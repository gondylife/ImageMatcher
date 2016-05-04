<?php

require_once('../config.php');
use App\Admin\Airtimebuy;

if (isset($_POST['delete-schedule'])) {
	$ref = $db->escapeValue($_POST['ref']);
	$delete = Airtimebuy::destroySchedule($ref);
	if ($delete) {
		die(json_encode(['status' => 'success']));
	}
}

?>