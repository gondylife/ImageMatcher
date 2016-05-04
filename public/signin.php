<?php

require_once('../config.php');

?>

<html>
<head>
	<title>AirtimeBuy - Account sign In</title>
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
	        	<i class="fa fa-lock"> </i>
	      	</div>
	   	</div>
	</div>
	<div class="barry">
	   	<form role="form" method="post" action="" id="form_signin">
	     	<div class="paystack">
		        <div id="alert-container" class="alert " role="alert" style="border-radius: 0;"></div>
	         	<div class="formholder">
		            <div class="form-group ">
		               <label>Email</label>
		            	<input type="email" class="form-control"  placeholder="Email"  id="email" name="email" required />
		            </div>
		            <div class="form-group">
		               <label>Password</label>
		               <input type="password" class="form-control"  placeholder="Password"  id="password" name="password"  required />
		            </div>
		            <div class="form-group">
		               <p> &nbsp; </p>
		            </div>
	         	</div>
	      	</div>
	      	<div class="btnholder">
	        	<button type="submit" class="btn btn-success btn-block btn-round">Sign In</button>
	      	</div>
	   	</form>
	</div>
	<div id="barry">
	   	<div class="paystack foot">
	     	&copy; 2015 AirtimeBuy. All Rights Reserved.
	   	</div>
	</div>

	<?php require_once(INCS_DIR.'scripts.inc.php'); ?>
</body>
</html>