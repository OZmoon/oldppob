<?php
require_once ("../config.php");
$tipe = $conn->real_escape_string($_POST['tipe']);
$nominal = $conn->real_escape_string($_POST['jumlah']);
$cek_rate = $conn->query("SELECT * FROM metode_depo WHERE id = '$tipe'");
$cek_hasil = $cek_rate->fetch_array();
$menghitung = $nominal * $cek_hasil['rate'];
echo $menghitung;
?>