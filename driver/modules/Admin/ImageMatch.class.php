<?php

namespace App\Admin;
use App\Core\Database;
use App\Libs\Keygen;
require_once '../../libraries/unirest-php/src/Unirest.php';

class ImageMatch {

	private $albumName = 'NIGERIANS';
	private $albumKey = '70e8fb7ff1ff861048f076588e8f728c7a9af72e9054d0f925d57d0e75b95776';
	private $urlCore = 'https://lambda-face-recognition.p.mashape.com/';
	private $endpointAlbum = 'album';
	private $endpointAlbumRebuild = 'album_rebuild';
	private $endpointAlbumTrain = 'album_train';
	private $endpointFaceDetect = 'detect';
	private $endpointFaceRecognize = 'recognize';

	private function createAlbum() {
		$urlAlbumCreate = "".$urlCore.$endpointAlbum;
		$response = Unirest\Request::post($urlAlbumCreate,
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
		$urlAlbumRebuild = "".$urlCore.$endpointAlbumRebuild.'?album='.$albumName.'&albumkey='.$albumKey;
		$response = Unirest\Request::post($urlAlbumRebuild,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Accept" => "application/json"
			)
		);
		return $response;
	}

	private function trainAlbum($data) {
		$urlAlbumTrain = "".$urlCore.$endpointAlbumTrain;
		$response = Unirest\Request::post($urlAlbumTrain,
			array(
				"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Accept" => "application/json"
			),
			array(
				"album" => $albumName,
				"albumkey" => $albumKey,
				"entryid" => $data['id'],
				"files" => Unirest\file::add(""),
				"urls" => $data['imageURL']
			)
		);
		return $response;
	}

	private function viewAlbum() {
		$urlAlbumView = "".$urlCore.$endpointAlbum.'?album='.$albumName.'&albumkey='.$albumKey;
		$response = Unirest\Request::get($urlAlbumView,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    	"Accept" => "application/json"
		  	)
		);
		return $response;
	}

	private function detectFace($data) {
		$urlFaceDetect = "".$urlCore.$endpointFaceDetect;
		$response = Unirest\Request::post($urlFaceDetect,
		  	array(
		    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
		  	),
		  	array(
		    	"files" => Unirest\file::add(""),
		    	"urls" => $data['imageURL']
		  	)
		);
		return $response;
	}

	private function recognizeFace($data) {
		$urlFaceRecognize = "".$urlCore.$endpointFaceRecognize;
		$response = Unirest\Request::post($urlFaceRecognize,
		  	array(
		  	    	"X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5"
		  	),
			array(
				"album" => $albumName,
				"albumkey" => $albumKey,
				"files" => Unirest\file::add(""),
		    	"urls" => $data['imageURL']
			)
		);
		return $response;
	}

	private function viewEntry($data) {
		$urlViewEntry = "".$urlCore.$endpointAlbumTrain.'?album='.$albumName.'&albumkey='.$albumKey.'&entryid='.$data['id'];
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