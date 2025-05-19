<?php
$host = "localhost";
$user = "upnyvmnz_citra_kosmetik";
$password = "citrakosmetik123";
$database = "upnyvmnz_citra_kosmetik";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

