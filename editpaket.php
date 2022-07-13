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
}else{
  $_SESSION = array(); 
  session_unset();
  session_destroy();
  echo "<script>
        alert('Silahkan Login Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}

if (!isset($_GET['id'])) {
  echo "<script>
        alert('Pilih Data Yang Ingin Diubah');
        document.location.href = 'kelolapaket.php';
       </script>";
}
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM paket WHERE id = $id");

$paket = [];

if (mysqli_num_rows($result) === 0) {
  echo "<script>
          alert('Paket Tidak Ada');
          document.location.href = 'kelolapaket.php';
        </script>";
}

while ($row = mysqli_fetch_assoc($result)) {
  $paket[] = $row;
}

$paket = $paket[0];
$temp_nama = $paket['nama'];

if (isset($_POST['ubah'])) {
  $id = $_POST['id'];
  $nama = $_POST['namapaket'];
  $deskripsi = $_POST['deskripsi'];
  $keterangan = $_POST['keterangan'];
  $tanggal = $_POST['tanggalberangkat'];
  $harga = $_POST['harga'];
  $image = $_POST['image'];

  if ($temp_nama === $nama) {
    $sql = "UPDATE paket SET nama = '$nama', deskripsi = '$deskripsi', keterangan = '$keterangan', tanggal_berangkat = '$tanggal', harga = '$harga', image = '$image' WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>
            alert('Data Berhasil Diubah');
            document.location.href = 'kelolapaket.php';
           </script>";
    } else {
      echo "<script>
            alert('Data Gagal Diubah');
            document.location.href = 'editpaket.php?id=$id';
           </script>";
    }
  }else{
    $result1 = mysqli_query($conn, "SELECT * FROM paket WHERE nama = '$nama'");
    if (mysqli_num_rows($result1) === 1) {
    echo "<script>
            alert('Nama Paket Sudah Ada!');
            document.location.href = 'editpaket.php?id=$id';
          </script>";
    }else{
      $sql = "UPDATE paket SET nama = '$nama', deskripsi = '$deskripsi', keterangan = '$keterangan', tanggal_berangkat = '$tanggal', harga = '$harga', image = '$image' WHERE id = '$id'";

      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo "<script>
              alert('Data Berhasil Diubah');
              document.location.href = 'kelolapaket.php';
             </script>";
      } else {
        echo "<script>
              alert('Data Gagal Diubah');
              document.location.href = 'editpaket.php?id=$id';
             </script>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Paket</title>
  <link rel="stylesheet" href="styleadmin.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">    
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar"> 
    <a href="landingpageadmin.php" class="nav">
      <div id="home">Home</div>
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
  <div class="container-paket">
    <h1 style="
          margin: 10px auto;
          letter-spacing: 3px;
          letter-spacing: 3px;
          text-shadow: 1px 1px 2px #000000;
        ">
      CRUD Website Paket Tour Travel
    </h1>
    <div class="adddata">
      <form action="" method="post">
        <h2 style="text-align: center; letter-spacing: 3px">
          Ubah Data Paket Wisata
        </h2>
        <input type="hidden" name="id" id="id" value="<?php echo $paket["id"]; ?>">
        <div class="labelinput">
          <div class="label">
            <label for="namapaket">Nama Paket Wisata</label>
          </div>
          <div class="input">
            <input type="text" id="namapaket" name="namapaket" value="<?php echo $paket["nama"]; ?>" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="deskripsi">Deskripsi</label>
          </div>
          <div class="input">
            <textarea id="deskripsi" name="deskripsi" required><?php echo $paket["deskripsi"]; ?></textarea>
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="keterangan">Keterangan</label>
          </div>
          <div class="input">
            <textarea id="keterangan" name="keterangan" required><?php echo $paket["keterangan"]; ?></textarea>
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="tanggalberangkat">Tanggal Berangkat</label>
          </div>
          <div class="input">
            <input type="date" id="tanggalberangkat" name="tanggalberangkat" min="<?php echo date('Y-m-d') ?>" value="<?php echo $paket["tanggal_berangkat"]; ?>" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="harga">Harga</label>
          </div>
          <div class="input">
            <input type="number" id="harga" name="harga" value="<?php echo $paket["harga"]; ?>" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="image">Link Image</label>
          </div>
          <div class="input">
            <input type="text" id="image" name="image" value="<?php echo $paket["image"]; ?>" required />
          </div>
        </div>
        <div class="labelinput">
          <button type="submit" class="addpaket" name="ubah">UBAH DATA</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>