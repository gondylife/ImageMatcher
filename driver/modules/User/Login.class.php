<?php

namespace App\User;
use App\Core\Database;

class Login {

	private $policeid, $secret;

	public function __construct () {
		$headers = apache_request_headers();
		$this->fetchData();
	}

	private function fetchData () {
		if ($_POST) {
			foreach ($_POST as $field => $value) {
				if (!isset($value) || empty($value)) {
					return false;
				}
			}
			$this->policeid = $_POST['policeid'];
			$this->secret = $_POST['secret'];
			$this->sanitizeData();
		}
	}

	private function sanitizeData () {
		global $db;
		$this->sanitized['policeid'] = $db->escapeValue($this->policeid);
		$this->sanitized['secret'] = $db->escapeValue($this->secret);
	}

	public function loginPersonnel () {
		global $db;
		if (empty($this->policeid) || empty($this->secret)) {
			return 'Please fill-up required fields.';
		}

		$policeid = $this->sanitized['policeid'];
		$secret = md5($this->sanitized['secret']);

		if ($this->checkPoliceID() === true) {
			$time = date('Y-m-d H:i:s', time());
			$login = $db->query("SELECT * FROM Access WHERE PoliceID = '{$policeid}' AND Secret = '{$secret}' AND Status = '1'");
			if ($db->countResult($login) === 1) {
				return true;
			} else {
				return 'Login Failed. You may not have access yet or your account is inactive. Contact the admin.';
			}
		} else {
			return $this->checkPoliceID();
		}
		return 'Invalid Login request.';
	}

	private function checkPoliceID() {
		if (empty($this->policeid)) {
			return 'Please enter police ID.';
		} else {
			return true;
		}
	}

	private function getRedirectURL () {
		global $db;
		$policeid = $this->sanitized['policeid'];
		$retriveRole = $db->query("SELECT Role FROM Access WHERE PoliceID = '{$policeid}' LIMIT 1");
		$role = $db->fetchResult($retriveRole, Database::RESULT_ASSOC)['Role'];
		if ($role === 'A') {
			return BASE_URL.'admin';
		}
		if ($role === 'P') {
			return BASE_URL.'internal';
		}
	}

	private function getFirstName () {
		global $db;
		$policeid = $this->sanitized['policeid'];
		$retriveRole = $db->query("SELECT Firstname FROM Access WHERE PoliceID = '{$policeid}' LIMIT 1");
		$firstname = $db->fetchResult($retriveRole, Database::RESULT_ASSOC)['Firstname'];
		return $firstname;
	}

	public function response () {
		$login = $this->loginPersonnel();
		$response = array('status' => (($login === true) ? 'success' : 'failure'), 'message' => (($login === true) ? 'Login Successful.' : $login));
		$redirect = $this->getRedirectURL();
		$firstname = $this->getFirstName();
		($login === true) && $response = array_merge($response, array('Firstname' => $firstname, 'PoliceID' => $this->policeid,  'redirect' => $redirect));
		return $response;
	}

	public function login() {
		$response = $this->response();
		if ($response['status'] === 'success') {
			//Add an audit trail for successful Login here.
			//Save to the Audit table, parameters include: Action, By, DateTime
		}
		return $response;
	}
}

?>