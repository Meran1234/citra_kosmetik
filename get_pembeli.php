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

// Query untuk mengambil data pembeli berdasarkan id_user
$stmt = $koneksi->prepare("SELECT tbl_user.id_user, tbl_user.nama, tbl_user.email, tbl_pembeli.jenis_kelamin, tbl_pembeli.tgl_lahir, tbl_pembeli.no_telp,tbl_pembeli.gambar FROM tbl_user INNER JOIN tbl_pembeli ON tbl_user.id_user = tbl_pembeli.id_user WHERE tbl_user.id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

$pembeli = [];
while ($row = $result->fetch_assoc()) {
    $pembeli[] = $row;
}

if (!empty($pembeli)) {
    echo json_encode([
        "success" => true,
        "pembeli" => $pembeli
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Pembeli tidak ditemukan"
    ]);
}

$stmt->close();
$koneksi->close();
?>
