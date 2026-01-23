<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require 'vendor/autoload.php';
// require 'web.config.php';
// require 'CloudABIS/CloudABISConnector.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Timesheet extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('notification');
        $this->load->library('form_validation');
        $this->load->library('pagination');
		$this->load->model('EmployeesDeatils_model');
		$this->load->model('Timesheet_model');
		$this->load->model('employees_model');
		$this->load->model('general_model');
		$this->load->model('admin_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
        
         $config = array(
              'protocol' => 'smtp', 
              'smtp_host' => 'smtp.gmail.com', 
              'smtp_port' => 587, 
              'smtp_user' => 'cafehrmanagement@gmail.com', 
                'smtp_pass' => 'wdpoqmfuizogwfsj',
                'mailtype' => 'html'
              );
              $this->load->library('email', $config);
              $this->email->initialize($config);
              
              
               
    //===========================================================phpmailer start =================================================
	$this->phpmailermail = new PHPMailer();
               
        $this->phpmailermail->isSMTP();
        // $this->phpmailermail->SMTPDebug = 2;
        $this->phpmailermail->Mailer = "smtp";
        $this->phpmailermail->Host     = $this->config->item('Host');
        $this->phpmailermail->SMTPAuth = $this->config->item('SMTPAuth');
        $this->phpmailermail->SMTPSecure = $this->config->item('SMTPSecure');
        $this->phpmailermail->Username = $this->config->item('Username');
        $this->phpmailermail->Password = $this->config->item('Password');
        $this->phpmailermail->Port     = $this->config->item('Port');
        $this->phpmailermail->setFrom($this->config->item('setFrom'), 'Cafeadmin');
				
			  //=========================================================php mailer end ======================================================
    }
    
    public function index(){}
    
    public function fetchEmpTimesheets(){
            $empId = $this->session->userdata('UserId');
            $date = date('Y-m-d');
            $result = $this->Timesheet_model->fetchEmpTimesheets($empId,$date); 
            // $this->db->last_query();
            
            echo json_encode($result); 
     } 
    public function save_break_record(){
      
        $break_time =  $this->input->post('break_time');   
        $break_type =  $this->input->post('break_type');
        $employee_timesheet_id =  $this->input->post('employee_timesheet_id');
        
        if($break_type == 'break_in_time'){
            $running_status = '2';
        }else{
            $running_status = '1';
        }
        
        $data = array(
         $break_type =>$break_time,
         'running_status' => $running_status,
        );
        
        $result = $this->Timesheet_model->update_employee_timesheet($data,$employee_timesheet_id); 
        if($result){
            echo "success";
        }else{
            echo "error";
        }
   
 }
    public function save_record(){
         
        $in_time =  $this->input->post('in_time');
        $type =  $this->input->post('type');
        $employee_timesheet_id =  $this->input->post('employee_timesheet_id');
        $outlet_id =  $this->input->post('outlet_id');
        $roster_id =  $this->input->post('roster_id');
        
        // compare and round up the time and searlize the day wise in out time's array as we are storing it in a single field in db
    //here in time is same name for in and out time
       $returned_data = $this->compare_time_logic($roster_id,$type,$in_time);
       
       // if employee arrives 15 mins before his rostered time restrict them from logging time (08-08-2021)
       if($returned_data['error'] == true){
           echo "Early";
           exit;
       }
        $in_time = $returned_data['in_time'];
            if($type == 'in_time'){
                $running_status = '1';
            }else{
                $running_status = '3';
            }
           $data = array(
             $type =>$in_time,
             'running_status' => $running_status,
            );
             
          if(isset($outlet_id) && !empty($outlet_id) && $type == 'in_time'){
            $data['outletname'] = $outlet_id;
          }
           
            $result = $this->Timesheet_model->update_employee_timesheet($data,$employee_timesheet_id); 
            
            if($result){
                echo "success";
            }else{
                echo "error";
            }
        
     }
    public function compare_time_logic($roster_id,$type,$in_time){
         $error = false;
         // for roundup compare time with roster and cloclkin time
          $dayname = date('D');
          
          if($type !="in_time"){ 
        
          if($dayname=="Tue"){
             $dayname = "tues_end_time"; 
          }elseif($dayname=="Thu"){
           $dayname = "thus_end_time";    
          }else{
              $dayname = strtolower($dayname);
              $dayname = $dayname."_end_time";
          }
          }else{
             
               if($dayname=="Tue"){
             $dayname = "tues_start_time"; 
          }elseif($dayname=="Thu"){
           $dayname = "thus_start_time";    
          }else{
              $dayname = strtolower($dayname);
              $dayname = $dayname."_start_time";
          }
          
          }
          
          
          
         $this_timesheet_details  = $this->admin_model->check_shift($roster_id,$dayname);
         
        
         
                    $round_up_time =  $this_timesheet_details[0]->$dayname;
                    $time2 = strtotime($this_timesheet_details[0]->$dayname);
                     
                    $time1 = strtotime($in_time);
                    $difference = round(abs(($time2 - $time1)) / 3600,2);
                    $hr_in_min = $difference* 60;
    
                     // check if clockin time is less than roster in time
        if($type == "in_time"){
                    if($time2 > $time1){
                        //up to 10 min early arrival is allowed for roundup else enter actual time as clockin time (old functioality as per new functioanlity if a employee arrives 15 mins or more , 
                        // before his rostered time he cant logg time)
                      if($hr_in_min > 15){
                         $new_in_time =  $in_time;
                        $error = true;
                      }else{
                       $new_in_time =  date("H:i", strtotime($round_up_time));   
                       }
                    }else{
                       
                        //for late there is relaxation of 5 min else enter actual clockin time
                         if($hr_in_min > 5){
                         $new_in_time =  $in_time;
                      }else{
                           $new_in_time =  date("H:i", strtotime($round_up_time));
                      }
                        
                    }
     }else{
         
          if($time2 > $time1){
                        //up to 10 min early arrival is allowed for roundup else enter actual time as clockin time
                      if($hr_in_min > 10){
                         $new_in_time =  $in_time;
                      }else{
                       $new_in_time =  date("H:i", strtotime($round_up_time));   
                       }
                    }else{
                        //for late there is relaxation of 5 min else enter actual clockin time
                         if($hr_in_min > 10){
                         $new_in_time =  $in_time;
                      }else{
                           $new_in_time =  date("H:i", strtotime($round_up_time));
                      }
                        
                    }
         
     }
               
        return array(
            'in_time' => $new_in_time,
             'error' => $error
            );;
        
         
     }
     
    
 

 	
}
