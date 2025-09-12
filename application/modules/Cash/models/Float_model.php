<?php

class Float_model extends CI_Model{
	
    function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
   

	  public function addFloat($data){
		    $builder = $this->tenantDb;
			 return  $builder->insert('CASH_ci_floats',$data);
			 //echo $query = $this->tenantDb->last_query(); exit;
		}
		
		// Float front office Build Queries Start ==========================================
		
		public function addFloatBuild($data){
		    $builder = $this->tenantDb;
			   $builder->insert('CASH_ci_frontOfficeBuild',$data);
			  return $lastInsertedId = $builder->insert_id();
			 
			 
		}
        function frontOfficeBuildUpdate($data,$id){	
         $builder = $this->tenantDb;		 
         $builder->set($data);
         $builder->where('id', $id);
         $builder->update('CASH_ci_frontOfficeBuild');
         return true;
        } 	
		 public function get_all_frontOfficeBuild(){
		     
		    $builder = $this->tenantDb;
	       $query = $builder->select('*')
                     ->where('deleted', 0)
                       ->where('status', 1)
                        ->where('location_id', $this->selected_location_id)
                     ->order_by("created_date", "desc")
                     ->get('CASH_ci_frontOfficeBuild');
                     if ($query === false) {
                         return  $frontOfficeBuild =  array();
                       } else {
                       $frontOfficeBuild = $query->result_array();
                       }
                     return $frontOfficeBuild;
		}
		 public function getFrontOfficeBuildByID($id){
	
		    $builder = $this->tenantDb;
	       $query = $builder->select('*')
                     ->where('id',$id)
                     ->where('location_id', $this->selected_location_id)
                      ->get('CASH_ci_frontOfficeBuild');
                     if ($query === false) {
                          return $FrontOfficeBuild =  array();
                       } else {
                       $FrontOfficeBuild = $query->result_array();
                       }
                     return $FrontOfficeBuild[0];
		}
	   function DeletefrontOfficeBuild($id){	
     	$data = array(
		'deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
 $builder = $this->tenantDb;		 
 $builder->set($data);
 $builder->where('id', $id);
 $builder->update('CASH_ci_frontOfficeBuild');
//  echo $queryyyy = $this->tenantDb->getLastQuery(); exit;
return true;
} 	
		
		//=============== front office floadbuild END ========
		
		// office build start =======================================================================
		
		public function addOfficeBuild($data){
		   
		    $builder = $this->tenantDb;
			   $builder->insert('CASH_ci_officeBuild',$data);
			  return $lastInsertedId = $builder->insert_id();
			 
		}
        function officeBuildUpdate($data,$id){	
 
         $builder = $this->tenantDb;		 
         $builder->set($data);
         $builder->where('id', $id);
         $builder->update('CASH_ci_officeBuild');
        //  echo $queryyyy = $builder->getLastQuery(); exit;
         return true;
} 	
		 public function get_all_officeBuild(){
		    $builder = $this->tenantDb;
		    
	       $query = $builder->select('*')
                     ->where('CASH_ci_officeBuild.deleted', 0)
                       ->where('CASH_ci_officeBuild.status', 1)
                       ->where('location_id', $this->selected_location_id)
                     ->order_by("created_date", "desc")
                     ->get('CASH_ci_officeBuild');
                    if ($query === false) {
                         return  $officeBuild =  array();
                       } else {
                       $officeBuild = $query->result_array();
                       }
                     return $officeBuild;
		}
		 public function getOfficeBuildByID($id){
	
		    $builder = $this->tenantDb;
	         $query = $builder->select('*')
                     ->where('id',$id)
                      ->get('CASH_ci_officeBuild');
                       if ($query === false) {
                          return $FrontOfficeBuild =  array();
                       } else {
                       $FrontOfficeBuild = $query->result_array();
                       }
                    
                     return $FrontOfficeBuild[0];
		}
	   function DeleteofficeBuild($id){	
     	$data = array(
		'deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
 $builder = $this->tenantDb;	 
 $builder->set($data);
 $builder->where('id', $id);
 $builder->update('CASH_ci_officeBuild');
//  echo $queryyyy = $this->tenantDb->getLastQuery(); exit;
return true;
} 
		
		
		// END office build ==============================================================
		
		public function update_cashD($data,$id){
	   
		    $builder = $this->tenantDb;
		     $builder->set($data);
            $builder->where('id', $id);
            return $builder->update('CASH_ci_floats');
		
		}
		
	
       function deleteFloat($id){	
     	$data = array(
		'deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
$builder = $this->tenantDb;
 $builder->set($data);
 $builder->where('id', $id);
 $builder->update('CASH_ci_floats');
return true;
} 

		
	   public function getFloatByID($id,$byDate=false,$float_type=''){
		ini_set('display_errors', 1);
		if($byDate){
	   $conditions = array(
         'CASH_ci_floats.till_id' => $id,
         'CASH_ci_floats.float_type' => $float_type,
         'CASH_ci_floats.created_date' => date('Y-m-d')
       );   
		}else{
		$conditions = array(
         'CASH_ci_floats.deleted' => 0,
          'CASH_ci_floats.id' => $id,
       );
		}
	 
	       $query = $this->tenantDb->select('
					CASH_ci_floats.*,
					CASH_ci_tills.till_name as "till_name1"
					')
					 ->join('CASH_ci_tills', 'CASH_ci_tills.id = CASH_ci_floats.till_id', 'left')
                     ->where($conditions)
                     ->order_by("CASH_ci_floats.created_date", "asc")
                      ->get('CASH_ci_floats');
                      
                       if ($query === false) {
                         return $floatsByThisId =  array();
                       } else {
                       $floatsByThisId = $query->result_array();
                       }
                       
                     return $floatsByThisId[0];
		}
     
		public function get_all_floats($floatType=''){

		    $builder = $this->tenantDb;
	        $query = $builder->select('
					CASH_ci_floats.id,
	    			CASH_ci_floats.time,
	    			CASH_ci_floats.managerVarience,
	    			CASH_ci_floats.m2_of_fc_floatvarience,
	    			CASH_ci_floats.frontCounterFloatTableFooterTotals,
	    			CASH_ci_floats.till_id,
	    			CASH_ci_floats.items_detail,
					CASH_ci_floats.status,
					CASH_ci_tills.till_name as "till_name1"
					')
					 ->join('CASH_ci_tills', 'CASH_ci_tills.id = CASH_ci_floats.till_id', 'left')
                     ->where('CASH_ci_floats.deleted' ,'0')
                     ->where('CASH_ci_floats.location_id', $this->selected_location_id)
                     ->where('CASH_ci_floats.float_type' ,$floatType)
                    //  ->where('CASH_ci_floats.till_id' ,$till_id)
                     ->order_by("CASH_ci_floats.created_date", "desc")
                      ->get('CASH_ci_floats');
                     
                     
                      if ($query === false) {
                          return $cashDeposits =  array();  
                       } else {
                       $cashDeposits = $query->result_array();
                       }
                   
                     return $cashDeposits;
		}
}