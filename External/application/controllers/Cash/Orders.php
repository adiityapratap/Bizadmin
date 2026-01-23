<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct() {
		parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('float_model');
	}
	public function viewOrder($doubleEncodedParams)
	{ 
	        $decodedParams = urldecode(urldecode(urldecode($doubleEncodedParams)));
           $decryptedParams = $this->encryption->decrypt($decodedParams);
           list($tenantIdentifier, $orderNo) = explode('|', $decryptedParams);
           $this->session->set_userdata('tenantIdentifier',$tenantIdentifier);
     	  initializeTenantDbConfig($tenantIdentifier);
	  
	  // update the status to viewed the moment they open the link
       $Builddata = array( 
						'orderStatus'=> 'Viewed',
						'updated_date' => date('Y-m-d'),
					);
      $this->float_model->officeBuildUpdate($Builddata,$orderNo); 
      	
      	$data['frontOfficeBuildData'] = $this->float_model->getOfficeBuildByID($orderNo); 
      	
    //   	echo "<pre>"; print_r(unserialize($data['frontOfficeBuildData']['otherDetails'])); exit;
		$data['disabled'] = 'disabled';
		$data['orderNumber'] = $orderNo;
		$this->load->view('general/header');
		$this->load->view('Cash/bankOrder',$data);
		 $this->load->view('general/footer');
	  
	}
	
	public function confirmBankOrder()
    { 
         $orderNumber = $this->POST['orderNumber'];
        $tenantIdentifier =  $this->session->userdata('tenantIdentifier');
         initializeTenantDbConfig($tenantIdentifier);
	   //  $bankComments = $this->POST['bankComments'];
	     $float_Builddata = array( 
				// 		'bankComments' => $bankComments,
						'orderStatus'=> 'Confirmed',
						'updated_date' => date('Y-m-d'),
					);
        
      	$result = $this->float_model->officeBuildUpdate($float_Builddata,$orderNumber); 
       echo $result;   
    }
	
}