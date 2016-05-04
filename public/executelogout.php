<?php

require_once('../config.php');
use App\Admin\Airtimebuy;

$logout = Airtimebuy::logout();
if (!$logout) {
	
} else {
	die(json_encode($logout));
}

?>