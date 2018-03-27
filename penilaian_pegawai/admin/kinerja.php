
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User - Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
<?php
   if (! @$_GET['menu']) 
			@$_GET['menu']='nav menu';
   if (! @$_GET['guest']) 
			@$_GET['guest']='';			
?>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Sistem</span> Penilaian Kinerja</a>
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
			   <?php
							include '../config.php';
							$query = "SELECT * FROM tbl_unit";
							$hasil = mysqli_query($konek,$query);
							while($data = mysqli_fetch_row($hasil)){
                             echo"<li class=''><a href='kinerja.php?id_kategori=$data[0]'><svg class='glyph stroked open folder'><use xlink:href='#stroked-open-folder'/></svg></svg>$data[1]</a></li> ";
										}
					
					?>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12" style="margin-bottom: 10px;">
				
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
					<?php
                         

							
							include '../config.php';
							error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
					
							$query = "SELECT DISTINCT u.nama_unit FROM tbl_unit u, tbl_parameter p  where u.kd_unit=p.kd_unit and p.kd_unit=$_GET[id_kategori]";
							$hasil = mysqli_query($konek,$query);
							while($data = mysqli_fetch_array($hasil)){

					  		echo " $data[0] ";
					  		 
										}
					
			
					  
					?>

				</div>
				<form action="" method="post">
                        <div class="row">
                        	<div class="form-group col-lg-6">
                        <select name="nama_cab" onchange="this.form.submit();" class="form-control">
					<?php
											
							
							 
											
											
											$query = "SELECT DISTINCT k.kd_cabang, t.nm_kantor FROM  tbl_regist r, tbl_kinerja k, tbl_kantor t where t.kd_kantor=r.jabatan and r.jabatan=k.kd_cabang and k.kd_unit=$_GET[id_kategori]";
											$hasil = mysqli_query($konek,$query);
											echo "<option >Pilih Cabang</option>";
											while($data=mysqli_fetch_array($hasil)){

											if($_POST['nama_cab']==$data['kd_cabang'])
												{
												
											    echo "<option selected value=$data[kd_cabang]>$data[kd_cabang] - $data[nm_kantor]</option>";
											}
											else{

												 echo "<option value=$data[kd_cabang]>$data[kd_cabang] - $data[nm_kantor]</option>";
											}
											} 
											 echo "</select>";
											
										
											?>
										</div>
									</div>
			


		<?php

				
					
                if(isset($_POST['nama_cab'])) {  
                	

                	$cab = $_POST['nama_cab'];

                	$_GET['nama_cab']=$_POST['nama_cab'];
					echo "<div><a class='btn btn-success' target='_blank' href='cetak.php?nama_cab=$_GET[nama_cab]&id_kategori=$_GET[id_kategori]' >Download PDF</a>";
					echo "&nbsp;&nbsp;<a class='btn btn-success' target='_blank' href='laporan.php?nama_cab=$_GET[nama_cab]&id_kategori=$_GET[id_kategori]' >Excel Keseluruhan</a>";
					echo "&nbsp;&nbsp;<button type='submit' class='btn btn-success' name='delete'>Hapus Data</button></div>";  

					if (isset($_POST['delete'])){
						$perintah="DELETE FROM tbl_kinerja WHERE kd_unit=$_GET[id_kategori] and kd_cabang=$_GET[nama_cab]";
	  						 $hasil=mysqli_query($konek,$perintah);
	  						 if($hasil > 0){
	  						 echo"<script type='text/javascript' language='javascript'>
						alert('Data Berhasil didelete');
						window.location.href='kinerja.php?id_kategori=$_GET[id_kategori]';
						</script>";
					}
					}
 

					include '../config.php';
					error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
					 $cabang=$_POST['jabatan'];
					$regis ="select DISTINCT p.nama_perspektif, j.nama_parameter,k.target, k.realisasi, k.pencapaian, k.nilai, k.sub_bobot, k.sub_score, k.kpi_bobot, k.kpi_score,k.bobot_perspektif, k.total_score,j.Nomor, k.nrp,k.kd_parameter, w.nama from tbl_perspektif p, tbl_parameter j, tbl_kinerja k, tbl_regist r, tbl_kantor t, tbl_pegawai w where w.nrpp=k.nrp and t.kd_kantor=r.jabatan and r.jabatan=k.kd_cabang and p.kd_perspektif=j.kd_perspektif and k.kd_parameter=j.kd_parameter and j.kd_unit=k.kd_unit and j.kd_unit=$_GET[id_kategori] and k.kd_cabang='$cab' order by k.kd_cabang, k.nrp,j.kd_perspektif";



					
					$hasill=mysqli_query($konek,$regis);
					while($data = mysqli_fetch_array($hasill)){
						$m++;
				  
				
					if($data[kd_parameter]==1)
					{
						include '../config.php';
						error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

							echo" <div class='table-responsive'>
                                <table class=''>
                                    <tbody>";
                                    	
					
							$query = "SELECT DISTINCT u.nama_unit FROM tbl_unit u, tbl_parameter p  where u.kd_unit=p.kd_unit and p.kd_unit=$_GET[id_kategori]";
							$hasil = mysqli_query($konek,$query);
							$dataa = mysqli_fetch_array($hasil);

				   	    echo" 
                                    	<tr><td><strong>Unit Kerja        </strong></td>
                                    	<td>&nbsp;&nbsp; : &nbsp;&nbsp;".$dataa[0]."</td>
                                    	</tr";

                                   echo"
                                         <tr><br><td><strong>Nrpp  </strong></td>
                                    	<td>&nbsp;&nbsp; : &nbsp;&nbsp;".$data[nrp]."</td>
                                         </tr>";
 						
                                   
                                        echo "<tr><br><td><strong>Nama Pegawai  </strong></td>
                                    	<td>&nbsp;&nbsp; : &nbsp;&nbsp;".$data[nama]."</td>
                                         </tr>
                                        
                                    </tbody>
                        </table>
                                       
                        </div><br>
                        ";
                        echo "	
                        <div class='table-responsive'>
                                <table class='table' border='1' rules='cols' >
                                    <thead>
                                        <tr><th>PERSPEKTIF</th>
                                        <th>KPI PARAMETER</th>
                                        <th>TARGET</th>
                                        <th>REALISASI</th>
                                        <th>PENC (%)</th>
                                        <th>NILAI</th>
                                        <th>SUB BOBOT</th>
                                        <th>SUB SCORE</th>
                                        <th>KPI BOBOT</th>
                                        <th>KPI SCORE</th>
                                        <th>BOBOT PERS</th>
                                        <th>TOTAL</th>

                                        "
                                        ;


	                if( $data[Nomor]=='X') 	{	
						 echo "<tr>";
						echo "
							<td class='txt-oflo'>$data[0]</td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";
					  	}
					
					else if( $data[Nomor]=='J' || $data[Nomor]=='T' ) 	{	
						 echo "<tr bgcolor='#CCCCCC'>";
						echo "
							<td class='txt-oflo'></td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";
					  	}
					  	else if( $data[Nomor]=='A' || $data[Nomor]=='B' || $data[Nomor]=='C' || $data[Nomor]=='D' || $data[Nomor]=='E' ) 	{	
						 echo "<tr bgcolor='yellow'>";
						echo "
						    
							<td class='txt-oflo'></td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";
					  	}
					  	else
					  	{
					  		 echo "<tr bgcolor='white'>";
						echo "
						
							<td class='txt-oflo'></td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";

					}		
}
					else
					{
						
					
	                if( $data[Nomor]=='X') 	{	
						 echo "<tr>";
						echo "
							<td class='txt-oflo'>$data[0]</td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";
					  	}
					
					else if( $data[Nomor]=='J' || $data[Nomor]=='T' ) 	{	
						 echo "<tr bgcolor='#CCCCCC'>";
						echo "
							<td class='txt-oflo'></td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";
					  	}
					  	else if( $data[Nomor]=='A' || $data[Nomor]=='B' || $data[Nomor]=='C' || $data[Nomor]=='D' || $data[Nomor]=='E' ) 	{	
						 echo "<tr bgcolor='yellow'>";
						echo "
						    
							<td class='txt-oflo'></td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";
					  	}
					  	else
					  	{
					  		 echo "<tr bgcolor='white'>";
						echo "
						
							<td class='txt-oflo'></td>
					  		<td class='txt-oflo'>$data[1]</td>
					  		<td class='txt-oflo'>$data[2]</td>
					  		<td class='txt-oflo'>$data[3]</td>
					  		<td class='txt-oflo'>$data[4]%</td>
					  		<td class='txt-oflo'>$data[5]</td>
					  		<td class='txt-oflo'>$data[6]%</td>
					  		<td class='txt-oflo'>$data[7]</td>
					  		<td class='txt-oflo'>$data[8]%</td>
					  		<td class='txt-oflo'>$data[9]</td>
					  		<td class='txt-oflo'>$data[10]%</td>
						  	<td class='txt-oflo'>$data[11]</td>
					  		</tr>";

					  	}
							 		
}

					  		

					 
					
					  }
			
		}

			?>
										
						  
				
                        </div>
                         </form>
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

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
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
