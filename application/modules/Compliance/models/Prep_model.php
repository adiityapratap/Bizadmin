<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prep_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}

	   public function add_site($data){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert('Compliance_prepArea',$data);
		}

     function change_status($data){
     $Newdata = array(
		'status' => $data['status'],
		'updated_date'=> date("Y-m-d")
		 );
	$this->tenantDb->set($Newdata);
	$this->tenantDb->where('id',$data['id']);
	$this->tenantDb->update('Compliance_prepArea');
return true;
} 
  function fetchAllPrepArea($prepTableName, $siteTableName)
{
    // Validate table names (avoid SQL injection)
    $prepTable   = $this->tenantDb->escape_str($prepTableName);
    $siteTable   = $this->tenantDb->escape_str($siteTableName);
    $location_id = (int) $this->selected_location_id;

    $sql = "SELECT tp.*, ts.site_name  FROM {$prepTable} AS tp LEFT JOIN {$siteTable} AS ts  ON tp.site_id = ts.id WHERE tp.is_deleted = 0 AND tp.status = 1 AND tp.location_id = ? ORDER BY tp.sort_order ASC";
     
    $query = $this->tenantDb->query($sql, [$location_id]);

    return ($query) ? $query->result_array() : [];
}

       function deletesite($id){	
     	$data = array(
		'is_deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
		 
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update('Compliance_prepArea');
return true;
} 
		


        public function updatePrep($data,$id){
		
// print_r($data); exit;
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update('Compliance_prepArea');
return true;
		}
}