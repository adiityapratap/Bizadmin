<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($details[0]->memo_id)){ ?>	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_memo" enctype="multipart/form-data">
                    <input type="hidden" name="memo_id" value="<?php if(isset($details[0]->memo_id)){ echo $details[0]->memo_id; } ?>">
                <?php } else { ?>
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/add_memo" enctype="multipart/form-data">
                <?php } ?>
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($details[0]->memo_id)){ echo "ADD"; } else{ echo "EDIT"; } ?> MEMO</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <?php if($role=='admin' || $role=='manager') { ?>
                                        <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_memo"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
	          		        <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Subject <span>*</span></label>
                                                    <input type="text" class="form-control" name="subject" value="<?php if(isset($details[0]->subject)){ echo $details[0]->subject; } ?>" autocomplete="off" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Message <span>*</span></label>
                                                    <textarea  class="form-control" name="message" rows="13" cols="80" autocomplete="off" required><?php if(isset($details[0]->message)){ echo $details[0]->message; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($role=='admin' || $role=='manager') { ?>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Role</label>
                                                    <select name="role" class ='form-control' id="role_memo">
                                                        <option value="">-- Select Role -- </option>
                                                        <option value="14" selected="selected">All Staff </option>
                                                        <?php if(isset($roles) && !empty($roles)) { foreach($roles as $role) { ?>
                                                        <?php if(isset($details[0]->role) && $details[0]->role == $role->role_id) { ?>
                                                            <option value="<?php echo $role->role_id; ?>" selected="selected"><?php echo $role->role_name; ?></option>
                                                        <?php } else {?>
                                                            <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                                                		<?php }}} ?>
                                                   </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Employee</label>
                                                    <select  name="emp_email" class="form-control" id="emp_slt" required>
                                                        <option value="">-- Select Employee --</option>
                                                	    <option value="" selected="selected">All Employees</option>
                                                	    <?php foreach($employees as $row){ ?>
                                                	        <option value="<?php echo $row->email."|".$row->emp_id; ?>"><?php echo $row->first_name.' '. $row->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option>
                                                	    <?php } ?>
                                            	  </select>
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