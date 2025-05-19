<?php
include_once('koneksi.php');

// Mengecek apakah id_user ada di dalam request
if (!isset($_POST['id_user']) || empty($_POST['id_user'])) {
    echo json_encode(['error' => 'ID User diperlukan']);
    exit;
}

// Ambil id_user dari request
$id_user = $_POST['id_user'];

// Pastikan koneksi berhasil
if ($koneksi === false) {
    echo json_encode(['error' => 'Gagal terhubung ke database']);
    exit;
}

// Query untuk mengambil data dari tbl_favorite yang sesuai dengan id_user
$query = "
    SELECT 
        f.id_produk, 
        f.merek, 
        f.harga, 
        p.gambar,
        p.stok,
        p.deskripsi
    FROM 
        tbl_favorite f
    LEFT JOIN 
        tbl_produk p ON f.id_produk = p.id_produk
    WHERE 
        f.id_user = '$id_user'"; // Filter berdasarkan id_user

$result = mysqli_query($koneksi, $query);

// Cek apakah query berhasil dieksekusi
if ($result === false) {
    echo json_encode(['error' => 'Gagal mengeksekusi query']);
    exit;
}

$data = [];

// Ambil data dan masukkan ke dalam array
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
// Mengatur header agar output dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

// Menutup koneksi
mysqli_close($koneksi);
?>
