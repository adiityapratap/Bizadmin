<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Temp_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
	
	 function updateTempDataRrecords(){
	     
	   //   $this->tenantDb->select('date_entered');
	   // $this->tenantDb->from('TEMP_foodTemprecordHistory');
	   // $this->tenantDb->where('TEMP_foodTemprecordHistory.location_id', 31);  
	    
	   // $query = $this->tenantDb->get();
    //     $result = $query->result_array();
        
    
   // Fetch records where location_id = 31
$this->tenantDb->select('id, date_entered');
$this->tenantDb->from('TEMP_foodTemprecordHistory');
$this->tenantDb->where('location_id', 31);
$this->tenantDb->where('date_entered', '2024-01-01');


$query = $this->tenantDb->get();
$records = $query->result_array();

if (!empty($records)) {
    $count = 0;
    foreach ($records as $record) {
        // Increment the date_entered by 1 day
        
        if($count == 0){
          $newDate = date('Y-m-d', strtotime($record['date_entered'] . ' +1 day'));  
           echo "New date if ".$newDate."</br>";
        }else{
         $newDate = date('Y-m-d', strtotime($newDate . ' +1 day'));  ;
         echo "New date = ".$newDate."</br>";
        }
       
        // Update the record with the new date
        $this->tenantDb->where('id', $record['id']);
        $this->tenantDb->update('TEMP_foodTemprecordHistory', ['date_entered' => $newDate]);
    $count++;     
    }
    exit;
} else {
    echo "No records found to update.";
}


        
	   
	    
	    exit;
	 }
	
		public function get_all_sitesQuestion(){
		    $where_conditions = array(
            'is_deleted' => 0,
            'location_id' => $this->selected_location_id
            );
        
       	$sitesCommentsQuestions = $this->tenantDb->select('staff_comments,manager_comments')
                      ->where($where_conditions)
                     ->order_by("created_at", "asc")
                     ->get('TEMP_sites')->result_array();
                //   echo $query = $this->tenantDb->last_query(); exit;
                     return $sitesCommentsQuestions;
		}
		
		
	public function get_allActive_sites(){
		 
           $sites = $this->tenantDb->select('*')
               ->where('is_deleted', 0)
               ->where('status', 1)
               ->where('location_id', $this->selected_location_id)
               ->order_by('created_at', 'asc')
               ->get('TEMP_sites') 
               ->result_array();

              return $sites;

		}
		
		public function get_allSitesForDash(){
		    
		      $this->tenantDb->select('TEMP_sites.*, JSON_ARRAYAGG(JSON_OBJECT("id", TEMP_prepArea.id, "prep_name", TEMP_prepArea.prep_name)) as prep_areas', false);
              $this->tenantDb->from('TEMP_sites');
              $this->tenantDb->join('TEMP_prepArea', 'TEMP_prepArea.site_id = TEMP_sites.id', 'inner');
              $this->tenantDb->group_by('TEMP_sites.id')
              ->where('TEMP_sites.location_id', $this->selected_location_id)
              ->where('TEMP_sites.is_deleted', 0)
               ->where('TEMP_sites.status', 1);
              $query = $this->tenantDb->get();
                return $result = $query->result_array();
		    
		}
		
		public function get_allEquipForDash($site_id=''){
		    $siteFilter = '';
		    if($site_id != ''){
		        $siteFilter = " AND TEMP_prepArea.site_id = ".$site_id;
		    }
		    $query = $this->tenantDb->query("SELECT 
    TEMP_eqipment.*, 
    TEMP_prepArea.site_id, 
    TEMP_prepArea.prep_name, 
    TEMP_eqipment.prep_id
FROM 
    TEMP_eqipment
LEFT JOIN 
    TEMP_prepArea ON TEMP_prepArea.id = TEMP_eqipment.prep_id
LEFT JOIN 
    TEMP_sites ON TEMP_sites.id = TEMP_prepArea.site_id
WHERE 
    TEMP_eqipment.is_deleted = 0
    AND TEMP_eqipment.location_id = ".$this->selected_location_id."
    AND TEMP_eqipment.status = 1
    ".$siteFilter."
    AND (
        (TEMP_eqipment.schedule_at = 0)
        OR (
            TEMP_eqipment.schedule_at = 1 
            AND (
                DAYOFWEEK(CURDATE()) = DAYOFWEEK(TEMP_eqipment.schedule_date)
            )
        )
        OR (
            TEMP_eqipment.schedule_at = 2 
            AND (
                DAYOFMONTH(CURDATE()) = DAYOFMONTH(TEMP_eqipment.schedule_date)
            )
        )
    )
ORDER BY TEMP_eqipment.sort_order ASC;");
		   // Fetch equipment and prep area data

// $query = $this->tenantDb->last_query();
// echo $query;
// exit;

// Organize data into the desired format
      $preparedData = [];

        foreach ($query->result_array() as $row) {
        $prepId = $row['prep_id'];
    
          if (!isset($preparedData[$prepId])) {
           $preparedData[$prepId] = [
            'prep_id' => $row['prep_id'],
            'site_id' => $row['site_id'], // Prep ID as main index
            'prep_name' => $row['prep_name'], 
            'equipments' => [], // Array to store equipment data
             ];
          }
    
           // Store equipment data under the 'equipments' key
              $preparedData[$prepId]['equipments'][] = [
        'id' => $row['id'],
        'equip_name' => $row['equip_name'],
        'status' => $row['status'],
        'is_deleted' => $row['is_deleted'],
        'created_date' => $row['created_date'],
        'location_id' => $row['location_id'],
        'equip_time' => $row['equip_time'],
        'temp_min' => $row['temp_min'],
        'temp_max' => $row['temp_max'],
        'is_attchmentRequired' => $row['is_attchmentRequired'],
        'schedule_at' => $row['schedule_at'],
        'schedule_date' => $row['schedule_date'],
        'deleted_at' => $row['deleted_at'],
        'site_id' => $row['site_id'],
        'prep_name' => $row['prep_name'],
    ];
          }
            return $preparedData;
             // The $preparedData array now contains the desired format
             // echo "<pre>";
             // print_r($preparedData);
            // exit;
            // 	echo $query = $this->tenantDb->last_query(); exit;	    
		}
		
	public function updateExceededTemp($id,$data){
     	  $this->tenantDb->where('id', $id);
       $this->tenantDb->update('TEMP_record_tempHistory', $data); 
       return true;
	}
	
	public function save_signature($sign,$tableName='TEMP_record_tempHistory')
   {
    
    $data = ['manager_sign' => $sign];
//   echo "sign : ".$sign;
//     echo "locations : ".$this->selected_location_id;
//   echo "daye : ".date('Y-m-d');
//   exit;
    // Apply where conditions
    $this->tenantDb->where('location_id', $this->selected_location_id);
    $this->tenantDb->where('date_entered', date('Y-m-d'));
    $this->tenantDb->update($tableName, $data);

    $this->tenantDb->where('location_id', $this->selected_location_id);
    $this->tenantDb->where('date_entered', date('Y-m-d'));
    $this->tenantDb->update('TEMP_chillingTemprecordHistory', $data);

   

   return true;
}

	
	public function fetchAttachmentUploadedToday($equip_id){
	   $curDate = date('Y-m-d');
	   $this->tenantDb->select('*');
       $this->tenantDb->from('TEMP_record_tempHistory');
       $this->tenantDb->where('equip_id', $equip_id);
       $this->tenantDb->where('date_entered', $curDate);
       $query = $this->tenantDb->get();
       if(!empty($query->result_array())){
           return $query->result_array();
       }else{
           return array();
       }
       
	}
	
	// for updating equip temp from history page
	function tempHistoryUpdate($data){
	    
	   $this->tenantDb->select('*');
       $this->tenantDb->from('TEMP_record_tempHistory');
       $this->tenantDb->where('equip_id', $data['equip_id']);
       $this->tenantDb->where('date_entered', $data['date_entered']);
       $query = $this->tenantDb->get();
       if ($query->num_rows() > 0) {
       $this->tenantDb->where('equip_id', $data['equip_id']);
       $this->tenantDb->where('date_entered', $data['date_entered']);      
       $this->tenantDb->update('TEMP_record_tempHistory', $data);    
       }else{
        $this->tenantDb->insert('TEMP_record_tempHistory', $data);     
       }
	    
	}
	
	public function batchTempHistoryUpdate($batchData){
	    if(empty($batchData)){
	        return 0;
	    }
	    
	    // Start transaction for better performance
	    $this->tenantDb->trans_start();
	    
	    $updateCount = 0;
	    
	    // Collect unique keys to check existing records in one query
	    $checkConditions = array();
	    foreach($batchData as $data){
	        $checkConditions[] = "(equip_id = '".$this->tenantDb->escape_str($data['equip_id'])."' AND date_entered = '".$this->tenantDb->escape_str($data['date_entered'])."')";
	    }
	    
	    // Get all existing records in one query
	    $existingRecords = array();
	    if(!empty($checkConditions)){
	        $whereClause = implode(' OR ', $checkConditions);
	        $query = $this->tenantDb->query("SELECT equip_id, date_entered FROM TEMP_record_tempHistory WHERE ".$whereClause);
	        foreach($query->result_array() as $row){
	            $key = $row['equip_id'].'_'.$row['date_entered'];
	            $existingRecords[$key] = true;
	        }
	    }
	    
	    // Separate data into updates and inserts
	    $updateData = array();
	    $insertData = array();
	    
	    foreach($batchData as $data){
	        $key = $data['equip_id'].'_'.$data['date_entered'];
	        if(isset($existingRecords[$key])){
	            $updateData[] = $data;
	        } else {
	            $insertData[] = $data;
	        }
	    }
	    
	    // Batch insert new records
	    if(!empty($insertData)){
	        $this->tenantDb->insert_batch('TEMP_record_tempHistory', $insertData);
	        $updateCount += count($insertData);
	    }
	    
	    // Batch update existing records using single query with CASE
	    if(!empty($updateData)){
	        $caseTempStatements = array();
	        $whereConditions = array();
	        
	        foreach($updateData as $data){
	            $equipId = $this->tenantDb->escape_str($data['equip_id']);
	            $dateEntered = $this->tenantDb->escape_str($data['date_entered']);
	            $temp = $this->tenantDb->escape_str($data['equip_temp']);
	            
	            $caseTempStatements[] = "WHEN equip_id = '".$equipId."' AND date_entered = '".$dateEntered."' THEN '".$temp."'";
	            $whereConditions[] = "(equip_id = '".$equipId."' AND date_entered = '".$dateEntered."')";
	        }
	        
	        if(!empty($caseTempStatements)){
	            $caseTemp = "CASE ".implode(" ", $caseTempStatements)." END";
	            $whereClause = implode(" OR ", $whereConditions);
	            
	            $updateQuery = "UPDATE TEMP_record_tempHistory 
	                           SET equip_temp = ".$caseTemp.",
	                               is_completed = 1,
	                               equip_IsTempok = 'ok'
	                           WHERE ".$whereClause;
	            
	            $this->tenantDb->query($updateQuery);
	            $updateCount += count($updateData);
	        }
	    }
	    
	    // Complete transaction
	    $this->tenantDb->trans_complete();
	    
	    return $updateCount;
	}
    		
	public function updateTempForTodays($equip_id='',$data,$attachmentCall=FALSE){
       
      
      $curDate = date('Y-m-d');
      $arrr= array();

       if(!$attachmentCall){

        $data['date_entered'] = $curDate;
        $arrr = $data;
       }
       
       if($attachmentCall){
          $arrr['date_entered'] = $curDate; 
          $arrr['attachment'] = (isset($data['attachment']) ? $data['attachment'] : '');
       }
      
    
      
      
       $this->tenantDb->select('*');
       $this->tenantDb->from('TEMP_record_tempHistory');
       $this->tenantDb->where('equip_id', $equip_id);
       $this->tenantDb->where('date_entered', $curDate);

       $query = $this->tenantDb->get();

      if ($query->num_rows() > 0) {
        //   echo "w<pre>"; print_r($arrr); print_r($query->result()); 
       $this->tenantDb->where('equip_id', $equip_id);
        $this->tenantDb->where('date_entered', $curDate);  
       
       $this->tenantDb->update('TEMP_record_tempHistory', $arrr);
    //   echo  $lastQuery = $this->db->last_query();
    //   exit;
       } else {
       $arrr['equip_id'] = $equip_id; 
       $this->tenantDb->insert('TEMP_record_tempHistory', $arrr);
      }
       return true;
   }
   
		public function add_equipTemp($data){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert('TEMP_record_tempHistory',$data);
		}
		
		public function fetchTodaysEnteredTempData(){
		  $this->tenantDb->select('TEMP_record_tempHistory.*');
          $this->tenantDb->from('TEMP_record_tempHistory');
          $this->tenantDb->where('TEMP_record_tempHistory.date_entered', date('Y-m-d'));
          $this->tenantDb->where('TEMP_record_tempHistory.is_completed', 1);
          $this->tenantDb->where('TEMP_record_tempHistory.location_id', $this->selected_location_id);
          $query = $this->tenantDb->get();
          
          $newArray = array();
          if(!empty($query->result_array())){
           foreach ($query->result_array() as $item) {
           $equipId = $item['equip_id'];
            $newArray[$equipId] = $item;
          }  
          }
            return $newArray;

		}
		
		public function fetchExceededTempData(){
		    // show exceeded or less temp. recorded for last 7 days for those equip whose corrected temp has not been entered yet
		$this->tenantDb->select('TEMP_record_tempHistory.*, TEMP_sites.site_name, TEMP_sites.manager_comments, TEMP_eqipment.equip_name');
        $this->tenantDb->from('TEMP_record_tempHistory');
$this->tenantDb->join('TEMP_sites', 'TEMP_record_tempHistory.site_id = TEMP_sites.id');
$this->tenantDb->join('TEMP_eqipment', 'TEMP_record_tempHistory.equip_id = TEMP_eqipment.id');
$this->tenantDb->join('TEMP_prepArea', 'TEMP_record_tempHistory.prep_id = TEMP_prepArea.id');

// Define conditions
$this->tenantDb->where('TEMP_record_tempHistory.equip_temp NOT BETWEEN TEMP_eqipment.temp_min AND TEMP_eqipment.temp_max');
$this->tenantDb->where('TEMP_record_tempHistory.date_entered >=', date('Y-m-d', strtotime('-7 days')));
$this->tenantDb->where('TEMP_record_tempHistory.date_entered <=', date('Y-m-d'));
$this->tenantDb->where('TEMP_record_tempHistory.location_id', $this->selected_location_id);
$this->tenantDb->where('(TEMP_record_tempHistory.correctedTemp = "" OR TEMP_record_tempHistory.correctedTemp IS NULL)');
$this->tenantDb->where('TEMP_eqipment.is_deleted', 0);
$this->tenantDb->where('TEMP_prepArea.status', 1);
$this->tenantDb->where('TEMP_sites.status', 1);
 

        $query = $this->tenantDb->get();
        // echo $this->tenantDb->last_query(); exit;
//  echo "<pre>"; print_r($query->result_array()); exit;
        return $query->result_array();
		}
		
		public function fetchTempViewHistoryData($fromDate,$toDate,$site_id=''){
		    
		   $this->tenantDb->select('TEMP_record_tempHistory.*');
           $this->tenantDb->from('TEMP_record_tempHistory');
           
           $this->tenantDb->where('TEMP_record_tempHistory.location_id', $this->selected_location_id);
           if($site_id !=''){
           $this->tenantDb->where('TEMP_record_tempHistory.site_id', $site_id);    
           }
           
           $this->tenantDb->where('TEMP_record_tempHistory.date_entered >=', $fromDate);
           $this->tenantDb->where('TEMP_record_tempHistory.date_entered <=', $toDate);
           
           $query = $this->tenantDb->get();
        //   echo $this->tenantDb->last_query(); exit;
        // echo "<pre>"; print_r($query->result_array()); exit;
          $newArray = array();
          $restructuredArray = array();
       // create array based on prep are , i.e nested array where parent array will be prep_id and under it will all of its equipments
          if(!empty($query->result_array())){
           foreach ($query->result_array() as $item) {
                $date_entered = $item['date_entered'];
              $equipId = $item['equip_id'];
            // $newArray[$equipId] = $item;
            if (!isset($restructuredArray[$date_entered])) {
            $restructuredArray[$date_entered] = array();     
            }
            $restructuredArray[$date_entered][$equipId] = $item;
          }  
          }
        //   echo "<pre>"; print_r($restructuredArray); exit;
            return $restructuredArray;

          
            
		}
		
		public function getSiteNameFromId($site_id,$tableName='TEMP_sites'){
		   $where_conditions = array(
            'id' => $site_id,
            );
       $sites = $this->tenantDb->select('site_name')
                      ->where($where_conditions)
                      ->get($tableName)
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($sites) {
           return $sites->site_name; 
         } else {
           return null; 
           }

		}  
		public function getPrepNameFromId($prep_id,$tableName='TEMP_prepArea'){
		   $where_conditions = array(
            'id' => $prep_id,
            );
       $prep = $this->tenantDb->select('prep_name')
                      ->where($where_conditions)
                      ->get($tableName)
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($prep) {
           return $prep->prep_name; 
         } else {
           return null; 
           }

		}
		public function getEquipNameFromId($equip_id,$additionalFields='',$mailFrequency=false){
		   $where_conditions = array(
            'id' => $equip_id,
            );
            if($mailFrequency==true){
                $where_conditions['mailFrequency'] = 'daily';
            }
       $equip = $this->tenantDb->select('equip_name,'.$additionalFields)
                      ->where($where_conditions)
                      ->get('TEMP_eqipment')
                      ->row();
                     
         // echo $this->tenantDb->last_query(); 
         if ($equip) {
           return $equip; 
         } else {
           return null; 
           }

		}
		 function commonRecordUpdate($table,$fieldname='',$id,$data){
      $this->tenantDb->where($fieldname, $id);
      $this->tenantDb->update($table, $data);  
      
    }
	
}