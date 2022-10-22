
	  
	  
<section id="configuration">
<div class="row">
	<div class="col-md-12">
	
	<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
	//AKSI SUPERUSER 
			if(isset($_REQUEST['act'])){
						$act = $_REQUEST['act'];
						switch ($act) {
						  case 'add':
							$pt = $_REQUEST['a1'];
							$mk = $_REQUEST['a2'];
							$kls = $_REQUEST['a3'];
							$isi = $_REQUEST['bio'];

							$ekstensi = array('rar','zip','doc','docx','pdf');					
							$file = $_FILES['file']['name'];
							$x = explode('.', $file);
							$eks = strtolower(end($x));
							$ukuran = $_FILES['file']['size'];
							$target_dir = "include/modul/";
							//jika form file tidak kosong akan mengeksekusi script dibawah ini
								if($file != ""){
								$rand = rand(1,99999999);
								$nfile = $rand."-".$file;
								//validasi file
									if(in_array($eks, $ekstensi) == true){
										if($ukuran < 7500000){
										move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);
										$query = mysqli_query($config, "INSERT INTO nio_modul(id_kel,username,idmk,isi,file,pertemuan,date,hits)
												VALUES('$kls','$_SESSION[username]','$mk','$isi','$nfile','$pt',NOW(),'0')");

											if($query == true){
											$_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
											header("Location: ./admin.php?page=mdl");
											die();
											} else {
											$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
											echo '<script language="javascript">window.history.back();</script>';
											}
										} else {
											$_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
											echo '<script language="javascript">window.history.back();</script>';
										}
									}else {
									$_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.RAR, *.ZIP, *.DOC, *.DOCX atau *.PDF!';
											header("Location: ./admin.php?page=mdl");
									}
								} else {
								//jika form file kosong akan mengeksekusi script dibawah ini
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
											echo '<script language="javascript">window.history.back();</script>';
								}
						  break;
						  case 'del':				  
							$idmodul = mysqli_real_escape_string($config, $_REQUEST['idm']);
							$query = mysqli_query($config, "SELECT * FROM  nio_modul WHERE  idm='$idmodul'");
							while($row = mysqli_fetch_array($query)){
								unlink("include/modul/".$row['file']);}
								$query = mysqli_query($config, "DELETE FROM nio_modul WHERE idm='$idmodul'");
								$query = mysqli_query($config, "DELETE FROM nio_unduh WHERE idm='$idmodul'");
								if($query == true){
									$_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
									header("Location: ./admin.php?page=mdl");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=mdl";
										  </script>';
								}
						  break;
						}
					}

	?>
	<div class="row">
		<div class="col-md-12 content-body">	  
			<div class="card card-content">
			  <div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5"><?php require_once "superuser.php"; ?> </div>
				<div class="col-xl-8 col-lg-6 col-md-12">
					<?php
					if(isset($_SESSION['succAdd'])){
						$succAdd = $_SESSION['succAdd'];
						echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succAdd.'
						</div>';unset($_SESSION['succAdd']);
					}
					if(isset($_SESSION['errFormat'])){
						$errFormat = $_SESSION['errFormat'];
						echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$errFormat.'
						</div>';unset($_SESSION['errFormat']);
					}
					if(isset($_SESSION['succDel'])){
						$succDel = $_SESSION['succDel'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDel.'
						</div>';unset($_SESSION['succDel']);
					}
					if(isset($_SESSION['succDel'])){
						$succDel = $_SESSION['succDel'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDel.'
						</div>';unset($_SESSION['succDel']);
					}
					?>
					 
					<h4 class='d-none d-md-block'>MODUL HASIL UJIAN SISWA - E-Belajar</h4>
					<p class='f14 d-none d-md-block'>Halaman hasil ujian siswa "<i class='primary'>Pastikan anda memilih kelas sekolah sesuai dengan modul yang akan anda upload untuk siswa anda</i>"</p>
				</div>
				<div class="col-xl-12 col-lg-6 col-md-12">				
					<div id='EditProfile' aria-expanded='false' class="card-content collapse entry">
					  <div class="card-body">
						<form class="form" method="POST" action="?page=mdl&act=add" enctype="multipart/form-data">
						  <div class="form-body"><h5><i class="ft-file-text"></i> <b>POKOK MODUL</b><hr/></h5>
							<div class="row">
							  <!--div class="form-group col-md-3 mb-2"><label>JENIS MATERI <span class='pink'>On</span> </label>
								<select name="a1" class="form-control border-primary" required>
								  <option value=''></option>
								  <option value='Penuntun Praktikum'>Buku Penuntun Praktikum</option>
								  <option value='e-Books'>e-Books Perkuliahan</option>
								  <option value='ModulModul 1'>Pertemuan - 1</option><option value='Modul2'>Pertemuan - 2</option><option value='Modul3'>Pertemuan - 3</option><option value='Modul4'>Pertemuan - 4</option>
								  <option value='Modul5'>Pertemuan - 5</option><option value='Modul6'>Pertemuan - 6</option><option value='Modul7'>Pertemuan - 7</option><option value='Modul8'>Pertemuan - 8</option>
								  <option value='Modul9'>Pertemuan - 9</option><option value='Modul10'>Pertemuan - 10</option><option value='Modul11'>Pertemuan - 11</option><option value='Modul12'>Pertemuan - 12</option>
								  <option value='Modul13'>Pertemuan - 13</option><option value='Modul14'>Pertemuan - 14</option><option value='Modul15'>Pertemuan - 15</option><option value='Modul16'>Pertemuan - 16</option>
								</select>
							  </div-->
							  <div class="form-group col-md-3 mb-2"><label>KELAS MENGAJAR</label>
								<select name="a3" class="form-control border-primary pepe" required>
								  <option value=''></option>
								  <?php
									$query = mysqli_query($config, "SELECT a.*,b.jurusan FROM nio_kelas a INNER JOIN  nio_jurusan b ON a.idj = b.idj ");
									while($row = mysqli_fetch_array($query)){
									echo "<option class='pepe' value='$row[id_kel]'>$row[kelas] -  $row[jurusan]</option>";
									}			
								  ?>					 
								</select>
							  </div>
							  <div class="form-group col-md-6 mb-2"><label>MATERI PELAJARAN</label>
								<select name="a2" class="form-control border-primary pepe" required>
								  <option value=''></option>
								  <?php
									$query = mysqli_query($config, "SELECT * FROM nio_mkl");
									while($row = mysqli_fetch_array($query)){
									echo "<option class='pepe' value='$row[idmk]'>$row[mkl]</option>";
									}			
								  ?>					 
								</select>
							  </div>
							  <div class="form-group col-md-12"><label>UPLOAD MODUL</label>
								<input type="file" name="file" id='file' class="form-control border-primary" required>					
								<code class="f12 primary m-2">Format file <b class="black">*RAR, *ZIP, *DOC, *DOCX, *PDF </b>dan ukuran maksimal file 7 MB!</code>
							  </div>
							  <div class="form-group col-md-12"><label>DESCRIPTION MODUL</label>
								<textarea class="ckeditor form-control" name="bio" id='ckedtor'  required></textarea>
							  </div>
							</div>
						  </div>
						  <div class="form-actions right">
							<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> <b>UPLOAD NOW</b></button>
							<button type="button" data-toggle='collapse' data-target='#EditProfile' class="btn btn-warning mr-1"><i class="ft-x"></i> <b>CANCEL</b></button>
						  </div>
						</form>
					 </div>
					</div>
				
				</div>
			  </div>
			</div> 
		</div>
		
		
		<div class="col-md-12">
		<div class="card-content card">
			<div class="card-body card-dashboard">
			<table class="table table-borderless bg-lighten-4 zero-configuration">			
				<thead class=''>
					<tr>
					<th>Tanggal Soal<br/></th>
					<th>Nama Siswa<br/></th>
					<th class='text-center'>Mata Pelajaran<br/></th>
					<th class='text-right'>Tanggal Jawab Siswa<br/></th>
					<th class='text-right'>Nilai Siswa<br/></th>
					</tr>
				</thead>
			  <tbody>
				<?php
				$nidn = $_SESSION['nidn'];
				$query = mysqli_query($config, "SELECT a.tgl_input AS tgl_soal, c.nama AS nm_siswa, d.mkl AS mapel, b.tgl_jawab AS tgl_jwb, b.nilai FROM m_soal a
INNER JOIN m_jawaban b ON a.id_soal=b.kode_soal
INNER JOIN nio_user c ON b.nidn=c.username
INNER JOIN nio_mkl d ON a.id_mapel=d.idmk
WHERE a.id_guru='$nidn'
GROUP BY a.id_soal
ORDER BY b.tgl_jawab DESC");
				if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)){
				//$unduhan = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_unduh WHERE idm='$row[idm]'"));
				$date_soal = tgl_indo($row['tgl_soal']);
				$date_jwb = tgl_indo($row['tgl_jwb']);
				//$ekstensi = array('zip','rar');
				//$ekstensi2 = array('doc','docx');
				//$file = $row['file']; $x = explode('.', $file); $eks = strtolower(end($x));
				 
				echo"
						  <td>
					    <b class='primary'>$date_soal</b><br/> 
						
					  </td>
					  <td>
					    <b class='primary'>$row[nm_siswa]</b><br/> 
						
					  </td>
					  <td width='17%'>						
						<p class='text-left f14'>
							<b class='primary'> $row[mapel]</b>
						</p>
					  </td>
					  <td class='text-truncate text-right' width='15%'>
						<b class='primary'>$date_jwb</b>
						
					  </td>
					  <td class='text-truncate text-right' width='15%'>
						<b class='primary'>$row[nilai]</b>
						
					  </td>
					</tr>  
				  ";
				}
				} 			  
				?>
				
			  </tbody>
			</table>
			</div>
        </div>	
		</div>	
	  <!-- AKHIR LISD ADMINNA -->
	</div>
	
	<!-- AWAL HALAMAN MAHASISWA -->
	<?php } else{
		$semester = $_SESSION['semester'];
	
	echo'
			<div class="card-content card">
			<div class="card-body card-dashboard">
			<table class="table table-borderless zero-configuration">
				<thead>
				  <tr><th class="text-center pepe dark f20" colspan="4">Hasil Ujian Anda</th></tr>
				  <tr class="text-left">
					<th>Tanggal Jawab <br/> <span class="f12"></th>
					<th>Mata Pelajaran<br/><span class="f12"></th>
					<th>Nilai Anda<br/><span class="f12"></th>
				  </tr>
				</thead>
				<tbody>';
				$nidn = $_SESSION['username'];
				$query = mysqli_query($config, "SELECT a.tgl_jawab, b.mkl AS mapel, a.nilai FROM m_jawaban a
INNER JOIN nio_mkl b ON a.id_mapel=b.idmk WHERE nidn='$nidn' and a.semester='$semester'
GROUP BY id_mapel");				
				while($row = mysqli_fetch_array($query)){

				$date = tgl_indo($row['tgl_jawab']);
				echo"
				  <tr>
					<td><b class='f13 primary'>$date</b><br/><span class='f12'></td>
					<td>
						<b class='f13 primary'>$row[mapel]</b><br/> 
						
					</td>
					<td width='15%'>
						<p class='text-center f12'>
							<b class='teal'> $row[nilai]</b>
						</p>
					</td>
					
				  </tr>";
				}
			echo'
				</tbody>
			</table>
			</div>
			
			
			</div>
			';
	
	} ?>
	<!-- AKHIR HALAMAN MAHASISWA -->
	</div>
</div>
</section>
	