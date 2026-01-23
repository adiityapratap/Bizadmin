<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		 
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	}
	
	 public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
           $data['file_path'] = base_url('/uploaded_files/'.$this->tenantIdentifier.'/Dms/');
           $data['currentUserRoleId'] = get_logged_in_user_role($this->ion_auth,'id');
            $data['allFolders'] = $this->common_model->fetchAllFolders();
            $dashboardData = $this->common_model->fetchDashboardData();
            $data['dashboardData'] =  $dashboardData['DocsUnderSubFolder'];
            $data['DocsWithoutSubFolder'] =  $dashboardData['DocsWithoutSubFolder'];
            // echo "<pre>"; print_r($data['DocsWithoutSubFolder']); exit;
      	$this->load->view('general/header');
      	$this->load->view('dashboard/dashboard',$data);
      	$this->load->view('general/footer');
  
    	
        
    }
    
   
    
	
}