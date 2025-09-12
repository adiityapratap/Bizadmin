<?php
class Dashboard_model extends CI_Model{
	protected $table = 'roster';
	
		public function employeeIdList($branch_id){
		$this->tenantDb->select('emp_id');
		$this->tenantDb->from('employee');
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
		$query = $this->tenantDb->get();
		return array_column($query->result(),'emp_id');
		
		
		}
		
		function employeeTodayRoster(){
		    
		    	$this->tenantDb->select('emp_id');
		$this->tenantDb->from('employee');
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
		$query = $this->tenantDb->get();
		return $query->result();
		   
		}
	
}