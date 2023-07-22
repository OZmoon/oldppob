<?php
require("../config.php");

if (isset($_POST['layanan'])) {
	$post_layanan = $conn->real_escape_string($_POST['layanan']);
	$cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE service_id = '$post_layanan' AND status = 'Normal'");
	if (mysqli_num_rows($cek_layanan) == 1) {
		$data_layanan = mysqli_fetch_assoc($cek_layanan);
	?>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Keterangan</label>
								<div class="col-lg-9 col-xl-6">
								    <textarea class="form-control bg-secondary" id="disabledTextInput" placeholder="<?php echo $data_layanan['deskripsi']; ?>" value="Keterangan" style="height: 100px" readonly="" disabled></textarea>
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