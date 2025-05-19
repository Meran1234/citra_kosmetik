<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

include 'koneksi.php'; // koneksi ke database

$id_user = $_POST['id_user'] ?? '';
$id_produk = $_POST['id_produk'] ?? '';

$response = array();

if (!empty($id_user) && !empty($id_produk)) {
    $query = "DELETE FROM tbl_favorite WHERE id_user = '$id_user' AND id_produk = '$id_produk'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $response['success'] = true;
        $response['message'] = "Data favorite berhasil dihapus.";
    } else {
        $response['success'] = false;
        $response['message'] = "Gagal menghapus data favorite.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Data tidak lengkap.";
}

echo json_encode($response);
?>
