<?php

namespace App\Admin;
use App\Admin\ImageMatch;
use App\Core\Database;
use App\Libs\Keygen;

class ConsumeImageMatch {

	private $firstname, $lastname, $othername, $dob, $sex, $phonenumber, $emailaddress, $homeaddress, $occupation, $workplace, $workaddress;

	public function __construct() {
		$headers = apache_request_headers();
		$this->fetchData();
	}

	private function fetchData() {
		if ($_POST) {
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
	}

	public function addEntry() {
		global $db;
		if (empty($this->firstname) || empty($this->lastname) || empty($this->dob) || empty($this->sex) || empty($this->phonenumber) || empty($this->emailaddress) || empty($this->homeaddress)) {
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

		if ($this->checkEmail() === true AND $this->checkPhonenumber() === true) {
			$uniqueid = md5(implode(':', [$firstname, $emailaddress, Keygen\generateRandKey(32)]));

			$insert = $db->query("INSERT INTO Data(UniqueID, Firstname, Lastname, Othername, DOB, Sex, Phonenumber, EmailAddress, HomeAddress, Occupation, WorkPlace, WorkAddress) VALUES('{$uniqueid}', '{$firstname}', '{$lastname}', '{$othername}', '{$dob}', '{$sex}', '{$phonenumber}', '{$emailaddress}', '{$homeaddress}', '{$occupation}', '{$workplace}', '{$workaddress}')");
			if ($insert === true) {
				$data = array(
					'id' => $uniqueid,
					'imageURL' => 'http://google.com/godswill.jpg'
				);
				return $createAlbumEntry = (new ImageMatch)->trainAlbum($data);
			} else {
				return false;
			}
		}
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
		$emailaddress = $this->sanitized['email'];
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
		$policeid = $this->sanitized['policeid'];
		$check = $db->query("SELECT Phonenumber FROM Data WHERE Phonenumber = '{$phonenumber}' LIMIT 1");
		return ($db->countResult($check) == 1) ? true : false;
	}

}

?>