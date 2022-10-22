<?php
include "../include/config.php";
session_start();
$nidn = $_SESSION['username'];
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
                  	
                  
                  	$data = mysqli_query($config, "SELECT a.id_soal, a.id, a.soal, b.nama, a.opsi_a,a.opsi_b,a.opsi_c,a.opsi_d,a.opsi_e,a.jawaban FROM m_soal a
							INNER JOIN nio_user b ON a.id_mapel=b.id_mapel
							WHERE a.id_mapel='$id_mapel'");
                  	while($row=mysqli_fetch_array($data)) { 
                  		$soal = $row['soal'];
                  		$id_soal = $row['id_soal'];
                  		$jawaban = $row['jawaban'];
                  		?>
					
                <div class="panel panel-default">
                	<div class="panel-heading">
						#<?php echo $no++; ?>
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $no; ?>" aria-expanded="true" aria-controls="collapseOne">
                		<?php echo substr($row['soal'], 0, 100); ?></a>
                	</div>
                	<div id="collapse<?php echo $no; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              			<div class="panel-body">
              				<input type="hidden" name="soal" id="soal" value="<?php echo $soal ?>">
              				
              					<table class="table table-bordered" id="restutabel"><tbody>
						              <?php 
						              $arra = array("a","b","c","d","e");
						              for ($i=0; $i<sizeof($arra);$i++) {
						                $opsi = "opsi_".$arra[$i];
						                $restu = $row['id'];
						            
						                  echo "<tr><td width='2%'><input type='radio' name=".$row['id']." id=".$row['id']." 
						                  value=".$arra[$i]."></td><td width='98%'>".$row[$opsi]."</td></tr>";
						               //	 echo "<input type='text' name=".$row['id']." id=".$row['id']." >";
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
					<input type="hidden" name="nidn" id="nidn" value="<?php echo $nidn ?>">
					<input type="hidden" name="id_mapel" id="id_mapel" value="<?php echo $id_mapel ?>">
					<input type="hidden" name="id_soal" id="id_soal" value="<?php echo $id_soal ?>">
					<input type="hidden" name="kunci_jwb" id="kunci_jwb" value="<?php echo $jawaban ?>">
              		<div class="form-group col-md-4">
								<button onclick="javasript:uji()" class="btn btn-block btn-primary pepe"><b>SUBMIT JAWABAN</b></button>
				          </div>

                  <div class="center padding" style="margin-top:10%;"  id="tombol_submit" >
      <br>
      <button type="submit" name="submit_nilai" class="btn blue round-large margin-top margin-bottom hover-new-blue" style="font-size: 1.3em;width:80%;">Submit Jawaban</button>
    </div>
		
<script src="themes/js/scripts/soal.js" type="text/javascript"></script>
  <!-- ALERT CUSTOM -->
    <script src="themes/sweetalert/js/jquery.min.js"></script> 
    <script src="themes/sweetalert/js/sweetalert2.min.js"></script> 
    <script src="themes/sweetalert/js/bootstrap.min.js"></script>
    <script>
    	function uji(){
    		alert('sip');
    		$('#restutabel').datagrid('selectAll');
  			var rows = $('#restutabel').datagrid('getSelections');
  			alert(rows);
    		// var jum_soal = "<?php echo $jum_soal?>";
    		// var id_soal = "<?php echo $restu?>";

//     		  for(var i=0;i<rows.length;i++){            
//     cidx      = rows[i].idx;
//     ckdgiat   = rows[i].kdkegiatan;
//     cnospd    = rows[i].no_spd;
//     ckdrek    = rows[i].kdrek5;
//     cnmrek    = rows[i].nmrek5;
//     cnilai    = angka(rows[i].nilai1);
// no        = i + 1 ;      
// $(document).ready(function(){      
//   $.ajax({
//     type     : 'POST',
//     url      : "<?php  echo base_url(); ?>index.php/tukd/dsimpan",
//     data     : ({cno_spp:a,cskpd:kode,cgiat:ckdgiat,crek:ckdrek,ngiat:cnmgiat,nrek:cnmrek,nilai:cnilai,kd:no,no_spdq:cnospd,no_bukti1:cnobukti1}),
//     dataType : "json"
//   });
// });
// }


    		//alert(rows);
    	}
    </script>
                  	



