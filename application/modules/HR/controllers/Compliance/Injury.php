<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Injury extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
       
		$this->load->model('employee_model');
		$this->load->model('auth_model');
	    $this->load->model('common_model');
        $this->location_id = $this->session->userdata('location_id') ? $this->session->userdata('location_id') : ($this->session->userdata('User_location_ids') ? $this->session->userdata('User_location_ids')[0] : null);
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
        $this->roleId = get_logged_in_user_role($this->ion_auth,'id');

    }
    function InjuryR($id=''){
        
		$data['employees'] = $this->employee_model->employeeList('1');
		$posted_data = $this->input->post();
        if (isset($posted_data) && !empty($posted_data)) {
        // Add Data
        foreach($posted_data as $key=> $value){
         ($value !='' ? $data_user[$key] = $value : '');   
        }
       if(isset($_FILES) && !empty($_FILES['userfile']['name'][0])){ 
        $uploadPath = './uploaded_files/'.$this->tenantIdentifier.'/HR/CompliancesForm';
        $uploadedFileName = $this->common_model->uploadAttachment($_FILES, $uploadPath);
        $data_user['injury_file'] = $uploadedFileName;
       }
       $data_user['date_added'] = date('Y-m-d');
       $data_user['location_id'] = $this->location_id; 

       $this->common_model->commonRecordCreate('HR_Injury_Report',$data_user); 
       redirect('HR/compliance/InjuryR');
        }else if($id !=''){
            // Edit Data
        $conditions = array('Injury_Report_id'=>$id);
	    $reportData = $this->common_model->fetchRecordsDynamically('HR_Injury_Report', '', $conditions);
	    $data['reportData'] = $reportData[0];
        }
        $this->load->view('general/header');
		$this->load->view('Compliance/InjuryReport/injuryR',$data);
		$this->load->view('general/footer');
    }
    
    function updateInjuryR($id){
    // Update Data
    
    $posted_data = $this->input->post();    
    foreach($posted_data as $key=> $value){
         ($value !='' ? $data_user[$key] = $value : '');   
        } 
    if(isset($_FILES) && !empty($_FILES['userfile']['name'][0])){ 
    $uploadPath = './uploaded_files/'.$this->tenantIdentifier.'/HR/CompliancesForm';
    $uploadedFileName = $this->common_model->uploadAttachment($_FILES, $uploadPath);
    $data_user['injury_file'] = $uploadedFileName;
    }    
    $this->common_model->commonRecordUpdate('HR_Injury_Report','Injury_Report_id',$id,$data_user);
    redirect(base_url('/HR/compliance/injuryR'));
    }
    
    function injuryList(){
        $conditions = array('location_id'=>$this->location_id);
        $fields = ['work_area','Injury_Report_id','injury_date','injury_time'];
	    $data['reportLists'] = $this->common_model->fetchRecordsDynamically('HR_Injury_Report', $fields, $conditions); 
        $this->load->view('general/header');
		$this->load->view('Compliance/InjuryReport/injuryList',$data);
		$this->load->view('general/footer');  
    }
    
    function deleteRecord(){
     $this->common_model->commonRecordDelete('HR_Injury_Report', $_POST['Injury_Report_id'], 'Injury_Report_id');   
    }
    
    
}

?>