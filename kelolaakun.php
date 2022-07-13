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
} else {
  $_SESSION = array();
  session_unset();
  session_destroy();
  echo "<script>
        alert('Silahkan Login Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}

if (isset($_POST['fname_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun ORDER BY f_name ASC");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else if (isset($_POST['fname_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun ORDER BY f_name DESC");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else if (isset($_POST['lname_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun ORDER BY l_name ASC");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else if (isset($_POST['lname_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun ORDER BY l_name DESC");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else if (isset($_POST['uname_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun ORDER BY username ASC");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else if (isset($_POST['uname_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun ORDER BY username DESC");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else if (isset($_POST['default'])) {
  $result = mysqli_query($conn, "SELECT * FROM akun");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}
else{
  $result = mysqli_query($conn, "SELECT * FROM akun");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Akun</title>
  <link rel="stylesheet" href="styleadmin.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar">
      <a href="landingpageadmin.php" class="nav">
        <div id="home">Beranda</div>
      </a>
      <a href="kelolaakun.php" class="nav active">
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
  <div class="container-crud">
    <h1>Data Akun</h1>
    <form action="" method="post">
      <div class="search">
        <div class="inputsearch">
          <input type="text" id="keyword" name="keyword" placeholder="Masukkan Kata Kunci" autocomplete="off" />
        </div>
      </div>
    </form>
    <form action="" class="sorting" method="post">
      <div class="depan">
        <button type="submit" name="fname_up">Urut Nama Depan<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="fname_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="lname_up">Urut Nama Belakang<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="lname_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="uname_up">Urut Username<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="uname_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="default">Default</button>
      </div>
    </form>
    <div class="tabelakun">
      <table border="1">
        <tr>
          <th>No.</th>
          <th>Nama Depan</th>
          <th>Nama Belakang</th>
          <th>Tanggal Lahir</th>
          <th>No. Telp</th>
          <th>Email</th>
          <th>Nama Pengguna</th>
          <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($akun as $acc) : ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $acc["f_name"]; ?></td>
            <td><?php echo $acc["l_name"]; ?></td>
            <td><?php echo $acc["tanggal_lahir"]; ?></td>
            <td><?php echo $acc["no_telp"]; ?></td>
            <td><?php echo $acc["email"]; ?></td>
            <td><?php echo $acc["username"]; ?></td>
            <td><a href="hapus.php?id=<?php echo $acc['id']; ?>&tabel=akun" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-1x" style="color: red;"></i></a></td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </table>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="js/script_akun.js"></script>
  <script src="script.js"></script>
</body>

</html>