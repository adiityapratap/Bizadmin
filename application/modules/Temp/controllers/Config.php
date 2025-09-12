<?php

class Config extends MY_Controller
{
    public function __construct() 
    {   
        	parent::__construct();
        	 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->load->model('config_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     
    }
    
    
    public function configureAddUpdate(){
     
        	if(!empty($this->POST)){
        	    $mailTypeList = array();
        	      $resultArray = array();
                  $nontificationMail = array();
      // Loop through the 'mailType' values
    
      foreach ($this->POST['mailType'] as $index => $mailType) {
      if (!isset($resultArray[$mailType])) {
        $resultArray[$mailType] = array(
            'configId' => (isset($this->POST['configId']) ? $this->POST['configId'] : ''),
            'configureFor' => $mailType,
            'emailTo' => array(),
        );
       }
     $resultArray[$mailType]['emailTo'][] = trim($this->POST['emailTo'][$index]);
     }
            $resultArray = array_values($resultArray);
            $allConfigIds = (isset($this->POST['configId']) ? $this->POST['configId'] : '');
  
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
                 if(isset($allConfigIds) && !empty($allConfigIds)){
                foreach ($allConfigIds as $configId) {
                $result = $this->config_model->deleteConfig($configId);     
                 }     
                 }
                 
               return redirect(base_url('Temp/configuresubmit'));
		    
		    }
		     else{
               
        $mailConfigurationData = $this->config_model->getConfiguration('','mail');
        $foodTempConfigurationData = $this->config_model->getConfiguration('','foodTemp');
        $chillingTempConfigurationData = $this->config_model->getConfiguration('','chillingTemp');
        $CronmailConfigurationData = $this->config_model->getConfiguration('','','NotificationEmailConfiguration');
      
        if(isset($CronmailConfigurationData) && !empty($CronmailConfigurationData)){ 
		   $data['cronMailConfigData'] = $CronmailConfigurationData;  
		}else{
		    $data['cronMailConfigData'] = '';
		}
        
        if(isset($mailConfigurationData) && !empty($mailConfigurationData)){ 
		   $data['mailConfigData'] = $mailConfigurationData;  
		}else{
		    $data['mailConfigData'] = '';
		}
		
		if(isset($foodTempConfigurationData) && !empty($foodTempConfigurationData)){ 
		   $data['foodTempConfigurationData'] = $foodTempConfigurationData;  
		}else{
		    $data['foodTempConfigurationData'] = '';
		}
		
		if(isset($chillingTempConfigurationData) && !empty($chillingTempConfigurationData)){ 
		   $data['chillingTempConfigurationData'] = $chillingTempConfigurationData;  
		}else{
		    $data['chillingTempConfigurationData'] = '';
		}

       
          $this->load->view('general/header');   
          $this->load->view('Configure/configuration',$data);
          $this->load->view('general/footer');       
        }
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
                 
               return redirect(base_url('Temp/configuresubmit'));
		    
		    
           }
        
    }
    
    function configureAddUpdateFoodTemp(){
        $tempArray['foodMaxTemp']= (isset($this->POST['foodMaxTemp']) ? $this->POST['foodMaxTemp'] : '');
        $tempArray['foodMinTemp']= (isset($this->POST['foodMinTemp']) ? $this->POST['foodMinTemp'] : '');
        $tempArray['showFoodTemp']= (isset($this->POST['showFoodTemp']) &&  $this->POST['showFoodTemp'] == 'on' ? 1 : 0);
        $configData = array( 
		'data' => serialize($tempArray),
		'configureFor' => 'foodTemp',
		'metaData'=> 'foodTemp',
		'created_date' => date('Y-m-d'),
		);
		$result = $this->config_model->configure($configData,(isset($this->POST['foodTempConfigId']) ? $this->POST['foodTempConfigId'] : ''));
		return redirect(base_url('Temp/configuresubmit'));			
        
    }
    
    function configureAddUpdateChillingTemp(){
        $tempArray['tempAtFinishMin']= (isset($this->POST['tempAtFinishMin']) ? $this->POST['tempAtFinishMin'] : '');
        $tempArray['tempAfterTwoHrs']= (isset($this->POST['tempAfterTwoHrs']) ? $this->POST['tempAfterTwoHrs'] : '');
        $tempArray['tempAfterFourHrs']= (isset($this->POST['tempAfterFourHrs']) ? $this->POST['tempAfterFourHrs'] : '');
        $tempArray['showChillingTemp']= (isset($this->POST['showChillingTemp']) &&  $this->POST['showChillingTemp'] == 'on' ? 1 : 0);
        $configData = array( 
		'data' => serialize($tempArray),
		'configureFor' => 'chillingTemp',
		'metaData'=> 'chillingTemp',
		'created_date' => date('Y-m-d'),
		);
		$result = $this->config_model->configure($configData,(isset($this->POST['chillingTempConfigId']) ? $this->POST['chillingTempConfigId'] : ''));
		return redirect(base_url('Temp/configuresubmit'));			
        
    }
    
}