<?php
require("../config.php");

if (isset($_POST['api'])) {
	$post_api = $conn->real_escape_string($_POST['api']);
	
if($post_api =="api_social_media"){
 include("api_data/social-media.php");
}else if($post_api =="api_top_up"){
 include("api_data/top-up.php");
}else if($post_api =="api_account_information"){
 include("api_data/account.php");   
}
} else {
?>
<option value="0">Terjadi Kesalahan, Silakan Hubungi Admin</option>
<?php
}