<?php

namespace App\Admin;
use Unirest;

class ImageMatch {

	const albumName = 'NIGERIANS';
	const albumKey = '70e8fb7ff1ff861048f076588e8f728c7a9af72e9054d0f925d57d0e75b95776';
	const urlCore = 'https://lambda-face-recognition.p.mashape.com/';
	const endpointAlbum = 'album';
	const endpointAlbumRebuild = 'album_rebuild';
	const endpointAlbumTrain = 'album_train';
	const endpointFaceDetect = 'detect';
	const endpointFaceRecognize = 'recognize';

	private function createAlbum() {
		$urlAlbumCreate = "".self::urlCore.self::endpointAlbum;
		$response = Unirest\Request::post($urlAlbumCreate,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
			),
			array(
				"album" => self::albumName
			)
		);
		return $response;
	}

	public function rebuildAlbum() {
		$urlAlbumRebuild = "".self::urlCore.self::endpointAlbumRebuild.'?album='.self::albumName.'&albumkey='.self::albumKey;
		$response = Unirest\Request::post($urlAlbumRebuild,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Accept" => "application/json"
			)
		);
		return $response;
	}

	public function trainAlbum($data) {
		$urlAlbumTrain = "".self::urlCore.self::endpointAlbumTrain;
		$params = array(
			"album" => self::albumName,
			"albumkey" => self::albumKey,
			"entryid" => $data['id'],
			"urls" => $data['imageURL'],
			"files" => Unirest\file::add("".$data['imageFile'])
		);
		if (array_key_exists("imageURL", $data)) {
			unset($params['imageFile']);
		} else if (array_key_exists("imageFile", $data)) {
			unset($params['imageURL']);
		} else {
			return false;
		}
		$response = Unirest\Request::post($urlAlbumTrain,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
			),
			$params
		);
		return $response;
	}

	public function viewAlbum() {
		$urlAlbumView = "".self::urlCore.self::endpointAlbum.'?album='.self::albumName.'&albumkey='.self::albumKey;
		$response = Unirest\Request::get($urlAlbumView,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    	"Accept" => "application/json"
		  	)
		);
		return $response;
	}

	public function detectFace($data) {
		$urlFaceDetect = "".self::urlCore.self::endpointFaceDetect;
		$params = array(
			"urls" => $data['imageURL'],
			"files" => Unirest\file::add("".$data['imageFile'])
		);
		if (array_key_exists("imageURL", $data)) {
			unset($params['imageFile']);
		} else if (array_key_exists("imageFile", $data)) {
			unset($params['imageURL']);
		} else {
			return false;
		}
		$response = Unirest\Request::post($urlFaceDetect,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
		  	),
		  	$params
		);
		return $response;
	}

	private function recognizeFace($data) {
		$urlFaceRecognize = "".self::urlCore.self::endpointFaceRecognize;
		$params = array(
			"album" => self::albumName,
			"albumkey" => self::albumKey,
			"urls" => $data['imageURL'],
			"files" => Unirest\file::add("".$data['imageFile'])
		);
		if (array_key_exists("imageURL", $data)) {
			unset($params['imageFile']);
		} else if (array_key_exists("imageFile", $data)) {
			unset($params['imageURL']);
		} else {
			return false;
		}
		$response = Unirest\Request::post($urlFaceRecognize,
		  	array(
		  	    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
		  	),
			$params
		);
		return $response;
	}

	public function viewEntry($data) {
		$urlViewEntry = "".self::urlCore.self::endpointAlbumTrain.'?album='.self::albumName.'&albumkey='.self::albumKey.'&entryid='.$data['id'];
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