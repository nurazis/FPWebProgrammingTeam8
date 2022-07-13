<?php 
	session_start();
	if (!isset($_SESSION['login'])) {
		echo "<script>
				alert('Silahkan Masuk Terlebih Dahulu');
				document.location.href = 'login.php';
			 </script>";
	}
    setcookie('user',"",0);
	$_SESSION = array(); 
	session_unset();
	session_destroy();
	echo "<script>
			alert('Anda Telah Keluar');
			document.location.href = 'login.php';
		 </script>";
	exit();
 ?>