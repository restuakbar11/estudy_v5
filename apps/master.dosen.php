<?php
if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){
  if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
	switch ($act) {
	  case 'add':
		$nama = $_REQUEST['nama'];
		$usernm = $_REQUEST['user'];
		$pass = $_REQUEST['pas'];
		$cam = $_REQUEST['cam'];
		$lv = $_REQUEST['lv'];
		$em = $_REQUEST['em'];
		$wa = $_REQUEST['wa'];
		$nidn = $_REQUEST['nidn'];
		
		$ekstensi = array('jpg','png','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$eks = strtolower(end($x));
		$ukuran = $_FILES['file']['size'];
		$target_dir = "themes/user/";
			if($file != ""){
			  $rand = rand(1,999);
			  $nfile = $usernm."-".$rand."-".$file;
			  if(in_array($eks, $ekstensi) == true){
				if($ukuran < 3000000){
				move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);
				$query = mysqli_query($config, "INSERT INTO nio_user(username,password,nama,nidn,email,wa,kampus,photo,level,login)
				VALUES('$usernm',MD5('$pass'),'$nama','$nidn','$em','$wa','$cam','$nfile','$lv','0')");
				  if($query == true){
					$_SESSION['succAdd'] = 'SUKSES! GURU BARU BERHASIL DITAMBAHKAN';
					header("Location: ./admin.php?page=guru");die();
				  } else {
				    $_SESSION['errQ'] = 'ERROR! GURU BARU GAGAL DITAMBAHKAN';
					header("Location: ./admin.php?page=dosen");die();
				  }
				} else {
				  $_SESSION['errSize'] = 'MAXSIZE FOTO TERLALU BESAR - MAX 3MB!';
				  echo '<script language="javascript">window.history.back();</script>';
				}
			  }else {
				$_SESSION['errFormat'] = 'FORMAT FOTO HARUS  *.JPEG, *.JPG! ATAU *.PNG!';
				header("Location: ./admin.php?page=guru");
			  }
			} else {
				$_SESSION['errFoto'] = 'Foto masih kosong';
				header("Location: ./admin.php?page=guru");			
			}
	  break;
	  case 'del':				  
		$idusers = mysqli_real_escape_string($config, $_REQUEST['iduser']);
		$query = mysqli_query($config, "SELECT * FROM  nio_user WHERE  username='$idusers'");
		while($row = mysqli_fetch_array($query)){
			unlink("themes/user/".$row['photo']);}
			$query = mysqli_query($config, "DELETE FROM nio_user WHERE  username='$idusers'");
			$query2 = mysqli_query($config, "DELETE FROM nio_modul WHERE  username='$idusers'");
			$query3 = mysqli_query($config, "DELETE FROM nio_uptugas WHERE  dosen='$idusers'");
			$query4 = mysqli_query($config, "DELETE FROM nio_tesis WHERE  dosen='$idusers'");
			$query5 = mysqli_query($config, "DELETE FROM nio_tugas WHERE  username='$idusers'");
			if($query == true){
				$_SESSION['succDel'] = 'SUKSES! Akun ini telah dihapus secara permanen';
				header("Location: ./admin.php?page=guru");
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
<div class="card">
<div class="card-body">
	<div class="row">
	  <div class="col-md-12">
	  <?php	  
		 if(isset($_SESSION['succAdd'])){
			$succAdd = $_SESSION['succAdd'];
			echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			'.$succAdd.'</div>';unset($_SESSION['succAdd']);
		}
					if(isset($_SESSION['succDel'])){
						$succDel = $_SESSION['succDel'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDel.'
						</div>';unset($_SESSION['succDel']);
					}
		
		//BUTTON TAMBAH DOSEN UNTUK ADMIN
		if($_SESSION['level'] == 'A'){
		echo'';		
		?>
		
		<div id='EditProfile' aria-expanded='false' class="card-content collapse entry mt-0 mb-3">
		  <div class="card-body">
			<form class="form" method="POST" action="?page=dosen&act=add" enctype="multipart/form-data">
			<div class="form-body"><h5><i class="ft-user-plus f18"></i> <b> CREATE USERS</b><hr/></h5>
			<div class="row">
				<div class="form-group col-md-6 mb-2"><label>FULL NAME</span> </label>
					<input type="text" name="nama" class="form-control border-primary" required >
				</div>
				<div class="form-group col-md-3 mb-2"><label>USERNAME LOGIN</span> </label>
					<input type="text" name="user" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-3 mb-2"><label>PASSWORD LOGIN</span> </label>
					<input type="text" name="pas" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-4 mb-2"><label>BIDANG GURU </span> </label>
					<input type="text" name="cam" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-2 mb-2"><label>LEVEL DOSEN</span> </label>
					<select name="lv" class="form-control border-primary" required>
						<option value='D'>Dosen</option>
						<option value='A'>Superuser</option>
					</select>
				</div>
				<div class="form-group col-md-3 mb-2"><label>eMAIL</span> </label>
					<input type="text" name="em" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-3 mb-2"><label>WHATSAPP</span> </label>
					<input type="text" name="wa" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-4 mb-2"><label>NIDN</span> </label>
					<input type="text" name="nidn" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-8 mb-2"><label>PICTURE</label>
					<input type="file" name="file" id='file' class="form-control border-primary" required>					
					<code class="f12 m-2">file <b class="black">*JPG or *PNG</b> Maxsize 2 MB!</code>
				</div>
			</div>
			</div>
			<div class="form-actions right">
			  <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> <b>TAMBAHKAN</b></button>
			  <button type="button" data-toggle='collapse' data-target='#EditProfile' class="btn btn-warning mr-1"><i class="ft-x"></i> <b>BATAL</b></button>
			</div>
			</form>
		  </div>
		</div>
		
		
		<div class="alert alert-light mt-3 secondary" role="alert">
		<a data-toggle="collapse" data-target="#EditProfile" class="btn btn-secondary white float-right"><i class="icon-users"></i> <b>TAMBAH BARU</b></a>
		
		<h4> <b><i class='icon icon-user'></i> DAFTAR DOSEN</b> <br/><i class='f12 text-dark'> Daftar Dosen dan informasi serta aksi pengelolan data</i></h4></div>
		
		
		
		<?php }else{ ?>
		<a href="" class="btn btn-primary white float-right ml-2" data-toggle="collapse" data-target="#Upgrade"><i class="icon-users"></i> <b>ADD GURU</b></a>
		<h4 class='d-none d-md-block'><b><i class='ft-users'></i> LIST GURU</b> </h4>
		<p class='f14 d-none d-md-block'>Penambahan Guru "<i class='primary'>Halaman penambahan Guru manual untuk penambahan anggota pengajar pada Sistem</i>"</p>
		<p id='Upgrade' aria-expanded='false' class="alert alert-warning mb-2 mt-2 collapse entry " role="alert"> <b>Penambahan Guru -</b> Hanya dapat dilakukan oleh <b>Superuser</b> pada Sistem E-Belajar ini - silahkan hubungi Superuser anda.</p>
		
		
		<?php } ?>  
		<!-- HALAMAN LIS BIMBINGAN -->
		<div id="users-list" class="list-group position-relative">	
		
		<div class="users-list-padding media-list"><table class="table table-borderless zero-configuration">				
			  <thead>
				<tr><th><i class='ft-users'></i> LIST SUPERUSER ADMINISTRATOR DAN DOSEN</th></tr>
			  </thead>
			  <tbody>
			<?php
			$query = mysqli_query($config, "SELECT * FROM nio_user WHERE level='A' OR level='D' ORDER BY login DESC");
			while($row = mysqli_fetch_array($query)){
			  echo"<tr><td>
			<div class='media'>
			  <div class='media-left pr-1'><span class='avatar avatar-pepe avatar-online'>";
				if($row['photo'] == ''){echo"<img class='border' src='themes/user/avatar.png' style='width:47px; height:44px;'>";}
				else{ echo"<img class='border' src='themes/user/$row[photo]' style='width:55px; height:55px;'>"; }
			  echo"
			  </span></div>
			  <div class='media-body w-100'>
				<h5 class='list-group-item-heading pepe'> <span class='font-small-3 float-right primary'><b>";
				 if($row['level'] == 'A'){echo"<i class='font-large-1 ft-award blue-grey lighten-3' data-toggle='tooltip' data-original-title='Superuser'></i>";}
				 else{echo"<i class='font-large-1 ft-users blue-grey lighten-3' data-toggle='tooltip' data-original-title='Letcure'></i>";}
				echo"</b></span>
				<b><i class='ft-users primary f16'></i> $row[nama] - <span class='danger f12'>@$row[nick]</span></b></h5>
				<p class='list-group-item-text text-muted mb-0 f14'>
					<i class='ft-mail primary'></i> $row[email]
					<i class='ft-headphones primary ml-1'></i> +62-$row[wa]
					<i class='ft-home primary ml-1'></i> $row[kampus]
					<i class='ft-check-circle primary ml-1'></i> NIDN : $row[nidn]
					<span class='float-right'></span>
				</p>
				<p class='list-group-item-text text-muted mt-1 f12'>
				<a class='badge badge-pill badge-dark' href='admin.php?page=on&usr=$row[username]' target='_blank'><i class='ft-user'></i> Profile Timeline</a>";
				 if($_SESSION['level'] == 'A'){ echo"
				<a class='badge badge-pill badge-danger white' data-toggle='collapse' data-target='#$row[username]'><i class='ft-trash-2'></i> Hapus Akun</a>";
				 } else {}
				 echo"
					<div id='$row[username]' aria-expanded='false' class='alert alert-icon-left alert-warning alert-dismissible f14 collapse' role='alert'>
					<div class='row'>
						<div class='col-md-9'>
						<strong>PENTING !!</strong> - <i class='black'>APAKAH ANDA YAKIN UNTUK MENGHAPUS AKUN INI ?</i><br/> Semua data informasi tentang dosen <b class='black'>$row[nama]</b> (Semua data informasi Guru pada Database) akan dihapus secara permanen.
						</div>
						<div class='col-md-3'>
							<a class='btn btn-pill btn-block btn-sm btn-block btn-dark' href='?page=dosen&act=del&iduser=$row[username]'><i class='ft-trash-2'></i> Hapus Permanen</a>
							<a class='btn btn-pill btn-block btn-sm btn-success' href='' data-toggle='collapse' data-target='#$row[username]'>Tidak</a>
						</div>
					</div>
					</div>
				</p>
			  </div>
			</div>
			  </td></tr>
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
</div>
<?php }else{
header("Location: ./");
} ?>