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
  <title>Tour Travel</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar">
      <a href="#fitur" class="nav">
        <div class="list">Fitur</div>
      </a>
      <a href="#about" class="nav">
        <div class="list">Tentang</div>
      </a>
      <a href="#offer" class="nav">
        <div class="list">Tawaran</div>
      </a>
    </div>
    <a href="login.php" class="list-login">
      <div>Masuk</div>
    </a>
  </div>
  <div class="container-satu">
    <div class="blur">
      <div class="content">
        <h3>Selamat Datang Di Best Tour & Travel</h3>
        <h1>Perjalanan Aman, Nyaman dan Menyenangkan</h1>
        <a href="login.php" style="text-decoration: none; color: white"><button class="pesan-sekarang">PESAN SEKARANG</button></a>
      </div>
    </div>
  </div>
  <div class="container-dua" id="fitur">
    <div class="offer">
      <div class="offer-header">
        <i class="fas fa-book fa-3x"></i>
        <h2>Booking Cepat</h2>
      </div>
      <div class="offer-content">
        <p>
          Dapatkan fitur reservasi dan bayar langsung dari website tidak pakai
          ribet
        </p>
        <a href="login.php"><button>Selengkapnya</button></a>
      </div>
    </div>
    <div class="offer">
      <div class="offer-header">
        <i class="fas fa-hand-holding-usd fa-3x"></i>
        <h2>Harga Terbaik</h2>
      </div>
      <div class="offer-content">
        <p>
          Dapatkan harga terbaik yang tidak membuat isi kantong anda
          ketar-ketir
        </p>
        <a href="login.php"><button>Selengkapnya</button></a>
      </div>
    </div>
    <div class="offer">
      <div class="offer-header">
        <i class="fas fa-user-shield fa-3x"></i>
        <h2>Aman Terjamin</h2>
      </div>
      <div class="offer-content">
        <p>
          Kami selalu mendahulukan keamanan anda sehingga anda tidak perlu
          khawatir
        </p>
        <a href="login.php"><button>Selengkapnya</button></a>
      </div>
    </div>
    <div class="offer">
      <div class="offer-header">
        <i class="fas fa-users fa-3x"></i>
        <h2>Tim CS Handal</h2>
      </div>
      <div class="offer-content">
        <p>
          Dapatkan informasi dan layanan 1x24 Jam untuk semua kebutuhan
          informasi
        </p>
        <a href="login.php"><button>Selengkapnya</button></a>
      </div>
    </div>
  </div>
  <div class="container-tiga">
    <div class="profile" id="about">
      <div class="deskripsi">
        <h2>Best Tour & Travel</h2>
        <p>
          Best Tour & Travel adalah salah satu perusahaan yang bergerak di
          bidang pariwisata yang menyediakan pemesanan paket wisata dengan
          tujuan berbagai objek wisata di Indonesia. <br />
          Tidak hanya menyediakan paket wisata per orang, perusahaan kami juga
          menyediakan paket wisata untuk kelompok/rombongan dengan harga yang
          lebih ekonomis. Kami percaya bahwa kami dapat memberikan pelayanan
          dan penawaran terbaik kepada semua customer kami.
        </p>
        <br />
        <blockquote>
          "Perjalanan bukan hadiah untuk bekerja, itu pendidikan untuk hidup"
        </blockquote>
      </div>
      <div class="button-profile">
        <a href="https://wa.me/6285348371038"><button>HUBUNGI KAMI</button></a>
      </div>
    </div>
    <h1>Paket Terpopuler</h1>
    <div class="container-empat">
      <?php $i = 1;
      foreach ($paket as $pkt) : ?>
        <?php if ($i < 4) : ?>
          <div class="paket" id="offer">
            <div class="paket-card">
              <div class="header" style="background-image: url(<?= $pkt["image"] ?>)"></div>
              <div class="content">
                <h2><?= $pkt["nama"] ?></h2>
                <p style="text-align: center;">Harga : <?= $pkt["harga"] ?></p>
                <a href="login.php"><button class="detail" id="<?= $i ?>" style="margin: 10px;">Detail</button></a>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php $i++;
      endforeach; ?>
    </div>
    <div class="footer">
      <p>&copy; Copyright. Best Tour & Travel. All Rights Reserved.</p>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>