<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equip extends MY_Controller {
    function __construct() {
        
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->load->model('equip_model');
		$this->load->model('prep_model');
		$this->load->model('general_model');
	   $this->selected_location_id = $this->session->userdata('location_id');
	  $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	}
	
	 public function index($system_id='')
    {   
    //   echo "In Progress...."; exit;
       $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
      	$this->load->view('general/header');
      	$this->load->view('equip/equipAdd',$data);
      	$this->load->view('general/footer');
    }
    
    public function add(){
// 		ini_set('display_errors', 1);
			if(isset($this->POST['equip_name'])){
			    $this->form_validation->set_rules('equip_name', 'Equipment name', 'trim|required');
			    $this->form_validation->set_rules('prep_id', 'Prep area', 'required');
			    
			    if ($this->form_validation->run() === TRUE) {
			    foreach($this->POST['equip_time'] as $equipTime){
			       $timestamp =  (isset($this->POST['schedule_date']) ? strtotime($this->POST['schedule_date']) : '');
                   $schedule_date = ($timestamp !='' ? date("Y-m-d", $timestamp) : '');
                   
			       $equip_data = array(
						'equip_name' => $this->POST['equip_name'],
						'mailFrequency' => (isset($this->POST['mailFrequency']) ? $this->POST['mailFrequency'] : ''),
						'schedule_date' => $schedule_date,
						'equip_time' => $equipTime,
						'temp_min' => $this->POST['temp_min'],
						'temp_max' => $this->POST['temp_max'],
						'prep_id' => (isset($this->POST['prep_id']) ? $this->POST['prep_id'] : ''),
						'schedule_at' => $this->POST['schedule_at'],
						'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] == 'on' ? 1 : 0),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
				// 	echo "<pre>"; print_r($equip_data); exit;
					$result = $this->equip_model->add_equip($equip_data);
					
			    }
			    redirect('Temp/Equip/fetchEquipList', 'refresh');
			}else{
			    $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			   $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
			    
			    $this->load->view('general/header');
      	        $this->load->view('equip/equipAdd',$data);
      	        $this->load->view('general/footer');
			}
					
				
			}
			
			
		}
		
		 public function edit($id){
		   if(isset($this->POST['equip_name'])){
		      
		       $this->form_validation->set_rules('equip_name', 'Equipment name', 'trim|required');
			    
			   
		       if ($this->form_validation->run() === TRUE){
		           $equipTimes = isset($this->POST['equip_time']) && is_array($this->POST['equip_time']) ? $this->POST['equip_time'] : [null];
$count = 0;

foreach ($equipTimes as $equipTime) {
    $timestamp = isset($this->POST['schedule_date']) ? strtotime($this->POST['schedule_date']) : '';
    $schedule_date = ($timestamp != '' ? date("Y-m-d", $timestamp) : '');

    if ($count == 0) {
        $equip_data = array(
            'equip_name' => $this->POST['equip_name'],
            'mailFrequency' => isset($this->POST['mailFrequency']) ? $this->POST['mailFrequency'] : '',
            'equip_time' => $equipTime,
            'schedule_date' => $schedule_date,
            'prep_id' => isset($this->POST['prep_id']) ? $this->POST['prep_id'] : '',
            'temp_min' => isset($this->POST['temp_min']) ? $this->POST['temp_min'] : '',
            'temp_max' => isset($this->POST['temp_max']) ? $this->POST['temp_max'] : '',
            'schedule_at' => isset($this->POST['schedule_at']) ? $this->POST['schedule_at'] : '',
            'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] == 'on') ? 1 : 0,
        );
        $result = $this->general_model->updateDataInOrzDb('TEMP_eqipment', 'id', $id, $equip_data);
    } else {
        $equip_data = array(
            'equip_name' => $this->POST['equip_name'],
            'equip_time' => $equipTime,
            'temp_min' => isset($this->POST['temp_min']) ? $this->POST['temp_min'] : '',
            'temp_max' => isset($this->POST['temp_max']) ? $this->POST['temp_max'] : '',
            'prep_id' => isset($this->POST['prep_id']) ? $this->POST['prep_id'] : '',
            'schedule_at' => isset($this->POST['schedule_at']) ? $this->POST['schedule_at'] : '',
            'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] == 'on') ? 1 : 0,
            'status' => 1,
            'location_id' => $this->session->userdata('location_id'),
            'created_date' => date('Y-m-d'),
        );
        $result = $this->equip_model->add_equip($equip_data);
    }

    $count++;
}

		 
		        redirect('Temp/Equip/fetchEquipList', 'refresh');
		       }else{
		           $data['message'] = (validation_errors()) ? validation_errors() : 'Please enter value for required fields';
		           $data['equpData'] = $this->equip_model->fetchEquipList($id)[0];
		           $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
		  // echo "<pre>"; print_r($data); exit;
		$this->load->view('general/header');
      	$this->load->view('equip/equipAdd',$data);
      	$this->load->view('general/footer');  
      	
      	
		       }
		   }else{
		$data['equpData'] = $this->equip_model->fetchEquipList($id)[0];
	$data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
		  // echo "<pre>"; print_r($data); exit;
		$this->load->view('general/header');
      	$this->load->view('equip/equipAdd',$data);
      	$this->load->view('general/footer');    
		   }
	
  
		 }
		
		public function fetchEquipList(){
		  $result = $this->equip_model->fetchEquipList();
		    	$data['EquipList'] = $result;
		    $this->load->view('general/header');
      	$this->load->view('equip/EquipList',$data);
      	$this->load->view('general/footer');
		    
		}
		
		public function updateSortOrder(){
	 
	 $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $equipID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $equipID);
        $this->tenantDb->update('TEMP_eqipment');
    }
    echo "success";
	}  
	
		
		public function deleteMultiple() {
        $table_name = $this->input->post('table_name');
        $selected_values = $this->input->post('selected_values');

        if (!empty($selected_values)) {
          $checklistData=$this->general_model->deleteMultiple($table_name,$selected_values);
            echo 'Success';
        } else {
            echo 'Error';
        }
    }
	
}