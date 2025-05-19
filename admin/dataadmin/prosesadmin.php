<?php
include_once('../../koneksi.php');

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $id_admin = mysqli_real_escape_string($koneksi, $_GET['id_admin']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
      
        $query = "INSERT INTO tbl_admin (nama, email, password) 
                  VALUES ('$nama', '$email', '$password')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: dataadmin.php");
        }
    } elseif ($_GET['proses'] == 'prosesubah' && isset($_GET['id_admin'])) {
        $id_admin = mysqli_real_escape_string($koneksi, $_GET['id_admin']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $query = "UPDATE tbl_admin
                  SET nama = '$nama', email = '$email', password = '$password'
                  WHERE id_admin = '$id_admin'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: dataadmin.php");
        }
    } elseif ($_GET['proses'] == 'proseshapus' && isset($_GET['id_admin'])) {
        $id_admin = mysqli_real_escape_string($koneksi, $_GET['id_admin']);

        $query = "DELETE FROM tbl_admin WHERE id_admin = '$id_admin'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: dataadmin.php");
        }
    }
}
?>