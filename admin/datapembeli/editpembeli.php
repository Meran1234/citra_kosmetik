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
            <h4>UBAH DATA PEMBELI</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <?php
                    if (isset($_GET['id_pembeli']) && is_numeric($_GET['id_pembeli'])) {
                        $id_pembeli = $_GET['id_pembeli'];

                        $stmt = $koneksi->prepare("SELECT * FROM tbl_pembeli WHERE id_pembeli = ?");
                        $stmt->bind_param("i", $id_pembeli);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($a = $result->fetch_array()) {
                    ?>
                            <form action="prosespembeli.php?proses=prosesubah&id_pembeli=<?php echo $a['id_pembeli']; ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($a['nama']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin :</label><br>
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo (isset($a['jenis_kelamin']) && $a['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?> id="Laki-laki" required>
                                    <label for="Laki-laki">Laki-laki</label>
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo (isset($a['jenis_kelamin']) && $a['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?> id="Perempuan" required>
                                    <label for="Perempuan">Perempuan</label>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" value="<?php echo htmlspecialchars($a['tgl_lahir']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($a['email']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="number" name="no_telp" class="form-control" value="<?php echo htmlspecialchars($a['no_telp']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>ID Alamat</label>
                                    <input type="text" name="id_alamat" class="form-control" value="<?php echo htmlspecialchars($a['id_alamat']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Gambar :</label>
                                    <input type="file" name="gambar" class="form-control">
                                    <small>Kosongkan jika tidak ingin mengubah gambar.</small>
                                    <br>
                                    <img src="../../profil/<?php echo $a['gambar']; ?>" width="150" height="150" alt="Gambar Produk">
                                </div>
                                <div class="modal-footer">
                                    <a href="datapembeli.php" class="btn btn-primary">Kembali</a>
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