<div class="modal fade" id="newEntryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document" style="width: 500px;">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">NPFIMS New Entry</h4>
	      	</div>
	      	<div id="ealert-container" class="alert fade in " role="alert" style="border: 0;"></div>
			<form method="POST" id="form_newentry" class="form-horizontal" style="padding-top: 10px; padding-bottom: 10px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">First name</label>
					<div class="col-sm-7">
						<input type="text" placeholder="John" class="form-control" id="efirstname" name="efirstname" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Last name</label>
					<div class="col-sm-7">
						<input type="text" placeholder="Doe" class="form-control" id="elastname" name="elastname" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Other name</label>
					<div class="col-sm-7">
						<input type="text" placeholder="John" class="form-control" id="eothername" name="eothername" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Date of birth</label>
					<div class="col-sm-7">
						<input type="date" placeholder="10/06/1993" class="form-control" id="edob" name="edob" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Sex</label>
					<div class="col-sm-7">
						<select name="esex" id="esex" class="form-control" required>
							<option selected disabled>Select Sex</option>
							<option value="M">Male</option>
							<option value="F">Female</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Phone number</label>
					<div class="col-sm-7">
						<input type="text" placeholder="+2347035762893" class="form-control" id="ephonenumber" name="ephonenumber" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Email address</label>
					<div class="col-sm-7">
						<input type="text" placeholder="john.doe@mail.com" class="form-control" id="eemailaddress" name="eemailaddress" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Home address</label>
					<div class="col-sm-7">	
						<input type="text" placeholder="#10 brownhilly close, Nsukka, Enugu" class="form-control"  id="ehomeaddress" name="ehomeaddress" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Occupation</label>
					<div class="col-sm-7">		
						<input type="text" placeholder="Mechanical Engineer" class="form-control" id="eoccupation" name="eoccupation" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Work place</label>
					<div class="col-sm-7">
						<input type="text" placeholder="Toyota Plc" class="form-control" id="eworkplace" name="eworkplace" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Work address</label>
					<div class="col-sm-7">
						<input type="text" placeholder="#10 smart drive, Nsukka, Enugu" class="form-control" id="eworkaddress" name="eworkaddress" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Image 1</label>
					<div class="col-sm-7">
						<input type="text" placeholder="Insert image URL" class="form-control" id="eimage1" name="eimage1" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Image 2</label>
					<div class="col-sm-7">
						<input type="text" placeholder="Insert image URL" class="form-control" id="eimage2" name="eimage2" />
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-4 col-sm-6">
				      	<button type="submit" class="btn btn-primary">Add Entry</button>
				    </div>
				</div>
			</form>
		</div>
  	</div>
</div>