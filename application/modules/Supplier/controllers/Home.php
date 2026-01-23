<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('general_model');
		 $this->load->model('config_model');
		 $this->load->model('budget_model');
		$this->load->model('order_model');
		$this->load->model('common_model');
		$this->load->model('internalorder_model');
	   $this->selected_location_id = $this->session->userdata('location_id');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	}
	
	public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
        $todaysDeliveryWhereConditions = array(
         'o.delivery_date' => date('Y-m-d'),
         'o.status' => array('1', '2', '3')
         );
         $allDeliveryWhereConditions = array(
         'o.delivery_date >' => date('Y-m-d'),
         'o.status' => array('1', '2', '3')
         );
         
         $orderSentWhereConditions = array(
        'WEEK(o.delivery_date, 1) =' => date('W'), // 1 specifies Sunday as the start of the week
        'YEAR(o.delivery_date) =' => date('Y'),
         'o.status' => array('1','2','3')
        );
         
        $configurationData = $this->config_model->getConfiguration('settings');
        $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
        $data['configData'] = $configData;
     
        $data['mandatoryRecord'] = $this->supplier_model->fetchSuppliersSortBYCutoffTime($this->selected_location_id);
        $data['topFiveSuppliers'] = $this->supplier_model->fetchTopFiveSuppliers();
        $data['locationBudgetDetails'] = fetchLocationBudget($this->tenantDb,$this->selected_location_id);
        $data['weeklySpent'] = $this->budget_model->getSuppliersUsedBudget('','weekly'); 
        $data['monthlySpent'] = $this->budget_model->getSuppliersUsedBudget('','monthly'); 
        $ordersSent = $this->order_model->getOrders($orderSentWhereConditions); 
        $data['thisWeekSentOrders'] = (isset($ordersSent) && is_array($ordersSent) ? count($ordersSent) : 0);
        $data['todaysDelivery'] = $this->order_model->getOrders($todaysDeliveryWhereConditions);
        $data['allDeliveries'] = $this->order_model->getOrders($allDeliveryWhereConditions,'delivery_date');
        $conditionsSub = array('location_id' => $this->selected_location_id,'is_deleted' => 0,'status' => 1); $colsToFetchSub = array('id,name,last_countedAt,is_kitchen,last_deliveryDate');
        $data['subLocationListInternalOrder'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub, $conditionsSub);
       // check if current location is_production(kitchen location)  , for internal order
        $conditionsSub['is_kitchen'] = 1;
        $is_productionResult = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', array('is_kitchen'), $conditionsSub);
        $data['is_production'] = (isset($is_productionResult) && !empty($is_productionResult) ? true : false);
        $data['allSubLocations'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub); 
        $data['weeklyRemaining'] = (isset($data['locationBudgetDetails']->weeklyLocationBudget) ? $data['locationBudgetDetails']->weeklyLocationBudget : 0) - $data['weeklySpent'];
        $data['monthlyRemaining'] = (isset($data['locationBudgetDetails']->monthlyLocationBudget) ? $data['locationBudgetDetails']->monthlyLocationBudget : 0) - $data['monthlySpent'];
        $data['monthlyBudgets'] = $this->budget_model->fetchMonthlyLocationBudgets();
        $data['monthlySpentForGraph'] = $this->order_model->fetchMonthlyOrderTotals();
      
        // echo "<pre>";  print_r($data['mandatoryRecord']); exit;
        // //
        // exit;
        
        // 9999 -> is global smtp wch can be used as a backup to send email id orifinal smtp of orz. is not working
          $emailSettings = $this->general_model->fetchSmtpSettings($this->selected_location_id,$system_id);
          if(empty($emailSettings)){
           $emailSettings = $this->general_model->fetchSmtpSettings('9999','9999');
           $this->configureSMTP($emailSettings);
          }else{
           if ($emailSettings->mail_protocol === 'smtp') {
          $this->configureSMTP($emailSettings);
          }   
          }
         if(isset($emailSettings->mail_from)){
           $this->session->set_userdata('mail_from',$emailSettings->mail_from);
          }
          
        $common_footer_view = $_SERVER['common_footer'];
      	$this->load->view('general/header');
      	$this->load->view('Suppliers/dashboard',$data);
      	$this->load->view('general/footer');

    }
    
	
}