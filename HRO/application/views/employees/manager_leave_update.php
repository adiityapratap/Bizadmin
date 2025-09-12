<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/update_leave_manager" enctype="multipart/form-data">
                   <input type="hidden" name="leave_id" value="<?php echo $leave_id; ?>">
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Update Leave</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
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
                                    <?php foreach($leaves as $row){ ?>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Employee Name <span>*</span></label>
                                                    <input type="text" class="form-control" readonly name="empname" value="<?php echo $emp_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Start Date <span>*</span></label>
                                                    <input type="text" class="form-control" readonly name="sdate" value="<?php echo date("d-m-Y",strtotime($row->start_date)); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">End Date <span>*</span></label>
                                                    <input type="text" class="form-control" readonly name="edate" value="<?php echo date("d-m-Y",strtotime($row->end_date)); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Nominated person <span>*</span></label>
                                                    <input type="text" class="form-control" name="new_nominated_person" value="<?php echo $row->new_nominated_person; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Status <span>*</span></label>
                                                    <select name="leave_status" class="form-control" onchange="yesnoCheck(this);">
                    									<option value="">Select</option>
                    								
                    									<option value="Approve" <?php if($row->leave_status == 'Approve'){ echo "selected";} ?>>Approve</option>
                    									<option value="Comment" <?php if($row->leave_status == 'Comment'){ echo "selected";} ?>>Add Comments</option>
                    										<option value="Pending" <?php if($row->leave_status == 'Pending'){ echo "selected";} ?>>Pending</option>
                    									<option value="Reject" <?php if($row->leave_status == 'Reject'){ echo "selected";} ?>>Reject</option>
                    									
                    								</select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($row->comments != ''){ ?>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Add Comments <span>*</span></label>
                                                    <textarea class="form-control" name="comment" rows="4"><?php echo $row->comments; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }else{ ?>
							                <div id="ifYes" style="display: none;">
                                                <div class="col-md-12 mb-4">  
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <label class="control-label fw-medium mb-3">Comment <span>*</span></label>
                                                            <textarea class="form-control" name="comment"  rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($row->medical_certificate != ''){  ?>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Medical Certificate</label>
                                                    <a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/leave_certificates/<?php echo $row->medical_certificate; ?>" target="_blank">View</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <?php $file_parts = pathinfo($row->medical_certificate); 
                            							 if($file_parts['extension'] == 'pdf'){ ?>
                            							    <iframe src="<?php echo base_url();?>assets/leave_certificates/<?php echo $row->medical_certificate; ?>" width="100%" height="100%"></iframe>
                            							<?php }else { ?>
                            						        <iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>assets/leave_certificates/<?php echo $row->medical_certificate; ?>&embedded=true" width="100%" height="100%"> </iframe>	
                                                     <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                     <?php } ?>
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
        if (that.value == "Comment") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>