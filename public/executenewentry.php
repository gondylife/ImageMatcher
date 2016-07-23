<?php

require_once('../config.php');
use App\Admin\Npfims;

if (isset($_POST)) {
	$enroll = Npfims::newEntry();
	die(json_encode($enroll));
}

?>