<style>
  .step-wizard .step {
    flex: 1;
    text-decoration: none;
    color: inherit;
    position: relative;
  }
  .step-wizard .step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 24px;
    right: -50%;
    width: 100%;
    height: 2px;
    background-color: #ddd;
    z-index: 0;
  }
  .step .icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #ddd;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    font-size: 20px;
    position: relative;
    z-index: 1;
  }
  .step.active .icon-circle,
  .step:hover .icon-circle {
    background-color: #405189;
  }
  .step .label {
    font-weight: 500;
    font-size: 14px;
  }
</style>

<div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                  
                <div class="row">
                        
              
                 
                    <!-- end col -->
                <div class="col-md-12 col-sm-12 col-lg-12 col-xxl-12">
                <div class="card h-100">
                <div class="card-body">   
                <div class="step-wizard d-flex justify-content-between mb-4" id="v-pills-tab" role="tablist">
  <a class="step text-center active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
    <div class="icon-circle"><i class="fas fa-user"></i></div>
    <div class="label">Personal</div>
  </a>

  <?php if($this->roleId != 4) { ?>
  <a class="step text-center" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
    <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
    <div class="label">Employment</div>
  </a>
  <?php } ?>

  <a class="step text-center" id="v-pills-onboarding-tab" data-bs-toggle="pill" href="#v-pills-onboarding" role="tab" aria-controls="v-pills-onboarding" aria-selected="false">
    <div class="icon-circle"><i class="fas fa-file-alt"></i></div>
    <div class="label">Onboarding Form</div>
  </a>

  <a class="step text-center" id="v-pills-shifts-tab" data-bs-toggle="pill" href="#v-pills-shifts" role="tab" aria-controls="v-pills-shifts" aria-selected="false">
    <div class="icon-circle"><i class="fas fa-clock"></i></div>
    <div class="label">Shifts</div>
  </a>

  <a class="step text-center" id="v-pills-leaves-tab" data-bs-toggle="pill" href="#v-pills-leaves" role="tab" aria-controls="v-pills-leaves" aria-selected="false">
    <div class="icon-circle"><i class="fas fa-plane-departure"></i></div>
    <div class="label">Leave</div>
  </a>

  <a class="step text-center" id="v-pills-unavailability-tab" data-bs-toggle="pill" href="#v-pills-unavailability" role="tab" aria-controls="v-pills-unavailability" aria-selected="false">
    <div class="icon-circle"><i class="fas fa-ban"></i></div>
    <div class="label">Unavailability</div>
  </a>
</div>
                <div class="tab-content text-black mt-4 mt-md-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <form  role="form" id="personalDetailsForm" method="post" class="mt-4" enctype="multipart/form-data">
                     <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>   
                                                 
                                                   
                	  	<input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                	   <div class="row gy-4">
                	       <h4 class="text-black">Personal Details</h4>
                	   <div class="col-lg-2 col-md-2">
                		<label for="title" class="form-label">Title:</label>
                		<select class="form-select" id="title" name="title">
                		<option value="">Select</option>
                		 <option value="Mr" <?php if($employee['title'] == 'Mr') echo'selected';?>>Mr</option>
                		 <option value="Ms" <?php if($employee['title'] == 'Ms') echo'selected';?>>Ms</option>
                		  <option value="Mrs" <?php if($employee['title'] == 'Mrs') echo'selected';?>>Mrs</option>
                		  <option value="Miss" <?php if($employee['title'] == 'Miss') echo'selected';?>>Miss</option>
                		  <option value="Miss" <?php if($employee['title'] == 'Dr') echo'selected';?>>Dr</option>
                		 </select>
                		    <span class="fieldError" id="title_error"></span>
                		</div>
                		
                	   <div class="col-lg-2 col-md-4">
                			<label for="preferred_name" class=" control-label">Preferred Name:</label>
                			<input type="text" id="preferred_name" class="form-control" name="preferred_name" value="<?php echo $employee['preferred_name']; ?>" autocomplete="off" >
                		</div>
                		
                		<div class="col-lg-2 col-md-5">
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
                    						<input type="text"  class="form-control" id="email" name="email" value="<?php echo $employee['email']; ?>">
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
                		<label for="title" class="form-label">Stress Profile:</label>
                		<select class="form-select" id="title" name="stress_profile">
                		<option value="">Select Stress Profile</option>
                		<?php if(isset($stressProfiles) && !empty($stressProfiles)) {  ?>
                		<?php foreach($stressProfiles as $stressProfile) {  ?>
          <option value="<?php echo $stressProfile['id'] ?>" <?php echo ($stressProfile['id'] == $employee['stress_profile'] ? 'selected' : ''); ?>><?php echo $stressProfile['stressProfileName'] ?></option>
                		 <?php } ?>
                		 <?php } ?>
                		 </select>
                		</div>
                		
                					<div class="col-lg-3 col-md-6">
                    				<label for="businessname" class="form-label">Highest Academic Achievements: </label>
                    				<textarea class="form-control" rows="2" name="heighest_acd_achmts"><?php echo $employee['heighest_acd_achmts']; ?></textarea>
                    				</div>
                						
                					
                        
						
				
				  <h5 class="fw-bold text-black"> Address</h5>	
				    <div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Unit Number:</label>
							<input type="text" class="form-control" id="unit_number" name="unit_number" value="<?php echo $employee['unit_number']; ?>" autocomplete="off">
						</div>	
					<div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Street Number:</label>
							<input type="text" class="form-control" id="street" name="street" value="<?php echo $employee['street']; ?>"  autocomplete="off" >
								 <span class="fieldError" id="street_error"></span>
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
				     <input type="button" name="contact_submit" id="save_continue_personal" class="btn btn-success btn-ph" value="SAVE">		
                	</form>
                                                </div>
                <div class="tab-pane fade mx-4" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <button type="button" class="btn btn-sm shadow-none show" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/theme-assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                            <span class="ms-1 fs-16 text-black user-name-sub-text"><?php echo $employee['first_name'].' '.$employee['last_name']; ?></span>
                            </span>
                        </span>
                    </button>
            <form  role="form" id="workDetailsForm" method="post" action="" class="mt-4" enctype="multipart/form-data">
                 <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
                <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                <input type="hidden" name="positionIdToRemove" class="allPositionIdsToRemove" value="">
                                              <div class="row gy-4">
                <h4 class="text-black">Work Details</h4>                                  
                                             <div class="col-lg-3 col-md-6">
                                             <label for="rate" class=" control-label">Hired On:</label>
                							<input readonly type="text" id="rate" class="form-control" name="rate" value="<?php echo date('d-m-Y',strtotime($employee['date_modified'])); ?>">
                                            </div>    
                                             <div class="col-lg-3 col-md-6">
                                             <label for="rate" class=" control-label">Works At:</label>
                							<input readonly type="text" id="rate" class="form-control" name="rate" value="<?php if(isset($locationNames) && !empty($locationNames)) { echo implode(', ', $locationNames); } ?>">
                                             </div>
                                             
                    <div class="col-lg-3 col-md-6">
							<label for="businessname" class="form-label">Employment Type<span>*</span></label>
							<select class="form-select" name="employee_type" id="employee_type">
								<option value="">Select</option>
								<option value="1" <?php if($employee['employee_type'] == '1'){ echo "selected"; } ?>>Full Time</option>
								<option value="2" <?php if($employee['employee_type'] == '2'){ echo "selected"; } ?>>Part Time</option>
								<option value="3" <?php if($employee['employee_type'] == '3'){ echo "selected"; } ?>>Casual</option>
								<option value="4" <?php if($employee['employee_type'] == '4'){ echo "selected"; } ?>>Full Time Fixed Term</option>
								<option value="5" <?php if($employee['employee_type'] == '5'){ echo "selected"; } ?>>Part Time Fixed Term</option>
							</select>
						</div>
						
					
                                              </div>  
                                              
                                              
                                              
                                              
         <div class="row mt-4">
          <h4 class="text-black">Position Details</h4>
         <div class="row">       
         <div class="col-md-12 col-sm-12 table-responsive">
         <table class="table table-bordered mt-3" id="positionTable">
                     <tbody>
                  
    <?php if(isset($empPositionAndRatesData) && !empty($empPositionAndRatesData)) { ?>
                
    <?php foreach ($empPositionAndRatesData as $employeePR) { ?>
    <tr class="positionMainRow">
        <td class="gap-2 d-flex">
            <div class="col-lg-3 col-md-3">
                <label for="businessname" class="form-label">Position<span>*</span></label>
                <select class="form-select" name="position_id[]" id="position_id">
                    <option value="">Select</option>
                    <?php foreach ($positions as $position) { ?>
                        <option value="<?php echo $position['position_id']; ?>" <?php echo ($position['position_id'] == $employeePR['position_id']) ? 'selected' : ''; ?>>
                            <?php echo $position['position_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-2 col-md-2">
                <label for="rate" class="control-label">Weekday Rate:<span>*</span></label>
                <div class="form-icon">
                    <input type="number" id="rate" class="form-control form-control-icon" name="rate[]" value="<?php echo number_format((float)$employeePR['rate'], 2); ?>" autocomplete="off">
                    <i class="bx bx-dollar"></i>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <label for="Saturday_rate" class="control-label">Saturday Rate:<span>*</span></label>
                <div class="form-icon">
                    <input type="number" id="Saturday_rate" class="form-control form-control-icon" name="Saturday_rate[]" value="<?php echo number_format((float) $employeePR['Saturday_rate'], 2); ?>" autocomplete="off">
                    <i class="bx bx-dollar"></i>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <label for="Sunday_rate" class="control-label">Sunday Rate:<span>*</span></label>
                <div class="form-icon">
                    <input type="number" id="Sunday_rate" class="form-control form-control-icon" name="Sunday_rate[]" value="<?php echo number_format((float)$employeePR['Sunday_rate'], 2); ?>" autocomplete="off">
                    <i class="bx bx-dollar"></i>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <label for="holiday_rate" class="control-label">Public Holiday:<span>*</span></label>
                <div class="form-icon">
                    <input type="number" id="holiday_rate" class="form-control form-control-icon" name="holiday_rate[]" value="<?php echo number_format((float)$employeePR['holiday_rate'], 2); ?>" autocomplete="off">
                    <i class="bx bx-dollar"></i>
                </div>
            </div>
            <input type="hidden" name="position_unique_id[]" class="position_unique_id" value="<?php echo $employeePR['id']; ?>">
        </td>
        <td>
            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-success add-Positionrow" type="button">+</button>
                <button class="btn btn-danger remove-Positionrow" type="button">-</button>
            </div>
        </td>
    </tr>
    <?php } ?>
     <?php } else {   ?>
    <tr class="positionMainRow">
                    <td class="gap-2 d-flex">
                   <div class="col-lg-3 col-md-3">
							<label for="businessname" class="form-label">Position<span>*</span></label>
							<select class="form-select" name="position_id[]" id="position_id">
								<option value="">Select</option>
							   <?php if(isset($positions) && !empty($positions)) {  ?>
							   <?php foreach($positions as $position) {  ?>
							    <?php  if($position['position_id'] == $employee['position_id']) { ?> 
							   <option selected value="<?php echo $position['position_id'] ?>"><?php echo $position['position_name'] ?></option>
							   <?php }else {  ?>
							   <option  value="<?php echo $position['position_id'] ?>"><?php echo $position['position_name'] ?></option>
							    <?php } ?>
							   <?php } ?>
							   <?php } ?>
							</select>
						</div>
						<div class="col-lg-2 col-md-2">
                							<label for="rate" class=" control-label">Weekday Rate:<span>*</span></label>
                							<div class="form-icon">
                							<input type="number" id="rate" class="form-control form-control-icon" name="rate[]" value="" autocomplete="off" >
                						    <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>  
                	    <div class="col-lg-2 col-md-2">
                							<label for="Saturday_rate" class=" control-label">Saturday Rate:<span>*</span></label>
                							<div class="form-icon">
                							<input type="number" id="Saturday_rate" class="form-control form-control-icon" name="Saturday_rate[]" value="" autocomplete="off" >
                					       <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>
                		 <div class="col-lg-2 col-md-2">
                							<label for="Sunday_rate" class=" control-label">Sunday Rate:<span>*</span></label>
                							<div class="form-icon">
                							<input type="number" id="Sunday_rate" class="form-control form-control-icon" name="Sunday_rate[]" value="" autocomplete="off" >
                					       <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>
                		<div class="col-lg-2 col-md-2">
                							<label for="holiday_rate" class=" control-label">Public Holiday:<span>*</span></label>
                						   <div class="form-icon">	
                							<input type="number" id="holiday_rate" class="form-control form-control-icon" name="holiday_rate[]" value="" autocomplete="off" >
                					        <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2 mt-3">
                     <button class="btn btn-success add-Positionrow" type="button">+</button>
                     <button class="btn btn-danger remove-Positionrow" type="button">-</button>
                     </div>
                    </td>
                </tr>  
    <?php } ?>
    </tbody>
        </table> 
        </div>  
        </div> 
       </div>                    
                                              
                                              
                                              
                                 
                        <input type="button" name="contact_submit" id="save_continue_work" class="btn btn-success btn-ph" value="SAVE">                            
                                                </form>
                                                </div>
                <div class="tab-pane fade" id="v-pills-onboarding" role="tabpanel" aria-labelledby="v-pills-onboarding-tab">
                                                
             <ul class="nav nav-tabs nav-justified mb-3 d-flex" role="tablist">
              
              
              <li class="nav-item" rel="emergencyDetails" >
              <a class="nav-link active" data-bs-toggle="tab" href="#emergencyDetails" role="tab">Emergency Details
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 1){ ?>
                <i class="ri-check-double-line text-success"></i>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="bankDetails">
              <a class="nav-link" value="bankDetails" data-bs-toggle="tab" href="#bankDetails" role="tab">Bank Details
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 2){ ?>
                <i class="ri-check-double-line text-success"></i>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="taxDetails">
              <a class="nav-link" data-bs-toggle="tab" href="#taxDetails" role="tab">Tax Details
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 3){ ?>
                <i class="ri-check-double-line text-success"></i>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="policeClearance">
              <a class="nav-link" data-bs-toggle="tab" href="#policeClearance" role="tab">Police Clearance
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 4){ ?>
              <i class="ri-check-double-line text-success"></i>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="superAnnuation">
              <a class="nav-link" data-bs-toggle="tab" href="#superAnnuation" role="tab">Super Annuation
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 5){ ?>
                <i class="ri-check-double-line text-success"></i>
               <?php }   ?></a>
              </li>
              
              <li class="nav-item" rel="privacyPolicy">
              <a class="nav-link" data-bs-toggle="tab" href="#privacyPolicy" role="tab">Policies
              <?php if(isset($employee['stepsCompleted']) && $employee['stepsCompleted'] > 6){ ?>
                <i class="ri-check-double-line text-success"></i>
               <?php }   ?></a>
              </li>
           
           </ul> 
                 <div class="tab-content text-black">
                   <div class="tab-pane active" id="emergencyDetails" role="emergencyDetails">
                       
              <form  role="form" id="emergencyDetailsForm" method="post" action="" enctype="multipart/form-data">
                   <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
                            	        <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
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
                    						<label for="businessname" class="form-label">Postcode:</label>
                    						<input type="text" class="form-control" name="nextkin_postcode" value="<?php echo $employee['nextkin_postcode']; ?>" autocomplete="off" >
                    						</div>
                    					<div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">State:</label>
                    						<input type="text" class="form-control" name="nextkin_state" value="<?php echo $employee['nextkin_state']; ?>" autocomplete="off" >
                    						</div>
                    				
                    						</div>   
               <input type="button" rel="bankDetails" name="contact_submit" id="save_continue_emergency" class="btn btn-success btn-ph" value="SAVE">		
                						</form>                             
               </div>         
                     
                    <div class="tab-pane" id="bankDetails" role="bankDetails">   
                     
                      <form  role="form" id="bankDetailsForm" method="post" action="" enctype="multipart/form-data">
                           <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
                           	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
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
                					
                		<input type="button" rel="taxDetails" name="contact_submit" id="save_continue_bank" class="btn btn-success btn-ph" value="SAVE">
                	</form>   
                     
                     </div> 
                     
                    <div class="tab-pane" id="taxDetails" role="taxDetails">  
                  
                   	<form  role="form" id="taxDetailsForm" method="post" action="" enctype="multipart/form-data">
                   	     <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
                               	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
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
                							<input type="button" value="SAVE" rel="policeClearance" name="contact_submit" id="save_continue_tax" class="btn btn-success btn-ph">
                						</form>
                     
                      </div>  

                     <div class="tab-pane" id="policeClearance" role="policeClearance">
                  
                   <p class="fw-bold">Police clearance certificate is mandatory to commence work. Please upload your certificate<span>*</span></p>
                   <?php if(isset($employee['police_certificate']) && $employee['police_certificate'] !='' && is_serialized($employee['police_certificate'])){  ?>
                   
                   <?php  $attachments = @unserialize($employee['police_certificate']); ?>
                   <?php foreach($attachments as $attachment) {  ?> 
    <p><a href="<?php echo base_url().'uploaded_files/cjs/HR/OnboardingFiles/'.$attachment ?>" target="_blank" class="btn btn-sm btn-success">View Attachment</a></p> 
                   <?php } ?>
                   <?php }else { ?>
                   <p><small>Refresh page to view already upladed document</small></p>
                   <?php } ?>
                   <form  role="form" id="policeDetailsForm" method="post" action="" enctype="multipart/form-data">
                        <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
                               	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
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
						           
						   <input type="button" rel="privacyPolicy" name="contact_submit" id="save_continue_police" class="btn btn-success btn-ph" value="SAVE">
                						</form>     
                        
                    </div>
                    
                    <div class="tab-pane" id="superAnnuation" role="superAnnuation">
                        
                    <form  role="form" id="annuationDetailsForm" method="post" action="" enctype="multipart/form-data">
                         <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
            		<input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
            		<div class="section-wrap">
            				            <div class="checkbox-group col-md-12" >
						      <p class="fw-bold">Do you have an existing superannuation account?</p>
						           <div class="tab">
						               
                                     <a class="tablinks tablinks_superAnnuation <?php echo (isset($employee['nominatedByEmployer']) && $employee['nominatedByEmployer'] == 0 ? 'active' :'' ); ?>" onclick="openThisTab(event, 'YesSuper','superAnnuation')">Yes</a>
                                     <a class="tablinks tablinks_superAnnuation <?php echo (isset($employee['nominatedByEmployer']) && $employee['nominatedByEmployer'] == 1 ? 'active' : '' ); ?>" onclick="openThisTab(event, 'NoSuper','superAnnuation')">No</a>
                                      <input type="hidden" value="<?php echo $employee['check_super_type']; ?>" name="check_super_type" class="check_super_type">
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
            				            <input  id="nominatedByEmployer" type="hidden" value="<?php echo $employee['nominatedByEmployer']; ?>" name="nominatedByEmployer" >

            				    	<div class="checkbox">
                            			<label style="color:#000;">
                            			    <input type="checkbox" checked="<?php echo (isset($employee['nominatedByEmployer']) && $employee['nominatedByEmployer'] == 1 ? 'checked' : '' ); ?>"  value="1" id="select_nominatedByEmployer" onchange="document.getElementById('nominatedByEmployer').value = this.checked ? 1 : 0">The super fund nominated by my employer.<span>*</span>
                            		     </label>
     
                            		<span class="fieldError" id="nominatedByEmployer_error"></span> 
                            							</div>
                                                    </div>
            				        
            				        </div>
                	<input type="button" rel="policeClearance" name="contact_submit" id="save_continue_annuation" class="btn btn-success btn-ph" value="SAVE">
                    </form>    
                     </div>
                     
                    <div class="tab-pane" id="privacyPolicy" role="privacyPolicy">
                      
                     <p class="fw-bold">You must read and agree to below attached company policies, staff induction and job description policies before submitting the form.</p>
                               	<form  role="form" id="privacyDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	     <div class="alert alert-success border-0 shadow d-none" role="alert">Details have been saved successfully</div>
                               	    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                               	      <div class="row">
                                        <div class="col-lg-4">
                                      <h5 class="text-black">Staff Induction Manual</h5>
                                    <div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
                            	<a class="btn btn-success btn-sm" href="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/job_10114.pdf" target="_blank">View</a>
                            	</div><br>
                            	   
                            <div class="form-group">
                          <div class="pdf-view-wrap">
                            <iframe src="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/job_10114.pdf" width="100%" height="100%"></iframe>
                          <div class="form-check mb-2">
                         <label class="form-check-label"><input class="form-check-input" id="agree_terms_one" type="checkbox" value="1" name="agree_terms_one" checked="<?php $employee['agree_terms_one'] == 1 ? 'checked' : '' ?>">I read, understood and agree to the the Staff Induction Manual.<span>*</span></label>
                        <span class="fieldError" id="agree_terms_one_error"></span> 
                            			</div>
                            			</div>	
                            			</div>
                            					
                            	         </div>
                                        <div class="col-lg-4">
                                                <h5 class="text-black">Company Policies and Procedures</h5>
                                           
                        					<div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
                        					 	<a class="btn btn-success btn-sm" href="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/job_10114.pdf" target="_blank">View</a>
                        					</div><br>
                        	          		
                        						<div class="form-group">
                        							<div class="pdf-view-wrap">
                        		<iframe src="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/job_10114.pdf" width="100%" height="100%"></iframe>
                        			<div class="form-check mb-2">
                        			<label class="form-check-label"><input class="form-check-input" type="checkbox" id="agree_terms_two" value="1" name="agree_terms_two"  checked="<?php $employee['agree_terms_two'] == 1 ? 'checked' : '' ?>">I read, understood and agree to the  Company Policies and Procedures Manual.<span>*</span></label>
                        			<span class="fieldError" id="agree_terms_two_error"></span> 
                        		</div>
                        		</div>	
                        					
                        	          		</div>
                    	          		</div>
                     <div class="col-lg-4">
                     <?php  
                     if(isset($employee['job_desc']) && $employee['job_desc'] !='' && !is_string($employee['job_desc'])){
                         
                     
                    $fileNameArray = unserialize($employee['job_desc']);
                   if(isset($fileNameArray) && !empty($fileNameArray)){
                        							     $fileName = $fileNameArray[0];
                        							     $file_parts = pathinfo($fileName); ?>
                                      <h5 class="text-black">Job Description</h5>
                                      <div class="col-md-2 job_desc_btn btn-position" style="text-align:right;padding-right:0px;">
                        			<a class="btn btn-success btn-sm mx-3" href="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/<?php echo $fileName; ?>" target="_blank">View</a>
                        			  </div> <br>
                        	          		
                        						<div class="form-group">
                        							<div class="pdf-view-wrap">
                        							    
                        							    
                        							  <?php if($file_parts['extension'] == 'pdf'){ ?>
        <iframe src="<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/<?php echo $fileName; ?>" width="100%" height="100%"></iframe>
                        							      <?php }else { ?>
        <iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/HR/JobDescr/<?php echo $fileName; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
                        								<?php } ?>
                        							
           <div class="form-check mb-2">
           <label  class="form-check-label"><input class="form-check-input" type="checkbox" id="agree_terms_three" value="1" name="agree_terms_three"  checked="<?php $employee['agree_terms_three'] == 1 ? 'checked' : '' ?>">I read, understood and agree to the Job Descriptions Manual.<span>*</span></label>
            <span class="fieldError" id="agree_terms_three_error"></span>                        							
           </div>
          </div>	
            </div>
        <?php } 
                     }
                   ?>
                  </div>                 
        </div> 
      <input type="button" name="contact_submit" id="save_continue_privacy" value="Submit" class="btn btn-success btn-ph">
                            </form>    
                     </div>
                     
                       </div>
                       </div>
                <div class="tab-pane fade" id="v-pills-documents" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                     <button type="button" class="btn btn-sm shadow-none show" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/theme-assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                            <span class="ms-1 fs-16 text-black user-name-sub-text"><?php echo $employee['first_name'].' '.$employee['last_name']; ?></span>
                            </span>
                        </span>
                    </button>
                                                    <div class="d-flex mb-4">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/small/img-7.jpg" alt="" width="150" class="rounded">
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                </div>
               <div class="tab-pane fade" id="v-pills-shifts" role="tabpanel" aria-labelledby="v-pills-shifts-tab">
                 <button type="button" class="btn btn-sm shadow-none show" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/theme-assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                            <span class="ms-1 fs-16 text-black user-name-sub-text"><?php echo $employee['first_name'].' '.$employee['last_name']; ?></span>
                            </span>
                        </span>
                    </button>   
                                                    <div class="d-flex mb-4">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/small/img-7.jpg" alt="" width="150" class="rounded">
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                </div>
               <div class="tab-pane fade" id="v-pills-leaves" role="tabpanel" aria-labelledby="v-pills-leaves-tab">
                    <button type="button" class="btn btn-sm shadow-none show" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/theme-assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                            <span class="ms-1 fs-16 text-black user-name-sub-text"><?php echo $employee['first_name'].' '.$employee['last_name']; ?></span>
                            </span>
                        </span>
                    </button>
               <div class="row mb-3"><div class="col-md-6"><h4 class="text-black ">Leaves Taken</h4></div>
    <div class="col-md-6"><button class="btn btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target=".requestLeave"><i class="ri-add-line"></i> Add leave request</button></div></div>
    <div class="row row-cols-xxl-5 row-cols-lg-5 row-cols-md-4 row-cols-1">
        <?php if(isset($leaveTypes) && !empty($leaveTypes)) { ?>
    <?php foreach($leaveTypes as $leaveType) { ?>
        <?php
            $leaveTypeIds = array_column($countOfLeaves, 'id');
            $key = array_search($leaveType['id'], $leaveTypeIds);
            $leaveCount = ($key !== false) ? $countOfLeaves[$key]['count'] : 0;
        ?>
        <div class="col">
            <div class="card bg-info-subtle shadow-none bg-opacity-10">
                <div class="card-body text-center py-4">
                    <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                    <a href="#!" class="stretched-link">
                        <h5 class="mt-4 text-black"><?php echo $leaveType['leaveTypeName']; ?></h5>
                    </a>
                    <p class="text-black mb-0"><?php echo $leaveCount; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

    <!--<div class="col">-->
    <!--                            <div class="card bg-info-subtle shadow-none bg-opacity-10">-->
    <!--                                <div class="card-body text-center py-4">-->
    <!--                                    <lord-icon src="https://cdn.lordicon.com/kkcllwsu.json" trigger="hover" colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>-->
    <!--                                    <a href="#!" class="stretched-link">-->
    <!--                                        <h5 class="mt-4 text-black">Annual leave</h5>-->
    <!--                                    </a>-->
    <!--                                    <p class="text-black mb-0">12</p>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--<div class="col">-->
    <!--                            <div class="card bg-info-subtle shadow-none bg-opacity-10">-->
    <!--                                <div class="card-body text-center py-4">-->
    <!--                                    <lord-icon src="https://cdn.lordicon.com/sygggnra.json" trigger="hover" colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>-->
    <!--                                    <a href="#!" class="stretched-link">-->
    <!--                                        <h5 class="mt-4 text-black">Study leave</h5>-->
    <!--                                    </a>-->
    <!--                                    <p class="text-black mb-0">7</p>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--<div class="col">-->
    <!--                            <div class="card bg-info-subtle shadow-none bg-opacity-10">-->
    <!--                                <div class="card-body text-center py-4">-->
    <!--                                    <lord-icon src="https://cdn.lordicon.com/pvbjsfif.json" trigger="hover" colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>-->
    <!--                                    <a href="#!" class="stretched-link">-->
    <!--                                        <h5 class="mt-4 text-black">Compassionate leave</h5>-->
    <!--                                    </a>-->
    <!--                                    <p class="text-black mb-0">3</p>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    </div>
    
    <h4 class="text-black">Leave requests</h4> 
    <div class="row">
    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist" style="display:flex !important">
     <li class="nav-item">
      <a class="nav-link py-3 Delivered active" data-bs-toggle="tab" href="#pastLeaves" role="tab" aria-selected="false">
      <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Past Leaves</a></li>
      
      <li class="nav-item">
      <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" href="#upcomingLeaves" role="tab" aria-selected="false">
      <i class="ri-close-circle-line me-1 align-bottom"></i> Upcoming Leaves </a></li>
      </ul>  
    <div class="tab-content mb-1">
    <div class="tab-pane   active show table-responsive" role="tabpanel"  id="pastLeaves">  
    <table id="leaveListTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
        <thead class="table-light">
        <tr>
        <th>Leave Type </th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status </th>
        <th>Action </th>
        </tr>
        </thead>
        <tbody>
    <?php if(isset($leaveRequestsData) && !empty($leaveRequestsData)) { ?>
    <?php foreach($leaveRequestsData as $leaveRequests){ ?>
     <tr data-delete-id="<?php echo $leaveRequests['id']; ?>">
        <td><?php echo $leaveRequests['leaveTypeName'] ?></td>
        <td><?php echo date('d-m-Y',strtotime($leaveRequests['start_date'])); ?></td>
        <td><?php echo date('d-m-Y',strtotime($leaveRequests['end_date'])); ?></td>  
        <td><?php echo ($leaveRequests['leave_status'] == 1) ? 'Pending' : (($leaveRequests['leave_status'] == 2) ? 'Approved' : (($leaveRequests['leave_status'] == 3) ? 'Rejected' : 'Cancelled')); ?></td>
        <td>
    <?php if (isset($leaveRequests['leave_status']) && $leaveRequests['leave_status'] != 2) { ?>
    <a href="#" class="btn btn-sm btn-soft-danger shadow-none" onclick="cancelLeave(this,<?php echo $leaveRequests['id']; ?>)">Cancel</a>
     <?php } ?>
            </td>
        </tr> 
    <?php } ?>
    <?php } ?>
         
        </tbody>
    </table> 
        </div>
    <div class="tab-pane  table-responsive" role="tabpanel"  id="upcomingLeaves">  
    <table id="leaveListTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
        <thead class="table-light">
        <tr>
        <th>Leave Type </th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status </th>
        <th>Action </th>
        </tr>
        </thead>
        <tbody>
    <?php if(isset($upcomingLeaveData) && !empty($upcomingLeaveData)) { ?>
    <?php foreach($upcomingLeaveData as $upcomingLeave){ ?>
     <tr data-delete-id="<?php echo $upcomingLeave['id']; ?>">
        <td><?php echo $upcomingLeave['leaveTypeName'] ?></td>
        <td><?php echo date('d-m-Y',strtotime($upcomingLeave['start_date'])); ?></td>
        <td><?php echo date('d-m-Y',strtotime($upcomingLeave['end_date'])); ?></td>  
        <td><?php echo ($upcomingLeave['leave_status'] == 1) ? 'Pending' : (($upcomingLeave['leave_status'] == 2) ? 'Approved' : (($upcomingLeave['leave_status'] == 3) ? 'Rejected' : 'Cancelled')); ?></td>
        <td>
    <?php if (isset($upcomingLeave['leave_status']) && $upcomingLeave['leave_status'] != 2) { ?>
    <a href="#" class="btn btn-sm btn-soft-danger shadow-none" onclick="cancelLeave(this,<?php echo $upcomingLeave['id']; ?>)">Cancel</a>
     <?php } ?>
            </td>
        </tr> 
    <?php } ?>
    <?php } ?>
         
        </tbody>
    </table> 
        </div>    
        </div>
    </div>
    </div>    
    <div class="tab-pane fade" id="v-pills-unavailability" role="tabpanel" aria-labelledby="v-pills-unavailability-tab">
       <button type="button" class="btn btn-sm shadow-none show" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/theme-assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                            <span class="ms-1 fs-16 text-black user-name-sub-text"><?php echo $employee['first_name'].' '.$employee['last_name']; ?></span>
                            </span>
                        </span>
                    </button>  
     
       <div class="flex-shrink-0">
        <button class="btn btn-soft-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Request Time Off</button>
        </div>
        
        <div class="unavailability-list mt-4">
                            <?php if(!empty($unavailability)){ 
                            foreach($unavailability as $unavail){
                            $start_date = new DateTime($unavail['start_date']);
                            $end_date = new DateTime($unavail['end_date']);
                            if($start_date == $end_date){
                               $abs_diff = 1; 
                            }else{
                                $abs_diff = $end_date->diff($start_date)->format("%a");
                            }
                            if($unavail['type'] == 'all_day'){
                            ?>
                                <div class="card custom_border-solid mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-2">
                                                <span class="badge rounded-pill text-bg-primary mb-2 p-2 px-3"><?php echo $abs_diff; ?> Day</span><br>
                                                <span class="fw-bold"><?php echo date('d-m-Y', strtotime($unavail['start_date'])).' TO '.date('d-m-Y', strtotime($unavail['end_date'])); ?></span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" rel="<?php echo $unavail['emp_availability_id']; ?>" class="delUnavailability btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="card custom_border-solid mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-2">
                                                <span class="badge rounded-pill text-bg-primary mb-2 p-2 px-3"><?php echo $abs_diff; ?> Hours</span><br>
                                                <span class="fw-bold"><?php echo date('d-m-Y', strtotime($unavail['start_date'])); ?></span><br>
                                                <span><?php echo $unavail['start_time'].'-'.$unavail['end_time']; ?></span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" rel="<?php echo $unavail['emp_availability_id']; ?>" class="delUnavailability btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            
                            <?php } } } ?>
                        </div>
    </div>
    
    </div>
                
                </div>
                </div>                            
                </div><!--  end col -->
                                        
                    </div>
                    </div>
                    </div>
                    
      <div class="modal fade requestLeave" tabindex="-1" role="dialog" aria-labelledby="requestLeaveModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="requestLeaveModalLabel">Request Leave</h5>
                                                                
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                         <div class="alert alert-success shadow successleaveRequest" role="alert" style="display:none">
                                             Leave request sent succesfully.
                                                </div> 
                                      <div class="alert alert-danger shadow mb-xl-0 dangerEmployee" role="alert" style="display:none"></div>   
                                      <form  role="form" id="newLeaveRequest" method="post" action="" enctype="multipart/form-data">  
                                     <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>"> 
                                       <div class="row">
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="customer-name" class="col-form-label">Start Date:</label>
                                <input type="text" name="start_date" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">                                    
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                <label for="customer-name" class="col-form-label">End Date:</label>
                                <input type="text" name="end_date" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                </div>
                               <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                          <label for="leaveType" class="form-label">Leave Type</label>           
                            <select class="form-select mb-3" name="leave_type" id="leaveType">
                             <option value=""> Select Leave Type</option>
                             <?php if(isset($leaveTypes) && $leaveTypes) { ?>
                             <?php foreach($leaveTypes as $leaveType) {  ?>
                             <option value="<?php echo $leaveType['id'] ?>"><?php echo $leaveType['leaveTypeName'] ?></option>
                             <?php } ?>
                             <?php } ?>
                                </select>
                               </div>
                             <div class="mb-3 col-lg-6 col-md-6 col-sm-12 sickcertificateAttachment d-none">  
                            <label for="leaveType" class="form-label">Medical Certificate</label>
                             <input type="file" id="sickleaveattachment" name="userfile[]" class="form-control" multiple>
                             </div>
                                 
                             <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                              <div>
                            <label for="leaveComments" class="form-label">Comment</label>
                            <textarea class="form-control" id="leaveComments" name="leaveComments" rows="3"></textarea>
                             </div>
                            </div>  
                            
                                 </div>
                               </form>
                            </div>
                            <div class="modal-footer">
                            <a href="javascript:void(0);" class="btn btn-link link-success shadow-none fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            <button type="button" class="btn btn-primary leaveRequestBtn" onclick="requestLeave()">Request Leave</button>
                           </div>
                            </div>
                            </div>
                       </div>                
     <?php $this->load->view('general/unavailabilityCanvas'); ?>               
    <script>
   $("#leaveListTable").DataTable({
    lengthChange: false,
    pageLength: 100,
   });
   function activaTab(formId){
    
    $("#"+formId).find(".alert").removeClass('d-none');
    };
    $(document).ready(function() {
        
    $("#leaveType").on('change',function(){
      
       let selectedOptionHTML = $('#leaveType option:selected')[0].outerHTML;
       let regex = /Sick Leave/i;
       console.log("nn",selectedOptionHTML)
        // in case of sick leave attachment is must
    if(regex.test(selectedOptionHTML)){
    $(".sickcertificateAttachment").removeClass("d-none");     
     }else{
   $(".sickcertificateAttachment").addClass("d-none");       
     }
   })    
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
    

    $('#save_continue_personal').click(function(e){
    let err=0; 
    if($('#title').val() == ''){ $('#title_error').html('Please select title');err=1;}
    if($('#first_name').val() == ''){ $('#first_name_error').html('Please enter first name');err=1;}
    if($('#last_name').val() == ''){ $('#last_name_error').html('Please enter last name');err=1;}
    if($('#email').val() == ''){ $('#email_error').html('Please enter email address'); err=1; } 
    if($('#phone').val() == ''){ $('#phone_error').html('Please enter phone number'); err=1; }
    if($('#dob').val() == ''){ $('#dob_error').html('Please enter date of birth'); err=1; }
    
    if($('#street_name').val() == ''){ $('#streetname_error').html('Please enter street name'); err=1; }
   
    if($('#state').val() == ''){ $('#state_error').html('Please select state'); err=1; }
    if($('#suburb').val() == ''){ $('#suburb_error').html('Please enter suburb'); err=1; }
    if($('#postcode').val() == ''){ $('#postcode_error').html('Please enter postcode'); err=1; }
    
    if(err == '0'){
        let btnsave = $('#save_continue_personal');
     btnsave.val("Saving data...");
        let data1 = $('#personalDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    console.log("res",res);
        	    if(res?.status=='success'){
        	    activaTab('personalDetailsForm');    
		       btnsave.val("SAVE AND CONTINUE");
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        }); e.preventDefault();
    }
    else{ alert('Please enter all the mandatory fields'); return false; }
	});
	
	// WorkDetail submit
	
	$('#save_continue_work').click(function(e){
     let positionIdToRemove = localStorage.getItem("positionIdsToRemove")
     $(".allPositionIdsToRemove").val(positionIdToRemove);
     $('#save_continue_work').val("Saving...");
        let data1 = $('#workDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
        	    addHiddenInputFields(res?.positionAddedDetails);     
        	     localStorage.removeItem("positionIdsToRemove")
		       $('#save_continue_work').val("SAVE AND CONTINUE");
		       activaTab('workDetailsForm');
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        });
   
	});
	
// 	emergency form submit
	$('#save_continue_emergency').click(function(e){
     console.log("Clicked");
       $('#save_continue_emergency').val("Saving...");
        let data1 = $('#emergencyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        $('#save_continue_emergency').val("SAVE AND CONTINUE");
		        activaTab('emergencyDetailsForm');
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	}
        });
   
	});
	
	// 	bank form submit
	$('#save_continue_bank').click(function(e){
    var err=0;
    $('.fieldError').html('');
   
    $('#bankDetailsForm').find('.required').each(function() {
        
          if($(this).val() == "") {
              err = 1;
              let fieldID=$(this).attr('id');
              $('#'+fieldID+'_error').html('This field should not be empty');
          }
        });
    
    if(err == '0'){
        $('#save_continue_bank').val("Saving..."); 
        let data1 = $('#bankDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        $('#save_continue_bank').val("SAVE AND CONTINUE"); 
		        activaTab('bankDetailsForm');
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
        $('#save_continue_tax').val("Saving..."); 
        let data1 = $('#taxDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        $('#save_continue_tax').val("SAVE AND CONTINUE"); 
		        activaTab('taxDetailsForm');
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
        $('#save_continue_police').val("Saving..."); 

       let formData = new FormData($("#policeDetailsForm")[0]);
           $.ajax({
            type: "POST",
            url: '/HR/Employee/submitOnboardingProcessForEmployee',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        $('#save_continue_police').val("SAVE AND CONTINUE"); 
		         activaTab('policeDetailsForm');
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
        $('#save_continue_annuation').val("Saving..."); 
        let data1 = $('#annuationDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		        $('#save_continue_annuation').val("SAVE AND CONTINUE");
		           activaTab('annuationDetailsForm');
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
        $('#save_continue_privacy').val("Saving..."); 
        let data1 = $('#privacyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/Employee/submitOnboardingProcessForEmployee',
        	data: data1,
        	success: function(response){
        	    let res = JSON.parse(response)
        	    if(res?.status=='success'){
		         $('#save_continue_privacy').val("SAVE AND CONTINUE"); 
		         activaTab('privacyDetailsForm');
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
    function requestLeave(){
      $('.leaveRequestBtn').html("Loading...");     
       let formData = new FormData($("#newLeaveRequest")[0]);
           $.ajax({
            type: "POST",
            url: '/HR/Leave/requestLeave',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                $(".successleaveRequest").show();
        	    $('.leaveRequestBtn').html("Request Leave");
        	    
        	    $(".requestLeave").modal('hide');
        	},
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    function cancelLeave(obj,leaveId){
     $(obj).html('Cancelling...');
      $.ajax({
       type: "POST",
       "url" : "/HR/Leave/cancelLeave",
       data:'id='+leaveId,
       success: function(data){
        $("tr[data-delete-id='" + leaveId + "']").remove();
        $(obj).html('Cancelled');
        }
        });
    }
    
  
$(document).ready(function(){
   $(document).on('click', '.add-Positionrow', function() {
        let $positionMainRow = $(this).closest('.positionMainRow');
        let clonedRow = $positionMainRow.clone();
        clonedRow.find('.position_unique_id').remove(); // Remove the element with the class "position_unique_id" from the cloned row
        $positionMainRow.after(clonedRow);
    });


     

 $(document).on('click', '.remove-Positionrow', function() {
    if ($('.positionMainRow').length > 1) {
        // Retrieve the existing array from localStorage
        let storedPositionIds = JSON.parse(localStorage.getItem("positionIdsToRemove")) || [];
        let positionIdToRemove = $(this).closest(".positionMainRow").find('input[name="position_unique_id[]"]').val();
        storedPositionIds.push(positionIdToRemove);
        localStorage.setItem("positionIdsToRemove", JSON.stringify(storedPositionIds));
        $(this).closest('.positionMainRow').remove();
    }
});

});

// adding updating multiple employee position 

 function addHiddenInputFields(data) {

        $('.positionMainRow').each(function(index) {
            var positionId = $(this).find('select[name="position_id[]"]').val();
            var positionData = data.find(item => item.position_id == positionId);
            if (positionData) {
    // Check if the hidden input field already exists within this element
    var hiddenInput = $(this).find('input[name="position_unique_id[]"]');

    if (hiddenInput.length) {
        // If it exists, update its value
        hiddenInput.val(positionData.id);
    } else {
        // If it doesn't exist, append a new hidden input field
        $(this).append('<input type="hidden" class="position_unique_id" name="position_unique_id[]" value="' + positionData.id + '">');
    }
}
        });
    }

</script>                