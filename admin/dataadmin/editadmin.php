
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
            <h4>UBAH ADMIN</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <?php
                    if (isset($_GET['id_admin']) && is_numeric($_GET['id_admin'])) {
                        $id_admin = $_GET['id_admin'];

                        $stmt = $koneksi->prepare("SELECT * FROM tbl_admin WHERE id_admin = ?");
                        $stmt->bind_param("i", $id_admin);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($a = $result->fetch_array()) {
                    ?>
                            <form action="prosesadmin.php?proses=prosesubah&id_admin=<?php echo $a['id_admin']; ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($a['nama']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($a['email']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($a['password']); ?>" required>
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