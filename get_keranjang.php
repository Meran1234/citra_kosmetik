<?php
header('Content-Type: application/json');
include 'koneksi.php';

// Ambil data dari POST
$id_user = $_POST['id_user'] ?? '';

// Validasi input
if (empty($id_user)) {
    echo json_encode([
        "success" => false,
        "message" => "ID user harus diisi"
    ]);
    exit;
}

// Query untuk mengambil data keranjang berdasarkan id_user
$stmt = $koneksi->prepare("SELECT tbl_keranjang.id_keranjang, tbl_keranjang.quantity, tbl_produk.merek, tbl_produk.harga, tbl_produk.gambar FROM tbl_keranjang INNER JOIN tbl_produk ON tbl_keranjang.id_produk = tbl_produk.id_produk WHERE tbl_keranjang.id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    // Ambil semua gambar sebagai string dan pisahkan berdasarkan koma
    $gambarArray = explode(',', $row['gambar']); // Memisahkan gambar menjadi array

    // Gabungkan URL dasar dengan gambar
    $gambarURLs = array_map(function ($gambar) {
        return 'https://citrakosmetik.my.id/uploads/' . $gambar;
    }, $gambarArray);

    // Menambahkan gambar array ke dalam data produk
    $row['gambar'] = $gambarURLs;
    $data[] = $row;
}

// Jika ada data keranjang, kirimkan sebagai JSON
if (!empty($data)) {
    echo json_encode([
        "success" => true,
        "keranjang" => $data
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Keranjang kosong"
    ]);
}

$stmt->close();
$koneksi->close();
?>
