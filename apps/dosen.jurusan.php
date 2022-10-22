<section id="configuration">
	<div class="row">
	
		<div class="col-md-12 content-body">	  
		<div class="card card-content">
		<div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5"><?php require_once "superuser.php"; ?> </div>
				<div class="col-xl-8 col-lg-6 col-md-12">
				<?php if( $_SESSION['level'] == 'A'){ 
				//QUERI DAN INFO ADMIN
				if(isset($_REQUEST['act'])){
						$act = $_REQUEST['act'];
						switch ($act) {
						  case 'add':
							$idpro = $_REQUEST['idpro'];
							$jrs = $_REQUEST['a1'];
							$akta = $_REQUEST['a3'];
								$query = mysqli_query($config, "INSERT INTO nio_jurusan(idj,id_pro,idus,jurusan,fakultas,akta) VALUES('$idpro','$idpro','$_SESSION[username]','$jrs','','$akta')");
									if($query == true){
										$_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
										header("Location: ./admin.php?page=jrs");
										die();
									} else {
										$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
										echo '<script language="javascript">window.history.back();</script>';
									}
						  break;
						  case 'edit':				  				  
							$idjur = mysqli_real_escape_string($config, $_REQUEST['idj']);
							$query = mysqli_query($config, "SELECT * FROM  nio_jurusan WHERE  idj='$idjur'");
							while($row = mysqli_fetch_array($query)){
							echo "
							<div class='card'>
							<div class='card-body'>
								<form class='form' method='POST' action='?page=jrs&act=editok' enctype='multipart/form-data'>
								  <div class='form-body'><h5><i class='ft-edit'></i> <b>EDIT JURUSAN <span class='danger float-right mr-2'>$row[jurusan]<span></b></h5><hr/>
									<div class='row'>
									  <div class='form-group col-md-4'>
										<input type='text' name='id_pro' class='form-control border-primary' value='$row[id_pro]' required>
										<input type='hidden' name='idx' class='form-control border-primary' value='$row[idj]' required>
										<code class='f12'><b>Kode Jurusan</b></code>
									  </div>
									  <div class='form-group col-md-8'>
										<input type='text' name='a11' class='form-control border-primary' value='$row[jurusan]' required>
										<code class='f12'><b>Nama Jurusan</b></code>
									  </div>
								
									  <div class='form-group col-md-3'>
										<button type='submit' name='submit' class='btn btn-warning btn-block'><b>UPDATE</b></button>
									  </div>
									</div>
								  </div>
								</form>
							</div>
							</div>
							";}
						  break;
						  case 'editok':				  
							if(isset($_REQUEST['submit'])){					   
								$idx = $_REQUEST['idx'];					   
								$idpro = $_REQUEST['id_pro'];				   
								$xjrs = $_REQUEST['a11'];
								$xfkl = $_REQUEST['a21'];
								$xakta = $_REQUEST['a31'];
								$query = mysqli_query($config, "UPDATE nio_jurusan SET id_pro='$idpro',jurusan='$xjrs',fakultas='$xfkl',akta='$xakta' WHERE idj='$idx'");
								if($query == true){
									$_SESSION['Editok'] = 'PROSES UPDATE !! Jurusan Success<br/>';
									header("Location: ./admin.php?page=jrs");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=jrs";
										  </script>';
								}
							}
						  break;
						  case 'delete':				  
							$idjure = mysqli_real_escape_string($config, $_REQUEST['idj']);
								$query = mysqli_query($config, "DELETE FROM nio_jurusan WHERE idj='$idjure'");
								if($query == true){
									$_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
									header("Location: ./admin.php?page=jrs");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=jrs";
										  </script>';
								}
						  break;
						}
					}	
					
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
					
					
					?>
					<a data-toggle="collapse" data-target="#EditProfile" class="btn btn-primary white  float-right ml-2"><b><i class="ft-zap"></i></b> CREATE NEW</b></a>
					<h4 class='d-none d-md-block'>CREATE JURUSAN</h4>
					<p class='f14 d-none d-md-block'>Halaman Entri Jurusan "<i class='primary'>Entri Jurusan yang ada di sekolah anda anda bisa dikosongkan jika anda inginkan.</i>"</p>
					
					
					<!-- FORM PADA TUGAS -->
					<div id='EditProfile' aria-expanded='false' class="card-content collapse entry mb-2">
					  <div class="card-body">						
						<form class="form" method="POST" action="?page=jrs&act=add" enctype="multipart/form-data">
						  <div class="form-body"><h5><i class="ft-file-text"></i> <b>TAMBAH JURUSAN</b><hr/></h5>
							<div class="row">
							  <div class="form-group col-md-4">
								<input type="text" name="idpro" class="form-control border-primary" placeholder="Kode Jurusan" required>
								<code class='f12'><b>Kode Jurusan</b></code>
							  </div>
							  <div class="form-group col-md-8">
								<input type="text" name="a1" class="form-control border-primary" placeholder="Jurusan" required>
								<code class='f12'><b>Nama Jurusan</b></code>
							  </div>
							 <!-- <div class="form-group col-md-4">
								<input type="text" class="form-control border-primary" value="Fakultas Kesehatan" disabled>
								<code class='f12'><b>Fakultas</b></code>
							  </div>
							  <div class="form-group col-md-5">
								<input type="text" name="a3" class="form-control border-primary" placeholder="Akta BAN-PT">
								<code class='f12'><b>Akta BAN-PT</b></code>
							  </div>-->
							  <div class="form-group col-md-2">
								<button type="submit" name="submit" class="btn btn-primary"><b>TAMABKAN</b></button>
							  </div>
							</div>
						  </div>
						</form>
					 </div>
					</div>
					<table class="table table-striped table-bordered" style='margin-top:50px;'>
						<thead>
						  <tr class=''><th>Nama Jurusan</th><th>Action</th></tr>
						</thead>
					  <tbody>
						<?php
						$query = mysqli_query($config, "SELECT * FROM nio_jurusan");
						if(mysqli_num_rows($query) > 0){
						while($row = mysqli_fetch_array($query)){
						  echo"
							<tr>
							  <td><span class='f12'>$row[fakultas] </span><br/><b class='secondary f20'>$row[jurusan]</b><br/> 
							  <td width='15%'>
										<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-dark'><i class='ft-inbox f16'></i></button>
										<button type='button' class='btn btn-secondary dropdown-toggle f14' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' href='?page=jrs&act=edit&idj=$row[idj]' ><i class='ft-edit'></i> <b>Edit Jurusan</b></a>
											<a class='dropdown-item fbold danger' href='?page=jrs&act=delete&idj=$row[idj]'><i class='ft-trash-2'></i>  <b>Delete Jurusan</b></a>
										</div>
										</div>
							  </td>
							</tr>				  
						  ";
						}
						} else {
							echo "<h4> Maaf Akun anda belum Terdaftar</h4>";
						}					  
						?>						
					  </tbody>
					</table>
					
					
					<!-- ADD JURUSAN UNTUK DOSEN -->
					<?php }elseif($_SESSION['level'] == 'D'){ ?>
					<h4 class="d-none d-md-block"><b>PENAMBAHAN JURUSAN</b></h4> 
					<p class="alert alert-warning"><b>SysTerintegrasi</b> - <i class="black">"<b>gURU</b> tidak dapat menambah <b>Jurusan </b> pada master data ini - Untuk melakukan penambahan, silahkan hubungi <b>Superuser</b> pada Sistem ini"</i></p>
					
					<table class="table table-striped table-bordered" style='margin-top:50px;'>
						<thead>
						  <tr><th> Program Studi</th><th>Action</th></tr>
						</thead>
					  <tbody>
						<?php
						$query = mysqli_query($config, "SELECT * FROM nio_jurusan");
						if(mysqli_num_rows($query) > 0){
						while($row = mysqli_fetch_array($query)){
						  echo"
							<tr>
							  <td><b class='secondary f20'>$row[jurusan]</b><br/> <span class='f12'>$row[fakultas] Akta BAN-PT : $row[akta]</span>
							  <p class='alert alert-warning collapse f14 mt-1' id='Dele$row[idj]' aria-expanded='false'><b>Guru</b> tidak dapat menghapus jurusan : <b class='dark'>$row[jurusan]</b> ini. Untuk menghapus hanya dapat dilakukan oleh <b>Superuser</b> </p>
							  <p id='edit$row[idj]' aria-expanded='false' class='alert alert-dark collapse f14 mt-1' role='alert'><b>Guru</b> juga tidak diberikan akses dalam mengedit Jurusan : <b class='dark'>$row[jurusan]</b> ini - Silahkan hubungi <b>Superuser</b> pada Sistem ini</p>
							  </td>
							  <td width='15%'>
										<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-dark'><i class='ft-inbox f24'></i></button>
										<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' href='#' data-toggle='collapse' data-target='#edit$row[idj]'><i class='ft-edit'></i> <b>Edit Jurusan</b></a>
											<a class='dropdown-item fbold danger' href='#' data-toggle='collapse' data-target='#Dele$row[idj]'><i class='ft-trash-2'></i>  <b>Delete Jurusan</b></a>
										</div>
										</div>
							  </td>
							</tr>				  
						  ";
						}
						} else {
							echo "<h4> Maaf Akun anda belum Terdaftar</h4>";
						}					  
						?>						
					  </tbody>
					</table>
				</div>
		</div>
		</div> 
		</div>
		
		
	  <!-- AKHIR LISD ADMINNA -->
	  
		<?php } else { header("Location: ./");} ?>
	  
	  
	</div>
</section>