<body bgcolor="#99CC33">
<?php
 include "../include/config.php";
session_start();
$nidn = $_SESSION['username'];
?>
<?php
       if(isset($_POST['submit'])){
			$pilihan=$_POST["pilihan"];
			$id_soal=$_POST["id_soal"];
			$jumlah=$_POST['jumlah'];
			$idmapel = $_POST['id_mapel'];
			$kd_mapel = $_POST['kd_soal'];
			$soal_essay = $_POST['soal'];
			$semester = $_POST['semester'];
			echo "<script>alert('$kd_mapel')</script>";
		//	echo "<script>alert('$idmapel')</script>";
			$score=0;
			$benar=0;
			$salah=0;
			$kosong=0;
			for ($i=0;$i<$jumlah;$i++){
				//id nomor soal
				$nomor=$id_soal[$i];

								
				
				
				//jika user tidak memilih jawaban
				if (empty($pilihan[$nomor])){
					$kosong++;
				}else{
					//jawaban dari user
					$jawaban=$pilihan[$nomor];
					$soal=$soal_essay[$nomor];
					//echo "<script>alert('$nomor')</script>";
					//echo "<script>alert('$jawaban')</script>";
					
					$data_jumlah_soal = mysqli_query($config, "SELECT * FROM m_soal_essay WHERE id_soal='$kd_mapel'");
                    $jum_soal=mysqli_num_rows($data_jumlah_soal);
					
					//cocokan jawaban user dengan jawaban di database
					//$data=mysqli_query("SELECT * FROM M_SOAL WHERE  id='$nomor'  and jawaban='$jawaban'");
					//$cek=mysqli_num_rows($data);

					$data = mysqli_query($config, "SELECT * FROM M_SOAL_essay WHERE id='$nomor'  and jawaban='$jawaban'");
                    $cek=mysqli_num_rows($data);					
					

					
					if($cek){
						//jika jawaban cocok (benar)
						$benar++;
					}else{
						//jika salah
						$salah++;
					}

					$sql_cek = mysqli_query($config, "SELECT * FROM m_jawaban_essay WHERE kode_soal='$kd_mapel'  and nidn='$nidn' and id_soal='$nomor'");
					$cek_jwb=mysqli_num_rows($sql_cek);

					if($cek_jwb==NULL){
						$data2 = mysqli_query($config,"INSERT INTO m_jawaban_essay (id_murid,id_mapel,nidn,soal,jawaban,tgl_jawab,id_soal,nilai,kode_soal,semester) Values ('$nidn','$idmapel','$nidn','$soal','$jawaban',CURDATE() ,'$nomor','','$kd_mapel','$semester')");
					}else{
						echo "<script>alert('Anda Sudah Menjawab Soal Ini')</script>
						 <a href='../admin.php?page=hasil_essay'>MENU</a>	";		
					}


					
				} 
			}
			header("location:../index.php");
			
		}
		//Lakukan Pengecekan  Data  dalam Database
		//echo "<script>alert('$benar')</script>";

	  
		
		//Menampilkan Hasil Ujian Kompetensi
		
		?>
		
</body>