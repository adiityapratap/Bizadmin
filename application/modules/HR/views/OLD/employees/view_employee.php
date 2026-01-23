<div class="main-content">
<style>
.nav-success .nav-link.active {
    color: #fff !important;
    background-color: #45cb85 !important;
    box-shadow: var(--vz-box-shadow);
        border-radius: 0.25rem;
} 
</style>
    <div class="page-content"> 
                
    <div class="container-fluid">
     <div class="row"> 
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php foreach($employee as $row){ ?>
            
            	   <?php 
                $allTabs = array(
                           'personalDetails' => 'Personal',
                           'emergencyDetails' => 'Emergency',
                           'generalInfo' => 'General',
                           'bankDetails' => 'Bank',   
                           'taxDetails' => 'Tax',
                           'superAnnuation' => 'Super',
                           'payDetails' => 'Pay',
                           'policeDeductions' => 'Police',
                           'medicalHistory' => 'Medical',
                           'vaccinationCertificate' => 'Vaccination',
                           'trainingUndertaken' => 'Training',
                           'requiredFile' => 'Additional Docs',
                           'companyPolicies' => ' Policies',
                            )
                  ?>
            	   
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
                                    <button class="btn btn-primary add-btn" onclick="send_onboading_mail(<?php echo $row->emp_id; ?>)"><i class="ri ri-send-plane-fill align-bottom me-1"></i> Send E-mail</button>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/manage_employee"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                  
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="card-body">
                         <div id="message_box" class="alert alert-success" role="alert" style="font-size: 18px;display:none">Email has been sent successfully</div>
                        <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                            <?php $count = 0; foreach($allTabs as $tabkey => $tabName) {  ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($count == 0 ? 'active' : '') ?>" data-bs-toggle="tab" href="#<?php echo $tabkey ?>" role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block"><?php echo $tabName; ?></span> 
                                </a>
                            </li>
                            <?php $count++; } ?>
                        </ul>
                     
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <h6 class="text-dark mb-3">Personal</h6>
                                <p class="mb-0">
                                    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="title" class="control-label text-dark">Title<span>*</span></label>
                                                <select class="form-control" id="title" name="title">
                                                    <option value="">Select</option>
                                                    <option value="Mr" <?php if($row->title == 'Mr'){ echo "selected"; } ?>>Mr</option>
                                                    <option value="Ms" <?php if($row->title == 'Ms'){ echo "selected"; } ?>>Ms</option>
                                                    <option value="Mrs" <?php if($row->title == 'Mrs'){ echo "selected"; } ?>>Mrs</option>
                                                    <option value="Miss" <?php if($row->title == 'Miss'){ echo "selected"; } ?>>Miss</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="first_name" class=" control-label text-dark">First Name<span>*</span></label>
                                                <input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $row->first_name; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="last_name" class=" control-label text-dark">Last Name<span>*</span></label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row->last_name; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="email" class="control-label text-dark">Email Address<span>*</span></label>
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row->email; ?>">
                                            </div>	
                                        </div>	
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="password" class="control-label text-dark">Password</label>
                                                <input type="text" class="form-control" id="password" name="password" value="" placeholder="*******">
                                            </div>
                                        </div>	
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="control-label text-dark" for="pin">Pin<span>*</span></label>
                                                <div class="input-group" style="border: 1px solid #d3d1d1 !important; display: table;">
                                                    <input type="password" class="form-control" id="pin" name="pin" value="<?php echo $row->pin; ?>" placeholder="****" style="border: none !important;" >
                                                    <!--<div class="input-group-addon"><i class="material-icons" onclick="view_pin(<?php echo $row->pin; ?>)" style="cursor: pointer;" title="View PIN">&#xe417;</i></div>-->
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Contact Number<span>*</span></label>
                                                <input type="text" class="form-control" name="phone" onkeypress='validate(event)' value="<?php echo $row->phone; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Date of Birth<span>*</span></label>
                                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"  data-deafult-date="<?php echo date('d M, Y',strtotime($row->dob)); ?>" name="dob" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="address" class="control-label text-dark">Address Line 1<span>*</span></label>
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $row->address; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Suburb:<span>*</span></label>
                                                <input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Postcode:<span>*</span></label>
                                                <input type="text" class="form-control" name="postcode" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">State:<span>*</span></label>
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
                                </p>
                            </div>
                            <div class="tab-pane" id="emergencyDetails" role="tabpanel">
                                <h6 class="text-dark mb-3">Emergency</h6>
                                <p class="mb-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Name</label>
                                                <input type="text" class="form-control" name="nextkin_name_two" value="<?php echo $row->nextkin_name_two; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Email</label>
                                                <input type="text" class="form-control" name="nextkin_email_two" value="<?php echo $row->nextkin_email_two; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Phone No" class="control-label text-dark">Phone</label>
                                                <input type="text" class="form-control" name="nextkin_phone_no" value="<?php echo $row->nextkin_phone_no; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Relationship</label>
                                                <input type="text" class="form-control" name="nextkin_relationship_two" value="<?php echo $row->nextkin_relationship_two; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Address Line 1</label>
                                                <input type="text" class="form-control" name="nextkin_street" value="<?php echo $row->nextkin_street; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Suburb</label>
                                                <input type="text" class="form-control" name="nextkin_suburb" value="<?php echo $row->nextkin_suburb; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Postcode</label>
                                                <input type="text" class="form-control" name="nextkin_postcode" value="<?php echo $row->nextkin_postcode; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">State</label>
                                                <input type="text" class="form-control" name="nextkin_state" value="<?php echo $row->nextkin_state; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="payDetails" role="tabpanel">
                                <h6 class="text-dark mb-3">Pay</h6>
                                <p class="mb-0">
                                    <div class="row">
                                    
                                    <?php if($role =='admin' || $userID == '266'){ ?>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Weekday<span>*</span></label>
                                                <input type="text" class="form-control" name="rate" onkeypress='validate(event)' value="<?php echo $row->rate; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Saturday</label>
                                                <input type="text" class="form-control" name="Saturday_rate"  value="<?php echo $row->Saturday_rate; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Sunday</label>
                                                <input type="text" class="form-control" name="Sunday_rate" value="<?php echo $row->Sunday_rate; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Public Holiday</label>
                                                <input type="text" class="form-control" name="holiday_rate"  value="<?php echo $row->holiday_rate; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                                                
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Uniform Allowance</label>
                                                <input type="text" class="form-control" name="uniform_allowance"  value="<?php echo $row->uniform_allowance; ?>" autocomplete="off" >
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="generalInfo" role="tabpanel">
                                <h6 class="text-dark mb-3">General</h6>
                                <p class="mb-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="businessname" class="control-label text-dark">Visa Status<span>*</span></label>
                                                        <input type="text" class="form-control" name="visa_status" value="<?php echo $row->visa_status; ?>"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="businessname" class="control-label text-dark">Highest Academics</label>
                                                        <textarea class="form-control" rows="5" name="heighest_acd_achmts"><?php echo $row->heighest_acd_achmts; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="businessname" class="control-label text-dark">Employment History</label>
                                                        <textarea class="form-control" rows="5" name="pre_emp_hstry_one" value="<?php echo $row->pre_emp_hstry_one; ?>" ><?php echo $row->pre_emp_hstry_one; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="businessname" class="control-label text-dark">Stress Profile</label>
                                                        <select class="form-control" name="stress_profile">
                                                            <option value="">Select</option>
                                                             <option value="15/16 year old" <?php if($row->stress_profile == '15/16 year old'){ echo 'selected'; } ?> >15/16 year old</option>
                                                            <option value="Max 24 Hours per week - 18 years plus" <?php if($row->stress_profile == 'Max 24 Hours per week - 18 years plus'){ echo 'selected'; } ?> >Max 24 Hours per week - 18 years plus</option>
                                                            <option value="24/7" <?php if($row->stress_profile == '24/7'){ echo 'selected'; } ?> >24/7</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($role =='admin' || $role =='manager'){ $col="col-md-4";?>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="businessname" class="control-label text-dark">Effective Start Date<span>*</span></label>
                                                        <input type="date" class="form-control datetime"  value="<?php if($row->effective_start_date != '00-00-0000'){ echo $row->effective_start_date; }else{ echo ""; } ?>" name="effective_start_date" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="abn" class="control-label text-dark">Role<span>*</span></label>
                                                        <select name="role" class="form-control">
                                                            <?php if(isset($roles) && !empty($roles)) { foreach($roles as $rolee) { 
                                                            if($row->role == $rolee->role_id){ ?>
                                                                <option selected="selected" value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
                                                            <?php } }}else{ $col="col-md-4"; } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="abn" class="control-label text-dark">Employee Type<span>*</span></label>
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
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="postalAddress" role="tabpanel">
                                <h6 class="text-dark mb-3">Home Address</h6>
                                <p class="mb-0">
                                     <div class="row">
                                             
                                             <div class="col-md-3">
                                        <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Unit Number:<span>*</span></label>
                                                <input type="text" class="form-control" name="unit_number" value="<?php echo $row->unit_number; ?>" autocomplete="off">
                                            </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                        <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Street Address:<span>*</span></label>
                                                <input type="text" class="form-control" name="street_name" value="<?php echo $row->street_name; ?>"  autocomplete="off" >
                                            </div> 
                                            </div>
                                            
                                              
                                            <div class="col-md-3">
                                        <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Suburb:<span>*</span></label>
                                                <input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
                                            </div>
                                            </div>
                                            
                                             <div class="col-md-3">
                                        <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Postcode:<span>*</span></label>
                                                <input type="text" class="form-control" name="postcode" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
                                            </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                        <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">State:<span>*</span></label>
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
                               </p>
                            </div>
                            <div class="tab-pane" id="bankDetails" role="tabpanel">
                                <h6 class="text-dark mb-3">Bank</h6>
                                <p class="mb-0">
                                 
                                    <div class="row mt-4">
                                        <h5>Account No 1</h5>
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                    <label for="businessname" class="control-label text-dark">Bank Name:</label>
                                                    <input type="text" class="form-control" name="bank_1" value="<?php echo $row->bank_1; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">BSB:</label>
                                                <input type="text" class="form-control" name="bsb_1" value="<?php echo $row->bsb_1; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">% to Deposit</label>
                                                <input type="text" class="form-control" name="percentage_1" value="<?php echo $row->percentage_1; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Branch Name:</label>
                                                <input type="text" class="form-control" name="bank_branch_1" value="<?php echo $row->bank_branch_1; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Account No:</label>
                                                <input type="text" class="form-control" name="account_no_1" value="<?php echo $row->account_no_1; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Account Name:</label>
                                                <input type="text" class="form-control" name="account_name_1" value="<?php echo $row->account_name_1; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                                    
                                    <div class="row mt-4">
                                        <h5>Account No 2</h5>
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Bank Name:</label>
                                                <input type="text" class="form-control" name="bank_2" value="<?php echo $row->bank_2; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">BSB:</label>
                                                <input type="text" class="form-control" name="bsb_2" value="<?php echo $row->bsb_2; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">% to Deposit:</label>
                                                <input type="text" class="form-control" name="percentage_2" value="<?php echo $row->percentage_2; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Branch Name:</label>
                                                <input type="text" class="form-control" name="bank_branch_2" value="<?php echo $row->bank_branch_2; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Account No:</label>
                                                <input type="text" class="form-control" name="account_no_2" value="<?php echo $row->account_no_2; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                       <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Account Name:</label>
                                                <input type="text" class="form-control" name="account_name_2" value="<?php echo $row->account_name_2; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                                   
                                    <div class="row mt-4">        
                                        <h5>Account No 3</h5>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Bank Name:</label>
                                                <input type="text" class="form-control" name="bank_3" value="<?php echo $row->bank_3; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">BSB:</label>
                                                <input type="text" class="form-control" name="bsb_3" value="<?php echo $row->bsb_3; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">% to Deposit:</label>
                                                <input type="text" class="form-control" name="percentage_3" value="<?php echo $row->percentage_3; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                           
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Branch Name:</label>
                                                <input type="text" class="form-control" name="bank_branch_3" value="<?php echo $row->bank_branch_3; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3">
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Account No:</label>
                                                <input type="text" class="form-control" name="account_no_3" value="<?php echo $row->account_no_3; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-3"> 
                                           <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Account Name:</label>
                                                <input type="text" class="form-control" name="account_name_3" value="<?php echo $row->account_name_3; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="row mt-4">   
                                        <div class="col-md-12">
                                            I hereby authorize  to initiate automatic deposits for my fortnightly wages to my bank account(s) as detailed above and also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. 
                                            I hereby agree not to hold  responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. 
                                            This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until update the new banking details.
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="taxDetails" role="tabpanel">
                                <h6 class="text-dark mb-3">Tax</h6>
                                <p class="mb-0">
                                    
                                      <div class="section-wrap">
                                            <div class="form-row">
                                                <div class="checkbox-group col-md-12" >
                                               <p>Do Employee have TFN?</p>
                                                    <div class="tab">
                                                        <a class="tablinks tablinks_tfn <?php if($row->tfn_number != '0') echo 'active' ?>" onclick="openThisTab(event, 'Yes','tfn')">Yes</a>
                                                        <a class="tablinks tablinks_tfn <?php if($row->tfn_number == '0') echo 'active' ?>" onclick="openThisTab(event, 'No','tfn')">No</a>
                                                    </div>
    
                                                    <!-- Tab content -->
                                                    <div id="Yes" class="tabcontent tabcontent_tfn" style="display:<?php if($row->tfn_number != '0') echo 'block' ?>">
                                                        <div class="form-row">	     	    
                                                            <div class="form-group col-md-6">
                                                                <label for="businessname" class="control-label text-dark">Enter Tax File Number:</label>
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
                                                                <label for="businessname" class="control-label text-dark">Enter Previous Surname:</label>
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
                                        
                                    </p>
                                    </div>
                            <div class="tab-pane" id="policeDeductions" role="tabpanel">
                                <h6 class="text-dark mb-3">Police Deductions</h6>
                                <p class="mb-0">
                                     <div class="row">
                                        
                                        <?php if((isset($row->police_certificate)) && ($row->police_certificate !='') && (file_exists("./uploaded_files/".$row->police_certificate))) {  ?>
                                            <div class="col-md-4" style="align-self: end;">
                                                <div class="mb-3">
                                                    <a class="btn btn-dark btn-lg" href="<?php echo base_url();?>uploaded_files/<?php echo $row->police_certificate; ?>" target="_blank">View Certificate </a>
                                                </div> 
                                            </div> 
                                        <?php } ?>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="requiredFile" role="tabpanel">
                                <h6 class="text-dark mb-3">Required File Uploads</h6>
                                <p class="mb-0">
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <?php 
                                            if((isset($row->quality_assurance)) && ($row->quality_assurance !='') && (file_exists("./uploaded_files/".$row->quality_assurance))) {  ?>
                                            <div class="col-md-2" style="text-align:right;padding-right:0px;">
                                                <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->quality_assurance; ?>" target="_blank">View</a>
                                            </div> 
                                            <?php } ?>		
                                        
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="medicalHistory" role="tabpanel">
                                <h6 class="text-dark mb-3">Medical History</h6>
                                <p class="mb-0">
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="text-dark fw-medium">Please provide details of any medical conditions that may affect your ability to perform your role.</label>
                                                <textarea type="text" class="form-control" name="medical_history" value="<?php echo $row->medical_history; ?>" rows="4"><?php echo $row->medical_history; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="vaccinationCertificate" role="tabpanel">
                                <h6 class="text-dark mb-3">Vaccination Certificate</h6>
                                <p class="mb-0">
                                    <div class="row">
                                       
                                        <?php if((isset($row->vaccination_certificate)) && ($row->vaccination_certificate !='') && (file_exists("./uploaded_files/".$row->vaccination_certificate))) {  ?>
                                            <div class="col-md-4" style="align-self: end;">
                                                <div class="mb-3">
                                                    <a class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->vaccination_certificate; ?>" target="_blank">View</a>
                                                </div> 
                                            </div> 
                                        <?php } ?>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="trainingUndertaken" role="tabpanel">
                                <h6 class="text-dark mb-3">Training Undertaken</h6>
                                <p class="mb-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">Fire/Emergency Training Completed Date:</label>
                                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"   name="fire_emg_completed_date" data-deafult-date="<?php echo date('d M, Y',strtotime($row->fire_emg_completed_date)); ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="businessname" class="control-label text-dark">OH&S Training Completition Date:</label>
                                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" name="oh_s_completed_date" data-deafult-date="<?php echo date('d M, Y',strtotime($row->oh_s_completed_date)); ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="superAnnuation" role="tabpanel">
                                <p class="mb-0">
                                    <div class="panel-body">
                                        <a style="float:right;" class="btn btn-dark" href="<?php echo base_url(); ?>assets/pdf/Superannuation.pdf" target="_blank">View Super Annuation Form</a>
                                        <h5>Super Annuation</h5>
                                        <h3 class="mt-4">Section A</h3>
                                        <div class="custom_border-dashed p-4">
                                            
                                            <div class="form-row">
                                                <div class="checkbox-group col-md-12" >
                                                    <h5 class="text-dark fw-medium">Choice of superannuation (super) fund</h5>
                                                    <span class="text-dark fw-bold">I request that all my future super contributions be paid to: (place an X in one of the boxes below)</span>
                                                    <label class="text-dark fw-bold">The APRA fund or retirement savings account (RSA) I nominate <input type="radio" value="apra_fund" name="choice_super_fund" <?php if($row->choice_super_fund == 'apra_fund') echo 'checked'; ?>> Complete items 2, 3 and 5</label>
                                                    <label class="text-dark fw-bold">The self-managed super fund (SMSF) I nominate <input type="radio" value="self_managed_fund" name="choice_super_fund" <?php if($row->choice_super_fund == 'self_managed_fund') echo 'checked'; ?>> Complete items 2, 4 and 5</label>
                                                    <label class="text-dark fw-bold">The super fund nominated by my employer (in section B) <input type="radio" value="fund_nom_emp" name="choice_super_fund" <?php if($row->choice_super_fund == 'fund_nom_emp') echo 'checked'; ?>> Complete items 2 and 5</label>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-3">
                                                <div class="col-md-12" >
                                                    <h5 class="text-dark fw-medium">Your details</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="name" class=" control-label text-dark">Name:<span>*</span></label>
                                                        <input type="text" id="pdf_name" class="form-control" name="pdf_first_name" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                                                        <span class="fieldError" id="pdf_name_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pdf_name_error" class=" control-label text-dark">Employee identification number (if applicable)</label>
                                                        <input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_emp_id_no" value="<?php echo $row->pdf_emp_id_no; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Tax file number (TFN)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_tax_file_number" value="<?php echo $row->pdf_tax_file_number; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-12 mt-3" >
                                                    <div class="mb-3">
                                                        <h5 class="text-dark fw-medium">Nominating your APRA fund or RSA</h5>
                                                        <span>You will need current details from your APRA regulated fund or RSA to complete this item. To do this you can contact your fund or RSA directly, or you can view your fund or RSA account details by logging into ATO online services via the ATO app or through myGov and selecting Super</span>
                                                    </div>
                                                </div>
                                                <div class=" col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="name" class=" control-label text-dark">Fund ABN</label>
                                                        <input type="text" id="pdf_name" class="form-control" name="pdf_apra_fund_abh" value="<?php echo $row->pdf_apra_fund_abh; ?>" autocomplete="off" >
                                                        <span class="fieldError" id="pdf_name_error"></span>
                                                    </div>
                                                </div>
                                                <div class=" col-md-8" >
                                                    <div class="mb-3">
                                                        <label for="pdf_name_error" class=" control-label text-dark">Fund name</label>
                                                        <input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_apra_fund_name" value="<?php echo $row->pdf_apra_fund_name; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Fund address</label>
                                                        <textarea id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_address" autocomplete="off" ><?php echo $row->pdf_apra_fund_address; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Suburb/town</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_town" value="<?php echo $row->pdf_apra_fund_town; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">State/territory</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_state" value="<?php echo $row->pdf_apra_fund_state; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Postcode</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_postcode" value="<?php echo $row->pdf_apra_fund_postcode; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Fund phone</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_phone" value="<?php echo $row->pdf_apra_fund_phone; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Unique superannuation identifier (USI)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_usi" value="<?php echo $row->pdf_apra_fund_usi; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Your account name (if applicable)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_acc_no" value="<?php echo $row->pdf_apra_fund_acc_no; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Your member number (if applicable)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_member_no" value="<?php echo $row->pdf_apra_fund_member_no; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3" >
                                                    <div class="mb-3">
                                                        <h5 class="text-dark fw-medium">Nominating your self-managed super fund (SMSF)</h5>
                                                        <span>You will need current details from your SMSF trustee to complete this item.</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="name" class=" control-label text-dark">Fund ABN</label>
                                                        <input type="text" id="pdf_name" class="form-control" name="pdf_self_fund" value="<?php echo $row->pdf_self_fund; ?>" autocomplete="off" >
                                                        <span class="fieldError" id="pdf_name_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" >
                                                    <div class="mb-3">
                                                        <label for="pdf_name_error" class=" control-label text-dark">Fund name</label>
                                                        <input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_self_fund_name" value="<?php echo $row->pdf_self_fund_name; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Fund address</label>
                                                        <textarea id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_address" autocomplete="off" ><?php echo $row->pdf_self_fund_address; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Suburb/town</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_town" value="<?php echo $row->pdf_self_fund_town; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">State/territory</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_state" value="<?php echo $row->pdf_self_fund_state; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Postcode</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_postcode" value="<?php echo $row->pdf_self_fund_postcode; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Fund phone</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_phone" value="<?php echo $row->pdf_self_fund_phone; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Fund electronic service address (ESA)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_esa" value="<?php echo $row->pdf_self_fund_esa; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Fund bank account name</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_bank_acc_no" value="<?php echo $row->pdf_self_fund_bank_acc_no; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">BSB code (please include all six numbers)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_bsb_code" value="<?php echo $row->pdf_self_fund_bsb_code; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Account number</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_acc_no" value="<?php echo $row->pdf_self_fund_acc_no; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3" >
                                                    <h5 class="text-dark fw-medium">Required documentation</h5>
                                                </div>
                                                <div class="checkbox-group col-md-12" >
                                                    <div class="mb-3">
                                                        <label for="smsf_agree"><input type="checkbox" value="1" id="smsf_agree" name="" <?php if($row->smsf_agree == '1') echo 'checked'; ?>> I am the trustee, or a director of the corporate trustee of the SMSF and I declare that the SMSF will accept contributions from my employer</label>
                                                        <span class="fieldError" id="smsf_agree_error"></span> 
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-12" >
                                                    <div class="mb-3">
                                                        <h5 class="text-dark fw-medium">Signature and date</h5>
                                                        <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>
                                                    </div>
                                                </div>
                                                <div class="checkbox-group col-md-12" >
                                                    <label><input type="checkbox" value="1" name="" <?php if($row->is_attached_rel_doc == '1') echo 'checked'; ?>> I have attached the relevant documentation.</label>
                                                </div>
                                                <div class="col-xxl-3 col-md-8" >
                                                    <label for="pdf_tax_file_number" class=" control-label text-dark">Signature</label>
                                                    <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_sign" value="<?php echo $row->pdf_self_fund_sign; ?>" autocomplete="off" >
                                                </div>
                                                <div class="col-xxl-3 col-md-4" >
                                                    <label for="pdf_tax_file_number" class=" control-label text-dark">Date</label>
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"  data-deafult-date="<?php echo date('d M, Y',strtotime($row->pdf_self_fund_date)); ?>" id="pdf_tax_file_number"  name="pdf_self_fund_date"  autocomplete="off" >
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-4">Section B</h3>
                                        <div class="custom_border-dashed p-4">
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <div class="mb-3"> 
                                                        <h5 class="text-dark fw-medium">Your details</h5>
                                                        <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3"> 
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Business name</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_business_name" value="<?php echo $row->pdf_business_name; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3"> 
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">ABN</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_abn" value="<?php echo $row->pdf_abn; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3"> 
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Signature</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_signture" value="<?php echo $row->pdf_signture; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3"> 
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Date</label>
                                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"  data-deafult-date="<?php echo date('d M, Y',strtotime($row->pdf_sign_date)); ?>" id="pdf_tax_file_number"  name="pdf_sign_date"  autocomplete="off" >
                                                    </div>
                                                </div>
                                        
                                                <div class="col-md-12 mt-3" >
                                                    <div class="mb-3"> 
                                                        <h5 class="text-dark fw-medium">Your nominated super fund</h5>
                                                        <span>If an employee does not choose their own super fund, and the ATO has advised the employee does not have a stapled super fund (for new employees from 1 November 2021), you can meet your SG obligations by paying super guarantee contributions on their behalf to the fund you have nominated below or another fund that meets the choice requirements:</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3">   
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Super fund name</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_name" value="<?php echo $row->pdf_super_fund_name; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Unique superannuation identifier (USI)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_usi" value="<?php echo $row->pdf_super_fund_usi; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Phone (for the product disclosure statement for this fund)</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_phone" value="<?php echo $row->pdf_super_fund_phone; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-4" >
                                                    <div class="mb-3">
                                                        <label for="pdf_tax_file_number" class=" control-label text-dark">Super fund website address</label>
                                                        <input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_fund_website_address" value="<?php echo $row->pdf_fund_website_address; ?>" autocomplete="off" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-4">Section C</h3>
                                        <div class="custom_border-dashed p-4">
                                           
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <div class="mb-3">
                                                        <h5 class="text-dark fw-medium">Record of choice acceptance</h5>
                                                        <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xxl-3 col-md-6" >
                                                    <label for="pdf_tax_file_number" class=" control-label text-dark">Date employee’s choice is received</label>
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"  data-deafult-date="<?php echo date('d M, Y',strtotime($row->pdf_tax_file_number)); ?>" id="pdf_tax_file_number"  name="pdf_date_emp_choice"  autocomplete="off" >
                                                </div>
                                                <div class="form-group col-xxl-3 col-md-6" >
                                                    <label for="pdf_tax_file_number" class=" control-label text-dark">Date you act on your employee’s choice</label>
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"  data-deafult-date="<?php echo date('d M, Y',strtotime($row->pdf_sign_date)); ?>" id="pdf_tax_file_number"  name="pdf_date_act"  autocomplete="off" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="companyPolicies" role="tabpanel">
                                <h6 class="text-dark mb-3">Polices</h6>
                                <p class="mb-0">
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-xxl-9 col-m-12 mb-4">
                                                        <label class="text-dark fw-medium">Company Policies and Procedures</label>
                                                </div> 
                                                <div class="col-xxl-3 col-m-12 mb-4">
                                                    <?php if($branch_id =='57') { ?>
                                                    <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" target="_blank">View</a>
                                                    <?php }elseif($branch_id =='55') { ?>
                                                    <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" target="_blank">View</a>
                                                    <?php }elseif($branch_id =='53') { ?>
                                                    <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/policy_redbean.pdf" target="_blank">View</a>
                                                    <?php  } else { ?>
                                                    <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" target="_blank">View</a>
                                                    <?php } ?>
                                                    
                                                </div>
                                                <div class="col-lg-3 mb-4">
                                                    <?php if($branch_id =='57') { ?>
                                                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" width="100%" height="100%"></iframe>
                                                    <?php }elseif($branch_id =='55') { ?>
                                                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" width="100%" height="100%"></iframe>
                                                    <?php }else { ?>
                                                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" width="100%" height="100%"></iframe>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="checkbox">
                                                        <label style="color:#000;padding: 23px;font-size: 16px;"><input type="checkbox"  value="1" id="agree_terms_two" name="agree_terms_two" <?php if($row->agree_terms_two == '1'){ echo "checked"; } ?>>I read, understood and agree  to the Company Policies and Procedures Manual.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-xxl-9 col-m-12 mb-4">
                                                        <label class="text-dark fw-medium">Staff Induction Manual</label>
                                                </div> 
                                                <div class="col-xxl-3 col-m-12 mb-4">
                                                    <?php if($branch_id =='57') { ?>
                                                        <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" target="_blank">View</a>
                                                    <?php }elseif($branch_id =='55') { ?>
                                                        <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdff" target="_blank">View</a>
                                                    <?php  } else { ?>
                                                        <a class="btn btn-dark w-100" href="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" target="_blank">View</a>
                                                    <?php } ?>
                                                    
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <?php if($branch_id =='57') { ?>
                                                        <iframe src="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" width="100%" height="100%"></iframe>
                                                    <?php }elseif($branch_id =='55') { ?>
                                                        <iframe src="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" width="100%" height="100%"></iframe>
                                                    <?php }else { ?>
                                                        <iframe src="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" width="100%" height="100%"></iframe>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="checkbox">
                                                        <label style="color:#000;padding: 23px;font-size: 16px;"><input type="checkbox"   id="agree_terms_one" value="1" name="agree_terms_one" <?php if($row->agree_terms_one == '1'){ echo "checked"; } ?>>I read, understood and agree to the Staff Induction Manual.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($row->job_desc != ""){ ?>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-xxl-6 col-m-12 mb-4">
                                                            <label class="text-dark fw-medium">Job Description</label>
                                                    </div> 
                                                    <div class="col-xxl-6 col-m-12 mb-4 text-end">
                                                        <a class="btn btn-dark" href="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" target="_blank">View</a>
                                                        <a class="btn btn-dark" href="<?php echo base_url();?>index.php/admin/edit_employee_job_desc/<?php echo $row->emp_id; ?>">Edit</a>
                                                        
                                                    </div>
                                                    <div class="col-lg-12 mb-4">
                                                        <?php $file_parts = pathinfo($row->job_desc); 
                                                        if($file_parts['extension'] == 'pdf'){ ?>
                                                            <iframe src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" width="100%" height="100%"></iframe>
                                                        <?php }else { ?>
                                                            <iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="checkbox">
                                                            <label style="color:#000;padding: 23px;font-size: 16px;"><input type="checkbox" value="1"   id="agree_terms_three" name="agree_terms_three" <?php if($row->agree_terms_three == '1'){ echo "checked"; } ?>>I read, understood and agree to the Job Descriptions Manual.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </p>
                            </div>                        
</div>
    </div>
                     </form>
                   <?php } ?>         
                            </div>
                        </div>
                    </div>
                    
                     </div>
                            </div>
                        </div>
                        
 <script>
 function send_onboading_mail(emp_id){
    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/admin/send_cred_email",
        data: {"emp_id":emp_id},
        beforeSend: function(){
        $("#loader").show();
         },
        complete:function(data){
        $("#loader").hide();
         },
         success: function(response){
                console.log(response);
                if(response=="Sent"){
                    $("#message_box").css("display","block");
                    setTimeout(function() { $("#message_box").css("display","none"); }, 1000);
                }
         }
    });
  
}
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
                    