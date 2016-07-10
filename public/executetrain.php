<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST)) {
	$dataArray = json_decode(file_get_contents('php://input'));
	$train = Npfims::addMoreImages($dataArray);
	die(json_encode($train));
}

?>