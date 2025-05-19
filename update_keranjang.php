<?php
header('Content-Type: application/json');
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

$id_user = $_POST['id_user'];
$merek = $_POST['merek'];
$quantity = $_POST['quantity'];

// Query untuk mengambil quantity sebelumnya dari keranjang
$query_keranjang = "SELECT quantity FROM tbl_keranjang WHERE id_user = '$id_user' AND merek = '$merek'";
$result_keranjang = mysqli_query($koneksi, $query_keranjang);
$row_keranjang = mysqli_fetch_assoc($result_keranjang);
$previous_quantity = $row_keranjang['quantity'] ?? 0;

// Query untuk memperbarui quantity di keranjang
$query_update_keranjang = "UPDATE tbl_keranjang SET quantity = '$quantity' WHERE id_user = '$id_user' AND merek = '$merek'";

// Mengambil stok produk yang ada
$query_stok = "SELECT stok FROM tbl_produk WHERE merek = '$merek'";
$result_stok = mysqli_query($koneksi, $query_stok);
$row_stok = mysqli_fetch_assoc($result_stok);
$current_stok = $row_stok['stok'];

// Tentukan apakah quantity bertambah atau berkurang
if ($quantity > $previous_quantity) {
    // Jika quantity bertambah, kurangi stok
    $stok_update = $current_stok - ($quantity - $previous_quantity);
} elseif ($quantity < $previous_quantity) {
    // Jika quantity berkurang, tambah stok
    $stok_update = $current_stok + ($previous_quantity - $quantity);
} else {
    // Jika quantity tidak berubah, tidak ada perubahan stok
    $stok_update = $current_stok;
}

// Pastikan stok cukup untuk perubahan
if ($stok_update >= 0) {
    // Update stok produk di tabel tbl_produk
    $query_update_stok = "UPDATE tbl_produk SET stok = '$stok_update' WHERE merek = '$merek'";

    // Lakukan pembaruan keranjang dan stok
    if (mysqli_query($koneksi, $query_update_keranjang) && mysqli_query($koneksi, $query_update_stok)) {
        echo json_encode(['success' => true, 'message' => 'Quantity berhasil diperbarui dan stok berhasil diperbarui']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui keranjang atau stok']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Stok tidak cukup']);
}

mysqli_close($koneksi);
?>
