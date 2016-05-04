<?php

namespace App\Libs\Keygen;

function generateID ($length = 16) {
	$chars = str_shuffle('3759402687094152031368921');
	$chars = str_shuffle(str_repeat($chars, ceil($length / 16)));
	$count = strlen($chars);
	return strrev(str_shuffle(substr($chars, mt_rand(0, ($count - $length -1)), $length)));
}

function generateRandKey ($length = 24) {
	$long = '';
	$chars = array();
	$key = '';
	array_push($chars, range(0, 9), range('a', 'z'), range(0, 9), range('A', 'Z'), range(0, 9));
	foreach ($chars as $set) {
		$long .= str_rot13(str_shuffle(implode('', $set)));
		$long = str_shuffle($long);
	}
	$split = ceil($length / 5);
	$size = strlen($long);
	$splitSize = ceil($size / $split);
	$chunkSize = $splitSize + mt_rand(1, 5);
	$chunkArray = array();
	while ($split != 0) {
		$strip = substr($long, mt_rand(0, $size - $chunkSize), $chunkSize);
		array_push($chunkArray, strrev($strip));
		$split--;
	}
	foreach ($chunkArray as $set) {
		$adjust = ((($length - strlen($key)) % 5) == 0) ? 5 : ($length - strlen($key)) % 5;
		$setSize = strlen($set);
		$key .= substr($set, mt_rand(0, $setSize - $adjust), $adjust);
	}
	return str_rot13(str_shuffle($key));
}

?>