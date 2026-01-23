<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->selected_location_id = $this->session->userdata('location_id');
    }

    public function add_task($data) {
        return $this->tenantDb->insert('Shifts_task', $data);
    }

    public function fetchTaskList($id = '') {
    // Get role ID of logged-in user
    $role_id = get_logged_in_user_role($this->ion_auth, 'id');

    if (!$role_id) {
        return []; // Return empty if no role found or not logged in
    }

    // Base WHERE condition
    $where = [];

    if ($id != '') {
        $where[] = 'st.id = ' . (int)$id;
    }

    $where[] = 'st.is_deleted = 0';
    $where[] = 'st.location_id = ' . (int)$this->selected_location_id;

    // Only apply role filter if not admin (role_id = 1)
    if ($role_id != 1) {
        $where[] = 'str.role_id = ' . (int)$role_id;
    }

    $where_sql = implode(' AND ', $where);

    // Final Query
    $sql = "
        SELECT Distinct st.*, p.name, sl.name AS shift_name
        FROM Shifts_task st
        INNER JOIN Shift_task_roles str ON str.task_id = st.id
        LEFT JOIN Shifts_prep p ON st.prep_id = p.id
        LEFT JOIN Shifts_shiftlist sl ON sl.id = st.shift_id
        WHERE $where_sql
        ORDER BY st.sort_order ASC
    ";
// echo $sql; exit;
    // Run the query
    $query = $this->tenantDb->query($sql);

    return ($query !== false) ? $query->result() : [];
}



    public function get_allTaskForDash() {
        $query = $this->tenantDb->query(
            "SELECT e.*, p.name 
             FROM Shifts_task e 
             LEFT JOIN Shifts_prep p ON e.id = p.id 
             WHERE e.is_deleted = 0 AND  e.status = 1
             AND e.location_id = " . (int)$this->selected_location_id . " 
             ORDER BY e.sort_order ASC"
        );

        return ($query !== false) ? $query->result_array() : [];
    }

    public function getScheduledTasks() {
        $currentDayOfWeek = date('w');
        $currentDayOfMonth = date('d');
        $currentWeekNumber = ceil($currentDayOfMonth / 7);
        $currentMonth = date('m');
        $currentYear = date('Y');
        $currentDayName = date('l');

        $this->tenantDb->select('Ct.*, p.name');
        $this->tenantDb->from('Shifts_task as Ct');
        $this->tenantDb->join('Shifts_prep as p', 'p.id = Ct.id', 'left');

        $this->tenantDb->group_start();

        $this->tenantDb->or_where("(Ct.schedule_at = 2 AND Ct.schedule_type = 'day' AND Ct.schedule_dayName = '$currentDayName' AND Ct.repeatWhichWeek = $currentWeekNumber AND MONTH(Ct.schedule_date) = $currentMonth AND YEAR(Ct.schedule_date) = $currentYear)");

        $this->tenantDb->or_where("(Ct.schedule_at = 1 AND Ct.schedule_type = 'date' AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(DAY, Ct.schedule_date, NOW()) % 7 = 0)");

        $this->tenantDb->or_where("(Ct.schedule_at = 2 AND Ct.schedule_type = 'date' AND Ct.schedule_date <= NOW() AND DAY(Ct.schedule_date) = DAY(NOW()))");

        $this->tenantDb->or_where("(Ct.schedule_at = 3 AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(MONTH, Ct.schedule_date, NOW()) % 3 = 0)");

        $this->tenantDb->or_where("(Ct.schedule_at = 4 AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(MONTH, Ct.schedule_date, NOW()) % 4 = 0)");

        $this->tenantDb->or_where("(Ct.schedule_at = 5 AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(MONTH, Ct.schedule_date, NOW()) % 6 = 0)");

        $this->tenantDb->or_where("(Ct.schedule_at = 0)");

        $this->tenantDb->where('Ct.is_deleted', 0);
        $this->tenantDb->where('Ct.location_id', $this->selected_location_id);

        $this->tenantDb->group_end();

        $query = $this->tenantDb->get();
        return $query->result_array();
    }
    
    	public function fetchTodaysEnteredData(){
		  $this->tenantDb->select('Shifts_record_History.*');
          $this->tenantDb->from('Shifts_record_History');
          $this->tenantDb->where('Shifts_record_History.date_entered', date('Y-m-d'));
          $this->tenantDb->where('Shifts_record_History.is_completed', 1);
          $this->tenantDb->where('Shifts_record_History.location_id', $this->selected_location_id);
          $query = $this->tenantDb->get();
          
          $newArray = array();
          if(!empty($query->result_array())){
           foreach ($query->result_array() as $item) {
           $taskId = $item['task_id'];
            $newArray[$taskId] = $item;
          }  
          }
            return $newArray;

		}
}
?>
