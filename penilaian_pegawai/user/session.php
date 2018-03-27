<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include "../config.php";

session_start();  // Memulai Session
// Menyimpan Session

if(!isset($_SESSION['kd_kepegawaian'])){
session_destroy();
echo "<script language=Javascript>
		window.alert('Anda Harus Login');
		javascript:document.location='../index.php';
	</script>";
}

$user_check=$_SESSION['kd_kepegawaian'];

// Ambil nama karyawan berdasarkan username karyawan dengan mysql_fetch_assoc
$ses_sql=mysqli_query($konek, "SELECT kd_kepegawaian from tbl_regist  where kd_kepegawaian='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);

$login_session = $row['kd_kepegawaian'];

if(!isset($login_session)){
session_destroy();
echo "<script language=Javascript>
		window.alert('Anda Harus Login');
		javascript:document.location='../index.php';
	</script>";
}
?>