<?php
if(isset($_POST['send']))
{
    $koneksi = mysqli_connect("localhost", "root", "", "ernov");
    // Periksa apakah koneksi berhasil
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    $email = $_POST['email'];

    $select = mysqli_query($koneksi, "SELECT email, password FROM login WHERE email='$email'");

    if(mysqli_num_rows($select)==1)
    {
        while($row=mysqli_fetch_array($select))
        {
            $email=$row['email'];
            $pass=md5($row['password']);
        }
        //$link="<a href='localhost:8080/phpmailer/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
        require_once('phpmailer/src/Exception.php');
        require_once('phpmailer/src/PHPMailer.php');
        require_once('phpmailer/src/SMTP.php');
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        
        $body = "Klik link berikut untuk reset Password, <a href='localhost/new - Copy/reset_pass.php?reset=$pass&key=$email'>$pass<a>"; //isi dari email
              
        $mail->IsSMTP();
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth = true;                  
        $mail->Username = "bujangkelapir@gmail.com"; // GMAIL username
        $mail->Password = "iroentrfdrgpojjc"; // GMAIL password
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = "465"; // set the SMTP port for the GMAIL server
        $mail->From='bujangkelapir@gmail.com';
        $mail->FromName='Admin ernov';

        $mail->AddAddress($email, 'User Sistem');
        $mail->Subject  = 'Reset Password';
        $mail->IsHTML(true);
        $mail->MsgHTML($body);
        if($mail->Send())
        {
            echo "<script> alert('Link reset password telah dikirim ke email anda, Cek email untuk melakukan reset'); window.location = 'beranda.php'; </script>"; //jika pesan terkirim
        }
        else
        {
            echo "Mail Error - >".$mail->ErrorInfo;
        }
    }
    else {
        echo "<script> alert('Email anda tidak terdaftar di sistem'); window.location = 'beranda.php'; </script>"; //jika pesan terkirim
    }
}
?>
