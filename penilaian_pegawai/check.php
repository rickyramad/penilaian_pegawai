<?php 
	include 'session.php';
	$exec = "SELECT level, jabatan FROM tbl_regist WHERE kd_kepegawaian = '$_SESSION[kd_kepegawaian]'";
	$gas = mysqli_query($konek, $exec);
	$cek = mysqli_fetch_row($gas);
	if ($cek[0]=="admin") {
		echo "<script language=Javascript>
		    window.alert('Selamat Datang Admin');
			javascript:document.location='admin/index.php';
		</script>";
	}
	else if ($cek[0]=="user") {
		echo "<script language=Javascript>
			window.alert('Selamat Datang');
			javascript:document.location='user/cab.php?id_kategori=1';
		</script>";
	}
	