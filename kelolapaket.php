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
  $result = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama ASC");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else if (isset($_POST['name_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama DESC");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else if (isset($_POST['harga_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM paket ORDER BY harga ASC");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else if (isset($_POST['harga_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM paket ORDER BY harga DESC");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else if (isset($_POST['tgl_up'])) {
  $result = mysqli_query($conn, "SELECT * FROM paket ORDER BY tanggal_berangkat ASC");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else if (isset($_POST['tgl_down'])) {
  $result = mysqli_query($conn, "SELECT * FROM paket ORDER BY tanggal_berangkat DESC");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else if (isset($_POST['default'])) {
  $result = mysqli_query($conn, "SELECT * FROM paket");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}
else {
  $result = mysqli_query($conn, "SELECT * FROM paket");

  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }
}

if (isset($_POST['tambah'])) {
  $nama = addslashes($_POST['namapaket']);
  $deskripsi = addslashes($_POST['deskripsi']);
  $keterangan = addslashes($_POST['keterangan']);
  $tanggal = $_POST['tanggalberangkat'];
  $harga = $_POST['harga'];
  $image = $_POST['image'];

  $result = mysqli_query($conn, "SELECT * FROM paket WHERE nama = '$nama'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Paket Sudah Ada!');
            document.location.href = 'kelolapaket.php';
          </script>";
  } else {
    $sql = "INSERT INTO paket (nama, deskripsi, keterangan, tanggal_berangkat, harga, image) VALUES ('$nama','$deskripsi','$keterangan','$tanggal','$harga','$image')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>
            alert('Data Berhasil Ditambah');
            document.location.href = 'kelolapaket.php';
           </script>";
    } else {
      echo "<script>
            alert('Data Gagal Ditambah');
            document.location.href = 'kelolapaket.php';
           </script>";
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
        <div id="home">Beranda</div>
      </a>
      <a href="kelolaakun.php" class="nav">
        <div class="list">Kelola Akun</div>
      </a>
      <a href="kelolaresev.php" class="nav">
        <div class="list">Kelola Reservasi</div>
      </a>
      <a href="kelolapaket.php" class="nav active">
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
      CRUD Paket Website Tour Travel
    </h1>
    <div class="adddata">
      <form action="" method="post">
        <h2 style="text-align: center; letter-spacing: 3px">
          Tambah Data Paket Wisata
        </h2>
        <div class="labelinput">
          <div class="label">
            <label for="namapaket">Nama Paket Wisata</label>
          </div>
          <div class="input">
            <input type="text" id="namapaket" name="namapaket" maxlength="50" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="deskripsi">Deskripsi</label>
          </div>
          <div class="input">
            <textarea id="deskripsi" name="deskripsi" required></textarea>
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="keterangan">Keterangan</label>
          </div>
          <div class="input">
            <textarea id="keterangan" name="keterangan" required></textarea>
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="tanggalberangkat">Tanggal Berangkat</label>
          </div>
          <div class="input">
            <input type="date" id="tanggalberangkat" name="tanggalberangkat" min="<?php echo date('Y-m-d') ?>" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="harga">Harga</label>
          </div>
          <div class="input">
            <input type="number" id="harga" name="harga" required />
          </div>
        </div>
        <div class="labelinput">
          <div class="label">
            <label for="image">Link Gambar</label>
          </div>
          <div class="input">
            <input type="text" id="image" name="image" maxlength="80" required />
          </div>
        </div>
        <div class="labelinput">
          <button type="submit" class="addpaket" name="tambah">TAMBAH DATA</button>
        </div>
      </form>
    </div>
    <div class="readdata">
      <h1>Data Paket Wisata</h1>
      <form action="" method="post">
        <div class="search">
          <div class="inputsearch">
            <input type="text" id="keyword" name="keyword" placeholder="Masukkan Kata Kunci" autocomplete="off" />
          </div>
      </form>
    </div>
    <form action="" class="sorting" method="post">
      <div class="depan">
        <button type="submit" name="name_up">Urut Nama<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="name_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="tgl_up">Urut Tanggal<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="tgl_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="harga_up">Urut Harga<i class="fas fa-arrow-up"></i></button>
        <button type="submit" name="harga_down"><i class="fas fa-arrow-down"></i></button>
      </div>
      <div class="belakang">
        <button type="submit" name="default">Default</button>
      </div>
    </form>
    <div class="tabelpaket">
      <table border="1">
        <tr>
          <th>No.</th>
          <th>Nama Paket Wisata</th>
          <th>Deskripsi</th>
          <th>Keterangan</th>
          <th>Tanggal Berangkat</th>
          <th>Harga</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($paket as $pkt) : ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $pkt["nama"]; ?></td>
            <td><?php echo $pkt["deskripsi"]; ?></td>
            <td><?php echo $pkt["keterangan"]; ?></td>
            <td><?php echo $pkt["tanggal_berangkat"]; ?></td>
            <td><?php echo $pkt["harga"]; ?></td>
            <td style="background-image: url(<?= $pkt["image"] ?>);background-size: cover;
  background-position: center;"></td>
            <td>
              <div class="aksi">
                <a href="editpaket.php?id=<?php echo $pkt['id']; ?>"><i class="fas fa-edit fa-2x" style="color: green; margin: 0 5px;"></i></a>
                <a href="hapus.php?id=<?php echo $pkt['id']; ?>&tabel=paket" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-2x" style="color: red; margin: 0 5px;"></i></a>
              </div>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </table>
    </div>
  </div>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="js/script_paket.js"></script>
  <script src="script.js"></script>
</body>

</html>