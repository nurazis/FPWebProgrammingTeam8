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
              alert('Silahkan Masuk Sebagai Pengguna');
              document.location.href = 'login.php';
           </script>";
  }
}
if (isset($_COOKIE['user'])) {
  $username = $_COOKIE['user'];
  $result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
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
  <title>Tentang - Best Tour & Travel</title>
  <link rel="stylesheet" href="style.css" />
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
      <a href="about.php" class="nav active">
        <div class="list">Tentang</div>
      </a>
      <a href="offer.php" class="nav">
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
  <div class="container-about">
    <h1 style="color: orange;">Tentang Best Tour & Travel</h1>
    <hr>
    <div class="contentabout">
      <div class="contentkanan">
        <p>
          Best Tour & Travel adalah salah satu perusahaan yang bergerak di
          bidang pariwisata yang menyediakan pemesanan paket wisata dengan
          tujuan berbagai objek wisata di Indonesia. <br />
          Tidak hanya menyediakan paket wisata per orang, perusahaan kami juga
          menyediakan paket wisata untuk kelompok/rombongan dengan harga yang
          lebih ekonomis. Kami percaya bahwa kami dapat memberikan pelayanan dan
          penawaran terbaik kepada semua customer kami.
        </p>
        <div class="tabel">
          <table>
            <tr>
              <td><i class="fab fa-instagram-square fa-2x" style="color: orange;"></i></td>
              <td>:</td>
              <td><a href="https://instagram.com/risqim12?utm_medium=copy_link" style="color: black;" target="_blank">@besttourtravel</a></td>
            </tr>
            <tr>
              <td><i class="fab fa-whatsapp-square fa-2x" style="color: orange;"></i></td>
              <td>:</td>
              <td><a href="https://wa.me/6285348371038" style="color: black;" target="_blank">085348371038</a></td>
            </tr>
            <tr>
              <td><i class="fab fa-facebook-square fa-2x" style="color: orange;"></i></td>
              <td>:</td>
              <td><a href="https://m.facebook.com/profile.php?id=100006998589085" style="color: black;" target="_blank">Best Tour & Travel</a></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="contentkiri">
        <div class="imgabout">
          <div class="imgaboutheader"><i class="fas fa-address-card fa-4x " style="color: orange;"></i></div>
        </div>
        <div class="imgaboutcontent">
          <p style="text-align: center;">Jalan Gerilya Gg. Keluarga RT. 102 Kota Samarinda</p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>&copy; Copyright. Best Tour & Travel. All Rights Reserved.</p>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>