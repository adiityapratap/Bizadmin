<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prep_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}

	   public function add_site($data){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert('TEMP_fryerPrepArea',$data);
		}

     function change_status($data){
     $Newdata = array(
		'status' => $data['status'],
		'updated_date'=> date("Y-m-d")
		 );
	$this->tenantDb->set($Newdata);
	$this->tenantDb->where('id',$data['id']);
	$this->tenantDb->update('TEMP_fryerPrepArea');
    return true;
      } 
      	public function get_allActive_sites(){
		 
           $sites = $this->tenantDb->select('*')
               ->where('is_deleted', 0)
               ->where('status', 1)
               ->where('location_id', $this->selected_location_id)
               ->order_by('created_at', 'asc')
               ->get('TEMP_fryerSites') 
               ->result_array();

              return $sites;

		}
		
  function fetchAllPrepArea(){
      $query = $this->tenantDb->query("SELECT tp.*,ts.site_name from TEMP_fryerPrepArea tp  left join TEMP_fryerSites ts on tp.site_id = ts.id   where tp.is_deleted = 0 AND  tp.location_id = ".$this->selected_location_id." order by tp.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result_array();
        } else {
         return $res = array();
        }
  }
       function deletesite($id){	
     	$data = array(
		'is_deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
		 
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update('TEMP_fryerPrepArea');
return true;
} 
		


        public function updatePrep($data,$id){
		
// print_r($data); exit;
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update('TEMP_fryerPrepArea');
return true;
		}
}