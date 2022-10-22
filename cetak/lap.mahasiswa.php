<?php
require('fpdf.php');


class PDF extends FPDF {
	// Page header

	function Header() { 
		$this->Image('http://localhost/estudy/estudy_v5/cetak/logo.png',12,3,30);
		$this->SetTitle('DAFTAR ABSENSI SISWA PER KELAS');
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
$pdf->Cell(195,7,'DAFTAR ABSENSI SISWA PER KELAS',0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,2,$row['alamat'],0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,7,'http://smpn8merauke.sch.id ',0,1,'C');
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(195,2,'whatsApp : +62813 2639 9136',0,1,'C');
$pdf->Cell(190,4,'',0,1,'C');
$pdf->MultiCell(190,1,'','B',1,'L');
$pdf->Cell(190,1,'','B',0,'L');
}


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(190,5,'',0,1,'C');

$diks = mysqli_real_escape_string($config, $_REQUEST['id_kel']);
$query = mysqli_query($config, "SELECT * FROM nio_kelas,nio_jurusan WHERE nio_kelas.idj=nio_jurusan.idj AND nio_kelas.id_kel='$diks'");
if(mysqli_num_rows($query) > 0){
while($row = mysqli_fetch_array($query)){

$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(24,6,'Jurusan',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',12); $pdf->Cell(1,6,$row['jurusan'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(24,6,'Kelas',0,0); $pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Helvetica','',12); $pdf->Cell(1,6,$row['kelas'],0,0);
$pdf->Cell(190,7,'',0,1,'C');
//$pdf->SetFont('Helvetica','B',12);
//$pdf->Cell(24,6,'Angkatan',0,0); $pdf->Cell(3,6,':',0,0);
//$pdf->SetFont('Helvetica','',12); $pdf->Cell(1,6,$row['tahun'],0,0);

}}else{
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,2,'',0,1,'C');
$pdf->Cell(70,7,'MAAF ... !! MODULE URL ANDA SALAH',0,1,'C');
}






$pdf->Cell(190,20,'',0,1,'C');
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(29,6,'NIS',0,0);
$pdf->Cell(115,6,'NAMA LENGKAP',0,0);
$pdf->Cell(20,6,'TANDA TANGAN',0,1);


$pdf->Cell(190,2,'','B',10,'C');
$pdf->SetFont('Helvetica','',11);
$idmodul = mysqli_real_escape_string($config, $_REQUEST['id_kel']);
$unduh = mysqli_query($config, "SELECT * FROM nio_user,nio_kelas,nio_jurusan WHERE nio_jurusan.idj=nio_kelas.idj AND nio_user.id_kel=nio_kelas.id_kel AND nio_kelas.id_kel='$idmodul' ORDER BY nio_user.username ASC");

if(mysqli_num_rows($unduh) > 0){
while ($row = mysqli_fetch_array($unduh)){
    $pdf->Cell(20,2,'',0,1);
    $pdf->Cell(29,6,$row['username'],0,0);
    $pdf->Cell(115,6,$row['nama'],0,0);
    $pdf->Cell(20,6,'..........................................',0,1);
}
}else{
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,2,'',0,1,'C');
$pdf->Cell(90,7,'DAFTAR SISWA KELAS INI KOSONG !!',0,1,'C');
}
$pdf->Output();
?>