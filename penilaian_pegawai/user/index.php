
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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php include'session.php'; echo $_SESSION['nama']." (".$_SESSION['nama_jab']." )"; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../index.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Keluar</a></li>
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
                             echo"<li class=''><a href='index.php?id_kategori=$data[0]'><svg class='glyph stroked dashboard-dial'><use xlink:href='#stroked-dashboard-dial'></use></svg>$data[1]</a></li> ";
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

					  		echo "Pengisian $data[0] ";
					  		 
										}
					
			
					    echo $_SESSION['nama_cabang'];
					?>

				</div>
				<form action="" method="post">
                        <div class="row">
                            <div class="form-group col-lg-6">


                              
											<br>
											Isikan Data Yang perlu saja
                            </div>
                        	</div>	
                     <form action="" method="post">   		
                        <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                        	 <th>No</th>
                                        	 <th>Perspektif</th>
                                        	  <th>Nomor</th>
                                            <th>KPI Parameter</th>
                                            
                                            <th>Target</th>
                                            <th>Realisasi</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                   

             

					<?php
                          echo '<tr>';


						
							include '../config.php';
							error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
							$kd_perspektif	= $_POST['nama_perspektif'];
							$kd_perspektif	= $_POST['nama_perspektif'];
						
							$query = "select p.nama_perspektif,j.Nomor, j.nama_parameter,j.kd_parameter from tbl_perspektif p, tbl_parameter j where p.kd_perspektif=j.kd_perspektif and j.kd_unit=$_GET[id_kategori]";
							$hasil = mysqli_query($konek,$query);
							
							while($data = mysqli_fetch_array($hasil)){

							$i++;

                            
                            
                           
							
                        
					  		echo "<td class='txt-oflo'>".$i."</td>
					  		<td class='txt-oflo'>$data[nama_perspektif]</td>
					  		<td class='txt-oflo'>$data[Nomor]</td>
					  		<td class='txt-oflo'>$data[nama_parameter]</td>";
					  		 

					  		$kd_parameter=$data[kd_parameter];
					  		 
					  		
                  						
					 ?>
					  <td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='Target ' class='' name="target<?php echo $i ?>" >%</td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='Realisasi ' class='' name='realisasi<?php echo $i ?>'>%</td></tr> 
				     <?php
				 }
				
				
					echo '</body>';
                    echo '</table>';
					
				 ?>
										

				
					
<?php
                     include '../config.php';
					 if(isset($_POST['simpan'])) {
					error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
					for($r=1;$r<=$i;$r++){
					$nama	= $_POST['simpan'];
					$target	= $_POST['target'.$r];
					$realisasi= $_POST['realisasi'.$r];
					$pencapaian=($realisasi/$target)*100;
					$id = $kd_parameter;
					$nama	= $_POST['namalengkap'];
					$jabatan= $_POST['jabatan'];
					$password	= md5($_POST['password']);
					$regis ="INSERT INTO `tbl_kinerja` (`kd_parameter`, `kd_cabang`,`kd_unit`, `target`, `realisasi`, `pencapaian`, `nilai`, `sub_bobot`, `sub_score`, `kpi_bobot`, `kpi_score`, `bobot_perspektif`, `total_score`) VALUES ('$id',  '0', '$_GET[id_kategori]', '$target', '$realisasi', '$pencapaian', '0', '0', '0', '0', '0', '0', '0');";
					$hasil=mysqli_query($konek,$regis);
			}
			}
			 
			?>
					
						  <button type="submit" class="btn btn-success" name="simpan">Simpan</button>

						
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
