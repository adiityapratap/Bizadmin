<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fryertemp_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->selected_location_id = $this->session->userdata('location_id');
    }

    /**  Generic safe result handler **/
    private function safe_result($query, $method) {
        if (!$query) {
            $error = $this->tenantDb->error();
            log_message('error', "DB ERROR in {$method}: " . $error['message']);
            log_message('error', 'Last Query: ' . $this->tenantDb->last_query());
            return [];
        }
        return $query->result_array();
    }

    /** ------------------- METHODS ------------------- **/

    public function get_allSitesForDash($siteId = '') {
        $this->tenantDb->select('TEMP_fryerSites.*, JSON_ARRAYAGG(JSON_OBJECT("id", TEMP_fryerPrepArea.id, "prep_name", TEMP_fryerPrepArea.prep_name)) as prep_areas', false);
        $this->tenantDb->from('TEMP_fryerSites');
        $this->tenantDb->join('TEMP_fryerPrepArea', 'TEMP_fryerPrepArea.site_id = TEMP_fryerSites.id', 'inner');
        $this->tenantDb->group_by('TEMP_fryerSites.id');
        $this->tenantDb->where('TEMP_fryerSites.location_id', $this->selected_location_id);
        $this->tenantDb->where('TEMP_fryerSites.is_deleted', 0);
        $this->tenantDb->where('TEMP_fryerPrepArea.is_deleted', 0);
        $this->tenantDb->where('TEMP_fryerSites.status', 1);

        if (!empty($siteId)) {
            $this->tenantDb->where('TEMP_fryerSites.id', $siteId);
        }

        $query = $this->tenantDb->get();
        return $this->safe_result($query, __FUNCTION__);
    }

    public function recordFoodTempForTodays($tempData, $id = '') {
        if (!empty($id)) {
            $this->tenantDb->where('id', $id);
            $this->tenantDb->update('TEMP_fryerTemprecordHistory', $tempData);
        } else {
            // echo "<pre>"; print_r($tempData); exit;
            $this->tenantDb->insert('TEMP_fryerTemprecordHistory', $tempData);
        }

        if ($this->tenantDb->error()['message']) {
            log_message('error', 'DB ERROR in ' . __FUNCTION__ . ': ' . $this->tenantDb->error()['message']);
            return false;
        }
        return true;
    }

    public function fetchTodaysEnteredTempData() {
        $this->tenantDb->select('*');
        $this->tenantDb->from('TEMP_fryerTemprecordHistory');
        $this->tenantDb->where('date_entered', date('Y-m-d'));
        $this->tenantDb->where('is_completed', 1);
        $this->tenantDb->where('location_id', $this->selected_location_id);
        $this->tenantDb->order_by('id', 'ASC');
        $query = $this->tenantDb->get();
        return $this->safe_result($query, __FUNCTION__);
    }

    public function fetchExceededTempData() {
        $this->tenantDb->select('h.*, s.site_name, a.prep_name, s.manager_comments');
        $this->tenantDb->from('TEMP_fryerTemprecordHistory h');
        $this->tenantDb->join('TEMP_fryerSites s', 'h.site_id = s.id');
        $this->tenantDb->join('TEMP_fryerPrepArea a', 'h.prep_id = a.id');
        $this->tenantDb->where('h.food_temp NOT BETWEEN h.currentFoodMinTempAllowed AND h.currentFoodMaxTempAllowed');
        $this->tenantDb->where('h.date_entered >=', date('Y-m-d', strtotime('-7 days')));
        $this->tenantDb->where('h.date_entered <=', date('Y-m-d'));
        $this->tenantDb->where('h.location_id', $this->selected_location_id);
        $this->tenantDb->where('(h.correctedTemp = "" OR h.correctedTemp IS NULL)', NULL, FALSE);
        $this->tenantDb->where('a.status', 1);
        $this->tenantDb->where('s.status', 1);
        $query = $this->tenantDb->get();
        return $this->safe_result($query, __FUNCTION__);
    }

    public function updateExceededTemp($id, $data) {
        $this->tenantDb->where('id', $id);
        $query = $this->tenantDb->get('TEMP_fryerTemprecordHistory');

        if ($query && $query->num_rows() > 0) {
            $this->tenantDb->where('id', $id);
            $this->tenantDb->update('TEMP_fryerTemprecordHistory', $data);
        }

        if ($this->tenantDb->error()['message']) {
            log_message('error', 'DB ERROR in ' . __FUNCTION__ . ': ' . $this->tenantDb->error()['message']);
        }

        return true;
    }

    public function fetchTempViewHistoryData($fromDate, $toDate, $site_id) {
        $this->tenantDb->select('FTH.*,FTP.product_name');
        $this->tenantDb->from('TEMP_fryerTemprecordHistory FTH');
        $this->tenantDb->join('TEMP_fryertempProducts FTP', 'FTH.productId = FTP.id');
        $this->tenantDb->where('FTH.location_id', $this->selected_location_id);
        $this->tenantDb->where('FTH.site_id', $site_id);
        $this->tenantDb->where('FTH.date_entered >=', $fromDate);
        $this->tenantDb->where('FTH.date_entered <=', $toDate);
        $query = $this->tenantDb->get();
        return $this->safe_result($query, __FUNCTION__);
    }

    public function fetchAttachmentUploadedToday($id) {
        $curDate = date('Y-m-d');
        $this->tenantDb->select('*');
        $this->tenantDb->from('TEMP_fryerTemprecordHistory');
        $this->tenantDb->where('id', $id);
        $this->tenantDb->where('date_entered', $curDate);
        $query = $this->tenantDb->get();
        return $this->safe_result($query, __FUNCTION__);
    }
}
?>
