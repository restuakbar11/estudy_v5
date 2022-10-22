
	  
	  
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
					 <a data-toggle="collapse" data-target="#EditProfile" class="btn btn-primary white  float-right ml-2"><i class="ft-file-plus"></i> BUAT MODUL BARU</a>
					<h4 class='d-none d-md-block'>MODUL MATERI - E-Belajar</h4>
					<p class='f14 d-none d-md-block'>Halaman Entri modul belajar siswa "<i class='primary'>Pastikan anda memilih kelas sekolah sesuai dengan modul yang akan anda upload untuk siswa anda</i>"</p>
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
					<th>Action<br/><span class="f12">Option</span></th>
					<th>Keterangan Module<br/><span class="f12"> Kelas</span></th>
					<th class='text-center'>Informasi<br/><span class="f12">Unduh - View</span></th>
					<th class='text-right'>Author<br/><span class="f12"> Pengelola Module</span></th>
					</tr>
				</thead>
			  <tbody>
				<?php
				$query = mysqli_query($config, "SELECT * FROM  nio_modul,nio_kelas,nio_mkl,nio_jurusan WHERE nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_kelas.idj=nio_jurusan.idj AND nio_modul.username='$_SESSION[username]' order by idm DESC");
				if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)){
				$unduhan = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_unduh WHERE idm='$row[idm]'"));
				$date = tgl_indo($row['date']);
				$ekstensi = array('zip','rar');
				$ekstensi2 = array('doc','docx');
				$file = $row['file']; $x = explode('.', $file); $eks = strtolower(end($x));
				  echo"
					<tr>
					  <td width='15%'>
						";
						if(in_array($eks, $ekstensi) == true){echo "<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-warning'><i class='fa fa-file-archive-o f26  text-white'></i></button>";}	
						else {
							if(in_array($eks, $ekstensi2) == true){echo "<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-primary'><i class='fa fa-file-word-o f24'></i></button>";} 
							else {echo "<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-danger'><i class='fa fa-file-pdf-o f24'></i></button>";}	
						}
						echo"
						<button type='button' class='btn btn-secondary dropdown-toggle f14' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
						<div class='dropdown-menu'>
							<a class='dropdown-item' href='cetak.php?act=unduh&idm=$row[idm]' target='_blank' ><i class='ft-printer f14'></i> <b>Print Report</b></a>
							<a class='dropdown-item' href='?page=views&idm=$row[idm]' target='_blank' ><i class='ft-eye f14'></i> <b>Show Detail</b></a>
							<a class='dropdown-item' href='include/modul/$row[file]' target='_blank' ><i class='ft-airplay f14'></i> Download File</a>
							<a class='dropdown-item fbold cyan' href='?page=mdl&act=del&idm=$row[idm]'><i class='f16 ft-trash-2'></i> <b>Delete Pelajaran</b></a>
						</div>
						</div>
					  </td>
					  <td>
					    <b class='f18'>$row[kelas]</b><br/> 
						<span class='f13'><i class='ft-cloud-rain'></i> $row[mkl]</span><br/>
						<span class='f12'><b class='badge badge-pill badge-warning'>Jurusan : $row[jurusan]</b></span>  <span class='f12'><b class='badge badge-pill badge-primary pepe'> file : $row[pertemuan]</b></span>
					  </td>
					  <td width='17%'>						
						<p class='text-left f14'>
							<i class='ft-download-cloud f16'></i> <b class='primary'>$unduhan</b>  Unduh <br/>
							<i class='ft-eye f16'></i><b class='primary'> $row[hits]</b>  Views<br/>
						</p>
					  </td>
					  <td class='text-truncate text-right' width='15%'>
						<h5>$date</h5>
						<span class='f14'>$_SESSION[nama] <i class='ft-user-check danger'></i></span>
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
	
	echo'
			<div class="card-content card">
			<div class="card-body card-dashboard">
			<table class="table table-borderless zero-configuration">
				<thead>
				  <tr><th class="text-center pepe dark f20" colspan="4">Daftar Pelajaran Anda</th></tr>
				  <tr class="text-left">
					<th>Kelas <br/> <span class="f12">  Kelas</span></th>
					<th>Pelajaran <br/><span class="f12"> Uploder & Pertemuan</span></th>
					<th>Online<br/><span class="f12"> Unduhan & Hits</span></th>
					<th>Action<br/><span class="f12"> Downloader</span> </th>
				  </tr>
				</thead>
				<tbody>';
				$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_modul,nio_mkl,nio_jurusan,nio_user WHERE nio_modul.username=nio_user.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_kelas.idj=nio_jurusan.idj AND nio_kelas.id_kel='$_SESSION[kls]' order by pertemuan ASC");				
				while($row = mysqli_fetch_array($query)){
				$date = tgl_indo($row['date']);
				echo"
				  <tr>
					<td><b class='f13 primary'>$row[jurusan]</b><br/><span class='f12'>Guru: <b class='teal'>$row[nama]</b></span> <br/> <span class='f12'>Kelas : <b class='danger'>$row[kelas]</b></span></td>
					<td>
						<b class='f13 primary'>$row[mkl]</b><br/> 
						 <span class='f13'>$date</span>- <span class='f12'> Pelajaran in <b>$row[pertemuan]</b></span>
					</td>
					<td width='15%'>
						<p class='text-center f12'>
							<b class='teal'><i class='ft-cloud-rain'></i> $row[unduh]</b>  Unduh  <br/>
							<b class='pink'><i class='ft-star'></i> $row[hits]</b>  Views<br/>
						</p>
					</td>
					<td width='8%' class='text-center'><a href='?page=views&idm=$row[idm]' class='btn btn-secondary mr-1 mb-1' > <i class='ft-check-circle'></i> Unduh Now</a></td>
				  </tr>";
				}
			echo'
				</tbody>
			</table>
			</div>
			
			<div class="card-text card-body m-2">
				<h4 class="pepe"> Keterangan :</h4>
				<p><code>Pelajaran </code> akan menampilkan semua materi pembelajaran yang diupload oleh guru anda, berdasarkan kategori kelas murid. Pastikan anda benar memilih kelas berdasarkan kelas anda, karena mengurangi kesalahan dalam menampilkan daftar bahan / modul perkulihan yang anda ikuti.</p>
			</div>
			</div>
			';
	
	} ?>
	<!-- AKHIR HALAMAN MAHASISWA -->
	</div>
</div>
</section>
	