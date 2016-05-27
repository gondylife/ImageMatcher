<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST)) {
	$data = json_decode($_POST['data']);
	var_dump($data);
	// $register = Npfims::register();
	// die(json_encode($register));
}

?>