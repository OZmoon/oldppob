<?php
session_start();
require("../config.php");
require("../library/class.phpmailer.php");
$tipe = "Lupa Kata Sandi";

        if (isset($_POST['lupa'])) {
            $email = $conn->real_escape_string(filter(trim($_POST['email'])));

            $cek_pengguna = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $cek_pengguna_ulang = mysqli_num_rows($cek_pengguna);
            $data_pengguna = mysqli_fetch_assoc($cek_pengguna);

            $error = array();
            if (empty($email)) {
    		    $error ['email'] = '*Tidak Boleh Kosong';
            } else if ($cek_pengguna_ulang == 0) {
    		    $error ['email'] = '*Email Tidak Ditemukan';
            } else {

            $acakin_password = acak(10).acak_nomor(10);
            $hash_pass = password_hash($acakin_password, PASSWORD_DEFAULT);

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = "mail.putrazc.site"; //host masing2 provider email
            $mail->SMTPDebug = 2;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "support@putrazc.site"; //user email
            $mail->Password = "wowosasgt1"; //password email 
            $mail->SetFrom("support@putrazc.site","Support NoReply"); //set email pengirim
            $mail->Subject = "Verifikasi Akun"; //subyek email
            $mail->AddAddress("$email","");  //tujuan email
            $mail->MsgHTML("<html>

<head>
    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='author' content='Rifkiapy'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.7/css/all.css'>
    <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
    <style type='text/css'>
        body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}table{border-collapse:collapse!important}body{font-family:'Dosis';height:100%!important;margin:0!important;padding:0!important;width:100%!important}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:600px){h1{font-size:32px!important;line-height:32px!important}}div[style*='margin: 16px 0;']{margin:0!important}
    </style>
</head>

<body style='background-color:#f4f4f4;margin:0 !important;padding:0 !important;'>
    <div
        style='display:none;font-size:1px;color:#fefefe;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;'>
        Kami senang Anda ada di sini! Bersiaplah untuk menggunakan akun baru Anda.
    </div>

    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
            <td bgcolor='#0022ff' align='center'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td style='padding-bottom:40px;'></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#0022ff' align='center' style='padding:0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' valign='top'
                            style='padding:40px 20px 20px 20px;border-radius:4px 4px 0px 0px;letter-spacing:4px;line-height:48px;'>
                            <h1 style='color: #111111;font-size:48px;font-weight:bold;margin:0;'>
                                Reset Berhasil!
                            </h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding:0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='left' style='padding:20px 30px 40px 30px;line-height:25px;'>
                            <p style='color:#666666;font-size:18px;font-weight:bold;margin:0;'>
                                Password anda berhasil di perbarui boss, Silakan masuk dengan menggunakan password yang baru di bawah ini.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td bgcolor='#ffffff' align='center' style='padding:40px 30px 60px 30px;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius:3px;' bgcolor='#ffe705'>
                                                  $acakin_password 
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left' style='padding:0px 30px 0px 30px;line-height:25px;'>
                            <p style='color:#666666;font-size: 18px;font-weight:bold;margin:0;'>
                                Terimakasih telah mempercayai kami Kincai Payment sebagai marketplace kesayangan anda!
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left'
                            style='padding:0px 30px 40px 30px;border-radius:0px 0px 4px 4px;line-height:25px;'>
                            <p style='color:#666666;font-size:18px;font-weight:bold;margin:0;'>
                            <br>
                                Kincai Payment,<br>
                                
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding:30px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td bgcolor='#f4f4f4' align='left' style='padding:0px 30px 30px 30px;line-height:18px;'>
                            <p style='color:#666;font-size:14px;font-weight:bold;margin:0;'>
                                Anda menerima email ini karena Anda baru saja mendaftar untuk akun baru di,
                                <a href='https://pembuat-smm.my.id/v1/' target='_blank'
                                    style='color:#111111;text-decoration:none;'>Lihat di Browser</a>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#f4f4f4' align='left'
                            style='padding:0px 30px 30px 30px;color:#666666;font-size:14px;font-weight:bold;line-height:18px;'>
                            <p style='margin:0;text-align:center;'>
                                Made with <i class='fa fa-heart' style='color:red;'></i> by Rifkiapy
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>");
            if ($mail->Send());
                if ($conn->query("UPDATE users SET password = '$hash_pass', random_kode = '$acakin_password' WHERE username = '".$data_pengguna['username']."'") == true) {
                    $_SESSION['hasil'] = array('alert' => 'success', 'pesan' => 'Sip, Kata Sandi Baru Telah Dikirim Ke Email Kamu atau cek di forder spam.<script>swal("Berhasil!", "Kata Sandi Baru Telah Dikirim Ke Email Kamu atau cek di forder spam.", "success");</script>');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan.<script>swal("Ups Gagal!", "Sistem Kami Sedang Mengalami Gangguan.", "error");</script>');    
                }
            }
        }

        require '../library/header_home.php';

?>

        <!-- Start Page Forgot Password -->
        <div class="login-2" style="background-image: url('<?php echo $config['web']['url'] ?>assets/media/bg/bg-1.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-section">
                            <h3>Lupa Kata Sandi</h3>
                            <?php
                            if (isset($_SESSION['hasil'])) {
                            ?>
                            <div class="alert alert-<?php echo $_SESSION['hasil']['alert'] ?> alert-dismissible" role="alert">
                                <?php echo $_SESSION['hasil']['pesan'] ?>
                            </div>
                            <?php
                            unset($_SESSION['hasil']);
                            }
                            ?>
                            <div class="login-inner-form">
                                <form class="form-horizontal" role="form" method="POST">
                                    <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                    <div class="form-group form-box">
                                        <input type="email" class="input-text" placeholder="Masukkan Email" name="email" value="<?php echo $email; ?>">
                                        <i class="flaticon-mail"></i>
                                        <small class="text-danger font-13 pull-right"><?php echo ($error['email']) ? $error['email'] : '';?></small>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block" name="lupa">Submit</button>
                                    </div>
                                    <br />
                                    <p>Sudah Punya Akun ?<a href="<?php echo $config['web']['url'] ?>auth/login"> <b>Masuk</b></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Forgot Password -->

        <!-- Start Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
        <!-- End Scrolltop -->

<?php
require '../library/footer_home.php';
?>