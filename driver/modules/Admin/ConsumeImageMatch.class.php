<?php

namespace App\Admin;
use App\Admin\ImageMatch;
use App\Core\Database;
use App\Libs\Keygen;

class ConsumeImageMatch {

	const RESULT_ASSOC = 2;
	private $firstname, $lastname, $othername, $dob, $sex, $phonenumber, $emailaddress, $homeaddress, $occupation, $workplace, $workaddress, $image1, $image2;

	public function __construct() {
		$headers = apache_request_headers();
		$this->fetchData();
	}

	private function fetchData() {
		if ($_POST AND isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['sex'])) {
			foreach ($_POST as $field => $value) {
				if (!isset($value) || empty($value)) {
					return false;
				}
			}
			$this->firstname = $_POST['firstname'];
			$this->lastname = $_POST['lastname'];
			$this->othername = $_POST['othername'];
			$this->dob = $_POST['dob'];
			$this->sex = $_POST['sex'];
			$this->phonenumber = $_POST['phonenumber'];
			$this->emailaddress = $_POST['emailaddress'];
			$this->homeaddress = $_POST['homeaddress'];
			$this->occupation = $_POST['occupation'];
			$this->workplace = $_POST['workplace'];
			$this->workaddress = $_POST['workaddress'];
			$this->image1 = $_POST['image1'];
			$this->image2 = $_POST['image2'];
			$this->sanitizeData();
		}
	}

	private function sanitizeData() {
		global $db;
		$this->sanitized['firstname'] = $db->escapeValue($this->firstname);
		$this->sanitized['lastname'] = $db->escapeValue($this->lastname);
		$this->sanitized['othername'] = $db->escapeValue($this->othername);
		$this->sanitized['dob'] = $db->escapeValue($this->dob);
		$this->sanitized['sex'] = $db->escapeValue($this->sex);
		$this->sanitized['phonenumber'] = $db->escapeValue($this->phonenumber);
		$this->sanitized['emailaddress'] = $db->escapeValue($this->emailaddress);
		$this->sanitized['homeaddress'] = $db->escapeValue($this->homeaddress);
		$this->sanitized['occupation'] = $db->escapeValue($this->occupation);
		$this->sanitized['workplace'] = $db->escapeValue($this->workplace);
		$this->sanitized['workaddress'] = $db->escapeValue($this->workaddress);
		$this->sanitized['image1'] = $db->escapeValue($this->image1);
		$this->sanitized['image2'] = $db->escapeValue($this->image2);
	}

	public function addNewEntry() {
		global $db;
		if (empty($this->firstname) || empty($this->lastname) || empty($this->dob) || empty($this->sex) || empty($this->phonenumber) || empty($this->emailaddress) || empty($this->homeaddress) || empty($this->image1) || empty($this->image2)) {
			return 'Please fill-up required fields.';
		}

		$firstname = $this->sanitized['firstname'];
		$lastname = $this->sanitized['lastname'];
		$othername = $this->sanitized['othername'];
		$dob = $this->sanitized['dob'];
		$sex = $this->sanitized['sex'];
		$phonenumber = $this->sanitized['phonenumber'];
		$emailaddress = $this->sanitized['emailaddress'];
		$homeaddress = $this->sanitized['homeaddress'];
		$occupation = $this->sanitized['occupation'];
		$workplace = $this->sanitized['workplace'];
		$workaddress = $this->sanitized['workaddress'];
		$image1 = $this->sanitized['image1'];
		$image2 = $this->sanitized['image2'];

		if ($this->checkEmail() === true AND $this->checkPhonenumber() === true) {
			$uniqueid = md5(implode(':', [$firstname, $emailaddress, Keygen\generateRandKey(32)]));

			$insert = $db->query("INSERT INTO Data(UniqueID, Firstname, Lastname, Othername, DOB, Sex, Phonenumber, EmailAddress, HomeAddress, Occupation, WorkPlace, WorkAddress, ImageCount) VALUES('{$uniqueid}', '{$firstname}', '{$lastname}', '{$othername}', '{$dob}', '{$sex}', '{$phonenumber}', '{$emailaddress}', '{$homeaddress}', '{$occupation}', '{$workplace}', '{$workaddress}', 2)");
			if ($insert === true) {
				$dataArray = array(
					'id' => $uniqueid,
					'image' => array($image1, $image2)
				);
				for ($i = 0; $i < count($dataArray['image']); $i++) {
					//Check if the image is a file or url and pass it to train album accordingly
					$data = array(
						'id' => $dataArray['id'],
						'imageURL' => $dataArray['image'][$i]
					);
					$createAlbumEntry = (new ImageMatch)->trainAlbum($data);
				}
				// $response[] = json_decode(json_encode($createAlbumEntry), true);
				//return a proper success failure variable to frontend
				(new ImageMatch)->rebuildAlbum();
				return true;
			} else {
				return false;
			}
		}
	}

	public function addMoreImages($dataArrray) {
		for ($i = 0; $i < count($dataArray['dataset']); $i++) {
			//Check if the image is a file or url and pass it to train album accordingly
			$data = array(
				'id' => $dataArray['id'],
				'imageURL' => $dataArray['dataset'][$i]
			);
			(new ImageMatch)->trainAlbum($data);
		}
		return true;
	}

	public function retrieveAllPersonnels() {
		global $db;
		$retrieve = "SELECT Firstname, Lastname, PoliceID, EmailAddress, Role, DateTime, Status FROM Access";
		$fetch = $db->execute($retrieve, $format = self::RESULT_ASSOC);
		return $fetch;
	}

	public function retrieveAllEntries() {
		global $db;
		$retrieve = "SELECT * FROM Data";
		$fetch = $db->execute($retrieve, $format = self::RESULT_ASSOC);
		return $fetch;
	}

	public function retrieveEntry($data) {
		global $db;
		$retrieve = $db->query("SELECT * FROM Data WHERE UniqueID = '{$data}'");
		$fetch = $db->fetchResult($retrieve, Database::RESULT_ASSOC);
		return $fetch;
	}

	public function editEntry($data) {
		global $db;
		$update = $db->query("UPDATE Data SET Othername = '{$data['othername']}', DOB = '{$data['dob']}', Phonenumber = '{$data['phonenumber']}', EmailAddress = '{$data['emailaddress']}', HomeAddress = '{$data['homeaddress']}', Occupation = '{$data['occupation']}', WorkPlace = '{$data['workplace']}', WorkAddress = '{$data['workaddress']}' WHERE UniqueID = '{$data['id']}'");
		return ($update === true) ? true : false;
	}

	public function updateImageCount($data) {
		global $db;
		$update = $db->query("UPDATE Data SET ImageCount = '{$data['imageCount']}' WHERE UniqueID = '{$data['id']}' LIMIT 1");
		return ($update === true) ? true : false;
	}

	public function detectFace($data) {
		return (new ImageMatch)->detectFace($data);
	}

	public function recognizeFace($data) {
		$recogize = (new ImageMatch)->recognizeFace($data);
	}

	private function checkEmail() {
		if (empty($this->emailaddress)) {
			return 'Please enter email address.';
		} else {
			if (filter_var($this->emailaddress, FILTER_VALIDATE_EMAIL) === false) {
				return 'Email address is invalid.';
			} else {
				if ($this->emailExists() === true) {
					return 'Email address is tied to someone else already.';
				} else {
					return true;
				}
			}
		}
	}

	private function emailExists() {
		global $db;
		$emailaddress = $this->sanitized['emailaddress'];
		$check = $db->query("SELECT EmailAddress FROM Data WHERE EmailAddress = '{$emailaddress}' LIMIT 1");
		return ($db->countResult($check) == 1) ? true : false;
	}

	private function checkPhonenumber() {
		if (empty($this->phonenumber)) {
			return 'Please enter phonenumber.';
		} else {
			if ($this->phonenumberExists() === true) {
				return 'phonenumber is tied to someone else already.';
			} else {
				return true;
			}
		}
	}

	private function phonenumberExists() {
		global $db;
		$phonenumber = $this->sanitized['phonenumber'];
		$check = $db->query("SELECT Phonenumber FROM Data WHERE Phonenumber = '{$phonenumber}' LIMIT 1");
		return ($db->countResult($check) == 1) ? true : false;
	}

}

?>