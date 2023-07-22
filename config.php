<?php
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

// status
// 1 = Ya
// 0 = Tidak
$maintenance = 0;
if($maintenance == 1) {
	die("<h1>Sistem dalam Perbaikan.<br/>System Under Maintenance.</h1>");
}

// database
$config['db'] = array(
	'host' => 'localhost',
	'name' => 'putrazc', //Ganti dengan nama database anda
	'username' => 'putrazc', //Ganti dengan username database anda
	'password' => 'password' //Ganti dengan password database anda
);

$conn = mysqli_connect($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['name']);
if(!$conn) {
	die("Koneksi Gagal : ".mysqli_connect_error());
}
$config['web'] = array(
'url' => 'https://putrazc.site/' //Ganti dengan domain anda, ex: https://putrazc_site/ (wajib diakhiri garis miring /)
);

// date & time
$date = date("Y-m-d");
$time = date("H:i:s");

// versi
$versi = '1.0.4';

require("library/function.php");
require("library/setting.php");

?>