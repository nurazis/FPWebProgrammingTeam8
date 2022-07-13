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
  $akun = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
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

if (isset($_GET['reservasi'])) {
  $id_resev = $_GET['reservasi'];
}else {
    echo "<script>
        alert('Silahkan Isi Reservasi');
        document.location.href = 'reservasi.php';
       </script>";
}
$result1 = mysqli_query($conn, "SELECT * FROM reservasi WHERE id_resev = '$id_resev'");
$reservasi = [];
if (mysqli_num_rows($result1) === 0) {
  echo "<script>
          alert('Reservasi Tidak Ada');
          document.location.href = 'reservasi.php';
        </script>";
}
while ($row = mysqli_fetch_assoc($result1)) {
  $reservasi[] = $row;
}

if (isset($_GET['paket'])) {
  $id_paket = $_GET['paket'];
}else {
    echo "<script>
        alert('Silahkan Isi Reservasi');
        document.location.href = 'reservasi.php';
       </script>";
}
$result2 = mysqli_query($conn, "SELECT * FROM paket WHERE id = '$id_paket'");
$paket = [];
if (mysqli_num_rows($result2) === 0) {
  echo "<script>
          alert('Reservasi Tidak Ada');
          document.location.href = 'offer.php';
        </script>";
}
while ($row = mysqli_fetch_assoc($result2)) {
  $paket[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rincian</title>
  <link rel="stylesheet" href="styleriwayat.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <?php foreach ($paket as $pkt) : ?>
    <div class="header">
      <div class="head" style="background-image: url(<?= $pkt["image"] ?>)">
        <h2><?= $pkt["nama"] ?></h2>
      </div>
      <div class="head-content">
        <h3>Keterangan</h3>
        <p><?= $pkt["keterangan"] ?></p>
      </div>
    </div>
  <?php endforeach ?>
  <div class="rincian">
    <div class="header-rin">
      <div class="line1"></div>
      <h1 style="color : orange"> Rincian </h1>
      <div class="line2"></div>
    </div>

    <div class="rincian-body">
      <div class="box">
        <h2>PENGGUNA</h2>
        <?php foreach ($akun as $akn) : ?>
          <div class="cover3">
            <label for="">Nama Lengkap</label>
            <input type="text" class="rinci" value="<?= $akn["f_name"] . ' ' . $akn["l_name"] ?>" disabled>
          </div>
          <div class="cover3">
            <label for="">E - Mail</label>
            <input type="email" class="rinci" value="<?= $akn["email"] ?>" disabled>
          </div>
          <div class="cover3">
            <label for="">Tanggal - Lahir</label>
            <input type="date" class="rinci" value="<?= $akn["tanggal_lahir"] ?>" disabled>
          </div>
        <?php endforeach ?>
      </div>
      <div class="box">
        <h2>PAKET</h2>
        <?php foreach ($paket as $pkt) : ?>
          <div class="cover3">
            <label for="">Nama Paket</label>
            <input type="text" class="rinci" name="namapaket" value="<?= $pkt["nama"] ?>" disabled>
          </div>
          <div class="cover3">
            <label for="">Tanggal Berangkat</label>
            <input type="date" class="rinci" name="tanggalberangkat" value="<?= $pkt["tanggal_berangkat"] ?>" disabled>
          </div>
          <div class="cover3">
            <label for="">Harga Paket</label>
            <input type="text" class="rinci" value="Rp. <?= $pkt["harga"] ?>" disabled>
          </div>
        <?php endforeach ?>
      </div>
      <div class="box">
        <h2>RESERVASI</h2>
        <?php foreach ($reservasi as $rsv) : ?>
          <div class="cover3">
            <label for="">Total </label>
            <input type="text" class="rinci" value="Rp. <?= $rsv["total"] ?>" disabled>
          </div>
          <div class="cover3">
            <label for="">Tanggal Pemesanan</label>
            <input type="date" class="rinci" value="<?= $rsv["tanggal"] ?>" disabled>
          </div>
          <div class="cover3">
            <label for="">Jumlah Orang</label>
            <input type="text" class="rinci" value="<?= $rsv["jumlah"] ?> Orang" disabled>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <a href="riwayat.php">
      <div class="kembali">
        <p>Kembali</p>
      </div>
    </a>
  </div>
  <div class="footer">
    <p>&copy; Copyright. Best Tour & Travel. All Rights Reserved.</p>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>