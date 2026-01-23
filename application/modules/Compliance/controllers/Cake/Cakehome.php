<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cakehome extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		  $this->load->model('general_model');
		  $this->load->model('generalcomp_model');
	      $this->load->model('prep_model');
	   $this->selected_location_id = $this->session->userdata('location_id');
	   $this->system_id = $this->session->userdata('system_id');
	   $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	}
	
	public function index($system_id='')
    {  
          (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
          $emailSettings = $this->general_model->fetchSmtpSettings($this->selected_location_id,$system_id);
//          ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
        $where_conditions = array('is_deleted' => 0, 'location_id' => $this->selected_location_id );
        $data['products'] = $this->common_model->fetchRecordsDynamically('Compliance_cakeproducts','',$where_conditions);
        $data['todaysEnteredData'] = $this->generalcomp_model->fetchTodaysEnteredDataForCakeDisplay();
        // echo "<pre>"; print_r($data['todaysEnteredData']); exit;
        $data['site_detail'] = $this->generalcomp_model->get_allSitesForDash(); 
        $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_prepArea','Compliance_sites');
        $this->load->view('general/header');
      	$this->load->view('Cakehome/dashboard',$data);
      	$this->load->view('general/footer');
        
    }   
    
    function listProduct(){
         $where_conditions = array('is_deleted' => 0, 'location_id' => $this->selected_location_id );
        $data['products'] = $this->common_model->fetchRecordsDynamically('Compliance_cakeproducts','',$where_conditions);
        $data['site_detail'] = $this->generalcomp_model->get_allSitesForDash(); 
        $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_prepArea','Compliance_sites');
        $this->load->view('general/header');
        $this->load->view('Cakehome/listProduct', $data);
        $this->load->view('general/footer');
    }
    
   public function addOrUpdateProduct() {
        $id = $this->input->post('id');
        $product_name = $this->input->post('product_name');
        $prep_id = $this->input->post('prep_id');

        $data = [
            'product_name' => $product_name,
            'prep_id' => $prep_id
        ];

        if ($id) {
            $this->common_model->commonRecordUpdate('Compliance_cakeproducts','id',$id, $data);
        } else {
            $this->common_model->commonRecordCreate('Compliance_cakeproducts',$data);
        }

        echo json_encode(['status' => 'success']);
    }
    
    public function getProductById($id) {
        $condition = array('id' => $id);
        $product = $this->common_model->fetchRecordsDynamically('Compliance_cakeproducts','',$condition);
        echo json_encode($product);
    }
    
    public function saveCakeRecord()
   {
       ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $product_id = $this->input->post('product_id');
    $field = $this->input->post('field');
    $value = $this->input->post('value');
    $prepId = $this->input->post('prep');

    if (!$product_id || !$field) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        return;
    }

    $data = [
        'product_id' => $product_id,
        'prep_id' => $prepId,
         $field => $value,
        'date_entered' => date('Y-m-d'),
        'location_id' => $this->selected_location_id
        
    ];

    // Check if a record already exists for this product
    $conditionPr = array('product_id'=>$product_id,'date_entered' => date('Y-m-d'));
    $exists = $this->common_model->fetchRecordsDynamically('Compliance_cake_records_history','',$conditionPr);

    if ($exists) {
        $this->common_model->commonRecordUpdate('Compliance_cake_records_history','id',$exists[0]['id'], $data);
    } else {
        $this->common_model->commonRecordCreate('Compliance_cake_records_history',$data);
    }

    echo json_encode(['status' => 'success']);
}

public function view_records()
{
      $this->load->view('general/header');
    $this->load->view('Cakehome/history');
     $this->load->view('general/footer');
}

public function getCakeRecords()
{
    $from = $this->input->post('from_date');
    $to = $this->input->post('to_date');


    $data = $this->generalcomp_model->getRecordsByDateRange($from, $to);

    echo json_encode($data);
}


	
}