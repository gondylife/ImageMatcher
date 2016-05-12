<?php

require_once('../config.php');
use App\Admin\ImageMatch;

$data = array(
	'id' => 'TigerWoods'
);

die(var_dump((new ImageMatch)->viewEntry($data)));

?>