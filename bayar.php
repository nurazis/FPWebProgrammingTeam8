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

if (isset($_POST["nama_paket"])) {
    $n_paket = $_POST["nama_paket"];
    $result1 = mysqli_query($conn, "SELECT * FROM paket WHERE nama = '$n_paket'");
    $paket = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $paket[] = $row;
    }
    $total = 0;
    $diskon = 0;
    if (isset($_POST["kode_kupon"])) {
        $kode_kupon = $_POST["kode_kupon"];
        $result2 = mysqli_query($conn, "SELECT * FROM kupon WHERE kode = '$kode_kupon'");
        $kupon = [];
        while ($row = mysqli_fetch_assoc($result2)) {
            $kupon[] = $row;
        }
        $id_kupon = 0;
        $kode = "";
        $disc = 0;
        foreach ($kupon as $kpn) :
            $kode = $kpn["kode"];
            $disc = $kpn["disc"];
            $id_diskon = $kpn["id"];
        endforeach;
        if ($kode_kupon === $kode) {
            $t_kode = $kode;
            $id_kupon = $id_diskon;
            $total = $_POST["jumlah_orang"] * $_POST["harga_paket"];
            $diskon = $_POST["jumlah_orang"] * $_POST["harga_paket"] * $disc;
            $total = $total - $diskon;
        } else {
            $t_kode = 0;
            $id_kupon = 0;
            $total = $_POST["jumlah_orang"] * $_POST["harga_paket"];
        }
    } else {
        $id_kupon = 0;
        $t_kode = 0;
        $total = $_POST["jumlah_orang"] * $_POST["harga_paket"];
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
    <title>Bayar</title>
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
            <h1 style="color : orange"> Bayar </h1>
            <div class="line2"></div>
        </div>
        <div class="reservasi-body">
            <form action="struk.php" method="post">
                <div class="cover-1">
                    <input type="hidden" name="id_kupon" id="id_kupon" value="<?= $id_kupon ?>">
                    <div class="cover2">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" class="bayar" name="nama_paket" id="nama_paket" value="<?= $n_paket ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="harga_paket">Harga</label>
                        <input type="number" class="bayar" name="harga_paket" id="harga_paket" value="<?= $_POST["harga_paket"] ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="nama_user">Nama Pengguna</label>
                        <input type="text" class="bayar" name="nama_user" id="nama_user" value="<?= $_POST["nama_user"] ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="tanggal_berangkat">Tanggal Berangkat</label>
                        <input type="date" class="bayar" name="tanggal_berangkat" id="tanggal_berangkat" value="<?= $_POST["tanggal_berangkat"] ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="jumlah_orang">Jumlah Orang</label>
                        <input type="text" class="bayar" name="jumlah_orang" id="jumlah_orang" value="<?= $_POST["jumlah_orang"] ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="kode_kupon">Kode Kupon</label>
                        <input type="text" class="bayar" name="kode_kupon" id="kode_kupon" value="<?= $t_kode ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="diskon">Diskon</label>
                        <input type="text" class="bayar" name="diskon" id="diskon" value="<?= $diskon ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="total">Total</label>
                        <input type="text" class="bayar" name="total" id="total" value="<?= $total ?>" readonly>
                    </div>
                    <div class="cover2">
                        <label for="uang" style=" font-weight: bold; color: orange;" class="uang">Uang </label>
                        <input type="number" class="bayar" style=" border: 5px solid orange;" name="uang" id="uang" placeholder="Masukan Jumlah Uang" required>
                    </div>
                </div>
                <button type="submit" style=" margin-top: 10px; margin-bottom: 20px;" class="book">Bayar</button>
            </form>
        </div>
    </div>

</body>

</html>