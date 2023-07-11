<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <?php
    require 'path/to/PHPMailer/src/PHPMailer.php';
    require 'path/to/PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $kode_acak = generateRandomString(); // Membuat kode acak baru

        // Cek apakah email ada di database
        $query = "SELECT * FROM login WHERE email = '$email'";
        // ...

        if ($update_result) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan host email yang sesuai
            $mail->SMTPAuth = true;
            $mail->Username = 'ridhobyu1@gmail.com'; // Ganti dengan alamat email pengirim
            $mail->Password = '123ahm@D'; // Ganti dengan password email pengirim
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('ridhobyu1@gmail.com', 'ridho'); // Ganti dengan alamat email dan nama pengirim
            $mail->addAddress($to); // Alamat email penerima

            $mail->Subject = 'Reset Password';
            $mail->Body = "Password baru Anda: $kode_acak";

            if ($mail->send()) {
                echo "Email dengan instruksi reset password telah dikirim ke alamat email Anda.";
            } else {
                echo "Gagal mengirim email. Silakan coba lagi.";
            }
        }
        // ...
    }

    // Fungsi untuk menghasilkan kode acak
    function generateRandomString($length = 10) {
        // ...
    }
    ?>

    <h1>Reset Password</h1>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <!-- Tambahkan elemen input lainnya jika diperlukan -->
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
