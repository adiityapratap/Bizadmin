<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <form class="form-horizontal" id="document_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/submit_outlet" enctype="multipart/form-data">
                <?php if(isset($details[0]->outlet_id)){ ?>	
            	<input type="hidden" class="form-control" name="outlet_id" value="<?php echo $details[0]->outlet_id; ?>">
            	   <?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($details[0]->outlet_id)){ echo "Edit"; } else { echo "Add"; }?> Outlet</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>

                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_outlet"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
	          		    
	          		    	<div class="form-group mt-2">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Outlet Name:<span>*</span></label>
							<div class="col-lg-12 col-sm-12">
							  
								<input type="text" class="form-control" name="outlet_name" value="<?php if(isset($details[0]->outlet_name)){ echo $details[0]->outlet_name; } ?>"  required >
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

