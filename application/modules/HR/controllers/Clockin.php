<?php

class Clockin extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
   	    //  $this->load->model('site_model');
   	     $this->load->model('common_model');
   	     $this->load->helper('security');
        $this->load->library('form_validation');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // $this->location_id = $this->session->userdata('location_id');
    }
    
   public function verify_pin_and_log_time()
  {
      
    $arrayInputFormat = array();
    
   
    $selectedEmp = $this->POST['selectedEmp'];
    $timeType = $this->POST['clockInTimeType'];
    list($emp_id, $position_id, $prep_id) = explode('_', $selectedEmp);
    $todayDayName = strtolower(date('D'));
    $conditionsTimesheet = array('emp_id'=>$emp_id,'position_id'=> $position_id,'prep_id' => $prep_id ,'date' => date('Y-m-d'));
    $todaytimesheet_details = $this->common_model->fetchRecordsDynamically('HR_timesheet_details', array($todayDayName), $conditionsTimesheet);
    
    if(isset($todaytimesheet_details) && $todaytimesheet_details[0][$todayDayName] !=''){
      $arrayInputFormat = (array)json_decode($todaytimesheet_details[0][$todayDayName]);
      
      $arrayInputFormat[$timeType] = $this->POST['currentTime'];
    }else{
    $arrayInputFormat[$timeType] = $this->POST['currentTime'];
    }
   
    if (!empty($arrayInputFormat)) {
    $timesheetData['emp_id'] = $emp_id;
    $timesheetData['position_id'] = $position_id;
    $timesheetData['prep_id'] = $prep_id;
    $timesheetData['date'] = date('Y-m-d');
    $data[$todayDayName] = json_encode($arrayInputFormat);
    $this->common_model->commonRecordUpdateMultipleConditions('HR_timesheet_details',$timesheetData,$data);    
        echo json_encode(['verified' => true]);
    } else {
        // Return a response indicating failed verification
        echo json_encode(['verified' => false]);
    }
}


    
}

?>