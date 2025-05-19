<?php
header('Content-Type: application/json');

include 'koneksi.php';

// Ambil data dari POST
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($email) || empty($password)) {
    echo json_encode(['message' => 'Email dan password harus diisi']);
    exit;
}

// Cek apakah email terdaftar
$cek = $koneksi->prepare("SELECT id_user, password, nama FROM tbl_user WHERE email = ?");

$cek->bind_param("s", $email);
$cek->execute();
$cek->store_result();

if ($cek->num_rows == 0) {
    echo json_encode(['message' => 'Email atau password salah']);
    $cek->close();
    exit;
}

// Ambil data user
$cek->bind_result($id_user, $hashed_password, $nama);
$cek->fetch();
$cek->close();

// Verifikasi password
if (password_verify($password, $hashed_password)) {
    echo json_encode([
        'message' => 'Login berhasil!',
        'id_user' => $id_user, 
        'nama' => $nama
    ]);
} else {
    echo json_encode(['message' => 'Email atau password salah']);
}

$koneksi->close();
?>
