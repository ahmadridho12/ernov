<?php
require 'function_staff.php';


//// dapetin id barang yang dipassing hal sebelumnya
$id_barang = $_GET['id']; /// get id barang
//// get informasi barang berdasarkan database
$get = mysqli_query($conn, "select * from stok where id_barang='$id_barang'");
$fetch = mysqli_fetch_assoc($get);
//////set variable
$nama_barang = $fetch['nama_barang'];
$harga = $fetch['harga'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];


 // cek ada gambar or no
 $gambar = $fetch['image'];
 if($gambar ==null) {
     // tidak ada gambar
     $img = 'No Photo';
 } else {
     // jika ada gambar
     $img = '<img src="../Admin/images/'.$gambar.'" class="zoomable">';
 }


 ///// generete Qr


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Barang Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/png" href="../image/e.jpg">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable {
                width: 200px;
            }
            .zoomable:hover {
                transform: scale(1.5);
                transition: 0.3s ease;
            }
            .penjelasan{
                font-size: 20px;
                padding-top:25px;
                
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">ERNOV</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
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
                                <div class="sb-nav-link-icon"></div>
                                Stok Barang
                            </a>
                            <a class="nav-link" href="staff_masuk.php">
                                <div class="sb-nav-link-icon"></i></div>
                                Barang masuk
                            </a>
                            <a class="nav-link" href="staff_keluar.php">
                                <div class="sb-nav-link-icon"></i></div>
                                Barang Keluar
                            </a>
                            
                            <a class="nav-link" href="list-user.php">
                                <div class="sb-nav-link-icon"></i></div>
                                list User
                            </a>
                            
                            
                            <!-- Navbar-->
                            
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">
                        Detail Barang
                    </h1>
                    <br>
                    <h2><?= $nama_barang; ?>
                    <br>
                    <br>
                    <?=$img;?>
                    
                    <div class="penjelasan">
                    <div class="row">
                        <div class="col-md-3">Harga</div>
                        <div class="col-md-9">: Rp<?php echo number_format($harga, 0,',','.'); ?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">Jenis</div>
                        <div class="col-md-9">: <?=$deskripsi;?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">Stock</div>
                        <div class="col-md-9">: <?=$stock;?></div>
                    </div>
                    </div>
                    
                        <br>
                        <br>
                        <h3>Barang Masuk</h3>
                   
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                
                            </div>
                            
                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">

                                
                              
                                <?php
                                     


                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="datamasuk" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Tujuan</th>
                                                <th>Jumlah</th>
                                                
                                            </tr>
                                        </thead>
                                      
                                        <tbody>


                                        <?php
                                     $ambildatamasuk = mysqli_query($conn, "select * from masuk  where  id_barang='$id_barang'");
                                     $i = 1;   
                                     while($fetch=mysqli_fetch_array($ambildatamasuk)){
                                        
                                         $tanggal = $fetch['tanggal'];
                                         $keterangan = $fetch['keterangan'];
                                         $qty = $fetch['qty'];
                                    ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$qty;?></td>
                                                
                                                
                                            </tr>

                                              
                                            

                                            
                                        <?php

                                    };
                                    
                                        ?>
                                                
                                            

                                           
                                                   
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                           
                                            

                                                   
                                                
                                                </div>
                                            </div>
                                            
                                        <?php

                                    
                                    
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                      
                        
                    </div>
                    <h3>Barang Keluar</h3>
                        <br>    
                    <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                
                            </div>
                            
                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">

                                
                              
                                <?php
                                     


                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="datakeluar" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Tujuan</th>
                                                <th>Jumlah</th>
                                                
                                            </tr>
                                        </thead>
                                      
                                        <tbody>


                                        <?php
                                     $ambildatakeluar = mysqli_query($conn, "select * from keluar  where  id_barang='$id_barang'");
                                     $i = 1;   
                                     while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                        
                                         $tanggal = $fetch['tanggal'];
                                         $penerima = $fetch['penerima'];
                                         $qty = $fetch['qty'];
                                    ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$qty;?></td>
                                                
                                                
                                            </tr>

                                              
                                            

                                            
                                        <?php

                                    };
                                    
                                        ?>
                                                
                                            

                                           
                                                   
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                           
                                            

                                                   
                                                
                                                </div>
                                            </div>
                                            
                                        <?php

                                    
                                    
                                        ?>
                                        </tbody>
                                    </table>
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
          <h4 class="modal-title">Tambah Barang</h4>
          <button type= "button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control">
        <br>
        <input type="text" name="harga" placeholder="Harga" class="form-control">
        <br>
        <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control">
        <br>
        <input type="number" name="stock" placeholder="Stock" class="form-control">
        <br>
        <input type="file" name="file"  class="form-control">
        <br>
        <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>

        </div>
        </form>
        
        <!-- Modal footer -->
       
        
      </div>
    </div>
  </div>                               
  
</html>
