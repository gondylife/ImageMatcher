<?php

require_once('../config.php');
use App\Admin\Airtimebuy;

if(isset($_POST)) {
	if ($_POST) {
		foreach ($_POST as $field => $value) {
			if (!isset($value) || empty($value)) {
				return false;
			}
		}
		$country = $_POST['country'];
		$network = $_POST['network'];
		$amount = $_POST['amount'];
		$phonenumber = $_POST['phonenumber'];
		$start = $_POST['startdate'];
		$frequency = $_POST['frequency'];
		$end = $_POST['enddate'];
	}
	$execute = Airtimebuy::saveScheduleDetails ($country, $network, $amount, $phonenumber, $start, $frequency, $end);
	die(json_encode($execute));
}

?>