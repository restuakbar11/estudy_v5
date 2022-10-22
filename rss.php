<?php
// PDO connect *********
function connect() {
return new PDO('mysql:host=localhost;edosen', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();

// posts *******************************
$sql = 'SELECT * FROM nio_modul ORDER BY idm DESC limit 0, 6';
$query = $pdo->prepare($sql);
$query->connect();
$rs_post = $query->fetchAll();

// The XML structure
$data .= '<?xml version="1.0" encoding="UTF-8"?>';
$data .= '<rss version="2.0">';
$data .= '<channel>';
$data .= '<title>www.ebelajar.com</title>';
$data .= '<link>http://www.ebelajar.com</link>';
$data .= '<description>Just RSS FEED from my article</description>';
$data .= '<managingEditor>ebelajar@gmail.com</managingEditor>';
$data .= '<image>';
$data .= '<title>MEW RSS FEED 2.0</title>';
$data .= '<link>http://ebelajar.com</link>';
$data .= '<url>http://m.erllang.ga/logo1.png</url>';
$data .= '</image>';
foreach ($rs_post as $row) {
$data .= '<item>';
$data .= '<title>'.$row['isi'].'</title>';
$data .= '<link>'.$row['file'].'</link>';
$data .= '<description>'.$row['unduh'].'</description>';
$data .= '</item>';
}
$data .= '</channel>';
$data .= '</rss> ';

header('Content-Type: application/xml');
echo $data;
?>