<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
      public function fetchArea($branch_id,$id=''){
        
	   $query = "SELECT * FROM `SUPPLIERS_areaList` WHERE status != 0 AND is_deleted = 0 and location_id=".$this->location_id;
  
	  if($id !=''){
	    $query .= " AND id = ".$id;
	  }
	  
	  $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
	  
      }
      
      public function fetchAreaWithSuppId($branch_id){
         
	   $query = "SELECT sa.name,sa.id FROM `SUPPLIERS_areaList` sa  WHERE sa.status != 0 AND sa.is_deleted = 0  and sa.location_id=".$this->location_id;
  
	 
	  
	  $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
	  
      }
      
      	public function updateArea($id = '', $data) {
    $this->tenantDb->set('name', $data['name']);
    $this->tenantDb->set('supplier_ids', serialize($data['supplier_ids']));
    $this->tenantDb->set('status', '1');
    $this->tenantDb->where('id', $id);
    $this->tenantDb->update('SUPPLIERS_areaList');
    
    $this->tenantDb->where('area_id', $id);
     $this->tenantDb->delete('SUPPLIERS_areaId_to_supplierId');
     
     foreach($data['supplier_ids'] as $sids){
       $insertData = array(
        'supplier_id' => $sids,
        'area_id' => $id,
    );
    $this->tenantDb->insert('SUPPLIERS_areaId_to_supplierId', $insertData);   
     }
    

    }

     public function addArea($location_id, $data) {
    $insertData = array(
        'name' => $data['name'],
        'supplier_ids' => serialize($data['supplier_ids']),
        'status' => '1',
        'location_id' => $location_id,
        'created_at' => date('Y-m-d')
    );
    $this->tenantDb->insert('SUPPLIERS_areaList', $insertData);
    $last_inserted_areaId = $this->tenantDb->insert_id();
    
     foreach($data['supplier_ids'] as $sids){
       $insertData = array(
        'supplier_id' => $sids,
        'area_id' => $last_inserted_areaId,
    );
    $this->tenantDb->insert('SUPPLIERS_areaId_to_supplierId', $insertData);   
     }
}

	public function AreaStatus($id, $data) {
    if (isset($data['is_deleted']) && $data['is_deleted'] == 1) {
        $this->tenantDb->set('is_deleted', '1');
    } else {
        $this->tenantDb->set('status', $data['status']);
    }
    $this->tenantDb->where('id', $id);
    $this->tenantDb->update('SUPPLIERS_areaList');
   }
}