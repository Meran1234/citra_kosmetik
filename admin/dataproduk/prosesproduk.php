
<?php
include_once('../../koneksi.php');

$proses = $_GET['proses'] ?? '';

if ($proses == 'prosestambah') {
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = intval(str_replace(".", "", $_POST['harga']));
    $stok = intval($_POST['stok']);

    $gambar_array = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $nama_file_tersimpan = [];

    for ($i = 0; $i < count($gambar_array); $i++) {
        $nama_file = uniqid() . '-' . basename($gambar_array[$i]);
        move_uploaded_file($gambar_tmp[$i], '../../uploads/' . $nama_file);
        $nama_file_tersimpan[] = $nama_file;
    }

    $gambar_disimpan = implode(',', $nama_file_tersimpan);

    $query = "INSERT INTO tbl_produk (kategori, jenis, merek, deskripsi, harga, stok, gambar)
              VALUES ('$kategori', '$jenis', '$merek', '$deskripsi', '$harga', '$stok', '$gambar_disimpan')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: dataproduk.php");
        exit();
    } else {
        die("Gagal menyimpan data: " . mysqli_error($koneksi));
    }
} elseif ($_GET['proses'] == 'prosesubah' && isset($_GET['id_produk'])) {
    $id_produk = mysqli_real_escape_string($koneksi, $_GET['id_produk']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = intval(str_replace(".", "", $_POST['harga']));
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);

    // Ambil gambar lama dari input hidden
    $gambar_lama = $_POST['gambar_lama'] ?? [];

    // Siapkan array untuk file baru
    $gambar_baru = [];

    if ($_FILES['gambar']['name'][0]) {
        foreach ($_FILES['gambar']['name'] as $key => $name) {
            if ($_FILES['gambar']['error'][$key] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['gambar']['tmp_name'][$key];
                $nama_file = uniqid() . '-' . basename($name);
                move_uploaded_file($tmp_name, '../../uploads/' . $nama_file);
                $gambar_baru[] = $nama_file;
            }
        }
    }

    // Gabungkan gambar lama dan gambar baru
    $semua_gambar = array_merge($gambar_lama, $gambar_baru);
    $gambar_disimpan = implode(',', $semua_gambar);

    // Update data produk
    $query = "UPDATE tbl_produk 
              SET kategori='$kategori', jenis='$jenis', merek='$merek', deskripsi='$deskripsi', 
                  harga='$harga', stok='$stok', gambar='$gambar_disimpan' 
              WHERE id_produk='$id_produk'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: dataproduk.php");
        exit();
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
} elseif ($proses == 'proseshapus' && isset($_GET['id_produk'])) {
    $id_produk = mysqli_real_escape_string($koneksi, $_GET['id_produk']);

    $query_old = "SELECT gambar FROM tbl_produk WHERE id_produk = '$id_produk'";
    $result_old = mysqli_query($koneksi, $query_old);
    $data_old = mysqli_fetch_assoc($result_old);
    $gambar_lama = $data_old['gambar'];

    if (!empty($gambar_lama) && file_exists("../../uploads/" . $gambar_lama)) {
        unlink("../../uploads/" . $gambar_lama);
    }

    $query = "DELETE FROM tbl_produk WHERE id_produk='$id_produk'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: dataproduk.php");
        exit();
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
}

?>
