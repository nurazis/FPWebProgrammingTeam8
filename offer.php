<?php
session_start();
require 'koneksi.php';
if (!isset($_SESSION['login'])) {
  echo "<script>
        alert('Silahkan Masuk Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
} else {
  if ($_SESSION['login'] == "admin") {
    echo "<script>
              alert('Silahkan Masuk Sebagai User');
              document.location.href = 'login.php';
           </script>";
  }
}
if (isset($_COOKIE['user'])) {
  $username = $_COOKIE['user'];
  $result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
  $akun = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
  $akun = $akun[0];
} else {
  $_SESSION = array();
  session_unset();
  session_destroy();
  echo "<script>
        alert('Silahkan Login Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}
$read_sql = "SELECT * FROM paket";
$result = mysqli_query($conn, $read_sql);
$paket = [];
while ($row = mysqli_fetch_assoc($result)) {
  $paket[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tawaran</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar">
      <a href="landingpageuser.php" class="nav">
        <div id="home">Beranda</div>
      </a>
      <a href="about.php" class="nav">
        <div class="list">Tentang</div>
      </a>
      <a href="offer.php" class="nav active">
        <div class="list">Tawaran</div>
      </a>
      <a href="riwayat.php" class="nav">
        <div class="list">Riwayat</div>
      </a>
    </div>
    <a href="edituser.php" class="list-login">
      <div><i class="fas fa-user"></i></div>
    </a>
  </div>
  <div class="container-offer">
    <?php $i = 1;
    foreach ($paket as $pkt) : ?>
      <div class="paket" id="offer">
        <div class="paket-card">
          <div class="header" style="background-image: url(<?= $pkt["image"] ?>)"></div>
          <div class="content">
            <h2><?= $pkt["nama"] ?></h2>
            <p style="text-align: center;">Harga : <?= $pkt["harga"] ?></p>
            <a href="reservasi.php?id=<?= $pkt["id"]; ?>"><button style="margin: 10px;">Pesan Sekarang</button></a>
          </div>
        </div>
      </div>
    <?php $i++;
    endforeach; ?>
  </div>
  <div class="footer">
    <p>&copy; Copyright. Best Tour & Travel. All Rights Reserved.</p>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>