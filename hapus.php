<?php 
	require 'koneksi.php';

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
	
	if (!isset($_GET['id'])) {
		echo "<script>
				alert('Pilih Data Yang Ingin Dihapus');
				document.location.href = 'landingpageadmin.php';
			 </script>";
	}
	$tabel = $_GET['tabel'];
	$id = $_GET['id'];

	if ($tabel=="akun") {
		$redirect = "kelolaakun.php";
		$result = mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");
		if($result){
			echo "<script>
					alert('Data Berhasil Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
		else{
			echo "<script>
					alert('Data Gagal Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
	}
	elseif ($tabel=="paket") {
		$redirect = "kelolapaket.php";
		$result = mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");
		if($result){
			echo "<script>
					alert('Data Berhasil Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
		else{
			echo "<script>
					alert('Data Gagal Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
	}
	elseif ($tabel=="reservasi") {
		$redirect = "kelolaresev.php";
		$result = mysqli_query($conn, "DELETE FROM $tabel WHERE id_resev = $id");
		if($result){
			echo "<script>
					alert('Data Berhasil Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
		else{
			echo "<script>
					alert('Data Gagal Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
	}
	elseif ($tabel=="kupon") {
		$redirect = "kelolakupon.php";
		$result = mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");
		if($result){
			echo "<script>
					alert('Data Berhasil Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
		else{
			echo "<script>
					alert('Data Gagal Dihapus');
					document.location.href = '$redirect';
				 </script>";
		}
	}
