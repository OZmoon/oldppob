<?php
session_start();
require '../config.php';
require '../library/database.php';

if (isset($_SESSION['user'])) {
    header("Location: ".$config['web']['url']);
} else {

?>

    <!DOCTYPE html>
    <html lang="id-ID" xml:lang="id-ID">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo $data['title']; ?></title>

            <!--Start Favicon-->
            <link rel="icon" href="<?php echo $config['web']['url'] ?>assets/media/logos/favicon.png" type="image/png">
            <!--End Favicon-->

            <!--Start Google Fonts-->
            <link  href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
            <!--End Google Fonts-->

            <!--Start Fonts Awesome-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
            <!--End Fonts Awesome-->

            <!--Custom Css-->
            <link rel="stylesheet" href="assets/css/scroll.css?v<?php echo $versi; ?>">
            <!--Custom Css-->

            <!--Start Bootstrap 4.1.3-->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css?v<?php echo $versi; ?>">
            <!--End Bootstrap 4.1.3-->

            <!--Start Animate Css-->
            <link rel="stylesheet" href="assets/css/plugins/animate.css?v<?php echo $versi; ?>">
            <!--End Animate Css-->

            <!--Start Slick Slider-->
            <link rel="stylesheet" href="assets/css/plugins/slick.css?v<?php echo $versi; ?>">
            <link rel="stylesheet" href="assets/css/plugins/slick-theme.css?v<?php echo $versi; ?>">
            <!--End Slick Slider-->

            <!--Start Magnific Popup-->
            <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css?v<?php echo $versi; ?>">
            <!--End Magnific Popup-->

            <!--Start Main Style-->
            <link rel="stylesheet" href="assets/css/main.css?v<?php echo $versi; ?>">
            <link rel="stylesheet" href="assets/css/custom.css?v<?php echo $versi; ?>">
            <!--End Main Style-->
        </head>

        <body>
            <!--Start Page Loading-->
            <div class="se-pre-con"></div>
            <!--End Page Loading-->

            <!--Start App-->
            <div id="app">

                <!--Start Navbar-->
                <header class="header-global">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                        <div class="container">
                            <a class="navbar-brand" href="/"><img src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelblack.png" style="height: 50px;" alt="<?php echo $data['short_title']; ?>"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#panel"><i class="fa fa-home"></i> Panel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#blog"><i class="fa fa-rss"></i> Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#aplikasi"><i class="fab fa-android"></i> Aplikasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#fitur"><i class="fa fa-star"></i> Fitur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="layanan" target="_blank" title="Produk dan Layanan <?php echo $data['short_title']; ?>" alt="Produk dan Layanan <?php echo $data['short_title']; ?>"><i class="fa fa-shopping-cart"></i> Layanan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#faqs"><i class="fa fa-question-circle"></i> Faqs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#kontak"><i class="fa fa-comments"></i> Kontak</a>
                                    </li>
                                </ul>
                                <a href="<?php echo $config['web']['url'] ?>KincaiPayment.apk" role="button" class="btn-1"><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>
                    </nav>
                </header>
                <!--End Navbar-->

                <!--Start panel-->
                <section class="slider d-flex align-items-center" id="panel">
                    <div class="container">
                        <div class="content">
                            <div class="row d-flex align-items-center">
                                <!--Left-->
                                <div class="col-md-6">
                                    <div class="left heading">
                                        <h1><?php echo $data['title']; ?></h1>
                                        <br/>
                                        <p class="lead wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                                            <i class="fa fa-check"></i> Penyedia Produk PPOB Terlengkap • Distributor Pulsa All Operator • Jasa Exchanger & E-Payment.
                                        </p>
                                        <p class="lead wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                                            <i class="fa fa-check"></i> Top Up Saldo E-Money Lokal & Global • Voucher Indodax • Games • Jasa Convert Pulsa Rate Tertinggi.
                                        </p>
                                        <p class="lead wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                                            <i class="fa fa-check"></i> Pusat Server Panel SMM Indonesia • Distributor Follower All Sosial Media • Jasa Youtube & Toko Online.
                                        </p>
                                        <ul class="list-inline list-unstyled header-links">
                                            <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                                                <i class="fa fa-list-ul"></i> Lihat <a href="../halaman/produk-dan-layanan" title="Layanan <?php echo $data['short_title']; ?>" alt="Layanan <?php echo $data['title']; ?>"><u> Produk & Layanan</u></a>.
                                                <br/><br/>
                                                <a href="<?php echo $config['web']['url'] ?>auth/login" class="btn-1"><i class="fa fa-sign-in-alt"></i> Masuk</a>
                                                <a href="<?php echo $config['web']['url'] ?>auth/register" class="btn-2"><i class="fa fa-user-plus"></i> Daftar</a>
                                            </li>
                                            <br/>
                                            <i class="fa fa-check-circle" style="color:#2196f3"></i> Powered by 401XD Group
                                        </ul>
                                    </div>
                                </div>
                                <!--Right-->
                                <div class="col-md-6">
                                    <div class="right">
                                        <img src="assets/img/landing/panel.png" alt="panel" class="img-fluid wow fadeInRight" data-wow-offset="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End panel-->

                <!--Start blog-->
                <section class="project" id="blog">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <!--Left-->
                            <div class="col-md-6">
                                <div class="left">
                                    <img src="assets/img/landing/blog.png" alt="blog" class="img-fluid wow fadeInLeft" data-wow-offset="1">
                                </div>
                            </div>
                            <!--Right-->
                            <div class="col-md-5">
                                <div class="right">
                                    <div class="heading text-center">
                                        <h2><i class="fa fa-rss"></i> Blog <?php echo $data['short_title']; ?></h2>
                                        <div class="line"></div>
                                        <p>
                                            <?php echo $data['deskripsi_web']; ?>
                                        </p>
                                    </div>
                                    <div id="postsexternal">
                                        <script type='text/javaScript'>
                                            var rcp_numposts=2;
                                            var rcp_snippet_length=150;
                                            var rcp_info='no';
                                            var rcp_comment='';
                                            var rcp_disable='T?t Nh?n xét';
                                            function recent_posts(json){var dw='';a=location.href;y=a.indexOf('?m=0');dw+='<ul>';for(var i=0;i<rcp_numposts;i++){var entry=json.feed.entry[i];var rcp_posttitle=entry.title.$t;if('content'in entry){var rcp_get_snippet=entry.content.$t}else{if('summary'in entry){var rcp_get_snippet=entry.summary.$t}else{var rcp_get_snippet="";}};rcp_get_snippet=rcp_get_snippet.replace(/<[^>]*>/g,"");if(rcp_get_snippet.length<rcp_snippet_length){var rcp_snippet=rcp_get_snippet}else{rcp_get_snippet=rcp_get_snippet.substring(0,rcp_snippet_length);var space=rcp_get_snippet.lastIndexOf(" ");rcp_snippet=rcp_get_snippet.substring(0,space)+"&#133;";};for(var j=0;j<entry.link.length;j++){if('thr$total'in entry){var rcp_commentsNum=entry.thr$total.$t+' '+rcp_comment}else{rcp_commentsNum=rcp_disable};if(entry.link[j].rel=='alternate'){var rcp_posturl=entry.link[j].href;if(y!=-1){rcp_posturl=rcp_posturl+'?m=0'}var rcp_postdate=entry.published.$t;if('media$thumbnail'in entry){var rcp_thumb=entry.media$thumbnail.url}else{rcp_thumb="https://kincaimedia.net/assets/images/kincaimedia/kincaimedia72.png"};}};dw+='<li>';dw+='<img alt="'+rcp_posttitle+'" src="'+rcp_thumb+'"/>';dw+='<div><a href="'+rcp_posturl+'" rel="dofollow">'+rcp_posttitle+'</a></div>';if(rcp_info=='yes'){dw+='<span>'+rcp_postdate.substring(8,10)+'/'+rcp_postdate.substring(5,7)+'/'+rcp_postdate.substring(0,4)+' - '+rcp_commentsNum+'</span>';};dw+='<div style="clear:both"></div></li>';};dw+='</ul>';document.getElementById('postsexternal').innerHTML=dw;};document.write('<script type=\"text/javascript\" src=\"https://blog.kincaimedia.net/feeds/posts/default/-/KM%20Panel?alt=json-in-script&max-results='+rcp_numposts+'&callback=recent_posts\"><\/script>');
                                        </script>
                                    </div>
                                    <br/>
                                    <div class="text-center">
                                        <a href="<?php echo $config['web']['url'] ?>auth/register" class="btn-1"><i class="fa fa-newspaper"></i> Artikel Lainnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End blog-->

                <!--Start aplikasi-->
                <section class="sliderapp d-flex align-items-center" id="aplikasi">
                    <div class="container text-center">
                        <div class="content">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="left">
                                        <div class="heading">
                                            <h2><i class="fab fa-android" style="color:#a4c639"></i> Aplikasi <?php echo $data['short_title']; ?></h2>
                                            <div class="line"></div>
                                        </div>
                                        <p>Selain menyediakan platform berbasis web, <?php echo $data['short_title']; ?> juga bisa di akses melalui aplikasi mobile dan tablet (Android & iOS).<br/><br/>Tersedia layanan Sosial Media Marketing All-In-One untuk optimasi Youtube, Facebook, Instagram, Twitter, Pinterest, Tiktok dan WhatsApp. Juga terdapat layanan toko online untuk Shopee, Tokopedia dan Bukalapak.<br/><br/>Tersedia berbagai Produk Digital dengan sistem PPOB untuk transaksi E-Money (Gojek, Grab, Dana, Ovo & Steam Wallet), Voucher All Games, Token PLN, Pulsa & Paket Internet All Operator Prabayar & Pascabayar, Paket Telepon & SMS, hingga Produk Operator Global.</p>
                                        <a href="<?php echo $config['web']['url'] ?>KincaiPayment.apk" class="btn-1"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                                <!--Right-->
                                <div class="col-md-6">
                                    <div class="right">
                                        <img src="assets/img/landing/aplikasi.png" alt="aplikasi" class="img-fluid wow fadeInRight" data-wow-offset="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End aplikasi-->

                <!--Start mulai-->
                <section class="features">
                    <div class="container text-center">
                        <div class="heading">
                            <h2><i class="fa fa-shopping-cart"></i> Langkah Memulai</h2>
                        </div>
                        <div class="line"></div>
                        <div class="row">
                            <!--Box-1-->
                            <div class="col-md-4">
                                <div class="box">
                                    <img src="assets/img/feature-1.png" alt="Mendaftar Akun <?php echo $data['short_title']; ?>">
                                    <h3>Mendaftar Akun</h3>
                                    <p>Pendaftaran hanya dengan mengisi data registrasi, kemudian verifikasi email, akun Anda segera aktif.</p>
                                </div>
                            </div>
                            <!--Box-2-->
                            <div class="col-md-4">
                                <div class="box">
                                    <img src="assets/img/feature-2.png" alt="Mengisi Saldo <?php echo $data['short_title']; ?>">
                                    <h3>Mengisi Saldo</h3>
                                    <p>Selanjutnya melakukan pengisian saldo agar dapat melakukan transaksi produk atau jasa yang disediakan.</p>
                                </div>
                            </div>
                            <!--Box-3-->
                            <div class="col-md-4">
                                <div class="box">
                                    <img src="assets/img/feature-3.png" alt="Melakukan Transaksi <?php echo $data['short_title']; ?>">
                                    <h3>Melakukan Transaksi</h3>
                                    <p>Setelah saldo masuk. Anda dapat melakukan transaksi dengan panduan lengkap di halaman order.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!--Start mulai-->

                <!--Start fitur-->
                <section class="benefits" id="fitur">
                    <div class="container text-center">
                        <div class="heading">
                            <h2><i class="fa fa-star"></i> Fitur <?php echo $data['short_title']; ?></h2>
                        </div>
                        <div class="line"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p>Platform bisnis yang menyediakan berbagai Layanan Multi Payment, Produk Digital PPOB, Saldo E-Money Lokal & Global, Voucher Games, Pulsa All Operator, Exchanger Voucher Indodax, Convert Pulsa, dan Jasa Pemasaran Sosial Media.</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <p>Anda dapat menjadi member, reseller atau agen berbagai jasa pembayaran yang terkoneksi PPOB, serta jasa optimasi media sosial dan toko online. Tersedia produk PPOB multi provider, e-money, voucher, pulsa, dan jasa exchanger.</p>
                            </div>
                            <!--BOX-1-->
                            <div class="col-md-4 col-sm-6">
                                <div class="box mb-30">
                                    <img src="assets/img/icons/security.png" width="80" alt="benefits">
                                    <h3>Keamanan Transaksi</h3>
                                    <p>Perlindungan keamanan adalah prioritas, kami menjamin privasi data dan transaksi divalidasi & disetujui pengguna sendiri.</p>

                                </div>
                            </div>
                            <!--BOX-2-->
                            <div class="col-md-4 col-sm-6">
                                <div class="box">
                                    <img src="assets/img/icons/rocket.png" width="80" alt="benefits">
                                    <h3>Sistem PPOB</h3>
                                    <p>Setiap pesanan di proses secara Otomatis dan Instan dengan PPOB, langsung pada Server utama kami tanpa penundaan.</p>

                                </div>
                            </div>
                            <!--BOX-3-->
                            <div class="col-md-4 col-sm-6">
                                <div class="box">
                                    <img src="assets/img/icons/device.png" width="80" alt="benefits">
                                    <h3>Mudah Digunakan</h3>
                                    <p>Transaksi dapat diakses cepat & responsive semua perangkat, tersedia App Mobile Android yang mudah digunakan.</p>
                                </div>
                            </div>
                            <!--BOX-4-->
                            <div class="col-md-4 col-sm-6">
                                <div class="box">
                                    <img src="assets/img/icons/bot.png" width="80" alt="benefits">
                                    <h3><?php echo $data['short_title']; ?> Otomatisasi</h3>
                                    <p>Fitur otomatisasi dengan AI diterapkan untuk mempopulerkan bisnis Anda di Sosial Media dan Toko Online di Marketplace.</p>
                                </div>
                            </div>
                            <!--BOX-5-->
                            <div class="col-md-4 col-sm-6">
                                <div class="box">
                                    <img src="assets/img/icons/code.png" width="80" alt="benefits">
                                    <h3>Terintegrasi API & H2H</h3>
                                    <p>Mendukung transaksi melalui Application Programming Interface (API). Sangat cocok untuk bisnis dengan sistem Host to Host (H2H).</p>
                                </div>
                            </div>
                            <!--BOX-6-->
                            <div class="col-md-4 col-sm-6">
                                <div class="box">
                                    <img src="assets/img/icons/money.png" width="80" alt="benefits">
                                    <h3>Metode Pembayaran</h3>
                                    <p>Kami mendukung berbagai metode pembayaran, mulai dari pulsa transfer, e-money, bank, e-payment, hingga cryptocurrency.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End fitur-->

                <!--Start pembayaran-->
                <section class="payments" id="pembayaran">
                    <div class="container text-center">
                        <div class="heading">
                            <h2><i class="fa fa-credit-card"></i> Dukungan Pembayaran</h2>
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="row">
                                        <!--Box-1-->
                                        <div class="col-md-4">
                                            <div class="box payment">
                                                <p><img src="assets/img/pembayaran/deposit-bank.png" alt="deposit" class="img-fluid"></p>
                                            </div>
                                        </div>
                                        <!--Box-2-->
                                        <div class="col-md-4">
                                            <div class="box payment">
                                                <p><img src="assets/img/pembayaran/deposit-emoney.png" alt="deposit" class="img-fluid"></p>
                                            </div>
                                        </div>
                                        <!--Box-3-->
                                        <div class="col-md-4">
                                            <div class="box payment">
                                                <p><img src="assets/img/pembayaran/deposit-epayment.png" alt="deposit" class="img-fluid"></p>
                                            </div>
                                        </div>
                                        <!--Box-4-->
                                        <div class="col-md-4">
                                            <div class="box payment">
                                                <p><img src="assets/img/pembayaran/deposit-pulsa.png" alt="deposit" class="img-fluid"></p>
                                            </div>
                                        </div>
                                        <!--Box-5-->
                                        <div class="col-md-4">
                                            <div class="box payment">
                                                <p><img src="assets/img/pembayaran/deposit-cryptocurrency.png" alt="deposit" class="img-fluid"></p>
                                            </div>
                                        </div>
                                        <!--Box-6-->
                                        <div class="col-md-4">
                                            <div class="box payment">
                                                <p><img src="assets/img/pembayaran/deposit-voucher.png" alt="deposit" class="img-fluid"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End pembayaran-->

                <!--Start faqs-->
                <section class="features" id="faqs">
                    <div class="container text-center">
                        <div class="heading">
                            <h2><i class="fa fa-question-circle"></i> Pertanyaan Umum</h2>
                        </div>
                        <div class="line"></div>
                        <div class="row">
                            <!--Box-1-->
                            <div class="col-md-4">
                                <div class="box faqs">
                                    <h3>Apa Itu <?php echo $data['short_title']; ?>?</h3>
                                    <p><?php echo $data['short_title']; ?> adalah penyedia layanan optimasi & otomatisasi digital berteknologi AI, berkualitas, cepat & aman. Kami berkomitmen mempopulerkan bisnis Anda di internet. Layanan unggulan kami dapat melakukan Optimasi Sosial Media & Toko Online, penyedia Produk Virtual Terkoneksi PPOB.</p>
                                </div>
                            </div>
                            <!--Box-2-->
                            <div class="col-md-4">
                                <div class="box faqs">
                                    <h3>Apa Kelebihan <?php echo $data['short_title']; ?>?</h3>
                                    <p>Dibanding jasa serupa lainnya, <?php echo $data['short_title']; ?> memberikan harga termurah, berteknologi AI tercepat, serta keamanan transaksi perbankan & PPOB yang terjamin. <?php echo $data['short_title']; ?> juga menyediakan edukasi bisnis dan panduan penggunaan sistem untuk Member, Agen, dan Reseller di <a href="https://blog.kincaimedia.net" title="Blog <?php echo $data['short_title']; ?>" alt="Blog <?php echo $data['short_title']; ?>">Website Portal Bisnis</a>.</p>
                                </div>
                            </div>
                            <!--Box-3-->
                            <div class="col-md-4">
                                <div class="box faqs">
                                    <h3>Bagaimana Cara Deposit?</h3>
                                    <p>Klik menu Isi Saldo, pilih metode deposit, pilih sistem konfirmasi (Otomatis/Manual), isi nominal deposit, klik submit. Lakukan pembayaran. Setelah transfer selesai klik konfirmasi di menu Tagihan. Metode "Otomatis" akan dikonfirmasi detik itu juga! Jika metode "Manual" dikonfirmasi paling lama 15 menit.</p>
                                </div>
                            </div>
                            <!--Box-4-->
                            <div class="col-md-4">
                                <div class="box faqs">
                                    <h3>Bagaimana Cara Order?</h3>
                                    <p>Klik Dasboard atau menu Order Baru, pilih Kategori dan Produk/Layanan, masukkan jumlah dan tujuan, lalu klik Order. Setelah itu akan muncul status order, Anda bisa melihat informasi pemesanan pada menu Riwayat Order.</p>
                                </div>
                            </div>
                            <!--Box-5-->
                            <div class="col-md-4">
                                <div class="box faqs">
                                    <h3>Bagaimana Kinerja Server?</h3>
                                    <p>Order sukses tercepat mulai 1 sampai 5 menit (jika sedang tidak melakukan sinkronisasi data), kami akan terus meningkatkan kinerja server agar lebih cepat lagi. Jika orderan pending, silakan menunggu paling lama 1x24 jam.</p>
                                </div>
                            </div>
                            <!--Box-6-->
                            <div class="col-md-4">
                                <div class="box faqs">
                                    <h3>Bagaimana Jika Order Stuck?</h3>
                                    <p>Jika lebih dari 1x24 jam orderan stuck, kami bisa membantu memproses secara manual. Ini biasanya karena server relasi sedang sinkronisasi data. Jika lebih dari 2x24 jam tetap stuck / tidak ada status, segera kirim Tiket.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!--Start faqs-->

                <!--Start teknologi-->
                <section class="some-facts" id="teknologi">
                    <div class="container text-center">
                        <div class="heading text-white">
                            <h2><i class="fa fa-server"></i> Dukungan Teknologi</h2>
                            <div class="line"></div>
                        </div>
                        <div class="row" style="place-content: center;place-items: center;">
                            <!--BOX-1-->
                            <div class="col-sm-1">
                                <div class="items">
                                    <img src="assets/img/teknologi/1.webp" alt="AI Technology">
                                </div>
                            </div>
                            <!--BOX-2-->
                            <div class="col-sm-1">
                                <div class="items">
                                    <img src="assets/img/teknologi/2.webp" alt="Cloudlinux">
                                </div>
                            </div>
                            <!--BOX-3-->
                            <div class="col-sm-1">
                                <div class="items">
                                    <img src="assets/img/teknologi/3.webp" alt="Intel">
                                </div>
                            </div>
                            <!--BOX-4-->
                            <div class="col-sm-1">
                                <div class="items">
                                    <img src="assets/img/teknologi/4.webp" alt="Cloudflare">
                                </div>
                            </div>
                            <!--BOX-5-->
                            <div class="col-sm-1">
                                <div class="items">
                                    <img src="assets/img/teknologi/5.webp" alt="Cpanel">
                                </div>
                            </div>
                            <!--BOX-6-->
                            <div class="col-sm-1">
                                <div class="items">
                                    <img src="assets/img/teknologi/6.webp" alt="Let's Encrypt">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End teknologi-->

                <?php
                $cek_kontak = $conn->query("SELECT * FROM kontak_website ORDER BY id DESC");
                while ($data_kontak = $cek_kontak->fetch_assoc()) {
                ?>
                <!--Start kontak-->
                <section class="contact" id="kontak">
                    <div class="container">
                        <div class="heading text-center">
                            <h2><i class="fa fa-comments"></i> Dukungan Pelanggan</h2>
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="title text-center">
                                    <h3><i class="fa fa-info-circle"></i> Informasi Kontak</h3>
                                    <p>Jangan ragu menghubungi kami melalui kontak dibawah ini</p>
                                </div>
                                <div class="content">
                                    <!--INFO-1-->
                                    <div class="info d-flex align-items-start">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <h4 class="d-inline-block">WHATSAPP :<br/>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo $data_kontak['no_wa']; ?>" target="_blank">
                                                <span><?php echo $data_kontak['no_wa']; ?></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <!--INFO-2-->
                                    <div class="info d-flex align-items-start">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <h4 class="d-inline-block">EMAIL :<br/>
                                            <a href="mailto:<?php echo $data_kontak['email']; ?>" target="_blank">
                                                <span><?php echo $data_kontak['email']; ?></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <!--INFO-3-->
                                    <div class="info d-flex align-items-start">
                                        <i class="fa fa-street-view" aria-hidden="true"></i>
                                        <h4 class="d-inline-block">ALAMAT :<br/>
                                            <span><?php echo $data_kontak['alamat']; ?> <?php echo $data_kontak['kode_pos']; ?></span>
                                        </h4>
                                    </div>
                                    <!--INFO-4-->
                                    <div class="info d-flex align-items-start">
                                        <i class="fa fa-street-view" aria-hidden="true"></i>
                                        <h4 class="d-inline-block">JAM KERJA :<br/>
                                            <span><?php echo $data_kontak['jam_kerja']; ?></span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="title text-center">
                                    <h3><i class="fa fa-map-marker"></i> Lokasi Perusahaan</h3>
                                    <p>Anda juga dapat menemui kami pada jam kerja di alamat dibawah ini</p>
                                </div>
                                <div class="content">
                                    <!--MAPS-->
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7974.337923485202!2d101.42365291714667!3d-2.0881201196206676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4604db0ec68cdc95!2sKincai%20Media%20Indonesia!5e0!3m2!1sid!2sid!4v1621521298053!5m2!1sid!2sid" width="100%" height="280" style="border:5px solid #F5F5F5;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End kontak-->
                <?php
                }
                ?>

            </div>
            <!--End App-->

            <!--Start Footer-->
            <footer class="footer">
                <div class="container text-center">
                    <img src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelwhite.png" style="width: auto; height: 70px;">
                    <p><a href="/halaman/tentang-kami" alt="Tentang Kami" title="Tentang Kami">About</a> • <a href="/halaman/dukungan-teknologi" alt="Dukungan Teknologi" title="Dukungan Teknologi">Technology</a> • <a href="/halaman/dukungan-pembayaran" alt="Dukungan Pembayaran" title="Dukungan Pembayaran">Payment</a> • <a href="/halaman/platform-aplikasi" alt="Platform Aplikasi" title="Platform Aplikasi">Platform</a> • <a href="/halaman/mitra-dan-jaringan" alt="Mitra dan Jaringan" title="Mitra dan Jaringan">Partner</a> • <a href="/halaman/ketentuan-layanan" alt="Ketentuan Layanan" title="Ketentuan Layanan">Terms</a> • <a href="/halaman/pertanyaan-umum" alt="Pertanyaan Umum" title="Pertanyaan Umum">FAQs</a></p>
                    <p>Copyright &copy;2017-<?php echo date("Y")?> <a href="http://www.401xd.com" rel="dofollow" alt="401XD Group Indonesia" title="401XD Group Indonesia"> 401XD Group</a></p> 
                </div>
            </footer>
            <!--End Footer-->

            <!--Start Java Script-->
            <script src="assets/js/plugins/jquery-3.3.1.min.js"></script>
            <!--End Java Script-->

            <!--Start Bootstrap 4.1.3-->
            <script src="assets/js/plugins/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <!--End Bootstrap 4.1.3-->

            <!--Start Slick Slider-->
            <script src="assets/js/plugins/slick.min.js"></script>
            <!--End Slick Slider-->

            <!--Start Couner Up-->
            <script src="assets/js/plugins/jquery.waypoints.min.js"></script>
            <script src="assets/js/plugins/jquery.counterup.min.js"></script>
            <!--End Couner Up-->

            <!--Start Wow JS-->
            <script src="assets/js/plugins/wow.min.js"></script>
            <!--End Wow JS-->

            <!--Start Magnific Popup-->
            <script src="assets/js/plugins/magnific-popup.min.js"></script>
            <!--End Magnific Popup-->

            <!--Start Main Js-->
            <script src="assets/js/main.js"></script>
            <!--End Main Js-->

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
    </html>

<?php } ?>