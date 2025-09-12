<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {
    function __construct() {
        
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->load->model('task_model');
		$this->load->model('prep_model');
		$this->load->model('general_model');
	   $this->selected_location_id = $this->session->userdata('location_id');
	  $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	}
	
	 public function index($system_id='')
    {   
    //   echo "In Progress...."; exit;
       $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
       $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);	
      	$this->load->view('general/header');
      	$this->load->view('task/taskAdd',$data);
      	$this->load->view('general/footer');
    }
    
    public function add(){

			if(isset($this->POST['task_name'])){
			    $this->form_validation->set_rules('task_name', 'Equipment name', 'trim|required');
			    $this->form_validation->set_rules('prep_id', 'Prep area', 'required');
			    
			    if ($this->form_validation->run() === TRUE) {
			    foreach($this->POST['task_time'] as $taskTime){
			       $timestamp =  (isset($this->POST['schedule_date']) ? strtotime($this->POST['schedule_date']) : '');
                   $schedule_date = ($timestamp !='' ? date("Y-m-d", $timestamp) : '');
                   
			       $equip_data = array(
						'task_name' => $this->POST['task_name'],
						'role_id' => serialize($this->POST['role_id']),
						'schedule_date' => $schedule_date,
						'schedule_type' => (isset($this->POST['schedule_type']) ? $this->POST['schedule_type'] : ''),
						'schedule_dayName' => (isset($this->POST['schedule_dayName']) ? $this->POST['schedule_dayName'] : ''),
						'repeatWhichWeek' => (isset($this->POST['repeatWhichWeek']) ? $this->POST['repeatWhichWeek'] : ''),
						'task_time' => $taskTime,
						'prep_id' => (isset($this->POST['prep_id']) ? $this->POST['prep_id'] : ''),
						'schedule_at' => $this->POST['schedule_at'],
						'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] == 'on' ? 1 : 0),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
				// 	echo "<pre>"; print_r($equip_data); exit;
					$result = $this->task_model->add_task($equip_data);
					
			    }
			    redirect('Clean/Task/fetchTaskList', 'refresh');
			}else{
			    $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			   $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
			    
			    $this->load->view('general/header');
      	        $this->load->view('task/taskAdd',$data);
      	        $this->load->view('general/footer');
			}
					
				
			}
			
			
		}
		
		 public function edit($id){
		   if(isset($this->POST['task_name'])){
		      
		       $this->form_validation->set_rules('task_name', 'Equipment name', 'trim|required');
			    
			   
		       if ($this->form_validation->run() === TRUE){
		           $count = 0;
		           foreach($this->POST['task_time'] as $taskTime){
		               $timestamp =  (isset($this->POST['schedule_date']) ? strtotime($this->POST['schedule_date']) : '');
                       $schedule_date = ($timestamp !='' ? date("Y-m-d", $timestamp) : '');
		              if($count == 0 ){ 
		              $equip_data = array(
						'task_name' => $this->POST['task_name'],
						'role_id' => serialize($this->POST['role_id']),
						'task_time' => $taskTime,
						'schedule_date' => $schedule_date,
						'schedule_type' => (isset($this->POST['schedule_type']) ? $this->POST['schedule_type'] : ''),
						'schedule_dayName' => (isset($this->POST['schedule_dayName']) ? $this->POST['schedule_dayName'] : ''),
						'repeatWhichWeek' => (isset($this->POST['repeatWhichWeek']) ? $this->POST['repeatWhichWeek'] : ''),
						'prep_id' => (isset($this->POST['prep_id']) ? $this->POST['prep_id'] : ''),
						'schedule_at' => (isset($this->POST['schedule_at']) ? $this->POST['schedule_at'] : ''),
						'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] == 'on' ? 1 : 0),
					 );   
			       $result = $this->general_model->updateDataInOrzDb('CLEAN_tasks','id',$id,$equip_data);	
		              }else{
		               
		               $equip_data = array(
						'task_name' => $this->POST['task_name'],
					 	'task_time' => $taskTime,
					    'role_id' => serialize($this->POST['role_id']),
						'prep_id' => (isset($this->POST['prep_id']) ? $this->POST['prep_id'] : ''),
						'schedule_at' => $this->POST['schedule_at'],
						'schedule_type' => (isset($this->POST['schedule_type']) ? $this->POST['schedule_type'] : ''),
						'schedule_dayName' => (isset($this->POST['schedule_dayName']) ? $this->POST['schedule_dayName'] : ''),
						'repeatWhichWeek' => (isset($this->POST['repeatWhichWeek']) ? $this->POST['repeatWhichWeek'] : ''),
						'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) ? $this->POST['is_attchmentRequired'] : ''),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
					$result = $this->task_model->add_task($equip_data);   
		                  
		                  
		              }
			    
			    
			    $count++;
		           }
		 
		  redirect('Clean/Task/fetchTaskList', 'refresh');
		       }else{
		           $data['message'] = (validation_errors()) ? validation_errors() : 'Please enter value for required fields';
		           $data['taskData'] = $this->task_model->fetchTaskList($id)[0];
		           $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
		  // echo "<pre>"; print_r($data); exit;
		$this->load->view('general/header');
      	$this->load->view('task/taskAdd',$data);
      	$this->load->view('general/footer');  
      	
      	
		       }
		   }else{
		$data['taskData'] = $this->task_model->fetchTaskList($id)[0];
	   $data['prep_detail'] = $this->prep_model->fetchAllPrepArea();
	  $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);	
		  // echo "<pre>"; print_r($data['taskData']); exit;
		$this->load->view('general/header');
      	$this->load->view('task/taskAdd',$data);
      	$this->load->view('general/footer');    
		   }
	
  
		 }
		
		public function fetchTaskList(){
		  $result = $this->task_model->fetchTaskList();
		  $data['taskList'] = $result;
		 $this->load->view('general/header');
      	$this->load->view('task/taskList',$data);
      	$this->load->view('general/footer');
		    
		}
		
		public function updateSortOrder(){
	 
	 $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $equipID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $equipID);
        $this->tenantDb->update('CLEAN_tasks');
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