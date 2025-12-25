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
		    $this->load->model('prep_model');
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	}
	
	 public function index($system_id='')
    {   
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
        // $this->load->model('equip_model');
        
        $data['todaysEnteredData'] = $this->generalcomp_model->fetchTodaysEnteredDataForIncomingGoods();
        $data['site_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsSites',array(),'status=1'); 
        $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_IncomingGoodsPrepArea','Compliance_IncomingGoodsSites');
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
          $condition = array('status' => 1); 
          $data['suppliers'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsproducts','',$condition);
          
          // todays data
        $condition = array('date_entered' => date('Y-m-d')); // 2025-10-09
        $history_data = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoods_history', '', $condition);

        // Process history data into $todaysEnteredData format
        $todaysEnteredData = array();
    foreach ($history_data as $record) {
        $todaysEnteredData[$record['supplier_id']] = array(
            'entered_by' => isset($record['entered_by']) ? $record['entered_by'] : '',
            'supplier_id' => isset($record['supplier_id']) ? $record['supplier_id'] : '',
            'invoice_no' => isset($record['invoice_no']) ? $record['invoice_no'] : '',
            'temp' => isset($record['temp']) ? $record['temp'] : '',
            'comments' => isset($record['comments']) ? $record['comments'] : '',
            'received_by' => isset($record['received_by']) ? $record['received_by'] : '',
            'signature' => isset($record['signature']) ? $record['signature'] : ''
        );
    }
    $data['todaysEnteredData'] = $todaysEnteredData;
        //   echo "<pre>"; print_r($data['history']); exit;
      	$this->load->view('general/header');
      	$this->load->view('Goods/dashboard',$data);
      	$this->load->view('general/footer');
  
    	
        
    }
    
   public function saveDashboardData()
{
    $supplier_id = $this->input->post('supplier');
    $field = $this->input->post('field');
    $value = $this->input->post('value');
    $prepId = $this->input->post('prep');

    if (!$supplier_id || !$field) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        return;
    }

    $data = [
        'supplier_id' => $supplier_id,
        'prep_id' => $prepId,
        $field => $value,
        'date_entered' => date('Y-m-d'),
        'location_id' => $this->selected_location_id
    ];

    // Check if a record already exists for this product
    $conditionPr = array(
        'supplier_id' => $supplier_id,
        'date_entered' => date('Y-m-d')
    );
    $exists = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoods_history', '', $conditionPr);

    if ($exists) {
        $this->common_model->commonRecordUpdate('Compliance_IncomingGoods_history', 'id', $exists[0]['id'], $data);
    } else {
        $this->common_model->commonRecordCreate('Compliance_IncomingGoods_history', $data);
    }

    echo json_encode(['status' => 'success']);
}

    
   
    
    
    function history(){
      $data['site_detail'] = $this->common_model->fetchRecordsDynamically('	Compliance_IncomingGoodsSites', '', ['status' => 1]);
      
      $this->load->view('general/header');
      $this->load->view('Goods/history', $data);
      $this->load->view('general/footer');
        
    }
    
  public function historyData($encodedDateRange = '', $prep_id = '') {
    // Handle input
    if ($encodedDateRange == '' && $prep_id == '') {
        $dateRange = $this->input->post('date_range');
        $prep_id = $this->input->post('site_id');
    } else {
        $dateRange = urldecode($encodedDateRange);
    }

    // Validate and process date range
    $dateParts = explode(" to ", $dateRange);
    if (count($dateParts) == 2) {
        $fromDate = date('Y-m-d', strtotime(trim($dateParts[0])));
        $toDate = date('Y-m-d', strtotime(trim($dateParts[1])));

        // Generate unique dates
        $uniqueDates = array();
        $currentDate = $fromDate;
        while ($currentDate <= $toDate) {
            $uniqueDates[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Fetch data
        $data['site_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsSites', '', array());
        $data['prep_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsPrepArea', '', array());
        $condition = array('status' => 1, 'is_deleted' => 0);
        $data['suppliers'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsproducts', '', $condition);

        // Fetch history data
        $condition = array(
            'date_entered >=' => $fromDate,
            'date_entered <=' => $toDate,
            'location_id' => $this->selected_location_id
        );
        if ($prep_id != '') {
            $condition['prep_id'] = $prep_id;
        }
        
        $history_data = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoods_history', '', $condition);
// echo "<pre>"; print_r($history_data); exit;
        // Restructure history data by date and supplier_id
        $weeklyHistoryData = array();
        foreach ($history_data as $item) {
            $date_entered = $item['date_entered'];
            $supplier_id = $item['supplier_id'];
            if (!isset($weeklyHistoryData[$date_entered])) {
                $weeklyHistoryData[$date_entered] = array();
            }
            $weeklyHistoryData[$date_entered][$supplier_id] = $item;
        }

        // Pass data to view
        $data['uniqueDates'] = $uniqueDates;
        $data['dateRange'] = $dateRange;
        $data['site_id'] = $prep_id;
        $data['weeklyHistoryData'] = $weeklyHistoryData;

        $this->load->view('general/header');
        $this->load->view('Goods/historyDetails', $data);
        $this->load->view('general/footer');
    } else {
        show_error('Invalid date range format');
    }
}

public function updateHistory() {
    // Validate input
    $supplier_id = $this->input->post('supplier_id', TRUE);
    $date_entered = $this->input->post('date_entered', TRUE);
    $prep_id = $this->input->post('prep_id', TRUE);
    $location_id = $this->input->post('location_id', TRUE);
    
    // All possible fields
    $supplier_name = $this->input->post('supplier_name', TRUE);
    $invoice_no = $this->input->post('invoice_no', TRUE);
    $temp = $this->input->post('temp', TRUE);
    $comments = $this->input->post('comments', TRUE);
    $received_by = $this->input->post('received_by', TRUE);
    $signature = $this->input->post('signature', TRUE);
    $wasteM_value = $this->input->post('wasteM_value', TRUE);
    $entered_by = $this->input->post('entered_by', TRUE);

    // Check for required fields
    if (empty($supplier_id) || empty($date_entered) || empty($prep_id) || empty($location_id)) {
        $response = array('status' => 'error', 'message' => 'Missing required fields');
        echo json_encode($response);
        return;
    }

    // Define condition for checking existing record
    $condition = array(
        'supplier_id' => $supplier_id,
        'date_entered' => $date_entered,
        'prep_id' => $prep_id,
        'location_id' => $location_id
    );

    // Determine which fields are being updated
    $update_data = array();
    
    if ($supplier_name !== '' && $supplier_name !== NULL) {
        $update_data['supplier_name'] = $supplier_name;
    }
    if ($invoice_no !== '' && $invoice_no !== NULL) {
        $update_data['invoice_no'] = $invoice_no;
    }
    if ($temp !== '' && $temp !== NULL) {
        $update_data['temp'] = $temp;
    }
    if ($comments !== '' && $comments !== NULL) {
        $update_data['comments'] = $comments;
    }
    if ($received_by !== '' && $received_by !== NULL) {
        $update_data['received_by'] = $received_by;
    }
    if ($signature !== '' && $signature !== NULL) {
        $update_data['signature'] = $signature;
    }
    if ($wasteM_value !== '' && $wasteM_value !== NULL) {
        $update_data['wasteM_value'] = $wasteM_value;
    }
    if ($entered_by !== '' && $entered_by !== NULL) {
        $update_data['entered_by'] = $entered_by;
    }

    // If no fields to update, return error
    if (empty($update_data)) {
        $response = array('status' => 'error', 'message' => 'No valid fields provided for update');
        echo json_encode($response);
        return;
    }

    // Check if record exists
    $exists = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoods_history', '', $condition);

    if (!empty($exists)) {
        // Update existing record with only the provided fields
        $this->common_model->commonRecordUpdateMultipleConditions('Compliance_IncomingGoods_history', $condition, $update_data);
        $response = array('status' => 'success', 'message' => 'Record updated successfully');
    } else {
        // Prepare full data for new record
        $data = array(
            'supplier_id' => $supplier_id,
            'date_entered' => $date_entered,
            'prep_id' => $prep_id,
            'location_id' => $location_id,
            'supplier_name' => $supplier_name ?: NULL,
            'invoice_no' => $invoice_no ?: NULL,
            'temp' => $temp ?: NULL,
            'comments' => $comments ?: NULL,
            'received_by' => $received_by ?: NULL,
            'signature' => $signature ?: NULL,
            'entered_by' => $entered_by ?: NULL
        );
        
        // Insert new record
        $insert_id = $this->common_model->commonRecordCreate('Compliance_IncomingGoods_history', $data);
        if ($insert_id) {
            $response = array('status' => 'success', 'message' => 'Record inserted successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to insert record');
        }
    }

    echo json_encode($response);
}

   
   
   // product add update etc..
   
     function listSuppliers(){
         $condition = array('status' => 1);
        $data['suplliers'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsproducts','',$condition);
        $data['site_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsSites','',$condition);
        $data['prep_detail'] = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsPrepArea','',$condition);
        
        // echo "<pre>"; print_r($data['products']); print_r($data['site_detail']);  print_r($data['prep_detail']); exit;
        $this->load->view('general/header');
        $this->load->view('Goods/listSuppliers', $data);
        $this->load->view('general/footer');
    }
    
   public function addOrUpdateProduct() {
        $id = $this->input->post('id');
  
       $data = [
         'supplier_name' => $this->input->post('supplier_name') ?? null,
          'prep_id'      => $this->input->post('prep_id') ?? null
        ];

        if ($id) {
            $this->common_model->commonRecordUpdate('Compliance_IncomingGoodsproducts','id',$id, $data);
        } else {
            $this->common_model->commonRecordCreate('Compliance_IncomingGoodsproducts',$data);
        }

       redirect('Compliance/Goods/home/listSuppliers');
    }
    
    public function getProductById($id) {
        $condition = array('id' => $id);
        $product = $this->common_model->fetchRecordsDynamically('Compliance_IncomingGoodsproducts','',$condition);
        echo json_encode($product);
    }
    
      public function delete(){
        $id = $this->input->post('id', TRUE);
         $this->common_model->softDeleteRecord('Compliance_IncomingGoodsproducts', 'id', $id);
         echo "success";
       
        
    }
    
	
}