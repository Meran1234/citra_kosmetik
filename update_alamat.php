<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'koneksi.php'; // Pastikan koneksi sudah benar dan aman

// Ambil data dari POST
$data = json_decode(file_get_contents("php://input"), true);

// Validasi data
if (
    isset($data['id_user']) &&
    isset($data['id_alamat']) &&
    isset($data['nama']) &&
    isset($data['no_telp']) &&
    isset($data['alamat']) &&
    isset($data['jalan']) &&
    isset($data['detail']) &&
    isset($data['flag'])
) {
    $id_user = $data['id_user'];
    $id_alamat = $data['id_alamat'];
    $nama = $data['nama'];
    $no_telp = $data['no_telp'];
    $alamat = $data['alamat'];
    $jalan = $data['jalan'];
    $detail = $data['detail'];
    $flag = $data['flag'];

    // Jika flag == 1, reset alamat utama lain
    if ($flag == "1") {
        $reset = mysqli_query($koneksi, "UPDATE tbl_alamat SET flag = '0' WHERE id_user = '$id_user'");
    }

    // Update alamat
    $query = "UPDATE tbl_alamat SET 
        nama = '$nama',
        no_telp = '$no_telp',
        alamat = '$alamat',
        jalan = '$jalan',
        detail = '$detail',
        flag = '$flag'
        WHERE id_alamat = '$id_alamat' AND id_user = '$id_user'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "Alamat berhasil diperbarui"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "message" => "Gagal memperbarui alamat"
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);
}
?>
