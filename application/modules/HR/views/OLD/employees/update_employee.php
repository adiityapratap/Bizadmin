<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <form class="form-horizontal" id="document_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_update_employee" enctype="multipart/form-data">
                <?php if(isset($details[0]->outlet_id)){ ?>	
            	<input type="hidden" class="form-control" name="emp_id" value="<?php echo $row->emp_id; ?>">
            	   <?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">EMPLOYEE INDUCTION</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>

                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/manage_employee"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <input type="submit" name="outlet_submit" class="btn btn-primary" value="Submit">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                             <span class="validation_text">
                            	<?php echo validation_errors(); ?>
                            	<span>
                             <?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
                            <div class='hideMe'>
                                <p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
                            </div>
                            <?php } ?>
                            <?php if(null !==$this->session->userdata('error_msg')) { ?>  
                            <div class='hideMe'>
                                <p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <?php foreach($employee as $row){ ?> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tabs_wrapper">
                                            <ul class="tabs">
                                                <li class="active" rel="personalDetails">Personal Details</li>
                                                <li rel="emergencyDetails">Emergency Details</li>
                                                <li rel="generalInfo">General Info</li>
                                                <li rel="postalAddress">Home Address</li>
                                                <li rel="bankDetails">Bank Details</li>
                                                <li rel="taxDetails">Tax Details</li>
                                                <li rel="ploceDeductions">Police Deductions</li>
                                                <li rel="requiredFile">Required File Uploads</li>
                                                <li rel="medicalHistory">Medical History</li>
                                                <li rel="vaccinationCertificate">Vaccination Certificate</li>
                                                <li rel="trainingUndertaken">Training Undertaken</li>
                                                <li rel="superAnnuation">Super Annuation</li>
                                                <li rel="staffInductionManual">Staff Induction Manual</li>
                                                <li rel="companyPolicies">Company Policies and Procedures</li>
                                                <li rel="jobDescription">Job Description</li>
                                            </ul>
                                            <div class="tab_container">
                                                <h3 class="d_active tab_drawer_heading" rel="personalDetails">Personal Details</h3>
                                                <div id="personalDetails" class="tab_content">
                                                    <h2>Personal Details</h2>
                                                    <div class="panel-body ct-form-in">
                                                        <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="title" class="control-label">Title:<span>*</span></label>
                                                                <select class="form-control" id="title" name="title">
                                                                    <option value="">Select</option>
                                                                    <option value="Mr" <?php if($row->title == 'Mr'){ echo "selected"; } ?>>Mr</option>
                                                                    <option value="Ms" <?php if($row->title == 'Ms'){ echo "selected"; } ?>>Ms</option>
                                                                    <option value="Mrs" <?php if($row->title == 'Mrs'){ echo "selected"; } ?>>Mrs</option>
                                                                    <option value="Miss" <?php if($row->title == 'Miss'){ echo "selected"; } ?>>Miss</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-5" >
                                                                <label for="first_name" class=" control-label">First Name:<span>*</span></label>
                                                                <input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $row->first_name; ?>" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group col-md-5" >
                                                                <label for="last_name" class=" control-label">Last Name:<span>*</span></label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row->last_name; ?>" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6" >
                                                                <label for="email" class="control-label">Email Address:<span>*</span></label>
                                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row->email; ?>">
                                                            </div>		
                                                            <div class="form-group col-md-6" >
                                                                <label for="password" class="control-label">Password:</label>
                                                                <input type="text" class="form-control" id="password" name="password" value="" placeholder="*******">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-2" >
                                                                <label class="control-label" for="pin">Pin:<span>*</span></label>
                                                                <div class="input-group" style="border: 1px solid #d3d1d1 !important; display: table;">
                                                                    <input type="password" class="form-control" id="pin" name="pin" value="<?php echo $row->pin; ?>" placeholder="****" style="border: none !important;" >
                                                                    <div class="input-group-addon"><i class="material-icons" onclick="view_pin(<?php echo $row->pin; ?>)" style="cursor: pointer;" title="View PIN">&#xe417;</i></div>
                                                                </div> 
                                                            </div>
                                                            <div class="form-group col-md-5" >
                                                                <label for="businessname" class="control-label">Contact Number:<span>*</span></label>
                                                                <input type="text" class="form-control" name="phone" onkeypress='validate(event)' value="<?php echo $row->phone; ?>" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label for="businessname" class="control-label">Date of Birth:<span>*</span></label>
                                                                <input type="date" class="form-control datetime"  value="<?php echo date('Y-m-d',strtotime($row->dob)); ?>" name="dob" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <?php if($role =='admin' || $role =='manager'){ $col="col-md-4";?>
                                                            <div class="form-row">	
                                                                <div class="form-group col-md-4">
                                                                    <label for="abn" class="control-label">Role:<span>*</span></label>
                                                                    <select name="role" class="form-control">
                                                                        <?php if(isset($roles) && !empty($roles)) { foreach($roles as $rolee) { 
                                                                            if($row->role == $rolee->role_id){ ?>
                                                                                <option selected="selected" value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
                                                                            <?php } else { ?>
                                                                                <option value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
                                                                        <?php } }}else{ $col="col-md-4"; } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group <?php echo $col; ?>">
                                                                    <label for="businessname" class="control-label">Effective Start Date:<span>*</span></label>
                                                                    <input type="date" class="form-control datetime"  value="<?php if($row->effective_start_date != '00-00-0000'){ echo $row->effective_start_date; }else{ echo ""; } ?>" name="effective_start_date" autocomplete="off" >
                                                                </div>
                                                                <div class="form-group <?php echo $col; ?>">
                                                                    <label for="abn" class="control-label">Employee Type:<span>*</span></label>
                                                                    <select name="employee_type" class="form-control">
                                                                        <?php  if($row->employee_type == "full_time"){ ?>
                                                                            <option selected="selected" value="full_time">Full Time</option>
                                                                            <option value="part_time">Part Time</option>
                                                                            <option value="casual">Casual</option>
                                                                        <?php } else if($row->employee_type == "part_time"){ ?>
                                                                            <option value="full_time">Full Time</option>
                                                                            <option selected="selected" value="part_time">Part Time</option>
                                                                            <option value="casual">Casual</option>
                                                                        <?php } else if($row->employee_type == "casual"){ ?>
                                                                            <option value="full_time">Full Time</option>
                                                                            <option value="part_time">Part Time</option>
                                                                            <option selected="selected" value="casual">Casual</option>
                                                                        <?php }else {  ?>
                                                                            <option value="full_time">Full Time</option>
                                                                            <option value="part_time">Part Time</option>
                                                                            <option  value="casual">Casual</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if($role =='admin' || $userID == '266'){ ?>
                                                            <div class="form-row">	
                                                                <div class="form-group col-md-4">
                                                                    <label for="businessname" class="control-label">Hourly Rate:<span>*</span></label>
                                                                    <input type="text" class="form-control" name="rate" onkeypress='validate(event)' value="<?php echo $row->rate; ?>" autocomplete="off" >
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="businessname" class="control-label">Saturday Rate:</label>
                                                                    <input type="text" class="form-control" name="Saturday_rate"  value="<?php echo $row->Saturday_rate; ?>" autocomplete="off" >
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="businessname" class="control-label">Sunday Rate:</label>
                                                                    <input type="text" class="form-control" name="Sunday_rate" value="<?php echo $row->Sunday_rate; ?>" autocomplete="off" >
                                                                </div>
                                                            </div>
                                                            <div class="form-row">	
                                                                <div class="form-group col-md-4">
                                                                    <label for="businessname" class="control-label">Public Holiday Rate:</label>
                                                                    <input type="text" class="form-control" name="holiday_rate"  value="<?php echo $row->holiday_rate; ?>" autocomplete="off" >
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="businessname" class="control-label">Uniform Allowance:</label>
                                                                    <input type="text" class="form-control" name="uniform_allowance"  value="<?php echo $row->uniform_allowance; ?>" autocomplete="off" >
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="businessname" class="control-label">Early Start:</label>
                                                                    <input type="text" class="form-control" name="early_start"  value="<?php echo $row->early_start; ?>" autocomplete="off" >
                                                                </div>
                                                            </div>
                                                            <div class="form-row">	
                                                                <div class="form-group col-md-6">
                                                                    <label for="businessname" class="control-label">Late Night:</label>
                                                                    <input type="text" class="form-control" name="late_night"  value="<?php echo $row->late_night; ?>" autocomplete="off" >
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <!-- #tab1 Ends -->
                                                <h3 class="tab_drawer_heading" rel="emergencyDetails">Emergency Details</h3>
                                                <div id="emergencyDetails" class="tab_content">
                                                    <h2>Emergency Details</h2>
                                                    <div class="panel-body">
                                                        <div class="form-row">	     	    
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Name:</label>
                                                                <input type="text" class="form-control" name="nextkin_name_two" value="<?php echo $row->nextkin_name_two; ?>" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Email Address:</label>
                                                                <input type="text" class="form-control" name="nextkin_email_two" value="<?php echo $row->nextkin_email_two; ?>" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <div class="form-row">	     
                                                            <div class="form-group col-md-6">
                                                                <label for="Phone No" class="control-label">Phone No:</label>
                                                                <input type="text" class="form-control" name="nextkin_phone_no" value="<?php echo $row->nextkin_phone_no; ?>" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Relationship:</label>
                                                                <input type="text" class="form-control" name="nextkin_relationship_two" value="<?php echo $row->nextkin_relationship_two; ?>" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <!--<div class="form-row">-->
                                                        <!--    <div class="form-group col-md-6">-->
                                                        <!--        <label for="businessname" class="control-label">Name:</label>-->
                                                        <!--        <input type="text" class="form-control" name="nextkin_name_one" value="<?php echo $row->nextkin_name_one; ?>" autocomplete="off">-->
                                                        <!--    </div>-->
                                                        <!--    <div class="form-group col-md-6">-->
                                                        <!--        <label for="businessname" class="control-label">Email Address:</label>-->
                                                        <!--        <input type="text" class="form-control" name="nextkin_email_one" value="<?php echo $row->nextkin_email_one; ?>" autocomplete="off" >-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Street address:</label>
                                                                <input type="text" class="form-control" name="nextkin_street" value="<?php echo $row->nextkin_street; ?>" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Town/Suburb:</label>
                                                                <input type="text" class="form-control" name="nextkin_suburb" value="<?php echo $row->nextkin_suburb; ?>" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">State:</label>
                                                                <input type="text" class="form-control" name="nextkin_state" value="<?php echo $row->nextkin_state; ?>" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Postcode:</label>
                                                                <input type="text" class="form-control" name="nextkin_postcode" value="<?php echo $row->nextkin_postcode; ?>" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- #tab2 -->
                                                <h3 class="tab_drawer_heading" rel="generalInfo">General Info</h3>
                                                <div id="generalInfo" class="tab_content">
                                                    <h2>General Info</h2>
                                                    <div class="panel-body">
                                                        <div class="form-row">      
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label">Visa Status:<span>*</span></label>
                                                                <input type="text" class="form-control" name="visa_status" value="<?php echo $row->visa_status; ?>"  autocomplete="off">
                                                            </div>
                                                            <!--<div class="form-group col-md-6">-->
                                                            <!--    <label for="businessname" class="control-label">TFN Number:<span>*</span></label>-->
                                                            <!--    <input type="text" class="form-control" name="tfn_number" value="<?php if($row->tfn_number != '0') echo $row->tfn_number; ?>" autocomplete="off">-->
                                                            <!--</div>-->
                                                        </div>
                                                        <!--<div class="form-row">-->
                                                        <!--    <div class="form-group col-md-6">-->
                                                        <!--        <label for="businessname" class="control-label">Super Fund Name:<span>*</span></label>-->
                                                        <!--        <input type="text" class="form-control" name="super_fund_name" value="<?php echo $row->super_fund_name; ?>" autocomplete="off" >-->
                                                        <!--    </div>-->
                                                        <!--    <div class="form-group col-md-6">-->
                                                        <!--        <label for="businessname" class="control-label">Super Annuation Number:<span>*</span></label>-->
                                                        <!--        <input type="text" class="form-control" name="super_annuation_no" value="<?php echo $row->super_annuation_no; ?>" autocomplete="off" >-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="businessname" class="control-label">Highest Academic Achievements: </label>
                                                                <textarea class="form-control" rows="5" name="heighest_acd_achmts"><?php echo $row->heighest_acd_achmts; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12" style="margin-bottom:0 !important">
                                                                <label for="businessname" class="control-label">Last 2 Previous Employments History:</label>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <textarea class="form-control" rows="5" name="pre_emp_hstry_one" value="<?php echo $row->pre_emp_hstry_one; ?>" ><?php echo $row->pre_emp_hstry_one; ?></textarea><br>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <textarea class="form-control" rows="5" name="pre_emp_hstry_two" value="<?php echo $row->pre_emp_hstry_two; ?>"><?php echo $row->pre_emp_hstry_two; ?></textarea><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- #tab3 -->
                                                <h3 class="tab_drawer_heading" rel="postalAddress">Home Address</h3>
                                                <div id="postalAddress" class="tab_content">
                                                    <h2>Home Address</h2>
                                                    <div class="panel-body">
                                                        <div class="form-row">      
                                                            <div class="form-group col-md-4">
                                                                <label for="businessname" class="control-label">Unit Number:<span>*</span></label>
                                                                <input type="text" class="form-control" name="unit_number" value="<?php echo $row->unit_number; ?>" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="businessname" class="control-label">Street Name:<span>*</span></label>
                                                                <input type="text" class="form-control" name="street_name" value="<?php echo $row->street_name; ?>"  autocomplete="off" >
                                                            </div>  
                                                            <div class="form-group col-md-4">
                                                                <label for="businessname" class="control-label">Street Number:<span>*</span></label>
                                                                <input type="text" class="form-control" name="street" value="<?php echo $row->street; ?>"  autocomplete="off" >
                                                            </div>
                                                        </div>
                                                        <div class="form-row">      
                                                            <div class="form-group col-md-4">
                                                                <label for="businessname" class="control-label">Suburb:<span>*</span></label>
                                                                <input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="businessname" class="control-label">Postcode:<span>*</span></label>
                                                                <input type="text" class="form-control" name="postcode" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="businessname" class="control-label">State:<span>*</span></label>
                                                                <select class="form-control" name="state">
                                                                    <option value="">Select</option>
                                                                    <option value="nsw" <?php if($row->state == 'nsw'){ echo "selected"; } ?>>New South Wales</option>
                                                                    <option value="vic" <?php if($row->state == 'vic'){ echo "selected"; } ?>>Victoria</option>
                                                                    <option value="qld" <?php if($row->state == 'qld'){ echo "selected"; } ?>>Queensland</option>
                                                                    <option value="wa" <?php if($row->state == 'wa'){ echo "selected"; } ?>>Western Australia</option>
                                                                    <option value="sa"<?php if($row->state == 'sa'){ echo "selected"; } ?>>South Australia</option>
                                                                    <option value="tas" <?php if($row->state == 'tas'){ echo "selected"; } ?>>Tasmania</option>
                                                                    <option value="act" <?php if($row->state == 'act'){ echo "selected"; } ?>>Australian Capital Territory</option>
                                                                    <option value="nt" <?php if($row->state == 'nt'){ echo "selected"; } ?>>Northern Territory</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- #tab4 --> 
                                                <h3 class="tab_drawer_heading" rel="bankDetails">Bank Details</h3>
                                                <div id="bankDetails" class="tab_content">
                                                    <h2>Bank Details</h2>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Account No 1</h5>
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Bank Name:</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="bank_1" value="<?php echo $row->bank_1; ?>" autocomplete="off"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">BSB:</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="bsb_1" value="<?php echo $row->bsb_1; ?>" autocomplete="off"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">% to Deposit</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="percentage_1" value="<?php echo $row->percentage_1; ?>" autocomplete="off"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Branch Name:</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="bank_branch_1" value="<?php echo $row->bank_branch_1; ?>" autocomplete="off"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Account No:</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="account_no_1" value="<?php echo $row->account_no_1; ?>" autocomplete="off"></div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Account Name:</label>
                                                                            <div class="col-sm-8"><input type="text" class="form-control" name="account_name_1" value="<?php echo $row->account_name_1; ?>" autocomplete="off"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h5>Account No 2</h5>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Bank Name:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="bank_2" value="<?php echo $row->bank_2; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">BSB:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="bsb_2" value="<?php echo $row->bsb_2; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">% to Deposit:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="percentage_2" value="<?php echo $row->percentage_2; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Branch Name:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="bank_branch_2" value="<?php echo $row->bank_branch_2; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Account No:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="account_no_2" value="<?php echo $row->account_no_2; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Account Name:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="account_name_2" value="<?php echo $row->account_name_2; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h5>Account No 3</h5>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Bank Name:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="bank_3" value="<?php echo $row->bank_3; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">BSB:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="bsb_3" value="<?php echo $row->bsb_3; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">% to Deposit:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="percentage_3" value="<?php echo $row->percentage_3; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Branch Name:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="bank_branch_3" value="<?php echo $row->bank_branch_3; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Account No:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="account_no_3" value="<?php echo $row->account_no_3; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="businessname" class="col-sm-4 control-label">Account Name:</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" name="account_name_3" value="<?php echo $row->account_name_3; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                I hereby authorize Zouki to initiate automatic deposits for my fortnightly wages to my bank account(s) as detailed above and also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. 
                                                                I hereby agree not to hold Zouki responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. 
                                                                This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until update the new banking details.
                                                            </div>
                                                        </div>						
                                                    </div>
                                                </div>
                                                
                                                <!-- #tax tab --> 
                                                <h3 class="tab_drawer_heading" rel="taxDetails">Tax Details</h3>
                                                <div id="taxDetails" class="tab_content">
                                                    <h2>Tax Declaration</h2>
                                                    <div class="panel-body">
                                                        <div class="section-wrap">
                                                            <div class="form-row">
                                                                <div class="checkbox-group col-md-12" >
                                                        
                                                                    <script>
                                                                        function openThisTab(evt, selected_value,fieldname) {
                                                                            // Declare all variables
                                                                            var i, tabcontent, tablinks;
                                                                            
                                                                            // Get all elements with class="tabcontent" and hide them
                                                                            tabcontent = document.getElementsByClassName("tabcontent_"+fieldname);
                                                                            for (i = 0; i < tabcontent.length; i++) {
                                                                                tabcontent[i].style.display = "none";
                                                                            }
                                                                            
                                                                            // Get all elements with class="tablinks" and remove the class "active"
                                                                            tablinks = document.getElementsByClassName("tablinks_"+fieldname);
                                                                            for (i = 0; i < tablinks.length; i++) {
                                                                                tablinks[i].className = tablinks[i].className.replace(" active", "");
                                                                            }
                                                                            
                                                                            // Show the current tab, and add an "active" class to the button that opened the tab
                                                                            document.getElementById(selected_value).style.display = "block";
                                                                            if(selected_value == 'No'){
                                                                                $('.check_tfn_type').val('tfn_type');
                                                                            }
                                                                            else{
                                                                                $('.check_tfn_type').val('tfn_number');
                                                                            }
                                                                            if(selected_value == 'noChanged'){
                                                                                $('#previous_surname').val(selected_value);
                                                                            }
                                                                            if(selected_value == 'noChanged' || selected_value == 'yesChanged'){
                                                                                $('.previous_surname_changed').val(selected_value);
                                                                            }
                                                                            document.getElementById(selected_value).style.display = "block";
                                                                            evt.currentTarget.className += " active";
                                                                        }
                                                                    </script>
                                                                    <p>Do Employee have TFN?</p>
                                                                    <div class="tab">
                                                                        <a class="tablinks tablinks_tfn <?php if($row->tfn_number != '0') echo 'active' ?>" onclick="openThisTab(event, 'Yes','tfn')">Yes</a>
                                                                        <a class="tablinks tablinks_tfn <?php if($row->tfn_number == '0') echo 'active' ?>" onclick="openThisTab(event, 'No','tfn')">No</a>
                                                                    </div>
    
                                                                    <!-- Tab content -->
                                                                    <div id="Yes" class="tabcontent tabcontent_tfn" style="display:<?php if($row->tfn_number != '0') echo 'block' ?>">
                                                                        <div class="form-row">	     	    
                                                                            <div class="form-group col-md-6">
                                                                                <label for="businessname" class="control-label">Enter Tax File Number:</label>
                                                                                <input type="text" class="form-control" id="tfn_number" name="tfn_number" value="<?php if($row->tfn_number != '0') echo $row->tfn_number; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" value="tfn_number" name="check_tfn_type" class="check_tfn_type">
                                                                    </div>
                                                                    <div id="No" class="tabcontent tabcontent_tfn"  style="display:<?php if($row->tfn_number == '0') echo 'block' ?>">
                                                                        <label><input type="radio" value="pendingTFN" name="tfn_type" <?php if($row->tfn_type == 'pendingTFN') echo 'checked' ?>> TFN is pending</label><br>
                                                                        <label><input type="radio" value="noTFN" name="tfn_type" <?php if($row->tfn_type == 'noTFN') echo 'checked' ?>> under 18 and don't have a TFN</label><br>
                                                                        <label><input type="radio" value="quotingTFN" name="tfn_type" <?php if($row->tfn_type == 'quotingTFN') echo 'checked' ?>> have an exemption from quoting a TFN (such as receiving a social security or service pension)</label>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="section-wrap">
                                                            <div class="form-row">
                                                                <div class="checkbox-group col-md-12" >
                                                                    <p>Have Employee changed his/her surname since you last dealt with the Australian Tax Office?</p>
                                                                    <div class="tab">
                                                                        <a class="tablinks tablinks_surname <?php if($row->have_surname_changed == 'yesChanged') echo 'active' ?>" onclick="openThisTab(event, 'yesChanged','surname')">Yes</a>
                                                                        <a class="tablinks tablinks_surname <?php if($row->have_surname_changed == 'noChanged') echo 'active' ?>" onclick="openThisTab(event, 'noChanged','surname')">No</a>
                                                                    </div>
                                                                    <!-- Tab content -->
                                                                    <div id="yesChanged" class="tabcontent tabcontent_surname" style="display:<?php if($row->have_surname_changed == 'yesChanged') echo 'block' ?>">
                                                                        <div class="form-row">	     	    
                                                                            <div class="form-group col-md-6">
                                                                                <label for="businessname" class="control-label">Enter Previous Surname:</label>
                                                                                <input type="text" class="form-control" id="previous_surname" name="previous_surname" value="<?php if($row->previous_surname != 'noChanged') echo $row->previous_surname; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="noChanged" class="tabcontent tabcontent_surname" style="display:<?php if($row->have_surname_changed == 'noChanged') echo 'block' ?>">
                                                                    </div>
                                                                    <input type="hidden" value="<?php echo $row->have_surname_changed; ?>" name="have_surname_changed" class="previous_surname_changed">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="section-wrap">
                                                            <div class="form-row">
                                                                <div class="checkbox-group col-md-12" >
                                                                    <p>Are Employee an Australian resident for tax purposes or a working holiday maker?</p>
                                                                    <label><input type="radio" value="australian" name="resident_type" <?php if($row->resident_type == 'australian') echo 'checked' ?>> Australian resident for tax purposes</label><br>
                                                                    <label><input type="radio" value="foreign" name="resident_type" <?php if($row->resident_type == 'foreign') echo 'checked' ?>> Foreign resident</label><br>
                                                                    <label><input type="radio" value="working_holiday" name="resident_type" <?php if($row->resident_type == 'working_holiday') echo 'checked' ?>> Working holiday maker</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="section-wrap">
                                                            <div class="form-row">
                                                                <div class="checkbox-group col-md-12" >
                                                                    <p>Do Employee have any of the following outstanding debts or loans?</p>
                                                                    <label><input type="radio" value="higher_education" name="loan_type" <?php if($row->loan_type == 'higher_education') echo 'checked' ?>> Higher Education Loan Program (HELP)</label><br>
                                                                    <label><input type="radio" value="vet_student" name="loan_type" <?php if($row->loan_type == 'vet_student') echo 'checked' ?>> VET Student Loan (VSL)</label><br>
                                                                    <label><input type="radio" value="financial_supplement" name="loan_type" <?php if($row->loan_type == 'financial_supplement') echo 'checked' ?>> Financial Supplement (FS)</label><br>
                                                                    <label><input type="radio" value="student_loan" name="loan_type" <?php if($row->loan_type == 'student_loan') echo 'checked' ?>> Student Start-up Loan (SSL)</label><br>
                                                                    <label><input type="radio" value="trade_loan" name="loan_type" <?php if($row->loan_type == 'trade_loan') echo 'checked' ?>> Trade Support Loan (TSL)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="section-wrap">
                                                            <div class="form-row">
                                                                <div class="checkbox-group col-md-12" >
                                                                    <p>Would Employee like to claim the tax-free threshold from this payer?</p>
                                                                    <label><input type="radio" value="yes" name="claim_tax_free" <?php if($row->claim_tax_free == 'yes') echo 'checked' ?>> Yes</label>
                                                                    <label><input type="radio" value="no" name="claim_tax_free" <?php if($row->claim_tax_free == 'no') echo 'checked' ?>> No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="section-wrap">
                                                            <div class="form-row">
                                                                <div class="checkbox-group col-md-12" >
                                                                    <p>On what basis are paid?</p>
                                                                    <label><input type="radio" value="full_time" name="job_type" <?php if($row->job_type == 'full_time') echo 'checked' ?>> Full-time</label><br>
                                                                    <label><input type="radio" value="part_time" name="job_type" <?php if($row->job_type == 'part_time') echo 'checked' ?>> Part-time</label><br>
                                                                    <label><input type="radio" value="labour_hire" name="job_type" <?php if($row->job_type == 'labour_hire') echo 'checked' ?>> Labour Hire</label><br>
                                                                    <label><input type="radio" value="superannuation" name="job_type" <?php if($row->job_type == 'superannuation') echo 'checked' ?>> Superannuation or annuity income stream</label><br>
                                                                    <label><input type="radio" value="casual" name="job_type" <?php if($row->job_type == 'casual') echo 'checked' ?>> Casual</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- #tab5 --> 
                                                <h3 class="tab_drawer_heading" rel="ploceDeductions">Police Deductions</h3>
                                                <div id="ploceDeductions" class="tab_content">
                                                    <h2>Police Deductions</h2>
                                                    <div class="panel-body">
                                                       



<div class="form-group">
<label for="businessname" class="col-sm-4 control-label">Upload Certificate</label>

<div class="col-sm-8">
<input type="file" class="form-control" name="police" value="<?php if((isset($row->police_certificate)) && ($row->police_certificate !='')) { echo $row->police_certificate;  } ?>">
<?php 
if((isset($row->police_certificate)) && ($row->police_certificate !='') && (file_exists("./uploaded_files/".$row->police_certificate))) {  ?>
<div class="col-md-2" style="text-align:right;padding-right:0px;">
<a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->police_certificate; ?>" target="_blank">View</a>
</div> 
<?php } ?>

</div>
</div>

</div>
</div>
<!-- #tab6 --> 
<h3 class="tab_drawer_heading" rel="requiredFile">Required File Uploads</h3>
<div id="requiredFile" class="tab_content">
<h2>Required File Uploads</h2>
<div class="panel-body">




<div class="form-row">      
<div class="form-group col-md-6">
<label for="businessname" class="control-label">Advice of Tax File Number to Superannuation Fund:</label>
<input type="file" class="form-control" name="advice_of_tax_file">
<?php 
if((isset($row->advice_of_tax_file)) && ($row->advice_of_tax_file !='') && (file_exists("./uploaded_files/".$row->advice_of_tax_file))) {  ?>
<div class="col-md-2" style="text-align:right;padding-right:0px;">
<a style="margin-top:4px;padding: 5px 20px;" class="btn bbtn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->advice_of_tax_file; ?>" target="_blank">View</a>
</div> 
<?php } ?>	

</div>
<div class="form-group col-md-6">
<label for="businessname" class="control-label">Quality Assurance/Food Safety Handling Certificate:</label>
<input type="file" class="form-control" name="quality_assurance">
<?php 
if((isset($row->quality_assurance)) && ($row->quality_assurance !='') && (file_exists("./uploaded_files/".$row->quality_assurance))) {  ?>
<div class="col-md-2" style="text-align:right;padding-right:0px;">
<a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->quality_assurance; ?>" target="_blank">View</a>
</div> 
<?php } ?>		

</div>
</div>




</div>
</div>
<!-- #tab7 --> 
<h3 class="tab_drawer_heading" rel="medicalHistory">Medical History</h3>
<div id="medicalHistory" class="tab_content">
<h2>Medical History</h2>
<div class="panel-body">
<div class="form-group">
<div class="col-sm-12">
<b>Please provide details of any medical conditions that may affect your ability to perform your role.</b>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<textarea type="text" class="form-control" name="medical_history" value="<?php echo $row->medical_history; ?>" rows="4"><?php echo $row->medical_history; ?></textarea>
</div>
</div>
</div>
</div>
<!-- #tab8 --> 
<h3 class="tab_drawer_heading" rel="vaccinationCertificate">Vaccination Certificate</h3>
<div id="vaccinationCertificate" class="tab_content">
<h2>Vaccination Certificate</h2>
<div class="panel-body">
<div class="form-group">
<label for="businessname" class="col-sm-4 control-label">Vaccination Certificate: </label>
<div class="col-sm-8">
<input type="file" class="form-control" name="vaccination_certificate">
<?php 
if((isset($row->vaccination_certificate)) && ($row->vaccination_certificate !='') && (file_exists("./uploaded_files/".$row->vaccination_certificate))) {  ?>
<div class="col-md-2" style="text-align:right;padding-right:0px;">
<a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->vaccination_certificate; ?>" target="_blank">View</a>
</div> 
<?php } ?>		
</div>
</div>
</div>
</div>
<!-- #tab9 --> 
<h3 class="tab_drawer_heading" rel="trainingUndertaken">Training Undertaken</h3>
<div id="trainingUndertaken" class="tab_content">
<h2>Training Undertaken</h2>
<div class="panel-body">

<div class="form-row">      
<div class="form-group col-md-6">
<label for="businessname" class="control-label">Fire/Emergency Training Completed Date:</label>
<input type="date" class="form-control datetime"  name="fire_emg_completed_date" value="<?php echo $row->fire_emg_completed_date; ?>" autocomplete="off">
</div>

<div class="form-group col-md-6">
<label for="businessname" class="control-label">OH&S Training Completition Date:</label>
<input type="date" class="form-control datetime" name="oh_s_completed_date" value="<?php echo $row->oh_s_completed_date; ?>" autocomplete="off">
</div>
</div>
</div>
</div>
<!-- #tab10 --> 

<!-- #tab6 --> 
<h3 class="tab_drawer_heading" rel="superAnnuation">Super Annuation</h3>
<div id="superAnnuation" class="tab_content">

<div class="panel-body">

<a style="float:right;" class="btn btn-dark" href="https://www.cafeadmin.com.au/HR/assets/pdf/Superannuation.pdf" target="_blank">View Super Annuation Form</a>
<h2>Super Annuation</h2>

<div class="section-wrap">
<h3>Section A</h3>
<div class="form-row">
<div class="checkbox-group col-md-12" >
<p>Choice of superannuation (super) fund</p>
<span>I request that all my future super contributions be paid to: (place an X in one of the boxes below)</span>
<label>The APRA fund or retirement savings account (RSA) I nominate <input type="radio" value="apra_fund" name="choice_super_fund" <?php if($row->choice_super_fund == 'apra_fund') echo 'checked'; ?>> Complete items 2, 3 and 5</label>
<label>The self-managed super fund (SMSF) I nominate <input type="radio" value="self_managed_fund" name="choice_super_fund" <?php if($row->choice_super_fund == 'self_managed_fund') echo 'checked'; ?>> Complete items 2, 4 and 5</label>
<label>The super fund nominated by my employer (in section B) <input type="radio" value="fund_nom_emp" name="choice_super_fund" <?php if($row->choice_super_fund == 'fund_nom_emp') echo 'checked'; ?>> Complete items 2 and 5</label>

</div>

</div>
<div class="form-row">
<div class="col-md-12" >
<p>Your details</p>

</div>
<div class="form-group col-md-4" >
<label for="name" class=" control-label">Name:<span>*</span></label>
<input type="text" id="pdf_name" class="form-control" name="pdf_first_name" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
<span class="fieldError" id="pdf_name_error"></span>
</div>
<div class="form-group col-md-4" >
<label for="pdf_name_error" class=" control-label">Employee identification number (if applicable)</label>
<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_emp_id_no" value="<?php echo $row->pdf_emp_id_no; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Tax file number (TFN)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_tax_file_number" value="<?php echo $row->pdf_tax_file_number; ?>" autocomplete="off" >

</div>
</div>
<div class="form-row">
<div class="col-md-12" >
<p>Nominating your APRA fund or RSA</p>
<span>You will need current details from your APRA regulated fund or RSA to complete this item. To do this you can contact your fund or RSA directly, or you can view your fund or RSA account details by logging into ATO online services via the ATO app or through myGov and selecting Super</span>
</div>
<div class="form-group col-md-4" >
<label for="name" class=" control-label">Fund ABN</label>
<input type="text" id="pdf_name" class="form-control" name="pdf_apra_fund_abh" value="<?php echo $row->pdf_apra_fund_abh; ?>" autocomplete="off" >
<span class="fieldError" id="pdf_name_error"></span>
</div>
<div class="form-group col-md-8" >
<label for="pdf_name_error" class=" control-label">Fund name</label>
<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_apra_fund_name" value="<?php echo $row->pdf_apra_fund_name; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-12" >
<label for="pdf_tax_file_number" class=" control-label">Fund address</label>
<textarea id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_address" autocomplete="off" ><?php echo $row->pdf_apra_fund_address; ?></textarea>

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">Suburb/town</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_town" value="<?php echo $row->pdf_apra_fund_town; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">State/territory</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_state" value="<?php echo $row->pdf_apra_fund_state; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">Postcode</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_postcode" value="<?php echo $row->pdf_apra_fund_postcode; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">Fund phone</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_phone" value="<?php echo $row->pdf_apra_fund_phone; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Unique superannuation identifier (USI)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_usi" value="<?php echo $row->pdf_apra_fund_usi; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Your account name (if applicable)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_acc_no" value="<?php echo $row->pdf_apra_fund_acc_no; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Your member number (if applicable)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_member_no" value="<?php echo $row->pdf_apra_fund_member_no; ?>" autocomplete="off" >

</div>
</div> 
<div class="form-row">
<div class="col-md-12" >
<p>Nominating your self-managed super fund (SMSF)</p>
<span>You will need current details from your SMSF trustee to complete this item.</span>
</div>
<div class="form-group col-md-4" >
<label for="name" class=" control-label">Fund ABN</label>
<input type="text" id="pdf_name" class="form-control" name="pdf_self_fund" value="<?php echo $row->pdf_self_fund; ?>" autocomplete="off" >
<span class="fieldError" id="pdf_name_error"></span>
</div>
<div class="form-group col-md-8" >
<label for="pdf_name_error" class=" control-label">Fund name</label>
<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_self_fund_name" value="<?php echo $row->pdf_self_fund_name; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-12" >
<label for="pdf_tax_file_number" class=" control-label">Fund address</label>
<textarea id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_address" autocomplete="off" ><?php echo $row->pdf_self_fund_address; ?></textarea>

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">Suburb/town</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_town" value="<?php echo $row->pdf_self_fund_town; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">State/territory</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_state" value="<?php echo $row->pdf_self_fund_state; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">Postcode</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_postcode" value="<?php echo $row->pdf_self_fund_postcode; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-3" >
<label for="pdf_tax_file_number" class=" control-label">Fund phone</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_phone" value="<?php echo $row->pdf_self_fund_phone; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-12" >
<label for="pdf_tax_file_number" class=" control-label">Fund electronic service address (ESA)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_esa" value="<?php echo $row->pdf_self_fund_esa; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Fund bank account name</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_bank_acc_no" value="<?php echo $row->pdf_self_fund_bank_acc_no; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">BSB code (please include all six numbers)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_bsb_code" value="<?php echo $row->pdf_self_fund_bsb_code; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Account number</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_acc_no" value="<?php echo $row->pdf_self_fund_acc_no; ?>" autocomplete="off" >

</div>
<div class="col-md-12" >
<p>Required documentation</p>

</div>
<div class="checkbox-group col-md-12" >

<label for="smsf_agree"><input type="checkbox" value="1" id="smsf_agree" name="" <?php if($row->smsf_agree == '1') echo 'checked'; ?>> I am the trustee, or a director of the corporate trustee of the SMSF and I declare that the SMSF will accept contributions from my employer</label>
<span class="fieldError" id="smsf_agree_error"></span> 
</div>
</div>
<div class="form-row">
<div class="col-md-12" >
<p>Signature and date</p>
<span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>
</div>
<div class="checkbox-group col-md-12" >

<label><input type="checkbox" value="1" name="" <?php if($row->is_attached_rel_doc == '1') echo 'checked'; ?>> I have attached the relevant documentation.</label>

</div>
<div class="form-group col-md-8" >
<label for="pdf_tax_file_number" class=" control-label">Signature</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_sign" value="<?php echo $row->pdf_self_fund_sign; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Date</label>
<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_date" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_self_fund_date)); } else { echo ''; } ?>" autocomplete="off" >

</div>
</div>
</div>
<div class="section-wrap">
<h3>Section B</h3>
<div class="form-row">
<div class="col-md-12" >
<p>Your details</p>
<span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>
</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Business name</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_business_name" value="<?php echo $row->pdf_business_name; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">ABN</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_abn" value="<?php echo $row->pdf_abn; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-8" >
<label for="pdf_tax_file_number" class=" control-label">Signature</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_signture" value="<?php echo $row->pdf_signture; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-4" >
<label for="pdf_tax_file_number" class=" control-label">Date</label>
<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_sign_date" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_sign_date)); } else { echo ''; } ?>" autocomplete="off" >

</div>
</div>
<div class="form-row">
<div class="col-md-12" >
<p>Your nominated super fund</p>
<span>If an employee does not choose their own super fund, and the ATO has advised the employee does not have a stapled super fund (for new employees from 1 November 2021), you can meet your SG obligations by paying super guarantee contributions on their behalf to the fund you have nominated below or another fund that meets the choice requirements:</span>
</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Super fund name</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_name" value="<?php echo $row->pdf_super_fund_name; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Unique superannuation identifier (USI)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_usi" value="<?php echo $row->pdf_super_fund_usi; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Phone (for the product disclosure statement for this fund)</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_phone" value="<?php echo $row->pdf_super_fund_phone; ?>" autocomplete="off" >

</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Super fund website address</label>
<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_fund_website_address" value="<?php echo $row->pdf_fund_website_address; ?>" autocomplete="off" >

</div>
</div>
</div>
<div class="section-wrap">
<h3>Section C</h3>
<div class="form-row">
<div class="col-md-12" >
<p>Record of choice acceptance</p>
<span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>
</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Date employee’s choice is received</label>
<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_date_emp_choice" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_date_emp_choice)); } else { echo ''; } ?>" autocomplete="off" >

</div>
<div class="form-group col-md-6" >
<label for="pdf_tax_file_number" class=" control-label">Date you act on your employee’s choice</label>
<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_date_act" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_date_act)); } else { echo ''; } ?>" autocomplete="off" >

</div>
</div>
</div>

</div>
</div>

<h3 class="tab_drawer_heading" rel="staffInductionManual">Staff Induction Manual</h3>
<div id="staffInductionManual" class="tab_content">
<h2>Staff Induction Manual</h2>
<div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
<?php if($branch_id =='57') { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" target="_blank">View</a>
<?php }elseif($branch_id =='55') { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" target="_blank">View</a>
<?php }else { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" target="_blank">View</a>
<?php } ?>

</div>
<div class="panel-body">
<div class="form-group">
<div style="height:400px;width:100%;">
<?php if($branch_id =='57') { ?>
<iframe src="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" width="100%" height="100%"></iframe>
<?php }elseif($branch_id =='55') { ?>
<iframe src="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" width="100%" height="100%"></iframe>
<?php }else { ?>
<iframe src="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" width="100%" height="100%"></iframe>
<?php } ?>
<div class="checkbox" style="margin-top: 22px;">
<label style="color:#000;padding: 23px;color:#000;font-size: 16px;"><input type="checkbox"   id="agree_terms_one" value="1" name="agree_terms_one" <?php if($row->agree_terms_one == '1'){ echo "checked"; } ?>>I read, understood and agree to the Staff Induction Manual.</label>
</div>
</div>	
</div>

</div>
</div>
<!-- #tab11 --> 
<h3 class="tab_drawer_heading" rel="companyPolicies">Company Policies and Procedures</h3>
<div id="companyPolicies" class="tab_content">
<h2>Company Policies and Procedures</h2>

<div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
<?php if($branch_id =='57') { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" target="_blank">View</a>
<?php }elseif($branch_id =='55') { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" target="_blank">View</a>
<?php }elseif($branch_id =='53') { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_redbean.pdf" target="_blank">View</a>
<?php  } else { ?>
<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" target="_blank">View</a>
<?php } ?>
</div>
<div class="panel-body">
<div class="form-group">
<div style="height:400px;width:100%;">

<?php if($branch_id =='57') { ?>
<iframe src="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" width="100%" height="100%"></iframe>
<?php }elseif($branch_id =='55') { ?>
<iframe src="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" width="100%" height="100%"></iframe>
<?php }else { ?>
<iframe src="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" width="100%" height="100%"></iframe>
<?php } ?>


<div class="checkbox" style="margin-top: 22px;">
<label style="color:#000;padding: 23px;color:#000;font-size: 16px;"><input type="checkbox"  value="1" id="agree_terms_two" name="agree_terms_two" <?php if($row->agree_terms_two == '1'){ echo "checked"; } ?>>I read, understood and agree  to the Company Policies and Procedures Manual.</label>
</div>
</div>	
</div>

</div>
</div>
<!-- #tab12 --> 
<h3 class="tab_drawer_heading" rel="jobDescription">Job Description</h3>
<div id="jobDescription" class="tab_content">
<?php if($row->job_desc != ""){ ?>
<h2>Job Description</h2>

<div class="col-md-2 job_desc_btn btn-position" style="text-align:right;padding-right:0px;">
<a style="width:100%;margin-left:8px;" class="btn btn-dark" href="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" target="_blank">View</a>
<a style="width:100%;margin-left:8px;" class="btn btn-dark" href="<?php echo base_url();?>index.php/admin/edit_employee_job_desc/<?php echo $row->emp_id; ?>">Edit</a>
</div> 
<div class="panel-body">
<div class="form-group">
<div style="height:400px;width:100%;">
<?php $file_parts = pathinfo($row->job_desc); 
if($file_parts['extension'] == 'pdf'){ ?>

<iframe src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" width="100%" height="100%"></iframe>

<?php }else { ?>
<iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
<!--<object src="<?php //echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"><embed src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"></embed></object>-->


<?php } ?>
<div class="checkbox" style="margin-top: 22px;">
<label style="color:#000;padding: 23px;color:#000;font-size: 16px;"><input type="checkbox" value="1"   id="agree_terms_three" name="agree_terms_three" <?php if($row->agree_terms_three == '1'){ echo "checked"; } ?>>I read, understood and agree to the Job Descriptions Manual.</label>
</div>
</div>	
</div>

</div>
<?php } ?>
</div>

<br>
<div class="btn-div col-md-3">
<button type="submit" name="contact_submit" id="btn1" class="btn btn-success btn-ph savebtn">SAVE</button>
<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
<button type="button"  class="btn btn-success btn-ph">CANCEL</button>
</a>
</div>
</div>
<!-- .tab_container -->
</div>
</div>
<!--tab design end-->



</div>


<?php } ?>
										
                        </div>
                    </div>
                </div>
                 </form>
            </div>
           
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

