<?php
if (!function_exists('fetchSystemNameFromId')) {
    // Fetch system name for Admin (Org level) by system ID
    function fetchSystemNameFromId($system_id) {
        $CI = &get_instance();
        $CI->load->database();

        // Validate input
        if (empty($system_id) || !is_numeric($system_id)) {
            return '';
        }

        $query = $CI->db->get_where('system_details', ['system_details_id' => $system_id]);

        if ($query === false) {
            log_message('error', 'Query failed in fetchSystemNameFromId: ' . print_r($CI->db->error(), true));
            return '';
        }

        if ($query->num_rows() > 0) {
            return $query->row()->system_name;
        }

        return '';
    }
}

if (!function_exists('fetchLocationNamesFromIds')) {
    // Fetch location names for non-Admin users by location IDs
    function fetchLocationNamesFromIds($location_ids, $singleLocation = false) {
        $CI = &get_instance();
        $CI->load->database();

        // Validate input
        if (empty($location_ids)) {
            return $singleLocation ? '' : [];
        }

        // Ensure location_ids is an array for where_in
        $location_ids = (array) $location_ids;

        $CI->db->select('location_id, location_name');
        $CI->db->where_in('location_id', $location_ids);
        $query = $CI->db->get('locations_list');

        if ($query === false) {
            log_message('error', 'Query failed in fetchLocationNamesFromIds: ' . print_r($CI->db->error(), true));
            return $singleLocation ? '' : [];
        }

        $location_map = $singleLocation ? '' : [];
        if ($singleLocation) {
            if ($query->num_rows() > 0) {
                $location_map = $query->row()->location_name;
            }
        } else {
            foreach ($query->result() as $row) {
                $location_map[$row->location_id] = $row->location_name;
            }
        }

        return $location_map;
    }
}

if (!function_exists('fetchSystemDetailsFromSystem_id')) {
    // Fetch system details by system ID
    function fetchSystemDetailsFromSystem_id($system_id) {
        $CI = &get_instance();
        $CI->load->database();

        // Validate input
        if (empty($system_id) || !is_numeric($system_id)) {
            return [];
        }

        $query = $CI->db->get_where('system_details', ['system_details_id' => $system_id]);

        if ($query === false) {
            log_message('error', 'Query failed in fetchSystemDetailsFromSystem_id: ' . print_r($CI->db->error(), true));
            return [];
        }

        if ($query->num_rows() > 0) {
            return (array) $query->row();
        }

        return [];
    }
}

if (!function_exists('get_system_details_for_user')) {
    // Fetch system details for a user based on their ID
    function get_system_details_for_user($user_id, $tenantDb, $defaultDb) {
        // Validate inputs
        if (empty($user_id) || !is_numeric($user_id)) {
            return [];
        }

        // Sanitize user_id to prevent SQL injection
        $user_id = $tenantDb->escape($user_id);

        $tenantQuery = $tenantDb->query("SELECT system_ids FROM Global_users WHERE id = $user_id AND active = 1");

        if ($tenantQuery === false) {
            log_message('error', 'Query failed in get_system_details_for_user: ' . print_r($tenantDb->error(), true));
            return [];
        }

        $result = $tenantQuery->result_array();
        if (empty($result) || empty($result[0]['system_ids'])) {
            return [];
        }

        // Handle system_ids (unserialize safely)
        $systemIdsRaw = $result[0]['system_ids'];
        $systemIdsUnserialized = is_string($systemIdsRaw) ? @unserialize($systemIdsRaw) : $systemIdsRaw;
        $systemIdsArray = is_array($systemIdsUnserialized) ? $systemIdsUnserialized : (is_string($systemIdsUnserialized) && !empty($systemIdsUnserialized) ? [$systemIdsUnserialized] : []);

        if (empty($systemIdsArray)) {
            return [];
        }

        // Sanitize and prepare system IDs for query
        $systemIds = implode(',', array_map([$tenantDb, 'escape'], $systemIdsArray));

        if (empty($systemIds)) {
            return [];
        }

        // Fetch system details
        $systemQuery = $defaultDb->query("SELECT system_details_id as system_id, system_name, system_icon, system_color, slug, custom_redirect_url FROM system_details WHERE system_details_id IN ($systemIds)");

        if ($systemQuery === false) {
            log_message('error', 'Query failed in get_system_details_for_user (system details): ' . print_r($defaultDb->error(), true));
            return [];
        }

        return $systemQuery->result_array();
    }
}
?>