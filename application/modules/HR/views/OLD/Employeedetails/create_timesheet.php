<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">	
                
                <form class="form-horizontal" id="add_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/create_timesheet" enctype="multipart/form-data">
                 
            	<div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">ADD TIMEESHEET</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                        <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/view_timesheet"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Timesheet Name <span>*</span></label>
                                                    <input type="text" required class="form-control" name="timesheet_name" value="<?php if(isset($details[0]->subject)){ echo $details[0]->subject; } ?>" autocomplete="off" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label fw-medium mb-3">Select Roster</label>
                                                    <select name="roster_list[]" class ='form-control selectpicker mb-3' id="roster_list" data-choices data-choices-text-unique-true multiple required>
                                                         <?php if(isset($rosters) && !empty($rosters)) { foreach($rosters as $roster) { $date = new DateTime($roster->start_date); $enddate = new DateTime($roster->end_date); $roster_name = $roster->roster_name."(". $date->format('d-m-Y')." To ".$enddate->format('d-m-Y').")";  ?>
                                                         <?php if(isset($details[0]->role) && $details[0]->role == $roster->roster_group_id) { ?>
                                                           <option value="<?php echo $roster->roster_group_id; ?>" selected="selected"><?php echo $roster_name; ?></option>
                                                         <?php } else { ?>
                                                         <option value="<?php echo $roster->roster_group_id; ?>" ><?php echo $roster_name; ?></option>
                                                		<?php }}} ?>
                                                     </select>
                                                     <?php  if($role == 'admin' && $viewAllroster == 0) {  ?>
                                                       	<div class="control-group">
                                                       	    <a href="<?php echo base_url(); ?>index.php/Employeedetails/create_timesheet/viewAll">View all Roster</a>
                                                       	    </div>
                                                       	    <?php }else if($role == 'admin' && $viewAllroster) {  ?>
                                                       	    <div class="control-group">
                                                       	    <a href="<?php echo base_url(); ?>index.php/Employeedetails/create_timesheet">View only future Roster</a>
                                                   	    </div>
                                               	    <?php } ?>
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