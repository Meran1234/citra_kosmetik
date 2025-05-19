<?php
include_once('../../koneksi.php');

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $id_laporan = mysqli_real_escape_string($koneksi, $_GET['id_laporan']);
        $rentang_waktu = mysqli_real_escape_string($koneksi, $_POST['rentang_waktu']);
        $total = mysqli_real_escape_string($koneksi, $_POST['total']);
        $merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
        $keuntungan = mysqli_real_escape_string($koneksi, $_POST['keuntungan']);

      
        $query = "INSERT INTO tbl_laporan (rentang_waktu, total, merek, keuntungan) 
                  VALUES ('$rentang_waktu', '$total', '$merek', '$keuntungan')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datalaporan.php");
        }
    } elseif ($_GET['proses'] == 'prosesubah' && isset($_GET['id_laporan'])) {
        $id_laporan = mysqli_real_escape_string($koneksi, $_GET['id_laporan']);
        $rentang_waktu = mysqli_real_escape_string($koneksi, $_POST['rentang_waktu']);
        $total = mysqli_real_escape_string($koneksi, $_POST['total']);
        $merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
        $keuntungan = mysqli_real_escape_string($koneksi, $_POST['keuntungan']);

        $query = "UPDATE tbl_laporan
                  SET id_laporan = '$id_laporan', rentang_waktu = '$rentang_waktu', total = '$total', 
                  merek = '$merek', keuntungan = '$keuntungan'
                  WHERE id_laporan = '$id_laporan'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datalaporan.php");
        }
    } elseif ($_GET['proses'] == 'proseshapus' && isset($_GET['id_laporan'])) {
        $id_laporan = mysqli_real_escape_string($koneksi, $_GET['id_laporan']);

        $query = "DELETE FROM tbl_laporan WHERE id_laporan = '$id_laporan'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datalaporan.php");
        }
    }
}
?>