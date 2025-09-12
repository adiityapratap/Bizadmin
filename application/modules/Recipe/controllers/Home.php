<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		  $this->load->model('recipe_model');
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	}
	
	 public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
         
        $data['currentUserRoleId'] = get_logged_in_user_role($this->ion_auth,'id');
        $this->session->set_userdata('listtype', 'ingredient');
        $data['recipes'] = $this->recipe_model->recipeList($data['currentUserRoleId']);
       
        $data['isDashboard'] = true;
        $this->load->view('general/header');
        $this->load->view('Recipebuilder/recipeList', $data);
        $this->load->view('general/footer');
  
    	
        
    }
    
   
    
	
}