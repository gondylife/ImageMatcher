<?php

namespace App\Admin;
use App\Admin\ImageMatch;
use App\Admin\ConsumeImageMatch;
use App\User\Register;
use App\User\Login;

class Npfims {

	public static function register() {
		die(json_encode((new Register)->register()));
	}

	public static function login() {
		return (new Login)->login();
	}

	public static function newEntry() {
		return (new ConsumeImageMatch)->addNewEntry();
	}

	public static function rebuildAlbum() {
		return (new ImageMatch)->rebuildAlbum();
	}

	public static function viewEntry($data) {
		return (new ImageMatch)->viewEntry($data);
	}

	public static function updateImageCount($data) {
		return (new ConsumeImageMatch)->updateImageCount($data);
	}

	public static function retrieveEntry($data) {
		return (new ConsumeImageMatch)->retrieveEntry($data);
	}

	public static function updateEntryDetails($data) {
		return (new ConsumeImageMatch)->editEntry($data);
	}

	public static function retrieveAllPersonnels() {
		return (new ConsumeImageMatch)->retrieveAllPersonnels();
	}

	public static function retrieveAllEntries() {
		return (new ConsumeImageMatch)->retrieveAllEntries();
	}

	public static function addMoreImages($dataArrray) {
		return (new ConsumeImageMatch)->addMoreImages($dataArrray);
	}

	public static function detectFace($data) {
		return (new ConsumeImageMatch)->detectFace($data);
	}

	public static function recognizeFace($data) {
		return (new ConsumeImageMatch)->recognizeFace($data);
	}

	public static function retrieveDetails($entryID) {
		return (new ConsumeImageMatch)->retrieveDetails($entryID);
	}

	public static function deactivate($data) {
		return (new Register)->deactivate($data);
	}

	public static function activate($data) {
		return (new Register)->activate($data);
	}

	public static function delete($data) {
		return (new Register)->delete($data);
	}

	public static function logout() {
		unset($_SESSION['PID']);
		unset($_SESSION['redirect']);
		unset($_SESSION['firstname']);
		unset($_SESSION['role']);
		return (!isset($_SESSION['PID'])) ? array('redirect' => BASE_URL) : false;
	}

}

?>