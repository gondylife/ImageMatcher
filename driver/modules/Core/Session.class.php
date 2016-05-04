<?php

namespace App\Core;

class Session {

	private $data;

	public function __construct () {
		session_start();
		$this->data = (isset($_SESSION)) ? $_SESSION : array();
	}

	public function setData ($label, $value, $prefix = '') {
		$prefix = (isset($prefix) && is_string($prefix) && strlen($prefix) > 0) ? $prefix.'_' : '';
		if (is_string($label)) {
			$this->data[$prefix.$label] = $_SESSION[$prefix.$label] = $value;
			return true;
		} else if (is_array($label) && is_array($value)) {
			$len = count($label);
			if ($len === count($value)) {
				$set = true;	
				foreach ($label as $name) {
					if (!is_string($name)) {
						$set = false;
						break;
					}
				}
				if ($set === true) {
					for ($i = 0; $i < $len; $i++) {
						$this->data[$prefix.$label[$i]] = $_SESSION[$prefix.$label[$i]] = $value[$i];
					}
					return true;
				}
			}
		}
		die('Could not map labels to values');
	}

	public function getData () {
		$args = func_get_args();
		$count = count($args);
		if ($count == 0) {
			return $this->data;
		} else if ($count == 1) {
			return ($this->exists($args[0])) ? $this->data[$args[0]] : null;
		} else {
			$data = array();
			foreach ($args as $label) {
				if ($this->exists($label)) {
					$data[$label] = $this->data[$label];
				}
			}
			return $data;
		}
	}

	public function exists ($label) {
		return (array_key_exists($label, $_SESSION) && is_string($label)) ? true : false;
	}

	public function destroy () {
		$args = func_get_args();
		$count = count($args);
		if ($count == 0) {
			$this->data = array();
			$_SESSION = array();
			session_destroy();
		} else {
			foreach ($args as $label) {
				if ($this->exists($label)) {
					unset($this->data[$label]);
					unset($_SESSION[$label]);
				}
			}
		}
	}

}

?>