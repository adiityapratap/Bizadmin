<?php

class Config_model extends CI_Model{
	
    function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}
    // Configuration of mail
     public function configure($data,$id=''){
		    $builder = $this->tenantDb;
		    $data['location'] = $this->selected_location_id;
		    if($id){
		      $builder->set($data);
              $builder->where('id', $id);
              $builder->update('CLEAN_configuration'); 
            return true;
		    }else{
		    return $builder->insert('CLEAN_configuration',$data);    
		    }
			  
		}
   
   public function deleteConfig($id){
		 $this->tenantDb->where('id', $id);
         $this->tenantDb->delete('CLEAN_configuration');   
          return true;
		}
		
public function getConfiguration($configureFor,$metaData=''){
	     $conditions = array(
	         'location' => $this->selected_location_id,
	         );
	        ($configureFor !='' ? $conditions['configureFor'] = $configureFor : '');
	        ($metaData !='' ? $conditions['metaData'] = $metaData : '');
	       //(isset($metaData) && $metaData !='' ? $conditions['metaData'] = $metaData : '');
		   $builder = $this->tenantDb;
	       $query = $builder->select('id,data,configureFor')
                     ->where($conditions)
                     ->get('CLEAN_configuration');
                      if ($query === false) {
                         return  $resultData =  array();
                       } else {
                       $resultData = $query->result_array();
                       }
      
                     return $resultData;
		}	
    
}