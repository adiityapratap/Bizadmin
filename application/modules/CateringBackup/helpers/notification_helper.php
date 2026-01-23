<?php 

function add_notification($orderID,$desc=''){
   
   $CI =& get_instance();
   	$CI->load->model('common_model');
   	
    if($desc == ''){
      $desc = 'order-'.$orderID.' edited on '.date('d-m-Y h:m:s');  
    }
    
    // echo "not".$desc;exit;
    
	    $data  = array(
	       'description' => $desc,
	       'orderID' => $orderID,
	       'date_added' => date('Y-m-d'),
	       'time_added' => date('h:m:s')
	       
	   );
	   
	     
	        $CI->common_model->commonRecordCreate('Catering_notification',$data);
	   
	    return true;
}

?>