<?php
session_start();
require '../config.php';
$tipe = "Daftar";

function dapetin($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
}
        if (isset($_POST['daftar'])) {
            $nama_depan = $conn->real_escape_string(trim(filter($_POST['nama_depan'])));
            $nama_belakang = $conn->real_escape_string(trim(filter($_POST['nama_belakang'])));
            $email = $conn->real_escape_string(trim(filter($_POST['email'])));
            $username = $conn->real_escape_string(trim(filter($_POST['username'])));
            $no_hp = $conn->real_escape_string(trim(filter($_POST['no_hp'])));
            $password = $conn->real_escape_string(trim(filter($_POST['password'])));
            $password2 = $conn->real_escape_string(trim(filter($_POST['password2'])));
            $pin = $conn->real_escape_string(trim(filter($_POST['pin'])));
            $kode_referral = $conn->real_escape_string(trim(filter($_POST['kode_referral'])));

            $secret_key = '6Le101ciAAAAAByKnrX3_to6qp4RPJUrhtAbQqu6'; //masukkan secret key-nya berdasarkan secret key masing-masing saat create api key nya
            $captcha = $_POST['g-recaptcha-response'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
            $recaptcha = dapetin($url);

            $cek_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $cek_email_ulang = mysqli_num_rows($cek_email);
            $data_email = mysqli_fetch_assoc($cek_email);

            $cek_pengguna = $conn->query("SELECT * FROM users WHERE username = '$username'");
            $cek_pengguna_ulang = mysqli_num_rows($cek_pengguna);
            $data_pengguna = mysqli_fetch_assoc($cek_pengguna);

            $cek_no_hp = $conn->query("SELECT * FROM users WHERE no_hp = '$no_hp'");
            $cek_no_hp_ulang = mysqli_num_rows($cek_no_hp);
            $data_no_hp = mysqli_fetch_assoc($cek_no_hp);

            $cek_kode = $conn->query("SELECT * FROM users WHERE kode_referral = '$kode_referral'");
            $cek_kode_ulang = mysqli_num_rows($cek_kode);
            $data_kode = mysqli_fetch_assoc($cek_kode);

            $pengguna = $data_kode['username'];
            $kode_ref = 'MK-'.acak_nomor(4);

            $error = array();
            if (empty($nama_depan)) {
    		    $error ['nama_depan'] = '*Tidak Boleh Kosong';
            } 
            else if (empty($nama_belakang)) {
    		    $error ['nama_belakang'] = '*Tidak Boleh Kosong';
            }
            else if (empty($email)) {
    		    $error ['email'] = '*Tidak Boleh Kosong';
            } else if ($cek_email->num_rows > 0) {
    		    $error ['email'] = '*Email Sudah Terdaftar';
            }
            else if (empty($username)) {
    		    $error ['username'] = '*Tidak Boleh Kosong';
            } else if (strlen($username) < 5) {
    		    $error ['username'] = '*Nama Pengguna Minimal 5 Karakter';
            } else if ($cek_pengguna->num_rows > 0) {
    		    $error ['username'] = '*Nama Pengguna Sudah Terdaftar';
            }
            else if (empty($no_hp)) {
		    $error ['no_hp'] = '*Tidak Boleh Kosong';
            } else if ($cek_no_hp == 0) {
		    $error ['no_hp'] = '*Nomor HP Sudah Terdaftar';
            }
            else if (empty($password)) {
    		    $error ['password'] = '*Tidak Boleh Kosong';
            } else if (strlen($password) < 6) {
    		    $error ['password'] = '*Minimal 6 Karakter';
            }
            else if (empty($password2)) {
    		    $error ['password2'] = '*Tidak Boleh Kosong';
            } else if ($password <> $password2) {
    		    $error ['password2'] = '*Konfirmasi Kata Sandi Tidak Sesuai';
            }
            else if (empty($pin)) {
    		    $error ['pin'] = '*Tidak Boleh Kosong.';
            } else if (strlen($pin) <> 6 ){
    		    $error ['pin'] = '*PIN Harus 6 Digit.';
            }
            else if (empty($pin)) {
    		    $error ['pin'] = '*Tidak Boleh Kosong.';
            } else if (strlen($pin) <> 6 ){
    		    $error ['pin'] = '*PIN Harus 6 Digit.';
            }
            else if ($recaptcha['success'] == false) {
    		    $error ['kode'] = '*Mohon Mengisi Captcha.';
            } else {
                
	        if (mysqli_num_rows($kode_ref) == 0) {
	           

                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $api_key =  acak(20);

                    if ($conn->query("INSERT INTO users VALUES ('', '$nama_depan', '$nama_belakang', '$nama_depan $nama_belakang', '$email', '$username', '$hash_password', '0', '0', '0', 'Member', 'Aktif', 'Belum Verifikasi', '$pin', '$api_key', 'Pendaftaran Gratis', '$pengguna', '$date', '$time', '0', '$no_hp', '', '$kode_ref', '', '0')") == true) {
                        $_SESSION['hasil'] = array('alert' => 'success', 'pesan' => 'Sip, Akun Kamu Berhasil Di Daftarkan.<script>swal("Berhasil!", "Akun Kamu Berhasil Di Daftarkan.", "success"}).then(function(){window.location="/auth/verification-account.php";});</script>');
                    } else {
                        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan.<script>swal("Ups Gagal!", "Sistem Kami Sedang Mengalami Gangguan.", "error");</script>');
                    }
	            }
            }
        }

        require '../library/header_home.php';

?>

                <!-- Start Page Register -->
        <div class="login-2" style="background-image: url('<?php echo $config['web']['url'] ?>assets/media/bg/bg-1.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-section">
                                                    
                            <img style="max-height:70px;max-width:300px;width: auto; height: 100px;" alt="Register" src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelblack.png" />
                        <br/>
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
                            <br/>
                            <div class="login-inner-form">
                                <form class="form-horizontal" role="form" method="POST">
                                    <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                    <div class="row">
                                        <div class="form-group form-box col-md-6 col-12">
                                            <input type="text" class="input-text" placeholder="Nama Depan" name="nama_depan" value="<?php echo $nama_depan; ?>">
                                            <small class="text-danger font-13 pull-right"><?php echo ($error['nama_depan']) ? $error['nama_depan'] : '';?></small>
                                        </div>
                                        <div class="form-group form-box col-md-6 col-12">
                                            <input type="text" class="input-text" placeholder="Nama Belakang" name="nama_belakang" value="<?php echo $nama_belakang; ?>">
                                            <small class="text-danger font-13 pull-right"><?php echo ($error['nama_belakang']) ? $error['nama_belakang'] : '';?></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-box col-md-6 col-12">
                                            <input type="email" class="input-text" placeholder="Email Aktif" name="email" value="<?php echo $email; ?>">
                                            <small class="text-danger font-13 pull-right"><?php echo ($error['email']) ? $error['email'] : '';?></small>
                                        </div>
                                        <div class="form-group form-box col-md-6 col-12">
                                            <input type="number" class="input-text" placeholder="Nomor HP" name="no_hp">
                                            <small class="text-danger font-13 pull-right"><?php echo ($error['no_hp']) ? $error['no_hp'] : '';?></small>
                                        </div>
                                    </div>
                                    <div class="form-group form-box">
                                        <input type="text" class="input-text" placeholder="Nama Pengguna" name="username" value="<?php echo $username; ?>">
                                        <i class="flaticon-user"></i>
                                        <small class="text-danger font-13 pull-right"><?php echo ($error['username']) ? $error['username'] : '';?></small>
                                    </div>
                                    <div class="form-group form-box">
                                        <input type="password" class="input-text" placeholder="Kata Sandi" name="password">
                                        <i class="flaticon-password"></i>
                                        <small class="text-danger font-13 pull-right"><?php echo ($error['password']) ? $error['password'] : '';?></small>
                                    </div>
                                    <div class="form-group form-box">
                                        <input type="password" class="input-text" placeholder="Konfirmasi Kata Sandi" name="password2">
                                        <i class="flaticon-password"></i>
                                        <small class="text-danger font-13 pull-right"><?php echo ($error['password2']) ? $error['password2'] : '';?></small>
                                    </div>
                                    <div class="form-group form-box">
                                        <input type="number" class="input-text" placeholder="PIN Transaksi Harus 6 Digit" name="pin" value="<?php echo $pin; ?>">
                                        <i class="fa fa-key"></i>
                                        <small class="text-danger font-13 pull-right"><?php echo ($error['pin']) ? $error['pin'] : '';?></small>
                                    </div>
                                    <div class="form-group form-box">
                                        <input type="text" class="input-text" placeholder="Kode Referral Jika Ada" name="kode_referral" value="<?php echo $kode_referral; ?>">
                                        <i class="fa fa-gift"></i>
                                        <small class="text-danger font-13 pull-right"><?php echo ($error['kode_referral']) ? $error['kode_referral'] : '';?></small>
                                    </div>
									<div class="form-group form-box">
                                       <div class="g-recaptcha" data-sitekey="6Le101ciAAAAAByKnrX3_to6qp4RPJUrhtAbQqu6"></div>
									</div>
                                    <i class="form-control-feedback"></i>
                                    <small class="text-info pull-left" ></small>
                                    <div class="checkbox clearfix">
                                        <div class="form-check checkbox-theme">
                                            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">
                                                Saya Setuju Dengan Ketentuan Layanan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block" name="daftar">Daftar</button>
                                    </div>
                                    <br />
                                    <p>Belum Verifikasi Akun ?<a href="<?php echo $config['web']['url'] ?>auth/verification-account"> <b>Verifikasi Disini</b></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Register -->

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <!-- Start Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
        <!-- End Scrolltop -->

<?php
require '../library/footer_home.php';
?>