<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($details[0]->emp_satisfaction_survey_id)){ ?>	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_emp_satisfaction_survey" enctype="multipart/form-data">
                    <input type="hidden" name="emp_satisfaction_survey_id" value="<?php if(isset($details[0]->emp_satisfaction_survey_id)){ echo $details[0]->emp_satisfaction_survey_id; } ?>">
				    <input type="hidden" name="emp_name" value="<?php if(isset($details[0]->emp_name)){ echo $details[0]->emp_name; } ?>">
				    <input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
                <?php } else {?>
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/emp_satisfaction_survey" enctype="multipart/form-data">
            	<?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($details[0]->emp_satisfaction_survey_id)){ echo "EDIT"; } else { echo "ADD"; }?> WORK SATISFACTION FEEDBACK</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                     <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_emp_satisfaction_survey"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
                                <label class="control-label fw-medium fs-16 mb-3">Feedback Details <small>(Rate Between 1-10 with 10 being the best)</small></label>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Compensation to the Employees <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="compensation" autocomplete="off" required  value="<?php if(isset($details[0]->compensation)){ echo $details[0]->compensation; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Opportunity for Advancement <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control"  name="oppurtinity"  autocomplete="off" required value="<?php if(isset($details[0]->oppurtinity)){ echo $details[0]->oppurtinity; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Work Benefits <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="benefits"  autocomplete="off" required value="<?php if(isset($details[0]->benefits)){ echo $details[0]->benefits; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Friendly Work Environment <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="work_environment"  autocomplete="off" required value="<?php if(isset($details[0]->work_environment)){ echo $details[0]->work_environment; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Training <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="training" required value="<?php if(isset($details[0]->training)){ echo $details[0]->training; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Performance Evaluation <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="performance_evaluation" required value="<?php if(isset($details[0]->performance_evaluation)){ echo $details[0]->performance_evaluation; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Guidance to Perform your Job Effectively <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="guidance"  required value="<?php if(isset($details[0]->guidance)){ echo $details[0]->guidance; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Overall Satisfaction with Job <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="job_satisfaction" required value="<?php if(isset($details[0]->job_satisfaction)){ echo $details[0]->job_satisfaction; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">General Employee Morale <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="emp_morale"  required value="<?php if(isset($details[0]->emp_morale)){ echo $details[0]->emp_morale; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Any Recommendations to Improve Employee Morale ?</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="recommendation" value="<?php if(isset($details[0]->recommendation)){ echo $details[0]->recommendation; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php if(isset($details[0]->emp_satisfaction_survey_id)){ ?>
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

