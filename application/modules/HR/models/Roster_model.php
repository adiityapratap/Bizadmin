<?php
class Roster_model extends CI_Model{
	
	function __construct() {
	parent::__construct();
	$this->location_id = $this->session->userdata('location_id');
	}
	
	function fetchAllPrepArea(){
      $query = $this->tenantDb->query("SELECT tp.*,ts.site_name from HR_prepArea tp  left join HR_sites ts on tp.site_id = ts.id   where tp.is_deleted = 0 AND  tp.location_id = ".$this->location_id." order by tp.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result_array();
        } else {
         return $res = array();
        }
  }
  
   function fetchEmployeeTodaysRoster(){
       $this->tenantDb->select('rd.*');
$this->tenantDb->from('HR_roster r');
$this->tenantDb->join('HR_roster_details rd', 'r.roster_id = rd.roster_id', 'left');
$this->tenantDb->where('r.location_id', 13);
$this->tenantDb->where('r.is_published', 1);
$this->tenantDb->where('r.is_deleted', 0);
$this->tenantDb->where('r.status', 1);
$this->tenantDb->where('CURDATE() BETWEEN r.start_date AND r.end_date');
$query = $this->tenantDb->get();
return $result = $query->result();
   }
	
}

?>