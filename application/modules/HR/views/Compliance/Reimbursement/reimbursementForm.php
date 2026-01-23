<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($formData['Employee_reimbursement_id'])){ ?>	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url('HR/reimbursement/updateReimbursement/'.$formData['Employee_reimbursement_id']); ?>" enctype="multipart/form-data">
                <?php } else { ?>
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url('HR/reimbursement/AddReimbursement'); ?>" enctype="multipart/form-data">
                <?php } ?>
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0 text-black">REIMBURSEMENT REQUEST</h5>
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
                                    <div class="row">
                                        <div class="col-md-12"><label class="control-label fw-medium mb-3">Receipts <span>*</span></label></div>
                                        <div class=" col-md-6 mb-4"> 
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="file" class="form-control" name="userfile[]" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if((isset($formData['receipt'])) && ($formData['receipt'] !='')) {  ?>
                                        <?php $receipts  = unserialize($formData['receipt']); ?>
                                        <?php foreach($receipts as $receipt) {  ?>
                                            <div class="col-md-3 mb-4"> 
                                                <div class="control-group">
                                                    <div class="controls">
                        							    <a class="btn btn-success w-100" href="<?php echo base_url();?>uploaded_files/<?php echo $this->tenantIdentifier ?>/HR/CompliancesForm/<?php echo $receipt; ?>" target="_blank">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                         <?php  } ?>    
                                        <?php } ?>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Employee Name <span>*</span></label>
                                                    <input type="text" class="form-control" name="emp_name" autocomplete="off" required value="<?php if(isset($formData['emp_name'])){ echo $formData['emp_name']; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Select Date <span>*</span></label>
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" name="completed_date"  autocomplete="off" required value="<?php if(isset($formData['completed_date'])){ echo date("d-m-Y", strtotime($formData['completed_date']) ); } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Total Reimbursement <span>*</span></label>
                                                    <input type="text" class="form-control" name="total_reimbursement"  autocomplete="off" required value="<?php if(isset($formData['total_reimbursement'])){ echo $formData['total_reimbursement']; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Reason <span>*</span></label>
                                                    <input type="text" class="form-control" name="reason"  autocomplete="off" required value="<?php if(isset($formData['reason'])){ echo $formData['reason']; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Approved Business Manager</label>
                                                    <input type="text" class="form-control" name="business_manager" value="<?php if(isset($formData['business_manager'])){ echo $formData['business_manager']; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Date BR Signed <span>*</span></label>
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" name="br_date"  autocomplete="off" required value="<?php if(isset($formData['br_date'])){ echo date("d-m-Y", strtotime($formData['br_date']) ); } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(isset($formData['Employee_reimbursement_id'])){ ?>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Manager Comments</label>
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