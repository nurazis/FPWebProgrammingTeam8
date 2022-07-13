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

    $result1 = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");

    $akun = [];

    while ($row = mysqli_fetch_assoc($result1)) {
        $akun[] = $row;
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $result = mysqli_query($conn, "SELECT * FROM paket WHERE id = '$id'");

        $paket = [];
        if (mysqli_num_rows($result) === 0) {
            echo "<script>
                    alert('Paket Tidak Ada');
                    document.location.href = 'offer.php';
                  </script>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $paket[] = $row;
        }
    } else {
        echo "<script>
            alert('Pilih Paket Yang Ingin Dipesan');
            document.location.href = 'offer.php';
           </script>";
    }
} else {
    $_SESSION = array();
    session_unset();
    session_destroy();
    echo "<script>
          alert('Silahkan Login Terlebih Dahulu');
          document.location.href = 'login.php';
         </script>";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi</title>
    <link rel="stylesheet" href="styleoffer.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
    <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
    <?php foreach ($paket as $pkt) { ?>
        <div class="header">
            <div class="head" style="background-image: url(<?= $pkt["image"] ?>)">
                <h2><?= $pkt["nama"] ?></h2>
            </div>
            <div class="head-content">
                <h3>Keterangan</h3>
                <p><?= $pkt["keterangan"] ?></p>
            </div>
        </div>
    <?php } ?>
    <div class="reservasi">
        <div class="header-res">
            <div class="line1"></div>
            <h1 style="color : orange">Reservasi</h1>
            <div class="line2"></div>
        </div>
        <div class="reservasi-body1">
            <?php foreach ($akun as $akn) { ?>
                <form action="bayar.php" method="post">
                    <div class="cover">
                        <div class="labelreservasi">
                            <label for="">Nama Paket</label><br>
                        </div>
                        <?php foreach ($paket as $pkt) { ?>
                            <div class="inputreservasi">
                                <input type="text" value="<?= $pkt['nama']; ?>" name="nama_paket" readonly><br>
                            </div>
                    </div>
                    <div class="cover">
                        <div class="labelreservasi">
                            <label for="">Harga</label><br>
                        </div>
                        <div class="inputreservasi">
                            <input type="number" value="<?= $pkt['harga']; ?>" name="harga_paket" readonly><br>
                        </div>
                    </div>
                    <div class="cover">
                        <div class="labelreservasi">
                            <label for="">Nama Pengguna</label><br>
                        </div>
                        <div class="inputreservasi">
                            <input type="text" value="<?= $akn['f_name'] . ' ' . $akn['l_name']; ?>" name="nama_user" readonly><br>
                        </div>
                    </div>
                    <div class="cover">
                        <div class="labelreservasi">
                            <label for="">Tanggal Berangkat</label><br>
                        </div>
                        <div class="inputreservasi">
                            <input type="date" value="<?= $pkt['tanggal_berangkat']; ?>" name="tanggal_berangkat" readonly><br>
                        </div>
                    </div>
                    <div class="cover">
                        <div class="labelreservasi">
                            <label for="" style="color: orange;">Jumlah Orang</label><br>
                        </div>
                        <div class="inputreservasi">
                            <input type="number" min="1" max="10" name="jumlah_orang" placeholder="Max 10 Org" required style="border: 3px solid orange;"><br>
                        </div>
                    </div>
                <?php } ?>
                <div class="cover">
                    <div class="labelreservasi">
                        <label for="" style="color: orange;">Kode Kupon</label><br>
                    </div>
                    <div class="inputreservasi">
                        <input type="text" name="kode_kupon" maxlength="30" placeholder="Masukan Kode Kupon Jika Ada, Jika Tidak Isi 0" required style="border: 3px solid orange;"><br>
                    </div>
                </div>
                <div class="tombol">
                    <button type="submit" class="book" name="submit"><i class="fas fa-calendar-check" style="margin-right: 5px;"></i>Pesan</button>
                </div>
                </form>
            <?php } ?>
            <div class="tombol">
                <a href="offer.php">
                    <button class="book"><i class="fas fa-step-backward" style="margin-right: 5px;"></i>Kembali</button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>