<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($details[0]->Injury_Report_id)){ ?>	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Injury_Report" enctype="multipart/form-data">
                    <input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
	                <input type="hidden" name= "Injury_Report_id" value="<?php if(isset($details[0]->Injury_Report_id)){ echo $details[0]->Injury_Report_id; } ?>">
                <?php } else {?>
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Injury_Report" enctype="multipart/form-data">
            	<?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($details[0]->Injury_Report_id)){ echo "EDIT"; } else { echo "ADD"; }?> INJURY REPORT</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>

                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_Injury_Report"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label fw-medium">Evidence Of the Injury</label>
                                    <div class="row">
                                        <div class="<?php if((isset($details[0]->injury_file)) && ($details[0]->injury_file !='') && (file_exists("./uploaded_files/".$details[0]->injury_file))) {  ?>col-md-8  <?php } else { ?>col-md-12 <?php } ?> mb-4"> 
                                            <div class="control-group">
                                                
                                                <div class="controls">
                                                    <input type="file" class="form-control" name="injury_file">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if((isset($details[0]->injury_file)) && ($details[0]->injury_file !='') && (file_exists("./uploaded_files/".$details[0]->injury_file))) {  ?>
                                            <div class="col-md-4 mb-4">    
                                                <div class="control-group">
                                                    <div class="controls">
                        							    <a class="btn btn-success w-100" href="<?php echo base_url();?>uploaded_files/<?php echo $details[0]->injury_file; ?>" target="_blank">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Work Area <span>*</span></label>
                                                <div class="controls">
						                            <input type="text" class="form-control" name="work_area" autocomplete="off" required value="<?php if(isset($details[0]->work_area)){ echo $details[0]->work_area; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Supervisor on Duty</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="supervisor_on_duty"  autocomplete="off" value="<?php if(isset($details[0]->supervisor_on_duty)){ echo $details[0]->supervisor_on_duty; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Select team</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="team"  autocomplete="off" value="<?php if(isset($details[0]->team)){ echo $details[0]->team; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Employee Reporting Injury <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="employee_reporting_injury"  autocomplete="off" required value="<?php if(isset($details[0]->employee_reporting_injury)){ echo $details[0]->employee_reporting_injury; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date of Injury <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control datepicker"  name="injury_date"  autocomplete="off" required value="<?php if(isset($details[0]->injury_date)){ echo $details[0]->injury_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Time of Injury <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="injury_time" style="z-index: 1 !important;" autocomplete="off"  required value="<?php if(isset($details[0]->injury_time)){ echo $details[0]->injury_time; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Describe How the Injury Occured</label>
                                                <div class="controls">
                                                    <textarea  class="form-control" name="injury_detail" rows="8" cols="80"><?php if(isset($details[0]->injury_detail)){ echo $details[0]->injury_detail; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Describe What Job you were doing at the Time of your Injury <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="injury_time_details"  autocomplete="off"  required value="<?php if(isset($details[0]->injury_time_details)){ echo $details[0]->injury_time_details; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Describe What part of your Body was Injured <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="body_part_injured"  autocomplete="off"  required value="<?php if(isset($details[0]->body_part_injured)){ echo $details[0]->body_part_injured; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Describe What you would Recommend to Prevent a Reoccurrence <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="preventive_measures"  autocomplete="off"  required value="<?php if(isset($details[0]->work_area)){ echo $details[0]->work_area; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Further Information you would like to Include regarding your Injury <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="further_information"  autocomplete="off"  required value="<?php if(isset($details[0]->further_information)){ echo $details[0]->further_information; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Business Manager <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="business_manager"  autocomplete="off"  required value="<?php if(isset($details[0]->business_manager)){ echo $details[0]->business_manager; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date BR Signed <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control datepicker"  name="br_date"  autocomplete="off"  required value="<?php if(isset($details[0]->br_date)){ echo $details[0]->br_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(isset($details[0]->Injury_Report_id)){ ?>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Manager Comments</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
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

