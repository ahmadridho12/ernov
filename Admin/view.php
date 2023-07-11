<?php
require 'function.php';

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
    
     $img = '<img class="card-img-top" src="images/'.$gambar.'" alt="Card image" style="width:100%">';
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Menampilkan barang</title>
</head>
<body>
    <div class="container mt-4">
    
 
  <h3>Detail Barang:</h3>
  <div class="card mt-4" style="width:400px">
    <?=$img;?>
    <div class="card-body">
      <h4 class="card-title"><?=$nama_barang;?></h4>
      <h5 class="card-text"><?=$harga;?></h5>
      <h5 class="card-text"><?=$deskripsi;?></h5>
      <h5 class="card-text"><?=$stock;?></h5>
      <a href="#" class="btn btn-primary">See Profile</a>
    </div>
  </div>
  <br>
</div>
</body>
</html>