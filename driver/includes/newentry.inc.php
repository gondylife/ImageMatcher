<?php

require_once('../config.php');
// use App\Admin\ImageMatch;

// $data = array(
// 	"id" => "josephyobo",
// 	"imageURL" => "http://e2.365dm.com/13/12/768x432/159128554_3045254.jpg?20140131063808"
// );
// die(pre_dump((new ImageMatch)->trainAlbum($data)));

?>
<html>
	<head></head>
	<body>
		<form method="POST" id="form_newentry">
		<input type="text" placeholder="firstname" id="firstname" name="firstname" required /><br/><br/>
		<input type="text" placeholder="lastname" id="lastname" name="lastname" required /><br/><br/>
		<input type="text" placeholder="othername" id="othername" name="othername" /><br/><br/>
		<input type="text" placeholder="dob" id="dob" name="dob" required /><br/><br/>
		<select name="sex" id="sex" required>
			<option selected disabled>Select Sex</option>
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select><br/><br/>
		<input type="text" placeholder="phonenumber" id="phonenumber" name="phonenumber" required /><br/><br/>
		<input type="email" placeholder="emailaddress" id="emailaddress" name="emailaddress" required /><br/><br/>
		<input type="text" placeholder="homeaddress" id="homeaddress" name="homeaddress" required /><br/><br/>
		<input type="text" placeholder="occupation" id="occupation" name="occupation" /><br/><br/>
		<input type="text" placeholder="workplace" id="workplace" name="workplace" /><br/><br/>
		<input type="text" placeholder="workaddress" id="workaddress" name="workaddress" /><br/><br/>
		<input type="text" placeholder="image1" id="image1" name="image1" required /><br/><br/>
		<input type="text" placeholder="image2" id="image2" name="image2" required /><br/><br/>
		<br/><br/>
		<button type="submit">Add Entry</button>
		</form>

		<script src="jquery.js"></script>
		<script src="main.js"></script>
	</body>
</html>