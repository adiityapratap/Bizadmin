<?php

class Site extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
   	     $this->load->model('site_model');
   	     $this->load->model('common_model');
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->selected_location_id = $this->session->userdata('location_id');
    }
   	public function index(){
			$data['site_detail'] = $this->site_model->get_all_sites($this->selected_location_id); 
			$this->load->view('general/header');
            $this->load->view('site/siteList',$data);
            $this->load->view('general/footer');
		}
	
	public function add(){
// 		ini_set('display_errors', 1);
			if(isset($this->POST['site_name'])){
					$site_data = array(
						'site_name' => $this->POST['site_name'],
				// 		'emailNotify' => (isset($this->POST['emailNotify']) ? 1 : 0),
				// 		'emailToNotify' => $this->POST['emailToNotify'],
						'staff_comments' => serialize($this->POST['staff_comments']),
						'manager_comments' => serialize($this->POST['manager_comments']),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_at' => date('Y-m-d'),
					);
					
			    $this->common_model->commonRecordCreate('TEMP_dishwashingSites',$site_data);
				redirect('Temp/Site', 'refresh');
			}else{
			 $data['form_type'] ='add';   
			$this->load->view('general/header');
            $this->load->view('site/siteAdd',$data);
            $this->load->view('general/footer');
			    
			}
			
			
		}
		
	
		public function edit($site_id=''){
// 		ini_set('display_errors', 1);

			if(isset($this->POST['site_name'])){
					$site_data = array(
						'site_name' => $this->POST['site_name'],
				// 		'emailNotify' => (isset($this->POST['emailNotify']) ? 1 : 0),
				// 		'emailToNotify' => $this->POST['emailToNotify'],
						'staff_comments' => serialize($this->POST['staff_comments']),
						'manager_comments' => serialize($this->POST['manager_comments']),
						'updated_date' => date('Y-m-d'),
					);
		
				
				$this->common_model->commonRecordUpdate('TEMP_dishwashingSites','id',$site_id, $site_data);
				redirect('Temp/Site', 'refresh');
			}else{
			     $condition = ['status' => 1,'location_id' => $this->selected_location_id];
               $data['site_detail'] = $this->common_model->fetchRecordsDynamically('TEMP_dishwashingSites','',$condition);
        
			 
			 $data['form_type'] ='edit';   
			$this->load->view('general/header');
            $this->load->view('site/siteAdd',$data);
            $this->load->view('general/footer');
			    
			}
			
			
		}
		
		
	function change_status(){
     $this->common_model->commonRecordDelete('TEMP_slicingSites','id',$this->POST['site_id'], $this->POST);
	 echo "success";
	}
   
   
   
    public function delete(){
       $this->common_model->commonRecordDelete('TEMP_slicingSites','id',$this->POST['id'], $this->POST);
	   echo "success";
		}
   
   
    

}
