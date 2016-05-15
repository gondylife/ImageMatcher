<?php

require_once('../config.php');
use App\Admin\Npfims;

if (isset($_POST['deactivate-personnel'])) {
	$ref = $db->escapeValue($_POST['ref']);
	$deactivate = Npfims::deactivate($ref);
	if ($deactivate) {
		die(json_encode(['status' => 'success']));
	}
}

if (isset($_POST['activate-personnel'])) {
	$ref = $db->escapeValue($_POST['ref']);
	$activate = Npfims::activate($ref);
	if ($activate) {
		die(json_encode(['status' => 'success']));
	}
}

if (isset($_POST['delete-personnel'])) {
	$ref = $db->escapeValue($_POST['ref']);
	$delete = Npfims::delete($ref);
	if ($delete) {
		die(json_encode(['status' => 'success']));
	}
}

?>