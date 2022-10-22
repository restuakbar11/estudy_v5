function simpan_soal(){
	semester = document.getElementById('semester').value;
	kd_soal = document.getElementById('kd_soal').value;
	id_guru = document.getElementById('nidn').value;
	mapel = document.getElementById('mapel').value;
	bobot = document.getElementById('bobot').value;
	jenis_mapel = document.getElementById('jenis_mapel').value;
	soal = document.getElementById('soal').value;
	jwb_a = document.getElementById('jwb_a').value;
	jwb_b = document.getElementById('jwb_b').value;
	jwb_c = document.getElementById('jwb_c').value;
	jwb_d = document.getElementById('jwb_d').value;
	jwb_e = document.getElementById('jwb_e').value;
	jawaban = document.getElementById('jawaban').value;
	$.ajax({
			type:'POST',
			data:({semester:semester,kd_soal:kd_soal,id_guru:id_guru,mapel:mapel,bobot:bobot,jenis_mapel:jenis_mapel,soal:soal,jwb_a:jwb_a,jwb_b:jwb_b,jwb_c:jwb_c,
				jwb_d:jwb_d,jwb_e:jwb_e,jawaban:jawaban,}),
			url : "apps/aksi_soal_ujian.php", 
			dataType:'json',
			success:function(data){
				if(data.error == false){
					swal({
					  title: 'Tersimpan..!!',
					  text: "Akan Menutup Dalam 2 Detik!!!",
					  confirmButtonColor: "#80C8FE",
					  type: "success",
					  timer: 3500,
					  confirmButtonText: "Ya",
					  showConfirmButton: true
					});
				}else{
					swal({
					  title: 'GAGAL SIMPAN..!!',
					  text: "Akan Menutup Dalam 2 Detik!!!",
					  confirmButtonColor: "#80C8FE",
					  type: "success",
					  timer: 3500,
					  confirmButtonText: "Ya",
					  showConfirmButton: true
					});
				}

				
			}
		});
	alert('sabar');
}

function simpan_jawaban(){
	alert('ok');	
	id_mapel = document.getElementById('id_mapel').value;
	alert(id_mapel);
	nidn = document.getElementById('nidn').value;
	alert(nidn);
	soal = document.getElementById('soal').value;
	alert(soal);
	jawaban = "<?php echo $row['id'] ?>";
	alert(jawaban);
	id_soal= document.getElementById('id_soal').value;
	alert(id_soal);
	kunci_jwb= document.getElementById('kunci_jwb').value;
	alert(kunci_jwb);

}

function simpan_essay(){
	semester = document.getElementById('semester').value;
	kd_soal = document.getElementById('kd_soal').value;
	id_guru = document.getElementById('nidn').value;
	mapel = document.getElementById('mapel').value;
	bobot = document.getElementById('bobot').value;
	jenis_mapel = document.getElementById('jenis_mapel').value;
	soal = document.getElementById('soal').value;
	jawaban = document.getElementById('jawaban').value;

		$.ajax({
			type:'POST',
			data:({semester:semester,kd_soal:kd_soal,id_guru:id_guru,mapel:mapel,bobot:bobot,jenis_mapel:jenis_mapel,soal:soal,jawaban:jawaban,}),
			url : "apps/aksi_soal_essay.php", 
			dataType:'json',
			success:function(data){
				if(data.error == false){
					swal({
					  title: 'Tersimpan..!!',
					  text: "Akan Menutup Dalam 2 Detik!!!",
					  confirmButtonColor: "#80C8FE",
					  type: "success",
					  timer: 3500,
					  confirmButtonText: "Ya",
					  showConfirmButton: true
					});
					//alert('sip');
				}else{
					swal({
					  title: 'GAGAL SIMPAN..!!',
					  text: "Akan Menutup Dalam 2 Detik!!!",
					  confirmButtonColor: "#80C8FE",
					  type: "success",
					  timer: 3500,
					  confirmButtonText: "Ya",
					  showConfirmButton: true
					});
					//alert('mantap');
				}

				
			}
		});
		alert('sabar');
}