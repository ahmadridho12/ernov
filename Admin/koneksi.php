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
                header("location: index.php");
            } else if ($user['role'] == "staff") {
                header("location: staff_index.php");
            } else if ($user['role'] == "pimpinan") {
                header("location: pimpinan_index.php");
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
    public function insert_pembayaran()
    {
        $nama =  $_POST['nama'];
        $nohp = $_POST['nohp'];
        $jenis_pindahan = $_POST['jenis_pembayaran'];
        $harga = $_POST['harga'];
        $metode_pembayaran = $_POST['metode_pembayaran'];
        $sql = "INSERT INTO `bayar`(`nama`, `nohp`, `jenis_pembayaran`, `harga`,`metode_pembayaran`) VALUES ('$nama','$nohp','$jenis_pindahan','$harga','$metode_pembayaran')";
        header("location: pembayaran.php");
        return $this->conn->query($sql);
    }

    public function edit_user()
    {
    $sql = "UPDATE `login` SET `email`='$new_email', `username`='$new_username', `password`='$new_password' WHERE `id_user`='$id_user'";
    return $this->conn->query($sql);
    }

    public function delete_user($id_user)
    {
        $sql = "DELETE FROM `login` WHERE `id_user`='$id_user'";
        return $this->conn->query($sql);
    }



    public function send_reset_email($email) {
        // Generate unique token
        $token = generate_token();
    
        // Store token in database associated with the email
        $sql = "INSERT INTO reset_tokens (email, token, expiration) VALUES ('$email', '$token', DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        $this->conn->query($sql);
    
        // Compose reset password email
        $subject = "Reset Password";
        $message = "Click the link below to reset your password:\n";
        $message .= "Reset Password Link: http://example.com/reset_password.php?token=$token";
    
        // Send email
        $headers = "From: noreply@example.com";
        if (mail($email, $subject, $message, $headers)) {
            echo "<script> alert('Email reset password berhasil dikirim'); </script>";
            echo "<script> location = 'forgot_password.php'; </script>";
        } else {
            echo "<script> alert('Gagal mengirim email reset password'); </script>";
            echo "<script> location = 'forgot_password.php'; </script>";
        }
    }

    
    public function reset_password($token, $new_password) {
        // Verify token and retrieve associated email from the database
        $sql = "SELECT email FROM reset_tokens WHERE token = '$token' AND expiration > NOW()";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $email = $row['email'];
    
        if ($result->num_rows == 1) {
            // Reset the password for the email
            $hashed_password = md5($new_password); // Hash the new password
            $sql_update = "UPDATE login SET password = '$hashed_password' WHERE email = '$email'";
            $this->conn->query($sql_update);
    
            // Invalidate the token or mark it as used
            $sql_delete = "DELETE FROM reset_tokens WHERE token = '$token'";
            $this->conn->query($sql_delete);
    
            echo "<script> alert('Password berhasil direset'); </script>";
            echo "<script> location = 'login1.php'; </script>";
        } else {
            echo "<script> alert('Token tidak valid atau telah kedaluwarsa'); </script>";
            echo "<script> location = 'forgot_password.php'; </script>";
        }
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
if(isset($_POST['pembayaran'])){
    $koneksi->insert_pembayaran();
}
if (isset($_POST['forget_password'])) {
    $koneksi->forget_password();
}