<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id_user = $_POST['id_user'];
$detail = $_POST['detail'];

$response = array();

if (!empty($id_user) && !empty($detail)) {
    // Query untuk mengambil id_alamat berdasarkan id_user dan detail yang diberikan
    $selectQuery = "SELECT id_alamat FROM tbl_alamat WHERE id_user = '$id_user' AND detail = '$detail'";
    $selectResult = mysqli_query($koneksi, $selectQuery);

    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $id_alamat = $row['id_alamat'];

        // Query untuk menghapus alamat dari tabel tbl_alamat
        $deleteQuery = "DELETE FROM tbl_alamat WHERE id_user = '$id_user' AND detail = '$detail'";
        $deleteResult = mysqli_query($koneksi, $deleteQuery);

        if ($deleteResult) {
            // Query untuk mengupdate id_alamat menjadi 0 di tbl_pembeli jika id_alamat yang dihapus sama
            $updateQuery = "UPDATE tbl_pembeli SET id_alamat = 0 WHERE id_user = '$id_user' AND id_alamat = '$id_alamat'";
            $updateResult = mysqli_query($koneksi, $updateQuery);

            if ($updateResult) {
                $response['success'] = true;
                $response['message'] = 'Alamat berhasil dihapus';
            } else {
                $response['success'] = false;
                $response['message'] = 'Gagal mengupdate id_alamat di tbl_pembeli';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal menghapus alamat';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Alamat tidak ditemukan';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Data tidak lengkap';
}

echo json_encode($response);
?>
