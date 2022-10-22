<?php
$semester = $_SESSION['semester'];
?> 
	  
<section id="configuration">
<div class="row">
	<div class="col-md-12">
	
	<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
	//AKSI SUPERUSER 
			if(isset($_REQUEST['act'])){
						$act = $_REQUEST['act'];
						switch ($act) {
						  
						  case 'del':				  
							$idmodul = mysqli_real_escape_string($config, $_REQUEST['idm']);
							$query = mysqli_query($config, "SELECT * FROM  nio_modul WHERE  idm='$idmodul'");
							while($row = mysqli_fetch_array($query)){
								unlink("include/modul/".$row['file']);}
								$query = mysqli_query($config, "DELETE FROM nio_modul WHERE idm='$idmodul'");
								$query = mysqli_query($config, "DELETE FROM nio_unduh WHERE idm='$idmodul'");
								if($query == true){
									$_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
									header("Location: ./admin.php?page=mdl");
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
	<div class="row">
		<div class="col-md-12 content-body">	  
			<div class="card card-content">
			  <div class="card-body row">
				<div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5"><?php require_once "superuser.php"; ?> </div>
				<div class="col-xl-8 col-lg-6 col-md-12">
					<?php
					if(isset($_SESSION['succAdd'])){
						$succAdd = $_SESSION['succAdd'];
						echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succAdd.'
						</div>';unset($_SESSION['succAdd']);
					}
					if(isset($_SESSION['errFormat'])){
						$errFormat = $_SESSION['errFormat'];
						echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$errFormat.'
						</div>';unset($_SESSION['errFormat']);
					}
					if(isset($_SESSION['succDel'])){
						$succDel = $_SESSION['succDel'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDel.'
						</div>';unset($_SESSION['succDel']);
					}
					if(isset($_SESSION['succDel'])){
						$succDel = $_SESSION['succDel'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succDel.'
						</div>';unset($_SESSION['succDel']);
					}
					?>
					
				</div>
			  </div>
			</div> 
		</div>
		
		
		<div class="col-md-12">
		<div class="card-content card">
			<div class="card-body card-dashboard">
			<table class="table table-borderless bg-lighten-4 zero-configuration">			
				<thead class=''>
					<tr>
					<th>Tanggal Soal<br/></th>
					<th>Kode Soal<br/></th>
					<th class='text-center'>Mata Pelajaran<br/></th>
					<th class='text-right'>Opsi<br/></th>
					</tr>
				</thead>
			  <tbody>
				<?php
				$id_guru = $_SESSION['nidn'];
				

				$query = mysqli_query($config, "SELECT a.id_mapel,a.tgl_input,a.id_soal,b.mkl AS nm_mapel,a.id_guru FROM M_SOAL_ESSAY a
INNER JOIN nio_mkl b ON a.id_mapel=b.idmk where a.id_guru	= '$id_guru' and a.semester='$semester'
GROUP BY a.id_soal
ORDER BY a.tgl_input ASC");
				if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)){
				$date_soal = tgl_indo($row['tgl_input']);
				$kode_soal = $row['id_soal'];
				$mapel = $row['nm_mapel'];
				$idguru = $row['id_guru'];
				$id_mapel = $row['id_mapel'];
				echo"
						  <td>
					    <b class='primary'>$date_soal</b><br/> 
						
					  </td>
					  <td>
					    <b class='primary'>$kode_soal</b><br/> 
						
					  </td>
					  <td width='17%'>						
						<p class='text-left f14'>
							<b class='primary'> $mapel</b>
						</p>
					  </td>
					 
					  
					  <td width='16%'>
								<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-dark'><i class='ft-inbox f24'></i></button>
								<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
								<div class='dropdown-menu'>
									
									<a class='dropdown-item' href='?page=edit_essay&id_mapel=$id_mapel' ><i class='ft-feather'></i> <b>Lihat Soal</b></a>
								</div>
								</div>
							  </td>
					</tr>  
				  ";
				}
				} 			  
				?>
				
			  </tbody>
			</table>
			</div>
        </div>	
		</div>	
	  <!-- AKHIR LISD ADMINNA -->
	</div>
	
	<!-- AWAL HALAMAN MAHASISWA -->
	<?php } else{
	
	echo'
			<div class="card-content card">
			<div class="card-body card-dashboard">
			<table class="table table-borderless zero-configuration">
				<thead>
				  <tr><th class="text-center pepe dark f20" colspan="4">Hasil Ujian Anda</th></tr>
				  <tr class="text-left">
					<th>Tanggal Jawab <br/> <span class="f12"></th>
					<th>Mata Pelajaran<br/><span class="f12"></th>
					<th>Nilai Anda<br/><span class="f12"></th>
					<th>Action<br/><span class="f12"></th>
				  </tr>
				</thead>
				<tbody>';
				$nidn = $_SESSION['username'];
				$query = mysqli_query($config, "SELECT a.id_mapel,a.id_murid,a.tgl_jawab, b.mkl AS mapel, SUM(a.nilai) AS nilai FROM m_jawaban_essay a
INNER JOIN nio_mkl b ON a.id_mapel=b.idmk WHERE nidn='$nidn'
GROUP BY id_mapel");				
				while($row = mysqli_fetch_array($query)){

				$date = tgl_indo($row['tgl_jawab']);
				echo"
				  <tr>
					<td><b class='f13 primary'>$date</b><br/><span class='f12'></td>
					<td>
						<b class='f13 primary'>$row[mapel]</b><br/> 
						
					</td>
					<td width='15%'>
						<p class='text-center f12'>
							<b class='teal'> $row[nilai]</b>
						</p>
					</td>
					<td width='16%'>
								<div class='btn-group btn-block mr-1 mb-1'><button type='button' class='btn btn-dark'><i class='ft-inbox f24'></i></button>
								<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <b>Options</b></button>
								<div class='dropdown-menu'>
									
									<a class='dropdown-item' href='?page=lihat_essay&id_mapel=$row[id_mapel]&id_mrd=$row[id_murid]' ><i class='ft-feather'></i> <b>Lihat Hasil</b></a>
								</div>
								</div>
							  </td>
					
				  </tr>";
				}
			echo'
				</tbody>
			</table>
			</div>
			
			
			</div>
			';
	
	} ?>
	<!-- AKHIR HALAMAN MAHASISWA -->
	</div>
</div>
</section>
	