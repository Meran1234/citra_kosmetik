<?php
include_once('../../koneksi.php');

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $id_penjualan = mysqli_real_escape_string($koneksi, $_GET['id_penjualan']);
        $tgl_transaksi = mysqli_real_escape_string($koneksi, $_POST['tgl_transaksi']);
        $jumlah_terjual = mysqli_real_escape_string($koneksi, $_POST['jumlah_terjual']);
        $merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
        $harga= mysqli_real_escape_string($koneksi, $_POST['harga']);
        $total = mysqli_real_escape_string($koneksi, $_POST['total']);

      
        $query = "INSERT INTO tbl_penjualan (id_penjualan, tgl_transaksi, jumlah_terjual, merek, harga, total) 
                  VALUES ('$id_penjualan', '$tgl_transaksi', '$jumlah_terjual', '$merek', '$harga', '$total')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapenjualan.php");
        }
    } elseif ($_GET['proses'] == 'prosesubah' && isset($_GET['id_penjualan'])) {
        $id_penjualan = mysqli_real_escape_string($koneksi, $_GET['id_penjualan']);
        $tgl_transaksi = mysqli_real_escape_string($koneksi, $_POST['tgl_transaksi']);
        $jumlah_terjual = mysqli_real_escape_string($koneksi, $_POST['jumlah_terjual']);
        $merek = mysqli_real_escape_string($koneksi, $_POST['merek']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
        $total = mysqli_real_escape_string($koneksi, $_POST['total']);

        $query = "UPDATE tbl_penjualan 
                  SET id_penjualan = '$id_penjualan', tgl_transaksi = '$tgl_transaksi', jumlah_terjual = '$jumlah_terjual', 
                  merek = '$merek', harga = '$harga', total = '$total'
                  WHERE id_penjualan = '$id_penjualan'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapenjualan.php");
        }
    } elseif ($_GET['proses'] == 'proseshapus' && isset($_GET['id_penjualan'])) {
        $id_penjualan = mysqli_real_escape_string($koneksi, $_GET['id_penjualan']);

        $query = "DELETE FROM tbl_penjualan WHERE id_penjualan = '$id_penjualan'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapenjualan.php");
        }
    }
}
?>