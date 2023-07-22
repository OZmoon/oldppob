<?php
require("../config.php");

if (isset($_POST['layanan'])) {
	$post_layanan = $conn->real_escape_string($_POST['layanan']);
	$cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE service_id = '$post_layanan' AND status = 'Aktif'");
	if (mysqli_num_rows($cek_layanan) == 1) {
		$data_layanan = mysqli_fetch_assoc($cek_layanan);
	?>

							<div class="form-group row">
							    <label class="col-xl-3 col-lg-3 col-form-label">Minimal Pesan</label>
								<div class="col-lg-9 col-xl-6">
								    <input type="text" class="form-control bg-secondary" placeholder="0" value="<?php echo number_format($data_layanan['min'],0,',','.'); ?>" readonly="" disabled>
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Maksimal Pesan</label>
								<div class="col-lg-9 col-xl-6">
								    <input type="text" class="form-control bg-secondary" placeholder="0" value="<?php echo number_format($data_layanan['max'],0,',','.'); ?>" readonly="" disabled>
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Harga/1000</label>
								<div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
                                        <input class="form-control bg-secondary" placeholder="0" id="jumlah" value="<?php echo number_format($data_layanan['harga'],0,',','.'); ?>" readonly="" disabled>
                                    </div>
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Keterangan</label>
								<div class="col-lg-9 col-xl-6">
								    <textarea class="form-control bg-secondary" id="disabledTextInput" placeholder="<?php echo $data_layanan['catatan']; ?>" value="Keterangan" style="height: 100px" readonly="" disabled></textarea>
							    </div>
							</div>
<?php
} else {
?>
							<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
								</button>
								<i class="mdi mdi-block-helper"></i>
								<b>Gagal :</b> Layanan Tidak Ditemukan
							</div>
<?php
}
} else {
?>
							<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
								</button>
								<i class="mdi mdi-block-helper"></i>
								<b>Gagal : </b> Terjadi Kesalahan, Silakan Hubungi Admin.
							</div>
<?php
}