<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <?php if(isset($details[0]->Probationary_Period_id)){ ?>	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Probationary_Period" enctype="multipart/form-data">
                    <input type="hidden" name= "Probationary_Period_id" value="<?php if(isset($details[0]->Probationary_Period_id)){ echo $details[0]->Probationary_Period_id; } ?>">
		            <input type="hidden" name= "emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
                <?php } else {?>
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Probationary_Period" enctype="multipart/form-data">
            	<?php } ?>
            	   
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($details[0]->Probationary_Period_id)){ echo "EDIT"; } else { echo "ADD"; }?> PROBATIONARY PERIOD</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                     <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_Probationary_Period"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
                                    <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Name <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="name" autocomplete="off" required value="<?php if(isset($details[0]->name)){ echo $details[0]->name; } ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Start Date <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control datepicker"  name="start_date"  autocomplete="off" required value="<?php if(isset($details[0]->start_date)){ echo $details[0]->start_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">End Date <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control datepicker"  name="end_date"  autocomplete="off" required value="<?php if(isset($details[0]->end_date)){ echo $details[0]->end_date; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <label class="control-label">Notes <span>*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="notes"  autocomplete="off" required value="<?php if(isset($details[0]->notes)){ echo $details[0]->notes; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(isset($details[0]->Probationary_Period_id)){ ?>
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

