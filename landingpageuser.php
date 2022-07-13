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
} else {
  $_SESSION = array();
  session_unset();
  session_destroy();
  echo "<script>
        alert('Silahkan Login Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}
$result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
$akun = [];
while ($row = mysqli_fetch_assoc($result)) {
  $akun[] = $row;
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page - Tour Travel</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar">
      <a href="landingpageuser.php" class="nav active">
        <div id="home">Beranda</div>
      </a>
      <a href="about.php" class="nav">
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
        <?php foreach ($akun as $kun) : ?>
          <h1><?php echo $kun['f_name']; ?></h1>
        <?php endforeach; ?>
        <a href="offer.php" style="text-decoration: none; color: white"><button class="pesan-sekarang">PESAN SEKARANG</button></a>
        <p style="margin: 20px;">Atau</p>
        <a href="#offer"><button class="lihatpaket">Lihat Paket Terpopuler</button></a>
      </div>
    </div>
  </div>
  <h1 class="headingpageuser">Paket Terpopuler</h1>
  <div class="container-dua">
    <?php $i = 1;
    foreach ($paket as $pkt) : ?>
      <?php if ($i < 4) : ?>
        <div class="paket" id="offer">
          <div class="paket-card">
            <div class="header" style="background-image: url(<?= $pkt["image"] ?>)"></div>
            <div class="content">
              <h2><?= $pkt["nama"] ?></h2>
              <p style="text-align: center;">Harga : <?= $pkt["harga"] ?></p>
              <button class="detail" id="<?= $i ?>" style="margin: 10px;">Detail</button>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php $i++;
    endforeach; ?>
  </div>
  <div class="container3">
    <?php $j = 1;
    foreach ($paket as $pkt) : ?>
      <?php if ($j < 4) : ?>
        <div class="detail<?= $j; ?>">
          <div class="header-user">
            <img src="<?= $pkt["image"] ?>" alt="" class="detail-img">
          </div>
          <div class="content-user">
            <h3>Deskripsi</h3>
            <p><?= $pkt["deskripsi"] ?></p>
            <h3>Keterangan</h3>
            <table>
              <tr>
                <td><?= $pkt["keterangan"] ?></td>
              </tr>
            </table>
            <h3>Harga</h3>
            <p>Rp <?= $pkt["harga"] ?></p>
            <a href="reservasi.php?id=<?= $pkt["id"]; ?>"><button style="margin: 10px;">Pesan Sekarang</button></a>
          </div>
        </div>
      <?php endif; ?>
    <?php $j++;
    endforeach ?>
  </div>
  <div class="footer">
    <p>&copy; Copyright. Best Tour & Travel. All Rights Reserved.</p>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>