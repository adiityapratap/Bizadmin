<?php

class Config extends MY_Controller
{
    public function __construct() 
    {   
        	parent::__construct();
        $this->load->model('config_model');
        $this->load->model('common_model');
         $this->load->model('tills_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
    }
    
    
    public function configureAddUpdate(){
         
        	if(!empty($this->POST)){
        	    $mailTypeList = array();
        	      $resultArray = array();

      // Loop through the 'mailType' values
      foreach ($this->POST['mailType'] as $index => $mailType) {
      if (!isset($resultArray[$mailType])) {
        $resultArray[$mailType] = array(
            'configId' => $this->POST['configId'],
            'configureFor' => $mailType,
            'emailTo' => array(),
        );
       }

     $resultArray[$mailType]['emailTo'][] = trim($this->POST['emailTo'][$index]);
     }

            $resultArray = array_values($resultArray);
            $allConfigIds = $this->POST['configId'];
 
                 foreach ($resultArray as $keyConfigId=> $configMailData) {
                
        	      $configData = array( 
						'data' => serialize($configMailData['emailTo']),
						'configureFor' => $configMailData['configureFor'],
						'metaData'=> 'mail',
						'created_date' => date('Y-m-d'),
					);
					if(isset($this->POST['configId'][$keyConfigId])){
					$id =  $this->POST['configId'][$keyConfigId];
					unset($allConfigIds[$keyConfigId]);
					}else{
					    $id ='';
					}
				      
					$result = $this->config_model->configure($configData,$id);
				
					 
                 }
                 // remove all the ids wch has be removed from UI in last update, issue was that last column with only one record type was not deleting
                 // for eg. if For weekly float there is only one email and while updating if we delete that row it was not deleting
                 foreach ($allConfigIds as $configId) {
                $result = $this->config_model->deleteConfig($configId);     
                 }
                
                
        	    
           	if($result){
		   	return redirect(base_url('Cash/configuresubmit'));    
		    }
           }else{
        $mailConfigurationData = $this->config_model->getConfiguration('','mail');
        $CronmailConfigurationData = $this->config_model->getConfiguration('','cronNotificationMail','NotificationEmailConfiguration');
        if(isset($CronmailConfigurationData) && !empty($CronmailConfigurationData)){ 
		   $data['cronMailConfigData'] = $CronmailConfigurationData;  
		}else{
		    $data['cronMailConfigData'] = '';
		}
        $arrayOfFloatType = array('daily','weekly','monthly');
        $count = 0;
        foreach($arrayOfFloatType as $floatType) {
          $floatTypeData =   $this->config_model->getConfiguration($floatType);
          if(isset($floatTypeData[0]) && $floatTypeData[0] !=''){
            $data['configData'][$count] = $this->config_model->getConfiguration($floatType)[0];  
          }else{
              $data['configData'][$count] = array();
          }
        
        $count++;
        }
        // echo "<pre>";
        // print_r($data);
        // exit;
      
		if(isset($mailConfigurationData) && !empty($mailConfigurationData)){ 
		   $data['mailConfigData'] = $mailConfigurationData;  
		}else{
		    $data['mailConfigData'] = '';
		}
		
// 		
		
		$floatsConfigurationData = $this->config_model->getConfiguration('floats');
// 		echo "<pre>"; print_r($floatsConfigurationData); exit;
		if(isset($floatsConfigurationData[0]) && !empty($floatsConfigurationData[0])){ 
		   $data['floatsConfigData'] = unserialize($floatsConfigurationData[0]['data']);  
		   $data['floatsConfigId'] = (isset($floatsConfigurationData[0]['id']) ? $floatsConfigurationData[0]['id'] : '');
		}else{
		    $data['floatsConfigData'] = '';
		     $data['floatsConfigId'] = '';
		}
       
          $this->load->view('general/header');   
          $this->load->view('Configure/configuration',$data);
          $this->load->view('general/footer');       
        }
    }
    public function configureFloat(){
   
        	if(!empty($this->POST)){
                foreach ($this->POST['floatType'] as $index => $floatType) {
                     $configFloatData[$floatType] = array( 
						'floatTotal' => $this->POST['floatTotal'][$index],
						'm1_floatTotal' => $this->POST['m1_floatTotal'][$index],
						'configId' => (isset($this->POST['configId'][$index]) ? $this->POST['configId'][$index]: ''),
						'hideSecondSection' => (isset($this->POST['hideSecondSection_'.$floatType]) ? 1 : 0),
					);
                  }
                }
             
                foreach ($configFloatData as $floatTypeKey => $floatTypeData) {
                     $configData = array( 
						'data' => serialize($floatTypeData),
						'configureFor' => $floatTypeKey,
						'metaData'=> $floatTypeKey,
						'created_date' => date('Y-m-d'),
					);
					$id = (isset($floatTypeData['configId']) ? $floatTypeData['configId'] : '' );
				
					$result = $this->config_model->configure($configData,$id);
			      }
				
		   return redirect(base_url('Cash/configuresubmit'));     
    }
    
     function configureAutomatedNotificationsubmit(){
       	if(!empty($this->POST)){
        	    $mailTypeList = array();
        	     $resultArray = array();

      foreach ($this->POST['mailType'] as $index => $mailType) {
      if (!isset($resultArray[$mailType])) {
        $resultArray[$mailType] = array(
            'cronMailNotificationConfigId' => (isset($this->POST['cronMailNotificationConfigId']) ? $this->POST['cronMailNotificationConfigId'] : ''),
            'time_of_notification' => (isset($this->POST['time_of_notification']) ? $this->POST['time_of_notification'] : ''),
            'emailTo' => array(),
            'configureFor' => $mailType
          
        );
       }
     $resultArray[$mailType]['emailTo'][] = trim($this->POST['emailTo'][$index]);
     }

            $resultArray = array_values($resultArray);
            $allConfigIds = (isset($this->POST['cronMailNotificationConfigId']) ? $this->POST['cronMailNotificationConfigId'] : '');
  
                 foreach ($resultArray as $keyConfigId=> $configMailData) {
              
        	      $configData = array( 
						'data' => serialize($configMailData['emailTo']),
						'configureFor' => $configMailData['configureFor'],
						'metaData'=> 'cronNotificationMail',
						'methodName' => $configMailData['configureFor'],
						'time_of_notification' => $configMailData['time_of_notification'],
					);
					if(isset($this->POST['cronMailNotificationConfigId'][$keyConfigId])){
					$id =  $this->POST['cronMailNotificationConfigId'][$keyConfigId];
					unset($allConfigIds[$keyConfigId]);
					}else{
					    $id ='';
					}
					$result = $this->config_model->configureAutomatedNotificationsubmit($configData,$id); 	 
                 }
                
                 if(isset($allConfigIds) && !empty($allConfigIds)){
                foreach ($allConfigIds as $configId) {
                $result = $this->config_model->deleteCronConfig($configId);     
                 }     
                 }
               return redirect(base_url('Cash/configuresubmit'));
		    
		    
           }
        
    }
    
}