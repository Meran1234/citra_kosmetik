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
            <h4>TAMBAH PESANAN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <form action="prosespesanan.php?proses=prosestambah" method="post">
                        <div class="form-group">
                            <label>Nama :</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label>Produk :</label>
                            <input type="text" name="produk" class="form-control" placeholder="Produk" required>
                        </div>
                        <div class="form-group">
                            <label>Harga :</label>
                            <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran:</label>
                            <input type="text" name="metode_pembayaran" class="form-control" placeholder="Metode Pembayaran" required>
                        </div>
                        <div class="modal-footer">
                            <a href="datapesanan.php" class="btn btn-primary">Kembali</a>
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