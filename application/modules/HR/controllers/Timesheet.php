<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;
class Timesheet extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        // $this->load->helper('notification');
		$this->load->model('timesheet_model');
	    $this->load->model('common_model');
	    $this->load->model('employee_model');
        $this->location_id = $this->session->userdata('location_id') ? $this->session->userdata('location_id') : ($this->session->userdata('User_location_ids') ? $this->session->userdata('User_location_ids')[0] : null);
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
        $this->roleId = get_logged_in_user_role($this->ion_auth,'id');
        $this->roleName =  get_logged_in_user_role($this->ion_auth,'name');
    }
    
    public function index(){
        
        
    }
    
    public function timesheetWithoutRoster($timesheetDateRange = '') {
        // Determine date range
        if ($timesheetDateRange) {
            $monday = new DateTime('monday this week');
            $timesheetDateRange = $monday->format('d M') . ' - ' . $monday->modify('+6 days')->format('d M');
            $dateRange = $this->createDateFormat($timesheetDateRange);
        } else {
            $dateRange = [
                'start_date' => date('Y-m-d', strtotime('monday this week')),
                'end_date' => date('Y-m-d', strtotime('sunday this week'))
            ];
        }

        // Fetch employee and position lists
        $conditions = ['location_id' => $this->location_id];
        $data['empLists'] = $this->employee_model->employeeList('', '', true);
        $data['positionLists'] = $this->common_model->fetchRecordsDynamically('HR_emp_position', '', $conditions);
        $data['prepAreaLists'] = $this->common_model->fetchRecordsDynamically('HR_prepArea', '', $conditions);
        $data['dateRange'] = $dateRange;

        // Load views
        $this->load->view('general/header');
        $this->load->view('timesheet/timesheetWithoutRoster', $data);
        $this->load->view('general/footer');
    }

    public function save_timesheet() {
        if (!$this->input->post('ids') || !$this->input->post('date_range')) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            exit;
        }

        $this->tenantDb->trans_start();
        $insertData = [];
        $timesheetWeek = $this->createDateFormat($this->input->post('date_range'));
        $startDate = $timesheetWeek['start_date'];
        $endDate = $timesheetWeek['end_date'];

        // Prepare timesheet entries
        foreach ($this->input->post('ids') as $empId) {
            $empIdParts = explode("_", $empId);
            $emp_id = $empIdParts[0];
            $position_id = $empIdParts[1] ?? null;
            $prep_area_id = $empIdParts[2] ?? null;

            $date = $startDate;
            while (strtotime($date) <= strtotime($endDate)) {
                // Check for existing record (including soft-deleted)
                $existing = $this->common_model->fetchRecordsDynamically(
                    'HR_timesheet',
                    ['timesheet_id', 'is_deleted'],
                    [
                        'roster_id' => null,
                        'employee_id' => $emp_id,
                        'roster_date' => $date
                    ]
                );

                $timesheetData = [
                    'roster_id' => null,
                    'employee_id' => $emp_id,
                    'prep_area_id' => $prep_area_id ?? 0,
                    'position_id' => $position_id,
                    'roster_date' => $date,
                    'roster_start_time' => null,
                    'roster_end_time' => null,
                    'roster_break_start_time' => null,
                    'roster_break_type' => null,
                    'roster_break_duration' => 0,
                    'task_description' => null,
                    'clock_in_time' => null,
                    'clock_out_time' => null,
                    'actual_break_duration' => 0,
                    'approval_status' => 'pending',
                    'is_deleted' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if (!empty($existing)) {
                    // Update existing record
                    $this->common_model->commonRecordUpdate(
                        'HR_timesheet',
                        'timesheet_id',
                        $existing[0]['timesheet_id'],
                        $timesheetData
                    );
                } else {
                    // Insert new record
                    $insertData[] = $timesheetData;
                }

                $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
        }

        // Insert new timesheet records
        if (!empty($insertData)) {
            try {
                $this->common_model->commonBulkRecordCreate('HR_timesheet', $insertData);
            } catch (Exception $e) {
                $this->tenantDb->trans_rollback();
                echo json_encode(['status' => 'error', 'message' => 'Failed to save timesheet: ' . $e->getMessage()]);
                exit;
            }
        }

        $this->tenantDb->trans_complete();
        if ($this->tenantDb->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Database error occurred']);
            exit;
        }

        echo json_encode(['status' => 'success', 'message' => 'Timesheet saved successfully']);
        exit;
    }

    public function timesheetList() {
        $conditions = ['location_id' => $this->location_id,'is_published' => 1, 'is_deleted' => 0, 'status' => 1];
        $data['timesheetList'] = $this->common_model->fetchRecordsDynamically('HR_roster', '', $conditions);
        
        $this->load->view('general/header');
        $this->load->view('timesheet/timesheetList', $data);
        $this->load->view('general/footer');
    }

    public function timesheetView($timesheetId) {
        // Fetch timesheet details
        $conditions = ['timesheet_id' => $timesheetId, 'is_deleted' => 0];
        $fieldsToFetch = [
            'employee_id', 'roster_date', 'prep_area_id', 'position_id',
            'clock_in_time', 'clock_out_time', 'actual_break_duration',
            'approval_status', 'task_description',
            'CONCAT(e.first_name, " ", e.last_name) as name',
            'p.prep_name', 'pos.position_name'
        ];
        $timesheetDetails = $this->common_model->fetchRecordsDynamically(
            'HR_timesheet',
            $fieldsToFetch,
            $conditions,
            ['JOIN HR_employee e ON HR_timesheet.employee_id = e.id'],
            ['JOIN 	HR_prepArea p ON HR_timesheet.prep_area_id = p.id'],
            ['LEFT JOIN HR_emp_position pos ON HR_timesheet.position_id = pos.id']
        );

        // Group data by employee and date
        $groupedData = [];
        foreach ($timesheetDetails as $record) {
            $empId = $record['employee_id'];
            $positionId = $record['position_id'] ?? 'none';
            $date = $record['roster_date'];

            if (!isset($groupedData[$empId])) {
                $groupedData[$empId] = [
                    'name' => $record['name'],
                    'positions' => []
                ];
            }

            if (!isset($groupedData[$empId]['positions'][$positionId])) {
                $groupedData[$empId]['positions'][$positionId] = [
                    'position_name' => $record['position_name'] ?? 'None',
                    'prep_name' => $record['prep_name'],
                    'dates' => []
                ];
            }

            $groupedData[$empId]['positions'][$positionId]['dates'][$date] = [
                'clock_in_time' => $record['clock_in_time'],
                'clock_out_time' => $record['clock_out_time'],
                'actual_break_duration' => $record['actual_break_duration'],
                'approval_status' => $record['approval_status'],
                'task_description' => $record['task_description']
            ];
        }

        $data['employee_weekly_timesheet_details'] = $groupedData;
        $this->load->view('general/header');
        $this->load->view('timesheet/edit_timesheetWithoutRoster', $data);
        $this->load->view('general/footer');
    }

    // Placeholder for createDateFormat
    private function createDateFormat($dateRange) {
        // Replace with your actual implementation
        $dates = explode(' - ', $dateRange);
        return [
            'start_date' => date('Y-m-d', strtotime($dates[0])),
            'end_date' => date('Y-m-d', strtotime($dates[1]))
        ];
    }
    
    function viewWeeklyTimesheet($start_date = null, $end_date = null){
      
	  $start_date = $start_date ?? date('Y-m-d', strtotime('monday this week'));
      $end_date = $end_date ?? date('Y-m-d', strtotime('sunday this week'));
      $conditions = ['location_id' => $this->location_id];
      $data['prepAreaLists'] = $this->common_model->fetchRecordsDynamically('HR_prepArea', '', $conditions);
        
        $data['timesheets'] = $this->timesheet_model->get_timesheets_by_date_range($start_date, $end_date, $this->location_id);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // echo "<pre>"; print_r($data['timesheets']); exit;
        
      $this->load->view('general/header');
	  $this->load->view('timesheet/weeklyTimesheet',$data);
	  $this->load->view('general/footer');
	  
    }
    
    public function update_timesheet() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        
        $rolesToAccess =  ['Manager','Admin'];
        if (!in_array($this->roleName,$rolesToAccess)) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized Access']);
            return;
        }
        
        $timesheet_id = $this->input->post('timesheet_id');
        $clock_in_time = $this->input->post('clock_in_time');
        $clock_out_time = $this->input->post('clock_out_time');
        
        $result = $this->timesheet_model->update_timesheet_times($timesheet_id, $clock_in_time, $clock_out_time);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Timesheet updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update timesheet']);
        }
    }
    
    public function verifyFace()
    {
    $input = json_decode(file_get_contents('php://input'), true);
    $employeeId = $input['employee_id'];
    $base64Image = $input['captured_image'];

    if (!$employeeId || !$base64Image) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        return;
    }

    $tempFile = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
    file_put_contents($tempFile, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image)));

    require_once FCPATH . 'vendor/autoload.php'; 
   

    $bucket = 'bizadmin-hr-employee-images';
    $storedKey = 'employee_faces/' . $employeeId . '.jpg';

    $rekognition = new RekognitionClient([
        'region' => 'ap-southeast-2',
        'version' => 'latest',
        'credentials' => [
            'key'    => 'AKIAXZ3XPGYZLXYPII56',
            'secret' => '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',
        ]
    ]);

    try {
        $result = $rekognition->compareFaces([
            'SourceImage' => [
                'S3Object' => [
                    'Bucket' => $bucket,
                    'Name'   => $storedKey,
                ]
            ],
            'TargetImage' => [
                'Bytes' => file_get_contents($tempFile)
            ],
            'SimilarityThreshold' => 85
        ]);

        if (!empty($result['FaceMatches']) && $result['FaceMatches'][0]['Similarity'] >= 85) {
                echo json_encode(['status' => 'success', 'similarity' => $result['FaceMatches'][0]['Similarity']]);
               
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Face does not match,Please contact Admin/Manager']);
            }

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Face does not match or exist,Please contact Admin/Manager']);
    } finally {
        if (file_exists($tempFile)) unlink($tempFile);
    }
}

      public function verifyPin() {
        $employeeId = $this->input->post('employee_id');
        $pin = $this->input->post('pin');

        if (!$employeeId || !$pin) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            return;
        }

        $employee = $this->common_model->fetchRecordsDynamically( 'HR_employee',  ['pin'],['emp_id' => $employeeId, 'pin' => $pin]);
           
         if (isset($employee) && !empty($employee)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid PIN']);
        }   
            
    }

     // for timesheet portal only , where employee can clockin and clockout
    public function clock_action()
    {
        $timesheetId = $this->input->post('timesheet_id');
        $employeeId = $this->input->post('employee_id');
        $action = $this->input->post('action');

        if (!$employeeId || !$action) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            exit;
        }

        

        $this->tenantDb->trans_start();

        if ($timesheetId == 0 && in_array($action, ['clock_in'])) {
            $timesheetData = [
                'roster_id' => null,
                'employee_id' => $employeeId,
                'prep_area_id' => $this->input->post('prep_area_id') ?? 0,
                'position_id' => null,
                'roster_date' => date('Y-m-d'),
                'roster_start_time' => null,
                'roster_end_time' => null,
                'roster_break_start_time' => null,
                'roster_break_type' => null,
                'roster_break_duration' => 0,
                'task_description' => null,
                'clock_in_time' => ($action === 'clock_in' ? date('Y-m-d H:i:s') : null),
                'clock_out_time' => null,
                'actual_break_duration' => 0,
                'approval_status' => 'pending',
                'is_deleted' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'location_id' => $this->location_id
            ];
            try {
                $timesheetId = $this->common_model->commonRecordCreate('HR_timesheet', $timesheetData);
            } catch (Exception $e) {
                $this->tenantDb->trans_rollback();
                echo json_encode(['status' => 'error', 'message' => 'Failed to create timesheet: ' . $e->getMessage()]);
                exit;
            }
        }

        // Handle timesheet actions
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];
        $responseData = [];
        if ($action === 'clock_in') {
            $timesheet = $this->common_model->fetchRecordsDynamically('HR_timesheet', ['timesheet_id', 'clock_in_time'], ['timesheet_id' => $timesheetId, 'is_deleted' => 0]);
            if (!empty($timesheet) && $timesheet[0]['clock_in_time']) {
                echo json_encode(['status' => 'error', 'message' => 'Employee already clocked in']);
                exit;
            }
            $updateData['clock_in_time'] = date('Y-m-d H:i:s');
            $responseData['clock_in_time'] = date('h:i A');
            try {
                $this->common_model->commonRecordUpdate('HR_timesheet', 'timesheet_id', $timesheetId, $updateData);
            } catch (Exception $e) {
                $this->tenantDb->trans_rollback();
                echo json_encode(['status' => 'error', 'message' => 'Failed to update timesheet: ' . $e->getMessage()]);
                exit;
            }
        } elseif ($action === 'clock_out') {
            $timesheet = $this->common_model->fetchRecordsDynamically('HR_timesheet', ['timesheet_id', 'clock_in_time'], ['timesheet_id' => $timesheetId, 'is_deleted' => 0]);
            if (empty($timesheet) || !$timesheet[0]['clock_in_time']) {
                echo json_encode(['status' => 'error', 'message' => 'Employee must clock in first']);
                exit;
            }
            $updateData['clock_out_time'] = date('Y-m-d H:i:s');
            $responseData['clock_out_time'] = date('h:i A');
            try {
                $this->common_model->commonRecordUpdate('HR_timesheet', 'timesheet_id', $timesheetId, $updateData);
            } catch (Exception $e) {
                $this->tenantDb->trans_rollback();
                echo json_encode(['status' => 'error', 'message' => 'Failed to update timesheet: ' . $e->getMessage()]);
                exit;
            }
        } elseif ($action === 'break_start') {
            $timesheet = $this->common_model->fetchRecordsDynamically('HR_timesheet', ['timesheet_id', 'clock_in_time'], ['timesheet_id' => $timesheetId, 'is_deleted' => 0]);
            if (empty($timesheet) || !$timesheet[0]['clock_in_time']) {
                echo json_encode(['status' => 'error', 'message' => 'Employee must clock in first']);
                exit;
            }
            // Check if there's an open break
            $latestBreak = $this->timesheet_model->getLatestBreak($timesheetId);
            if ($latestBreak && !$latestBreak['break_end_time']) {
                echo json_encode(['status' => 'error', 'message' => 'A break is already in progress']);
                exit;
            }
            // Create new break record
            $breakData = [
                'timesheet_id' => $timesheetId,
                'break_start_time' => date('Y-m-d H:i:s'),
                'break_end_time' => null,
                'break_duration' => 0,
                'is_deleted' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            try {
                $breakId = $this->common_model->commonRecordCreate('HR_timesheet_breaks', $breakData);
                $responseData['break_start_time'] = date('h:i A');
            } catch (Exception $e) {
                $this->tenantDb->trans_rollback();
                echo json_encode(['status' => 'error', 'message' => 'Failed to start break: ' . $e->getMessage()]);
                exit;
            }
        } elseif ($action === 'break_end') {
            $latestBreak = $this->timesheet_model->getLatestBreak($timesheetId);
            if (!$latestBreak || $latestBreak['break_end_time']) {
                echo json_encode(['status' => 'error', 'message' => 'No active break found']);
                exit;
            }
            $breakEndTime = date('Y-m-d H:i:s');
            $breakDuration = (strtotime($breakEndTime) - strtotime($latestBreak['break_start_time'])) / 60;
            $breakUpdateData = [
                'break_end_time' => $breakEndTime,
                'break_duration' => $breakDuration,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            try {
                $this->common_model->commonRecordUpdate('HR_timesheet_breaks', 'break_id', $latestBreak['break_id'], $breakUpdateData);
                // Update actual_break_duration in HR_timesheet
                $totalBreakDuration = $this->timesheet_model->getBreakDurationForTimesheet($timesheetId);
                $this->common_model->commonRecordUpdate('HR_timesheet', 'timesheet_id', $timesheetId, ['actual_break_duration' => $totalBreakDuration]);
                $responseData['break_duration'] = $totalBreakDuration;
                $responseData['break_end_time'] = date('h:i A');
            } catch (Exception $e) {
                $this->tenantDb->trans_rollback();
                echo json_encode(['status' => 'error', 'message' => 'Failed to end break: ' . $e->getMessage()]);
                exit;
            }
        }

        $responseData['status'] = 'success';
        $responseData['message'] = ucfirst(str_replace('_', ' ', $action)) . ' successful';
        $this->tenantDb->trans_complete();

        if ($this->tenantDb->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Database error occurred']);
            exit;
        }

        echo json_encode($responseData);
        exit;
    }

    // public function autoApproveTimesheet($rosterId) {
        
    //     if (empty($rosterId) || !is_numeric($rosterId)) {
    //         return ['status' => 'error', 'message' => 'Invalid roster ID'];
    //     }
  
    //     // fetch pending timesheets
    //     $where = ['roster_id' => $rosterId, 'is_deleted' => 0, 'approval_status' => 'pending'];
    //     $timesheets = $this->common_model->fetchRecordsDynamically('HR_timesheet', '', $where);

    //     if (empty($timesheets)) {
    //         return ['status' => 'error', 'message' => 'No pending timesheets found'];
    //     }

    //     $updatedTimesheets = [];
    //     $timeTolerance = 15 * 60; 
    //     $breakTolerance = 5; // 5 minutes

    //     foreach ($timesheets as $ts) {
    //         if (empty($ts['clock_in_time']) || empty($ts['clock_out_time'])) {
    //             continue;
    //         }

    //         try {
    //             $rosterStart = DateTime::createFromFormat('H:i:s', $ts['roster_start_time'] ?? '00:00:00');
    //             $rosterEnd = DateTime::createFromFormat('H:i:s', $ts['roster_end_time'] ?? '00:00:00');
    //             $clockIn = DateTime::createFromFormat('H:i:s', $ts['clock_in_time']);
    //             $clockOut = DateTime::createFromFormat('H:i:s', $ts['clock_out_time']);

    //             if (!$rosterStart || !$rosterEnd || !$clockIn || !$clockOut) {
    //                 continue;
    //             }

    //             $startDiff = abs($rosterStart->getTimestamp() - $clockIn->getTimestamp());
    //             $endDiff = abs($rosterEnd->getTimestamp() - $clockOut->getTimestamp());
    //             $breakDiff = abs(($ts['roster_break_duration'] ?? 0) - ($ts['actual_break_duration'] ?? 0));

    //             if ($startDiff <= $timeTolerance && $endDiff <= $timeTolerance && $breakDiff <= $breakTolerance) {
    //                 $updatedTimesheets[] = [
    //                     'timesheet_id' => $ts['timesheet_id'],
    //                     'approval_status' => 'approved'
    //                 ];
    //             }
    //         } catch (Exception $e) {
    //             continue;
    //         }
    //     }

    //     if (!empty($updatedTimesheets)) {
    //         $this->tenantDb->update_batch('HR_timesheet', $updatedTimesheets, 'timesheet_id');
    //         return [
    //             'status' => 'success',
    //             'message' => count($updatedTimesheets) . ' timesheets auto-approved'
    //         ];
    //     }

    //     return ['status' => 'success', 'message' => 'No timesheets eligible for auto-approval'];
    // }
    
    
    
    // function for  manual approval of timesheet on click of button
    
    public function approve_employee_timesheets() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $rolesToAccess =  ['Manager','Admin'];
       
        if (!in_array($this->roleName,$rolesToAccess)) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized Access']);
            return;
        }
        
        $employee_id = $this->input->post('employee_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        
        $result = $this->timesheet_model->approve_employee_timesheets($employee_id, $start_date, $end_date);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'All timesheets for employee approved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to approve timesheets']);
        }
    }


    
}
    
    ?>