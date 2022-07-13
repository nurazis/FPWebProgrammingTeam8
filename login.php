<?php
session_start();
require 'koneksi.php';
if (isset($_SESSION['login'])) {
  if (isset($_COOKIE['user'])) {
    $username = $_COOKIE['user'];
    if ($_SESSION['login'] == "admin") {
      echo "<script>
                alert('Selamat Datang Kembali $username');
                document.location.href = 'landingpageadmin.php';
            </script>";
    } else if ($_SESSION['login'] == "user") {
      echo "<script>
                alert('Selamat Datang Kembali $username');
                document.location.href = 'landingpageuser.php';
            </script>";
    }
  } else {
    $_SESSION = array();
    session_unset();
    session_destroy();
  }
}
if (isset($_POST['login'])) {
  $username = addslashes($_POST['username']);
  $passadmin = $_POST['password'];
  $pass = $_POST['password'];
  $result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
  $result1 = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$username'");
  $result2 = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
  $result3 = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$username'");

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($pass, $row['password'])) {
      $_SESSION['login'] = "user";
      setcookie('user', "$username", time() + 3600);
      header("Location: landingpageuser.php");
      exit();
    } else {
      echo "<script>
            alert('Password Salah!');
            document.location.href = 'login.php';
           </script>";
    }
  } elseif (mysqli_num_rows($result1) === 1) {
    $row = mysqli_fetch_assoc($result1);

    if (password_verify($pass, $row['password'])) {
      $_SESSION['login'] = "user";
      $username = $row['username'];
      setcookie('user', "$username", time() + 3600);
      header("Location: landingpageuser.php");
      exit();
    } else {
      echo "<script>
            alert('Password Salah!');
            document.location.href = 'login.php';
           </script>";
    }
  } else if (mysqli_num_rows($result2) === 1) {
    $row = mysqli_fetch_assoc($result2);
    if ($passadmin === $row['password']) {
      $_SESSION['login'] = "admin";
      setcookie('user', "$username", time() + 3600);
      header("Location: landingpageadmin.php");
      exit();
    } else {
      echo "<script>
            alert('Password Salah!');
            document.location.href = 'login.php';
           </script>";
    }
  } elseif (mysqli_num_rows($result3) === 1) {
    $row = mysqli_fetch_assoc($result3);
    if ($passadmin === $row['password']) {
      $_SESSION['login'] = "admin";
      $username = $row['username'];
      setcookie('user', "$username", time() + 3600);
      header("Location: landingpageadmin.php");
      exit();
    } else {
      echo "<script>
            alert('Password Salah!');
            document.location.href = 'login.php';
           </script>";
    }
  } else {
    echo "<script>
          alert('Username/Email Tidak Terdaftar!');
          document.location.href = 'login.php';
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
  <title>Login Page - Tour Travel</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="container-login">
    <div class="blurlogin">
      <h2 style="font-size: 20px;">Mari Mulai</h2>
      <div class="card-login">
        <form action="" method="post">
          <div class="labelinput">
            <div class="label"><label for="username">Nama Pengguna/Email</label></div>
            <div class="input">
              <input type="text" id="username" name="username" />
            </div>
          </div>
          <div class="labelinput">
            <div class="label"><label for="password">Kata Sandi</label></div>
            <div class="input">
              <div class="inputpass">
                <input type="password" id="password" name="password" />
                <div id="toggle" onclick="showHide();"><i class="fas fa-eye"></i></div>
              </div>
            </div>
          </div>
          <div class="labelinput">
            <button type="submit" name="login" class="button-login" style="margin-top: 30px;">
              MASUK
            </button>
          </div>
        </form>
        <div class="labelinput">
          <p>Belum Punya Akun?</p>
          <a href="register.php"><button class="button-regiss">DAFTAR</button></a>
        </div>
      </div>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>