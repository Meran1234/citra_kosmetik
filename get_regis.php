<?php
header('Content-Type: application/json');

include 'koneksi.php';

// Ambil data dari POST
$nama     = $_POST['nama'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$no_telp  = $_POST['no_telp'] ?? '';

// Validasi input
if (empty($nama) || empty($email) || empty($password) || empty($no_telp)) {
    echo json_encode(['message' => 'Semua field harus diisi.']);
    exit;
}

// Cek apakah email sudah terdaftar
$cek = $koneksi->prepare("SELECT id_user FROM tbl_user WHERE email = ?");
$cek->bind_param("s", $email);
$cek->execute();
$cek->store_result();

if ($cek->num_rows > 0) {
    echo json_encode(['message' => 'Email sudah terdaftar.']);
    $cek->close();
    exit;
}
$cek->close();

// Hash password sebelum simpan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Simpan user baru
$stmt = $koneksi->prepare("INSERT INTO tbl_user (nama, email, password, no_telp) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $email, $hashed_password, $no_telp);

if ($stmt->execute()) {
    $id_user = $stmt->insert_id;

    // Simpan juga ke tabel pembeli
    $stmt2 = $koneksi->prepare("INSERT INTO tbl_pembeli (id_user, nama, email, no_telp) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("isss", $id_user, $nama, $email, $no_telp);

    if ($stmt2->execute()) {
        echo json_encode([
            'message' => 'Registrasi berhasil!',
            'id_user' => $id_user
        ]);
    } else {
        echo json_encode(['message' => 'Gagal menyimpan ke tbl_pembeli: ' . $stmt2->error]);
    }

    $stmt2->close();
} else {
    echo json_encode(['message' => 'Registrasi gagal: ' . $stmt->error]);
}

$stmt->close();
$koneksi->close();
?>
