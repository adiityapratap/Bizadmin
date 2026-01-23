<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slicingtemp_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->selected_location_id = $this->session->userdata('location_id');

    }

    private function safe_result($query) {
        if (!$query) {
         
            log_message('error', 'DB Error in ' . __FUNCTION__ . ': ' . $this->tenantDb->last_query());
            log_message('error', $this->tenantDb->error()['message']);
            return [];
        }
        return $query->result_array();
    }

    	public function get_allSitesForDash($siteId=''){
		    
		      $this->tenantDb->select('TEMP_slicingSites.*, JSON_ARRAYAGG(JSON_OBJECT("id", TEMP_slicingPrepArea.id, "prep_name", TEMP_slicingPrepArea.prep_name)) as prep_areas', false);
              $this->tenantDb->from('TEMP_slicingSites');
              $this->tenantDb->join('TEMP_slicingPrepArea', 'TEMP_slicingPrepArea.site_id = TEMP_slicingSites.id', 'inner');
              $this->tenantDb->group_by('TEMP_slicingSites.id')
              ->where('TEMP_slicingSites.location_id', $this->selected_location_id)
              ->where('TEMP_slicingSites.is_deleted', 0)
              ->where('TEMP_slicingPrepArea.is_deleted', 0)
               ->where('TEMP_slicingSites.status', 1);
               if($siteId !=''){
               $this->tenantDb->where('TEMP_slicingSites.id', $siteId);  
               }
              $query = $this->tenantDb->get();
              return $this->safe_result($query);
           
		    
		}

    public function get_allProducts() {
        $this->tenantDb->select('id, product_name, prep_id, status');
        $this->tenantDb->from('TEMP_slicingProducts');
        $this->tenantDb->where('status', 1);
        $this->tenantDb->where('is_deleted', 0);
        $query = $this->tenantDb->get();
        return $this->safe_result($query);
    }

    public function recordChillingTempForTodays($tempData, $id = '') {
        if ($id != '') {
            $this->tenantDb->where('id', $id);
            $this->tenantDb->update('TEMP_slicingTemprecordHistory', $tempData);
        } else {
            $this->tenantDb->insert('TEMP_slicingTemprecordHistory', $tempData);
        }
        return true;
    }

    public function fetchTodaysEnteredTempData() {
        $this->tenantDb->select('id, product_id, internal_batch_code_allocated, start_slicing, time_finished_slicing, temp_of_product_at_end_of_slicing, time_chilling_process_started, time_chilling_process_finished, temp_of_product_at_start_of_slicing, comments, entered_by, signature, is_completed, isTempOk, site_id, prep_id, location_id, date_entered');
        $this->tenantDb->from('TEMP_slicingTemprecordHistory');
        $this->tenantDb->where('date_entered', date('Y-m-d'));
        $this->tenantDb->where('location_id', $this->selected_location_id);
        $this->tenantDb->order_by('id', 'ASC');
        $query = $this->tenantDb->get();
        return $this->safe_result($query);
    }

    public function fetchExceededTempData() {
        $this->tenantDb->select('h.*, s.site_name, a.prep_name, s.manager_comments');
        $this->tenantDb->from('TEMP_slicingTemprecordHistory h');
        $this->tenantDb->join('TEMP_slicingSites s', 'h.site_id = s.id');
        $this->tenantDb->join('TEMP_slicingPrepArea a', 'h.prep_id = a.id');
        $this->tenantDb->where('h.date_entered >=', date('Y-m-d', strtotime('-7 days')));
        $this->tenantDb->where('h.date_entered <=', date('Y-m-d'));
        $this->tenantDb->where('h.location_id', $this->selected_location_id);
        $this->tenantDb->where('h.isTempOk', 'notOk');
        $this->tenantDb->where('a.status', 1);
        $this->tenantDb->where('s.status', 1);
        $query = $this->tenantDb->get();
        return $this->safe_result($query);
    }

    public function updateExceededTemp($id, $data) {
        $this->tenantDb->where('id', $id);
        $this->tenantDb->where('date_entered', $data['date_entered']);
        $query = $this->tenantDb->get('TEMP_slicingTemprecordHistory');
        if ($query && $query->num_rows() > 0) {
            $this->tenantDb->where('id', $id);
            $this->tenantDb->where('date_entered', $data['date_entered']);
            $this->tenantDb->update('TEMP_slicingTemprecordHistory', $data);
        }
        return true;
    }

    public function fetchTempViewHistoryData($fromDate, $toDate, $site_id) {
        $this->tenantDb->distinct();
        $this->tenantDb->select('h.id, h.product_id, p.product_name, h.internal_batch_code_allocated, h.start_slicing, h.time_finished_slicing, h.temp_of_product_at_end_of_slicing, h.time_chilling_process_started, h.time_chilling_process_finished, h.temp_of_product_at_start_of_slicing, h.comments, h.entered_by, h.signature, h.is_completed, h.isTempOk, h.site_id, h.prep_id, h.location_id, h.date_entered');
        $this->tenantDb->from('TEMP_slicingTemprecordHistory h');
        $this->tenantDb->join('TEMP_slicingProducts p', 'h.product_id = p.id', 'LEFT');
        $this->tenantDb->where('h.location_id', $this->selected_location_id);
        $this->tenantDb->where('h.site_id', $site_id);
        $this->tenantDb->where('h.date_entered >=', $fromDate);
        $this->tenantDb->where('h.date_entered <=', $toDate);
        $query = $this->tenantDb->get();
        return $this->safe_result($query);
    }

    public function fetchAttachmentUploadedToday($id) {
        $curDate = date('Y-m-d');
        $this->tenantDb->select('*');
        $this->tenantDb->from('TEMP_slicingTemprecordHistory');
        $this->tenantDb->where('id', $id);
        $this->tenantDb->where('date_entered', $curDate);
        $query = $this->tenantDb->get();
        return $this->safe_result($query);
    }
}
?>
