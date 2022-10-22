<?php
//include "../include/config.php";
//session_start();
$nidn = $_SESSION['username'];
?>
<!-- ALERT CUSTOM -->
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/sweetalert2.min.css">
			<form class="form form-horizontal" method="post" action="?page=instansi" enctype="multipart/form-data">
				<div class="form-body">
				<div class="alert alert-light mb-1" role="alert">
					<b>GANTI PASSWORD</b>
				</div>
				  <div class="row">
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-5 label-control" for="userinput1"><b>Password Lama</b></label>
					  <div class="col-md-7">
						<input type="Password" name="pass_lama" id="pass_lama" class="form-control border-primary pepe" placeholder="Masukkan Password Lama Anda" >
						<input type="hidden" name="nidn" id="nidn" class="form-control border-primary pepe" value="<?php echo "$nidn"; ?>">
					  </div>
					</div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-5 label-control" for="userinput1"><b>Password Baru</b></label>
					  <div class="col-md-7">
						<input type="Password" name="pass_baru" id="pass_baru" class="form-control border-primary pepe" placeholder="Masukkan Password Baru Anda" >
					  </div>
					</div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-md-6">
					<div class="form-group row">
					  <label class="col-md-5 label-control" for="userinput1"><b>Masukkan Lagi Password Baru Anda</b></label>
					  <div class="col-md-7">
						<input type="Password" name="pass_baru2" id="pass_baru2" class="form-control border-primary pepe" placeholder="Masukkan Lagi Password Baru Anda" >
					  </div>
					</div>
					</div>
				  </div>
				</div>
				
				<div class="form-actions right">
				  <a type="submit" name="submit" onclick="javascript:ubah_password()" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Simpan</a>
				  <button type="reset" class="btn btn-warning mr-1"><i class="ft-x"></i> Cancel</button>
				</div>
			</form>
			
			<div class="card-text float-right">
				<p>Halaman ini merupakan halaman identitas Aplikasi <code>E-Belajar</code> anda.<br/>Silahkan melakukan update data identitas mengenai e-Belajar anda pada halaman ini.</p>
				
		<p class="card-text text-right m-2">E-Belajar<br/> Power by : <a href="https://www.ebelajar.com" data-toggle="tooltip" data-original-title="Instagram Owner">@ebelajar</a></p>
			</div>
			
			
			</div>
		  </div>
		</div>
	</div>
	</div>
  <!-- ALERT CUSTOM -->
    <script src="themes/sweetalert/js/jquery.min.js"></script> 
    <script src="themes/sweetalert/js/sweetalert2.min.js"></script> 
    <script src="themes/sweetalert/js/bootstrap.min.js"></script>
	<script>
		function ubah_password(){
			nidn = document.getElementById('nidn').value;
			pass_lama = document.getElementById('pass_lama').value;
			pass_baru= document.getElementById('pass_baru').value;
			pass_baru2 = document.getElementById('pass_baru2').value;
			if(pass_baru == pass_baru2){
					$.ajax({
					type:'POST',
					data:({nidn:nidn,pass_lama:pass_lama,pass_baru:pass_baru,pass_baru2:pass_baru2,}),
					url : "apps/aksi_ganti_pass.php", 
					dataType:'json',
					success:function(data){
						if(data.error == false){
							swal({
							  title: 'Tersimpan..!!',
							  text: "PASSWORD ANDA BERHASIL DIRUBAH",
							  confirmButtonColor: "#80C8FE",
							  type: "success",
							  timer: 3500,
							  confirmButtonText: "Ya",
							  showConfirmButton: true
							});
						}else{
							swal({
							  title: 'GAGAL SIMPAN..!!',
							  text: "ANDA SALAH MEMASUKKAN PASSWORD LAMA ANDA",
							  confirmButtonColor: "#80C8FE",
							  type: "error"
							});
						}

						
					}
				});
							//alert('ok');

				}else{
					swal({
							  title: 'GAGAL SIMPAN..!!',
							  text: "ANDA SALAH MEMASUKKAN KONFIRMASI PASSWORD",
							  confirmButtonColor: "#80C8FE",
							  type: "error"
							});
				}
			
		}
	</script>