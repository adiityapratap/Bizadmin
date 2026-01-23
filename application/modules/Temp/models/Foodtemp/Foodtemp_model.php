<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Foodtemp_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
	
	public function get_allSitesForDash($siteId=''){
		    
		      $this->tenantDb->select('TEMP_foodSites.*, JSON_ARRAYAGG(JSON_OBJECT("id", TEMP_foodPrepArea.id, "prep_name", TEMP_foodPrepArea.prep_name)) as prep_areas', false);
              $this->tenantDb->from('TEMP_foodSites');
              $this->tenantDb->join('TEMP_foodPrepArea', 'TEMP_foodPrepArea.site_id = TEMP_foodSites.id', 'inner');
              $this->tenantDb->group_by('TEMP_foodSites.id')
              ->where('TEMP_foodSites.location_id', $this->selected_location_id)
              ->where('TEMP_foodSites.is_deleted', 0)
              ->where('TEMP_foodPrepArea.is_deleted', 0)
               ->where('TEMP_foodSites.status', 1);
               if($siteId !=''){
               $this->tenantDb->where('TEMP_foodSites.id', $siteId);  
               }
              $query = $this->tenantDb->get();
                return $result = $query->result_array();
		    
		}
  public function recordFoodTempForTodays($tempData,$id=''){
      if($id !=''){
        $this->tenantDb->where('id', $id);
        $this->tenantDb->update('TEMP_foodTemprecordHistory', $tempData);
      }else{
      $this->tenantDb->insert('TEMP_foodTemprecordHistory', $tempData);    
      } 

      return true;
   }
   
  public function fetchTodaysEnteredTempData(){
		  $this->tenantDb->select('TEMP_foodTemprecordHistory.*');
          $this->tenantDb->from('TEMP_foodTemprecordHistory');
          $this->tenantDb->where('TEMP_foodTemprecordHistory.date_entered', date('Y-m-d'));
          $this->tenantDb->where('TEMP_foodTemprecordHistory.is_completed', 1);
          $this->tenantDb->where('TEMP_foodTemprecordHistory.location_id', $this->selected_location_id);
          $this->tenantDb->order_by('id','ASC');
          $query = $this->tenantDb->get();
          
          $resultArray = $query->result_array();
          
            return $resultArray;

		} 
 public function fetchExceededTempData(){
		    // show exceeded or less temp. recorded for last 7 days for those equip whose corrected temp has not been entered yet
		$this->tenantDb->select('TEMP_foodTemprecordHistory.*, TEMP_foodSites.site_name,TEMP_foodPrepArea.prep_name, TEMP_foodSites.manager_comments');
        $this->tenantDb->from('TEMP_foodTemprecordHistory');
        $this->tenantDb->join('TEMP_foodSites', 'TEMP_foodTemprecordHistory.site_id = TEMP_foodSites.id');
        $this->tenantDb->join('TEMP_foodPrepArea', 'TEMP_foodTemprecordHistory.prep_id = TEMP_foodPrepArea.id');

      // Define conditions
        $this->tenantDb->where('TEMP_foodTemprecordHistory.food_temp NOT BETWEEN TEMP_foodTemprecordHistory.currentFoodMinTempAllowed AND TEMP_foodTemprecordHistory.currentFoodMaxTempAllowed');
        $this->tenantDb->where('TEMP_foodTemprecordHistory.date_entered >=', date('Y-m-d', strtotime('-7 days')));
        $this->tenantDb->where('TEMP_foodTemprecordHistory.date_entered <=', date('Y-m-d'));
        $this->tenantDb->where('TEMP_foodTemprecordHistory.location_id', $this->selected_location_id);
        $this->tenantDb->where('(TEMP_foodTemprecordHistory.correctedTemp = "" OR TEMP_foodTemprecordHistory.correctedTemp IS NULL)');
        $this->tenantDb->where('TEMP_foodPrepArea.status', 1);
        $this->tenantDb->where('TEMP_foodSites.status', 1);
 
        $query = $this->tenantDb->get();
        // echo $this->tenantDb->last_query(); exit;
//  echo "<pre>"; print_r($query->result_array()); exit;
        return $query->result_array();
		}	
 public function updateExceededTemp($id,$data){
       $this->tenantDb->select('TEMP_foodTemprecordHistory.*');
        $this->tenantDb->from('TEMP_foodTemprecordHistory');
       $this->tenantDb->where('id', $id);
       $query = $this->tenantDb->get();
       if ($query->num_rows() > 0) {
        $this->tenantDb->where('id', $id);
       $this->tenantDb->update('TEMP_foodTemprecordHistory', $data);   
       }else{
    //       $insertdata
    //   $this->tenantDb->insert('TEMP_foodTemprecordHistory', $data);     
       }
       
        
    //   echo $this->tenantDb->last_query(); exit;
       return true;
	}
	
	public function fetchTempViewHistoryData($fromDate,$toDate,$site_id){
		    
		   $this->tenantDb->select('TEMP_foodTemprecordHistory.*');
           $this->tenantDb->from('TEMP_foodTemprecordHistory');
           
           $this->tenantDb->where('TEMP_foodTemprecordHistory.location_id', $this->selected_location_id);
           $this->tenantDb->where('TEMP_foodTemprecordHistory.site_id', $site_id);
           $this->tenantDb->where('TEMP_foodTemprecordHistory.date_entered >=', $fromDate);
           $this->tenantDb->where('TEMP_foodTemprecordHistory.date_entered <=', $toDate);
           
           $query = $this->tenantDb->get();
            return $query->result_array();
       	}
       	
    public function fetchAttachmentUploadedToday($id){
	   $curDate = date('Y-m-d');
	   $this->tenantDb->select('*');
       $this->tenantDb->from('TEMP_foodTemprecordHistory');
       $this->tenantDb->where('id', $id);
       $this->tenantDb->where('date_entered', $curDate);
       $query = $this->tenantDb->get();
       if(!empty($query->result_array())){
           return $query->result_array();
       }else{
           return array();
       }
       
	}   	

}
?>