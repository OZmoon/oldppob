<?php
/* 
Script Topup Otomatis Via Pulsa XL
Creator : Salman El Faris
From : Ilmupanel
 */
require_once "config.php";
require_once "EnvayaSMS.php";
require_once "../config.php";
$request = EnvayaSMS::get_request();
header("Content-Type: {$request->get_response_type()}");
if (!$request->is_validated($PASSWORD))
{
    header("HTTP/1.1 403 Forbidden");
    error_log("Invalid password");    
    echo $request->render_error_response("Invalid password");
    return;
}
$action = $request->get_action();
switch ($action->type)
{
    case EnvayaSMS::ACTION_INCOMING:    
        
        // Send an auto-reply for each incoming message.
    
        $type = strtoupper($action->message_type);
        $isi_pesan = $action->message;
     if($action->from == '168' AND preg_match("/Anda menerima Pulsa dari/i", $isi_pesan)) {
         $pesan_isi = $action->message;
         $insert_message = $conn->query("INSERT INTO pesan_tsel (isi, status, date) VALUES ('$pesan_isi', 'UNREAD', '$date')");
         $CheckHistory = $conn->query("SELECT * FROM deposit WHERE tipe = 'Pulsa Transfer' AND provider = 'XL' AND date = '$date'");
         if (mysqli_num_rows($CheckHistory) == 0) {
                error_log("Riwayat Top Up Tidak Tersedia");
         } else {          
             while($DataDeposit = mysqli_fetch_assoc($CheckHistory)) {
                        $kode = $DataDeposit['kode_deposit'];
                        $no_pegirim = $DataDeposit['nomor_pengirim'];
                        $user = $DataDeposit['username'];
                        $saldo = $DataDeposit['get_saldo'];
                        $this_date = $DataDeposit['date'];
                        $jumlah_transfer = $DataDeposit['jumlah_transfer'];
                        $cekpesan = preg_match("/Anda menerima Pulsa dari $no_pegirim sebesar Rp$jumlah_transfer/i", $isi_pesan);
                        if($cekpesan == true) {                              
                            $update_history_topup = $conn->query("INSERT INTO riwayat_saldo_koin VALUES ('', '$user', 'Penambahan Saldo', '$saldo', 'Mendapatkan Saldo Melalui Deposit Otomatis VIA XL TRANSFER Dengan ID Deposit : $kode', '$this_date', '$time')");                            
                            $update_history_topup = $conn->query("UPDATE deposit SET status = 'Success' WHERE code = '$kode'");
                            $update_history_topup = $conn->query("UPDATE users SET saldo = saldo+$saldo WHERE username = '$user'");
                            if($update_history_topup == TRUE) {  
                                error_log("Saldo $user Telah Ditambahkan Sebesar $amount");
                            } else {
                                error_log("System Error");
                            }
                        } else {
                            error_log("Data Transfer Pulsa Tidak Ada");
                        }
                }
         }
     } else {
        error_log("Received $type from {$action->from}");
        error_log(" message: {$action->message}");
     }                     
        
        return;
}