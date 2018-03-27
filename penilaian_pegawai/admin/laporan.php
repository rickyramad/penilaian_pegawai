<!DOCTYPE HTML>
<!--
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>LAPORAN EXCEL</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="landing">
				
		<!-- Header -->
			<header id="header" class="inner">
			
				<a href="kinerja.php"><h1>KEMBALI</h1></a>
			</header> 
		
		


		<!-- Banner -->
		<br></br>
		<br></br>
		<div>
		<p align="left"><a href="export.php"><button>Export Data ke Excel</button></a></p>
		<br>
		<h2>REKAPAN EXCEL SECARA KESELURUHAN
 		</h2>
		 <table width="90%" border="1">
		<tr bgcolor="">
		
      		<th width="33"><center>No</center></th>
			<th width="99"><center>Nrpp</center></th>
	  		<th width="100"><center>Nama</center></th>
			<th width="100"><center>Kantor<center></th>
				<th width="100"><center>Unit<center></th>
			<th width="100"><center>Perspektif</center></th>
			<th width="100"><center>Nilai</center></th>

		
		</div>	
			
		</tr>
				
<?php
include"../config.php";

			$tampil="SELECT DISTINCT k.nrp, p.nama, x.nm_kantor, f.nama_perspektif, k.total_score, m.Nomor, m.kd_perspektif, u.nama_unit  FROM tbl_pegawai p, tbl_kinerja k, tbl_parameter m, tbl_regist i, tbl_perspektif f, tbl_kantor x, tbl_unit u where u.kd_unit=m.kd_unit and x.kd_kantor=i.jabatan and k.nrp=p.nrpp and k.kd_parameter=m.kd_parameter  and k.kd_cabang=i.jabatan and f.kd_perspektif=m.kd_perspektif and m.Nomor='J' and m.kd_unit=k.kd_unit or u.kd_unit=m.kd_unit and x.kd_kantor=i.jabatan and k.nrp=p.nrpp and k.kd_parameter=m.kd_parameter  and k.kd_cabang=i.jabatan and f.kd_perspektif=m.kd_perspektif and m.Nomor='T' and m.kd_unit=k.kd_unit order by k.kd_kinerja ASC";
			$hasil=mysqli_query($konek,$tampil); 
			$i='';
			while($data=mysqli_fetch_array($hasil))
			{
				$i++;
				$nrpp=$data['nrp'];
				$nama=$data['nama'];
				$kantor=$data['nm_kantor'];
				$unit=$data['nama_unit'];
				$pers=$data['nama_perspektif'];
				$total=$data['total_score'];

				if($data['kd_perspektif']==1 || $data['kd_perspektif']==2)
				{
				

					echo "<tr>
							<td><center>$i</center></td>
							<td><center>$nrpp</center></td>
							<td><center>$nama</center></td>
							<td><center>$kantor</center></td>
							<td><center>$unit</center></td>
							<td><center>$pers</center></td>
							<td><center>$total</center></td>
							
							</tr>";
				}
				else
				{
				

					echo "<tr>
							<td><center>$i</center></td>
							<td><center></center></td>
							<td><center></center></td>
							<td><center></center></td>
							<td><center></center></td>
							<td><center>$pers</center></td>
							<td><center>$total</center></td>
							
							</tr>";
				}


}


?>
</table>





		<!-- Footer -->

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>

	</body>
</html>