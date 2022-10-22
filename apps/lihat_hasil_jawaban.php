<?php
include "../include/config.php";

//$nidn = $_SESSION['username'];
?>
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
						<p>
                		<input style="background-color:#dff0d8;width:20px;border:solid 1px #000000" disabled="disabled">
                		<b>Jawaban Yang Benar</b>&nbsp;
                		<input style="background-color:yellow;width:20px;border:solid 1px #000000" disabled="disabled">
                		<b>Jawaban Anda</b>&nbsp;
						</p>
							
				<?php

                  	$no = 1; //batasan halaman
                  	
					$id_mapel = urldecode($_GET['id_mapel']);
                  	$data = mysqli_query($config, "SELECT a.soal, b.nama, a.opsi_a,a.opsi_b,a.opsi_c,a.opsi_d,a.opsi_e,a.jawaban FROM m_soal a
							INNER JOIN nio_user b ON a.id_mapel=b.id_mapel
							WHERE a.id_mapel='$id_mapel'");
                  	while($row=mysqli_fetch_array($data)) { ?>
				
                <div class="panel panel-default">
                	<div class="panel-heading">
						#<?php echo $no++; ?>
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $no; ?>" aria-expanded="true" aria-controls="collapseOne">
                		<?php echo substr($row['soal'], 0, 100); ?></a>
                	</div>
                	<div id="collapse<?php echo $no; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              			<div class="panel-body">
              					<table class="table table-bordered"><tbody>
						              <?php 
						          //     $cek_jawaban = mysqli_query($config, "SELECT * FROM m_jawaban WHERE nidn='123456' AND id_mapel='7'");
						          //     while($row=mysqli_fetch_array($data)) {
						          // }
						              $arra = array("a","b","c","d","e");
						              for ($i=0; $i<sizeof($arra);$i++) {
						                $opsi = "opsi_".$arra[$i];
						                
						                if ($row['jawaban'] == strtoupper($arra[$i])) {
						                  echo "<tr style='background: #dff0d8'><td width='2%'>".$arra[$i]."</td><td width='98%'>".$row[$opsi]."</td></tr>";
						                } else if ($row['jawaban']==strtoupper($arra[$i])){
						                echo "<tr style='background:yellow'><td width='2%'>".$arra[$i]."</td><td width='98%'>".$row[$opsi]."</td></tr>";	
						                }else{
						                  echo "<tr><td width='2%'>".$arra[$i]."</td><td width='98%'>".$row[$opsi]."</td></tr>";
						                }
						              }
						              ?>
						              </tbody>
            					</table>
                		</div>
              		</div>
          		</div>

			
				
	
					<?php
					} 
					?>	

				
		

                  	



