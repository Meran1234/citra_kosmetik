<?php
header('Content-Type: application/json');

include 'koneksi.php';

// Ambil data dari POST
$id_produk = $_POST['id_produk'] ?? '';
$merek = $_POST['merek'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$id_user = $_POST['id_user'] ?? '';

// Validasi input
if (empty($id_produk) || empty($merek) || empty($quantity) || empty($id_user)) {
    echo json_encode([
        "success" => false,
        "message" => "Semua data harus diisi"
    ]);
    exit;
}

// Ambil id_pembeli dari tbl_pembeli berdasarkan id_user
$query_pembeli = $koneksi->prepare("SELECT id_pembeli FROM tbl_pembeli WHERE id_user = ?");
$query_pembeli->bind_param("i", $id_user);
$query_pembeli->execute();
$result = $query_pembeli->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "Data pembeli tidak ditemukan untuk user ini"
    ]);
    exit;
}

$row = $result->fetch_assoc();
$id_pembeli = $row['id_pembeli'];
$query_pembeli->close();

// Cek apakah produk dengan merek yang sama sudah ada di keranjang
$query_keranjang = $koneksi->prepare("SELECT id_keranjang, quantity FROM tbl_keranjang WHERE id_produk = ? AND merek = ? AND id_user = ?");
$query_keranjang->bind_param("isi", $id_produk, $merek, $id_user);
$query_keranjang->execute();
$result_keranjang = $query_keranjang->get_result();

if ($result_keranjang->num_rows > 0) {
    // Jika produk sudah ada di keranjang, update quantity
    $row_keranjang = $result_keranjang->fetch_assoc();
    $new_quantity = $row_keranjang['quantity'] + $quantity;

    $update_keranjang = $koneksi->prepare("UPDATE tbl_keranjang SET quantity = ? WHERE id_keranjang = ?");
    $update_keranjang->bind_param("ii", $new_quantity, $row_keranjang['id_keranjang']);
    
    if ($update_keranjang->execute()) {
        // Update stok produk
        $stmt_update = $koneksi->prepare("UPDATE tbl_produk SET stok = stok - ? WHERE id_produk = ?");
        $stmt_update->bind_param("ii", $quantity, $id_produk);

        if ($stmt_update->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Jumlah produk di keranjang diperbarui dan stok dikurangi"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Gagal mengurangi stok produk"
            ]);
        }

        $stmt_update->close();
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Gagal memperbarui keranjang: " . $update_keranjang->error
        ]);
    }
    $update_keranjang->close();
} else {
    // Jika produk belum ada di keranjang, masukkan data baru
    $stmt = $koneksi->prepare("INSERT INTO tbl_keranjang (id_produk, merek, quantity, id_user, id_pembeli) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiii", $id_produk, $merek, $quantity, $id_user, $id_pembeli);

    if ($stmt->execute()) {
        // Update stok produk
        $stmt_update = $koneksi->prepare("UPDATE tbl_produk SET stok = stok - ? WHERE id_produk = ?");
        $stmt_update->bind_param("ii", $quantity, $id_produk);

        if ($stmt_update->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Produk dimasukkan ke keranjang dan stok dikurangi"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Gagal mengurangi stok produk"
            ]);
        }

        $stmt_update->close();
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Gagal menambahkan ke keranjang: " . $stmt->error
        ]);
    }

    $stmt->close();
}

$koneksi->close();
?>
