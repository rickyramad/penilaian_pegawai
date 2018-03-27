<html>
<head>
<title>Update Tabel User</title>
</head>
<?php
   include "../config.php";
   $perintah="SELECT * FROM tbl_regist WHERE kd_kepegawaian='$_GET[id]'";
   $hasil=mysqli_query($konek,$perintah);
   $data=mysqli_fetch_row($hasil);
   error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   
?>
<body>
  <script language="javascript">
                function hanyaAngka(e, decimal) {
                var key;
                var keychar;
                 if (window.event) {
                     key = window.event.keyCode;
                 } else
                 if (e) {
                     key = e.which;
                 } else return true;
               
                keychar = String.fromCharCode(key);
                if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
                    return true;
                } else
                if ((("0123456789").indexOf(keychar) > -1)) {
                    return true;
                } else
                if (decimal && (keychar == ".")) {
                    return true;
                } else return false;
                }
            </script>
<form action="ubah.php" method="post" name="form1" target="_parent">
  <table width="564" border="0" align="center">
    <tr bgcolor="#009999">
      <td colspan="2">

        <div align="center">Update
        </div></td></tr>
    <tr bgcolor="#CCCCCC">
      <td width="92" bgcolor="#CCCCCC">Kode Kepegawaian </td>
      <td width="357"><label>
        <input type="text" onkeypress="return hanyaAngka(event, false)" name="kode_kepegawaian"
		<?php
		    echo "value=$data[0]";
		?>
		>
      </label></td>
    </tr>
    <tr bgcolor="#DDDDDD">
      <td>Level</td>
      <td><label>
        <input name="level" type="text"
		<?php
		    echo "value=$data[4]";
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
