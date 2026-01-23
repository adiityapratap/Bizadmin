<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incident extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
       
		$this->load->model('employee_model');
		$this->load->model('auth_model');
	    $this->load->model('common_model');
        $this->location_id = $this->session->userdata('location_id') ? $this->session->userdata('location_id') : ($this->session->userdata('User_location_ids') ? $this->session->userdata('User_location_ids')[0] : null);
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
        $this->roleId = get_logged_in_user_role($this->ion_auth,'id');
        $this->roleName = get_logged_in_user_role($this->ion_auth,'name');

    }
    function incidentR($id=''){
		$data['employees'] = $this->employee_model->employeeList('1');
		$posted_data = $this->input->post();
        if (isset($posted_data) && !empty($posted_data)) {
        // Add Data
        foreach($posted_data as $key=> $value){
         ($value !='' ? $data_user[$key] = $value : '');   
        }
       $data_user['date_added'] = date('Y-m-d');
       $data_user['location_id'] = $this->location_id; 
       $this->common_model->commonRecordCreate('HR_Incident_Report',$data_user);  
        }else if($id !=''){
        // Edit Data
        $conditions = array('Incident_Report_id'=>$id);
	    $reportData = $this->common_model->fetchRecordsDynamically('HR_Incident_Report', '', $conditions);
	    $data['reportData'] = $reportData[0];
        }
        $this->load->view('general/header');
		$this->load->view('Compliance/IncidentReport/incidentR',$data);
		$this->load->view('general/footer');
    }
    
    function updateIncidentR($id){
        // Update Data
    $posted_data = $this->input->post();    
    foreach($posted_data as $key=> $value){
         ($value !='' ? $data_user[$key] = $value : '');   
        }    
    $this->common_model->commonRecordUpdate('HR_Incident_Report','Incident_Report_id',$id,$data_user);
    redirect('HR/compliance/incidentR');
    }
    
    function incidentList(){
        $conditions = array('location_id'=>$this->location_id);
        $fields = ['person_completing_report_name','Incident_Report_id','incident_date','incident_time'];
	    $data['recordLists'] = $this->common_model->fetchRecordsDynamically('HR_Incident_Report', $fields, $conditions); 
        $this->load->view('general/header');
		$this->load->view('Compliance/IncidentReport/incidentList',$data);
		$this->load->view('general/footer');  
    }
    
    function deleteRecord(){
     $this->common_model->commonRecordDelete('HR_Incident_Report', $_POST['Incident_Report_id'], 'Incident_Report_id');   
    }
    
    
}

?>