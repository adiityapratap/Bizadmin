<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
       
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // $this->load->helper('notification');
		$this->load->model('employee_model');
		$this->load->model('auth_model');
	    $this->load->model('common_model');
        $this->location_id = $this->session->userdata('location_id') ? $this->session->userdata('location_id') : ($this->session->userdata('User_location_ids') ? $this->session->userdata('User_location_ids')[0] : null);
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
        $this->roleId = get_logged_in_user_role($this->ion_auth,'id');
        // $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
     
    }
    
    function requestLeave(){
      $uploadPath='./uploaded_files/'.$this->tenantIdentifier.'/HR/MedicalCertificate';
      $uploadedFileName = $this->common_model->uploadAttachment($_FILES,$uploadPath);
      $data = $_POST;
      $data['medical_certificate'] = $uploadedFileName;
      $data['leave_status'] = 1;
      $data['location_id'] = $this->location_id;
      $data['start_date'] = date('Y-m-d',strtotime($_POST['start_date'])); 
      $data['end_date'] = date('Y-m-d',strtotime($_POST['end_date'])); 
      $data['date_added'] = date('Y-m-d');
      $leaveId =$this->common_model->commonRecordCreate('HR_leave_management',$data);
      
       $conditionsMail = array('location' => $this->location_id, 'configureFor' => 'emails'); $fields = ['data'];
       $mailConfigData = $this->common_model->fetchRecordsDynamically('HR_configuration',$fields,$conditionsMail);
       
       if(isset($mailConfigData[0]['data']) && !empty($mailConfigData[0]['data'])){
           
        $managerEmail = unserialize($mailConfigData[0]['data']); 
        $emailSendTo = explode(',', $managerEmail[0]);
        $dataToEncrypt = array(
         'location_id' => $this->location_id,
         'tenantIdentifier' => $this->tenantIdentifier,
         'id' => $leaveId,
         'emp_id' => $_POST['emp_id'],
         'mail_from' => $this->session->userdata('mail_from'),
         'username' => $this->session->userdata('username'),
         'mail_protocol' => $this->session->userdata('mail_protocol'),
         'smtp_host' => $this->session->userdata('smtp_host'),
         'smtp_port' => $this->session->userdata('smtp_port'),
         'smtp_username' => $this->session->userdata('smtp_username'),
         'smtp_pass' => $this->session->userdata('smtp_pass'),
         );
         
     $encryptedData = $this->encryption->encrypt(json_encode($dataToEncrypt));
     $Maildata['nameEmail'] = $this->session->userdata('username');
     $Maildata['start_date'] = $_POST['start_date'];  $Maildata['end_date'] = $_POST['end_date'];
     
     $laveTypeCondition = array('id'=>$_POST['leave_type']);
     $fieldLeaveType = ['leaveTypeName'];
     $leaveTypeData = $this->common_model->fetchRecordsDynamically('HR_leaves',$fieldLeaveType,$laveTypeCondition);
       
     $Maildata['leave_type'] = $leaveTypeData[0]['leaveTypeName']; $Maildata['leaveComments'] = $_POST['leaveComments'];
     $Maildata['approveLeaveUrl'] = base_url().'External/HR/approveLeave/'.urlencode(urlencode(urlencode($encryptedData)));  
     $Maildata['rejectLeaveUrl'] = base_url().'External/HR/rejectLeave/'.urlencode(urlencode(urlencode($encryptedData)));
     $mailContent = $this->load->view('emails/leaveRequest',$Maildata,TRUE);
	 $mailStatus = $this->sendEmail($emailSendTo, 'Leave Request', $mailContent,$this->session->userdata('mail_from'));   
     echo $mailStatus;
        }
      
      echo "success";
    }
    
    function cancelLeave(){
        $data['leave_status'] = 0;
      $this->common_model->commonRecordUpdate('HR_leave_management','id',$_POST['id'],$data);   
    }
}

?>