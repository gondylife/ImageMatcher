<?php

require_once('../config.php');
use App\Admin\Npfims;

if(isset($_POST) AND isset($_POST['othername']) AND isset($_POST['workaddress'])) {
	$data = array(
		'id' => mysql_real_escape_string($_POST['id']),
		'othername' => mysql_real_escape_string($_POST['othername']),
		'dob' => mysql_real_escape_string($_POST['dob']),
		'phonenumber' => mysql_real_escape_string($_POST['phonenumber']),
		'emailaddress' => mysql_real_escape_string($_POST['emailaddress']),
		'homeaddress' => mysql_real_escape_string($_POST['homeaddress']),
		'occupation' => mysql_real_escape_string($_POST['occupation']),
		'workplace' => mysql_real_escape_string($_POST['workplace']),
		'workaddress' => mysql_real_escape_string($_POST['workaddress'])
	);
	$update = Npfims::updateEntryDetails($data);
	die(json_encode($update));
}

if (isset($_POST) AND isset($_POST['edit-entry'])) {
	$ref = $db->escapeValue($_POST['ref']);
	$entry = Npfims::retrieveEntry($ref);
	if ($entry) {
		die(json_encode($entry));
	}
}

?>