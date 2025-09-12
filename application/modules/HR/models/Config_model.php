<?php

class Config_model extends CI_Model{
	
    function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
    // Configuration of mail
     public function configure($data,$id=''){
      // We are saving notification mail data in a seprate table system wise so that we can send mail notificaion on those mail using cron job 
		    
		    $data['location'] = $this->selected_location_id;
		    if($id){
		      $this->tenantDb->set($data);
              $this->tenantDb->where('id', $id);
              $this->tenantDb->update('HR_configuration'); 
              return true;
		    }else{
		     $this->tenantDb->insert('HR_configuration',$data);  
		     $id = $this->tenantDb->insert_id();
		     return $id;
		    }
			  
		}
		
	
   
    public function deleteConfig($id){
		 $this->tenantDb->where('id', $id);
         $this->tenantDb->delete('HR_configuration');   
          return true;
		}
	
}