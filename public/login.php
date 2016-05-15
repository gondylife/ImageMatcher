<?php

require_once('../config.php');

?>
<html>
	<head></head>
	<body>
		<form method="POST" id="form_login">
		<input type="text" placeholder="policeid" id="policeid" name="policeid" required /><br/><br/>
		<input type="password" placeholder="secret" id="secret" name="secret" required /><br/><br/><br/><br/>
		<button type="submit">Log In</button>
		</form>

		<script src="jquery.js"></script>
		<script src="main.js"></script>
	</body>
</html>