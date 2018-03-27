<?php
include 'config.php';
					if(isset($_POST['tombol'])) {
						$nama	= $_POST['tombol'];
					$nmr	= $_POST['nmr_kepegawaian'];
					$id = mysqli_real_escape_string($konek, $_POST['nmr_kepegawaian']);
					$nama	= $_POST['namalengkap'];
					$jabatan= $_POST['jabatan'];
					$password	= md5($_POST['password']);
					$regis ="INSERT INTO `tbl_regist` (`kd_kepegawaian`, `nama`, `jabatan`, `password`,`level`) VALUES ('$nmr', '$nama', '$jabatan', '$password', 'user')";
					$r=mysqli_query($konek,$regis);
				
					
					if($r > 0)
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('Pendaftaran anda telah berhasil. Silahkan login');
						window.location.href='index.php';
						</script>";
					}
					else
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('Nomor Kepegawaian Sudah Terdaftar');
						window.location.href='registrasi.php';
						</script>";
					}
				}
					?>