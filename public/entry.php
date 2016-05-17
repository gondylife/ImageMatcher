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
					<th>Full name</th>
					<th>Police ID</th>
					<th>Email address</th>
					<th>Role</th>
					<th>Access Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($personnels as $id => $Details) {
						if ($Details['Role'] === 'A') {
							$role = 'Admin';
						}
						if ($Details['Role'] === 'P') {
							$role = 'Police';
						}
						if ($Details['Status'] === '1') {
							$status = 'Active';
							$button = '<button type="submit" class="deactivate-personnel" data-personnel="'.$Details['PoliceID'].'" title="Deactivate Personnel">Deactivate</button>';
						}
						if ($Details['Status'] === '0') {
							$status = 'Inactive';
							$button = '<button type="submit" class="activate-personnel" data-personnel="'.$Details['PoliceID'].'" title="Activate Personnel">Activate</button>';
						}
				?>
				<tr>
					<td><?=$Details['Firstname'].' ' .$Details['Lastname'];?></td>
					<td><?=$Details['PoliceID'];?></td>
					<td><?=$Details['EmailAddress'];?></td>
					<td><?=$role;?></td>
					<td><?=$Details['DateTime'];?></td>
					<td><?=$status;?></td>
					<td><?=$button;?>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="delete-personnel" data-personnel="<?=$Details['PoliceID'];?>" title="Delete Personnel">Delete</button></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>

		<script src="jquery.js"></script>
		<script src="main.js"></script>
	</body>
</html>