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
//$kelompok = $_POST['kelompok'];
$soal = $_POST['soal'];
$soal = $_POST['soal'];
$jwb_a = $_POST['jwb_a'];
$jwb_b = $_POST['jwb_b'];
$jwb_c = $_POST['jwb_c'];
$jwb_d = $_POST['jwb_d'];
$jwb_e = $_POST['jwb_e'];
$jawaban = $_POST['jawaban'];
$tgl_input = date('Y-m-d H:i:s');

$query=mysqli_query($config, "INSERT into m_soal (id_guru,id_mapel,bobot,gambar,soal,opsi_a,opsi_b,opsi_c,opsi_d,opsi_e,jawaban,tgl_input,id_soal,kelompok,semester)
	values
	('$id_guru','$mapel','$bobot','','$soal','$jwb_a','$jwb_b','$jwb_c','$jwb_d','$jwb_e','$jawaban','$tgl_input','$kd_soal',$jenis_mapel,$semester)");

$data = array(
			'error' => false
			);
			echo json_encode($data);

?>