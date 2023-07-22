<?php
require("../config.php");

if (isset($_POST['provider'])) {
	$post_provider = $conn->real_escape_string($_POST['provider']);
	$cek_metode = $conn->query("SELECT * FROM metode_depo WHERE id = '$post_provider' AND status = 'Aktif' ORDER BY id ASC");
	$data_metode = mysqli_fetch_assoc($cek_metode);

	if ($data_metode['provider'] == 'TELKOMSEL') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nomor Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="text" class="form-control" placeholder="Contoh : 085381259307" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'XL') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nomor Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="text" class="form-control" placeholder="Contoh : 085381259307" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'GOPAY') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nama Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="text" class="form-control" placeholder="Contoh : Adi Gunawan" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" value="<?php echo $post_jumlah; ?>" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'BCA') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nama Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="text" class="form-control" placeholder="Contoh : Adi Gunawan" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" value="<?php echo $post_jumlah; ?>" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'BRI') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nama Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="text" class="form-control" placeholder="Contoh : Adi Gunawan" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" value="<?php echo $post_jumlah; ?>" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'OVO') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nomor Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="number" class="form-control" placeholder="Contoh : 085381259307" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" value="<?php echo $post_jumlah; ?>" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'DANA') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nomor Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="number" class="form-control" placeholder="Contoh : 085381259307" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" value="<?php echo $post_jumlah; ?>" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php } else if ($data_metode['provider'] == 'LINKAJA') { ?>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Nomor Pengirim</label>
			<div class="col-lg-9 col-xl-6">
				<input type="number" class="form-control" placeholder="Contoh : 085381259307" value="<?php echo $post_pengirim; ?>" name="pengirim">
				<span class="form-text text-muted"><?php echo ($error['pengirim']) ? $error['pengirim'] : '';?></span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xl-3 col-lg-3 col-form-label">Jumlah</label>
			<div class="col-lg-9 col-xl-6">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text text-primary">Rp</span></div>
					<input type="number" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Isi Saldo" value="<?php echo $post_jumlah; ?>" id="jumlah">
				</div>
				<span class="form-text text-muted"><?php echo ($error['jumlah']) ? $error['jumlah'] : '';?></span>
			</div>
		</div>

	<?php }
}