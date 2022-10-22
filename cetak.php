<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i' rel='stylesheet'>
</head>
<?php
ob_start();
session_start();
require_once('include/config.php');
if(empty($_SESSION['level'])){
  $_SESSION['err'] = '<b>Sign-in</b> please';
  header("Location: ./");
  die();
} else {

	require_once('include/tanggal.php');
	if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){ 
	  $act = $_REQUEST['act'];
	  switch ($act) {
		case 'unduh':
			require_once"cetak/lap.unduh.php";
		break;			
		case 'mhsperkelas':
			require_once"cetak/lap.mahasiswa.php";
		break;		
		case 'tugas':
			require_once"cetak/lap.tugas.php";
		break;	
		case 'bimbol':
			require_once"cetak/lap.bimbol.php";
		break;
		
		
	  }
	
	
	
	}else{
	
	  $act = $_REQUEST['act'];
	  switch ($act) {
	  
		case 'bimbol':
			require_once"cetak/lap.bimbol.php";
		break;
	  }
	
	}
}
?>
</html>