<?php  if(isset($form) && $form == 'view'){ $disable = 'disable';}else{ $disable = ''; } ?>
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
                        <form action="<?php echo base_url() ?>index.php/admin/resume_form_submit" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">
                                        <?php if(isset($form) && $form == 'view'){ echo 'View Resume'; }
                				          else if(isset($form) && $form == 'edit'){ echo 'Edit Resume'; }
                				          else { echo 'Add Resume'; }?>
				                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url() ?>index.php/admin/resumes"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <?php if(isset($form) && $form == 'edit') { ?>
                                        <input type="hidden"  name="customer_user_id" value="<?php if(isset($resume[0]->resume_id)){ echo $resume[0]->resume_id; }?>">
                                        <input type="submit" class="btn btn-primary" value="Update Resume">
                                        <?php } else if(isset($form) && $form == 'add'){ ?>
                                        <input type="submit" class="btn btn-primary" value="Add New Resume">
                                    <?php }else{}?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                            <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert alert-success" role="alert" style="font-size: 18px;">
                                 <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                           
                                <div class="row">
                                    <div class="col-lg-6 col-md-12"> 
                                      <div class="row">
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Name of candidate</label>
                                              <div class="controls">
                                                <input type="text" <?php echo $disable; ?> class="form-control" name="candidate_name" value="<?php if(isset($resume[0]->candidate_name)){ echo $resume[0]->candidate_name; }?>" autocomplete="off" >
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Email</label>
                                              <div class="controls">
                                                <input type="text" <?php echo $disable; ?> class="form-control" name="email"  value="<?php if(isset($resume[0]->email)){ echo $resume[0]->email; }?>" autocomplete="off">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Phone</label>
                                              <div class="controls">
                                                <input type="text" <?php echo $disable; ?> class="form-control" name="phone" value="<?php if(isset($resume[0]->phone)){ echo $resume[0]->phone; }?>"  autocomplete="off">
                                              </div>
                                            </div>
                                          </div>     
                                      </div>
                                    </div> 
                                    <div class="col-lg-6 col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Job role</label>
                                              <div class="controls">
                                                <input type="text" <?php echo $disable; ?> class="form-control" name="job_role"  value="<?php if(isset($resume[0]->job_role)){ echo $resume[0]->job_role; }?>" autocomplete="off">
                                              </div>
                                            </div>
                                          </div>  
                                          <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label"><?php if(isset($form) && $form != 'view'){ echo "Upload"; } ?> Resume</label>
                                              <div class="controls">
                                                    <?php if(isset($form) && $form == 'view'){ ?>
                                                    <a class="btn btn-success mr-2" href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->resume; ?>" target="_blank"><i class="mdi mdi-eye align-bottom me-1"></i> View Resume</a>
                                                    <a class="btn btn-info" href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->resume; ?>" download><i class="mdi mdi-download align-bottom me-1"></i> Download Resume</a>
                                                    <?php } else{ ?>
                                                    <input type="file" class="form-control" name="resume"  autocomplete="off">
                                                <?php } ?>
                                              </div>
                                            </div>
                                          </div>  
                                          
                                           <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label"><?php if(isset($form) && $form != 'view'){ echo "Upload"; } ?> cover letter</label>
                                              <div class="controls">
                                                    <?php if(isset($form) && $form == 'view'){ ?>
                                                    <a class="btn btn-success mr-2" href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->cover_letter; ?>" target="_blank"><i class="mdi mdi-eye align-bottom me-1"></i> View Cover Letter</a>
                                                    <a class="btn btn-info" href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->cover_letter; ?>" download><i class="mdi mdi-download align-bottom me-1"></i> Download Cover Letter</a>
                                                    <?php } else{ ?>
                                                    <input type="file" class="form-control" name="cover_letter" autocomplete="off">
                                                <?php } ?>
                                              </div>
                                            </div>
                                          </div>  
                                          
                                         
                                        </div>
                                      
                                            
                                             
                              </div>
                                    <div class="col-lg-12 mb-4">  
                                        <div class="control-group">
                                          <label class="control-label">Notes</label>
                                          <div class="controls">
                                                <input type="text" <?php echo $disable; ?> class="form-control" name="notes" value="<?php if(isset($resume[0]->notes)){ echo $resume[0]->notes; }?>" >
                                          </div>
                                        </div>
                                     </div>  
                                </div>
                             
                              
                        </div>
                       
                       
                    </div>
                    </form>
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
 $('#form_registration').validate({
    rules:{
      name:{
        required:true
      },
      email:{
        required:true,
        email:true,
        remote:{type:'post',url:'<?php echo base_url() ?>index.php/auth/email_check',async:false}
      },
      password:{
        required : true
      },
      password_confirm:{
        required : true,
        equalTo : '#password'
      }
    },
    messages:{
      name:{
        required:"Please Enter Name"
      },
      email:{
        required:"Please Enter Email",
        email:"Invalid Email Id",
        remote :"Email is already Exist"
      },
      password:{
        required : "Please Enter Password"
      },
      password_confirm:{
        required : "Please Enter Confirm Password",
        equalTo : '#password'
      }
    }

  });
</script> 
