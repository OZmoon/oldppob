<?php
require '../config.php';
require '../library/database.php';
?>

<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $data['short_title']; ?></title>

    <!-- Start Favicon -->
    <link rel="icon" href="<?php echo $config['web']['url'] ?>assets/media/logos/favicon.png" type="image/png">
    <!-- End Favicon -->

    <!-- Start Google Fonts -->
    <link  href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <!-- End Google Fonts -->

    <!-- Start Fonts Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <!-- End Fonts Awesome -->

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/scroll.css?v<?php echo $versi; ?>">
    <!-- Custom Css -->

    <!-- Start Bootstrap 4.1.3 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v<?php echo $versi; ?>">
    <!-- End Bootstrap 4.1.3 -->

    <!-- Start Animate Css -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css?v<?php echo $versi; ?>">
    <!-- End Animate Css -->

    <!-- Start Slick Slider -->
    <link rel="stylesheet" href="assets/css/plugins/slick.css?v<?php echo $versi; ?>">
    <link rel="stylesheet" href="assets/css/plugins/slick-theme.css?v<?php echo $versi; ?>">
    <!-- End Slick Slider -->

    <!-- Start Magnific Popup -->
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css?v<?php echo $versi; ?>">
    <!-- End Magnific Popup -->

    <!-- Start Main Style -->
    <link rel="stylesheet" href="assets/css/main.css?v<?php echo $versi; ?>">
    <link rel="stylesheet" href="assets/css/custom.css?v<?php echo $versi; ?>">
    <!-- End Main Style -->
</head>

<body>
    <!-- Start Page Loading -->
    <div class="se-pre-con"></div>
    <!-- End Page Loading -->

    <!-- Start App -->
    <div id="app">

        <!-- Start Navbar -->
        <header class="header-global">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="/"><img src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelblack.png" style="height: 50px; width: auto;" alt="<?php echo $data['short_title']; ?>"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#panel">Panel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#blog">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#aplikasi">Aplikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#fitur">Fitur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#layanan">Layanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#faqs">Faqs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panel/#kontak">Kontak</a>
                            </li>
                        </ul>
                        <a href="<?php echo $config['web']['url'] ?>KincaiPayment.apk" role="button" class="btn-1">Download</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- End Navbar -->

        <!-- Start layanan -->
        <section class="features" style="padding-top:120px;">
            <div class="container">
                <div class="heading text-center">
                    <h2>Produk dan Layanan <?php echo $data['short_title']; ?></h2>
                    <div class="line"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <h3 class="m-t-0 header-title text-center"><b>PPOB & E-Payments</b></h3>
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <select class="form-control" id="tipe" name="tipe">
                                            <option value="">Pilih Salah Satu</option>
                                            <option value="Pulsa">Pulsa</option>
                                            <option value="E-Money">E-Money</option>
                                            <option value="Data">Data</option>
                                            <option value="Paket SMS & Telpon">Paket SMS & Telpon</option>
                                            <option value="Games">Games</option>
                                            <option value="PLN">PLN</option>
                                            <option value="Pulsa Internasional">Pulsa Internasional</option>
                                            <option value="Voucher">Voucher</option>
                                            <option value="WIFI ID">WIFI ID</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" id="operator" name="operator">
                                            <option value="0">Pilih Tipe Dahulu</option>
                                        </select>
                                    </div>
                                </form>
                            <div id="layanan_top_up"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="box">
                            <h3 class="m-t-0 header-title text-center"><b>Jasa Sosial Media</b></h3>
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label>Kategori</label>
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
                                    </div>
                                </form>
                            <div id="layanan"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End layanan -->

    </div>
    <!-- End App -->

    <!-- Start Footer -->
    <footer class="footer">
        <div class="container text-center">
            <img src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelwhite.png" style="width: auto; height: 70px;">
            <p><a href="/halaman/tentang-kami" alt="Tentang Kami" title="Tentang Kami">About</a> • <a href="/halaman/dukungan-teknologi" alt="Dukungan Teknologi" title="Dukungan Teknologi">Technology</a> • <a href="/halaman/dukungan-pembayaran" alt="Dukungan Pembayaran" title="Dukungan Pembayaran">Payment</a> • <a href="/halaman/platform-aplikasi" alt="Platform Aplikasi" title="Platform Aplikasi">Platform</a> • <a href="/halaman/mitra-dan-jaringan" alt="Mitra dan Jaringan" title="Mitra dan Jaringan">Partner</a> • <a href="/halaman/ketentuan-layanan" alt="Ketentuan Layanan" title="Ketentuan Layanan">Terms</a> • <a href="/halaman/pertanyaan-umum" alt="Pertanyaan Umum" title="Pertanyaan Umum">FAQs</a></p>
            <p>Copyright &copy;2017-<?php echo date("Y")?> <a href="http://www.401xd.com" rel="dofollow" alt="401XD Group Indonesia" title="401XD Group Indonesia"> 401XD Group</a></p> 
        </div>
    </footer>
    <!-- End Footer -->

    <!--Call Layanan Sosmed-->
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#kategori").change(function() {
            var kategori = $("#kategori").val();
            $.ajax({
                url: '<?php echo $config['web']['url']; ?>ajax/list-service-sosmed.php',
                data: 'kategori=' + kategori,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#layanan").html(msg);
                }
            });
        });
    });
    </script>

    <!--Call Produk PPOB-->
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#tipe").change(function() {
            var tipe = $("#tipe").val();
            $.ajax({
                url: '<?php echo $config['web']['url']; ?>ajax/type-top-up.php',
                data: 'tipe=' + tipe,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#operator").html(msg);
                }
            });
        });
        $("#operator").change(function() {
            var tipe = $("#tipe").val();
            var operator = $("#operator").val();
            $.ajax({
                url: '<?php echo $config['web']['url']; ?>ajax/list-service-top-up.php',
                data  : 'tipe=' +tipe + '&operator=' + operator,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#layanan_top_up").html(msg);
                }
            });
        });
    });
    </script>

    <!-- Start Datatables for Section layanan-->
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/plugins/dataTables.buttons.min.js"></script>
    <script src="assets/js/plugins/dataTables.responsive.min.js"></script>
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <!-- End Datatables for Section layanan-->

    <!-- Start Java Script -->
    <script src="assets/js/plugins/jquery-3.3.1.min.js"></script>
    <!-- End Java Script -->

    <!-- Start Bootstrap 4.1.3 -->
    <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- End Bootstrap 4.1.3 -->

    <!-- Start Slick Slider -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- End Slick Slider -->

    <!-- Start Couner Up -->
    <script src="assets/js/plugins/jquery.waypoints.min.js"></script>
    <script src="assets/js/plugins/jquery.counterup.min.js"></script>
    <!-- End Couner Up -->

    <!-- Start Wow JS -->
    <script src="assets/js/plugins/wow.min.js"></script>
    <!-- End Wow JS -->

    <!-- Start Magnific Popup -->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!-- End Magnific Popup -->

    <!-- Start Main Js -->
    <script src="assets/js/main.js"></script>
    <!-- End Main Js -->

    <!--Scroll Indicator Load-->
    <div class="progress-container-custom">
        <div class="progress-bar-custom" id="progressbarcustom"></div>
    </div>
    <script type='text/javascript'>
        //<![CDATA[
            window.addEventListener("scroll", myFunction);
            function myFunction() {
                var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var scrolled = (winScroll / height) * 100;
                document.getElementById("progressbarcustom").style.width = scrolled + "%";
            }
        //]]>
    </script>

    <!--Nofollow-->
    <script type="text/javascript">
        //<![CDATA[
            $("a").filter(function() {
                return this.hostname && this.hostname !== location.hostname
            }).attr("rel", "nofollow noopener").attr("target", "_blank");
        //]]>
    </script>

</body>