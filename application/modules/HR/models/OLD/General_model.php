<?php
class General_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	

     function get_leaves($id='',$type='', $i=null){
         
	
		$this->tenantDb->select('leave_management.*, employee.first_name');
		$this->tenantDb->from('HR_leave_management as leave_management');
		$this->tenantDb->join('HR_employee as employee', 'leave_management.emp_id = employee.emp_id');
		if($type == 'admin'){
		    	$this->tenantDb->where('leave_management.branch_id',$id);
		}else{
		    	$this->tenantDb->where('leave_management.emp_id',$id);
		}
	
		$this->tenantDb->order_by('leave_id',"DESC");
		$query = $this->tenantDb->get();
		
		$errors = $this->tenantDb->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			sleep(5);
			$this->get_leaves($id='',$type='',$i);
		}else{
			return $query->result();
		}		
	}


    

}
?>