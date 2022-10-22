<?php
if(isset($_REQUEST['submit'])){

							$nim = $_REQUEST['idtesis'];
							$note = $_REQUEST['note'];
							$avt = $_REQUEST['avt'];
							$act = $_REQUEST['revisi'];
							
							$ekstensi = array('zip','doc','docx','pdf');					
							$file = $_FILES["file"]["name"];
							$x = explode('.', $file);
							$eks = strtolower(end($x));
							$ukuran = $_FILES['file']['size'];
							$target_dir = "themes/bimbol/";
							//jika form file tidak kosong akan mengeksekusi script dibawah ini
								if($file != ""){
								$rand = rand(1,99999999);
								$nfile = $rand."-".$file;
								//validasi file
									if(in_array($eks, $ekstensi) == true){
										if($ukuran < 7500000){
										move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);
										$query = mysqli_query($config, "INSERT INTO nio_tesis_bim(idtesis,file,note,tgl,avt,act)
												VALUES('$nim','$nfile','$note',NOW(),'$avt','$act')");

											if($query == true){
											$_SESSION['succAdd'] = 'Disqus <b>BIMBOL</b> Diterbitkan';
											header("Location: ./admin.php?page=bimbol&idtesis=$nim");
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
									$_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.ZIP, *.MS-WORD *.PDF!';
											header("Location: ./admin.php?page=bimbol&idtesis=$nim");
									}
								} else {
								//jika form file kosong akan mengeksekusi script dibawah ini
								$query = mysqli_query($config, "INSERT INTO nio_tesis_bim(idtesis,note,tgl,avt,act)
												VALUES('$nim','$note',NOW(),'$avt','$act')");
									if($query == true){
										$_SESSION['succAdd'] = 'Disqus <b>BIMBOL</b> Diterbitkan';
										header("Location: ./admin.php?page=bimbol&idtesis=$nim");
										die();
									} else {
										$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
										echo '<script language="javascript">window.history.back();</script>';
									}
								}
}else{ ?>
<div class="card">
<div class="card-body">

	<div class="row">
	  <div class="col-md-9">
		<?php
		
					if(isset($_SESSION['succAdd'])){
						$succAdd = $_SESSION['succAdd'];
						echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succAdd.'
						</div>';unset($_SESSION['succAdd']);
					}if(isset($_SESSION['errSize'])){
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
			if(isset($_SESSION['errQ'])){
				$errQ = $_SESSION['errQ'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errQ.'
				</div>';unset($_SESSION['errQ']);
			}
			if(isset($_SESSION['errQ'])){
				$errQ = $_SESSION['errQ'];
				echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$errQ.'
				</div>';unset($_SESSION['errQ']);
			}

		?>
	    
		<!-- FORM DISKUSI BIMBINGAN -->
		<div id='Disqusbimbol' aria-expanded='false' class="card-content collapse entry">
					  <div class="card-body">
						<?php
								$nim = mysqli_real_escape_string($config, $_REQUEST['idtesis']);
								$query2 = mysqli_query($config, "SELECT username FROM nio_user WHERE username='$nim'");
								while($rowus = mysqli_fetch_array($query2)){
									echo "<form class='form form-horizontal' method='post' action='?page=bimbol&idtesis=$rowus[username]' enctype='multipart/form-data'>";
								}
								?>
						  <div class="form-body"><h6 class='list-group-item-heading'> 
						  <!-- INFORMASI AKSES -->
						  <?php if($_SESSION['level'] == 'M'){ ?><span class='f14 float-right'><i class='ft-users f16'></i> <b>Mahasiswa</b></span>
						  <?php } else { ?><span class='f14 float-right'><i class='ft-users f16'></i> <b>Guru</b></span><?php } ?>
						  
						  <h5><i class="ft-message-circle f18"></i> <b>Form Disqus </b><hr/></h5>
							<div class="row">
								<?php if($_SESSION['level'] == 'M'){ echo '<input type="hidden" name="avt" class="form-control border-primary" value="M" required></span>';?>
								  <div class="form-group col-md-3"><label><b>Bimbingan</b></label>
									<select name="revisi" class="form-control border-primary" required>
									  <option value='B'>Kirim Bahan</option><option value='D'> Diskusi</option>
									</select>
								  </div>
								<?php } else { echo '<input type="hidden" name="avt" class="form-control border-primary" value="D" required></span>'; ?>
								  <div class="form-group col-md-3"><label><b>Status Bimbingan</b></label>
									<select name="revisi" class="form-control border-primary" required>
									  <option value='D'>Diskusi</option> <option value='O'>Lanjut BAB</option><option value='R'>Revisi BAB</option>
									</select>
								  </div>
								<?php } ?>
							  
							  <div class="form-group col-md-9"><label><b>File Berkas</b> <code class="f12 danger m-2">FILE <b>*MS-WORD,*PDF</b> Maxsize 3MB</code></label>
								<input type="file" name="file" id='file' class="form-control border-primary"
								<?php if($_SESSION['level'] == 'M'){echo'required'; }else{}?>>	
							  </div>
							   <div class="form-group col-md-12"><label><b>Coretan </b></label>
								<textarea rows="4" class="form-control ckeditor" name="note" id='ckedtor' placeholder="Keterangan tentang modul .... !!" required></textarea>
							  </div>
							  
							  <div class="form-group col-md-12 ">
								<button type='submit' name='submit' class='btn btn-primary float-right'><i class='ft-message-circle'></i> <b>Terbitkan</b></button>
							  </div>
							  <div class="form-group col-md-9">
								<?php
								if($_SESSION['level'] == 'M'){ echo"<input type='hidden' name='idtesis' class='form-control border-primary' value='$_SESSION[username]' required>";}
								else{
								$nim = mysqli_real_escape_string($config, $_REQUEST['idtesis']);
								$query2 = mysqli_query($config, "SELECT username FROM nio_user WHERE username='$nim'");
								while($rowus = mysqli_fetch_array($query2)){
									echo "<input type='hidden' name='idtesis' class='form-control border-primary' value='$rowus[username]' required>";
								}}
								?>
							  </div>
							  
							</div>
						  </div>
						</form>
					 </div>
					</div>
		
		<!-- HALAMAN LIS BIMBINGAN -->
		<div id="users-list" class="list-group position-relative">
		<div class="users-list-padding media-list">
		<?php
		$nim = mysqli_real_escape_string($config, $_REQUEST['idtesis']);
		$query = mysqli_query($config, "SELECT * FROM nio_tesis_bim,nio_tesis WHERE nio_tesis.idtesis=nio_tesis_bim.idtesis AND nio_tesis_bim.idtesis='$nim' ORDER BY nio_tesis_bim.idbim DESC");
		if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){
		$date = tgl_indo($row['tgl']);
		echo"
			<div class='media'>
			  <div class='media-left pr-1'><span class='avatar avatar-md avatar-online'><img class='media-object' src='themes/bimbol/icon/list.png' alt='Generic placeholder image'></span></div>
			  <div class='media-body w-100'>";
				if ($row['avt']=='D'){ 
					echo"<h6 class='list-group-item-heading'> <span class='f14 float-right'><i class='ft-users f16'></i> Guru</span>";
				}else{echo"<h6 class='list-group-item-heading'> <span class='f14 float-right'><i class='ft-message-circle f16 primary'></i> Mahasiswa</span>";}
				if ($row['act']=='R'){
					echo"
					<b class='warning'><i class='ft-pocket'></i> REVISI :</b><hr/>";
						if ($row['note']==''){ echo" Coretan Pada sesini kosong - SycReading"; } else { echo"$row[note]"; }
					echo"</h6>
					<p class='list-group-item-text text-muted mt-2 mb-0'><span class='primary'><i class='ft-calendar'></i> $date </span>";
						if ($row['file']==''){ echo"<span class='badge badge-pill badge-warning float-right'><i class='ft-x'></i> Berkas Kosong</span>"; } 
						else { echo"<a href='themes/bimbol/$row[file]' target='_blank' class='float-right'><span class='badge badge-pill badge-warning'><i class='ft-file-text f12'></i> Lihat Coretan Guru</span></a>"; }
					echo"</p>
					";
				}else if ($row['act']=='O'){
					echo"
					<span>
					<b class='success'>
					<span class='badge badge-pill badge-success'><i class='ft-check-circle f12'></i></span> BAB ACC</b><hr/>  Silahkan upload kembali <b class='danger'>BAB</b> selanjutnya untuk <b>Melanjutkan</b> Bimbingan Online anda.</h6>
					
					$row[note]
					<p class='list-group-item-text text-muted mb-0'><span class='primary'><i class='ft-calendar'></i> $date </span>
					<span class='badge badge-pill badge-success float-right'> UPLOAD BAB Selanjutnya</span>
					</p>
					</span>
					
					";
				}else if ($row['act']=='B'){
				
					echo"
					<b class='cyan'><i class='ft-file-text primary'></i> NEW FILE :</b><hr/> ";
						if ($row['note']==''){ echo" <i class='warning'>Coretan <b>SESI</b> ini kosong - SycReading</i>"; } else { echo"$row[note]"; }
					echo"</h6>
					<p class='list-group-item-text text-muted mt-2 mb-0'><span class='primary'><i class='ft-calendar'></i> $date </span>";
						if ($row['file']==''){ echo"<span class='badge badge-pill badge-warning float-right'><i class='ft-x font-small-2'></i> Berkas Kosong</span>"; } 
						else { echo"<a href='themes/bimbol/$row[file]' target='_blank'  class='float-right'><span class='badge badge-pill badge-secondary'><i class='ft-file-text f12'></i> Lihat Berkas</span></a>"; }
					echo"</p>
					";
				}				
				else{
				
					echo"
					<b><i class='ft-message-circle'></i> DISQUS</b><hr/> ";
						if ($row['note']==''){ echo" <i>Coretan <b>SESI</b> ini kosong - SycReading</i>"; } else { echo"$row[note]"; }
					echo"</h6>
					<p class='list-group-item-text text-muted mb-0'><span class='primary'><i class='ft-calendar'></i> $date </span>
					<span class='badge badge-pill badge-secondary float-right'><i class='ft-message-circle'></i></span></p>
					";
				}
				echo"
			  </div>
			</div>
		";		
		}}else{ echo'
		<div class="col-md-12">
				<div class="alert alert-light mb-2 text-center" role="alert">
				<h3 class="cyan pepe"> Notifications bimbol</h3><hr/>
				<b>SycBimbol<i class="ft-message-circle cyan"></i> </b> Belum terterdapat disqus bimbingan online pada mahasiswa ini.				
				</div>
			</div>		
		';}
		?>
		</div>
		</div>
			
		
	  </div>
	  
	  
	  <div class="col-md-3">
		<span data-toggle='collapse' data-target='#Disqusbimbol' class='btn btn-secondary btn-block'><i class='ft-plus-circle f14'></i> <b>MULAI BIMBINGAN</b></span><hr/>
		<div class="media">
		<?php
			$nim = mysqli_real_escape_string($config, $_REQUEST['idtesis']);
			$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$nim'");
			while($row = mysqli_fetch_array($query)){
				echo"<div class='media-left pr-1'>";
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='media-object brpe img-xl'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='media-object img-xl border' style='height:32px;'>"; }				
				echo"</div>
				<div class='media-body'><h4><b>Mahasiswa</b></h4><p>Informasi Identitas Mahasiswa <b>BIMBOL</b> </p>
				</div>
				";			  
		?>
		</div><hr/>
		
		<a href='' target='_blank' class='btn btn-secondary btn-block f14'><i class='fa fa-whatsapp'></i> +62 <?php echo $row['wa'];?></a>
		<a href='index.php' class='btn btn-dark btn-block f14'><i class='ft-x'></i> Close BIMBOL</a><hr/>
		<hr/>
		<p class='text-bold-500'><i class='ft-users f16'></i> <?php echo $row['nama'];?> <hr/>
		<i class='ft-mail f16'></i> <?php echo $row['email'];?></p><hr/>
		<i class='fa fa-whatsapp f16'></i> +62 <?php echo $row['wa'];?></p><hr/>
		
		<?php } ?>
	  </div>
	</div>
	
	
</div>
</div>
<?php } ?>