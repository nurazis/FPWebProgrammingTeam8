<?php
session_start();

require 'koneksi.php';

if (!isset($_SESSION['login'])) {
  echo "<script>
        alert('Silahkan Masuk Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}

if (isset($_COOKIE['user'])) {
  $username = $_COOKIE['user'];

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
  $result2 = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");

  $user = [];

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $user[] = $row;
    $tabel = "admin";
    $redirect = "landingpageadmin.php";
  } elseif (mysqli_num_rows($result2) === 1) {
    $row = mysqli_fetch_assoc($result2);
    $user[] = $row;
    $tabel = "akun";
    $redirect = "landingpageuser.php";
  }

  $user = $user[0];
} else {
  $_SESSION = array();
  session_unset();
  session_destroy();
  echo "<script>
        alert('Silahkan Login Terlebih Dahulu');
        document.location.href = 'login.php';
       </script>";
}

$temp_username = $user['username'];
$temp_email = $user['email'];
$temp_nohp = $user['no_telp'];

if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $tabel = $_POST['tabel'];
  $fnama = addslashes($_POST['fnama']);
  $lnama = addslashes($_POST['lnama']);
  $ttl = $_POST['ttl'];
  $nohp = $_POST['nohp'];
  $email = addslashes($_POST['email']);
  $username = addslashes($_POST['uname']);
  $pass = $_POST['pass'];
  if ($tabel == "akun") {
    $pass = password_hash($pass, PASSWORD_DEFAULT);
  }

  if ($temp_username == $username) {
    if ($temp_email == $email) {
      $sql = "UPDATE $tabel SET f_name = '$fnama', l_name = '$lnama', tanggal_lahir = '$ttl', no_telp = '$nohp', email = '$email', username = '$username', password = '$pass' WHERE id = '$id'";

      $result4 = mysqli_query($conn, $sql);
      if ($result4) {
        echo "<script>
                alert('Data Berhasil Diubah');
                document.location.href = 'edituser.php';
             </script>";
      } else {
        echo "<script>
                alert('Data Gagal Diubah');
                document.location.href = 'edituser.php';
             </script>";
      }
    } else {
      $result2 = mysqli_query($conn, "SELECT * FROM $tabel WHERE email = '$email'");
      if (mysqli_num_rows($result2) === 1) {
        echo "<script>
               alert('Email Sudah Ada!');
               document.location.href = 'edituser.php';
             </script>";
      } else {
        $sql = "UPDATE $tabel SET f_name = '$fnama', l_name = '$lnama', tanggal_lahir = '$ttl', no_telp = '$nohp', email = '$email', username = '$username', password = '$pass' WHERE id = '$id'";

        $result4 = mysqli_query($conn, $sql);
        if ($result4) {
          echo "<script>
                  alert('Data Berhasil Diubah');
                  document.location.href = 'edituser.php';
               </script>";
        } else {
          echo "<script>
                  alert('Data Gagal Diubah');
                  document.location.href = 'edituser.php';
               </script>";
        }
      }
    }
  } else {
    $result1 = mysqli_query($conn, "SELECT * FROM $tabel WHERE username = '$username'");
    if (mysqli_num_rows($result1) === 1) {
      echo "<script>
            alert('Nama Pengguna Sudah Ada!');
            document.location.href = 'edituser.php';
          </script>";
    } else {
      if ($temp_email == $email) {
        $sql = "UPDATE $tabel SET f_name = '$fnama', l_name = '$lnama', tanggal_lahir = '$ttl', no_telp = '$nohp', email = '$email', username = '$username', password = '$pass' WHERE id = '$id'";

        $result4 = mysqli_query($conn, $sql);
        if ($result4) {
          setcookie('user', "$username", time() + 3600);
          echo "<script>
                  alert('Data Berhasil Diubah');
                  document.location.href = 'edituser.php';
                </script>";
        } else {
          echo "<script>
                  alert('Data Gagal Diubah');
                  document.location.href = 'edituser.php';
               </script>";
        }
      } else {
        $result2 = mysqli_query($conn, "SELECT * FROM $tabel WHERE email = '$email'");
        if (mysqli_num_rows($result2) === 1) {
          echo "<script>
                 alert('Email Sudah Ada!');
                 document.location.href = 'edituser.php';
                </script>";
        } else {
          $sql = "UPDATE $tabel SET f_name = '$fnama', l_name = '$lnama', tanggal_lahir = '$ttl', no_telp = '$nohp', email = '$email', username = '$username', password = '$pass' WHERE id = '$id'";

          $result4 = mysqli_query($conn, $sql);
          if ($result4) {
            setcookie('user', "$username", time() + 3600);
            echo "<script>
                    alert('Data Berhasil Diubah');
                    document.location.href = 'edituser.php';
                 </script>";
          } else {
            echo "<script>
                    alert('Data Gagal Diubah');
                    document.location.href = 'edituser.php';
                 </script>";
          }
        }
      }
    }
  }
}

if (isset($_POST['logout'])) {
  header("Location: logout.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Akun Saya - Tour Travel</title>
  <link rel="stylesheet" href="styleadmin.css" />
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" />
  <link rel="shortcut icon" href="assets/image/pngwing.com.png">
</head>

<body>
  <div class="navbar">
    <div class="logo">Best Tour & Travel</div>
    <div class="menunavbar">
      <a href="<?php echo $redirect; ?>" class="nav">
        <div id="home">Beranda</div>
      </a>
    </div>
    <a href="edituser.php" class="list-login">
      <div><i class="fas fa-user"></i></div>
    </a>
  </div>
  <div class="container-user">
    <h1>Profil Saya</h1>
    <div class="coveratas">
      <form action="" method="post">
        <div class="cover-1">
          <input type="hidden" name="id" id="id" value="<?php echo $user["id"]; ?>">
          <input type="hidden" name="tabel" id="tabel" value="<?php echo $tabel; ?>">
          <div class="cover">
            <div class="labeledit">
              <label for="fnama">Nama Depan</label>
            </div>
            <div class="inputedit">
              <input type="text" id="fnama" name="fnama" maxlength="50" value="<?php echo $user['f_name']; ?>">
            </div>
          </div>
          <div class="cover">
            <div class="labeledit">
              <label for="lnama">Nama Belakang</label>
            </div>
            <div class="inputedit">
              <input type="text" id="lnama" name="lnama" maxlength="50" value="<?php echo $user['l_name']; ?>">
            </div>
          </div>
          <div class="cover">
            <div class="labeledit">
              <label for="ttl">Tanggal Lahir</label>
            </div>
            <div class="inputedit">
              <input type="date" id="ttl" name="ttl" max="2004-12-31" value="<?php echo $user["tanggal_lahir"]; ?>" />
            </div>
          </div>
          <div class="cover">
            <div class="labeledit">
              <label for="nohp">Nomor Telepon</label>
            </div>
            <div class="inputedit">
              <input type="number" id="nohp" name="nohp" min="0" value="<?php echo $user["no_telp"]; ?>" />
            </div>
          </div>
          <div class="cover">
            <div class="labeledit">
              <label for="email">Email</label>
            </div>
            <div class="inputedit">
              <input type="email" id="email" name="email" maxlength="50" value="<?php echo $user["email"]; ?>" />
            </div>
          </div>

          <div class="cover">
            <div class="labeledit">
              <label for="uname">Nama Pengguna</label>
            </div>
            <div class="inputedit">
              <input type="text" id="uname" name="uname" maxlength="50" value="<?php echo $user["username"]; ?>" />
            </div>
          </div>
          <div class="cover">
            <div class="labeledit">
              <label for="pass">Kata Sandi</label>
            </div>
            <div class="inputedit">
              <input type="password" id="pass" name="pass" maxlength="50" value="<?php echo $user["password"]; ?>" />
            </div>
          </div>
        </div>
        <div class="savedata"><button type="submit" name="save" id="save">
            <i class="fas fa-save" style="margin-right: 5px;"></i>Simpan
          </button></div>
        <div class="logout">
          <form action="" method="post"><button type="submit" name="logout">
              <p>Keluar</p><i class="fas fa-sign-out-alt"></i>
            </button></form>
        </div>
      </form>
    </div>
  </div>
</body>

</html>