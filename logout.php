<?php
session_start();
require("config.php");

$insert_user = $conn->query("INSERT INTO aktifitas VALUES ('', '".$_SESSION['user']['username']."', 'Keluar', '".get_client_ip()."', '$date', '$time')");
if ($insert_user == TRUE) {
unset($_SESSION['user']);
exit(header("Location: ".$config['web']['url']."panel"));
}