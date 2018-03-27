
<?php 

include 'config.php';
if (isset($_POST['tombol'])) {
 
$kd_kepegawaian=  mysqli_real_escape_string ($konek, $_POST['nmr_kepegawaian']);
$password= mysqli_real_escape_string($konek, md5($_POST['password']));
  
$login = mysqli_query($konek,"SELECT * FROM tbl_regist r, tbl_kantor k WHERE kd_kepegawaian='$kd_kepegawaian' AND password='$password' and r.jabatan=k.kd_kantor ");
$cek = mysqli_num_rows($login);
$r=mysqli_fetch_array($login);
 
if($cek>0){
	session_start();
		$_SESSION['kd_kepegawaian']     = $r['kd_kepegawaian'];
		$_SESSION['nama']   = $r['nama'];
		$_SESSION['jabatan']     = $r['jabatan'];
		$_SESSION['nm_kantor']     = $r['nm_kantor'];
		$_SESSION['nama_unit']     = $r['nama_unit'];
		$_SESSION['nama_cabang']     = $r['nama_cabang'];
		$_SESSION['cabang']     = $r['cabang'];
		$_SESSION['unit']   = $r['unit'];
	header("location:check.php");
} else
{
	echo"<script type='text/javascript' language='javascript'>
	alert('Usermame atau Password anda salah');
	window.location.href='login.php';
	</script>";
}

}

?>
 

