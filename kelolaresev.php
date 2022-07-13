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

if (isset($_POST['name_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id ORDER BY f_name ASC, l_name ASC");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else if (isset($_POST['name_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id ORDER BY f_name DESC, l_name DESC");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else if (isset($_POST['paket_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id ORDER BY paket.nama ASC");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else if (isset($_POST['paket_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id ORDER BY paket.nama DESC");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else if (isset($_POST['tgl_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id ORDER BY tanggal ASC");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else if (isset($_POST['tgl_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id ORDER BY tanggal DESC");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else if (isset($_POST['default'])) {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}
else {
  $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id");

  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}


if (isset($_POST['search'])) {
  $key = $_POST['keyword'];
  $result = mysqli_query($conn, "SELECT * FROM akun WHERE CONCAT(f_name,' ',l_name) LIKE '%" . $key . "%'");
  $reservasi = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservasi[] = $row;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Reservasi</title>
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
      <a href="kelolaakun.php" class="nav">
        <div class="list">Kelola Akun</div>
      </a>
      <a href="kelolaresev.php" class="nav active">
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
    <h1>Data Reservasi</h1>
    <form action="" method="post">
      <div class="search">
        <div class="labelsearch">
            <button type="submit" name="search"><i class="fas fa-search" style="margin-right: 5px;"></i>Cari</button>
          </div>
        <div class="inputsearch">
          <input type="text" name="keyword" placeholder="Masukkan Kata Kunci" autocomplete="off" />
        </div>

      </div>
    </form>
    <form action="" class="sorting" method="post">
      <div class="depan">
        <button type="submit" name="name_up">Urut Nama<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="name_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="paket_up">Urut Paket<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="paket_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="tgl_up">Urut Tanggal<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="tgl_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="default">Default</button>
      </div>
    </form>
    <div class="tabelakun">
      <table border="1">
        <tr>
          <th>No.</th>
          <th>Nama Lengkap</th>
          <th>Paket Yang Dibeli</th>
          <th>Tanggal Reservasi</th>
          <th>Jumlah Orang</th>
          <th>Total</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
          foreach ($reservasi as $resev) {
            $id = $resev['id'];
            $result = mysqli_query($conn, "SELECT * FROM reservasi INNER JOIN akun ON reservasi.id_user = akun.id JOIN paket ON reservasi.id_paket = paket.id WHERE id_user = '$id'");
            $akun = [];
            while ($row = mysqli_fetch_assoc($result)) {
              $akun[] = $row;
            }
        ?>
            <?php $i = 1;
            foreach ($akun as $akn) : ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $akn["f_name"] . " " . $akn["l_name"]; ?></td>
                <td><?php echo $akn["nama"]; ?></td>
                <td><?php echo $akn["tanggal"]; ?></td>
                <td><?php echo $akn["jumlah"]; ?></td>
                <td><?php echo $akn["total"]; ?></td>
                <td><?php echo $akn["email"]; ?></td>
                <td><a href="hapus.php?id=<?php echo $akn['id_resev']; ?>&tabel=reservasi" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-1x" style="color: red;"></a></td>
              </tr>
            <?php $i++;
            endforeach;
          }
        } else {
          $i = 1;
          foreach ($reservasi as $resev) : ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $resev["f_name"] . " " . $resev["l_name"]; ?></td>
              <td><?php echo $resev["nama"]; ?></td>
              <td><?php echo $resev["tanggal"]; ?></td>
              <td><?php echo $resev["jumlah"]; ?></td>
              <td><?php echo $resev["total"]; ?></td>
              <td><?php echo $resev["email"]; ?></td>
              <td><a href="hapus.php?id=<?php echo $resev['id_resev']; ?>&tabel=reservasi" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-1x" style="color: red;"></a></td>
            </tr>
        <?php $i++;
          endforeach;
        } ?>
      </table>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>