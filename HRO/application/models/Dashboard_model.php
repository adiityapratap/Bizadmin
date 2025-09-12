<?php
class Dashboard_model extends CI_Model{
	protected $table = 'roster';
	
		public function employeeIdList($branch_id){
		$this->db->select('emp_id');
		$this->db->from('employee');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		return array_column($query->result(),'emp_id');
		
		
		}
		
		function employeeTodayRoster(){
		    
		    	$this->db->select('emp_id');
		$this->db->from('employee');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
		   
		}
	
}