
<div class='card p-1'>	
	<div class='row'>
		<div class='col-md-8'>
		<?php
			$query = mysqli_query($config, "SELECT * FROM nio_discussion,nio_user WHERE nio_discussion.id_posted=nio_user.username order by id_discus DESC");
			while($row = mysqli_fetch_array($query)){
			$date = tgl_indoo($row['date']);		
		?>
		  <div class='timeline-card p-1 mb-2' style='border-left:6px solid #eee;border-radius:8px;border-bottom:3px solid #eee;'>
			<div class='media ml-2'>
			<div class='media-left pr-1'>
				<?php
				
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='media-object img-xl bg-default' style='border:1px solid #ccc;border-radius:5px;'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='media-object brpe img-xl' style='border:2px solid #aaa;'>"; }
				?>
			</div>
			<div class='media-body'><h4><a href='?page=on&usr=<?php echo $row['username']; ?>' target='_blank'><b class='black'><?php echo $row['nama']; ?></b></a></h4>
				<p class='text-muted mb-0 f12'></p>
				<ul class='list-inline text-muted f14'>
					<li class='pr-1'><a href='' class='badge badge-pill badge-secondary'> <?php echo $row['category']; ?></a></li>
					<li class='pr-1'><a href='' ><span class='ft-calendar'></span> <?php echo $date; ?> (<?php echo $row['time']; ?>)</a></li>
					<li class='pr-1'><a href='#' class=''><span class='ft-award'></span> 
					<?php if($row['level'] == 'A'){ echo"<b class='secondary'>Administrator</b>";						
					} else if($row['level'] == 'D'){ echo"<b class='warning'>Guru</b>";
					} else { echo"<b class='danger'>Student</b>";  } ?> </a></li>
				</ul>
			</div>
			</div>
			
			
			<div class='card-content'> 
				<div class='card-body'>
				<span class='f14'>
				<i><b><?php echo $row['regards']; ?></b> - #<?php echo $row['tema']; ?></i></span>
				<?php echo $row['discussion']; ?>				
				</div>
				
				<?php if($row['category'] == 'Pengumuman'){ 
				echo "<div class='col-md-12' style='margin-top:-15px;'><p> <i class='ft-award f16' style='padding:4px;border:1px solid #aaa;border-radius:50%;'></i>  <i>Pengumuman ini berlaku untuk setiap pengguna E-Belajar !!</i></p></div>";			
				} else { ?>
				<a href='' class='badge badge-pill badge-primary float-right' data-toggle='collapse' data-target='#<?php echo $row['id_discus']; ?>'><i class='ft-message-circle f12'></i> BERI KOMENTAR </a>
				<div class='card-footer mt-1 collapse' id='<?php echo $row['id_discus']; ?>' aria-expanded='false'>
					
					<div class='media'>
					<div class='row p-1'>
					<?php
					$kangpepe = mysqli_query($config, "SELECT * FROM nio_discussion_comm, nio_discussion,nio_user WHERE nio_discussion_comm.username=nio_user.username AND nio_discussion.id_discus=nio_discussion_comm.id_discus AND nio_discussion_comm.id_discus='$row[id_discus]'");
					if(mysqli_num_rows($kangpepe) > 0){
					while ($kangpez = mysqli_fetch_array($kangpepe)){
					$date = tgl_indoo($kangpez['date']);
					echo "
							<div class='col-md-1 mb-2' style='border-left:2px solid #eee;border-radius:8px;border-bottom:1px solid #eee;'>		
							<div class='media-left'> <span class='avatar avatar-online border border-1'>";
							if($kangpez['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar'>";
							} else {echo"<img src='themes/user/$kangpez[photo]' alt='avatar' style='height:30px;border-left:2px solid #aaa;'>";}
							
							echo"</span></div>
							</div>
							
							<div class='col-md-11 mb-2' style='border-left:2px solid #eee;border-radius:8px;border:1px solid #eee;'>	
							<div class='media-body'>
								<p class='text-bold-600 mb-0'><a href='?page=on&usr=$kangpez[username]' target='_blank'>$kangpez[nama]</a> <small class='text-danger'><i>$date</i></small></p>
								$kangpez[comment]
							</div>
							</div>
					";	
					} }else {
					echo "<div class='col-md-12 ml-1' style='margin-top:-8px;'><p> <i class='ft-message-circle f14' style='padding:4px;border:1px solid #aaa;border-radius:50%;'></i>  <i>Jadilah orang pertama yang menanggapi topik diskusi ini !!</i></p></div>";						
					}
					
					
					?>	
						
						<form class='form col-md-12 mt-1' method='POST' action='?page=disqus&act=tanggapi' enctype='multipart/form-data'>
						<div class='row'>
						<div class='col-md-9'>			
							<input type='hidden' name='kangpepe1' value='<?php echo $row['id_discus']; ?>' required >		
							<textarea name='kangpepe2' rows='1' class='form-control ml-1' width='45px' placeholder='Berikan tanggapan anda disini' required></textarea>
						</div>
						<div class='col-md-2'>
							<button type='submit' name='submit' class='btn btn-primary'><b>Post Komentar</b></button>
						</div>
						</div>
						</form>
						
					</div>		
					</div>			
				</div>
				
				<?php } ?>
				
			</div>
		  </div>
		  
			<?php } ?>
		  
		  
		  <hr/>
		</div>
		<div class='col-md-4'>
		<?php
		if(isset($_SESSION['succAdd'])){
						$succAdd = $_SESSION['succAdd'];
						echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succAdd.'
						</div>';unset($_SESSION['succAdd']);
					}
		?>
			<a href='#' class='btn btn-secondary block' data-toggle='modal' data-backdrop='false' data-target='#BuatDiskusi'>BUAT DISKUSI BARU</a>	
			<div class='p-1 mt-3' style='border-left:5px solid #eee;border-radius:8px;border-bottom:3px solid #eee;'><h4 class='mb-2'><b>Penumuman Terbaru</b><br/><i class='f12'>Klik untuk popover baca detai pengumuman</i></h4>
				<ul>
				<?php
				$query = mysqli_query($config, "SELECT * FROM nio_discussion,nio_user WHERE nio_discussion.id_posted=nio_user.username AND category='Pengumuman' order by id_discus DESC");
				while($row = mysqli_fetch_array($query)){
				$date = tgl_indoo($row['date']);		
				echo"<li><a href='#' data-toggle='popover' data-placement='left' data-content='$row[discussion]' data-trigger='click' data-original-title='$row[nama] $date' data-html='true'><b>#$row[tema]</b></a><br/> <small><i>$row[nama]</i></small></li>";
				}
				?>
					
					
				</ul>
			</div>
			<div class='p-1 mt-3' style='border-right:5px solid #eee;border-radius:8px;border-bottom:3px solid #eee;'><h4 class='mb-2'><b>Topik Diskusi Terkini</b><br/><i class='f12'>tempelkan kursor menapilkan popover diskusi</i></h4>
				<ul>
				<?php
				$query = mysqli_query($config, "SELECT * FROM nio_discussion,nio_user WHERE nio_discussion.id_posted=nio_user.username order by RAND() LIMIT 10");
				while($row = mysqli_fetch_array($query)){
				$date = tgl_indoo($row['date']);		
				echo"<li><a href='#' data-toggle='popover' data-placement='bottom' data-content='$row[discussion]' data-trigger='hover' data-original-title='$row[nama] $date' data-html='true'><b>#$row[tema]</b></a><br/> <small><i>$row[nama]</i></small></li>";
				}
				?>
					
					
				</ul>
			</div>
			
			<h4 class='mt-3'><b>Murid Populer</b></h4>
			<div class="">
			  <div id="recent-buyers" class="media-list height-300 position-relative">
			  <?php
			  $query = mysqli_query($config, "SELECT * FROM nio_user,nio_kelas WHERE nio_kelas.id_kel=nio_user.id_kel AND level='M' ORDER BY login DESC LIMIT 4");
			  if(mysqli_num_rows($query) > 0){
			  while($row = mysqli_fetch_array($query)){
			  echo"
				<div class='media border-0'>
					<div class='media-left pr-1'>
					  <span class='avatar avatar-md avatar-online'>";
					
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='border'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='border-primary' style='width:47px; height:44px;'>"; }
					echo" 
					  <i></i></span>
					</div>
					<div class='media-body w-100'>
					  <h6 class='list-group-item-heading'>$row[nama] </h6>
					  <p class='list-group-item-text mb-0'>
					  <span class='badge badge-secondary'>$row[kelas]</span><a href='admin.php?page=on&usr=$row[username]' class='badge badge-dark ml-1'><i class='icon-user-following'></i> Profile </a></p>
					</div>
				</div>
			  
			  ";
			  } } else { echo "<h6 class='list-group-item-heading'> KOSONG </h6>"; }				  
			  ?>
			  </div>
			</div>
			
		</div>
	</div>
</div>



<div class='modal fade text-left' id='BuatDiskusi' tabindex='-1' role='dialog' aria-labelledby='myModalLabel4' aria-hidden='true'>
  <div class='modal-dialog modal-lg' role='document'>
	<div class='modal-content'>
	  <div class='modal-header bg-secondary'><h4 class='modal-title white' id='myModalLabel4'><b>BUAT DISKUSI BARU</b></h4><button type='button' class='close white' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='f18'>&times;</span></button></div>
	  <form class="form" method="POST" action="?page=disqus&act=add" enctype="multipart/form-data">
	  <div class='modal-body bg-default'>
			<div class='form-body'>
			<div class='row'>
				<div class='form-group col-md-5'><code>Tema Diskusi Anda</code>
					<input type='text' name='tema' class='form-control border-primary' placeholder='#Pembahasan Materi Pelajaran' required >
					
				</div>
				<div class='form-group col-md-4'><code>Salam Pembuka</code>
					<select name='slm' class='form-control border-primary' required>
						<option value='Assalamualaikum Wr.Wb'>Assalamualaikum Wr.Wb</option>
						<option value='Shalom & Tuhan Meberkati'>Shalom & Tuhan Meberkati</option>
						<option value='Om swastiastu'>Om swastiastu</option>
						<option value='Namo Buddhaya'>Namo Buddhaya</option>
						<option value='Wei De Dong Tian'>Wei De Dong Tian</option>
					</select>
				</div>
				<div class='form-group col-md-3'><code>Kategori</code>
					<select name='ktg' class='form-control border-primary' required>
						<?php if($_SESSION['level'] == 'M'){ ?>
						<option value='Diskusi Studi'>Diskusi Studi</option>
						<option value='Opini'>Opini</option>
						<?php } else { ?>
						<option value='Pengumuman'>Pengumuman</option>
						<option value='Intruksi'>Intruksi</option>
						<option value='Diskusi Studi'>Diskusi Studi</option>
						<option value='Opini'>Opini</option>
						<?php } ?>
					</select>
				</div>
				<div class='form-group col-md-12'><label><b>Deskripsi Diskusi</b></label>
					<textarea class='ckeditor form-control' name='des' id='ckedtor'  required></textarea>
				</div>
			</div>
			</div>
	  </div>
	  <div class='modal-footer bg-secondary'>
		<button  type='submit' name='submit' class='btn btn-info round'>Terbitkan</button>
		<button type='button' class='btn btn-danger round' data-dismiss='modal'>Tutup</button>
	  </div>
	  </form>
	</div>
  </div>
</div>




<?php
if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
	switch ($act) {
	  default:
	  break;
	  case 'add':
		$tema= $_REQUEST['tema'];
		$salam= $_REQUEST['slm'];
		$kategori= $_REQUEST['ktg'];
		$deskripsi= $_REQUEST['des'];
			$query = mysqli_query($config, "INSERT INTO nio_discussion(id_discus,id_posted,discussion, tema, regards,category,date,time)
											VALUES('','$_SESSION[username]','$deskripsi','$tema','$salam','$kategori',NOW(),NOW())");
				if($query == true){
					$_SESSION['succAdd'] = 'Diskusi anda telah diterbitkan';
					header("Location: ./admin.php?page=disqus");
					die();
				} else {
					$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
					echo '<script language="javascript">window.history.back();</script>';
				}
	  break;
	  case 'tanggapi':				  
		$idcus= $_REQUEST['kangpepe1'];
		$comment= $_REQUEST['kangpepe2'];
			$query = mysqli_query($config, "INSERT INTO nio_discussion_comm(id_comm,username,id_discus,comment,date)
											VALUES('','$_SESSION[username]','$idcus','$comment',NOW())");
				if($query == true){
					$_SESSION['succAdd'] = 'Diskusi anda telah diterbitkan';
					header("Location: ./admin.php?page=disqus");
					die();
				} else {
					$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
					echo '<script language="javascript">window.history.back();</script>';
				}
	  break;
	}
}
?>