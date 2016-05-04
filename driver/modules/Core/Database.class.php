<?php

namespace App\Core;
use \Exception as Exception;

class Database {

	const HOST = DB_HOST;
	const USER = DB_USER;
	const PSWD = DB_PSWD;
	const NAME = DB_NAME;

	const RESULT_ARRAY = 1;
	const RESULT_ASSOC = 2;

	private $connection, $magicQuotesActive, $realEscapeStringExists;

	public function __construct () {
		$this->connect();
		$this->magicQuotesActive = get_magic_quotes_gpc();
		$this->realEscapeStringExists = function_exists("mysql_real_escape_string");
	}

	private function connect () {
		$this->connection = @mysql_connect(self::HOST, self::USER, self::PSWD);
		if (!$this->connection) {
			die('DB Connection failed: '.mysql_error());
		} else {
			$db_select = mysql_select_db(self::NAME, $this->connection);
			if (!$db_select) {
				die('DB Selection failed: '.mysql_error());
			}
		}	
	}

	public function escapeValue ($value) {
		if ($this->realEscapeStringExists) {
			if ($this->magicQuotesActive) {
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		} else {
			if (!$this->magicQuotesActive) {
				$value = addslashes($value);
			}
		}
		return $value;
	}

	public function query ($sql) {
		$result = mysql_query($sql, $this->connection);
		if (!$result) {
			return false;
		}
		$this->confirmQuery($result);
		return $result;
	}

	private function confirmQuery ($result) {
		if (!$result) {
			die("Database query failed: ". mysql_error());
		}
	}

	public function execute ($sql, $format = self::RESULT_ARRAY) {
		global $db;
		$result = array();
		$query = $db->query($sql);
		while ($row = $db->fetchResult($query, $format)) {
			$result[] = $row;
		}
		return $result;
		return (count($result) == 1) ? $result[0] : $result;
	}

	public function fetchResult ($result, $format = self::RESULT_ARRAY) {
		switch ($format) {
			case self::RESULT_ARRAY:
				return mysql_fetch_array($result);
				break;
			case self::RESULT_ASSOC:
				return mysql_fetch_assoc($result);
				break;
			default:
				return false;
		}
	}

	public function countResult ($result = '') {
		if (empty($result)) {
			return mysql_affected_rows($this->connection);
		} else {
			$rows = mysql_num_rows($result); 
			if ($rows) {
				return mysql_num_rows($result);
			} else {
				return;
			}
		}
	}

}

?>