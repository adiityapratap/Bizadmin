<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {
    function __construct() {
        
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->load->model('task_model');
		$this->load->model('prep_model');
		$this->load->model('general_model');
		$this->load->model('common_model');
	   $this->selected_location_id = $this->session->userdata('location_id');
	  $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	}
	// tasklist is being fetched from home/tasks
	 public function index($system_id='')
    {   
    //   echo "In Progress...."; exit;
       
       $conditions['is_deleted'] = 0;
 		$data['prep_detail'] = $this->common_model->fetchRecordsDynamically('Shifts_prep', ['id','name','status'], $conditions);
 	    $data['shiftLists'] = $this->common_model->fetchRecordsDynamically('Shifts_shiftlist', ['id','name','status'], $conditions);
       $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);	
      	$this->load->view('general/header');
      	$this->load->view('task/taskAdd',$data);
      	$this->load->view('general/footer');
    }
    
    public function add(){
              $conditions['is_deleted'] = 0;
 		    $data['shiftLists'] = $this->common_model->fetchRecordsDynamically('Shifts_shiftlist', ['id','name','status'], $conditions);
 		    
 		    $data['prep_detail'] = $this->common_model->fetchRecordsDynamically('Shifts_prep', ['id','name','status'], $conditions);
 		    
			if(isset($this->POST['task_name'])){
			    $this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
			    $this->form_validation->set_rules('prep_id', 'Prep area', 'required');
			    
			    if ($this->form_validation->run() === TRUE) {
			        
			  
                 $timestamp = isset($this->POST['schedule_date']) ? strtotime($this->POST['schedule_date']) : '';
                 $schedule_date = ($timestamp != '' ? date("Y-m-d", $timestamp) : '');

               $shiftData = array(
        'task_name' => $this->POST['task_name'],
        'shift_id' => $this->POST['shift_id'],
        'role_id' => serialize($this->POST['role_id']),
        'schedule_date' => $schedule_date,
        'schedule_type' => isset($this->POST['schedule_type']) ? $this->POST['schedule_type'] : '',
        'schedule_dayName' => isset($this->POST['schedule_dayName']) ? $this->POST['schedule_dayName'] : '',
        'repeatWhichWeek' => isset($this->POST['repeatWhichWeek']) ? $this->POST['repeatWhichWeek'] : '',
        'task_time' => (isset($this->POST['task_time']) && !empty($this->POST['task_time'])) ? $this->POST['task_time'] : '',
        'prep_id' => isset($this->POST['prep_id']) ? $this->POST['prep_id'] : '',
        'schedule_at' => isset($this->POST['schedule_at']) ? $this->POST['schedule_at'] : '',
        'is_attchmentRequired' => (isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] == 'on') ? 1 : 0,
        'status' => 1,
        'location_id' => $this->session->userdata('location_id'),
        'created_date' => date('Y-m-d'),
    );
                 $taskId = $this->common_model->commonRecordCreate('Shifts_task',$shiftData);
                 
            if ($taskId) 
            {
                 $this->common_model->commonRecordDelete('Shift_task_roles', $taskId, 'role_id');
            }
                 
                 if (isset($this->POST['role_id']) && !empty($this->POST['role_id'])) {
                 foreach($this->POST['role_id'] as $roleId){
                 $roleData[] = ['role_id' => $roleId,'task_id' =>$taskId];
                 }
            $this->common_model->commonBulkRecordCreate('Shift_task_roles', $roleData);
            }

			 redirect('Shifts/Task/fetchTaskList', 'refresh');
			}else{
			    $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			 
			    $this->load->view('general/header');
      	        $this->load->view('task/taskAdd',$data);
      	        $this->load->view('general/footer');
			}
					
				
			}
			
			
		}
public function edit($taskId)
{
    $conditions['is_deleted'] = 0;
    $data['prep_detail'] = $this->common_model->fetchRecordsDynamically('Shifts_prep', ['id','name','status'], $conditions);
    $data['shiftLists'] = $this->common_model->fetchRecordsDynamically('Shifts_shiftlist', ['id','name','status'], $conditions);
   
    if (isset($this->POST['task_name'])) {
        $this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
    // echo "<pre>"; print_r($this->POST); exit;
        if ($this->form_validation->run() === TRUE) {

            // Safely handle schedule_date
            $schedule_date = !empty($this->POST['schedule_date']) ? date("Y-m-d", strtotime($this->POST['schedule_date'])) : '';

            // Safely handle role_id
            $role_ids = isset($this->POST['role_id']) && is_array($this->POST['role_id']) 
                ? serialize($this->POST['role_id']) 
                : serialize([]);

            $shiftData = [
                'task_name' => $this->POST['task_name'],
                'shift_id' => $this->POST['shift_id'] ?? '',
                'prep_id' => $this->POST['prep_id'] ?? '',
                'role_id' => $role_ids,
                'task_time' => $this->POST['task_time'] ?? '',
                'schedule_date' => $schedule_date,
                'schedule_type' => $this->POST['schedule_type'] ?? '',
                'schedule_dayName' => $this->POST['schedule_dayName'] ?? '',
                'repeatWhichWeek' => $this->POST['repeatWhichWeek'] ?? '',
                'schedule_at' => $this->POST['schedule_at'] ?? '',
                'is_attchmentRequired' => isset($this->POST['is_attchmentRequired']) && $this->POST['is_attchmentRequired'] === 'on' ? 1 : 0,
            ];

            // Update the task
            $this->common_model->commonRecordUpdate('Shifts_task', 'id', $taskId, $shiftData);
            
            
            if ($taskId) 
            {
             $this->common_model->commonRecordDelete('Shift_task_roles', $taskId, 'role_id');
            }
                 
                 if (isset($this->POST['role_id']) && !empty($this->POST['role_id'])) {
                 foreach($this->POST['role_id'] as $roleId){
                 $roleData[] = ['role_id' => $roleId,'task_id' =>$taskId];
                 }
            $this->common_model->commonBulkRecordCreate('Shift_task_roles', $roleData);
            }

            redirect('Shifts/Task/fetchTaskList', 'refresh');
        } else {
            $data['message'] = validation_errors() ?: 'Please enter value for required fields';
            $data['taskData'] = $this->task_model->fetchTaskList($taskId)[0];

            $this->load->view('general/header');
            $this->load->view('task/taskAdd', $data);
            $this->load->view('general/footer');
        }
    } else {
        // First time loading the form
        $data['taskData'] = $this->task_model->fetchTaskList($taskId)[0];
        $data['roles'] = get_all_roles($this->ion_auth, $this->selected_location_id);

        $this->load->view('general/header');
        $this->load->view('task/taskAdd', $data);
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
        $taskID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $taskID);
        $this->tenantDb->update('Shifts_task');
    }
    echo "success";
	}  
	
	public function deleteTask(){
	    
     $result = $this->common_model->commonRecordDelete('Shifts_task',$this->POST['id'],'id');
		echo $res;
		}
		
		public function deleteMultiple() {
        $table_name = $this->input->post('table_name');
        $selected_values = $this->input->post('selected_values');

        if (!empty($selected_values)) {
          $checklistData=$this->common_model->commonBulkRecordDelete($table_name,$selected_values);
            echo 'Success';
        } else {
            echo 'Error';
        }
    }
	
}