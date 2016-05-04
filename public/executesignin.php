<?php

require_once('../config.php');
use App\Admin\Airtimebuy;

if(isset($_POST)) {
	$login = Airtimebuy::signin();
	if ($login['status'] === 'success') {
		$_SESSION['BID'] = $login['buyerID'];
	}
	die(json_encode($login));
}

?>