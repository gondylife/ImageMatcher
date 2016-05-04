<?php

namespace App\Libs\Utils;

function insertQueryFromArray($array, $table) {
	$sql = "INSERT INTO {$table} (";
	$sql .= implode(', ', array_keys($array));
	$sql .= ") VALUES ('";
	$sql .= implode("', '", array_values($array));
	$sql .= "')";
	return $sql;
}

function updateQueryFromArray($array, $table, $checkField) {
	$sql = "UPDATE {$table} SET ";
	$pairs = array();
	foreach ($array as $key => $value) {
		$pair = "{$key} = '{$value}'";
		if ($key === $checkField) {
			$check = $pair;
			continue;
		}
		array_push($pairs, $pair);
	}
	$sql .= implode(', ', $pairs);
	$sql .= " WHERE {$check}";
	return $sql;
}

?>