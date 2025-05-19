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
            <h4>TAMBAH DATA PEMBELI</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <form action="prosespembeli.php?proses=prosestambah" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama :</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin :</label><br>
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" id="Laki-laki" required>
                            <label for="Laki-laki">Laki-laki</label>
                            <input type="radio" name="jenis_kelamin" value="Perempuan" id="Perempuan" required>
                            <label for="Perempuan">Perempuan</label>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir :</label>
                            <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp :</label>
                            <input type="number" name="no_telp" class="form-control" placeholder="No Telp" required>
                        </div>
                        <div class="form-group">
                            <label>ID Alamat :</label>
                            <input type="text" name="id_alamat" class="form-control" placeholder="ID Alamat" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gambar :</label>
                            <input type="file" name="gambar" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <a href="datapembeli.php" class="btn btn-primary">Kembali</a>
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