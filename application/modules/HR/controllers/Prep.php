<?php

class Prep extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
      	 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
   	     $this->load->model('general_model');
   	     $this->load->model('roster_model');
   	     $this->load->model('common_model');
        // $this->load->model('site_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->location_id = $this->session->userdata('location_id');
    }
   	public function index(){
			
			$conditions = array('location_id' => $this->location_id, 'is_deleted' => '0','status' => '1');
   	        
   	        $data['prep_detail'] = $this->roster_model->fetchAllPrepArea();
   	        $data['site_detail'] = $this->common_model->fetchRecordsDynamically('HR_sites','',$conditions);
		
			$this->load->view('general/header');
            $this->load->view('roster/prepList',$data);
            $this->load->view('general/footer');
		}
	public function add(){
		
		$data = $_POST;
		$data['created_at'] = date('Y-m-d'); $data['location_id'] = $this->location_id;
	    $this->common_model->commonRecordCreate('HR_prepArea',$data);	
		echo "success"; exit;	
			
			
		}
		
	
		public function edit($site_id=''){
		ini_set('display_errors', 1);
	
			if(isset($this->POST['site_name'])){
					$site_data = array(
						'prep_name' => $this->POST['prep_name'],
						'site_id' => (isset($this->POST['site_id']) ? $this->POST['site_id'] : ''),
						'updated_date' => date('Y-m-d'),
					);
		
				$result = $this->prep_model->update_site($site_data,$site_id);	
				
			
			}
			
			
		}
		
		
	function change_status(){

		$this->prep_model->change_status($this->POST);
	}
   function updatePrep(){
    //   echo "<pre>"; print_r($this->POST); exit;
      $this->common_model->commonRecordUpdate('HR_prepArea','id',$this->POST['id'],$this->POST);
// 		$this->prep_model->updatePrep($this->POST,$this->POST['id']);
	}
	
  public function updateSortOrder(){
	 
	 $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $equipID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $equipID);
        $this->tenantDb->update('TEMP_prepArea');
    }
    echo "success";
	}  	
   
   
   
    public function delete(){
       $data['is_deleted'] = 1; 
      $this->common_model->commonRecordUpdate('HR_prepArea','id',$_POST['id'],$data);
		echo $res;
		}
   
   
    

}
