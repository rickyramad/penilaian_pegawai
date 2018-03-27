
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
			header('location:kantor.php');
   }

   if ($_POST['tombol_update']=="Submit")
   {
	   $perintah="UPDATE tbl_kantor SET
	              kd_kantor='$_POST[kd_kantor]', nm_kantor='$_POST[nm_kantor]', tipe='$_POST[tipe]' ,parent='$_POST[parent]' WHERE kd_kantor='$_POST[kd_kantor]'
				  ";
	   $data =mysqli_query($konek,$perintah);
	    if($data >0)
					{
			           echo"<script type='text/javascript' language='javascript'>
						alert('data berhasil di update');
						window.location.href='kantor.php';
						</script>";
					}
					else
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('data tidak terupdate kode tidak bisa di ganti');
						window.location.href='kantor.php';
						</script>";
					}
   }



 if ($_GET['tombol']=="jadi_delete")
   {
       $perintah="DELETE FROM tbl_kantor
	              WHERE kd_kantor='$_GET[id]'";
	     $data =mysqli_query($konek,$perintah);
	   if($data >0)
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('data telah di hapus');
						window.location.href='kantor.php';
						</script>";
					}
					else
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('data tidak terhapus akibat relasi,  ->hapus data relasi');
						window.location.href='kantor.php';
						</script>";
					}
   }
 if ($_GET['tombol']=="delete")
   {
       echo "<script type='text/javascript'>
	         x=window.confirm('Apakah data mau dihapus');
			 if (x)
			     window.location.href='kantor.php?tombol=jadi_delete&id=$_GET[id]';
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
		
			<li class="active"><a href="kantor.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Kantor</a></li>
		
			<li class=""><a href="unit.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Unit</a></li>
	
			<li class=""><a href="perspektif.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Perspektif</a></li>
	
			<li class=""><a href="parameter.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tabel Parameter</a></li>

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
                        <div class="table-responsive">
                                <table class="" border ="1">
                                    <tbody>
                                        <tr><td><center><strong>Menu Pengisian</strong></td></tr>
                                    	<tr><td>Kode Kantor         </td>
                                    	<td><input placeholder="kode kantor" name="kd_kantor" class="form-control" type="text"></td></tr>
                                            <tr><br><td>Nama Kantor    </td>
                                    	<td><input placeholder="kantor"  name="nm_kantor" class="form-control" type="text">
                                    		</td></tr>
                                         </tr>
                                        <tr><br><td>Tipe    		  </td>
                                    	<td>
                                    		<select name="tipe"  class="form-control">
                                    	<?php
											include '../config.php';

											$query = "SELECT DISTINCT tipe FROM tbl_kantor";
											$hasil = mysqli_query($konek,$query);
											while($data=mysqli_fetch_array($hasil)){
											  echo "<option value=$data[tipe]> $data[tipe]</option>";
											}
			

											?></select></td></tr>
                                        	<tr><br><td>Parent    </td>
                                    	<td><input placeholder="parent"  name="parent" class="form-control" type="text">
                                    		</td></tr>
                                           <tr><td><center><button type="submit" class="btn btn-success" name="simpan">Simpan</button></td></tr>
                                    </tbody>
                        </table>
                                       
                        </div>
                    </div>
                </div>  
                 </form>
                    <?php
					include '../config.php';
					if(isset($_POST['simpan'])) {
					$kd	= $_POST['simpan'];
					$kd_kantor	= $_POST['kd_kantor'];
					$nm_kantor	= $_POST['nm_kantor'];
					$tipe	= $_POST['tipe'];
					$parent = $_POST['parent'];
					$simpan ="INSERT INTO `tbl_kantor` (`kd_kantor`, `nm_kantor`, `tipe`, `parent`) VALUES ('$kd_kantor', '$nm_kantor', '$tipe', '$parent');";
					$data = mysqli_query($konek,$simpan);
					if($data >0)
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('data telah tersimpan');
						window.location.href='kantor.php';
						</script>";
					}
					else
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('data tidak tersimpan kode sudah ada');
						window.location.href='kantor.php';
						</script>";
					}
					}

					?>



				<br>
				<form action="" method="post">
                       <strong>Tampilan Tabel</strong>
                        <div class="table-responsive">
                                <table class="table " border="1">

                                    <thead>
                                        <tr>
                                        <th>No</th>
                                            <th>Kode Kantor</th>
                                            <th>Kantor</th>
                                            <th>Tipe</th>
                                       <th>Parent</th>
                                       <th>Edit</th>
                                            <th>Hapus</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                          <?php
                          echo '<tr>';
							include '../config.php';
							$i=0;
							$query = "SELECT * FROM tbl_kantor";
							$hasil = mysqli_query($konek,$query);
							while($data = mysqli_fetch_array($hasil)){
								$i++;
							
					  		echo "<td class='txt-oflo'>".$i."</td>
					  			  <td class='txt-oflo'>".$data[0]."</td>
					  			  <td class='txt-oflo'>".$data[1]."</td>
					  			  <td class='txt-oflo'>".$data[2]."</td>
					  			  <td class='txt-oflo'>".$data[3]."</td>
					  			  <td class='txt-oflo'><a class='btn btn-success' href='update_kantor.php?id=$data[0]'>Edit Data</a></td>
							      <td class='txt-oflo'><a  class='btn btn-success' href='kantor.php?tombol=delete&id=$data[0]'>
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
