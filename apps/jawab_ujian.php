<?php
include "../include/config.php";
session_start();
$nidn = $_SESSION['username'];
$idkel = $_SESSION['kls'];
$semester = $_SESSION['semester'];

?>
 <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/sweetalert2.min.css">
<style type="text/css">
	.panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
          box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}
.panel-default {
  border-color: #ddd;
}
.panel-default > .panel-heading {
  color: #333;
  background-color: #f5f5f5;
  border-color: #ddd;
}
</style>

		  	<?php
          $no = 1; //batasan halaman
                  	
					$id_mapel = urldecode($_GET['id_mapel']);

                  	$quee = mysqli_query($config, "select kelompok from nio_kelas where id_kel = '$idkel'");
                    
                    while($row=mysqli_fetch_array($quee)) { 
                      $id_kelompok = $row['kelompok'];
                    }

                  	$data = mysqli_query($config, "SELECT a.id_soal as kd_soal, a.id_soal, a.id, a.soal, b.nama, a.opsi_a,a.opsi_b,a.opsi_c,a.opsi_d,a.opsi_e,a.jawaban FROM m_soal a		INNER JOIN nio_user b ON a.id_mapel=b.id_mapel	WHERE a.id_mapel='$id_mapel' and a.kelompok='$id_kelompok'");
                    $jumlah=mysqli_num_rows($data);
                    $urut = 0;
                  	while($row=mysqli_fetch_array($data)) { 
                      $id_soal = $row['id'];
                  		$soal = $row['soal'];  
                      $pilihan_a=$row["opsi_a"];
                      $pilihan_b=$row["opsi_b"];
                      $pilihan_c=$row["opsi_c"];
                      $pilihan_d=$row["opsi_d"];
                      $pilihan_e=$row["opsi_e"];                 		
                  		$jawaban = $row['jawaban'];
                      $kd_soal = $row['kd_soal'];
                  		?>
					

      <form name="form1" method="post" action="apps/proses_jawaban.php">
      <input type="hidden" name="id_soal[]" value=<?php echo $id_soal; ?>>
      <input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
      <input type="hidden" name="kd_soal" value=<?php echo $kd_soal; ?>>
      <input type="hidden" name="semester" value=<?php echo $semester; ?>>
      <tr>
          <td width="17"><font color="#000000"><?php echo $urut=$urut+1; ?></font></td>
          <td width="430"><font color="#000000"><b><?php echo "$soal"; ?></b></font></td>
      </tr></br>
     
      <tr>
          <td height="21"><font color="#000000">&nbsp;</font></td>
          <td><font color="#000000">
            <input name="pilihan[<?php echo $id_soal; ?>]" type="radio" value="A"> A.</font>
            <?php echo "$pilihan_a";?></font> </td>
      </tr>
      <tr>
          <td><font color="#000000">&nbsp;</font></td>
          <td><font color="#000000">
           <input name="pilihan[<?php echo $id_soal; ?>]" type="radio" value="B"> B. 
            <?php echo "$pilihan_b";?></font> </td>
      </tr>
      <tr>
          <td><font color="#000000">&nbsp;</font></td>
          <td><font color="#000000">
          <input name="pilihan[<?php echo $id_soal; ?>]" type="radio" value="C"> C.  
            <?php echo "$pilihan_c";?></font> </td>
      </tr>
      <tr>
        <td><font color="#000000">&nbsp;</font></td>
          <td><font color="#000000">
             <input name="pilihan[<?php echo $id_soal; ?>]" type="radio" value="D"> D.
            <?php echo "$pilihan_d";?></font> </td>
            </tr>
      <tr>
        <td><font color="#000000">&nbsp;</font></td>
          <td><font color="#000000">
             <input name="pilihan[<?php echo $id_soal; ?>]" type="radio" value="E"> E.
            <?php echo "$pilihan_e";?></font> </td>
            </tr></br></br></br></br>
      
    <?php
    }
    ?>
    <input type="hidden" name="id_mapel" id="id_mapel" value="<?php echo $id_mapel ?>">
          <tr>
        <td>&nbsp;</td>
          <td><input type="submit" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
            </tr>
      </table>
</form>

		    


