<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Generalcomp_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
	
	public function fetchAttachmentUploadedToday($task_id){
	   $curDate = date('Y-m-d');
	   $this->tenantDb->select('attachment');
       $this->tenantDb->from('Shifts_record_History');
       $this->tenantDb->where('task_id', $task_id);
       $this->tenantDb->where('date_entered', $curDate);
       $query = $this->tenantDb->get();
       if(!empty($query->result_array())){
           return $query->result_array();
       }else{
           return array();
       }
       
	}
    		
	public function updateRecordForTodays($task_id='',$data){
       
      
      $curDate = date('Y-m-d');
     
       $this->tenantDb->select('*');
       $this->tenantDb->from('Shifts_record_History');
       $this->tenantDb->where('task_id', $task_id);
       $this->tenantDb->where('date_entered', $curDate);

       $query = $this->tenantDb->get();

      if ($query->num_rows() > 0) {
       $this->tenantDb->where('task_id', $task_id);
        $this->tenantDb->where('date_entered', $curDate);  
       $this->tenantDb->update('Shifts_record_History', $data);
    //   echo  $lastQuery = $this->tenantDb->last_query();
    //   exit;
       } else {
    
       $this->tenantDb->insert('Shifts_record_History', $data);
      }
       return true;
   }
   
	public function fetchTodaysEnteredData(){
		  $this->tenantDb->select('Shifts_record_History.*');
          $this->tenantDb->from('Shifts_record_History');
          $this->tenantDb->where('Shifts_record_History.date_entered', date('Y-m-d'));
          $this->tenantDb->where('Shifts_record_History.is_completed', 1);
          $this->tenantDb->where('Shifts_record_History.location_id', $this->selected_location_id);
          $query = $this->tenantDb->get();
          
          $newArray = array();
          if(!empty($query->result_array())){
           foreach ($query->result_array() as $item) {
           $taskId = $item['task_id'];
            $newArray[$taskId] = $item;
          }  
          }
            return $newArray;

		}
		
			public function fetchTodaysEnteredDataForCakeDisplay(){
		  $this->tenantDb->select('Compliance_cake_records_history.*');
          $this->tenantDb->from('Compliance_cake_records_history');
          $this->tenantDb->where('Compliance_cake_records_history.date_entered', date('Y-m-d'));
          $this->tenantDb->where('Compliance_cake_records_history.location_id', $this->selected_location_id);
          $query = $this->tenantDb->get();
          
          $newArray = array();
          if(!empty($query->result_array())){
           foreach ($query->result_array() as $item) {
           $productId = $item['product_id'];
            $newArray[$productId] = $item;
          }  
          }
            return $newArray;

		}
		
	public function fetchHistoryData($fromDate,$toDate,$site_id){
		    
		   $this->tenantDb->select('Shifts_record_History.*,Shifts_prep.prep_name,Compliance_tasks.task_name');
           $this->tenantDb->from('Shifts_record_History');
           $this->tenantDb->join('Shifts_prep', 'Shifts_prep.id = Shifts_record_History.prep_id', 'left');
           $this->tenantDb->join('Compliance_tasks', 'Compliance_tasks.id = Shifts_record_History.task_id', 'left');
           $this->tenantDb->where('Shifts_record_History.location_id', $this->selected_location_id);
           $this->tenantDb->where('Shifts_record_History.site_id', $site_id);
           $this->tenantDb->where('Shifts_record_History.date_entered >=', $fromDate);
           $this->tenantDb->where('Shifts_record_History.date_entered <=', $toDate);
           
           $query = $this->tenantDb->get();
        //   echo $this->tenantDb->last_query(); exit;
        // echo "<pre>"; print_r($query->result_array()); exit;
          $newArray = array();
          $restructuredArray = array();
       // create array based on prep are , i.e nested array where parent array will be prep_id and under it will all of its equipments
          if(!empty($query->result_array())){
           foreach ($query->result_array() as $item) {
                $date_entered = $item['date_entered'];
              $taskId = $item['task_id'];
            // $newArray[$taskId] = $item;
            if (!isset($restructuredArray[$date_entered])) {
            $restructuredArray[$date_entered] = array();     
            }
            $restructuredArray[$date_entered][$taskId] = $item;
          }  
          }
        //   echo "<pre>"; print_r($restructuredArray); exit;
            return $restructuredArray;

          
            
		}

		public function getPrepNameFromId($prep_id){
		   $where_conditions = array(
            'id' => $prep_id,
            );
       $prep = $this->tenantDb->select('prep_name')
                      ->where($where_conditions)
                      ->get('Shifts_prep')
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($prep) {
           return $prep->prep_name; 
         } else {
           return null; 
           }

		}
		public function getEquipNameFromId($task_id,$additionalFields='',$mailFrequency=false){
		   $where_conditions = array(
            'id' => $task_id,
            );
            if($mailFrequency==true){
                $where_conditions['mailFrequency'] = 'daily';
            }
       $equip = $this->tenantDb->select('task_name,'.$additionalFields)
                      ->where($where_conditions)
                      ->get('Compliance_tasks')
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($equip) {
           return $equip; 
         } else {
           return null; 
           }

		}
		
  

	
}