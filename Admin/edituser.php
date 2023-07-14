<?php 
include_once 'koneksi.php';
if ($_SESSION['role'] !="member"){
    echo"<script>alert(' Akses Ditolak')</script>";
    echo"<script>location='login1.php'</script>";

    
}
$id = $_GET['id_user'];
$ambildata = mysqli_query($koneksi, "SELECT * FROM login where id_user = '$id'");
$data = mysqli_fetch_array($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/e.jpg">
</head>
<body>
    <div class="container">
        <h1>Form Input Pengguna</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control"  value=""<?php echo $data['email'] ?> id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
