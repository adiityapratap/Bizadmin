<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($formData['Resignation_Letter_id'])){ ?>	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url('HR/resignationL/updateResignationL/'.$formData['Resignation_Letter_id']); ?>" enctype="multipart/form-data">
                    <input type="hidden" name= "emp_id" value="<?php if(isset($formData['emp_id'])){ echo $formData['emp_id']; } ?>">				    
                <?php } else {?>
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url('HR/resignationL/AddResignationL'); ?>" enctype="multipart/form-data">
            	<?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0 text-black"><?php if(isset($formData['Resignation_Letter_id'])){ echo "EDIT"; } else { echo "NEW"; }?> RESIGNATION LETTER</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <input type="submit" id="add_btn" class="btn btn-primary" value="Submit">
                                   
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
                                    <label class="control-label fw-medium">Upload File</label>
                                    <div class="row">
                                        <div class=" col-md-12 mb-4"> 
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="file" class="form-control" name="userfile[]" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if((isset($formData['resign_letter'])) && ($formData['resign_letter'] !='')) {  ?>
                                        <?php $resignLetters  = unserialize($formData['resign_letter']); ?>
                                        <?php foreach($resignLetters as $resignLetter) {  ?>
                                            <div class="col-md-4 mb-4"> 
                                                <div class="control-group">
                                                    <div class="controls">
                        							    <a class="btn btn-success w-100" href="<?php echo base_url();?>uploaded_files/<?php echo $this->tenantIdentifier ?>/HR/CompliancesForm/<?php echo $resignLetter; ?>" target="_blank">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                         <?php  } ?>    
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Subject <span>*</span></label>
                                                <div class="controls">
						                            <input type="text" class="form-control" name="subject" autocomplete="off" required value="<?php if(isset($formData['subject'])){ echo $formData['subject']; } ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Name <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="name" autocomplete="off" required value="<?php if(isset($formData['name'])){ echo $formData['name']; } ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Date of Submission <span>*</span></label>
                                                <div class="controls">
                <input type="text" value="<?php echo (isset($formData['resign_date']) ? $formData['resign_date'] : '') ?>" class="form-control flatpickr-input active" name="resign_date" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Reason for Leaving and Experience Working with Us <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="resign_note" autocomplete="off" required value="<?php if(isset($formData['resign_note'])){ echo $formData['resign_note']; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(isset($formData['Resignation_Letter_id'])){ ?>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Manager Comments</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="comment" value="<?php if(isset($formData['comment'])){ echo $formData['comment']; } ?>" >
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

