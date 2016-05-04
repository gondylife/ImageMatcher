<?php

require_once '../config.php';

?>

<html>
<head>
	<title>AirtimeBuy - Account creation</title>
	<?php require_once INCS_DIR . 'metadata.inc.php';?>
</head>
<body>
	<div class="color-bar"> </div>
	<div class="account-topbar">
	   	<div class="signuptop">
	     	<div class="logo">
	        	<img src="airtimebuy.png" height="30" >
	      	</div>
	      	<div class="lock pull-right">
	        	<i class="fa fa-user"> </i>
	      	</div>
	   	</div>
	</div>
	<div class="signupbarry">
	   	<form role="form" method="post" action="" id="form_signup">
	     	<div class="signuppaystack">
		        <div id="alert-container" class="alert " role="alert" style="border-radius: 0;"></div>
	         	<div class="signupformholder">
	         		<div class="row">
		         		<div class="form-group" style="float: left; width: 49%;">
			               <label>Firstname</label>
			            	<input type="text" class="form-control"  placeholder="Firstname"  id ="firstname" name="firstname" required />
			            </div>
			            <div class="form-group" style="float: right; width: 49%;">
			               <label>Lastname</label>
			            	<input type="text" class="form-control"  placeholder="Lastname"  id="lastname" name="lastname" required />
			            </div>
		            </div>
		            <div class="row">
			            <div class="form-group" style="float: left; width: 49%;">
			               <label>Username</label>
			            	<input type="text" class="form-control"  placeholder="Username"  id="username" name="username" required />
			            </div>
			            <div class="form-group" style="float: right; width: 49%;">
			               <label>Password</label>
			            	<input type="password" class="form-control" placeholder="Password" id="password" name="password" required />
			            </div>
		            </div>
		            <div class="row">
			            <div class="form-group" style="float: left; width: 49%;">
			               <label>Email</label>
			            	<input type="email" class="form-control" placeholder="Email" id="email" name="email" required />
			            </div>
			            <div class="form-group" style="float: right; width: 49%;">
			               <label>Phone Number</label>
			               <?php if (isset($_SESSION['phonenumber'])) {?>
			               <input type="text" class="form-control"  placeholder="Phonenumber" value="<?=$_SESSION['phonenumber']?>" id="phonenumber" name="phonenumber" required />
			               <?php } else {?>
			               <input type="text" class="form-control" placeholder="Phonenumber" id="phonenumber" name="phonenumber" required />
			               <?php }
?>
			            </div>
			        </div>
		            <div class="form-group">
		               <p> &nbsp; </p>
		            </div>
	         	</div>
	      	</div>
	      	<div class="signupbtnholder">
	        	<button type="submit" class="btn btn-success btn-block btn-round">Sign Up</button>
	      	</div>
	   	</form>
	</div>
	<div id="barry">
	   	<div class="signuppaystack foot">
	     	&copy; 2015 AirtimeBuy. All Rights Reserved.
	   	</div>
	</div>

	<?php require_once INCS_DIR . 'scripts.inc.php';?>
</body>
</html>