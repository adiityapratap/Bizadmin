<?php
class Timesheet_model extends CI_Model{

	public function fetchEmpTodaysTimesheets($empId,$date){
        $weekday = date('l',strtotime($date)).'_layout';
    	$this->db->select('employee_timesheet.*,outlet.outlet_name,outlet.outlet_id,roster.roster_name,timesheet.timesheet_name');
		$this->db->from('employee_timesheet');
		$this->db->join('timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id','left'); 
		$this->db->join('roster', 'employee_timesheet.roster_id = roster.roster_id','left'); 
		$this->db->join('outlet', 'roster.'.$weekday.' = outlet.outlet_id','left'); 
		$this->db->where('employee_timesheet.employee_id',$empId);
		$this->db->where('employee_timesheet.date',$date);
		$this->db->where('employee_timesheet.status','1'); 
		$this->db->where('employee_timesheet.running_status','1'); 
		$this->db->or_where('employee_timesheet.running_status','2'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	public function fetchEmpTimesheets($empId,$date){
        $weekday = date('l',strtotime($date)).'_layout';
    	$this->db->select('employee_timesheet.*,outlet.outlet_name,outlet.outlet_id,roster.roster_name,timesheet.timesheet_name');
		$this->db->from('employee_timesheet');
		$this->db->join('timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id','left'); 
		$this->db->join('roster', 'employee_timesheet.roster_id = roster.roster_id','left'); 
		$this->db->join('outlet', 'roster.'.$weekday.' = outlet.outlet_id','left'); 
		$this->db->where('employee_timesheet.employee_id',$empId);
		$this->db->where('employee_timesheet.date',$date);
		$this->db->where('employee_timesheet.status','1'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	function update_employee_timesheet($data,$employee_timesheet_id){
	    
	   $this->db->where('employee_timesheet_id',$employee_timesheet_id);
		return $this->db->update('employee_timesheet',$data);
	}	

}