<?php
include 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_user'])) {
    $id_user = intval($_GET['id_user']);

    $query = $koneksi->prepare("
        SELECT nama, no_telp, alamat, jalan, detail, flag 
        FROM tbl_alamat 
        WHERE id_user = ?
        ORDER BY flag DESC, id_alamat DESC
    ");
    $query->bind_param("i", $id_user);
    $query->execute();
    $result = $query->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    $query->close();
    $koneksi->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'ID user tidak ditemukan atau metode tidak valid'
    ]);
}
?>
