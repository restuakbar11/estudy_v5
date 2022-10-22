<section id="configuration">
	<div class="row">
	
		<div class="col-md-12 content-body">	  
		<div class="card card-content">
		<div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5"><?php require_once "superuser.php"; ?> </div>
				<div class="col-xl-8 col-lg-6 col-md-12">
				<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
				//QUERI DAN INFO ADMIN
				if(isset($_REQUEST['act'])){
						$act = $_REQUEST['act'];
						switch ($act) {
						  default:
						  break;
						  case 'add':
							$mkl= $_REQUEST['mkl1'];
							$mkl2= $_REQUEST['mkl2'];
							$mkl3= $_REQUEST['mkl3'];
								$query = mysqli_query($config, "INSERT INTO nio_mkl(idus,mkl,sks,ket,dibuat,dirubah,oleh) VALUES('$_SESSION[username]','$mkl','$mkl2','$mkl3',NOW(),NOW(),'$_SESSION[nama]')");
									if($query == true){
										$_SESSION['succAdd'] = 'CREATE MATKULIAH SUCCESS';
										header("Location: ./admin.php?page=mkl");
										die();
									} else {
										$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
										echo '<script language="javascript">window.history.back();</script>';
									}
						  break;
						  case 'edit':				  				  
							$idmkur = mysqli_real_escape_string($config, $_REQUEST['idmk']);
							$query = mysqli_query($config, "SELECT * FROM nio_mkl WHERE idmk='$idmkur'");
							while($row = mysqli_fetch_array($query)){
							echo "
								<div  style='margin-bottom:380px;'>
								<form class='form' method='POST' action='?page=mkl&act=okepe' enctype='multipart/form-data'>
								  <div class='form-body'><h5><i class='ft-edit'></i> <b>EDIT KELAS</h5><hr/>
									<div class='row'>
									  <div class='form-group col-md-7'>
										<input type='text' name='ax1' class='form-control border-primary' value='$row[mkl]' required>
										<code class='f12'>Pelajaran </code>
										<input type='hidden' name='idm' class='form-control border-primary' value='$row[idmk]' required>
									  </div>
									  <div class='form-group col-md-2'>
										<input type='text' name='ax2' class='form-control border-primary' value='$row[sks]' required>
										<code class='f12'>Bobot </code>
									  </div>
									  <div class='form-group col-md-3'>
										<button type='submit' name='submit' class='btn btn-warning btn-block'><b>UPDATE</b></button>
									  </div>
									</div>
								  </div>
								</form>
								</div>
							";}
						  break;
						  case 'okepe':				  
							if(isset($_REQUEST['submit'])){					   
								$idx = $_REQUEST['idm'];				   
								$mkls = $_REQUEST['ax1'];			   
								$sks = $_REQUEST['ax2'];
								$query = mysqli_query($config, "UPDATE nio_mkl SET mkl='$mkls',sks='$sks',dirubah=NOW(),oleh='$_SESSION[nama]' WHERE idmk='$idx'");
								if($query == true){
									$_SESSION['Editok'] = 'UPDATE PELAJARAN !! Success<br/>';
									header("Location: ./admin.php?page=mkl");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=mkl";
										  </script>';
								}
							}
						  break;
						  case 'del':				  
							$idkure = mysqli_real_escape_string($config, $_REQUEST['idmk']);
								$query = mysqli_query($config, "DELETE FROM nio_mkl WHERE idmk='$idkure'");
								if($query == true){
									$_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
									header("Location: ./admin.php?page=mkl");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=mkl";
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
					if(isset($_SESSION['succDesable'])){
						$succDesable = $_SESSION['succDesable'];
						echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDesable.'
						</div>';unset($_SESSION['succDesable']);
					}
					?>
					<a data-toggle="collapse" data-target="#EditProfile" class="btn btn-primary white  float-right ml-2"><b><i class="ft-zap"></i></b> CREATE NEW</b></a>
					<h4 class='d-none d-md-block'>BUAT PELAJARAN - Learning Class</h4>
					<p class='f14 d-none d-md-block'>Halaman Entri Pelajaran "<i class='primary'>Merupakan Halama untuk menginput / menambahkan  pelajaran baru</i>"</p>
					
					<!-- FORM PADA TUGAS -->
					<div id='EditProfile' aria-expanded='false' class="card-content collapse entry mb-2">
					  <div class="card-body">
						<form class="form" method="POST" action="?page=mkl&act=add" enctype="multipart/form-data">
						  <div class="form-body"><h5><i class="ft-zap"></i> <b>CREATE PELAJARAN</b><hr/></h5>
							<div class="row">
							  <div class="form-group col-md-12">
								<input type="text" name="mkl1" class="form-control border-primary"  placeholder="Nama Pelajaran " required>
								<code class='f12 danger'> <b>Nama Pelajaran</b></code>
							  </div>
							  <div class="form-group col-md-2">
								<input type="number" name="mkl2" class="form-control border-primary"  placeholder="Bobot" required>
								<code class='f12 danger'> <b>Bobot</b></code>
							  </div>
							  <div class="form-group col-md-5">
								<select name="mkl3" class="form-control border-primary pepe" required>
								  <option value='WAJIB'>Pelajaran Wajib</option>
								  <option value='PILIHAN'>pelajaran Pilihan</option>
								</select>
								<code class='f12 danger'> <b>Jenis Pelajaran</b></code>
							  </div>
							  <div class="form-group col-md-4">
								<button type="submit" name="submit" class="btn btn-block btn-primary pepe"><b>TAMBAHKAN</b></button>
							  </div>
							</div>
						  </div>
						</form>
					 </div>
					</div>
					
				</div>	
				
				
				<div class="col-xl-12 col-lg-6 col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" style='margin-top:50px;'>
						<thead>
						  <tr><th> Bobot / Daftar Pelajaran</th> <th>Keterangan</th> <th>Setting Tools</th></tr>
						</thead>
					  <tbody>
						<?php
						$query = mysqli_query($config, "SELECT * FROM nio_mkl order by idmk ASC");
						while($row = mysqli_fetch_array($query)){
						$dibuat = tgl_indo($row['dibuat']);
						$dirubah = tgl_indo($row['dirubah']);
						  echo"
							<tr>
							  <td><b class='f14 pepe secondary'><b class='badge badge-secondary f12 mr-1'>$row[sks] Bobot</b> $row[mkl]</b></td>
							  <td>
							  <p class='f12'><b class='danger'>Pelajaran $row[ket] </b><br/>  <b class='cyan'>Update:</b> $dirubah - <b class='cyan'>Oleh :</b> $row[oleh]</p>
							  <p class='alert alert-secondary collapse f14' id='seeinfo$row[idmk]' aria-expanded='false'><b>Guru</b>  hanya dapat mengedit Pelajaran <b class='danger'>$row[mkl]</b>. Untuk menghapus hanya dapat dilakukan oleh <b>Superuser</b> </p>
							  </td>
							  
							  <td width='10%'>";
							  if($_SESSION['level'] == 'D'){ 
								echo "							
								<div class='btn-group btn-sm btn-block'><button type='button' class='btn btn-sm btn-dark'><i class='ft-inbox f24'></i></button>
								<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
								<div class='dropdown-menu'>
									<a class='dropdown-item' href='?page=mkl&act=edit&idmk=$row[idmk]' ><i class='ft-feather'></i> <b>Edit Pelajaran</b></a>
									<a class='dropdown-item fbold danger' data-toggle='collapse' data-target='#seeinfo$row[idmk]'><i class='ft-trash-2'></i>  <b>Delete Pelajaran</b></a>
								</div>
								</div>";
								} else{
								echo"								
								<div class='btn-group btn-sm btn-block mr-1 mb-1'><button type='button' class='btn btn-sm btn-dark'><i class='ft-inbox f24'></i></button>
								<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
								<div class='dropdown-menu'>
									<a class='dropdown-item' href='?page=mkl&act=edit&idmk=$row[idmk]' ><i class='ft-feather'></i> <b>Edit Pelajaran</b></a>
									<a class='dropdown-item fbold danger' href='?page=mkl&act=del&idmk=$row[idmk]'><i class='ft-trash-2'></i>  <b>Delete pelajaran</b></a>
								</div>
								</div>
								";
								}
							  echo"</td>
							</tr>				  
						  ";
						}			  
						?>
						
					  </tbody>
					</table>
					</div>
				</div>
		</div>
		</div> 
		</div>
		
		
	  <!-- AKHIR LISD ADMINNA -->
	  
		<?php } else { header("Location: ./");} ?>
	  
	  
	</div>
</section>
