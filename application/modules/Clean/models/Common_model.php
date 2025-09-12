<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
	
		public function get_all_sitesQuestion(){
		    $where_conditions = array(
            'is_deleted' => 0,
            'location_id' => $this->selected_location_id
            );
        
       	$sitesCommentsQuestions = $this->tenantDb->select('staff_comments,manager_comments')
                      ->where($where_conditions)
                     ->order_by("created_at", "asc")
                     ->get('CLEAN_sites')->result_array();
                //   echo $query = $this->tenantDb->last_query(); exit;
                     return $sitesCommentsQuestions;
		}
		
		
	public function get_allActive_sites(){
		 
           $sites = $this->tenantDb->select('*')
               ->where('is_deleted', 0)
               ->where('status', 1)
               ->where('location_id', $this->selected_location_id)
               ->order_by('created_at', 'asc')
               ->get('CLEAN_sites') 
               ->result_array();

              return $sites;

		}
		
    public function get_allSitesForDash(){
		    
		      $this->tenantDb->select('CLEAN_sites.*, JSON_ARRAYAGG(JSON_OBJECT("id", CLEAN_prepArea.id, "prep_name", CLEAN_prepArea.prep_name)) as prep_areas', false);
              $this->tenantDb->from('CLEAN_sites');
              $this->tenantDb->join('CLEAN_prepArea', 'CLEAN_prepArea.site_id = CLEAN_sites.id', 'inner');
              $this->tenantDb->group_by('CLEAN_sites.id')
              ->where('CLEAN_sites.location_id', $this->selected_location_id)
              ->where('CLEAN_sites.is_deleted', 0)
               ->where('CLEAN_sites.status', 1);
              $query = $this->tenantDb->get();
                return $result = $query->result_array();
		    
		}
		

	 

	public function fetchAttachmentUploadedToday($task_id){
	   $curDate = date('Y-m-d');
	   $this->tenantDb->select('attachment');
       $this->tenantDb->from('CLEAN_record_History');
       $this->tenantDb->where('task_id', $task_id);
       $this->tenantDb->where('date_entered', $curDate);
       $query = $this->tenantDb->get();
       if(!empty($query->result_array())){
           return $query->result_array();
       }else{
           return array();
       }
       
	}
    		
	public function updateCleanRecordForTodays($task_id='',$data){
       
      
      $curDate = date('Y-m-d');
     
       $this->tenantDb->select('*');
       $this->tenantDb->from('CLEAN_record_History');
       $this->tenantDb->where('task_id', $task_id);
       $this->tenantDb->where('date_entered', $curDate);

       $query = $this->tenantDb->get();

      if ($query->num_rows() > 0) {
       $this->tenantDb->where('task_id', $task_id);
        $this->tenantDb->where('date_entered', $curDate);  
       $this->tenantDb->update('CLEAN_record_History', $data);
    //   echo  $lastQuery = $this->tenantDb->last_query();
    //   exit;
       } else {
    
       $this->tenantDb->insert('CLEAN_record_History', $data);
      }
       return true;
   }
   
	public function fetchTodaysEnteredData(){
		  $this->tenantDb->select('CLEAN_record_History.*');
          $this->tenantDb->from('CLEAN_record_History');
          $this->tenantDb->where('CLEAN_record_History.date_entered', date('Y-m-d'));
          $this->tenantDb->where('CLEAN_record_History.is_completed', 1);
          $this->tenantDb->where('CLEAN_record_History.location_id', $this->selected_location_id);
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
		
	public function fetchHistoryData($fromDate,$toDate,$site_id){
		    
		   $this->tenantDb->select('CLEAN_record_History.*,CLEAN_sites.site_name,CLEAN_prepArea.prep_name,CLEAN_tasks.task_name');
           $this->tenantDb->from('CLEAN_record_History');
           $this->tenantDb->join('CLEAN_prepArea', 'CLEAN_prepArea.id = CLEAN_record_History.prep_id', 'left');
           $this->tenantDb->join('CLEAN_sites', 'CLEAN_sites.id = CLEAN_record_History.site_id', 'left');
           $this->tenantDb->join('CLEAN_tasks', 'CLEAN_tasks.id = CLEAN_record_History.task_id', 'left');
           $this->tenantDb->where('CLEAN_record_History.location_id', $this->selected_location_id);
           $this->tenantDb->where('CLEAN_record_History.site_id', $site_id);
           $this->tenantDb->where('CLEAN_record_History.date_entered >=', $fromDate);
           $this->tenantDb->where('CLEAN_record_History.date_entered <=', $toDate);
           
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
	public function getSiteNameFromId($site_id){
		   $where_conditions = array(
            'id' => $site_id,
            );
       $sites = $this->tenantDb->select('site_name')
                      ->where($where_conditions)
                      ->get('CLEAN_sites')
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($sites) {
           return $sites->site_name; 
         } else {
           return null; 
           }

		}  
		public function getPrepNameFromId($prep_id){
		   $where_conditions = array(
            'id' => $prep_id,
            );
       $prep = $this->tenantDb->select('prep_name')
                      ->where($where_conditions)
                      ->get('CLEAN_prepArea')
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
                      ->get('CLEAN_tasks')
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($equip) {
           return $equip; 
         } else {
           return null; 
           }

		}
	
}