<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
               
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">REIMBURSEMENT REQUEST</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_Employee_reimbursement"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
	          		        <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 mb-4">  
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <label class="control-label fw-medium mb-3">Receipts</label>
                                                        <a class="btn btn-success w-100" href="<?php echo base_url();?>uploaded_files/<?php echo $details[0]->receipt; ?>" target="_blank">View</a>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-md-9 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Employee Name</label>
                                                    <input type="text" readonly class="form-control" name="emp_name" autocomplete="off" required value="<?php if(isset($details[0]->emp_name)){ echo $details[0]->emp_name; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Select Date</label>
                                                    <input type="text" readonly class="form-control datepicker"  name="completed_date"  autocomplete="off" required value="<?php if(isset($details[0]->completed_date)){ echo date("d-m-Y", strtotime($details[0]->completed_date) ); } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Total Reimbursement</label>
                                                    <input type="text" readonly class="form-control" name="total_reimbursement"  autocomplete="off" required value="<?php if(isset($details[0]->total_reimbursement)){ echo $details[0]->total_reimbursement; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Reason</label>
                                                    <input type="text" readonly class="form-control" name="reason"  autocomplete="off" required value="<?php if(isset($details[0]->reason)){ echo $details[0]->reason; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Approved Business Manager</label>
                                                    <input type="text" readonly class="form-control" name="business_manager" value="<?php if(isset($details[0]->business_manager)){ echo $details[0]->business_manager; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Date BR Signed</label>
                                                    <input type="text" readonly class="form-control datepicker"  name="br_date"  autocomplete="off" required value="<?php if(isset($details[0]->br_date)){ echo date("d-m-Y", strtotime($details[0]->br_date) ); } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(isset($details[0]->Employee_reimbursement_id)){ ?>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Manager Comments</label>
                                                    <input type="text" readonly class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
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