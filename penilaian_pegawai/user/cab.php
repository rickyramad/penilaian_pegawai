
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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php include'session.php'; echo $_SESSION['nama']." (".$_SESSION['nm_kantor']." )"; ?><span class="caret"></span></a>
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
                             echo"<li class=''><a href='cab.php?id_kategori=$data[0]'><svg class='glyph stroked open folder'><use xlink:href='#stroked-open-folder'/></svg></svg>$data[1]</a></li> ";
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
                       <button type="submit" class="btn btn-success" name="isi">Input</button>
             		<button type="submit" class="btn btn-success" name="tampil">Tampil</button>
             		

             		<br>
             		<br>

					<?php
					  if(isset($_POST['isi']) || isset($_POST['simpan'])) {
					    echo" 
					    		<strong>Isikan Data Yang perlu saja</strong>
					    		<br>
					    		<br>
                              
                                ";
                              
                                		 echo "<select name='pegawai' class='form-control'>";

											$query = "SELECT p.nrpp, p.nama FROM tbl_pegawai p, tbl_kantor k where p.kd_cabang=k.kd_kantor and p.kd_cabang='$_SESSION[jabatan]' or k.parent='$_SESSION[jabatan]' and p.kd_cabang=k.kd_kantor";
											$hasil = mysqli_query($konek,$query);
											echo "<option value='' class='active'>NRPP & nama</option>";
											  
											while($data=mysqli_fetch_array($hasil)){
											$_POST['pegawaii']=$data[nama];
											if($_POST['pegawai']==$data['nrpp'])
												{
											    echo "<option selected value=$data[nrpp]>$data[nrpp] - $data[nama]</option>";
											   
											}
											else{
												 echo "<option value=$data[nrpp]>$data[nrpp] - $data[nama]</option>";
												
											}
											 
											} 
											 echo "</select>";
											 $nrp=$_POST['pegawai']; 
											 
											              
				     
								  
                
						echo "		
                            </div>
                        	</div>	
                     <form action='' method='post'>   		
                        <div class='table-responsive'>
                                <table class='table' border='1'>
                                    <thead>
                                        <tr>
                                        	 <th>No</th>
                                        	 <th>Perspektif</th>
                                            <th>KPI Parameter</th>
                                            
                                            <th>Target</th>
                                            <th>Realisasi</th>
                                            <th>Nilai</th>
                                            <th>Score</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>";
                   
                          echo '<tr>';


						
							include '../config.php';
							error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
							$kd_perspektif	= $_POST['nama_perspektif'];
							$kd_perspektif	= $_POST['nama_perspektif'];
							$query = "select p.nama_perspektif,j.Nomor, j.nama_parameter,j.kd_parameter from tbl_perspektif p, tbl_parameter j where p.kd_perspektif=j.kd_perspektif and j.kd_unit=$_GET[id_kategori] order by j.kd_perspektif";
							$hasil = mysqli_query($konek,$query);
							
							while($data = mysqli_fetch_array($hasil)){

							$i++;
							
                            
                        if($data[Nomor]=='X') 	{
							
                            echo "<td class='txt-oflo'><strong>".$i."</td>";
					  		echo "<td class='txt-oflo'><strong>$data[nama_perspektif]</td>";
					  		echo "
					  		<td class='txt-oflo'>$data[nama_parameter]</td>";

					  		
					  		 
					  	}	
					  	else{
					  		echo "<td class='txt-oflo'>".$i."</td>";
					  		echo "<td class='txt-oflo'></td>";
					  		echo "
					  		<td class='txt-oflo'>$data[nama_parameter]</td>";
					  		
					  	} 

					  		
					  		 
					  	if($data[Nomor]=='A' || $data[Nomor]=='B' || $data[Nomor]=='C' || $data[Nomor]=='D' || $data[Nomor]=='E'
					  	|| $data[Nomor]=='J' || $data[Nomor]=='T' ) 	{

					  		echo "<td></td><td></td></tr>";

					  	}
					  	else if($_GET[id_kategori]==1 || $_GET[id_kategori]==2 || $_GET[id_kategori]==3){

					?>
					       <td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='Target ' class='' name="target<?php echo $i ?>" ></td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='Realisasi ' class='' name='realisasi<?php echo $i ?>'></td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='nilai ' class='' name="nilai<?php echo $i ?>" disabled></td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='score' class='' name="score<?php echo $i ?>" ></td></div></tr>
					<?php  		
					  	}
					  	else{
                  				
					 ?>
					  <td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='Target ' class='' name="target<?php echo $i ?>" >%</td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='Realisasi ' class='' name='realisasi<?php echo $i ?>'>%</td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='nilai ' class='' name="nilai<?php echo $i ?>"></td><td class='txt-oflo'><input title='Berbentuk Numerik' placeholder='score' class='' name="score<?php echo $i ?>" disabled></td></tr> 
				     <?php
				 }
				 }
				
				   echo "<td></td><td></td><td></td><td></td><td></td><td></td><td><center><button type='submit' class='btn btn-success' name='simpan'>Simpan</button></center><td>";
					echo '</body>';
                    echo '</table>';
					
					
					//input data
					 if(isset($_POST['simpan']) || isset($_POST['pegawai'])) {
					 include '../config.php';
					error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
					
					
					
					
					$loginn = mysqli_query($konek,"SELECT nrp from tbl_kinerja where kd_cabang=$_SESSION[jabatan]");
					$dataa = mysqli_fetch_array($loginn);
					if($dataa[0]==$_POST['pegawai'])
					{
					echo"<script type='text/javascript' language='javascript'>
						alert('data tidak masuk NRPP sama');
						window.location.href='cab.php?id_kategori=$_GET[id_kategori]';
						</script>";
					}
					else if($_POST['pegawai']=='')
					{
						echo"<script type='text/javascript' language='javascript'>
						alert('NRPP tidak boleh kosong');
						window.location.href='cab.php?id_kategori=$_GET[id_kategori]';
						</script>";
					}
					
				
				else if($dataa[0]!=$_POST['pegawai']){
					for($r=1;$r<=$i;$r++){
					$login = mysqli_query($konek,"SELECT kpi_sub, kd_kpi, bobot_pers FROM tbl_parameter  WHERE kd_unit='$_GET[id_kategori]' and kd_parameter='$r'");
					$data = mysqli_fetch_array($login);
					$kpi_sub=$data[0];
					$kd_kpi=$data[1];
					$bobot_pers=$data[2];
					$nama	= $_POST['simpan'];
					$target	= $_POST['target'.$r];
					$realisasi= $_POST['realisasi'.$r];
					$nilai= $_POST['nilai'.$r];
					$score= $_POST['score'.$r];
					$pencapaian=0;
					$id = $r;
					$kpi_score=0;
					$total_score=0;

					//cleaning
					if($_GET[id_kategori]==1)
					{
						//customer
						if($id==1)
						{
							$kpi_score1=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score1;
							$kd_kpi1=$data[1];
							$kd_kpi=$kd_kpi1;
						}
						else if($id==2)
						{
							$kpi_score2=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score2;
							$kd_kpi2=$data[1];
							$kd_kpi=$kd_kpi2;
						}
						else if($id==3)
						{
							$kpi_score3=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score3;
							$kd_kpi3=$data[1];
							$kd_kpi=$kd_kpi3;
						}
						else if($id==4)
						{
							$kpi_score4=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score4;
							$kd_kpi4=$data[1];
							$kd_kpi=$kd_kpi4;
						}
						else if($id==5)
						{
							$kpi_score5=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score5;
							$kd_kpi5=$data[1];
							$kd_kpi=$kd_kpi5;
						}
						//jumlah dari yang diatas
						else if($id==7)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3+$kd_kpi4+$kd_kpi5;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3+$kpi_score4+$kpi_score5;
							$bobot_pers7=$data[2];
							$total_score7=($kpi_score*$bobot_pers7)/100;
							$total_score=$total_score7;

						}
						else if($id==8)
						{
							$kpi_score8=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score8;
							$kd_kpi8=$data[1];
							$kd_kpi=$kd_kpi8;
						}
						else if($id==9)
						{
							$kpi_score9=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score9;
							$kd_kpi9=$data[1];
							$kd_kpi=$kd_kpi9;
						}
						else if($id==10)
						{
							$kpi_score10=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score10;
							$kd_kpi10=$data[1];
							$kd_kpi=$kd_kpi10;
						}
						//jumlah dari yang diatas
						else if($id==11)
						{
							$kd_kpi=$kd_kpi8+$kd_kpi9+$kd_kpi10;
							$kpi_score=$kpi_score8+$kpi_score9+$kpi_score10;
							$bobot_pers11=$data[2];
							$total_score11=($kpi_score*$bobot_pers11)/100;
							$total_score=$total_score11;

						}
						else if($id==12)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							
							$score12=($nilai*$kpi_sub)/100;
							$score=$score12;

						}
						else if($id==13)
						{
							$score=$score12;
							$kpi_score13=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score13;
							$kd_kpi13=$data[1];
							$kd_kpi=$kd_kpi13;

						}
						else if($id==14)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score14=($nilai*$kpi_sub)/100;
								$score=$score14;

						}
						else if($id==15)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score15=($nilai*$kpi_sub)/100;
								$score=$score15;

							

						}
							else if($id==16)
						{
							$score=$score14+$score15;
							$kpi_score16=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score16;
							$kd_kpi16=$data[1];
							$kd_kpi=$kd_kpi16;

						}
						else if($id==17)
						{
							
							$kd_kpi17=$data[1];
							$kpi_score17=($nilai*$kd_kpi17)/100;
							$kpi_score=$kpi_score17;


						}
						else if($id==18)
						{
							$kd_kpi18=$data[1];
							$kpi_score18=($nilai*$kd_kpi18)/100;
							$kpi_score=$kpi_score18;

						}
						//jumlah dari yang diatas
						else if($id==19)
						{
							$kd_kpi=$kd_kpi13+$kd_kpi16;
							$kpi_score=$kpi_score17+$kpi_score18+$kpi_score13+$kpi_score16;
							$bobot_pers18=$data[2];
							$total_score18=($kpi_score*$bobot_pers18)/100;
							$total_score=$total_score18;

						}
						//total
						else if($id==20)
						{
							$bobot_pers=$bobot_pers7+$bobot_pers18+$bobot_pers11;
							$total_score=$total_score7+$total_score11+$total_score18;

						}
						
						
					}

					//sopir
					else if($_GET[id_kategori]==2){
						//custumer
						if($id==1)
						{
							$kpi_score1=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score1;
							$kd_kpi1=$data[1];
							$kd_kpi=$kd_kpi1;
						}
						else if($id==2)
						{
							$kpi_score2=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score2;
							$kd_kpi2=$data[1];
							$kd_kpi=$kd_kpi2;
						}
						else if($id==3)
						{
							$kpi_score3=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score3;
							$kd_kpi3=$data[1];
							$kd_kpi=$kd_kpi3;
						}
						else if($id==4)
						{
							$kpi_score4=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score4;
							$kd_kpi4=$data[1];
							$kd_kpi=$kd_kpi4;
						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3+$kd_kpi4;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3+$kpi_score4;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;

						}
						else if($id==7)
						{
							$kpi_score7=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score7;
							$kd_kpi7=$data[1];
							$kd_kpi=$kd_kpi7;
						}
						else if($id==8)
						{
							$kpi_score8=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score8;
							$kd_kpi8=$data[1];
							$kd_kpi=$kd_kpi8;
						}
						//jumlah dari yang diatas
						else if($id==9)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8;
							$kpi_score=$kpi_score7+$kpi_score8;
							$bobot_pers9=$data[2];
							$total_score9=($kpi_score*$bobot_pers9)/100;
							$total_score=$total_score9;

						}
						else if($id==10)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score10=($nilai*$kpi_sub)/100;
							$score=$score10;

						}
						else if($id==11)
						{
							$score=$score10;
							$kpi_score11=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score11;
							$kd_kpi11=$data[1];
							$kd_kpi=$kd_kpi11;

						}
						else if($id==12)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score12=($nilai*$kpi_sub)/100;
								$score=$score12;

						}
						else if($id==13)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score13=($nilai*$kpi_sub)/100;
								$score=$score13;

							

						}
							else if($id==14)
						{
							$score=$score12+$score13;
							$kpi_score14=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score14;
							$kd_kpi14=$data[1];
							$kd_kpi=$kd_kpi14;

						}
						else if($id==15)
						{
							
							$kd_kpi15=$data[1];
							$kpi_score15=($nilai*$kd_kpi15)/100;
							$kpi_score=$kpi_score15;


						}
						else if($id==16)
						{
							$kd_kpi16=$data[1];
							$kpi_score16=($nilai*$kd_kpi16)/100;
							$kpi_score=$kpi_score16;

						}
						//jumlah dari yang diatas
						else if($id==17)
						{
							$kd_kpi=$kd_kpi11+$kd_kpi14;
							$kpi_score=$kpi_score11+$kpi_score14+$kpi_score15+$kpi_score16;
							$bobot_pers17=$data[2];
							$total_score17=($kpi_score*$bobot_pers17)/100;
							$total_score=$total_score17;

						}
						//total
						else if($id==18)
						{
							$bobot_pers=$bobot_pers6+$bobot_pers9+$bobot_pers17;
							$total_score=$total_score6+$total_score9+$total_score17;

						}

					}

					//satpam
					else if($_GET[id_kategori]==3){
						//custumer
						if($id==1)
						{
							$kpi_score1=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score1;
							$kd_kpi1=$data[1];
							$kd_kpi=$kd_kpi1;
						}
						else if($id==2)
						{
							$kpi_score2=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score2;
							$kd_kpi2=$data[1];
							$kd_kpi=$kd_kpi2;
						}
						else if($id==3)
						{
							$kpi_score3=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score3;
							$kd_kpi3=$data[1];
							$kd_kpi=$kd_kpi3;
						}
						else if($id==4)
						{
							$kpi_score4=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score4;
							$kd_kpi4=$data[1];
							$kd_kpi=$kd_kpi4;
						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3+$kd_kpi4;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3+$kpi_score4;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;

						}
						//internal proses
						else if($id==7)
						{
							$kpi_score7=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score7;
							$kd_kpi7=$data[1];
							$kd_kpi=$kd_kpi7;
						}
						else if($id==8)
						{
							$kpi_score8=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score8;
							$kd_kpi8=$data[1];
							$kd_kpi=$kd_kpi8;
						}
						else if($id==9)
						{
							$kpi_score9=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score9;
							$kd_kpi9=$data[1];
							$kd_kpi=$kd_kpi9;
						}
						//jumlah dari yang diatas
						else if($id==10)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8+$kd_kpi9;
							$kpi_score=$kpi_score7+$kpi_score8+$kpi_score9;
							$bobot_pers10=$data[2];
							$total_score10=($kpi_score*$bobot_pers10)/100;
							$total_score=$total_score10;

						}
						//learning & growth
						else if($id==11)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;

						}
						else if($id==12)
						{
							$score=$score11;
							$kpi_score12=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score12;
							$kd_kpi12=$data[1];
							$kd_kpi=$kd_kpi12;

						}
						else if($id==13)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score13=($nilai*$kpi_sub)/100;
								$score=$score13;

						}
						else if($id==14)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score14=($nilai*$kpi_sub)/100;
								$score=$score14;

							

						}
							else if($id==15)
						{
							$score=$score13+$score14;
							$kpi_score15=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score15;
							$kd_kpi15=$data[1];
							$kd_kpi=$kd_kpi15;

						}
						else if($id==16)
						{
							
							$kd_kpi16=$data[1];
							$kpi_score16=($nilai*$kd_kpi16)/100;
							$kpi_score=$kpi_score16;


						}
						else if($id==17)
						{
							$kd_kpi17=$data[1];
							$kpi_score17=($nilai*$kd_kpi17)/100;
							$kpi_score=$kpi_score17;

						}
						//jumlah dari yang diatas
						else if($id==18)
						{
							$kd_kpi=$kd_kpi12+$kd_kpi15;
							$kpi_score=$kpi_score12+$kpi_score15+$kpi_score16+$kpi_score17;
							$bobot_pers18=$data[2];
							$total_score18=($kpi_score*$bobot_pers18)/100;
							$total_score=$total_score18;

						}
						//total
						else if($id==19)
						{
							$bobot_pers=$bobot_pers7+$bobot_pers10+$bobot_pers18;
							$total_score=$total_score7+$total_score10+$total_score18;

						}
					}

					//kepala kas
					else if($_GET[id_kategori]==4)
					{
						//financial
						if($id==1)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0 && $target==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi1=$data[1];
							$kd_kpi=$kd_kpi1;
							$kpi_score1=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score1;
							
						}
						else if($id==2)
						{
							if($pencapaian<4)
							{
								$nilai=100;
							}
							else if($pencapaian>=4 && $pencapaian<7)
							{
								$nilai=90;
							}
							else if($pencapaian>=7 && $pencapaian<10)
							{
								$nilai=80;
							}
							else if($pencapaian>=10 && $pencapaian<14)
							{
								$nilai=70;
							}
							else if($pencapaian>=14 && $pencapaian<17)
							{
								$nilai=60;
							}
							else if($pencapaian>=17 && $pencapaian<20)
							{
								$nilai=50;
							}
							else
							{
								$nilai=0;
							}
							$kd_kpi2=$data[1];
							$kd_kpi=$kd_kpi2;
							$kpi_score2=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score2;
						}

						else if($id==3)
						{
							if($pencapaian<4)
							{
								$nilai=100;
							}
							else if($pencapaian>=4 && $pencapaian<7)
							{
								$nilai=90;
							}
							else if($pencapaian>=7 && $pencapaian<10)
							{
								$nilai=80;
							}
							else if($pencapaian>=10 && $pencapaian<14)
							{
								$nilai=70;
							}
							else if($pencapaian>=14 && $pencapaian<17)
							{
								$nilai=60;
							}
							else if($pencapaian>=17 && $pencapaian<20)
							{
								$nilai=50;
							}
							else
							{
								$nilai=0;
							}
							$kd_kpi3=$data[1];
							$kd_kpi=$kd_kpi3;
							$kpi_score3=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score3;
						}
						//jumlah dari yang diatas
						else if($id==4)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3;
							$bobot_pers4=$data[2];
							$total_score4=($kpi_score*$bobot_pers4)/100;
							$total_score=$total_score4;

						}
						//customer
						else if($id==5)
						{
							$kd_kpi5=$data[1];
							$kd_kpi=$kd_kpi5;
							$kpi_score5=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score5;

						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi5;
							$kpi_score=$kpi_score5;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;
						}
						//internal proses
						else if($id==7)
						{
							if($realisasi<1)
							{
								$nilai=100;
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=90;
							}
							else if($realisasi>=4 && $realisasi<7)
							{
								$nilai=70;
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=60;
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=50;
							}
							else
							{
								$nilai=30;
							}
							$kd_kpi7=$data[1];
							$kd_kpi=$kd_kpi7;
							$kpi_score7=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score7;
						}
						else if($id==8)
						{
							if($realisasi<1)
							{
								$nilai=100;
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=90;
							}
							else if($realisasi>=4 && $realisasi<7)
							{
								$nilai=70;
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=60;
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=50;
							}
							else
							{
								$nilai=30;
							}
							$kd_kpi8=$data[1];
							$kd_kpi=$kd_kpi8;
							$kpi_score8=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score8;
						}
						else if($id==9)
						{
							$kd_kpi9=$data[1];
							$kd_kpi=$kd_kpi9;
							$kpi_score9=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score9;
						}
						//jumlah dari yang diatas
						else if($id==10)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8+$kd_kpi9;
							$kpi_score=$kpi_score7+$kpi_score8+$kpi_score9;
							$bobot_pers10=$data[2];
							$total_score10=($kpi_score*$bobot_pers10)/100;
							$total_score=$total_score10;
						}
						//learning & growth
						else if($id==11)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;

						}
						else if($id==12)
						{
							$score=$score11;
							$kpi_score12=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score12;
							$kd_kpi12=$data[1];
							$kd_kpi=$kd_kpi12;

						}
						else if($id==13)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score13=($nilai*$kpi_sub)/100;
								$score=$score13;

						}
						else if($id==14)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score14=($nilai*$kpi_sub)/100;
								$score=$score14;

							

						}
						else if($id==15)
						{
							$score=$score13+$score14;
							$kpi_score15=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score15;
							$kd_kpi15=$data[1];
							$kd_kpi=$kd_kpi15;

						}
						else if($id==16)
						{
							
							$score16=($nilai*$kpi_sub)/100;
							$score=$score16;


						}
						else if($id==17)
						{
							$score17=($nilai*$kpi_sub)/100;
							$score=$score17;

						}
						else if($id==18)
						{
							$score=$score16+$score17;
							$kpi_score18=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score18;
							$kd_kpi18=$data[1];
							$kd_kpi=$kd_kpi18;

						}
						//jumlah dari yang diatas
						else if($id==19)
						{
							$kd_kpi=$kd_kpi12+$kd_kpi15+$kd_kpi18;
							$kpi_score=$kpi_score12+$kpi_score15+$kpi_score18;
							$bobot_pers19=$data[2];
							$total_score19=($kpi_score*$bobot_pers19)/100;
							$total_score=$total_score19;

						}
						//total
						else if($id==20)
						{
							$bobot_pers=$bobot_pers4+$bobot_pers6+$bobot_pers10+$bobot_pers19;
							$total_score=$total_score4+$total_score6+$total_score10+$total_score19;

						}
					}

					//analis dan admin
					else if($_GET[id_kategori]==5)
					{
						//financial
						if($id==1)
						{
							$kd_kpi1=$data[1];
							$kd_kpi=$kd_kpi1;
							$kpi_score1=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score1;
						}
						//jumlah dari yang diatas
						else if($id==2)
						{
							$kd_kpi=$kd_kpi1;
							$kpi_score=$kpi_score1;
							$bobot_pers2=$data[2];
							$total_score2=($kpi_score*$bobot_pers2)/100;
							$total_score=$total_score2;

						}
						//internal proses
						else if($id==3)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi3=$data[1];
							$kd_kpi=$kd_kpi3;
							$kpi_score3=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score3;
						}
						else if($id==4)
						{
							if($realisasi<5)
							{
								$nilai=70;
							}
							else if($realisasi>=5 && $realisasi<10)
							{
								$nilai=90;
							}
							else
							{
								$nilai=100;
							}
							$kd_kpi4=$data[1];
							$kd_kpi=$kd_kpi4;
							$kpi_score4=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score4;
						}
						else if($id==5)
						{
							if($realisasi<1)
							{
								$nilai=100;
							}
							else if($realisasi>=1 && $realisasi<2)
							{
								$nilai=80;
							}
							else if($realisasi>=2 && $realisasi<3)
							{
								$nilai=60;
							}
							else if($realisasi>=3 && $realisasi<4)
							{
								$nilai=40;
							}
							else if($realisasi>=4 && $realisasi<5)
							{
								$nilai=30;
							}
							else
							{
								$nilai=0;
							}
							$score5=($nilai*$kpi_sub)/100;
							$score=$score5;
						}

						else if($id==6)
						{
							if($realisasi<1)
							{
								$nilai=100;
							}
							else if($realisasi>=1 && $realisasi<2)
							{
								$nilai=80;
							}
							else if($realisasi>=2 && $realisasi<3)
							{
								$nilai=60;
							}
							else if($realisasi>=3 && $realisasi<4)
							{
								$nilai=40;
							}
							else if($realisasi>=4 && $realisasi<5)
							{
								$nilai=30;
							}
							else
							{
								$nilai=0;
							}
							$score6=($nilai*$kpi_sub)/100;
							$score=$score6;
						}
						else if($id==7)
						{
							$score=$score5+$score6;
							$kpi_score7=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score7;
							$kd_kpi7=$data[1];
							$kd_kpi=$kd_kpi17;
						}
						else if($id==8)
						{
							$nilai=($realisasi*100)/100;
							$kd_kpi8=$data[1];
							$kd_kpi=$kd_kpi8;
							$kpi_score8=($nilai*$kd_kpi)/100;
							$kpi_score=$kpi_score8;
						}
						//jumlah dari yang diatas
						else if($id==9)
						{
							$kd_kpi=$kd_kpi3+$kd_kpi4+$kd_kpi7+$kd_kpi8;
							$kpi_score=$kpi_score3+$kpi_score4+$kpi_score7+$kpi_score8;
							$bobot_pers9=$data[2];
							$total_score9=($kpi_score*$bobot_pers9)/100;
							$total_score=$total_score9;

						}
						//learning & growth
						else if($id==10)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score10=($nilai*$kpi_sub)/100;
							$score=$score10;

						}
						else if($id==11)
						{
							$score=$score10;
							$kpi_score11=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score11;
							$kd_kpi11=$data[1];
							$kd_kpi=$kd_kpi11;

						}
						else if($id==12)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score12=($nilai*$kpi_sub)/100;
								$score=$score12;

						}
						else if($id==13)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score13=($nilai*$kpi_sub)/100;
								$score=$score13;

							

						}
						else if($id==14)
						{
							$score=$score12+$score13;
							$kpi_score14=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score14;
							$kd_kpi14=$data[1];
							$kd_kpi=$kd_kpi14;

						}
						else if($id==15)
						{
							
							$score15=($nilai*$kpi_sub)/100;
							$score=$score15;


						}
						else if($id==16)
						{
							$score16=($nilai*$kpi_sub)/100;
							$score=$score16;

						}
						else if($id==17)
						{
							$score=$score15+$score16;
							$kpi_score17=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score17;
							$kd_kpi17=$data[1];
							$kd_kpi=$kd_kpi17;

						}
						//jumlah dari yang diatas
						else if($id==18)
						{
							$kd_kpi=$kd_kpi11+$kd_kpi14+$kd_kpi17;
							$kpi_score=$kpi_score11+$kpi_score14+$kpi_score17;
							$bobot_pers18=$data[2];
							$total_score18=($kpi_score*$bobot_pers18)/100;
							$total_score=$total_score18;

						}
						//total
						else if($id==19)
						{
							$bobot_pers=$bobot_pers2+$bobot_pers9+$bobot_pers18;
							$total_score=$total_score2+$total_score9+$total_score18;

						}
					}

					//kabag pemasaran
					else if($_GET[id_kategori]==6)
					{
						//financial
						if($id==1)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score1=($nilai*$kpi_sub)/100;
							$score=$score1;

						}
						else if($id==2)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<1.5)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=1.5 && $realisasi<2 )
							{
								$nilai=round(80,1);
								
							}
							else if($realisasi>=2 && $realisasi<2.5)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=2.5 && $realisasi<3)
							{
								$nilai=round(60,1);
								
							}
								else if($realisasi>=3 && $realisasi<4)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=4 && $realisasi<4.5)
							{
								$nilai=round(40,1);
								
							}
							else if($realisasi>=4.5)
							{
								$nilai=round(0,1);
								
							}
							$score2=($nilai*$kpi_sub)/100;
							$score=$score2;

						}
						else if($id==3)
						{
							$score3=($nilai*$kpi_sub)/100;
							$score=$score3;
						}
						else if($id==4)
						{
							$score=$score1+$score2+$score3;
							$kpi_score4=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score4;
							$kd_kpi4=$data[1];
							$kd_kpi=$kd_kpi4;
						}
						else if($id==5)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>=$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score5=($nilai*$kpi_sub)/100;
							$score=$score5;
						}
						else if($id==6)
						{
							$score=$score5;
							$kpi_score6=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score6;
							$kd_kpi6=$data[1];
							$kd_kpi=$kd_kpi6;	
						}
						//jumlah dari yang diatas
						else if($id==7)
						{
							$kd_kpi=$kd_kpi4+$kd_kpi6;
							$kpi_score=$kpi_score4+$kpi_score6;
							$bobot_pers7=$data[2];
							$total_score7=($kpi_score*$bobot_pers7)/100;
							$total_score=$total_score7;
						}
						else if($id==8)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score8=($nilai*$kpi_sub)/100;
							$score=$score8;
						}
						else if($id==9)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score9=($nilai*$kpi_sub)/100;
							$score=$score9;
						}
						else if($id==10)
						{
							$score=$score8+$score9;
							$kpi_score10=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score10;
							$kd_kpi10=$data[1];
							$kd_kpi=$kd_kpi10;		
						}
						else if($id==11)
						{
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;
						}
						else if($id==12)
						{
							$score12=($nilai*$kpi_sub)/100;
							$score=$score12;
						}
						else if($id==13)
						{
							$score11=($nilai*$kpi_sub)/100;
							$score=$score13;
						}
						else if($id==14)
						{
							$score11=($nilai*$kpi_sub)/100;
							$score=$score14;
						}
						else if($id==15)
						{
							$score=$score11+$score12+$score13+$score14;
							$kpi_score15=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score15;
							$kd_kpi15=$data[1];
							$kd_kpi=$kd_kpi15;	
						}
						//jumlah dari yang diatas
						else if($id==16)
						{
							$kd_kpi=$kd_kpi10+$kd_kpi15;
							$kpi_score=$kpi_score10+$kpi_score15;
							$bobot_pers16=$data[2];
							$total_score16=($kpi_score*$bobot_pers16)/100;
							$total_score=$total_score16;
						}
						//internal proses
						else if($id==17)
						{
							$kd_kpi17=$data[1];
							$kpi_score17=($nilai*$kd_kpi17)/100;
							$kpi_score=$kpi_score17;
						}
						else if($id==18)
						{
							$score18=($nilai*$kpi_sub)/100;
							$score=$score18;
						}
						else if($id==19)
						{
							$score19=($nilai*$kpi_sub)/100;
							$score=$score19;
						}
						else if($id==20)
						{
							$score=$score18+$score19;
							$kpi_score20=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score20;
							$kd_kpi20=$data[1];
							$kd_kpi=$kd_kpi20;	
						}
						else if($id==21)
						{
							$kd_kpi21=$data[1];
							$kpi_score21=($nilai*$kd_kpi17)/100;
							$kpi_score=$kpi_score21;
						}
						else if($id==22)
						{
							$kd_kpi22=$data[1];
							$kpi_score22=($nilai*$kd_kpi22)/100;
							$kpi_score=$kpi_score22;
						}
						//jumlah dari yang diatas
						else if($id==23)
						{
							$kd_kpi=$kd_kpi17+$kd_kpi20+$kd_kpi21+$kd_kpi22;
							$kpi_score=$kpi_score10+$kpi_score15;
							$bobot_pers23=$data[2];
							$total_score23=($kpi_score*$bobot_pers23)/100;
							$total_score=$total_score23;
						}

						//learning & growth
						else if($id==24)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score24=($nilai*$kpi_sub)/100;
							$score=$score24;

						}
						else if($id==25)
						{
							$score=$score24;
							$kpi_score25=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score25;
							$kd_kpi25=$data[1];
							$kd_kpi=$kd_kpi25;

						}
						else if($id==26)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score26=($nilai*$kpi_sub)/100;
								$score=$score26;

						}
						else if($id==27)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score27=($nilai*$kpi_sub)/100;
								$score=$score27;

							

						}
						else if($id==28)
						{
							$score=$score26+$score27;
							$kpi_score28=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score28;
							$kd_kpi28=$data[1];
							$kd_kpi=$kd_kpi28;

						}
						else if($id==29)
						{
							
							$score29=($nilai*$kpi_sub)/100;
							$score=$score29;


						}
						else if($id==30)
						{
							$score30=($nilai*$kpi_sub)/100;
							$score=$score30;

						}
						else if($id==31)
						{
							$score=$score29+$score30;
							$kpi_score31=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score31;
							$kd_kpi31=$data[1];
							$kd_kpi=$kd_kpi31;

						}
						//jumlah dari yang diatas
						else if($id==32)
						{
							$kd_kpi=$kd_kpi25+$kd_kpi28+$kd_kpi31;
							$kpi_score=$kpi_score25+$kpi_score28+$kpi_score31;
							$bobot_pers32=$data[2];
							$total_score32=($kpi_score*$bobot_pers32)/100;
							$total_score=$total_score32;

						}
						//total
						else if($id==33)
						{
							$bobot_pers=$bobot_pers7+$bobot_pers16+$bobot_pers23+$bobot_pers32;
							$total_score=$total_score7+$total_score16+$total_score23+$total_score32;

						}
					}

					//kabag operasional
					else if($_GET[id_kategori]==7)
					{
						//customer
						if($id==3)
						{
							$score3=($nilai*$kpi_sub)/100;
							$score=$score3;
						}
						else if($id==4)
						{
							$score4=($nilai*$kpi_sub)/100;
							$score=$score4;
						}
						else if($id==5)
						{
							$score5=($nilai*$kpi_sub)/100;
							$score=$score5;
						}
						else if($id==6)
						{
							$score6=($nilai*$kpi_sub)/100;
							$score=$score6;
						}
						else if($id==7)
						{
							$score7=($nilai*$kpi_sub)/100;
							$score=$score7;
						}
						else if($id==8)
						{
							$score=$score3+$score4+$score5+$score6+$score7;
							$kpi_score8=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score8;
							$kd_kpi8=$data[1];
							$kd_kpi=$kd_kpi8;

						}
						//jumlah dari yang diatas
						else if($id==9)
						{
							$kd_kpi=$kd_kpi8;
							$kpi_score=$kpi_score8;
							$bobot_pers9=$data[2];
							$total_score9=($kpi_score*$bobot_pers9)/100;
							$total_score=$total_score9;

						}
						//internal proses
						else if($id==10)
						{
							$kd_kpi10=$data[1];
							$kpi_score10=($nilai*$kd_kpi10)/100;
							$kpi_score=$kpi_score10;
						}
						else if($id==11)
						{
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;
						}
						else if($id==12)
						{
							$score12=($nilai*$kpi_sub)/100;
							$score=$score12;
						}
						else if($id==13)
						{
							$score=$score11+$score12;
							$kpi_score13=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score13;
							$kd_kpi13=$data[1];
							$kd_kpi=$kd_kpi13;
						}
						else if($id==14)
						{
							$score14=($nilai*$kpi_sub)/100;
							$score=$score14;
						}
						else if($id==15)
						{
							$score15=($nilai*$kpi_sub)/100;
							$score=$score15;
						}
						else if($id==16)
						{
							$score=$score14+$score15;
							$kpi_score16=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score16;
							$kd_kpi16=$data[1];
							$kd_kpi=$kd_kpi16;
						}
						else if($id==17)
						{
							$kd_kpi17=$data[1];
							$kpi_score17=($nilai*$kd_kpi17)/100;
							$kpi_score=$kpi_score17;
						}
						else if($id==18)
						{
							$kd_kpi18=$data[1];
							$kpi_score18=($nilai*$kd_kpi18)/100;
							$kpi_score=$kpi_score18;
						}
						//jumlah dari yang diatas
						else if($id==19)
						{
							$kd_kpi=$kd_kpi10+$kd_kpi13+$kd_kpi16+$kd_kpi17+$kd_kpi18;
							$kpi_score=$kpi_score10+$kpi_score13+$kpi_score16+$kpi_score17+$kpi_score18;
							$bobot_pers19=$data[2];
							$total_score19=($kpi_score*$bobot_pers19)/100;
							$total_score=$total_score19;

						}

						//learning & growth
						else if($id==20)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score20=($nilai*$kpi_sub)/100;
							$score=$score20;

						}
						else if($id==21)
						{
							$score=$score20;
							$kpi_score21=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score21;
							$kd_kpi21=$data[1];
							$kd_kpi=$kd_kpi21;

						}
						else if($id==22)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score22=($nilai*$kpi_sub)/100;
								$score=$score22;

						}
						else if($id==23)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score23=($nilai*$kpi_sub)/100;
								$score=$score23;

						}
						else if($id==24)
						{
							$score=$score22+$score23;
							$kpi_score24=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score24;
							$kd_kpi24=$data[1];
							$kd_kpi=$kd_kpi24;

						}
						else if($id==25)
						{
							
							$score25=($nilai*$kpi_sub)/100;
							$score=$score25;


						}
						else if($id==26)
						{
							$score26=($nilai*$kpi_sub)/100;
							$score=$score26;

						}
						else if($id==27)
						{
							$score=$score25+$score26;
							$kpi_score27=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score27;
							$kd_kpi27=$data[1];
							$kd_kpi=$kd_kpi27;

						}
						//jumlah dari yang diatas
						else if($id==28)
						{
							$kd_kpi=$kd_kpi21+$kd_kpi24+$kd_kpi27;
							$kpi_score=$kpi_score21+$kpi_score24+$kpi_score27;
							$bobot_pers28=$data[2];
							$total_score28=($kpi_score*$bobot_pers28)/100;
							$total_score=$total_score28;

						}
						//total
						else if($id==29)
						{
							$bobot_pers=$bobot_pers9+$bobot_pers19+$bobot_pers28;
							$total_score=$total_score9+$total_score19+$total_score28;

						}
					}

					//AO funding
					else if($_GET[id_kategori]==8)
					{
						//financial
						if($id==1)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						//jumlah dari yang diatas
						else if($id==2)
						{
							$kd_kpi=$kd_kpi1;
							$kpi_score=$kpi_score1;
							$bobot_pers2=$data[2];
							$total_score2=($kpi_score*$bobot_pers2)/100;
							$total_score=$total_score2;

						}
						//customer
						else if($id==3)
						{
							$kd_kpi3=$data[1];
							$kpi_score3=($nilai*$kd_kpi3)/100;
							$kpi_score=$kpi_score3;
						}
						else if($id==4)
						{
							$kd_kpi4=$data[1];
							$kpi_score4=($nilai*$kd_kpi4)/100;
							$kpi_score=$kpi_score4;
						}
						else if($id==5)
						{
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi3+$kd_kpi4+$kd_kpi5;
							$kpi_score=$kpi_score3+$kpi_score4+$kpi_score5;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;
						}
						//internal proses
						else if($id==7)
						{
							$kd_kpi7=$data[1];
							$kpi_score7=($nilai*$kd_kpi7)/100;
							$kpi_score=$kpi_score7;
						}
						else if($id==8)
						{
							$kd_kpi8=$data[1];
							$kpi_score8=($nilai*$kd_kpi8)/100;
							$kpi_score=$kpi_score8;
						}
						else if($id==9)
						{
							$kd_kpi9=$data[1];
							$kpi_score9=($nilai*$kd_kpi9)/100;
							$kpi_score=$kpi_score9;
						}
						else if($id==10)
						{
							$kd_kpi10=$data[1];
							$kpi_score10=($nilai*$kd_kpi10)/100;
							$kpi_score=$kpi_score10;
						}
						//jumlah dari yang diatas
						else if($id==11)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8+$kd_kpi9+$kd_kpi10;
							$kpi_score=$kpi_score7+$kpi_score8+$kpi_score9+$kpi_score10;
							$bobot_pers11=$data[2];
							$total_score11=($kpi_score*$bobot_pers11)/100;
							$total_score=$total_score11;
						}

						//learning & growth
						else if($id==12)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score12=($nilai*$kpi_sub)/100;
							$score=$score12;

						}
						else if($id==13)
						{
							$score=$score12;
							$kpi_score13=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score13;
							$kd_kpi13=$data[1];
							$kd_kpi=$kd_kpi13;

						}
						else if($id==14)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score14=($nilai*$kpi_sub)/100;
								$score=$score14;

						}
						else if($id==15)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score15=($nilai*$kpi_sub)/100;
								$score=$score15;

						}
						else if($id==16)
						{
							$score=$score14+$score15;
							$kpi_score16=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score16;
							$kd_kpi16=$data[1];
							$kd_kpi=$kd_kpi16;

						}
						else if($id==17)
						{
							
							$score17=($nilai*$kpi_sub)/100;
							$score=$score17;


						}
						else if($id==18)
						{
							$score18=($nilai*$kpi_sub)/100;
							$score=$score18;

						}
						else if($id==19)
						{
							$score=$score17+$score18;
							$kpi_score19=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score19;
							$kd_kpi19=$data[1];
							$kd_kpi=$kd_kpi19;

						}
						//jumlah dari yang diatas
						else if($id==20)
						{
							$kd_kpi=$kd_kpi13+$kd_kpi16+$kd_kpi19;
							$kpi_score=$kpi_score13+$kpi_score16+$kpi_score19;
							$bobot_pers20=$data[2];
							$total_score20=($kpi_score*$bobot_pers20)/100;
							$total_score=$total_score20;

						}
						//total
						else if($id==21)
						{
							$bobot_pers=$bobot_pers2+$bobot_pers6+$bobot_pers11+$bobot_pers20;
							$total_score=$total_score2+$total_score6+$total_score11+$total_score20;

						}
					}

					// sales kredit
					else if($_GET[id_kategori]==9)
					{
						//financial
						if($id==1)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						else if($id==2)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<1.5)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=1.5 && $realisasi<2 )
							{
								$nilai=round(80,1);
								
							}
							else if($realisasi>=2 && $realisasi<2.5)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=2.5 && $realisasi<3)
							{
								$nilai=round(60,1);
								
							}
								else if($realisasi>=3 && $realisasi<4)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=4 && $realisasi<4.5)
							{
								$nilai=round(40,1);
								
							}
							else if($realisasi>=4.5)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi2=$data[1];
							$kpi_score2=($nilai*$kd_kpi2)/100;
							$kpi_score=$kpi_score2;
						}
						else if($id==3)
						{
							$kd_kpi3=$data[1];
							$kpi_score3=($nilai*$kd_kpi3)/100;
							$kpi_score=$kpi_score3;
						}
						//jumlah dari yang diatas
						else if($id==4)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3;
							$bobot_pers4=$data[2];
							$total_score4=($kpi_score*$bobot_pers4)/100;
							$total_score=$total_score4;
						}

						//customer
						else if($id==5)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						else if($id==6)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi6=$data[1];
							$kpi_score6=($nilai*$kd_kpi6)/100;
							$kpi_score=$kpi_score6;
						}
						//jumlah dari yang diatas
						else if($id==7)
						{
							$kd_kpi=$kd_kpi5+$kd_kpi6;
							$kpi_score=$kpi_score5+$kpi_score6;
							$bobot_pers7=$data[2];
							$total_score7=($kpi_score*$bobot_pers7)/100;
							$total_score=$total_score7;
						}

						//internal proses
						else if($id==8)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
						
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi8=$data[1];
							$kpi_score8=($nilai*$kd_kpi8)/100;
							$kpi_score=$kpi_score8;
						}
						else if($id==9)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
						
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi9=$data[1];
							$kpi_score9=($nilai*$kd_kpi9)/100;
							$kpi_score=$kpi_score9;
						}
						else if($id==10)
						{
							$kd_kpi10=$data[1];
							$kpi_score10=($nilai*$kd_kpi10)/100;
							$kpi_score=$kpi_score10;
						}
						//jumlah dari yang diatas
						else if($id==11)
						{
							$kd_kpi=$kd_kpi8+$kd_kpi9+$kd_kpi10;
							$kpi_score=$kpi_score8+$kpi_score9+$kpi_score10;
							$bobot_pers11=$data[2];
							$total_score11=($kpi_score*$bobot_pers11)/100;
							$total_score=$total_score11;
						}

						//learning & growth
						else if($id==12)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score12=($nilai*$kpi_sub)/100;
							$score=$score12;

						}
						else if($id==13)
						{
							$score=$score12;
							$kpi_score13=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score13;
							$kd_kpi13=$data[1];
							$kd_kpi=$kd_kpi13;

						}
						else if($id==14)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score14=($nilai*$kpi_sub)/100;
								$score=$score14;

						}
						else if($id==15)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score15=($nilai*$kpi_sub)/100;
								$score=$score15;

						}
						else if($id==16)
						{
							$score=$score14+$score15;
							$kpi_score16=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score16;
							$kd_kpi16=$data[1];
							$kd_kpi=$kd_kpi16;

						}
						else if($id==17)
						{
							
							$score17=($nilai*$kpi_sub)/100;
							$score=$score17;


						}
						else if($id==18)
						{
							$score18=($nilai*$kpi_sub)/100;
							$score=$score18;

						}
						else if($id==19)
						{
							$score=$score17+$score18;
							$kpi_score19=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score19;
							$kd_kpi19=$data[1];
							$kd_kpi=$kd_kpi19;

						}
						//jumlah dari yang diatas
						else if($id==20)
						{
							$kd_kpi=$kd_kpi13+$kd_kpi16+$kd_kpi19;
							$kpi_score=$kpi_score13+$kpi_score16+$kpi_score19;
							$bobot_pers20=$data[2];
							$total_score20=($kpi_score*$bobot_pers20)/100;
							$total_score=$total_score20;

						}
						//total
						else if($id==21)
						{
							$bobot_pers=$bobot_pers4+$bobot_pers7+$bobot_pers11+$bobot_pers20;
							$total_score=$total_score4+$total_score7+$total_score11+$total_score20;

						}

					}

					//penagihan kredit
					else if($_GET[id_kategori]==10)
					{
						//financial
						if($id==1)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						//jumlah dari yang diatas
						else if($id==2)
						{
							$kd_kpi=$kd_kpi1;
							$kpi_score=$kpi_score1;
							$bobot_pers2=$data[2];
							$total_score2=($kpi_score*$bobot_pers2)/100;
							$total_score=$total_score2;

						}
						//customer
						else if($id==3)
						{
							$kd_kpi3=$data[1];
							$kpi_score3=($nilai*$kd_kpi3)/100;
							$kpi_score=$kpi_score3;
						}
						//jumlah dari yang diatas
						else if($id==4)
						{
							$kd_kpi=$kd_kpi3;
							$kpi_score=$kpi_score3;
							$bobot_pers4=$data[2];
							$total_score4=($kpi_score*$bobot_pers4)/100;
							$total_score=$total_score4;

						}
						//internal proses
						else if($id==5)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						else if($id==6)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi6=$data[1];
							$kpi_score6=($nilai*$kd_kpi6)/100;
							$kpi_score=$kpi_score6;
						}
						else if($id==7)
						{
							$kd_kpi7=$data[1];
							$kpi_score7=($nilai*$kd_kpi7)/100;
							$kpi_score=$kpi_score7;
						}
						//jumlah dari yang diatas
						else if($id==8)
						{
							$kd_kpi=$kd_kpi5+$kd_kpi6+$kd_kpi7;
							$kpi_score=$kpi_score5+$kpi_score6+$kpi_score7;
							$bobot_pers8=$data[2];
							$total_score8=($kpi_score*$bobot_pers8)/100;
							$total_score=$total_score8;

						}

						//learning & growth
						else if($id==9)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score9=($nilai*$kpi_sub)/100;
							$score=$score9;

						}
						else if($id==10)
						{
							$score=$score9;
							$kpi_score10=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score10;
							$kd_kpi10=$data[1];
							$kd_kpi=$kd_kpi10;

						}
						else if($id==11)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score11=($nilai*$kpi_sub)/100;
								$score=$score11;

						}
						else if($id==12)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score12=($nilai*$kpi_sub)/100;
								$score=$score12;

						}
						else if($id==13)
						{
							$score=$score11+$score12;
							$kpi_score13=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score13;
							$kd_kpi13=$data[1];
							$kd_kpi=$kd_kpi13;

						}
						else if($id==14)
						{
							
							$score14=($nilai*$kpi_sub)/100;
							$score=$score14;


						}
						else if($id==15)
						{
							$score15=($nilai*$kpi_sub)/100;
							$score=$score15;

						}
						else if($id==16)
						{
							$score=$score14+$score15;
							$kpi_score16=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score16;
							$kd_kpi16=$data[1];
							$kd_kpi=$kd_kpi16;

						}
						//jumlah dari yang diatas
						else if($id==17)
						{
							$kd_kpi=$kd_kpi10+$kd_kpi13+$kd_kpi16;
							$kpi_score=$kpi_score10+$kpi_score13+$kpi_score16;
							$bobot_pers17=$data[2];
							$total_score17=($kpi_score*$bobot_pers17)/100;
							$total_score=$total_score17;

						}
						//total
						else if($id==18)
						{
							$bobot_pers=$bobot_pers2+$bobot_pers4+$bobot_pers8+$bobot_pers17;
							$total_score=$total_score2+$total_score4+$total_score8+$total_score17;

						}
					}

					//teller
					else if($_GET[id_kategori]==11)
					{
						//financial
						if($id==1)
						{
							if($realisasi<2){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=2 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<6 )
							{
								$nilai=round(80,1);
								
							}
							else if($realisasi>=6 && $realisasi<8)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=8 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						else if($id==2)
						{
							if($realisasi==0){
							    $nilai=round(100,1);
							
							}
							else if($realisasi<=2500000)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi<=5000000)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>5000000)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi2=$data[1];
							$kpi_score2=($nilai*$kd_kpi2)/100;
							$kpi_score=$kpi_score2;
						}
						//jumlah dari yang diatas
						else if($id==3)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2;
							$kpi_score=$kpi_score1+$kpi_score2;
							$bobot_pers3=$data[2];
							$total_score3=($kpi_score*$bobot_pers3)/100;
							$total_score=$total_score3;

						}
						//customer
						else if($id==4)
						{
							$kd_kpi4=$data[1];
							$kpi_score4=($nilai*$kd_kpi4)/100;
							$kpi_score=$kpi_score4;
						}
						else if($id==5)
						{
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi4+$kd_kpi5;
							$kpi_score=$kpi_score4+$kpi_score5;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;

						}
						//internal proses
						else if($id==7)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi7=$data[1];
							$kpi_score7=($nilai*$kd_kpi7)/100;
							$kpi_score=$kpi_score7;
						}
						else if($id==8)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi8=$data[1];
							$kpi_score8=($nilai*$kd_kpi8)/100;
							$kpi_score=$kpi_score8;
						}
						else if($id==9)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<2)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=2 && $realisasi<3 )
							{
								$nilai=round(10,1);
								
							}
							else if($realisasi>=3)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi9=$data[1];
							$kpi_score9=($nilai*$kd_kpi9)/100;
							$kpi_score=$kpi_score9;
						}
						else if($id==10)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi10=$data[1];
							$kpi_score10=($nilai*$kd_kpi10)/100;
							$kpi_score=$kpi_score10;
						}
						else if($id==11)
						{
							$kd_kpi11=$data[1];
							$kpi_score11=($nilai*$kd_kpi11)/100;
							$kpi_score=$kpi_score11;
						}
						//jumlah dari yang diatas
						else if($id==12)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8+$kd_kpi9+$kd_kpi10+$kd_kpi11;
							$kpi_score=$kpi_score7+$kpi_score8+$kpi_score9+$kpi_score10+$kpi_score11;
							$bobot_pers12=$data[2];
							$total_score12=($kpi_score*$bobot_pers12)/100;
							$total_score=$total_score12;

						}

						//learning & growth
						else if($id==13)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score13=($nilai*$kpi_sub)/100;
							$score=$score13;

						}
						else if($id==14)
						{
							$score=$score13;
							$kpi_score14=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score14;
							$kd_kpi14=$data[1];
							$kd_kpi=$kd_kpi14;

						}
						else if($id==15)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score15=($nilai*$kpi_sub)/100;
								$score=$score15;

						}
						else if($id==16)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score16=($nilai*$kpi_sub)/100;
								$score=$score16;

						}
						else if($id==17)
						{
							$score=$score15+$score16;
							$kpi_score17=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score17;
							$kd_kpi17=$data[1];
							$kd_kpi=$kd_kpi17;

						}
						else if($id==18)
						{
							
							$score18=($nilai*$kpi_sub)/100;
							$score=$score18;


						}
						else if($id==19)
						{
							$score19=($nilai*$kpi_sub)/100;
							$score=$score19;

						}
						else if($id==20)
						{
							$score=$score18+$score19;
							$kpi_score20=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score20;
							$kd_kpi20=$data[1];
							$kd_kpi=$kd_kpi20;

						}
						//jumlah dari yang diatas
						else if($id==21)
						{
							$kd_kpi=$kd_kpi14+$kd_kpi17+$kd_kpi20;
							$kpi_score=$kpi_score14+$kpi_score17+$kpi_score20;
							$bobot_pers21=$data[2];
							$total_score21=($kpi_score*$bobot_pers21)/100;
							$total_score=$total_score21;

						}
						//total
						else if($id==22)
						{
							$bobot_pers=$bobot_pers3+$bobot_pers6+$bobot_pers12+$bobot_pers21;
							$total_score=$total_score3+$total_score6+$total_score12+$total_score21;

						}
					}

					//kliring
					else if($_GET[id_kategori]==12)
					{
						//internal proses
						if($id==1)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						else if($id==2)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi2=$data[1];
							$kpi_score2=($nilai*$kd_kpi2)/100;
							$kpi_score=$kpi_score2;
						}
						else if($id==3)
						{
							$kd_kpi3=$data[1];
							$kpi_score3=($nilai*$kd_kpi3)/100;
							$kpi_score=$kpi_score3;
						}
						//jumlah dari yang diatas
						else if($id==4)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3;
							$bobot_pers4=$data[2];
							$total_score4=($kpi_score*$bobot_pers4)/100;
							$total_score=$total_score4;

						}
						//learning & growth
						else if($id==5)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score5=($nilai*$kpi_sub)/100;
							$score=$score5;

						}
						else if($id==6)
						{
							$score=$score5;
							$kpi_score6=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score6;
							$kd_kpi6=$data[1];
							$kd_kpi=$kd_kpi6;

						}
						else if($id==7)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score7=($nilai*$kpi_sub)/100;
								$score=$score7;

						}
						else if($id==8)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score8=($nilai*$kpi_sub)/100;
								$score=$score8;

						}
						else if($id==9)
						{
							$score=$score7+$score8;
							$kpi_score9=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score9;
							$kd_kpi9=$data[1];
							$kd_kpi=$kd_kpi9;

						}
						else if($id==10)
						{
							
							$score10=($nilai*$kpi_sub)/100;
							$score=$score10;


						}
						else if($id==11)
						{
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;

						}
						else if($id==12)
						{
							$score=$score10+$score11;
							$kpi_score12=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score12;
							$kd_kpi12=$data[1];
							$kd_kpi=$kd_kpi12;

						}
						//jumlah dari yang diatas
						else if($id==13)
						{
							$kd_kpi=$kd_kpi6+$kd_kpi9+$kd_kpi12;
							$kpi_score=$kpi_score6+$kpi_score9+$kpi_score12;
							$bobot_pers13=$data[2];
							$total_score13=($kpi_score*$bobot_pers13)/100;
							$total_score=$total_score13;

						}
						//total
						else if($id==22)
						{
							$bobot_pers=$bobot_pers4+$bobot_pers13;
							$total_score=$total_score4+$total_score13;

						}

					}

					//stafpengadaan(umum)
					else if($_GET[id_kategori]==13)
					{
						//financial
						if($id==1)
						{
							if($realisasi==0){
							    $nilai=round(100,1);
							
							}
							else if($realisasi<=500000)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi<=1000000)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>1000000)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						//jumlah dari yang diatas
						else if($id==2)
						{
							$kd_kpi=$kd_kpi1;
							$kpi_score=$kpi_score1;
							$bobot_pers2=$data[2];
							$total_score2=($kpi_score*$bobot_pers2)/100;
							$total_score=$total_score2;

						}
						//customer
						else if($id==3)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi3=$data[1];
							$kpi_score3=($nilai*$kd_kpi3)/100;
							$kpi_score=$kpi_score3;
						}
						else if($id==4)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi4=$data[1];
							$kpi_score4=($nilai*$kd_kpi4)/100;
							$kpi_score=$kpi_score4;
						}
						else if($id==5)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi3+$kd_kpi4+$kd_kpi5;
							$kpi_score=$kpi_score3+$kpi_score4+$kpi_score5;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;

						}

						//internal proses
						else if($id==7)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi7=$data[1];
							$kpi_score7=($nilai*$kd_kpi7)/100;
							$kpi_score=$kpi_score7;
						}
						else if($id==8)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi8=$data[1];
							$kpi_score8=($nilai*$kd_kpi8)/100;
							$kpi_score=$kpi_score8;
						}
						else if($id==9)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi9=$data[1];
							$kpi_score9=($nilai*$kd_kpi9)/100;
							$kpi_score=$kpi_score9;
						}
						else if($id==10)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi10=$data[1];
							$kpi_score10=($nilai*$kd_kpi10)/100;
							$kpi_score=$kpi_score10;
						}
						else if($id==11)
						{
							$kd_kpi11=$data[1];
							$kpi_score11=($nilai*$kd_kpi11)/100;
							$kpi_score=$kpi_score11;
						}
						//jumlah dari yang diatas
						else if($id==12)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8+$kd_kpi9+$kd_kpi10+$kd_kpi11;
							$kpi_score=$kpi_score7+$kpi_score8+$kpi_score9+$kpi_score10+$kpi_score11;
							$bobot_pers12=$data[2];
							$total_score12=($kpi_score*$bobot_pers12)/100;
							$total_score=$total_score12;

						}
						//learning & growth
						else if($id==13)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score13=($nilai*$kpi_sub)/100;
							$score=$score13;

						}
						else if($id==14)
						{
							$score=$score13;
							$kpi_score14=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score14;
							$kd_kpi14=$data[1];
							$kd_kpi=$kd_kpi14;

						}
						else if($id==15)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score15=($nilai*$kpi_sub)/100;
								$score=$score15;

						}
						else if($id==16)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score16=($nilai*$kpi_sub)/100;
								$score=$score16;

						}
						else if($id==17)
						{
							$score=$score15+$score16;
							$kpi_score17=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score17;
							$kd_kpi17=$data[1];
							$kd_kpi=$kd_kpi17;

						}
						else if($id==18)
						{
							
							$score18=($nilai*$kpi_sub)/100;
							$score=$score18;


						}
						else if($id==19)
						{
							$score19=($nilai*$kpi_sub)/100;
							$score=$score19;

						}
						else if($id==20)
						{
							$score=$score18+$score19;
							$kpi_score20=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score20;
							$kd_kpi20=$data[1];
							$kd_kpi=$kd_kpi20;

						}
						//jumlah dari yang diatas
						else if($id==21)
						{
							$kd_kpi=$kd_kpi14+$kd_kpi17+$kd_kpi20;
							$kpi_score=$kpi_score14+$kpi_score17+$kpi_score20;
							$bobot_pers21=$data[2];
							$total_score21=($kpi_score*$bobot_pers21)/100;
							$total_score=$total_score21;

						}
						//total
						else if($id==22)
						{
							$bobot_pers=$bobot_pers2+$bobot_pers6+$bobot_pers12+$bobot_pers21;
							$total_score=$total_score2+$total_score6+$total_score12+$total_score21;

						}
					}

					//sundries
					else if($_GET[id_kategori]==14)
					{
						if($id==1)
						{
							if($realisasi<2){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=2 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<6 )
							{
								$nilai=round(80,1);
								
							}
							else if($realisasi>=6 && $realisasi<8)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=8 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						else if($id==2)
						{
							if($realisasi==0){
							    $nilai=round(100,1);
							
							}
							else if($realisasi<=2500000)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi<=5000000)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>5000000)
							{
								$nilai=round(0,1);
								
							}
							$kd_kpi2=$data[1];
							$kpi_score2=($nilai*$kd_kpi2)/100;
							$kpi_score=$kpi_score2;
						}
						//jumlah dari yang diatas
						else if($id==3)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2;
							$kpi_score=$kpi_score1+$kpi_score2;
							$bobot_pers3=$data[2];
							$total_score3=($kpi_score*$bobot_pers3)/100;
							$total_score=$total_score3;

						}
						//customer
						else if($id==4)
						{
							$kd_kpi4=$data[1];
							$kpi_score4=($nilai*$kd_kpi4)/100;
							$kpi_score=$kpi_score4;
						}
						else if($id==5)
						{
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						//jumlah dari yang diatas
						else if($id==6)
						{
							$kd_kpi=$kd_kpi4+$kd_kpi5;
							$kpi_score=$kpi_score4+$kpi_score5;
							$bobot_pers6=$data[2];
							$total_score6=($kpi_score*$bobot_pers6)/100;
							$total_score=$total_score6;

						}
						//internal proses
						else if($id==7)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi7=$data[1];
							$kpi_score7=($nilai*$kd_kpi7)/100;
							$kpi_score=$kpi_score7;
						}
						else if($id==8)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi8=$data[1];
							$kpi_score8=($nilai*$kd_kpi8)/100;
							$kpi_score=$kpi_score8;
						}
						else if($id==9)
						{
							$kd_kpi9=$data[1];
							$kpi_score9=($nilai*$kd_kpi9)/100;
							$kpi_score=$kpi_score9;
						}
						//jumlah dari yang diatas
						else if($id==10)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi8+$kd_kpi9;
							$kpi_score=$kpi_score7+$kpi_score8+$kpi_score9;
							$bobot_pers10=$data[2];
							$total_score10=($kpi_score*$bobot_pers10)/100;
							$total_score=$total_score10;

						}

						//learning & growth
						else if($id==11)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;

						}
						else if($id==12)
						{
							$score=$score11;
							$kpi_score12=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score12;
							$kd_kpi12=$data[1];
							$kd_kpi=$kd_kpi12;

						}
						else if($id==13)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score13=($nilai*$kpi_sub)/100;
								$score=$score13;

						}
						else if($id==14)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score14=($nilai*$kpi_sub)/100;
								$score=$score14;

							

						}
						else if($id==15)
						{
							$score=$score13+$score14;
							$kpi_score15=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score15;
							$kd_kpi15=$data[1];
							$kd_kpi=$kd_kpi15;

						}
						else if($id==16)
						{
							
							$score16=($nilai*$kpi_sub)/100;
							$score=$score16;


						}
						else if($id==17)
						{
							$score17=($nilai*$kpi_sub)/100;
							$score=$score17;

						}
						else if($id==18)
						{
							$score=$score16+$score17;
							$kpi_score18=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score18;
							$kd_kpi18=$data[1];
							$kd_kpi=$kd_kpi18;

						}
						//jumlah dari yang diatas
						else if($id==19)
						{
							$kd_kpi=$kd_kpi12+$kd_kpi15+$kd_kpi18;
							$kpi_score=$kpi_score12+$kpi_score15+$kpi_score18;
							$bobot_pers19=$data[2];
							$total_score19=($kpi_score*$bobot_pers19)/100;
							$total_score=$total_score19;

						}
						//total
						else if($id==20)
						{
							$bobot_pers=$bobot_pers3+$bobot_pers6+$bobot_pers10+$bobot_pers19;
							$total_score=$total_score3+$total_score6+$total_score10+$total_score19;

						}
					}

					//CS
					else if($_GET[id_kategori]==15)
					{
						//customer
						if($id==1)
						{
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						else if($id==2)
						{
							$kd_kpi2=$data[1];
							$kpi_score2=($nilai*$kd_kpi2)/100;
							$kpi_score=$kpi_score2;
						}
						//jumlah dari yang diatas
						else if($id==3)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2;
							$kpi_score=$kpi_score1+$kpi_score2;
							$bobot_pers3=$data[2];
							$total_score3=($kpi_score*$bobot_pers3)/100;
							$total_score=$total_score3;

						}
						//internal proses
						else if($id==4)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi4=$data[1];
							$kpi_score4=($nilai*$kd_kpi4)/100;
							$kpi_score=$kpi_score4;
						}
						else if($id==5)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi5=$data[1];
							$kpi_score5=($nilai*$kd_kpi5)/100;
							$kpi_score=$kpi_score5;
						}
						else if($id==6)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi6=$data[1];
							$kpi_score6=($nilai*$kd_kpi6)/100;
							$kpi_score=$kpi_score6;
						}
						else if($id==7)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi7=$data[1];
							$kpi_score7=($nilai*$kd_kpi7)/100;
							$kpi_score=$kpi_score7;
						}
						else if($id==8)
						{
							$kd_kpi8=$data[1];
							$kpi_score8=($nilai*$kd_kpi8)/100;
							$kpi_score=$kpi_score8;
						}
						//jumlah dari yang diatas
						else if($id==9)
						{
							$kd_kpi=$kd_kpi4+$kd_kpi5+$kd_kpi6+$kd_kpi7+$kd_kpi8;
							$kpi_score=$kpi_score4+$kpi_score5+$kpi_score6+$kpi_score7+$kpi_score8;
							$bobot_pers9=$data[2];
							$total_score9=($kpi_score*$bobot_pers9)/100;
							$total_score=$total_score9;

						}

						//learning & growth
						else if($id==10)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score10=($nilai*$kpi_sub)/100;
							$score=$score10;

						}
						else if($id==11)
						{
							$score=$score10;
							$kpi_score11=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score11;
							$kd_kpi11=$data[1];
							$kd_kpi=$kd_kpi11;

						}
						else if($id==12)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score12=($nilai*$kpi_sub)/100;
								$score=$score12;

						}
						else if($id==13)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score13=($nilai*$kpi_sub)/100;
								$score=$score13;

							

						}
						else if($id==14)
						{
							$score=$score12+$score13;
							$kpi_score14=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score14;
							$kd_kpi14=$data[1];
							$kd_kpi=$kd_kpi14;

						}
						else if($id==15)
						{
							
							$score15=($nilai*$kpi_sub)/100;
							$score=$score15;


						}
						else if($id==16)
						{
							$score16=($nilai*$kpi_sub)/100;
							$score=$score16;

						}
						else if($id==17)
						{
							$score=$score15+$score16;
							$kpi_score17=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score17;
							$kd_kpi17=$data[1];
							$kd_kpi=$kd_kpi17;

						}
						//jumlah dari yang diatas
						else if($id==18)
						{
							$kd_kpi=$kd_kpi11+$kd_kpi14+$kd_kpi17;
							$kpi_score=$kpi_score11+$kpi_score14+$kpi_score17;
							$bobot_pers18=$data[2];
							$total_score18=($kpi_score*$bobot_pers18)/100;
							$total_score=$total_score18;

						}
						//total
						else if($id==19)
						{
							$bobot_pers=$bobot_pers3+$bobot_pers9+$bobot_pers18;
							$total_score=$total_score3+$total_score9+$total_score18;

						}
					}

					//verifikator
					else if($_GET[id_kategori]==16)
					{
						//internal proses
						if($id==1)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi1=$data[1];
							$kpi_score1=($nilai*$kd_kpi1)/100;
							$kpi_score=$kpi_score1;
						}
						else if($id==2)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=10 && $realisasi<13)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=13)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi2=$data[1];
							$kpi_score2=($nilai*$kd_kpi2)/100;
							$kpi_score=$kpi_score2;
						}
						else if($id==3)
						{
							if($realisasi<1){
							    $nilai=round(100,1);
							
							}
							else if($realisasi>=1 && $realisasi<3)
							{
								$nilai=round(90,1);
								
							}
							else if($realisasi>=3 && $realisasi<5 )
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=5 && $realisasi<7)
							{
								$nilai=round(60,1);
								
							}
							else if($realisasi>=7 && $realisasi<9)
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=9)
							{
								$nilai=round(30,1);
								
							}
							$kd_kpi3=$data[1];
							$kpi_score3=($nilai*$kd_kpi3)/100;
							$kpi_score=$kpi_score3;
						}
						else if($id==4)
						{
							$kd_kpi4=$data[1];
							$kpi_score4=($nilai*$kd_kpi4)/100;
							$kpi_score=$kpi_score4;
						}
						//jumlah dari yang diatas
						else if($id==5)
						{
							$kd_kpi=$kd_kpi1+$kd_kpi2+$kd_kpi3+$kd_kpi4;
							$kpi_score=$kpi_score1+$kpi_score2+$kpi_score3+$kpi_score4;
							$bobot_pers5=$data[2];
							$total_score5=($kpi_score*$bobot_pers5)/100;
							$total_score=$total_score5;
						}

						//learning & growth
						else if($id==6)
						{
							$pencapaian=round ((($realisasi/$target)*100),0);
							if($realisasi>$target)
							{
								$nilai=100;
							}
							else if($realisasi==0)
							{
								$nilai=0;
							}
							else{
								$nilai=$pencapaian;
							}
							$score6=($nilai*$kpi_sub)/100;
							$score=$score6;

						}
						else if($id==7)
						{
							$score=$score6;
							$kpi_score7=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score7;
							$kd_kpi7=$data[1];
							$kd_kpi=$kd_kpi7;

						}
						else if($id==8)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score8=($nilai*$kpi_sub)/100;
								$score=$score8;

						}
						else if($id==9)
						{
							if($realisasi<1){
							 $nilai=round(100,1);
							
									}
							else if($realisasi>=1 && $realisasi<4)
							{
								$nilai=round(70,1);
								
							}
							else if($realisasi>=4 && $realisasi<7 )
							{
								$nilai=round(50,1);
								
							}
							else if($realisasi>=7 && $realisasi<10)
							{
								$nilai=round(30,1);
								
							}
						
							else if($realisasi>=10)
							{
								$nilai=round(10,1);
								
							}
								$score9=($nilai*$kpi_sub)/100;
								$score=$score9;
						}
						else if($id==10)
						{
							$score=$score8+$score9;
							$kpi_score10=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score10;
							$kd_kpi10=$data[1];
							$kd_kpi=$kd_kpi10;

						}
						else if($id==11)
						{
							
							$score11=($nilai*$kpi_sub)/100;
							$score=$score11;


						}
						else if($id==12)
						{
							$score12=($nilai*$kpi_sub)/100;
							$score=$score12;

						}
						else if($id==13)
						{
							$score=$score11+$score12;
							$kpi_score13=($score*$kd_kpi)/100;
							$kpi_score=$kpi_score13;
							$kd_kpi13=$data[1];
							$kd_kpi=$kd_kpi13;

						}
						//jumlah dari yang diatas
						else if($id==14)
						{
							$kd_kpi=$kd_kpi7+$kd_kpi10+$kd_kpi13;
							$kpi_score=$kpi_score7+$kpi_score10+$kpi_score13;
							$bobot_pers14=$data[2];
							$total_score14=($kpi_score*$bobot_pers14)/100;
							$total_score=$total_score14;

						}
						//total
						else if($id==15)
						{
							$bobot_pers=$bobot_pers5+$bobot_pers14;
							$total_score=$total_score5+$total_score14;

						}

					}
					
					$regis ="INSERT INTO `tbl_kinerja` (`kd_kinerja`, `kd_parameter`, `nrp`, `kd_unit`,`kd_cabang`, `target`, `realisasi`, `pencapaian`, `nilai`, `sub_bobot`, `sub_score`, `kpi_bobot`, `kpi_score`, `bobot_perspektif`, `total_score`) VALUES (NULL, '$id', '$nrp','$_GET[id_kategori]', '$_SESSION[jabatan]', '$target', '$realisasi', '$pencapaian', '$nilai', '$kpi_sub', '$score', '$kd_kpi', '$kpi_score', '$bobot_pers', '$total_score');";
					$hasil=mysqli_query($konek,$regis);
					echo"<script type='text/javascript' language='javascript'>
						alert('Data Berhasil diinput');
						window.location.href='cab.php?id_kategori=$_GET[id_kategori]';
						</script>";
					
			}
		
	}

					
		
		}
			 
		}
		else if (isset($_POST['tampil']) || isset($_POST['nrp']) ) {
			
				 ?>
											<?php
											
												 echo "<select name='nrp' onchange='this.form.submit();'' class='form-control'>";
											
											
											$query = "SELECT DISTINCT k.nrp, p.nama FROM tbl_kinerja k, tbl_pegawai p where k.kd_unit='$_GET[id_kategori]' and k.kd_cabang='$_SESSION[jabatan]' and k.nrp=p.nrpp";
											$hasil = mysqli_query($konek,$query);
											echo "<option value='' class='active'>NRPP & Nama</option>";
											while($data=mysqli_fetch_array($hasil)){
											if($_POST['nrp']==$data['nrp'])
												{
											    echo "<option selected value=$data[nrp]>$data[nrp] - $data[nama]</option>";
											}
											else{
												 echo "<option value=$data[nrp]>$data[nrp] - $data[nama]</option>";
											}
											} 
											 echo "</select>";
											
										
											?>
					<?php
					 $nrpx	= $_POST['nrp'];
					$nama	= $_POST['tampil'];
					$target	= $_POST['target'.$r];
					$realisasi= $_POST['realisasi'.$r];
					$pencapaian=round ((($realisasi/$target)*100),0);
					$id = $r;
					$query = "SELECT * FROM `tbl_refkinerja` LIMIT 10 ";
					$hasil = mysqli_query($konek,$query);

					echo "</div>
					
					</div>  		
                        <div class='table-responsive'>
                                <table class='table' border='1' rules='cols' >
                                    <thead>
                                        <tr><th>Nomor</th>";
					while($data = mysqli_fetch_array($hasil)){


                                       echo" 
                                       	 <th>$data[1]</th>
                                        	 ";
                         }
                         echo "
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    echo "<tr bgcolor='#CCCCCC'>";

					$regis ="select p.nama_perspektif, j.nama_parameter,k.target, k.realisasi, k.pencapaian, k.nilai, k.sub_bobot, k.sub_score, k.kpi_bobot, k.kpi_score, j.Nomor, k.nrp from tbl_perspektif p, tbl_parameter j, tbl_kinerja k where p.kd_perspektif=j.kd_perspektif and k.kd_parameter=j.kd_parameter and j.kd_unit=k.kd_unit and j.kd_unit=$_GET[id_kategori] and k.nrp='$nrpx' and k.kd_cabang=$_SESSION[jabatan] order by j.kd_perspektif";
					$hasill=mysqli_query($konek,$regis);
					while($data = mysqli_fetch_array($hasill)){
						$m++;
					if( $data[Nomor]=='X') 	{	
						 echo "<tr>";
						echo "<td class='txt-oflo'>".$m."</td>
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
					  		</tr>";
					  	}
					else if( $data[Nomor]=='J' || $data[Nomor]=='T' ) 	{	
						 echo "<tr bgcolor='#CCCCCC'>";
						echo "<td class='txt-oflo'>".$m."</td>
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
					  		</tr>";
					  	}
					  	else if( $data[Nomor]=='A' || $data[Nomor]=='B' || $data[Nomor]=='C' || $data[Nomor]=='D' || $data[Nomor]=='E' ) 	{	
						 echo "<tr bgcolor='yellow'>";
						echo "
						    <td class='txt-oflo'>".$m."</td>
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
					  		</tr>";
					  	}
					  	else
					  	{
					  		 echo "<tr bgcolor='white'>";
						echo "
						<td class='txt-oflo'>".$m."</td>
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
					  		</tr>";

					  	}
					}
					$_GET['nrp']=$_POST['nrp'];
					echo "<div><a class='btn btn-success' target='_blank' href='cetak.php?nrp=$_GET[nrp]&id_kategori=$_GET[id_kategori]' >Download PDF</a>"; 
					echo "&nbsp;&nbsp;<button type='submit' class='btn btn-success' name='delete'>Hapus Data</button></div>";  

					if (isset($_POST['delete'])){
						$perintah="DELETE FROM tbl_kinerja WHERE nrp='$_GET[nrp]' and kd_unit=$_GET[id_kategori] and kd_cabang=$_SESSION[jabatan]";
	  						 $hasil=mysqli_query($konek,$perintah);
	  						 if($hasil > 0){
	  						 echo"<script type='text/javascript' language='javascript'>
						alert('Data Berhasil didelete');
						window.location.href='cab.php?id_kategori=$_GET[id_kategori]';
						</script>";
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
