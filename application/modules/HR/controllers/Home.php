<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->load->model('common_model');
		$this->load->model('roster_model');
		$this->load->model('timesheet_model');
		$this->load->model('general_model');
		  $this->load->model('employee_model');
	   $this->location_id = $this->session->userdata('location_id') ?? 0;
	}
	
	public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
        $emailSettings = $this->general_model->fetchSmtpSettings($this->location_id,$system_id);
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
          }else{
            $this->session->set_userdata('mail_from','info@bizadmin.com.au');  
          }
          $conditionsAvail = array('emp_id'=>$empId,'is_deleted'=>'0');
          $data['unavailability'] = $this->common_model->fetchRecordsDynamically('HR_emp_availability', '', $conditionsAvail);
          $todaysRoster = $this->roster_model->fetchEmployeeTodaysRoster();
          if(isset($todaysRoster) && !empty($todaysRoster)){
           $dayName = strtolower(date('l'));
           $todaysRosterDatas = $todaysRoster[0]->$dayName;
           
          }
          if(isset($todaysRosterDatas) && !empty($todaysRosterDatas)){
            $todaysRosterDatas =  json_decode($todaysRosterDatas);
            foreach($todaysRosterDatas as $key => $todaysRosterData){
              $parts = explode("_", $string);
              $empId = end($parts);   
            }
          }
          
        //   echo "<pre>"; print_r($this->session->userdata); exit;
          
        //   AMEND DASHBOARD CODE FROMM HERE
        
//          $role = $this->ion_auth->get_users_groups()->row()->id;
// 			if($this->ion_auth->is_admin()){
// 			     $emp_id ='';
// 			    $type = 'admin';
// 			    $id = $this->location_id;
// 			}else{
// 			    $user = $this->ion_auth->user()->row();
// 			     $user_email = $user->email;
				
// 			 	$id = $this->admin_model->get_emp_details_fromemail($user_email);
// 			    $type = 'employee';
// 			    $empId = $user->id;
//                 $date = date('Y-m-d');
//                 $todaysTimesheet = $this->Timesheet_model->fetchEmpTodaysTimesheets($empId,$date); 
// 			    $data['todaysTimesheet'] = $todaysTimesheet;
			   
// 			   $unavailability = $this->admin_model->fetch_unavailability(); 
// 			   $data['unavailability'] = $unavailability;
// 			}
			
// 		//fetch recent timesheet============================================================
				
// 		$this->tenantDb->distinct();   
// 		$this->tenantDb->select('timesheet.timesheet_id,timesheet.timesheet_name,roster.start_date,roster.end_date,timesheet.roster_group_id,multiple_roster_group_id');
// 		$this->tenantDb->from('HR_timesheet as timesheet');   
// 		$this->tenantDb->join('HR_roster as roster', 'timesheet.roster_group_id = roster.roster_group_id'); 
// 		if($this->session->userdata('role') == 'employee'){
// 		    $id = $this->session->userdata('UserId');
// 		   $this->tenantDb->where('emp_id',$id); 
// 		}
// 			$this->tenantDb->limit(4);	
// 			$this->tenantDb->order_by('timesheet_id',"DESC");
	
// 		$query = $this->tenantDb->get();
// 		$data['timesheets'] = $query->result();
				
// 				//===========================================================================
				
// 				$roster_list_for_dash = $this->admin_model->get_roster_weeks($id,$type,'dash');
		

// 				$leaves = $this->general_model->get_leaves($id,$type);
			
// 				$data['role'] = $role;
// 				$data['leaves'] = $leaves;
// 				$data['roster'] = $roster_list_for_dash;
				
// 			// for displaying chart
           
//             $days = array('Week_1','Week_2','Week_3','Week_4');
//             $roster = $this->admin_model->get_roster_weeks($id,$type,'dash');
//             $week_days = array('mon','tues','wed','thus','fri','sat','sun');
		    
// 		    $count =1;
// 		    foreach($roster as $row){ 
		       
// 		        $rate = $this->admin_model->get_emp_details_fieldwise($row->emp_id,'rate');
// 		        $week_earning =  0;
// 		        $hrs_worked =  0;
// 		        for ($i = 0; $i < 7; $i++) {
// 		          $start_nameofday = $week_days[$i].'_start_time';
//                  $end_nameofday = $week_days[$i].'_end_time'; 
//                   $break_nameofday = $week_days[$i].'_break_time'; 
//                   $break_hrs = $row->$break_nameofday;
                    
//                     $time1 = strtotime($row->$start_nameofday);
//                     $time2 = strtotime($row->$end_nameofday);
//                   if($time1 !='' && $time2 !=''){
//                     $difference = round(abs(($time2 - $time1)) / 3600,2);
                
//                 $hr_in_min = $difference* 60;
              
//               if((isset($difference) && $difference !='') && isset($break_hrs) && $break_hrs !='' && isset($hr_in_min) && $hr_in_min !=''){
                   
//                 $difference = $hr_in_min -  $break_hrs;
//                 // echo $difference; 
//                 $total_pay = (($rate)/60) * $difference;
//                 $hrs_worked = $hrs_worked + $difference;
                  
                 
//               // sum total earning of the week       
//                 $week_earning = $week_earning + $total_pay;
//               }else{
                   
//                  $hrs_worked =0;
//                  $week_earning = 0;
                   
//               }
//                 }
                   
//                 }
               
// 		         // convert total mins worked in hrs
            
//                 $total_hrs_worked = floor($hrs_worked / 60).':'.($hrs_worked -   floor($hrs_worked / 60) * 60); 
// 		        $this_week_earning[] = $week_earning;
// 		        $week_earning = number_format(floor($week_earning*100)/100,2, '.', ''); 
		     
// 		        $dataPoints[] = array("label"=> "Week_".$count, "y"=> $week_earning);
// 		        $employee_hrs_records[] = array("label"=> $row->roster_name, "hrs_worked"=> $total_hrs_worked,"earned"=> '$'.number_format($week_earning,2));
// 	            $count++;



// 		    }
		    
// 			  if(isset($dataPoints) && $dataPoints !=''){
// 			      $data['roster_report'] = $dataPoints;
// 			  }else{
// 			      $data['roster_report'] = '';
// 			  }
			
			 
			 $this->load->view('general/header');
             $data = '';
				if($type == 'admin'){
				  $this->load->view('general/dashboard_admin',$data);  
				}else{
				// if(isset($employee_hrs_records)){
				// $data['employee_hrs_records'] = $employee_hrs_records;
			 //   }else{
				// $data['employee_hrs_records'] = '';
				// }
				//     // echo "<pre>";print_r($data);exit;
		   $this->load->view('general/dashboard',$data); 
				}
		 	$this->load->view('general/footer');
  
    	
        
    }
    
     public function clockInClockOut($system_id = '', $istimesheet = '')
    {
        if (!empty($system_id)) {
            $this->session->set_userdata('system_id', $system_id);
        }
       
        $data['location_name']= fetchLocationNamesFromIds($this->session->userdata('User_location_ids'),true);
        $conditionsGeneralConfig = array('location' => $this->location_id, 'configureFor' => 'feature_toggle');
        $toggleConfig = $this->common_model->fetchRecordsDynamically('HR_configuration', ['data'], $conditionsGeneralConfig);
        
        if(isset($toggleConfig[0]['data']) && $toggleConfig[0]['data'] !='') {
        $generalConfigData = json_decode($toggleConfig[0]['data'], true);
        $data['generalConfigData']['feature_toggle'] = isset($generalConfigData['value']) ? $generalConfigData['value'] : '0';
        }
       
       
        // Configure SMTP settings
        $emailSettings = $this->general_model->fetchSmtpSettings($this->location_id, $system_id);
        if (empty($emailSettings)) {
            $emailSettings = $this->general_model->fetchSmtpSettings('9999', '9999');
            $this->configureSMTP($emailSettings);
        } else {
            if ($emailSettings->mail_protocol === 'smtp') {
                $this->configureSMTP($emailSettings);
            }
        }

        $this->session->set_userdata('mail_from', $emailSettings->mail_from ?? 'info@bizadmin.com.au');

        $currentDate = date('Y-m-d');

        // Fetch timesheet records
        $timesheetDetailsData = array();
        $timesheetDetailsData = $this->timesheet_model->getTimesheetForDate($currentDate, $this->location_id);

        // Fallback to active employees if no timesheet records
        
        $data['empLists'] = $timesheetDetailsData;

        // Fetch prep areas
        $prepConditions = ['location_id' => $this->location_id, 'is_deleted' => 0, 'status' => 1];
        $prepAreas = $this->common_model->fetchRecordsDynamically('HR_prepArea', ['id', 'prep_name', 'color'], $prepConditions, 'prep_name');
        $selectedPrepAreas = $this->ion_auth->user()->row()->prepIds ?? '';
        if (!empty($selectedPrepAreas)) {
            $selectedPrepIds = unserialize($selectedPrepAreas);
            $filteredPrepAreas = array_filter($prepAreas, function ($area) use ($selectedPrepIds) {
                return in_array((int)$area['id'], $selectedPrepIds);
            });
            $data['prepAreas'] = array_values($filteredPrepAreas);
        } else {
            $data['prepAreas'] = $prepAreas;
        }

        $data['currentDate'] = $currentDate;

        // $this->load->view('general/header');
        $this->load->view('TimesheetClockIn/clockin', $data);
        $this->load->view('general/footer');
    }
    
   
    
    
    
	
}