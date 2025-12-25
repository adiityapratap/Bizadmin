<?php

class Prep extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
      	 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
   	     $this->load->model('general_model');
   	     $this->load->model('prep_model');
   	     $this->load->model('temp_model');
   	     $this->load->model('common_model');
        $this->load->model('site_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->selected_location_id = $this->session->userdata('location_id');
    }
   	public function index(){
			$data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
// 			echo "<pre>"; print_r($data['prep_detail']); exit;
			$data['site_detail'] = $this->temp_model->get_allActive_sites(); 
			$this->load->view('general/header');
            $this->load->view('prep/prepList',$data);
            $this->load->view('general/footer');
		}
	public function add(){
// 		ini_set('display_errors', 1);
			if(isset($this->POST['prep_name'])){
					$site_data = array(
						'prep_name' => $this->POST['prep_name'],
						'site_id' => (isset($this->POST['site_id']) ? $this->POST['site_id'] : ''),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_at' => date('Y-m-d'),
					);
				$this->common_model->commonRecordCreate('TEMP_dishwashingPrepArea',$site_data);	
					$result = $this->prep_model->add_site($site_data);
			echo "success";
			}
			
			
		}
		
	
		public function edit($site_id=''){
// 		ini_set('display_errors', 1);
	
			if(isset($this->POST['site_name'])){
					$site_data = array(
						'prep_name' => $this->POST['prep_name'],
						'site_id' => (isset($this->POST['site_id']) ? $this->POST['site_id'] : ''),
						'updated_date' => date('Y-m-d'),
					);
		$this->common_model->commonRecordUpdate('TEMP_dishwashingPrepArea','id',$site_id, $site_data);

			}

		}
		
		
	function change_status(){

		$this->prep_model->change_status($this->POST);
	}
   function updatePrep(){
	$this->common_model->commonRecordUpdate('TEMP_dishwashingPrepArea','id',$this->POST['id'], $this->POST);
	
	}
	
  public function updateSortOrder(){
	 
	 $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $equipID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $equipID);
        $this->tenantDb->update('TEMP_dishwashingPrepArea');
    }
    echo "success";
	}  	
   
   
   
    public function delete(){
        $this->POST['status'] =0; $this->POST['is_deleted'] = 1;
        $this->common_model->commonRecordUpdate('TEMP_dishwashingPrepArea','id',$this->POST['id'], $this->POST);
    
		echo 'succeess';
		}
   
   
    

}
