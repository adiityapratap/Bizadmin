<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roster extends MY_Controller {

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
    
    
   function rosterForm() {
    // Set session data for previous URL
    $this->session->set_userdata('previous_url', current_url());

    // Common conditions
    $conditions = ['location_id' => $this->location_id, 'is_deleted' => '0'];

    // Base data array
    $data = [
        'empLists' => $this->employee_model->employeeList('', '', true),
        'positionLists' => $this->common_model->fetchRecordsDynamically('HR_emp_position', '', $conditions),
        'prepAreas' => $this->common_model->fetchRecordsDynamically('HR_prepArea', '', $conditions),
        'rosterId' => 0,
        'weekRange' => '',
        'rosterStartDate' => '',
        'rosterInfo' => [],
        'allDayRosterData' => []
    ];

    // Calculate current week's date range (Monday to Sunday)
    try {
        $startDate = new DateTime('monday this week');
        $endDate = (clone $startDate)->modify('+6 days');
        $data['rosterStartDate'] = $startDate->format('Y-m-d');
        $data['weekRange'] = $startDate->format('d M') . ' - ' . $endDate->format('d M');
    } catch (Exception $e) {
        // Fallback in case of DateTime failure
        $data['rosterStartDate'] = date('Y-m-d');
        $data['weekRange'] = date('d M') . ' - ' . date('d M', strtotime('+6 days'));
    }

    // Simulate query parameters for fetchRosterByWeek
    $_GET['weekRange'] = $data['weekRange'];
    $_GET['rosterStartDate'] = $data['rosterStartDate'];

    // Call fetchRosterByWeek and capture its data
    $rosterData = $this->fetchRosterByWeek(true);

    // Merge roster data with existing data, ensuring no overwrite of critical fields
    $data = array_merge($data, array_intersect_key($rosterData, [
        'rosterId' => true,
        'weekRange' => true,
        'rosterStartDate' => true,
        'rosterInfo' => true,
        'allDayRosterData' => true
    ]));
  
    // Load views
    $this->load->view('general/header');
    $this->load->view('roster/roster', $data);
    $this->load->view('general/footer');
}

   public function fetchRosterByWeek($returnData = false) {
    // Fetch and decode query parameters with null coalescing
    $weekRange = urldecode($this->input->get('weekRange', true)) ?? '';
    $rosterStartDate = urldecode($this->input->get('rosterStartDate', true)) ?? '';
    $locationId = $this->location_id;

    // Initialize data array
    $data = [
        'rosterId' => 0,
        'weekRange' => $weekRange,
        'rosterStartDate' => $rosterStartDate,
        'empLists' => $this->employee_model->employeeList('', '', true),
        'positionLists' => $this->common_model->fetchRecordsDynamically('HR_emp_position', '', ['is_deleted' => 0]),
        'prepAreas' => $this->common_model->fetchRecordsDynamically('HR_prepArea', '', ['is_deleted' => 0]),
        'rosterInfo' => [],
        'allDayRosterData' => []
    ];

    // Validate and parse rosterStartDate
    try {
        if (empty($rosterStartDate)) {
            throw new Exception('Roster start date is missing.');
        }
        $startDate = new DateTime($rosterStartDate);
        $endDate = (clone $startDate)->modify('+6 days');
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');
    } catch (Exception $e) {
        // Fallback to current week's Monday if date is invalid
        $startDate = new DateTime('monday this week');
        $endDate = (clone $startDate)->modify('+6 days');
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');
        $data['weekRange'] = $startDate->format('d M') . ' - ' . $endDate->format('d M');
    }

    // Fetch rosters from HR_roster for the given week range and location
    $whereRoster = [
        'start_date <=' => $endDateFormatted,
        'end_date >=' => $startDateFormatted,
        'location_id' => $locationId,
        'is_deleted' => 0
    ];
    $rosterInfo = $this->common_model->fetchRecordsDynamically('HR_roster', '', $whereRoster);
    $data['rosterInfo'] = $rosterInfo ?? [];

    // Fetch roster details for the matched rosters
    $rosterDetails = [];
    if (isset($rosterInfo) && !empty($rosterInfo)) {
        $rosterId = $rosterInfo[0]['roster_id'] ?? null;
        if (!empty($rosterId)) {
            $whereDetails = ['roster_id' => $rosterId,'is_deleted' => 0];
            $rosterDetails = $this->common_model->fetchRecordsDynamically('HR_roster_details', '', $whereDetails);
        }
    }

    // Format roster details for localStorage
    $allDayRosterData = [];
    if (isset($rosterDetails) && !empty($rosterDetails)) {
        foreach ($rosterDetails as $detail) {
            $shiftBoxName = date('d', strtotime($detail['roster_date'] ?? date('Y-m-d'))) . '_' . ($detail['prep_area_id'] ?? 0);
            $key = "emp_{$shiftBoxName}_" . ($detail['employee_id'] ?? 0);

            $dataEmp = [
                'employeeId' => $detail['employee_id'] ?? 0,
                'position_id' => $detail['position_id'] ?? 0,
                'selectedEmpName' => $this->getEmployeeName($detail['employee_id'] ?? 0) ?? 'Unknown',
                'empShiftStartTime' => $detail['shift_start_time'] ?? '',
                'empShiftEndTime' => $detail['shift_end_time'] ?? '',
                'empBreakTime' => $detail['break_start_time'] ?? '',
                'breakType' => $detail['break_type'] ?? '',
                'breakDuration' => $detail['break_duration'] ?? '',
                'taskDescr' => $detail['task_description'] ?? '',
                'rosterDate' => date('d-m-Y', strtotime($detail['roster_date'] ?? date('Y-m-d')))
            ];
            $allDayRosterData[$key] = json_encode($dataEmp, JSON_THROW_ON_ERROR);
        }
    }
    $data['rosterId'] = $rosterId ?? 0;
    $data['allDayRosterData'] = $allDayRosterData;

    if ($returnData) {
        return $data;
    }

    // Load views
    $this->load->view('general/header');
    $this->load->view('roster/roster', $data);
    $this->load->view('general/footer');
}
    
    function rosterList(){
        $this->session->set_userdata('previous_url', current_url());
     $conditions = array('location_id' => $this->location_id, 'is_deleted' => '0','status'=> 1);
     $data['rosterList'] = $this->common_model->fetchRecordsDynamically('HR_roster','',$conditions);
      $this->load->view('general/header');
	  $this->load->view('roster/rosterList',$data);
	  $this->load->view('general/footer');
    //  echo "<pre>"; print_r($rosterList); exit;
    }
    

// add roster details at the same time populate timesheet table also with the employee from roster table
   public function addRoster() {
        // Get the posted data
        $empDatas = $this->input->post();

        // Parse the week range (e.g., "26 May - 01 Jun")
        $rosterWeek = $this->createDateForRoster($empDatas['week']);
        $startDate = new DateTime($rosterWeek['start_date']);
        $endDate = new DateTime($rosterWeek['end_date']);
        $endDate->modify('+1 day');

        // Prepare roster data for the HR_roster table
        $conditions = [
            'location_id' => $this->location_id,
            'is_deleted' => '0',
            'start_date' => $rosterWeek['start_date']
        ];

        // Check if a roster already exists for this week and location
        $cols = ['roster_id'];
        $existingRosterOfThisWeek = $this->common_model->fetchRecordsDynamically('HR_roster', $cols, $conditions);
        $updateRecord = false;
        $rosterData = [
            'start_date' => $rosterWeek['start_date'],
            'end_date' => $rosterWeek['end_date'],
            'location_id' => $this->location_id,
            'rosterName' => $empDatas['rosterName'] ?: $rosterWeek['start_date'] . ' to ' . $rosterWeek['end_date'],
            'is_published' => ($empDatas['savetype'] == 'publish' ? 1 : 0),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->tenantDb->trans_start();
        if (!empty($existingRosterOfThisWeek)) {
            $updateRecord = true;
            $rosterId = $existingRosterOfThisWeek[0]['roster_id'];
            $this->common_model->commonRecordUpdate('HR_roster', 'roster_id', $rosterId, $rosterData);
        } else {
            $rosterData['created_at'] = date('Y-m-d H:i:s');
            $rosterId = $this->common_model->commonRecordCreate('HR_roster', $rosterData);
        }

        // Prepare roster details
        $rosterData = [];
        foreach ($empDatas as $key => $value) {
            if (!preg_match('/^emp_\d+_\d+_\d+$/', $key)) continue;
            $shiftData = json_decode($value, true);
            if (!$shiftData) continue;

            $keyParts = explode('_', $key);
            $prepAreaId = isset($keyParts[2]) ? (int)$keyParts[2] : null;
            if (!$prepAreaId) continue;

            $rosterDate = DateTime::createFromFormat('d-m-Y', $shiftData['rosterDate']);
            if (!$rosterDate) continue;
            $formattedRosterDate = $rosterDate->format('Y-m-d');

            $shiftStartTime = !empty($shiftData['empShiftStartTime']) ? $this->convertTo24HourFormat($shiftData['empShiftStartTime']) : null;
            $shiftEndTime = !empty($shiftData['empShiftEndTime']) ? $this->convertTo24HourFormat($shiftData['empShiftEndTime']) : null;
            $breakStartTime = !empty($shiftData['empBreakTime']) ? $this->convertTo24HourFormat($shiftData['empBreakTime']) : null;

            $rosterData[] = [
                'roster_id' => $rosterId,
                'employee_id' => $shiftData['employeeId'],
                'position_id' => $shiftData['position_id'] ?: null,
                'prep_area_id' => $prepAreaId,
                'roster_date' => $formattedRosterDate,
                'shift_start_time' => $shiftStartTime,
                'shift_end_time' => $shiftEndTime,
                'break_start_time' => $breakStartTime,
                'break_type' => $shiftData['breakType'],
                'break_duration' => $shiftData['breakDuration'],
                'task_description' => !empty($shiftData['taskDescr']) ? $shiftData['taskDescr'] : null,
                'is_deleted' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        // Synchronize roster details
        if ($updateRecord) {
            $this->synchronizeRosterDetails($rosterId, $rosterData);
        } else {
            if (!empty($rosterData)) {
                $this->common_model->commonBulkRecordCreate('HR_roster_details', $rosterData);
            }
        }

        // Synchronize timesheet
        $this->synchronizeTimesheetFromRoster($rosterId);

        $this->tenantDb->trans_complete();
        if ($this->tenantDb->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Database error occurred']);
            return;
        }

        $message = $updateRecord ? 'Roster updated successfully' : 'Roster created successfully';
        echo json_encode(['status' => 'success', 'message' => $message]);
    }
    
// used when we create/edit a roster we have to accordingly make changes in timesheet table
    public function synchronizeRosterDetails($rosterId, $newRosterData) {
        // Fetch all existing roster details (including soft-deleted)
        $existingDetails = $this->common_model->fetchRecordsDynamically(
            'HR_roster_details',
            ['id', 'employee_id', 'roster_date', 'is_deleted'],
            ['roster_id' => $rosterId]
        );

        // Create a lookup for new roster data
        $newRosterLookup = [];
        foreach ($newRosterData as $new) {
            $key = $new['employee_id'] . '|' . $new['roster_date'];
            $newRosterLookup[$key] = $new;
        }

        // Mark existing records as deleted if not in new data
        foreach ($existingDetails as $existing) {
            $key = $existing['employee_id'] . '|' . $existing['roster_date'];
            if (!isset($newRosterLookup[$key])) {
                if ($existing['is_deleted'] == 0) {
                    $this->common_model->commonRecordUpdate(
                        'HR_roster_details',
                        'id',
                        $existing['id'],
                        ['is_deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]
                    );
                }
            }
        }

        // Insert or update new roster details
        $recordsToInsert = [];
        foreach ($newRosterData as $new) {
            $key = $new['employee_id'] . '|' . $new['roster_date'];
            $existingRecord = null;
            foreach ($existingDetails as $existing) {
                if ($existing['employee_id'] == $new['employee_id'] && $existing['roster_date'] == $new['roster_date']) {
                    $existingRecord = $existing;
                    break;
                }
            }

            if ($existingRecord) {
                // Update existing record, even if soft-deleted
                $updateData = array_merge($new, ['is_deleted' => 0, 'updated_at' => date('Y-m-d H:i:s')]);
                $this->common_model->commonRecordUpdate(
                    'HR_roster_details',
                    'id',
                    $existingRecord['id'],
                    $updateData
                );
            } else {
                // New record to insert
                $recordsToInsert[] = $new;
            }
        }

        if (!empty($recordsToInsert)) {
            $this->common_model->commonBulkRecordCreate('HR_roster_details', $recordsToInsert);
        }
    }
// used when we create/edit a roster we have to accordingly make changes in timesheet table
    public function synchronizeTimesheetFromRoster($rosterId) {
        if (empty($rosterId) || !is_numeric($rosterId)) {
            return ['status' => 'error', 'message' => 'Invalid roster ID'];
        }

        // Fetch roster details
        $rosterDetails = $this->common_model->fetchRecordsDynamically(
            'HR_roster_details',
            [],
            ['roster_id' => $rosterId, 'is_deleted' => 0]
        );

        if (empty($rosterDetails)) {
            return ['status' => 'error', 'message' => 'No roster details found'];
        }

        // Fetch all existing timesheet entries (including soft-deleted)
        $existingTimesheets = $this->common_model->fetchRecordsDynamically(
            'HR_timesheet',
            ['timesheet_id', 'employee_id', 'roster_date', 'clock_in_time', 'clock_out_time', 'actual_break_duration', 'approval_status', 'is_deleted'],
            ['roster_id' => $rosterId]
        );

        // Create a lookup for existing timesheet entries
        $timesheetLookup = [];
        foreach ($existingTimesheets as $ts) {
            $key = $ts['employee_id'] . '|' . $ts['roster_date'];
            $timesheetLookup[$key] = $ts;
        }

        // Prepare timesheet entries
        $recordsToInsert = [];
        $recordsToUpdate = [];
        foreach ($rosterDetails as $detail) {
            $key = $detail['employee_id'] . '|' . $detail['roster_date'];
            $timesheetData = [
                'roster_id' => $rosterId,
                'employee_id' => $detail['employee_id'] ?? 0,
                'prep_area_id' => $detail['prep_area_id'] ?? 0,
                'position_id' => $detail['position_id'] ?? 0,
                'roster_date' => $detail['roster_date'] ?? date('Y-m-d'),
                'roster_start_time' => $detail['shift_start_time'] ?? null,
                'roster_end_time' => $detail['shift_end_time'] ?? null,
                'roster_break_start_time' => $detail['break_start_time'] ?? null,
                'roster_break_duration' => $detail['break_duration'] ?? 0,
                'roster_break_type' => $detail['break_type'] ?? '',
                'task_description' => $detail['task_description'] ?? '',
                'approval_status' => 'pending',
                'is_deleted' => 0,
                'location_id' =>$this->location_id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (isset($timesheetLookup[$key])) {
                // Update existing timesheet, preserving clock-in/out times
                $existing = $timesheetLookup[$key];
                $timesheetData['clock_in_time'] = $existing['clock_in_time'];
                $timesheetData['clock_out_time'] = $existing['clock_out_time'];
                $timesheetData['actual_break_duration'] = $existing['actual_break_duration'];
                $timesheetData['approval_status'] = $existing['approval_status'];
                $recordsToUpdate[] = array_merge($timesheetData, ['timesheet_id' => $existing['timesheet_id']]);
            } else {
                // New timesheet entry
                $timesheetData['clock_in_time'] = null;
                $timesheetData['clock_out_time'] = null;
                $timesheetData['actual_break_duration'] = 0;
                $timesheetData['created_at'] = date('Y-m-d H:i:s');
                $recordsToInsert[] = $timesheetData;
            }
        }

        // Mark timesheet entries as deleted if not in roster details
        foreach ($existingTimesheets as $ts) {
            $key = $ts['employee_id'] . '|' . $ts['roster_date'];
            $found = false;
            foreach ($rosterDetails as $detail) {
                if ($detail['employee_id'] == $ts['employee_id'] && $detail['roster_date'] == $ts['roster_date']) {
                    $found = true;
                    break;
                }
            }
            if (!$found && $ts['is_deleted'] == 0) {
                $this->common_model->commonRecordUpdate(
                    'HR_timesheet',
                    'timesheet_id',
                    $ts['timesheet_id'],
                    ['is_deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }
        }

        // Insert new timesheet entries
        if (!empty($recordsToInsert)) {
            $this->common_model->commonBulkRecordCreate('HR_timesheet', $recordsToInsert);
        }

        // Update existing timesheet entries
        foreach ($recordsToUpdate as $record) {
            $timesheetId = $record['timesheet_id'];
            unset($record['timesheet_id']);
            $this->common_model->commonRecordUpdate('HR_timesheet', 'timesheet_id', $timesheetId, $record);
        }

        return ['status' => 'success', 'message' => 'Timesheet synchronized successfully'];
    }

/**
 * Convert time from 12-hour format (e.g., "9:00 AM") to 24-hour format (e.g., "09:00:00")
 * @param string $time Time in 12-hour format
 * @return string|null Time in 24-hour format or null if invalid
 */
  private function convertTo24HourFormat($time) {
    if (empty($time)) {
        return null;
    }

    // Normalize the input: trim whitespace, convert AM/PM to uppercase
    $time = trim($time);
    $time = preg_replace('/\s+/', ' ', $time); // Ensure single space between time and AM/PM
    $time = str_replace(['am', 'pm'], ['AM', 'PM'], strtolower($time));

    try {
        // First, check if the time is already in 24-hour format (HH:MM:SS)
        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $time)) {
            // Validate the time components
            list($hours, $minutes, $seconds) = explode(':', $time);
            if ($hours >= 0 && $hours <= 23 && $minutes >= 0 && $minutes <= 59 && $seconds >= 0 && $seconds <= 59) {
                return $time; // Already in 24-hour format, return as-is
            }
        }

        // Try parsing as 12-hour format
        $dateTime = DateTime::createFromFormat('h:i A', $time); // e.g., "11:00 AM"
        if ($dateTime === false) {
            $dateTime = DateTime::createFromFormat('g:i A', $time); // e.g., "9:00 AM"
        }
        if ($dateTime === false) {
            $dateTime = DateTime::createFromFormat('h:ia', $time); // e.g., "11:00AM"
        }
        if ($dateTime === false) {
            $dateTime = DateTime::createFromFormat('g:ia', $time); // e.g., "9:00AM"
        }

        if ($dateTime === false) {
            log_message('error', "Invalid time format: $time");
            return null;
        }

        return $dateTime->format('H:i:s');
    } catch (Exception $e) {
        log_message('error', "Error converting time: $time, Error: " . $e->getMessage());
        return null;
    }
}
 
  
 
    
    function createDateForRoster($string){
     $parts = explode(" - ", $string);
     $start_date = $parts[0];
     $end_date = $parts[1];

     $start_timestamp = strtotime("$start_date " . date('Y'));
     $end_timestamp = strtotime("$end_date " . date('Y'));
  
     // Convert timestamps to the desired format
     $start_date_formatted = date('Y-m-d', $start_timestamp);
     $end_date_formatted = date('Y-m-d', $end_timestamp);
     $resultArray['start_date'] = $start_date_formatted;
     $resultArray['end_date'] = $end_date_formatted;
    
     return $resultArray;
    }
    

    // working code
    public function rosterView($roster_id = 0) {
  $data['rosterId'] = $roster_id;
  $data['weekRange'] = $this->input->get('weekRange') ?? '';
  $data['rosterStartDate'] = $this->input->get('rosterStartDate') ?? '';
  $data['empLists'] =  $this->employee_model->employeeList('','',true);
  $data['positionLists'] = $this->common_model->fetchRecordsDynamically('HR_emp_position','', ['is_deleted' => 0]);
  $data['prepAreas'] = $this->common_model->fetchRecordsDynamically('HR_prepArea','', ['is_deleted' => 0]);

  // Fetch roster info
  
  $data['rosterInfo'] = $this->common_model->fetchRecordsDynamically('HR_roster','', ['roster_id' => $roster_id]);
  // Fetch roster details and format for localStorage
  $rosterDetails = $this->common_model->fetchRecordsDynamically('HR_roster_details','', ['roster_id' => $roster_id,'is_deleted' => 0]);
 
  $allDayRosterData = [];
  foreach ($rosterDetails as $detail) {
    $shiftBoxName = date('d', strtotime($detail['roster_date'])) . '_' . $detail['prep_area_id']; // Adjust prep_area_id if needed
    $key = "emp_{$shiftBoxName}_{$detail['employee_id']}";
    $dataEmp = [
      'employeeId' => $detail['employee_id'],
      'position_id' => $detail['position_id'],
      'selectedEmpName' => $this->getEmployeeName($detail['employee_id']), // Implement this method
      'empShiftStartTime' => $detail['shift_start_time'],
      'empShiftEndTime' => $detail['shift_end_time'],
      'empBreakTime' => $detail['break_start_time'],
      'breakType' => $detail['break_type'],
      'breakDuration' => $detail['break_duration'],
      'taskDescr' => $detail['task_description'],
      'rosterDate' => date('d-m-Y', strtotime($detail['roster_date']))
    ];
    $allDayRosterData[$key] = json_encode($dataEmp);
  }
  $data['allDayRosterData'] = $allDayRosterData;
  
      $this->load->view('general/header');
	  $this->load->view('roster/roster',$data);
	  $this->load->view('general/footer');
//   $this->load->view('hr/roster_view', $data);
}




   private function getEmployeeName($emp_id) {
  $employee = $this->common_model->fetchRecordsDynamically('HR_employee', ['first_name', 'last_name'], ['emp_id' => $emp_id]);

  if (isset($employee[0]['first_name'], $employee[0]['last_name'])) {
    return $employee[0]['first_name'] . ' ' . $employee[0]['last_name'];
  }
  return '';
}

    
    // view roster by team member
    function rosterViewByTM($rosterId=''){
        
      $conditionsRoster = array('roster_id' => $rosterId,'is_deleted' => 0);    
      $rosterData = $this->common_model->fetchRecordsDynamically('HR_roster_details','',$conditionsRoster);
     
      $data['rosterId'] = $rosterId;    
     
     
      $conditions = array('location_id' => $this->location_id, 'is_deleted' => '0');

      $data['empLists'] =  $this->employee_model->employeeList('','',true);
      $data['positionLists'] = $this->common_model->fetchRecordsDynamically('HR_emp_position','',$conditions); 
      
      $data['prepAreas'] = $this->common_model->fetchRecordsDynamically('HR_prepArea','',$conditions);
   	  $data['sites'] = $this->common_model->fetchRecordsDynamically('HR_sites','',$conditions);
      $dayName = strtolower(date("l")); // monday, friday etc..
      

      if(isset($rosterData[0][$dayName]) && !empty($rosterData[0][$dayName])){
      $dayDatas = json_decode($rosterData[0][$dayName]);
      $rosterDayWiseData = array();
      
      foreach($dayDatas as $empKey => $dayData){
      $empInfo = explode('_',$empKey);
      $empID =  (isset($empInfo[3]) ? $empInfo[3] : '0');
      $prepID =  (isset($empInfo[2]) ? $empInfo[2] : '0');
      
      $conditions = array('id' => $prepID);    $fieldsToFetch = ['prep_name'];
      $prepName = $this->common_model->fetchRecordsDynamically('HR_prepArea',$fieldsToFetch,$conditions); 
      $decodedRosterValues = json_decode($dayData);
      
      $timeDataDecoded = json_decode($dayData);
      $timeData['workHrs'] = $timeDataDecoded->empShiftStartTime. '- ' .$timeDataDecoded->empShiftEndTime;
      $timeData['breakHrs'] = $timeDataDecoded->empBreakTime ? $timeDataDecoded->empBreakTime :'';
      $timeData['breakDuration'] = $timeDataDecoded->breakDuration ? $timeDataDecoded->breakDuration : '';
      $timeData['prep_name'] = $prepName[0]['prep_name'];
      if(!isset($rosterDayWiseData[$empID][$prepID])){
      $rosterDayWiseData[$empID][$prepID] = $timeData;    
      }
      }
      }
     $data['rosterDayWiseData'] = $rosterDayWiseData;
   
      $this->load->view('general/header');
	  $this->load->view('roster/rosterViewByTM',$data);
	  $this->load->view('general/footer');  
    }
    
    public function rosterViewWTM($rosterId = '') {
    // Validate roster ID
    if (empty($rosterId)) {
        $this->session->set_flashdata('error_message', 'Invalid roster ID.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Fetch necessary data
    $conditions = ['location_id' => $this->location_id, 'is_deleted' => '0'];
    $data['empLists'] = $this->employee_model->employeeList('', '', true);
    $data['positionLists'] = $this->common_model->fetchRecordsDynamically('HR_emp_position', '', $conditions);
    $data['prepAreas'] = $this->common_model->fetchRecordsDynamically('HR_prepArea', '', $conditions);

    // Fetch roster metadata
    $rosterConditions = ['roster_id' => $rosterId, 'location_id' => $this->location_id, 'is_deleted' => '0'];
    $rosterInfo = $this->common_model->fetchRecordsDynamically('HR_roster', '', $rosterConditions);
    if (empty($rosterInfo)) {
        $this->session->set_flashdata('error_message', 'Roster not found.');
        redirect($this->session->userdata('previous_url'));
        return;
    }
    $data['rosterInfo'] = $rosterInfo;

    // Fetch roster details
    $rosterDetailConditions = ['roster_id' => $rosterId,'is_deleted' => 0];
    $rosterDetails = $this->common_model->fetchRecordsDynamically('HR_roster_details', '', $rosterDetailConditions);
    log_message('debug', 'Roster Details Query: ' . $this->db->last_query());
    log_message('debug', 'Roster Details: ' . json_encode($rosterDetails));

    // Determine the week range
    $startDate = new DateTime($rosterInfo[0]['start_date']);
    $endDate = new DateTime($rosterInfo[0]['end_date']);
    $days = [];
    $currentDate = clone $startDate;
    while ($currentDate <= $endDate) {
        $days[] = [
            'date' => $currentDate->format('Y-m-d'),
            'day' => strtolower($currentDate->format('l')) // e.g., 'monday'
        ];
        $currentDate->modify('+1 day');
    }

    // Organize roster data by employee
    $rosterViewWTM = [];
    if (!empty($rosterDetails)) {
        foreach ($rosterDetails as $detail) {
            $empId = $detail['employee_id'];
            $prepId = $detail['prep_area_id'];
            $rosterDate = new DateTime($detail['roster_date']);
            $dayOfWeek = strtolower($rosterDate->format('l')); // e.g., 'monday'

            // Find employee details
            $empIndex = array_search($empId, array_column($data['empLists'], 'emp_id'));
            if ($empIndex === false) {
                continue; // Skip if employee not found
            }

            // Find prep area details
            $prepIndex = array_search($prepId, array_column($data['prepAreas'], 'id'));
            $prepName = $prepIndex !== false ? $data['prepAreas'][$prepIndex]['prep_name'] : '';

            // Initialize employee entry if not already set
            if (!isset($rosterViewWTM[$empId])) {
                $rosterViewWTM[$empId] = [
                    'emp_name' => $data['empLists'][$empIndex]['name'],
                    'prep_name' => $prepName,
                    'prep_id' => $prepId
                ];
            }

            // Add shift details for the day
            $rosterViewWTM[$empId][$dayOfWeek] = [
                'start_time' => $detail['shift_start_time'] ? date('h:i A', strtotime($detail['shift_start_time'])) : '',
                'end_time' => $detail['shift_end_time'] ? date('h:i A', strtotime($detail['shift_end_time'])) : '',
                'break_time' => $detail['break_start_time'] ? date('h:i A', strtotime($detail['break_start_time'])) : '',
                'break_type' => $detail['break_type'],
                'break_duration' => $detail['break_duration'],
                'task_description' => $detail['task_description']
            ];
        }

        // Ensure all days are initialized for each employee (even if no shift)
        $dayKeys = array_column($days, 'day');
        foreach ($rosterViewWTM as &$empData) {
            foreach ($dayKeys as $day) {
                if (!isset($empData[$day])) {
                    $empData[$day] = [
                        'start_time' => '',
                        'end_time' => '',
                        'break_time' => '',
                        'break_type' => '',
                        'break_duration' => '',
                        'task_description' => ''
                    ];
                }
            }
        }
        unset($empData); // Unset the reference
    }

    // Pass data to the view
    $data['rosterId'] = $rosterId;
    $data['rosterViewWTM'] = $rosterViewWTM;
    $data['days'] = $days; // For displaying the week range in the UI

    $this->load->view('general/header');
    $this->load->view('roster/rosterViewByTM', $data);
    $this->load->view('general/footer');
}
    
    public function recreateRoster() {
    // Get the posted data
    $rosterId = $_POST['roster_id'] ?? '';
    $nextMonday = !empty($_POST['start_date']) ? date('Y-m-d', strtotime($_POST['start_date'])) : '';
    $nextSunday = !empty($_POST['end_date']) ? date('Y-m-d', strtotime($_POST['end_date'])) : '';

    // Validate input
    if (empty($rosterId) || empty($nextMonday) || empty($nextSunday)) {
        $this->session->set_flashdata('error_message', 'Invalid input. Please provide roster ID, start date, and end date.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Validate date range (start_date should be a Monday, end_date should be a Sunday, 6 days apart)
    $startDate = new DateTime($nextMonday);
    $endDate = new DateTime($nextSunday);
    $interval = $startDate->diff($endDate);
    if ($startDate->format('N') != 1 || $endDate->format('N') != 7 || $interval->days != 6) {
        $this->session->set_flashdata('error_message', 'Invalid date range. Start date must be a Monday, end date must be a Sunday, and the range must be 6 days.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Check if a roster already exists for the new date range
    $validateCondition = [
        'start_date' => $nextMonday,
        'end_date' => $nextSunday,
        'location_id' => $this->location_id,
        'is_deleted' => 0
    ];
    $rosterCheck = $this->common_model->fetchRecordsDynamically('HR_roster', '', $validateCondition);
    if (!empty($rosterCheck)) {
        $this->session->set_flashdata('error_message', 'Roster already exists for the specified week.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Fetch the existing roster
    $conditions = [
        'roster_id' => $rosterId,
        'location_id' => $this->location_id,
        'is_deleted' => 0
    ];
    $roster = $this->common_model->fetchRecordsDynamically('HR_roster', '', $conditions);
    if (empty($roster)) {
        $this->session->set_flashdata('error_message', 'No roster found for the specified criteria.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Fetch the roster details
    $conditionsRoster = ['roster_id' => $rosterId,'is_deleted' => 0];
    $roster_details = $this->common_model->fetchRecordsDynamically('HR_roster_details', '', $conditionsRoster);
    if (empty($roster_details)) {
        $this->session->set_flashdata('error_message', 'No roster details found for the specified roster.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Create a new roster
    $new_roster_data = [
        'rosterName' => date('Y-m-d', strtotime($nextMonday)) . ' to ' . date('Y-m-d', strtotime($nextSunday)),
        'start_date' => $nextMonday,
        'end_date' => $nextSunday,
        'status' => $roster[0]['status'] ?? 1,
        'is_published' => $roster[0]['is_published'] ?? 0,
        'location_id' => $roster[0]['location_id'] ?? $this->location_id,
        'is_deleted' => 0
    ];
    $newRosterId = $this->common_model->commonRecordCreate('HR_roster', $new_roster_data);
    if (!$newRosterId) {
        $this->session->set_flashdata('error_message', 'Failed to create new roster.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Adjust roster details for the new date range
    $originalStartDate = new DateTime($roster[0]['start_date']);
    $newStartDate = new DateTime($nextMonday);
    $newRosterDetails = [];

    foreach ($roster_details as $detail) {
        // Calculate the day offset from the original roster's start date
        $originalRosterDate = new DateTime($detail['roster_date']);
        $dayOffset = $originalStartDate->diff($originalRosterDate)->days;

        // Apply the offset to the new start date
        $newRosterDate = clone $newStartDate;
        $newRosterDate->modify("+$dayOffset days");

        // Prepare the new roster detail
        $new_detail = [
            'roster_id' => $newRosterId,
            'employee_id' => $detail['employee_id'],
            'position_id' => $detail['position_id'],
            'prep_area_id' => $detail['prep_area_id'],
            'roster_date' => $newRosterDate->format('Y-m-d'),
            'shift_start_time' => $detail['shift_start_time'],
            'shift_end_time' => $detail['shift_end_time'],
            'break_start_time' => $detail['break_start_time'],
            'break_type' => $detail['break_type'],
            'break_duration' => $detail['break_duration'],
            'task_description' => $detail['task_description']
        ];

        // Insert the new roster detail
        $this->common_model->commonRecordCreate('HR_roster_details', $new_detail);
        $newRosterDetails[] = $new_detail;
    }

    // enter data in timesheet table
    $this->synchronizeTimesheetFromRoster($newRosterId);
   

    // Set success message and redirect
    $this->session->set_flashdata('success_message', 'Roster recreated successfully.');
    redirect($this->session->userdata('previous_url'));
}
    
    // when recreating , we have to update date for roster as it is in encoded format so wrote seprate method
    function updateRosterDates($roster_details, $start_date) {
   
    $updated_roster = [];
    $updated_DataForTimesheet = [];
   
    $current_date = strtotime($start_date);
   $allDaysname = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    foreach ($roster_details as $key => $value) {
        if(in_array($key,$allDaysname)){
      
        $day_data = json_decode($value, true);
      
        foreach ($day_data as &$employee_data) {
            $employee_data = json_decode($employee_data, true); // Decode nested JSON string to array
            $employee_data['rosterDate'] = date('d-m-Y', $current_date); // Update rosterDate
            $employee_data = json_encode($employee_data); // Encode back to JSON string
        }
       
        $updated_roster[$key] = json_encode($day_data);
        $updated_DataForTimesheet[] = $day_data;
    
        $current_date = strtotime('+1 day', $current_date);
        }
    }
    $result['rosterData'] = $updated_roster;
    $result['dataForTimesheet'] = $updated_DataForTimesheet;
    return $result;
}
    
    function deleteRoster(){
       $data['is_deleted'] = 1; 
	   $this->common_model->commonRecordUpdate('HR_roster','roster_id',$_POST['rosterId'],$data);
	   $this->common_model->commonRecordUpdate('HR_roster_details','roster_id',$_POST['rosterId'],$data);
	   $this->common_model->commonRecordUpdate('HR_timesheet','roster_id',$_POST['rosterId'],$data);
	   echo "Success"; exit;
    }
    
}
    
    ?>