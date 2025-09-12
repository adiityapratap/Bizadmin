<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}

	   public function add_task($data){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert('CLEAN_tasks',$data);
		}
		
		public function fetchTaskList($id=''){
		 $sql = (isset($id) && $id !='' ? 'e.id='.$id.' AND ' : '');   
	    $query = $this->tenantDb->query("SELECT e.*,p.prep_name,s.site_name from CLEAN_tasks e left join CLEAN_prepArea p on e.prep_id = p.id  left join CLEAN_sites s on p.site_id = s.id where ".$sql."  e.is_deleted = 0 AND  e.location_id = ".$this->selected_location_id." order by e.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result();
        } else {
         return $res = array();
        }
	}
	
	function get_allTaskForDash(){
	 $sql = '';     
	 $query = $this->tenantDb->query("SELECT e.*,p.prep_name,s.site_name from CLEAN_tasks e left join CLEAN_prepArea p on e.prep_id = p.id  left join CLEAN_sites s on p.site_id = s.id where ".$sql."  e.is_deleted = 0 AND  e.location_id = ".$this->selected_location_id." order by e.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result_array();
        } else {
         return $res = array();
        }   
	}
	
	public function getScheduledTasks() {
        // Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        $currentDayOfWeek = date('w');

        // Get the current day of the month
        $currentDayOfMonth = date('d');

        // Calculate the week number (1-4) based on the current date
        $currentWeekNumber = ceil($currentDayOfMonth / 7);

        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Get the current day name (e.g., 'Monday', 'Tuesday', ...)
        $currentDayName = date('l');
// echo $currentYear; exit;
        // Construct conditions for fetching tasks dynamically
        $this->tenantDb->select('Ct.*,p.prep_name,s.site_name');
        $this->tenantDb->from('CLEAN_tasks as Ct');
        $this->tenantDb->join('CLEAN_prepArea as p', 'p.id = Ct.prep_id', 'left');
        $this->tenantDb->join('CLEAN_sites as s', 's.id = p.site_id', 'left');
        $this->tenantDb->where('Ct.is_deleted', 0);
        $this->tenantDb->where('Ct.status', 1);
        $this->tenantDb->where('Ct.location_id', $this->selected_location_id);
        $this->tenantDb->group_start();

        // Check for dynamic day
        $this->tenantDb->or_where("(Ct.schedule_at = 2 AND Ct.schedule_type = 'day' AND Ct.schedule_dayName = '$currentDayName' AND Ct.repeatWhichWeek = $currentWeekNumber AND Ct.schedule_date <= NOW())");

        // Check for weekly date-based schedule
        $this->tenantDb->or_where("(Ct.schedule_at = 1  AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(DAY, Ct.schedule_date, NOW()) % 7 = 0)");

        // Check for monthly date-based schedule
        $this->tenantDb->or_where("(Ct.schedule_at = 2 AND Ct.schedule_type = 'date' AND Ct.schedule_date <= NOW() AND DAY(Ct.schedule_date) = DAY(NOW()))");
        
        // Check for quarterly schedule
        $this->tenantDb->or_where("(Ct.schedule_at = 3  AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(MONTH, Ct.schedule_date, NOW()) % 3 = 0)");
        
         // Check for every 4 months schedule
        $this->tenantDb->or_where("(Ct.schedule_at = 4  AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(MONTH, Ct.schedule_date, NOW()) % 4 = 0)");

        // Check for semi-annual schedule
        $this->tenantDb->or_where("(Ct.schedule_at = 5  AND Ct.schedule_date <= NOW() AND TIMESTAMPDIFF(MONTH, Ct.schedule_date, NOW()) % 6 = 0)");

        // Check for daily schedule
        $this->tenantDb->or_where("(Ct.schedule_at = 0)");
        
       
        $this->tenantDb->group_end();

        // Execute the query
        $query = $this->tenantDb->get();

        // Return the results
        return $query->result_array();
    }
		
		
}
	
?>