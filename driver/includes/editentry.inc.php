<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document" style="width: 500px;">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">NPFIMS Edit Entry</h4>
	      	</div>
	      	<div id="eealert-container" class="alert fade in " role="alert" style="border: 0;"></div>
			<form method="POST" id="form_editentry" class="form-horizontal" style="padding-top: 10px; padding-bottom: 10px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">Other name</label>
					<div class="col-sm-7">
						<input type="text" placeholder="John" class="form-control" id="eeothername" name="eeothername" /><br/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Date of birth</label>
					<div class="col-sm-7">
						<input type="date" placeholder="10/06/1993" class="form-control" id="eedob" name="eedob" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Phone number</label>
					<div class="col-sm-7">
						<input type="text" placeholder="+2347031234567" class="form-control" id="eephonenumber" name="eephonenumber" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Email address</label>
					<div class="col-sm-7">
						<input type="email" placeholder="john.doe@mail.com" class="form-control" id="eeemailaddress" name="eeemailaddress" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Home address</label>
					<div class="col-sm-7">	
						<input type="text" placeholder="#10 brownhilly close, Nsukka, Enugu" class="form-control"  id="eehomeaddress" name="eehomeaddress" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Occupation</label>
					<div class="col-sm-7">		
						<input type="text" placeholder="Mechanical Engineer" class="form-control" id="eeoccupation" name="eeoccupation" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Work place</label>
					<div class="col-sm-7">
						<input type="text" placeholder="Toyota Plc" class="form-control" id="eeworkplace" name="eeworkplace" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Work address</label>
					<div class="col-sm-7">
						<input type="text" placeholder="#10 smart drive, Nsukka, Enugu" class="form-control" id="eeworkaddress" name="eeworkaddress" />
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-4 col-sm-6">
				      	<button type="submit" class="btn btn-primary">Update Entry</button>
				    </div>
				</div>
			</form>
		</div>
  	</div>
</div>