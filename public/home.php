<?php

require_once '../config.php';

if (!isset($_SESSION['BID'])) {
	header('Location: ' . BASE_URL . 'signin');
}

use App\Admin\Airtimebuy;
// die(var_dump(Airtimebuy::scheduledRecharge()));

$details = Airtimebuy::retrieveDetails($_SESSION['BID']);

$history = Airtimebuy::retrieveAllTransactions($_SESSION['BID']);

$schedule = Airtimebuy::retrieveAllSchedule($_SESSION['BID']);

?>

<html>
<head>
	<title>AirtimeBuy - Dashboard</title>
	<?php require_once INCS_DIR . 'metadata.inc.php';?>
	<style type="text/css">
		.home-tab{
			margin: 20px;
		}
	</style>
</head>
<body>
	<div class="color-bar"> </div>
	<div class="account-topbar">
	   	<div class="dashboardtop">
	     	<div class="logo">
	        	<img src="airtimebuy.png" height="30" >
	      	</div>
	      	<div class="lock pull-right">
	        	<i class="fa fa-tachometer"> </i>
	      	</div>
	   	</div>
	</div>
	<div class="dashboardbarry">
		<div id="loadingdiv" style="z-index:5000; background-color:rgba(255,255,255,0.9); height:100%; width:1200px; text-align:center; vertical-align:middle; display:none; position:absolute; padding:40px 20px 20px;"><img src="preloader.gif"><br><br><p><em>Please wait while we process this transaction...</em></div>
		<div class="home-tab">
		    <ul class="nav nav-tabs" id="homeTabs">
		        <li class="active"><a data-toggle="tab" href="#recharge">Quick Recharge</a></li>
		        <li><a data-toggle="tab" href="#schedule">Schedule Recharge</a></li>
		        <!-- <li><a data-toggle="tab" href="#billing">Manage Billing</a></li> -->
		        <div style="float: right; padding: 15px;">
		        <span style="">Hello <strong><?=$details[0]["firstname"];?></strong></span>
		        <span style="margin-left: 30px; font-size: 25px;"><a href="logout" title="Sign Out" id="logout"><i class="fa fa-power-off"> </i></a></span>
		        </div>
		    </ul>
		    <div class="tab-content">
		        <div id="recharge" class="tab-pane fade in active">
		        	<div class="row" style="width: 30%; float: left;">
		        		<h3 style="padding: 0 0 5px 25px;">Recharge</h3>
			            <form role="form" method="post" action="" id="form_airtime" style="border: 1px solid #b9c9fe; border-radius: 10px; padding: 20px 0;">
			            	<div class="dashboardpaystack">
			            		<div id="alert-container" class="alert " role="alert" style="border-radius: 0; display: none"></div>
			            		<div class="dashboardformholder">
			            			<div class="form-group">
				            		   <label>Country</label>
					            		<select class="form-control" name="country" id="country" required style="padding: 0;">
					            			<option value="" selected disabled>Select Country</option>
					            			<option value="NGN">Nigeria</option>
					            			<option value="KES">Kenya</option>
					            			<option value="GBP">United Kingdom</option>
					            		</select>
				            		</div>
				            		<div class="form-group">
				            		   <label>Operator</label>
				            			<select class="form-control" name="nOperator" id="nOperator" required style="padding: 0;"></select>
				            		</div>
				            		<div class="form-group">
				            		   <label>Amount</label>
				            		   <input type="text" class="form-control" placeholder="Top-up Amount" id="amount" name="amount" required />
				            		</div>
				            		<div class="form-group">
				            		   <label>Phone Number</label>
				            		   <input type="text" class="form-control" id="phonenumber" placeholder="phonenumber" name="phonenumber"  required />
				            		</div>
				            		<div class="form-group">
				            		   <p> &nbsp; </p>
				            		</div>
			            		</div>
		            		</div>
			            	<div class="dashboardbtnholder" style="width: 88%">
			        			<button type="submit" id="buyairtime" class="btn btn-success btn-block btn-round">Buy Airtime</button>
			      			</div>
		            	</form>
	            	</div>
	            	<div class="row" style="width: 69%; float: right; padding-right: 20px;">
		        		<h3 style="padding: 0 0 5px 0">Recharge History</h3>
			            <div class="table-responsive">
			            	<table id="rounded-corner">
			            		<thead>
			            			<tr>
			            				<th scope="col" class="rounded-company">S/N</th>
			            				<th scope="col">Country</th>
			            				<th scope="col">Network</th>
			            				<th scope="col">Phone Number</th>
			            				<th scope="col">Amount</th>
			            				<th scope="col">Transaction Ref</th>
			            				<th scope="col">Transaction Date</th>
			            				<th scope="col" class="rounded-q4">Status</th>
			            			</tr>
			            		</thead>
			            		<tfoot>
			            			<tr>
			            		    	<td colspan="7" class="rounded-foot-left"><em>This table contains all recharge transactions carried out on your account.</em></td>
			            		    	<td class="rounded-foot-right">&nbsp;</td>
			            		    </tr>
			            		</tfoot>
			            		<tbody>
			            			<?php
$i = 0;
foreach ($history as $id => $allDetails) {
	$i++;
	if ($allDetails['country'] === 'NGN') {
		$country = 'Nigeria';
	}

	if ($allDetails['country'] === 'KES') {
		$country = 'Kenya';
	}

	if ($allDetails['country'] === 'GBP') {
		$country = 'United Kingdom';
	}

	if ($allDetails['status'] === '1') {
		$status = 'Successful';
	} else {
		$status = 'Failed';
	}

	$networks = array('1' => 'NG Airtel', '2' => 'NG Etisalat', '3' => 'NG Visafone', '4' => 'NG MTN', '5' => 'NG GLO', '6' => 'KES Airtel', '7' => 'KES Orange', '8' => 'KES Safaricom', '9' => 'KES YU', '10' => 'UK Orange', '11' => 'UK TMobile', '12' => 'UK Vodafone');
	if (array_key_exists($allDetails['network'], $networks)) {
		$network = $networks[$allDetails['network']];
	}

	?>
			            			<tr>
			            				<td><?=$i;?></td>
			            				<td><?=$country;?></td>
			            				<td><?=$network?></td>
			            				<td><?=$allDetails['phonenumber'];?></td>
			            				<td><?=$allDetails['country'] . ' ' . $allDetails['amount'];?></td>
			            				<td><?=$allDetails['transaction_ref'];?></td>
			            				<td><?=$allDetails['transaction_date'];?></td>
			            				<td><?=$status;?></td>
			            			</tr>
			            			<?php }
?>
			            		</tbody>
			            	</table>
			            </div>
	            	</div>
		        </div>
		        <div id="schedule" class="tab-pane fade">
		            <div class="row" style="width: 30%; float: left;">
		        		<h3 style="padding: 0 0 5px 25px;">Schedule</h3>
			            <form role="form" method="post" action="" id="form_schedule" style="border: 1px solid #b9c9fe; border-radius: 10px; padding: 20px 0;">
			            	<div class="dashboardpaystack">
			            		<div id="alert-container-schedule" class="alert " role="alert" style="border-radius: 0; display: none"></div>
			            		<div class="dashboardformholder">
			            			<div class="form-group">
				            		   <label>Country</label>
					            		<select class="form-control" name="countrySchedule" id="countrySchedule" required style="padding: 0;">
					            			<option value="" selected disabled>Select Country</option>
					            			<option value="NGN">Nigeria</option>
					            			<option value="KES">Kenya</option>
					            			<option value="GBP">United Kingdom</option>
					            		</select>
				            		</div>
				            		<div class="form-group">
				            		   <label>Operator</label>
				            			<select class="form-control" name="nOperatorSchedule" id="nOperatorSchedule" required style="padding: 0;"></select>
				            		</div>
				            		<div class="form-group">
				            		   <label>Amount</label>
				            		   <input type="text" class="form-control" placeholder="Top-up Amount" id="amountSchedule" name="amountSchedule"  required />
				            		</div>
				            		<div class="form-group">
				            		   <label>Phone Number</label>
				            		   <input type="text" class="form-control" id="phonenumberSchedule" placeholder="phonenumber" name="phonenumberSchedule"  required />
				            		</div>
				            		<div class="form-group">
				            		   <label>Start Date</label>
				            		   <input  type="text" class="form-control" placeholder="Click to select"  id="startdate" required>
				            		</div>
				            		<div class="form-group">
				            		   <label>Frequency</label>
					            		<select class="form-control" name="frequency" id="frequency" style="padding: 0;">
					            			<option value="" selected disabled>Select Frequency</option>
					            			<option value="daily">Daily</option>
					            			<option value="weekly">Weekly</option>
					            			<option value="monthly">Monthly</option>
					            			<option value="yearly">Yearly</option>
					            		</select>
				            		</div>
				            		<div class="form-group">
				            		   <label>End Date</label>
				            		   <input  type="text" class="form-control" placeholder="Click to select"  id="enddate" required>
				            		</div>
				            		<div class="form-group">
				            		   <p> &nbsp; </p>
				            		</div>
			            		</div>
		            		</div>
			            	<div class="dashboardbtnholder" style="width: 88%">
			        			<button type="submit" id="schedulerecharge" class="btn btn-success btn-block btn-round">Schedule Recharge</button>
			      			</div>
		            	</form>
	            	</div>
		            <div class="row" style="width: 69%; float: right; padding-right: 20px;">
		        		<h3 style="padding: 0 0 5px 0">Schedule Chart</h3>
			            <div class="table-responsive">
			            	<table id="rounded-corner">
			            		<thead>
			            			<tr>
			            				<th scope="col" class="rounded-company">Start Date</th>
			            				<th scope="col">Frequency</th>
			            				<th scope="col">Next Date</th>
			            				<th scope="col">End Date</th>
			            				<th scope="col">Country</th>
			            				<th scope="col">Network</th>
			            				<th scope="col">Phone Number</th>
			            				<th scope="col">Amount</th>
			            				<th scope="col" class="rounded-q4">Action</th>
			            			</tr>
			            		</thead>
			            		<tfoot>
			            			<tr>
			            		    	<td colspan="8" class="rounded-foot-left"><em>This table contains all scheduled recharge details for your account.</em></td>
			            		    	<td class="rounded-foot-right">&nbsp;</td>
			            		    </tr>
			            		</tfoot>
			            		<tbody>
			            			<?php foreach ($schedule as $id => $scheduleDetails) {
	if ($scheduleDetails['country'] === 'NGN') {
		$country = 'Nigeria';
	}

	if ($scheduleDetails['country'] === 'KES') {
		$country = 'Kenya';
	}

	if ($scheduleDetails['country'] === 'GBP') {
		$country = 'United Kingdom';
	}

	$networks = array('1' => 'NG Airtel', '2' => 'NG Etisalat', '3' => 'NG Visafone', '4' => 'NG MTN', '5' => 'NG GLO', '6' => 'KES Airtel', '7' => 'KES Orange', '8' => 'KES Safaricom', '9' => 'KES YU', '10' => 'UK Orange', '11' => 'UK TMobile', '12' => 'UK Vodafone');
	if (array_key_exists($scheduleDetails['network'], $networks)) {
		$network = $networks[$scheduleDetails['network']];
	}

	?>
			            			<tr>
			            				<td><?=$scheduleDetails['start'];?></td>
			            				<td><?=$scheduleDetails['frequency'];?></td>
			            				<td><?=$scheduleDetails['next'];?></td>
			            				<td><?=$scheduleDetails['end'];?></td>
			            				<td><?=$scheduleDetails['country'];?></td>
			            				<td><?=$network;?></td>
			            				<td><?=$scheduleDetails['phonenumber'];?></td>
			            				<td><?=$scheduleDetails['amount'];?></td>
			            				<td><a href="#" class="delete-schedule" data-schedule="<?=$scheduleDetails['reference'];?>" title="Delete Schedule"><span class="fa fa-times-circle"></span></a></td>
			            			</tr>
			            			<?php
}
?>
			            		</tbody>
			            	</table>
			            </div>
	            	</div>
		        </div>
		        <!-- <div id="billing" class="tab-pane fade">
		            <h3>Section C</h3>
		            <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
		        </div> -->
		    </div>
		</div>
	</div>
	<div id="barry">
	   	<div class="dashboardpaystack foot">
	     	&copy; 2015 AirtimeBuy. All Rights Reserved.
	   	</div>
	</div>

	<?php require_once INCS_DIR . 'scripts.inc.php';?>
	<?php

if (isset($_GET['trxref'])) {
	if ($_GET['trxref'] === $_SESSION['ATtoken']) {
		?>
				<script type="text/javascript">
					$('#loadingdiv').show();
				</script>
				<?php
$urlVerify = 'https://www.paywithcapture.com/live/pay/verification/';

		$data = array(
			'merchantid' => '102555',
			'trxref' => $_SESSION['ATtoken'],
			'secretkey' => 12345,
		);

		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, $urlVerify);
		curl_setopt($request, CURLOPT_POST, true);
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
		$execute = curl_exec($request);
		curl_close($request);

		$execute = json_decode($execute, true);

		if ($execute['status'] === '1') {
			$result = Airtimebuy::prepareToBuyAirtime();

			if ($result['status']) {
				unset($_SESSION['ATcountry']);
				unset($_SESSION['ATnetwork']);
				unset($_SESSION['ATamount']);
				unset($_SESSION['ATphonenumber']);
				unset($_SESSION['ATtoken']);

				if ($result['status'] === 'success') {?>
							<script>
								$('#loadingdiv').hide();
								var responseElem = $('#form_airtime').find('#alert-container');
								responseElem.removeClass('alert-danger').addClass('alert-success').show();
								responseElem.html('<?=$result['message'];?>');
							</script>
						<?php } else if ($result['status'] === 'failure') {?>
							<script>
								$('#loadingdiv').hide();
								var responseElem = $('#form_airtime').find('#alert-container');
								responseElem.removeClass('alert-success').addClass('alert-danger').show();
								responseElem.html('<?=$result['message'];?>');
							</script>
						<?php }
			}
		} else if ($execute['status'] === '0') {?>
			<script>
				$('#loadingdiv').hide();
				var responseElem = $('#form_airtime').find('#alert-container');
				responseElem.removeClass('alert-success').addClass('alert-danger').show();
				responseElem.html('Transaction failed. Payment was unsuccessful.');
			</script>
		<?php }
	}
}
?>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#homeTabs a').click(function (e) {
		            e.preventDefault();
		            $(this).tab('show');
		        });

		        // store the currently selected tab in the hash value
		        $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
		            var id = $(e.target).attr("href").substr(1);
		            window.location.hash = id;
		        });

		        // on load of the page: switch to the currently selected tab
		        var hash = window.location.hash;
		        $('#homeTabs a[href="' + hash + '"]').tab('show');
		});
	</script>
</body>
</html>