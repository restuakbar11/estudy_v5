<?php

$nidn = $_SESSION['nidn'];
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
				<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
				//QUERI DAN INFO ADMIN

					//INFORMASI AKSI
					
					
					?>
					
					
					<!-- FORM INPUT SOAL -->
					
					  <div class="card-body">
						<form class="form" method="POST" >
						  <div class="form-body"><h5><i class="ft-zap"></i> <b>CREATE SOAL ESSAY UJIAN</b><hr/></h5>
							<div class="row">
							  <div class="form-group col-md-7">
								<select name="mapel" id="mapel" class="form-control border-primary pepe" required>
								  <option value=''>PILIH MATERI PELAJARAN</option>
								   <?php
									$query = mysqli_query($config, "SELECT * FROM nio_mkl");
									while($row = mysqli_fetch_array($query)){
									echo "<option class='pepe' value='$row[idmk]'>$row[mkl]</option>";
									}			
								  ?>					 
								</select>
								<code class='f12 danger'> <b>Nama Materi Pelajaran</b></code>
							  </div>
							   
							  <div class="form-group col-md-2">
								<input type="number" name="bobot" id="bobot" class="form-control border-primary" placeholder="Bobot" required>
								<input type="hidden" name="semester" id="semester" value="<?php echo $semester ?>">
								<code class='f12 danger'> <b>Bobot</b></code>
							  </div>
							  <div class="form-group col-md-5">
								<select name="jenis_mapel" id="jenis_mapel" class="form-control border-primary pepe" required>
								  <option value='7'>Kelas VII</option>
								  <option value='8'>kelas VIII</option>
								  <option value='9'>kelas IX</option>
								</select>
								<code class='f12 danger'> <b>Kelas</b></code>
								<input type="hidden" name="nidn" id="nidn" value="<?php echo $nidn ?>">
							  </div>
							  <div class="form-group col-md-4">
								<input type="text" name="kd_soal" id="kd_soal" class="form-control border-primary" placeholder="Kode Soal" required>
								<code class='f12 danger'> <b>Kode Soal</b></code>
							  </div>
							  <!-- <div class="form-group col-md-5">
								<input type="file" id="logo" class="form-control border-primary" name="logo">
								<code class="f12 primary m-2">Gambar Soal <b class="black">*PNG</b> & Filesize <b class="black">2</b> MB!</code>								
							  </div> -->
							   <div class="form-group col-md-12"><label>Dekskripsi Soal Ujian</label>
								<textarea class="form-control" name="soal" id='soal'  required></textarea>
							  </div>
							  <div class="form-group col-md-12">
								<textarea type="text" name="jawaban" id="jawaban" class="form-control border-primary"  placeholder="Jawaban A" required></textarea>
								<code class='f12 danger'> <b>JAWABAN</b></code>
							  </div>
							  
							  
							  <div class="form-group col-md-4">
								<a onclick="javasript:simpan_essay()" class="btn btn-block btn-primary pepe"><b>TAMBAHKAN</b></a>
							  </div>
							</div>
						  </div>
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
		
		
	  <!-- AKHIR LISD ADMINNA -->
	  
		<?php } else { header("Location: ./admin.php?page=mrd_essay");} ?>
	  
	  
	</div>
</section>
<script src="themes/js/scripts/soal.js" type="text/javascript"></script>
  <!-- ALERT CUSTOM -->
    <script src="themes/sweetalert/js/jquery.min.js"></script> 
    <script src="themes/sweetalert/js/sweetalert2.min.js"></script> 
    <script src="themes/sweetalert/js/bootstrap.min.js"></script>
