<?php
require 'session_login.php';
require 'database.php';
require 'csrf_token.php';
?>

<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title><?php echo $data['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="<?php echo $data['deskripsi_web']; ?>" name="description" />
    <meta content="RAP Code" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Start Favicon Icon -->
    <link rel="shortcut icon" href="<?php echo $config['web']['url'] ?>assets/media/logos/favicon.png" />
    <!-- End Favicon Icon -->

    <!-- Start CSS -->
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/support-center/home-2.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/voucher/voucher-1.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/pricing/pricing-3.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/invoices/invoice-1.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/invoices/invoice-2.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/wizard/wizard-4.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/pages/support-center/faq-2.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/plugins/global/plugins.bundle.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/style.bundle.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $config['web']['url'] ?>assets/css/style.css?v<?php echo $versi; ?>" rel="stylesheet" type="text/css" />
    <!-- End CSS -->
    
    <!-- Start Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!-- End Fonts -->

    <!-- Start Script JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- End Script JS -->

    <!-- Start Script Morris Chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- End Script Morris Chart -->

</head>

<?php
if (isset($_SESSION['user'])) {
?>

<!-- Start Body -->
<body style="background-image: url(<?php echo $config['web']['url'] ?>assets/media/bg/bg-2.png); background-position: center top; background-size: 100% 350px;"  class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

    <!-- Start Page -->

    <!-- Start Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed">
        <div class="kt-header-mobile__logo">
	        <a href="<?php echo $config['web']['url'] ?>">
		           <img alt="<?php echo $data['short_title']; ?>" src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelblack.png" style="width: auto; height: 50px;"/>
	        </a>
        </div>
        <div class="kt-header-mobile__toolbar">
	        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
	        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
        </div>
    </div>
    <!-- End Header Mobile -->

    <!-- Start Body Content -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            
	        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- Start Header -->
                <div id="kt_header" class="kt-header  kt-header--fixed" data-ktheader-minimize="on">
        	        <div class="kt-container">

                        <!-- Start Brand -->
                        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                	        <a class="kt-header__brand-logo" href="<?php echo $config['web']['url'] ?>">
                		        <img alt="<?php echo $data['short_title']; ?>" src="<?php echo $config['web']['url'] ?>assets/media/logos/webkmpanelwhite.png" class="kt-header__brand-logo-default"/>
                		        <img alt="<?php echo $data['short_title']; ?>" src="<?php echo $config['web']['url'] ?>assets/media/logos/logo.png" class="kt-header__brand-logo-sticky"/>
                	        </a>		
                        </div>
                        <!-- End Brand -->

                        <!-- Start Header Menu -->
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

                        <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile">
                                <ul class="kt-menu__nav">
                                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="<?php echo $config['web']['url'] ?>" class="kt-menu__link"><span class="kt-menu__link-text">Beranda</span>
                                        </a>
                                    </li>
                                    <?php
                                    if ($data_user['level'] == "Developers") {
                                    ?>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="<?php echo $config['web']['url'] ?>admin" class="kt-menu__link"><span class="kt-menu__link-text">Admin</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-text">Staff  &nbsp;<i class="fa fa-angle-down"></i></span>
                                        </a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a  href="<?php echo $config['web']['url'] ?>staff/code-invitation-new" class="kt-menu__link">
                                                        <span class="kt-menu__link-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <polygon fill="#000000" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                                                                    <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" fill="#000000" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span class="kt-menu__link-text">Tambah Member</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a  href="<?php echo $config['web']['url'] ?>staff/transfer-balance" class="kt-menu__link">
                                                        <span class="kt-menu__link-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M21.4451171,17.7910156 C21.4451171,16.9707031 21.6208984,13.7333984 19.0671874,11.1650391 C17.3484374,9.43652344 14.7761718,9.13671875 11.6999999,9 L11.6999999,4.69307548 C11.6999999,4.27886191 11.3642135,3.94307548 10.9499999,3.94307548 C10.7636897,3.94307548 10.584049,4.01242035 10.4460626,4.13760526 L3.30599678,10.6152626 C2.99921905,10.8935795 2.976147,11.3678924 3.2544639,11.6746702 C3.26907199,11.6907721 3.28437331,11.7062312 3.30032452,11.7210037 L10.4403903,18.333467 C10.7442966,18.6149166 11.2188212,18.596712 11.5002708,18.2928057 C11.628669,18.1541628 11.6999999,17.9721616 11.6999999,17.7831961 L11.6999999,13.5 C13.6531249,13.5537109 15.0443703,13.6779456 16.3083984,14.0800781 C18.1284272,14.6590944 19.5349747,16.3018455 20.5280411,19.0083314 L20.5280247,19.0083374 C20.6363903,19.3036749 20.9175496,19.5 21.2321404,19.5 L21.4499999,19.5 C21.4499999,19.0068359 21.4451171,18.2255859 21.4451171,17.7910156 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.254964, 11.721538) scale(-1, 1) translate(-12.254964, -11.721538) "/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span class="kt-menu__link-text">Transfer Saldo</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="<?php echo $config['web']['url'] ?>page/user-ranking" class="kt-menu__link"><span class="kt-menu__link-text">Peringkat</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="<?php echo $config['web']['url'] ?>page/help" class="kt-menu__link"><span class="kt-menu__link-text">Bantuan</span>&nbsp;&nbsp;<?php if (mysqli_num_rows($CallDBTiket) !== 0) { ?><span class="badge badge-primary"><?php echo mysqli_num_rows($CallDBTiket); ?></span><?php } ?>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                           <span class="kt-menu__link-text">Harga &nbsp;<i class="fa fa-angle-down"></i></span>
                                        </a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                <a  href="<?php echo $config['web']['url'] ?>price/social-media" class="kt-menu__link">
                                                    <span class="kt-menu__link-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                                <path d="M3.52270623,14.028695 C2.82576459,13.3275941 2.82576459,12.19529 3.52270623,11.4941891 L11.6127629,3.54050571 C11.9489429,3.20999263 12.401513,3.0247814 12.8729533,3.0247814 L19.3274172,3.0247814 C20.3201611,3.0247814 21.124939,3.82955935 21.124939,4.82230326 L21.124939,11.2583059 C21.124939,11.7406659 20.9310733,12.2027862 20.5869271,12.5407722 L12.5103155,20.4728108 C12.1731575,20.8103442 11.7156477,21 11.2385688,21 C10.7614899,21 10.3039801,20.8103442 9.9668221,20.4728108 L3.52270623,14.028695 Z M16.9307214,9.01652093 C17.9234653,9.01652093 18.7282432,8.21174298 18.7282432,7.21899907 C18.7282432,6.22625516 17.9234653,5.42147721 16.9307214,5.42147721 C15.9379775,5.42147721 15.1331995,6.22625516 15.1331995,7.21899907 C15.1331995,8.21174298 15.9379775,9.01652093 16.9307214,9.01652093 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <span class="kt-menu__link-text">Sosial Media</span>
                                                </a>
                                            </li>
                                            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                <a  href="<?php echo $config['web']['url'] ?>price/top-up" class="kt-menu__link">
                                                    <span class="kt-menu__link-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z" fill="#000000" opacity="0.3"/>
                                                                <path d="M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z M8,1 L16,1 C17.5187831,1 18.75,2.23121694 18.75,3.75 L18.75,20.25 C18.75,21.7687831 17.5187831,23 16,23 L8,23 C6.48121694,23 5.25,21.7687831 5.25,20.25 L5.25,3.75 C5.25,2.23121694 6.48121694,1 8,1 Z M9.5,1.75 L14.5,1.75 C14.7761424,1.75 15,1.97385763 15,2.25 L15,3.25 C15,3.52614237 14.7761424,3.75 14.5,3.75 L9.5,3.75 C9.22385763,3.75 9,3.52614237 9,3.25 L9,2.25 C9,1.97385763 9.22385763,1.75 9.5,1.75 Z" fill="#000000" fill-rule="nonzero"/>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <span class="kt-menu__link-text">Top Up</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                   <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-text">Halaman &nbsp;<i class="fa fa-angle-down"></i></span>
                                        </a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a  href="<?php echo $config['web']['url'] ?>page/api-documentation" class="kt-menu__link">
                                                    <span class="kt-menu__link-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M15.2718029,8.68536757 C14.8932864,8.28319382 14.9124644,7.65031935 15.3146382,7.27180288 C15.7168119,6.89328641 16.3496864,6.91246442 16.7282029,7.31463817 L20.7282029,11.5646382 C21.0906029,11.9496882 21.0906029,12.5503176 20.7282029,12.9353676 L16.7282029,17.1853676 C16.3496864,17.5875413 15.7168119,17.6067193 15.3146382,17.2282029 C14.9124644,16.8496864 14.8932864,16.2168119 15.2718029,15.8146382 L18.6267538,12.2500029 L15.2718029,8.68536757 Z M8.72819712,8.6853647 L5.37324625,12.25 L8.72819712,15.8146353 C9.10671359,16.2168091 9.08753558,16.8496835 8.68536183,17.2282 C8.28318808,17.6067165 7.65031361,17.5875384 7.27179713,17.1853647 L3.27179713,12.9353647 C2.90939712,12.5503147 2.90939712,11.9496853 3.27179713,11.5646353 L7.27179713,7.3146353 C7.65031361,6.91246155 8.28318808,6.89328354 8.68536183,7.27180001 C9.08753558,7.65031648 9.10671359,8.28319095 8.72819712,8.6853647 Z" fill="#000000" fill-rule="nonzero"/>
                                                            </g>
                                                        </svg></span><span class="kt-menu__link-text">API Dokumentasi</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a  href="<?php echo $config['web']['url'] ?>page/contact" class="kt-menu__link">
                                                    <span class="kt-menu__link-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M17,2 L19,2 C20.6568542,2 22,3.34314575 22,5 L22,19 C22,20.6568542 20.6568542,22 19,22 L17,22 L17,2 Z" fill="#000000" opacity="0.3"/>
                                                                <path d="M4,2 L16,2 C17.6568542,2 19,3.34314575 19,5 L19,19 C19,20.6568542 17.6568542,22 16,22 L4,22 C3.44771525,22 3,21.5522847 3,21 L3,3 C3,2.44771525 3.44771525,2 4,2 Z M11.1176481,13.709585 C10.6725287,14.1547043 9.99251947,14.2650547 9.42948307,13.9835365 C8.86644666,13.7020183 8.18643739,13.8123686 7.74131803,14.2574879 L6.2303083,15.7684977 C6.17542087,15.8233851 6.13406645,15.8902979 6.10952004,15.9639372 C6.02219616,16.2259088 6.16377615,16.5090688 6.42574781,16.5963927 L7.77956724,17.0476658 C9.07965249,17.4810276 10.5130001,17.1426601 11.4820264,16.1736338 L15.4812434,12.1744168 C16.3714821,11.2841781 16.5921828,9.92415954 16.0291464,8.79808673 L15.3965752,7.53294436 C15.3725414,7.48487691 15.3409156,7.44099843 15.302915,7.40299777 C15.1076528,7.20773562 14.7910703,7.20773562 14.5958082,7.40299777 L13.0032662,8.99553978 C12.5581468,9.44065914 12.4477965,10.1206684 12.7293147,10.6837048 C13.0108329,11.2467412 12.9004826,11.9267505 12.4553632,12.3718698 L11.1176481,13.709585 Z" fill="#000000"/>
                                                            </g>
                                                        </svg></span><span class="kt-menu__link-text">Kontak Kami</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a  href="<?php echo $config['web']['url'] ?>page/tos" class="kt-menu__link">
                                                    <span class="kt-menu__link-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                                <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
                                                                <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
                                                            </g>
                                                        </svg></span><span class="kt-menu__link-text">Ketentuan Layanan</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a  href="<?php echo $config['web']['url'] ?>page/faq" class="kt-menu__link">
                                                    <span class="kt-menu__link-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            </g>
                                                        </svg></span><span class="kt-menu__link-text">Pertanyaan Umum</span>
                                                    </a>
                                                </li>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </div>
                        </div>
                        <!--End Header Menu -->

                        <!-- Start Header Topbar -->
                        <div class="kt-header__topbar kt-grid__item">
                       
                	    <!-- Start Icon Deposit Balance -->
                	    <div class="kt-header__topbar-item dropdown">
                		    <div class="kt-header__topbar-wrapper" data-toggle="" data-offset="10px,0px">
                			    <span class="kt-header__topbar-icon">
                			        <a href="<?php echo $config['web']['url'] ?>history/deposit">
                				        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                				            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                	    			            <rect x="0" y="0" width="24" height="24"/>
                	    			            <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                	    			            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                	    			            <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                				            </g>
                				        </svg>
                                    </a>
                			    </span>
                		    </div>
                	    </div>
                	    <!-- End Icon Deposit Balance -->

                	    <!-- Start Icon Cart -->
                	    <div class="kt-header__topbar-item dropdown">
                		    <div class="kt-header__topbar-wrapper" data-toggle="" data-offset="10px,0px">
                			    <span class="kt-header__topbar-icon">
                			        <a href="<?php echo $config['web']['url'] ?>history/order">
                				        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                				            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                	    			            <rect x="0" y="0" width="24" height="24"/>
                	    			            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                	    			            <path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="#000000"/>
                				            </g>
                				        </svg>
                                    </a>
                			    </span>
                		    </div>
                	    </div>
                	    <!-- End Icon Cart -->

                		<!-- Start User Bar -->
                		<div class="kt-header__topbar-item kt-header__topbar-item--user">
                		    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                			    <span class="kt-header__topbar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                </span>
                			    <img alt="Profile" src="<?php echo $config['web']['url'] ?>assets/media/icon/user.jpg" class="kt-hidden"/>
                		    </div>
                    		<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                
                        		<!-- Start Head -->
                        		<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo $config['web']['url'] ?>assets/media/bg/bg-2.png)">
                                    <div class="kt-user-card__avatar">
                                        <img class="kt-hidden" alt="Profile" src="<?php echo $config['web']['url'] ?>assets/media/users/user.png" />
                                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="kt-user-card__name">
                                        <?php echo $data_user['nama']; ?>
                                    </div>
                                </div>
                                <!-- End Head -->

                                <!-- Start Navigation -->
                                <div class="kt-notification">
                                    <a href="<?php echo $config['web']['url'] ?>page/profile" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Profil
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Pengaturan
                                            </div>
                                        </div>
                                    </a>
                                    <a href="<?php echo $config['web']['url'] ?>history/account-activity" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-rocket-1 kt-font-danger"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Aktifitas
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Riwayat Akun
                                            </div>
                                        </div>
                                    </a>
                                    <a href="<?php echo $config['web']['url'] ?>history/balance-coins" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon-coins kt-font-primary"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Saldo & Koin
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Riwayat Pemakaian Saldo & Koin
                                            </div>
                                        </div>
                                    </a>
                                    <a href="<?php echo $config['web']['url'] ?>history/order" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-shopping-cart kt-font-warning"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Pesanan
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Tagihan Pesanan <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">0 Pending</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="<?php echo $config['web']['url'] ?>logout" class="btn btn-label btn-label-brand btn-sm btn-bold">Keluar</a>
                                    </div>
                                </div>
                                <!-- End Navigation -->
                	        </div>
                        </div>
                        <!-- End User Bar -->

                    </div>
                </div>
                <!-- End Header -->

            </div>

<?php } ?>