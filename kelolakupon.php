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

if (isset($_POST['tambah'])) {
  $kode = addslashes($_POST['kode']);
  $disc = addslashes($_POST['disc']);
  $result = mysqli_query($conn, "SELECT * FROM kupon WHERE kode = '$kode'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Kupon Sudah Ada!');
            document.location.href = 'kelolakupon.php';
          </script>";
  } else {
    $sql = "INSERT INTO kupon (kode, disc) VALUES ('$kode','$disc')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>
            alert('Data Berhasil Ditambah');
            document.location.href = 'kelolakupon.php';
           </script>";
    } else {
      echo "<script>
            alert('Data Gagal Ditambah');
            document.location.href = 'kelolakupon.php';
           </script>";
    }
  }
}

if (isset($_POST['kode_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM kupon ORDER BY kode ASC");

  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }
}
else if (isset($_POST['kode_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM kupon ORDER BY kode DESC");

  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }
}
else if (isset($_POST['disc_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM kupon ORDER BY disc ASC");

  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }
}
else if (isset($_POST['disc_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM kupon ORDER BY disc DESC");

  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }
}
else if (isset($_POST['default'])) {
  $result = mysqli_query($conn, "SELECT * FROM kupon");

  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }
}
else {
  $result = mysqli_query($conn, "SELECT * FROM kupon");

  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }
}

if (isset($_POST['search'])) {
  $key = $_POST['keyword'];
  $result = mysqli_query($conn, "SELECT * FROM kupon WHERE kode LIKE '%" . $key . "%'");
  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
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
        <div id="home">Beranda</div>
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
      <a href="kelolakupon.php" class="nav active">
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
      CRUD Kupon Website Tour Travel
    </h1>
    <div class="adddata">
      <form action="" method="post">
        <h2 style="text-align: center; letter-spacing: 3px">
          Tambah Data Kupon
        </h2>
        <div class="labelinput">
          <div class="label">
            <label for="kode">Kode Kupon</label>
          </div>
          <div class="input">
            <input type="text" id="kode" name="kode" maxlength="30" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="disc">Diskon</label>
          </div>
          <div class="input">
            <input type="text" id="disc" name="disc" min="0" required></textarea>
          </div>
        </div>
        <div class="labelinput">
          <button type="submit" class="addpaket" name="tambah">TAMBAH DATA</button>
        </div>
      </form>
    </div>
    <div class="readdata">
      <h1>Data Kupon</h1>
      <form action="" method="post">
        <div class="search">
          <div class="inputsearch">
            <input type="text" id="keyword" name="keyword" placeholder="Masukkan Kata Kunci" autocomplete="off" />
          </div>
      </form>
    </div>
    <form action="" class="sorting" method="post">
      <div class="depan">
        <button type="submit" name="kode_up">Urut Kode<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="kode_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="disc_up">Urut Diskon<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="disc_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="default">Default</button>
      </div>
    </form>
    <div class="tabelpaket">
      <table border="1">
        <tr>
          <th>No.</th>
          <th>Kode</th>
          <th>Diskon</th>
          <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($kupon as $kpn) : ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $kpn["kode"]; ?></td>
            <td><?php echo $kpn["disc"]; ?></td>
            <td>
              <div class="aksi">
                <a href="editkupon.php?id=<?php echo $kpn['id']; ?>"><i class="fas fa-edit fa-2x" style="color: green;"></i></a>
                <a href="hapus.php?id=<?php echo $kpn['id']; ?>&tabel=kupon" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-2x" style="color: red;"></i></a>
              </div>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </table>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="js/script_kupon.js"></script>
  <script src="script.js"></script>
</body>

</html>