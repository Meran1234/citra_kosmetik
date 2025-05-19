<?php
include_once('../../koneksi.php');

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
        $id_alamat = mysqli_real_escape_string($koneksi, $_POST['id_alamat']);

        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../../profil/";
        $target_file = $target_dir . basename($gambar);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO tbl_pembeli (nama, jenis_kelamin, tgl_lahir, email, no_telp, id_alamat, gambar) 
                  VALUES ('$nama', '$jenis_kelamin', '$tgl_lahir', '$email', '$no_telp', '$id_alamat', '$gambar')";
                if (mysqli_query($koneksi, $query)) {
                    header("Location: datapembeli.php");
                    exit();
                } else {
                    die("Error: " . mysqli_error($koneksi));
                }
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            echo "Format gambar tidak didukung (Gunakan JPG, JPEG, PNG, GIF).";
        }
    } elseif ($_GET['proses'] == 'prosesubah' && isset($_GET['id_pembeli'])) {
        $id_pembeli = mysqli_real_escape_string($koneksi, $_GET['id_pembeli']);
        $id_pembeli = mysqli_real_escape_string($koneksi, $_GET['id_pembeli']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
        $id_alamat = mysqli_real_escape_string($koneksi, $_POST['id_alamat']);


        $query_old = "SELECT gambar FROM tbl_pembeli WHERE id_pembeli = '$id_pembeli'";
        $result_old = mysqli_query($koneksi, $query_old);
        $data_old = mysqli_fetch_assoc($result_old);
        $gambar_lama = $data_old['gambar'];

        if ($_FILES['gambar']['name']) {
            $gambar = $_FILES['gambar']['name'];
            $target_file = "../../profil/" . basename($gambar);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    if (!empty($gambar_lama) && file_exists("../../profil/" . $gambar_lama)) {
                        unlink("../../profil/" . $gambar_lama);
                    }
                    $query = "UPDATE tbl_pembeli 
                  SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', tgl_lahir = '$tgl_lahir', 
                  email = '$email', no_telp = '$no_telp', id_alamat = '$id_alamat', gambar = '$gambar'
                  WHERE id_pembeli = '$id_pembeli'";
                } else {
                    die("Gagal mengunggah gambar.");
                }
            } else {
                die("Format gambar tidak didukung.");
            }
        } else {
            $query = "UPDATE tbl_pembeli 
                  SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', tgl_lahir = '$tgl_lahir', 
                  email = '$email', no_telp = '$no_telp', id_alamat = '$id_alamat'
                  WHERE id_pembeli = '$id_pembeli'";
        }

        if (mysqli_query($koneksi, $query)) {
            header("Location: datapembeli.php");
            exit();
        } else {
            die("Error: " . mysqli_error($koneksi));
        }
    }
}
?>
