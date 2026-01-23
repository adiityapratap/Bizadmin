<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	
	}
	
	public function fetchRecordsDynamically($table, $fields = array(), $conditions = array()) {
        if (!empty($fields)) {
            $this->tenantDb->select(implode(',', $fields));
        } else {
            $this->tenantDb->select('*');
        }
        $this->tenantDb->from($table);
        if (!empty($conditions)) {
            $this->tenantDb->where($conditions);
        }

        $query = $this->tenantDb->get();
     // echo $lastQuery = $this->tenantDb->last_query(); exit;
        // Return the result
        return ($query ? $query->result_array() : '');
    }
    
   function commonRecordUpdate($table,$fieldname='',$id,$data){
      $this->tenantDb->where($fieldname, $id);
      $this->tenantDb->update($table, $data);  
      
    }
    
     function commonRecordCreate($table,$data){
      $this->tenantDb->insert($table, $data);
      return  $this->tenantDb->insert_id();
    }
    
    public function commonRecordUpdateMultipleConditions($tableName,$fields, $data) {
      if(isset($fields)){
       foreach($fields as $fieldName =>$fieldValue){
        $this->tenantDb->where($fieldName, $fieldValue);   
       } 
      $this->tenantDb->update($tableName,$data); 
      }else{
      return true;    
      }    
    }
    

}
?>