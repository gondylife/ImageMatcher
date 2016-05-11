<?php

namespace App\Admin;
use Unirest\Request;
use Unirest\file;

class ImageMatch {

	const albumName = 'CELEBS';
	const albumKey = 'b1ccb6caa8cefb7347d0cfb65146d5e3f84608f6ee55b1c90d37ed4ecca9b273';
	const urlCore = 'https://lambda-face-recognition.p.mashape.com/';
	const endpointAlbum = 'album';
	const endpointAlbumRebuild = 'album_rebuild';
	const endpointAlbumTrain = 'album_train';
	const endpointFaceDetect = 'detect';
	const endpointFaceRecognize = 'recognize';

	private function createAlbum() {
		$urlAlbumCreate = "".self::urlCore.self::endpointAlbum;
		$response = Request::post($urlAlbumCreate,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
			),
			array(
				"album" => $albumName
			)
		);
		return $response;
	}

	private function rebuildAlbum() {
		$urlAlbumRebuild = "".self::urlCore.self::endpointAlbumRebuild.'?album='.self::albumName.'&albumkey='.self::albumKey;
		$response = Request::post($urlAlbumRebuild,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Accept" => "application/json"
			)
		);
		return $response;
	}

	private function trainAlbum($data) {
		$urlAlbumTrain = "".self::urlCore.self::endpointAlbumTrain;
		$response = Request::post($urlAlbumTrain,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
			),
			array(
				"album" => self::albumName,
				"albumkey" => self::albumKey,
				"entryid" => $data['id'],
				"files" => file::add(""),
				"urls" => $data['imageURL']
			)
		);
		return $response;
	}

	private function viewAlbum() {
		$urlAlbumView = "".self::urlCore.self::endpointAlbum.'?album='.self::albumName.'&albumkey='.self::albumKey;
		$response = Request::get($urlAlbumView,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    	"Accept" => "application/json"
		  	)
		);
		return $response;
	}

	private function detectFace($data) {
		$urlFaceDetect = "".self::urlCore.self::endpointFaceDetect;
		$response = Request::post($urlFaceDetect,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
		  	),
		  	array(
		    	"files" => file::add(""),
		    	"urls" => $data['imageURL']
		  	)
		);
		return $response;
	}

	private function recognizeFace($data) {
		$urlFaceRecognize = "".self::urlCore.self::endpointFaceRecognize;
		$response = Request::post($urlFaceRecognize,
		  	array(
		  	    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
		  	),
			array(
				"album" => self::albumName,
				"albumkey" => self::albumKey,
				"files" => file::add(""),
		    	"urls" => $data['imageURL']
			)
		);
		return $response;
	}

	public function viewEntry($data) {
		$urlViewEntry = "".self::urlCore.self::endpointAlbumTrain.'?album='.self::albumName.'&albumkey='.self::albumKey.'&entryid='.$data['id'];
		$response = Request::get($urlViewEntry,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    	"Accept" => "application/json"
		  	)
		);
		return $response;
	}

	// public function testEntry() {
	// 	return "This works";
	// }

}

?>