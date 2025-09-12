<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bankdeposit_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	} 
        public function get_AllCoinBag($tillId=''){
           
		 $builder = $this->tenantDb;
	      $query = $builder->select('
				    CASH_ci_cash_deposit.regtotal,
					CASH_ci_cash_deposit.regtotal1,
					CASH_ci_cash_deposit.created_date,
					')
                     ->where('CASH_ci_cash_deposit.deleted' ,'0')
                     ->where('CASH_ci_cash_deposit.till_id' ,$tillId)
                      ->where('CASH_ci_cash_deposit.Month' ,date("F"))
                     ->where('CASH_ci_cash_deposit.Year' ,date("Y"))
                      ->get('CASH_ci_cash_deposit');
                       if ($query === false) {
                         return $thisMonthCoinBagsData =  array();
                       } else {
                       $thisMonthCoinBagsData = $query->result_array();
                       }
                 

                     return $thisMonthCoinBagsData;
		}
		
		 public function get_TillWiseCoinBag(){
		 $builder = $this->tenantDb;
	$query = $builder->select('
				    CASH_ci_cash_deposit.regtotal1,
				    CASH_ci_cash_deposit.depositM2,
					CASH_ci_cash_deposit.till_id,
					CASH_ci_cash_deposit.created_date,
					')
                     ->where('CASH_ci_cash_deposit.deleted' ,'0')
                     ->where('CASH_ci_cash_deposit.Month' ,date("F"))
                     ->where('CASH_ci_cash_deposit.Year' ,date("Y"))
                      ->where('CASH_ci_cash_deposit.location_id' ,$this->selected_location_id)
                      ->get('CASH_ci_cash_deposit');
                       if ($query === false) {
                         return $thisMonthCoinBagsData =  array();
                       } else {
                       $thisMonthCoinBagsData = $query->result_array();
                       }

                     return $thisMonthCoinBagsData;
		}

	  public function add_bankDeposit($data){
	   $data['location_id'] = $this->selected_location_id;
		    $builder = $this->tenantDb;
			  return $builder->insert('CASH_ci_bank_deposit',$data);
			 
		}
	 public function delete_bankDeposit($id){
	   
		    $builder = $this->tenantDb;
			 
			 $builder->where('till_id', $id);
			 $builder->where('created_date', date("Y-m-d"));
              $builder->delete('CASH_ci_bank_deposit');
              return true;
			 
		}	
	
	function get_bankDepositData($monthName,$tillId){
	
	    	 $builder = $this->tenantDb;
	         $query = $builder->select('
				    CASH_ci_bank_deposit.bank_deposit_data,
				    CASH_ci_bank_deposit.created_date,
					')
                     ->where('CASH_ci_bank_deposit.depositMonth' ,$monthName)
                      ->where('CASH_ci_bank_deposit.till_id' ,$tillId)
                       ->where('CASH_ci_bank_deposit.location_id' ,$this->selected_location_id)
                      ->get('CASH_ci_bank_deposit');
                       if ($query === false) {
                         return $thisMonthBankDepositData =  array();
                       } else {
                       $thisMonthBankDepositData = $query->result_array();
                       }
                
                     return $thisMonthBankDepositData;
	}	
	
	
    // Bank reconcile Methods ==========================================================================================
    
    public function addBankReceiptOfThisDate($file_name){
        // seraialized because multiple files can be attached
        $data = array(
            'upload_date' => date('Y-m-d'),
            'file_name' => serialize($file_name),
            'location_id' => $this->selected_location_id,
            'ip' => $_SERVER['REMOTE_ADDR']
            );
    $builder = $this->tenantDb;
			  return $builder->insert('CASH_ci_bank_reconcile_attachments',$data);    
    }
    
    public function fetchBankReceipt($date){
	    
	    	 $builder = $this->tenantDb;
	         $query = $builder->select('file_name')
                     ->where('upload_date' ,$date)
                     ->where('location_id' ,$this->selected_location_id)
                      ->get('CASH_ci_bank_reconcile_attachments');
                      if ($query === false) {
                         return $receiptName =  array();
                       } else {
                       $receiptName = $query->result_array();
                       }
                 
                 return (isset($receiptName[0]['file_name']) ? $receiptName[0]['file_name'] : '');
	}
    
    public function fetchMonthlyBankReconcileData($monthName){
	    
	    	 $builder = $this->tenantDb;
	         $query = $builder->select('CASH_ci_bank_reconcile.item_details')
                     ->where('CASH_ci_bank_reconcile.month' ,$monthName)
                      ->where('CASH_ci_bank_reconcile.year' ,date("Y"))
                     ->where('CASH_ci_bank_reconcile.location_id' ,$this->selected_location_id)
                      ->get('CASH_ci_bank_reconcile');
                      if ($query === false) {
                         return $thisMonthBankReconcileData =  array();
                       } else {
                       $thisMonthBankReconcileData = $query->result_array();
                       }
                
                     return $thisMonthBankReconcileData;
	}
	public function fetcharchiveBankReconcileData($monthName,$yearName){
	    
	    	 $builder = $this->tenantDb;
	         $query = $builder->select('CASH_ci_bank_reconcile.item_details')
                     ->where('CASH_ci_bank_reconcile.month' ,$monthName)
                     ->where('CASH_ci_bank_reconcile.year' ,$yearName)
                     ->where('CASH_ci_bank_reconcile.location_id' ,$this->selected_location_id)
                      ->get('CASH_ci_bank_reconcile');
                       if ($query === false) {
                         return $selectedMonthBankReconcileData =  array();
                       } else {
                       $selectedMonthBankReconcileData = $query->result_array();
                       }
                     return $selectedMonthBankReconcileData;
	}	
	
	public function add_bankReconcile($data){
	    
	    $builder = $this->tenantDb;
        $condition = array('month' => date('F'),'year' => date('Y'),'location_id' => $this->selected_location_id);
        $query = $builder->get_where('CASH_ci_bank_reconcile', $condition);
        if ($query->num_rows() == 0) {
            // echo "<pre>"; print_r($condition); exit;
			  return $builder->insert('CASH_ci_bank_reconcile',$data);  
        }else{
            $builder->where($condition);
           $builder->update('CASH_ci_bank_reconcile', $data);
        }
		     
		}
		
	public function update_bankReconcile($data){
	       //  echo "<pre>"; print_r($this->tenantDb); exit;
		     $builder = $this->tenantDb;
             $builder->set($data);
             $builder->where('month', date('F'));
             $builder->where('year', date('Y'));
            return $builder->update('CASH_ci_bank_reconcile');
            //  echo $queryyyy = $this->tenantDb->getLastQuery();
             
		}
		
	public function countBankReconcile(){
			 
		   	 $builder = $this->tenantDb->table('CASH_ci_bank_reconcile');
             $result = $builder->select('CASH_ci_bank_reconcile.month')
                            ->where('CASH_ci_bank_reconcile.month', date('F'))
                            ->where('CASH_ci_bank_reconcile.year', date('Y'))
                             ->count_all_results();
			 
		}    
		

		public function fetchListOfCompletedDatesOfThisMonth(){
	 $builder = $this->tenantDb;
         	 $query = $builder->select('CASH_ci_bank_reconcile.completedRecordDates')
                     ->where('CASH_ci_bank_reconcile.month' ,date('F'))
                     ->where('CASH_ci_bank_reconcile.year' , date('Y'))
                     ->where('CASH_ci_bank_reconcile.location_id' ,$this->selected_location_id)
                       ->get('CASH_ci_bank_reconcile');
                      if ($query === false) {
                         return $result =  array();
                       } else {
                       $result = $query->result_array();
                       
                        // echo $queryyyy = $builder->getLastQuery(); exit;  
                       } 
               
            return (isset($result[0]['completedRecordDates']) ? $result[0]['completedRecordDates'] : '');
			    
	}
	
		public function fetchListOfDatesBankedForThisMonth(){
	 $builder = $this->tenantDb;
         	 $query = $builder->select('CASH_ci_bank_reconcile.datesBanked')
                     ->where('CASH_ci_bank_reconcile.month' ,date('F'))
                     ->where('CASH_ci_bank_reconcile.year' , date('Y'))
                     ->where('CASH_ci_bank_reconcile.location_id' ,$this->selected_location_id)
                       ->get('CASH_ci_bank_reconcile');
                      if ($query === false) {
                         return $result =  array();
                       } else {
                       $result = $query->result_array();
                       
                        // echo $queryyyy = $builder->getLastQuery(); exit;  
                       } 
               
            return (isset($result[0]['datesBanked']) ? $result[0]['datesBanked'] : '');
			    
	}
		
	   
     
	
}