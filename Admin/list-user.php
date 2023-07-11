<?php
require 'function.php';

include_once 'koneksi.php';
if ($_SESSION['role'] !="admin"){
    echo"<script>alert(' Akses Ditolak')</script>";
    echo"<script>location='login1.php'</script>";

    
}

$get1 = mysqli_query($conn, "select * from login");
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
        <title>Barang masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">
            <img src="images/ernov.jpg" alt="Ernov">
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
                            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="#">Activity Log</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Keluar</a>
                            </div>
                    
                            
                               
                            
                           
                            </a>
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Daftar Pengguna</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pengguna</li>
                        </ol>
                       
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                 
                                <br>
                                <br>
                                <ul class="list-group">
                                <li class="list-group-item"><h5>Total user: <?=$count1;?></h5></li>
                               
                                </ul>
                                
                                

                              
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
                                                <th>No</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Passsword</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                                

            
                                                
                                            </tr>
                                        </thead>
                                      
                                        <tbody>
                                           
                                        <?php
                                            $getKategori = mysqli_query($conn, "SELECT * FROM login");

                                            $no = 1;
                                            while ($datauser = mysqli_fetch_array($getKategori)) {
                                                $iduser = $datauser['id_user'];
                                                $email = $datauser['email'];
                                                $username = $datauser['username'];
                                                $password = $datauser['password'];
                                                $role = $datauser['role'];
                                            ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $email; ?></td>
                                                <td><?= $username; ?></td>
                                                <td><?= $password; ?></td>
                                                <td><?= $role; ?></td>
                                                <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$iduser;?>">
                                                    Ubah
                                                </button> 
                                                
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$iduser;?>">
                                                    Hapus
                                                 </button> 
                                                </td>
                                                
                                            </tr>
                                               <!-- edit modal -->
                                               <div class="modal fade" id="edit<?=$iduser;?>">
                                               
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit User</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    
                                                    
                                                    
                                                    <br>
                                                    <input type="text" name="email"  value="<?=$email;?>" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="username"  value="<?=$username;?>" class="form-control" required>
                                                    <br>
                                                    
                                                   
                                                    <input type="hidden" name="id_user" value="<?=$iduser;?>">
                                                    
                                                    <button type="submit" class="btn btn-primary" name="edituser">Submit</button>
                                                    <br>
                                                    </div>
                                                    </form>
                                                    <!-- Modal footer -->
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                            

                                                     <!-- delete modal -->
                                            <div class="modal fade" id="delete<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus user?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus <?=$username;?>
                                                    
                                                    
                                                    <input type="hidden" name="email" value="<?=$email;?>">
                                                    <input type="hidden" name="username" value="<?=$username;?>">
                                                    <input type="hidden" name="id_user" value="<?=$iduser;?>">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger" name="hapususer">Submit</button>
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
  
</html>
