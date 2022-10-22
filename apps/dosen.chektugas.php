<?php if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ ?>

<div class="row" id="default">
<div class="col-12">
 <div class="card">
 <div class="card-content collapse show">
	<div class="card-body card-dashboard text-center">
		 <?php
		  echo" <div class='disp'>";
			$query2 = mysqli_query($config, "SELECT institusi,alamat,prov,url,email,telp,logo FROM nio_edosen");
                    list($institusi,$alamat,$prov,$url,$email,$telp,$logo) = mysqli_fetch_array($query2);
                    if(!empty($institusi)){ echo '<h6 class="up" id="nama">'.$institusi.'</h6><br/>';} 
					else { echo '<h6 class="up" id="nama"></h6><br/>';}
					
                    echo '<h6 class="up" id="lapz">HALAMAN PEMERIKSAAN TUGAS SISWA </h6><br/>';
                    if(!empty($alamat)){echo '<p class="f12" id="alamat">'.$alamat.' - '.$prov.'</p>';}
					else {
                        echo '<span id="alamat">Jl..</span>';
                    }
			echo"
			</div>";
		 ?>
	</div>
	<?php
		if(isset($_REQUEST['act'])){
		$act = $_REQUEST['act'];
			switch ($act) {
			case 'ok':
			  $u1 = $_REQUEST['ax1'];
			  $u2 = $_REQUEST['ax2'];
			  $u3 = $_REQUEST['ax3'];
			  $query2 = mysqli_query($config, "UPDATE nio_uptugas SET act='A', nilai='$u1' WHERE idupt='$u3'");
			  if($query == true){
			  echo '<script language="javascript">window.history.back();</script>';
			  } else {
				$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
											header("Location: ./admin.php?page=chektugas&idt=$u2");
			  }
			break;
			case 'no':
			  $idupt = mysqli_real_escape_string($config, $_REQUEST['idupt']);
			  $query = mysqli_query($config, "UPDATE nio_uptugas SET act='X', nilai='0' WHERE idupt='$idupt'");
			  if($query == true){
			  echo '<script language="javascript">window.history.back();</script>';
			  } else {
				$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
				echo '<script language="javascript">window.history.back();</script>';
			  }
			break;
			}
		} else{?>
	
	
	<div class="table-responsive">
	<table class="table table-striped mb-0">
	  <thead>
		<tr>
		  <th width='75%'>NPM & NAMA SISWA</th>
		  <th width='18%'>ACTION POINT</th>
		  <th>KOREKSI TUGAS</th>
		  <th width='8%'>NILAI</th>
		</tr>
      </thead>
	  <tbody>
	  <?php
	  $cekidt = mysqli_real_escape_string($config, $_REQUEST['idt']);
	  $query = mysqli_query($config, "SELECT * FROM nio_uptugas,nio_user WHERE nio_uptugas.username=nio_user.username AND nio_uptugas.idt='$cekidt' ORDER BY nio_user.nama ASC");
		while($row = mysqli_fetch_array($query)){
		echo"
		<tr>		  
		  <td><b>$row[username]</b> -  $row[nama] <br/> <small>$row[file]</small></td>";
		  if ($row['act']=='A'){ echo"<td width='2%'><span class='badge badge-pill badge-info mr-1' data-toggle='tooltip' data-original-title='Tugas telah Diterima'><i class='ft-check f14'></i></span> DITERIMA</td>";
		  }else if ($row['act']=='X'){  echo"<td width='2%'><span class='badge badge-pill badge-danger mr-1' data-toggle='tooltip' data-original-title='Tugas telah Diterima'><i class='ft-x f14'></i></span> DITOLAK</td>";
		  } else { echo"
			<form class='form' method='POST' action='?page=chektugas&act=ok' enctype='multipart/form-data'>
			<td>
			<input type='text' name='ax1' class='form-control-sm border-primary' value='$row[nilai]' required   data-toggle='tooltip' data-original-title='Nilai dari Tugas'><br/>
			<input type='hidden' name='ax2' value='$row[idt]' required>
			<input type='hidden' name='ax3' value='$row[idupt]' required>
			<button type='submit' name='submit' class='btn btn-block btn-sm btn-success f14' style='margin-top:2px;'><i class='ft-check-square'></i> DITERIMA</button></form>
			<a href='?page=chektugas&act=no&idupt=$row[idupt]' class='btn btn-block btn-sm btn-danger F14' style='margin-top:2px;'><i class='ft-x-square'></i> DITOLAK</a>
			</td>
			
		   ";}		  
		  echo"
		  <td width='3%'><a  href='include/tugas/$row[file]' target='_blank' class='badge badge-pill badge-primary badge-glow'   data-toggle='tooltip' data-original-title='Cek Kebenaran Tugas Siswa'> <i class='ft-clipboard'></i> Periksa Tugas</a>
			</td>
		  <td>";
		  if ($row['nilai']==''){ echo"<span class='badge badge-pill badge-danger'  data-toggle='tooltip' data-original-title='Tugas Belum Diterima'><i class='ft-alert-octagon f14'></i></span>";
		  }
		  else if ($row['nilai']=='0'){ echo"<span class='badge badge-pill badge-danger'>0</span>";
		  } else {echo"<span class='badge badge-pill badge-info'>$row[nilai]</span>";}
		  echo"
		  </td>
		</tr>";
		}
		
	  }
	  ?>
	  </tbody>
	</table>
	</div>
	<div class="card-body card-dashboard text-right">
		<h5 class="pepe">Keterangan</h5>
		<p class="card-text">Jika aksi tidak dilakukan maka nilai tugas Siswa adalah <b>kosong</b><br/> Jika tugas Siswa ditolak maka nilai siswa adalah <b>0</b> </p>
	</div>
  </div>
  </div>
</div>
</div>

<?php } else { header("Location: ./");} ?>