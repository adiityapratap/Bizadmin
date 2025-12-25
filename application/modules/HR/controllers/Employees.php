<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {

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
         $user_id = $this->ion_auth->user()->row()->id;
        $empData = $this->common_model->fetchRecordsDynamically('HR_employee', ['emp_id'], ['userId'=>$user_id]);
        $this->empId = (isset($empData[0]['emp_id']) ? $empData[0]['emp_id'] : ''); // incase of superadmin 
        // $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
     
    }
    
    // inserting fake/duumy employees
    
     public function seed()
    {
        $names = [
    'John', 'Kevin', 'Alice', 'Sophie', 'Michael', 'Emma', 'Daniel', 'Olivia', 'James', 'Ava',
    'David', 'Grace', 'Chris', 'Chloe', 'Ethan', 'Zoe', 'Liam', 'Ella', 'Ryan', 'Lily',
    'Noah', 'Mia', 'William', 'Isabella', 'Alexander', 'Sophia', 'Benjamin', 'Charlotte',
    'Henry', 'Amelia', 'Samuel', 'Harper', 'Thomas', 'Evelyn', 'Jack', 'Aria', 'Lucas',
    'Scarlett', 'Mason', 'Luna', 'Jacob', 'Abigail', 'Oliver', 'Emily', 'Elijah', 'Madison',
    'Logan', 'Avery', 'Jackson', 'Sofia'
];

        $created = 0;
        foreach ($names as $i => $name) {
            $email = strtolower($name) . ($i+1) . '@example.com';
            $password = $email . '#123!Allowed!';
            $additional_data = [
                'first_name' => $name,
                'last_name' => 'Doe'
            ];
            $group = [2]; // assuming group_id 2 is a standard employee group

            $user_id = $this->ion_auth->register($email, $password, $email, $additional_data, $group);

            if ($user_id) {
                $employee_data = [
                    'userId' => $user_id,
                    'first_name' => $name,
                    'preferred_name' => $name,
                    'last_name' => 'Doe',
                    'onboarding_status' => 1,
                    'emp_availability' => 'Full Time',
                    'employee_type' => 'Permanent',
                    'email' => $email,
                    'phone' => '9056101' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                    'pin' => hash('sha256', '2580'),
                    'dob' => '1996-03-23',
                    'effective_start_date' => '2025-06-01',
                    'location_id' => 13,
                    'bank_1' => 'State Bank',
                    'bsb_1' => '0987',
                    'account_no_1' => 'A12K34' . $i,
                    'percentage_1' => 100,
                    'account_name_1' => $name . ' Doe',
                    'nextkin_name_one' => 'Kin One',
                    'nextkin_email_one' => 'kin' . $i . '@example.com',
                    'nextkin_phone_no' => '8765432' . str_pad($i + 1, 2, '0', STR_PAD_LEFT),
                    'nextkin_relationship_one' => 'Sibling',
                    'title' => 'Mr',
                    'unit_number' => '12',
                    'street_name' => 'gghh',
                    'street' => 'wdd',
                    'suburb' => 'MEl',
                    'postcode' => '1234',
                    'state' => 'act',
                    'stress_profile' => '2',
                    'tfn_number' => '00998877',
                    'super_fund_name' => 'hgchh',
                    'heighest_acd_achmts' => 'BCA',
                    'visa_status' => 'eyj',
                    'agree_terms_one' => 1,
                    'agree_terms_two' => 1,
                    'agree_terms_three' => 1,
                    'status' => '1',
                    'created_at' => date('Y-m-d')
                ];
               $empid =  $this->common_model->commonRecordCreate('HR_employee',$employee_data);
               $emplocData['location_id'] = 13; $emplocData['empId'] = $empid;
               $this->common_model->commonRecordCreate('HR_empIdToLocationId',$emplocData);
               $empposData['position_id'] = 1; $empposData['rate'] ='12';
               $empposData['emp_id'] = $empid; 
                $this->common_model->commonRecordCreate('HR_emp_to_position',$empposData);
               if($empid){
               $created++;    
               }else{
                   break;
               }
                
            }
        }

        echo "<h3>Successfully created $created dummy users and employees.</h3>";
    }
    
    public function employeeList(){ 
        
	  $userId = $this->ion_auth->get_user_id();
	  if($this->roleId == 4){
	    // for employee logins only
	  $conditions = array('userId'=>$userId); $fields = ['emp_id'];
	 
	  $empData = $this->common_model->fetchRecordsDynamically('HR_employee', $fields, $conditions); 
	   
	  $this->editEmployee($empData[0]['emp_id']);
	  }else{
	      // for admin,manager,staff login
	  $data['locations'] = $this->auth_model->fetchLocationsFromUserId($userId);
	  $data['empLists'] = $this->employee_model->employeeList('','0');
	  $data['inActiveEmpLists'] = $this->employee_model->employeeList('1','0');
	  $data['activeContractorLists'] = $this->employee_model->employeeList('','1'); 
	  $data['inactiveContractorLists'] = $this->employee_model->employeeList('1','1');
// 	  echo "<pre>"; print_r($data['activeContractorLists']); exit;
	 
      $this->load->view('general/header');
	  $this->load->view('employee/employeeList',$data);
	  $this->load->view('general/footer');    
	  }
	  
	}
	
	 
	
	public function editEmployee($empId = '')
{
    // ---------- Defaults ----------
    $data = [];
    $empId = !empty($empId) ? $empId : ($this->empId ?? null);

    // ---------- Guard: empId ----------
    if (empty($empId)) {
        // Fail silently – no errors, no notices
        redirect('dashboard');
        return;
    }

    // ---------- Conditions ----------
    $conditions              = ['emp_id' => $empId];
    $conditionsLeave         = ['status' => '1'];
    $conditionsStress        = ['status' => '1', 'is_deleted' => '0'];
    $conditionsAvail         = ['emp_id' => $empId, 'is_deleted' => '0'];
    $locationId              = $this->location_id ?? 0;

    // ---------- Employee Data ----------
    $empData = $this->employee_model->employeeDetails($empId);
    $employee = (is_array($empData) && !empty($empData[0])) ? $empData[0] : [];

    // ---------- Leaves ----------
    $leaveData = $this->common_model
        ->fetchRecordsDynamically('HR_leaves', '', $conditionsLeave) ?? [];

    // ---------- Assign Safe Defaults ----------
    $data['empPositionAndRatesData'] = $this->common_model
        ->fetchRecordsDynamically('HR_emp_to_position', '', $conditions) ?? [];

    $data['availability'] = $this->common_model
        ->fetchRecordsDynamically('HR_emp_availability', '', $conditionsAvail) ?? [];

    $data['leaveRequestsData'] = $this->employee_model
        ->fetchLeaveRequestsRecord($empId, 'past') ?? [];

    $data['upcomingLeaveData'] = $this->employee_model
        ->fetchLeaveRequestsRecord($empId, 'upcoming') ?? [];

    $data['countOfLeaves'] = $this->employee_model
        ->fetchCountOfLeaves() ?? 0;

    $data['stressProfiles'] = $this->common_model
        ->fetchRecordsDynamically('HR_stressProfile', '', $conditionsStress) ?? [];

    $data['positions'] = $this->common_model
        ->fetchRecordsDynamically('HR_emp_position', '', $conditionsStress) ?? [];

    $data['payrollTypes'] = $this->common_model
        ->fetchRecordsDynamically(
            'HR_payroll_type',
            ['id', 'name'],
            ['is_deleted' => 0, 'location_id' => $locationId]
        ) ?? [];

    // ---------- Locations ----------
    $locationIdsArray = [];

    if (!empty($employee['location_ids'])) {
        $unserialized = @unserialize($employee['location_ids']);
        if (is_array($unserialized)) {
            $locationIdsArray = $unserialized;
        }
    }

    $data['locationNames'] = function_exists('fetchLocationNamesFromIds')
        ? fetchLocationNamesFromIds($locationIdsArray)
        : [];

    // ---------- Final Assignments ----------
    $data['employee']   = $employee;
    $data['leaveTypes'] = $leaveData;
    
    // echo "<pre>"; print_r($employee); exit;

    // ---------- Prep Areas ----------
    $data['prepAreaLists'] = $this->common_model
        ->fetchRecordsDynamically(
            'HR_prepArea',
            '',
            ['location_id' => $locationId]
        ) ?? [];

    // ---------- Views ----------
    $this->load->view('general/header');
    $this->load->view('employee/editEmployee', $data);
    $this->load->view('general/footer');
}

	function employeeCommonUpdate($empId,$data){
	   // echo "<pre>"; print_r($data); exit;
	 $this->common_model->commonRecordUpdate('HR_employee','emp_id',$empId,$data);     
	}
	function employeeDelete(){
	   $data['is_deleted'] = $_POST['is_deleted']; 
	   $empId = $_POST['emp_id'];
	   $userId = $_POST['user_id'];
	   $this->common_model->commonRecordUpdate('HR_employee','emp_id',$empId,$data);
	   if(isset($_POST['is_deleted']) && $_POST['is_deleted'] == 1){
	    $data['deleted_at'] =   date('Y-m-d');
	   }else{
	    $data['date_modified'] =  date('Y-m-d');
	   }

	   $this->common_model->commonRecordDelete('Global_users',$userId,'id');
	   echo "Success";
	} 
	function employeeStatusUpdate(){
	  $dataToUpdate['status'] = $_POST['status'];
	  $this->employeeCommonUpdate($_POST['id'],$dataToUpdate);
	  $data['active'] = $_POST['status']; 
	  $this->common_model->commonRecordUpdate('Global_users','id',$_POST['user_id'],$data);
	   echo "Success";
	}
	
	function onboardNewEmployee(){
	  
	    if (!empty($_FILES['userfile']['name'])){
	         $uploadPath='./uploaded_files/'.$this->tenantIdentifier.'/HR/JobDescr';
             $jobDescrFilename = $this->common_model->uploadAttachment($_FILES,$uploadPath);
            }else{
              $jobDescrFilename = '';  
            }
	  
	   $data=array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'userId' => $this->input->post('userId'),
			'location_id' => $this->location_id,
			'location_ids' => serialize($this->input->post('locationIds')),
			'status' => 1,
			'job_desc' => $jobDescrFilename,
			'created_at' => date("Y-m-d"),
			'date_modified' => date("Y-m-d")
			);
// 	 echo "<pre>"; print_r($this->input->post('locationIds')); exit;
	 $emp_id = $this->employee_model->onboardNewEmployee($data); 
	 // if an employee belongs to multiple locations
	 if(isset($_POST['locationIds']) && !empty($_POST['locationIds'])){
	 foreach($_POST['locationIds'] as $locationId){
	  $locData = array(
			'location_id' => $locationId,
			'empId' => $emp_id,
			);
      $this->employee_model->allocateLocationToEmployee($locData);  			
	     }
	 }
	 if($this->input->post('type') =='onboard'){
	     // only send ponboarding email if onboard button has been clicked
	 $this->sendOnboardingEmail($emp_id,$_POST);     
	 }else{
	     
	     $response = [
    'emp_id' => $emp_id,
    'mailStatus' => [
        'status' => 'success',
        'error'  =>  ''
    ]
];


    return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
        
	 }
	

	}
	
/**
 * Send the onboarding e-mail and return emp_id + mail status to Ajax.
 *
 * @param int $emp_id
 * @return void  (outputs JSON)
 */
public function sendOnboardingEmail($emp_id, $formData = [])
{
 
    // ---------------------------------------------------------
    $dataToEncrypt = [
        'location_id'       => $this->location_id,
        'tenantIdentifier'  => $this->tenantIdentifier,
        'empId'             => $emp_id,
        'mail_from'         => $this->session->userdata('mail_from'),
        'username'          => $this->session->userdata('username'),
        'mail_protocol'     => $this->session->userdata('mail_protocol'),
        'smtp_host'         => $this->session->userdata('smtp_host'),
        'smtp_port'         => $this->session->userdata('smtp_port'),
        'smtp_username'     => $this->session->userdata('smtp_username'),
        'smtp_pass'         => $this->session->userdata('smtp_pass'),
    ];

  
    $locationNamesList = [];

    if (!empty($formData['locationIds'])) {

        $locationIdsArray = $formData['locationIds'];  // Correct variable!

        // Fetch location names using helper
        $locationAssocArray = fetchLocationNamesFromIds($locationIdsArray, false);  
        // Example result: [10 => "Bendigo", 12 => "Werribee"]

        // Convert to simple array of names
        $locationNamesList = array_values($locationAssocArray);

        // Also add to encryption payload:
        $dataToEncrypt['location_names'] = $locationNamesList;
    }

   
    $encryptedData = $this->encryption->encrypt(json_encode($dataToEncrypt));

    $Maildata['onboardingUrl'] = base_url() . 'External/HR/onboardingForm/' 
        . urlencode(urlencode(urlencode($encryptedData)));

 
    $Maildata['employeeName'] = $this->input->post('first_name');

    // Send list of locations to email template
    $Maildata['locationNamesList'] = $locationNamesList;  

   
    $mailContent = $this->load->view('emails/onboardingEmail', $Maildata, TRUE);

  
    $emailSendTo = $this->input->post('email');

   $mailStatus = $this->sendEmail(
    $emailSendTo,
    'BizAdmin - Welcome to HR management',
    $mailContent,
    $this->session->userdata('mail_from')
);

// ---------------------------------------------------------
// 7. AJAX RESPONSE
// ---------------------------------------------------------
$response = [
    'emp_id' => $emp_id,
    'mailStatus' => [
        'status' => $mailStatus['status'],
        'error'  => isset($mailStatus['error']) ? $mailStatus['error'] : ''
    ]
];


    return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}

	
	function submitOnboardingProcessForEmployee(){
	    $empId = $this->input->post('emp_id');
	    
	    $positionIdsToRemove = json_decode($this->input->post('positionIdToRemove'));
        if (is_array($positionIdsToRemove) && !empty($positionIdsToRemove)) {
            $this->common_model->commonBulkRecordDelete('HR_emp_to_position',$positionIdsToRemove,'id');
        }
	   
        if (!empty($_FILES['userfile']['name'])){
        $uploadPath='./uploaded_files/'.$this->tenantIdentifier.'/HR/OnboardingFiles';
        $filename = $this->common_model->uploadAttachment($_FILES,$uploadPath);    
        $data_user['police_certificate'] = $filename;
        }
        $posted_data = $this->input->post();
        
        // NOTE :  please add new index in below array for fiels added to employee form to execulde , if its name not matching with hr_employee table column
        $excludedValues = array('rate','Saturday_rate','Sunday_rate','holiday_rate','position_id','position_unique_id','positionIdToRemove','payroll_type_id','created_at');
        foreach($posted_data as $key=> $value){
        ($value !='' && !in_array($key,$excludedValues) ? $data_user[$key] = $value : '');   
        }
        
        
        
         $positionresponse = array();
         if(isset($_POST['position_id']) && !empty($_POST['position_id'])){
           foreach($_POST['position_id'] as $index => $positionid){
           $positionRatesData = array();
           $positionRatesData['emp_id'] = $_POST['emp_id'];
           $positionRatesData['position_id'] = $positionid;
           $positionRatesData['rate'] = isset($_POST['rate'][$index]) ? $_POST['rate'][$index] : 0;
           $positionRatesData['Saturday_rate'] = isset($_POST['Saturday_rate'][$index]) ? $_POST['Saturday_rate'][$index] : 0;
           $positionRatesData['Sunday_rate'] = isset($_POST['Sunday_rate'][$index]) ? $_POST['Sunday_rate'][$index] : 0;
           $positionRatesData['holiday_rate'] = isset($_POST['holiday_rate'][$index]) ? $_POST['holiday_rate'][$index] : 0;
           $positionRatesData['payroll_type_id'] = isset($_POST['payroll_type_id'][$index]) ? $_POST['payroll_type_id'][$index] : null;
          
           
           if(isset($_POST['position_unique_id'][$index])){
            $this->common_model->commonRecordUpdate('HR_emp_to_position','id',$_POST['position_unique_id'][$index],$positionRatesData);   
            $uniqueId = $_POST['position_unique_id'][$index];
           }else{
            $uniqueId = $this->common_model->commonRecordCreate('HR_emp_to_position',$positionRatesData);     
           }
           
          
           $positionResponse = array();
           $positionResponse['id'] = $uniqueId;
           $positionResponse['position_id'] = $positionid;
    
           $positionResponses[] = $positionResponse;
          
        } 
        $response['positionAddedDetails'] = $positionResponses;
         }
        
       
        $data_user['date_modified'] = date("Y-m-d");
        // $data_user['onboarding_status'] = 1;
        $this->employeeCommonUpdate($empId,$data_user);
        $response['status'] = 'success';
		$response['message'] = 'success';
		
		echo json_encode($response);   
	}
	
	
	
	// save_availability : To record Employee Availability for each day
	
public function save_availability()
{
    $emp_id      = $this->input->post('emp_id');
    $same_hours  = $this->input->post('same_hours') ? 1 : 0;
    $location_id = $this->location_id;

    if (!$emp_id) {
        echo json_encode(["status" => "error", "message" => "Invalid employee"]);
        return;
    }

    // All week days
    $days = ["mon","tue","wed","thu","fri","sat","sun"];

    // Weekly structure posted
    $weekly = $this->input->post('weekly');
    if (!is_array($weekly)) {
        $weekly = [];
    }

    // SAME HOURS MODE: override weekly array
    if ($same_hours == 1) {

        $start = $this->input->post('same_start');
        $end   = $this->input->post('same_end');

        foreach ($days as $d) {
            $weekly[$d] = [
                "start" => $start ?: "",
                "end"   => $end   ?: ""
            ];
        }

    } else {
        // Ensure all days exist
        foreach ($days as $d) {
            $weekly[$d]["start"] = trim($weekly[$d]["start"] ?? "");
            $weekly[$d]["end"]   = trim($weekly[$d]["end"] ?? "");
        }
    }

    // Encode JSON
    $weekly_json = json_encode($weekly);

    // Prepare save row
    $saveData = [
        "emp_id"       => $emp_id,
        "weekly_json"  => $weekly_json,
        "same_hours"   => $same_hours,
        "location_id"  => $location_id,
        "updated_at"   => date('Y-m-d H:i:s'),
        "is_deleted"   => 0
    ];

    // Check existing
    $existing = $this->common_model->fetchRecordsDynamically(
        "HR_emp_availability",
        "",
        ["emp_id" => $emp_id, "is_deleted" => 0]
    );

    if (empty($existing)) {
        $this->common_model->commonRecordCreate("HR_emp_availability", $saveData);
    } else {
        $this->common_model->commonRecordUpdate(
            "HR_emp_availability",
            "emp_availability_id",
            $existing[0]["emp_availability_id"],
            $saveData
        );
    }

    // Log changes
    $logData = [
        "emp_id"      => $emp_id,
        "location_id" => $location_id,
        "weekly_json" => $weekly_json,
        "same_hours"  => $same_hours,
        "ip_address"  => $this->input->ip_address(),
        "user_agent"  => $this->input->user_agent(),
        "created_at"  => date("Y-m-d H:i:s")
    ];

    $this->common_model->commonRecordCreate("HR_employee_unavailability_logs", $logData);

    echo json_encode([
        "status"  => "success",
        "message" => "Availability updated successfully"
    ]);
}


public function get_availability_for_day()
{
    $emp_id = $this->input->post("emp_id");
    $dayKey = $this->input->post("day_key"); // mon/tue/wed...
    $location_id = $this->location_id;

    // Fetch availability record
    $result = $this->common_model->fetchRecordsDynamically(
        "HR_emp_availability",
        "",
        ["emp_id" => $emp_id, "is_deleted" => 0]
    );

    if (empty($result)) {
        echo json_encode([
            "available" => false,
            "message" => "No availability record found."
        ]);
        return;
    }

    $row = $result[0];
    $weekly = json_decode($row["weekly_json"], true);
    $same = intval($row["same_hours"]) === 1;

    // Determine availability
    if ($same) {
        $start = $weekly["mon"]["start"] ?? "";
        $end   = $weekly["mon"]["end"] ?? "";
    } else {
        $start = $weekly[$dayKey]["start"] ?? "";
        $end   = $weekly[$dayKey]["end"] ?? "";
    }

    // No hours set → unavailable
    $available = (!empty($start) && !empty($end));

    echo json_encode([
        "available" => $available,
        "start" => $start ?: "",
        "end" => $end ?: "",
        "same_hours" => $same
    ]);
}

	

	

	
	
// 	old functions start here ============================================================================================================================
    
//     public function employee_delete(){
       
         
//     	$id = $_POST['id'];
    
//     	$this->load->model('employees_model');
    
//      $this->employees_model->employee_delete($id);
    
//       }
//     public function revert_deleted_emp(){
        
//     	$id = $_POST['id']; 
    
//     	$this->load->model('employees_model');
//         $this->employees_model->revert_deleted_emp($id);
         
//     }
    
//      public function fetch_employee_availability_for_next_week(){
//          $emp_id    = $_POST['employee_id'];
          
//         if($_POST['start_date'] == ''){
//             echo  'error'; exit;
//         }     
        
//         $start_date = date('Y-m-d', strtotime($_POST['start_date']));
        
//         $res = $this->employees_model->fetch_employee_availability($emp_id,$start_date);
      
//          if(!empty($res)){
//              echo json_encode($res);   
//          }else{
//           echo  'false';  
//          }
        	
     
//     //   if(is_array($emp_availability) && !empty($emp_availability)){
//     //     for($i = 0 ;$i < 7; $i++){
//     //       $date_next = date('d-m-Y', strtotime($_POST['start_date'] . ' +'.$i.' day'));
      
//     //         if(in_array($date_next,$emp_availability)){
//     //           $unavailabel = true;
//     //         }
         
//     //     }
        
//     //   }else{
//     //      $unavailabel = false;
//     //   }
      
//     //   if($unavailabel == true){
//     //   echo json_encode($emp_availability);   
//     //   }else{
//     //     echo  'available';
//     //   }
   
   
      
//      }
//      public function add_availability(){
       
//         if(!empty($this->input->post())){
        
//          $posted_data = $this->input->post();
//         foreach($posted_data as $key=> $valuue){
//          ($valuue !='' ? $avail_data[$key] = $valuue : '');
//          }
//         //  echo "<pre>";print_r($avail_data); exit;
//          $res = $this->employees_model->update_employee_availability($this->emp_id,$avail_data);
//          $data['success_message'] = 'Your update has been successful.';
        
//         }
      
        
// 	    $dates = new DateTime();
// 	    // get date for next Sunday as we will ask employee availability for coming week
// 	    $datee = $dates->modify('next monday');  $data['next_monday_date'] = $dates->format('Y-m-d');
//         $data['Mondate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Tuedate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Weddate']=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $data['Thudate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Fridate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Satdate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Sundate']=  $datee->format('d-m-Y');   
		
        
    
//          $res = $this->employees_model->fetch_employee_availability($this->emp_id);
//          if(!empty($res)){
//             $data['emp_availability'] = unserialize($res[0]->emp_availability);
//          }
       
//         $this->load->view('general/header');
// 		$this->load->view('employees/add_availability',$data);
// 		$this->load->view('general/footer');
       
//     }
//     public function leave_delete(){
//     $id = $_POST['id'];
//     $this->load->model('employees_model');
//      $this->employees_model->leave_delete($id);
         
//     }
    
  

//       function thank_you_page(){
          
          
//           $this->load->view('employees/thank_you_page');
// 		   $this->load->view('general/footer');
          
//       }
//     function emp_dashboard() {
// 	       $this->load->view('general/header');
//           $this->load->view('employees/employee_dashboard');
// 		   $this->load->view('general/footer');
// 	} 
// 	function get_roster_weeks() {
// 	   if (!$this->ion_auth->logged_in()) {
//             redirect('auth/homepage');
//         }else {
// 				$emp_id = $this->ion_auth->user()->row()->id; 
// 			 	$roster = $this->employees_model->get_roster_weeks($emp_id,$this->location_id);
// 			    $data['roster'] = $roster;
				
// 				$this->load->view('general/header');
// 				$this->load->view('employees/roster_emp_table',$data);
// 				$this->load->view('general/footer');
          	
// 		}
// 	}
// 		function emp_indection_reg() {
// 	   if (!$this->ion_auth->logged_in()) {
//             redirect('auth/homepage');
//         }else{
//               $emp_id = $this->ion_auth->user()->row()->id;
//         	   $employee_details = $this->employees_model->get_emp_details($emp_id);

//         	   $get_docs = $this->employees_model->get_docs($emp_id);
        	   
//         	    $data['docs'] = $get_docs;
        	
//         		$data['user_details'] = $employee_details;
				  
// 		        $this->load->view('general/header');
//         		$this->load->view('employees/emp_indection_reg',$data);
// 		        $this->load->view('general/footer');
// 		}
// 	}
// 	function submit_emp_indection_reg() {
// 	   $this->form_validation->set_rules('title','title','trim|required');
//          $dob = strtotime($this->input->post('dob'));
//          $dob = date('Y-m-d',$dob);

// 		if ($this->form_validation->run() == true) {
//             $emp_id = $this->input->post('emp_id');
// 		    $data = array(
// 		    	'first_name' => $this->input->post('first_name'),
// 		    	'last_name' => $this->input->post('last_name'),
// 		    	'email' => $this->input->post('email'),
// 		    	'phone' => $this->input->post('phone'),
// 		    	'title' => $this->input->post('title'),
// 		    	'name' => $this->input->post('name'),
// 		    	'surname' => '',
// 		    	'email' => $this->input->post('email'),
// 		    	'dob' => $dob,
// 		    	'unit_number' => $this->input->post('unit'),
// 		    	'street' => $this->input->post('street'),
// 		    	'suburb' => $this->input->post('suburb'),
// 		    	'postcode' => $this->input->post('post'),
// 		    	'state' => $this->input->post('state'),
// 		    	'tfn_number' => $this->input->post('tfn_no'),
// 		    	'super_fund_name' => $this->input->post('super_fund_name'),
// 				'super_annuation_no' => $this->input->post('super_annua_no'),
// 				'heighest_acd_achmts' => $this->input->post('heighest_acadamic_ach'),
// 				'pre_emp_hstry_one' => $this->input->post('pre_emp_hstry_one'),
// 				'pre_emp_hstry_two' => $this->input->post('pre_emp_hstry_two'),
// 				'pre_emp_hstry_three' => $this->input->post('pre_emp_hstry_three'),
// 				'visa_status' => $this->input->post('visa_status'),
// 				'nextkin_name_one' => $this->input->post('nextkin_name_one'),
// 				'nextkin_email_one' => $this->input->post('nextkin_email_one'),
// 				'nextkin_relationship_one' => $this->input->post('nextkin_relationship_one'),
// 				'nextkin_name_two' => $this->input->post('nextkin_name_two'),
// 				'nextkin_email_two' => $this->input->post('nextkin_email_two'),
// 				'nextkin_relationship_two' => $this->input->post('nextkin_relationship_two'),
// 				'agree_terms_one' => $this->input->post('agree_terms_one'),
// 				'agree_terms_two' => $this->input->post('agree_terms_two')
// 				);
				
			
// 			$result = $this->employees_model->add_induction_form($data,$emp_id);
//             $data_user = array(
//             	'status' => 'Complete'
//             	);
//             $user_id = $this->ion_auth->user()->row()->id;	
//             $user = $this->employees_model->status_update($data_user,$user_id);	
// 			if($result){
// 				$this->session->set_flashdata('sucess_msg', 'All the information has been successfully added. Cafe manager will be in touch for any further information required.');
// 			}else{
// 				$this->session->set_flashdata('error_msg', 'Unable to add Induction');
// 			}
// 			redirect('employees/emp_dashboard');
// 		}else{
// 			redirect('employees/emp_indection_reg');
// 		}
// 	}
// 	function submit_save_exit_emp_indection_reg() {
// 	  $emp_id = $this->input->post('emp_id');
		
// 			$itemname = $this->input->post('itemname');
// 			$uniform_arr = [];

// 			foreach($itemname as $item){
					
// 					$uniforms = $_REQUEST['uniform']["'$item'"];

// 					foreach($uniforms as $key => $details){
// 						$exp = explode('_',$key);
// 						if($details != '' && $exp[1] == 'qty'){
// 							$data['name'] = $item;
// 							$data['size'] = $exp[0];
// 							$data['qty'] = $uniforms[$exp[0]."_qty"];
// 							$data['total'] = $uniforms[$exp[0]."_total"];

// 							array_push($uniform_arr, $data);
// 						}
// 					}	
// 				}
// 				//echo '<pre>';print_r($uniform_arr);exit;
// 				foreach($uniform_arr as $uniform){
// 					$values['employee_id'] = $emp_id;
// 					$values['item_name'] = $uniform['name'];
// 					$values['item_size'] = $uniform['size'];
// 					$values['quantity'] = $uniform['qty'];
// 					$values['total'] = $uniform['total'];

// 					$add_uniform = $this->employees_model->add_uniform($values);
// 				}
    
// 			 $dob = strtotime($this->input->post('dob'));


//             $dob = date('Y-m-d',$dob);
// 		    $data = array(
// 		    	'first_name' => $this->input->post('first_name'),
// 		    	'last_name' => $this->input->post('last_name'),
// 		    	'email' => $this->input->post('email'),
// 		    	'phone' => $this->input->post('phone'),
// 		    	'title' => $this->input->post('title'),
// 		    	'name' => $this->input->post('name'),
// 		    	'surname' => '',
// 		    	'email' => $this->input->post('email'),
// 		    	'dob' => $dob,
// 		    	'unit_number' => $this->input->post('unit'),
// 		    	'street' => $this->input->post('street'),
// 		    	'suburb' => $this->input->post('suburb'),
// 		    	'postcode' => $this->input->post('post'),
// 		    	'state' => $this->input->post('state'),
// 		    	'tfn_number' => $this->input->post('tfn_no'),
// 		    	'super_fund_name' => $this->input->post('super_fund_name'),
// 				'super_annuation_no' => $this->input->post('super_annua_no'),
// 				'heighest_acd_achmts' => $this->input->post('heighest_acadamic_ach'),
// 				'pre_emp_hstry_one' => $this->input->post('pre_emp_hstry_one'),
// 				'pre_emp_hstry_two' => $this->input->post('pre_emp_hstry_two'),
// 				'pre_emp_hstry_three' => $this->input->post('pre_emp_hstry_three'),
// 				'visa_status' => $this->input->post('visa_status'),
// 				'nextkin_name_one' => $this->input->post('nextkin_name_one'),
// 				'nextkin_email_one' => $this->input->post('nextkin_email_one'),
// 				'nextkin_relationship_one' => $this->input->post('nextkin_relationship_one'),
// 				'nextkin_name_two' => $this->input->post('nextkin_name_two'),
// 				'nextkin_email_two' => $this->input->post('nextkin_email_two'),
// 				'nextkin_relationship_two' => $this->input->post('nextkin_relationship_two'),
// 				'agree_terms_one' => $this->input->post('agree_terms_one'),
// 				'agree_terms_two' => $this->input->post('agree_terms_two'),
// 				'bank_1' => $this->input->post('bank_1'),
// 				'bank_branch_1' => $this->input->post('bank_branch_1'),
// 				'bsb_1' => $this->input->post('bsb_1'),
// 				'account_no_1' => $this->input->post('account_no_1'),
// 				'percentage_1' => $this->input->post('percentage_1'),
// 				'account_name_1' => $this->input->post('account_name_1'),
// 				'bank_2' => $this->input->post('bank_2'),
// 				'bank_branch_2' => $this->input->post('bank_branch_2'),
// 				'bsb_2' => $this->input->post('bsb_2'),
// 				'account_no_2' => $this->input->post('account_no_2'),
// 				'percentage_2' => $this->input->post('percentage_2'),
// 				'account_name_2' => $this->input->post('account_name_2'),
// 				'bank_3' => $this->input->post('bank_3'),
// 				'bank_branch_3' => $this->input->post('bank_branch_3'),
// 				'bsb_3' => $this->input->post('bsb_3'),
// 				'account_no_3' => $this->input->post('account_no_3'),
// 				'percentage_3' => $this->input->post('percentage_3'),
// 				'account_name_3' => $this->input->post('account_name_3'),
// 				'entity' => $this->input->post('entity'),
// 				'police_surname' => $this->input->post('police_surname'),
// 				'given_name' => $this->input->post('given_name'),
// 				'address' => $this->input->post('address'),
// 				'medical_history' => $this->input->post('medical_history'),
// 				'fire_emg_completed_date' => $this->input->post('fire_emg_completed_date'),
// 				'oh_s_completed_date' => $this->input->post('oh_s_completed_date'),
// 				'police_certificate' => $final_file_name
// 				);
// 			$result = $this->employees_model->add_induction_form($data,$emp_id);
// 	}
// 	function open_timesheet() {
// 	   $result = $this->employees_model->get_employees();
//           $data['employees'] = $result;
//           $this->load->view('employees/open_timesheet',$data);
// 	}
	
//      public function manager_leave_filter($endate='',$date='',$status=''){
// 	         $user_email = $this->ion_auth->user()->row()->email;
// 			 $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			 
// 	    $params=array();
// 			if($endate!=''&&$endate!='unset')
// 				$params['end_ate']=$endate;
				
// 			if($date!=''&&$date!='unset')
// 				$params['start_date']=$date;
// 			if($status!=''&&$status!='unset')
// 				$params['status']=$status;
	

	    			
// 	    $leaves = $this->employees_model->getleaves($params,$emp_id);	
// 		$data['leaves'] = $leaves;
				
// 				$this->load->view('general/header');
// 				$this->load->view('employees/leave_history',$data);
// 				$this->load->view('general/footer');

// 	}
	
// 	function emp_timesheet($id) {
// 	   $result = $this->employees_model->get_employee_timesheet($id);
//           $data['employees'] = $result;
//           $this->load->view('employees/employee_timesheet',$data);
// 	}
// 	function submit_employee_timesheet() {
// 	   if ($this->form_validation->run() == true) {
//             $data = array(
//             	'employee_id' => $this->input->post('emp_id'),
//             	'date' => date('Y-m-d'),
//             	'in_time' => $this->input->post('emp_id'),
//             	'out_time' => $this->input->post('emp_id')
//             	);
//           $result = $this->employees_model->submit_employee_timesheet($data); 	
// 		}else{
			 
// 		 }
// 		 redirect('employees/open_timesheet');
// 	}
// 	public function upload($emp_id){
		
// 		// echo '<pre>';print_r($_FILES);exit;
		
// 		$file_name = 'induction_'.rand('10000','99999');
//     	$config['upload_path'] = 'assets/docs/emp_uploads/';
//         $config['allowed_types'] = 'jpg|jpeg|png|pdf';
//         $config['max_size']             = 1024;
//         $config['max_width']            = 5000;
//         $config['max_height']           = 5000;
//         $config['file_name'] = $file_name;

//         $this->load->library('upload',$config);
//         $this->upload->initialize($config);
        
//         if($this->upload->do_upload('file')){
//             $uploadData = $this->upload->data();
//             $picture = $uploadData['file_name'];
//         }else{
//             $picture = '';
//         }
//         //echo $picture;exit;
//         $path = 'assets/docs/emp_uploads/'.str_replace(' ','_',$picture);
//         $filename = $_FILES['file']['name'];
//         // echo $filename;exit;
        
//         $data = array(
//         	'employee_id' => $emp_id,
//         	'file_type' => $_FILES['file']['type'],
//             'file_name' => $picture,
//             'path' => $path
//             );
//         $res = $this->employees_model->update($data,$emp_id);
//         //echo "<pre>";print_r($res);exit;
//         $msg="";
						
// 			foreach($res as $row){
// 						$msg.="<div class='col-sm-3'>
// 	       	    <img src=".base_url('').'assets/docs/emp_uploads/'.$row->file_name." style='width:100%;min-height:200px;' alt='image1' class='upload-file'>
// 		<button  class='btn btn-info' ><a href=".base_url('').'assets/docs/emp_uploads/'.$row->file_name." style='text-decoration:none;' target='_blank'>View</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button target='_blank' class='btn btn-info'><a type='button' style='text-decoration:none;' onClick='delete_row(".$row->doc_id.");' id='$emp_id'>Delete</a></button>	
// 	    </div>";
// 			   }

        
// 	    echo $msg;
//     }
//     public function deletefiles(){
        
//     	$id = $_POST['id'];
//     	$result = $this->employees_model->get_docs_name($id);
//     	$path = $result[0]->path;
//     	$file = FCPATH.$path;
//     	// echo $file;exit;
//     	unlink($file);
//     	$result = $this->employees_model->delete_doc($id);
//     }
     
// 	public function leave_management(){
	     
// 		   $user_id = $this->ion_auth->user()->row()->id;
//           $user_email = $this->ion_auth->user()->row()->email;
// 		   $id = $this->admin_model->get_emp_details_fromemail($user_email);
			
// 		   $data['emp_id'] = $id;
// 		   $this->load->view('general/header');
//           $this->load->view('employees/leave_mng',$data);
// 		   $this->load->view('general/footer');
// 	}
// 	public function submit_leave(){
// 	 $emp_id = $this->input->post('emp_id');
// 			$branch_result = $this->employees_model->get_emp_update($emp_id);

// 			foreach($branch_result as $row){
// 				$branchId = $row->branch_id;
// 			}
// 			//echo $branchId;exit;
// 			if($_FILES['med_certificate']['name'] != ''){
// 			$target_dir = 'assets/leave_certificates/';
// 		  	$userfile_name = $_FILES['med_certificate']['name'];
//             $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
// 		  	$file_name = 'leave_'.rand('10000','99999');
// 		  	//$file_name = $_FILES["resume"]["name"];
// 		  	$i = ".";
//             $final_file_name=$file_name.$i.$userfile_extn;
//             $target_file = $target_dir . $final_file_name;
//             $file = move_uploaded_file($_FILES["med_certificate"]["tmp_name"], $target_file);
// 			}else{
// 				$final_file_name = "";
// 			}
// 			$start_date = $this->input->post('start_date');
// 			$end_date = $this->input->post('end_date');
// 			$s_date = date('Y-m-d', strtotime($start_date));
// 			$e_date = date('Y-m-d', strtotime($end_date));
// 		$data = array(
// 		   'emp_id' => $emp_id,
// 		   'leave_type' => $this->input->post('leave_type'),
// 		   'start_date' => $s_date,
// 		   'end_date' => $e_date,
// 		   'leave_status' => 'Pending',
// 		   'medical_certificate' => $final_file_name,
// 		   'comments' => '',
// 		   'branch_id' => $branchId
// 		);
// 		//echo '<pre>';print_r($data);exit;
// 		$result = $this->employees_model->add_leave($data);
// 		if($result){
// 		    // send notifaction to manager when emp apply for leave using a helper function
//          add_notification('leave_apply','manager',$emp_id);
         
// 		    $to = $branch_result[0]->manager_email;
		       
// 		  $msg = ' 
//     <html> 
//     <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

//         <title></title> 
//     </head> 
//     <body> 
//         Hi Manager,
// '.$branch_result[0]->first_name.' has requested leave. Please login to the HR portal to approve/reject/add more comments for the leave request. '.$branch_result[0]->first_name.' will be notified of the outcome.
//  <p>Kind Regards,</p>
//         <p>HR Team</p>
//          </body> 
//          </html>';  
        
//       $emp_details = array(
// 			     'send_to' =>$to,
// 			     'subject' =>  "Leave Requested by ".$branch_result[0]->first_name,
			    
// 			     );  
		   
// 		      if($this->get_content_and_send_mail($emp_details,$msg)){    
// 				$this->session->set_flashdata('sucess_msg', '-	Your Leave Request has been sent to the manager for Review. An email notification will be sent once the manager has an update on the request.');
// 				redirect('employees/leave_management');
// 		      }
// 			}else{
// 				$this->session->set_flashdata('error_msg', 'Unable to send your leave request. Contact your Manager.');
// 				redirect('employees/leave_management');
// 			}
// 	}
// 	public function leave_history(){
	
// 				$leaves = $this->employees_model->get_emp_leave_details($this->ion_auth->user()->row()->id);
// 				$data['leaves'] = $leaves;
				
// 				$this->load->view('general/header');
// 				$this->load->view('employees/leave_history',$data);
// 				$this->load->view('general/footer');
// 	}
// 	public function emp_leave_check($id){
// 		       $leaves = $this->employees_model->get_leaves_manager_update($id);
// 				$data['leaves'] = $leaves;
// 				$data['leave_id'] = $id;
// 				//echo '<pre>';print_r($leaves);exit;
// 				$data['leaves'] = $leaves;
				
// 				$this->load->view('general/header');
// 				$this->load->view('employees/leave_history',$data);
// 				$this->load->view('general/footer');
// 	}
// 	function roster_history() {
// 	           $roster = $this->employees_model->get_roster_emp($this->ion_auth->user()->row()->id);
//                 $data['roster'] = $roster;
// 				$this->load->view('general/header');
// 				$this->load->view('employees/emp_roster_history',$data);
// 				$this->load->view('general/footer');
// 	}
//     function emp_week_roster($date) {
// 	   	$employees = $this->employees_model->get_employees_branchwise($this->location_id);				
// 				$roster = $this->employees_model->emp_week_roster($this->ion_auth->user()->row()->id,$date);
// 				foreach($roster as $row){
// 					$s_date = $row->start_date;
// 					$e_date = $row->end_date;
// 				}
// 				$data['employees'] = $employees;
//                 $data['roster'] = $roster;
// 				$data['start_date'] = $s_date;
//                 $data['end_date'] = $e_date;
				
// 				$this->load->view('general/header');
// 				$this->load->view('employees/emp_rost_detail_view',$data);
// 				$this->load->view('general/footer');
// 	}
}
