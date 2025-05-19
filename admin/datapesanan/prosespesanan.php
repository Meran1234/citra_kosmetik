<?php
include_once('../../koneksi.php');

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id_pesanan']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $produk = mysqli_real_escape_string($koneksi, $_POST['produk']);
        $harga= mysqli_real_escape_string($koneksi, $_POST['harga']);
        $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);

        $query = "INSERT INTO tbl_pesanan (nama, produk, harga, metode_pembayaran) 
                  VALUES ('$nama', '$produk', '$harga', '$metode_pembayaran')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapesanan.php");
        }
    } elseif ($_GET['proses'] == 'prosesubah' && isset($_GET['id_pesanan'])) {
        $id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id_pesanan']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $produk = mysqli_real_escape_string($koneksi, $_POST['produk']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
        $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);

        $query = "UPDATE tbl_pesanan
                  SET nama = '$nama', produk = '$produk', harga = '$harga', metode_pembayaran = '$metode_pembayaran'
                  WHERE id_pesanan = '$id_pesanan'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapesanan.php");
        }
    } elseif ($_GET['proses'] == 'proseshapus' && isset($_GET['id_pesanan'])) {
        $id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id_pesanan']);

        $query = "DELETE FROM tbl_pesanan WHERE id_pesanan = '$id_pesanan'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapesanan.php");
        }
    }
}
?>