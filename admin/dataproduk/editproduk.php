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
            <h4>UBAH DATA PRODUK</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <?php
                    if (isset($_GET['id_produk']) && is_numeric($_GET['id_produk'])) {
                        $id_produk = $_GET['id_produk'];

                        $stmt = $koneksi->prepare("SELECT * FROM tbl_produk WHERE id_produk = ?");
                        $stmt->bind_param("i", $id_produk);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($a = $result->fetch_array()) {
                    ?>
                            <form action="prosesproduk.php?proses=prosesubah&id_produk=<?php echo $a['id_produk']; ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Skincare Dasar" <?php if ($a['kategori'] == 'Skincare Dasar') echo 'selected'; ?>>Skincare Dasar</option>
                                        <option value="Perawatan Wajah" <?php if ($a['kategori'] == 'Perawatan Wajah') echo 'selected'; ?>>Perawatan Wajah</option>
                                        <option value="Makeup Wajah" <?php if ($a['kategori'] == 'Makeup Wajah') echo 'selected'; ?>>Makeup Wajah</option>
                                        <option value="Makeup Mata" <?php if ($a['kategori'] == 'Makeup Mata') echo 'selected'; ?>>Makeup Mata</option>
                                        <option value="Haircare" <?php if ($a['kategori'] == 'Haircare') echo 'selected'; ?>>Haircare</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" name="jenis" class="form-control" value="<?php echo htmlspecialchars($a['jenis']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Merek</label>
                                    <input type="text" name="merek" class="form-control" value="<?php echo htmlspecialchars($a['merek']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" value="<?php echo htmlspecialchars($a['deskripsi']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" class="form-control" value="<?php echo htmlspecialchars($a['harga']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="stok" class="form-control" value="<?php echo htmlspecialchars($a['stok']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Gambar :</label>
                                    <input type="file" name="gambar[]" class="form-control" multiple>
                                    <br>

                                    <style>
                                        .image-wrapper {
                                            position: relative;
                                            display: inline-block;
                                            margin-right: 10px;
                                            margin-bottom: 10px;
                                        }

                                        .image-wrapper img {
                                            display: block;
                                            border: 1px solid #ccc;
                                            border-radius: 8px;
                                        }

                                        .image-wrapper .remove-image {
                                            position: absolute;
                                            top: -8px;
                                            right: -8px;
                                            background: red;
                                            color: white;
                                            border-radius: 50%;
                                            padding: 2px 6px;
                                            cursor: pointer;
                                            font-weight: bold;
                                            font-size: 14px;
                                        }
                                    </style>

                                    <div id="gambar-lama-container">
                                        <?php
                                        $gambarArray = explode(',', $a['gambar']);
                                        foreach ($gambarArray as $gambar) {
                                            if (!empty($gambar)) {
                                                echo '<div class="image-wrapper">
                        <span class="remove-image" onclick="this.parentElement.remove();">×</span>
                        <img src="../../uploads/' . htmlspecialchars($gambar) . '" width="150" height="150" alt="Gambar Produk">
                        <input type="hidden" name="gambar_lama[]" value="' . htmlspecialchars($gambar) . '">
                      </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <a href="dataproduk.php" class="btn btn-primary">Kembali</a>
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