<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST)) {
	$register = Npfims::register();
	die(json_encode($register));
}

?>