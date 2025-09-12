<?php
if (!function_exists('createNotification')) {
    // This method is to fetch system for Admin only i.e Orz level
    function createNotification($tenantDb,$system_id,$location_id,$notifiType,$msg) {
        // Make sure the $db parameter is an instance of CI_DB_driver (Database Library)
       
        $data = array(
         'system_id' => $system_id,
         'title' => $msg,
         'descr' => $msg,
         'location_id' => $location_id,
         'date' => date('Y-m-d'),
         'time' => date('h:i A'),
         'notification_type' => $notifiType,
      );

        $tenantDb->insert('Global_notification', $data);
    
    }
}


if (!function_exists('fetchAllUnreadNotification')) {
  
    function fetchAllUnreadNotification($tenantDb,$location_id,$status=1) {
      $tenantQuery = $tenantDb->query("SELECT * FROM Global_notification WHERE location_id = '".$location_id."' AND is_deleted = 0 AND status = ".$status);
      $resultRows = $tenantQuery->result_array(); 
      $totalCount = $tenantQuery->num_rows(); 
      return ['result' => $resultRows, 'total_count' => $totalCount];

    
    }
}

if (!function_exists('markNotificationAsRead')) {
  
    function markNotificationAsRead($tenantDb,$notificationIds) {
      $notificationIdsToUpdate = (is_array($notificationIds) ? $notificationIdsString = implode(',', $notificationIds) : $notificationIds);
      $tenantQuery = $tenantDb->query("UPDATE Global_notification SET status = 0 WHERE id IN ($notificationIdsToUpdate)");
      
      return true;

    
    }
}