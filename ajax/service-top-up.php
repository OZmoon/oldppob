<?php
require("../config.php");

if (isset($_POST['operator'])) {
    $post_tipe = $conn->real_escape_string($_POST['tipe']);
	$post_operator = $conn->real_escape_string($_POST['operator']);
	$cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE operator = '$post_operator' AND tipe ='$post_tipe' AND status = 'Normal' ORDER BY harga ASC");
	?>
	<option value="0">Pilih Salah Satu</option>
	<?php
	while ($data_layanan = $cek_layanan->fetch_assoc()) {
	?>
	<option value="<?php echo $data_layanan['service_id'];?>"><?php echo $data_layanan['layanan'];?></option>
	<?php
	}
} else {
?>
<option value="0">Error.</option>
<?php
}