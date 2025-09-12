<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover-active" data-sidebar-image="none" data-preloader="disable">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>BIZADMIN HR</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>hr-assets/images/logo/favicon.jpg" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
   <script src="https://www.cafeadmin.com.au/haccap/assets/js/jquery-1.9.1.min.js"></script>
  <!-- glightbox css -->
        <link rel="stylesheet" href="<?php echo base_url(""); ?>hr-assets/libs/glightbox/css/glightbox.min.css">
    <!-- Sweet Alert css-->
    <link href="<?php echo base_url(""); ?>hr-assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    
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
   <!-- script file for fingerprint-->
  <!--<script src="<?php echo base_url(); ?>assets/js/scripts/CloudABIS-ScanR.js"></script>-->
  <!--<script src="<?php //echo base_url(); ?>assets/js/scripts/CloudABIS-Helper.js"></script>-->
    
    
   <script type="text/javascript">  
    $(document).ready(function() {
      
        //set cookie for fingerprint device setup
         var engineName = "FPFF02";
            var deviceName = "Secugen";
            var templateFormat = "ISO";
            setCookie("CSDeviceName", deviceName, 7);
                setCookie("CABEngineName", engineName, 7);
                setCookie("CSTempalteFormat", templateFormat, 7);
                
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
    } );
  </script>
  
  
</head>
<body>
<?php $role = $this->session->userdata('role'); 

    $CI =& get_instance();
    $CI->load->model('admin_model');
    if($role=='employee') {
        $notifications = $CI->admin_model->fetch_employee_notifications();
       $notifications_count = $CI->admin_model->fetch_notifications_count_emp();
    }else if($role !=''){
        $notifications = $CI->admin_model->fetch_manager_notifications();  
        $notifications_count = $CI->admin_model->fetch_notifications_count();
    }
?> 
	<!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <?php   $role = $this->session->userdata('role'); if($role=='employee') { $logopath = "general/dashboard"; }else{ $logopath = "general"; } ?>
                        <a href="<?php echo base_url(); ?>index.php/<?php echo $logopath; ?>" class="logo logo-dark">
                        
                        <span class="logo-sm">
                            <img src="<?php echo base_url() ?>hr-assets/images/logo/BizAdmin-Logo.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url() ?>hr-assets/images/logo/BizAdmin-Logo.png" alt="" height="25">
                        </span>
                    </a>

                    
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

            </div>
            <div class="app-menu navbar-menu mx-3">
                <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <?php 
                            if(!empty($menus)){  
                            $user_id = $this->session->userdata('user_id');
                           $countmenu=1;
                            $userlevel = $this->session->userdata('clearance_level');
                            foreach($menus as $menu){ 
                              
                        
                            if($this->session->userdata('role') != 'Prep Area'){
                        ?>
                        <li class="nav-item">
                            <?php if(!empty($menu->submenus)){ ?>
                            <a class="nav-link menu-link" href="#sidebar_<?php echo $countmenu;?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <span class="d-flex"><span data-key="t-dashboards" class="fs-11"><?php echo Strtoupper($menu->description); ?></span></span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebar_<?php echo $countmenu;?>">
                                <ul class="nav nav-sm flex-column">
                                    <?php foreach($menu->submenus as $submenu){  ?>
                     
                                    <?php 
                                    if($user_id == 265 || $user_id == 266){ 
                                    if(($submenu->submenu_id != 45 && $submenu->submenu_id != 57 )){ ?>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" class="nav-link" data-key="t-analytics"> <?php echo $submenu->description; ?> </a>
                                    </li>
                                     <?php } } else{ ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" class="nav-link" data-key="t-crm"> <?php echo $submenu->description; ?> </a>
                                    </li>
                                         
                                    <?php } ?>
                                      
                                        <?php }  ?>
                                   
                                </ul>
                            </div>
                            <?php  }else { ?>
                            <a class="nav-link menu-link" href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>">
                                <span class="d-flex"> <span data-key="t-dashboards" class="fs-11"><?php echo Strtoupper($menu->description); ?></span></span>
                            </a>
                            <?php } }?>
                            
                           
                        </li> <!-- end Dashboard Menu -->
                         <?php $countmenu++; } } ?>
                        

                    </ul>
            </div>
             <div class="d-flex align-items-center">
                <ul  class="navbar-nav dropdown ms-sm-3 header-item ">
                    <?php if($role != 'employee') { ?>
                    <li class="nav-item">
                           
                            <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" role="button" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                   
                                    <span class="text-start ms-xl-2">
                                       
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><i class="mdi mdi-google-maps fs-12"></i> <?php echo $this->session->userdata('branch_name');?></span>
                                    </span>
                                </span>
                            </a>
                          
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                            
            
                            <a class="nav-link menu-link" href="#notification" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="notification">
                                <span class="d-flex align-items-center">
                                    <i class="bx bx-bell fs-22"></i>
                                    <?php if(!empty( $notifications_count[0]['total_count'])){ ?><span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?php  echo $notifications_count[0]['total_count']; ?><span class="visually-hidden">unread messages</span></span><?php } ?>
                                </span>
                            </a>
                            <?php  if(!empty($notifications)) { ?>
                            <div class="collapse menu-dropdown dropdown-menu-end" id="notification">
                                <ul class="nav nav-sm flex-column p-3">
                                    <?php foreach($notifications as $notification){  ?>
                                    <li class="nav-item">
                                        <h6 class="dropdown-header"><?php  echo $notification->description;    ?></h6>
                                      
                                    </li>
                                    <?php  }  ?>
                                </ul>
                            </div>
                            <?php  } ?>
                    </li>
                    <li class="nav-item">
                           
                            <a class="nav-link menu-link" href="#userDropdown" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <span class="d-flex align-items-center">
                                    <i class="bx bxs-user-circle fs-24"></i>
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $this->session->userdata('username');?></span>
                                    </span>
                                </span>
                            </a>
                            <div class="collapse menu-dropdown dropdown-menu-end" id="userDropdown">
                                <ul class="nav nav-sm flex-column p-3">
                                  
                                    <li class="nav-item">
                                        <h6 class="dropdown-header">Welcome <?php echo $this->session->userdata('username');?>!</h6>
                                        <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/auth/logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                                    </li>
                                </ul>
                            </div>
                    </li>
                    </ul>
                                    
                
            </div>
           
           
        </div>
        <!-- <div class="app-menu navbar-menu">-->
        <!--     <div id="scrollbar">-->
        <!--        <div class="">-->

        <!--            <div id="two-column-menu">-->
        <!--            </div>-->
                    
        <!--        </div>-->
                <!-- Sidebar -->
        <!--    </div>-->
        <!--</div>-->
    </div>
</header>
         <!-- ========== App Menu ========== -->
       
      