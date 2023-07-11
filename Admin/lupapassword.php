<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "ernov");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
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

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $query = "SELECT * FROM nama_tabel WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        // Email ditemukan, buat kode acak dan update password baru
        $kode_acak = generateRandomString();
        $hashed_password = password_hash($kode_acak, PASSWORD_DEFAULT);
        $update_query = "UPDATE nama_tabel SET password = '$hashed_password' WHERE email = '$email'";
        $update_result = mysqli_query($koneksi, $update_query);

        if ($update_result) {
            // Kirim email dengan kode acak
            $to = $email;
            $subject = "Reset Password";
            $message = "Password baru Anda: $kode_acak";
            $headers = "From: admin@example.com";

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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
</head>
<body>
    <h1>Lupa Password</h1>
    <form method="post" action="send_email.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <input type="submit" name="submit" value="Reset Password">
    </form>
</body>
</html>
