<?php
require 'session_login.php';
require 'database.php';
require 'csrf_token.php';
?>

<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title><?php echo $tipe; ?> | <?php echo $data['short_title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="<?php echo $data['deskripsi_web']; ?>" name="description" />
        <meta content="RAP Code" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- Start Favicon Icon -->
        <link rel="shortcut icon" href="<?php echo $config['web']['url'] ?>assets/media/logos/favicon.png" />
        <!-- End Favicon Icon -->

        <!-- Start CSS -->
        <link type="text/css" rel="stylesheet" href="<?php echo $config['web']['url'] ?>assets/css/pages/login/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $config['web']['url'] ?>assets/fonts/font-awesome/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $config['web']['url'] ?>assets/fonts/flaticon/font/flaticon.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $config['web']['url'] ?>assets/css/pages/login/style.css">
        <link rel="stylesheet" type="text/css" id="style_sheet" href="<?php echo $config['web']['url'] ?>assets/css/pages/login/default.css">
        <!-- End CSS -->

        <!-- Start Google Fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
        <!-- End Google Fonts -->

        <!-- Start Script Sweetalert JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- End Script Sweetalert JS -->

</head>