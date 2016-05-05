<?php

namespace App\User;
use App\Libs\Keygen;

class Register {

	const SUBJECT = 'Image Matching System Credentials';
	private static $table = "Access";

	private $firstname, $lastname, $policeid, $emailaddress, $role, $secret;

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
			$this->policeid = $_POST['policeid'];
			$this->emailaddress = $_POST['emailaddress'];
			$this->role = $_POST['role'];
			$this->sanitizeData();
		}
	}

	private function sanitizeData() {
		global $db;
		$this->sanitized['firstname'] = $db->escapeValue($this->firstname);
		$this->sanitized['lastname'] = $db->escapeValue($this->lastname);
		$this->sanitized['policeid'] = $db->escapeValue($this->policeid);
		$this->sanitized['emailaddress'] = $db->escapeValue($this->emailaddress);
		$this->sanitized['role'] = $db->escapeValue($this->role);
	}

	public function registerPersonnel() {
		global $db;
		if (empty($this->firstname) || empty($this->lastname) || empty($this->policeid) || empty($this->emailaddress) || empty($this->role)) {
			return 'Please fill-up required fields.';
		}

		$firstname = $this->sanitized['firstname'];
		$lastname = $this->sanitized['lastname'];
		$policeid = $this->sanitized['policeid'];
		$emailaddress = $this->sanitized['emailaddress'];
		$role = $this->sanitized['role'];

		if ($this->checkPoliceID() === true AND $this->checkEmail() === true) {

			$this->$secret = md5(implode(':', [$policeid, $email, Keygen\generateRandKey(10)]));
			$datetime = date('Y-m-d H:i:s', time());
			$data = array(
				'Firstname' => $firstname,
				'Lastname' => $lastname,
				'PoliceID' => $policeid,
				'EmailAddress' => $emailaddress,
				'Role' => $role,
				'Secret' => $this->$secret,
				'DateTime' => $datetime
			);

			$insert = $db->query(Utils\insertQueryFromArray($data, self::$table));

			if ($insert) {
				return true;
			} else {
				return 'Account creation successful.';
			}
		} else {
			return $this->checkEmail();
		}
		return 'Invalid Account creation request.';
	}

	private function checkPoliceID() {
		if (empty($this->policeid)) {
			return 'Please enter police ID.';
		} else {
			if ($this->policeIDExists() === true) {
				return 'Police ID is tied to an account already.';
			} else {
				return true;
			}
		}
	}

	private function policeIDExists() {
		global $db;
		$policeid = $this->sanitized['policeid'];
		$check = $db->query("SELECT PoliceID FROM Access WHERE PoliceID = '{$policeid}' LIMIT 1");
		return ($db->countResult($check) == 1) ? true : false;
	}

	private function checkEmail() {
		if (empty($this->emailaddress)) {
			return 'Please enter email address.';
		} else {
			if (filter_var($this->emailaddress, FILTER_VALIDATE_EMAIL) === false) {
				return 'Email address is invalid.';
			} else {
				if ($this->emailExists() === true) {
					return 'Email address is tied to an account already.';
				} else {
					return true;
				}
			}
		}
	}

	private function emailExists() {
		global $db;
		$emailaddress = $this->sanitized['email'];
		$check = $db->query("SELECT EmailAddress FROM Access WHERE EmailAddress = '{$emailaddress}' LIMIT 1");
		return ($db->countResult($check) == 1) ? true : false;
	}

	public function response() {
		$register = $this->registerPersonnel();
		$response = array('status' => (($register === true) ? 'success' : 'failure'), 'message' => (($register === true) ? 'Account created successfully. We have emailed credentials to the email address provided.' : $register));
		return $response;
	}

	private function setHeaders($headers = array()) {
		$this->headers = "";
		$mailheaders = array(
			"From" => "NPF Image Matching System <hello@npfims.com>",
			"MIME-Version" => "1.0",
			"Content-Type" => "text/html; charset=ISO-8859-1",
		);
		if (isset($headers) && is_array($headers) && count(array_keys($headers)) != 0) {
			foreach ($headers as $key => $value) {
				if (is_integer($key)) {
					continue;
				}
				if (!strpos('-', $key)) {
					$key = ucfirst($key);
				} else {
					$key = explode('-', $key);
					$strips = array();
					foreach ($key as $str) {
						array_push($strips, ucfirst($str));
					}
					$key = implode('-', $strips);
				}
				if (array_key_exists($key, $mailheaders)) {
					continue;
				}
				$mailheaders[$key] = $value;
			}
		}
		foreach ($mailheaders as $header => $value) {
			$this->headers .= $header . ": " . $value . "\r\n";
		}
		return $this;
	}

	private function setContent() {
		$message = '<html><body>';
		$message .= '<p>Hello ' . $this->firstname . ',</p>';
		$message .= '<p>&nbsp;</p>';
		$message .= '<p>Welcome to NPF Image Matching System.</p>';
		$message .= '<p>Find your login credentials below:</p>';
		$message .= '<p>URL: <a href="http://npfims.com">http://npfims.com</a></p>';
		$message .= '<p>Secret: ' . $this->$secret . '</p>';
		$message .= '<p>Visit the URL(above), enter your police ID and secret(above) to gain access </p>';
		$message .= '<p>&nbsp;</p>';
		$message .= '<p>Best Wishes,</p>';
		$message .= '<p>The NPF IMS Team.</p>';
		$message .= "</body></html>";
		$this->body = $message;
		return $this;
	}

	protected function sendMail($headers = array()) {
		$this->setHeaders($headers)->setContent();
		$send = mail($this->emailaddress, self::SUBJECT, $this->body, $this->headers);
		return ($send) ? true : false;
	}

	public function register() {
		$response = $this->response();
		if ($response['status'] === 'success') {
			$mail = $this->sendMail();
		}
		return array('message' => $response['message'], 'status' => $response['status'], 'sendmail' => isset($mail) ? $mail : "Mail function not called");
	}
}

?>