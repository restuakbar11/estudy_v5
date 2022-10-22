<section id="description" class="card">
    <div class='card-header'><h4 class='card-title'><b><i class='icon icon-layers f16'></i> Pelajaran</b></h4><hr/></div>
    <div class="card-content">
        <div class="card-body">
		<div class="row">
		<?php
		if(isset($_REQUEST['act'])){
		$act = $_REQUEST['act'];
			switch ($act) {
				case 'unduh':
					$u1 = $_REQUEST['u1'];
					$u2 = $_REQUEST['u2'];
					$u3 = $_REQUEST['u3'];
					$u4 = $_REQUEST['u4'];
					$query = mysqli_query($config, "INSERT INTO nio_unduh(username,idm,tgl_unduh) VALUES('$u2','$u3',NOW())");
					$query2 = mysqli_query($config, "UPDATE nio_modul SET unduh='$u1' WHERE idm='$u3'");
					  if($query == true){
						$_SESSION['UnduhOK'] = '<b> Berhasil Unduh !!</b> Data <b>AutoSys </b>tersimpan pada histori unduhan anda.<br/>Untuk melakukan Download Langsung dibawah ini : <hr/>
						<a href="include/modul/'.$u4.'" class="btn btn-info" target="_blank"> UNDUH LANGSUNG </a>';
						header("Location: ./admin.php?page=views&idm=$u3"); die();						
					  } else {
						$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
						echo '<script language="javascript">window.history.back();</script>';
					  }
				break;
			}
		} else {
			$idmodul = mysqli_real_escape_string($config, $_REQUEST['idm']);
			$query = mysqli_query($config, "SELECT * FROM  nio_modul,nio_kelas,nio_mkl,nio_jurusan,nio_user WHERE nio_user.username=nio_modul.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_jurusan.idj=nio_kelas.idj AND idm='$idmodul'");
			if(mysqli_num_rows($query) > 0){
			while($row = mysqli_fetch_array($query)){
			$date = tgl_indo($row['date']);
			$oke =$row['hits']+1;
			$und =$row['unduh']+1;
			$ekstensi = array('zip','rar');
			$ekstensi2 = array('doc','docx');
			$file = $row['file']; $x = explode('.', $file); $eks = strtolower(end($x));
			echo'
				<div class="col-md-4 mb-2">
				<div class="media">';
				if(in_array($eks, $ekstensi) == true){echo ' <img class="media-object" src="./themes/zip.png" style="width: 60px;height: 64px;">';} 
				else {
					if(in_array($eks, $ekstensi2) == true){echo '  <img class="media-object" src="./themes/word.png"  style="width: 60px;height: 64px;">';} 
					else {echo ' <img class="media-object" src="./themes/pdf.png"  style="width: 55px;height: 64px;">';}	
				}
				echo"<div class='media-body ml-2'>
						<p class='f16'> <b class='teal'>Guru : </b><br/>$row[nama]</p>
						<p class='f16'> <b class='teal'>Date Upload: </b><br/>$date</p>
					</div>
				</div>
				<p class='mt-1 text-center'>
					<b class='teal'><i class='ft-cloud-rain'></i> $row[unduh]</b>  Unduh  
					<b class='pink'><i class='ft-star'></i> $oke</b>  Hits<br/>
				</p>";
				
				if($_SESSION['kls']){				
					$ada = mysqli_query($config, "SELECT username, idm FROM nio_unduh WHERE idm='$row[idm]' AND username='$_SESSION[username]'");
					if(mysqli_num_rows($ada) > 0){
						
						echo"<a href='#' class='btn btn-warning btn-block' data-toggle='collapse' data-target='#saldomin'><b>Download Agin</b></a>
							<p id='saldomin' aria-expanded='false' class='mt-1 f14 text-center alert white alert-secondary bg-dark collapse'>Modul perkuliahan ini telah anda <b>Unduh</b> Sebelumnya. Silahkan unduh kembali pada Halaman <a href='?page=histori'><b>History Unduh</b></a></p> ";
					} else {
						echo"<form class='form' method='POST' action='?page=views&act=unduh' enctype='multipart/form-data'>
						  <input type='hidden' name='u1' value='$und' required>
						  <input type='hidden' name='u2' value='$_SESSION[username]' required>
						  <input type='hidden' name='u3' value='$row[idm]' required>
						  <input type='hidden' name='u4' value='$row[file]' required>
						  <button type='submit' name='submit' class='btn btn-primary btn-block'><b>Download file</b></button>
						 </form>";
					}
				} else {
					if($_SESSION['level'] == 'M'){
					echo"<p class='text-center alert alert-secondary collapse' id='seeinfo' aria-expanded='false'>Selain Kelas <b>$row[kelas]</b> Angkatan <b>$row[tahun]</b> <b class='danger'>History Unduh</b> tidak dapat dicatat sebagai file unduhan pada system.<br/><br/>
						<a href='include/modul/$row[file]' target='_blank' class='danger'><b class='badge badge-pill badge-dark'>Tetap Download</b></a></p>
						<a href='' data-toggle='collapse' data-target='#seeinfo' class='btn btn-secondary btn-block'><b>Download Filev</b></a>";}
					else{ echo"<a href='include/modul/$row[file]' target='_blank' class='btn btn-secondary btn-block'><b>Guru Download</b></a>"; }
				
				}
				
				echo"				
				</div>
				<div class='col-md-8'>";
				
				if(isset($_SESSION['UnduhOK'])){
					$UnduhOK = $_SESSION['UnduhOK'];
					echo'<div class="alert alert-light mb-2 text-center" role="alert">'.$UnduhOK.'</div>';
					unset($_SESSION['UnduhOK']);
				}
				echo"
				  <h4 class='danger'><i class='ft-check-circle icon-bg-circle bg-danger f12'></i> <b>Informasi Pelajaran</b></h4><br/>
				 	 <h5><b>Kelas :</b>  $row[kelas]</h5>
					<h5><b>Jurusan :</b>  $row[jurusan]</h5>
					
					<h5><b>Pelajaran :</b>  $row[mkl]</h5>
					<h5><b>COURSES :</b>  <span class='pepe'>$row[pertemuan]</span></h5><hr/>
				  
				  <h4 class='teal mt-2'><i class='ft-copy icon-bg-circle bg-teal f12'></i> <b>Keterangan Pelajaran	</b></h4><br/>
				  <p style='text-align:justify;' class='f16'>$row[isi] </p><p><b>Document : </b> <span class='f12'>$row[file]</span></p><hr/>
				  <!-- sini komen-->
				</div>";
				$pepe = mysqli_query($config,"UPDATE nio_modul SET hits='$oke' WHERE idm='$idmodul'");
			} 
			
			}else{
        header("Location:?page=mdl");
			}
		}		
		?>
		</div>
        </div>
    </div>
</section>
