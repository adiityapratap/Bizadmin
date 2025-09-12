<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($details[0]->document_id)){ ?>	
            		<form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_document" enctype="multipart/form-data">
            	   <?php } else { ?>
            	   <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/add_document" enctype="multipart/form-data">
            
            	    <?php } ?>
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">ADD DOCUMENT</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <?php if($role=='admin' || $role=='manager') { ?>
                                    
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_document"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <input type="submit" name="add_btn" id="add_btn" class="btn btn-primary" value="Submit">
                                     
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
	          		    
	          		    	<div class="form-group mt-2">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Document Name:<span>*</span></label>
							<div class="col-lg-12 col-sm-12">
							  
								<input type="text" class="form-control" name="doc_name" value="<?php if(isset($details[0]->doc_name)){ echo $details[0]->doc_name; } ?>"  required >
							</div>
						</div>
						
						<div class="form-group mt-2">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Upload File:<span>*</span></label>
							<div class="col-lg-12 col-sm-12">
							    <input type="hidden" name="document_id" value="<?php if(isset($details[0]->document_id)){ echo $details[0]->document_id; } ?>">
								<input type="file" class="form-control" name="document_name" value="<?php if(isset($details[0]->document_name)){ echo $details[0]->document_name; } ?>"  required >
							</div>
						</div>
						
						
                    			<?php if($role=='admin' || $role=='manager') { ?>			
                    		<div class="form-group mt-2">
                          <label class="control-label col-lg-4 col-sm-12">Role</label>
                          <div class="controls col-lg-12 col-sm-12">
                           <select name="role" class ='form-control'>
                                <option value="14">All Staff </option>
                             <?php if(isset($roles) && !empty($roles)) { foreach($roles as $role) { ?>
                             <?php if(isset($details[0]->role) && $details[0]->role == $role->role_id) { ?>
                             <option value="<?php echo $role->role_id; ?>" selected="selected"><?php echo $role->role_name; ?></option>
                             <?php } else {?>
                             <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                    		
                    		<?php }}} ?>
                               
                                   
                               
                           </select>
                          </div>
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

