<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
			$this->load->model('supplier_model');
	   $this->location_id = $this->session->userdata('location_id');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	}
	
	 public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
     
        $data['areaList'] = $this->admin_model->fetchArea($this->location_id);
        $data['suppliers_list']  = $this->supplier_model->getSuppliers();

      	$this->load->view('general/header');
      	$this->load->view('Admin/areaList',$data);
      	$this->load->view('general/footer');

    }
    
     public function manageArea($type=""){
        
         if($type == 'edit'){
             $id = $_POST['id'];
           $result = $this->admin_model->updateArea($id,$_POST);
                echo "success";
        }else if($type == 'add'){
          $result = $this->admin_model->addArea($this->location_id,$_POST);
                echo "success";
        }
    }
    public function AreaStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status=='delete'){
         $data = array( 'is_deleted' => 1  );   
        }else{
         $data =array( 'status' => $status  );   
        }
        
          
        $result = $this->admin_model->AreaStatus($id,$data);
    }
    
	
}