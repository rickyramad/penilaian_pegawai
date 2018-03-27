<html>
<head>
<title>Update Tabel Pegawai</title>
</head>
<?php
   include "../config.php";
   $perintah="SELECT * FROM tbl_pegawai WHERE nrpp='$_GET[id]'";
   $hasil=mysqli_query($konek,$perintah);
   $data=mysqli_fetch_row($hasil);
   error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   
?>
<body>
 
<form action="pegawai.php" method="post" name="form1" target="_parent">
  <table width="564" border="0" align="center">
    <tr bgcolor="#009999">
      <td colspan="2">

        <div align="center">Update
        </div></td></tr>
    <tr bgcolor="#CCCCCC">
      <td width="92" bgcolor="#CCCCCC">Nrpp </td>
      <td width="357"><label>
        <input type="text" name="nrpp"
		<?php
		    echo "value=$data[0]";
		?>
		>
      </label></td>
    </tr>
    <tr bgcolor="#DDDDDD">
      <td>Nama</td>
      <td><label>
        <textarea name="nama" type="text">
		<?php
		    echo "$data[1]";
		?>
		</textarea>
    
      </label></td>
    </tr>		
    <tr bgcolor="#DDDDDD">
      <td>Kode Kantor</td>
      <td><label>
       <input type="text" name="kd_cabang"
    <?php
        echo "value=$data[2]";
    ?>
    >
    
      </label></td>
    </tr>   

    <tr bgcolor="#009999">
      <td colspan="2"><div align="right">
        <label>
        <input type="submit" name="tombol_update" value="Submit">
				<input type="submit" name="tombol_update" value="Cancel">
        </label>
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
