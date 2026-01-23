<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php $dayName = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun'); ?>
      <?php $dayNamelabel = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); ?>
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">	
                    <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url() ?>index.php/employees/add_availability" enctype="multipart/form-data">
                    <input type="hidden" name="EmpId" value="<?php echo $employeeID; ?>">
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Add Your Availability ( <?php echo $Mondate ?> To <?php echo $Sundate ?> )</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                                <div>
                                    <input type="submit" name="add_btn" id="add_btn" class="btn btn-primary" value="Update">
                                  
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
                                    <label class="control-label fw-medium mb-3">Please check the checkboxes for the days you are available and please mention the times available in the comments section (Example 9am-6pm).</label>
                                    <?php for($day = 0; $day < 7; $day++) {  ?>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3"><?php  echo $dayNamelabel[$day]; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <?php if($emp_availability[$dayName[$day].'_avail'] =='') {  ?>
                                                        <input class="form-check-input" name="<?php  echo $dayName[$day]; ?>_avail" type="checkbox"  value="<?php echo ${$dayName[$day].'date'}; ?>">
                                                    <?php }else{ ?>
                                                        <input class="form-check-input" name="<?php  echo $dayName[$day]; ?>_avail" type="checkbox" checked="checked" value="<?php echo ${$dayName[$day].'date'}; ?>">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-12 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <?php if($emp_availability[$dayName[$day].'_comment'] !='') {  ?>
                                                      <input type="text" class="form-control" name="<?php  echo $dayName[$day]; ?>_comment" value="<?php echo $emp_availability[$dayName[$day].'_comment']; ?>">
                                                    <?php }else{ ?>
                                                      <input type="text" class="form-control" name="<?php  echo $dayName[$day]; ?>_comment" placeholder="Comments">
                                                    <?php } ?>    
                                                </div>
                                            </div>
                                        </div>
                                    
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