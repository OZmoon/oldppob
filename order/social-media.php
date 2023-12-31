<?php
session_start();
require '../config.php';
require '../library/session_user.php';

        if (isset($_POST['pesan'])) {
		    require '../library/session_login.php';
		    $post_kategori = $conn->real_escape_string(trim(filter($_POST['kategori'])));
		    $post_layanan = $conn->real_escape_string(trim(filter($_POST['layanan'])));
		    $post_target = $conn->real_escape_string(trim(filter($_POST['target'])));
		    $post_jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
		    $post_pin = $conn->real_escape_string(trim(filter($_POST['pin'])));
		    $post_comments = $_POST['comments'];

		    $cek_rate = $conn->query("SELECT * FROM setting_rate WHERE tipe = 'Sosial Media'");
		    $data_rate = mysqli_fetch_assoc($cek_rate);

		    $cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE service_id = '$post_layanan' AND status = 'Aktif'");
		    $data_layanan = mysqli_fetch_assoc($cek_layanan);

	    	$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE target = '$post_target' AND status = 'Pending'");
		    $data_pesanan = mysqli_fetch_assoc($cek_pesanan);

			$cek_rate_koin = $conn->query("SELECT * FROM setting_koin_didapat WHERE status = 'Aktif'");
			$data_rate_koin = mysqli_fetch_assoc($cek_rate_koin);

		    $kategori = $data_layanan['kategori'];
		    $layanan = $data_layanan['layanan'];
		    $cek_harga = $data_layanan['harga'] / 1000;
		    $cek_profit = $data_rate['rate'] / 1000;
		    $hitung = count(explode(PHP_EOL, $post_comments));
	        $replace = str_replace("\r\n",'\r\n', $post_comments);
	        if (!empty($post_comments)) {
			    $post_jumlah = $hitung;
		    } else {
		    	$post_jumlah = $post_jumlah;
		    }
		    if (!empty($post_comments)) {
		    	$harga = $cek_harga*$hitung;
			    $profit = $cek_profit*$hitung;
		    } else {
			    $harga = $cek_harga*$post_jumlah;
			    $profit = $cek_profit*$post_jumlah;
		    }
		    $order_id = acak_nomor(3).acak_nomor(4);
            $provider = $data_layanan['provider'];
            $koin = $harga * $data_rate_koin['rate'];

		    $cek_provider = $conn->query("SELECT * FROM provider WHERE code = '$provider'");
		    $data_provider = mysqli_fetch_assoc($cek_provider);

            // Get Start Count
            if ($data_layanan['kategori'] == "Instagram Likes" AND "Instagram Likes Indonesia" AND "Instagram Likes [Targeted Negara]" AND "Instagram Likes/Followers Per Minute") {
                $start_count = likes_count($post_target);
            } else if ($data_layanan['kategori'] == "Instagram Followers No Refill/Not Guaranteed" AND "Instagram Followers Indonesia" AND "Instagram Followers [Negara]" AND "Instagram Followers [Refill] [Guaranteed] [NonDrop]") {
                $start_count = followers_count($post_target);
            } else if ($data_layanan['kategori'] == "Instagram Views") {
                $start_count = views_count($post_target);
            } else {
                $start_count = 0;
            }

            $error = array();
            if (empty($post_kategori)) {
    		    $error ['kategori'] = '*Wajib Pilih Salah Satu.';
            }
            if (empty($post_layanan)) {
    		    $error ['layanan'] = '*Wajib Pilih Salah Satu.';
            }
            if (empty($post_target)) {
    		    $error ['target'] = '*Tidak Boleh Kosong.';
            }
            if (empty($post_jumlah)) {
    		    $error ['jumlah'] = '*Tidak Boleh Kosong.';
            }
            if (empty($post_pin)) {
    		    $error ['pin'] = '*Tidak Boleh Kosong.';
            } else if ($post_pin <> $data_user['pin']) {
    		    $error ['pin'] = '*PIN Yang Kamu Masukkan Salah.';
            } else {

    		if (mysqli_num_rows($cek_layanan) == 0) {
    			$_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Layanan Tidak Tersedia.<script>swal("Ups Gagal!", "Layanan Tidak Tersedia.", "error");</script>');

		    } else if (mysqli_num_rows($cek_provider) == 0) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Server Kami Sedang Maintance.<script>swal("Ups Gagal!", "Server Kami Sedang Maintance.", "error");</script>');

		    } else if ($post_jumlah < $data_layanan['min']) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Minimal Jumlah Pemesanan Adalah '.number_format($data_layanan['min'],0,',','.').'<script>swal("Yahh Gagal!", "Jumlah Minimal Pemesanan Adalah '.number_format($data_layanan['min'],0,',','.').'", "error");</script>');
			
		    } else if ($post_jumlah > $data_layanan['max']) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Maksimal Jumlah Pemesanan Adalah '.number_format($data_layanan['max'],0,',','.').'<script>swal("Yahh Gagal!", "Jumlah Maksimal Pemesanan Adalah '.number_format($data_layanan['max'],0,',','.').'", "error");</script>');
			
		    } else if ($data_user['saldo_sosmed'] < $harga) {
			    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Yahh, Saldo Sosial Media Kamu Tidak Mencukupi Untuk Melakukan Pemesanan Ini.<script>swal("Yahh Gagal!", "Saldo Sosial Media Kamu Tidak Mencukupi Untuk Melakukan Pemesanan Ini.", "error");</script>');

		    } else if (mysqli_num_rows($cek_pesanan) == 1) {
		        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Masih Terdapat Pesanan Dengan Tujuan Yang Sama & Berstatus Pending.<script>swal("Ups Gagal!", "Masih Terdapat Pesanan Dengan Tujuan Yang Sama & Berstatus Pending.", "error");</script>');

		    } else {

			if ($provider == "MANUAL") {
				$api_postdata = "";
			} else if ($provider == "IRVANKEDE") {
			    if ($post_comments == false) {
                $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&quantity=$post_jumlah";
			    } else if ($post_comments == true) {
			    $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&custom_comments=$post_comments";
			    }
			    $url = "https://irvankede-smm.co.id/api/order";
			} else if ($provider == "MEDANPEDIA") {
			    if ($post_comments == false) {
                $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&quantity=$post_jumlah";
			    } else if ($post_comments == true) {
			    $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&custom_comments=$post_comments";
			    }
			    $url = "https://medanpedia.co.id/api/order";
			} else if($provider == "WSTORE") {
			    if ($post_comments == false) {
                $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&quantity=$post_jumlah";
			    } else if ($post_comments == true) {
			    $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&custom_comments=$post_comments";
			    }
			    $url = "https://www.wstore.co.id/api/order";
			} else if ($provider == "LOLLIPOP") {
			    if ($post_comments == false) {
                $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&quantity=$post_jumlah";
			    } else if ($post_comments == true) {
			    $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&custom_comments=$post_comments";
			    }
			    $url = "https://lollipop-smm.com/api/order";
			} else if($provider == "MEDIAMARKET") {
			    if ($post_comments == false) {
                $postdata = "api_key=".$data_provider['api_key']."&action=pemesanan&layanan=".$data_layanan['provider_id']."&target=$post_target&jumlah=$post_jumlah";
			    } else if ($post_comments == true) {
			    $postdata = "api_id=".$data_provider['api_id']."&api_key=".$data_provider['api_key']."&service=".$data_layanan['provider_id']."&target=$post_target&custom_comments=$post_comments";
			    }
			    $url = "https://mediamarket.id/api/social-media";
			} else {
				die("System Error!");
			}
			    $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                $json_result = json_decode($chresult, true);

			    if ($provider == "IRVANKEDE" AND $json_result['status'] == false) {
				    $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, '.$json_result['data']);
			    } else if ($provider == "MEDANPEDIA" AND $json_result['status'] == false) {
			        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, '.$json_result['data']);
			    } else if ($provider == "WSTORE" AND $json_result['status'] == false) {
			        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, '.$json_result['data']);
			    } else if ($provider == "LOLLIPOP" AND $json_result['status'] == false) {
			        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, '.$json_result['data']);
			    } else if ($provider == "MEDIAMARKET" AND $json_result['status'] == false) {
			        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, '.$json_result['data']);
			    }else {

                    if ($provider == "IRVANKEDE") {
					    $provider_oid = $json_result['data']['id'];
				    } else if($provider == "MEDANPEDIA") {
				        $provider_oid = $json_result['data']['id'];
				    } else if($provider == "WSTORE") {
				        $provider_oid = $json_result['data']['id'];
				    } else if($provider == "LOLLIPOP") {
				        $provider_oid = $json_result['data']['id'];
				    }else if($provider == "MEDIAMARKET") {
				        $provider_oid = $json_result['data']['id'];
				    }

			            $top_layanan = $conn->query("SELECT * FROM top_layanan WHERE layanan = '$layanan'");
			            $data_layanan = mysqli_fetch_assoc($top_layanan);
			            $check_top = $conn->query("SELECT * FROM top_users WHERE username = '$sess_username'");
			            $data_top = mysqli_fetch_assoc($check_top);
			            if ($conn->query("INSERT INTO pembelian_sosmed VALUES ('','$order_id', '$provider_oid', '$sess_username', '$layanan', '$post_target', '$post_jumlah', '$post_jumlah', '$start_count', '$harga', '$profit', '$koin', 'Pending', '$date', '$time', '$provider', 'Website', '0')") == true) {
			            	$conn->query("INSERT INTO semua_pembelian VALUES ('','WEB-$order_id', '$order_id', '$sess_username', '$kategori', '$layanan', '$harga', '$post_target', 'Pending', '$date', '$time', 'WEB', '0')");
				            $conn->query("UPDATE users SET saldo_sosmed = saldo_sosmed-$harga, pemakaian_saldo = pemakaian_saldo+$harga WHERE username = '$sess_username'");
				            $conn->query("INSERT INTO riwayat_saldo_koin VALUES ('', '$sess_username', 'Saldo', 'Pengurangan Saldo', '$harga', 'Mengurangi Saldo Sosial Media Melalui Pemesanan Sosial Media Dengan Kode Pesanan : WEB-$order_id', '$date', '$time')");
			                if (mysqli_num_rows($check_top) == 0) {
				                $insert_topup = $conn->query("INSERT INTO top_users VALUES ('', 'Order', '$sess_username', '$harga', '1')");
			                } else {
				                $insert_topup = $conn->query("UPDATE top_users SET jumlah = ".$data_top['jumlah']."+$harga, total = ".$data_top['total']."+1 WHERE username = '$sess_username' AND method = 'Order'");
			                }
			                if (mysqli_num_rows($top_layanan) == 0) {
				                $insert_topup = $conn->query("INSERT INTO top_layanan VALUES ('', 'Layanan', '$layanan', '$harga', '1')");
			                } else {
				                $insert_topup = $conn->query("UPDATE top_layanan SET jumlah = ".$data_top['jumlah']."+$harga, total = ".$data_top['total']."+1 WHERE layanan = '$layanan' AND method = 'Layanan'");
			                }
    			            $jumlah = number_format($post_jumlah,0,',','.');
    			            $harga2 = number_format($harga,0,',','.');
    			            $_SESSION['hasil'] = array('alert' => 'success', 'pesan' => 'Sip, Pesanan Kamu Telah Kami Terima.');
				        } else {
					        $_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan.<script>swal("Ups Gagal!", "Sistem Kami Sedang Mengalami Gangguan.", "error");</script>');
				        }
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
		            <h3 class="kt-subheader__title">Pemesanan Baru</h3>
	                <div class="kt-subheader__breadcrumbs">
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Halaman Utama</a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Pemesanan Baru</a>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- End Sub Header -->

        <!-- Start Content -->
        <div class="kt-container kt-grid__item kt-grid__item--fluid">

        <!-- Start Page Orders Social Media -->
        <div class="row">
	        <div class="col-lg-7">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="flaticon2-shopping-cart text-primary"></i>
					            Pemesanan Sosial Media
					        </h3>
				        </div>
			        </div>
			        <div class="kt-portlet__body">
                    <?php
                    if (isset($_SESSION['hasil'])) {
                    ?>
                    <div class="alert alert-<?php echo $_SESSION['hasil']['alert'] ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION['hasil']['pesan'] ?>
                    </div>
                    <?php
                    unset($_SESSION['hasil']);
                    }
                    ?>
                        <form class="form-horizontal" method="POST">
	                        <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">   										    
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Kategori</label>
								<div class="col-lg-9 col-xl-6">
									<select class="form-control" id="kategori" name="kategori">
										<option value="0">Pilih Salah Satu</option>
										<?php
										$cek_kategori = $conn->query("SELECT * FROM kategori_layanan WHERE tipe = 'Sosial Media' ORDER BY nama ASC");
										while ($data_kategori = mysqli_fetch_assoc($cek_kategori)) {
										?>
										<option value="<?php echo $data_kategori['kode']; ?>"><?php echo $data_kategori['nama']; ?></option>
										<?php
										}
										?>
									</select>
									<span class="form-text text-muted"><?php echo ($error['kategori']) ? $error['kategori'] : '';?></span>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Layanan</label>
								<div class="col-lg-9 col-xl-6">
									<select class="form-control" name="layanan" id="layanan">
										<option value="0">Pilih Kategori Dahulu</option>
									</select>
									<span class="form-text text-muted"><?php echo ($error['layanan']) ? $error['layanan'] : '';?></span>
								</div>
							</div>
							<div id="catatan"></div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Tujuan</label>
								<div class="col-lg-9 col-xl-6">
									<input type="text" name="target" class="form-control" placeholder="Masukan Username / Link">
									<span class="form-text text-muted"><?php echo ($error['target']) ? $error['target'] : '';?></span>
								</div>
							</div>
							<div id="show1">
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
								<div class="col-lg-9 col-xl-6">
									<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" onkeyup="get_total(this.value).value;">
									<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
								</div>
							</div>
							<input type="hidden" id="rate" value="0">
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Total Harga</label>
								<div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
                                        <input type="number" class="form-control" id="total" placeholder="0" readonly>
                                    </div>
								</div>
							</div>
							</div>
							<div id="show2" style="display: none;">
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Komen</label>
								<div class="col-lg-9 col-xl-6">
									<textarea class="form-control" name="comments" id="comments" placeholder="Pisahkan Tiap Baris Komentar Dengan Enter"></textarea>
								</div>
							</div>
							<input type="hidden" id="rate" value="0">
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Total Harga</label>
								<div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
                                        <input type="number" class="form-control" id="totalxx" placeholder="0" readonly>
                                    </div>
								</div>
							</div>
							</div>
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
                                            <button type="submit" name="pesan" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Submit</button>
                                            <button type="reset" class="btn btn-danger btn-elevate btn-pill btn-elevate-air">Ulangi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</form>
					</div>
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
						<ul>
							<li>Pastikan Username / Link Data Yang Di Input Benar Dan Valid.</li>
							<li>Pastikan Akun Target Tidak Berstatus Private (@).</li>
							<li>Jangan Input Data Yang Sama Dengan Pesanan Sebelum Nya Apabila Pesanan Sebelum Nya Belum Berstatus Success.</li>
							<li>Apabila Pesanan Tidak Mengalami Perubahan Status, Silakan Hubungi Kontak Admin Untuk Di Selesaikan.</li>
                            <li>Harap Masukan Target Dengan Benar, Tidak Ada Pengembalian Dana Untuk Kesalahan Pengguna Yang Pesanannya Sudah Terlajur Di Pesan.</li>
                            <li>Jika Butuh Bantuan Silakan Hubungi Kontak Kami.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page New Orders Social Media -->

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
		    $("#kategori").change(function() {
			    var kategori = $("#kategori").val();
			    $.ajax({
			        url: '<?php echo $config['web']['url']; ?>ajax/service-sosmed.php',
			        data: 'kategori=' + kategori,
			        type: 'POST',
			        dataType: 'html',
			        success: function(msg) {
				        $("#layanan").html(msg);
			        }
		        });
	        });
		    $("#layanan").change(function() {
			    var layanan = $("#layanan").val();
			    $.ajax({
			        url: '<?php echo $config['web']['url']; ?>ajax/note-sosmed.php',
			        data: 'layanan=' + layanan,
			        type: 'POST',
			        dataType: 'html',
			        success: function(msg) {
				        $("#catatan").html(msg);
			        }
		        });
			    $.ajax({
			        url: '<?php echo $config['web']['url']; ?>ajax/price-sosmed.php',
			        data: 'layanan=' + layanan,
			        type: 'POST',
			        dataType: 'html',
			        success: function(msg) {
				        $("#rate").val(msg);
			        }
		        });
		    });
        });

document.getElementById("show1").style.display = "none";
    $("#layanan").change(function() {
		var selectedCountry = $("#layanan option:selected").text();
		if (selectedCountry.indexOf('Komen') !== -1 || selectedCountry.indexOf('komen') !== -1 || selectedCountry.indexOf('comment') !== -1 || selectedCountry.indexOf('Comment') !== -1) {
			document.getElementById("show1").style.display = "none";
			document.getElementById("show2").style.display = "block";
		} else {
		    document.getElementById("show1").style.display = "block";
			document.getElementById("show2").style.display = "none";
		}
	});
	 $(document).ready(function(){
            $("#comments").on("keypress", function(a){
                if(a.which == 13) {
                    var baris = $("#comments").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(baris)*rates;
                    console.log(calc)
                    $('#totalxx').val(calc);
                }
            });

        });
function get_total(quantity) {
	var rate = $("#rate").val();
	var result = eval(quantity) * rate;
	$('#total').val(result);
}
	</script>

<?php
	require ("../library/footer.php");
?>