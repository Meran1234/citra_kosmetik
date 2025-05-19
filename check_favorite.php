<?php

header('Content-Type: application/json');
include 'koneksi.php'; // Pastikan untuk menyertakan koneksi database Anda

// Ambil parameter yang dikirimkan via GET
$id_produk = $_GET['id_produk'];
$id_user = $_GET['id_user'];

// Query untuk memeriksa apakah produk sudah ada di tabel favorit
$query = "SELECT * FROM tbl_favorite WHERE id_produk = ? AND id_user = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ii", $id_produk, $id_user); // Mengikat parameter (integer)
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah ada hasil
if ($result->num_rows > 0) {
    echo json_encode(['success' => true]); // Produk ada di favorit
} else {
    echo json_encode(['success' => false]); // Produk belum ada di favorit
}

$stmt->close();
$koneksi->close();
?>
