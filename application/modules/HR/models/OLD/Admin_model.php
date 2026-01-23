<?php
class Admin_model extends CI_Model{
	protected $table = 'HR_roster';
	
	function __construct() {
	parent::__construct();
	}
	public function get_employees($i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		$query = $this->tenantDb->get();
		$this->tenantDb->where('status',1);
		
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
			$this->get_employees($i);
		}else{
			return $query->result();
		}
	}
	
	public function give_branch_access_employee($branchAccessData){
	       $this->tenantDb->insert('branches_access', $branchAccessData);  
	}
	public function add_unavailability($data){
	    $this->tenantDb->insert('HR_emp_availability', $data);  
	    $insert_id = $this->tenantDb->insert_id();
	    return $insert_id;
	}
	function del_unavailability($id){
		$this->tenantDb->where('emp_availability_id',$id);
		return $this->tenantDb->delete('HR_emp_availability');
	}
	public function fetch_unavailability($i = 0){
	    
	    $emp_id = $this->session->userdata('UserId');
	    $today = date('Y-m-d');
	    $this->tenantDb->select('*');
		$this->tenantDb->from('HR_emp_availability');
		$this->tenantDb->where('emp_id',$emp_id);
		$this->tenantDb->where('start_date >',$today);
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
			$this->fetch_unavailability($i);
		}else{
			return $query->result();
		}
	}
	
	public function getbranch_manager_email($branchID,$i=null){
	  
	    $this->tenantDb->select('*');
		$this->tenantDb->from('customer_branches');
		$this->tenantDb->where('branch_id',$branchID);
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
			$this->getbranch_manager_email($i);
		}else{
			return $query->result();
		}
	}
	
	function submitResume($data,$resume_id,$type=''){
	    
	   if($resume_id == '' || $type == 'create'){
	    $this->tenantDb->insert('resumes',$data);   
	   }else{
	      $this->tenantDb->where('resume_id',$resume_id);
		$this->tenantDb->update('resumes',$data);
	   }
	    
	    return true;
	}
	public function get_resumes($resume_id='',$dataFilter){
	    $branch_id = $this->session->userdata('branch_id');
		$this->tenantDb->select('*');
		$this->tenantDb->from('resumes');
		
		if($resume_id != ''){
		    $this->tenantDb->where('resume_id',$resume_id);
		    
		}
		if(isset($dataFilter['candidate_name']) && $dataFilter['candidate_name'] != ''){
           $this->tenantDb->like('candidate_name',$dataFilter['candidate_name']);
        }
        if(isset($dataFilter['phone']) && $dataFilter['phone'] != ''){
           $this->tenantDb->like('phone',$dataFilter['phone']);
        }
        if(isset($dataFilter['email']) && $dataFilter['email'] != ''){
            $this->tenantDb->like('email',$dataFilter['email']);
        }
		$this->tenantDb->where('branch_id',$branch_id);
		$query = $this->tenantDb->get();
		return $query->result();
		
	}	
	public function resume_del($resume_id){
		$this->tenantDb->where('resume_id',$resume_id);
		return $this->tenantDb->delete('resumes');
		
	}
	function post_job($job_data,$id='',$type=''){
	   if($id =='' || $type =='recreate'){
	    $this->tenantDb->insert('careers',$job_data);   
	   }else{
	      $this->tenantDb->where('id',$id);
		$this->tenantDb->update('careers',$job_data);
	   }
	    
	    return true;
	}
	function update_job_status($data,$id){
		 $this->tenantDb->where('id',$id);
		 return $this->tenantDb->update('careers',$data);
	}
	function update_interview_status($data,$id){
			 $this->tenantDb->where('interview_assesment_id',$id);
		 return $this->tenantDb->update('interview_assesment',$data);
	}
	function delete_job($id){
		$this->tenantDb->where('id',$id);
		return $this->tenantDb->delete('careers');
	}

	public function get_public_holidays($i=null){
		$this->tenantDb->select('date,branch_ids');
		$this->tenantDb->from('public_holidays');
			$this->tenantDb->where('status',1);
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
			$this->get_public_holidays($i);
		}else{
			return $query->result();
		}
	}
	
public function fetch_manager_notifications(){
		 $branch_id = $this->session->userdata('branch_id');
		
		$table ='notification';
		$condition = ' send_to ="manager" AND  status = 1 AND branch_id ='.$branch_id;
		$query = $this->tenantDb->query('SELECT * FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition." order by id desc");
			return $query->result();
	}
public function fetch_notifications_count(){
     $branch_id = $this->session->userdata('branch_id');
		
		$table ='notification';
		$condition = ' send_to ="manager" AND status = 1 AND branch_id ='.$branch_id;
		$query = $this->tenantDb->query('SELECT COUNT(id) as total_count FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition);
	
			return $query->result_array();
}
	
	public function fetch_notifications_count_emp(){
		 $emp_id = $this->session->userdata('UserId');
		
		$table ='notification';
		$condition = ' send_to = "employee" AND status = 1 AND emp_id ='.$emp_id;
		$query = $this->tenantDb->query('SELECT COUNT(id) as total_count FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition);
			return $query->result_array();
	}
	
public function fetch_employee_notifications(){
		 $emp_id = $this->session->userdata('UserId');

		$table ='notification';
		$condition = ' send_to ="employee" AND status = 1 AND emp_id ='.$emp_id;
         $query = $this->tenantDb->query('SELECT * FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition);
       
       
			return $query->result();
	}
	
	function employee_roster_reports($start_date='',$end_date='',$empID){ 
		    
	     $branch_id = $this->session->userdata('branch_id');
	     
        $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
	  
	    $this->tenantDb->where('emp_id',$empID);
	     if($start_date !=''){
	    $this->tenantDb->where('start_date >=',$start_date);
	     }
	    if($end_date !=''){
	       $this->tenantDb->where('start_date <=',$end_date);   
	    }
	  $query = $this->tenantDb->get();
	  return $query->result();		
	}
	
	
   function roster_weekly_reports($start_date,$end_date, $i=null){ 
		    
	     $branch_id = $this->session->userdata('branch_id');
	     
        $this->tenantDb->select('*');
		$this->tenantDb->from('weekly_roster_report');
	
	    $this->tenantDb->where('branch_id',$branch_id);
	    $this->tenantDb->where('start_date',$start_date);
	       $this->tenantDb->where('end_date',$end_date);
	    
	    
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
			$this->roster_weekly_reports('','',$i);
		}else{
			return $query->result();
		}		
	}
	
	function save_weekly_report($start_date,$end_date,$week_roster_name,$report_data){
	    $branch_id = $this->session->userdata('branch_id');
	    $data  = array(
	       'start_date' => $start_date,
	       'end_date' => $end_date,
	       'branch_id' => $branch_id,
	       'roster_data' => serialize($report_data)
	        );
	    $this->tenantDb->insert('weekly_roster_report',$data);
	    return true;
	}
	
	function add_notification($data){
	    	$this->load->model('employees_model');
	   $branch_result = $this->employees_model->get_emp_update($data['emp_id']);

			foreach($branch_result as $row){
				$branchId = $row->branch_id;
			}
			
	$data['branch_id'] = $branchId;
	   if($this->tenantDb->insert('notification',$data)){
	         return true;
	   }else{
	    return true;
	   }
	 
	}
	
	public function week_roster($id='',$emp_id='',$filter=false,$i=null){ 
         $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
	if($filter == true){
	    
	    $this->tenantDb->where_in('roster_group_id',$id);
	  $this->tenantDb->where('emp_id',$emp_id); 
		
	}else{
	 $this->tenantDb->where('roster_group_id',$id);
		$role = $this->session->userdata('role');	
		if($role =="employee"){
		    $this->tenantDb->where('emp_id',$emp_id);
		}   
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
			$this->week_roster($id,$emp_id,$i);
		}else{
			return $query->result();
		}		
	}
	public function week_roster_beta($id='',$emp_id='',$filter=false,$i=null){ 
         $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		$this->tenantDb->join('HR_employee as employee', 'roster.emp_id = employee.emp_id ','left');
		$this->tenantDb->join('emp_department', 'roster.roster_department = emp_department.emp_department_id ','left');
		$this->tenantDb->join('role', 'employee.role = role.role_id ','left');
	if($filter == true){
	    
	    $this->tenantDb->where_in('roster.roster_group_id',$id);
	  $this->tenantDb->where('roster.emp_id',$emp_id); 
		
	}else{
	 $this->tenantDb->where('roster.roster_group_id',$id);
		$role = $this->session->userdata('role');	
		if($role =="employee"){
		    $this->tenantDb->where('employee.emp_id',$emp_id);
		}   
	}
	$this->tenantDb->order_by("roster.roster_department", "asc");	
		$query = $this->tenantDb->get();
		
			return $query->result();		
	}
	public function check_shift($roster_id,$dayname){
	    
	  
	     $this->tenantDb->select($dayname);
		 $this->tenantDb->from('HR_roster');
	    $this->tenantDb->where('roster_id',$roster_id);
	
		$query = $this->tenantDb->get();
		
		return $query->result();
	}
	public function fetch_role($branch_id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('role');
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
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
			$this->fetch_role($branch_id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function get_disbaled_employees($branch_id){
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		$this->tenantDb->where('branch_id',$branch_id);
        $this->tenantDb->where('status',0);
		$this->tenantDb->order_by('first_name','ASC');
		$query = $this->tenantDb->get();
		return $query->result();
	}
	public function get_employees_branchwise($branch_id,$type='',$id='',$field_name='',$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		
	
		if($type == 'admin'){
		    
		$this->tenantDb->where('branch_id',$branch_id);
		    $this->tenantDb->where('status',1);
		    
		}else if($type == 'manager'){
		    
		    $this->tenantDb->where('branch_id',$branch_id);
		    $this->tenantDb->where('status',1);
		}else{
		  $this->tenantDb->where('emp_id',$branch_id);  
		  $this->tenantDb->where('status',1);
		}
		if(isset($id) && $id != ''){
		   $this->tenantDb->where($field_name,$id);  
		}
		
		
		$this->tenantDb->order_by('first_name','ASC');
		$query = $this->tenantDb->get();
		
		
		return $query->result();
	}
	
	public function get_emp_departments_branchwise($branch_id,$id='',$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('emp_department');
		 
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
		
		if(isset($id) && $id != ''){
		   $this->tenantDb->where('emp_department_id',$id);  
		}
		
		
		$this->tenantDb->order_by('department_name','ASC');
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
			$this->get_emp_departments_branchwise($branch_id,$id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_outlet_branchwise($branch_id,$id='',$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('outlet');
		 
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
		
		if(isset($id) && $id != ''){
		   $this->tenantDb->where('outlet_id',$id);  
		}
		
		
		$this->tenantDb->order_by('outlet_name','ASC');
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
			$this->get_outlet_branchwise($branch_id,$id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function filter_get_employees_branchwise($branch_id='',$name,$phone,$email,$i=null){
	 
	    	$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		if(isset($name) && $name !='unset'){
		    $this->tenantDb->like('first_name', $name);
		    
		}
		if(isset($email) && $email !='unset'){
		   
		    $this->tenantDb->where('email',$email);
		}
		if(isset($phone) && $phone !='unset'){
		    
		    $this->tenantDb->where('phone',$phone);
		}
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
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
			$this->filter_get_employees_branchwise($branch_id,$name,$phone,$email,$i);
		}else{
			return $query->result();
		}
	    
	}
	
	public function filter_get_disabled_employees_branchwise($branch_id='',$name,$phone,$email,$i=null){
	 
	    	$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		if(isset($name) && $name !='unset'){
		    $this->tenantDb->like('first_name', $name);
		    
		}
		if(isset($email) && $email !='unset'){
		   
		    $this->tenantDb->where('email',$email);
		}
		if(isset($phone) && $phone !='unset'){
		    
		    $this->tenantDb->where('phone',$phone);
		}
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',0);
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
			$this->filter_get_disabled_employees_branchwise($branch_id,$name,$phone,$email,$i);
		}else{
			return $query->result();
		}
	    
	}
	function add_employee($data){
	    
		 $this->tenantDb->insert('HR_employee as employee',$data);
		 $insert_id = $this->tenantDb->insert_id();
		 $data2=array(
			'id' => $insert_id,
			);
		 $this->tenantDb->insert('emp_uniform',$data2);
		 return  $insert_id;
	}
	function saveOutlet($data){
	    
		 $this->tenantDb->insert('outlet',$data);
		 $insert_id = $this->tenantDb->insert_id();
		 
		 return  $insert_id;
	}
	function saveData($tablename,$data){
	    
		 $this->tenantDb->insert($tablename,$data);
		 $insert_id = $this->tenantDb->insert_id();
		 
		 return  $insert_id;
	}
	public function fetch_record($tablename,$branch_id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from($tablename);
		$this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
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
			$this->fetch_record($tablename,$branch_id,$i);
		}else{
			return $query->result();
		}
	}
    function add_report($data){
	    
		 $this->tenantDb->insert('reports',$data);
		 $insert_id = $this->tenantDb->insert_id();
// 		 $data2=array(
// 			'id' => $insert_id,
// 			);
// 		 $this->tenantDb->insert('emp_uniform',$data2);
		 return  $insert_id;
	}
	
	function add_role($data){
	    
		 $this->tenantDb->insert('role',$data);
		 $insert_id = $this->tenantDb->insert_id();
		 
		 return  $insert_id;
	}
	
	function add_user($data_user){
	    $this->tenantDb->insert('customer_users',$data_user);
		$insert_id = $this->tenantDb->insert_id();
		return  $insert_id;
	}
	function user_group_insert($data_user_groups){
	    $this->tenantDb->insert('customer_users_groups',$data_user_groups);
	}
	public function get_emp_update($id,$i=null){
	   
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		$this->tenantDb->where('emp_id',$id);
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
			$this->get_emp_update($id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function get_emp_uniform($id,$i=null){
	   
		$this->tenantDb->select('*');
		$this->tenantDb->from('emp_uniform');
		$this->tenantDb->where('id',$id);
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
			$this->get_emp_update($id,$i);
		}else{
			return $query->result();
		}
	}
	
	function update_employee($data_user,$id){
		 $this->tenantDb->where('emp_id',$id);
		 return $this->tenantDb->update('HR_employee as employee',$data_user);
	}
	
	function update_employee_uniform($data_user,$id){
	    
		$this->tenantDb->where('id',$id);
        $q = $this->tenantDb->get('emp_uniform');

        if ( $q->num_rows() > 0 ) 
       {
         $this->tenantDb->where('id',$id);
         $this->tenantDb->update('emp_uniform',$data_user);
        } else {
        $this->tenantDb->set('id', $id);
        $this->tenantDb->insert('emp_uniform',$data_user);
        }

	}
	
	function update_employee_job_desc($data_job_desc,$id){
		 $this->tenantDb->where('emp_id',$id);
		 
	
		 return $this->tenantDb->update('HR_employee',$data_job_desc);
	}
	
	function update_complete_roster($data,$roster_id){

		$this->tenantDb->where('roster_id',$roster_id);
		return $this->tenantDb->update('HR_roster',$data);
	}
	
	function update_user($id,$data_user,$branch_data=array()){
	 
	 	$this->tenantDb->where('customer_user_id',$id);
		$this->tenantDb->delete('branches_access');
	     
	    foreach($branch_data as $bd){
	      $data2 = array(
	     'branch_id' => $bd,
	     'customer_user_id' => $id
	     );
	 
	 $this->tenantDb->insert('branches_access',$data2);  
	    }
		 $this->tenantDb->where('customer_user_id',$id);
		 
		
		 return $this->tenantDb->update('customer_users',$data_user);
	}
	
	function update_branch($id,$data_user){
		 $this->tenantDb->where('branch_id',$id);
		 return $this->tenantDb->update('customer_branches',$data_user);
	}
	
	function employee_delete($id){
		$this->tenantDb->where('emp_id',$id);
		$this->tenantDb->delete('HR_employee');
	}
	
	function user_delete($id){
	  
		$this->tenantDb->where('customer_user_id',$id);
		$this->tenantDb->delete('customer_users');
	}
	
	function role_delete($id){
	  
		$this->tenantDb->where('role_id',$id);
		$this->tenantDb->delete('role');
	}
	
	function add_branch($data){
	    
	 $this->tenantDb->insert('customer_branches',$data);
	 
	 $data2 = array(
	     'branch_id' => $this->tenantDb->insert_id(),
	     'customer_user_id' => $this->session->userdata('user_id')
	     );
	 
	 $this->tenantDb->insert('branches_access',$data2);
	 return true;
	 
	}
	function branch_delete($id){
	 
	  
	    $this->tenantDb->where('branch_id',$id);
		$this->tenantDb->delete('branches_access');
		
		$this->tenantDb->where('branch_id',$id);
		$this->tenantDb->delete('customer_branches');
	}
	
	function fetch_users($user_id = '',$i=null){
	   $branch_id = $this->session->userdata('branch_id');
	   $this->tenantDb->select('*');
	   $this->tenantDb->from('customer_users');
	   if(isset($user_id) && $user_id !=''){
	     $this->tenantDb->where('customer_user_id',$user_id);  
	   }
	      
	    $this->tenantDb->where('branch_id',$branch_id); 
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
			$this->fetch_users('',$i);
		}else{
			return $query->result();
		}
	    
	}
	function fetch_careers($id=''){
	   $branch_id = $this->session->userdata('branch_id');
	   $this->tenantDb->select('*');
	   $this->tenantDb->from('careers');
	   if($id !=''){
	    $this->tenantDb->where('id',$id);   
	   }
	   $this->tenantDb->where('branch_id',$branch_id); 
	  $this->tenantDb->order_by('id','DESC');
	   $query = $this->tenantDb->get();
		return $query->result();
	    
	}
	
	function fetch_applications($id=''){
	  
	     $branch_id = $this->session->userdata('branch_id');
	   $this->tenantDb->select('applicants_details.*,careers.job_name,careers.start_date');
	   $this->tenantDb->from('applicants_details');
	   $this->tenantDb->join('careers', 'applicants_details.job_id = careers.id ','left');
	   if($id !=''){
	    $this->tenantDb->where('applicants_details.applicants_details_id',$id);   
	   }
	   $this->tenantDb->where('applicants_details.branch_id',$branch_id); 
	   // $this->tenantDb->where('applicants_details.status',1); 
	  $this->tenantDb->order_by('applicants_details.applicants_details_id','DESC');
	   $query = $this->tenantDb->get();
	    return $query->result();
	 if($query !== FALSE && $query->num_rows() == 1) // if the affected number of rows is one
     {
      return $query->result();
     }
     else
    {
      return true;
    }
	}
	
	function fetch_roles($user_id = '',$i=null){
	    $branch_id = $this->session->userdata('branch_id');
	   $this->tenantDb->select('*');
	   $this->tenantDb->from('role');
	    $this->tenantDb->where('branch_id',$branch_id); 
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
			$this->fetch_roles('',$i);
		}else{
			return $query->result();
		}
	    
	}
	
	function fetch_branches($branch_id = '',$i=null){
	    
	   $this->tenantDb->select('*');
	   $this->tenantDb->from('customer_branches');
	   if(isset($branch_id) && $branch_id !=''){
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
			$this->fetch_branches('',$i);
		}else{
			return $query->result();
		}
	    
	}
	function fetch_branches_basedonuser($i=null){
	  
	   $this->tenantDb->select('*');
	   $this->tenantDb->from('customer_branches');
	   $this->tenantDb->join('branches_access', 'branches_access.branch_id = customer_branches.branch_id','left');
	   $this->tenantDb->where('branches_access.customer_user_id',$this->session->userdata('user_id'));
	 
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
			$this->fetch_branches_basedonuser($i);
		}else{
			return $query->result();
		}
	    
	}
	function get_user_status($user_id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('customer_users');
		$this->tenantDb->where('customer_user_id',$user_id);
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
			$this->get_user_status($user_id,$i);
		}else{
			return $query->result();
		}
	}
	function get_emp_details($emp_id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		$this->tenantDb->where('emp_id',$emp_id);
		$this->tenantDb->order_by('first_name','ASC');
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
			$this->get_emp_details($emp_id,$i);
		}else{
			return $query->result();
		}
	}
	function add_induction_form($data,$emp_id){
		$this->tenantDb->where('emp_id',$emp_id);
		return $this->tenantDb->update('HR_employee',$data);
	}
	function status_update($data_user,$user_id){
		$this->tenantDb->where('customer_user_id',$user_id);
		return $this->tenantDb->update('customer_users',$data_user);
	}
	function get_email($id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('customer_users');
		$this->tenantDb->where('customer_user_id',$id);
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
			$this->get_email($id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_employee_timesheet($id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee');
		$this->tenantDb->where('emp_id',$id);
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
			$this->get_employee_timesheet($id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_timesheet($id='',$timesheet_id='',$date='',$roster_id='',$i=null){

		$this->tenantDb->select('*');
		$this->tenantDb->from('employee_timesheet');
		if(isset($date) && $date !=''){
		 $this->tenantDb->where('date',$date); 
		}
		if(isset($id) && $id !=''){
		 $this->tenantDb->where('employee_id',$id);   
		}
		if(isset($timesheet_id) && $timesheet_id !=''){
		    $this->tenantDb->where('timesheet_id',$timesheet_id);
		}
		
		
		if($roster_id !=''){
		    $this->tenantDb->where('roster_id',$roster_id);
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
			$this->get_timesheet($id,$roster_id,$date,$roster_id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_all_timesheet($branch_id='',$future='',$i=null){
		$this->tenantDb->distinct();
		$this->tenantDb->select('timesheet.*,roster.start_date,roster.end_date');
		$this->tenantDb->from('timesheet');
		$this->tenantDb->join('HR_roster', 'roster.roster_group_id = timesheet.roster_group_id','left');
		$this->tenantDb->where('timesheet.branch_id',$branch_id);
		$this->tenantDb->where('timesheet.status',1);
	   	$todays_date = date('Y-m-d');
	   	 // check this thing
	   //	  $this->tenantDb->where('roster.start_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
	   	  
	   	if($future !=''){
		 $this->tenantDb->where('roster.end_date >= ',$todays_date);
	   	}
		
// 		 $this->tenantDb->where('roster.start_date >=',$todays_date);
		 $this->tenantDb->order_by('roster.start_date',"ASC");
	
		
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
			$this->get_all_timesheet($branch_id,$i);
		}else{
		    
		 
			return $query->result();
		}
	}
	
	public function getthis_timesheet_details($timesheet_id,$roster_id,$type){
	    
	    
		$this->tenantDb->select($type);
		$this->tenantDb->from('employee_timesheet');
		$this->tenantDb->where('roster_id',$roster_id);
		$this->tenantDb->where('timesheet_id',$timesheet_id);
		$query = $this->tenantDb->get();
		return $query->result_array();
		
	}
	public function get_timesheet_id($id,$i=null){
		$date = date("Y-m-d");
		$this->tenantDb->select('*');
		$this->tenantDb->from('employee_timesheet');
		$this->tenantDb->where('date',$date);
		$this->tenantDb->where('timesheet_id',$id);
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
			$this->get_timesheet_id($id,$i);
		}else{
			return $query->result();
		}
	}
	function submit_employee_timesheet($data){
		 return $this->tenantDb->insert('employee_timesheet',$data);
	}
	
  public function get_timesheet_nameby_id($timesheet_id){
      $this->tenantDb->select('timesheet_name');
		$this->tenantDb->from('timesheet');
		$this->tenantDb->where('timesheet_id',$timesheet_id);
			$query = $this->tenantDb->get();
			return $query->result();
  }
  
    public function get_timesheet_by_roster_group_id($roster_group_id){
      $this->tenantDb->select('timesheet_id');
		$this->tenantDb->from('employee_timesheet');
		$this->tenantDb->where('roster_group_id',$roster_group_id);
		$this->tenantDb->where('status',1);
			$this->tenantDb->where('timesheet_id !=',0);
			$query = $this->tenantDb->get();
			return $query->result();
  }
	
	
	function fetch_emp_idofthisroster($roster_group_id){
	    
	    $this->tenantDb->select('emp_id,start_date,end_date');
		 $this->tenantDb->from('HR_roster');
	    $this->tenantDb->where('roster_group_id',$roster_group_id);
	
		$query = $this->tenantDb->get();
		
		return $query->result();
	}
	function get_emp_idofthisroster($empId,$roster_id,$roster_group_id){
	    
	    $this->tenantDb->select('emp_id,start_date,end_date');
		 $this->tenantDb->from('HR_roster');
	    $this->tenantDb->where('roster_group_id',$roster_group_id);
	    $this->tenantDb->where('emp_id',$empId);
	    $this->tenantDb->where('roster_id',$roster_id);
	
		$query = $this->tenantDb->get();
		
		return $query->result();
	}
	function update_employee_timesheet($data_out,$timesheet_id,$roster_id,$outlet=''){
	    
	    if(isset($timesheet_id) && $timesheet_id !=''){
	       $this->tenantDb->where('timesheet_id',$timesheet_id); 
	    }
	    $date = date('Y-m-d');
	    
	    $this->tenantDb->where('date = ', $date);
	    
		$this->tenantDb->where('roster_id',$roster_id);
	     
	    
		return $this->tenantDb->update('employee_timesheet',$data_out);
	}	
	function update_employee_timesheet_emps($prev_emp,$emp_id,$timesheet_id){
	    $data = array(
	        'employee_id' => $emp_id,
	        );
	       
	    
	    if($prev_emp !='' && $timesheet_id !=''){
	       $this->tenantDb->where('employee_id',$prev_emp); 
	  
	       $this->tenantDb->where('timesheet_id',$timesheet_id); 
	        return $this->tenantDb->update('employee_timesheet',$data);
	       
	    }
	    
		
	}
	
	function update_employee_timesheet_data($data_out,$employee_timesheet_id){
	    
	 $this->tenantDb->where('employee_timesheet_id',$employee_timesheet_id); 
	    
	 return $this->tenantDb->update('employee_timesheet',$data_out);
	}
	
	public function check_insert_or_update($emp_id,$timesheet_id,$date){
	    $this->tenantDb->select('*');
		$this->tenantDb->from('employee_timesheet');
		$this->tenantDb->where('date',$date);
		$this->tenantDb->where('timesheet_id',$timesheet_id);
		$this->tenantDb->where('employee_id',$emp_id);
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
			$this->check_insert_or_update($emp_id,$timesheet_id,$date);
		}else{
			return "found";
		}
	
	    
	}
	function add_job_applicant($data){
		return $this->tenantDb->insert('job_application',$data);
	}
	function getleaves($params,$i=''){
	    
	  
	    $branch_id = $this->session->userdata('branch_id');
		$this->tenantDb->select('leave_management.*, employee.first_name');
		$this->tenantDb->from('HR_leave_management as leave_management');
		$this->tenantDb->join('HR_employee as employee', 'leave_management.emp_id = employee.emp_id');
		$this->tenantDb->where('leave_management.branch_id',$branch_id);
		
			if(!empty($params))
		     {
		       if(isset($params['first_name'])){
		    
		        $this->tenantDb->like('employee.first_name',$params['first_name']);
		      } 
		    
           if(isset($params['start_date'])){
		     $this->tenantDb->where('leave_management.start_date',$params['start_date']);   
		    }
		    
		  
	
		     if(isset($params['status'])){
		     $this->tenantDb->where('leave_management.leave_status',$params['status']);   
		    }
			
		    
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
			$this->getleaves($params,$i);
		}else{
			return $query->result();
		}
		
			
	}
	function get_leaves($i=null){

		$branch_id = $this->session->userdata('branch_id');
		
		$this->tenantDb->select('leave_management.*, employee.first_name');
		$this->tenantDb->from('HR_leave_management as leave_management');
		$this->tenantDb->join('HR_employee as employee', 'leave_management.emp_id = employee.emp_id');
		$this->tenantDb->where('leave_management.branch_id',$branch_id);
		$this->tenantDb->order_by('leave_management.leave_id',"desc");
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
			$this->get_leaves($i);
		}else{
			return $query->result();
		}
		
	}
	
	function get_leavesdate_all_emps($emp_id,$start_date,$end_date,$i=''){

	    $branch_id = $this->session->userdata('branch_id');
		$this->tenantDb->select('leave_management.start_date,leave_management.end_date');
		$this->tenantDb->from('HR_leave_management as leave_management');
		$this->tenantDb->where('leave_management.branch_id',$branch_id);
		$this->tenantDb->where('leave_management.leave_status','Approve');
		$this->tenantDb->where('leave_management.emp_id',$emp_id);
		
		
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
			$this->get_leavesdate_all_emps($emp_id,$start_date,$end_date);
		}else{
			return $query->result();
		}
	}
	function get_leaves_manager_update($id,$i=null){
	    
        $this->tenantDb->select('*');
		$this->tenantDb->from('HR_leave_management as leave_management');
		$this->tenantDb->where('leave_id',$id);
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
			$this->get_leaves_manager_update($id,$i);
		}else{
			return $query->result();
		}
		
	}
	function update_leave_manager($data,$leave_id){
		$this->tenantDb->where('leave_id',$leave_id);
		return $this->tenantDb->update('HR_leave_management as leave_management',$data);
	}
	function insert_roster($data){
		  $this->tenantDb->insert('HR_roster',$data);
		  $insert_id = $this->tenantDb->insert_id();
          return  $insert_id;
	}
	function update_rostergroup_id($roster_id){
	    $data = array(
	        'roster_group_id' => $this->session->userdata('rostergroup_id')
	        );
	    $this->tenantDb->where('roster_id',$roster_id);
		return $this->tenantDb->update('HR_roster',$data);
	}
	function get_employees_roster($branch_id='',$future='',$i=null){
	     $this->tenantDb->distinct();
         $this->tenantDb->select('roster_group_id,start_date,end_date,roster_name');
		 $this->tenantDb->from('HR_roster');
	
		if(isset($branch_id) && $branch_id != ''){
		   
		 $this->tenantDb->where('branch_id',$branch_id);
		 $todays_date = date('Y-m-d');
		if($future !=''){
		  //$this->tenantDb->where('roster.start_date ');
		     $this->tenantDb->where('roster.end_date >=',$todays_date);
		}else{
		    $this->tenantDb->where('start_date BETWEEN DATE_SUB(NOW(), INTERVAL 21 DAY) AND NOW()');
		}
		 
		 
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
			$this->get_employees_roster($branch_id,$future,$i);
		}else{
			return $query->result();
		}
		
	}
	function get_emp_roster($id,$roster_group_id='',$i=null){
         $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		if($roster_group_id !=''){
		   $this->tenantDb->where('roster_group_id',$roster_group_id); 
		}else{
		   $this->tenantDb->where('emp_id',$id); 
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
			$this->get_emp_roster($id,$roster_group_id,$i);
		}else{
			return $query->result();
		}		
	}
	
				// start 6Jan 2021 work
				
				
// 	function get_emps_roster_week($emp_id,$start_date,$end_date,$i=''){
// 	     $this->tenantDb->select('DISTINCT(emp_id)');
// 		$this->tenantDb->from('HR_roster');
		
// 		if($start_date !='' && $end_date !=''){
// 		    $condition = "(start_date BETWEEN '" . $start_date . "'" . " AND " . "'" . $end_date . "' or end_date BETWEEN '" . $start_date . "'" . " AND '" . $end_date . "')";
// 		   $this->tenantDb->where($condition); 
// 		}
// 		if($emp_id !=''){
// 		   $this->tenantDb->where('emp_id',$emp_id); 
// 		}
		
// 		$query = $this->tenantDb->get();
// 		 	$errors = $this->tenantDb->error();
// 		if($errors['code'] != 0){
// 			if($i == null){
// 				$i = 1;
// 			}else{
// 				$i = $i+1;
// 			}
			
// 			if($i == 5){
// 				show_error('error '+$i);
// 			}
// 			sleep(5);
// 			$this->get_emps_roster_week($emp_id,$start_date,$end_date);
// 		}else{
// 			return $query->result();
// 		}
		 
// 	}
// function get_emps_roster_week_time($emp_id,$start_date,$end_date,$i=''){
// 	     $this->tenantDb->select('*');
// 		$this->tenantDb->from('HR_roster');
		
// 		if($start_date !='' && $end_date !=''){
// 		    $condition = "(start_date BETWEEN '" . $start_date . "'" . " AND " . "'" . $end_date . "' or end_date BETWEEN '" . $start_date . "'" . " AND '" . $end_date . "')";
// 		   $this->tenantDb->where($condition); 
// 		}
// 		if($emp_id !=''){
// 		   $this->tenantDb->where('emp_id',$emp_id); 
// 		}
		
// 		$query = $this->tenantDb->get();
// 		 	$errors = $this->tenantDb->error();
// 		if($errors['code'] != 0){
// 			if($i == null){
// 				$i = 1;
// 			}else{
// 				$i = $i+1;
// 			}
			
// 			if($i == 5){
// 				show_error('error '+$i);
// 			}
// 			sleep(5);
// 			$this->get_emps_roster_week($emp_id,$start_date,$end_date);
// 		}else{
// 			return $query->result();
// 		}
		 
// 	}
			// End 6Jan 2021 work
	
	function update_roster($data,$roster_id){
		$this->tenantDb->where('roster_group_id',$roster_id);
		return $this->tenantDb->update('HR_roster',$data);
	}
	function delete_roster($id,$emp_id=""){
	   
		$this->tenantDb->where('roster_group_id',$id);
		if($emp_id !=''){
		$this->tenantDb->where('emp_id',$emp_id);   
		}
		$this->tenantDb->delete('HR_roster');
	}
	
	function delete_document($id,$emp_id=""){
	   
		$this->tenantDb->where('document_id',$id);
		if($emp_id !=''){
		$this->tenantDb->where('emp_id',$emp_id);   
		}
		$this->tenantDb->delete('document');
	}
	public function delete_single_roster($roster_group_id,$roster_id){
	    
	    $this->tenantDb->where('roster_group_id',$roster_group_id);
	
		$this->tenantDb->where('roster_id',$roster_id);   

		$this->tenantDb->delete('HR_roster');
		
		// delete this roster from timesheet also when updating
		

		$this->tenantDb->where('roster_id',$roster_id);   

		$this->tenantDb->delete('employee_timesheet');
		
		
		
		
	}
	
	public function fetch_employee_for_timsheet($roster_group_id){
	    
	 
	   $outletname = date("l")."_layout";
	   
	   	$this->tenantDb->select('employee.emp_id,employee.first_name,employee.last_name,employee.fingerprint_auth_status,roster.roster_id,roster.'.$outletname.' as outlet_name');
		$this->tenantDb->from('HR_roster');
	     $this->tenantDb->join('HR_employee as employee', 'roster.emp_id = employee.emp_id');
		$this->tenantDb->where('roster.roster_group_id',$roster_group_id);
		$this->tenantDb->order_by('employee.first_name',"ASC");
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
			$this->fetch_employee_for_timsheet($roster_group_id);
		}else{
		    
		   
			return $query->result();
		}
	}
	
	 public function get_roster_weeks_list($limit, $start) {
        $this->tenantDb->limit($limit, $start);
        $query = $this->tenantDb->get($this->table);

        return $query->result();
    }
	public function get_roster_weeks($id,$type='',$dash='',$limit='', $start='',$i=null){
	    
       $this->tenantDb->limit($limit, $start);
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		$this->tenantDb->group_by("roster_group_id");
			if($type == 'admin'){
		 $this->tenantDb->where('branch_id',$id);   
		}
		elseif($type == 'roster_mail'){
		   
		    $this->tenantDb->where('roster_group_id',$id);
		 }else{
		  $this->tenantDb->where('emp_id',$id);
		  $this->tenantDb->where('roster_status',1);
		}
		if($dash != '')
        {
         $this->tenantDb->limit(5);
         }		
		$this->tenantDb->order_by('start_date',"DESC");
	
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
			$this->get_roster_weeks($id,$type='',$dash,$i);
		}else{
		   
			return $query->result();
		}
	}
	
		public function get_roster_weekss($id,$type='',$dash='',$limit='', $start='',$i=null){
	    
       $this->tenantDb->limit($limit, $start);
    //   $this->tenantDb->group_by("roster_group_id");
		$this->tenantDb->select('*');
// 		
		$this->tenantDb->from('HR_roster');
		$this->tenantDb->group_by("roster_group_id");
		if($type == 'admin'){
		 $this->tenantDb->where('branch_id',$id);   
		}
	
		$this->tenantDb->order_by('start_date',"DESC");
	
		$query = $this->tenantDb->get();
	return $query->result();
	}
	
		public function get_dashboard_roster($id,$type='',$dash=''){
	    
		
		$this->tenantDb->select('DISTINCT(roster_group_id),roster_id, start_date,end_date,roster_name');
       $this->tenantDb->group_by('roster_group_id'); 
	
		$query = $this->tenantDb->get('HR_roster');
		if($dash != '')
       {
         $this->tenantDb->limit(4);
      }		
        
		$this->tenantDb->order_by('start_date',"DESC");
	
		
		
	return $query->result();
	}
	
	public function get_total($table_name,$id,$type) 
    {
        if($type == 'employee'){
             $this->tenantDb->where('emp_id',$id); 
		   
		}else{
		   $this->tenantDb->where('branch_id',$id); 
		}
        $this->tenantDb->from($table_name);
        return $this->tenantDb->count_all_results();      
       
    }
	
	function get_emp_details_fieldwise($emp_id,$fieldname='rate',$find_byemail=''){
	    
	    $this->tenantDb->select($fieldname);
        
		$this->tenantDb->from('HR_employee as employee');
		$this->tenantDb->where('status',1);
		if($find_byemail == ''){
		    $this->tenantDb->where('emp_id',$emp_id);
		}else{
		    // here emp_id has email id not emp id
		    $this->tenantDb->where('email',$emp_id);
		}
		
		
		
		$query = $this->tenantDb->get();
	
     if(isset($query->result()[0]->$fieldname) && !empty($query->result()[0]->$fieldname)){
           return $query->result()[0]->$fieldname;
       }else{
           
           return '';
       }
	
		
	}	
	
	function get_outlet_details_fieldwise($outlet_id){
	    
	    $this->tenantDb->select('outlet_name');
        
		$this->tenantDb->from('HR_outlet');
		$this->tenantDb->where('status',1);
		$this->tenantDb->where('outlet_id',$outlet_id);
		
		
		
		$query = $this->tenantDb->get();
	
     if(isset($query->result()[0]->outlet_name) && !empty($query->result()[0]->outlet_name)){
           return $query->result()[0]->outlet_name;
       }else{
           
           return '';
       }
	
		
	}
	
	
		function get_emp_details_fromemail($empemail_id){
	    
	    $this->tenantDb->select('emp_id');
        
		$this->tenantDb->from('HR_employee as employee');
		
		$this->tenantDb->where('email',$empemail_id);
		
		
		$query = $this->tenantDb->get();
	
     if(isset($query->result()[0]->emp_id) && !empty($query->result()[0]->emp_id)){
           return $query->result()[0]->emp_id;
       }else{
           
           return '';
       }
	
		
	}
		function week_hour_worked_price($rate,$roster_id,$emp_id){
		    
		   
		    
         $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , mon_start_time, mon_end_time ) * ( '.$rate.' / 60 ) as mon');
         $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , tues_start_time, tues_end_time ) * ( '.$rate.' / 60 ) as tues');
          $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , wed_start_time, wed_end_time ) * ( '.$rate.' / 60 ) as wed');
          $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , thus_start_time, thus_end_time ) * ( '.$rate.' / 60 ) as thus');
            $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , fri_start_time, fri_end_time ) * ( '.$rate.' / 60 ) as fri'); 
            $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , sat_start_time, sat_end_time ) * ( '.$rate.' / 60 ) as sat');
            $this->tenantDb->select('TIMESTAMPDIFF( MINUTE , sun_start_time, sun_end_time ) * ( '.$rate.' / 60 ) as sun');
		$this->tenantDb->from('HR_roster');
		
		$this->tenantDb->where('roster_id',$roster_id);
		$this->tenantDb->where('emp_id',$emp_id);
		$query = $this->tenantDb->get();
		
	return $query->result();
		

		
 
	
		
	}
	
		function week_hour_break($roster_id,$emp_id){
		    
         $this->tenantDb->select('sum(mon_break_time + tues_break_time + wed_break_time +	thus_break_time + fri_break_time + sat_break_time + sun_break_time) as total_break');
        
		$this->tenantDb->from('HR_roster');
		
		$this->tenantDb->where('roster_id',$roster_id);
		$this->tenantDb->where('emp_id',$emp_id);
		$query = $this->tenantDb->get();
	
       if(isset($query->result()[0]->total_break) && !empty($query->result()[0]->total_break)){
           return $query->result()[0]->total_break;
       }else{
           
           return '';
       }
				
	}
	
	function roster_filter($start_date,$end_date,$branch_id,$roster_name,$type,$i=null){
	    
	     $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		if($type=='employee'){
		   $this->tenantDb->where('emp_id',$branch_id);
		}else{
		  $this->tenantDb->where('branch_id',$branch_id);
		}
	
	
		
		
		if(isset($start_date) && $start_date !='unset'){
		    $myinput=$start_date; $start_date=date('Y-m-d',strtotime($myinput)); 
		    $this->tenantDb->where('start_date >=',$start_date);
		    
		}
		if(isset($end_date) && $end_date !='unset'){
		     $myinput=$end_date; $end_date=date('Y-m-d',strtotime($myinput)); 
		    $this->tenantDb->where('end_date <=',$end_date);
		    
		}

		
		if(isset($roster_name) && $roster_name !='unset'){
		     
		    $this->tenantDb->where('roster_name',$roster_name);
		    
		}
		$this->tenantDb->group_by("roster_group_id");
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
			$this->roster_filter($start_date,$end_date,$roster_name,$branch_id,$i);
		}else{
			return $query->result();
			
		}		
	}
	
	
		function roster_filter_for_report($start_date,$end_date,$branch_id){
	    
	     $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		$this->tenantDb->where('branch_id',$branch_id);
	
	   if(isset($start_date) && $start_date !=''){
		    $myinput=$start_date; 
		    $start_date=date('Y-m-d',strtotime($myinput));
		   
		    $this->tenantDb->where('start_date =',$start_date);
		    
		}
		if(isset($end_date) && $end_date !=''){
		     $myinput2=$end_date; 
		     
		     $end_date=date('Y-m-d',strtotime($myinput2)); 
		   
		    $this->tenantDb->where('end_date =',$end_date);
		    
		}
    //   $this->tenantDb->group_by("roster_group_id");
   
		$query = $this->tenantDb->get();
		
			return $query->result();		
	}
	function fetch_reports($i=null){ 
	     $branch_id = $this->session->userdata('branch_id');
        $this->tenantDb->select('*');
		$this->tenantDb->from('reports');
	    $this->tenantDb->where('branch_id',$branch_id);
	    $this->tenantDb->order_by('report_id','DESC');
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
			$this->fetch_reports($i);
		}else{
			return $query->result();
		}		
	}
		function report_filter($start_date,$end_date, $i=null){ 
		    
	     $branch_id = $this->session->userdata('branch_id');
	     
        $this->tenantDb->select('*');
		$this->tenantDb->from('reports');
	
	    $this->tenantDb->where('branch_id',$branch_id);
	    
	    if(isset($start_date) && $start_date !=''){
		    $myinput=$start_date; 
		    $start_date=date('Y-m-d',strtotime($myinput));
		   
		    //$this->tenantDb->where('start_date =',$start_date);
		    
		}
		if(isset($end_date) && $end_date !=''){
		     $myinput2=$end_date; 
		     
		     $end_date=date('Y-m-d',strtotime($myinput2)); 
		   
		  // $this->tenantDb->where('end_date =',$end_date);
		    
		}
           $condition = "start_date BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'"." or end_date BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
            
	        $this->tenantDb->where($condition);
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
			$this->fetch_reports($i);
		}else{
			return $query->result();
		}		
	}
	function view_details_reports($report_id='',$i=null){ 
	     
        $this->tenantDb->select('*');
		$this->tenantDb->from('reports');
		if(isset($report_id) && $report_id !=''){
		 $this->tenantDb->where('report_id',$report_id);   
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
			$this->fetch_reports($i);
		}else{
		  
			return (array)$query->result();
		}		
	}
	function emp_roster($date,$branch_id='',$i=null){
         $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		$this->tenantDb->where('start_date',$date);
		if(isset($branch_id) && $branch_id !=''){
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
			$this->emp_roster($date,$branch_id,$i);
		}else{
			return $query->result();
		}
		
	}
	function fetch_rosterfrom_roster_id($roster_id='',$i=null){
         $this->tenantDb->select('*');
		$this->tenantDb->from('HR_roster');
		$this->tenantDb->where('roster_id',$roster_id);
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
			$this->fetch_rosterfrom_roster_id($roster_id,$i);
		}else{
			return $query->result();
		}
		
	}
	
		public function get_employeesbyrole($role_id,$i=null){
		$this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee as employee');
		$branch_id = $this->session->userdata('branch_id');
		 $this->tenantDb->where('branch_id',$branch_id);
		$this->tenantDb->where('status',1);
		
     	if($role_id !='all'){
	     $this->tenantDb->where('role',$role_id);
	    }
		$this->tenantDb->order_by('first_name','ASC');
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
			$this->get_employeesbyrole($role_id,$i);
		}else{
			return $query->result();
		}
	}
	public function fetch_emp_role($emp_id,$emp_rate_check,$i=null){
	    
	    $branch_id = $this->session->userdata('branch_id');
	    if($emp_rate_check == 1){
	        $this->tenantDb->select('employee.role,employee.first_name,employee.last_name,employee.rate,employee.Saturday_rate,employee.Sunday_rate,employee.holiday_rate,role.role_name');
	    }else{
	        $this->tenantDb->select('employee.role,employee.first_name,employee.last_name,role.role_name');
	    }
		
		$this->tenantDb->from('HR_employee as employee');
		$this->tenantDb->join('role', 'employee.role = role.role_id ','left');
		$this->tenantDb->where('employee.branch_id',$branch_id);
		$this->tenantDb->where('employee.status',1);
	    $this->tenantDb->where('employee.emp_id',$emp_id);
	 
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
			$this->get_employeesbyrole($role_id,$i);
		}else{
			return $query->result();
		}
	}	
	public function check_emp_rates_for_roster($user_id,$i=null){
	    
	    $this->tenantDb->select('show_emp_rates_in_roster');
		$this->tenantDb->from('customer_users');
	    $this->tenantDb->where('customer_user_id',$user_id);
	 
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
			$this->check_emp_rates_for_roster($user_id,$i);
		}else{
			return $query->result();
		}
	}
	function save_survey($data){
		 return $this->tenantDb->insert('emp_survey',$data);
	}
	function get_survey($id){
		 $this->tenantDb->select('*');
		$this->tenantDb->from('emp_survey');
		$this->tenantDb->where('emp_id',$id);
		$query = $this->tenantDb->get();
		return $query->result();
	}
	function get_all_survey($branch_id){
		 $this->tenantDb->select('*');
		$this->tenantDb->from('emp_survey');
		
		$this->tenantDb->join('HR_employee as employee', 'emp_survey.emp_id = employee.emp_id ','left');
		$this->tenantDb->where('emp_survey.branch_id',$branch_id);
		$query = $this->tenantDb->get();
	
// 		echo $this->tenantDb->last_query();exit;
		return $query->result();
		 	
	}
	function email_view_update($id,$updateData){
	    
		 $this->tenantDb->where('emp_id',$id);
		 return $this->tenantDb->update('HR_employee as employee',$updateData);
	}
}