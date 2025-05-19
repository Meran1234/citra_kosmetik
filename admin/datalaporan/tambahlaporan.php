<?php
include_once('../../koneksi.php');

if ($_GET['aksi'] == 'tambah') {
?>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/edit.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citra Kosmetik</title>
    <div class="container">
        <div class="card p-3">
            <h4>TAMBAH LAPORAN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <form action="proseslaporan.php?proses=prosestambah" method="post">
                        <div class="form-group">
                            <label>Rentang Waktu :</label>
                            <input type="number" name="rentang_waktu" class="form-control" placeholder="Rentang Waktu" required>
                        </div>
                        <div class="form-group">
                            <label>Total :</label>
                            <input type="number" name="total" class="form-control" placeholder="Total" required>
                        </div>
                        <div class="form-group">
                            <label>Merek :</label>
                            <input type="text" name="merek" class="form-control" placeholder="Merek" required>
                        </div>
                        <div class="form-group">
                            <label>Keuntungan :</label>
                            <input type="number" name="keuntungan" class="form-control" placeholder="Keuntungan" required>
                        </div>
                        <div class="modal-footer">
                            <a href="datalaporan.php" class="btn btn-primary">Kembali</a>
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php
}
?>