<?php

require_once('../config.php');
use App\Admin\Airtimebuy;

if(isset($_POST)) {
  Airtimebuy::signup();
}

?>