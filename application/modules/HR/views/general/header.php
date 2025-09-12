<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover-active" data-sidebar-image="none" data-preloader="disable">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Bizadmin</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>login-assets/img/favicon.jpeg" />
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/HR/assets/css/custom.css');?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
   <meta charset="utf-8">
   
    <?php 
 // we have a common header to import all css for all the Apps like HR, Cash , Supplier etc so that css and js can be reused across all aps using common file
     $common_view_path = APPPATH . 'views/general/header.php';
     include($common_view_path);
?>
   

 <script src="<?php echo base_url('application/modules/HR/assets/js/custom.js');?>"></script>
 <style>
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none; /* Hide initially */
        }

        .spinner-border {
            width: 8rem;
            height: 8rem;
            border-width: 0.4rem;
            top: 50%;
            left: 50%;
            position: absolute;
        }
.logo-lg img{
    height: 50px;
    width: 139px;
    margin-left: 100px;
}
        }
  
    </style>
</head>
<body data-base-url="<?php echo base_url(); ?>">


    <div id="layout-wrapper">

        <?php $this->load->view('partials/menu'); ?>
        
        
 <div class="loader-container" id="loaderContainer">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
</div>
       
      
       
      