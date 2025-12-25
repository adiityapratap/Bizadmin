<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contractors extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
      
		$this->load->model('employee_model');
		$this->load->model('auth_model');
	    $this->load->model('common_model');
        $this->location_id = $this->session->userdata('location_id');
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');

    }
    
  
	
	function addEditContractor($id=''){
	    
      $userId = $this->ion_auth->get_user_id();
	  $data['locations'] = $this->auth_model->fetchLocationsFromUserId($userId);
	  $this->load->view('general/header');
	  $conditionsStress = array('status'=>'1','is_deleted'=>'0');
	  $data['positions'] = $this->common_model->fetchRecordsDynamically('HR_emp_position', '', $conditionsStress);
	  if($id !=''){
	  $conditions = array('emp_id'=>$id);
	  $conditionsDocs = array('contractorId'=>$id);
	  $contractorData = $this->common_model->fetchRecordsDynamically('HR_employee', '', $conditions);
	  $data['contractorDocs'] = $this->common_model->fetchRecordsDynamically('HR_contractorsToDocs', '', $conditionsDocs);
	  $data['empPositionAndRatesData'] = $this->common_model->fetchRecordsDynamically('HR_emp_to_position', '', $conditions);
	 
	  $locationIdsArray = unserialize($contractorData[0]['location_ids']);  
	  $data['locationIdsArray'] = $locationIdsArray; 
	  $data['contractor'] = $contractorData[0];
	  $this->load->view('employee/editContractor',$data);
	  }else{
	   $this->load->view('employee/addContractor',$data);   
	  }
	  $this->load->view('general/footer');
	  
	}
	
	function submitContractorForm(){
	    
	    $posted_data = $this->input->post();

        $excludedValues = array('locationIds','rate','Saturday_rate','Sunday_rate','holiday_rate','position_id','position_unique_id','positionIdToRemove');
        foreach($posted_data as $key=> $value){
        ($value !='' && !in_array($key,$excludedValues) ? $data[$key] = $value : '');   
        }
        
        $data['created_at'] = date("Y-m-d");
        $data['status'] = 1;
        $data['location_id'] = $this->location_id;
        if(isset($_POST['locationIds']) && !empty($_POST['locationIds'])){
        $data['location_ids'] = serialize($_POST['locationIds']);    
        }
        
        $contractorId = $this->employee_model->addUpdateContractor($data);
       $contractorId = isset($contractorId) && $contractorId !='' ? $contractorId : $_POST['emp_id'];

$positionResponses = array();

if(isset($_POST['position_id']) && !empty($_POST['position_id'])){
 foreach($_POST['position_id'] as $index => $positionid){
    $positionRatesData = array();
    $positionRatesData['emp_id'] = $contractorId;
    $positionRatesData['position_id'] = $positionid;
    $positionRatesData['rate'] = isset($_POST['rate'][$index]) ? $_POST['rate'][$index] : 0;
    $positionRatesData['Saturday_rate'] = isset($_POST['Saturday_rate'][$index]) ? $_POST['Saturday_rate'][$index] : 0;
    $positionRatesData['Sunday_rate'] = isset($_POST['Sunday_rate'][$index]) ? $_POST['Sunday_rate'][$index] : 0;
    $positionRatesData['holiday_rate'] = isset($_POST['holiday_rate'][$index]) ? $_POST['holiday_rate'][$index] : 0;

    if(isset($_POST['position_unique_id'][$index])){
        $this->common_model->commonRecordUpdate('HR_emp_to_position', 'id', $_POST['position_unique_id'][$index], $positionRatesData);
        $uniqueId = $_POST['position_unique_id'][$index];
    } else {
        $uniqueId = $this->common_model->commonRecordCreate('HR_emp_to_position', $positionRatesData);
        // echo $uniqueId;  exit;
    }

    $positionResponse = array();
    $positionResponse['id'] = $uniqueId;
    $positionResponse['position_id'] = $positionid;
    $positionResponse['contractor_id'] = $contractorId; // Add contractor_id here

    $positionResponses[] = $positionResponse;
}   
}


if (empty($positionResponses)) {
    $positionResponses[] = array('contractor_id' => $contractorId);
}

if (!empty($positionResponses)) {
    $positionResponses[0]['contractor_id'] = $contractorId;
}

        
    if(isset($_POST['locationIds']) && !empty($_POST['locationIds'])){
	 foreach($_POST['locationIds'] as $locationId){
	  $locData = array(
			'location_id' => $locationId,
			'empId' => $contractorId,
			);
      $this->employee_model->allocateLocationToEmployee($locData);  			
	     }
	 }
        
    $response['positionAddedDetails'] = $positionResponses;
		echo json_encode($response);   
	}
	
	function uploadContractorDocs(){
	   
       $data = array();

       $config['upload_path'] = './uploaded_files/'.$this->tenantIdentifier.'/HR/OtherFiles';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|jpeg';
        $config['max_size'] = '10000'; // max_size in kb
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);

        $file_names = $this->input->post('file_name');
        $docIds = $this->input->post('doc_ids');
       $contractorId = $this->input->post('emp_id');
        // Loop through each file
        $files = $_FILES['userfile'];
        $file_count = count($files['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $_FILES['userfile'] = array(
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            );
            $file_data = array(
             'contractorId' => $contractorId,
             'document_name' => $file_names[$i],
                );

            if (!$this->upload->do_upload('userfile')) {
                $data['error'][$i] = $this->upload->display_errors();
            } else {
                $file_info = $this->upload->data();
                $data['file_info'][$i] = $file_info;
                 $file_data['UploadedNewName'] = $file_info['file_name'];
            }
      if($docIds[$i]){ 
        $this->common_model->commonRecordUpdate('HR_contractorsToDocs','id',$docIds[$i],$file_data);    
        }else{
      $this->common_model->commonRecordCreate('HR_contractorsToDocs',$file_data);         
        }
            
        }
        echo json_encode($file_data);
    
	}
	

    
}
    ?>