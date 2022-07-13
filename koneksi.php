<?php
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "travel";

	$conn = mysqli_connect($server, $user, $password, $db);

	if(!$conn){
		die("Gagal Terhubung Ke Database".$db. mysqli_connect_error());
	}
?>