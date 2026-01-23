<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memo extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        // $this->load->helper('notification');
		$this->load->model('employee_model');
		$this->load->model('auth_model');
	    $this->load->model('common_model');
        $this->location_id = $this->session->userdata('location_id') ? $this->session->userdata('location_id') : ($this->session->userdata('User_location_ids') ? $this->session->userdata('User_location_ids')[0] : null);
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
        $this->roleId = get_logged_in_user_role($this->ion_auth,'id');
    }
    
    function memoList(){
      $conditions = array('location_id' => $this->location_id, 'is_deleted' => '0');
      $empFields = ['emp_id','first_name','last_name'];
      $positionFields = ['position_id','position_name'];
      $data['positionLists'] = $this->common_model->fetchRecordsDynamically('HR_emp_position',$positionFields,$conditions);
      $data['empLists'] = $this->common_model->fetchRecordsDynamically('HR_employee',$empFields,$conditions);
      $this->load->view('general/header');
	  $this->load->view('memo/memoList',$data);
	  $this->load->view('general/footer');
    }
    
    function sendMemo(){
        $data =array();
        $empIdsArray = array();
        $allEmp = false;
        $data['location_id'] = $this->location_id;
        $data['date_added'] = date('Y-m-d');
        $data['subject'] = (isset($_POST['subject']) ? $_POST['subject'] : '');
        if(isset($_POST['sendToAllEmp']) && $_POST['sendToAllEmp'] == 'on'){
            $data['sendToAllEmp'] = 1;
            $allEmp = true;
        }else if(isset($_POST['position_ids']) && !empty($_POST['position_ids'])){
        $data['position_ids'] = implode(",", $_POST['position_ids']);       
        }
       
      
        if(isset($_POST['editorData']) && $_POST['editorData'] != ''){
           $data['message'] = $_POST['editorData']; 
        }
        $memoId =$this->common_model->commonRecordCreate('HR_memo',$data);
        if(isset($_POST['emp_ids']) && !empty($_POST['emp_ids']) && $allEmp == false){
            $empIdsArray = explode(',', $_POST['emp_ids'][0]);
            $dataMemo = [];
     
        foreach ($empIdsArray as $empId) {
            $dataMemo[] = [
                'memo_id' => $memoId,
                'emp_id' => $empId
            ];
        }
      $this->common_model->commonBulkRecordCreate('HR_memo_to_employee',$dataMemo);  
        }

        echo $memoId ; exit;
    }
    
    function fetchMemoList(){
      $conditions = array('location_id' => $this->location_id, 'is_deleted' => '0');    
      $memoLists = $this->common_model->fetchRecordsDynamically('HR_memo','',$conditions); 
      echo (isset($memoLists) && !empty($memoLists) ? json_encode($memoLists) : '');
    }
    
    function deleteMemo(){
        foreach($_POST['values'] as $memoId){
          if($memoId !=''){ 
             $data['status'] = 0; $data['is_deleted'] = 1;$data['tabtype'] = 'Trash';
           $this->common_model->commonRecordUpdate('HR_memo','memo_id',$memoId,$data);
          }  
        }
        
      echo "success";
    }
    
    function addMemoComments(){
       $memoId = $_POST['memo_id'];
       echo "Still needs to be implemented emp wise comments need to discuss with kj"; exit;
       $this->common_model->commonRecordUpdate('HR_memo','memo_id',$memoId,$data); 
    }
    
  }
    
    ?>