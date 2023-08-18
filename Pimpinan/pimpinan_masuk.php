<?php
require 'function_pimpinan.php';

include_once '../koneksi.php';
if ($_SESSION['role'] !="pimpinan"){
    echo"<script>alert(' Akses Ditolak')</script>";
    echo"<script>location='../login1.php'</script>";

    
}

$get1 = mysqli_query($conn, "select * from masuk");
$count1 = mysqli_num_rows($get1);

///////// quantity barang masuk
$queryTotalQtyMasuk = mysqli_query($conn, "SELECT SUM(qty) AS total_qty_masuk FROM masuk");
$rowTotalQtyMasuk = mysqli_fetch_assoc($queryTotalQtyMasuk);
$totalQtyMasuk = $rowTotalQtyMasuk['total_qty_masuk'];

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
        <title>Barang masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/png" href="../image/e.jpg">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable {
                width: 100px;
            }
            .zoomable:hover {
                transform: scale(2.5);
                transition: 0.3s ease;
            }
            .navbar-brand img {
                width: 150px;
                position: absolute;
                top: 0;
                left: 0;
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
        <a class="navbar-brand" href="pimpinan_index.php">
            <img src="../image/ernov.png" alt="Ernov">
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <div class="text-right">
            <p style="color: white;">
                <strong style="color: white;"><?php echo $loggedInUserUsername; ?></strong>
                <span class="hg" style="color: white;">pimpinan</span>
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
                            
                        <a class="nav-link" href="pimpinan_index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Beranda
                            </a>
                            
                            <a class="nav-link" href="pimpinan_stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="pimpinan_masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="pimpinan_keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Barang Keluar
                            </a>
                            <!-- Navbar-->
                            
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Barang Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                             
                                <a href="export-barang-masuk_pimpinan.php" class="btn btn-info float-right">
                                <i class="fas fa-print"></i> 
                                </a> 
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-warning text-white mb-4">
                                        <div class="card-body text-center">
                                            <strong>Total Barang Masuk</strong>
                                            <br>
                                            <strong style="font-size: 24px;"><?=$totalQtyMasuk;?> Pcs</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="row mt-4">
                                <div class="col">

                                    <form method="POST" class="form-inline">
                                        <input type="date" name="tgl_mulai" class="form-control ">
                                        <input type="date" name="tgl_selesai" class="form-control ml-3">
                                        <button type="submit" name="filter_tgl" class="btn btn-info ml-3">Filter</button>
                                    </form>
                                </div>
                                 </div>
                            </div>
                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>tanggal</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Harga </th>
                                                <th>Jumlah</th>
                                                <th>Tujuan</th>
                                                
            
                                                
                                            </tr>
                                        </thead>
                                      
                                        <tbody>
                                           
                                        <?php
                                            if(isset($_POST['filter_tgl'])) {
                                                $mulai = $_POST['tgl_mulai'];
                                                $selesai = $_POST['tgl_selesai'];

                                                if($mulai!=null || $selesai!=null){

                                                    $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stok s where s.id_barang = m.id_barang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY)  ");
                                                } else {
                                                    $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stok s WHERE s.id_barang = m.id_barang");
                                                }
                                                
                                            } else {
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stok s WHERE s.id_barang = m.id_barang");
                                            }

                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                                $idb = $data['id_barang'];
                                                $idm = $data['id_masuk'];
                                                $tanggal = $data['tanggal'];
                                                $nama_barang = $data['nama_barang'];
                                                $harga = $data['harga'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];

                                                // cek ada gambar atau tidak
                                                $gambar = $data['image'];
                                                if ($gambar == null) {
                                                    // tidak ada gambar
                                                    $img = 'No Photo';
                                                } else {
                                                    // jika ada gambar
                                                    $img = '<img src="../Admin/images/'.$gambar.'" class="zoomable">';
                                                }
                                            ?>

                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$img;?></td>
                                                <td><?=$nama_barang;?></td>
                                                <td>Rp<?php echo number_format($harga, 0,',','.'); ?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$keterangan;?></td>
                                                
                                                
                                            </tr>
                                               <!-- edit modal -->
                                               <div class="modal fade" id="edit<?=$idm;?>">
                                               
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    
                                                    
                                                    
                                                    <br>
                                                    <input type="text" name="keterangan"  value="<?=$keterangan;?>" class="form-control" required>
                                                    <br>
                                                    <input type="number" name="qty"  value="<?=$qty;?>" class="form-control" required>
                                                    <br>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <input type="hidden" name="idm" value="<?=$idm;?>">
                                                    <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                    <br>
                                                    </div>
                                                    </form>
                                                    <!-- Modal footer -->
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                            

                                                     <!-- delete modal -->
                                            <div class="modal fade" id="delete<?=$idm;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus barang?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus <?=$nama_barang;?>?
                                                    
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <input type="hidden" name="kty" value="<?=$qty;?>">
                                                    <input type="hidden" name="idm" value="<?=$idm;?>">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Submit</button>
                                                    <br>
                                                    </div>
                                                    </form>
                                                    <!-- Modal footer -->
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                        <?php

                                         };
                                        ?>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
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
     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">

        <select name="barangnya" class="form-control">
            <?php 
                $ambilsemuadatanya = mysqli_query($conn,"SELECT * FROM stok");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray['nama_barang'];
                    $idbarangnya = $fetcharray['id_barang'];
                    
            ?>
            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
            <?php        
                }
            ?>
        </select>
         <br>
      
        <br>
        
        <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
        <br>
        <input type="text" name="penerima" placeholder="penerima" class="form-control" required>
        <br>
        
        <br>
        <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
        <br>
        </div>
        </form>
        <!-- Modal footer -->
       
        
      </div>
    </div>
  </div>
</html>
