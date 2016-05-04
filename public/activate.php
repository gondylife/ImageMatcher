<?php

require_once('../config.php');
use App\Admin\Airtimebuy as APP;

if(isset($_GET['token'])) {
	$activate = APP::activate($_GET['token']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>AirtimeBuy - Account activation</title>
	<?php require_once(INCS_DIR.'metadata.inc.php'); ?>
</head>
<body>
	<div class="color-bar"> </div>
	<div class="account-topbar">
	   	<div class="top">
	     	<div class="logo">
	        	<img src="airtimebuy.png" height="30" >
	      	</div>
	      	<div class="lock pull-right">
	        	<i class="fa fa-plug"> </i>
	      	</div>
	   	</div>
	</div>
	<?php
		if (isset($activate) AND $activate['status'] === 'success') { ?>
			<meta http-equiv="refresh" content="5;URL='signin'" />
			<div class="alert alert-success activatebarry" role="alert"><?=$activate['message'];?></div>
	<?php } else if (isset($activate) AND $activate['status'] === 'failure') { ?>
			<div class="alert alert-danger activatebarry" role="alert"><?=$activate['message'];?></div>
	<?php } ?>
	<div id="barry">
	   	<div class="paystack foot">
	     	&copy; 2015 AirtimeBuy. All Rights Reserved.
	   	</div>
	</div>

	<?php require_once(INCS_DIR.'scripts.inc.php'); ?>
</body>
</html>