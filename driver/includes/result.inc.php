<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document" style="width: 650px;">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">NPFIMS Search Result</h4>
	        	<div class="noPrint" style="width: 40px; float: right; font-size:30px; margin-top: -30px; margin-right: 15px;">
					<a href="" id="printIcon" title="Print Result" onclick="window.print()" style="cursor: pointer;"><span><i class="fa fa-print"></i></span></a>
		    	</div>
	      	</div>
	      	<div>
				<div id="middle" style="height: 280px;">
					<div id="middle-left" style="width: 390px; height:250px; margin: 15px 15px 15px 15px; border: 1px solid #000; float: left;">
						<h4 style="width: 150px; margin: auto; padding: 10px 0;">Personal Details</h4>
						<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Firstname: </span>
		    				<span id="firstname" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Lastname: </span>
		    				<span id="lastname" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Othername: </span>
		    				<span id="othername" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Date of Birth: </span>
		    				<span id="dob" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Sex: </span>
		    				<span id="sex" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Email: </span>
		    				<span id="email" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Phone Number: </span>
		    				<span id="phonenumber" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Match Confidence: </span>
		    				<span id="confidence" class="answer" style="padding-right: 5px; font-size: 25px; color: #00FF00"></span>
	    				</div>
					</div>
					<div id="middle-right" style="width: 200px; height:250px; margin: 15px 15px 15px 10px; border: 1px solid #FFF; float: right;">
						<img id="displayimage" src="" style="width: 200px; height:250px; border-radius: 7px;" />
					</div>
	    		</div>
	    		<div id="bottom" style="height: 250px; margin: 0 15px 15px;">
	    			<div id="botton-left" style="width: 300px; height:250px; margin-right: 10px; border: 1px solid #000; float: left;">
	    				<h4 style="width: 155px; margin: auto; padding: 10px 0 30px;">Residential Details</h4>
	    				<span id="homeaddress" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    			</div>
	    			<div id="botton-right" style="width: 300px; height:250px; border: 1px solid #000; float: right;">
	    				<h4 style="width: 106px; margin: auto; padding: 10px 0 30px;">Work Details</h4>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Occupation: </span>
		    				<span id="occupation" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Work Place: </span>
		    				<span id="workplace" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    				<div>
		    				<span class="title" style="padding: 0 5px; font-size: 15px;">Work Address: </span>
		    				<span id="workaddress" class="answer" style="padding-right: 5px; font-size: 25px;"></span>
	    				</div>
	    			</div>
	    		</div>
	      	</div>
		</div>
	</div>
</div>