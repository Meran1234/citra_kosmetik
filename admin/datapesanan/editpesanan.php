<?php
include_once('../../koneksi.php');

if ($_GET['aksi'] == 'ubah') {
?>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/edit.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citra Kosmetik</title>
    <div class="container">
        <div class="card p-3">
            <h4>UBAH PESANAN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <?php
                    if (isset($_GET['id_pesanan']) && is_numeric($_GET['id_pesanan'])) {
                        $id_pesanan = $_GET['id_pesanan'];

                        $stmt = $koneksi->prepare("SELECT * FROM tbl_pesanan WHERE id_pesanan = ?");
                        $stmt->bind_param("i", $id_pesanan);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($a = $result->fetch_array()) {
                    ?>
                            <form action="prosespesanan.php?proses=prosesubah&id_pesanan=<?php echo $a['id_pesanan']; ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($a['nama']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Produk</label>
                                    <input type="text" name="produk" class="form-control" value="<?php echo htmlspecialchars($a['produk']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" class="form-control" value="<?php echo htmlspecialchars($a['harga']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Metode Pembayaran</label>
                                    <input type="text" name="metode_pembayaran" class="form-control" value="<?php echo htmlspecialchars($a['metode_pembayaran']); ?>" required>
                                </div>
                                <div class="modal-footer">
                                    <a href="datapesanan.php" class="btn btn-primary">Kembali</a>
                                    <input type="submit" class="btn btn-success" value="Ubah">
                                </div>
                            </form>
                    <?php
                        } else {
                            echo "Data tidak ditemukan.";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>