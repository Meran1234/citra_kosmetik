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
            <h4>TAMBAH DATA PRODUK</h4>
            <div class="panel panel-container">
                <div class="bootstrap-table">
                    <form action="prosesproduk.php?proses=prosestambah" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Kategori :</label>
                            <select name="kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Skincare Dasar">Skincare Dasar</option>
                                <option value="Perawatan Wajah">Perawatan Wajah</option>
                                <option value="Makeup Wajah">Makeup Wajah</option>
                                <option value="Makeup Mata">Makeup Mata</option>
                                <option value="Haircare">Haircare</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenis :</label>
                            <input type="text" name="jenis" class="form-control" placeholder="Jenis" required>
                        </div>
                        <div class="form-group">
                            <label>Merek :</label>
                            <input type="text" name="merek" class="form-control" placeholder="Merek" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi :</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label>Harga :</label>
                            <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                        </div>
                        <div class="form-group">
                            <label>Stok :</label>
                            <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar:</label>
                            <input type="file" name="gambar[]" class="form-control" multiple required accept="image/*">
                            <div id="gambar-list" style="margin-top: 10px;"></div> 
                        </div>

                        <div class="modal-footer">
                            <a href="dataproduk.php" class="btn btn-primary">Kembali</a>
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gambarInput = document.querySelector('input[name="gambar[]"]');
            const gambarList = document.getElementById('gambar-list');

            // Simpan semua file yang dipilih secara manual
            let selectedFiles = [];

            // Fungsi untuk render ulang preview gambar
            function renderPreview() {
                gambarList.innerHTML = ''; // kosongkan tampilan sebelumnya
                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Buat container gambar + tombol hapus
                        const wrapper = document.createElement('div');
                        wrapper.style.display = 'inline-block';
                        wrapper.style.position = 'relative';
                        wrapper.style.marginRight = '10px';

                        // Elemen gambar
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.border = '1px solid #ccc';
                        img.style.borderRadius = '8px';

                        // Tombol hapus (tanda silang)
                        const deleteBtn = document.createElement('div');
                        deleteBtn.innerHTML = '&times;';
                        deleteBtn.style.position = 'absolute';
                        deleteBtn.style.top = '0';
                        deleteBtn.style.right = '5px';
                        deleteBtn.style.cursor = 'pointer';
                        deleteBtn.style.fontSize = '18px';
                        deleteBtn.style.color = 'red';
                        deleteBtn.style.fontWeight = 'bold';

                        deleteBtn.addEventListener('click', () => {
                            selectedFiles.splice(index, 1); // hapus dari array
                            renderPreview(); // render ulang
                            updateFileInput(); // update input file
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(deleteBtn);
                        gambarList.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Fungsi untuk update input file (trik DataTransfer)
            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                gambarInput.files = dataTransfer.files;
            }

            // Saat memilih file
            gambarInput.addEventListener('change', function(event) {
                const files = Array.from(event.target.files);
                selectedFiles = selectedFiles.concat(files); // gabung file baru dengan sebelumnya
                renderPreview(); // tampilkan ulang semua gambar
                updateFileInput(); // perbarui input file
            });
        });
    </script>



<?php
}
?>