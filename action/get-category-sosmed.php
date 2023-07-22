<?php
require_once("../config.php");

    $check_provider = $conn->query("SELECT * FROM provider WHERE code = 'MEDANPEDIA'");
    $data_provider = mysqli_fetch_assoc($check_provider);

    $p_apiid = $data_provider['api_id'];
    $p_apikey = $data_provider['api_key'];

    $url = "https://medanpedia.co.id/api/services";
    $postdata = array( 
        'api_id' => $p_apiid,
	    'api_key' => $p_apikey
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    $result = json_decode($chresult, true);
    // print_r($result);

// get data service
foreach($result['data'] as $data) {
       //INSERT KATEGORI
        $category = $data['category'];
		$cek_kategori = $conn->query("SELECT * FROM kategori_layanan WHERE nama = '$category'");
        $data_cat = mysqli_fetch_assoc($cek_kategori);
		if (mysqli_num_rows($cek_kategori) == 0) {
           $input_kategori = $conn->query("INSERT INTO kategori_layanan VALUES ('','$category','$category','Sosial Media','')");
           if ($input_kategori == TRUE){
               $check_data = $conn->query("SELECT * FROM kategori_layanan WHERE nama = '$category'");
               $get_data = mysqli_fetch_assoc($check_data);
               $data['category'] = $get_data['category'];
           } else {
               $data['category'] = $category;
           }
		} else {
            $data['category'] = $data_cat['kode'];
		}
        // end get data service 
	    $check_services = $conn->query("SELECT * FROM layanan_sosmed WHERE service_id = '".$data['id']."'");
        $data_services = mysqli_fetch_assoc($check_services);
        if (mysqli_num_rows($check_services) > 0) {
            echo "<br>Layanan Sudah Ada Di Database \n <br />";
        } else {
        $name = strtr($data['name'], array(
			'MP' => 'TB',
			'PNC' => 'TCB',
			'Medanpedia' => 'Technobooks',
			'MEdanpedia' => 'Technobooks',
			'MEDANPEDIA' => 'TECHNOBOOKS',
		));
        $insert = $conn->query("INSERT INTO `layanan_sosmed`(`service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`,`status`, `provider_id`, `provider`,`tipe`) VALUES ('".$data['id']."', '".$data['category']."', '$name', '".$data['description']."', '".$data['min']."', '".$data['max']."','".($data['price'] + $data['price'] * 60 / 100 )."','".($data['price'] + $data['price'] * 60 / 100 )."','Aktif','".$data['id']."','MEDANPEDIA', 'Sosial Media')");
        if ($insert == TRUE) {
        $sid = $data['id'];
        $category = $data['category'];
        $price = $data['price'];
        $min = $data['min'];
        $max = $data['max'];
        $note = $data['description'];
        echo"===============<br>Layanan Sosmed Berhasil Di Tambahkan<br><br>ID Layanan : $sid<br>Kategori : $category<br>Nama Layanan : $name<br>Harga : $price<br>min : $min<br>max : $max<br>deskripsi : $note<br>===============<br>";
        } else {
            echo "Gagal Menampilkan Data Layanan sosmed.<br />";
        
        }
}
}
?>