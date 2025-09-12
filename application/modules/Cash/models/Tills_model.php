<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tills_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
	}

	   public function add_till($data){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert('CASH_ci_tills',$data);
		}

 function change_status($data){
     $Newdata = array(
		'status' => $data['status'],
		'updated_date'=> date("Y-m-d")
		 );
	$this->tenantDb->set($Newdata);
	$this->tenantDb->where('id',$data['till_id']);
	$this->tenantDb->update('CASH_ci_tills');
return true;
} 
       function deleteTill($id){	
     	$data = array(
		'deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
		 
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update('CASH_ci_tills');
return true;
} 
		
			public function get_allActive_tills($location_id=''){
		 
$tills = $this->tenantDb->select('*')
    ->where('deleted', 0)
    ->where('status', 1)
    ->where('location_id', $location_id)
    ->order_by('created_date', 'asc')
    ->get('CASH_ci_tills') 
    ->result_array();

foreach ($tills as $key => $till) {
    $cd = $this->tenantDb->select('shiftStarted, IsManagerfinalSubmissionDone,IsStafffinalSubmissionDone')
        ->where('till_id', $till['id'])
        ->where('created_date', date('Y-m-d'))
        ->get('CASH_ci_cash_deposit') 
        ->result_array();

    if (!empty($cd)) {
        $tills[$key]['shiftStarted'] = 1;
        $tills[$key]['IsStafffinalSubmissionDone'] = $cd[0]['IsStafffinalSubmissionDone'];
        $tills[$key]['IsManagerfinalSubmissionDone'] = $cd[0]['IsManagerfinalSubmissionDone'];
        
       
    } else {
        $tills[$key]['shiftStarted'] = 0;
        $tills[$key]['IsStafffinalSubmissionDone'] = null;
        $tills[$key]['IsManagerfinalSubmissionDone'] = null;
    }
}

return $tills;

		}
		
		public function get_all_tills($location_id=''){
		    
	$tills = $this->tenantDb->select('id,till_name,created_date,updated_date,status')
                     ->where('deleted', 0)
                     ->where('location_id', $location_id)
                     ->order_by("created_date", "asc")
                     ->get('CASH_ci_tills')->result_array();
                  
                     foreach($tills  as $till){
                      $query = $this->tenantDb->select('CASH_ci_cash_deposit.shiftStarted,CASH_ci_cash_deposit.shiftEnded')
                       ->where('CASH_ci_cash_deposit.till_id', $till['id'])
                     ->where('CASH_ci_cash_deposit.created_date', date("Y-m-d"))
                     ->get('CASH_ci_cash_deposit');
                     
                     if ($query === false) {
    // echo $this->tenantDb->last_query(); // Print the last executed query
    // echo $this->tenantDb->error();      // Print any errors
    $cd = array();
} else {
    $cd = $query->result_array();
}

                     $key = array_search($till['id'], array_column($tills, 'id'));
                     if(!empty($cd)){
                      $tills[$key]['shiftStarted'] = 1;
                     }else{
                      $tills[$key]['shiftStarted'] = 0;   
                     }
                     (!empty($cd) ? $tills[$key]['shiftEnded'] = $cd[0]['shiftEnded'] : '');
                    
                     }
                   
                     return $tills;
		}

	

        public function get_till_by_id($id){

			$this->tenantDb->select('
					id,
					till_name,
					created_date
					'
	    	);
	    	
	    	$this->tenantDb->where('id' , $id);
	    return	$query = $this->tenantDb->get('CASH_ci_tills')->result_array;					 
			
		

		}

        public function update_till($data){
			$Newdata = array(
		'till_name' => $data['till_name'],
		'updated_date'=> date("Y-m-d")
		 );

 $this->tenantDb->set($Newdata);
 $this->tenantDb->where('id', $data['id']);
 $this->tenantDb->update('CASH_ci_tills');
return true;
		}
}