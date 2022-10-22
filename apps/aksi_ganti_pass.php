<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "estudy_v5";
$config = mysqli_connect($host, $username, $password, $database);

$nidn = $_POST['nidn'];
$password_lama = $_POST['pass_lama'];
$pass_baru = $_POST['pass_baru'];
$pass_baru2 = $_POST['pass_baru2'];



$cek_pass=mysqli_query($config, "SELECT password from nio_user where username='$nidn' and password=MD5('$password_lama')");
$hasil = mysqli_num_rows($cek_pass);

if ($hasil >= 1) {
	//echo "sukses";
	$query_nilai = mysqli_query($config, "UPDATE nio_user SET password=MD5('$pass_baru') where username='$nidn'");
	//die($query_nilai);
$data = array(
			'error' => false
			);
			echo json_encode($data);
}else{
	$data = array(
			'error' => true
			);
			echo json_encode($data);
}




?>