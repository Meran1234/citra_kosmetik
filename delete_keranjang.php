<?php
header('Content-Type: application/json');
include 'koneksi.php';

$id_user = $_POST['id_user'];
$merek = $_POST['merek'];

$response = array();

if (!empty($id_user) && !empty($merek)) {
    // Langkah 1: Ambil jumlah kuantitas item yang akan dihapus
    $query = "SELECT quantity, merek FROM tbl_keranjang WHERE id_user = '$id_user' AND merek = '$merek'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Langkah 2: Ambil kuantitas dari keranjang
        $item = mysqli_fetch_assoc($result);
        $quantityToReturn = $item['quantity'];
        
        // Langkah 3: Update stok di tbl_produk
        $updateStockQuery = "UPDATE tbl_produk SET stok = stok + $quantityToReturn WHERE merek = '$merek'";
        $updateStockResult = mysqli_query($koneksi, $updateStockQuery);

        if ($updateStockResult) {
            // Langkah 4: Hapus item dari keranjang
            $deleteQuery = "DELETE FROM tbl_keranjang WHERE id_user = '$id_user' AND merek = '$merek'";
            $deleteResult = mysqli_query($koneksi, $deleteQuery);

            if ($deleteResult) {
                $response['success'] = true;
                $response['message'] = "Item berhasil dihapus.";
            } else {
                $response['success'] = false;
                $response['message'] = "Gagal menghapus item dari keranjang.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal mengupdate stok produk.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Item tidak ditemukan di keranjang.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Data tidak lengkap.";
}

echo json_encode($response);
?>
