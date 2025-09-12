<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Timesheet_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
	
	
	
 public function getTimesheetForDate($date, $location_id)
    {
        $fields = [
            'HR_timesheet.timesheet_id',
            'HR_timesheet.employee_id',
            'HR_timesheet.prep_area_id',
            'HR_timesheet.position_id',
            'HR_timesheet.clock_in_time',
            'HR_timesheet.clock_out_time',
            'HR_timesheet.actual_break_duration',
            'HR_timesheet.approval_status',
            'CONCAT(e.first_name, " ", e.last_name) as name',
            'e.employee_type',
            'e.pin',
            'p.prep_name',
            'pos.position_name',
            'MAX(b.break_start_time) as latest_break_start_time',
            'b.break_end_time as latest_break_end_time'
        ];

        $this->tenantDb->select(implode(',', $fields))
            ->from('HR_timesheet')
            ->join('HR_employee e', 'HR_timesheet.employee_id = e.emp_id', 'inner')
            ->join('HR_prepArea p', 'HR_timesheet.prep_area_id = p.id', 'inner')
            ->join('HR_emp_position pos', 'HR_timesheet.position_id = pos.position_id', 'left')
            ->join('HR_timesheet_breaks b', 'HR_timesheet.timesheet_id = b.timesheet_id AND b.is_deleted = 0', 'left')
            ->where([
                'HR_timesheet.roster_date' => $date,
                'HR_timesheet.is_deleted' => 0,
                'HR_timesheet.location_id' => $location_id
            ])
            ->group_by('HR_timesheet.timesheet_id')
            ->order_by('e.first_name, e.last_name');

        $query = $this->tenantDb->get();
        return $query->result_array();
    }

    public function getBreakDurationForTimesheet($timesheet_id)
    {
        $this->tenantDb->select('SUM(break_duration) as total_break_duration')
            ->from('HR_timesheet_breaks')
            ->where(['timesheet_id' => $timesheet_id, 'is_deleted' => 0]);
        $query = $this->tenantDb->get();
        $result = $query->row_array();
        return $result['total_break_duration'] ?? 0;
    }

    public function getLatestBreak($timesheet_id)
    {
        $this->tenantDb->select('break_id, break_start_time, break_end_time')
            ->from('HR_timesheet_breaks')
            ->where(['timesheet_id' => $timesheet_id, 'is_deleted' => 0])
            ->order_by('break_start_time', 'DESC')
            ->limit(1);
        $query = $this->tenantDb->get();
        return $query->row_array();
    }
    
     public function get_timesheets_by_date_range($start_date, $end_date, $location_id) {
        $fields = [
            'HR_timesheet.timesheet_id',
            'HR_timesheet.employee_id',
            'HR_timesheet.prep_area_id',
            'HR_timesheet.position_id',
            'HR_timesheet.clock_in_time',
            'HR_timesheet.clock_out_time',
            'HR_timesheet.actual_break_duration',
            'HR_timesheet.roster_date',
            'HR_timesheet.approval_status',
            'CONCAT(e.first_name, " ", e.last_name) as employee_name',
            'e.employee_type',
            'e.pin',
            'p.prep_name',
            'pos.position_name',
            'SUM(b.break_duration) as total_break_duration',
            'TIMEDIFF(HR_timesheet.clock_out_time, HR_timesheet.clock_in_time) as total_time',
            'SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(HR_timesheet.clock_out_time, HR_timesheet.clock_in_time)) - IFNULL(SUM(b.break_duration), 0)) as total_hours',
            'r.shift_start_time',
            'r.shift_end_time'
        ];
        
        $this->tenantDb->select($fields)
            ->from('HR_timesheet')
            ->join('HR_employee e', 'HR_timesheet.employee_id = e.emp_id', 'inner')
            ->join('HR_prepArea p', 'HR_timesheet.prep_area_id = p.id', 'inner')
            ->join('HR_emp_position pos', 'HR_timesheet.position_id = pos.position_id', 'left')
            ->join('HR_timesheet_breaks b', 'HR_timesheet.timesheet_id = b.timesheet_id AND b.is_deleted = 0', 'left')
            ->join('HR_roster_details r', 'HR_timesheet.employee_id = r.employee_id AND HR_timesheet.roster_date = r.roster_date', 'left')
            ->where('HR_timesheet.roster_date >=', $start_date)
            ->where('HR_timesheet.roster_date <=', $end_date)
            ->where([
                'HR_timesheet.is_deleted' => 0,
                'HR_timesheet.location_id' => $location_id
            ])
            ->group_by('HR_timesheet.timesheet_id')
            ->order_by('e.first_name, e.last_name, HR_timesheet.roster_date');
        
        $query = $this->tenantDb->get();
        $timesheets = $query->result_array();
        
        // Auto-approve timesheets if clock times match shift times (within 5 minutes)
        foreach ($timesheets as &$timesheet) {
            if ($timesheet['shift_start_time'] && $timesheet['shift_end_time']) {
                $clock_in_diff = abs(strtotime($timesheet['clock_in_time']) - strtotime($timesheet['shift_start_time']));
                $clock_out_diff = abs(strtotime($timesheet['clock_out_time']) - strtotime($timesheet['shift_end_time']));
                $five_minutes = 5 * 60; // 5 minutes in seconds
                
                if ($clock_in_diff <= $five_minutes && $clock_out_diff <= $five_minutes) {
                    $timesheet['approval_status'] = 'Approved';
                    $this->tenantDb->where('timesheet_id', $timesheet['timesheet_id'])
                        ->update('HR_timesheet', ['approval_status' => 'approved']);
                }
            }
        }
        
        return $timesheets;
    }
    
    public function update_timesheet_times($timesheet_id, $clock_in_time, $clock_out_time) {
        $data = [];
        if ($clock_in_time) {
            $data['clock_in_time'] = $clock_in_time;
        }
        if ($clock_out_time) {
            $data['clock_out_time'] = $clock_out_time;
        }
        
        if (!empty($data)) {
            $this->tenantDb->where('timesheet_id', $timesheet_id)
                ->update('HR_timesheet', $data);
            return $this->tenantDb->affected_rows() > 0;
        }
        return false;
    }
    
     public function approve_employee_timesheets($employee_id, $start_date, $end_date) {
        $this->tenantDb->where([
            'employee_id' => $employee_id,
            'roster_date >=' => $start_date,
            'roster_date <=' => $end_date,
            'is_deleted' => 0
        ])->update('HR_timesheet', ['approval_status' => 'approved']);
        
        return $this->tenantDb->affected_rows() > 0;
    }

	
}