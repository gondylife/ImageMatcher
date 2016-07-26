<?php

require_once('../config.php');
use App\Admin\Npfims;

if (isset($_POST)) {
	$login = Npfims::login();
	if ($login['status'] === 'success') {
		$_SESSION['PID'] = $login['PoliceID'];
		$_SESSION['redirect'] = $login['redirect'];
		$_SESSION['firstname'] = $login['Firstname'];
	}
	die(json_encode($login));
}

?>