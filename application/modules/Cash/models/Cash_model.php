<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cash_model extends CI_Model{
    
  function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	} 
    
	 public function getTillNameByID($tillId){
		    $builder = $this->tenantDb;
		    
	       $query = $builder->select('CASH_ci_tills.till_name')
                     ->where('CASH_ci_tills.id', $tillId)
                     ->get('CASH_ci_tills');
                    if ($query === false) {
                         return $tills =  array();
                       } else {
                       $tills = $query->result_array();
                       }
                     return $tills;
		}	
		

	  public function add_cashD($data){
	   
		    $builder = $this->tenantDb;
			   $builder->insert('CASH_ci_cash_deposit',$data);
		return	$lastInsertedId = $builder->insert_id();   
			 
			 
		}
		
	public function update_cashD($data,$id){
	   
		    $builder = $this->tenantDb;
		     $builder->set($data);
            $builder->where('id', $id);
             return $builder->update('CASH_ci_cash_deposit');
// 		echo $queryyyy = $this->tenantDb->getLastQuery(); exit; 
		}
		
	
      function deleteCashDeposit($id){	
     	$data = array(
		'deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
         $builder = $this->tenantDb;	 
         $builder->set($data);
         $builder->where('id', $id);
         $builder->update('CASH_ci_cash_deposit');
        return true;
        } 
		
	   public function getCashDepositByID($id,$todayData=''){
		ini_set('display_errors', 1);
		    $builder = $this->tenantDb;
		    if($todayData){
		    $data_array = array('CASH_ci_cash_deposit.till_id' => $id, 'CASH_ci_cash_deposit.created_date' => date('Y-m-d'));    
		    }else{
		      $data_array = array('CASH_ci_cash_deposit.id' => $id);
		    }
		  
	       $query = $builder->select('
					CASH_ci_cash_deposit.*,
					CASH_ci_tills.till_name as "till_name1"
					')
					 ->join('CASH_ci_tills', 'CASH_ci_tills.id = CASH_ci_cash_deposit.till_id', 'left')
                     ->where('CASH_ci_cash_deposit.deleted' ,'0')
                     ->where('CASH_ci_cash_deposit.location_id', $this->selected_location_id)
                     ->where($data_array)
                     ->order_by("CASH_ci_cash_deposit.created_date", "asc")
                      ->get('CASH_ci_cash_deposit');
                      if ($query === false) {
                         return $cashDeposits =  array();
                       } else {
                       $cashDeposits = $query->result_array();
                       }
                //   echo $queryyyy = $this->tenantDb->getLastQuery(); exit; 
                     return (isset($cashDeposits[0]) ? $cashDeposits[0] : array());
		}
     
		public function get_all_cashD($tillID=''){
	
		    $builder = $this->tenantDb;
	$query = $builder->select('
					CASH_ci_cash_deposit.*,
					CASH_ci_tills.till_name as "till_name"
					')
					 ->join('CASH_ci_tills', 'CASH_ci_tills.id = CASH_ci_cash_deposit.till_id', 'left')
                     ->where('CASH_ci_cash_deposit.deleted' ,'0')
                      ->where('CASH_ci_cash_deposit.location_id', $this->selected_location_id)
                     ->where('CASH_ci_cash_deposit.till_id' ,$tillID)
                     ->order_by("CASH_ci_cash_deposit.created_date", "desc")
                      ->get('CASH_ci_cash_deposit');
                      if ($query === false) {
                         return $cashDeposits =  array();
                       } else {
                       $cashDeposits = $query->result_array();
                       }
                    //  $queryyyy = $this->db->getLastQuery();

                     return $cashDeposits;
		}
}