<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($details[0]->Incident_Report_id)){ ?>	
                    <form class="form-horizontal" id="add_btn" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Incident_Report" enctype="multipart/form-data">
                    <input type="hidden" name= "Incident_Report_id" value="<?php if(isset($details[0]->Incident_Report_id)){ echo $details[0]->Incident_Report_id; } ?>">
                <?php } else {?>
                    <form class="form-horizontal" id="add_btn" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Incident_Report" enctype="multipart/form-data">
            	<?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($details[0]->Incident_Report_id)){ echo "EDIT"; } else { echo "ADD"; }?> INCIDENT REPORT</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>

                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_Incident_Report"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <input type="submit" name="add_btn" id="add_btn" class="btn btn-primary" value="Submit">
                                   
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
	          		        <div class="row">
                                <div class="col-lg-12 col-md-12 mb-4"> 
                                    <div class="control-group">
                                        <label class="control-label">Employee Name</label>
                                        <div class="controls">
                                            <select class="form-control" name="emp_id" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
            								    <option value="">Select Employee</option>
            								    <?php foreach($employees as $emp){
            								        if($emp->emp_id == $details[0]->emp_id){
            								    ?>
            								    <option value="<?php echo $emp->emp_id; ?>" selected><?php echo $emp->first_name.' '. $emp->last_name; ?></option>
            								    <?php } else{?>
            								    <option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->first_name.' '. $emp->last_name; ?></option>
            								    <?php } } ?>
            								</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label">The incident resulted in :</label>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="injury" name="incident_effected_to" <?php echo  ($details[0]->incident_effected_to =="injury" ? 'checked' : '')?>> Injury to an individual</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="damage" name="incident_effected_to" <?php echo  ($details[0]->incident_effected_to =="damage" ? 'checked' : '')?>> Damage to property</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="other" name="incident_effected_to" <?php echo  ($details[0]->incident_effected_to =="other" ? 'checked' : '')?>> other</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label">Personal details (of injured):</label>
                                    <div class="row">
                                        <div class="col-md-2 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Surname</label>
                                                <div class="controls">
						                            <input type="text" class="form-control" name="surname" autocomplete="off" value="<?php if(isset($details[0]->surname)){ echo $details[0]->surname; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">First name</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="firstname" autocomplete="off" value="<?php if(isset($details[0]->firstname)){ echo $details[0]->firstname; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Initial</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="initial" autocomplete="off" value="<?php if(isset($details[0]->initial)){ echo $details[0]->initial; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Address</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="address" autocomplete="off" value="<?php if(isset($details[0]->address)){ echo $details[0]->address; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Postcode</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="postcode" autocomplete="off" value="<?php if(isset($details[0]->postcode)){ echo $details[0]->postcode; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date of birth <span>*</span></label>
                                                <div class="controls">
                                                    <input type="date" class="form-control datetime"  name="dob"  autocomplete="off" required  value="<?php if(isset($details[0]->dob)){ echo $details[0]->dob; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5"> 
                                    <label class="control-label">Gender: </label>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="male" name="gender" <?php echo  ($details[0]->gender =="male" ? 'checked' : '')?>> Male</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="female" name="gender" <?php echo  ($details[0]->gender =="female" ? 'checked' : '')?>> Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-7 col-md-7"> 
                                    <label class="control-label">Type</label>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="staff" name="incident_by" <?php echo  ($details[0]->incident_by =="staff" ? 'checked' : '')?> > Staff member</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="customer" name="incident_by" <?php echo  ($details[0]->incident_by =="customer" ? 'checked' : '')?>> Customer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="other" name="incident_by" <?php echo  ($details[0]->incident_by =="other" ? 'checked' : '')?>> Other</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label">Incident details:</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Time incident occurred <span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="incident_time" autocomplete="off" required value="<?php if(isset($details[0]->incident_time)){ echo $details[0]->incident_time; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date incident occurred <span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="date" class="form-control"  name="incident_date"  autocomplete="off" required  value="<?php if(isset($details[0]->incident_date)){ echo $details[0]->incident_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Where did the incident occur? (Please specify)</label>
                                                <div class="controls">
                                                    <textarea  class="form-control" name="incident_place" rows="4" cols="80" ><?php if(isset($details[0]->incident_place)){ echo $details[0]->incident_place; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">What was the nature of, and injury resulting from, this incident? <br><small>(Please explain in your own words what had happened)</small></label>
                                                <div class="controls">
                                                    <textarea  class="form-control" name="incident_detail" rows="4" cols="80" ><?php if(isset($details[0]->incident_detail)){ echo $details[0]->incident_detail; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label">Were there any witnesses?</label>
                                    <div class="row">
                                        <div class="col-md-2 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="yes" name="is_witness" <?php echo  ($details[0]->is_witness =="yes" ? 'checked' : '')?>> Yes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="no" name="is_witness" <?php echo  ($details[0]->is_witness =="no" ? 'checked' : '')?>> No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Name of witness/es:</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="witness_name" autocomplete="off" value="<?php if(isset($details[0]->witness_name)){ echo $details[0]->witness_name; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="witness_position" autocomplete="off" value="<?php if(isset($details[0]->witness_position)){ echo $details[0]->witness_position; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Contact details</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="witness_contact" autocomplete="off" value="<?php if(isset($details[0]->witness_contact)){ echo $details[0]->witness_contact; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Address</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="witness_Address" autocomplete="off" value="<?php if(isset($details[0]->witness_Address)){ echo $details[0]->witness_Address; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Postcode</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="witness_postcode" autocomplete="off" value="<?php if(isset($details[0]->witness_postcode)){ echo $details[0]->witness_postcode; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Signature of person completing report</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="person_reporting_incident_sign" autocomplete="off" value="<?php if(isset($details[0]->person_reporting_incident_sign)){ echo $details[0]->person_reporting_incident_sign; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Name of person completing report</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="person_completing_report_name" autocomplete="off" value="<?php if(isset($details[0]->person_completing_report_name)){ echo $details[0]->person_completing_report_name; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date <span>*</span></label>
                                                <div class="controls">
                                                    <input type="date" class="form-control datetime"  name="report_complete_signtaure_date"  autocomplete="off" required  value="<?php if(isset($details[0]->report_complete_signtaure_date)){ echo $details[0]->report_complete_signtaure_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label">Has the hazard/incident been acknowledged by management?</label>
                                    <div class="row">
                                        <div class="col-md-2 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="yes" name="is_acknowdledeged"  <?php echo  ($details[0]->is_acknowdledeged =="yes" ? 'checked' : '')?> > Yes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label><input type="checkbox" value="no" name="is_acknowdledeged" <?php echo ($details[0]->is_acknowdledeged =="no" ? 'checked' : '')?> > No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Describe what has been done to resolve the hazard/incident:</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="witness_name" autocomplete="off" value="<?php if(isset($details[0]->witness_name)){ echo $details[0]->witness_name; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">  
                                            <div class="control-group">
                                                <label class="control-label">A copy of this report is be forwarded to your supervisor immediately</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Supervisor’s comments</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="supervisor_comments" <?php echo ($role=='employee') ? 'disabled' : '' ?> value="<?php if(isset($details[0]->supervisor_comments)){ echo $details[0]->supervisor_comments; } ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Supervisor’s signature</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="supervisor_sign" <?php echo ($role=='employee') ? 'disabled' : '' ?> value="<?php if(isset($details[0]->supervisor_sign)){ echo $details[0]->supervisor_sign; } ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control datetime"  name="supervisor_sign_date" <?php echo ($role=='employee') ? 'disabled' : '' ?>  autocomplete="off" value="<?php if(isset($details[0]->supervisor_sign_date)){ echo $details[0]->supervisor_sign_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 		
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

