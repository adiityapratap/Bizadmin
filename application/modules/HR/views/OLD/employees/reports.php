<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php $userId = $this->session->userdata('user_id'); ?>
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
                                    <h5 class="card-title mb-0">Reports</h5>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
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
                            <form action="<?php echo base_url();?>index.php/admin/generate_report" method="POST">
									<div class="form-group row">
										<label class="col-sm-3 control-label text-right">Date From</label>
										<div class="col-sm-6">
											<input type="text" class="form-control datepicker" name="date_from" required>
										</div>
									</div>
									<div class="form-group row mt-2">
										<label class="col-sm-3 control-label text-right">Date To</label>
										<div class="col-sm-6"> 
											<input type="text" class="form-control datepicker" name="date_to" required>
										</div>
									</div>
									<div class="ct-report-btn">
										<button type="submit" class="btn btn-success btn-ph">Generate <i class="fa fa-bar-chart"></i>
									</div>
								</form>
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

<script type="text/javascript">

  
</script> 
