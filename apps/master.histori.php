
<div class="card">
<div class="card-body">
	<div class="row">
	  <div class="col-md-12">
		<!-- HALAMAN LIS BIMBINGAN -->
		<div id="users-list" class="list-group position-relative">
		<div class="users-list-padding media-list">
			<table class="table table-striped table-bordered zero-configuration  p-2">
			  <thead>
					<tr><th class='text-center pepe cyan'><h3 class=''><b>History Unduh Pelajaran</b></h3></th></tr>
			  </thead>
			  <tbody>
			<?php
			$query = mysqli_query($config, "SELECT * FROM nio_modul,nio_unduh,nio_mkl WHERE nio_modul.idmk=nio_mkl.idmk AND nio_unduh.idm=nio_modul.idm AND nio_unduh.username='$_SESSION[username]'");				
				while($row = mysqli_fetch_array($query)){
				$date = tgl_indo($row['date']);
			  echo"<tr><td>
			<div class='media'> 
			  <div class='media-body w-80'>
				<h5 class='list-group-item-heading pepe'> <span class='font-small-3 float-right primary'><b>
				
				<i class='font-medium-5 ft-users blue-grey lighten-3' data-toggle='tooltip' data-original-title='Letcure'></i>
				
				</b></span>
				
				<b><i class='ft-users primary f16'></i> $row[mkl]</b></h5>
				<p class='list-group-item-text text-muted mb-0 f14'>
					<i class='ft-airplay primary'></i> $row[unduh] Downloader
					<i class='ft-eye primary ml-1'></i> $row[hits] Viewers
					<i class='ft-check-circle primary ml-1'></i> Pertemuan or Pelajaran in -$row[pertemuan]
					<span   class='float-right f16'>
					<a href='?page=views&idm=$row[idm]'><span class='badge badge-pill badge-secondary'><i class='ft-printer'></i> Show detail</span></a>
					<a href='include/modul/$row[file]' target='_blank'><span class='badge badge-pill badge-danger'> <i class='ft-check-circle'></i> Unduh Agin</span></a>
					</span>
				</p>
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
