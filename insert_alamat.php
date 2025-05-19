<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $jalan = $_POST['jalan'];
    $detail = $_POST['detail'];
    $flag = isset($_POST['flag']) ? intval($_POST['flag']) : 0;

    if (empty($id_user) || empty($nama) || empty($no_telp) || empty($alamat) || empty($jalan) || empty($detail)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Semua field harus diisi'
        ]);
        exit;
    }

    // Cek user dan ambil id_pembeli
    $check = $koneksi->prepare("
        SELECT u.id_user, p.id_pembeli
        FROM tbl_user u
        JOIN tbl_pembeli p ON u.id_user = p.id_user
        WHERE u.id_user = ?
    ");
    $check->bind_param("i", $id_user);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_pembeli = $row['id_pembeli'];

        // Jika flag = 1, reset alamat utama sebelumnya (per user)
        if ($flag === 1) {
            $reset = $koneksi->prepare("UPDATE tbl_alamat SET flag = 0 WHERE id_user = ? AND flag = 1");
            $reset->bind_param("i", $id_user);
            $reset->execute();
            $reset->close();
        }

        // Masukkan alamat baru
        $stmt = $koneksi->prepare("
            INSERT INTO tbl_alamat (id_user, id_pembeli, nama, no_telp, alamat, jalan, detail, flag)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("iisssssi", $id_user, $id_pembeli, $nama, $no_telp, $alamat, $jalan, $detail, $flag);

        if ($stmt->execute()) {
            // Jika alamat yang disimpan adalah alamat utama (flag=1), update tbl_pembeli
            if ($flag === 1) {
                $id_alamat_baru = $koneksi->insert_id;

                $updatePembeli = $koneksi->prepare("UPDATE tbl_pembeli SET id_alamat = ? WHERE id_user = ?");
                $updatePembeli->bind_param("ii", $id_alamat_baru, $id_user);
                $updatePembeli->execute();
                $updatePembeli->close();
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Alamat berhasil disimpan'
            ]);
        } else {
            echo json_encode([
                'status' => 'insert_failed',
                'message' => 'Gagal menyimpan alamat: ' . $stmt->error
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            'status' => 'user_not_found',
            'message' => 'User tidak ditemukan'
        ]);
    }

    $check->close();
    $koneksi->close();
}
?>
