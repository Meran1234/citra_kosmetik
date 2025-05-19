<?php
include_once('../../koneksi.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citra Kosmetik</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/admin.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .btn-success {
            margin-top: 20px;
            font-size: 12px;
            width: 20x;
            height: 35px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            min-height: 100vh;
            min-height: -webkit-fill-available;
            margin: 0;
            overflow-y: auto;
            overflow-x: hidden;
        }

        html {
            height: -webkit-fill-available;
            overflow-x: hidden;
        }

        .table-responsive {
            overflow-x: unset !important;
        }

        #dataLEmburTable th {
            font-size: 12px;
            text-align: center;
            vertical-align: middle;
        }

        #dataLEmburTable td {
            font-size: 12px;
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_wrapper table.dataTable th {
            font-size: 12px !important;
            text-align: center !important;
            vertical-align: middle !important;
        }

        .dataTables_wrapper table.dataTable td {
            font-size: 12px !important;
            text-align: center !important;
            vertical-align: middle !important;
        }

        @media only screen and (max-width: 768px) {
            .form-control {
                margin-left: 5px;
                width: 80% !important;
                font-size: 10px;
            }

            form button {
                width: 70px;
                margin-top: 10px;
                padding: 15px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="home" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
        </symbol>
        <symbol id="data-pesanan" viewBox="0 0 16 16">
            <path d="M3 1h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H3zm2 4h6v1H5V4zm0 3h6v1H5V7zm0 3h6v1H5v-1z" />
        </symbol>
        <symbol id="data-produk" viewBox="0 0 16 16">
            <path d="M2 2a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2zm10 0H4v2h8V2z" />
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol id="data-penjualan" viewBox="0 0 16 16">
            <path d="M0 0h1v15h15v1H0V0zm14 12l-3-3-2 2-3-3-4 4 0.707 0.707L6 9.414l3 3 2-2 2.793 2.793L14 12z" />
        </symbol>
        <symbol id="laporan-penjualan" viewBox="0 0 16 16">
            <path d="M3 1h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM3 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H3zm3 1h5v4H6V1z" />
        </symbol>
        <symbol id="logout" viewBox="0 0 24 24">
            <path d="M16.59 7.41L15.17 8.83L18.34 12L15.17 15.17L16.59 16.59L21.17 12L16.59 7.41Z"></path>
            <path d="M19 3H10C8.9 3 8 3.9 8 5V9H10V5H19V19H10V15H8V19C8 20.1 8.9 21 10 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3Z"></path>
        </symbol>
    </svg>

    <header>
        <div class="container-1" style="display: flex; align-items: center; margin-left: 10px;">
            <button class="sidebar-toggler btn btn-outline-light" onclick="toggleSidebar()" style="border: none; padding: 0; background: transparent; width: auto; height: auto; margin-right: 10px;">
                <i class="bi bi-list" style="font-size: 30px; color: black;" id="openSidebar"></i>
            </button>
            <button class="site-title" onclick="window.location.href='../index.php';" style="margin: 0; border: none;  background: transparent;">
                <i class="bi bi-house"></i>
            </button>
        </div>
    </header>

    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white" id="sidebar" style="width: 280px;">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="../../assets/img/ck.png" alt="Logo" width="50" height="50" class="me-2">
            <span class="nama" style="margin-right: 50px; margin-bottom: 10px;">Citra Kosmetik</span>
            <button class="btn btn-outline-light" onclick="toggleSidebar()" style="border: none; padding: 0; background: transparent; width: auto; height: auto; margin-bottom: 30px; margin-left:10px">
                <i class="bi bi-x-circle" style="font-size: 20px; color: black;" id="closeSidebar"></i>
            </button>
        </a>
        <hr class="hr">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="../index.php" class="nav-link text-white" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#home" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="../dataproduk/dataproduk.php" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#data-produk" />
                    </svg>
                    Data Produk
                </a>
            </li>
            <li>
                <a href="../datapembeli/datapembeli.php" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#people-circle" />
                    </svg>
                    Data Pembeli
                </a>
            </li>
            <li>
                <a href="../datapesanan/datapesanan.php" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#data-pesanan" />
                    </svg>
                    Data Pesanan
                </a>
            </li>
            <li>
                <a href="../dataadmin/dataadmin.php" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#people-circle" />
                    </svg>
                    Data Admin
                </a>
            </li>
            <li>
                <a href="#" class="nav-link active">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#data-penjualan" />
                    </svg>
                    Data Penjualan
                </a>
            </li>
            <li>
                <a href="../datalaporan/datalaporan.php" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#laporan-penjualan" />
                    </svg>
                    Data Laporan Penjualan
                </a>
            </li>
        </ul>
        <hr style="color: black;">
        <div class="d-flex justify-content-end">
            <a href="../../index.php" class="d-flex align-items-center text-decoration-none" style="margin-right: 20px;">
                <span style="font-size: 1.25rem; margin-right: 10px; color: black;">Logout</span>
                <svg class="bi" width="20" height="20" style="color: black;">
                    <use xlink:href="#logout" />
                </svg>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between d-f" style="margin-top: 10px;">
            <form>
            </form>
            <form method="GET" action="" class="d-flex">
                <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari nama pembeli..."
                    style="width: 300px; height: 40px; margin-top: 20px; margin-right: 5px;">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>Data Penjualan</span>
                <a href="tambahpenjualan.php?aksi=tambah" class="btn btn-primary">+ Tambah Data</a>
            </div>
            <div class="scrollable-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="produkTable">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">TANGGAL TRANSAKSI</th>
                                    <th class="text-center">JUMLAH TERJUAL</th>
                                    <th class="text-center">MEREK</th>
                                    <th class="text-center">HARGA</th>
                                    <th class="text-center">TOTAL</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $search = isset($_GET['search']) ? $_GET['search'] : '';

                                if ($search) {
                                    $query = "SELECT * FROM tbl_penjualan WHERE merek LIKE '%$search%'";
                                } else {
                                    $query = "SELECT * FROM tbl_penjualan";
                                }

                                $data = mysqli_query($koneksi, $query);
                                $no = 1;
                                while ($a = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($a['tgl_transaksi']); ?></td>
                                        <td><?php echo htmlspecialchars($a['jumlah_terjual']); ?></td>
                                        <td><?php echo htmlspecialchars($a['merek']); ?></td>
                                        <td><?php echo htmlspecialchars(number_format($a['harga'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars(number_format($a['total'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <a href="editpenjualan.php?id_penjualan=<?php echo urlencode($a['id_penjualan']); ?>&aksi=ubah" style="display: inline-block; margin: 0 5px; font-size: 12px;">
                                                <i class="bi bi-pencil-square" style="margin-left: 5px;"></i>
                                            </a>
                                            <a href="prosespenjualan.php?id_penjualan=<?php echo urlencode($a['id_penjualan']); ?>&proses=proseshapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display: inline-block; margin: 0 5px; font-size: 12px;">
                                                <i class="bi bi-trash" width="9" height="9" style="color: red; margin-right: 5px;"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <script>
            function toggleSidebar() {
                var sidebar = document.getElementById("sidebar");
                if (sidebar.style.display === "none" || sidebar.style.display === "") {
                    sidebar.style.display = "block";
                } else {
                    sidebar.style.display = "none";
                }
            }
        </script>
        <script src="../../assets/js/sidebar.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#produkTable').DataTable({
                    "searching": false,
                    "lengthChange": false,
                    "language": {
                        "sEmptyTable": "Tidak ada data yang tersedia di tabel",
                        "sInfo": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                        "sInfoEmpty": "Menampilkan 0 hingga 0 dari 0 data",
                        "sInfoFiltered": "(disaring dari _MAX_ total data)",
                        "sLengthMenu": "Tampilkan _MENU_ data",
                        "sLoadingRecords": "Sedang memuat...",
                        "sProcessing": "Sedang diproses...",
                        "sSearch": "Cari:",
                        "sZeroRecords": "Tidak ada data yang cocok ditemukan",
                        "oPaginate": {
                            "sFirst": "Pertama",
                            "sPrevious": "Sebelumnya",
                            "sNext": "Selanjutnya",
                            "sLast": "Terakhir"
                        },
                    },
                });

                $('#dateSearch').on('change', function() {
                    var searchDate = this.value;
                    table.column(5).search(searchDate).draw();
                });

            });
        </script>
</body>

</html>