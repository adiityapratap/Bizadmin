<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reimbursement extends MY_Controller {

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
    function reimbursementForm($id=''){

		$posted_data = $this->input->post();
        if (isset($posted_data) && !empty($posted_data)) {
        // Add Data
        foreach($posted_data as $key=> $value){
         ($value !='' ? $data_user[$key] = $value : '');   
        }
       if(isset($_FILES) && !empty($_FILES)){
        $uploadPath = './uploaded_files/'.$this->tenantIdentifier.'/HR/CompliancesForm';
        $uploadedFileName = $this->common_model->uploadAttachment($_FILES, $uploadPath);
        $data_user['receipt'] = $uploadedFileName;
       }
       $data_user['date_added'] = date('Y-m-d');
       $data_user['location_id'] = $this->location_id; 

       $this->common_model->commonRecordCreate('HR_Employee_reimbursement',$data_user); 
       redirect('HR/compliance/reimbursementR');
        }else if($id !=''){
        // Edit Data
        $conditions = array('Employee_reimbursement_id'=>$id);
	    $reportData = $this->common_model->fetchRecordsDynamically('HR_Employee_reimbursement', '', $conditions);
	    $data['formData'] = $reportData[0];
        }
        $this->load->view('general/header');
		$this->load->view('Compliance/Reimbursement/reimbursementForm',$data);
		$this->load->view('general/footer');
    }
    
    function updateResignationL($id){
    // Update Data
    $posted_data = $this->input->post();    
    foreach($posted_data as $key=> $value){
         ($value !='' ? $data_user[$key] = $value : '');   
        } 
    if(isset($_FILES) && !empty($_FILES['userfile']['name'][0])){ 
     $uploadPath = './uploaded_files/'.$this->tenantIdentifier.'/HR/CompliancesForm';
     $uploadedFileName = $this->common_model->uploadAttachment($_FILES, $uploadPath);
     $data_user['receipt'] = $uploadedFileName;
    }    
    $this->common_model->commonRecordUpdate('HR_Employee_reimbursement','Employee_reimbursement_id',$id,$data_user);
    redirect(base_url('/HR/compliance/reimbursementR'));
    }
    
    function reimbursementList(){
        
        $conditions = array('location_id'=>$this->location_id);
        $fields = ['emp_name','Employee_reimbursement_id','completed_date'];
	    $data['reportLists'] = $this->common_model->fetchRecordsDynamically('HR_Employee_reimbursement', $fields, $conditions); 
	  
        $this->load->view('general/header');
		$this->load->view('Compliance/Reimbursement/reimbursementList',$data);
		$this->load->view('general/footer');  
        
    }
    
    function deleteRecord(){
     $this->common_model->commonRecordDelete('HR_Employee_reimbursement', $_POST['Employee_reimbursement_id'], 'Employee_reimbursement_id');   
    }
    
    
}

?>