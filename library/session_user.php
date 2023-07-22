<?php
	if (!isset($_SESSION['user'])) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'pesan' => 'Silakan Masuk Terlebih Dahulu.');
		exit(header("Location: ".$config['web']['url']."auth/login"));
	}