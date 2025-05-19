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
            <h4>TAMBAH ADMIN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <form action="prosesadmin.php?proses=prosestambah" method="post">
                        <div class="form-group">
                            <label>Nama  :</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input type="text" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                            <a href="dataadmin.php" class="btn btn-primary">Kembali</a>
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