<?php

require_once('../config.php');

if (!isset($_SESSION['PID'])) {
    header('Location: '.BASE_URL.'login');
}

?>
<!DOCTYPE html>
<html>
	<head>
	    <title>NPFIMS - Police</title>
		<?php require_once(INCS_DIR.'metadata.inc.php'); ?>
		<style type="text/css">
			body {
			  	background: url("searchbg.png") repeat;
			  	font: 100%/1 "Helvetica Neue", Arial, sans-serif;
			}
			#top-panel {
				border-bottom: 1px solid #FFF;
			}
			#panel-right {
				width: 40px;
				height: 50px;
				float: right;
				padding: 10px;
				font-size: 30px;
			}
			#panel-left {
				width: 150px;
				height: 30px;
				float: left;
				padding: 20px;
				color: #FFF;
				font-size: 15px;
			}
			#panel-center {
				width: 540px;
				height: 50px;
				margin: 250px auto;
			}
			.fileUpload {
			    position: relative;
			    overflow: hidden;
			    height: 50px;
			    padding: 10px;
			    background: #d83c3c;
			    border-radius: 3px 0 0 3px; 
			}
			.fileUpload input.upload {
			    position: absolute;
			    top: 0;
			    right: 0;
			    margin: 0;
			    padding: 0;
			    font-size: 20px;
			    cursor: pointer;
			    opacity: 0;
			    filter: alpha(opacity=0);
			}
			.cf:before, .cf:after{
			    content:"";
			    display:table;
			}
			.cf:after{
			    clear:both;
			}
			.cf{
			    zoom:1;
			}
			.form-wrapper {
			    width: 540px;
			    background: #444;
			    background: rgba(0,0,0,.2);
			    border-radius: 10px;
			    box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
			}
			.form-wrapper input {
			    width: 360px;
			    height: 50px;
			    padding: 10px 5px;
			    float: left;    
			    font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
			    border: 0;
			    background: #eee; 
			}
			.form-wrapper input:focus {
			    outline: 0;
			    background: #fff;
			    box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
			}
			.form-wrapper input::-webkit-input-placeholder {
			   color: #999;
			   font-weight: normal;
			   font-style: italic;
			}
			.form-wrapper input:-moz-placeholder {
			    color: #999;
			    font-weight: normal;
			    font-style: italic;
			}
			.form-wrapper input:-ms-input-placeholder {
			    color: #999;
			    font-weight: normal;
			    font-style: italic;
			}
			.form-wrapper button {
			    overflow: visible;
			    position: relative;
			    float: right;
			    border: 0;
			    padding: 0;
			    cursor: pointer;
			    height: 50px;
			    width: 110px;
			    font: bold 15px/40px 'lucida sans', 'trebuchet MS', 'Tahoma';
			    color: #fff;
			    text-transform: uppercase;
			    background: #d83c3c;
			    border-radius: 0 3px 3px 0;      
			    text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);
			}
			.form-wrapper button:hover{		
			    background: #e54040;
			}
			.form-wrapper button:active,
			.form-wrapper button:focus{   
			    background: #c42f2f;
				outline: 0;   
			}
			.form-wrapper button:before {
			    content: '';
			    position: absolute;
			    border-width: 8px 8px 8px 0;
			    border-style: solid solid solid none;
			    border-color: transparent #d83c3c transparent;
			    top: 17px;
			    left: -6px;
			}
			.form-wrapper button:hover:before{
			    border-right-color: #e54040;
			}
			.form-wrapper button:focus:before,
			.form-wrapper button:active:before{
			    border-right-color: #c42f2f;
			}
			.form-wrapper button::-moz-focus-inner {
			    border: 0;
			    padding: 0;
			}
			@media print {
			    header, .footer, footer {
			        display: none;
			    }
			    body.modal-open div.container.body-content div#mainContent {
			        display: none;
			    }
			    .noPrint {
			        display: none;
			    }
			}      
		</style>
	</head>
	<body>
		<div id="loadingdiv" style="z-index:5000; background-color:rgba(255,255,255,0.9); height:100%; width:100%; text-align:center; vertical-align:middle; display:none; position:absolute; padding:270px 20px 20px;"><img src="preloader.gif"><br><br><p style="font-size: 20px;"><em id="loadingText">Search in progress...</em></div>
		<div class="container-fluid noPrint">
		  	<div class="row">
		    	<div id="top-panel" class="col-sm-12">
		    		<div id="panel-left">
		    			<span>Hello, <em id="personnelName"><?=$_SESSION['firstname'];?></em></span>
		    		</div>
		    		<div id="panel-right">
						<a href="" id="logout" title="Log Out" style="color: #FFF; cursor: pointer;"><span><i class="fa fa-sign-out"></i></span></a>
		    		</div>
		    	</div>
		  	</div>
		  	<div class="row">
				<div id="search-panel" class="col-sm-12">
		    		<div id="panel-center">
		    			<div id="internal-alert-container" class="alert fade in " role="alert"></div>
		    			<form  method="POST" enctype="multipart/form-data" id="form_search" class="form-wrapper cf">
			    			<div class="fileUpload btn btn-danger" style="width: 70px; float: left;">
			    			    <span style="font-size: 20px;"><i class="fa fa-upload"></i></span>
			    			    <input type="file" accept="image/*" id="uploadBtn" class="upload" />
			    			</div>
			    			<div style="width: 470px; float: right;">
	        					<input type="text" id="image" name="image" placeholder="Enter image url here..." required />
	        					<button type="submit">Search</button>
	    					</div>
	    				</form>
		    		</div>
		    	</div>
		  	</div>
		</div>

		<?php require_once(INCS_DIR.'scripts.inc.php'); ?>
		<?php require_once(INCS_DIR.'result.inc.php'); ?>
	</body>
</html>