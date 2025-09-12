<?php
class Employee_model extends CI_Model{
	
	function __construct() {
	parent::__construct();
	$this->location_id = $this->session->userdata('location_id');
	}
	
	function onboardNewEmployee($data){
	 $this->tenantDb->insert('HR_employee',$data);
     $insert_id = $this->tenantDb->insert_id();  
		return $insert_id;
	}
	
	function allocateLocationToEmployee($data){
	  $this->tenantDb->insert('HR_empIdToLocationId',$data);
	  return true;  
	}
	// if u will pass "$seprateRowsForPositions" true, than it will return seprate rows/indexes for seprate roles per employee i.e Employee A is manager 
	// and Chef , than it will return two index in array one for chef and one for Manager role
 function employeeList($is_deleted = 0,$employeeType='',$separateRowsForPositions = false) {
    
   $selectFields = ['DISTINCT CONCAT_WS(" ", e.first_name, e.last_name) as name','e.company_name', 'e.userId', 'e.created_at', 'e.emp_id', 'e.email', 'e.phone', 'e.status', 'e.stress_profile'];

    if ($separateRowsForPositions) {
        $selectFields[] = 'ep.position_id';
    }

    // Convert select fields array to string
    $selectFieldsString = implode(', ', $selectFields);

    $this->tenantDb->select($selectFieldsString);
    $this->tenantDb->from('HR_employee e');
    $this->tenantDb->join('HR_empIdToLocationId el', 'e.emp_id = el.empId', 'LEFT');

    if ($separateRowsForPositions) {
        $this->tenantDb->join('HR_emp_to_position ep', 'e.emp_id = ep.emp_id', 'LEFT');
    }
    
    $this->tenantDb->where('e.is_deleted', $is_deleted ? 1: 0);

    if ($employeeType != '') {
        // 0 =  employeee 1= contractor
        $this->tenantDb->where('e.is_contractor', $employeeType);
    }

    if (!empty($this->location_id)) {
        $this->tenantDb->where('el.location_id', $this->location_id);
    } else {
        return [];
    }
    // Execute the query
    $query = $this->tenantDb->get();
    // echo $this->tenantDb->last_query(); exit;
    // echo "<pre>"; print_r($query->result_array()); exit;
    return $query->result_array();
}

	
	function employeeDetails($emp_id) {
    // Initialize the table names
    $tables = ['HR_employee' => 'e', 'HR_empIdToLocationId' => 'el', 'HR_emp_to_position' => 'ep'];

    // Initialize the select fields array
    $selectFields = [];

    // Fetch the column names dynamically and build the select fields array
    foreach ($tables as $table => $alias) {
        // Query to get column names
        $query = $this->tenantDb->query("SHOW COLUMNS FROM $table");
        $columns = $query->result_array();

        // Add columns to select fields, excluding 'emp_id' for non-primary tables
        foreach ($columns as $column) {
            if ($column['Field'] != 'emp_id' || $alias == 'e') {
                $selectFields[] = "$alias." . $column['Field'] . " as " . $column['Field'];
            }
        }
    }

    // Convert select fields array to string
    $selectFieldsString = implode(', ', $selectFields);

    // Select the fields
    $this->tenantDb->select($selectFieldsString);
    $this->tenantDb->from('HR_employee e');
    $this->tenantDb->join('HR_empIdToLocationId el', 'e.emp_id = el.empId', 'LEFT');
    $this->tenantDb->join('HR_emp_to_position ep', 'e.emp_id = ep.emp_id', 'LEFT');
    $this->tenantDb->where('e.emp_id', $emp_id);
    // $this->tenantDb->where('el.location_id', $this->location_id);

    // Execute the query
    $query = $this->tenantDb->get();
    $results = $query->result_array();

    // Merge rows if multiple positions are found
    $mergedResult = [];
    foreach ($results as $row) {
        foreach ($row as $key => $value) {
            if (!isset($mergedResult[$key]) || $value !== null) {
                $mergedResult[$key] = $value;
            }
        }
    }

    // Remove the unwanted 'emp_id' keys from non-primary tables
    unset($mergedResult['el_empId'], $mergedResult['ep_empId']);
// echo $this->tenantDb->last_query(); exit;
    // Return the merged result as an array with a single index
    return [$mergedResult];
}


	
	function fetchLeaveRequestsRecord($empId,$type='past'){
	    
	  $this->tenantDb->select('hlm.id, hlm.emp_id, hlm.start_date, hlm.end_date, hlm.leaveComments, hl.leaveTypeName, hl.leaveTypeName, hlm.leave_status, hlm.medical_certificate');
      $this->tenantDb->from('HR_leave_management hlm');
      $this->tenantDb->join('HR_leaves hl', 'hl.id = hlm.leave_type', 'LEFT');
      $this->tenantDb->where('hlm.emp_id', $empId);
      $this->tenantDb->where('hlm.leave_status !=', 0);
      if($type == 'past') {
      $this->tenantDb->where('hlm.start_date <', date('Y-m-d'));  
      } else {
      $this->tenantDb->where('hlm.start_date >=', date('Y-m-d'));  
     }

      $query = $this->tenantDb->get();
      $result = $query->result_array();

      return $result;

	}
	
	function fetchCountOfLeaves(){
	    $query = $this->tenantDb->select('hl.leaveTypeName,hl.id, COUNT(hlm.leave_type) as count')
                        ->from('HR_leaves hl')
                        ->join('HR_leave_management hlm', 'hl.id = hlm.leave_type', 'left')
                        ->where('hlm.leave_status !=', 0)
                        ->where('location_id', $this->location_id)
                        ->group_by('hlm.leave_type')
                        ->get();

      $result = $query->result_array();

      return $result;
	}
	

	
	
		// contractors methods starts here
	
	
		function contractorList($status=1,$isDeleted=0){
	    // we are storing employee and contractor in same table now, differntiated by is_contractor col = 1
	$this->tenantDb->select('CONCAT_WS(" ",e.first_name, e.last_name) as name,e.userId,e.created_at, e.emp_id,e.email, e.phone, e.status,e.stress_profile,e.company_name');
      $this->tenantDb->from('HR_employee e');
      $this->tenantDb->join('HR_empIdToLocationId el', 'e.emp_id = el.empId', 'LEFT');
      $this->tenantDb->where('e.status', $status);
      $this->tenantDb->where('e.is_deleted', $isDeleted);
      $this->tenantDb->where('el.location_id', $this->location_id);
      $this->tenantDb->where('e.is_contractor', 1);
      $query = $this->tenantDb->get();
      return $query->result_array();
	}
	
	function addUpdateContractor($data){
	    $insert_data = [];
       $update_data = [];
       foreach ($data as $column => $value) {
        $insert_data[$column] = $value;
        $update_data[] = "$column = VALUES($column)";
        }

       $insert_query = $this->tenantDb->set($insert_data)->get_compiled_insert('HR_employee');
        $update_query = implode(', ', $update_data);
        $sql = "$insert_query ON DUPLICATE KEY UPDATE $update_query";
        $this->tenantDb->query($sql);
        return  $this->tenantDb->insert_id();
	}
}
	
	?>