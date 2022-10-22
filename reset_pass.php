<?php
    ob_start();
    session_start();
require('include/config.php');
?>
<!doctype html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Selamat Datang di Sistem E-Belajar</title>
	 <?php
      $query = mysqli_query($config, "SELECT logo,institusi from nio_edosen");
      list($logo) = mysqli_fetch_array($query);
      if(!empty($logo)){
          echo '<link rel="icon" href="./themes/images/logo/'.$logo.'" type="image/x-icon">';
      } else {
          echo '<link rel="icon" href="./themes/images/logo/niozone-app.png" type="image/x-icon">';
      }
     ?>
     <!-- ALERT CUSTOM -->
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/sweetalert2.min.css">
    
    <!-- ALERT CUSTOM -->
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
    <div class="app-content container center-layout">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-12 box-shadow-3 p-0  bg-white  border-lighten-3 ">						
            <div class="card border-grey px-1 py-1 m-0">
                <div class="card-header border-0">
					 <?php //JIKA USER IDAK TERDAFAR
						if(isset($_SESSION['errLog'])){
						$errLog = $_SESSION['errLog'];
						  echo'<div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								'.$errLog.'
							   </div>';unset($_SESSION['errLog']);
						}//JIKA AKSES TIDAK DIBOLEHKAN 
						if(isset($_SESSION['err'])){
						$err = $_SESSION['err'];
						  echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								'.$err.'
							   </div>'; unset($_SESSION['err']);
						}
						if(isset($_SESSION['kosong'])){
						$kosong = $_SESSION['kosong'];
						  echo'<div class="alert alert-icon-left alert-warning alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								'.$kosong.'
							   </div>'; unset($_SESSION['kosong']);
						}?>
                         <?php
                             $query = mysqli_query($config, "SELECT logo,institusi from nio_edosen");
                               //list($logo) = mysqli_fetch_array($query);
                                list($logo,$institusi) = mysqli_fetch_array($query);
                                //echo($institusi);
                            if(!empty($logo)){
                               // echo '<link rel="icon" href="./themes/images/logo/'.$logo.'" type="image/x-icon">';
                echo '<div class="card-title text-center"><img src="./themes/images/logo/'.$logo.'" class="rounded" width="120px" height="100   px"></div>';
                echo '<p class="line-on-side text-muted text-center pt-1"><span><b>'.$institusi.'</b> </span></p>';
                            } else {
                                echo '<link rel="icon" href="./themes/images/logo/niozone-app.png" type="image/x-icon">';
                            }
                        ?>
                        
                </div>
                <div class="card-content">
				<div class="card-body">
				  
					<?php
                        if(isset($_REQUEST['submit'])){
                        	$pass_baru = $_REQUEST['password_baru'];
                        	$pass_baru2 = $_REQUEST['password_baru2'];
                            $kd_akun = $_REQUEST['kd_akun'];
                            if($pass_baru == $pass_baru2){
	                            $query = mysqli_query($config, "SELECT * FROM nio_user WHERE kd_akun='$kd_akun'");
	                            if(mysqli_num_rows($query) > 0){
	                            	$_SESSION['succAdd'] = 'SUKSES! SISWA BARU BERHASIL DITAMBAHKAN';
	                            	$query = mysqli_query($config, "UPDATE nio_user SET password=md5($pass_baru2) WHERE kd_akun='$kd_akun'");
	                            	header("Location: reset_pass.php");
	                            }else{
	                            	$_SESSION['errLog'] = '<b>GAGAL RESET PASSWORD</b><br/>Kode Akun Anda Salah';
	                            	header("Location: reset_pass.php");
	                            }
                            }else{
                            	$_SESSION['errLog'] = '<b>PASSWORD YANG ANDA ULANGI SALAH</b><br/>';
	                            	header("Location: reset_pass.php");
                            }

                        } else {
                    ?>
					
                    <form class="form-horizontal" method="POST" action="">                     
					 <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" name="kd_akun" class="form-control" id="user-name" placeholder="MASUKKAN KODE AKUN">
                        <div class="form-control-position"><i class="ft-users"></i></div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" name="password_baru" class="form-control" id="user-password" placeholder="PASSWORD BARU">
                        <div class="form-control-position"><i class="ft-unlock"></i></div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" name="password_baru2" class="form-control" id="user-password" placeholder="ULANGI PASSWORD BARU">
                        <div class="form-control-position"><i class="ft-unlock"></i></div>
                      </fieldset>			
                      <button type="submit" name="submit" class="btn btn-primary btn-block" id="position-bottom-full"><b><i class="ft-unlock f18"></i>RESET PASSWORD</b></button><hr>
                      
                      </div>
                    </form>

					<?php } ?>
                  </div>
                  <?php
				  echo '<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Copyright@'.$institusi.'</span></p>	'; ?>
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>

	
	
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
    <!-- ALERT CUSTOM -->
    <script src="themes/sweetalert/js/jquery.min.js"></script> 
    <script src="themes/sweetalert/js/sweetalert2.min.js"></script> 
    <script src="themes/sweetalert/js/bootstrap.min.js"></script>
	
    <noscript>
        <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
    </noscript>

    <!-- END PAGE LEVEL JS-->
  </body>

<!-- Mirrored from pixinvent.com/stack-responsive-bootstrap-4-admin-template/html/ltr/horizontal-menu-template/login-with-bg-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 May 2018 01:28:38 GMT -->
</html>