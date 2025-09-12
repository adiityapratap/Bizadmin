<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<?php if($survey[0]->status == 1){ $disabled = 'custom_disable'; }else { $disabled = ''; } ?>
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <form class="form-horizontal" id="surveyForm" role="form" method="post" action="" enctype="multipart/form-data">
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Survey</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <?php if($survey[0]->status == 1){ ?>
                                     <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/survey_list"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <?php } ?>
                                    <?php if($survey[0]->status != 1){ ?>
                                        <input type="button" name="survey-submit" id="survey_submit" class="btn btn-primary" value="Submit">
                                   <?php } ?>
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
                                    <label class="control-label fw-medium fs-14 mb-4">Please complete this employee questionnaire as conducted by (Zouki). All information will be kept confidential. Any concerns can be communicated to the Human Resources manager. Thank you for your time and cooperation.</label>
                                    <p>Answer the following questions by circling the most appropriate answer</p>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">1. You have the resources necessary to do your job well</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="disagree-input" value="disagree" name="resources" <?php if($survey[0]->resources == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="neutral-input" value="neutral" name="resources" <?php if($survey[0]->resources == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="agree-input" value="agree" name="resources" <?php if($survey[0]->resources == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">2. Help and Support are easily accessed.</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="support-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="support-disagree-input" value="disagree" name="support" <?php if($survey[0]->support == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="support-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="support-neutral-input" value="neutral" name="support" <?php if($survey[0]->support == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="support-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="support-agree-input" value="agree" name="support" <?php if($survey[0]->support == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">3. Training options are offered.</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="trainingOptions-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="trainingOptions-disagree-input" value="disagree" name="trainingOptions" <?php if($survey[0]->trainingOptions == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="trainingOptions-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="trainingOptions-neutral-input" value="neutral" name="trainingOptions" <?php if($survey[0]->trainingOptions == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-3">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="trainingOptions-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="trainingOptions-agree-input" value="agree" name="trainingOptions" <?php if($survey[0]->trainingOptions == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">What types of training would you like to see?</label>
                                                    <input type="text" id="trainingType-agree-input" class="form-control" name="trainingType" value="<?php echo $survey[0]->trainingType; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">4. Your working conditions are safe and non- hazardous</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="workingConditions-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="workingConditions-disagree-input" value="disagree" name="workingConditions" <?php if($survey[0]->workingConditions == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="workingConditions-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="workingConditions-neutral-input" value="neutral" name="workingConditions" <?php if($survey[0]->workingConditions == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="workingConditions-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="workingConditions-agree-input" value="agree" name="workingConditions" <?php if($survey[0]->workingConditions == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">5. You have been given instructions on emergency safety procedures</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="emergencyInst-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="emergencyInst-disagree-input" value="disagree" name="emergencyInst" <?php if($survey[0]->emergencyInst == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="emergencyInst-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="emergencyInst-neutral-input" value="neutral" name="emergencyInst" <?php if($survey[0]->emergencyInst == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="emergencyInst-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="emergencyInst-agree-input" value="agree" name="emergencyInst" <?php if($survey[0]->emergencyInst == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">6. Requirements of your job are clear</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="clearRequirements-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="clearRequirements-disagree-input" value="disagree" name="clearRequirements" <?php if($survey[0]->clearRequirements == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="clearRequirements-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="clearRequirements-neutral-input" value="neutral" name="clearRequirements" <?php if($survey[0]->clearRequirements == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="clearRequirements-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="clearRequirements-agree-input" value="agree" name="clearRequirements" <?php if($survey[0]->clearRequirements == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">7. Communication with other employees/managers is easy</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="communication-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="communication-disagree-input" value="disagree" name="communication" <?php if($survey[0]->communication == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="communication-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="communication-neutral-input" value="neutral" name="communication" <?php if($survey[0]->communication == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group ">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="communication-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="communication-agree-input" value="agree" name="communication" <?php if($survey[0]->communication == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">8. Your manager is approachable and supportive</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="approachableManager-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="approachableManager-disagree-input" value="disagree" name="approachableManager" <?php if($survey[0]->approachableManager == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="approachableManager-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="approachableManager-neutral-input" value="neutral" name="approachableManager" <?php if($survey[0]->approachableManager == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="approachableManager-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="approachableManager-agree-input" value="agree" name="approachableManager" <?php if($survey[0]->approachableManager == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">9. The following acts are unlawful and may end your employment immediately: Bullying, Sexual harassment, Discrimination.</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                     <label class="<?php echo $disabled; ?>" for="unlawfulAct-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="unlawfulAct-disagree-input" value="disagree" name="unlawfulAct" <?php if($survey[0]->unlawfulAct == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="unlawfulAct-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="unlawfulAct-neutral-input" value="neutral" name="unlawfulAct" <?php if($survey[0]->unlawfulAct == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="unlawfulAct-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="unlawfulAct-agree-input" value="agree" name="unlawfulAct" <?php if($survey[0]->unlawfulAct == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">10. The company policies and procedures are updated on the HR portal and it’s my responsibility to read them and adhere to all policies</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="updatedPolicies-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="updatedPolicies-disagree-input" value="disagree" name="updatedPolicies" <?php if($survey[0]->updatedPolicies == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="updatedPolicies-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="updatedPolicies-neutral-input" value="neutral" name="updatedPolicies" <?php if($survey[0]->updatedPolicies == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="updatedPolicies-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="updatedPolicies-agree-input" value="agree" name="updatedPolicies" <?php if($survey[0]->updatedPolicies == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">11. It’s my responsibility to report any accident while on duty:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="reportAccident-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="reportAccident-disagree-input" value="disagree" name="reportAccident" <?php if($survey[0]->reportAccident == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="reportAccident-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="reportAccident-neutral-input" value="neutral" name="reportAccident" <?php if($survey[0]->reportAccident == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="reportAccident-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="reportAccident-agree-input" value="agree" name="reportAccident" <?php if($survey[0]->reportAccident == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">12. Abuse alcohol or drugs whilst on Zouki premises may terminate your employment immediately:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="terminate-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="terminate-disagree-input" value="disagree" name="terminate" <?php if($survey[0]->terminate == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="terminate-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="terminate-neutral-input" value="neutral" name="terminate" <?php if($survey[0]->terminate == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="terminate-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="terminate-agree-input" value="agree" name="terminate" <?php if($survey[0]->terminate == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">13. I feel valued and affirmed at work:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="feelValued-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="feelValued-disagree-input" value="disagree" name="feelValued" <?php if($survey[0]->feelValued == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="feelValued-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="feelValued-neutral-input" value="neutral" name="feelValued" <?php if($survey[0]->feelValued == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="feelValued-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="feelValued-agree-input" value="agree" name="feelValued" <?php if($survey[0]->feelValued == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">14. My values fit with the organizational values:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="organizationalValues-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="organizationalValues-disagree-input" value="disagree" name="organizationalValues" <?php if($survey[0]->organizationalValues == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="organizationalValues-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="organizationalValues-neutral-input" value="neutral" name="organizationalValues" <?php if($survey[0]->organizationalValues == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="organizationalValues-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="organizationalValues-agree-input" value="agree" name="organizationalValues" <?php if($survey[0]->organizationalValues == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">15. Creativity and innovation are supported:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="creativity-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="creativity-disagree-input" value="disagree" name="creativity" <?php if($survey[0]->creativity == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="creativity-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="creativity-neutral-input" value="neutral" name="creativity" <?php if($survey[0]->creativity == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="creativity-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="creativity-agree-input" value="agree" name="creativity" <?php if($survey[0]->creativity == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">16. My manager reviews my progress:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="progresReviewed-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="progresReviewed-disagree-input" value="disagree" name="progresReviewed" <?php if($survey[0]->progresReviewed == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                   <label class="<?php echo $disabled; ?>" for="progresReviewed-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="progresReviewed-neutral-input" value="neutral" name="progresReviewed" <?php if($survey[0]->progresReviewed == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="progresReviewed-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="progresReviewed-agree-input" value="agree" name="progresReviewed" <?php if($survey[0]->progresReviewed == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">17. I am fairly compensated:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="compensated-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="compensated-disagree-input" value="disagree" name="compensated" <?php if($survey[0]->compensated == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="compensated-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="compensated-neutral-input" value="neutral" name="compensated" <?php if($survey[0]->compensated == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="compensated-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="compensated-agree-input" value="agree" name="compensated" <?php if($survey[0]->compensated == 'agree') echo"checked"; ?>> Agree</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="custom_border-dashed px-3 py-3">
                                    <label class="control-label fw-medium mb-2">18. Zouki always expects its employee’s treating colleagues in a professional manner:</label>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-warning">
                                                    <label class="<?php echo $disabled; ?>" for="professional-disagree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="professional-disagree-input" value="disagree" name="professional" <?php if($survey[0]->professional == 'disagree') echo"checked"; ?>> Disagree</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="<?php echo $disabled; ?>" for="professional-neutral-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="professional-neutral-input" value="neutral" name="professional" <?php if($survey[0]->professional == 'neutral') echo"checked"; ?>> Neutral</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 mb-4">  
                                            <div class="control-group">
                                                <div class="controls form-radio-success">
                                                    <label class="<?php echo $disabled; ?>" for="professional-agree-input"><input type="radio" class="form-check-input <?php echo $disabled; ?>" id="professional-agree-input" value="agree" name="professional" <?php if($survey[0]->professional == 'agree') echo"checked"; ?>> Agree</label>
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

<script>
    	$('#survey_submit').click(function(){
    
        var data1 = $('#surveyForm').serialize();
        
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_survey_form/",
        	data: data1,
        // 	beforeSend: function(){
        //         $("#loader").show();
        //          },
        //         complete:function(data){
        //         $("#loader").hide();
        //          },
        	success: function(data){ console.log(data); 
        	    if(data=='success'){
		        $msg = "Thank you for submitting Survey.";
		        $icon = "success";
		        }
		        else{
		         $msg = "Form not submitted.";
		         $icon = "warning";
		        } 
        	    Swal.fire({
		         text: $msg,
                 icon: $icon,
                  }).then((value) => {
                  if(data=='success'){
                  window.location = "<?php echo base_url(); ?>index.php/admin/survey_form/<?php echo $survey[0]->emp_id;?>";
                   }
               });
               
        	}
        	
        }); 
		
	});
	
	
</script>