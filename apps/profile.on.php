<?php


if(isset($_REQUEST['submit'])){
	$idpepe = $_REQUEST['pepe'];
	$nm = $_REQUEST['nama'];
	$nc = $_REQUEST['nick'];
	$em = $_REQUEST['em'];
	$bl = $_REQUEST['bl'];
	$wa = $_REQUEST['wa'];
	$km = $_REQUEST['km'];
	$fb = $_REQUEST['fb'];
	$ig = $_REQUEST['ig'];
	$al = $_REQUEST['al'];
	$tmp = $_REQUEST['tmp'];
	$tgl = $_REQUEST['tgl'];
	  
			if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $al)){
			$_SESSION['alamat'] = 'Form Alamat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
							
			header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
			} else {
				$cek_username=mysqli_real_escape_string($config,$_REQUEST['nick']);
				$sql = "select * from nio_user where nick ='$cek_username'";
				$process = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($process);
					$ekstensi = array('png','jpg','jpeg');
					$logo = $_FILES['logo']['name'];
					$x = explode('.', $logo);
					$eks = strtolower(end($x));
					$ukuran = $_FILES['logo']['size'];
					$target_dir = "themes/user/";
					
					//JIKA LOGO DIUPLOAD
					if(!empty($logo)){
						$nlogo = $logo;
						if(in_array($eks, $ekstensi) == true){
						  if($ukuran < 1000000){
						  $pepe= mysqli_query($config, "SELECT photo FROM nio_user");
						  list($photo) = mysqli_fetch_array($pepe);
						  unlink("themes/user/".$photo);
						  move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir.$nlogo);
						  $query = mysqli_query($config, "UPDATE nio_user SET nama='$nm',nick='$nc',tempat='$tmp',tgl='$tgl',kampus='$km',email='$em',blog='$bl',wa='$wa',fb='$fb',ig='$ig',alamat='$al', photo='$nlogo' WHERE username='$idpepe'");
							if($query == true){
								$_SESSION['succEdit'] = '✔ SUKSES! Data instansi berhasil diupdate';
								header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
							} else {
								$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
								header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
							}
							
						  } else {
							$_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!<br/><br/>';
								header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
						  }
						} else {
							$_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.PNG!';
								header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
						}
					} else {
						//JIKA LOGO KOSONG
						$query = mysqli_query($config, "UPDATE nio_user SET nama='$nm',nick='$nc',tempat='$tmp',tgl='$tgl',kampus='$km',email='$em',blog='$bl',wa='$wa',fb='$fb',ig='$ig',alamat='$al' WHERE username='$idpepe'");
						  if($query == true){
							$_SESSION['succEdit'] = '✔ SUKSES! Data instansi berhasil diupdate';
							header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
						  } else {
								$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query 2';
								header("Location: ././admin.php?page=on&usr=$_SESSION[username]"); die();
						  }
					}
					
				//disinii
			}
		
		  
} else {
	
?>







<?php
	$usr = mysqli_real_escape_string($config, $_REQUEST['usr']);
	$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$usr'");
	if(mysqli_num_rows($query) > 0){
	while($row = mysqli_fetch_array($query)){ ?>



<?php 
?>	
<div class="content-body">
<div id="user-profile">
    <div class="row">
        <div class="col-12">
			<!-- INFORMASI AKSI PROFILE --->
			<?php		
			if(isset($_SESSION['nickAda'])){
				$nickAda = $_SESSION['nickAda'];
				echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$nickAda.'
				</div>';unset($_SESSION['nickAda']);
			}	
			if(isset($_SESSION['errSize'])){
				$errSize = $_SESSION['errSize'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errSize.'
				</div>';unset($_SESSION['errSize']);
			}	
			if(isset($_SESSION['succEdit'])){
				$succEdit = $_SESSION['succEdit'];
				echo'<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$succEdit.'
				</div>';unset($_SESSION['succEdit']);
			}
			if(isset($_SESSION['errQ'])){
				$errQ = $_SESSION['errQ'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errQ.'
				</div>';unset($_SESSION['errQ']);
			}
			if(isset($_SESSION['nm'])){
				$nm = $_SESSION['nm'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$nm.'
				</div>';unset($_SESSION['nm']);
			}
			if(isset($_SESSION['alamat'])){
				$alamat = $_SESSION['alamat'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$alamat.'
				</div>';unset($_SESSION['alamat']);
			}
			?>
            <div class="card profile-with-cover">
                <div class="card-img-top img-fluid bg-cover height-300" style="background: url('themes/images/backgrounds/bg-1.jpg') 50%;"></div>
                <div class="media profil-cover-details w-100">
                    <div class="media-left pl-2 pt-2">
                        
							<?php
							if($row['photo'] == ''){echo"<a href='#' class='profile-image'><img src='themes/user/avatar.png' alt='niozone' class='ounded-circle img-border height='100'></a>";}
							else{ echo"<a href='#' class='profile-image'><img src='themes/user/$row[photo]'  alt='niozone' class='ounded-circle img-border width='125' height='120'></a>"; }
							?>
                      
                    </div>
                    <div class="media-body pt-3 px-2">
                        <div class="row">
                            <div class="col">
                              <h3 class="title f20 black pepe"> <?php echo $row['nama'];?></h3>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group float-right ml-2" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-secondary d-none d-md-block "><i class="ft-award f16"></i> <b class='danger'><?php echo $row['login'];?></b> Actived</button>
									<?php
									if($_SESSION['username'] == $row['username']){echo'<span data-toggle="collapse" data-target="#Disqusbimbol" class="btn btn-danger"><i class="icon icon-user-following"></i> <b>Edit profile</b></span>';}
									else{echo'<button type="button" class="btn btn-danger"><i class="fa fa-whatsapp"></i> Message</button>';}
									?>
                                    
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
				
                <nav class="navbar navbar-light navbar-profile align-self-end">
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
							
							<ul class="nav nav-tabs nav-linetriangle">
							  <li class="nav-item"><a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#tab41" aria-expanded="true"><i class="ft-users"></i> Identitas</a></li>
							  <?php //TAMPILAN MAHASISWA
								if($row['level'] == 'M'){
							  ?>
							  <!--
							  <li class="nav-item"><a class="nav-link" id="base-tab43" data-toggle="tab" aria-controls="tab43" href="#tab43" aria-expanded="false"><i class="ft-briefcase"></i>  History Unduh</a></li>
							  <li class="nav-item"><a class="nav-link" id="base-tab432" data-toggle="tab" aria-controls="tab432" href="#tab432" aria-expanded="false"><i class="ft-airplay"></i> List Tugas</a></li>
							  -->
							  <?php //TAMPILAN DOSEN
								} else { 
							  ?>
							  <!--
							  <li class="nav-item"><a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#tab42" aria-expanded="false"><i class="ft-briefcase"></i>  List Course</a></li>
							  <li class="nav-item"><a class="nav-link" id="base-tab422" data-toggle="tab" aria-controls="tab422" href="#tab422" aria-expanded="false"><i class="ft-airplay"></i>  List Tugas</a></li>
							  <li class="nav-item"><a class="nav-link" id="base-tab423" data-toggle="tab" aria-controls="tab423" href="#tab423" aria-expanded="false"><i class="ft-bell"></i>  MHS Bimbol</a></li>
							  -->
							  <?php } ?>
							  <li class="nav-item"><a class="nav-link" id="base-tab424" data-toggle="tab" aria-controls="tab424" href="#tab424" aria-expanded="false"><i class="ft-sunset"></i> Logs</a></li>
							</ul>
                        </div>
                    </div>
                </nav>
                </nav>
            </div>
			
		<div class="col-12">	
		<div class="card">
        <div id='Disqusbimbol' aria-expanded='false' class="card-content collapse entry">
		<div class="card-body">
			
			<?php
			$query = mysqli_query($config, "SELECT * FROM nio_user WHERE username='$_SESSION[username]'");
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)){
			?>
			
			<section class="col-12 d-flex align-items-center justify-content-center">
			</section>
			<form class="form form-horizontal" method="post" action="?page=on&usr=$_SESSION[username]" enctype="multipart/form-data">
				<div class="form-body">
				<div class="alert alert-light mb-2" role="alert"><b>PROFILE INFORMATION</b></div>
				
				<div class="row m-1">
				  <div class="col-xl-6 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Full Names</label>
					  <input type="text" name="nama" class="form-control border-primary" value="<?php echo $row['nama']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-2 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Username</label>
					  <input type="text" class="form-control border-primary" value="<?php echo $row['username']; ?>" disabled>
					  <input type="hidden" name="pepe" class="form-control border-primary" value="<?php echo $row['username']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-2 col-md-12 mb-1">
					<fieldset class="form-group"><label for="basicInput">Sessions</label>
					 <?php 
						if($_SESSION['level'] == 'A'){echo" <input type='text' class='form-control border-primary' value='Superuser' disabled>";} 
						elseif($_SESSION['level'] == 'D'){echo"  <input type='text' class='form-control border-primary' value='Guru' disabled>";} 
						else {echo " <input type='text' class='form-control border-primary' value='Siswa' disabled>";}
					?>					 
					</fieldset>
				  </div>
				  <div class="col-xl-2 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Login</label>
					  <input type="text" class="form-control border-primary" value="<?php echo $row['login']; ?>" disabled>
					</fieldset>
				  </div>
				  <div class="col-xl-3 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Nama Panggilan</label>
					  <input type="text" name="nick" class="form-control border-primary pepe" value="<?php echo $row['nick']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-6 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Tempat Lahir</label>
					  <input type="text" name="tmp" class="form-control border-primary" value="<?php echo $row['tempat']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-3 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Tanggal Lahir</label>
					  <input type="date" name="tgl" class="form-control border-primary" value="<?php echo $row['tgl']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-4 col-md-12">
					<fieldset class="form-group"><label for="basicInput">E-Mail</label>
					  <input type="text" name="em" class="form-control border-primary" value="<?php echo $row['email']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-5 col-md-12 mb-1">
					<fieldset class="form-group"><label for="basicInput">Blogs</label>
					  <input type="text" name="bl" class="form-control border-primary" value="<?php echo $row['blog']; ?>" >
					</fieldset>
				  </div>
				  <div class="col-xl-3 col-md-12 mb-1">
					<fieldset class="form-group"><label for="basicInput">WhatsApp</label>
					  <input type="text" name="wa" class="form-control border-primary" value="<?php echo $row['wa']; ?>" >
					</fieldset>
				  </div>
				  
				  <div class="col-xl-4 col-md-12 mb-1">
					<fieldset class="form-group"><label for="basicInput">Homebase Prodi</label>
					  <input type="text" name="km" class="form-control border-primary" value="<?php echo $row['kampus']; ?>" >
					</fieldset>
				  </div>
				
				  <div class="col-xl-4 col-md-12">
					<fieldset class="form-group"><label for="basicInput">URL Facebook</label>
					  <input type="text" name="fb" class="form-control border-primary" value="<?php echo $row['fb']; ?>" >
					  <code class="f12 danger m-2"> https://fb.com/ebelajar </code>
					</fieldset>
				  </div>  
				  <div class="col-xl-4 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Instagram</label>
					  <input type="text" name="ig" class="form-control border-primary" value="<?php echo $row['ig']; ?>" >
					  <code class="f12 danger m-2"> https://instagram.com/ebelajar </code>
					</fieldset>
				  </div>
				  <div class="col-xl-12 col-md-12">
					<fieldset class="form-group"><label for="basicInput">Alamat Lengkap</label>
					  <input type="text" name="al" class="form-control border-primary" value="<?php echo $row['alamat']; ?>" >
					</fieldset>
				  </div>
					<div class="col-md-12">
					<div class="form-group row">
					  <label class="col-md-2 label-control" for="userinput1">
					  <?php
					  
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='media-object img-xl border' style='height:35px;'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='media-object img-xl border' style='height:35px;'>"; }
					  ?>
					  </label>
					  <div class="col-md-10">
						<input type="file" id="logo" class="form-control border-primary" name="logo">
						<code class="f12 primary m-2">Format Logo <b class="black">*PNG</b> & Filesize <b class="black">2</b> MB!</code>
					  </div>
					</div>
					</div>
					
					
				</div>	
				<div class="form-actions right">
				  <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
				  <button type="reset" class="btn btn-warning mr-1"><i class="ft-x"></i> Cancel</button>
				</div>
			</form>
			
			<?php } } else { echo" NOD FOUND";}?>
			<hr/>
			<div class="card-text">
				<p>Change background color of the form control.</p>
			</div>
			
			
			</div>
		</div>
		</div>
		</div>
		</div>
		
		
			
		<div class="col-12" style='margin-top:-60px;'>	
		<div class="card">
        <div class="card-content row p-2">
		
		  
		  <div class="col-md-12">
			<?php 
			$usr = mysqli_real_escape_string($config, $_REQUEST['usr']);
			$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$usr'");
			while($rower= mysqli_fetch_array($query)){ ?>
			
			<div class="col-md-12">
			<div class="card">
				<div class="card-content">
				<div class="tab-content">
					<!-- IDENTITAS -->
					<div role="tabpanel" class="tab-pane active" id="tab41" aria-expanded="true" aria-labelledby="base-tab41">
						<div class="content-body">
						<section class="card">
						<?php
						$usr = mysqli_real_escape_string($config, $_REQUEST['usr']);
						$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$usr'");
						while($row = mysqli_fetch_array($query)){
						$date = tgl_indo($row['tgl']);
						
						echo"
						<div id='invoice-template' class='card-body'>
							<div id='invoice-company-details' class='row'>
							<div class='col-md-7 text-md-left'>
							  <div class='media'>
								<img src='themes/edosen-app.png' alt='company logo' class='border p-1 d-none d-md-block mr-2'/>
								<div class='media-body'>
								<ul class='px-0 list-unstyled'>
									<li class='pepe f18'>$row[nama]</li>
									<li><b>$row[tempat] / $date</b></li>";
									if($row['kampus'] == ''){ echo"<li> ebelajar</li>";}
									else{ echo"<li>$row[kampus]</li>";}
									if($row['nick'] == ''){ echo"<li class='cyan pepe'>@no_nick</li>";}
									else{ echo"<li class='cyan pepe'>@$row[nick]</li>";}
									echo"
								</ul>
								<h5 class='pepe mt-3'><i class='ft-layers'></i> General Information</h5>
								<ul class='px-0 list-unstyled f14'>
								  <li><b>Contact E-Mail : </b> $row[email]</li>
								  <li><b>WhatsApp : </b> +62$row[wa]</li>
								  <li><b>User : </b> $row[username]</li>
								  <li><b>Loged :</b> $row[login] Logins</li>
								  <li><b>Kode Akun :</b> $row[kd_akun] (Simpan apabila lupa kata sandi)</li>
								</ul>
								</div>
							  </div>
							</div>
							<div class='col-md-5 text-md-right'>";
								if($row['level'] == 'M'){ echo"<h3 class='pepe'> Mudrid</h3>";}
								else{ echo"<h3 class='pepe danger'> Guru</h3>";}
								if($row['blog'] == ''){ echo"<a href='https://ebelajar.com/' class='f16 pb-3' target='_blank' data-toggle='tooltip' data-original-title='Promo websiet murah disini'>https://ebelajar.com/<i class='ft-globe f12'></i></a>";}
								else{ echo"<a href='$row[blog]' class='f16 pb-3' target='_blank'>$row[blog] <i class='ft-globe f12'></i></a>";}
								
								echo"
								<h5 class='pepe mt-3'><i class='ft-map-pin'></i>  Alamat Lengkap</h5>
								<p class='f14'>$row[alamat]</p><h5 class='pepe mt-3 mb-1'>Media Social <i class='ft-layers'></i> </h5>
								<ul class='px-0 list-unstyled f14'>
								  <li class='mt-1'><a href='$row[fb]' target='_blank' class='badge badge-pill badge-primary f12'> <i class='ft-facebook'></i> Facebook</a></li>
								  <li class='mt-1'><a href='$row[fb]' target='_blank' class='badge badge-pill badge-warning f12'> <i class='ft-instagram'></i> Instagram</a></li>
								  <li class='mt-1'><a href='https://linkedin.com/in/ebelajar/' target='_blank' class='badge badge-pill badge-info f12'> <i class='fa fa-linkedin'></i> Linkedin Profile</a></li>
								</ul>
							</div>
							
							</div>
						</div>";
						} ?>
						</section>
						</div>
					</div>
					
					<!-- COURSE DOSEN -->
					<div class="tab-pane" id="tab42" aria-labelledby="base-tab42">
						
					</div>
					<!-- TUGAS DOSEN -->
					<div class="tab-pane" id="tab422" aria-labelledby="base-tab422">
						<p>ISI 2.2</p>
					</div>
					<!-- BIMBOL DOSEN -->
					<div class="tab-pane" id="tab423" aria-labelledby="base-tab423">
						<p>ISI 2.3</p>
					</div>
					<!-- HISTORY UNDUHAN MAHASISWA-->
					<div class="tab-pane" id="tab43" aria-labelledby="base-tab43">
						<p>ISI 3</p>
					</div>
					<!-- HISTORY TUGAS MAHASISWA-->
					<div class="tab-pane" id="tab432" aria-labelledby="base-tab432">
						<p>ISI 3.2</p>
					</div>
					<!-- LOGS HISTORY -->
					<div class="tab-pane" id="tab424" aria-labelledby="base-tab424">
						<div class="table-responsive mt-3">
						<table class="table table-striped mb-0">
						  <thead>
							<tr>
							  <th width='23%'>TanggalLogs</th>
							  <th>IP Address</th>
							  <th>Browser</th>
							  <th>Operation System</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							$usr = mysqli_real_escape_string($config, $_REQUEST['usr']);
							$query = mysqli_query($config, "SELECT * FROM counterdb WHERE  username='$usr' order by tanggal DESC LIMIT 4");
							while($row = mysqli_fetch_array($query)){					
							$date = tgl_indo($row['tanggal']);
							echo"
							<tr class='f14'>	  
							  <td>$date</td> 
							  <td>$row[ip_address]</td>
							  <td>$row[browser]</td>
							  <td width='10%'><b>$row[os]</b></td>
							</tr>";
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
			<?php } ?>
			
			
			
			
			
                       
		  </div>
		</div>
		</div>
		</div>
		
		
	</div>
</div>
</div>

<?php }

} else {
header("Location:admin.php");
}


} ?>