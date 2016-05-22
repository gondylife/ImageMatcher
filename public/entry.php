<?php

require_once('../config.php');

use App\Admin\Npfims;

$entries = Npfims::retrieveAllEntries();

?>
<html>
	<head></head>
	<body>
		<table style="border: 1px solid black;">
			<thead>
				<tr>
					<th>First name</th>
					<th>Last name</th>
					<th>Other name</th>
					<th>DOB</th>
					<th>Sex</th>
					<th>Phone Number</th>
					<th>Email address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($entries as $id => $Details) {
						$buttonEdit = '<button type="submit" class="edit-entry" data-entry="'.$Details['UniqueID'].'" title="Edit Entry"><a data-toggle="modal" data-target="#editModal">Edit</a></button>';
						$buttonTrain = '<button type="submit" class="train-album" data-entry="'.$Details['UniqueID'].'" title="Train Album"><a data-toggle="modal" data-target="#trainModal">Train</a></button>';
				?>
				<tr>
					<td><?=$Details['Firstname'];?></td>
					<td><?=$Details['Lastname'];?></td>
					<td><?=$Details['Othername'];?></td>
					<td><?=$Details['DOB'];?></td>
					<td><?=$Details['Sex'];?></td>
					<td><?=$Details['Phonenumber'];?></td>
					<td><?=$Details['EmailAddress'];?></td>
					<td><?=$buttonEdit;?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$buttonTrain;?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>

		<?php require_once(INCS_DIR.'editentry.inc.php'); ?>
		<?php require_once(INCS_DIR.'train.inc.php'); ?>
		<script src="jquery.js"></script>
		<script src="bootstrap.js"></script>
		<script src="main.js"></script>
	</body>
</html>