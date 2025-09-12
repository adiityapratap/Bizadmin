<?php


function get_order_status_name($statusId) {
  return isset(ORDER_STATUS_LABELS[$statusId]) ? ORDER_STATUS_LABELS[$statusId] : '';
}

 

?>