<?php
class Config extends MY_Controller
{
    public function __construct() 
    {   
        	parent::__construct();
        $this->load->model('config_model');
       $this->location_id = $this->session->userdata('location_id');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
    }
    
    
    public function configureSave(){
         
        	if(!empty($this->POST)){
        	    $settingsData = array(
        	         'showInvoice' => (isset($this->POST['hideInvoiceSection']) && $this->POST['hideInvoiceSection'] == 'on' ? 1 : 0),
        	         'sendAttachInvoiceEmail' => (isset($this->POST['sendAttachInvoiceEmail']) && $this->POST['sendAttachInvoiceEmail'] == 'on' ? 1 : 0),
        	         
        	         'showInternalOrder' => (isset($this->POST['showInternalOrder']) && $this->POST['showInternalOrder'] == 'on' ? 1 : 0),
        	         'showDashboardHeaderSection' => (isset($this->POST['showDashboardHeaderSection']) && $this->POST['showDashboardHeaderSection'] == 'on' ? 1 : 0),
        	         'showTodayOrderSection' => (isset($this->POST['showTodayOrderSection']) && $this->POST['showTodayOrderSection'] == 'on' ? 1 : 0),
        	         'showDeliverySection' => (isset($this->POST['showDeliverySection']) && $this->POST['showDeliverySection'] == 'on' ? 1 : 0),
        	         'showInternalOrderDeliverySection' => (isset($this->POST['showInternalOrderDeliverySection']) && $this->POST['showInternalOrderDeliverySection'] == 'on' ? 1 : 0),
        	         'showFooterGraphSection' => (isset($this->POST['showFooterGraphSection']) && $this->POST['showFooterGraphSection'] == 'on' ? 1 : 0),
        	         'showFocusSupplierSection' => (isset($this->POST['showFocusSupplierSection']) && $this->POST['showFocusSupplierSection'] == 'on' ? 1 : 0),
        	         
        	         'orzName'=> $this->POST['orzName'] ? $this->POST['orzName'] : '',
        	         'email'=> $this->POST['email'] ? $this->POST['email'] : '',
        	         'reply_to'=> $this->POST['reply_to'] ? $this->POST['reply_to'] : '',
        	         'budgetExceedEmail'=> $this->POST['budgetExceedEmail'] ? $this->POST['budgetExceedEmail'] : '',
        	         'phone'=> $this->POST['phone'] ? $this->POST['phone'] : '',
        	        );
        	$configData = array( 
			'data' => serialize($settingsData),
			'configureFor' => 'settings',
			'metaData'=> 'invoice,email,phone',
			'created_date' => date('Y-m-d'),
			);
			
			if(isset($this->POST['configId']) && $this->POST['configId'] !=''){
			 
			$this->config_model->configure($configData,$this->POST['configId']);    
			}else{
		    $this->config_model->configure($configData);	    
			}
		    echo "Success";
		  // return redirect(base_url('/Supplier/configuresubmit'));
           }else{
               
            $configurationData = $this->config_model->getConfiguration('settings');
            $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());

            
             $data['configData'] = $configData;
             $data['configId'] = (isset($configurationData[0]['id']) ? $configurationData[0]['id'] : '');
		    
	
          $this->load->view('general/header');   
          $this->load->view('Configure/configuration',$data);
          $this->load->view('general/footer');       
        }
    }
    
    
}