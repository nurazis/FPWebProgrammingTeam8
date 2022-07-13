<?php
session_start();

require 'koneksi.php';

if (!isset($_SESSION['login'])) {
  echo "<script>
        alert('Silahkan Masuk Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
} else {
  if ($_SESSION['login'] == "user") {
    echo "<script>
              alert('Silahkan Masuk Sebagai Admin');
              document.location.href = 'login.php';
           </script>";
  }
}

if (isset($_COOKIE['user'])) {
  $username = $_COOKIE['user'];

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

  $admin = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $admin[] = $row;
  }
} else {
  $_SESSION = array();
  session_unset();
  session_destroy();
  echo "<script>
        alert('Silahkan Login Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page - Admin</title>
  <link rel="stylesheet" href="styleadmin.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar">
      <a href="landingpageadmin.php" class="nav active">
        <div id="home">Beranda</div>
      </a>
      <a href="kelolaakun.php" class="nav">
        <div class="list">Kelola Akun</div>
      </a>
      <a href="kelolaresev.php" class="nav">
        <div class="list">Kelola Reservasi</div>
      </a>
      <a href="kelolapaket.php" class="nav">
        <div class="list">Kelola Paket Wisata</div>
      </a>
      <a href="kelolakupon.php" class="nav">
        <div class="list">Kelola Kupon</div>
      </a>
    </div>
    <a href="edituser.php" class="list-login">
      <div><i class="fas fa-user"></i></div>
    </a>
  </div>
  <div class="container-satu">
    <div class="blur">
      <div class="content">
        <h3>Selamat Datang Di Best Tour & Travel</h3>
        <?php date_default_timezone_set('Asia/Makassar');
        $a = date("H");
        if (($a >= 6) && ($a <= 11)) {
          echo "<h1>Selamat Pagi</h1>";
        } else if (($a >= 11) && ($a <= 15)) {
          echo "<h1>Selamat Siang</h1>";
        } else if (($a >= 15) && ($a <= 18)) {
          echo "<h1>Selamat Sore</h1>";
        } else {
          echo "<h1>Selamat Malam</h1>";
        }
        ?>
        <?php foreach ($admin as $min) : ?>
          <h1><?php echo $min["f_name"]; ?></h1>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>