<?php
$host="localhost";
$kullanici="root";
$parola="";
$veri_tabani="uye";

$baglanti =mysqli_connect($host, $kullanici, $parola, $veri_tabani);
mysqli_set_charset($baglanti, "UTF8");

?>