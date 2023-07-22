<?php
   require_once("../config.php");

$CallDB = $conn->query("SELECT * FROM mutasi_bca WHERE bank = 'BCA'");

if (mysqli_num_rows($CallDB) == 0) {
	die("Data Mutasi BCA Tidak Ditemukan.");
} else {
	while($ThisData = $CallDB->fetch_assoc()) {
		$Provider = $ThisData['bank'];
		if ($conn->query("DELETE FROM mutasi_bca WHERE bank = '$Provider'") == true) {
			echo "Data Mutasi BCA Berhasil Di Hapus.<br />";
    	} else {
			echo "Gagal Menampilkan Data Mutasi BCA.<br />";
		}
	}
}
?>