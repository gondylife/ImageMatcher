<?php

require_once('../config.php');

?>
<html>
	<head></head>
	<body>
		<form method="POST" id="form_newpersonnel">
		<input type="text" placeholder="firstname" id="firstname" name="firstname" required /><br/><br/>
		<input type="text" placeholder="lastname" id="lastname" name="lastname" required /><br/><br/>
		<input type="text" placeholder="policeid" id="policeid" name="policeid" required /><br/><br/>
		<input type="email" placeholder="email" id="emailaddress" name="emailaddress" required /><br/><br/>
		<select name="role" id="role" required>
			<option selected disabled>Select Role</option>
			<option value="A">Admin Personnel</option>
			<option value="P">Police Personnel</option>
		</select>
		<br/><br/><br/><br/>
		<button type="submit">Register</button>
		</form>

		<script src="jquery.js"></script>
		<script src="main.js"></script>
	</body>
</html>