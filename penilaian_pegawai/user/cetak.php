<?php
// memanggil library FPDF
require('../fpdf18/fpdf.php');
session_start();  
$kd_unit=$_GET['id_kategori'];
$jab=$_SESSION['jabatan'];
$nrp=$_GET['nrp'];
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(250,7,'PENILAIAN KINERJA BANK SULTRA',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
include '../config.php';
$mahasiswa = mysqli_query($konek, "SELECT DISTINCT u.nama_unit FROM tbl_unit u, tbl_parameter p  where u.kd_unit=p.kd_unit and p.kd_unit=$kd_unit");

while ($row = mysqli_fetch_array($mahasiswa)){
    $pdf->Cell(150,6,'Unit                '.': '.$row['nama_unit'],0,1);   
}
	$pdf->Cell(150,6,'Nrpp              '.': '.$nrp,0,1); 

$nama = mysqli_query($konek, "SELECT DISTINCT p.nama FROM tbl_kinerja k, tbl_pegawai p where k.kd_unit='$kd_unit' and k.kd_cabang='$jab' and k.nrp=p.nrpp");

while ($row = mysqli_fetch_array($nama)){
    $pdf->Cell(150,6,'Nama             '.': '.$row['nama'],0,1);   
}


$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,6,'NAMA PERSPEKTIF',1,0,'C');
$pdf->Cell(75,6,'NAMA PARAMETER',1,0, 'C');
$pdf->Cell(20,6,'TARGET',1,0,'C');
$pdf->Cell(20,6,'REALISASI',1,0,'C');
$pdf->Cell(20,6,'PENCAPAIAN',1,0,'C');
$pdf->Cell(18,6,'NILAI',1,0,'C');
$pdf->Cell(20,6,'SUB BOBOT',1,0,'C');
$pdf->Cell(20,6,'SUB SCORE',1,0,'C');
$pdf->Cell(20,6,'KPI BOBOT',1,0,'C');
$pdf->Cell(20,6,'KPI SCORE',1,1,'C');

 
$pdf->SetFont('Arial','',7);
 
include '../config.php';
$mahasiswa = mysqli_query($konek, "SELECT p.nama_perspektif, j.nama_parameter,k.target, k.realisasi, k.pencapaian, k.nilai, k.sub_bobot, k.sub_score, k.kpi_bobot, k.kpi_score, j.Nomor, k.nrp from tbl_perspektif p, tbl_parameter j, tbl_kinerja k where p.kd_perspektif=j.kd_perspektif and k.kd_parameter=j.kd_parameter and j.kd_unit=k.kd_unit and k.kd_cabang='$jab' and k.kd_unit='$kd_unit' and k.nrp='$nrp' order by j.kode");

while ($row = mysqli_fetch_array($mahasiswa)){
    if($row['Nomor']=='X')
    {
    $pdf->Cell(30,6,$row['nama_perspektif'],1,0);
    $pdf->Cell(75,6,$row['nama_parameter'],1,0);
    $pdf->Cell(20,6,$row['target'].'%',1,0);
    $pdf->Cell(20,6,$row['realisasi'].'%',1,0); 
    $pdf->Cell(20,6,$row['pencapaian'].'%',1,0);
    $pdf->Cell(18,6,$row['nilai'],1,0);
    $pdf->Cell(20,6,$row['sub_bobot'].'%',1,0);
    $pdf->Cell(20,6,$row['sub_score'],1,0);
    $pdf->Cell(20,6,$row['kpi_bobot'].'%',1,0);
    $pdf->Cell(20,6,$row['kpi_score'],1,1);    
    }
    else
    {
    $pdf->Cell(30,6,'',1,0);
    $pdf->Cell(75,6,$row['nama_parameter'],1,0);
    $pdf->Cell(20,6,$row['target'].'%',1,0);
    $pdf->Cell(20,6,$row['realisasi'].'%',1,0); 
    $pdf->Cell(20,6,$row['pencapaian'].'%',1,0);
    $pdf->Cell(18,6,$row['nilai'],1,0);
    $pdf->Cell(20,6,$row['sub_bobot'].'%',1,0);
    $pdf->Cell(20,6,$row['sub_score'],1,0);
    $pdf->Cell(20,6,$row['kpi_bobot'].'%',1,0);
    $pdf->Cell(20,6,$row['kpi_score'],1,1);
    }  
}

$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$nama = mysqli_query($konek, "SELECT DISTINCT  j.nama_jab from tbl_jabatan j, tbl_kinerja k where j.kd_jab=k.kd_cabang and k.kd_cabang='$jab' and k.kd_unit='$kd_unit' and k.nrp='$nrp'");

while ($row = mysqli_fetch_array($nama)){
    $pdf->Cell(400,6,$row['nama_jab'],0,1,'C');   
}

 
$pdf->Output();
?>