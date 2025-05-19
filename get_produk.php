<?php
include_once('koneksi.php');

$query = "SELECT * FROM tbl_produk";
$result = mysqli_query($koneksi, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Ambil semua gambar sebagai string dan pisahkan berdasarkan koma
    $gambarArray = explode(',', $row['gambar']);  // Memisahkan gambar menjadi array
    // Gabungkan URL dasar dengan gambar
    $gambarURLs = array_map(function ($gambar) {
        return 'https://citrakosmetik.my.id/uploads/' . $gambar;
    }, $gambarArray);

    // Menambahkan gambar array ke dalam data produk
    $row['gambar'] = $gambarURLs;  // Kirimkan array gambar
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
