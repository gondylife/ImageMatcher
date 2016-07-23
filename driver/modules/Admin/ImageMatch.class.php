<?php

namespace App\Admin;
use Unirest;

class ImageMatch {

	private static $galleryName = 'NIGERIANS';
	private static $urlCore = 'https://kairos-face-recognition.p.mashape.com/';
	private static $appID = 'efab5466';
	private static $appKey = '5922a2fcfb365182e6c0f871f3a6459a';
	private static $endpointEnroll = 'enroll';
	private static $endpointDetect = 'detect';
	private static $endpointRecognize = 'recognize';

	private function enrollToGallery($data) {
		$urlEnrollToGallery = self::$urlCore.self::$endpointEnroll;
		$response = Unirest\Request::post($urlEnrollToGallery,
		  array(
		    "X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    "Content-Type" => "application/json",
		    "app_id" => self::$appID,
		    "app_key" => self::$appKey,
		    "Accept" => "application/json"
		  )
		  {
		  	"url": $data['imageURL'],
		    "gallery_name": self::$galleryName,
		    "subject_id": $data['id']
		  }
		);
		return $response;
	}

	public function detectFace($data) {
		$urlFaceDetect = self::$urlCore.self::$endpointDetect;
		$response = Unirest\Request::post($urlFaceDetect,
		  	array(
		    "X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    "Content-Type" => "application/json",
		    "app_id" => self::$appID,
		    "app_key" => self::$appKey,
		    "Accept" => "application/json"
		  )
		  {
		  	"url": $data['imageURL'],
		  	"selector": "FULL"
		  }
		);
		return $response;
	}

	private function recognizeFace($data) {
		$urlFaceRecognize = self::$urlCore.self::$endpointRecognize;
		$response = Unirest\Request::post($urlFaceRecognize,
		  	array(
		    "X-Mashape-Key" => "6eausabVMPmshTIsH6RFSxyjGtDDp1PeoG8jsn7XOLkw57PKs5",
		    "Content-Type" => "application/json",
		    "app_id" => self::$appID,
		    "app_key" => self::$appKey,
		    "Accept" => "application/json"
		  )
		  {
		    "url": $data['imageURL'],
		    "gallery_name": self::$galleryName,
		    "threshold": ".7",
		    "max_num_results": "3"
		  }
		);
		return $response;
	}

}

?>