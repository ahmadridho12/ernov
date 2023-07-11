<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin ernov | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/iconfonts/ionicons/css/ionicons.css">
  <link rel="stylesheet" href="vendors/iconfonts/typicons/src/font/typicons.css">
  <link rel="stylesheet" href="vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    
    body {
      background-color: #f2f2f2;
    }
    .login-box {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      height: 100vh;
      margin-top: 50px;
    }
    .card-body {
      padding: 30px;
    }
    .login-card-body {
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-box-msg {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 25px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 10px;
    }
    .form-control {
      border-radius: 4px;
      height: 40px;
    }
    .input-group-text {
      background-color: transparent;
      border: none;
      padding: 0;
    }
    .input-group-text i {
      font-size: 18px;
      line-height: 1;
    }
    .submit-btn {
      font-size: 16px;
      font-weight: 500;
    }
    #message {
      font-size: 14px;
      margin-top: 10px;
      display: block;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Reset Password</p>
      <?php
      if($_GET['key'] && $_GET['reset']) {
          $koneksi = mysqli_connect("localhost", "root", "", "ernov");

          if (!$koneksi) {
              die("Koneksi database gagal: " . mysqli_connect_error());
          }

          $email = $_GET['key'];
          $pass = $_GET['reset'];

          $select = mysqli_query($koneksi, "SELECT email, password FROM login WHERE email='$email' AND md5(password)='$pass'");

          if(mysqli_num_rows($select) == 1) {
      ?>
      <form action="" method="POST">
          <div class="form-group">
              <label class="label">Password Baru</label>
              <div class="input-group">
                  <input type="password" class="form-control" name="password" id="password" onkeyup='check();' placeholder="*********">
                  <input type="hidden" name="email" value="<?php echo $email;?>">
                  <input type="hidden" name="pass" value="<?php echo $pass;?>">
                  <div class="input-group-append">
                      <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <label class="label">Konfirmasi Password</label>
              <div class="input-group">
                  <input type="password" name="konfirmasi" class="form-control" id="confirm_password" onkeyup='check();' placeholder="*********">
                  <div class="input-group-append">
                      <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <span id='message'></span>
          </div>
          <div class="form-group">
              <button class="btn btn-danger submit-btn btn-" id="btnSubmit" name="submit_password">Reset</button>
          </div>
      </form>
      <?php
          } else {
              echo "Data Tidak Ditemukan";
          }
      }

      if(isset($_POST['submit_password'])) {
          $koneksi = mysqli_connect("localhost", "root", "", "ernov");

          if (!$koneksi) {
              die("Koneksi database gagal: " . mysqli_connect_error());
          }

          $email = $_POST['email'];
          $pass = $_POST['password'];

          $select = mysqli_query($koneksi, "UPDATE login SET password=MD5('$pass') WHERE email='$email'") or die(mysqli_error());
          if($select) {
              echo "<script> alert('Reset password berhasil'); window.location = 'beranda.php'; </script>";
          } else {
              echo "<script>alert('Gagal Menyimpan '); window.location = 'beranda.php';</script>";
          }
      }
      ?>
    </div>
  </div>
</div>
<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  var check = function() {
      if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'Password dan Konfirmasi Sama';
      } else {
          document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'Password dan Konfirmasi Tidak Sama';
      }
  }
</script>
</body>
</html>
