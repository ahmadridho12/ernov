<?php

require 'function_pimpinan.php';




?>
<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <style>
            .zoomable {
                width: 100px;
            }
            .zoomable:hover {
                transform: scale(2.5);
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

<body>
<div class="container">
			<h2>Cetak Laporan Barang </h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
					<!-- Masukkan table nya disini, dimulai dari tag TABLE -->
                    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                    <thead>
                           
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Kategori</th>
                                                <th>Harga </th>
                                                <th>Jenis</th>
                                                <th>Stok</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                      
                                        <tbody>


                                    <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT s.*, k.nama_kategori FROM stok s JOIN kategori k ON s.id_kategori = k.id_kategori");
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
                                                $img = '<img src="../Admin/images/' . $gambar . '" class="zoomable">';
                                            }
                                        
                                            // cek ada gambar or no
                                          
                                            
                                                
                                            
                                    ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$img;?></td>
                                                
                                                <td><?=$nama_barang;?></td>
                                                
                                                    
                                            </td>
                                                <td><?=$nama_kategori;?></td>
                                                <td>Rp<?php echo number_format($harga, 0,',','.'); ?></td>
                                                <td><?php echo$deskripsi;?></td>
                                                <td><?php echo$stock;?></td>
                                                
                                                
                                                
                                               
                                                
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