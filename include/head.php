<?php
    //cek session
    if(!empty($_SESSION['level'])){
	require_once('include/config.php');
	require_once('include/tanggal.php');
	require_once('include/statistik.php');
?>
 
 <head>
<!--
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="themes/js/idle/jquery.idle.js"></script>-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="E-Belajar - Media pembelajaran online siswa.">
  <meta name="keywords" content="elerning,belajaar,siswa,belajar online">
  <meta name="author" content="ebelajar.com">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
	  var url = "logout.php"; 
	  var count = 1800; 
	  function countDown() {
	  if (count > 0) {
	  count--; var waktu = count + 1;
	  $('#sessiontime').html('Logout session <b class="cyan">' + waktu + '</b> detik / 30 Menit');
	  setTimeout("countDown()", 1000);
	  } else {window.location.href = url;}
	  } countDown();
  </script>
  <title>E-Belajar System</title>
	 <?php
	 
	 
      $query = mysqli_query($config, "SELECT logo,institusi from nio_edosen");
      list($logo) = mysqli_fetch_array($query);
      list($institusi) = mysqli_fetch_array($query);
      if(!empty($logo)){
          echo '<link rel="icon" href="./themes/images/logo/'.$logo.'" type="image/x-icon">';
      } else {
          echo '<link rel="icon" href="./themes/images/logo/niozone-app.png" type="image/x-icon">';
      }
	  $result = $config->query("SELECT nama,login,username FROM nio_user WHERE level = 'M' ORDER BY login DESC LIMIT 5");
     ?>
	 
	 <!--
		<script type="text/javascript" src="themes/js/jquery.min.js"></script>
		<script src="themes/js/highcharts.js"></script>
		
		<div class='row'>
		 <div class="col-md-10 d-none d-md-block">
		<div id="pepe" style="min-width: 400px; height: 400px; padding:40px; margin: margin:50px;"></div>
		</div>
        </div>
		
	-->
	<script type="text/javascript">
		//2)script untuk membuat grafik, perhatikan setiap komentar agar paham
		$(function () {
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'pepe', //letakan grafik di div id container
						//Type grafik, anda bisa ganti menjadi area,bar,column dan bar
						type: 'area',  
						marginRight: 50,
						marginBottom: 25
					},
					title: {
						text: '<b>E-Belajar Indonesia</b>',
						x: -20 //center
					},
					subtitle: {
						text: 'Learning Management System',
						x: -20
					},
					xAxis: { //X axis menampilkan data bulan 
						categories: [<?php
		  if($result->num_rows > 0){
			  while($row = $result->fetch_assoc()){
				echo "['".$row['nama']."'],";
			  }
		  }
		  ?>]
					},
					yAxis: {
						title: {  //label yAxis
							text: 'Total penjualan'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080' //warna dari grafik line
						}]
					},
					tooltip: { 
					//fungsi tooltip, ini opsional, kegunaan dari fungsi ini 
					//akan menampikan data di titik tertentu di grafik saat mouseover
						formatter: function() {
								return '<b>'+ this.series.name +'</b><br/>'+
								this.x +': '+ this.y ;
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: 200,
						y: 200,
						borderWidth: 0
					},
					//series adalah data yang akan dibuatkan grafiknya,
				
					series: [{  
						name: 'Active', 
						data: [50, 30,20,60,5]
					}
					
					]
				});
			});
			
		});
		</script>
		
		
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link rel="apple-touch-icon" href="themes/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="themes/images/ico/favicon.ico">
    <link rel="stylesheet" type="text/css" href="themes/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="themes/css/fon.css">
    <link rel="stylesheet" type="text/css" href="themes/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="themes/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/extensions/unslider.css">
	<link rel="stylesheet" type="text/css" href="themes/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="themes/css/pages/project.min.css">
    <link rel="stylesheet" type="text/css" href="themes/css/plugins/extensions/noui-slider.min.css">
    <link rel="stylesheet" type="text/css" href="themes/css/core/colors/palette-noui.css">
    <link rel="stylesheet" type="text/css" href="themes/css/app.min.css">
    <link rel="stylesheet" type="text/css" href="themes/css/core/menu/menu-types/horizontal-menu.min.css">
  <link rel="stylesheet" type="text/css" href="themes/css/pages/login-register.min.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="themes/vendors/css/forms/icheck/icheck.css">
  
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/weather-icons/climacons.min.css">	
    <link rel="stylesheet" type="text/css" href="themes/css/pages/users.min.css">
    <link rel="stylesheet" type="text/css" href="themes/css/pages/timeline.min.css">
	
    <link rel="stylesheet" type="text/css" href="themes/vendors/js/gallery/photo-swipe/photoswipe.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/js/gallery/photo-swipe/default-skin/default-skin.css">
    <link rel="stylesheet" type="text/css" href="themes/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="themes/css/plugins/extensions/toastr.min.css">
  </head>
 
<?php

 //menghitung jumlah Documen
 $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_modul"));
 //menghitung jumlah unduh
 $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_unduh"));
 //menghitung jumlah kelas
 $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_kelas"));
 //menghitung jumlah mahasiswa
 $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_user WHERE level='M'"));
 //menghitung jumlah tugas mahasiswa
 $countgs = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_tugas WHERE act='A' AND id_kel='$_SESSION[kls]'"));
 //TUGAS AKTIV DOSEN
 $tgsact = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_tugas WHERE act='A' AND username='$_SESSION[username]'"));

 
 //info tugas mahasiswa  pada dosen
 $uptu = mysqli_num_rows(mysqli_query($config, "SELECT * FROM nio_uptugas WHERE act='C' AND dosen='$_SESSION[username]'"));
    } else {
        header("Location: ../");
        die();
    }
?>
