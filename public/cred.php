<?php

require_once('../config.php');

if (!isset($_SESSION['BID'])) {
	header('Location: '.BASE_URL.'signin');
}

?>

<html>
<head>
	<title>AirtimeBuy - Billing information</title>
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
	        	<i class="fa fa-credit-card"> </i>
	      	</div>
	   	</div>
	</div>
	<div class="barry">
	   	<form role="form" method="post" action="" id="payment-form">
	   		<div id="loadingdiv"><img src="preloader.gif"><br><br><p><em>Please wait while we capture your billing details...</em></div>
	     	<div class="paystack">
		        <div id="alert-container" class="alert " role="alert" style="border-radius: 0;"></div>
	         	<div class="formholder">
		            <div class="form-group">
                        <label>Card Number</label>
                        <input type="tel" class="form-control numbersonly bgchange" id="cardnumber" placeholder="Card number" data-pwc="number" maxlength="16" onKeyPress="changeBG();" onKeyDown="changeBG();" onKeyUp="changeBG();" autocomplete="off" required />
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label>Month</label>
                                <input type="tel" class="form-control numbersonly" id="month" placeholder="08" data-pwc="exp-month" maxlength="2" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-xs-1 text-center">
                            <div class="form-group">
                                <label></label><br>
                                /
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="tel" class="form-control numbersonly" id="year" placeholder="2015" data-pwc="exp-year" maxlength="4" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-xs-3" style="padding-right:0 !important">
                            <div class="form-group">
                                <label>CVC</label>
                                <input type="tel" class="form-control numbersonly" id="cvc" placeholder="000" data-pwc="cvc" maxlength="3" autocomplete="off" required />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="buyerID" name="buyerID" value="<?=$_SESSION['BID']?>" />
		            <div class="form-group">
		               <p> &nbsp; </p>
		            </div>
	         	</div>
	      	</div>
	      	<div class="btnholder">
	        	<button type="submit" class="btn btn-success btn-block btn-round">Submit Credentials</button>
	      	</div>
	   	</form>
	</div>
	<div id="barry">
	   	<div class="paystack foot">
	     	&copy; 2015 AirtimeBuy. All Rights Reserved.
	   	</div>
	</div>

	<?php require_once(INCS_DIR.'scripts.inc.php'); ?>
	<script type="text/javascript" src="https://paywithcapture.com/capture/assets/js/tokenization.js"></script>
	<script type="text/javascript">
	Pwc.setPublishableKey('uFmz/uE/SDT6GupOrSEXIZXGByjQ0zFkPyc9LqKHFqnTI0WPN3JS5kQPo/j9or0TOXlqMQj2lzHn/UGsQT4XeQ==');
	</script>
</body>
</html>