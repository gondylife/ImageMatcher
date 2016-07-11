<?php

require_once('../config.php');
use App\Admin\Npfims;

$logout = Npfims::logout();
if (!$logout) {
	
} else {
	die(json_encode($logout));
}

?>