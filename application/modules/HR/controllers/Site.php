<?php

class Site extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
   	    //  $this->load->model('site_model');
   	     $this->load->model('common_model');
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->location_id = $this->session->userdata('location_id');
    }
   	public function index(){
   	        $conditions = array('location_id' => $this->location_id, 'is_deleted' => '0');
   	        $data['site_detail'] = $this->common_model->fetchRecordsDynamically('HR_sites','',$conditions);
			
			$this->load->view('general/header');
            $this->load->view('roster/siteList',$data);
            $this->load->view('general/footer');
		}
	
	public function add(){
	
		$data = $_POST;
		$data['created_at'] = date('Y-m-d'); $data['location_id'] = $this->location_id;
	    $this->common_model->commonRecordCreate('HR_sites',$data);	
		echo "success"; exit;	
		}
		
	public function edit(){
		$data['site_name'] = $_POST['site_name'];
	   $this->common_model->commonRecordUpdate('HR_sites','id',$_POST['id'],$data);	
		echo "success"; exit;			
		}

	function change_status(){
	   	$data['status'] = $_POST['status']; 
		$this->common_model->commonRecordUpdate('HR_sites','id',$_POST['id'],$data);
	}
	 
    public function delete(){ 
        $data['is_deleted'] = 1; 
      $this->common_model->commonRecordUpdate('HR_sites','id',$_POST['id'],$data);
		echo $res;
		}
   
   
    

}
