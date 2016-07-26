<?php

require_once('../config.php');
use App\Admin\Npfims;

if (isset($_POST)) {
	$enroll = Npfims::newEntry();
	if ($enroll === true) {
		$response = array(
			"status" => "success",
			"message" => "New Entry Added Successfully!"
		);
	} else {
		 $response = array(
			"status" => "failure",
			"message" => "New Entry Cound not be added!"
		);
	}
	die(json_encode($response));
}

?>