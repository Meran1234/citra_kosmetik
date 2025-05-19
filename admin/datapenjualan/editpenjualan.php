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
            <h4>UBAH DATA PENJUALAN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <?php
                    if (isset($_GET['id_penjualan']) && is_numeric($_GET['id_penjualan'])) {
                        $id_penjualan = $_GET['id_penjualan'];

                        $stmt = $koneksi->prepare("SELECT * FROM tbl_penjualan WHERE id_penjualan = ?");
                        $stmt->bind_param("i", $id_penjualan);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($a = $result->fetch_array()) {
                    ?>
                            <form action="prosespenjualan.php?proses=prosesubah&id_penjualan=<?php echo $a['id_penjualan']; ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Tanggal Transaksi</label>
                                    <input type="date" name="tgl_transaksi" class="form-control" value="<?php echo htmlspecialchars($a['tgl_transaksi']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Terjual</label>
                                    <input type="number" name="jumlah_terjual" class="form-control" value="<?php echo htmlspecialchars($a['jumlah_terjual']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Merek</label>
                                    <input type="text" name="merek" class="form-control" value="<?php echo htmlspecialchars($a['merek']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?php echo htmlspecialchars($a['harga']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" name="total" class="form-control" value="<?php echo htmlspecialchars($a['total']); ?>" required>
                                </div>
                                <div class="modal-footer">
                                    <a href="datapenjualan.php" class="btn btn-primary">Kembali</a>
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