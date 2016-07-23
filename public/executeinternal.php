<?php

require_once('../config.php');
use App\Admin\Npfims;

if (isset($_POST)) {
	$image = file_get_contents('php://input');
	$data = array(
		"imageURL" => $image
	);
	$find = Npfims::detectFace($data);
	die(json_encode($find));
}