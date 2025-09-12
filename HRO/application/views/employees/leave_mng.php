<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/employees/submit_leave" enctype="multipart/form-data">
                   <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">ADD NEW LEAVE REQUEST</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/employees/emp_dashboard">Cancel</a>
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
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Leave Type <span>*</span></label>
                                                    <select name="leave_type" class="form-control" onchange="yesnoCheck(this);" required>
                    									<option value="">Select</option>
                    									<option value="Annual">Annual Leave</option>
                    									<option value="Sick">Sick Leave</option>
                    									<option value="Long Service Leave">Long Service Leave</option>
                    									<option value="Day Off">Day Off</option>
                    								</select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ifYes" style="display: none;">
                                            <div class="col-md-6 mb-4">  
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <label class="control-label fw-medium mb-3">Upload Medical Certificate<span>*</span></label>
                                                        <input type="file" class="form-control" name="med_certificate" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Start Date <span>*</span></label>
                                                    <input type="date" class="form-control datetime" name="start_date" placeholder='Start Date' autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">End Date <span>*</span></label>
                                                    <input type="date" class="form-control datetime" name="end_date" placeholder='End Date' autocomplete="off" required>
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
    function yesnoCheck(that) {
        if (that.value == "Sick") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>