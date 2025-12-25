 <div class="container-fluid">
   <div class="row">
     <div class="card mb-5">
      <div class="card-body px-5">         
 	<?php if(null !==$this->session->userdata('error_msg')) { ?>  
				<div class='hideMe alert alert-danger'>
					<?php echo $this->session->flashdata('error_msg'); ?>
				</div>
				<?php } ?>
			<ul class="nav nav-tabs nav-justified mb-3" role="tablist">
               <li class="nav-item" rel="personalDetails">
                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">Personal Details<?php
              if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 0){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="emergencyDetails">
              <a class="nav-link " data-bs-toggle="tab" href="#emergencyDetails" role="tab">Emergency Details
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 1){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="bankDetails">
              <a class="nav-link" value="bankDetails" data-bs-toggle="tab" href="#bankDetails" role="tab">Bank Details
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 2){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="taxDetails">
              <a class="nav-link" data-bs-toggle="tab" href="#taxDetails" role="tab">Tax Details
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 3){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="policeClearance">
              <a class="nav-link" data-bs-toggle="tab" href="#policeClearance" role="tab">Police Clearance
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 4){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="superAnnuation">
              <a class="nav-link" data-bs-toggle="tab" href="#superAnnuation" role="tab">Super Annuation
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 5){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="privacyPolicy">
              <a class="nav-link" data-bs-toggle="tab" href="#privacyPolicy" role="tab">Policies
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 6){ ?>
                <span class="badge bg-success">done</span>
               <?php }   ?></a>
              </li>
           
           </ul>    
  			    
  			     <div class="tab-content text-black">
                    <div class="tab-pane active" id="personalDetails" role="personalDetails">
                 	<form  role="form" id="personalDetailsForm" method="post" action="" class="mt-4" enctype="multipart/form-data">
                	  	<input type="hidden" name="emp_id" id="emp_id" value="<?php echo $employee['emp_id']; ?>">
                	  	<input type="hidden" name="stepsCompleted" class="personalDetailsFormSteps" value="1">
                	   <div class="row gy-4">
                	             <div class="col-lg-1 col-md-2">
                		<label for="title" class="form-label">Title:<span>*</span></label>
                		<select class="form-select" id="title" name="title">
                		<option value="">Select</option>
                		 <option value="Mr" <?php if($employee['title'] == 'Mr') echo'selected';?>>Mr</option>
                		 <option value="Ms" <?php if($employee['title'] == 'Ms') echo'selected';?>>Ms</option>
                		  <option value="Mrs" <?php if($employee['title'] == 'Mrs') echo'selected';?>>Mrs</option>
                		  <option value="Miss" <?php if($employee['title'] == 'Miss') echo'selected';?>>Miss</option>
                		   </select>
                		    <span class="fieldError" id="title_error"></span>
                		</div>
                		
                		<div class="col-lg-2 col-md-4">
                			<label for="preferred_name" class=" control-label">Preferred Name:</label>
                			<input type="text" id="preferred_name" class="form-control" name="preferred_name" value="<?php echo $employee['preferred_name']; ?>" autocomplete="off" >
                		
                		</div>
                					<div class="col-lg-3 col-md-6">
                							<label for="first_name" class=" control-label">First Name:<span>*</span></label>
                							<input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $employee['first_name']; ?>" autocomplete="off" >
                						    <span class="fieldError" id="first_name_error"></span>
                						</div>
                					<div class="col-lg-3 col-md-6">
                							<label for="last_name" class=" control-label">Last Name:<span>*</span></label>
                							<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $employee['last_name']; ?>" autocomplete="off" >
                						    <span class="fieldError" id="last_name_error"></span>
                						</div>
                	                <div class="col-lg-3 col-md-6">
                    						<label for="email" class="form-label">Email Address:<span>*</span></label>
                    						<input type="text" readonly class="form-control" id="email" name="email" value="<?php echo $employee['email']; ?>">
                    						<span class="fieldError" id="email_error"></span>
                    						</div>
                    				<div class="col-lg-3 col-md-6">
                    							<label for="phone" class="form-label">Contact Number:<span>*</span></label>
                    						    <input type="text" class="form-control" id="phone" name="phone" onkeypress='validate(event)' autocomplete="off" value="<?php echo $employee['phone']; ?>">
                    						    <span class="fieldError" id="phone_error"></span>
                    						</div>
                					<div class="col-lg-3 col-md-6">
                    							<label for="dob" class="form-label">Date of Birth:<span>*</span></label>
                    					    	<input type="date" class="form-control datetime" id="dob" name="dob" autocomplete="off" value="<?php echo $employee['dob']; ?>">
                    						    <span class="fieldError" id="dob_error"></span>
                    						</div>
                					<div class="col-lg-3 col-md-6">
                    							<label for="businessname" class="form-label">Highest Academic Achievements: </label>
                    							<textarea class="form-control" rows="2" name="heighest_acd_achmts"><?php echo $employee['heighest_acd_achmts']; ?></textarea>
                    						</div>
                    						
                    						<div class="col-lg-3 col-md-6 ">
                    						<label for="businessname" class="form-label">Face Verification:<span>*</span> </label>
                    						
                    					  
                    					   <?php  if(isset($employee['face_image_url']) && $employee['face_image_url'] !='') { ?>	
                    					   <button type="button" id="faceVerifyBtn" class="btn btn-outline-info mt-3 form-control" onclick="startCamera()"><i class="ri-camera-line me-2"></i>Start Camera</button>
                    						<small id="verificationMessage" class="text-success fw-semibold  mt-2">Verification completed successfully</small>
                    						<img src="<?php echo $employee['face_image_url']; ?>" width="320" height="240" id="savedCapturedImage" />
                    						<?php }else{ ?>
                    						<button type="button" id="faceVerifyBtn" class="btn btn-outline-info mt-3 form-control" onclick="startCamera()"><i class="ri-camera-line me-2"></i>Complete Face Verification</button>
                    						<small id="verificationPreMessage" class="text-info fw-semibold  mt-2">Click on the button to capture your photo for verification</small>
                    						<?php } ?>
                    						<small id="verificationError" class="text-danger fw-semibold  mt-2"></small>
                    						<input type="hidden" id="employeePhoto" value="<?php echo $employee['face_image_url']; ?>" />
                    						<video id="video" width="320" height="240" autoplay style="display: none;"></video>
                    						<canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                    						<img id="capturedImagePreview" src="" width="320" height="240" style="display:none; margin-top:10px;" />
                    						</div>
                						
                					
                        
						
				
				  <h5 class="fw-bold text-black"> Address</h5>	
				    <div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Unit Number:</label>
							<input type="text" class="form-control" id="unit_number" name="unit_number" value="<?php echo $employee['unit_number']; ?>" autocomplete="off">
						</div>	
					<div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Street Number:</label>
							<input type="text" class="form-control" id="street" name="street" value="<?php echo $employee['street']; ?>"  autocomplete="off" >
							
				    </div>
					<div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Street Name:<span>*</span></label>
							<input type="text" class="form-control" id="street_name" name="street_name" value="<?php echo $employee['street_name']; ?>"  autocomplete="off" >
							 <span class="fieldError" id="streetname_error"></span>
						
						</div>
					<div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Suburb:<span>*</span></label>
							<input type="text" class="form-control"  id="suburb" name="suburb" value="<?php echo $employee['suburb']; ?>" autocomplete="off" >
								 <span class="fieldError" id="suburb_error"></span>
						</div>
					<div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Postcode:<span>*</span></label>
							<input type="text" id="postcode" class="form-control" name="postcode" onkeypress='validate(event)' value="<?php if($employee['postcode'] != "0"){ echo $employee['postcode']; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
							 <span class="fieldError" id="postcode_error"></span>
						</div>
					<div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">State:<span>*</span></label>
							 <span class="fieldError" id="state_error"></span>
							<select class="form-select" name="state" id="state">
								<option value="">Select</option>
								<option value="nsw" <?php if($employee['state'] == 'nsw'){ echo "selected"; } ?>>New South Wales</option>
								<option value="vic" <?php if($employee['state'] == 'vic'){ echo "selected"; } ?>>Victoria</option>
								<option value="qld" <?php if($employee['state'] == 'qld'){ echo "selected"; } ?>>Queensland</option>
								<option value="wa" <?php if($employee['state'] == 'wa'){ echo "selected"; } ?>>Western Australia</option>
								<option value="sa"<?php if($employee['state'] == 'sa'){ echo "selected"; } ?>>South Australia</option>
								<option value="tas" <?php if($employee['state'] == 'tas'){ echo "selected"; } ?>>Tasmania</option>
								<option value="act" <?php if($employee['state'] == 'act'){ echo "selected"; } ?>>Australian Capital Territory</option>
								<option value="nt" <?php if($employee['state'] == 'nt'){ echo "selected"; } ?>>Northern Territory</option>
							</select>
						</div>
					</div>
				<input type="button" rel="emergencyDetails" name="contact_submit" id="save_continue_personal" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">		
                	</form>                           
                     </div>        
               
                    <div class="tab-pane" id="emergencyDetails" role="emergencyDetails">
             
              <form  role="form" id="emergencyDetailsForm" method="post" action="" enctype="multipart/form-data">
                            	        <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                            	        <input type="hidden" name="stepsCompleted" class="emergencyDetailsFormSteps" value="2">
                                       <div class="row gy-4">      	    
                    					 <div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="control-label ">Name:<span>*</span></label>
                    						<input type="text" id="nextkin_name_two" class="form-control required" value="<?php echo $employee['nextkin_name_two']; ?>" name="nextkin_name_two" autocomplete="off">
                    						<span class="fieldError" id="nextkin_name_two_error"></span>
                    						</div>
                    					<div class="col-lg-3 col-md-6">
                    						<label for="businessname"   class="control-label ">Relationship:<span>*</span></label>
                    						<input type="text" class="form-control required"  id="nextkin_relationship_two" value="<?php echo $employee['nextkin_relationship_two']; ?>" name="nextkin_relationship_two" autocomplete="off" >
                    							<span class="fieldError" id="nextkin_relationship_two_error"></span>
                    						</div>
                    					<div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">Email Address:</label>
                    						<input type="text" class="form-control " name="nextkin_email_two" value="<?php echo $employee['nextkin_email_two']; ?>" autocomplete="off" >
                    						
                    						</div>
                    							     
                    					<div class="col-lg-3 col-md-6">
                    						<label for="Phone No"  class="control-label ">Contact No:<span>*</span></label>
                    						<input type="text" id="nextkin_phone_no" class="form-control required" value="<?php echo $employee['nextkin_phone_no']; ?>" name="nextkin_phone_no" autocomplete="off" >
                    							<span class="fieldError" id="nextkin_phone_no_error"></span>
                    						</div>
                    						
                    					 
                                        <div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">Street address:</label>
                    						<input type="text" class="form-control" name="nextkin_street" value="<?php echo $employee['nextkin_street']; ?>" autocomplete="off">
                    						</div>
                    						
                    			  	<div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">Town/Suburb:</label>
                    						<input type="text" class="form-control" name="nextkin_suburb" value="<?php echo $employee['nextkin_suburb']; ?>" autocomplete="off" >
                    						</div>
                    				
                    					<div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">State:</label>
                    						<input type="text" class="form-control" name="nextkin_state" value="<?php echo $employee['nextkin_state']; ?>" autocomplete="off" >
                    						</div>
                    				<div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">Postcode:</label>
                    						<input type="text" class="form-control" name="nextkin_postcode" value="<?php echo $employee['nextkin_postcode']; ?>" autocomplete="off" >
                    						</div>
                    						</div>   
               <input type="button" rel="bankDetails" name="contact_submit" id="save_continue_emergency" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">		
                						</form>                             
               </div>         
                     
                    <div class="tab-pane" id="bankDetails" role="bankDetails">   
                      
                      <form  role="form" id="bankDetailsForm" method="post" action="" enctype="multipart/form-data">
                           	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                           	    <input type="hidden" name="stepsCompleted" class="bankDetailsFormSteps" value="3">
                					<div class="row">
                					<h5 class="text-black">Account No 1</h5>
                					  <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Bank Name:<span>*</span></label>
                								<input type="text" id="bank_1" class="form-control required" value="<?php echo $employee['bank_1']; ?>" name="bank_1" autocomplete="off">
                								<span class="fieldError" id="bank_1_error"></span>
                						  </div>
                						  
                						   <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Account Name:<span>*</span></label>
                							<input type="text" id="account_name_1" class="form-control required" name="account_name_1" value="<?php echo $employee['account_name_1']; ?>" autocomplete="off">
                							<span class="fieldError" id="account_name_1_error"></span>
                						  </div>
                						  
                						 <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">BSB:<span>*</span></label>
                							<input type="text" id="bsb_1" class="form-control required" name="bsb_1" value="<?php echo $employee['bsb_1']; ?>" autocomplete="off">
                								<span class="fieldError" id="bsb_1_error"></span>
                						  </div>
                						  
                						   <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Account No:<span>*</span></label>
                								<input type="text" id="account_no_1" class="form-control required" name="account_no_1" value="<?php echo $employee['account_no_1']; ?>" autocomplete="off">
                								<span class="fieldError" id="account_no_1_error"></span>
                							</div>
                						  
                						  <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">% to Deposit<span>*</span></label>
                								<input type="text" id="percentage_1" class="form-control required" name="percentage_1" value="<?php echo $employee['percentage_1']; ?>" autocomplete="off">
                								<span class="fieldError" id="percentage_1_error"></span>
                						  </div>

                							</div>
                					<div class="row mt-4">
                						 <h5 class="text-black">Account No 2</h5>
                						
                						  <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Bank Name:</label>
                							<input type="text" class="form-control" name="bank_2" value="<?php echo $employee['bank_2']; ?>" autocomplete="off">
                						  </div>
                						  
                						  <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Account Name:</label>
                						<input type="text" class="form-control" name="account_name_2" value="<?php echo $employee['account_name_2']; ?>" autocomplete="off">
                						  </div>
                						  
                						 <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">BSB:</label>
                						   <input type="text" class="form-control" name="bsb_2" value="<?php echo $employee['bsb_2']; ?>" autocomplete="off">
                						  </div>
                						  
                						   <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Account No:</label>
                							<input type="text" class="form-control" name="account_no_2" value="<?php echo $employee['account_no_2']; ?>" autocomplete="off">
                						  </div>
                						  
                						 <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">% to Deposit:</label>
                						<input type="text" class="form-control" name="percentage_2" value="<?php echo $employee['percentage_2']; ?>" autocomplete="off">
                						  </div>
                						
                							</div>
                					<div class="row mt-4">	
                						 <h5 class="text-black">Account No 3</h5>
                						 <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Bank Name:</label>
                							<input type="text" class="form-control" name="bank_3" value="<?php echo $employee['bank_3']; ?>" autocomplete="off">
                						  </div>
                						  
                						   <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Account Name:</label>
                						  <input type="text" class="form-control" name="account_name_3" value="<?php echo $employee['account_name_3']; ?>" autocomplete="off">
                						  </div>
                						  
                						 <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">BSB:</label>
                							<input type="text" class="form-control" name="bsb_3" value="<?php echo $employee['bsb_3']; ?>" autocomplete="off">
                						  </div>

                						 <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">Account No:</label>
                							<input type="text" class="form-control" name="account_no_3" value="<?php echo $employee['account_no_3']; ?>" autocomplete="off">
                						  </div>
                						  
                						  <div class="col-lg-3 col-md-6 col-sm-12">
                							<label for="businessname" class="form-label">% to Deposit:</label>
                						<input type="text" class="form-control" name="percentage_3" value="<?php echo $employee['percentage_3']; ?>" autocomplete="off">
                						  </div>
                						 </div>
                					  <div class="row mt-4 ">
                					  <div class="col-12 ">
                					      <?php $location=' ';?>
                	<p>	I hereby authorize <?php echo $location; ?> to initiate automatic deposits for my fortnightly wages to my bank account(s) as detailed above and also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. 
                I hereby agree not to hold <?php echo $location; ?> responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. 
                This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until update the new banking details.</p>
                					  </div>
                					</div>
                					
                		<input type="button" rel="taxDetails" name="contact_submit" id="save_continue_bank" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                	</form>   
                     
                     </div> 
                     
                    <div class="tab-pane" id="taxDetails" role="taxDetails">  
                   
                   	<form  role="form" id="taxDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                               	    <input type="hidden" name="stepsCompleted" class="taxDetailsFormSteps" value="4">
        				            <div class="section-wrap">
        				                <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <p>Do you have your TFN?</p>
						                            
						                            <div class="tab">
                                                          <a class="tablinks tablinks_tfn <?php echo (isset($employee['check_tfn_type']) && $employee['check_tfn_type']=='tfn_number' ? 'active' : ''); ?>" onclick="openThisTab(event, 'Yes','tfn')">Yes</a>
                                                          <a class="tablinks tablinks_tfn <?php echo (isset($employee['check_tfn_type']) && $employee['check_tfn_type']=='tfn_type' ? 'active' : ''); ?>" onclick="openThisTab(event, 'No','tfn')">No</a>
                                                    </div>
                                                        
                                                    <!-- Tab content -->
                                                 
                                                    <div id="Yes" class="tabcontent tabcontent_tfn">
                                                     <div class="form-row">	     	    
                                						<div class="form-group col-md-6">
                                						<label for="businessname" class="form-label">Enter Tax File Number:<span>*</span></label>
                                						<input type="text" class="form-control" id="tfn_number" name="tfn_number" value="<?php echo $employee['tfn_number']; ?>" autocomplete="off">
                                						<span class="fieldError" id="tfn_number_error"></span>
                                						</div>
                                							</div>
                                                    </div>
                                                  
                                                    
                                                    <div id="No" class="tabcontent tabcontent_tfn">
                                                       <label><input type="radio" value="pendingTFN" name="tfn_type" <?php if($employee['tfn_type'] == 'pendingTFN') echo"checked"; ?>> My TFN is pending</label><br>
                                                    <label><input type="radio" value="noTFN" name="tfn_type" <?php if($employee['tfn_type'] == 'noTFN') echo"checked"; ?>>  I'm under 18 and don't have a TFN</label><br>
                                                     <label><input type="radio" value="quotingTFN" name="tfn_type" <?php if($employee['tfn_type'] == 'quotingTFN') echo"checked"; ?>> I have an exemption from quoting a TFN (such as receiving a social security or service pension)</label>
                                                    	<span class="fieldError" id="tfn_type_error"></span>
                                                    </div>
                                                     <input type="hidden" value="<?php echo (isset($employee['check_tfn_type']) ? $employee['check_tfn_type'] : 'tfn_number'); ?>" name="check_tfn_type" class="check_tfn_type">
                                                    </div>
                                    						
            						            </div>
            						        </div>
            						        <div class="section-wrap">
                    						            <div class="form-row">
                    						                        <div class="checkbox-group col-md-12" >
                    						                            <p>Have you changed your surname since you last dealt with the Australian Tax Office?</p>
                    						                            
                    						                             <div class="tab">
                                                              <a class="tablinks tablinks_surname <?php  if($employee['have_surname_changed'] == 'yesChanged'){ echo 'active';} ?>" onclick="openThisTab(event, 'yesChanged','surname')">Yes</a>
                                                              <a class="tablinks tablinks_surname <?php if($employee['have_surname_changed'] == ''){ echo 'active'; } ?> <?php if($employee['have_surname_changed'] == 'noChanged'){ echo 'active';} ?>" onclick="openThisTab(event, 'noChanged','surname')">No</a>
                                                            
                                                            </div>
                                                            
                                                            <!-- Tab content -->
                                                            <div id="yesChanged" class="tabcontent tabcontent_surname" <?php if($employee['have_surname_changed'] == 'yesChanged'){ ?>style="display:block;" <?php } ?>>
                                                             <div class="form-row">	     	    
                                        						<div class="form-group col-md-6">
                                        						<label for="businessname" class="form-label">Enter Previous Surname:</label>
                                        						<input type="text" class="form-control" id="previous_surname" name="previous_surname" value="<?php if( $employee['previous_surname'] != 'noChanged'){echo $employee['previous_surname'];} ?>" autocomplete="off">
                                        						</div>
                                        							</div>
                      
                                                            </div>
                                                            <div id="noChanged" class="tabcontent tabcontent_surname" <?php if($employee['have_surname_changed'] == 'noChanged'){ echo 'style="display:block;"';} ?>>
                                                            </div>
                    
                                                            <input type="hidden" value="<?php echo $employee['have_surname_changed']; ?>" name="have_surname_changed" class="previous_surname_changed ">
                                                            </div>
                    						            </div>
                    						    </div>
						            
            						<div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>Are you an Australian resident for tax purposes or a working holiday maker?</p>
    						                            
                            							<label><input type="radio" value="australian" name="resident_type" <?php if($employee['resident_type'] == 'australian') echo "checked"; ?>> Australian resident for tax purposes</label><br>
                            							<label><input type="radio" value="foreign" name="resident_type" <?php if($employee['resident_type'] == 'foreign') echo "checked"; ?>> Foreign resident</label><br>
                            							<label><input type="radio" value="working_holiday" name="resident_type" <?php if($employee['resident_type'] == 'working_holiday') echo "checked"; ?>> Working holiday maker</label>
                                							<span class="fieldError" id="resident_type_error"></span>
                            						</div>
                            						
    						            </div> 
						            </div>
            						<div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>Do you have any of the following outstanding debts or loans?</p>
    						                            
                            							<label><input type="radio" value="higher_education" name="loan_type" <?php if($employee['loan_type'] == 'higher_education') echo"checked"; ?>> Higher Education Loan Program (HELP)</label><br>
                            							<label><input type="radio" value="vet_student" name="loan_type" <?php if($employee['loan_type'] == 'vet_student') echo"checked"; ?>> VET Student Loan (VSL)</label><br>
                            							<label><input type="radio" value="financial_supplement" name="loan_type" <?php if($employee['loan_type'] == 'financial_supplement') echo"checked"; ?>> Financial Supplement (FS)</label><br>
                            							<label><input type="radio" value="student_loan" name="loan_type" <?php if($employee['loan_type'] == 'student_loan') echo"checked"; ?>> Student Start-up Loan (SSL)</label><br>
                            							<label><input type="radio" value="trade_loan" name="loan_type" <?php if($employee['loan_type'] == 'trade_loan') echo"checked"; ?>> Trade Support Loan (TSL)</label>
                                						<span class="fieldError" id="loan_type_error"></span>
                            						</div>
                            						
    						            </div>
    						      </div>
            					  <div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>Would you like to claim the tax-free threshold from this payer?</p>
    						                            
                            							<label><input type="radio" value="yes" name="claim_tax_free" <?php if($employee['claim_tax_free'] == 'yes') echo"checked"; ?>> Yes</label>
                            							<label><input type="radio" value="no" name="claim_tax_free" <?php if($employee['claim_tax_free'] == 'no') echo"checked"; ?>> No</label>
                            								<span class="fieldError" id="claim_tax_free_error"></span>
                            						</div>
                            						
    						            </div>
						           </div>
            					   <div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>On what basis are you paid?</p>
    						                            
                            							<label><input type="radio" value="full_time" name="job_type" <?php if($employee['job_type'] == 'full_time') echo"checked"; ?>> Full-time</label><br>
                            							<label><input type="radio" value="part_time" name="job_type" <?php if($employee['job_type'] == 'part_time') echo"checked"; ?>> Part-time</label><br>
                            							<label><input type="radio" value="labour_hire" name="job_type" <?php if($employee['job_type'] == 'labour_hire') echo"checked"; ?>> Labour Hire</label><br>
                            							<label><input type="radio" value="superannuation" name="job_type" <?php if($employee['job_type'] == 'superannuation') echo"checked"; ?>> Superannuation or annuity income stream</label><br>
                            							<label><input type="radio" value="casual" name="job_type" <?php if($employee['job_type'] == 'casual') echo"checked"; ?>> Casual</label>
                            								<span class="fieldError" id="job_type_error"></span>
                                						
                            						</div>
                            						
    						            </div>
						            </div>
            						       
						             <!--button-->
                							<input type="button" value="SAVE AND CONTINUE" rel="policeClearance" name="contact_submit" id="save_continue_tax" class="btn btn-success btn-ph">
                						</form>
                     
                      </div>  

                     <div class="tab-pane" id="policeClearance" role="policeClearance">
                   
                   <p class="fw-bold">Police clearance certificate is mandatory to commence work. Please upload your certificate<span>*</span></p>
                   <?php if(isset($employee['police_certificate']) && $employee['police_certificate'] !=''){  ?>
                   <?php foreach(unserialize($employee['police_certificate']) as $attachment) {  ?> 
    <p><a href="<?php echo base_url().'uploaded_files/cjs/HR/OnboardingFiles/'.$attachment ?>" target="_blank" class="btn btn-sm btn-success">View Attachment</a></p> 
                   <?php } ?>
                   <?php }else { ?>
                   <p><small>Refresh page to view already upladed document</small></p>
                   <?php } ?>
                   <form  role="form" id="policeDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                               	    <input type="hidden" name="stepsCompleted" class="policeDetailsFormSteps" value="5">
        				           <div class="form-row">
						              <div class="form-group justify-content-center d-flex">
                						 <div class="dropzone">
                                        <div class="fallback">
                                       <input type="file" id="police" name="userfile[]" class="form-control-file" multiple>
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                            </div>
                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                    </div>
                						</div>
						            </div> 
						           
						   <input type="button" rel="privacyPolicy" name="contact_submit" id="save_continue_police" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>     
                        
                    </div>
                    
                    <div class="tab-pane" id="superAnnuation" role="superAnnuation">
                    <form  role="form" id="annuationDetailsForm" method="post" action="" enctype="multipart/form-data">
            		<input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
            		<input type="hidden" name="stepsCompleted" class="annuationDetailsFormSteps" value="6">
            		<div class="section-wrap">
            				            <div class="checkbox-group col-md-12" >
						      <p class="fw-bold">Do you have an existing superannuation account?</p>
						           <div class="tab">
						               
                                     <a class="tablinks tablinks_superAnnuation <?php echo (isset($employee['nominatedByEmployer']) && $employee['nominatedByEmployer'] == 0 ? 'active' :'' ); ?>" onclick="openThisTab(event, 'YesSuper','superAnnuation')">Yes</a>
                                     <a class="tablinks tablinks_superAnnuation <?php echo (isset($employee['nominatedByEmployer']) && $employee['nominatedByEmployer'] == 1 ? 'active' : '' ); ?>" onclick="openThisTab(event, 'NoSuper','superAnnuation')">No</a>
                                      <input type="hidden" value="yes" name="check_super_type" class="check_super_type">
                                     </div>
                                    </div>
            				          
						            <div id="YesSuper" class="tabcontent tabcontent_superAnnuation">
						                    <div class="row">
						                        <div class="col-md-12" >
						                            <p>Your details</p>
						                            
                        						</div>
                        					<div class="col-lg-3 col-md-6 col-sm-12">
                        							<label for="pdf_name" class=" control-label">Name:</label>
                        							<input type="text" id="pdf_name" class="form-control required" name="pdf_first_name" value="<?php echo $employee['pdf_first_name']; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_name_error"></span>
                        						</div>
                        							<div class="col-lg-3 col-md-6 col-sm-12">
                        							<label for="pdf_name_error" class=" control-label">Employee identification number (if applicable)</label>
                        							<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_emp_id_no" value="<?php echo $employee['pdf_emp_id_no']; ?>" autocomplete="off" >

                        						</div>
                        				
						                    
						                  	<div class="col-lg-3 col-md-6 col-sm-12">
                        							<label for="pdf_apra_fund_abh" class=" control-label">Fund ABN</label>
                        							<input type="text" id="pdf_apra_fund_abh" class="form-control required" name="pdf_apra_fund_abh" value="<?php echo $employee['pdf_apra_fund_abh']; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_abh_error"></span>
                        						</div>
                        					<div class="col-lg-3 col-md-6 col-sm-12">
                        							<label for="pdf_apra_fund_name" class=" control-label">Fund name</label>
                        							<input type="text" id="pdf_apra_fund_name" class="form-control required" name="pdf_apra_fund_name" value="<?php echo $employee['pdf_apra_fund_name']; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_name_error"></span>
                        						</div>
                        					
                        					<div class="col-lg-3 col-md-6 col-sm-12">
                        							<label for="pdf_apra_fund_usi" class=" control-label">Unique superannuation identifier (USI)<span>*</span></label>
                        							<input type="text" id="pdf_apra_fund_usi" class="form-control required" name="pdf_apra_fund_usi" value="<?php echo $employee['pdf_apra_fund_usi']; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_usi_error"></span>
                        						</div>
                        					
                        					<div class="col-lg-3 col-md-6 col-sm-12">
                        							<label for="pdf_apra_fund_member_no" class=" control-label">Your member number (if applicable)</label>
                        							<input type="text" id="pdf_apra_fund_member_no" class="form-control" name="pdf_apra_fund_member_no" value="<?php echo $employee['pdf_apra_fund_member_no']; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_member_no_error"></span>
                        						</div>
						                    
						                    </div>
						                    
            				        </div>
            				        <div id="NoSuper" class="tabcontent tabcontent_superAnnuation select_nominatedByEmployer">
            				            <input  id="nominatedByEmployer" type="hidden" value="0" name="nominatedByEmployer" >

            				    	<div class="checkbox">
                            			<label style="color:#000;">
                            			    <input type="checkbox" checked="<?php echo (isset($employee['nominatedByEmployer']) && $employee['nominatedByEmployer'] == 1 ? 'checked' : '' ); ?>"  value="1" id="select_nominatedByEmployer" onchange="document.getElementById('nominatedByEmployer').value = this.checked ? 1 : 0">The super fund nominated by my employer.<span>*</span>
                            		     </label>
     
                            		<span class="fieldError" id="nominatedByEmployer_error"></span> 
                            							</div>
                                                    </div>
            				        
            				        </div>
                	<input type="button" rel="policeClearance" name="contact_submit" id="save_continue_annuation" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                    </form>    
                     </div>
                     
                    <div class="tab-pane" id="privacyPolicy" role="privacyPolicy">
                     <p class="fw-bold">You must read and agree to below attached company policies, staff induction and job description policies before submitting the form.</p>
                               	<form  role="form" id="privacyDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                               	    <input type="hidden" name="stepsCompleted" class="privacyDetailsFormSteps" value="7">
                               	      <div class="row">
                                        <div class="col-lg-4">
                                      <h4 class="text-black">Staff Induction Manual</h4>
                                  
     <?php $inductionAttachment = ''; ?>
    <?php if(isset($uploadedFiles) && !empty($uploadedFiles)){  ?>
    <?php foreach($uploadedFiles as $uploadedFile) {  ?>
   <?php if($uploadedFile['metaData'] == 'induction') { $inductionAttachment = unserialize($uploadedFile['data']);  ?>   
    <a href="<?php echo base_url().'uploaded_files/'.$this->session->userdata('tenantIdentifier').'/HR/OtherFiles/'.$inductionAttachment[0] ?>" target="_blank" class="btn btn-success btn-sm my-3">View Staff Induction Manual</a>
     <?php } ?>
     <?php } ?>
   <?php } ?>        
 
                            	   
                            						<div class="form-group mt-2">
                            							<div class="pdf-view-wrap">
                            		<iframe src="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/OtherFiles/<?php echo $inductionAttachment[0]; ?>" width="100%" height="100%"></iframe>
                            			<div class="form-check mb-2">
                            		<label class="form-check-label"><input class="form-check-input" id="agree_terms_one" type="checkbox" value="1" name="agree_terms_one" >I read, understood and agree to the the Staff Induction Manual.<span>*</span></label>
                            		<span class="fieldError" id="agree_terms_one_error"></span> 
                            			</div>
                            			</div>	
                            			</div>
                            					
                            	         </div>
                                        <div class="col-lg-4">
       <h4 class="text-black">Company Policies and Procedures</h4>
                                           
     <?php $policyAttachment = ''; ?>
    <?php if(isset($uploadedFiles) && !empty($uploadedFiles)){  ?>
    <?php foreach($uploadedFiles as $uploadedFile) {  ?>
   <?php if($uploadedFile['metaData'] == 'policy') { $policyAttachment = unserialize($uploadedFile['data']);  ?>   
    <a href="<?php echo base_url().'uploaded_files/'.$this->session->userdata('tenantIdentifier').'/HR/OtherFiles/'.$policyAttachment[0] ?>" target="_blank" class="btn btn-success btn-sm my-3">View Policies</a>
     <?php } ?>
     <?php } ?>
   <?php } ?>                     					    
    
                        	          		
                        						<div class="form-group mt-2">
                        							<div class="pdf-view-wrap">
                        		<iframe src="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/OtherFiles/<?php echo $policyAttachment[0]; ?>" width="100%" height="100%"></iframe>
                        			<div class="form-check mb-2">
                        			<label class="form-check-label"><input class="form-check-input" type="checkbox" id="agree_terms_two" value="1" name="agree_terms_two">I read, understood and agree to the  Company Policies and Procedures Manual.<span>*</span></label>
                        			<span class="fieldError" id="agree_terms_two_error"></span> 
                        		</div>
                        		</div>	
                        					
                        	          		</div>
                    	          		</div>
                                        <div class="col-lg-4">
                                      <?php
                        							    $fileNameArray = unserialize($employee['job_desc']);
                        							    if(isset($fileNameArray) && !empty($fileNameArray)){
                        							     $fileName = $fileNameArray[0];
                        							     $file_parts = pathinfo($fileName); ?>
                                      <h4 class="text-black">Job Description</h4>
    <a class="btn btn-success btn-sm my-3" href="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/<?php echo $fileName; ?>" target="_blank">View JD</a>                                  
                  	<div class="form-group mt-2">
                    <div class="pdf-view-wrap">
                    <?php if($file_parts['extension'] == 'pdf'){ ?>
        <iframe src="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/<?php echo $fileName; ?>" width="100%" height="100%"></iframe>
                        							      <?php }else { ?>
        <iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/<?php echo $fileName; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
                        								<?php } ?>
                        							
           <div class="form-check mb-2">
           <label  class="form-check-label"><input class="form-check-input" type="checkbox" id="agree_terms_three" value="1" name="agree_terms_three" >I read, understood and agree to the Job Descriptions Manual.<span>*</span></label>
            <span class="fieldError" id="agree_terms_three_error"></span>                        							
           </div>
          </div>	
            </div>
        <?php } ?>
        </div>
        </div> 
      <input type="button" name="contact_submit" id="save_continue_privacy" value="Submit" class="btn btn-success btn-ph">
                            </form>    
                     </div>
                      </div>  
       </div> 
       </div>  
     </div>
</div>
<div id="onboardSuccessModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                                                            </lord-icon>
                                                            <div class="mt-4">
                                                                <h4 class="mb-3 text-black">Success</h4>
  <p class="text-black mb-4"> Thank you for submitting your onboarding application. You will receive an email shortly with the HR employee portal login process. Please contact your manager if any issues.</p>
                                                                <div class="hstack gap-2 justify-content-center">
                                                                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
     <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
                                
  <script>
async function startCamera() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const emp_id = document.getElementById('emp_id').value;
    const btn = document.getElementById('faceVerifyBtn');
    const message = document.getElementById('verificationMessage');
    const preVerificationmessage = document.getElementById('verificationPreMessage');
    const preview = document.getElementById('capturedImagePreview');
    const savedCapturedImage = document.getElementById('savedCapturedImage');
    btn.innerText = 'Capture Photo';
    savedCapturedImage.style.display ="none";
    

    // Load face-api models
    await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/External/models/tiny_face_detector'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/External/models/face_landmark_68'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/External/models/face_recognition')
    ]);

    // Show video stream
    video.style.display = 'block';
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => video.srcObject = stream);

    // On video play
    video.addEventListener('play', async () => {
        const result = await faceapi
            .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (result) {
            // Draw face to canvas
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/jpeg');
             // Stop video
             video.srcObject.getTracks().forEach(t => t.stop());
            video.style.display = "none";

            // Show captured preview to user
            preview.src = '';
            preview.src = imageData;
            preview.style.display = "block";
           
           

            // Send image to server
            fetch("<?= base_url('/External/Employee/uploadFaceImage') ?>", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    emp_id: emp_id,
                    image: imageData
                })
            }).then(res => res.json())
              .then(response => {
                  if (response.status === 'success') {
                      btn.innerText = 'Recapture Photo';
                      message.style.display = 'block';
                      preVerificationmessage.style.display = 'none';
                      $('#employeePhoto').val(true);
                      alert('Face verification completed.');
                  } else {
                      alert('Upload failed: ' + response.message);
                  }
              });
        } 
    }, { once: true });
}
</script>
<script>

    $(document).ready(function() {
    if($(".check_super_type").val() == 'yes'){
     $(".select_nominatedByEmployer").hide();   
    } 
    let nominatedByEmployer = '<?php echo $employee['nominatedByEmployer']; ?>';
    let check_tfn_type = '<?php echo $employee['check_tfn_type']; ?>';
    let have_surname_changed = '<?php echo $employee['have_surname_changed']; ?>';
    let stepsCompleted = '<?php echo $employee['stepsCompleted']; ?>';
    
    if(nominatedByEmployer == 0){
    $("#YesSuper").show();
    $("#NoSuper").hide();    
    }else{
    $("#YesSuper").hide();
    $("#NoSuper").show();    
    }
    
    if(check_tfn_type == 'tfn_number'){
      $("#Yes").show();
      $("#No").hide();
    }else{
      $("#Yes").hide();
      $("#No").show();   
    }
    
    if(have_surname_changed =='noChanged'){
     $("#noChanged").show();   
     $("#yesChanged").hide(); 
    }else{
     $("#noChanged").hide();   
     $("#yesChanged").show();    
    }
    
    $('#onboardSuccessModal').on('hidden.bs.modal', function () {
    window.location.href = 'https://bizadmin.com.au/<?php echo $this->session->userdata('tenantIdentifier'); ?>';
    });
    
    $('#save_continue_personal').click(function(e){
    var err=0; 
    if($('#title').val() == ''){ $('#title_error').html('Please select title');err=1;}
    if($('#first_name').val() == ''){ $('#first_name_error').html('Please enter first name');err=1;}
    if($('#last_name').val() == ''){ $('#last_name_error').html('Please enter last name');err=1;}
    if($('#email').val() == ''){ $('#email_error').html('Please enter email address'); err=1; } 
    if($('#phone').val() == ''){ $('#phone_error').html('Please enter phone number'); err=1; }
    if($('#dob').val() == ''){ $('#dob_error').html('Please enter date of birth'); err=1; }
    if($('#employeePhoto').val() == ''){ $('#verificationError').html('Please capture your photo'); err=1; }
    
    if($('#street_name').val() == ''){ $('#streetname_error').html('Please enter street name'); err=1; }
   
    if($('#state').val() == ''){ $('#state_error').html('Please select state'); err=1; }
    if($('#suburb').val() == ''){ $('#suburb_error').html('Please enter suburb'); err=1; }
    if($('#postcode').val() == ''){ $('#postcode_error').html('Please enter postcode'); err=1; }
    
    if(err == '0'){
     $('#loaderContainer').show();
        var data1 = $('#personalDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/External/Employee/submit_onboarding_process',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        activaTab('emergencyDetails'); $('#loaderContainer').hide();
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        }); e.preventDefault();
    }
    else{ alert('Please enter all the mandatory fields'); return false; }
	});
	
	
// 	emergency form submit
	$('#save_continue_emergency').click(function(e){
    var err=0;
    $('.fieldError').html('');
      $('#emergencyDetailsForm').find('.required').each(function() {
        // if((parseInt($(".emergencyDetailsFormSteps").val()) - parseInt(stepsCompleted)) > 1){
        //     alert("Please complete previous steps first"); activaTab('personalDetails');
        //     err = 1;
        //     return false;
        // }
          if($(this).val() == "") {
              err = 1;
              var fieldID=$(this).attr('id');
            //   console.log(fieldID);
              $('#'+fieldID+'_error').html('This field should not be empty');
          }
        });
    // validate prev steps are completed before completing further steps
    
    
    if(err == '0'){
        $('#loaderContainer').show();
        let data1 = $('#emergencyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/External/Employee/submit_onboarding_process',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        activaTab('bankDetails'); $('#loaderContainer').hide();
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        }); e.preventDefault();
    }
    else{ alert('Please enter all the mandatory fields'); return false; }
	});
	
	// 	bank form submit
	$('#save_continue_bank').click(function(e){
    var err=0;
    $('.fieldError').html('');
   
    $('#bankDetailsForm').find('.required').each(function() {
        
          if($(this).val() == "") {
               
              err = 1;
              var fieldID=$(this).attr('id');
            //   console.log(fieldID);
              $('#'+fieldID+'_error').html('This field should not be empty');
          }
        });
    
    if(err == '0'){
        $('#loaderContainer').show();
        let data1 = $('#bankDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/External/Employee/submit_onboarding_process',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        activaTab('taxDetails'); $('#loaderContainer').hide();
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        }); e.preventDefault();
    }
    else{ alert('Please enter all the mandatory fields'); return false; }
	});
	

	// 	tax form submit
	$('input[name=resident_type]').on("change",function(){
	  if($(this).val() == 'working_holiday'){
	      $(".countryOfOrigin").css("display","block");
	  }else{
	      $(".countryOfOrigin").css("display","none");
	  }
	})
	$('#save_continue_tax').click(function(e){
	    if($(".check_tfn_type ").val() == 'tfn_number' && $("#tfn_number").val() == ''){
	        alert('Please enter TFN number.');
	        $("#tfn_number_error").html('Please Enter TFN Number');
	        return false;
	    }
	   //else if($(".check_tfn_type ").val() == 'tfn_type' && !$('input[name=tfn_type]:checked').length > 0){
	   //      alert('Please choose correct TFN option.');
	   //      $("#tfn_type_error").html('Please choose correct TFN option');
	   //     return false;
	   // }
	   
	    if($('input[name=resident_type]:checked').val() == 'working_holiday' && $("#origin_country").val() == ''){
	      alert('Please enter  your native country');
	      $("#resident_type_error").html('Please enter  your native country');
	        return false;   
	    }
    var err=0;
    
     var allradio_tax = [];
   
    $('#taxDetailsForm').find('input[type="radio"]').each(function() {
            var fieldName=$(this).attr('name');
           
           if(fieldName !='loan_type' && fieldName != 'tfn_type'){
            if(!allradio_tax.includes(fieldName)){
                if (!$('input[name='+fieldName+']:checked').length > 0) {
             
                $('#'+fieldName+'_error').html('This field should not be empty');
                err=1; 
                   }
            }
           
           allradio_tax.push(fieldName);
           }
        });
        // return false;
    // err=1; 
    if(err == '0'){
        $('#loaderContainer').show();
        let data1 = $('#taxDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/External/Employee/submit_onboarding_process',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        activaTab('policeClearance'); $('#loaderContainer').hide();
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        }); e.preventDefault();
    }
    else{ alert('Please enter all the mandatory fields'); return false; }
	});	
	
	// 	police form submit
	$('#save_continue_police').click(function(e){
    var err=0;
    $('.fieldError').html('');
    let data1 = new FormData(document.getElementById("policeDetailsForm"));
    if($("#police").val() == "")
     {
         err=1;
         $('#police_error').html('Please upload police clearance certificate.');
      }

   
    if(err == '0'){
        $('#loaderContainer').show();

       let formData = new FormData($("#policeDetailsForm")[0]);
           $.ajax({
            type: "POST",
            url: '/External/Employee/submit_onboarding_process',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        activaTab('superAnnuation'); $('#loaderContainer').hide();
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	},
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
        e.preventDefault();
    }
    else{ alert('Please enter all the mandatory fields'); return false; }
	});

    // 	annuation
	$('#save_continue_annuation').click(function(e){
    $('.fieldError').html('');
    var err=0;
    if($(".check_super_type").val() == 'no'){
    if($('#select_nominatedByEmployer').is(":checked")){}else{ $('#nominatedByEmployer_error').html('Please check the checkbox'); err=1; }     
    }

    if(err == '0'){
        $('#loaderContainer').show();
        let data1 = $('#annuationDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/External/Employee/submit_onboarding_process',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        activaTab('privacyPolicy'); $('#loaderContainer').hide();
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        }); e.preventDefault();
    }
    else{
        alert('Please enter all the mandatory fields');
        return false;
    }
		
	});
	$('#save_continue_privacy').click(function(){
    let err=0;
    
    if($('#agree_terms_one').is(":checked")){}else{ $('#agree_terms_one_error').html('Please agree the terms'); err=1; }
    if($('#agree_terms_two').is(":checked")){}else{ $('#agree_terms_two_error').html('Please agree the terms'); err=1; }
    if ($('#agree_terms_three').is(":visible")) {
    if($('#agree_terms_three').is(":checked")){}else{ $('#agree_terms_three_error').html('Please agree the terms'); err=1; }
    }
    if(err == '0'){
        let data1 = $('#privacyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/External/Employee/submit_onboarding_process',
        	data: data1,
        	beforeSend: function(){
                $('#loaderContainer').show();
                 },
                complete:function(data){
                $('#loaderContainer').hide();
                 },
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        $('#loaderContainer').hide();
		        $("#onboardSuccessModal").modal('show');
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        	
        }); 
    }
    else{
        alert('Please enter all the mandatory fields');
        return false;
    }
		
	});
	
   function validate(evt) {
		  var theEvent = evt || window.event;
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode( key );
		  var regex = /[0-9]|\./;
		  if( !regex.test(key) ) {
		    theEvent.returnValue = false;
		    if(theEvent.preventDefault) theEvent.preventDefault();
		  }
		}

   function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
   };

  });
  
 function openThisTab(evt, selected_value,fieldname) { 
                                                       
    let i, tabcontent, tablinks;
                                                        
    tabcontent = document.getElementsByClassName("tabcontent_"+fieldname);
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks_"+fieldname);
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(selected_value).style.display = "block";
    
    if(fieldname =='tfn'){
     if(selected_value == 'No'){
    $('.check_tfn_type').val('tfn_type');
    }
    else{
    $('.check_tfn_type').val('tfn_number');
    }    
    }
   
   if(fieldname =='superAnnuation'){
    if(selected_value == 'NoSuper'){
    $('.check_super_type').val('no');
    $('#nominatedByEmployer').val(1);
    }
    else{
    $('.check_super_type').val('yes');
    $('#nominatedByEmployer').val(0);
    }
    }
    
    if(fieldname =='surname'){
    if(selected_value == 'noChanged'){
    $('#previous_surname').val(selected_value);
     }
    if(selected_value == 'noChanged' || selected_value == 'yesChanged'){
    $('.previous_surname_changed').val(selected_value);
    }
    }
     document.getElementById(selected_value).style.display = "block";
    evt.currentTarget.className += " active";
 }

</script>