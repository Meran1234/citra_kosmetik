<?php
header('Content-Type: application/json');
include 'koneksi.php';

// Ambil data dari POST
$id_user = $_POST['id_user'] ?? '';
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$tgl_lahir = $_POST['tgl_lahir'] ?? '';
$no_telp = $_POST['no_telp'] ?? '';

// Validasi input
if (empty($id_user) || empty($nama) || empty($email) || empty($jenis_kelamin) || empty($tgl_lahir) || empty($no_telp)) {
    echo json_encode([
        "success" => false,
        "message" => "Semua data harus diisi"
    ]);
    exit;
}

// Mulai transaksi
$koneksi->begin_transaction();

try {
    // Update tbl_pembeli
    $stmt1 = $koneksi->prepare("UPDATE tbl_pembeli SET nama = ?, email = ?, jenis_kelamin = ?, tgl_lahir = ?, no_telp = ? WHERE id_user = ?");
    $stmt1->bind_param("sssssi", $nama, $email, $jenis_kelamin, $tgl_lahir, $no_telp, $id_user);
    $stmt1->execute();

    // Update tbl_user
    $stmt2 = $koneksi->prepare("UPDATE tbl_user SET nama = ?, email = ?, no_telp = ? WHERE id_user = ?");
    $stmt2->bind_param("sssi", $nama, $email, $no_telp, $id_user);
    $stmt2->execute();

    // Commit transaksi jika berhasil
    $koneksi->commit();

    echo json_encode([
        "success" => true,
        "message" => "Data berhasil diperbarui di kedua tabel"
    ]);
} catch (Exception $e) {
    // Rollback jika ada error
    $koneksi->rollback();
    echo json_encode([
        "success" => false,
        "message" => "Gagal memperbarui data: " . $e->getMessage()
    ]);
}

// Tutup statement dan koneksi
$stmt1->close();
$stmt2->close();
$koneksi->close();
?>
