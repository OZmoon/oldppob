<?php
session_start();
require '../config.php';
require '../library/session_user.php';
require '../library/header.php';

	if (isset($_GET['oid'])) {
		$kode_pesanan = filter($_GET['oid']);

		$cek_pesanan = $conn->query("SELECT * FROM semua_pembelian WHERE id_pesan = '$kode_pesanan' AND user = '$sess_username'");
		$data_pesanan = mysqli_fetch_assoc($cek_pesanan);

		if ($data_pesanan['status'] == "Pending") {
			$label = "warning";
		} else if ($data_pesanan['status'] == "Processing") {
			$label = "primary";
		} else if ($data_pesanan['status'] == "Error") {
			$label = "danger";
		} else if ($data_pesanan['status'] == "Partial") {
			$label = "danger";
		} else if ($data_pesanan['status'] == "Success") {
			$label = "success";
		}

		if ($cek_pesanan->num_rows == 0) {
			header("Location: ".$config['web']['url']."rip/order");
		} else {
?>

        <!-- Start Sub Header -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
	        <div class="kt-container">
	            <div class="kt-subheader__main">
		            <h3 class="kt-subheader__title">Print Pesanan
	                <div class="kt-subheader__breadcrumbs">
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Halaman Utama</a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Print Pesanan</a>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- End Sub Header -->

        <!-- Start Content -->
        <div class="kt-container kt-grid__item kt-grid__item--fluid">

		<!-- Start Page Order Struk -->
        <div class="row">
	        <div class="offset-lg-2 col-lg-8">
		        <div class="kt-portlet">
			        <div class="kt-portlet__body">
                    <h4 class="text-center"><strong><font face="BatangChe">** <?php echo $data['short_title']; ?> **</font></strong></h4>
                    <h5 class="text-center"><strong><font face="Century"><?php echo tanggal_indo($data_pesanan['date']); ?>, <?php echo $data_pesanan['time']; ?></font></strong></h5>
                    <br />
	                <center>
		                <h4><font face="Algerian">STRUK PEMBELIAN</font></h4>
	                </center>
                    <br />
                    <p><font face="Courier New">Kategori&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data_pesanan['kategori']; ?></font></p>
	                <p><font face="Courier New">Nama Layanan : <?php echo $data_pesanan['layanan']; ?></font></p>
	                <p><font face="Courier New">Tujuan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data_pesanan['target']; ?></font></p>
	                <p><font face="Courier New">Harga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. <?php echo number_format($data_pesanan['harga'],0,',','.'); ?>,-</font></p>
	                <p><font face="Courier New">Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </font><label class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo $data_pesanan['status']; ?></label></p>
					<center>
					    <h4><font face="Stencil">Terima Kasih</font></h4>
					</center>
					</div>
					<div class="card-footer text-muted">
						<a href="<?php echo $config['web']['url']; ?>history/order" class="btn btn-warning btn-elevate btn-pill btn-elevate-air">Kembali</a>
						<a class="pull-right btn btn-primary btn-elevate btn-pill btn-elevate-air" href="#" onClick="window.print();">Print</a>
					</div>
				</div>
			</div>
		</div>
        <!-- End Page Order Struk -->
        
        </div>
        <!-- End Content -->
        
        <br />
	<br />

        <!-- Start Scrolltop -->

		<!-- End Scrolltop -->

<?php ?>

<?php 
require '../library/footer.php';
}
} else {
	header("Location: ".$config['web']['url']."rip/order");
}
?>