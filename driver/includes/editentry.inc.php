<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">NPFIMS Edit Entry</h4>
	      	</div>
			<form method="POST" id="form_editentry">
				<input type="text" placeholder="othername" id="othername" name="othername" /><br/><br/>
				<input type="text" placeholder="dob" id="dob" name="dob" required /><br/><br/>
				<input type="text" placeholder="phonenumber" id="phonenumber" name="phonenumber" required /><br/><br/>
				<input type="email" placeholder="emailaddress" id="emailaddress" name="emailaddress" required /><br/><br/>
				<input type="text" placeholder="homeaddress" id="homeaddress" name="homeaddress" required /><br/><br/>
				<input type="text" placeholder="occupation" id="occupation" name="occupation" /><br/><br/>
				<input type="text" placeholder="workplace" id="workplace" name="workplace" /><br/><br/>
				<input type="text" placeholder="workaddress" id="workaddress" name="workaddress" /><br/><br/>
				<br/><br/>
				<button type="submit">Update Entry</button>
			</form>
		</div>
  	</div>
</div>