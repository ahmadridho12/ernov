<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "ernov");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $kode_acak = generateRandomString(); // Membuat kode acak baru

    // Cek apakah email ada di database
    $query = "SELECT * FROM login WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Email ditemukan, buat kode acak dan update password baru
        $hashed_password = password_hash($kode_acak, PASSWORD_DEFAULT);
        $update_query = "UPDATE login SET password = '$hashed_password' WHERE email = '$email'";
        $update_result = mysqli_query($koneksi, $update_query);

        if ($update_result) {
            // Kirim email dengan kode acak
            $to = $email;
            $subject = "Reset Password";
            $message = "Password baru Anda: $kode_acak";
            $headers = "From: bujanggoks@gmail.com";

            if (mail($to, $subject, $message, $headers)) {
                echo "Email dengan instruksi reset password telah dikirim ke alamat email Anda.";
            } else {
                echo "Gagal mengirim email. Silakan coba lagi.";
            }
        } else {
            echo "Gagal mengupdate password. Silakan coba lagi.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
}

// Fungsi untuk menghasilkan kode acak
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="kode_acak">Kode Acak:</label>
        <input type="text" name="kode_acak" id="kode_acak" required>
        <br>
        <label for="password_baru">Password Baru:</label>
        <input type="password" name="password_baru" id="password_baru" required>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
