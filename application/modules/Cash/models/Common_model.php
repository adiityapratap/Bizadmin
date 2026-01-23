<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{
	function __construct() {
		parent::__construct();
      	}  
    
    public function getTillNameByID($tillId){
		  
	       $query = $this->tenantDb->select('till_name')
                     ->where('id', $tillId)
                     ->get('CASH_ci_tills');
                      if ($query === false) {
                         return $tills =  array();
                       } else {
                       $tills = $query->result_array();
                       }
                    
                     return (isset($tills[0]['till_name']) ? $tills[0]['till_name'] : '');
		}
		
		
}
?>