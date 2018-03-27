
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User - Dashboard</title>

<link href="../user/css/bootstrap.min.css" rel="stylesheet">
<link href="../user/css/datepicker3.css" rel="stylesheet">
<link href="../user/css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="../user/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
<?php
   if (! @$_GET['tombol']) 
			@$_GET['tombol']="";
   if (! @$_POST['tombol_update']) 
			@$_POST['tombol_update']="";			
?>
 <?php
 include "../config.php";

  if ($_GET['tombol']=="Cancel")
   {
			header('location:parameter.php');
   }

   if ($_POST['tombol_update']=="Submit")
   {
	   $perintah="UPDATE tbl_parameter SET
	              kd_perspektif='$_POST[kd_perspektif]', kd_parameter='$_POST[kd_parameter]'
	              , kd_unit='$_POST[nama_unit]' , Nomor='$_POST[no_parameter]' , nama_parameter='$_POST[nama_parameter]' , kd_kpi='$_POST[kpi_bobot]' , kpi_sub='$_POST[sub_bobot]' , bobot_pers='$_POST[bobot_pers]' , kode='$_POST[kode]'
				  WHERE kode='$_POST[kode]'
				  ";
	   $data =mysqli_query($konek,$perintah);
	    if($data >0)
					{
			           echo"<script type='text/javascript' language='javascript'>
						alert('data berhasil di update');
						window.location.href='parameter.php';
						</script>";
					}
					else
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('data tidak terupdate kode tidak bisa di ganti');
						window.location.href='parameter.php';
						</script>";
					}
   }

 if ($_GET['tombol']=="jadi_delete")
   {
       $perintah="DELETE FROM tbl_parameter
	              WHERE kode='$_GET[id]'";
	   $data =mysqli_query($konek,$perintah);
	   if($data >0)
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('data telah di hapus');
						window.location.href='parameter.php';
						</script>";
					}
					else
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('data tidak terhapus akibat relasi, ->hapus data relasi');
						window.location.href='parameter.php';
						</script>";
					}
   }
 if ($_GET['tombol']=="delete")
   {
       echo "<script type='text/javascript'>
	         x=window.confirm('Apakah data mau dihapus');
			 if (x)
			     window.location.href='parameter.php?tombol=jadi_delete&id=$_GET[id]';
			 else 
			     window.alert('data tidak jadi dihapus');
	         </script>
	        ";
   }   
   ?>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Tampilan</span> Database</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php include'session.php'; echo $_SESSION['nama']; ?> (Admin)<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="index.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Keluar</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

		<ul class="nav menu">
			<li class=""><a href="ubah.php" ><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel User</a></li>
	
			<li class=""><a href="kantor.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Kantor</a></li>
		
			<li class=""><a href="unit.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Unit</a></li>
	
			<li class=""><a href="perspektif.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Perspektif</a></li>
	
			<li class="active"><a href="parameter.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Parameter</a></li>

			<li class=""><a href="pegawai.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Pegawai</a></li>
	
		
  </ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12" style="margin-bottom: 10px;">
				
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>Selamat Datang Admin
				</div>

				<script language="javascript">
						    function hanyaAngka(e, decimal) {
						    var key;
						    var keychar;
						     if (window.event) {
						         key = window.event.keyCode;
						     } else
						     if (e) {
						         key = e.which;
						     } else return true;
						   
						    keychar = String.fromCharCode(key);
						    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
						        return true;
						    } else
						    if ((("0123456789").indexOf(keychar) > -1)) {
						        return true;
						    } else
						    if (decimal && (keychar == ".")) {
						        return true;
						    } else return false;
						    }
						</script>
					<form action="" method="post">   
                        <div>
                                <table border='1'>
                                        <tr><td><center><strong>Menu Pengisian</strong></td></tr>
                                         <tr><br><td>Nama Perspektif    </td>
                                    	<td>
                                    		<select name="nama_perspektif"  class="form-control">
                                    	<?php
											include '../config.php';

											$query = "SELECT * FROM tbl_perspektif";
											$hasil = mysqli_query($konek,$query);
											while($data=mysqli_fetch_array($hasil)){
											  echo "<option value=$data[kd_perspektif]> $data[kd_perspektif]-$data[nama_perspektif]</option>";
											}
			

											?></select></td></tr>
                                         </tr>
                                    	<tr><td>Kode Parameter        </td>
                                    	<td><input placeholder="kode parameter" onkeypress="return hanyaAngka(event, false)"  name="kd_parameter" class="form-control" type="text"></td></tr>
                                            <tr><br><td>Nama Unit    		  </td>
                                    	<td>
                                    		<select name="nama_unit"  class="form-control">
                                    	<?php
											include '../config.php';

											$query = "SELECT * FROM tbl_unit";
											$hasil = mysqli_query($konek,$query);
											while($data=mysqli_fetch_array($hasil)){
											  echo "<option value=$data[kd_unit]> $data[kd_unit]-$data[nama_unit]</option>";
											}
			

											?></select></td></tr>
                                         </tr>
                                         <tr><br><td>Nomor Parameter   </td>
                                    	<td><input placeholder="nomor parameter (X..1,2,3)"  name="no_parameter" class="form-control" type="text_area"></td></tr>
                                         <tr><br><td>Nama Parameter   </td>
                                    	<td><textarea name="nama_parameter" placeholder="parameter"   class="form-control"></textarea></td></tr>
                                    	<tr><br><td>KPI Bobot   </td>
                                    	<td><input placeholder="KPI BOBOT" onkeypress="return hanyaAngka(event, false)"  name="kpi_bobot" class="form-control" type="text_area"></td></tr>
                                    	<tr><br><td>Sub Bobot   </td>
                                    	<td><input placeholder="SUB KPI BOBOT" onkeypress="return hanyaAngka(event, false)"  name="sub_bobot" class="form-control" type="text_area"></td></tr>
                                    	<tr><br><td>Bobot Perspektif </td>
                                    	<td><input placeholder="BOBOT PERSPEKTIF" onkeypress="return hanyaAngka(event, false)" name="bobot_pers" class="form-control" type="text_area"></td></tr>
                                    	<tr><br><td>Kode Primary </td>
                                    	<td><input placeholder="isikan berurutan" onkeypress="return hanyaAngka(event, false)" name="primary" class="form-control" type="text_area"></td></tr>
                                        
                                           <tr><td><button type="submit" class="btn btn-success" name="simpan">Simpan</button></td></tr>
                        </table>
                                       
                        </div>
                    </div>
                </div>  
                 </form>
                    <?php
					include '../config.php';
					if(isset($_POST['simpan'])) {
					$kd	= $_POST['simpan'];
					$nama_perspektif	= $_POST['nama_perspektif'];
					$kd_parameter	= $_POST['kd_parameter'];
					$nama_unit	= $_POST['nama_unit'];
					$nomor_parameter=$_POST['no_parameter'];
					$nama_parameter	= $_POST['nama_parameter'];
					$kpi_bobot=$_POST['kpi_bobot'];
					$sub_bobot=$_POST['sub_bobot'];
					$bobot_pers=$_POST['bobot_pers'];
					$kode_pri=$_POST['primary'];
					$simpan ="INSERT INTO `tbl_parameter` (`kd_perspektif`, `kd_parameter`, `kd_unit`, `Nomor`, `nama_parameter`, `kd_kpi`, `kpi_sub`, `bobot_pers`, `kode`) VALUES ('$nama_perspektif', '$kd_parameter', '$nama_unit', '$nomor_parameter', '$nama_parameter', '$kpi_bobot', '$sub_bobot', '$bobot_pers', '$kode_pri');";
					$data = mysqli_query($konek,$simpan);
					if($data >0)
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('data telah tersimpan');
						window.location.href='parameter.php';
						</script>";
					}
					else
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('data tidak tersimpan kode suudah ada');
						window.location.href='parameter.php';
						</script>";
					}
					}
					?>

				<br>



				<form action="" method="post">
					<strong>Tampilan Tabel</strong>
                        <div class="table-responsive">
                                <table class="table " border='1'>

                                    <thead>
                                        <tr>
                                        <th>No</th>
                                            <th>Kode Perspektif</th>
                                            <th>Kode Parameter</th>
                                           <th>Kode Unit</th>
                                           <th>Nomor Parameter</th>
                                           <th>Nama Parameter</th>
                                            <th>KPI Bobot</th>
                                            <th>SUB Bobot</th>
                                            <th>Bobot Perspektif</th>
                                            <th>Kode Primary</th>
                                       <th>Edit</th>
                                            <th>Hapus</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                          <?php
                          echo '<tr>';
							include '../config.php';
							$i=0;
							$query = "SELECT * FROM tbl_parameter";
							$hasil = mysqli_query($konek,$query);
							while($data = mysqli_fetch_array($hasil)){
								$i++;
							
					  		echo "<td class='txt-oflo'>".$i."</td>
					  			  <td class='txt-oflo'>".$data[0]."</td>
					  			  <td class='txt-oflo'>".$data[1]."</td>
					  			  <td class='txt-oflo'>".$data[2]."</td>
					  			  <td class='txt-oflo'>".$data[3]."</td>
					  			   <td class='txt-oflo'>".$data[4]."</td>
					  			   <td class='txt-oflo'>".$data[5]."</td>
					  			    <td class='txt-oflo'>".$data[6]."</td>
					  			    <td class='txt-oflo'>".$data[7]."</td>
					  			    <td class='txt-oflo'>".$data[8]."</td>
					  			  <td class='txt-oflo'><a class='btn btn-success' href='update_para.php?id=$data[8]'>Edit Data</a></td></a></td>
							      <td class='txt-oflo'><a class='btn btn-success' href='parameter.php?tombol=delete&id=$data[8]'>
							       Hapus Data</a></td>
                            </tr>";     
										
					}
					echo '</body>';
                    echo '</table>';
					
					?>
                                       
                        </div>
                    </div>
                </div>
        
                            
                       
                    </form>
					 </div>
					 </div>

						</div>
					</article>
					</div>
			</section>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="../user/js/jquery-1.11.1.min.js"></script>
	<script src="../user/js/bootstrap.min.js"></script>
	<script src="../user/js/chart.min.js"></script>
	<script src="../user/js/chart-data.js"></script>
	<script src="../user/js/easypiechart.js"></script>
	<script src="../user/js/easypiechart-data.js"></script>
	<script src="../user/js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
