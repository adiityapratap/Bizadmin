<?php
class Timesheet_model extends CI_Model{

	public function fetchEmpTodaysTimesheets($empId,$date){
        $weekday = date('l',strtotime($date)).'_layout';
    	$this->tenantDb->select('employee_timesheet.*,outlet.outlet_name,outlet.outlet_id,roster.roster_name,timesheet.timesheet_name');
		$this->tenantDb->from('HR_employee_timesheet as employee_timesheet');
		$this->tenantDb->join('HR_timesheet as timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id','left'); 
		$this->tenantDb->join('HR_roster as roster', 'employee_timesheet.roster_id = roster.roster_id','left'); 
		$this->tenantDb->join('HR_outlet as outlet', 'roster.'.$weekday.' = outlet.outlet_id','left'); 
		$this->tenantDb->where('employee_timesheet.employee_id',$empId);
		$this->tenantDb->where('employee_timesheet.date',$date);
		$this->tenantDb->where('employee_timesheet.status','1'); 
		$this->tenantDb->where('employee_timesheet.running_status','1'); 
		$this->tenantDb->or_where('employee_timesheet.running_status','2'); 
		$query = $this->tenantDb->get();
		return $query->result_array();
	}
	public function fetchEmpTimesheets($empId,$date){
        $weekday = date('l',strtotime($date)).'_layout';
    	$this->tenantDb->select('employee_timesheet.*,outlet.outlet_name,outlet.outlet_id,roster.roster_name,timesheet.timesheet_name');
		$this->tenantDb->from('HR_employee_timesheet as employee_timesheet');
		$this->tenantDb->join('HR_timesheet as timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id','left'); 
		$this->tenantDb->join('HR_roster as roster', 'employee_timesheet.roster_id = roster.roster_id','left'); 
		$this->tenantDb->join('HR_outlet as outlet', 'roster.'.$weekday.' = outlet.outlet_id','left'); 
		$this->tenantDb->where('employee_timesheet.employee_id',$empId);
		$this->tenantDb->where('employee_timesheet.date',$date);
		$this->tenantDb->where('employee_timesheet.status','1'); 
		$query = $this->tenantDb->get();
		return $query->result_array();
	}
	function update_employee_timesheet($data,$employee_timesheet_id){
	    
	   $this->tenantDb->where('employee_timesheet_id',$employee_timesheet_id);
		return $this->tenantDb->update('HR_employee_timesheet as employee_timesheet',$data);
	}	

}