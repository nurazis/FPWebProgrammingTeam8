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
        document.location.href = 'kelolakupon.php';
       </script>";
}
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM kupon WHERE id = $id");

$kupon = [];

if (mysqli_num_rows($result) === 0) {
  echo "<script>
          alert('Kupon Tidak Ada');
          document.location.href = 'kelolakupon.php';
        </script>";
}

while ($row = mysqli_fetch_assoc($result)) {
  $kupon[] = $row;
}

$kupon = $kupon[0];
$temp_kode = $kupon['kode'];

if (isset($_POST['ubah'])) {
  $id = $_POST['id'];
  $kode = $_POST['kode'];
  $disc = $_POST['disc'];

  if ($temp_kode === $kode) {
    $sql = "UPDATE kupon SET kode = '$kode', disc = '$disc' WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>
            alert('Data Berhasil Diubah');
            document.location.href = 'kelolakupon.php';
           </script>";
    } else {
      echo "<script>
            alert('Data Gagal Diubah');
            document.location.href = 'editkupon.php?id=$id';
           </script>";
    }
  }else{
    $result1 = mysqli_query($conn, "SELECT * FROM kupon WHERE kode = '$kode'");
    if (mysqli_num_rows($result1) === 1) {
    echo "<script>
            alert('Kode Kupon Sudah Ada!');
            document.location.href = 'editkupon.php?id=$id';
          </script>";
    }else{
      $sql = "UPDATE kupon SET kode = '$kode', disc = '$disc' WHERE id = '$id'";

      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo "<script>
              alert('Data Berhasil Diubah');
              document.location.href = 'kelolakupon.php';
             </script>";
      } else {
        echo "<script>
              alert('Data Gagal Diubah');
              document.location.href = 'editkupon.php?id=$id';
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
  <title>Kelola Kupon</title>
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
        <input type="hidden" name="id" id="id" value="<?php echo $kupon["id"]; ?>">
        <div class="labelinput">
          <div class="label">
            <label for="kode">Kode</label>
          </div>
          <div class="input">
            <input type="text" id="kode" name="kode" maxlength="30" value="<?php echo $kupon["kode"]; ?>" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="disc">Diskon</label>
          </div>
          <div class="input">
            <input type="text" id="disc" name="disc" min="0" required value="<?php echo $kupon["disc"]; ?>" />
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