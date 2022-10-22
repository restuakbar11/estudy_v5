<?php
require('fpdf.php');

class PDF extends FPDF {
	// Page header
	function Header() { 
		$this->Image('http://localhost/estudy/estudy_v5/cetak/logo.png',12,3,30);
		$this->SetTitle('LAPORAN UNDUHAN COURSE MODULE');
	}
	// Page footer
	function Footer() {
		// Posisi 15 cm dari bawah
		$this->SetY(-15);    
		// Arial italic 8
		$this->SetFont('Helvetica','I',8);    
		// Page number
		$this->Cell(0,13,'http://ebelajar.com :  '.$this->PageNo().' of {nb}',0,0,'C');
	}
}

//Membuat file PDF
$pdf = new PDF();
//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
//Mencetak kalimat dengan perulangan
$query2 = mysqli_query($config, "SELECT institusi,alamat,prov,url,email,telp,logo FROM nio_edosen");
while ($row = mysqli_fetch_array($query2)){
$pdf->SetFont('Helvetica','B',19);
$pdf->Cell(195,7,$row['institusi'],0,1,'C');
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(195,7,'LAPORAN KEHADIRAN PELAJARAN SISWA',0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,2,$row['alamat'],0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,7,'http://ebelajar.com ',0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,2,'whatsApp : +62813 2639 9136',0,1,'C');
$pdf->Cell(190,4,'',0,1,'C');
$pdf->MultiCell(190,1,'','B',1,'L');
$pdf->Cell(190,1,'','B',0,'L');
}


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(190,5,'',0,1,'C');

$idmodul = mysqli_real_escape_string($config, $_REQUEST['idm']);
$query = mysqli_query($config, "SELECT * FROM  nio_modul,nio_kelas,nio_mkl,nio_jurusan,nio_user WHERE nio_user.username=nio_modul.username AND nio_modul.id_kel=nio_kelas.id_kel AND nio_modul.idmk=nio_mkl.idmk AND nio_jurusan.idj=nio_kelas.idj AND idm='$idmodul'");
if(mysqli_num_rows($query) > 0){
while($row = mysqli_fetch_array($query)){

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(24,6,'Kelas',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',10); $pdf->Cell(1,6,$row['kelas'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(24,6,'Jurusan',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',10); $pdf->Cell(1,6,$row['jurusan'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(24,6,'Matakuliah',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',10); $pdf->Cell(1,6,$row['mkl'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(24,6,'E-Courses ',0,0);  $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','B',10); $pdf->Cell(1,6,$row['pertemuan'],0,0);

}}else{
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,2,'',0,1,'C');
$pdf->Cell(80,7,'403 - DATA PELAJARAN TIDAK DITEMUKAN',0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,8,'',0,1,'C');
$pdf->Cell(95,7,'http://ebelajar.com',0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,2,'',0,1,'C');
$pdf->Cell(51,1,'WhatsApp : +62813 2639 9136',0,1,'C');
}





$pdf->Cell(190,15,'',0,1,'C');
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(29,6,'NIM',0,0);
$pdf->Cell(95,6,'NAMA LENGKAP',0,0);
$pdf->Cell(37,6,'TGL HADIR',0,0);
$pdf->Cell(24,6,'STATUS',0,1);
$pdf->Cell(190,2,'','B',1,'L');
$pdf->Cell(190,2,'',0,1,'C');
$pdf->SetFont('Helvetica','',11);


$idmodul = mysqli_real_escape_string($config, $_REQUEST['idm']);
$unduh = mysqli_query($config, "SELECT * FROM nio_modul,nio_unduh,nio_user WHERE nio_unduh.username=nio_user.username AND  nio_unduh.idm=nio_modul.idm AND nio_modul.idm='$idmodul' order by nio_unduh.username ASC");

if(mysqli_num_rows($unduh) > 0){
while ($row = mysqli_fetch_array($unduh)){

    $pdf->Cell(29,6,$row['username'],0,0);
    $pdf->Cell(95,6,$row['nama'],0,0);
    $pdf->Cell(39,6,tgl_indo($row['tgl_unduh']),0,0); 
    $pdf->Cell(24,6,'Hadir',0,1);
	$pdf->Cell(190,2,'',0,1,'C');
}
}else{
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,8,'',0,1,'C');
$pdf->Cell(112,12,'DATA PELAJARAN MASIH KOSONG / BELUM DILAKSANAKAN',0,1,'C');
}
$pdf->Output();
?>