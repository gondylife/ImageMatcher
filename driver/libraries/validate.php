<?php

namespace App\Libs\Validate;
use App\User\Account as User;

function validateName ($value) {
	$length = strlen($value);
	if ($length < 2 || $length > 24 || !preg_match("/^([a-zA-Z]+\-)?[a-zA-Z]+$/", $value)) {
		$error = 'Invalid name.';
	}
	return (isset($error)) ? $error : true;
}

function validateUsername ($value) {
	$length = strlen($value);
	if ($length < 5 || $length > 32) {
		$error = 'Must be 5-32 characters long.';
	} else if (!preg_match("/^[-a-zA-Z0-9\.]+$/", $value)) {
		$error = 'Contains unsupported characters.';
	} else if (User::exists($value, 'username')) {
		$error = 'Username already taken.';
	}
	return (isset($error)) ? $error : true;
}

function validateEmail ($value) {
	if (!preg_match("/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z].)+[a-zA-Z]{2,9}$/", $value)) {
		$error = 'Invalid email address.';
	} else if (User::exists($value, 'email')) {
		$error = 'Email already exists.';
	}
	return (isset($error)) ? $error : true;
}

function validatePassword ($value) {
	$length = strlen($value);
	if ($length < 7) {
		$error = 'Must be at least 7 characters.';
	}
	return (isset($error)) ? $error : true;
}

function validatePhone ($value) {
	if (!preg_match("/^\d{11,14}$/", $value)) {
		$error = 'Invalid phone number.';
	} else if (User::exists($value, 'phone')) {
		$error = 'Phone number already exists in directory.';
	}
	return (isset($error)) ? $error : true;
}

function validateAddress ($value) {
	if (!preg_match("/^[-a-zA-Z0-9]+$/", $value)) {
		$error = 'Invalid address.';
	}
	return (isset($error)) ? $error : true;
}

function validateCity ($value) {
	if (!preg_match("/^([a-zA-Z]+[-\s]?)?[a-zA-Z]+$/", $value)) {
		$error = 'Invalid city.';
	}// else if (User::exists($value, 'phone')) {
	// 	$error = 'Phone number already exists in directory.';
	// }
	return (isset($error)) ? $error : true;
}

function validateCountry ($value) {
	if (!preg_match("/^[a-zA-Z]+$/", $value)) {
		$error = 'Invalid country.';
	} //else if (User::exists($value, 'phone')) {
	// 	$error = 'Phone number already exists in directory.';
	// }
	return (isset($error)) ? $error : true;
}

?>