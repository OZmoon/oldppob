<?php
require_once("../config.php");

$check_provider = $conn->query("SELECT * FROM `provider` WHERE `code` = 'MEDIAMARKET'");
$data_provider = mysqli_fetch_assoc($check_provider);

$p_apiid = $data_provider['api_id'];
$p_apikey = $data_provider['api_key'];

$url = "https://mediamarket.id/api/social-media";
$postdata = array( 
	'api_key' => $p_apikey,
	'action' => 'layanan'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
$result = json_decode($chresult, true);

//print '<pre>'.print_r($result,1).'</pre>'; flush(); die();

//parsing data
foreach($result['data'] as $data) {
    
    //check category
    $category = $data['kategori'];
	$cek_kategori = $conn->query("SELECT * FROM `kategori_layanan` WHERE `nama` = '$category'");
    $data_cat = mysqli_fetch_assoc($cek_kategori);
	if (mysqli_num_rows($cek_kategori) == 0) {
	    $input_kategori = $conn->query("INSERT INTO `kategori_layanan` (`id`, `nama`, `kode`, `tipe`, `server`) VALUES (NULL, '$category', '$category', 'Sosial Media', 'MEDIAMARKET');");
        if ($input_kategori == TRUE){
            $check_data = $conn->query("SELECT * FROM `kategori_layanan` WHERE `nama` = '$category'");
            $get_data = mysqli_fetch_assoc($check_data);
            $data['kategori'] = $get_data['kode'];
            echo "Kategori baru berhasil ditambahkan.<br>";
        } else {
            $data['kategori'] = $category;
            echo "Kategori baru gagal ditambahkan.<br>";
        }
	} else {
        $data['kategori'] = $data_cat['kode'];
        echo "Kategori baru sudah ada di databases.<br>";
	}
    
    //check service
	$check_services = $conn->query("SELECT * FROM `layanan_sosmed` WHERE `service_id` = '".$data['sid']."'");
    $data_services = mysqli_fetch_assoc($check_services);
    if (mysqli_num_rows($check_services) > 0) {
        echo "Layanan sudah ada di database<br>";
    } else {
        $price = ($data['harga'] + $data['harga'] * 27 / 100 );
        $insert = $conn->query("INSERT INTO `layanan_sosmed` (`id`, `service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`, `status`, `provider_id`, `provider`, `tipe`) VALUES (NULL, '".$data['sid']."', '".$data['kategori']."', '".$data['layanan']."', '".$data['catatan']."', '".$data['min']."', '".$data['max']."', '".$price."', '".$price."', 'Aktif', '".$data['sid']."', 'MEDIAMARKET', 'Sosial Media');");
        if ($insert == TRUE) {
            $sid = $data['sid'];
            $category = $data['kategori'];
            $price = $data['harga'];
            $min = $data['min'];
            $max = $data['max'];
            $note = $data['catatan'];
            echo"===============<br>Layanan Sosmed Berhasil Di Tambahkan<br><br>ID Layanan : $sid<br>Kategori : $category<br>Nama Layanan : $name<br>Harga : $price<br>min : $min<br>max : $max<br>deskripsi : $note<br>===============<br>";
        } else {
            echo "Gagal Menampilkan Data Layanan sosmed.<br />";
        
        }
    }
}
?>