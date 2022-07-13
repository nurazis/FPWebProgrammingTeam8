<?php
require 'koneksi.php';
if (isset($_POST['regis'])) {
  $fnama = strip_tags(addslashes($_POST['fnama']));
  $lnama = strip_tags(addslashes($_POST['lnama']));
  $ttl = $_POST['ttl'];
  $nohp = $_POST['nohp'];
  $email = strip_tags(addslashes($_POST['email']));
  $username = strip_tags(addslashes($_POST['username']));
  $pass = $_POST['password'];
  $pass2 = $_POST['password2'];
  if ($pass === $pass2) {
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
      echo "<script>
                alert('Nama Pengguna Sudah Ada!');
                document.location.href = 'register.php';
              </script>";
    } else {
      $result = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$email'");
      if (mysqli_fetch_assoc($result)) {
        echo "<script>
                  alert('Email Sudah Ada!');
                  document.location.href = 'register.php';
                </script>";
      } else {
        $result = mysqli_query($conn, "SELECT * FROM akun WHERE no_telp = '$nohp'");
        if (mysqli_fetch_assoc($result)) {
          echo "<script>
                    alert('Nomor Telepon Sudah Ada!');
                    document.location.href = 'register.php';
                  </script>";
        } else {
          $sql = "INSERT INTO akun (f_name, l_name, tanggal_lahir, no_telp, email, username, password) VALUES('$fnama','$lnama','$ttl','$nohp','$email','$username','$pass')";
          $result = mysqli_query($conn, $sql);
          if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                  alert('Daftar Berhasil');
                  document.location.href = 'login.php';
                 </script>";
          } else {
            echo "<script>
                  alert('Daftar Gagal');
                  document.location.href = 'register.php';
                 </script>";
          }
        }
      }
    }
  } else {
    echo "<script>
              alert('Konfirmasi Kata Sandi Tidak Sesuai!');
              document.location.href = 'register.php';
            </script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Page - Tour Travel</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="container-regis">
    <div class="blurregis">
      <h2>Akun Baru</h2>
      <div class="card-regis">
        <form action="" method="post">
          <div class="labelinput">
            <div class="label"><label for="fnama">Nama Depan</label></div>
            <div class="input">
              <input type="text" id="fnama" name="fnama" maxlength="50" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="lnama">Nama Belakang</label></div>
            <div class="input">
              <input type="text" id="lnama" name="lnama" maxlength="50" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="ttl">Tanggal Lahir</label></div>
            <div class="input">
              <input type="date" id="ttl" name="ttl" max="2004-12-31" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="nohp">Nomor Telepon</label></div>
            <div class="input">
              <input type="number" id="nohp" name="nohp" min="0" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="email">Alamat Email</label></div>
            <div class="input">
              <input type="email" id="email" name="email" maxlength="50" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="username">Nama Pengguna</label></div>
            <div class="input">
              <input type="text" id="username" name="username" maxlength="50" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="password">Kata Sandi</label></div>
            <div class="input">
              <input type="password" id="password" name="password" required />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="password2">Konfirmasi Kata Sandi</label></div>
            <div class="input">
              <input type="password" id="password2" name="password2" required />
            </div>
          </div>
          <div class="labelinput">
            <button type="submit" name="regis" class="button-regis">
              DAFTAR
            </button>
          </div>
        </form>
        <a href="login.php"><input type="button" name="button-back" value="KEMBALI KE LOGIN" class="button-regiss" /></a>
      </div>
    </div>
  </div>
</body>

</html>