<html>
<head>
<title>Update Tabel Kantor</title>
</head>
<?php
   include "../config.php";
   $perintah="SELECT * FROM tbl_kantor WHERE kd_kantor='$_GET[id]'";
   $hasil=mysqli_query($konek,$perintah);
   $data=mysqli_fetch_row($hasil);
   error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   
?>
<body>
 
<form action="kantor.php" method="post" name="form1" target="_parent">
  <table width="564" border="0" align="center">
    <tr bgcolor="#009999">
      <td colspan="2">

        <div align="center">Update
        </div></td></tr>
    <tr bgcolor="#CCCCCC">
      <td width="92" bgcolor="#CCCCCC">Kode kantor </td>
      <td width="357"><label>
        <input type="text" name="kd_kantor"
		<?php
		    echo "value=$data[0]";
		?>
		>
      </label></td>
    </tr>
    <tr bgcolor="#DDDDDD">
      <td>kantor</td>
      <td><label>
        <textarea name="nm_kantor" type="text">
		<?php
		    echo "$data[1]";
		?>
		</textarea>
    
      </label></td>
    </tr>		
    <tr bgcolor="#DDDDDD">
      <td>Tipe</td>
      <td><label>
       <input type="text" name="tipe"
    <?php
        echo "value=$data[2]";
    ?>
    >
    
      </label></td>
    </tr>   
    <tr bgcolor="#DDDDDD">
      <td>Parent</td>
      <td><label>
       <input type="text" name="parent"
    <?php
        echo "value=$data[3]";
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
