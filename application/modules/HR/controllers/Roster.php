<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
    
    
  public function rosterForm()
    {
    // ---------- Previous URL (safe) ----------
    if (isset($this->session)) {
        $this->session->set_userdata('previous_url', current_url());
    }

    // ---------- Location ----------
    $locationId = $this->location_id ?? 0;

    // ---------- Conditions ----------
    $conditions = [
        'location_id' => $locationId,
        'is_deleted'  => '0'
    ];

    // ---------- Base Data (safe defaults) ----------
    $data = [
        'empLists'          => [],
        'positionLists'    => [],
        'prepAreas'         => [],
        'rosterId'          => 0,
        'weekRange'         => '',
        'rosterStartDate'   => '',
        'rosterInfo'        => [],
        'allDayRosterData'  => []
    ];

    // ---------- Employees ----------
    $data['empLists'] = $this->employee_model->employeeList('', '', true) ?? [];
   

    // ---------- Positions ----------
    $data['positionLists'] = $this->common_model->fetchRecordsDynamically('HR_emp_position', '', $conditions) ?? [];

    $data['prepAreas'] = $this->common_model->fetchRecordsDynamically('HR_prepArea', '', $conditions) ?? [];
    
     // Check if custom dates are provided
    $customStartDate = $this->input->get('start_date');
    $customEndDate = $this->input->get('end_date');

    // ---------- Week Date Range ----------
    try {
        if (!empty($customStartDate) && !empty($customEndDate)) {
            $startDate = new DateTime($customStartDate);
            $endDate = new DateTime($customEndDate);
        } else {
            $startDate = new DateTime('monday this week');
            $endDate   = (clone $startDate)->modify('+6 days');
        }

        $data['rosterStartDate'] = $startDate->format('Y-m-d');
        $data['rosterEndDate'] = $endDate->format('Y-m-d');
        $data['weekRange'] = $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y');
        $data['weekRangeShort'] = $startDate->format('d M') . ' - ' . $endDate->format('d M');
    } catch (Throwable $e) {
        // Absolute fallback
        $data['rosterStartDate'] = date('Y-m-d');
          $data['rosterEndDate'] = date('Y-m-d', strtotime('+6 days'));
        $data['weekRange'] = date('d M Y') . ' - ' . date('d M Y', strtotime('+6 days'));
        $data['weekRangeShort'] = date('d M') . ' - ' . date('d M', strtotime('+6 days'));
    }

    // ---------- Safely simulate GET params ----------
    $_GET['weekRange']       = $data['weekRange'];
    $_GET['rosterStartDate'] = $data['rosterStartDate'];
    $_GET['rosterEndDate'] = $data['rosterEndDate'];

    // ---------- Fetch Roster ----------
    $rosterData = [];

    if (method_exists($this, 'fetchRosterByWeek')) {
        $response = $this->fetchRosterByWeek(true);
        if (is_array($response)) {
            $rosterData = $response;
        }
    }

    // ---------- Merge only allowed keys ----------
    $allowedKeys = [
        'rosterId',
        'weekRange',
        'rosterStartDate',
        'rosterInfo',
        'allDayRosterData'
    ];

    foreach ($allowedKeys as $key) {
        if (isset($rosterData[$key])) {
            $data[$key] = $rosterData[$key];
        }
    }
    
    // Get superannuation config
    $superConfig = $this->common_model->fetchRecordsDynamically('HR_configuration',['data'], ['location' => $this->location_id, 'configureFor' => 'superannuation']);
        
    
    $data['tierBasedEnabled'] = (isset($superConfig[0]['data']) && is_array($config = json_decode($superConfig[0]['data'], true)) && isset($config['enable_tier_payroll']) && $config['enable_tier_payroll'] == '1') ? 1 : 0;
    

    // ---------- Final Safety ----------
    $data['rosterInfo']       = is_array($data['rosterInfo']) ? $data['rosterInfo'] : [];
    $data['allDayRosterData'] = is_array($data['allDayRosterData']) ? $data['allDayRosterData'] : [];
    $data['rosterId']         = (int) ($data['rosterId'] ?? 0);

    // ---------- Views ----------
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
        if (!empty($rosterEndDate)) {
            $endDate = new DateTime($rosterEndDate);
        } else {
            $endDate = (clone $startDate)->modify('+6 days');
        }
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');
    } catch (Exception $e) {
        // Fallback to current week's Monday if date is invalid
        $startDate = new DateTime('monday this week');
        $endDate = (clone $startDate)->modify('+6 days');
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');
         $data['weekRange'] = $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y');
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
    

// add roster details at the same time populate timesheet table also with the employee from roster table , save roster
   public function addRoster() {
        // Get the posted data
        $empDatas = $this->input->post();
        $parentTimesheetId = null;

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
        
        $validateConditionTS = [
        'date_from' => $rosterWeek['start_date'],
        'location_id' => $this->location_id,
        'is_deleted' => 0
    ];
        $existingTimesheetOfThisWeek = $this->common_model->fetchRecordsDynamically('HR_timesheet', '', $validateConditionTS);
        $updateRecord = false;
        $rosterData = [
            'start_date' => $rosterWeek['start_date'],
            'end_date' => $rosterWeek['end_date'],
            'location_id' => $this->location_id,
            'rosterName' => $empDatas['rosterName'] ?: date('d-m-Y', strtotime($rosterWeek['start_date'])) . ' to ' . date('d-m-Y', strtotime($rosterWeek['end_date'])),
            'is_published' => ($empDatas['savetype'] == 'publish' ? 1 : 0),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $timesheetData = [
            'date_from' => $rosterWeek['start_date'],
            'date_to' => $rosterWeek['end_date'],
            'status' => 1,
            'location_id' => $this->location_id,
            'is_published'=>$rosterData['is_published'],
            'is_timesheet_without_roster' => 0,
            ];

        $this->tenantDb->trans_start();
        if (!empty($existingRosterOfThisWeek)) {
            $updateRecord = true;
            $rosterId = $existingRosterOfThisWeek[0]['roster_id'];
            $this->common_model->commonRecordUpdate('HR_roster', 'roster_id', $rosterId, $rosterData);
            // change the timesheet stats to published as well
            $timesheetUpdateData['is_published'] = $rosterData['is_published'];
            $this->common_model->commonRecordUpdate('HR_timesheet', 'roster_id', $rosterId, $timesheetUpdateData);
           $parentTimesheetId =  $existingTimesheetOfThisWeek[0]['id'];
          
        } else if(!empty($existingTimesheetOfThisWeek)){
           // timesheet already exist for thhis week so we cannot create another roster/timehseet for this week for this location
           echo json_encode(['status' => 'error', 'message' => 'Roster/Timesheet already exist for this week.']);
            return;
        }else{
           $rosterData['created_at'] = date('Y-m-d H:i:s');
            $rosterId = $this->common_model->commonRecordCreate('HR_roster', $rosterData);
              //make entry in timesheet teble so we can show on listing page , added on 25-11-2025 after making updating timesheet table names 
            $timesheetData['roster_id'] = $rosterId;
            $parentTimesheetId = $this->common_model->commonRecordCreate('HR_timesheet', $timesheetData);  
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
        $this->synchronizeTimesheetFromRoster($rosterId,$parentTimesheetId);

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
    public function synchronizeTimesheetFromRoster($rosterId,$parentTimesheetId='') {
       
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
            'HR_timesheet_details',
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
                 'status' => 1,
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
     // New timesheet entry, we need to enter parent_timesheet_id just when creating new row in "HR_timesheet_details" table parent id will not change so no need in update case
                $timesheetData['clock_in_time'] = null;
                $timesheetData['clock_out_time'] = null;
                $timesheetData['parent_timesheet_id'] = $parentTimesheetId;
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
                    'HR_timesheet_details',
                    'timesheet_id',
                    $ts['timesheet_id'],
                    ['is_deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }
        }

        // Insert new timesheet entries
        if (!empty($recordsToInsert)) {
            $this->common_model->commonBulkRecordCreate('HR_timesheet_details', $recordsToInsert);
        }

        // Update existing timesheet entries
        foreach ($recordsToUpdate as $record) {
            $timesheetId = $record['timesheet_id'];
            unset($record['timesheet_id']);
            $this->common_model->commonRecordUpdate('HR_timesheet_details', 'timesheet_id', $timesheetId, $record);
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
        // Check if the string contains full dates (YYYY-MM-DD format)
        if (preg_match('/\d{4}-\d{2}-\d{2}/', $string)) {
            $parts = explode(" - ", $string);
            $resultArray['start_date'] = trim($parts[0]);
            $resultArray['end_date'] = trim($parts[1]);
            return $resultArray;
        }
        
        // Handle traditional "29 Dec - 04 Jan" format
        $parts = explode(" - ", $string);
        $start_date = trim($parts[0]);
        $end_date = trim($parts[1]);
        
        // Get current year
        $currentYear = date('Y');
        $currentMonth = date('n');
        
        // Parse start date
        $start_timestamp = strtotime("$start_date $currentYear");
        $start_month = date('n', $start_timestamp);
        
        // Parse end date - handle year transition
        $end_timestamp = strtotime("$end_date $currentYear");
        $end_month = date('n', $end_timestamp);
        
        // If end month is less than start month, it's likely next year
        if ($end_month < $start_month) {
            $end_timestamp = strtotime("$end_date " . ($currentYear + 1));
        }
        // If we're in December and start date is in December but end date appears to be in January
        elseif ($currentMonth == 12 && $start_month == 12 && $end_month == 1) {
            $end_timestamp = strtotime("$end_date " . ($currentYear + 1));
        }
        
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
    $startDateRaw = $_POST['start_date'] ?? '';
    $endDateRaw = $_POST['end_date'] ?? '';
    
    // Remove commas and convert to Y-m-d format
    $nextMonday = '';
    $nextSunday = '';
    
    if (!empty($startDateRaw)) {
        $startDateRaw = str_replace(',', '', $startDateRaw);
        $startTimestamp = strtotime($startDateRaw);
        $nextMonday = $startTimestamp ? date('Y-m-d', $startTimestamp) : '';
    }
    
    if (!empty($endDateRaw)) {
        $endDateRaw = str_replace(',', '', $endDateRaw);
        $endTimestamp = strtotime($endDateRaw);
        $nextSunday = $endTimestamp ? date('Y-m-d', $endTimestamp) : '';
    }

 

    // Validate input
    if (empty($rosterId) || empty($nextMonday) || empty($nextSunday)) {
        $this->session->set_flashdata('error_message', 'Invalid input. Please provide roster ID, start date, and end date.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Create DateTime objects for validation
    $startDate = DateTime::createFromFormat('Y-m-d', $nextMonday);
    $endDate = DateTime::createFromFormat('Y-m-d', $nextSunday);

    // Verify DateTime objects were created successfully
    if (!$startDate || !$endDate) {
        $this->session->set_flashdata('error_message', 'Invalid date format. Please check your dates.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Reset time to midnight for accurate comparison
    $startDate->setTime(0, 0, 0);
    $endDate->setTime(0, 0, 0);

    
    // Rule 1: Start must be Monday (N=1)
    if ((int)$startDate->format('N') !== 1) {
        $this->session->set_flashdata(
            'error_message', 
            'Start date must be a Monday. You selected: ' . $startDate->format('l, d M Y')
        );
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Rule 2: End must be Sunday (N=7)
    if ((int)$endDate->format('N') !== 7) {
        $this->session->set_flashdata(
            'error_message', 
            'End date must be a Sunday. You selected: ' . $endDate->format('l, d M Y')
        );
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Rule 3: End date must be exactly 6 days after start date
    $daysDifference = (int)$startDate->diff($endDate)->days;
    
    

    if ($daysDifference !== 6) {
        $this->session->set_flashdata(
            'error_message',
            'Invalid date range. End date must be exactly 6 days after start date (the Sunday of the same week). Days difference: ' . $daysDifference
        );
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Check if a roster or timesheet already exists for the new date range
    $validateCondition = [
        'start_date' => $nextMonday,
        'end_date' => $nextSunday,
        'location_id' => $this->location_id,
        'is_deleted' => 0
    ];
    
    $rosterCheck = $this->common_model->fetchRecordsDynamically('HR_roster', '', $validateCondition);
    
    $validateConditionTS = [
        'date_from' => $nextMonday,
        'date_to' => $nextSunday,
        'location_id' => $this->location_id,
        'is_deleted' => 0
    ];
    
    $timesheetCheck = $this->common_model->fetchRecordsDynamically('HR_timesheet', '', $validateConditionTS);
    
    if (!empty($rosterCheck) || !empty($timesheetCheck)) {
        $this->session->set_flashdata('error_message', 'Roster/Timesheet already exists for the specified week (' . $nextMonday . ' to ' . $nextSunday . ').');
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
    $conditionsRoster = [
        'roster_id' => $rosterId,
        'is_deleted' => 0
    ];
    
    $roster_details = $this->common_model->fetchRecordsDynamically('HR_roster_details', '', $conditionsRoster);
    
    if (empty($roster_details)) {
        $this->session->set_flashdata('error_message', 'No roster details found for the specified roster.');
        redirect($this->session->userdata('previous_url'));
        return;
    }

    // Create a new roster
    $new_roster_data = [
        'rosterName' => $nextMonday . ' to ' . $nextSunday,
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

    // Make entry in timesheet table so we can show on listing page
    $timesheetData = [
        'date_from' => $nextMonday,
        'date_to' => $nextSunday,
        'roster_id' => $newRosterId,
        'status' => 1,
        'is_published' => $roster[0]['is_published'] ?? 0,
        'location_id' => $this->location_id,
        'is_timesheet_without_roster' => 0,
    ];
    
    $parentTimesheetId = $this->common_model->commonRecordCreate('HR_timesheet', $timesheetData);

    // Adjust roster details for the new date range
    $originalStartDate = new DateTime($roster[0]['start_date']);
    $newStartDate = new DateTime($nextMonday);

    foreach ($roster_details as $detail) {
        // Calculate the day offset from the original roster's start date
        $originalRosterDate = new DateTime($detail['roster_date']);
        $dayOffset = (int)$originalStartDate->diff($originalRosterDate)->days;

        // Apply the offset to the new start date
        $newRosterDate = clone $newStartDate;
        $newRosterDate->modify("+{$dayOffset} days");

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
    }

    // Synchronize timesheet from roster
    $this->synchronizeTimesheetFromRoster($newRosterId, $parentTimesheetId);

    // Set success message and redirect
    $this->session->set_flashdata('success_message', 'Roster recreated successfully for the week of ' . $nextMonday . ' to ' . $nextSunday . '.');
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
	   $this->common_model->commonRecordUpdate('HR_timesheet_details','roster_id',$_POST['rosterId'],$data);
	   echo "Success"; exit;
    }
    
   
// Add this new method to your Roster controller class

private function calculateWorkedMinutes(array $shift): int
{
    $start = strtotime($shift['shift_start_time']);
    $end   = strtotime($shift['shift_end_time']);

    if (!$start || !$end || $end <= $start) {
        return 0;
    }

    $totalMinutes = ($end - $start) / 60;

    $breakMinutes = !empty($shift['break_duration'])
        ? (int)$shift['break_duration']
        : 0;

    return max(0, $totalMinutes - $breakMinutes);
}


/**
 * Download Roster as PDF
 * Generates a professional PDF of the roster schedule
 */
public function exportRosterPDF()
{
    // Enable debugging only if needed
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Load TCPDF
    require_once(FCPATH . 'vendor/tecnickcom/tcpdf/tcpdf.php');

    $rosterId = $this->input->get('roster_id');

    if (empty($rosterId)) {
        show_error('Invalid roster ID');
    }

    /* ---------- Fetch data ---------- */
    $rosterInfo = $this->common_model->fetchRecordsDynamically(
        'HR_roster', '', ['roster_id' => $rosterId, 'is_deleted' => 0]
    );

    if (empty($rosterInfo)) {
        show_error('Roster not found');
    }

    $rosterDetails = $this->common_model->fetchRecordsDynamically(
        'HR_roster_details', '', ['roster_id' => $rosterId, 'is_deleted' => 0]
    );

    $startDate = new DateTime($rosterInfo[0]['start_date']);
    $endDate   = new DateTime($rosterInfo[0]['end_date']);

    /* ---------- Build days ---------- */
    $days = [];
    $d = clone $startDate;
    while ($d <= $endDate) {
        $days[] = [
            'label' => $d->format('D') . '<br><span style="font-size:10px">' . $d->format('d M') . '</span>',
            'key'   => $d->format('Y-m-d')
        ];
        $d->modify('+1 day');
    }

    /* ---------- Group shifts by employee ---------- */
    $employees = [];

    foreach ($rosterDetails as $shift) {
        $empId = $shift['employee_id'];
        $date  = $shift['roster_date'];

        if (!isset($employees[$empId])) {
            $employees[$empId] = [
                'name' => $this->getEmployeeName($empId),
                'shifts' => [],
                'total_minutes' => 0
            ];
        }

        // Calculate worked minutes (SHIFT − BREAK)
        $workedMinutes = $this->calculateWorkedMinutes($shift);
        $employees[$empId]['total_minutes'] += $workedMinutes;

        $label  = date('h:i A', strtotime($shift['shift_start_time']));
        $label .= ' – ' . date('h:i A', strtotime($shift['shift_end_time']));

        if (!empty($shift['break_duration'])) {
            $label .= '<br><span style="color:#6B7280">Break: '
                   . (int)$shift['break_duration'] . ' min</span>';
        }

        $employees[$empId]['shifts'][$date][] = $label;
    }

    /* ---------- Create PDF ---------- */
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 15);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);

    /* ---------- HTML ---------- */
    $html = '
    <style>
        body { font-family: helvetica, sans-serif; }
        h1 { color:#4F46E5; font-size:26px; text-align:center; margin-bottom:6px; }
        .meta { text-align:center; color:#6B7280; font-size:12px; margin-bottom:20px; }
        table { width:100%; border-collapse:collapse; }
        th {
            background:#EEF2FF;
            border:1px solid #CBD5E1;
            padding:10px;
            font-size:12px;
            text-align:center;
        }
        td {
            border:1px solid #E5E7EB;
            padding:12px;
            font-size:11px;
            vertical-align:top;
        }
        .emp-name {
            font-weight:bold;
            font-size:12px;
            color:#111827;
            background:#F9FAFB;
            white-space:nowrap;
        }
        .off {
            color:#9CA3AF;
            font-style:italic;
            text-align:center;
        }
        .total {
            font-weight:bold;
            background:#F3F4F6;
            text-align:center;
        }
    </style>

    <h1>' . htmlspecialchars($rosterInfo[0]['rosterName']) . '</h1>
    <div class="meta">
        Week: ' . $startDate->format('d M Y') . ' – ' . $endDate->format('d M Y') . '<br>
        Generated: ' . date('d M Y H:i') . '
    </div>

    <table>
        <tr>
            <th style="width:14%">Employee</th>';

    foreach ($days as $day) {
        $html .= '<th>' . $day['label'] . '</th>';
    }

    $html .= '<th>Total</th></tr>';

    /* ---------- Rows ---------- */
    foreach ($employees as $emp) {
        $html .= '<tr>';
        $html .= '<td class="emp-name">' . htmlspecialchars($emp['name']) . '</td>';

        foreach ($days as $day) {
            if (!empty($emp['shifts'][$day['key']])) {
                $html .= '<td>' . implode('<hr>', $emp['shifts'][$day['key']]) . '</td>';
            } else {
                $html .= '<td class="off">Off</td>';
            }
        }

        $hours = intdiv($emp['total_minutes'], 60);
        $mins  = $emp['total_minutes'] % 60;

        $html .= '<td class="total">' . $hours . 'h ' . $mins . 'm</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    /* ---------- Render ---------- */
    $pdf->writeHTML($html, true, false, true, false, '');

    $filename = 'Roster_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.pdf';
    $pdf->Output($filename, 'D');
}


/**
 * Generate HTML for roster EXCEL days are vertical wise
 */
public function exportRosterExcel()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $rosterId = $this->input->get('roster_id');
    if (!$rosterId) {
        show_error('Invalid roster ID');
    }

    /* ---------- Fetch data ---------- */
    $rosterInfo = $this->common_model->fetchRecordsDynamically(
        'HR_roster', '', ['roster_id' => $rosterId, 'is_deleted' => 0]
    );

    if (empty($rosterInfo)) {
        show_error('Roster not found');
    }

    $rosterDetails = $this->common_model->fetchRecordsDynamically(
        'HR_roster_details', '', ['roster_id' => $rosterId, 'is_deleted' => 0]
    );

    $startDate = new DateTime($rosterInfo[0]['start_date']);
    $endDate   = new DateTime($rosterInfo[0]['end_date']);

    /* ---------- Build days ---------- */
    $days = [];
    $d = clone $startDate;
    while ($d <= $endDate) {
        $days[] = [
            'label' => $d->format('D d M'),
            'key'   => $d->format('Y-m-d')
        ];
        $d->modify('+1 day');
    }

    /* ---------- Group shifts by employee ---------- */
    $employees = [];

    foreach ($rosterDetails as $shift) {
        $empId = $shift['employee_id'];
        $date  = $shift['roster_date'];

        if (!isset($employees[$empId])) {
            $employees[$empId] = [
                'name'          => $this->getEmployeeName($empId),
                'shifts'        => [],
                'total_minutes' => 0
            ];
        }

        // Calculate worked minutes (including break deduction)
        $start = strtotime($shift['shift_start_time']);
        $end   = strtotime($shift['shift_end_time']);
        $minutes = ($end - $start) / 60;

        if (!empty($shift['break_duration'])) {
            $minutes -= (int) $shift['break_duration'];
        }

        $employees[$empId]['total_minutes'] += max(0, $minutes);

        // Shift label (string only)
        $label = date('h:i A', $start) . ' – ' . date('h:i A', $end);

        if (!empty($shift['break_duration'])) {
            $label .= ' (Break: ' . $shift['break_duration'] . ' min)';
        }

        $employees[$empId]['shifts'][$date][] = $label;
    }

    /* ---------- Create Spreadsheet ---------- */
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    /* ---------- Header row ---------- */
    $col = 1;
    $sheet->setCellValueByColumnAndRow($col++, 1, 'Employee');

    foreach ($days as $day) {
        $sheet->setCellValueByColumnAndRow($col++, 1, $day['label']);
    }

    $sheet->setCellValueByColumnAndRow($col, 1, 'Total');

    $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => [
            'horizontal' => 'center',
            'vertical'   => 'center'
        ],
    ]);

    /* ---------- Data rows ---------- */
    $row = 2;

    foreach ($employees as $emp) {
        $col = 1;
        $sheet->setCellValueByColumnAndRow($col++, $row, $emp['name']);

        foreach ($days as $day) {

            if (!empty($emp['shifts'][$day['key']])) {
                // Convert array → string safely
                $cellValue = implode("\n", (array) $emp['shifts'][$day['key']]);

                $sheet->setCellValueByColumnAndRow($col, $row, $cellValue);
                $sheet->getStyleByColumnAndRow($col, $row)
                      ->getAlignment()
                      ->setWrapText(true);

                $col++;
            } else {
                $sheet->setCellValueByColumnAndRow($col++, $row, 'Off');
            }
        }

        // Total hours
        $hours = intdiv($emp['total_minutes'], 60);
        $mins  = $emp['total_minutes'] % 60;

        $sheet->setCellValueByColumnAndRow($col, $row, "{$hours}h {$mins}m");
        $row++;
    }

    /* ---------- Auto-size columns ---------- */
    foreach (range('A', $sheet->getHighestColumn()) as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    /* ---------- Download ---------- */
    $filename = 'Roster_' . $startDate->format('Y-m-d') .
                '_to_' . $endDate->format('Y-m-d') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}



// Export roster end

private function parseDateRange($weekRange) {
    // Parse date range like "08 Jan 2026 - 14 Jan 2026"
    $parts = explode(' - ', $weekRange);
    if (count($parts) !== 2) {
        // Fallback to current week
        $monday = new DateTime('monday this week');
        $sunday = clone $monday;
        $sunday->modify('+6 days');
        return $this->generateWeekDates($monday, $sunday);
    }
    
    $startDate = DateTime::createFromFormat('d M Y', trim($parts[0]));
    $endDate = DateTime::createFromFormat('d M Y', trim($parts[1]));
    
    return $this->generateWeekDates($startDate, $endDate);
}

private function generateWeekDates($startDate, $endDate) {
    $dates = [];
    $current = clone $startDate;
    
    while ($current <= $endDate) {
        $dates[] = [
            'day' => $current->format('l'),
            'date' => $current->format('d/m'),
            'full_date' => $current->format('d-m-Y')
        ];
        $current->modify('+1 day');
    }
    
    return $dates;
}

private function generatePDFHTML($rosterName, $weekRange, $dates, $prepAreas, $shifts) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 10px;
                margin: 0;
                padding: 15px;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .header h1 {
                margin: 0 0 5px 0;
                font-size: 20px;
                color: #1f2937;
            }
            .header p {
                margin: 0;
                font-size: 12px;
                color: #6b7280;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }
            th {
                background-color: #f3f4f6;
                padding: 8px 5px;
                text-align: left;
                border: 1px solid #e5e7eb;
                font-weight: 600;
                color: #374151;
                font-size: 9px;
            }
            th.area-header {
                width: 12%;
            }
            th.day-header {
                width: 12.5%;
                text-align: center;
            }
            td {
                padding: 8px 5px;
                border: 1px solid #e5e7eb;
                vertical-align: top;
            }
            td.area-cell {
                background-color: #f9fafb;
                font-weight: 600;
                color: #1f2937;
            }
            .shift-box {
                background-color: #E6F4EA;
                padding: 6px;
                margin-bottom: 5px;
                border-radius: 4px;
                border: 1px solid #CAEBD0;
                font-size: 8px;
            }
            .shift-name {
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 3px;
            }
            .shift-time {
                color: #4b5563;
                margin-bottom: 2px;
            }
            .shift-break {
                color: #4b5563;
                font-style: italic;
            }
            .no-shifts {
                color: #9ca3af;
                font-style: italic;
                text-align: center;
                font-size: 8px;
            }
            .footer {
                margin-top: 20px;
                padding-top: 10px;
                border-top: 2px solid #e5e7eb;
                text-align: center;
                color: #6b7280;
                font-size: 8px;
            }
            .day-date {
                display: block;
                font-size: 8px;
                color: #6b7280;
                font-weight: normal;
                margin-top: 2px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>' . htmlspecialchars($rosterName) . '</h1>
            <p>' . htmlspecialchars($weekRange) . '</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th class="area-header">Area</th>';
    
    // Add day headers
    foreach ($dates as $date) {
        $html .= '<th class="day-header">' . htmlspecialchars($date['day']) . '<span class="day-date">' . htmlspecialchars($date['date']) . '</span></th>';
    }
    
    $html .= '
                </tr>
            </thead>
            <tbody>';
    
    // Add rows for each preparation area
    foreach ($prepAreas as $area) {
        $html .= '<tr>';
        $html .= '<td class="area-cell">' . htmlspecialchars($area['prep_name']) . '</td>';
        
        // Add cells for each day
        foreach ($dates as $date) {
            $html .= '<td>';
            
            // Find shifts for this area and date
            $dayShifts = $this->getShiftsForAreaAndDate($shifts, $area['id'], $date['full_date']);
            
            if (empty($dayShifts)) {
                $html .= '<div class="no-shifts">No shifts</div>';
            } else {
                foreach ($dayShifts as $shift) {
                    $html .= '<div class="shift-box">';
                    $html .= '<div class="shift-name">' . htmlspecialchars($shift['selectedEmpName']) . '</div>';
                    $html .= '<div class="shift-time">⏰ ' . htmlspecialchars($shift['empShiftStartTime']) . ' - ' . htmlspecialchars($shift['empShiftEndTime']) . '</div>';
                    
                    if (!empty($shift['empBreakTime'])) {
                        $html .= '<div class="shift-break">☕ Break: ' . htmlspecialchars($shift['empBreakTime']) . '</div>';
                    }
                    
                    $html .= '</div>';
                }
            }
            
            $html .= '</td>';
        }
        
        $html .= '</tr>';
    }
    
    $html .= '
            </tbody>
        </table>
        
        <div class="footer">
            <p>Generated on ' . date('d M Y, h:i A') . '</p>
        </div>
    </body>
    </html>';
    
    return $html;
}

private function getShiftsForAreaAndDate($shifts, $areaId, $date) {
    $result = [];
    
    // Extract day number from date (format: dd-mm-yyyy)
    $dayNumber = substr($date, 0, 2);
    
    // Look for shifts matching this area and date
    foreach ($shifts as $key => $value) {
        if (strpos($key, 'emp_') !== 0) continue;
        
        $shiftData = json_decode($value, true);
        if (!$shiftData) continue;
        
        // Parse key: emp_DD_AreaID_EmpID
        $keyParts = explode('_', $key);
        if (count($keyParts) < 3) continue;
        
        $shiftDay = $keyParts[1];
        $shiftAreaId = $keyParts[2];
        
        // Check if this shift matches our area and date
        if ($shiftAreaId == $areaId && $shiftDay == $dayNumber) {
            $result[] = $shiftData;
        }
    }
    
    return $result;
}

private function sanitizeFilename($filename) {
    return preg_replace('/[^a-z0-9_\-]/i', '_', $filename);
}
    
}
    
    ?>