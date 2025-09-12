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
    //   echo "<pre>"; print_r($this->POST); exit;
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
    // echo "<pre>"; print_r($resultArray); exit;
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
                 
               return redirect(base_url('Clean/configuresubmit'));
		    
		    
           }else{
               
        $mailConfigurationData = $this->config_model->getConfiguration('','mail');
       
        $CronmailConfigurationData = $this->config_model->getConfiguration('','cronNotificationMail','NotificationEmailConfiguration');
      
        if(isset($CronmailConfigurationData) && !empty($CronmailConfigurationData)){ 
		   $data['cronMailConfigData'] = $CronmailConfigurationData;  
		}else{
		    $data['cronMailConfigData'] = '';
		}
        // echo "<pre>"; print_r($CronmailConfigurationData); exit;
        if(isset($mailConfigurationData) && !empty($mailConfigurationData)){ 
		   $data['mailConfigData'] = $mailConfigurationData;  
		}else{
		    $data['mailConfigData'] = '';
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
               return redirect(base_url('Clean/configuresubmit'));
		    
		    
           }
        
    }
    
   
    
}