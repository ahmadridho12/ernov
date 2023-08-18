<?php
require 'function.php';

include_once 'koneksi.php';
if ($_SESSION['role'] !="admin"){
    echo"<script>alert(' Akses Ditolak')</script>";
    echo"<script>location='login1.php'</script>";

    
}

//// get data
//ambil data total
$get1 = mysqli_query($conn, "select * from stok");
$count1 = mysqli_num_rows($get1);

$get2 = mysqli_query($conn, "select * from kategori");
$count2 = mysqli_num_rows($get2);

//////// stok
$queryTotalStock = mysqli_query($conn, "SELECT SUM(stock) AS total_stock FROM stok");
$rowTotalStock = mysqli_fetch_assoc($queryTotalStock);
$totalStock = $rowTotalStock['total_stock'];

///////// quantity barang masuk
$queryTotalQtyMasuk = mysqli_query($conn, "SELECT SUM(qty) AS total_qty_masuk FROM masuk");
$rowTotalQtyMasuk = mysqli_fetch_assoc($queryTotalQtyMasuk);
$totalQtyMasuk = $rowTotalQtyMasuk['total_qty_masuk'];

/////// quantity barang keluar
$queryTotalQtyKeluar = mysqli_query($conn, "SELECT SUM(qty) AS total_qty_keluar FROM keluar");
$rowTotalQtyKeluar = mysqli_fetch_assoc($queryTotalQtyKeluar);
$totalQtyKeluar = $rowTotalQtyKeluar['total_qty_keluar'];


$queryMasuk = mysqli_query($conn, "SELECT tanggal, COUNT(*) as total_masuk FROM masuk GROUP BY tanggal ORDER BY tanggal ASC");
$barangMasuk = array();
$jumlahMasuk = array();
while ($row = mysqli_fetch_assoc($queryMasuk)) {
    $barangMasuk[] = $row['tanggal'];
    $jumlahMasuk[] = $row['total_masuk'];
}

// Kode PHP untuk mengambil data barang keluar per hari dari tabel keluar
$queryKeluar = mysqli_query($conn, "SELECT tanggal, COUNT(*) as total_keluar FROM keluar GROUP BY tanggal ORDER BY tanggal ASC");
$barangKeluar = array();
$jumlahKeluar = array();
while ($row = mysqli_fetch_assoc($queryKeluar)) {
    $barangKeluar[] = $row['tanggal'];
    $jumlahKeluar[] = $row['total_keluar'];
}
// Periksa apakah sesi sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi role pengguna dari sesi
$loggedInUserUsername = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/png" href="images/e.jpg">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
    .navbar-brand img {
      width: 150px;
      position: absolute;
      top: 0;
      left: 0;
    
    }
    .card-body{
        color : black;
    }
    .zoomable {
                width: 100px;
                height: 100px;
    }
    .zoomable:hover {
                transform: scale(1.5);
                transition: 0.3s ease;
    }
    .text-right {
        position: relative;
        left: 1100px;
    }
    .text-right p {
        margin-bottom: 0;
    }
    .hg{
        font-size:12px;
    }
  </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
        <img src="images/ernov.png" alt="Ernov">
        </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <div class="text-right">
            <p style="color: white;">
                <strong style="color: white;"><?php echo $loggedInUserUsername; ?></strong>
                <span class="hg" style="color: white;">admin</span>
            </p>
            </div>
            </li>
            </ul>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php">Keluar</a>
                </div>
            </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                          
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Beranda
                            </a>
                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cube"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="kategori.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Kategori Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="list-user.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Daftar Pengguna
                            </a>
                            
                            
                           
                        </a>
                       
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">
                 Beranda
                </h1>
                <br>
                <div class="row justify-content-right">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body text-center">
                            <strong>Jumlah Produk</strong>
                            <br>
                            <strong style="font-size: 24px;"><?=$count1;?> Pcs</strong>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="stock.php">Lihat Semua</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body text-center">
                            <strong>Total Barang Tersedia</strong>
                            <br>
                            <strong style="font-size: 24px;"><?=$totalStock;?> Pcs</strong>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="stock.php">Lihat Semua</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary text-white mb-4"> <!-- Modified background color -->
                        <div class="card-body text-center">
                            <strong>Jumlah Kategori</strong>
                            <br>
                            <strong style="font-size: 24px;"><?=$count2;?> Pcs</strong>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="kategori.php">Lihat Semua</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body text-center">
                            <strong>Total Barang Masuk</strong>
                            <br>
                            <strong style="font-size: 24px;"><?=$totalQtyMasuk;?> Pcs</strong>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="masuk.php">Lihat Semua</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body text-center">
                            <strong>Total Barang Keluar</strong>
                            <br>
                            <strong style="font-size: 24px;"><?=$totalQtyKeluar;?> Pcs</strong>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="keluar.php">Lihat Semua</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

                    </div>

                            <div class="card-body">

                            <?php
                            $ambildatastockHabis = mysqli_query($conn, "SELECT * FROM stok WHERE stock = 0");
                            $ambildatastockMenipis = mysqli_query($conn, "SELECT * FROM stok WHERE stock > 0 AND stock <= 5");

                            while ($fetchHabis = mysqli_fetch_array($ambildatastockHabis)) {
                                $barangHabis = $fetchHabis['nama_barang'];

                                // Menampilkan peringatan untuk barang yang stok habis
                                ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stok <?=$barangHabis;?> telah habis.
                                </div>
                                <?php
                            }

                            while ($fetchMenipis = mysqli_fetch_array($ambildatastockMenipis)) {
                                $barangMenipis = $fetchMenipis['nama_barang'];
                                $stockMenipis = $fetchMenipis['stock'];

                                // Menampilkan peringatan untuk barang yang stok menipis
                                ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stok <?=$barangMenipis;?> tersisa <?=$stockMenipis;?>. Segera tambahkan stok.
                                </div>
                                <?php
                            }
                            ?>
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Data Barang
                            </div>
                    <?php
                        // Ambil data stok dari tabel stok
                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stok ORDER BY stock DESC");

                        // Periksa apakah query berhasil dieksekusi
                        if ($ambilsemuadatastock) {
                            // Inisialisasi array untuk menyimpan data grafik
                            $barang = array();
                            $stock = array();

                            // Loop melalui hasil query
                            while ($row = mysqli_fetch_assoc($ambilsemuadatastock)) {
                                $barang[] = $row['nama_barang'];
                                $stock[] = $row['stock'];
                            }

                            // Ubah data menjadi format JSON
                            $barang = json_encode($barang);
                            $stock = json_encode($stock);
                        } else {
                            // Tampilkan pesan kesalahan jika query gagal dieksekusi
                            echo "Error: " . mysqli_error($conn);
                        }
                        ?>

                        <!-- Tambahkan elemen HTML untuk menampilkan grafik -->

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Grafik Stok Barang
                                </div>
                                <div class="card-body">
                                    <canvas id="chartStock" width="500" height="100"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            var ctx = document.getElementById('chartStock').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo $barang; ?>,
                                    datasets: [{
                                        label: 'Stock Barang',
                                        data: <?php echo $stock; ?>,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    <br><br>
                                    
                    <?php

$periode = "bulan"; // Default periode

if(isset($_GET['periode'])) {
    $periode = $_GET['periode'];
}

// Ambil data barang masuk per bulan dari tabel masuk
$queryBarangMasuk = "";
if($periode == "bulan") {
    $queryBarangMasuk = mysqli_query($conn, "SELECT YEAR(tanggal) AS tahun, MONTH(tanggal) AS bulan, SUM(qty) AS total_masuk FROM masuk GROUP BY tahun, bulan ORDER BY tahun, bulan ASC");
} else {
    $queryBarangMasuk = mysqli_query($conn, "SELECT tanggal, SUM(qty) AS total_masuk FROM masuk GROUP BY tanggal ORDER BY tanggal ASC");
}

$barangMasuk = array();
$jumlahMasuk = array();
while ($row = mysqli_fetch_assoc($queryBarangMasuk)) {
    if($periode == "bulan") {
        $barangMasuk[] = date("M Y", strtotime($row['tahun'] . "-" . $row['bulan']));
    } else {
        $barangMasuk[] = $row['tanggal'];
    }
    $jumlahMasuk[] = $row['total_masuk'];
}

// Ambil data barang keluar per bulan dari tabel keluar
$queryBarangKeluar = "";
if($periode == "bulan") {
    $queryBarangKeluar = mysqli_query($conn, "SELECT YEAR(tanggal) AS tahun, MONTH(tanggal) AS bulan, SUM(qty) AS total_keluar FROM keluar GROUP BY tahun, bulan ORDER BY tahun, bulan ASC");
} else {
    $queryBarangKeluar = mysqli_query($conn, "SELECT tanggal, SUM(qty) AS total_keluar FROM keluar GROUP BY tanggal ORDER BY tanggal ASC");
}

$barangKeluar = array();
$jumlahKeluar = array();
while ($row = mysqli_fetch_assoc($queryBarangKeluar)) {
    if($periode == "bulan") {
        $barangKeluar[] = date("M Y", strtotime($row['tahun'] . "-" . $row['bulan']));
    } else {
        $barangKeluar[] = $row['tanggal'];
    }
    $jumlahKeluar[] = $row['total_keluar'];
}
?>
<form method="get">
        <select name="periode" onchange="this.form.submit()">
            <option value="bulan" <?php if($periode == "bulan") echo "selected"; ?>>Per Bulan</option>
            <option value="hari" <?php if($periode == "hari") echo "selected"; ?>>Per Hari</option>
        </select>
    </form>

    <canvas id="chartBarang" width="400" height="100"></canvas>

    <script>
    var ctx = document.getElementById('chartBarang').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(($periode == "bulan") ? $barangMasuk : $barangKeluar); ?>,
            datasets: [{
                    label: 'Barang Masuk',
                    data: <?php echo json_encode($jumlahMasuk); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Barang Keluar',
                    data: <?php echo json_encode($jumlahKeluar); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
                    





                         

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
