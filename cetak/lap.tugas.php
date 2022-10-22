<?php
require('fpdf.php');

class PDF extends FPDF {
	// Page header
	function Header() { 
		$this->Image('http://localhost/estudy/estudy_v5/cetak/logo.png',12,3,30);
		$this->SetTitle('LAPORAN PENGIRIMAN TUGAS SISWA');
	}
	// Page footer
	function Footer() {
		// Posisi 15 cm dari bawah
		$this->SetY(-15);    
		// Arial italic 8
		$this->SetFont('Helvetica','I',8);    
		// Page number
		$this->Cell(0,10,'http://ebelajar.com :  '.$this->PageNo().' of {nb}',0,0,'C');
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
$pdf->Cell(195,7,'LAPORAN PENGIRIMAN TUGAS SISWA',0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,2,$row['alamat'],0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,7,'http://ebelajar.com ',0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,2,'whatsApp : +62813 6565 5692',0,1,'C');
$pdf->Cell(190,4,'',0,1,'C');
$pdf->MultiCell(190,1,'','B',1,'L');
$pdf->Cell(190,1,'','B',0,'L');
}


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(190,5,'',0,1,'C');

$diks = mysqli_real_escape_string($config, $_REQUEST['idt']);
$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_tugas,nio_user WHERE nio_kelas.id_kel=nio_tugas.id_kel AND nio_user.username=nio_tugas.username AND nio_tugas.idt='$diks'");
if(mysqli_num_rows($query) > 0){
while($row = mysqli_fetch_array($query)){

$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(24,6,'Kelas',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',11); $pdf->Cell(1,6,$row['kelas'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(24,6,'Guru',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','B',11); $pdf->Cell(1,6,$row['nama'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
$pdf->SetFont('Helvetica','B',11); $pdf->Cell(24,6,'Tentang',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',11); $pdf->Cell(28,6,$row['jenis'],0,0);
$pdf->Cell(190,5,'',0,1,'C');
$pdf->SetFont('Helvetica','B',15); $pdf->Cell(23,6,'',0,0); $pdf->Cell(4,6,'',0,0);
$pdf->SetFont('Helvetica','B',10); $pdf->Cell(10,6,'Open',0,0); $pdf->Cell(2,6,':',0,0);
$pdf->SetFont('Helvetica','',10); $pdf->Cell(30,6,tgl_indo($row['date']),0,0);
$pdf->SetFont('Helvetica','B',10); $pdf->Cell(10,6,'Close',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',10); $pdf->Cell(1,6,tgl_indo($row['dateline']),0,0);

}}else{
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,2,'',0,1,'C');
$pdf->Cell(70,7,'MAAF ... !! MODULE URL ANDA SALAH',0,1,'C');
}






$pdf->Cell(190,20,'',0,1,'C');
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(29,6,'NIM',0,0);
$pdf->Cell(88,6,'NAMA LENGKAP',0,0);
$pdf->Cell(50,6,'NILAI',0,0);
$pdf->Cell(20,6,'STATUS',0,1);


$pdf->Cell(190,2,'','B',10,'L');
$pdf->SetFont('Helvetica','',12);
$cekidt = mysqli_real_escape_string($config, $_REQUEST['idt']);
$unduh = mysqli_query($config, "SELECT * FROM nio_uptugas,nio_user WHERE nio_uptugas.username=nio_user.username AND nio_uptugas.idt='$cekidt' ORDER BY nio_user.nama ASC");

if(mysqli_num_rows($unduh) > 0){
while ($row = mysqli_fetch_array($unduh)){
    $pdf->Cell(20,2,'',0,1);
    $pdf->Cell(29,6,$row['username'],0,0);
    $pdf->Cell(88,6,$row['nama'],0,0);
	$pdf->SetFont('Helvetica','',12);
	 $pdf->SetFont('Helvetica','B',12);
    $pdf->Cell(52,6,$row['nilai'],0,'C'); 
	 $pdf->SetFont('Helvetica','',12);
		if ($row['act']=='X'){
		 $pdf->Cell(20,6,'Tolak',0,1);
		}elseif ($row['act']=='C'){
		 $pdf->Cell(20,6,'Kosong',0,1);
		}else{
		 $pdf->Cell(20,6,'Terima',0,1);
		 $pdf->SetFont('Helvetica','',12);
		}
    
}
}else{
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,2,'',0,1,'C');
$pdf->Cell(90,7,'DAFTAR SISWA PER KELAS ANDA KOSONG !!',0,1,'C');
}
$pdf->Output();
?>