<?php

$nidn = $_SESSION['username'];
$semester = $_SESSION['semester'];

?>
<!-- ALERT CUSTOM -->
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/sweetalert2.min.css">
<section id="configuration">
	<div class="row">
	
		<div class="col-md-12 content-body">	  
		<div class="card card-content">
		<div class="card-body row">
				
				<div class="col-xl-12 col-lg-6 col-md-12">
				
					
					<!-- FORM INPUT SOAL -->
					
					  <div class="card-body">
						<form class="form" method="post" >
						  <div class="form-body"><h5><i class="ft-zap"></i> <b>DATA SOAL UJIAN</b><hr/></h5>
							<div class="row">
							  <div class="form-group col-md-7">
								<select name="mapel" id="mapel" class="form-control border-primary pepe" required>
								  <option value=''>PILIH MATERI PELAJARAN</option>
								   <?php
									$query = mysqli_query($config, "SELECT a.idmk, a.mkl FROM nio_mkl a
INNER JOIN m_soal b ON a.idmk=b.id_mapel WHERE id_mapel IN (SELECT id_mapel FROM m_jawaban WHERE id_murid='$nidn')
GROUP BY idmk");
									while($row = mysqli_fetch_array($query)){
									echo "<option class='pepe' value='$row[idmk]'>$row[mkl]</option>";
									}			
								  ?>					 
								</select>
								<code class='f12 danger'> <b>Nama Materi Pelajaran</b></code>
							  </div>
							   
							  
							 
							
							  <div class="form-group col-md-4">
								<a onclick="javascript:pilih_soal()" class="btn btn-block btn-primary "><b>PILIH</b></a>
						</form>
							  </div>
							</div>
						  </div>
						<div class="col-xl-12 col-lg-6 col-md-12">
					<div class="table-responsive">
						<div class="tampildata">
						</div>
					</div>
				</div>
					 </div>
					</div>
					
				</div>	
				
				
				
		</div>
		</div> 
		
		
	  <!-- AKHIR LISD ADMINNA -->
	  
	</div>
</section>
<script src="themes/js/scripts/soal.js" type="text/javascript"></script>
  <!-- ALERT CUSTOM -->
    <script src="themes/sweetalert/js/jquery.min.js"></script> 
    <script src="themes/sweetalert/js/sweetalert2.min.js"></script> 
    <script src="themes/sweetalert/js/bootstrap.min.js"></script>

<script>
	//$(document).ready(function () {
	 function pilih_soal(){
	 	mapel = document.getElementById('mapel').value;
	 	//alert(mapel);
	// 		$.ajax({
	//         data:({mapel:mapel,}),
	//         type: 'POST',
	//         url: "apps/ambil_ujian.php",
	//         success: function() {
	//           $('.tampildata').load("apps/ambil_ujian.php?mapel="+mapel);
	//         }
	//       });
	// }

		
	      var data = $('.form').serialize();
	      //alert(data);
	      $.ajax({
	        type: 'POST',
	        url: "apps/jembatan.php",
	        data: data,
	        success: function() {
	         $('.tampildata').load("apps/lihat_hasil_jawaban.php?id_mapel="+mapel);
	        }
	      });
	    
	}
//});
	
</script>
