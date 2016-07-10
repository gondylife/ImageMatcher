<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST)) {
	$data = [];
	$image = json_decode(file_get_contents('php://input'));
	$data['imageURL'] = $image;
	$find = Npfims::detectFace($data);
	die(json_encode($find));
}

?>