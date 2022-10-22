

     <footer class="footer footer-dark navbar-shadow">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout"><span class="float-md-left d-block d-md-inline-block white">Copyright  &copy;ebelajar <a class="text-bold-800 white" href="http://ebelajar.com" target="_blank" data-toggle="tooltip" data-original-title="ebelajar"></a> </p>
    </footer>

	
	<!--
	<div class="customizer border-left-blue-grey border-left-lighten-4 p-1 show"><a class="customizer-close" href="#"><b><i class="ft-x f22 danger"></i></b></a>
	<a class="customizer-toggle bg-secondary" href="#"><i class="ft-user f24 mt-1 fa white"></i></a>
	<div class="customizer-content p-1">
	<h4 class="pepe mb-0">My Account</h4>
	<hr>
	<div class="media">
		<?php
			$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$_SESSION[username]'");
			while($row = mysqli_fetch_array($query)){
				echo"<div class='media-left pr-1'>";
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='media-object brpe img-xl'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='media-object img-xl border' style='height:32px;'>"; }

				if($_SESSION['level'] == 'A'){
				
				}
				else if($_SESSION['level'] == 'D'){}
				else{}
				echo"</div>
				<div class='media-body'><h4><b>$row[nama]</b></h4>
					<a href='$row[fb]' class='badge badge-pill badge-primary f12'><i class='ft-facebook'></i> Facebook</a>
					<a href='$row[ig]' class='badge badge-pill badge-danger f12'><i class='ft-instagram'></i> Instagram</a>
					<a href='?page=on&usr=$row[username]' class='badge badge-pill badge-dark f12'><i class='ft-user-check'></i> My Profile</a>
				</div>
				";
			
		?>
		</div>
		<hr/>
	
	<h3 class="mt-1 text-bold-500 mb-2">Account Information</h3>
	  <p>
		<i class='icon icon-graduation f16 danger mr-1'></i> <?php echo $row['kampus'];?><hr/>
		<i class='ft-mail f16 danger mr-1'></i> <?php echo $row['email'];?><hr/>
		<i class='ft-cloud f16 danger mr-1'></i> <?php echo $row['blog'];?><hr/>
		<i class='fa fa-whatsapp f16 danger mr-1'></i> +62 <?php echo $row['wa'];?><hr/>
	  </p>
	 <hr/>
	<span class="badge badge-pill badge-secondary f14 text-center"><div id="sessiontime"></div></span>
	 
	<?php } ?>
	</div>
    </div>
	-->
	
	
	
	
	
	
	
	
    <!-- BEGIN VENDOR JS-->
	
	  <script type="text/javascript" src="themes/ckeditor/ckeditor.js"></script>
    <script src="themes/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="themes/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript" src="themes/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="themes/vendors/js/extensions/jquery.knob.min.js" type="text/javascript"></script>
    <script src="themes/js/scripts/extensions/knob.min.js" type="text/javascript"></script>
	
    <script src="themes/data/jvector/visitor-data.js" type="text/javascript"></script>
	
    <script src="themes/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="themes/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="themes/fonts/simple-line-icons/style.min.css">
	
    <script src="themes/vendors/js/forms/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="themes/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="themes/js/scripts/tables/datatables/datatable-basic.min.js" type="text/javascript"></script>
  <script src="themes/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
  <script src="themes/js/scripts/forms/checkbox-radio.min.js" type="text/javascript"></script>
  
    <script src="themes/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
    <script src="themes/js/scripts/extensions/toastr.min.js" type="text/javascript"></script>
  
    <script src="themes/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="themes/js/core/app.min.js" type="text/javascript"></script>
    <script src="themes/js/scripts/customizer.min.js" type="text/javascript"></script>
    <script src="themes/js/scripts/popover/popover.min.js" type="text/javascript"></script>
    <!-- END STACK JS-->
	
    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="themes/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
    <script src="themes/js/scripts/pages/dashboard-analytics.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="themes/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="themes/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>
    <script src="themes/vendors/js/charts/jvector/jquery-jvectormap-de-merc.js" type="text/javascript"></script>
    <script src="themes/vendors/js/charts/jvector/jquery-jvectormap-us-lcc.js" type="text/javascript"></script>
    <script src="themes/vendors/js/charts/jvector/jquery-jvectormap-us-aea.js" type="text/javascript"></script>
	
    <script type="text/javascript" src="themes/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
    <script src="themes/js/scripts/charts/jvector/jvector.min.js" type="text/javascript"></script>
    <script src="themes/data/jvector/gdp-data.js" type="text/javascript"></script>
	
	
    <script type="text/javascript" src="themes/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
    <script src="themes/js/scripts/forms/wizard-steps.min.js" type="text/javascript"></script>