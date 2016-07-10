<?php

require_once('../config.php');

?>
<html>
	<head></head>
	<body>
		<form method="POST" id="form_search">
		<input type="text" placeholder="Image URL" id="image" name="image" required /><br/><br/>
		<button type="submit">Search</button>
		</form>

		<script src="jquery.js"></script>
		<script src="main.js"></script>
	</body>
</html>