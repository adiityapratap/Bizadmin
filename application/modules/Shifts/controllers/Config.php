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
                 
               return redirect(base_url('Temp/configuresubmit'));
		    
		    
           }else{
               
        $mailConfigurationData = $this->config_model->getConfiguration('','mail');
        $foodTempConfigurationData = $this->config_model->getConfiguration('','foodTemp');
        // echo "<pre>"; print_r($mailConfigurationData); exit;
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

       
          $this->load->view('general/header');   
          $this->load->view('Configure/configuration',$data);
          $this->load->view('general/footer');       
        }
    }
    
    function configureAddUpdateFoodTemp(){
        $tempArray['foodMaxTemp']= (isset($this->POST['foodMaxTemp']) ? $this->POST['foodMaxTemp'] : '');
        $tempArray['foodMinTemp']= (isset($this->POST['foodMinTemp']) ? $this->POST['foodMinTemp'] : '');
        $configData = array( 
		'data' => serialize($tempArray),
		'configureFor' => 'foodTemp',
		'metaData'=> 'foodTemp',
		'created_date' => date('Y-m-d'),
		);
		$result = $this->config_model->configure($configData,(isset($this->POST['foodTempConfigId']) ? $this->POST['foodTempConfigId'] : ''));
		return redirect(base_url('Temp/configuresubmit'));			
        
    }
    
}