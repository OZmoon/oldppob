<?php
require("../config.php");

if(isset($_POST['swit']) && $_POST['swit'] == 'reqnmr'){
	$nomor = $conn->real_escape_string(trim(filter($_POST['nomor'])));
	$type  = $conn->real_escape_string(trim(filter($_POST['tipe'])));
	if($type == 'E-Money' OR $type == 'Games'){
		$operator = $conn->real_escape_string(trim(filter($_POST['opr'])));
		$layanan_pulsa = $conn->query("SELECT * FROM layanan_pulsa WHERE tipe ='$type' AND operator = '$operator' AND status = 'Normal' ORDER BY harga ASC");
	}else if($type == 'PLN'){
		$operator = $getOperator->getSearchNumber($nomor);
		$layanan_pulsa = $conn->query("SELECT * FROM layanan_pulsa WHERE tipe ='$type' AND status = 'Normal' ORDER BY harga ASC");
	}else if($type == 'WIFI ID' OR $type == 'GOOGLE PLAY INDONESIA'){
		$operator = $getOperator->getSearchNumber($nomor);
		$layanan_pulsa = $conn->query("SELECT * FROM layanan_pulsa WHERE operator ='$type' AND status = 'Normal' ORDER BY harga ASC");
	}else{
		$operator = $getOperator->getSearchNumber($nomor);
		$layanan_pulsa = $conn->query("SELECT * FROM layanan_pulsa WHERE operator = '$operator' AND tipe ='$type' AND status = 'Normal' ORDER BY harga ASC");	
	}

	
	

	$aray_layanan = array();
	while ($layanan = $layanan_pulsa->fetch_assoc()) {
		array_push($aray_layanan,$layanan);
	}
	echo json_encode($aray_layanan);

}

if(isset($_POST['swit']) && $_POST['swit'] == 'reqOpr'){
	$post_tipe = $conn->real_escape_string($_POST['tipe']);
	$kode	   = $conn->real_escape_string($_POST['kode']);
	$cek_layanan = $conn->query("SELECT * FROM kategori_layanan WHERE server = '$post_tipe' And kode = '$kode'");
	$kd = '';
	while ($row = $cek_layanan->fetch_assoc()) {
		$kd = $row['id'];
	}
	echo $kd;
}

if(isset($_POST['swit']) && $_POST['swit'] == 'reqktg'){
	$type = "E-Money";
	$layanan_pulsa = $conn->query("SELECT * FROM kategori_layanan WHERE server ='$type' ORDER BY id ASC");
    // jumlah item e-wallt harus sama dengan julah item pada paket json (base_url/josn/jasonOpetor.json)
    // Pastikan nama pada paket json sama dengan nama yang di tulis di database.
    $data = '';
    $path_local =  $settingURL."assets/media/logos/logo_E-wallets.png";
	while ($layanan = $layanan_pulsa->fetch_assoc()) {
		$path  = ((empty($getOperator->getImgLogo($type)[$layanan['kode']][0]))?$path_local:$getOperator->getImgLogo($type)[$layanan['kode']][0]);
		?>
		<div class="col-3 katekogori" >
		<img src="<?=$path?>" style="width: 100%; height: 53px;">
		<div class="bgSh" data-id="<?=$layanan['kode']?>" style="opacity: 0"></div>
		<div class="text-center" style="font-size: 10px;"><?=$layanan['nama']?></div>
		</div>
		<?php }
		 
	}

if(isset($_POST['swit']) && $_POST['swit'] == 'reqktgame'){
	$type = "Games";
	$layanan_pulsa = $conn->query("SELECT * FROM kategori_layanan WHERE server ='$type' ORDER BY id ASC");
    // jumlah item e-wallt harus sama dengan julah item pada paket json (base_url/josn/jasonOpetor.json)
    // Pastikan nama pada paket json sama dengan nama yang di tulis di database.
    $data = '';
    $path_local =  $settingURL."assets/media/logos/games.png";
	while ($layanan = $layanan_pulsa->fetch_assoc()) {
		$path  = ((empty($getOperator->getImgLogo($type)[$layanan['kode']][0]))?$path_local:$getOperator->getImgLogo($type)[$layanan['kode']][0]);
		?>
		<div class="col-3 katekogori" style="padding: 5px;">
		<img src="<?=$path?>" style="width: 100%; height: 53px;">
		<div class="bgSh" data-id="<?=$layanan['kode']?>" style="opacity: 0"></div>
		<div class="text-center" style="font-size: 10px;"><?=$layanan['nama']?></div>
		</div>
		<?php }
		 
	}
