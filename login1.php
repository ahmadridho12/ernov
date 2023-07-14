<?php
include_once "koneksi.php";
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == "member"){
        header("location: index.php");
    }elseif ($_SESSION['role'] == "admin"){
        header("location: indexadmin.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="image/e.jpg">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/style.css">
    <style>
    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0069d9;
    }
</style>

</head>

<body class="bg-gradient-primary">

    <div class="container" style="margin-top :110px">
        <div class="card o-hidden border-0 shadow-lg my-5"  >
            <div class="card-body p-0"  >
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center mx-auto">
                    <img src="image/ernov.jpg" alt="Ernov" style="max-width: 100%; height: auto; margin-left : 50px">
                    </div>
                    <div  class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><strong>Masuk</strong></h1>
                            </div>
                            <form action="koneksi.php?proses_login" method="POST" class="user">
                                
                                <div class="form-group">
                                    <input type="username" class="form-control form-control-user" id="inputusername" name="username"
                                        placeholder="Masukan Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="inputpassword" name="password"
                                        placeholder="Masukan Password" required>
                                        <br>
                                        <p><a href="beranda.php">Lupa Password?</a></p>
                        <br>
                        <br>
                        <div class="row">
                                <div class="col text-center">
                                <button class="btn-primary">Masuk</button>
                                    
                                    
                        </div>
                               
                               
                            </form>
                            <hr>
                            
                            <div class="text-center">
                                <a class="bold" href="register.php">Belum Punya Akun? Daftar!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>