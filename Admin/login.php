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

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- di bawah ini buat akses css nya -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    

    <title>Login Page</title>
</head>

<body>
    
    <!-- awal Jumbotron -->
   
    </div>
    <!-- akhir Jumbotron -->
    <div class="container-fluid">
        <div class="row">
            
            <!-- col dibawah ini pake aturan yang ada 12 kolom itu, biar card nya ada di tengah -->
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
            </div>    
    <div class="col-5 " id="foto">
            <img src="img/padang.jpg" class="rounded float-end" width="250%" height="700px" >
        </div>
                <!-- Pake card (search di bootstrap), jangan lupa bikin tag form-->
                <form action="koneksi.php?proses_login" method="POST">
                    <br>
                    <br>
                    <br>
                    <div class="card shadow rounded-lg">
                    
                        <div class="w3-card w3-teal text-center">
                            <h4>LOGIN</h4>
                        </div>
                        <div class="card-body text-secondary">
                            <!-- biar rapi pake row col lagii heheh, aga ribet memang -->
                            <div class="row">
                                <div class="col-sm-3">
                                    Username
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <input type="username" class="form-control" id="inputusername" name="username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                   Pass
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="inputpassword" name="password">
                                    </div>
                                </div>
                            </div>
                
                            
                            <div class="row">
                                <div class="col text-center">
                                <p><button class="w3-button w3-teal w3-round-large">LOGIN</button></p>
                                    
                                    <p class="mt-3">Belum PUNYA AKUN?<a href="daftar.php" class="card_link">Daftar Disini</a></p>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Akhir card -->
                </form>
                
            </div>
        </div>
        
        <!-- Optional JavaScript; choose one of the two! -->
        
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
 


</body>

</html>