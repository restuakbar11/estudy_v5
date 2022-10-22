<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 

  if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
	switch ($act) {
	  case 'add':
		$nama = $_REQUEST['nama'];
		$usernm = $_REQUEST['user'];
		$pass = $_REQUEST['pas'];
		$em = $_REQUEST['em'];
		$wa = $_REQUEST['wa'];
		$kls = $_REQUEST['kls'];
		$kd_akun = $_REQUEST['kd_akun'];
		
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
				$query = mysqli_query($config, "INSERT INTO nio_user(username,password,level,nama,email,wa,id_kel,photo,login,kd_akun)
				VALUES('$usernm',MD5('$pass'),'M','$nama','$em','$wa','$kls','$nfile','0','$kd_akun')");
				  if($query == true){
					$_SESSION['succAdd'] = 'SUKSES! SISWA BARU BERHASIL DITAMBAHKAN';
					header("Location: ./admin.php?page=siswa");die();
				  } else {
				    $_SESSION['errQ'] = 'ERROR! SISWA BARU GAGAL DITAMBAHKAN';
					header("Location: ./admin.php?page=siswa");die();
				  }
				} else {
				  $_SESSION['errSize'] = 'MAXSIZE FOTO TERLALU BESAR - MAX 3MB!';
				  echo '<script language="javascript">window.history.back();</script>';
				}
			  }else {
				$_SESSION['errFormat'] = 'FORMAT FOTO HARUS  *.JPEG, *.JPG! ATAU *.PNG!';
				header("Location: ./admin.php?page=siswa");
			  }
			} else {
				$_SESSION['errFoto'] = 'Foto masih kosong';
				header("Location: ./admin.php?page=siswa");			
			}
	  break;
	  case 'del':				  
		$idusers = mysqli_real_escape_string($config, $_REQUEST['iduser']);
		$query = mysqli_query($config, "SELECT * FROM  nio_user WHERE  username='$idusers'");
		while($row = mysqli_fetch_array($query)){
			unlink("themes/user/".$row['photo']);}
			$query = mysqli_query($config, "DELETE FROM nio_user WHERE  username='$idusers'");
			$query2 = mysqli_query($config, "DELETE FROM nio_unduh WHERE  username='$idusers'");
			$query3 = mysqli_query($config, "DELETE FROM nio_uptugas WHERE  username='$idusers'");
			$query4 = mysqli_query($config, "DELETE FROM nio_tesis WHERE  idtesis='$idusers'");
			$query5 = mysqli_query($config, "DELETE FROM nio_tesis_bim WHERE  idtesis='$idusers'");
			if($query == true){
				$_SESSION['succDel'] = 'SUKSES! Akun ini telah dihapus secara permanen';
				header("Location: ./admin.php?page=siswa");
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
	  <div id='EditProfile' aria-expanded='false' class="card-content collapse entry mt-0 mb-3">
		  <div class="card-body">
			<form class="form" method="POST" action="?page=siswa&act=add" enctype="multipart/form-data">
			<div class="form-body"><h5><i class="ft-user-plus f18"></i> <b> TAMBAH SISWA BARU</b><hr/></h5>
			<div class="row">
				<div class="form-group col-md-4 mb-2"><label>Nama Lengkap</span> </label>
					<input type="text" name="nama" class="form-control border-primary" required >
				</div>
				<div class="form-group col-md-3 mb-2"><label>NIS Siswa</span> </label>
					<input type="text" name="user" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-2 mb-2"><label>Password Default</span> </label>
					<input type="text" name="pas" class="form-control border-primary" value="Ebelajar08" required>
				</div>
				<div class="form-group col-md-3 mb-2"><label>Kelas Siswa </span> </label>
					<select name="kls" class="form-control border-primary" required>
								  <option value=""> Pilih Kelas</option>
								  <?php
								  $query = mysqli_query($config, "SELECT a.*,b.jurusan FROM nio_kelas a INNER JOIN  nio_jurusan b ON a.idj = b.idj ");
								  while($row = mysqli_fetch_array($query)){
								  echo "<option value='$row[id_kel]'><strong>$row[kelas]</strong> -  $row[jurusan]</option>";}	
								 // echo "<option value='$row[idk]'><strong>$row[kelas]</strong> - Angkatan $row[tahun]</option>";}		
								  ?>					 
								</select>
				</div>
				<div class="form-group col-md-3 mb-2"><label>Email</span> </label>
					<input type="email" name="em" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-3 mb-2"><label>Telp / WhatsApp</span> </label>
					<input type="text" name="wa" class="form-control border-primary" required>
				</div>
				<div class="form-group col-md-3 mb-2"><label>Kode Akun</span> </label>
					<input type="text" name="kd_akun" class="form-control border-primary" placeholder="ex: NIS">
				</div>
				<div class="form-group col-md-3 mb-2"><label>PICTURE</label>
					<input type="file" name="file" id='file' class="form-control border-primary" required>					
					<code class="f12 m-2">file <b class="black">*JPG or *PNG</b> Maxsize 2 MB!</code>
				</div>
			</div>
			</div>
			<div class="form-actions right row">
				<div class="col-md-7">
					<small> Pastikan data ini anda isi dengan benar, poinfocus adalah NIS,Kelas Siswa dan Nama Lengkap Siswa, adapun untuk pengeditan dalam mevalidasi data hanya dapat dilakukan pemilik akun.</small>
				</div>
				<div class="col-md-5">
			  <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> <b>TAMBAHKAN</b></button>
			  <button type="button" data-toggle='collapse' data-target='#EditProfile' class="btn btn-warning mr-1"><i class="ft-x"></i> <b>BATAL</b></button>
				</div>
			</div>
			</form>
		  </div>
		</div>
	  
		<?php
		if($_SESSION['level'] == 'A'){
			 if(isset($_SESSION['succAdd'])){
			$succAdd = $_SESSION['succAdd'];
			echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			'.$succAdd.'</div>';unset($_SESSION['succAdd']);
			}
			if(isset($_SESSION['errQ'])){
				$errQ = $_SESSION['errQ'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errQ.'
				</div>';unset($_SESSION['errQ']);
			}
			if(isset($_SESSION['succDel'])){
				$succDel = $_SESSION['succDel'];
				echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$succDel.'
				</div>';unset($_SESSION['succDel']);
			}
			if(isset($_SESSION['errSize'])){
				$errSize = $_SESSION['errSize'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errSize.'
				</div>';unset($_SESSION['errSize']);
			}
			if(isset($_SESSION['errFormat'])){
				$errFormat = $_SESSION['errFormat'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errFormat.'
				</div>';unset($_SESSION['errFormat']);
			}
			if(isset($_SESSION['errFoto'])){
				$errFoto = $_SESSION['errFoto'];
				echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errFoto.'
				</div>';unset($_SESSION['errFoto']);
			}
		?>
		
		<div class="alert alert-light mt-3 secondary" role="alert">
		<a data-toggle="collapse" data-target="#EditProfile" class="btn btn-secondary white float-right"><i class="icon-users"></i> <b>TAMBAH SISWA</b></a>
		
		<h4> <b><i class='icon icon-user'></i> DAFTAR SISWA ANDA</b> <br/><i class='f12 text-dark'> E-Belajar</i></h4></div>
		
		<?php
		} else {
		?>
		
		<?php
		}
		?>
	  
		<!-- HALAMAN LIS BIMBINGAN -->
		<div id="users-list" class="list-group position-relative mt-3">
		<div class="users-list-padding media-list">
			<table class="table table-borderless zero-configuration">				
			  <thead>
				<tr><th><i class='ft-users'></i> LIST SISWA</th></tr>
			  </thead>
			  <tbody>
			<?php
			$query = mysqli_query($config, "SELECT * FROM nio_user WHERE level='M' ORDER BY username DESC");
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
					<i class='ft-check-circle primary ml-1'></i> NIS : $row[username]
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
						<strong>PENTING !!</strong> - <i class='black'>APAKAH ANDA YAKIN UNTUK MENGHAPUS AKUN INI ?</i><br/> Semua data informasi tentang siswa <b class='black'>$row[nama]</b> (Semua data informasi dan Knowledge Student pada Database) akan dihapus secara permanen.
						</div>
						<div class='col-md-3'>
							<a class='btn btn-pill btn-block btn-sm btn-block btn-dark' href='?page=siswa&act=del&iduser=$row[username]'><i class='ft-trash-2'></i> Hapus Permanen</a>
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
	  
	  
	  <div class="col-md-2">
	  </div>
	</div>	
</div>
</div>
<?php }else{
header("Location: ./");
} ?>