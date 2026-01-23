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
                        <div><label class="control-label fw-medium fs-16 mb-4">Employee Evaluation Form</label>
	          		        <div class="row">
                                <div class="col-lg-12 col-md-12"> 
                                <label class="control-label fw-medium fs-16 mb-3 text-uppercase">EMPLOYEE INFORMATION</label>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Employee Name</label>
                                                <div class="controls">
                                                    <select class="form-control" name="emp_id" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
                    								    <option value="">Select Employee</option>
                    								    <?php foreach($employees as $emp){ if($emp->emp_id == $details[0]->emp_id){ ?>
                    								        <option value="<?php echo $emp->emp_id; ?>" selected><?php echo $emp->first_name.' '. $emp->last_name; ?></option>
                    								    <?php } else{?>
                    								        <option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->first_name.' '. $emp->last_name; ?></option>
                    								    <?php } } ?>
                    								</select> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Job Title</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="job_title" value="<?php if(isset($details[0]->job_title)){ echo $details[0]->job_title; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Manager/ Supervisor</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="manager" value="<?php if(isset($details[0]->manager)){ echo $details[0]->manager; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                <label class="control-label fw-medium fs-16 mb-3">Review Period</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">From</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control"  name="rev_period_from"  autocomplete="off" value="<?php if(isset($details[0]->rev_period_from)){ echo $details[0]->rev_period_from; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">To</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control"  name="rev_period_to"  autocomplete="off" value="<?php if(isset($details[0]->rev_period_to)){ echo $details[0]->rev_period_to; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <label class="control-label fw-medium fs-16 mb-4 text-uppercase">CORE VALUES AND OBJECTIVES</label><br>
                                    <label class="control-label fw-medium fs-16 mb-3">Quality of Work</label><br>
                                    <label class="control-label fw-medium mb-3">Work is completed accurately (few or no errors), efficiently and within deadlines with minimal supervision</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="qw_exceeds_expectations">	<input type="checkbox"  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_exceeds_expectations" class="form-check-input" name="qw_exceeds_expectations" value="1" <?php if(isset($options_rating['qw_exceeds_expectations']) && $options_rating['qw_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="qw_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_meets_expectations" class="form-check-input" name="qw_meets_expectations" value="1" <?php if(isset($options_rating['qw_meets_expectations']) && $options_rating['qw_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="qw_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_needs_improvement" class="form-check-input" name="qw_needs_improvement" value="1" <?php if(isset($options_rating['qw_needs_improvement']) && $options_rating['qw_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="qw_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_unacceptable" class="form-check-input" name="qw_unacceptable" value="1" <?php if(isset($options_rating['qw_unacceptable']) && $options_rating['qw_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="qw_comments" rows="4" cols="40" ><?php if(isset($details[0]->qw_comments)){ echo $details[0]->qw_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Attendance & Punctuality</label><br>
                                    <label class="control-label fw-medium mb-3">Reports for work on time, provides advance notice of need for absence</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ap_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ap_exceeds_expectations" class="form-check-input" name="ap_exceeds_expectations" value="1" <?php if(isset($options_rating['ap_exceeds_expectations']) && $options_rating['ap_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ap_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qwOpt2" class="form-check-input" name="ap_meets_expectations" value="1" <?php if(isset($options_rating['ap_meets_expectations']) && $options_rating['ap_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ap_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ap_needs_improvement" class="form-check-input" name="ap_needs_improvement" value="1" <?php if(isset($options_rating['ap_needs_improvement']) && $options_rating['ap_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ap_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ap_unacceptable" class="form-check-input" name="ap_unacceptable" value="1" <?php if(isset($options_rating['ap_unacceptable']) && $options_rating['ap_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?>  class="form-control" name="ap_comments" rows="4" cols="40" ><?php if(isset($details[0]->ap_comments)){ echo $details[0]->ap_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Reliability/Dependability</label><br>
                                    <label class="control-label fw-medium mb-3">Consistently performs at a high level; manages time and workload effectively to meet responsibilities</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="rd_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_exceeds_expectations" class="form-check-input" name="rd_exceeds_expectations" value="1" <?php if(isset($options_rating['rd_exceeds_expectations']) && $options_rating['rd_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="rd_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_meets_expectations" class="form-check-input" name="rd_meets_expectations" value="1" <?php if(isset($options_rating['rd_meets_expectations']) && $options_rating['rd_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="rd_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_needs_improvement" class="form-check-input" name="rd_needs_improvement" value="1" <?php if(isset($options_rating['rd_needs_improvement']) && $options_rating['rd_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="rd_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_unacceptable" class="form-check-input" name="rd_unacceptable" value="1" <?php if(isset($options_rating['rd_unacceptable']) && $options_rating['rd_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="rd_comments" rows="4" cols="40" ><?php if(isset($details[0]->rd_comments)){ echo $details[0]->rd_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Communication Skills</label><br>
                                    <label class="control-label fw-medium mb-3">Written and oral communications are clear, organized, and effective; listens and comprehends well</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="cs_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_exceeds_expectations" class="form-check-input" name="cs_exceeds_expectations" value="1" <?php if(isset($options_rating['cs_exceeds_expectations']) && $options_rating['cs_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="cs_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_meets_expectations" class="form-check-input" name="cs_meets_expectations" value="1" <?php if(isset($options_rating['cs_meets_expectations']) && $options_rating['cs_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="cs_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_needs_improvement" class="form-check-input" name="cs_needs_improvement" value="1" <?php if(isset($options_rating['cs_needs_improvement']) && $options_rating['cs_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="cs_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_unacceptable" class="form-check-input" name="cs_unacceptable" value="1" <?php if(isset($options_rating['cs_unacceptable']) && $options_rating['cs_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?>  class="form-control" name="cs_comments" rows="4" cols="40" ><?php if(isset($details[0]->cs_comments)){ echo $details[0]->cs_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Judgment & Decision-Making</label><br>
                                    <label class="control-label fw-medium mb-3">Makes thoughtful, well-reasoned decisions; exercises good judgment, resourcefulness, and creativity in problem-solving</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="jdm_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_exceeds_expectations" class="form-check-input" name="jdm_exceeds_expectations" value="1" <?php if(isset($options_rating['jdm_exceeds_expectations']) && $options_rating['jdm_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="jdm_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_meets_expectations" class="form-check-input" name="jdm_meets_expectations" value="1" <?php if(isset($options_rating['jdm_meets_expectations']) && $options_rating['jdm_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="jdm_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_needs_improvement" class="form-check-input" name="jdm_needs_improvement" value="1" <?php if(isset($options_rating['jdm_needs_improvement']) && $options_rating['jdm_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="jdm_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_unacceptable" class="form-check-input" name="jdm_unacceptable" value="1" <?php if(isset($options_rating['jdm_unacceptable']) && $options_rating['jdm_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="jdm_comments" rows="4" cols="40" ><?php if(isset($details[0]->jdm_comments)){ echo $details[0]->jdm_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Initiative & Flexibility</label><br>
                                    <label class="control-label fw-medium mb-3">Demonstrates initiative, often seeking out additional responsibility; identifies problems and solutions; thrives on new challenges and adjusts to unexpected changes</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="if_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_exceeds_expectations" class="form-check-input" name="if_exceeds_expectations" value="1" <?php if(isset($options_rating['if_exceeds_expectations']) && $options_rating['if_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="if_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_meets_expectations" class="form-check-input" name="if_meets_expectations" value="1" <?php if(isset($options_rating['if_meets_expectations']) && $options_rating['if_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="if_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_needs_improvement" class="form-check-input" name="if_needs_improvement" value="1" <?php if(isset($options_rating['if_needs_improvement']) && $options_rating['if_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="if_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_unacceptable" class="form-check-input" name="if_unacceptable" value="1" <?php if(isset($options_rating['if_unacceptable']) && $options_rating['if_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="if_comments" rows="4" cols="40" ><?php if(isset($details[0]->if_comments)){ echo $details[0]->if_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Cooperation & Teamwork</label><br>
                                    <label class="control-label fw-medium mb-3">Respectful of colleagues when working with others and makes valuable contributions to help the group achieve its goals</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ct_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_exceeds_expectations" class="form-check-input" name="ct_exceeds_expectations" value="1" <?php if(isset($options_rating['ct_exceeds_expectations']) && $options_rating['ct_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ct_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_meets_expectations" class="form-check-input" name="ct_meets_expectations" value="1" <?php if(isset($options_rating['ct_meets_expectations']) && $options_rating['ct_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ct_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_needs_improvement" class="form-check-input" name="ct_needs_improvement" value="1" <?php if(isset($options_rating['ct_needs_improvement']) && $options_rating['ct_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ct_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_unacceptable" class="form-check-input" name="ct_unacceptable" value="1" <?php if(isset($options_rating['ct_unacceptable']) && $options_rating['ct_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="ct_comments" rows="4" cols="40" ><?php if(isset($details[0]->ct_comments)){ echo $details[0]->ct_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Knowledge of Position</label><br>
                                    <label class="control-label fw-medium mb-3">Possesses required skills, knowledge, and abilities to competently perform the job</label><br>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="kp_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_exceeds_expectations" class="form-check-input" name="kp_exceeds_expectations" value="1" <?php if(isset($options_rating['kp_exceeds_expectations']) && $options_rating['kp_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="kp_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_meets_expectations" class="form-check-input" name="kp_meets_expectations" value="1" <?php if(isset($options_rating['kp_meets_expectations']) && $options_rating['kp_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="kp_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_needs_improvement" class="form-check-input" name="kp_needs_improvement" value="1" <?php if(isset($options_rating['kp_needs_improvement']) && $options_rating['kp_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="kp_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_unacceptable" class="form-check-input" name="kp_unacceptable" value="1" <?php if(isset($options_rating['kp_unacceptable']) && $options_rating['kp_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="kp_comments" rows="4" cols="40" ><?php if(isset($details[0]->kp_comments)){ echo $details[0]->kp_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Training & Development</label>
                                    <label class="control-label fw-medium mb-3">Continually seeks ways to strengthen performance and regularly monitors new developments in field of work</label>
                                    <label class="control-label fw-medium mb-3">Rating:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="td_exceeds_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_exceeds_expectations" class="form-check-input" name="td_exceeds_expectations" value="1" <?php if(isset($options_rating['td_exceeds_expectations']) && $options_rating['td_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="td_meets_expectations">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_meets_expectations" class="form-check-input" name="td_meets_expectations" value="1" <?php if(isset($options_rating['td_meets_expectations']) && $options_rating['td_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="td_needs_improvement">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_needs_improvement" class="form-check-input" name="td_needs_improvement" value="1" <?php if(isset($options_rating['td_needs_improvement']) && $options_rating['td_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="td_unacceptable">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_unacceptable" class="form-check-input" name="td_unacceptable" value="1" <?php if(isset($options_rating['td_unacceptable']) && $options_rating['td_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comments and Examples</label>
                                                <div class="controls">
                                                    <textarea  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="td_comments" rows="4" cols="40" ><?php if(isset($details[0]->td_comments)){ echo $details[0]->td_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">PERFORMANCE GOALS (Set objectives and outline steps to improve in problem areas or further employee development)</label><br>
                                    <label class="control-label fw-medium mb-3">Work is completed accurately (few or no errors), efficiently and within deadlines with minimal supervision</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <textarea  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="performance_comments" rows="4" cols="40" ><?php if(isset($details[0]->performance_comments)){ echo $details[0]->performance_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Overall Rating</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls ">
                                                    <label for="ol_rating_opt1" class="d-flex">	<span class="col-sm-auto"><input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt1" class="form-check-input" name="ol_rating_opt1" value="1" <?php if(isset($options_rating['ol_rating_opt1']) && $options_rating['ol_rating_opt1'] == 1){ echo 'checked'; } ?>></span> <span class="text-dark px-2">Exceeds expectations <h6 class="text-mute">Employee consistently performs at a high level that exceeds expectations</h6> </span> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ol_rating_opt2" class="d-flex">	<span class="col-sm-auto"><input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt2" class="form-check-input" name="ol_rating_opt2" value="1" <?php if(isset($options_rating['ol_rating_opt2']) && $options_rating['ol_rating_opt2'] == 1){ echo 'checked'; } ?>></span> <span class="text-dark px-2">Meets expectations <h6 class="text-mute">Employee satisfies all essential job requirements; may exceed expectations periodically; demonstrates likelihood of eventually exceeding expectations</h6> </span></label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ol_rating_opt3" class="d-flex">	<span class="col-sm-auto"><input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt3" class="form-check-input" name="ol_rating_opt3" value="1" <?php if(isset($options_rating['ol_rating_opt3']) && $options_rating['ol_rating_opt3'] == 1){ echo 'checked'; } ?>></span> <span class="text-dark px-2">Needs improvement <h6 class="text-mute">Employee consistently performs below required standards/expectations for the position; training or other action is necessary to correct performance</h6> </span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="ol_rating_opt4" class="d-flex">	<span class="col-sm-auto"><input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt4" class="form-check-input" name="ol_rating_opt4" value="1" <?php if(isset($options_rating['ol_rating_opt4']) && $options_rating['ol_rating_opt4'] == 1){ echo 'checked'; } ?>></span><span class="text-dark px-2"> Unacceptable <h6 class="text-mute">Employee is unable or unwilling to perform required duties according to company standards; immediate improvement must be demonstrated</h6></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Comment on the overall performance</label>
                                                <div class="controls">
                                                    <textarea  class="form-control" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> name="ol_rating_comments" rows="4" cols="40" ><?php if(isset($details[0]->ol_rating_comments)){ echo $details[0]->ol_rating_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Employee Comments (optional)</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <textarea  class="form-control" name="emp_comments" rows="4" cols="40" ><?php if(isset($details[0]->emp_comments)){ echo $details[0]->emp_comments; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label class="control-label fw-medium fs-16 mb-3">Acknowledgement</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label for="acknowledgement"> <input type="checkbox" <?php echo ($role == 'employee' ? 'required' : 'disabled'); ?> name="acknowledgement"  id="acknowledgement" <?php echo (isset($details[0]->acknowledgement) && $details[0]->acknowledgement !='' ? 'checked': '');?>  > I acknowledge that I have had the opportunity to discuss this performance evaluation with my manager/ supervisor and I have received a copy of this evaluation.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Employee Signature</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="emp_sign" <?php echo ($role == 'employee' ? 'required' : 'disabled'); ?> autocomplete="off"  value="<?php if(isset($details[0]->emp_sign)){ echo $details[0]->emp_sign; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control"  name="emp_sign_date"  autocomplete="off" <?php echo ($role == 'employee' ? 'required' : 'disabled'); ?> value="<?php if(isset($details[0]->emp_sign_date)){ echo $details[0]->emp_sign_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Manager/ Supervisor Signature</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="manager_sign"  autocomplete="off"  value="<?php if(isset($details[0]->manager_sign)){ echo $details[0]->manager_sign; } ?>" <?php echo ($role == 'employee' ? 'disabled' : 'required'); ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control"  name="manager_sign_date"  autocomplete="off"  value="<?php if(isset($details[0]->manager_sign_date)){ echo $details[0]->manager_sign_date; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
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

