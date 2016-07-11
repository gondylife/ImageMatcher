<div class="modal fade" id="trainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document" style="width: 500px;">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">NPFIMS Train Album</h4>
	      	</div>
	      	<div id="alert-container" class="alert fade in " role="alert" style="border: 0;"></div>
			<form method="POST" id="form_trainalbum" class="form-horizontal" style="padding-top: 10px; padding-bottom: 10px;">
				<h3 class="addimage_field" style="padding-bottom: 10px; width: 50px; margin: 0 auto; cursor: pointer;"><i class="fa fa-plus"></i></h3>
				<div class="imageurl_fields">
					<div class="form-group">
						<label class="col-sm-2 control-label">#1</label>
					    <div class="col-sm-6">
					      	<input type="text" placeholder="Insert image URL" class="form-control imageurlfield" name="imageURL[]" required />
					    </div>
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-6">
				      	<button type="submit" class="btn btn-primary">Train Album</button>
				    </div>
				</div>
			</form>
		</div>
  	</div>
</div>