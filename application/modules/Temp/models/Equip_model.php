<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Equip_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}

	   public function add_equip($data){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert('TEMP_eqipment',$data);
		}
		
		public function fetchEquipList($id=''){
		 $sql = (isset($id) && $id !='' ? 'e.id='.$id.' AND ' : '');   
	    $query = $this->tenantDb->query("SELECT e.*,p.prep_name,s.site_name from TEMP_eqipment e left join TEMP_prepArea p on e.prep_id = p.id  left join TEMP_sites s on p.site_id = s.id where ".$sql."  e.is_deleted = 0 AND  e.location_id = ".$this->selected_location_id." order by e.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result();
        } else {
         return $res = array();
        }
	}	
		
		
}
	
?>