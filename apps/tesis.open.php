
<div class="card">
<div class="card-body">
	<!-- HALAMAN PADA ADMIN & DOSEN -->
	<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
		//QUERI DAN INFO ADMIN
		if(isset($_REQUEST['act'])){
		$act = $_REQUEST['act'];
			switch ($act) {
			case 'ok':
			  $disabledtgs = mysqli_real_escape_string($config, $_REQUEST['idpe']);
			  $query = mysqli_query($config, "UPDATE nio_tesis SET ked='O' WHERE id='$disabledtgs'");
			  if($query == true){
				$_SESSION['succDesable'] = '<b>Approved Aply </b> Anda dapat memulai bimbingan bersama Mahasiswa anda!!<br/>';
				echo '<script language="javascript">window.history.back();</script>';
			  } else {
				$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
				echo '<script language="javascript">window.history.back();</script>';
			  }
			break;
			case 'clear':
			  $disabledtgs = mysqli_real_escape_string($config, $_REQUEST['idpe']);
			  $query = mysqli_query($config, "UPDATE nio_tesis SET ked='X' WHERE id='$disabledtgs'");
			  if($query == true){
				$_SESSION['bimbolOK'] = '<b>Bimbingan Close</b> Anda telah selesai membimbing Mahasiswa anda!! <br/>';
				echo '<script language="javascript">window.history.back();</script>';
              } else {
				$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
				echo '<script language="javascript">window.history.back();</script>';
			  }
			break;
			case 'delete':
			  $disabledtgs = mysqli_real_escape_string($config, $_REQUEST['idpe']);
			  $query = mysqli_query($config, "UPDATE nio_tesis SET ked='X' WHERE id='$disabledtgs'");
			  if($query == true){
				$_SESSION['bimbolOK'] = '<b>Bimbingan Close</b> Anda telah selesai membimbing Mahasiswa anda!! <br/>';
				echo '<script language="javascript">window.history.back();</script>';
              } else {
				$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
				echo '<script language="javascript">window.history.back();</script>';
			  }
			break;
			}
		}	else {
		?>
	<div class="card-body card-dashboard text-center mb-2 d-none d-md-block">
		 <?php
		  echo" <div class='disp'>";
			$query2 = mysqli_query($config, "SELECT institusi,alamat,prov,url,email,telp,logo FROM nio_edosen");
                    list($institusi,$alamat,$prov,$url,$email,$telp,$logo) = mysqli_fetch_array($query2);
                    if(!empty($institusi)){ echo '<h6 class="up" id="lapz">'.$institusi.'</h6><br/>';} 
					else { echo '<h6 class="up" id="nama"></h6><br/>';}
                    echo '<h6 class="up" id="nama">DAFTAR BIMBINGAN TUGAS SISWA </h6><br/>';
			echo"
			</div>";
		 ?>
	</div>
	
	<?php
	if(isset($_SESSION['succDesable'])){
						$succDesable = $_SESSION['succDesable'];
						echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDesable.'
						</div>';unset($_SESSION['succDesable']);
	}
					if(isset($_SESSION['bimbolOK'])){
						$bimbolOK = $_SESSION['bimbolOK'];
						echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$bimbolOK.'
						</div>';unset($_SESSION['bimbolOK']);
					}
	?>
	<div class="table-responsive mt-3">
	<table class="table table-striped mb-0">
	  <thead>
		<tr>
		  <th width='23%'>ACTION</th>
		  <th><i class='ft-users f14'></i> </th>
		  <th>NPM & NAMA</th>
		  <th width='37%'>JUDUL TUGAS</th>
		  <th width='14%'>CEK SURAT</th>
		</tr>
      </thead>
	  <tbody>
	  <?php
	  $query = mysqli_query($config, "SELECT * FROM nio_tesis,nio_user WHERE nio_tesis.idtesis=nio_user.username AND nio_tesis.dosen='$_SESSION[username]' order by ked ASC");
		while($row = mysqli_fetch_array($query)){		
		echo"
		<tr>
		  <td>";
		  if ($row['ked']=='N'){ echo"
			<a href='?page=tesis&act=delete&idpe=$row[id]' class='badge badge-pill badge-danger' data-toggle='tooltip' data-original-title='Tolak & Hapus'><i class='ft-x-circle f14'></i> </a>
			<a href='?page=tesis&act=ok&idpe=$row[id]' class='badge badge-pill badge-secondary' data-toggle='tooltip' data-original-title='Approved Pengajuan Mahasiswa'><i class='ft-check-circle f14'></i> Approved</a>
			";
		  } 
		  elseif ($row['ked']=='O'){ 
		    echo"
			<a href='?page=tesis&act=clear&idpe=$row[id]' class='badge badge-pill badge-success' data-toggle='tooltip' data-original-title='Mahasisw print bersih'><i class='ft-award f14'></i> </a>
			<a href='?page=bimbol&idtesis=$row[idtesis]' class='badge badge-pill badge-info dark' data-toggle='tooltip' data-original-title='Halaman Bimbingan Mahasiswa'><i class='ft-file-text font-small-2'></i> <b>Mulai Bimbingan</b></a>
			";
		  } else {echo"<i class='ft-check-square f14'></i> Bimbingan Selesai";}
		  echo"
		  </td>	  
		  <td><span class='f14'> <b>$row[pmb]</b></span></td> 
		  <td><span class='f14'> <b>$row[idtesis]</b> <br/> $row[nama]</span></td>
		  <td><i class='f14'>$row[judul]</i></td>
		  <td width='3%'><a  href='include/surat/$row[paper]' target='_blank' class='badge badge-pill badge-primary'   data-toggle='tooltip' data-original-title='Cek surat izin bimbingan Fakultas'> <i class='ft-clipboard'></i> Lihat Surat </a></td>
		  
		</tr>";
		}
		
	  
	  ?>
	  </tbody>
	</table>
	</div>
	
	<?php } ?>
	<div class="card-body card-dashboard text-right mt-3">
		<p class="card-text m-2">Guru Pembimbing <br/> <b class='mr-3 danger'><code>TTD</code></b> </p>
		<h4 class="pepe m-2"><?php echo $_SESSION['nama'];?></h4>
		<p class="card-text text-right m-2"> ebelajar<br/> Power by : <a href="https://www.ebelajar.com" data-toggle="tooltip" data-original-title="Instagram Owner">@ebelajar</a></p>
	</div>
	
	
	<!-- HALAMAN PADA MAHASISWA -->
	<?php } else { 
	
	if(isset($_REQUEST['pepe'])){
			$jdl = $_REQUEST['b1'];
			$nim = $_REQUEST['b2'];
			$dosen = $_REQUEST['b3'];
			$pmb = $_REQUEST['b4'];
							$ekstensi = array('zip','pdf');					
							$file = $_FILES['file']['name'];
							$x = explode('.', $file);
							$eks = strtolower(end($x));
							$ukuran = $_FILES['file']['size'];
							$target_dir = "include/surat/";
							//jika form file tidak kosong akan mengeksekusi script dibawah ini
								if($file != ""){
								$rand = rand(1,999);
								$nfile = $nim."-".$rand."-".$file;
								//validasi file
									if(in_array($eks, $ekstensi) == true){
										if($ukuran < 5500000){
										move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);
										$query = mysqli_query($config, "INSERT INTO nio_tesis (ked,idtesis,dosen,judul,paper,pmb)
												VALUES('N','$_SESSION[username]','$dosen','$jdl','$nfile','$pmb')");

											if($query == true){
											$_SESSION['PepeOK'] = 'SUKSES! Data berhasil ditambahkan';
											header("Location: ./admin.php?page=tesis");
											die();
											} else {
											$_SESSION['PepeX'] = 'ERROR! Ada masalah dengan query';
											header("Location: ./admin.php?page=tesis");
											}
										} else {
											$_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
											echo '<script language="javascript">window.history.back();</script>';
										}
									}else {
									$_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.ZIP atau *.PDF!';
											header("Location: ./admin.php?page=mdl");
									}
								} else {								
									$_SESSION['eX'] = 'NDAK NIO KA DAABASE';
											header("Location: ./admin.php?page=tesis");
								}
        }
		
		if(isset($_SESSION['PepeOK'])){
						$PepeOK = $_SESSION['PepeOK'];
						echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$PepeOK.'
						</div>';unset($_SESSION['PepeOK']);
					}
					if(isset($_SESSION['PepeX'])){
						$PepeX = $_SESSION['PepeX'];
						echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$PepeX.'
						</div>';unset($_SESSION['PepeX']);
					}
					if(isset($_SESSION['eX'])){
						$eX = $_SESSION['eX'];
						echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$eX.'
						</div>';unset($_SESSION['eX']);
					}
	?>
	
	
	<div class="card-body">
	
	<?php
	$ada = mysqli_query($config, "SELECT * FROM nio_tesis WHERE idtesis='$_SESSION[username]'");
	//DISINI SELESAI PENGAJUAN SKRIPSI
	if(mysqli_num_rows($ada) > 1){
		while($row = mysqli_fetch_array($ada)){			
		  //SKRIPSI BELUM DI ACC DOSEN
		  if($row['ked'] == 'N'){echo'		  
		  <div class="users-list-padding media-list">
			<div class="media">
			  <div class="media-left pr-1"><span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle border" src="themes/bimbol/icon/cek.png" alt="Generic placeholder image"></span></div>
			  <div class="media-body w-100">
				<h6 class="list-group-item-heading f18"> 
					<b>Status Pandding !!</b><hr/>Pengajuan Tugas belum di ACC oleh Guru Pembimbing anda. Prihal ini dalam tahap pengecekan <b>Guru</b> pembimbing bersangkutan.
				</h6><br/><br/>
				<p class="card-text text-left">  <b>Cek Status Bimbingan Online anda secara berkala</b><br/> Power by : <a href="https://www.instagram.com/ebelajar/" data-toggle="tooltip" data-original-title="Instagram Owner">@ebelajar<a/></p>
			  </div>
			</div>
		  </div>
		  ';} 
		  //SKRIPSI DI ACC DOSEN & DIALIHKAN KE BIMBINGAN
		  elseif($row['ked'] == 'O'){
		  header("Location: ?page=bimbol&idtesis=$_SESSION[username]");
		  }
		  
		  //SKRIPSI DI ACC DOSEN & DIALIHKAN KE BIMBINGAN
		  else {echo'		  
		  <div class="users-list-padding media-list">
			<div class="media">
			  <div class="media-left pr-1"><span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle border" src="themes/bimbol/icon/wisuda.png" alt="Generic placeholder image"></span></div>
			  <div class="media-body w-100">
				<h6 class="list-group-item-heading f18"> 
					<b>Selamat Wisuda</b><hr/>
					Semoga Ujian <b>KOMPRE</b> anda berjalan dengan lancar. Tidak lupa ucapan puji syukur kepada Sang pencipta dan selalu berdoa dalam menjalani segala hal.
				</h6><br/><br/>
				<p class="card-text text-left">ebelajar<br/> Power by : <a href="https://www.ebelajar.com" data-toggle="tooltip" data-original-title="Instagram Owner">@ebelajar<a/></p>
			  </div>
			</div>
		  </div>
		  ';} 
		}
		
	} else { //DISINI HALAMAN PENGAJUAN SKRIPSI 
	?>	
		<div class="card-dashboard text-right mb-3">
			<h4 class="m-2"> Haii .. !! <b class='pepe danger'><?php echo $_SESSION['nama'];?></b></h4>
			<p class="card-text"> Pengajuan  pada Guru anda yang terdapat pada <b>E-Belajar</b> ini dapat dilakukan hanya satu kali. <br/>sebelum melakukan tugas akhir diharapkan belum mengajukan permohonan ini. agar menghindari kesulitan dikemudian hari. </p>
		</div>	
		<form class="form form-horizontal mt-3" method="post" action="?page=tesis" enctype="multipart/form-data">
		  <div class="row m-1">
			<div class="col-xl-12 col-md-12 mb-1">
				<fieldset class="form-group">
				<input type="text" name="b1" class="form-control border-primary" required>
				<input type="hidden" name="b2" class="form-control border-primary" value='<?php echo $_SESSION['username'];?>'>
				<code class='f12'><b>* Masukan Judul  anda ?</b></code>
				</fieldset>
			</div>
			<div class="col-xl-5 col-md-12">
				<fieldset class="form-group">
				<input type='file' name='file' class='form-control border-primary' required>	
				<code class='f12'><b>* Upload surat izin pembimbing anda !!</b></code>
				</fieldset>
			</div>
			<div class="col-xl-3 col-md-12">
				<fieldset class="form-group">
				<select name="b3" class="form-control border-primary" required>
				<option value=''> Pilih Guru</option>
				<?php $query = mysqli_query($config, "SELECT * FROM nio_user WHERE level='D' OR level='A'");
					  while($row = mysqli_fetch_array($query)){
					  echo "<option value='$row[username]'>$row[nama]</option>";}			
				?>					 
				</select>
				<code class='f12'><b>* Pilih Guru pembimbing anda !!</b></code>
				</fieldset>
			</div>
			<div class="col-xl-2 col-md-12">
				<fieldset class="form-group">
				<select name="b4" class="form-control border-primary" required>
				<option value=''> Pilih Pembimbing</option>
				  <option value='1'>PMB 1</option> <option value='2'>PMB 2</option>
				</select>
				<code class='f12'><b>* Pembimbing ke-</b></code>
				</fieldset>
			</div>
			<div class="col-xl-2 col-md-12">
				<button type='submit' name='pepe' class='btn btn-primary'><i class='ft-clipboard'></i> <b>AJUKAN </b></button>
			</div>
		  </div>		
		</form>
	
	<?php } ?>	
	</div>	
	<?php } ?>
	
	
	
	
	
	
	
  
  
  
</div>
</div>