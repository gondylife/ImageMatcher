<?php

namespace App\Admin;
use Unirest;

class ImageMatch {

	private static $albumName = 'NIGERIANS';
	private static $albumKey = '70e8fb7ff1ff861048f076588e8f728c7a9af72e9054d0f925d57d0e75b95776';
	private static $urlCore = 'https://lambda-face-recognition.p.mashape.com/';
	private static $endpointAlbum = 'album';
	private static $endpointAlbumRebuild = 'album_rebuild';
	private static $endpointAlbumTrain = 'album_train';
	private static $endpointFaceDetect = 'detect';
	private static $endpointFaceRecognize = 'recognize';

	private function createAlbum() {
		$urlAlbumCreate = self::$urlCore.self::$endpointAlbum;
		$response = Unirest\Request::post($urlAlbumCreate,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
			),
			array(
				"album" => self::$albumName
			)
		);
		return $response;
	}

	public function rebuildAlbum() {
		$urlAlbumRebuild = self::$urlCore.self::$endpointAlbumRebuild.'?album='.self::$albumName.'&albumkey='.self::$albumKey;
		$response = Unirest\Request::post($urlAlbumRebuild,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Accept" => "application/json"
			)
		);
		return $response;
	}

	public function trainAlbum($data) {
		$urlAlbumTrain = self::$urlCore.self::$endpointAlbumTrain;
		$body = array(
			"album" => self::$albumName,
			"albumkey" => self::$albumKey,
			"entryid" => $data['id']
		);
		if (array_key_exists("imageURL", $data)) {
			$body['urls'] = urldecode($data['imageURL']);
		}
		if (array_key_exists("imageFile", $data)) {
			$body['files'] = Unirest\Request\Body::file($data['imageFile']);
		}
		$response = Unirest\Request::post($urlAlbumTrain,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
			),
			$body
		);
		return $response;
	}

	public function viewAlbum() {
		$urlAlbumView = self::$urlCore.self::$endpointAlbum.'?album='.self::$albumName.'&albumkey='.self::$albumKey;
		$response = Unirest\Request::get($urlAlbumView,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    	"Accept" => "application/json"
		  	)
		);
		return $response;
	}

	public function detectFace($data) {
		$urlFaceDetect = self::$urlCore.self::$endpointFaceDetect;
		$body = array();
		if (array_key_exists("imageURL", $data)) {
			$body['urls'] = urldecode($data['imageURL']);
		}
		if (array_key_exists("imageFile", $data)) {
			$body['files'] = Unirest\Request\Body::file($data['imageFile']);
		} 
		$response = Unirest\Request::post($urlFaceDetect,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
		  	),
		  	$body
		);
		return $response;
	}

	private function recognizeFace($data) {
		$urlFaceRecognize = self::$urlCore.self::$endpointFaceRecognize;
		$body = array(
			"album" => self::$albumName,
			"albumkey" => self::$albumKey
		);
		if (array_key_exists("imageURL", $data)) {
			$body['urls'] = urldecode($data['imageURL']);
		}
		if (array_key_exists("imageFile", $data)) {
			$body['files'] = Unirest\Request\Body::file($data['imageFile']);
		} 
		$response = Unirest\Request::post($urlFaceRecognize,
		  	array(
		  	    "X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
		  	),
			$body
		);
		return $response;
	}

	public function viewEntry($data) {
		$urlViewEntry = self::$urlCore.self::$endpointAlbumTrain.'?album='.self::$albumName.'&albumkey='.self::$albumKey.'&entryid='.$data['id'];
		$response = Unirest\Request::get($urlViewEntry,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    	"Accept" => "application/json"
		  	)
		);
		return $response;
	}

}

?>