<div class="modal fade" id="newPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document" style="width: 500px;">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">NPFIMS New Personnel</h4>
	      	</div>
	      	<div id="palert-container" class="alert fade in " role="alert" style="border: 0;"></div>
			<form method="POST" id="form_newpersonnel" class="form-horizontal" style="padding-top: 10px; padding-bottom: 10px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">First name</label>
					<div class="col-sm-7">
						<input type="text" placeholder="John" class="form-control" id="pfirstname" name="pfirstname" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Last name</label>
					<div class="col-sm-7">
						<input type="text" placeholder="Doe" class="form-control" id="plastname" name="plastname" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Police ID</label>
					<div class="col-sm-7">
						<input type="text" placeholder="821103BD" class="form-control" id="ppoliceid" name="ppoliceid" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Email address</label>
					<div class="col-sm-7">
						<input type="email" placeholder="john.doe@mail.com" class="form-control" id="pemailaddress" name="pemailaddress" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Role</label>
					<div class="col-sm-7">
						<select class="form-control" id="prole" name="prole" required>
							<option selected disabled>Select Role</option>
							<option value="A">Admin Personnel</option>
							<option value="P">Police Personnel</option>
						</select>
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-4 col-sm-6">
				      	<button type="submit" class="btn btn-primary">Register</button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>