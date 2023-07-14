<?php

require 'function.php';

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
  <link rel="icon" type="image/png" href="images/e.jpg">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
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