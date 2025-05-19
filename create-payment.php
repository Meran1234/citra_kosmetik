<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
require 'koneksi.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-5zG3F2x80tzmagnnEgUQqpDJ';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil input JSON dari request body
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!$input) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
    exit;
}

// Ambil data user dan produk
$id_user = $input['id_user'] ?? '';
$nama_pembeli = $input['nama'] ?? '';
$email_pembeli = $input['email'] ?? '';
$telepon_pembeli = $input['no_telp'] ?? '';
$alamat = $input['alamat'] ?? '';
$produkList = $input['produk'] ?? [];
$total_harga = $input['total'] ?? 0;

if (empty($produkList)) {
    echo json_encode(['status' => 'error', 'message' => 'Produk tidak boleh kosong']);
    exit;
}

// Generate order ID
$order_id = uniqid("ORDER-");

// Siapkan item_details untuk Midtrans dari list produk
$item_details = [];
foreach ($produkList as $produk) {
    $id_produk = $produk['id_produk'];
    $jumlah = (int)$produk['jumlah'];
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
    $produk_db = mysqli_fetch_assoc($query);
    if (!$produk_db) {
        echo json_encode(['status' => 'error', 'message' => "Produk dengan ID $id_produk tidak ditemukan"]);
        exit;
    }
    $item_details[] = [
        'id' => $produk_db['id_produk'],
        'price' => (int)$produk_db['harga'],
        'quantity' => $jumlah,
        'name' => $produk_db['merek'] . " - " . $produk_db['jenis'],
    ];
}

// Payload Midtrans
$params = [
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => (int)$total_harga,
    ],
    'item_details' => $item_details,
    'customer_details' => [
        'first_name' => $nama_pembeli,
        'email' => $email_pembeli,
        'phone' => $telepon_pembeli
    ]
];

// Request Snap token
try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // Simpan transaksi ke database tanpa detail produk terpisah
    $nama_pembeli_esc = mysqli_real_escape_string($koneksi, $nama_pembeli);
    $alamat_esc = mysqli_real_escape_string($koneksi, $alamat);

    mysqli_query($koneksi, "INSERT INTO tbl_transaksi (
        id_transaksi, id_user, nama_pembeli, alamat, total_harga, status, payment_url, reference, tanggal
    ) VALUES (
        '$order_id', '$id_user', '$nama_pembeli_esc', '$alamat_esc', $total_harga, 'PENDING', '', '$snapToken', NOW()
    )");

    echo json_encode([
        'status' => 'success',
        'snap_token' => $snapToken,
        'order_id' => $order_id
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}