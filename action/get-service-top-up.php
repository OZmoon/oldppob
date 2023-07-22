<?php
require_once("../config.php");

    $check_provider = $conn->query("SELECT * FROM provider_pulsa WHERE code = 'DG-PULSA'");
    $data_provider = mysqli_fetch_assoc($check_provider);

    $cek_harga_website = $conn->query("SELECT * FROM setting_harga_untung WHERE kategori = 'WEBSITE' AND tipe = 'Top Up'");
    $data_harga_website = mysqli_fetch_assoc($cek_harga_website);

    $cek_harga_api = $conn->query("SELECT * FROM setting_harga_untung WHERE kategori = 'API' AND tipe = 'Top Up'");
    $data_harga_api = mysqli_fetch_assoc($cek_harga_api);

    $p_apiid = $data_provider['api_id'];
    $p_apikey = $data_provider['api_key'];

    $harga_website = $data_harga_website['harga'];
    $harga_api = $data_harga_api['harga'];

    $url = "https://api.digiflazz.com/v1/price-list";
    $sign = md5("$p_apiid+$p_apikey+pricelist");

    $data = array( 
	    'username' => $p_apiid,
	    'sign' => $sign
    );
    $header = array(
    'Content-Type: application/json',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    // echo $response;
    // die;
    $result = json_decode($response);
    // print_r($result);

$indeks=0; 
$i = 1;
// get data service
foreach($result->data as $data) {

$sid = $data->buyer_sku_code;
$category = $data->brand;
$type = $data->category;
$service = $data->product_name;
$description = $data->desc;
$price = $data->price;
$ht_status = $data->buyer_product_status;
$indeks++; 
$i++;
// end get data service 
// setting price 
$price_web = $price + $harga_website; //setting penambahan harga web

$price_api = $price + $harga_api; //setting penambahan harga api
// setting price

		if ($ht_status == true) {
			$status = "Normal";
		} else if ($ht_status == false) {
			$status = "Gangguan";
		}

		//INSERT LAYANAN
		$type2 = strtr($type, array(
			'Paket SMS & Telpon' => 'Paket SMS Telpon',
			'China TOPUP' => 'Pulsa Internasional',
			'Malaysia TOPUP' => 'Pulsa Internasional',
			'Philippines TOPUP' => 'Pulsa Internasional',
			'Singapore TOPUP' => 'Pulsa Internasional',
			'Thailand TOPUP' => 'Pulsa Internasional',
			'Vietnam TOPUP' => 'Pulsa Internasional',
		));

		$check_services = $conn->query("SELECT * FROM layanan_pulsa WHERE service_id = '$sid' AND provider = 'DG-PULSA'");
        $data_services = mysqli_fetch_assoc($check_services);
        if (mysqli_num_rows($check_services) > 0) {
            echo "<br>Layanan Sudah Ada Di Database => $service | $sid \n <br />";
        } else {

		//INSERT KATEGORI
		$cek_kategori = $conn->query("SELECT * FROM kategori_layanan WHERE kode = '$category' AND server = '$type2'");
		if (mysqli_num_rows($cek_kategori) == 0) {
           $input_kategori = $conn->query("INSERT INTO kategori_layanan VALUES ('','$category','$category','Top Up','$type2')");
            echo "<br>Kategori Sudah Ada Di Database => $category \n <br />";
		} else {

		}

$insert = $conn->query("INSERT INTO layanan_pulsa VALUES ('', '$sid', '$sid', '$category', '$service', '$description', '$price_web', '$price_api', '$status', 'DG-PULSA', '$type2', 'TOP UP')");
if ($insert == TRUE) {
echo"===============<br>Layanan Top Up Berhasil Di Tambahkan<br><br>ID Layanan : $sid<br>Operator : $category<br>Nama Layanan : $service<br>Tipe : $type2<br>Deskripsi : $description<br>Harga Web : $price_web<br>Harga API : $price_api<br>Status : $status<br>===============<br>";
} else {
    echo "Gagal Menampilkan Data Layanan Top Up.<br />";

}
}
}
?>