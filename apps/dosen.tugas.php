<section id="configuration">
	<div class="row">
	<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
		//QUERI DAN INFO ADMIN
		if(isset($_REQUEST['act'])){
                $act = $_REQUEST['act'];
                switch ($act) {
				  case 'add':
					$b1= $_REQUEST['b1'];
					$b2 = $_REQUEST['b2'];
					$b3 = $_REQUEST['b3'];
					$b4 = $_REQUEST['b4'];
						

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
										$query = mysqli_query($config, "INSERT INTO nio_tugas(id_kel,username,jenis,date,dateline,act,file) VALUES('$b4','$_SESSION[username]','$b1','$b2','$b3','A','$nfile')");

											if($query == true){
											$_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
											header("Location: ./admin.php?page=tgs");
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
				  case 'disabled':				  
            		$disabledtgs = mysqli_real_escape_string($config, $_REQUEST['idt']);
                        $query = mysqli_query($config, "UPDATE nio_tugas SET act='D' WHERE idt='$disabledtgs'");
                		if($query == true){
                            $_SESSION['succDesable'] = '<b>Berhasil !! </b> Upload Tugas Telah anda Ditutup <br/>';
                            header("Location: ./admin.php?page=tgs");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tgs";
                                  </script>';
                		}
				  break;
				  case 'del':				  
            		$deltgs = mysqli_real_escape_string($config, $_REQUEST['idt']);
                        $query = mysqli_query($config, "DELETE FROM nio_tugas WHERE idt='$deltgs'");
                        $query2 = mysqli_query($config, "DELETE FROM nio_uptugas WHERE idt='$deltgs'");
                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=tgs");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tgs";
                                  </script>';
                		}
				  break;
                }
			}	
		?>
	
		<div class="col-md-12 content-body">	  
		<div class="card card-content">
		<div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5"><?php require_once "superuser.php"; ?> </div>
				<div class="col-xl-8 col-lg-6 col-md-12">
					<?php
					//INFORMASI AKSI
					if(isset($_SESSION['succAdd'])){
						$succAdd = $_SESSION['succAdd'];
						echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succAdd.'
						</div>';unset($_SESSION['succAdd']);
					}
					if(isset($_SESSION['Editok'])){
						$Editok = $_SESSION['Editok'];
						echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$Editok.'
						</div>';unset($_SESSION['Editok']);
					}
					if(isset($_SESSION['succDel'])){
						$succDel = $_SESSION['succDel'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDel.'
						</div>';unset($_SESSION['succDel']);
					}
					if(isset($_SESSION['succDesable'])){
						$succDesable = $_SESSION['succDesable'];
						echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDesable.'
						</div>';unset($_SESSION['succDesable']);
					}
					?>
					<a data-toggle="collapse" data-target="#EditProfile" class="btn btn-primary white  float-right ml-2"><i class="ft-calendar"></i> BUAT TUGAS BARU</a>
					<h4 class='d-none d-md-block'>BUAT ACTION TUGAS - Upload Tugas</h4>
					<p class='f14 d-none d-md-block'>Halaman Entri Tugas "<i class='primary'>Pilih kelas untuk tugas siswa anda, tentukan jadwal mulai dan akhir dari upload tugas & anda dapat menutup akhir dari tugas anda buat.</i>"</p>
					
					<!-- FORM PADA TUGAS -->
					<div id='EditProfile' aria-expanded='false' class="card-content collapse entry">
					  <div class="card-body" style="margin-bottom:-50px;">
						<form class="form" method="POST" action="?page=tgs&act=add" enctype="multipart/form-data">
						  <div class="form-body"><h5><i class="ft-calendar"></i> <b>CREATE TUGAS</b><hr/></h5>
							<div class="row">
							  <div class="form-group col-md-12">
								<input type="text" name="b1" class="form-control border-primary"  placeholder="Judul tugas" required>
								<code class='f12 black'> Judul Tentang Tugas</code>
							  </div>
							   <div class="form-group col-md-12"><label>UPLOAD TUGAS</label>
								<input type="file" name="file" id='file' class="form-control border-primary" required>					
								<code class="f12 primary m-2">Format file <b class="black">*RAR, *ZIP, *DOC, *DOCX, *PDF </b>dan ukuran maksimal file 7 MB!</code>
							  </div>
							  <div class="form-group col-md-3">
								<input type="date" name="b2" class="form-control border-primary" placeholder="Angkatan" required>
								<code class='f12 primary'> Start Upload</code>
							  </div>
							  <div class="form-group col-md-3">
								<input type="date" name="b3" class="form-control border-primary" placeholder="Angkatan" required>
								<code class='f12 primary'> Close Upload</code>
							  </div>
							  <div class="form-group col-md-4">
								<select name="b4" class="form-control border-primary" required>
								  <option value=''>Pilih Kelas</option>
								  <?php
									$query = mysqli_query($config, "SELECT a.*,b.jurusan FROM nio_kelas a INNER JOIN  nio_jurusan b ON a.idj = b.idj");
									while($row = mysqli_fetch_array($query)){
									echo "<option value='$row[id_kel]'>$row[kelas]-  $row[jurusan]</option>";
									}			
								  ?>					 
								</select><code class='f12 primary'>For Kelas</code>
							  </div>
							  <div class="form-group col-md-2">
								<button type="submit" name="submit" class="btn btn-primary"><b>CREATE</b></button>
							  </div>
							</div>
						  </div>
						</form>
					 </div>
					</div>
					
				</div>
		</div>
		</div> 
		<div class="card-content card"  style="margin-top:-20px;">
			<div class="card-body card-dashboard">
			<table class="table table-borderless zero-configuration">
				<thead>
				  <tr>
					<th>Action<br/><span class="f12"> Aksi Administrator</span></th>
					<th>Management Tugas<br/><span class="f12"> Inforamsi Tugas Siswa / Kelas</span></th>
				  </tr>
				</thead>
			  <tbody>
				<?php
				$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_tugas,nio_user WHERE nio_kelas.id_kel=nio_tugas.id_kel AND nio_user.username=nio_tugas.username AND nio_tugas.username='$_SESSION[username]'");				
				while($row = mysqli_fetch_array($query)){				
				$date = tgl_indo($row['date']);
				$dateline = tgl_indo($row['dateline']);
				echo"
				  <tr>
					  <td width='18%'>
						<a href='?page=chektugas&idt=$row[idt]' class='btn btn-block btn-primary text-left' ><b><i class='ft-file-text'></i> PERIKSA TUGAS</b></a>";
						  if ($row['act'] == 'A'){ echo"<a href='?page=tgs&act=disabled&idt=$row[idt]' class='btn btn-block btn-sm btn-success text-left'><i class='ft-bell-off'></i> TUTUP SESI TUGAS</a>
						 		 <a href='include/modul/$row[file]' class='btn btn-block btn-sm btn-success text-left'><i class='ft-airplay'></i> Download Tugas</a>

													  <a href='?page=tgs&act=del&idt=$row[idt]' class='btn btn-block btn-sm btn-danger text-left' > <i class='ft-trash-2'></i> HAPUS SESI INI</a>";}
						  else{echo"<a href='cetak.php?act=tugas&idt=$row[idt]' target='_blank' class='btn btn-block btn-sm btn-warning text-left'><i class='ft-printer'></i> CETAK DATA TUGAS</a>";}
						echo"						
					  </td>  <td><p>$row[jenis] <br/><span class='teal f14'> <b class='danger'>Open : </b>$date - <b class='danger'>Close :</b> $dateline </span><hr/>
					  <span class='teal f12'> ";
						$sumupload = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_uptugas WHERE idt='$row[idt]'"));
						  if ($row['act'] == 'A'){ echo"
						  <span class='badge badge-pill badge-primary mr-1 f12'> <b>$sumupload</b> Tugas Siswa Masuk</span>
						  <b class='badge badge-pill badge-secondary f12 mr-1'>Sesi Dibuka</b>";}
						  else{echo"
						  <span class='badge badge-pill badge-success mr-1 f12'> Total <b>$sumupload</b> Tugas</span>
						  <b class='badge badge-pill badge-danger mr-1 f12'>Sesi telah ditutup</b> ";}						 
					  echo"<span class='f14'>Tugas Kelas : <b class='danger'>$row[kelas]</b> </span>
					  </span> </p>
					  </td>
					  
					</tr>";
				}
							  
				?>
				
			  </tbody>
			</table>
			</div>
        </div>	
		</div>
		
		
		<div class="col-md-12">
		
      </div>	
	  <!-- AKHIR LISD ADMINNA -->
	  
	  <?php } else {	
		
		if(isset($_REQUEST['pepe'])){
			$idtugas = $_REQUEST['b1'];
					$nim = $_REQUEST['b2'];
					$dosen = $_REQUEST['b3'];
							$ekstensi = array('rar','zip','doc','docx','pdf');					
							$file = $_FILES['file']['name'];
							$x = explode('.', $file);
							$eks = strtolower(end($x));
							$ukuran = $_FILES['file']['size'];
							$target_dir = "include/tugas/";
							//jika form file tidak kosong akan mengeksekusi script dibawah ini
								if($file != ""){
								$rand = rand(1,999);
								$nfile = $nim."-".$rand."-".$file;
								//validasi file
									if(in_array($eks, $ekstensi) == true){
										if($ukuran < 5500000){
										move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);
										$query = mysqli_query($config, "INSERT INTO nio_uptugas (idt,dosen,username,file,act)
												VALUES('$idtugas','$dosen','$_SESSION[username]','$nfile','C')");

											if($query == true){
											$_SESSION['PepeOK'] = 'SUKSES! Data berhasil ditambahkan';
											header("Location: ./admin.php?page=tgs");
											die();
											} else {
											$_SESSION['PepeX'] = 'ERROR! Ada masalah dengan query';
											header("Location: ./admin.php?page=tgs");
											}
										} else {
											$_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
											echo '<script language="javascript">window.history.back();</script>';
										}
									}else {
									$_SESSION['errFormat'] = 'Format file yang diperbolehkan *.RAR *.ZIP *.DOC *.DOCX atau *.PDF!';
											header("Location: ./admin.php?page=mdl");
									}
								} else {
								
								}
        }
	  echo'<div class="col-md-12 content-body">	  
		<div class="card card-content">
		<div class="card-body">';
		
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
		
			$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_tugas,nio_user WHERE nio_user.username=nio_tugas.username AND nio_kelas.id_kel=nio_tugas.id_kel AND nio_tugas.act='A' AND nio_kelas.id_kel='$_SESSION[kls]'");
			if(mysqli_num_rows($query) > 0){
			while($row = mysqli_fetch_array($query)){
				$date = tgl_indo($row['date']);
				$dateline = tgl_indo($row['dateline']);
				
				$ada = mysqli_query($config, "SELECT username, idt FROM nio_uptugas WHERE idt='$row[idt]' AND username='$_SESSION[username]'");
				if(mysqli_num_rows($ada) > 0){
				echo"<div class='col-md-12 mb-2'>
					 <div class='alert alert-icon-left alert-info alert-dismissible mb-2' role='alert'> 
						<h6 class='pepe'><i class='icon-user f12'></i> $_SESSION[username] - $_SESSION[nama]</h6>
						ANDA TELAH BERHASIL MELAKUKAN PENGIRIMAN <b>1</b> SESI E-TUGAS INI SEBELUMNYA<br/>
						<span class='f12'> Informasi ini akan hilang saat proses pengiriman tugas telah berakhir</span>
					</div>
					</div>";
					 
				}else{
				echo"<div class='col-md-12'>
				<div class='row mb-3'>
				<div class='col-md-5'>
				<h5><b class='secondary f18'>TUGAS TENTANG :</b> <hr/><SPAN  class='secondary f16'> $row[jenis]</h5><hr/>				
				<p>
				<b>Mulai Kirim </b>: <code class='danger'>$date</code> <br/>
				<b>Berakhir Kirim</b> : <code class='pink'>$dateline</code> <br/></p>
				
				<p> <b>Kelas :</b>  <code class='teal'>$row[kelas]</code> <br/>
				<b>Nama Guru :</b>  <code class='teal'>$row[nama]</code> <br/>
				<a href='include/modul/$row[file]' target='_blank' class='danger'><b class='badge badge-pill badge-dark'>Download Tugas</b></a></p>
				</p>
				</div>
				
				";				
				echo "
				<div class='col-md-7'>
				<form class='form' method='POST' action='?page=tgs' enctype='multipart/form-data'>
				  <div class='form-body'>
					<div class='row'>
					  <div class='form-group col-md-12'>
						<input type='hidden' name='b1' class='form-control border-primary'  value='$row[idt]' required>
						<input type='hidden' name='b3' class='form-control border-primary'  value='$row[username]' required>
						<input type='hidden' name='b2' class='form-control border-primary'  value='$_SESSION[username]' required>
					  </div>
					  <div class='form-group col-md-8'>					
						<h6 class='pepe mt-1'><i class='ft-users f16'></i> : $_SESSION[username] - $_SESSION[nama]</h6>
						<input type='file' name='file' class='form-control border-primary' placeholder='Angkatan' required>		
						<code class='f12 primary m-2'>Format file <b class='black'>*RAR *ZIP *PDF *DOC *DOCX </b> or <b class='black'>*ZIP </b></code>
					  </div>
					  <div class='form-group col-md-4'>
						<button type='submit' name='pepe' class='btn btn-primary mt-3'><i class='ft-layers'></i> <b>KIRIM TUGAS</b></button>
					  </div>
					</div>
					Catatan :
					<ul style='text-align:justify;' class='f12'>
						<li><i>Pastikan Tugas yanga anda upload sudah benar-benar sesuai dengan format permintaan tugas.</i></li>
						<li><i>Jika anda belum melakukan upload tugas pada jadwal yang telah ditentukan, silahkan menghubungi Guru bersangkutan.</i></li>
					</ul>
				  </div>
				</form>
				</div>
				</div>
				</div><hr/>
				";					
				}
				
				
			}
			} else { ?>
			<div class='col-md-12 mb-2'>
					 <div class='alert alert-icon-left alert-info alert-dismissible mb-2' role='alert'> 
						<h6 class='pepe'><i class='icon-user f12'></i> SESI E-TUGAS ANDA SAAT INI MASIH KOSONG</h6>
						<span class='f12'> AutoSys akan memberi Notifikasi pada menu anda jika ketersediaan pengiriman tugas.</span>
					</div>
					</div>
			<div class="col-md-12">
				<div class="alert alert-light mb-2 text-center" role="alert">
				<h3> TUGAS TIDAK TERSEDIA or DITUTUP !!</h3><hr/>
				<b>AutoSys </b> akan memberi Notifikasi pada menu anda jika ketersediaan pengiriman tugas.				
				</div>
			</div>
			
			<div class="card-body card-dashboard">
			<table class="table table-borderless zero-configuration">
			  <thead>
				<tr><th>No</th> <th>Nama Jenis Tugas</th> <th>Print</th> </tr>
			  </thead>
			  <tbody>
				<?php
				  $query = mysqli_query($config, "SELECT * FROM nio_uptugas,nio_user,nio_tugas WHERE nio_uptugas.idt=nio_tugas.idt AND nio_uptugas.username=nio_user.username AND nio_uptugas.username='$_SESSION[username]' ORDER BY nio_user.nama ASC");
					while($row = mysqli_fetch_array($query)){
					echo"
					<tr>		  
					  <td><b>$row[username]</b><br/> $row[nama]</td>
					  <td><i class='f14'>$row[jenis]</i></td>
					  <td width='20%'><a  href='cetak.php?act=unduh&idm=$row[idupt]' target='_blank' class='badge badge-pill badge-primary'> <i class='ft-printer'></i> Print Bukti</a>
					  <span class='badge badge-pill badge-info'>$row[act]</span></td>
					</tr>";
					}			  
				?>
				
			  </tbody>
			</table>
			</div>
			
			
			
		<?php	}
		echo'
		</div>
		</div>
		</div>
		';
	  } ?>
	  
	  
	</div>
</section>
