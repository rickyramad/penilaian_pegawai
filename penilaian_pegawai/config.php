<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "db_penilaian";

	// Koneksi dan memilih database di server
	$konek=mysqli_connect($hostname,$username,$password) or die("Koneksi Gagal");
	mysqli_select_db($konek,$database) or die("Database Tidak Ditemukan");
?>
