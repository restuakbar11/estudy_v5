<body bgcolor="#99CC33">
<?php
 include "../include/config.php";
session_start();
$nidn = $_SESSION['username'];
?>
<?php
       if(isset($_POST['submit'])){
			$pilihan=$_POST["pilihan"];
			$id=$_POST["id"];
			$jumlah=$_POST['jumlah'];
			$idmapel = $_POST['id_mapel'];
			$kd_mapel = $_POST['kd_soal'];
			$id_soal = $_POST['id_soal'];
		//	echo "<script>alert('$jumlah')</script>";
		//	echo "<script>alert('$idmapel')</script>";
			$score=0;
			$benar=0;
			$salah=0;
			$kosong=0;
			for ($i=0;$i<$jumlah;$i++){
				//id nomor soal
				$nomor=$id[$i];
				//id soal yang dibuat guru
				$nomor_id=$id_soal[$i];
				//$nilai=$pilihan[$i];
				$jawaban=$pilihan[$nomor];
				//$jawaban_benar=$jwb_benar[$nomor];
				$ambil_jawaban = mysqli_query($config, "SELECT jawaban from m_soal_essay where id='$nomor_id'");
				$ambil_dulu=mysqli_fetch_array($ambil_jawaban);
				$jwb_benar=$ambil_dulu['jawaban'];
								
				
					$data2 = mysqli_query($config,"UPDATE m_jawaban_essay SET nilai='$jawaban', jawaban_benar='$jwb_benar'
						where id=$nomor AND kode_soal='$kd_mapel'");
				// echo "<script>alert('$data2')</script>";
				//jika user tidak memilih jawaban
				
			}
			// header("location:../index.php");
			
		}
		header("Location: ../admin.php?page=hasil_essay");
		//Lakukan Pengecekan  Data  dalam Database

	  
		
		//Menampilkan Hasil Ujian Kompetensi
		
		?>
		
</body>