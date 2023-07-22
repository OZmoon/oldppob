			            </div>
					</div>
					<!-- End Body Content -->

					<!-- Start Footer -->
					<div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer">
						<div class="kt-footer__top">
							<div class="kt-container ">
								<div class="row">
									<div class="col-lg-6">
										<div  class="kt-footer__section">
											<h3 class="kt-footer__title">Tentang <?php echo $data['short_title']; ?></h3>
											<div class="kt-footer__content">
												<b><?php echo $data['short_title']; ?></b> Adalah Sebuah Platform Bisnis Yang Menyediakan Berbagai Layanan MultI Media Marketing Yang Bergerak Terutama Di Indonesia. Dengan Bergabung Bersama Kami, Anda Dapat Menjadi Penyedia Jasa Sosial Media Atau Reseller Sosial Media Seperti Jasa Penambah Followers, Likes, Views, Subscribe, Dll. Saat Ini Tersedia Berbagai Layanan Untuk Sosial Media Terpopuler Seperti Instagram, Facebook, Twitter, Youtube, Dll. Dan Kamipun Juga Menyediakan Panel Pulsa & PPOB Seperti Pulsa All Operator, Paket Data, Saldo Gojek/Grab, Token PLN, All Voucher Game Online, Dll.
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div  class="kt-footer__section">
											<h3 class="kt-footer__title">Informasi</h3>
											<div class="kt-footer__content">
												<div class="kt-footer__nav">
													<div class="kt-footer__nav-section">
														<a href="<?php echo $config['web']['url'] ?>page/how-to-top-up-balance">Cara Deposit</a>
														<a href="<?php echo $config['web']['url'] ?>page/how-to-transaction">Panduan Transaksi</a>
														<a href="<?php echo $config['web']['url'] ?>page/balance-top-up-method">Pembayaran</a>
														<a href="<?php echo $config['web']['url'] ?>page/api-documentation">API Dokumentasi</a>
														<a href="<?php echo $config['web']['url'] ?>page/service-promo">Layanan Promo</a>
													</div>
												</div>	
											</div>
										</div>
									</div>
									<?php
									$cek_kontak = $conn->query("SELECT * FROM kontak_website ORDER BY id DESC");
									while ($data_kontak = $cek_kontak->fetch_assoc()) {
									?>
									<div class="col-lg-3">
										<div class="kt-footer__section">
											<h3 class="kt-footer__title">Sosial Media</h3>
											<div class="kt-footer__content">
												<div class="kt-footer__nav">
													<div class="kt-footer__nav-section">
														<a href="<?php echo $data_kontak['link_fb']; ?>" target="_blank"><i class="flaticon-facebook-logo-button fa-2x"></i> &nbsp;Facebook</a>
														<a href="<?php echo $data_kontak['link_ig']; ?>" target="_blank"><i class="flaticon-instagram-logo fa-2x"></i> &nbsp;Instagam</a>
														<a href="https://api.whatsapp.com/send?phone=<?php echo $data_kontak['no_wa']; ?>" target="_blank"><i class="flaticon-whatsapp fa-2x"></i> &nbsp;WhatsApp</a>
													</div>
												</div>	
											</div>
										</div>
									</div>							
								</div>				
							</div>	
						</div>
						<?php
					}
					?>					
						<div class="kt-footer__bottom">
							<div class="kt-container ">
								<div class="kt-footer__wrapper">
									<div class="kt-footer__copyright">
									Copyright &copy; 2021 <a href="<?php echo $config['web']['url'] ?>" target="_blank" class="kt-link"> <?php echo $data['short_title']; ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Footer -->

				</div>
			</div>
		</div>
		<!-- End Page -->

		<!-- Global Config (global config for global JS sciprts) -->
		<script>
		    var KTAppOptions = {"colors":{"state":{"brand":"#366cf3","light":"#ffffff","dark":"#282a3c","primary":"#2196f3","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
		</script>
		<!-- End Global Config -->

		<!-- Global Theme Bundle (used by all pages) -->
		<script src="<?php echo $config['web']['url'] ?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/scripts.bundle.js" type="text/javascript"></script>
		<!-- End Global Theme Bundle -->

		<!-- Page Vendors (used by this page) -->
		<script src="<?php echo $config['web']['url'] ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
		<!-- End Page Vendors -->

		<!-- Page Scripts (used by this page) -->
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/components/charts/line-chart/morris.min.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/components/charts/raphael/raphael-min.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/custom/chat/chat.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/custom/voucher/theme.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/custom/voucher/clipboard.min.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/custom/wizard/wizard-4.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/custom/contacts/list-columns.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/components/extended/bootstrap-notify.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/dashboard.js" type="text/javascript"></script>
		<script src="<?php echo $config['web']['url'] ?>assets/js/pages/custom/user/profile.js" type="text/javascript"></script>
		<!-- End Page Scripts -->

		<script>
		    $('#news').modal('show');
		    function read_news() {
		      $.ajax({
		        type: "GET",
		        url: "<?php echo $config['web']['url'] ?>ajax/read-news.php"
		      });
		    }
		</script>

	</body>
</html>