<!DOCTYPE HTML>
<!--
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>SISTEM PENILAIAN KINERJA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		 <link rel="stylesheet" href="css/font-awesome.css">
		  <link rel="stylesheet" href="css/metisMenu.css">
    	<link rel="stylesheet" href="css/animate.css">
    	<link rel="stylesheet" href="css/bootstrap.css">

    <!-- App styles -->
    	<link rel="stylesheet" href="css/pe-icon-7-stroke.css">
    	<link rel="stylesheet" href="css/helper.css">
    	<link rel="stylesheet" href="css/style.css">
   
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>

	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><a href="login.php"></a></h1>
				<a href="login.php">Login</a>
			</header>

		<!-- Nav -->

		<!-- Banner -->
			<section id="banner1">
				<p><strong>REGISTRASI</strong></p><br />
				<p> <strong>SISTEM PENILAIAN KINERJA SETIAP UNIT<br />
					BANK PEMBANGUNAN DAERAH<br />
					SULAWESI TENGGARA</strong></p></b>

					<div class="col-md-12">
          	<div class="content">
			<div class="hpanel">
                <div class="panel-body">
                    <form action="regis.php" method="post">
                        <div class="row">
                        	 <div class="form-group col-lg-6">
                              
                                <input title="No. KTP harus valid" placeholder="Nomor Kepegawaian" class="form-control" name="nmr_kepegawaian" id="" required="" type="">
                            </div>
                            <div class="form-group col-lg-12">
                               
                                <input placeholder="Nama Lengkap tanpa disingkat" class="form-control" name="namalengkap" required="" type="">
                            </div>
                           
                            <div class="form-group col-lg-6">
                              
                                <input value="" placeholder="Kata sandi untuk login ke system" class="form-control" name="password" autocomplete="off" required="" type="password">
                            </div>
                           
                             <div class="form-group col-lg-6">
                          
                               <select name="jabatan" class="form-control">
											<?php
											include 'config.php';
											$query = "SELECT * FROM tbl_kantor ";
											$hasil = mysqli_query($konek,$query);
											echo "<option value='' class='active'>Pilih cabang</option>";
											while($data=mysqli_fetch_array($hasil)){
												if($data[2]=='CABANG')
												{
											    echo "<option value=$data[0]> $data[1]</option>";
											}
											}
											?>
											</select>
                            </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" name="tombol">Register</button>
                        </div>
                    </form>

					 </div>

					 </div>
					 
						  <p>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        <br>
			        </p>
					</div>

				</div>


					
					</section>

				
				
		


		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					
					<p>2018 © Copyright KP Teknik Informatika 2018 </p>
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