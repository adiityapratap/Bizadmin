<?php
class EmployeesDeatils_model extends CI_Model{
	
	public function get_total($table_name) 
    {
        return $this->tenantDb->count_all($table_name);
    }
 
	public function add_data_to_tble($table_name,$data=array()){
	    $this->tenantDb->insert($table_name,$data);
		 $insert_id = $this->tenantDb->insert_id();
		 
		 return  $insert_id;
	}
	public function delete_row($table_name,$unique_id_col_name,$unique_id_col_val){
	    $this->tenantDb->where($unique_id_col_name,$unique_id_col_val);   
		$this->tenantDb->delete($table_name);
	}
	
	public function delete_record($table_name,$unique_id_col_name,$unique_id_col_val,$data){
	     
	     $this->tenantDb->where($unique_id_col_name,$unique_id_col_val);
	  
		 return $this->tenantDb->update($table_name,$data);
	}
		public function fetch_column($table_name,$col_name,$where){
	    	$this->tenantDb->select($col_name);
			$this->tenantDb->from($table_name); 
			 $this->tenantDb->where('applicants_details_id',$where);
			 	$query = $this->tenantDb->get();
			 		return $query->result_array();
	}
	
	public function fetch_data($params,$i=null){

	   $table_name = $params['table_name'];
	   $limit = $params['limit'];  $start = $params['start']; $branch_id = $params['branch_id']; $role_id = $params['role_id'];  $type =  $params['type']; $emp_id = $params['emp_id'];
		if($table_name == "timesheet"){
		$this->tenantDb->distinct();   
		$this->tenantDb->select('timesheet.timesheet_id,timesheet.timesheet_name,roster.start_date,roster.end_date,timesheet.roster_group_id,multiple_roster_group_id');
		$this->tenantDb->from($table_name);   
		$this->tenantDb->join('roster', 'timesheet.roster_group_id = roster.roster_group_id','left'); 
		if($this->session->userdata('role') == 'employee'){
		   $this->tenantDb->join('employee_timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id'); 
		   $id = $this->session->userdata('UserId');
		   $this->tenantDb->where('employee_timesheet.employee_id',$id); 
		}
		 $this->tenantDb->where('timesheet.status',1);
		}else{
		$this->tenantDb->select('*'); 
		$this->tenantDb->from($table_name);
		}
		$this->tenantDb->limit($limit, $start);
		if($type =='employee'){
		$this->tenantDb->where('emp_id',$branch_id); 
		}elseif($type =='memo'){
		    if($table_name=='document'){
		      $this->tenantDb->where('role',$role_id);  
		      $this->tenantDb->or_where('role', "14");
		       $this->tenantDb->where('branch_id',$branch_id);
		    }else{
		  //   echo $branch_id; exit;
		    $this->tenantDb->where('role',$role_id); 
		    $this->tenantDb->or_where('role', "14"); 
		   
		    if($emp_id !=''){ 
		        $this->tenantDb->where('emp_id',$emp_id);
		        $this->tenantDb->or_where('emp_id',0);
		        }else{ 
		      $this->tenantDb->or_where('role', "14"); 
		      }
		       $this->tenantDb->where('branch_id',$branch_id);
		    }
			}else{
		    
		if($table_name == "timesheet"){
		    $this->tenantDb->where('timesheet.branch_id',$branch_id);
		}else{
		    $this->tenantDb->where('branch_id',$branch_id);
		}
			}
		
		$this->tenantDb->order_by($table_name.'_id',"DESC");
	
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
			$this->fetch_data($table_name,$branch_id,$limit,$start,$i=null);
		}else{
			return $query->result();
		}
	    
	}
	
    public function verify_pin($emp_pin,$emp_id) 
    {
         $this->tenantDb->select('*');
		$this->tenantDb->from('employee');
		$this->tenantDb->where('emp_id',$emp_id);
		$this->tenantDb->where('pin',$emp_pin);
		$result = $this->tenantDb->get();
	
       if ($result->num_rows() > 0) {
        return "verified";
       } else {
         return "Notverified";
         }
    }
	
	public function get_record_from_table($table_name,$id=''){
	   
	     $this->tenantDb->select('*');
		$this->tenantDb->from($table_name);
    	if($id != ''){
    		$this->tenantDb->where($table_name.'_id',$id);
    	}
    
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
			$this->get_record_from_table($table_name,$id,$i=null);
		}else{
		   
			return $query->result();
		}
	
	    
	}
	public function get_branchwise_record_from_table($table_name,$branch_id='',$status='',$id=''){
	   
	     $this->tenantDb->select('*');
		$this->tenantDb->from($table_name);
    	if($id != ''){
    		$this->tenantDb->where($table_name.'_id',$id);
    	}
    	if($status != ''){
    		$this->tenantDb->where('status',$status);
    	}
    	if($branch_id != ''){
    	    $this->tenantDb->where('branch_id',$branch_id);
    	}
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
			$this->get_branchwise_record_from_table($table_name,$branch_id,$id,$i=null);
		}else{
		   
			return $query->result();
		}
	
	    
	}
	public function update_table($table_name,$id,$data=array()){
	   
	    $this->tenantDb->where($table_name.'_id',$id);
	  
		 return $this->tenantDb->update($table_name,$data);
	}
		public function update_employee_timesheet($id,$data=array()){
	   
	    $this->tenantDb->where('timesheet_id',$id);
	  
		 return $this->tenantDb->update('employee_timesheet',$data);
	}
	
	function timesheet_filters($start_date,$end_date,$branch_id,$timesheet_name,$exEmployee,$type,$i=null){
	  	if((isset($start_date) && $start_date !='unset') || (isset($end_date) && $end_date !='unset')){
		    
		   $roster_group_ids = $this->fetch_rostergroup_id($start_date,$end_date,$branch_id);
		}
       

		$this->tenantDb->select('timesheet.timesheet_id,timesheet.timesheet_name,roster.start_date,roster.end_date,timesheet.roster_group_id,timesheet.multiple_roster_group_id');
	    $this->tenantDb->from('timesheet');
		$this->tenantDb->join('roster', 'timesheet.roster_group_id = roster.roster_group_id'); 
		

		
	   if(isset($timesheet_name) && $timesheet_name !='unset'){
// 		$this->tenantDb->where('timesheet.timesheet_name',$timesheet_name);
    //   echo $timesheet_name; exit;
      $this->tenantDb->like('timesheet.timesheet_name', $timesheet_name);
	
	   }
	   	if(!empty($roster_group_ids)){
		foreach($roster_group_ids as $roster_group_id){
		    $this->tenantDb->or_where('timesheet.roster_group_id', $roster_group_id->roster_group_id); 
		}
	}
	
	   if($exEmployee != '' && $exEmployee != 'unset'){
	       $this->tenantDb->or_where('roster.emp_id',$exEmployee);
	      
	   }
		   
	
	   $this->tenantDb->where('timesheet.branch_id',$branch_id);
       	$this->tenantDb->group_by("timesheet.timesheet_id");
       	$query = $this->tenantDb->get();
       	return $query->result();
       	
	}
	function fetch_rostergroup_id($start_date,$end_date,$branch_id){
	    
	       $this->tenantDb->select('roster_group_id');
		     $this->tenantDb->from('roster');  
		     
		     
		 if(isset($start_date) && $start_date !='unset'){
		    $myinput=$start_date;
		    $start_date=date('Y-m-d',strtotime($myinput)); 
		    $this->tenantDb->where('start_date >=',$start_date);
		    
		}
	
		if(isset($end_date) && $end_date !='unset'){
		     $myinput=$end_date;
		     $end_date=date('Y-m-d',strtotime($myinput)); 
		    $this->tenantDb->where('end_date <=',$end_date);
		    
		}
		 $this->tenantDb->where('branch_id',$branch_id);
		 	$this->tenantDb->group_by("roster_group_id");
  	   $query = $this->tenantDb->get();
  	   
  	   return (array)$query->result();
  	   
  	 
		
	    
	}
	
	public function get_approved_timesheet($i=null){
	    
	    $branch_id = $this->session->userdata('branch_id');
	    
	    $this->tenantDb->select('employee_timesheet.in_time,employee_timesheet.out_time,employee_timesheet.break_in_time,employee_timesheet.break_out_time,employee_timesheet.in_verify,employee_timesheet.timesheet_id,employee_timesheet.roster_id,employee_timesheet.date,employee.first_name,employee.last_name');
		$this->tenantDb->from('employee_timesheet');
	    $this->tenantDb->join('employee', 'employee.emp_id = employee_timesheet.employee_id','left');
	    $this->tenantDb->join('timesheet', 'timesheet.timesheet_id = employee_timesheet.timesheet_id','left');
		$this->tenantDb->where('timesheet.branch_id',$branch_id);
		$this->tenantDb->where('employee_timesheet.in_verify',1);
		
		
	
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
			$this->get_approved_timesheet($i=null);
		}else{
		   
			return $query->result();
		}
	
	    
	}
	
	public function get_approved_timesheet_timedifference($roster_id,$emp_ts_id,$i=null){
	  
	    $this->tenantDb->select('TIMEDIFF(out_time, in_time) as in_out_diff ,TIMEDIFF(break_out_time, break_in_time) as break_diff,employee_timesheet_id');
		$this->tenantDb->from('employee_timesheet');
	   
		$this->tenantDb->where('roster_id',$roster_id);
		$this->tenantDb->where('employee_timesheet_id',$emp_ts_id);
		
		
	
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
			$this->get_approved_timesheet_timedifference($roster_id,$i=null);
		}else{
		   
		
			return $query->result();
		}
	
	    
	}
	
	public function get_disbaled_employees($branch_id){
		$this->tenantDb->select('*');
		$this->tenantDb->from('employee');
		$this->tenantDb->where('branch_id',$branch_id);
        $this->tenantDb->where('status',0);
		$this->tenantDb->order_by('first_name','ASC');
		$query = $this->tenantDb->get();
		return $query->result();
	}
	
}