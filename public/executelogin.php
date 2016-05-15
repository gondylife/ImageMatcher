<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST)) {
	$login = Npfims::login();
	if ($login['status'] === 'success') {
		$_SESSION['PID'] = $login['PoliceID'];
	}
	die(json_encode($login));
}

?>