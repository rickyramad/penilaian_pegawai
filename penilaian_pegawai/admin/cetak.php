<?php
// memanggil library FPDF
require('../fpdf18/fpdf.php');
session_start();  
$kd_unit=$_GET['id_kategori'];
$jab=$_SESSION['jabatan'];
$nama_cab=$_GET['nama_cab'];
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
// mencetak string 
$pdf->SetFont('Arial','B',13);
$pdf->Cell(270,7,'PENILAIAN KINERJA BANK SULTRA',0,1,'C');
include '../config.php';
$mahasiswaaa = mysqli_query($konek, "SELECT DISTINCT k.kd_cabang, j.nama_cabang FROM tbl_jabatan j, tbl_regist r, tbl_kinerja k where j.kd_jab=r.jabatan and r.jabatan=k.kd_cabang and k.kd_unit=$kd_unit and k.kd_cabang='$nama_cab'");

while ($roww = mysqli_fetch_array($mahasiswaaa)){
    $pdf->Cell(270,7,'Cabang '.$roww['nama_cabang'],0,1,'C');   
}

 $mahasiswaa = mysqli_query($konek, "SELECT DISTINCT u.nama_unit FROM tbl_unit u, tbl_parameter p  where u.kd_unit=p.kd_unit and p.kd_unit=$kd_unit");

     while ($roww = mysqli_fetch_array($mahasiswaa)){
            $pdf->Cell(270,7,'Unit '.$roww['nama_unit'],0,1,'C');   
 }
  
$pdf->SetFont('Arial','',7);
 
include '../config.php';
$mahasiswa = mysqli_query($konek, "select DISTINCT p.nama_perspektif, j.nama_parameter,k.target, k.realisasi, k.pencapaian, k.nilai, k.sub_bobot, k.sub_score, k.kpi_bobot, k.kpi_score,k.bobot_perspektif, k.total_score,j.Nomor, k.nrp,k.kd_parameter, w.nama from tbl_perspektif p, tbl_parameter j, tbl_kinerja k, tbl_regist r, tbl_kantor t, tbl_pegawai w where w.nrpp=k.nrp and t.kd_kantor=r.jabatan and r.jabatan=k.kd_cabang and p.kd_perspektif=j.kd_perspektif and k.kd_parameter=j.kd_parameter and j.kd_unit=k.kd_unit and j.kd_unit='$kd_unit' and k.kd_cabang='$nama_cab' order by k.kd_cabang, k.nrp,j.kd_perspektif");

while ($row = mysqli_fetch_array($mahasiswa)){

    if($row['kd_parameter']==1)
    {
     $mahasiswaa = mysqli_query($konek, "SELECT DISTINCT u.nama_unit FROM tbl_unit u, tbl_parameter p  where u.kd_unit=p.kd_unit and p.kd_unit=$kd_unit");

     while ($roww = mysqli_fetch_array($mahasiswaa)){
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(10,7,'',0,1);
            $pdf->Cell(150,6,'Unit                '.': '.$roww['nama_unit'],0,1);   
                   }

            $pdf->Cell(150,6,'Nrpp               '.': '.$row['nrp'],0,1); 
            $pdf->Cell(150,6,'Nama             '.': '.$row['nama'],0,1); 

    $pdf->Cell(10,7,'',0,1);
 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(30,6,'NAMA PERSPEKTIF',1,0,'C');
    $pdf->Cell(70,6,'NAMA PARAMETER',1,0, 'C');
    $pdf->Cell(17,6,'TARGET',1,0,'C');
    $pdf->Cell(17,6,'REALISASI',1,0,'C');
    $pdf->Cell(15,6,'PENC (%)',1,0,'C');  
    $pdf->Cell(17,6,'NILAI',1,0,'C');
    $pdf->Cell(19,6,'SUB BOBOT',1,0,'C');
    $pdf->Cell(19,6,'SUB SCORE',1,0,'C');
    $pdf->Cell(19,6,'KPI BOBOT',1,0,'C');
    $pdf->Cell(19,6,'KPI SCORE',1,0,'C');
    $pdf->Cell(19,6,'BOBOT PERS',1,0,'C');
     $pdf->Cell(15,6,'TOTAL',1,1,'C');

    if($row['Nomor']=='X')
    {
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(30,6,$row['nama_perspektif'],1,0);
    $pdf->Cell(70,6,$row['nama_parameter'],1,0);
    $pdf->Cell(17,6,$row['target'].'%',1,0);
    $pdf->Cell(17,6,$row['realisasi'].'%',1,0); 
    $pdf->Cell(15,6,$row['pencapaian'].'%',1,0);
    $pdf->Cell(17,6,$row['nilai'],1,0);
    $pdf->Cell(19,6,$row['sub_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['sub_score'],1,0);
    $pdf->Cell(19,6,$row['kpi_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['kpi_score'],1,0); 
    $pdf->Cell(19,6,$row['bobot_perspektif'],1,0);  
    $pdf->Cell(15,6,$row['total_score'],1,1);   
    }
    else
    {
    $pdf->Cell(30,6,'',1,0);
    $pdf->Cell(70,6,$row['nama_parameter'],1,0);
    $pdf->Cell(17,6,$row['target'].'%',1,0);
    $pdf->Cell(17,6,$row['realisasi'].'%',1,0); 
    $pdf->Cell(15,6,$row['pencapaian'].'%',1,0);
    $pdf->Cell(17,6,$row['nilai'],1,0);
    $pdf->Cell(19,6,$row['sub_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['sub_score'],1,0);
    $pdf->Cell(19,6,$row['kpi_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['kpi_score'],1,0); 
    $pdf->Cell(19,6,$row['bobot_perspektif'],1,0);  
    $pdf->Cell(15,6,$row['total_score'],1,1);   
    }  
    }
    else
    {
    if($row['Nomor']=='X')
    {
    $pdf->Cell(30,6,$row['nama_perspektif'],1,0);
    $pdf->Cell(70,6,$row['nama_parameter'],1,0);
    $pdf->Cell(17,6,$row['target'].'%',1,0);
    $pdf->Cell(17,6,$row['realisasi'].'%',1,0); 
    $pdf->Cell(15,6,$row['pencapaian'].'%',1,0);
    $pdf->Cell(17,6,$row['nilai'],1,0);
    $pdf->Cell(19,6,$row['sub_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['sub_score'],1,0);
    $pdf->Cell(19,6,$row['kpi_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['kpi_score'],1,0); 
    $pdf->Cell(19,6,$row['bobot_perspektif'],1,0);  
    $pdf->Cell(15,6,$row['total_score'],1,1);   
    }
    else
    {
    $pdf->Cell(30,6,'',1,0);
    $pdf->Cell(70,6,$row['nama_parameter'],1,0);
    $pdf->Cell(17,6,$row['target'].'%',1,0);
    $pdf->Cell(17,6,$row['realisasi'].'%',1,0); 
    $pdf->Cell(15,6,$row['pencapaian'].'%',1,0);
    $pdf->Cell(17,6,$row['nilai'],1,0);
    $pdf->Cell(19,6,$row['sub_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['sub_score'],1,0);
    $pdf->Cell(19,6,$row['kpi_bobot'].'%',1,0);
    $pdf->Cell(19,6,$row['kpi_score'],1,0); 
    $pdf->Cell(19,6,$row['bobot_perspektif'],1,0);  
    $pdf->Cell(15,6,$row['total_score'],1,1);     
    }  
    }
}


 
$pdf->Output();
?>