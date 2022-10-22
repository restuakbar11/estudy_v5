<?php
include "../include/config.php";
session_start();
$nidn = $_SESSION['username'];
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
                  	
                  
                  	$data = mysqli_query($config, "SELECT a.id_soal as kd_soal, a.id_soal, a.id, a.soal, b.nama,a.jawaban FROM m_soal_essay a		INNER JOIN nio_user b ON a.id_mapel=b.id_mapel	WHERE a.id_mapel='$id_mapel' and a.semester='$semester'");
                    $jumlah=mysqli_num_rows($data);
                    $urut = 0;
                  	while($row=mysqli_fetch_array($data)) { 
                      $id_soal = $row['id'];
                  		$soal = $row['soal'];              		
                  		$jawaban = $row['jawaban'];
                      $kd_soal = $row['kd_soal'];
                  		?>
					

      <form name="form1" method="post" action="apps/proses_jawaban_essay.php">
      <input type="hidden" name="id_soal[]" value=<?php echo $id_soal; ?>>
      <input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
      <input type="text" name="kd_soal" value=<?php echo $kd_soal; ?>>
      <input type="hidden" name="soal[<?php echo $id_soal; ?>]" value=<?php echo $soal; ?>>
      <input type="hidden" name="semester" value=<?php echo $semester; ?>>
      <tr>
          <td width="17"><font color="#000000"><?php echo $urut=$urut+1; ?></font></td>
          <td width="430"><font color="#000000"><b><?php echo "$soal"; ?></b></font></td>
      </tr></br>
     
      <tr>
          <td height="21"><font color="#000000">&nbsp;</font></td>
          
      </tr>
      <tr>
        <div class="form-group col-md-12">
                <textarea type="text" name="pilihan[<?php echo $id_soal; ?>]" class="form-control border-primary"  placeholder="Tulis Jawaban Disini....." required></textarea>
                <code class='f12 danger'> <b>JAWABAN</b></code>
                </div>
      </tr>
     </br></br></br></br>
      
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

		    


