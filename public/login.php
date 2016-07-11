<?php

require_once('../config.php');

if (isset($_SESSION['PID'])) {
	header('Location: ' . $_SESSION['redirect']);
}

?>
<!DOCTYPE html>
<html >
  	<head>
	    <title>NPFIMS - Account Sign In</title>
		<?php require_once(INCS_DIR.'metadata.inc.php'); ?>
	  	<style>
	  		html, body, div, header, form {
	  			padding:0;
			  	font-size:100%;
			  	font:inherit;
	  		}
			* {
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}
			body {
			  	background: url("stardust.png") repeat;
			  	font: 100%/1 "Helvetica Neue", Arial, sans-serif;
			}
			#login-alert-container {
				left: 50%;
				margin: 24rem auto 1rem auto;
				width: 20rem;
				min-height: 3rem;
			}
			.logo-div {
				margin: 3em auto 5em auto;
				width: 10rem;
				height: 10rem;
			}
			.logo {
				width: 10rem;
				height: 10rem;
			}
			.login {
				position: absolute;
				top: 60%;
				left: 50%;
				margin: -10rem 0 0 -10rem;
				width: 20rem;
				height: 20rem;
				padding: 20px;
				background: #fff;
				border-radius: 5px;
				overflow: hidden;
			}
			.login:hover > .login-header, .login.focused > .login-header {
				width: 2rem;
			}
			.login:hover > .login-header > .text, .login.focused > .login-header > .text {
				font-size: 1rem;
				transform: rotate(-90deg);
			}
			.login.loading > .login-header {
				width: 20rem;
			}
			.login.loading > .login-header > .text {
				display: none;
			}
			.login.loading > .login-header > .loader {
				display: block;
			}
			.login-header {
				position: absolute;
				left: 0;
				top: 0;
				z-index: 1;
				width: 20rem;
				height: 20rem;
				background: orange;
				transition: width 0.5s ease-in-out;
			}
			.login-header > .text {
				display: block;
				width: 100%;
				height: 100%;
				font-size: 5rem;
				text-align: center;
				line-height: 20rem;
				color: #fff;
				transition: all 0.5s ease-in-out;
			}
			.login-header > .loader {
				display: none;
				position: absolute;
				left: 5rem;
				top: 5rem;
				width: 10rem;
				height: 10rem;
				border: 2px solid #fff;
				border-radius: 50%;
				animation: loading 2s linear infinite;
			}
			.login-header > .loader:after {
				content: "";
				position: absolute;
				left: 4.5rem;
				top: -0.5rem;
				width: 1rem;
				height: 1rem;
				background: #fff;
				border-radius: 50%;
				border-right: 2px solid orange;
			}
			.login-header > .loader:before {
				content: "";
				position: absolute;
				left: 4rem;
				top: -0.5rem;
				width: 0;
				height: 0;
				border-right: 1rem solid #fff;
				border-top: 0.5rem solid transparent;
				border-bottom: 0.5rem solid transparent;
			}
			@keyframes loading {
				50% {
					opacity: 0.5;
				}
				100% {
					transform: rotate(360deg);
				}
			}
			.form_login {
				margin: 0 0 0 2rem;
				padding: 0.5rem;
			}
			.login-input {
				display: block;
				width: 100%;
				font-size: 2rem;
				padding: 0.5rem 1rem;
				box-shadow: none;
				border-color: #ccc;
				border-width: 0 0 2px 0;
			}
			.login-input + .login-input {
				margin: 10px 0 0;
			}
			.login-input:focus {
				outline: none;
				border-bottom-color: orange;
			}
			.login-btn {
				position: absolute;
				right: 1rem;
				bottom: 1rem;
				width: 5rem;
				height: 5rem;
				border: none;
				background: orange;
				border-radius: 50%;
				font-size: 0;
				border: 0.6rem solid transparent;
				transition: all 0.3s ease-in-out;
			}
			.login-btn:after {
				content: "";
				position: absolute;
				left: 1rem;
				top: 0.8rem;
				width: 0;
				height: 0;
				border-left: 2.4rem solid #fff;
				border-top: 1.2rem solid transparent;
				border-bottom: 1.2rem solid transparent;
				transition: border 0.3s ease-in-out 0s;
			}
			.login-btn:hover, .login-btn:focus, .login-btn:active {
				background: #fff;
				border-color: orange;
				outline: none;
			}
			.login-btn:hover:after, .login-btn:focus:after, .login-btn:active:after {
				border-left-color: orange;
			}
    	</style>
		<script src="prefixfree.js"></script>
	</head>
	<body>
		<div class="logo-div">
			<img class="logo" src="logo.png" />
		</div>
		<div class="login">
			<header class="login-header">
				<span class="text">LOGIN</span>
				<span class="loader"></span>
			</header>
			<form method="POST" id="form_login" class="form_login">
		    	<input type="text" id="policeid" class="login-input" placeholder="PoliceID" name="policeid" required />
		    	<input type="password" id="secret" class="login-input" placeholder="Secret" name="secret" required />
		    	<button type="submit" class="login-btn">Login</button>
			</form>
		</div>
		<div id="login-alert-container" class="alert fade in " role="alert"></div>

		<?php require_once(INCS_DIR.'scripts.inc.php'); ?>
  	</body>
</html>
