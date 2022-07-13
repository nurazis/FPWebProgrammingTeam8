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

if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
} else {
    $_SESSION = array();
    session_unset();
    session_destroy();
    echo "<script>
          alert('Silahkan Login Terlebih Dahulu');
          document.location.href = 'login.php';
         </script>";
  }
$result1 = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$user'");
$akun = [];
while ($row = mysqli_fetch_assoc($result1)) {
    $akun[] = $row;
}

if ($_POST["uang"] < $_POST["total"]) {
    echo "<script>
              alert('Pembelian Gagal Uang Anda Tidak Mencukupi');
              document.location.href = 'landingpageuser.php';
           </script>";
} else if (isset($_POST["total"])) {
    $kembali = $_POST["uang"] - $_POST["total"];
    if (isset($_POST["nama_paket"])) {
        $n_paket = $_POST["nama_paket"];
    }
    $result2 = mysqli_query($conn, "SELECT * FROM paket WHERE nama = '$n_paket'");
    $paket = [];
    while ($row = mysqli_fetch_assoc($result2)) {
        $paket[] = $row;
    }

    $tanggal = date("Y/m/d");
    $jumlah = $_POST["jumlah_orang"];
    $total = $_POST["total"];
    foreach ($akun as $akn) {
        $id_user = $akn['id'];
    }
    foreach ($paket as $pkt) {
        $id_paket = $pkt['id'];
    }
    $id_kupon = $_POST["id_kupon"];

    if ($id_kupon==0) {
        $sql = "INSERT INTO reservasi (tanggal, jumlah, total, id_user, id_paket, id_kupon) VALUES ('$tanggal','$jumlah','$total','$id_user','$id_paket', NULL)";
    }
    else{
        $sql = "INSERT INTO reservasi (tanggal, jumlah, total, id_user, id_paket, id_kupon) VALUES ('$tanggal','$jumlah','$total','$id_user','$id_paket','$id_kupon')";
    }
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('Reservasi Berhasil');
           </script>";
    } else {
        echo "<script>
            alert('Reservasi Gagal');
            document.location.href = 'landingpageuser.php';
           </script>";
    }
} else {
    echo "<script>
        alert('Silahkan Isi Reservasi');
        document.location.href = 'reservasi.php';
       </script>";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <link rel="stylesheet" href="styleoffer.css">
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
    <div class="reservasi">
        <div class="header-res">
            <div class="line1"></div>
            <h1 style="color : orange"> Struk </h1>
            <div class="line2"></div>
        </div>
        <div class="reservasi-body">
            <form action="landingpageuser.php" method="post">
                <div class="box">
                    <h2>PENGGUNA</h2>
                    <?php foreach ($akun as $akn) : ?>
                        <div class="cover3">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="struk" name="namalengkap" value="<?= $akn["f_name"] . ' ' . $akn["l_name"] ?>" disabled>
                        </div>
                        <div class="cover3">
                            <label for="">E - Mail</label>
                            <input type="email" class="struk" name="email" value="<?= $akn["email"] ?>" disabled>
                        </div>
                        <div class="cover3">
                            <label for="">Tanggal - Lahir</label>
                            <input type="date" class="struk" name="tanggallahir" value="<?= $akn["tanggal_lahir"] ?>" disabled>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="box">
                    <h2>PAKET</h2>
                    <?php foreach ($paket as $pkt) : ?>
                        <div class="cover3">
                            <label for="">Nama Paket</label>
                            <input type="text" class="struk" name="namapaket" value="<?= $pkt["nama"] ?>" disabled>
                        </div>
                        <div class="cover3">
                            <label for="">Jumlah Orang</label>
                            <input type="text" class="struk" name="jumlah" value="<?= $_POST["jumlah_orang"] ?>" disabled>
                        </div>
                        <div class="cover3">
                            <label for="">Tanggal Berangkat</label>
                            <input type="date" class="struk" name="tanggalberangkat" value="<?= $pkt["tanggal_berangkat"] ?>" disabled>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="box">
                    <h2>UANG</h2>
                    <div class="cover3">
                        <label for="">Total</label>
                        <input type="text" class="struk" name="total" value="<?= $_POST["total"] ?>" disabled>
                    </div>
                    <div class="cover3">
                        <label for="">Tunai </label>
                        <input type="text" class="struk" name="uang" value="<?= $_POST["uang"] ?>" disabled>
                    </div>
                    <div class="cover3">
                        <label for="">Kembalian</label>
                        <input type="text" class="struk" name="kembalian" value="<?= $kembali ?>" disabled>
                    </div>
                </div>
                <button type="submit" name="home" class="submit">Beranda</button>
            </form>
        </div>
    </div>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>

</html>