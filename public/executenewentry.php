<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST)) {
	$register = Npfims::newEntry();
	die(json_encode($register));
}

?>