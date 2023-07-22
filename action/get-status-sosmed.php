<?php
	require("../config.php");

	$check_order = $conn->query("SELECT * FROM pembelian_sosmed WHERE status IN ('Pending', 'Processing')");

	if (mysqli_num_rows($check_order) == 0) {
	  die("Pesanan Berstatus Pending Tidak Ditemukan.");
	} else {
	  while($data_order = mysqli_fetch_assoc($check_order)) {
	    $o_oid = $data_order['oid'];
	    $o_poid = $data_order['provider_oid'];
	    $o_provider = $data_order['provider'];
	    $username = $data_order['user'];
	    $koin = $data_order['koin'];
	    $layanan = $data_order['layanan'];
	    $provider = $data_order['provider'];
	  if ($o_provider == "MANUAL") {
	    echo "Pesanan Manual<br />";
	  } else {

        $getService = $conn->query("SELECT * FROM layanan_sosmed WHERE layanan = '$layanan' AND provider = '$provider'");
        $getDataService = mysqli_fetch_assoc($getService);

		$check_provider = $conn->query("SELECT * FROM provider WHERE code = 'MEDANPEDIA'");
		$data_provider = mysqli_fetch_assoc($check_provider);

		$p_apikey = $data_provider['api_key'];
		$p_api_id = $data_provider['api_id'];

        $url = "https://medanpedia.co.id/api/status";

        $postdata = array( 
            'api_id' => $p_api_id,
            'api_key' => $p_apikey,
            'id' => $o_poid,
        );
        // echo json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $chresult = curl_exec($ch);
        $result = json_decode($chresult, true);
        // echo $result;
        $sn = $result['data']['status'];
        if (isset($result['status']) AND $result['status'] == true) {
			if ($sn == 'Success') {
				$status = 'Success';
			} elseif ($sn == 'Error') {
				$status = 'Error';
			} elseif ($sn == 'Partial') {
				$status = 'Partial';
			} elseif ($sn == 'Processing') {
				$status = 'Processing';
			} else {
				$status = 'Pending';
			}
			
	      if ($sn == "Success") {
            $update = $conn->query("INSERT INTO riwayat_saldo_koin VALUES ('', '$username', 'Koin', 'Penambahan Koin', '$koin', 'Mendapatkan Koin Melalui Pemesanan $layanan Dengan Kode Pesanan : $o_oid', '$date', '$time')");
            $update = $conn->query("UPDATE users SET koin = koin+$koin WHERE username = '$username'");
        	    }
			$start_count = (isset($result['data']['start_count'])) ? $result['data']['start_count'] : 0;
			$remains = (isset($result['data']['remains'])) ? $result['data']['remains'] : 0;
	        $update_order = $conn->query("UPDATE semua_pembelian SET status = '$status' WHERE id_pesan = '$o_oid'");
	       	$update_order = $conn->query("UPDATE pembelian_sosmed SET status = '".$status."', remains = '".$remains."', start_count = '".$start_count."',  date = '".date('Y-m-d')."' WHERE oid = '$o_oid'");
    	    if ($update_order == TRUE) {
    	        echo "===============<br>Berhasil Menampilkan Data Status Sosmed<br><br>ID Pesanan : $o_oid<br>Remains : $remains<br>Status : $status<br>===============<br>";
    	    } else {
    	        echo "Gagal Menampilkan Data Status Sosmed.<br />";
    	    }		
            
        }
	  }
	}
  }
?>