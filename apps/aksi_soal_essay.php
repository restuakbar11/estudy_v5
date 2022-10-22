<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "estudy_v5";
$config = mysqli_connect($host, $username, $password, $database);

$semester = $_POST['semester'];
$kd_soal = $_POST['kd_soal'];
$id_guru = $_POST['id_guru'];
$mapel = $_POST['mapel'];
$bobot = $_POST['bobot'];
$jenis_mapel = $_POST['jenis_mapel'];
$soal = $_POST['soal'];
$jawaban = $_POST['jawaban'];
$tgl_input = date('Y-m-d H:i:s');

$query=mysqli_query($config, "INSERT into m_soal_essay (id_guru,id_mapel,bobot,soal,jawaban,tgl_input,id_soal,kelompok,semester)
	values
	('$id_guru','$mapel','$bobot','$soal','$jawaban','$tgl_input','$kd_soal',$jenis_mapel,$semester)");

$data = array(
			'error' => false
			);
			echo json_encode($data);

?>