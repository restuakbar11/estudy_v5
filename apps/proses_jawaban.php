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
			$semester = $_POST['semester'];
		//	echo "<script>alert('$jumlah')</script>";
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
					//echo "<script>alert('$nomor')</script>";
					//echo "<script>alert('$jawaban')</script>";
					
					$data_jumlah_soal = mysqli_query($config, "SELECT * FROM m_soal WHERE id_soal='$kd_mapel'");
                    $jum_soal=mysqli_num_rows($data_jumlah_soal);
					
					//cocokan jawaban user dengan jawaban di database
					//$data=mysqli_query("SELECT * FROM M_SOAL WHERE  id='$nomor'  and jawaban='$jawaban'");
					//$cek=mysqli_num_rows($data);

					$data = mysqli_query($config, "SELECT * FROM M_SOAL WHERE id='$nomor'  and jawaban='$jawaban'");
                    $cek=mysqli_num_rows($data);					
					

					
					if($cek){
						//jika jawaban cocok (benar)
						$benar++;
					}else{
						//jika salah
						$salah++;
					}

					$sql_cek = mysqli_query($config, "SELECT * FROM m_jawaban WHERE kode_soal='$kd_mapel'  and nidn='$nidn' and id_soal='$nomor'");
					$cek_jwb=mysqli_num_rows($sql_cek);

					if($cek_jwb==NULL){
						$data2 = mysqli_query($config,"INSERT INTO m_jawaban (id_murid,id_mapel,nidn,jawaban,tgl_jawab,id_soal,nilai,kode_soal,semester) Values ('$nidn','$idmapel','$nidn','$jawaban',CURDATE() ,'$nomor','','$kd_mapel','$semester')");
					}else{
						echo "<script>alert('Anda Sudah Menjawab Soal Ini')</script>
						 <a href='../admin.php?page=hasil_ujian'>MENU</a>	";		
					}


					
				} 
			}
			$jum_nilai =($benar / $jum_soal) * 100;
			$query_nilai = mysqli_query($config, "UPDATE m_jawaban SET nilai='$jum_nilai'
							WHERE id_mapel='$idmapel'  AND nidn='$nidn' AND kode_soal='$kd_mapel'");


						$username=  ucwords($_SESSION['nama']);
		echo "<h3 style='border:0';>Selamat <u>$username</u> Sudah Selesai Dalam Mengerjakan Tes</h3>";
		 echo "<br><br><br><div align='center'>
		 <table><tr><th colspan=3>Hasil Tes Anda</th></tr>
		  <tr><td><b>Nilai anda            </td><td>: </b></td>";
	  echo "
		 <tr><td>Jumlah Jawaban Benar</td><td> : $benar </td></tr>
		 <tr><td>Jumlah Jawaban Salah</td><td> : $salah</td></tr>
		 <tr><td>Jumlah Jawaban Kosong</td><td>: $kosong</td></tr>
		 <a href='../admin.php?page=hasil_ujian'>MENU</a>
		</table></div>";
		}
		//Lakukan Pengecekan  Data  dalam Database
		//echo "<script>alert('$benar')</script>";

	  
		
		//Menampilkan Hasil Ujian Kompetensi
		
		?>
		
</body>