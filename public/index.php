<?php

require_once '../config.php';

if (isset($_POST['submitphone']) && isset($_POST['phonenumber'])) {
	$_SESSION['phonenumber'] = $_POST['phonenumber'];
	header('location: signup');
}
?>

<html>
<head>
	<title>AirtimeBuy - Recharge online directly</title>
	<?php require_once INCS_DIR . 'metadata.inc.php';?>
</head>
<body>
	<div class="wrap">
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<a href="index" class="logo" title="AirtimeBuy">AirtimeBuy</a>
						<nav class="menu">
							<ul>
								<li><a href="signup">Sign Up</a></li>
								<li>
								<a class="login" href="signin">
								<button class="login">Sign in</button>
								</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="hero">
		   	<div class="container">
		      	<div class="row">
		         	<div class="col-md-8 fadeIn animated">
		            	<h1>Recharge online with ease...</h1>
		            	<p style="font-size:20px;">Whatever your network, get your line automatically credited right away.</p>
			            <div class="searchinput">
			               	<div class="row">
			               		<form method="post" id="phoneform">
			                     	<div class="col-sm-7">
			                        	<input type="text" placeholder="+2348035134649" autofocus="" name="phonenumber" required>
			                     	</div>
				                    <div class="col-sm-5 offsetleft">
				                    	<button class="large-btn bounce animated" type="submit" form="phoneform" name="submitphone">Get Started</button>
				                    </div>
			                    </form>
			               	</div>
			            </div>
		        	</div>
		      	</div>
		   	</div>
		</div>
		<div class="color-bar" id="next">
        </div>
        <div class="testimonials">
            <div class="container">
               <div class="row">
                  <div class="col col-sm-12 quote-header">
                     <h3>Prepaid plan online recharge.</h3>
                     <p>You can safely recharge both Nigerian providers as well as providers for 7+ other countries worldwide. Friends and family abroad can also top up your Nigerian phone credit online at AirtimeBuy.com. Recharge phone credit immediately in a safe and fast way. After payment, the phone credit is automatically added to the remaining prepaid balance.</p>
                  </div>
               </div>
            </div>
        </div>
        <div class="features">
            <div class="container">
               	<div class="row">
                  	<div class="col-sm-6 item midline">
	                    <img src="recurring.png" >
	                    <h3>Manage Subscriptions</h3>
	                    <p>Easily manage one-off and scheduled top-ups. Attach phone numbers to plans, and we take care of recharging them every month (or week, day, or year).</p>
                  	</div>
	                <div class="col-sm-6 item">
	                    <img src="security.png" >
	                    <h3>Security & Compliance</h3>
	                    <p>All data is securely transmitted and encrypted. PCI Compliance, 3-D Secure, HTTPS, SSL encryption  - all in one place and without the hassle.</p>
	                 </div>
	                 <div class="col-sm-6 item midline">
	                    <img src="dashboard.png" >
	                    <h3>Easy to use Dashboard </h3>
	                    <p>Our simple online dashboard and sms notifications keep you updated with comprehensive information on all recharges.</p>
	                 </div>
                  	<div class="col-sm-6 item item">
	                    <img src="support.png" >
	                    <h3>Excellent Customer Support</h3>
	                    <p>We understand the importance of staying close to our customers and we will do everything we can to support you.</p>
                  	</div>
               	</div>
            </div>
        </div>
        <div class="testimonials purple">
            <div class="container">
               	<div class="row">
                  	<div class="col-sm-12 quote-header">
	                    <h3>Start recharging directly online today..</h3>
	                    <p>AirtimeBuy is quick and easy, you complete the initial setup once and thereafter recharge in less than 2 minutes.
		                    <br/>
		                    <a href="mailto:hello@airtimebuy.com" style="color:#ff9900">hello@airtimebuy.com</a>
	                    </p>
                  	</div>
               	</div>
            </div>
        </div>
        <div id="footer">
            <div class="container">
               	<div class="row">
                  	<div class="col-sm-12 clearfix">
                    	&copy; 2015 AirtimeBuy. All Rights Reserved.
                  	</div>
               	</div>
            </div>
        </div>
	</div>

	<?php require_once INCS_DIR . 'scripts.inc.php';?>
</body>
</html>