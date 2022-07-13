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

foreach ($akun as $akn) :
    $id_user = $akn["id"];
endforeach;

$result1 =  mysqli_query($conn, "SELECT * FROM reservasi WHERE id_user = '$id_user'");
$reservasi = [];
while ($row = mysqli_fetch_assoc($result1)) {
    $reservasi[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
    <link rel="stylesheet" href="styleriwayat.css">
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
            <a href="offer.php" class="nav">
                <div class="list">Tawaran</div>
            </a>
            <a href="riwayat.php" class="nav active">
                <div class="list">Riwayat</div>
            </a>
        </div>
        <a href="edituser.php" class="list-login">
            <div><i class="fas fa-user"></i></div>
        </a>
    </div>
    <div class="judul">
        <h2 class="">Riwayat Pemesanan</h2>
    </div>
    <div class="wrapper">
        <?php foreach ($reservasi as $rsv) :
            $id_paket = $rsv["id_paket"];
            $result2 =  mysqli_query($conn, "SELECT * FROM paket WHERE id = '$id_paket'");
            $paket = [];
            while ($row = mysqli_fetch_assoc($result2)) {
                $paket[] = $row;
            }
            $paket = $paket[0];
        ?>
            <div class="container">
                <div class="gambar" style="background-image: url(<?= $paket["image"] ?>)">
                    <h3><?= $paket["nama"] ?></h3>
                </div>
                <h4>Tanggal Pesan: <?= $rsv["tanggal"] ?></h4>
                <h4><?= $rsv["jumlah"] ?> Orang</h4>
                <h4>Rp. <?= $rsv["total"] ?></h4>
                <a href="rincian.php?reservasi=<?= $rsv["id_resev"] ?>&paket=<?= $rsv["id_paket"] ?>">
                    <button class="book">Rincian</button>
                </a>
            </div>
        <?php endforeach ?>
    </div>
    <div class="footer">
        <p>&copy; Copyright. Best Tour & Travel. All Rights Reserved.</p>
    </div>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</body>

</html>