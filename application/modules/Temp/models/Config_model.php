<?php

class Config_model extends CI_Model{
	
    function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
    // Configuration of mail
     public function configure($data,$id=''){
      // We are saving notification mail data in a seprate table system wise so that we can send mail notificaion on those mail using cron job 
		    $builder = $this->tenantDb;
		    $data['location'] = $this->selected_location_id;
		    if($id){
		     
		      $builder->set($data);
              $builder->where('id', $id);
              $builder->update('TEMP_ci_configuration'); 
            
            return true;
		    }else{

		     $builder->insert('TEMP_ci_configuration',$data);  
		     $id = $this->tenantDb->insert_id();
		     if($data['configureFor']=='notification_mail'){
		      $notificationConfigData = array( 
				 'id'=> $id ? $id : '',
				 'systemName' => 'Temperature',
				 'location_id' => $this->selected_location_id,
				 'email' => serialize($data['data']),
				 'time_of_notification'=> $data['time_of_notification'],
				 'system_id'=> $this->session->userdata('system_id')
				  	);  
			 $builder->insert('NotificationEmailConfiguration',$notificationConfigData);	  	
		        }
		        
		     return true;   
		    }
			  
		}
		
	function configureAutomatedNotificationsubmit($data,$id=''){
	        $builder = $this->tenantDb;
	        $systemDetails = fetchSystemDetailsFromSystem_id($this->session->userdata('system_id'));
		    $data['location'] = $this->selected_location_id;
		    $data['system_id'] = $this->session->userdata('system_id'); 
		    $data['systemName'] = (isset($systemDetails->system_name) ? $systemDetails->system_name : '');
		    if($id){
		     
		      $builder->set($data);
              $builder->where('id', $id);
              $builder->update('NotificationEmailConfiguration'); 
            return true;
		    }else{
		    
		     $builder->insert('NotificationEmailConfiguration',$data);  
		     $id = $this->tenantDb->insert_id();
		     return true;   
		    }  
	    
	}
   
   public function deleteConfig($id){
		 $this->tenantDb->where('id', $id);
         $this->tenantDb->delete('TEMP_ci_configuration');   
          return true;
		}
		
 public function deleteCronConfig($id){
		 $this->tenantDb->where('id', $id);
         $this->tenantDb->delete('NotificationEmailConfiguration');   
          return true;
		}		
		
public function getConfiguration($configureFor,$metaData='',$tableName='TEMP_ci_configuration'){
	        $conditions['location'] =  $this->selected_location_id;
	        ($configureFor !='' ? $conditions['configureFor'] = $configureFor : '');
	        ($metaData !='' ? $conditions['metaData'] = $metaData : '');
	        if($tableName =='NotificationEmailConfiguration'){
	         $conditions['system_id']  =  $this->session->userdata('system_id');
	        }
	       //(isset($metaData) && $metaData !='' ? $conditions['metaData'] = $metaData : '');
		   $builder = $this->tenantDb;
	       $query = $builder->select('id,data,configureFor,time_of_notification')
                     ->where($conditions)
                     ->get($tableName);
                      if ($query === false) {
                         return  $resultData =  array();
                       } else {
                       $resultData = $query->result_array();
                       }
      
                     return $resultData;
		}	
    
}