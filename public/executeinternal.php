<?php

require_once('../config.php');
use App\Admin\Npfims;

if (isset($_POST) && isset($_FILES["file"])) {
	$sourcePath = $_FILES['file']['tmp_name'];
	$targetPath = "../photos/".$_FILES['file']['name'];
	if (move_uploaded_file($sourcePath, $targetPath)) {
		$response = array(
			"status" => "success"
		);
		die(json_encode($response));
	}
} else {
	if (isset($_POST)) {
		$image = file_get_contents('php://input');
		$data = array(
			"imageURL" => $image
		);
		$detect = Npfims::detectFace($data);
		if ($detect->body->images[0]->status === 'Complete' AND count($detect->body->images[0]->faces) >= 1) {
			$recognize = Npfims::recognizeFace($data);
			if ($recognize->body->images[0]->transaction->status === 'success') {
				$entryID = $recognize->body->images[0]->transaction->subject;
				$details = Npfims::retrieveDetails($entryID);
				$confidence = ($recognize->body->images[0]->transaction->confidence / 1) * 100;
				$details['confidence'] = round($confidence, 2) .'%';
				die(json_encode($details));
			}
			if ($recognize->body->images[0]->transaction->status === 'failure') {
				$response = array(
					"status" => "failure",
					"message" => "Oops, No Match Found!"
				);
				die(json_encode($response));
			}
		}
	}
}

?>