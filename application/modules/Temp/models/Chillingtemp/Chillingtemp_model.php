<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chillingtemp_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
	
	function insertPastrecords($startDate,$end_date,$siteId,$preID){
	    
        // Set the initial date
        $start_date = new DateTime($startDate);
        $end_date = new DateTime($end_date);

        // Values to insert
        $data_template = [
            'site_id' => $siteId,
            'prep_id' => $preID,
            'foodName' => 'Chicken Schnitzel',
            'startTime' => '8',
            'finishTime' => '8.10',
            'chillingStartTime' => '8.15',
            'entered_by' => 'Harpi',
            'location_id' => $this->selected_location_id,
            'timeAfterTwohours' => '10:10 AM',
            'tempAfterTwohours' => '19',
            'timeAfterFourhours' => '12:10 PM',
            'tempAfterFourhours' => '3.4',
            'is_completed' => '1',
            'isTempok' => 'ok'
        ];

        $temp_at_finish = 80; // Starting temperature at finish

        while ($start_date <= $end_date) {
            $date_entered = $start_date->format('Y-m-d');
            
            // Adjust temperature values approximately every 10 days
            if ((int)$start_date->format('d') % 10 === 0) {
                $temp_at_finish = rand(78, 82); // Random temperature for variation
                $data_template['tempAfterTwohours'] = rand(18, 20);
                $data_template['tempAfterFourhours'] = number_format(rand(30, 40) / 10, 1); // Random value like 3.4
            }

            // Prepare the data for this date
            $data = $data_template;
            $data['tempAtFinish'] = $temp_at_finish;
            $data['date_entered'] = $date_entered;

            // Insert the data into the table
            $this->tenantDb->insert('TEMP_chillingTemprecordHistory', $data);

            // Move to the next day
            $start_date->modify('+1 day');
            echo "inserted fat temp".$temp_at_finish;
        }
	}
	
	public function get_allSitesForDash($siteId=''){
		    
		      $this->tenantDb->select('TEMP_chillingSites.*, JSON_ARRAYAGG(JSON_OBJECT("id", TEMP_chillingPrepArea.id, "prep_name", TEMP_chillingPrepArea.prep_name)) as prep_areas', false);
              $this->tenantDb->from('TEMP_chillingSites');
              $this->tenantDb->join('TEMP_chillingPrepArea', 'TEMP_chillingPrepArea.site_id = TEMP_chillingSites.id', 'inner');
              $this->tenantDb->group_by('TEMP_chillingSites.id')
              ->where('TEMP_chillingSites.location_id', $this->selected_location_id)
              ->where('TEMP_chillingSites.is_deleted', 0)
              ->where('TEMP_chillingPrepArea.is_deleted', 0)
               ->where('TEMP_chillingSites.status', 1);
               if($siteId !=''){
               $this->tenantDb->where('TEMP_chillingSites.id', $siteId);  
               }
              $query = $this->tenantDb->get();
                return $result = $query->result_array();
		    
		}
  public function recordChillingTempForTodays($tempData,$id=''){
      if($id !=''){
        $this->tenantDb->where('id', $id);
        $this->tenantDb->update('TEMP_chillingTemprecordHistory', $tempData);
      }else{
      $this->tenantDb->insert('TEMP_chillingTemprecordHistory', $tempData);    
      } 

      return true;
   }
   
  public function fetchTodaysEnteredTempData(){
		  $this->tenantDb->select('TEMP_chillingTemprecordHistory.*');
          $this->tenantDb->from('TEMP_chillingTemprecordHistory');
          $this->tenantDb->where('TEMP_chillingTemprecordHistory.date_entered', date('Y-m-d'));
        //   $this->tenantDb->where('TEMP_chillingTemprecordHistory.is_completed', 1);
          $this->tenantDb->where('TEMP_chillingTemprecordHistory.location_id', $this->selected_location_id);
          $this->tenantDb->order_by('id','ASC');
          $query = $this->tenantDb->get();
          
          $resultArray = $query->result_array();
          
            return $resultArray;

		} 
 public function fetchExceededTempData(){
		    // show exceeded or less temp. recorded for last 7 days for those equip whose corrected temp has not been entered yet
		$this->tenantDb->select('TEMP_chillingTemprecordHistory.*, TEMP_chillingSites.site_name,TEMP_chillingPrepArea.prep_name, TEMP_chillingSites.manager_comments');
        $this->tenantDb->from('TEMP_chillingTemprecordHistory');
        $this->tenantDb->join('TEMP_chillingSites', 'TEMP_chillingTemprecordHistory.site_id = TEMP_chillingSites.id');
        $this->tenantDb->join('TEMP_chillingPrepArea', 'TEMP_chillingTemprecordHistory.prep_id = TEMP_chillingPrepArea.id');

      // Define conditions
        // $this->tenantDb->where('TEMP_chillingTemprecordHistory.food_temp NOT BETWEEN TEMP_chillingTemprecordHistory.currentFoodMinTempAllowed AND TEMP_chillingTemprecordHistory.currentFoodMaxTempAllowed');
        $this->tenantDb->where('TEMP_chillingTemprecordHistory.date_entered >=', date('Y-m-d', strtotime('-7 days')));
        $this->tenantDb->where('TEMP_chillingTemprecordHistory.date_entered <=', date('Y-m-d'));
        $this->tenantDb->where('TEMP_chillingTemprecordHistory.location_id', $this->selected_location_id);
        // $this->tenantDb->where('(TEMP_chillingTemprecordHistory.correctedTemp = "" OR TEMP_chillingTemprecordHistory.correctedTemp IS NULL)');
        $this->tenantDb->where('TEMP_chillingPrepArea.status', 1);
        $this->tenantDb->where('TEMP_chillingSites.status', 1);
 
        $query = $this->tenantDb->get();
        // echo $this->tenantDb->last_query(); exit;
//  echo "<pre>"; print_r($query->result_array()); exit;
        return $query->result_array();
		}	
 public function updateExceededTemp($id,$data){
       $this->tenantDb->select('TEMP_chillingTemprecordHistory.*');
        $this->tenantDb->from('TEMP_chillingTemprecordHistory');
       $this->tenantDb->where('id', $id);
       $this->tenantDb->where('date_entered', $data['date_entered']);
       $query = $this->tenantDb->get();
       if ($query->num_rows() > 0) {
        $this->tenantDb->where('id', $id);
       $this->tenantDb->where('date_entered', $data['date_entered']);
       $this->tenantDb->update('TEMP_chillingTemprecordHistory', $data);   
       }else{
    //       $insertdata
    //   $this->tenantDb->insert('TEMP_chillingTemprecordHistory', $data);     
       }
       
        
    //   echo $this->tenantDb->last_query(); exit;
       return true;
	}
	
	public function fetchTempViewHistoryData($fromDate,$toDate,$site_id){
		    
		   $this->tenantDb->select('TEMP_chillingTemprecordHistory.*');
           $this->tenantDb->from('TEMP_chillingTemprecordHistory');
           
           $this->tenantDb->where('TEMP_chillingTemprecordHistory.location_id', $this->selected_location_id);
           $this->tenantDb->where('TEMP_chillingTemprecordHistory.site_id', $site_id);
           $this->tenantDb->where('TEMP_chillingTemprecordHistory.date_entered >=', $fromDate);
           $this->tenantDb->where('TEMP_chillingTemprecordHistory.date_entered <=', $toDate);
           
           $query = $this->tenantDb->get();
            return $query->result_array();
       	}
       	
    public function fetchAttachmentUploadedToday($id){
	   $curDate = date('Y-m-d');
	   $this->tenantDb->select('*');
       $this->tenantDb->from('TEMP_chillingTemprecordHistory');
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