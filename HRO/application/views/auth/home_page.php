<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
   
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>BIZADMIN HR</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>hr-assets/images/logo/favicon.jpg" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    <!-- Layout config Js -->
    <script src="<?php echo base_url(""); ?>hr-assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url(""); ?>hr-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url(""); ?>hr-assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url(""); ?>hr-assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url(""); ?>hr-assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(""); ?>hr-assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(""); ?>hr-assets/css/custom-style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- auth-page wrapper -->
    <div class="auth-page-wrapper bg-primary py-5 d-flex justify-content-center align-items-center min-vh-100" >
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <h1 class="text-white mb-3 text-center">BIZADMIN HR MANAGEMENT</h1>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         <?php if(null !==$this->session->flashdata('permissionmessage')) { ?>  
                            <div id='hideMe'>
                               <p class="alert alert-danger"><?php echo $this->session->flashdata('permissionmessage'); ?></p>
                            </div>
                            <?php } ?>
                            <?php if(null !==$this->session->userdata('feedback')) { ?>
                            <div class="alert alert-success" id="success-alert">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <?php } ?> 
                          
                            <?php if(null !==$this->session->userdata('email_sent')) { ?>  
                            <div id='hideMe'>
                                <p class="alert alert-success"><?php echo $this->session->flashdata('email_sent'); ?></p>
                            </div>
                            <?php } ?>
                            <?php if(null !==$this->session->userdata('email_notsent')) { ?>  
                            <div id='hideMe'>
                                <p class="alert alert-danger"><?php echo $this->session->flashdata('email_notsent'); ?></p>
                            </div>
                            <?php } ?>
                                
                            <?php if(null !==$this->session->userdata('message_success')) { ?>
                              <div class="alert alert-success">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <?php echo $this->session->userdata('message_success');?>
                              </div>
                            <?php } ?>
                    </div>
                    <div class="col-lg-12">
                        <div class="overflow-hidden">
                            <div class="row justify-content-center g-0">
                              
                                <div class="col-lg-6 p-5 auth-one-bg">
                                    <div class="">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                          
                                                <div class="p-lg-3 mt-4 mb-4 text-center ">
                                                    
                                                    <!-- Buttons with Label -->
                                                    <a href="<?php echo base_url(""); ?>index.php/auth/login/manager"><button type="button" class="btn btn-lg btn-primary btn-label waves-effect waves-light"><i class="ri-user-line label-icon align-middle fs-16 me-2"></i> Manager portal</button></a>
                                                </div>
                                                
                                                <div class="p-lg-3 mt-4 mb-4 text-center ">
                                                   
                                                    <!-- Buttons with Label -->
                                                    <a href="<?php echo base_url(""); ?>index.php/auth/login/employee"><button type="button" class="btn btn-lg btn-primary btn-label waves-effect waves-light"><i class="ri-user-line label-icon align-middle fs-16 me-2"></i> Employeee portal</button></a>
                                                </div>
                                                
                                                <div class="p-lg-3 mt-4 mb-4 text-center ">
                                                    
                                                    <!-- Buttons with Label -->
                                                    <a href="<?php echo base_url(""); ?>index.php/auth/login/timesheet"><button type="button" class="btn btn-lg btn-primary btn-label waves-effect waves-light"><i class="ri-user-line label-icon align-middle fs-16 me-2"></i> Timesheet portal</button></a>
                                                </div>
        
                                                    
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-white">&copy;
                                BIZADMIN HR @Maintained by AARIA
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

   
</body>