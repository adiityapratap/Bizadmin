<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		  $this->load->model('generalcomp_model');
		  $this->load->model('task_model');
		  $this->load->model('config_model');
		   $this->load->model('general_model');
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	   $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	}
	
	 public function index($system_id='')
      {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
        // $this->load->model('equip_model');
        
       $conditions['is_deleted'] = 0;
 		$data['shiftLists'] = $this->common_model->fetchRecordsDynamically('Shifts_shiftlist', ['id','name','status'], $conditions);
        $allTasks =  $this->task_model->fetchTaskList(); 
        $groupedTasks = [];

       foreach ($allTasks as $task) {
        $shiftId = $task->shift_id;
        $prepId = $task->prep_id;
        $groupedTasks[$shiftId][$prepId][] = $task;
      }
      $data['groupedTasks'] = $groupedTasks;
        // echo "<pre>"; print_r($allTasks); exit;
        
         $data['todaysEnteredData'] = $this->task_model->fetchTodaysEnteredData();
        //  echo "<pre>"; print_r($data['todaysEnteredData']); exit;
         
          $emailSettings = $this->general_model->fetchSmtpSettings($this->selected_location_id,$system_id);
          if(empty($emailSettings)){
           $emailSettings = $this->general_model->fetchSmtpSettings('9999','9999');
           $this->configureSMTP($emailSettings);
          }else{
           if ($emailSettings->mail_protocol === 'smtp') {
          $this->configureSMTP($emailSettings);
          }   
          }
          if(isset($emailSettings->mail_from)){
           $this->session->set_userdata('mail_from',$emailSettings->mail_from);
          }
          
          
      	$this->load->view('general/header');
      	$this->load->view('dashboard/dashboard',$data);
      	$this->load->view('general/footer');
  
    	
        
    }
    
    public function shiftList(){
			$conditions['is_deleted'] = 0;
 		    $data['shiftLists'] = $this->common_model->fetchRecordsDynamically('Shifts_shiftlist', ['id','name','status'], $conditions);
			$this->load->view('general/header');
            $this->load->view('task/shifts',$data);
            $this->load->view('general/footer');
		}
   	public function addShift(){
		
			if(isset($this->POST['shift_name'])){
			$data = array(
			'name' => $this->POST['shift_name'],
			'location_id' => $this->selected_location_id,
			);
			
			$result = $this->common_model->commonRecordCreate('Shifts_shiftlist',$data);		
			echo "success";
			}
			
			
		}
	function change_status(){
		$data = array(
		'status' => $this->POST['status'],
		);
	  $result = $this->common_model->commonRecordUpdate('Shifts_shiftlist','id',$this->POST['id'],$data);
		 
	}
    function updateShift(){

	if(isset($this->POST['prep_name'])){
					$data = array(
						'name' => $this->POST['prep_name'],
					);
		  $result = $this->common_model->commonRecordUpdate('Shifts_shiftlist','id',$this->POST['id'],$data);
		 }
	}
	public function deleteShift(){
	    
     $result = $this->common_model->commonRecordDelete('Shifts_shiftlist',$this->POST['id'],'id');
		echo $res;
		}
    
    function saveDashboardData(){
      $json_data = file_get_contents('php://input');
      $dashboardData = array();
    if (!empty($json_data)) {
        $dashboardData = json_decode($json_data, true)[0];
    }

    $dashboardData['location_id'] = $this->selected_location_id;
    $dashboardData['date_entered'] = date("Y-m-d");
    $dashboardData['is_completed'] = 1;
    $dashboardData['attachment'] = $this->session->userdata('complianceAttachment');
    $this->generalcomp_model->updateRecordForTodays($dashboardData['task_id'],$dashboardData); 
    $this->session->unset_userdata('complianceAttachment');
    }
   
   
   function tasks(){
       
	$result = $this->task_model->fetchTaskList();
// 	echo "<pre>"; print_r($result); exit;
	$data['taskList'] = $result;
	$this->load->view('general/header');
    $this->load->view('task/taskList',$data);
    $this->load->view('general/footer');
		    
		
   }
    
    
    function history(){
         $data['site_detail'] = $this->generalcomp_model->get_allSitesForDash();
      	$this->load->view('general/header');
      	$this->load->view('dashboard/history',$data);
      	$this->load->view('general/footer');
        
    }
  function historyData(){
    $dateRange =  $this->input->post('date_range'); 
    $site_id =  $this->input->post('site_id'); 
   
    $dateParts = explode(" to ", $dateRange);

    if (count($dateParts) == 2) {
    $fromDate = date('Y-m-d',strtotime(trim($dateParts[0])));
    $toDate = date('Y-m-d',strtotime(trim($dateParts[1])));
   

    $uniqueDates = array();
    $currentDate = $fromDate;
    while ($currentDate <= $toDate) {
    $uniqueDates[] = $currentDate;
    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }      
    $data['uniqueDates'] = $uniqueDates;
      
    
       $data['weeklyHistoryData'] = $this->generalcomp_model->fetchHistoryData($fromDate,$toDate,$site_id);
    //   echo "<pre>"; print_r($data['weeklyHistoryData']); exit;
    
        $this->load->view('general/header');
      	$this->load->view('dashboard/tempHistoryDetails',$data);
      	$this->load->view('general/footer');
      	
      } else {
    // Handle invalid input or display an error message
      echo "Invalid date range format";
     }

       
    }
    
    public function uploadTemperatureAttachment()
    {
     $orzName = $this->tenantIdentifier;    
    $config['upload_path'] = './uploaded_files/'.$orzName.'/Compliance/ComplianceAttachments/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; // Add allowed file types
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 8048; // Maximum file size in KB (2MB)

    $this->load->library('upload', $config);

    $uploaded_files = [];


      // Count total files
      $countfiles = count($_FILES['userfile']['name']);
 
      // Looping all files
      for($i=0;$i<$countfiles;$i++){
 
        if(!empty($_FILES['userfile']['name'][$i])){
 
          // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['userfile']['name'][$i];
          $_FILES['file']['type'] = $_FILES['userfile']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['userfile']['error'][$i];
          $_FILES['file']['size'] = $_FILES['userfile']['size'][$i];

          // Set preference
          $config['upload_path'] = './uploaded_files/'.$orzName.'/Compliance/ComplianceAttachments/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['file']['name'][$i];
 
          //Load upload library
          $this->load->library('upload',$config); 
 
    
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
          
            // Initialize array
            $uploaded_files[$i] = $filename;
          }
        }
 
      }

 
    
   $this->session->set_userdata('complianceAttachment',serialize($uploaded_files));
    echo "Uploaded Files: " . implode(', ', $uploaded_files);
}
    public function fetchAttachmentUploadedToday(){
    $task_id =  $this->input->post('task_id');
    $result = $this->generalcomp_model->fetchAttachmentUploadedToday($task_id);
    if(isset($result[0]['attachment']) && $result[0]['attachment'] !=''){
      $attachments = unserialize($result[0]['attachment']);  
    }else{
        $attachments =  array();
    }
    echo json_encode($attachments);
    }
    
    
    
	
}