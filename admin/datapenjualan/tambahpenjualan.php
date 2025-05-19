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
            <h4>TAMBAH DATA PENJUALAN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <form action="prosespenjualan.php?proses=prosestambah" method="post">
                        <div class="form-group">
                            <label>Tanggal Transaksi :</label>
                            <input type="date" name="tgl_transaksi" class="form-control" placeholder="Tanggal Transaksi" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Terjual :</label>
                            <input type="number" name="jumlah_terjual" class="form-control" placeholder="Jumlah Terjual" required>
                        </div>
                        <div class="form-group">
                            <label>Merek :</label>
                            <input type="text" name="merek" class="form-control" placeholder="Merek" required>
                        </div>
                        <div class="form-group">
                            <label>Harga :</label>
                            <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                        </div>
                        <div class="form-group">
                            <label>Total :</label>
                            <input type="text" name="total" class="form-control" placeholder="Total" required>
                        </div>
                        <div class="modal-footer">
                            <a href="datapenjualan.php" class="btn btn-primary">Kembali</a>
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