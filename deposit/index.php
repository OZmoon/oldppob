<?php
session_start();
require("../config.php");
require '../library/session_user.php';

        if (isset($_POST['buat'])) {
	        require '../library/session_login.php';
	        $post_metode = $conn->real_escape_string($_POST['radio7']);
		    $post_tipe = $conn->real_escape_string($_POST['radio6']);
		    $post_provider = $conn->real_escape_string($_POST['provider']);
		    $post_pengirim = $conn->real_escape_string(trim(filter($_POST['pengirim'])));
		    $post_jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
		    $post_pin = $conn->real_escape_string(trim(filter($_POST['pin'])));

		    $cek_metod = $conn->query("SELECT * FROM metode_depo WHERE id = '$post_provider' AND status = 'Aktif' ORDER BY id ASC");
		    $data_metod = $cek_metod->fetch_assoc();
		    $cek_metod_rows = mysqli_num_rows($cek_metod);

		    $cek_depo = $conn->query("SELECT * FROM deposit WHERE username = '$sess_username' AND status = 'Pending'");
		    $data_depo = $cek_depo->fetch_assoc();
		    $count_depo = mysqli_num_rows($cek_depo);

            if ($post_metode == "saldo_sosmed"){
		    	$post_metodee = "Saldo Sosmed";
            } else if($post_metode == "saldo_top_up"){
		    	$post_metodee = "Saldo Top Up";
            }

            $tipe_saldo = $post_metode;
		    $kode = acak_nomor(3).acak_nomor(3);

            $error = array();
            if (empty($post_metode)) {
		        $error ['radio7'] = '*Wajib Pilih Salah Satu.';
            }
            if (empty($post_tipe)) {
		        $error ['radio6'] = '*Wajib Pilih Salah Satu.';
            }
            if (empty($post_provider)) {
		        $error ['provider'] = '*Wajib Pilih Salah Satu.';
            }
            if (empty($post_pengirim)) {
		        $error ['pengirim'] = '*Tidak Boleh Kosong.';
            }
            if (empty($post_jumlah)) {
		        $error ['jumlah'] = '*Tidak Boleh Kosong.';
            }
            if (empty($post_pin)) {
		        $error ['pin'] = '*Tidak Boleh Kosong.';
            } else if ($post_pin <> $data_user['pin']) {
		        $error ['pin'] = '*PIN Yang Kamu Masukkan Salah.';
            } else {

            if ($cek_metod_rows == 0) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Tipe Pembayaran Tidak Tersedia.<script>swal("Ups Gagal!", "Tipe Pembayaran Tidak Tersedia.", "error");</script>');
		    } else if ($count_depo >= 1) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Kamu Masih Memiliki Isi Saldo Yang Berstatus Pending.<script>swal("Ups Gagal!", "Kamu Masih Memiliki Isi Saldo Berstatus Pending.", "error");</script>');
	    	} else if ($post_jumlah < $data_metod['minimal']) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Minimal Isi Saldo Adalah Rp '.$data_metod['minimal'].'.<script>swal("Ups Gagal!", "Minimal Isi Saldo Adalah Rp '.$data_metod['minimal'].'.", "error");</script>');
	        } else {

		    if ($data_metod['tipe'] == 'Transfer Bank') {
			    $post_jumlah = $post_jumlah + rand(000,999);
		    }

	                $get_saldo = $post_jumlah * $data_metod['rate'];
	                $saldo = number_format($get_saldo,0,',','.');
	                $tanggal = date('Y-m-d'); // Tanggal Request
                    $kodec = 'menzcreate-uvdOat63c2y8JAR'; // Kode Akses
                    $jumlah = $get_saldo; // Jumlah
                    $bank = $data_metod['provider']; // BRI/BNI/BCA/GOPAY/OVO
                    
                    $url = "https://cekduit.my.id/api/input.php";
                    
                    $curlHandle = curl_init();
                    curl_setopt($curlHandle, CURLOPT_URL, $url);
                    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "kode=".$kodec."&jumlah=".$jumlah."&bank=".$bank."&tanggal=".$tanggal);
                    curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                    curl_setopt($curlHandle, CURLOPT_POST, 1);
                    $result = curl_exec($curlHandle);
                    curl_close($curlHandle);
                    
                    $b = json_decode($result, true);
                    
                //    print_r($b);
	                $insert = $conn->query("INSERT INTO deposit VALUES ('', '$kode', '$sess_username', '".$data_metod['tipe']."', '".$data_metod['provider']."', '$post_pengirim', '".$data_metod['tujuan']." ".$data_metod['nama_penerima']."', '".$data_metod['catatan']." $saldo','$post_jumlah', '$get_saldo', 'saldo_top_up', 'Pending', '$date', '$time')");
	                if ($insert == TRUE) {
   		                $_SESSION['hasil'] = array('alert' => 'success', 'pesan' => 'Sip! Kamu Berhasil Buat Isi '.$post_metodee.'.<script>swal("Berhasil!", "Kamu Berhasil Buat Isi Saldo.", "success");</script>');
		            } else {
			            $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan.<script>swal("Ups Gagal!", "Sistem Kami Sedang Mengalami Gangguan.", "error");</script>');
	                }
	            }
	        }
        }

	    require("../library/header.php");

?>

        <!-- Start Sub Header -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
	        <div class="kt-container">
	            <div class="kt-subheader__main">
		            <h3 class="kt-subheader__title">Isi Saldo</h3>
	                <div class="kt-subheader__breadcrumbs">
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon-coins"></i></a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Halaman Utama</a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Isi Saldo</a>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- End Sub Header -->

        <!-- Start Content -->
        <div class="kt-container kt-grid__item kt-grid__item--fluid">

        <!-- Start Page Top Up Balance -->
        <div class="row">
	        <div class="col-lg-7">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="flaticon-coins text-primary"></i>
					            Deposit
					        </h3>
				        </div>
                        <div class="kt-portlet__head-label">
                            <a href="<?php echo $config['web']['url'] ?>history/deposit" class="pull-right btn btn-primary btn-sm"> <i class="fas fa-history"></i> History</a>
                        </div>				        
			        </div>
			        <div class="kt-portlet__body">
					<?php
					$cek_depo = $conn->query("SELECT * FROM deposit WHERE username = '$sess_username' AND status = 'Pending' ORDER BY id DESC");
					while ($data_depo = $cek_depo->fetch_assoc()) {
					?>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
					<script>
						var url = "<?php echo $config['web']['url'] ?>deposit/invoice?kode_deposit=<?php echo $data_depo['kode_deposit']; ?>"; // URL Tujuan
						var count = 1; // dalam detik
						function countDown() {
							if (count > 0) {
							    count--;
							    var waktu = count + 1;
							    setTimeout("countDown()", 1000);
							} else {
							    window.location.href = url;
							}
						}
						countDown();
					</script>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['hasil'])) {
                    ?>
                    <div class="alert alert-<?php echo $_SESSION['hasil']['alert'] ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION['hasil']['pesan'] ?><div id="respon"></div>
                    </div>
                    <?php
                    unset($_SESSION['hasil']);
                    }
                    ?>
					<form class="form-horizontal" role="form" method="POST">
						<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
							<div class="form-group row">
						        <label class="col-xl-3 col-lg-3 col-form-label">Isi Saldo Ke</label>
						        <div class="col-lg-9 col-xl-6">
							         <div class="kt-radio-list">
								        <label class="kt-radio kt-radio--bold kt-radio--brand">
									        <input type="radio" name="radio7" id="metod" value="saldo_sosmed">Sosmed
									        <span></span>
								        </label>
								        <label class="kt-radio kt-radio--bold kt-radio--brand">
									        <input type="radio" name="radio7" id="metod" value="saldo_top_up">Top Up
									        <span></span>
								        </label>
								        <span class="form-text text-muted"><?php echo ($error['radio7']) ? $error['radio7'] : '';?></span>
							        </div>
						        </div>
							</div>
							<div class="form-group row">
						        <label class="col-xl-3 col-lg-3 col-form-label">Kategori Pembayaran</label>
						        <div class="col-lg-9 col-xl-6">
							         <div class="kt-radio-list">
								        <label class="kt-radio kt-radio--bold kt-radio--brand">
									        <input type="radio" name="radio6" id="tipe" value="Transfer Pulsa">Transfer Pulsa
									        <span></span>
								        </label>
								        <label class="kt-radio kt-radio--bold kt-radio--brand">
									        <input type="radio" name="radio6" id="tipe" value="Transfer Bank">Transfer Bank
									        <span></span>
								        </label>
								        <span class="form-text text-muted"><?php echo ($error['radio6']) ? $error['radio6'] : '';?></span>
							        </div>
						        </div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Tipe Pembayaran</label>
								<div class="col-lg-9 col-xl-6">
									<select class="form-control" name="provider" id="provider">
										<option value="0">Pilih Kategori Pembayaran Dahulu...</option>
									</select>
									<span class="form-text text-muted"><?php echo ($error['provider']) ? $error['provider'] : '';?></span>
								</div>
							</div>
							<div id="pembayaran"></div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">PIN</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-lock text-primary"></i></span></div>
                                        <input type="password" name="pin" class="form-control" placeholder="Masukkan PIN Kamu">
                                    </div>
                                    <span class="form-text text-muted"><?php echo ($error['pin']) ? $error['pin'] : '';?></span>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" name="buat" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Submit</button>
                                            <button type="reset" class="btn btn-danger btn-elevate btn-pill btn-elevate-air">Ulangi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>    
					</form>
				</div>
			</div>

	        <div class="col-lg-5">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="flaticon-alert text-primary"></i>
					            Informasi
					        </h3>
				        </div>
			        </div>
			        <div class="kt-portlet__body">
						<p>Isi Saldo Pada <b><?php echo $data['short_title']; ?></b> Menggunakan Sistem Verifikasi Otomatis, Saldo Akan Bertambah Pada Menit Yang Sama Ketika Kamu <b>Sukses</b> Melakukan Deposit.</p>
						<p>Jadwal Bank <b>OFFLINE</b> Bisa Kamu Cek Di Bawah Ini Dengan Mengeklik Salah Satu Tipe Pembayaran.</p>
						<div class="mb-3" id="accordion">
							<!-- KE 1 -->
							<div class="card mb-1">
								<div class="card-header" id="headingOne">
									<h4 class="m-0">
										<a class="text-dark collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
										<i class="flaticon2-information mr-1 text-primary"></i>
										BANK BRI
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="card-collapse collapse in" role="tabcard" aria-labelledby="headingOne">
									<div class="kt-portlet__body">
										<ul>
											<li>Senin - Minggu : 22:00 WIB - 06:00 WIB</li>
											<li>Bank BRI Sering Gangguan Dadakan, Harap Jika Sudah Transfer Masuk Dan Bank BRI Mengalami Gangguan Dadakan Langsung Hubungi (CS) Bantuan <b><?php echo $data['short_title']; ?></b> Untuk Di Tindak Lanjuti.</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- KE 2 -->
							<div class="card mb-1">
							    <div class="card-header" id="headingTwo">
									<h4 class="m-0">
										<a class="text-dark collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="true">
										<i class="flaticon2-information mr-1 text-primary"></i>
										BANK BCA
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="card-collapse collapse" role="tabcard" aria-labelledby="headingTwo">
									<div class="kt-portlet__body">
										<ul>
											<li>Senin - Jumat : 21:00 WIB - 01:00 WIB</li>
											<li>Sabtu : 18:00 WIB - 20:00 WIB, 21:00 WIB - 01:00 WIB</li>
											<li>Minggu : 00:00 WIB - 05:00 WIB</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- KE 3 -->
							<div class="card mb-1">
							    <div class="card-header" id="headingTiga">
									<h4 class="m-0">
										<a class="text-dark collapsed" data-toggle="collapse" href="#collapseTiga" aria-expanded="true">
										<i class="flaticon2-information mr-1 text-primary"></i>
										MANDIRI
										</a>
									</h4>
								</div>
								<div id="collapseTiga" class="card-collapse collapse" role="tabcard" aria-labelledby="headingTiga">
									<div class="card-body">
										<ul>
											<li>Senin - Jumat : 23:00 WIB - 03:30 WIB</li>
											<li>Sabtu - Minggu : 22:00 WIB - 04:00 WIB</b></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- KE 4 -->
							<div class="card mb-1">
								<div class="card-header" id="headingEmpat">
									<h4 class="m-0">
										<a class="text-dark collapsed" data-toggle="collapse" href="#collapseEmpat" aria-expanded="false">
										<i class="flaticon2-information mr-1 text-primary"></i>
										BANK BTPN JENIUS
										</a>
									</h4>
								</div>
								<div id="collapseEmpat" class="card-collapse collapse" role="tabcard" aria-labelledby="headingEmpat" style="">
									<div class="card-body">
										<ul>
											<li>Senin - Minggu : 22:00 WIB - 06:00 WIB</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- KE 5 -->
							<div class="card mb-1">
							    <div class="card-header" id="headingLima">
									<h4 class="m-0">
										<a class="text-dark collapsed" data-toggle="collapse" href="#collapseLima" aria-expanded="true">
										<i class="flaticon2-information mr-1 text-primary"></i>
										BANK BNI
										</a>
									</h4>
								</div>
								<div id="collapseLima" class="card-collapse collapse" role="tabcard" aria-labelledby="headingLima">
									<div class="card-body">
										<ul>
											<li>24 Jam</li>
											<li>Jarang Sekali Terjadi <b>OFFLINE</b> Kecuali Kalau Ada Gangguan Dadakan.</li>
										</ul>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <!-- End Page Top Up Balance -->

        </div>
        <!-- End Content -->

        <!-- Start Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
		    <i class="fa fa-arrow-up"></i>
		</div>
		<!-- End Scrolltop -->

        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
            $('input[type=radio][id=tipe]').change(function() {
                var tipe = this.value;
                $.ajax({
                    url: '<?php echo $config['web']['url']; ?>ajax/provider-top-up-balance.php',
                    data: 'tipe=' + tipe,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#provider").html(msg);
                    }
                });
            });
            $("#provider").change(function() {
                var provider = $("#provider").val();
                $.ajax({
                    url: '<?php echo $config['web']['url']; ?>ajax/payment-top-up-balance.php',
                    data: 'provider=' + provider,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#pembayaran").html(msg);
                    }
                });
            });
            $("#jumlah").change(function(){
                var pembayaran = $("#pembayaran").val();
                var jumlah = $("#jumlah").val();
                $.ajax({
                    url : '<?php echo $config['web']['url']; ?>ajax/rate-top-up-balance.php',
                    type  : 'POST',
                    dataType: 'html',
                    data  : 'pembayaran='+pembayaran+'&jumlah='+jumlah,
                    success : function(result){
                        $("#rate").val(result);
                    }
                });
            });
        });
		</script>

<?php
require ("../library/footer.php");
?>