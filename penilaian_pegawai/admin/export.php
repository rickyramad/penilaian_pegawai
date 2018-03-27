<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/force-download");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=surat.xls");
 
// Tambahkan table
include 'laporan.php';
?>