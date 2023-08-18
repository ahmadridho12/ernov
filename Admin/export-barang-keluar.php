<?php

require 'function.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi role pengguna dari sesi
$loggedInUserUsername = isset($_SESSION['username']) ? $_SESSION['username'] : '';

?>
<html>
<head>
  <title>Cetak Barang Keluar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="icon" type="image/png" href="images/e.jpg">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
            left: 1320px;
            }
            .text-right p {
                margin-bottom: 0;
            }
            .hg{
                font-size:12px;
            }
            .form-group {
            width: 200px;
            display: inline-block;
            margin-left: 100px; /* Geser tombol ke kanan */
            }

            .btn-filter {
                margin-left: 100px; /* Geser tombol ke kanan */
            }
            .navbar {
            height: 60px; /* Menambahkan tinggi navbar */
            }
            .dt-buttons button:hover {
            background-color: #0056b3;
            color: green; /* Warna latar belakang tombol saat dihover */
            }
            .dt-buttons button {
                background-color: #007bff; /* Warna latar belakang tombol */
                color: white; /* Warna teks tombol */
                border: none; /* Hilangkan border tombol */
                border-radius: 4px; /* Rounding border tombol */
                padding: 6px 12px; /* Ruang dalam tombol */
                margin-right: 5px; /* Ruang antara tombol */
                cursor: pointer; /* Ubah kursor saat diarahkan ke tombol */
            }
  </style>
</head>

<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">
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
                        </div>
                    </div>
                   
                </nav>
            </div>
			<h2>Cetak Laporan Barang Keluar</h2>
			
				<div class="data-tables datatable-dark">
					
					<!-- Masukkan table nya disini, dimulai dari tag TABLE -->
                    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                    <thead>
                    <div class="row mt-4">
                    <div class="col">
                        <form method="POST" class="form-inline">
                            <div class="form-group mx-sm-5">
                                <label for="tgl_mulai" class="mr-2">Tanggal Mulai:</label>
                                <input type="date" name="tgl_mulai" class="form-control">
                            </div>
                            <div class="form-group mx-sm-5">
                                <label for="tgl_selesai" class="mr-2">Tanggal Selesai:</label>
                                <input type="date" name="tgl_selesai" class="form-control">
                            </div>
                            <button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>
                        </form>
                    </div>
                </div>
                <br>
                    
                    <tr>
                                                <th>Tanggal</th>
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

                                                $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stok s where s.id_barang = k.id_barang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY)  ");
                                            } else {
                                                $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stok s WHERE s.id_barang = k.id_barang");
                                            }
                                            
                                        } else {
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stok s WHERE s.id_barang = k.id_barang");
                                        }
                                       
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                            $idk = $data['id_keluar'];
                                            $idb = $data['id_barang'];
                                            $tanggal = $data['tanggal'];
                                            $nama_barang = $data['nama_barang'];
                                            $harga = $data['harga'];
                                            $qty = $data['qty'];
                                            $penerima = $data['penerima'];

                                             // cek ada gambar or no
                                             $gambar = $data['image'];
                                             if($gambar ==null) {
                                                 // tidak ada gambar
                                                 $img = 'No Photo';
                                             } else {
                                                 // jika ada gambar
                                                 $img = '<img src="images/'.$gambar.'" class="zoomable">';
                                             }
                                        
                                        ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$nama_barang;?></td>
                                                <td>Rp<?php echo number_format($harga, 0,',','.'); ?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$penerima;?></td>
                                                
                                                
                                            </tr>

                                                
                                            
                                        <?php

                                    };
                                    
                                        ?>
                                        </tbody>
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>