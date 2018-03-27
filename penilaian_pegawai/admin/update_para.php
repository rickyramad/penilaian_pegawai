<html>
<head>
<title>Update Tabel Perspektif</title>
</head>
<?php
   include "../config.php";
   $perintah="SELECT * FROM tbl_parameter WHERE kode='$_GET[id]'";
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
<form action="parameter.php" method="post" name="form1" target="_parent">
  <table width="564" border="0" align="center">
    <tr bgcolor="#009999">
      <td colspan="2">

        <div align="center">Update
        </div></td></tr>
    <tr bgcolor="#CCCCCC">
      <td width="92" bgcolor="#CCCCCC">Nama Perspektif </td>
      <td width="357"><label>
       <select name="kd_perspektif"  class="form-control">
                                      <?php
                      include '../config.php';

                      $query = "SELECT DISTINCT p.kd_perspektif,p.nama_perspektif, j.kd_perspektif FROM tbl_perspektif p, tbl_parameter j where p.kd_perspektif=j.kd_perspektif";
                      $hasil = mysqli_query($konek,$query);
                      while($dataa=mysqli_fetch_array($hasil)){
                        if($dataa[2]==$data[0])
                        {
                          echo "<option selected value=$dataa[0]> $dataa[0]-$dataa[1]</option>";
                      }
                      else{
                         echo "<option value=$dataa[0]> $dataa[0]-$dataa[1]</option>";
                      }
                        
                      }
      

                      ?></select>
      </label></td>
    </tr>

     <tr bgcolor="#DDDDDD">
      <td>Kode Parameter</td>
      <td><label>
        <input name="kd_parameter" onkeypress="return hanyaAngka(event, false)" type="text"
    <?php
        echo "value=$data[1]";
    ?>
    >
    
      </label></td>
    </tr>   

    <tr bgcolor="#DDDDDD">
      <td>Nama Unit</td>
      <td><label>
       <select name="nama_unit"  class="form-control">
                                      <?php
                      include '../config.php';

                      $query = "SELECT DISTINCT u.kd_unit,u.nama_unit FROM tbl_unit u,tbl_parameter p where u.kd_unit=p.kd_unit";
                      $hasil = mysqli_query($konek,$query);
                      while($dataa=mysqli_fetch_array($hasil)){
                          if($dataa[0]==$data[2])
                        {
                          echo "<option selected value=$dataa[0]> $dataa[0]-$dataa[1]</option>";
                      }
                      else{
                         echo "<option value=$dataa[0]> $dataa[0]-$dataa[1]</option>";
                      }
                      }
      

                      ?></select>
    
      </label></td>
    </tr>		

    <tr bgcolor="#DDDDDD">
      <td>Nomor Parameter</td>
      <td><label>
        <input name="no_parameter" type="text"
    <?php
        echo "value=$data[3]";
    ?>
    >
    
      </label></td>
    </tr>   

     <tr bgcolor="#DDDDDD">
      <td>Nama Parameter</td>
      <td><label>
        <textarea name="nama_parameter" type="text">
    <?php
        echo "$data[4]";
    ?>
     </textarea>
    
      </label></td>
    </tr>   

     <tr bgcolor="#DDDDDD">
      <td>KPI Bobot</td>
      <td><label>
        <input name="kpi_bobot" onkeypress="return hanyaAngka(event, false)" type="text"
    <?php
        echo "value=$data[5]";
    ?>
    >
    
      </label></td>
    </tr>   

    <tr bgcolor="#DDDDDD">
      <td>Sub Bobot</td>
      <td><label>
        <input name="sub_bobot" onkeypress="return hanyaAngka(event, false)" type="text"
    <?php
        echo "value=$data[6]";
    ?>
    >
    
      </label></td>
    </tr>   

     <tr bgcolor="#DDDDDD">
      <td>Bobot Perspektif</td>
      <td><label>
        <input name="bobot_pers" onkeypress="return hanyaAngka(event, false)" type="text"
    <?php
        echo "value=$data[7]";
    ?>
    >
    
      </label></td>
    </tr>   

      <tr bgcolor="#DDDDDD">
      <td>Kode Primary</td>
      <td><label>
        <input name="kode" onkeypress="return hanyaAngka(event, false)" type="text"
    <?php
        echo "value=$data[8]";
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
