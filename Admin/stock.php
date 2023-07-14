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


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stok Barang</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="icon" type="image/png" href="images/e.jpg">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable {
                width: 100px;
                height: 100px;
            }
            .zoomable:hover {
                transform: scale(1.5);
                transition: 0.3s ease;
            }
            a{
                text-decoration: none;
                color:black;
            }
            .navbar-brand img {
                width: 150px;
                position: absolute;
                top: 0;
                left: 0;
            }
          
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">
        <img src="images/ernov.jpg" alt="Ernov">
        </a>
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
                            
                        <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Beranda
                            </a>
                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
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
      
                            <!-- Navbar-->
                           
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h1 class="mt-4">
                
                        Stok Barang


                        </h1>
                        
                      
                       
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang Baru
                                </button>
                                
                                
                                <a href="export.php" class="btn btn-info"> Cetak Laporan </a> 
                                <br>
                                <br>
                                <ul class="list-group">
                                <li class="list-group-item"><h5>Total Barang : <?=$count1;?></h5></li>
                               
                                </ul>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Kategori</th>
                                                <th>Harga </th>
                                                <th>Jenis</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                      
                                        <tbody>


                                    <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT s.*, k.nama_kategori FROM stok s JOIN kategori k ON s.id_kategori = k.id_kategori ORDER BY s.id_barang DESC");
                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                            $nama_barang = $data['nama_barang'];
                                            $harga = $data['harga'];
                                            $deskripsi = $data['deskripsi'];
                                            $stock = $data['stock'];
                                            $idb = $data['id_barang'];
                                            $nama_kategori = $data['nama_kategori'];
                                        
                                            // cek ada gambar or no
                                            $gambar = $data['image'];
                                            if ($gambar == null) {
                                                // tidak ada gambar
                                                $img = 'No Photo';
                                            } else {
                                                // jika ada gambar
                                                $img = '<img src="images/' . $gambar . '" class="zoomable">';
                                            }
                                        
                                            // cek ada gambar or no
                                          
                                            
                                                
                                            
                                    ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$img;?></td>
                                                <td>
                                                    <strong><a href="detail.php?id=<?=$idb;?>">
                                                        <?=$nama_barang;?></strong>
                                                    </a>
                                                </strong>
                                            </td>
                                                <td><?=$nama_kategori;?></td>
                                                <td>Rp<?php echo number_format($harga, 0,',','.'); ?></td>
                                                <td><?php echo$deskripsi;?></td>
                                                <td><?php echo$stock;?></td>
                                                <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                    Ubah
                                                </button> 
                                                
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                    Hapus
                                                 </button> 
                                                </td>
                                                
                                            </tr>

                                               <!-- edit modal -->
                                            <div class="modal fade" id="edit<?=$idb;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                    <input type="text" name="nama_barang" value="<?=$nama_barang;?>" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="harga"  value="<?=$harga;?>" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="deskripsi"  value="<?=$deskripsi;?>" class="form-control" required>
                                                    <br>
                                                    <input type="file" name="file"   class="form-control" >
                                                    <br>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                    <br>
                                                    </div>
                                                    </form>
                                                    <!-- Modal footer -->
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                           
                                            

                                                     <!-- delete modal -->
                                                     <div class="modal fade" id="delete<?=$idb;?>">
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
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger" name="hapusbarang">Submit</button>
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
       <!-- The Modal  tambah barang. -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type= "button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control" required>

        <br>
        <select name="kategorinya" class="form-control">
            <?php 
                $ambilsemuadatanya = mysqli_query($conn,"SELECT * FROM kategori");
                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namakategorinya = $fetcharray['nama_kategori'];
                    $idkategorinya = $fetcharray['id_kategori'];
                    
            ?>
            <option value="<?=$idkategorinya;?>"><?=$namakategorinya;?></option>
            <?php        
                }
            ?>
        </select>
        <br>
        <input type="number" name="harga" placeholder="Harga" class="form-control" required>
        <br>
        <input type="text" name="deskripsi" placeholder="Jenis" class="form-control" required>
        <br>
        <input type="number" name="stock" placeholder="Stock" class="form-control" required>
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
  


    


   <!-- The Modal  tambah Toko. -->
   
</html>
