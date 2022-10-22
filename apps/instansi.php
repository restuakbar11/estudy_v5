<?php
if(isset($_REQUEST['submit'])){
	$idpepe = $_REQUEST['pepe'];
	$i1 = $_REQUEST['i1'];
	$e1 = $_REQUEST['e1'];
	$w1 = $_REQUEST['w1'];
	$p1 = $_REQUEST['p1'];
	$p2 = $_REQUEST['p2'];
	$a1 = $_REQUEST['a1'];
	  if(!preg_match("/^[a-zA-Z0-9. -]*$/", $i1)){
		$_SESSION['namains'] = 'Form Nama Instansi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan minus(-)';
		echo '<script language="javascript">window.history.back();</script>';
	  } else {
	  
			if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $a1)){
			$_SESSION['alamat'] = 'Form Alamat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
            echo '<script language="javascript">window.history.back();</script>';
			} else {
				if(!filter_var($w1, FILTER_VALIDATE_URL)){
				$_SESSION['website'] = 'Alamat Website harus menggunakan <b class="black">http://</b> atau <b class="black">https://</b>';
				header("Location: ././admin.php?page=instansi"); die();
				} else {
				
					$ekstensi = array('png');
					$logo = $_FILES['logo']['name'];
					$x = explode('.', $logo);
					$eks = strtolower(end($x));
					$ukuran = $_FILES['logo']['size'];
					$target_dir = "themes/images/logo/";
					
					//JIKA LOGO DIUPLOAD
					if(!empty($logo)){
						$nlogo = $logo;
						if(in_array($eks, $ekstensi) == true){
						  if($ukuran < 2000000){
						  $query = mysqli_query($config, "SELECT logo FROM nio_edosen");
						  list($logo) = mysqli_fetch_array($query);
						  unlink($target_dir.$logo);
						  move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir.$nlogo);
						  $query = mysqli_query($config, "UPDATE nio_edosen SET institusi='$i1',alamat='$a1',prov='$p2',url='$w1',email='$e1',telp='$p1', logo='$nlogo' WHERE idedosen='$idpepe'");
							if($query == true){
								$_SESSION['succEdit'] = 'SUKSES! Data instansi berhasil diupdate';
								header("Location: ././admin.php?page=instansi"); die();
							} else {
								$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
								echo '<script language="javascript">window.history.back();</script>';
							}
							
						  } else {
							$_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!<br/><br/>';
							echo '<script language="javascript">window.history.back();</script>';
						  }
						} else {
							$_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.PNG!';
							echo '<script language="javascript">window.history.back();</script>';
						}
					} else {
						//JIKA LOGO KOSONG
						$query = mysqli_query($config, "UPDATE nio_edosen SET institusi='$i1',alamat='$a1',prov='$p2',url='$w1',email='$e1',telp='$p1' WHERE idedosen='$idpepe'");
						  if($query == true){
							$_SESSION['succEdit'] = 'SUKSES! Data instansi berhasil diupdate';
							header("Location: ././admin.php?page=instansi"); die();
						  } else {
							$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
							echo '<script language="javascript">window.history.back();</script>';
						  }
					}
				}
			}
		
		}
  
} else {
?>
	<div class="row">
	<div class="col-md-12">
		<div class="card">
		  <div class="card-content collpase show">
			<div class="card-body">
			<?php
			$query = mysqli_query($config, "SELECT * FROM nio_edosen");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
			?>
			
			
			
			<?php			
			if(isset($_SESSION['succEdit'])){
				$succEdit = $_SESSION['succEdit'];
				echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$succEdit.'
				</div>';unset($_SESSION['succEdit']);
			}
			if(isset($_SESSION['website'])){
				$website = $_SESSION['website'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$website.'
				</div>';unset($_SESSION['website']);
			}
			
			
			?>
			
			
			<?php  if($_SESSION['level'] == 'M'){header("Location:admin.php"); }else{?>
			<form class="form form-horizontal" method="post" action="?page=instansi" enctype="multipart/form-data">
				<div class="form-body">
				<div class="alert alert-light mb-2" role="alert">
					<b>INSTITUSI INFORMASI</b>
				</div>
				  <div class="row">
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-3 label-control" for="userinput1"><b>Institusi</b></label>
					  <div class="col-md-9">
						<input type="text" name="i1" class="form-control border-primary pepe" value="<?php echo $row['institusi']; ?>" >
					  </div>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-3 label-control" for="userinput1"><b>E-Mail</b></label>
					  <div class="col-md-9">
						<input type="text" name="e1" class="form-control border-primary" value="<?php echo $row['email']; ?>" >
					  </div>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-3 label-control" for="userinput1"><b>Website</b></label>
					  <div class="col-md-9">
						<input type="text" name="w1" class="form-control border-primary" value="<?php echo $row['url']; ?>" >
					  </div>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-3 label-control" for="userinput1"><b>Telphone</b></label>
					  <div class="col-md-9">
						<input type="text" name="p1" class="form-control border-primary" value="<?php echo $row['telp']; ?>" >
					  </div>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-3 label-control" for="userinput1"><b>Provinsi</b></label>
					  <div class="col-md-9">
						<input type="text" name="p2" class="form-control border-primary" value="<?php echo $row['prov']; ?>" >
					  </div>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-3 label-control" for="userinput1"><b>ID E-belajar</b></label>
					  <div class="col-md-9">
						<input type="text" class="form-control border-primary" value="<?php echo $row['idedosen']; ?>" disabled >
						<input type="hidden" name="pepe" class="form-control border-primary" value="<?php echo $row['idedosen']; ?>" >
					  </div>
					</div>
					</div>
				  </div>			  		  
				<div class="alert alert-light mb-2" role="alert"><b>INSTITUSI MEDIA</b></div>			
				  <div class="row">
					<div class="col-md-12">
					<div class="form-group row">
					  <label class="col-md-2 label-control" for="userinput1"><img class='media-object img-xl' src="themes/images/logo/<?php echo $row['logo']; ?>"></label>
					  <div class="col-md-10">
						<input type="file" id="logo" class="form-control border-primary" name="logo">
						<code class="f12 primary m-2">Format Logo <b class="black">*PNG</b> & Filesize <b class="black">2</b> MB!</code>
					  </div>
					</div>
					</div>
					
					<div class="col-md-12">
					<div class="form-group row">
					  <label class="col-md-2 label-control" for="userinput1"><b>Address Istitusi</b></label>
					  <div class="col-md-10">
						<input type="text" name="a1" class="form-control border-primary" value="<?php echo $row['alamat']; ?>">
					  </div>
					</div>
					</div>
				  </div>
				</div>
				
				<div class="form-actions right">
				  <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
				  <button type="reset" class="btn btn-warning mr-1"><i class="ft-x"></i> Cancel</button>
				</div>
			</form>
			
			<?php }} ?>
			<div class="card-text float-right">
				<p>Halaman ini merupakan halaman identitas Aplikasi <code>E-Belajar</code> anda.<br/>Silahkan melakukan update data identisa mengenai e-Belajar anda pada halaman ini.</p>
				
		<p class="card-text text-right m-2">E-Belajar<br/> Power by : <a href="https://www.ebelajar.com" data-toggle="tooltip" data-original-title="Instagram Owner">@ebelajar</a></p>
			</div>
			
			
			</div>
		  </div>
		</div>
	</div>
	</div>
<?php  }
} ?>