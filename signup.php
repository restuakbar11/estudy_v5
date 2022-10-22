<?php
    ob_start();
    session_start();
    //cek session
    if(isset($_SESSION['level'])){
        header("Location: ./admin.php");
        die();
    }
    require('include/config.php');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  
<!-- Mirrored from pixinvent.com/stack-responsive-bootstrap-4-admin-template/html/ltr/horizontal-menu-template/login-with-bg-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 May 2018 01:28:37 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Registrasi Murid</title>
	 <?php
      $query = mysqli_query($config, "SELECT logo from nio_edosen");
      list($logo) = mysqli_fetch_array($query);
      if(!empty($logo)){
          echo '<link rel="icon" href="./themes/images/logo/'.$logo.'" type="image/x-icon">';
      } else {
          echo '<link rel="icon" href="./themes/images/logo/niozone-app.png" type="image/x-icon">';
      }
     ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="themes/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="themes/css/app.min.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="themes/css/core/menu/menu-types/horizontal-menu.min.css">
    <link rel="stylesheet" type="text/css" href="themes/css/pages/login-register.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
  </head>
  <body class="horizontal-layout horizontal-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content container center-layout mt-0">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
		<?php
 if(isset($_REQUEST['pepe'])){
		$nama		 = $_REQUEST['kangpepe1'];
		$username	 = $_REQUEST['kangpepe2'];
		$password	 = $_REQUEST['kangpepe3'];
		$whatsapp	 = $_REQUEST['kangpepe4'];
		$email		 = $_REQUEST['kangpepe5'];
		$idkls		 = $_REQUEST['kangpepe6'];		
		
		$sql = "SELECT * FROM nio_user where username= '$username'";
		$process = mysqli_query($config, $sql);
		$num = mysqli_num_rows($process);
		if($num == 0){
			$query = mysqli_query($config, "INSERT INTO nio_user(username,password,level,nama,email,wa,id_kel,login)
				VALUES('$username',MD5('$password'),'M','$nama','$email','$$whatsapp','$idkls','0')");
				if($query == true){
					$_SESSION['succAdd'] = '<b>Selamat</b> Akun anda telah didaftarkan.';
					header("Location: signup.php");
					die();
				} else {
					$_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
					echo '<script language="javascript">window.history.back();</script>';
				}
		}else {
			$_SESSION['AdaKangPe'] = '<b> Validate :</b> Maaf Akun anda sudah terdaftar. Hubungi Superuser system untuk verifikasi.';
			header("Location: signup.php");
		}
	
  } else {
?>
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-5  box-shadow-3 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-1 m-0">
                
                <div class="card-header border-0 pb-0">
                    <div class="card-title text-center"><img src="themes/images/eDosen-App.png" class="rounded" width='170px' height='35px'></div>
					<p class="line-on-side text-muted text-center pt-1"><span><b>Registrasi Student</b></span></p>
					<?php
					if(isset($_SESSION['succAdd'])){
						$succAdd = $_SESSION['succAdd'];
						echo'<div class="alert alert-icon-left alert-info alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$succAdd.'
						</div>';unset($_SESSION['succAdd']);
					}
					if(isset($_SESSION['errQ'])){
						$errQ = $_SESSION['errQ'];
						echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$errQ.'
						</div>';unset($_SESSION['errQ']);
					}
					if(isset($_SESSION['AdaKangPe'])){
						$AdaKangPe = $_SESSION['AdaKangPe'];
						echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$AdaKangPe.'
						</div>';unset($_SESSION['AdaKangPe']);
					}
					?>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control" name="kangpepe1" placeholder="Nama Lengkap" required>
                                <div class="form-control-position">
                                    <i class="ft-users"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control" name="kangpepe2" placeholder="NPM SIAKAD" required>
                                <div class="form-control-position">
                                    <i class="ft-award"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control" name="kangpepe3" placeholder="Password SIAKAD" required>
                                <div class="form-control-position">
                                    <i class="ft-unlock"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control" name="kangpepe4" placeholder="081365655692 " required>
                                <div class="form-control-position">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" class="form-control" name="kangpepe5" placeholder="Email Active" required>
                                <div class="form-control-position"><i class="ft-at-sign"></i></div>
                            </fieldset>							
							  <div class="form-group row">
								<div class="col-md-7 col-12 text-center text-sm-left">
                            <fieldset class="form-group position-relative has-icon-left">
								<select name="kangpepe6" class="form-control border-primary" required>
								  <option value=""> Pilih Kelas</option>
								  <?php
								  $query = mysqli_query($config, "SELECT * FROM nio_kelas");
								  while($row = mysqli_fetch_array($query)){
								  echo "<option value='$row[idk]'><strong>$row[kelas]</strong> - Angkatan $row[tahun]</option>";}			
								  ?>					 
								</select>
                                <div class="form-control-position"><i class="ft-briefcase"></i></div>
                            </fieldset>
								
								</div>
								<div class="col-md-5 col-12 float-sm-left text-center text-sm-right mt-1"><a href="index.php" class="card-link"><i class="ft-unlock f14"></i>  <b>Login System</b></a></div>
							  </div>		
                            <button type="submit" name='pepe' class="btn btn-primary btn-block"><b><i class="ft-user-plus"></i> Registrasi Akun</b></button>
                        </form>
                    </div>
				  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Copyright@2020</span></p>	
                </div>
            </div>
        </div>
		
		
		
    </div>
	<?php } ?>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    
    <!-- BEGIN VENDOR JS-->
    <script src="themes/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="themes/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript" src="themes/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="themes/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="themes/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN STACK JS-->
    <script src="themes/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="themes/js/core/app.min.js" type="text/javascript"></script>
    <script src="themes/js/scripts/customizer.min.js" type="text/javascript"></script>
    <!-- END STACK JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="themes/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
    <script src="themes/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
	
    <noscript>
        <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
    </noscript>

    <!-- END PAGE LEVEL JS-->
  </body>

<!-- Mirrored from pixinvent.com/stack-responsive-bootstrap-4-admin-template/html/ltr/horizontal-menu-template/login-with-bg-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 May 2018 01:28:38 GMT -->
</html>