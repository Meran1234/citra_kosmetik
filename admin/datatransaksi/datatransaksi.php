<?php
include_once('../../koneksi.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM tbl_transaksi WHERE nama_pelanggan LIKE '%$search%' ORDER BY tanggal_transaksi DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Transaksi</h2>

        <form method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Cari Nama Pelanggan" class="form-control" style="max-width: 300px; display: inline-block;">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <div class="table-responsive">
            <table id="dataTransaksiTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_transaksi'] ?></td>
                            <td><?= $row['nama_pelanggan'] ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td><?= $row['metode_pembayaran'] ?></td>
                            <td>
                                <?php
                                    $status = $row['status_pembayaran'];
                                    $badge = $status === 'lunas' ? 'success' : ($status === 'gagal' ? 'danger' : 'warning');
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= ucfirst($status) ?></span>
                            </td>
                            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_transaksi'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTransaksiTable').DataTable();
        });
    </script>
</body>

</html>