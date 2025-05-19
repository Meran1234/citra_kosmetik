<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id_produk = $_POST['id_produk'] ?? '';
$merek     = $_POST['merek'] ?? '';
$harga     = $_POST['harga'] ?? '';
$id_user   = $_POST['id_user'] ?? '';

if (empty($id_produk) || empty($merek) || empty($harga) || empty($id_user)) {
    echo json_encode([
        "success" => false,
        "message" => "Semua data harus diisi"
    ]);
    exit;
}

// Cek apakah produk dengan merek yang sama sudah ada di favorit untuk user ini
$query_check = $koneksi->prepare("SELECT id_favorite FROM tbl_favorite WHERE id_user = ? AND merek = ?");
$query_check->bind_param("is", $id_user, $merek);
$query_check->execute();
$result_check = $query_check->get_result();

if ($result_check->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Produk dengan merek ini sudah ada di favorit"
    ]);
    exit;
}

$query_pembeli = $koneksi->prepare("SELECT id_pembeli FROM tbl_pembeli WHERE id_user = ?");
$query_pembeli->bind_param("i", $id_user);
$query_pembeli->execute();
$result = $query_pembeli->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "Data pembeli tidak ditemukan untuk user ini"
    ]);
    exit;
}

$row = $result->fetch_assoc();
$id_pembeli = $row['id_pembeli'];
$query_pembeli->close();

$stmt = $koneksi->prepare("INSERT INTO tbl_favorite (id_produk, merek, harga, id_user, id_pembeli) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isiii", $id_produk, $merek, $harga, $id_user, $id_pembeli);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Berhasil menambahkan ke favorite"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Gagal menambahkan ke favorite: " . $stmt->error
    ]);
}

$stmt->close();
$koneksi->close();
?>
