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
            <h4>UBAH LAPORAN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <?php
                    if (isset($_GET['id_laporan']) && is_numeric($_GET['id_laporan'])) {
                        $id_laporan = $_GET['id_laporan'];

                        $stmt = $koneksi->prepare("SELECT * FROM tbl_laporan WHERE id_laporan = ?");
                        $stmt->bind_param("i", $id_laporan);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($a = $result->fetch_array()) {
                    ?>
                            <form action="proseslaporan.php?proses=prosesubah&id_laporan=<?php echo $a['id_laporan']; ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Rentang Waktu</label>
                                    <input type="text" name="rentang_waktu" class="form-control" value="<?php echo htmlspecialchars($a['rentang_waktu']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="number" name="total" class="form-control" value="<?php echo htmlspecialchars($a['total']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Merek</label>
                                    <input type="text" name="merek" class="form-control" value="<?php echo htmlspecialchars($a['merek']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Keuntungan</label>
                                    <input type="number" name="keuntungan" class="form-control" value="<?php echo htmlspecialchars($a['keuntungan']); ?>" required>
                                </div>
                                <div class="modal-footer">
                                    <a href="datalaporan.php" class="btn btn-primary">Kembali</a>
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