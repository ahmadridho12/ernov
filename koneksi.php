<?php
class Koneksi {
    var $conn;
    function __construct()
    {
        session_start();
        $this->conn = mysqli_connect("localhost","root","","ernov");
    }

    
    public function proses_login() 
    
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM `login` WHERE `username` = '$username' AND `password` = '$password'";
        $result = $this->conn->query($sql);
        $user = $result->fetch_assoc();
        if ($user > 0) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
    
            if ($user['role'] == "admin") {
                echo "<script> alert('Anda Login Sebagai Admin'); </script>";
                echo "<script> location = 'Admin/index.php'; </script>";
            } else if ($user['role'] == "staff") {
                echo "<script> alert('Anda Login Sebagai Staff'); </script>";
                echo "<script> location = 'Staff/staff_index.php'; </script>";
            } else if ($user['role'] == "pimpinan") {
                echo "<script> alert('Anda Login Sebagai Pimpinan'); </script>";
                echo "<script> location = 'Pimpinan/pimpinan_index.php'; </script>";
            }
        } else {
            echo "<script> alert('Periksa Kembali'); </script>";
            echo "<script> location = 'login1.php'; </script>";
        }
    }

    public function proses_daftar()
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password= md5($_POST['password']);
        $role= $_POST['role'];
        

        $sql = "INSERT INTO login(email,username,password,role) values ('$email','$username','$password','$role')";
        $this->conn->query($sql);
        
        echo "<script> alert('Akun Berhasil dibuat'); </script>";
        echo "<script> location = 'login1.php'; </script>";
    }

    public function proses_logout()
    {
        session_destroy();
        echo "<script> alert('Anda Berhasil Logout'); </script>";
        echo "<script> location = 'open.php'; </script>";
    }
   
}




$koneksi = new Koneksi();

if(isset($_GET['proses_login'])){
    $koneksi->proses_login();
}
if(isset($_GET['proses_daftar'])){
    $koneksi->proses_daftar();
}
if(isset($_GET['proses_logout'])){
    $koneksi->proses_logout();
}
