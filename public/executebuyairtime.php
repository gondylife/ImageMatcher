<?php

require_once '../config.php';

if (isset($_POST)) {
	if ($_POST) {
		foreach ($_POST as $field => $value) {
			if (!isset($value) || empty($value)) {
				return false;
			}
		}
		$_SESSION['ATcountry'] = $_POST['country'];
		$_SESSION['ATnetwork'] = $_POST['network'];
		$_SESSION['ATamount'] = $_POST['amount'];
		$_SESSION['ATphonenumber'] = $_POST['phonenumber'];
		$_SESSION['ATtoken'] = $_POST['token'];
	}

	die(json_encode($_SESSION['ATtoken']));
}

?>