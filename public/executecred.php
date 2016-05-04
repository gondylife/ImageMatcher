<?php

require_once('../config.php');
use App\Admin\Airtimebuy;

if(isset($_POST)) {
	$save = Airtimebuy::saveToken();
	die(json_encode($save));
}

?>