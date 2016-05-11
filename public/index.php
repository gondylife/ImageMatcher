<?php

require_once('../config.php');
use App\Admin\ImageMatch;

$data = array(
	'id' => 'TigerWoods'
);
die((new ImageMatch)->viewEntry($data));
// var_dump(class_exists("Unirest\Request"));

?>