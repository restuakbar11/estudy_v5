<section id="configuration">
	<div class="row">
	
		<div class="col-md-12 content-body">	  
		<div class="card card-content">
		<div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5"><?php require_once "superuser.php"; ?> </div>
				<div class="col-xl-8 col-lg-6 col-md-12">
				<?php if($_SESSION['level'] == 'A'){ 
				//QUERI DAN INFO ADMIN
				if(isset($_REQUEST['act'])){
						$act = $_REQUEST['act'];
						switch ($act) {						  
						  case 'add':
							$id= $_REQUEST['b0'];
							$klss = $_REQUEST['b1'];
							$xhun = $_REQUEST['b2'];
							$idjs = $_REQUEST['b3'];
							$kel = $_REQUEST['kelompok'];
								
								$query = mysqli_query($config, "INSERT INTO nio_kelas(id_kel,idj,usid,kelas,tahun,kelompok) VALUES('$id','$idjs','$_SESSION[username]','$klss','$xhun','$kel')");
									if($query == true){
										$_SESSION['succAdd'] = 'PENAMBAHAN KELAS SUKSES SUCCESS';
										header("Location: ./admin.php?page=kls");
										die();
									} else {
										$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
										echo '<script language="javascript">window.history.back();</script>';
									}
						  break;
						  case 'edit':				  				  
							$id_kelur = mysqli_real_escape_string($config, $_REQUEST['id_kel']);
							$query = mysqli_query($config, "SELECT * FROM nio_kelas WHERE id_kel='$id_kelur' order by id_kel");
							while($row = mysqli_fetch_array($query)){
							$jur = $row['idj'];
							echo "
							<div class='card'>
							<div class='card-body'>
								<form class='form' method='POST' action='?page=kls&act=editkelas' enctype='multipart/form-data'>
								  <div class='form-body'><h5><i class='ft-edit'></i> <b>EDIT KELAS</h5><hr/>
									<div class='row'>
									  <div class='form-group col-md-4'>
										<input type='text' name='a11' class='form-control border-primary' value='$row[kelas]' required>
										<code class='f12'>Nama Kelas</code>
										<input type='hidden' name='idx' class='form-control border-primary' value='$row[id_kel]' required>
									  </div>
									 <div class='form-group col-md-3'>
								<select name='kelompok' id='kelompok' class='form-control border-primary' value='$row[kelompok]'  required>
								  <option value='7'>7</option>
								  <option value='8'>8</option>
								  <option value='9'>9</option>
								</select>
								<code class='f12 danger'> <b>Level Kelas</b></code>
							  </div>
									  <div class='form-group col-md-4'>
										<select name='a31' class='form-control border-primary' required>
										<option value=''></option>";
											$query = mysqli_query($config, "SELECT * FROM nio_jurusan");
											while($row = mysqli_fetch_array($query)){
											echo "<option value='$row[idj]'>$row[jurusan]</option>";
											}
										echo"</select>";
											$query = mysqli_query($config, "SELECT * FROM nio_jurusan WHERE idj='$jur'");
											while($xjur = mysqli_fetch_array($query)){echo "<code class='f12 info'>$xjur[jurusan]</code>";}
										echo"
									  </div>
									  <div class='form-group col-md-2'>
										<button type='submit' name='submit' class='btn btn-primary btn-block'><b>UPDATE</b></button>
									  </div>
									</div>
								  </div>
								</form>
							</div>
							</div>
							";}
						  break;
						  case 'editkelas':				  
							if(isset($_REQUEST['submit'])){					   
								$idx = $_REQUEST['idx'];				   
								$xjrs = $_REQUEST['a11'];
								//$xfkl = $_REQUEST['a21'];
								$xjur = $_REQUEST['a31'];
								$kel  = $_REQUEST['kelompok'];
								$query = mysqli_query($config, "UPDATE nio_kelas SET kelas='$xjrs',idj='$xjur',tahun='$xfkl' ,kelompok='$kel'WHERE id_kel='$idx'");
								if($query == true){
									$_SESSION['Editok'] = 'PROSES UPDATE !! Kelas Success<br/>';
									header("Location: ./admin.php?page=kls");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=kls";
										  </script>';
								}
							}
						  break;
						  case 'del':				  
							$id_kelure = mysqli_real_escape_string($config, $_REQUEST['id_kel']);
								$query = mysqli_query($config, "DELETE FROM nio_kelas WHERE id_kel='$id_kelure'");
								if($query == true){
									$_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
									header("Location: ./admin.php?page=kls");
									die();
								} else {
									$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
									echo '<script language="javascript">
											window.location.href="./admin.php?page=kls";
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
					if(isset($_SESSION['errQ'])){
						$errQ = $_SESSION['errQ'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$errQ.'
						</div>';unset($_SESSION['errQ']);
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
					<a data-toggle="collapse" data-target="#EditProfile" class="btn btn-primary white  float-right ml-2"><b><i class="ft-zap"></i></b> TAMBAHKAN KELAS</b></a>
					<h4 class='d-none d-md-block'>CREATE KELAS AJAR</h4>
					<p class='f14 d-none d-md-block'><i class='primary'>"Penambahan kelas hanya dapat dilakukan oleh <b>Superuser</b> karena kelas berpengaruh pada bahan <b>E-Belajar</b> yang akan di upload. "</i></p>
					
					<!-- FORM PADA TUGAS -->
					<div id='EditProfile' aria-expanded='false' class="card-content collapse entry">
					  <div class="card-body">
						<form class="form" method="POST" action="?page=kls&act=add" enctype="multipart/form-data">
						  <div class="form-body"><h5><i class="ft-file-text"></i> <b>CREATE KELAS AJAR</b><hr/></h5>
							<div class="row">
							  <div class="form-group col-md-4">
								<input type="text" name="b0" class="form-control border-primary"  placeholder="180300" required>
								<code class='f12 danger'> <b>Kode Kelas</b></code>
							  </div>
							  <div class="form-group col-md-8">
								<input type="text" name="b1" class="form-control border-primary"  placeholder="Nama kelas" required>
								<code class='f12 danger'> <b>Nama Kelas</b></code>
							  </div>
							  <!--div class="form-group col-md-3">
								<input type="text" name="b2" class="form-control border-primary" placeholder="Angkatan" required>
								<code class='f12 danger'> <b>Tahun Angkatan</b></code>
							  </div-->
							  <div class="form-group col-md-5">
								<select name="b3" class="form-control border-primary pepe" required>
								  <option value=''>Pilih Jurusan</option>
								  <?php
									$query = mysqli_query($config, "SELECT * FROM nio_jurusan");
									while($row = mysqli_fetch_array($query)){
									echo "<option value='$row[idj]'>$row[jurusan]</option>";
									}			
								  ?>					 
								</select>
								<code class='f12 danger'> <b>Jurusan</b></code>
							  </div>
							  <div class="form-group col-md-5">
								<select name="kelompok" id="kelompok" class="form-control border-primary pepe" required>
								  <option value='7'>7</option>
								  <option value='8'>8</option>
								  <option value='9'>9</option>
								</select>
								<code class='f12 danger'> <b>Level Kelas</b></code>
							  </div>
							  <div class="form-group col-md-4">
								<button type="submit" name="submit" class="btn btn-primary"><b>TAMBAHKAN</b></button>
							  </div>
							</div>
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
			<table class="table table-striped table-bordered zero-configuration  p-2">
				<thead>
					<tr><th>Kelas<br/><span class="f12"></span></th>
					<th>Jurusan<br/><span class="f12"></span></th>
					<th>Jumlah<br/><span class="f12"> siswa</span></th>
					<th>Action<br/><span class="f12"> Setting Tools</span></th></tr>
				</thead>
			  <tbody>
				<?php
						$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_jurusan WHERE nio_jurusan.idj=nio_kelas.idj AND usid='$_SESSION[username]' LIMIT 15");
						while($row = mysqli_fetch_array($query)){
						  echo"
							<tr>
							  <td width=20%'><b class='teal f14'>$row[kelas]</b> <br/> </td>
							  <td><b>$row[jurusan]</b> <br/> <span class='f12'>$row[fakultas]</span></td>";
							  $sumkelas = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_user WHERE id_kel='$row[id_kel]'"));
							  echo"
							  <td width='21%'><span class='f14'>Siswa Terdaftar</span> <br/><code class='teal'><b class='black f16'>$sumkelas</b> Siswa</code></td>
							  <td width='16%'>
								<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-dark'><i class='ft-inbox f24'></i></button>
								<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
								<div class='dropdown-menu'>
									<a class='dropdown-item' href='cetak.php?act=mhsperkelas&id_kel=$row[id_kel]' target='_blank' ><i class='ft-printer'></i> <b>Print Siswa</b></a>
									<a class='dropdown-item' href='?page=kls&act=edit&id_kel=$row[id_kel]' ><i class='ft-feather'></i> <b>Edit Kelas</b></a>
									<a class='dropdown-item fbold danger' href='?page=kls&act=del&id_kel=$row[id_kel]'><i class='ft-trash-2'></i>  <b>Delete Kelas</b></a>
								</div>
								</div>
							  </td>
							</tr>				  
						  ";
						}			  
						?>
			  </tbody>
			</table>
			</div>
        </div>	
		</div>	
		
		
		
		
		
	  <!-- AKHIR LISD ADMINNA -->
	  
		<?php }elseif($_SESSION['level'] == 'D'){
			echo' <h4 class="d-none d-md-block"><b>PENAMBAHAN KELAS</b></h4> <p class="f14 d-none d-md-block"><b>SysTerintegrasi</b> - <i class="primary">"Penambahan kelas hanya dapat dilakukan oleh <b>Superuser</b> karena kelas berpengaruh pada bahan <b>ED Pelajaran</b> yang akan di upload oleh <b>Guru</b> lainya. Silahkan hubungi <b>Superuser</b> sistem ini."</i></p>
			';?>
		
		
		<div class="col-md-12 mt-3">
		<div class="card-content">
			<table class="table">
				<thead>
					<tr><th>KELAS<br/><span class="f14"> </span></th>
					<th>JURUSAN<br/><span class="f14"> </span></th>
					<th>JUMLAH<br/><span class="f14"> </span></th>
					<th>AKSI<br/><span class="f14"> </span></th></tr>
				</thead>
			  <tbody>
				<?php
						$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_jurusan WHERE nio_jurusan.idj=nio_kelas.idj");
						while($row = mysqli_fetch_array($query)){
						  echo"
							<tr>
							  <td width='25%'><b class='teal'>$row[kelas]</b> <br/> </td>
							  <td><b>$row[jurusan]</b> <br/> <span class='f12'>$row[fakultas]</span></td>";
							  $sumkelas = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_user WHERE id_kel='$row[id_kel]'"));
							  echo"
							  <td width='21%'><code class='teal'><b class='black f14'>$sumkelas</b>Siswa</code></td>
							  <td width='18%'>
								<a href='cetak.php?act=mhsperkelas&id_kel=$row[id_kel]' target='_blank' class='badge badge-dark mb-1' data-toggle='tooltip' data-original-title='Print data Siswa kelas $row[kelas]' ><i class='ft-printer'></i> Print Siswa</a>
								
							  </td>
							</tr>				  
						  ";
						}			  
						?>
			  </tbody>
			</table>
        </div>	
		</div>	
			
			
		<?php }else { header("Location: ./");} ?>
	  
	  
	</div>
</section>