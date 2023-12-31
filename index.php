<?php 
session_start();
require("config.php");

if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
    $check_user = $conn->query("SELECT * FROM users WHERE username = '$sess_username'");
    $data_user = $check_user->fetch_assoc();
    $check_username = $check_user->num_rows;
    if ($check_username == 0) {
       header("Location: ".$config['web']['url']."logout");
   } else if ($data_user['status'] == "Tidak Aktif") {
       header("Location: ".$config['web']['url']."logout");
   }

    // Data Grafik Pesanan Sosial Media
   $check_order_today = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='($date)' and user = '$sess_username'");

   $oneday_ago = date('Y-m-d', strtotime("-1 day"));
   $check_order_oneday_ago = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='$oneday_ago' and user = '$sess_username'");

   $twodays_ago = date('Y-m-d', strtotime("-2 day"));
   $check_order_twodays_ago = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='$twodays_ago' and user = '$sess_username'");

   $threedays_ago = date('Y-m-d', strtotime("-3 day"));
   $check_order_threedays_ago = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='$threedays_ago' and user = '$sess_username'");

   $fourdays_ago = date('Y-m-d', strtotime("-4 day"));
   $check_order_fourdays_ago = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='$fourdays_ago' and user = '$sess_username'");

   $fivedays_ago = date('Y-m-d', strtotime("-5 day"));
   $check_order_fivedays_ago = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='$fivedays_ago' and user = '$sess_username'");

   $sixdays_ago = date('Y-m-d', strtotime("-6 day"));
   $check_order_sixdays_ago = $conn->query("SELECT * FROM pembelian_sosmed WHERE date ='$sixdays_ago' and user = '$sess_username'");   

    // Data Grafik Pesanan Top Up
   $check_order_pulsa_today = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$date' and user = '$sess_username'");

   $oneday_ago = date('Y-m-d', strtotime("-1 day"));
   $check_order_pulsa_oneday_ago = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$oneday_ago' and user = '$sess_username'");

   $twodays_ago = date('Y-m-d', strtotime("-2 day"));
   $check_order_pulsa_twodays_ago = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$twodays_ago' and user = '$sess_username'");

   $threedays_ago = date('Y-m-d', strtotime("-3 day"));
   $check_order_pulsa_threedays_ago = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$threedays_ago' and user = '$sess_username'");

   $fourdays_ago = date('Y-m-d', strtotime("-4 day"));
   $check_order_pulsa_fourdays_ago = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$fourdays_ago' and user = '$sess_username'");

   $fivedays_ago = date('Y-m-d', strtotime("-5 day"));
   $check_order_pulsa_fivedays_ago = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$fivedays_ago' and user = '$sess_username'");

   $sixdays_ago = date('Y-m-d', strtotime("-6 day"));
   $check_order_pulsa_sixdays_ago = $conn->query("SELECT * FROM pembelian_pulsa WHERE date ='$sixdays_ago' and user = '$sess_username'");

        // Data Grafik Pesanan Pascabayar
   $check_order_pascabayar_today = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$date' and user = '$sess_username'");

   $oneday_ago = date('Y-m-d', strtotime("-1 day"));
   $check_order_pascabayar_oneday_ago = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$oneday_ago' and user = '$sess_username'");

   $twodays_ago = date('Y-m-d', strtotime("-2 day"));
   $check_order_pascabayar_twodays_ago = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$twodays_ago' and user = '$sess_username'");

   $threedays_ago = date('Y-m-d', strtotime("-3 day"));
   $check_order_pascabayar_threedays_ago = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$threedays_ago' and user = '$sess_username'");

   $fourdays_ago = date('Y-m-d', strtotime("-4 day"));
   $check_order_pascabayar_fourdays_ago = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$fourdays_ago' and user = '$sess_username'");

   $fivedays_ago = date('Y-m-d', strtotime("-5 day"));
   $check_order_pascabayar_fivedays_ago = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$fivedays_ago' and user = '$sess_username'");

   $sixdays_ago = date('Y-m-d', strtotime("-6 day"));
   $check_order_pascabayar_sixdays_ago = $conn->query("SELECT * FROM pembelian_pascabayar WHERE date ='$sixdays_ago' and user = '$sess_username'");

} else {
    exit(header("Location: ".$config['web']['url']."panel"));
}

include("library/header.php");
if (isset($_SESSION['user'])) {
?>

    <!-- Start Sub Header -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container">
        <div class="kt-subheader__main">
          <h3 class="kt-subheader__title">Beranda</h3>
          <div class="kt-subheader__breadcrumbs">
            <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Beranda</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Start Table Icon Box -->
    <div class="kt-container">
      <div class="row">
        <div class="col-lg-12">
          <div style="border-radius:20px;" class="btn btn-light btn-hover-light col-lg-12">
            <a href="<?php echo $config['web']['url'] ?>deposit">
              <table class="table mb-0">
                <tbody>
                  <tr>
                    <td>
                      <div class="kt-iconbox__desc">
                        <h5 class="kt-iconbox__title">
                          <img src="<?php echo $config['web']['url'] ?>assets/media/icon/balance-top-up.svg" width="20px"> Rp <?php echo number_format($data_user['saldo_sosmed'],0,',','.'); ?>
                        </h5>
                        <div class="kt-iconbox__content">
                         Sosmed
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="kt-iconbox__desc">
                        <h5 class="kt-iconbox__title">
                          <img src="<?php echo $config['web']['url'] ?>assets/media/icon/balance-top-up.svg" width="20px"> Rp <?php echo number_format($data_user['saldo_top_up'],0,',','.'); ?>
                        </h5>
                        <div class="kt-iconbox__content">
                         Top Up
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Table Icon Box -->

    <br/>

    <!-- Start Table Icon Box -->
    <div class="kt-container">
      <div class="row">
        <div class="col-lg-12">
          <div style="border-radius:20px;" class="btn btn-light btn-hover-light col-lg-12">
            <a href="<?php echo $config['web']['url'] ?>page/withdraw-coin-to-balance">
              <table class="table mb-0">
                <tbody>
                  <tr>
                    <td>
                      <div class="kt-iconbox__desc">
                        <h5 class="kt-iconbox__title">
                          <img src="<?php echo $config['web']['url'] ?>assets/media/icon/coins.svg" width="20px"> <?php echo number_format($data_user['koin'],0,',','.'); ?>
                        </h5>
                        <div class="kt-iconbox__content">
                          <a href="<?php echo $config['web']['url'] ?>page/withdraw-coin-to-balance" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle"></i> Tukar Koin</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Table Icon Box -->

    <br/>

    <!-- Start Card Box Order -->
    <div class="kt-container">
      <div class="product-catagory-wrap">
        <div style="border-radius: 4px;" class="kt-portlet">
          <div style="border-radius: 4px;" class="kt-portlet__body shadow">
            <div class="row">    
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/social-media"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/sosmed.png"><span>Sosmed</span></a>
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/pulsa-reguler"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/pulsa.png"><span>Pulsa</span></a>
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/saldo-emoney"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/e-money.png"><span>E-Wallet</span></a>
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/paket-data-internet"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/internet.png"><span>Paket Data</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/paket-sms-telepon"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/phone-sms.png"><span>Telpon & SMS</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/voucher-game"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/voucher-game.png"><span>Voucher Game</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/pln-pascabayar"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/pascabayar.png"><span>Pasca-bayar</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/token-pln"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/token-listrik.png"><span>Token Listrik</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/pulsa-internasional"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/pulsa-internasional.png"><span>Pulsa Inter</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/wifi-id"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/wifi-id.png"><span>Wifi ID</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/voucher"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/voucher.png"><span>Voucher</span></a>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card mb-3 catagory-card border-0">
                  <div class="card-body">
                    <a href="<?php echo $config['web']['url'] ?>order/playstore"><img src="<?php echo $config['web']['url'] ?>assets/media/icon-pay/streaming.png"><span>Google Play</span></a>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
    <!-- End Card Box Order -->

    <!-- Start Referral -->
    <div class="kt-container">
      <div class="cta-area">
        <div class="cta-text px-4 py-5" style="background-image: url(<?php echo $config['web']['url'] ?>assets/media/bg/bg-3.jpg)">
          <h4>Dapatkan Koin Gratis!</h4>
          <p>Syarat Nya Mudah Banget <br>Ajak Temen Atau Keluarga Untuk Mendaftar Disini Dengan Kode Referral Kamu.</p><a class="btn btn-warning" href="<?php echo $config['web']['url'] ?>page/program-referral"><i class="fa fa-eye"></i> Cek Disini</a>
        </div>
      </div>
    </div>
    <!-- End Referral -->

    <br/>

    <!-- Start Content -->
    <div class="kt-container kt-grid__item kt-grid__item--fluid">

    <!-- Start Sub Icon Box -->
    <div class="row">
      <div class="col-lg-12">
        <div class="kt-portlet">
          <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-widget28" class="h-75 d-inline-block">
              <div class="kt-widget28__visual" style="background-image: url(<?php echo $config['web']['url'] ?>assets/media/bg/bg-3.jpg)" class="rounded"></div>
              <div class="kt-widget28__wrapper kt-portlet__space-x">
               <ul class="nav nav-pills nav-fill kt-portlet__space-x" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link active" href="<?php echo $config['web']['url'] ?>deposit"><span><img src="<?php echo $config['web']['url'] ?>assets/media/icon/top-up.svg" width="50px"></span></span>Deposit</span></a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link active" href="<?php echo $config['web']['url'] ?>history/order"><span><img src="<?php echo $config['web']['url'] ?>assets/media/icon/shopping-cart.svg" width="50px"></span><span>Pesanan</span></a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link active" href="<?php echo $config['web']['url'] ?>history/balance-coins"><span><img src="<?php echo $config['web']['url'] ?>assets/media/icon/coupon.svg" width="50px"></span><span>History</span></a>
                 </li>		                 
               </ul>
            </div>				 	 
          </div>
        </div>
      </div>
    </div>

    <!-- Start Grafik -->
    <div class="col-lg-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <i class="flaticon-graph text-primary"></i>
                Grafik Pesanan 7 Hari Terakhir
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="chart" id="line-chart" style="height: 300px;"></div>
          <script>
            $(function () {
                "use strict";
                var line = new Morris.Line({
                    element: 'line-chart',
                    resize: true,
                    data: [
                        {w: '<?php echo $date; ?>', x: <?php echo mysqli_num_rows($check_order_today); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_today); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_today); ?>},
                        {w: '<?php echo $oneday_ago; ?>', x: <?php echo mysqli_num_rows($check_order_oneday_ago); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_oneday_ago); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_oneday_ago); ?>},
                        {w: '<?php echo $twodays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_twodays_ago); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_twodays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_twodays_ago); ?>},
                        {w: '<?php echo $threedays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_threedays_ago); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_threedays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_threedays_ago); ?>},
                        {w: '<?php echo $fourdays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_fourdays_ago); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_fourdays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_fourdays_ago); ?>},
                        {w: '<?php echo $fivedays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_fivedays_ago); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_fivedays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_fivedays_ago); ?>},
                        {w: '<?php echo $sixdays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_sixdays_ago); ?>, y: <?php echo mysqli_num_rows($check_order_pulsa_sixdays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_pascabayar_sixdays_ago); ?>}
                    ],
                    xkey: 'w',
                    ykeys: ['x','y','z'],
                    labels: ['Pesanan Sosial Media','Pesanan Top Up','Pesanan Pascabayar'],
                    lineColors: ['#f35864','#1576c2','FFFF00'],
                    hideHover: 'auto'
                });
            });
          </script>
        </div>
      </div>
    </div>

    <!-- Start News -->
    <div class="col-lg-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    <i class="flaticon2-bell text-primary"></i>
                    Berita & Informasi
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
          <div class="kt-notes">
              <div class="kt-notes__items">
                <?php
                $cek_berita = $conn->query("SELECT * FROM berita ORDER BY id DESC LIMIT 5");
                while ($data_berita = $cek_berita->fetch_assoc()) {
                $beritastr = "-".strlen($data_berita['konten']);
                $beritasensor = substr($data_berita['konten'],$slider_beritastr,+100);
                if ($data_berita['tipe'] == "INFO") {
                    $label = "info";
                } else if ($data_berita['tipe'] == "PERINGATAN") {
                    $label = "warning";
                } else if ($data_berita['tipe'] == "PENTING") {
                    $label = "danger";
                }

                if ($data_berita['icon'] == "PESANAN") {
                    $label_icon = "flaticon2-shopping-cart";
                } else if ($data_berita['icon'] == "LAYANAN") {
                    $label_icon = "flaticon-signs-1";
                } else if ($data_berita['icon'] == "DEPOSIT") {
                    $label_icon = "flaticon-coins";
                } else if ($data_berita['icon'] == "PENGGUNA") {
                    $label_icon = "flaticon2-user";
                } else if ($data_berita['icon'] == "PROMO") {
                    $label_icon = "flaticon2-percentage";
                }
                ?>
                <div class="kt-notes__item">
                  <div class="kt-notes__media">
                      <span class="kt-notes__icon">
                          <i class="<?php echo $label_icon; ?> text-primary"></i>
                      </span>
                  </div>
                  <div class="kt-notes__content"> 
                      <div class="kt-notes__section">
                          <div class="kt-notes__info">
                              <a href="<?php echo $config['web']['url'] ?>page/news-details?id=<?php echo $data_berita['id']; ?>" class="kt-notes__title">
                                  <?php echo $data_berita['title']; ?>
                              </a>
                              <span class="kt-notes__desc">
                                  (<?php echo tanggal_indo($data_berita['date']); ?>)
                              </span>
                              <span class="kt-badge kt-badge--<?php echo $label; ?> kt-badge--inline"><?php echo $data_berita['tipe']; ?></span>
                          </div>
                      <div class="kt-subheader__wrapper" data-toggle="kt-tooltip" title="" data-original-title="Mau Lihat?">
                          <a href="<?php echo $config['web']['url'] ?>page/news-details?id=<?php echo $data_berita['id']; ?>" class="btn btn-sm btn-icon-md btn-icon">
                          <i class="flaticon-eye"></i>
                          </a>
                      </div>
                  </div>
                  <span class="kt-notes__body">
                      <?php echo nl2br ($beritasensor."....."); ?>
                  </span>  
                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
        <a href="<?php echo $config['web']['url'] ?>page/news" class="btn btn-sm btn-primary text-center"><i class="flaticon-visible"></i> Lihat Semua...</a>
        </div>
      </div>
    </div>
    <!-- End News -->

    <!-- Start Modal Content -->
    <?php 
    if ($data_user['read_news'] == 0) {
    ?>
    <div class="modal fade show" id="news" tabindex="-1" role="dialog" aria-labelledby="NewsInfo" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title mt-0" id="NewsInfo"><b><i class="flaticon2-bell text-primary"></i>  Berita & Informasi</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow: auto;">
                <?php
                $cek_berita = $conn->query("SELECT * FROM berita ORDER BY id DESC LIMIT 5");
                while ($data_berita = $cek_berita->fetch_assoc()) {
                if ($data_berita['tipe'] == "INFO") {
                    $label = "info";
                } else if ($data_berita['tipe'] == "PERINGATAN") {
                    $label = "warning";
                } else if ($data_berita['tipe'] == "PENTING") {
                    $label = "danger";    
                }
                ?>  
                <div class="alert alert-warning">
                    <div class="alert-text">
                        <p><span class="float-right text-muted"><?php echo tanggal_indo($data_berita['date']); ?>, <?php echo $data_berita['time']; ?></span></p>
                        <h5 class="inbox-item-author mt-0 mb-1"><?php echo $data_berita['title']; ?></h5>
                        <h5><span class="badge badge-<?php echo $label; ?>"><?php echo $data_berita['tipe']; ?></span></h5>
                        <?php echo nl2br($data_berita['konten']); ?>
                    </div>
                </div>
                <?php } ?>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="read_news()"><i class="flaticon2-check-mark"></i> Saya Sudah Membaca</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- End Modal Content-->

  </div>
  <!-- End Page -->
      
</div>
<!-- End Content -->

<!-- Start Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
  <i class="fa fa-arrow-up"></i>
</div>
<!-- End Scrolltop -->

<?php 
}
require 'library/footer.php';
?>