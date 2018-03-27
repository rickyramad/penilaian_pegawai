<?php 
	include 'session.php';
	$exec = "SELECT level FROM tbl_regist WHERE kd_kepegawaian = '$_SESSION[kd_kepegawaian]'";
	$gas = mysqli_query($konek, $exec);
	$cek = mysqli_fetch_row($gas);
	if ($cek[0]!="admin") {
		echo "<script language=Javascript>
			window.alert('Anda Bukan Admin');
			javascript:document.location='../index.php';
		</script>";
	}
 ?>
<html>
	<head>
		<title>SISTEM PENILAIAN KINERJA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><a href="home.php">HALAMAN ADMIN</a></h1>
				<a href="../index.php">Logout</a>
			</header> 


		<!-- Banner -->
			<section id="banner1">
				<img src="../images/logo_bank.png" width="11.5% " /><br> <!--logo it atas-->
				<b><strong>SISTEM PENILAIAN KINERJA</strong>
				<p> SISTEM PENILAIAN KINERJA SETIAP UNIT<br />
					ANK PEMBANGUNAN DAERAHL<br />
					SULAWESI TENGGARA</p></b>
				
					<br></br>
					
				<b><a href="kinerja.php?id_kategori=1" class="button alt" style="text-decoration:none">Lihat Data Kinerja</a>&nbsp; &nbsp; &nbsp;
					<a href="ubah.php" class="button alt" style="text-decoration:none">Ubah Data Base</a></b>
				<br></br>
				
				
				SELAMAT DATANG ADMIN </a>
				<p>
        <br>
        <br>
        <br>
        <br>
        </p>
						
					</section>




		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					
					<p>2017 © Copyright KP Teknik Informatika 2018 </p>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>