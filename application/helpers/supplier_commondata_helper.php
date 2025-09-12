<?php 
if (!function_exists('fetchLocationBudget')) {
  
    function fetchLocationBudget($tenantDb,$location_id) {
    
      try {
        // Get the date of the most recently entered budget record
        $tenantDb->select_max('date_modified', 'lastBudgetRecordedDate');
        $tenantDb->from('SUPPLIERS_LocationWisebudgetRecord');
        $query = $tenantDb->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $lastBudgetRecordedDate = $row->lastBudgetRecordedDate;

            // Fetch budget data for the most recent date and current location
            $tenantDb->select('*');
            $tenantDb->from('SUPPLIERS_LocationWisebudgetRecord');
            $tenantDb->where('date_modified', $lastBudgetRecordedDate);
            $tenantDb->where('location_id', $location_id);
            $query = $tenantDb->get();

            return $query->row(); // Return the budget data
        } else {
            return []; // Return an empty array if no records found
        }
    } catch (Exception $e) {
        // Handle database errors here
        

    
    }
}
}

?>