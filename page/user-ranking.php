<?php
session_start();
require '../config.php';
require '../library/header.php';
?>

        <!-- Start Sub Header -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
	        <div class="kt-container">
	            <div class="kt-subheader__main">
		            <h3 class="kt-subheader__title">Peringkat Bulanan</h3>
	                <div class="kt-subheader__breadcrumbs">
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Halaman Utama</a>
	                	<span class="kt-subheader__breadcrumbs-separator"></span>
	                    <a href="<?php echo $config['web']['url'] ?>" class="kt-subheader__breadcrumbs-link">Peringkat Bulanan</a>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- End Sub Header -->

        <!-- Start Content -->
        <div class="kt-container kt-grid__item kt-grid__item--fluid">

        <!-- Start Page User Ranking -->
        <div class="row">
	        <div class="col-lg-6">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="flaticon-trophy text-primary"></i>
					            Top 5 Pesanan
					        </h3>
				        </div>
			        </div>
			        <div class="kt-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap m-0">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama Pengguna</th>
                                        <th>Jumlah Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$no = 1;
                                $top_pesanan = $conn->query("SELECT A.* FROM top_users A INNER JOIN (SELECT username,max(jumlah) as maxRev FROM top_users GROUP BY username) B on A.username=B.username and A.jumlah=B.maxRev ORDER BY jumlah DESC LIMIT 5"); // edit
								while ($data_pesanan = mysqli_fetch_assoc($top_pesanan)) {
								$userstr = "-".strlen($data_pesanan['username']);
								$usersensor = substr($data_pesanan['username'],$slider_userstr,-4);	
								if ($no == 1) {
									$label = "success";
								} else if ($no == 2) {
									$label = "primary";
								} else if ($no == 3) {
									$label = "dark";
								} else if ($no == 4) {
									$label = "warning";
								} else if ($no == 5) {
									$label = "danger";
								}
							    ?>
								<tr>
									<td><span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo $no; ?></span></td>
									<td><span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo "".$usersensor."****"; ?></span></td>
									<td>Rp <?php echo number_format($data_pesanan['jumlah'],0,',','.'); ?> <span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm">(Dari <?php echo number_format($data_pesanan['total'],0,',','.'); ?> Pesanan)</span></td>
								</tr>
								<?php
								$no++;
								}
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
	        <div class="col-lg-6">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="flaticon-trophy text-primary"></i>
					            Top 5 Deposit
					        </h3>
				        </div>
			        </div>
			        <div class="kt-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap m-0">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama Pengguna</th>
                                        <th>Jumlah Deposit</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$no = 1;
                                $top_deposit = $conn->query("SELECT A.* FROM top_depo A INNER JOIN (SELECT username,max(jumlah) as maxRev FROM top_depo GROUP BY username) B on A.username=B.username and A.jumlah=B.maxRev ORDER BY jumlah DESC LIMIT 5"); // edit
								while ($data_deposit = mysqli_fetch_array($top_deposit)) {
								$userstr = "-".strlen($data_deposit['username']);
								$usersensor = substr($data_deposit['username'],$slider_userstr,-4);				
								if ($no == 1) {
									$label = "success";
								} else if ($no == 2) {
									$label = "primary";
								} else if ($no == 3) {
									$label = "dark";
								} else if ($no == 4) {
									$label = "warning";
								} else if ($no == 5) {
									$label = "danger";
								}
							    ?>
                                    <tr>
									    <td><span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo $no; ?></span></td>
									    <td><span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo "".$usersensor."****"; ?></span></td>
									    <td>Rp <?php echo number_format($data_deposit['jumlah'],0,',','.'); ?> <span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm">(Dari <?php echo number_format($data_deposit['total'],0,',','.'); ?> Deposit)</span></td>
                                    </tr>
								<?php
								$no++;
								}
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 text-center">
        <h2>Top 5 Layanan Bulan Ini</h2>
        <p>Berikut Adalah 5 Layanan Dengan Pemesanan Tertinggi Bulan Ini.</p>
        </div>
        <div class="row">
	        <div class="offset-lg-2 col-lg-8">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="flaticon-trophy text-primary"></i>
					            Top 5 Layanan
					        </h3>
				        </div>
			        </div>
			        <div class="kt-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap m-0">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama Layanan</th>
                                        <th>Jumlah Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$no = 1;
                                $top_layanan = $conn->query("SELECT A.* FROM top_layanan A INNER JOIN (SELECT layanan,max(jumlah) as maxRev FROM top_layanan GROUP BY layanan) B on A.layanan=B.layanan and A.jumlah=B.maxRev ORDER BY jumlah DESC LIMIT 5"); // edit
								while ($data_layanan = mysqli_fetch_assoc($top_layanan)) {								
								if ($no == 1) {
									$label = "success";
								} else if ($no == 2) {
									$label = "primary";
								} else if ($no == 3) {
									$label = "dark";
								} else if ($no == 4) {
									$label = "warning";
								} else if ($no == 5) {
									$label = "danger";
								}
							    ?>
								<tr>
									<td><span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo $no; ?></span></td>
									<td><span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm"><?php echo $data_layanan['layanan']; ?></span></td>
									<td>Rp <?php echo number_format($data_layanan['jumlah'],0,',','.'); ?> <span class="btn btn-<?php echo $label; ?> btn-elevate btn-pill btn-elevate-air btn-sm">(Dari <?php echo number_format($data_layanan['total'],0,',','.'); ?> Pesanan)</span></td>
								</tr>
								<?php
								$no++;
								}
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page User Ranking -->

        </div>
        <!-- End Content -->

        <!-- Start Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
		    <i class="fa fa-arrow-up"></i>
		</div>
		<!-- End Scrolltop -->

<?php
require '../library/footer.php';
?>