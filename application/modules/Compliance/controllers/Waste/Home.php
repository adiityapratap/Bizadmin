<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('generalcomp_model');
		  $this->load->model('task_model');
		  $this->load->model('common_model');
		  $this->load->model('config_model');
		   $this->load->model('general_model');
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	}
	
	 public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
        // $this->load->model('equip_model');
        
        $data['site_detail'] = $this->generalcomp_model->get_allSitesForDash(); 
        $data['taskListForDash'] = $this->task_model->getScheduledTasks(); 
        $data['todaysEnteredData'] = $this->generalcomp_model->fetchTodaysEnteredData();
         
    //   echo "<pre>"; print_r($data['taskListForDash']); exit;
      
       
        // $phpArray = json_decode($data['site_detail'][0]['prep_areas'], true);
        // echo "<pre>"; print_r($data['exceededTempData']); exit;
        
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
          
          
      	$this->load->view('general/header');
      	$this->load->view('dashboard/dashboard',$data);
      	$this->load->view('general/footer');
  
    	
        
    }
    
    function saveDashboardData(){
      $json_data = file_get_contents('php://input');
      $dashboardData = array();
    if (!empty($json_data)) {
        $dashboardData = json_decode($json_data, true)[0];
    }

    $dashboardData['location_id'] = $this->selected_location_id;
    $dashboardData['date_entered'] = date("Y-m-d");
    $dashboardData['is_completed'] = 1;
  
    $this->generalcomp_model->updateRecordForTodays($dashboardData['task_id'],$dashboardData); 
    $this->session->unset_userdata('complianceAttachment');
    }
   
    
    
    function history(){
         $data['site_detail'] = $this->generalcomp_model->get_allSitesForDash();
      	$this->load->view('general/header');
      	$this->load->view('dashboard/history',$data);
      	$this->load->view('general/footer');
        
    }
  function historyData(){
    $dateRange =  $this->input->post('date_range'); 
    $site_id =  $this->input->post('site_id'); 
   
    $dateParts = explode(" to ", $dateRange);

    if (count($dateParts) == 2) {
    $fromDate = date('Y-m-d',strtotime(trim($dateParts[0])));
    $toDate = date('Y-m-d',strtotime(trim($dateParts[1])));
   

    $uniqueDates = array();
    $currentDate = $fromDate;
    while ($currentDate <= $toDate) {
    $uniqueDates[] = $currentDate;
    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }      
    $data['uniqueDates'] = $uniqueDates;
      
    
       $data['weeklyHistoryData'] = $this->generalcomp_model->fetchHistoryData($fromDate,$toDate,$site_id);
    //   echo "<pre>"; print_r($data['weeklyHistoryData']); exit;
    
        $this->load->view('general/header');
      	$this->load->view('dashboard/tempHistoryDetails',$data);
      	$this->load->view('general/footer');
      	
      } else {
    // Handle invalid input or display an error message
      echo "Invalid date range format";
     }

       
    }
    
   
    
   
   
   // product add update etc..
   
     function listProduct(){
         $condition = array('status' => 1);
        $data['products'] = $this->common_model->fetchRecordsDynamically('Compliance_wasteManagementproducts','',$condition);
        $data['site_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_WasteManagementsites','',$condition);
        $data['prep_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_WasteManagementPrepArea','',$condition);
        
        // echo "<pre>"; print_r($data['products']); print_r($data['site_detail']);  print_r($data['prep_detail']); exit;
        $this->load->view('general/header');
        $this->load->view('WasteManagement/listProduct', $data);
        $this->load->view('general/footer');
    }
    
   public function addOrUpdateProduct() {
        $id = $this->input->post('id');
  
       $data = [
         'product_name' => $this->input->post('product_name') ?? null,
         'par_level'    => $this->input->post('par_level') ?? null,
          'prep_id'      => $this->input->post('prep_id') ?? null
        ];

        if ($id) {
            $this->common_model->commonRecordUpdate('Compliance_wasteManagementproducts','id',$id, $data);
        } else {
            $this->common_model->commonRecordCreate('Compliance_wasteManagementproducts',$data);
        }

       redirect('Compliance/Waste/home/listProduct');
    }
    
    public function getProductById($id) {
        $condition = array('id' => $id);
        $product = $this->common_model->fetchRecordsDynamically('Compliance_wasteManagementproducts','',$condition);
        echo json_encode($product);
    }
    
	
}