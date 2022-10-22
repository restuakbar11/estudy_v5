<?php
ob_start();
session_start();
require_once('include/config.php');
if(empty($_SESSION['level'])){
  $_SESSION['err'] = '<b>LOGIN</b> PLEASE';
  header("Location: ./");
  die();
} else {


?>
<html class="loading" lang="en" data-textdirection="ltr">

  <?php include('include/head.php'); ?>
  <body class="horizontal-layout horizontal-menu 2-columns bg-white menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
	
    <?php include "include/menu.php";?>

  <div class="app-content container center-layout mt-2 mb-3">
    <div class="content-wrapper"><div class="content-header row"></div>
		<?php		  
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            switch ($page) {
				case 'instansi':require_once"apps/instansi.php"; break;
				case 'on':require_once"apps/profile.on.php"; break;
				case 'guru':require_once"apps/master.guru.php"; break;
				case 'siswa':require_once"apps/master.siswa.php"; break;
				
				case 'mdl':require_once"apps/dosen.upload.php"; break;
				case 'views':require_once"apps/modul.views.php"; break;
				case 'mkl':require_once"apps/dosen.matakuliah.php"; break;
				case 'jrs':require_once"apps/dosen.jurusan.php"; break;
				case 'kls':require_once"apps/dosen.kelas.php"; break;
				case 'mhs':require_once"apps/dosen.mhs.php"; break;
				
				case 'tgs':require_once"apps/dosen.tugas.php"; break;
				case 'chektugas':require_once"apps/dosen.chektugas.php"; break;
				
				case 'tesis':require_once"apps/tesis.open.php"; break;
				case 'bimbol':require_once"apps/tesis.bimbingan.php"; break;
				
				case 'histori':require_once"apps/master.histori.php"; break;
				case 'inbox':require_once"apps/inbox.php"; break;
				case 'disqus':require_once"apps/master.disqus.php"; break;
				case 'session':require_once"apps/maste.logs.php"; break;
				case 'chat':require_once"apps/chatting.php"; break;
				case 'soal':require_once"apps/soal_ujian.php"; break;
				case 'data_soal':require_once"apps/data_soal_ujian.php"; break;
				case 'mrd_ujian':require_once"apps/murid_ujian.php"; break;
				case 'mrd_hasil_ujian':require_once"apps/hasil_ujian_mrd.php"; break;
				case 'hasil_ujian':require_once"apps/hasil_ujian.php"; break;

				case 'ganti_pass':require_once"apps/ganti_password.php";break;
				case 'soal_essay':require_once"apps/soal_essay.php"; break;
				case 'mrd_essay':require_once"apps/murid_essay.php"; break;
				case 'hasil_essay':require_once"apps/hasil_essay.php"; break;
				case 'koreksi_essay':require_once"apps/koreksi_essay.php"; break;
				case 'lihat_essay':require_once"apps/lihat_essay.php"; break;
				case 'data_soal_essay':require_once"apps/data_soal_essay.php"; break;
				case 'edit_essay':require_once"apps/edit_essay.php"; break;
			}
        } else {
		
		?>		
		
			
		<div class="row">
          <div class="col-xl-3 col-lg-6 col-12 d-none d-md-block">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-1 text-center bg-primary bg-darken-2"><i class="icon-trophy font-large-2 white"></i></div>
                  <div class="p-1 bg-gradient-x-cyan white media-body"><h5><?php echo $count1; ?> <b>E-Tugas</b></h5><h5 class="font-small-3">Tugas Murid</h5></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12 d-none d-md-block">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-1 text-center bg-primary bg-darken-2"><i class="icon-cloud-download font-large-2 white"></i></div>
                  <div class="p-1 bg-gradient-x-info white media-body"><h5><?php echo $count2; ?> <b>Download</b></h5><h5 class="f12">Semua Download</h5></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12 d-none d-md-block">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-1 text-center bg-primary bg-darken-2"><i class="icon-graduation font-large-2 white"></i></div>
                  <div class="p-1 bg-gradient-x-warning white media-body"><h5><?php echo $count3; ?> <b>Kelas</b> </h5><h5 class="font-small-3">Semua Kelas Murid</h5></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12 d-none d-md-block">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-1 text-center bg-primary bg-darken-2"><i class="icon-users font-large-2 white"></i></div>
                  <div class="p-1 bg-gradient-x-danger white media-body"><h5><?php echo $count4; ?> <b>Murid</b></h5><h5 class="font-small-3">Semua Murid</h5></div>
                </div>
              </div>
            </div>
          </div>
        </div>
		
		
		
		 <?php  if($_SESSION['level'] == 'M' || $_SESSION['level'] == 'A'){ ?>
		
		<div class="row match-height">
		  <div class="col-xl-8 col-lg-12">
			<div class="card">
			<div class="card-header">
			  <h4 class="card-title"><b>New Tugas</b></h4>
			</div>
			<div class="card-content">
			  <div class="table-responsive">
				<table id="recent-orders" class="table table-hover mb-0">
				<tbody>
				<?php 
				$kls = $_SESSION['kls'];
				if ($kls>0){
				$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_modul,nio_mkl,nio_jurusan,nio_user WHERE nio_modul.username=nio_user.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_kelas.idj=nio_jurusan.idj and nio_kelas.id_kel = $kls  order by idm ASC LIMIT 6");
				}else{
					$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_modul,nio_mkl,nio_jurusan,nio_user WHERE nio_modul.username=nio_user.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_kelas.idj=nio_jurusan.idj  order by idm ASC LIMIT 6");
				}
				
				while($row = mysqli_fetch_array($query)){
				$date = tgl_indo($row['date']);
				$kelas =$row['id_kel'];
				$oke =$row['hits']+1;
				$und =$row['unduh']+1;
				$ekstensi = array('zip','rar');
				$ekstensi2 = array('doc','docx');
				$file = $row['file']; $x = explode('.', $file); $eks = strtolower(end($x));
				echo"
				 <tr>					
					<td width='80%'>";
					if($kelas){
						echo"<h6 class='list-group-item-heading'><a href='?page=views&idm=$row[idm]' class='badge badge-dark f14' data-toggle='tooltip' data-original-title='Detail Pelajaran' ><i class='icon-badge'></i> Unduh Pelajaran</a></h6>";
					}else{
						echo"<h6 class='list-group-item-heading'><a href='?page=views&idm=$row[idm]' class='badge badge-secondary f14' data-toggle='tooltip' data-original-title='Detail Pelajaran' ><i class='icon-badge'></i> Unduh Pelajaran</a></h6>";
					}
					echo"
					    <b class='f14'>$row[jurusan]</b><br/> 
						<span class='f13 cursor' data-toggle='tooltip' data-original-title='Nama Matakuliah' ><i class='ft-inbox f12'></i>  $row[mkl]</span>
					</td>
					<td class='text-truncate text-right' width='5%'>
						<h5>$date</h5><span class='f12'>Kelas: <b class='teal'>$row[kelas]</b></span> <br/> <span class='f12'>Pelajaran : <b class='pepe'>$row[pertemuan]</b></span><br/>
						<span class='f14'>$row[nama] <i class='ft-user-check danger f16'></i></span>
					</td>
					<td width='5%'>";
					if(in_array($eks, $ekstensi) == true){echo '<img class="rounded" src="themes/zip.png" width="33px" height="45px" data-toggle="tooltip" data-original-title="File ini extensi ZIP / RAR">';} 
					else {
						if(in_array($eks, $ekstensi2) == true){echo '<img class="rounded" src="themes/word.png" width="33px" height="45px" data-toggle="tooltip" data-original-title="File ini extensi Dokumen">';} 
						else {echo '<img class="rounded" src="themes/pdf.png" width="33px" height="45px" data-toggle="tooltip" data-original-title="File ini extensi PDF">';}	
					}
					echo"
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
		  </div>
		  <div class="col-xl-4 col-lg-12">
		  <div class="card">
			<div class="card-header"><h4 class="card-title"><b>Info Murid Teratas</b></h4><hr/></div>
			<div class="card-content px-1">
			  <div id="recent-buyers" class="media-list height-300 position-relative">
			  <?php
			  $query = mysqli_query($config, "SELECT * FROM nio_user,nio_kelas WHERE nio_kelas.id_kel=nio_user.id_kel AND level='M' ORDER BY login DESC LIMIT 5");
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
				<?php } else{ } ?>


		 <?php  if($_SESSION['level'] == 'D'){ ?>

		<div class="row match-height">
		  <div class="col-xl-8 col-lg-12">
			<div class="card">
			<div class="card-header">
			  <h4 class="card-title"><b>MENU UTAMA</b></h4>
			</div>
			<div class="card-content">
			  <div class="table-responsive">
				<table id="recent-orders" class="table table-hover mb-0">
				<tbody>
				<?php 
				$kls = $_SESSION['kls'];
				if ($kls>0){
				$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_modul,nio_mkl,nio_jurusan,nio_user WHERE nio_modul.username=nio_user.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_kelas.idj=nio_jurusan.idj and nio_kelas.id_kel = 'XXX'  order by idm ASC LIMIT 6");
				}else{
					$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_modul,nio_mkl,nio_jurusan,nio_user WHERE nio_modul.username=nio_user.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_kelas.idj=nio_jurusan.idj and nio_kelas.id_kel = 'XXX' order by idm ASC LIMIT 6");
				}
				
				while($row = mysqli_fetch_array($query)){
				$date = tgl_indo($row['date']);
				$kelas =$row['id_kel'];
				$oke =$row['hits']+1;
				$und =$row['unduh']+1;
				$ekstensi = array('zip','rar');
				$ekstensi2 = array('doc','docx');
				$file = $row['file']; $x = explode('.', $file); $eks = strtolower(end($x));
				echo"
				 <tr>					
					<td width='80%'>";
					if($kelas){
						echo"<h6 class='list-group-item-heading'><a href='?page=views&idm=$row[idm]' class='badge badge-dark f14' data-toggle='tooltip' data-original-title='Detail Pelajaran' ><i class='icon-badge'></i> Unduh Pelajaran</a></h6>";
					}else{
						echo"<h6 class='list-group-item-heading'><a href='?page=views&idm=$row[idm]' class='badge badge-secondary f14' data-toggle='tooltip' data-original-title='Detail Pelajaran' ><i class='icon-badge'></i> Unduh Pelajaran</a></h6>";
					}
					echo"
					    <b class='f14'>$row[jurusan]</b><br/> 
						<span class='f13 cursor' data-toggle='tooltip' data-original-title='Nama Matakuliah' ><i class='ft-inbox f12'></i>  $row[mkl]</span>
					</td>
					<td class='text-truncate text-right' width='5%'>
						<h5>$date</h5><span class='f12'>Kelas: <b class='teal'>$row[kelas]</b></span> <br/> <span class='f12'>Pelajaran : <b class='pepe'>$row[pertemuan]</b></span><br/>
						<span class='f14'>$row[nama] <i class='ft-user-check danger f16'></i></span>
					</td>
					<td width='5%'>";
					if(in_array($eks, $ekstensi) == true){echo '<img class="rounded" src="themes/zip.png" width="33px" height="45px" data-toggle="tooltip" data-original-title="File ini extensi ZIP / RAR">';} 
					else {
						if(in_array($eks, $ekstensi2) == true){echo '<img class="rounded" src="themes/word.png" width="33px" height="45px" data-toggle="tooltip" data-original-title="File ini extensi Dokumen">';} 
						else {echo '<img class="rounded" src="themes/pdf.png" width="33px" height="45px" data-toggle="tooltip" data-original-title="File ini extensi PDF">';}	
					}
					echo"
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
		  </div>
		  <div class="col-xl-4 col-lg-12">
		  <div class="card">
			<div class="card-header"><h4 class="card-title"><b>Info Murid Teratas</b></h4><hr/></div>
			<div class="card-content px-1">
			  <div id="recent-buyers" class="media-list height-300 position-relative">
			  <?php
			  $query = mysqli_query($config, "SELECT * FROM nio_user,nio_kelas WHERE nio_kelas.id_kel=nio_user.id_kel AND level='M' ORDER BY login DESC LIMIT 5");
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


		<?php } else{ } ?>

		
		<?php }?>
	
		
		
		<?php  if($_SESSION['level'] == 'M'){ ?>
		 <div class="content-body">
			<div class="card card-content">
			  <div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
					<?php
					   $query = mysqli_query($config, "SELECT * FROM nio_user WHERE level='A' OR level='D' ORDER BY RAND() DESC LIMIT  1");
					   if(mysqli_num_rows($query) > 0){
						while($row = mysqli_fetch_array($query)){
						echo"
						<div class='media'>";
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='media-object brpe img-xl mr-2'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='media-object img-xl border mr-2' style='height:32px;'>"; }
						
						echo"
						  <div class='media-body'><h4><b>Guru </b></h4><h6 class='text-bold-500'> $row[nama]</h6> <p class='font-small-3 primary'>$row[kampus]</p></div>
						</div>
						  <a href='$row[fb]' class='btn btn-info btn-sm f14'><i class='ft-facebook'></i> Facebook</a>
						  <a href='$row[ig]' class='btn btn-danger btn-sm f14'><i class='ft-instagram'></i> Instagram</a>
						  <a href='?page=on&usr=$row[username]' class='btn btn-outline-primary btn-sm f14'><i class='ft-user-check'></i> Profile</a>
						";
						}
					   } else {
					   echo "Dosen idak diemukan";
					   }
					?>
					
				  
				</div>
				<div class="col-xl-8 col-lg-6 col-md-12  d-none d-md-block">
				  <h3>Selamat Datang  <b class='danger'><?php echo $_SESSION['nama']; ?></b>  di <b>E-Belajar</b></h3>
				  <p class='text-muted'><b>Media pembelajaran Blanded Learning </b>- <i> ini merupakan media pembelajaran <b>online</b> bagi Siswa. Anda dapat mendownload bahan pelajaran & mengirim tugas dari media <b>E-Belajar</b> ini, sebagai penilaian Guru anda. Setiap aktivitas anda dapat dilacak oleh guru anda, sebagai penilaian aktivitas respon anda terhadap pembelajaran.</i></p>
				</div>
			  </div>
			</div> 
		  </div>
		  <?php } else{ } ?>

		  <?php  if($_SESSION['level'] == 'D'){ ?>
		 <div class="content-body">
			<div class="card card-content">
			  <div class="card-body row">
				<div class="col-xl-1 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
					
				  
				</div>
				<div class="col-xl-8 col-lg-6 col-md-12  d-none d-md-block">
				  <h3>Selamat Datang  <b class='danger'><?php echo $_SESSION['nama']; ?></b>  di <b>E-Belajar</b></h3>
				  <p class='text-muted'><b>Media pembelajaran Blanded Learning </b>- <i> ini merupakan media pembelajaran <b>online</b> bagi Guru dan Siswa. Anda dapat Upload bahan pelajaran & mengirim tugas dari media <b>E-Belajar</b> ini, sebagai Tugas dari anda. Setiap aktivitas murid anda dapat dilacak oleh guru , sebagai penilaian aktivitas respon anda terhadap pembelajaran.</i></p>
				</div>
			  </div>
			</div> 
		  </div>
		  <?php } else{ } ?>

	  
    </div>
	
	
  </div>
	
	
	
	
    <!-- ////////////////////////////////////////////////////////////////////////////-->

  <?php include('include/footer.php'); ?>    
  </body>
</html>
<?php } ?>