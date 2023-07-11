<?php
require 'function_staff.php';

include_once '../koneksi.php';
if ($_SESSION['role'] !="staff"){
    echo"<script>alert(' Akses Ditolak')</script>";
    echo"<script>location='../login1.php'</script>";

    
}
//// get data
//ambil data total
$get1 = mysqli_query($conn, "select * from stok");
$get2 = mysqli_query($conn, "select * from masuk");
$get3 = mysqli_query($conn, "select * from keluar");


$count1 = mysqli_num_rows($get1);
$count2 = mysqli_num_rows($get2);
$count3 = mysqli_num_rows($get3);


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
  </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">
        <img src="../image/ernov.jpg" alt="Ernov">
        </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
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
                            
                          
                            <a class="nav-link" href="staff_index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Beranda
                            </a>
                            <a class="nav-link" href="staff_stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Stock Barang
                            </a>
                           
                            <a class="nav-link" href="staff_masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="staff_keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Barang Keluar
                            </a>
                            
                            
                            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="#">Activity Log</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Keluar</a>
                            </div>
                           
                        </a>
                       
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">
                 Beranda
                </h1>

                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Beranda</li>
                        </ol>
                        <div class="row justify-content-center">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body text-center">
                                    <strong>Jumlah Barang</strong>
                                    <br>
                                    <strong style="font-size: 24px;"><?=$count1;?></strong>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="stock.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body text-center">
                                    <strong>Jumlah Barang Masuk</strong>
                                    <br>
                                    <strong style="font-size: 24px;"><?=$count2;?></strong>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="masuk.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body text-center">
                                    <strong>Jumlah Barang Keluar</strong>
                                    <br>
                                    <strong style="font-size: 24px;"><?=$count3;?></strong>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="keluar.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">

                                <?php
                                    $ambildatastock = mysqli_query($conn, "select * from stok where stock < 1");

                                    while($fetch=mysqli_fetch_array($ambildatastock)){
                                        $barang = $fetch['nama_barang'];

                                        
                                        
                                        ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stock <?=$barang;?> telah habis.
                                </div>
                                <?php
                                     }


                                ?>
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
                                    
                    <div class="card mb-4">
                        <div class="card-header">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Bar Chart Example
                        </div>
                            <div class="card-body">
                                <canvas id="chartBarang" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>

                    <script>
                        var ctx = document.getElementById('chartBarang').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($barangMasuk); ?>,
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
