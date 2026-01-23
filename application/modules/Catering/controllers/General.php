<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('genric_model');
		$this->load->model('orders_model');
		$this->load->model('common_model');
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	    $this->selected_location_id = $this->session->userdata('location_id');
	}
	

   public function dashboard($system_id=''){
       
       
       (isset($system_id) && $system_id !=''  ? $this->session->set_userdata('system_id',$system_id) : '');
       
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
       
       
         
      $user = $this->ion_auth->user()->row();
      $current_hour = date('H');
  
    
        if ($current_hour < 12) {
            $greeting = "Good Morning";
        } elseif ($current_hour < 18) {
            $greeting = "Good Afternoon";
        } else {
            $greeting = "Good Evening";
        }
        $data['greeting'] = $greeting;
        $data['username'] = $user->first_name;
        
        $orderFields = 'Catering_orders.order_id,Catering_orders.delivery_date,Catering_orders.delivery_time,Catering_orders.status,Catering_orders.is_completed';
        
        // fetch today's order
       $where = array('Catering_orders.delivery_date' => date('Y-m-d'),'Catering_orders.status !=' => 0,'is_quote' => 0);
       $data['todaysOrder'] = $this->orders_model->fetchOrders($where,$orderFields,'order_by_delivery_time'); 
       
       // tomm order
       $tomorrow = date('Y-m-d', strtotime('+1 day'));
       $where = array('Catering_orders.delivery_date' => $tomorrow,'Catering_orders.status !=' => 0,'is_quote' => 0);
       $data['tommorowsorders'] = $this->orders_model->fetchOrders($where,$orderFields);
      
       // delivery within next seven days
       $where = array( 'Catering_orders.delivery_date >' => date('Y-m-d'),'Catering_orders.delivery_date <=' => date('Y-m-d', strtotime('+7 days')),'Catering_orders.status !=' => 0,'is_quote' => 0);
       $data['weekorders'] = $this->orders_model->fetchOrders($where,$orderFields);
       
       
       $where = array('status' => 4,'is_quote' => 1);
       $totalPendingQuotes = $this->common_model->fetchRecordsDynamically('Catering_orders',['count(order_id) as totalPendingQuotes'],$where); 
       $data['totalPendingQuotes'] = reset($totalPendingQuotes);
       
       $where = array( 'Catering_orders.delivery_date >=' => date('Y-m-d'),'Catering_orders.status !=' => 0,'is_quote' => 0);
       $totalFutureOrders = $this->common_model->fetchRecordsDynamically('Catering_orders',['count(order_id) as totalFutureOrders'],$where); 
       $data['totalFutureOrders'] = reset($totalFutureOrders);
      
       $this->load->view('general/header');
       $this->load->view('general/dashboard',$data);
       $this->load->view('general/footer');
       
   }
   
   function settings(){
       
       $data['locations'] = $this->common_model->fetchRecordsDynamically('Catering_locations'); 
       
      if(isset($_POST) && !empty($_POST)){
     
      $where = array('location_id' => $this->selected_location_id);
      $resultSettings = $this->common_model->fetchRecordsDynamically('Catering_settings',['id'],$where);  
     
     if(isset($resultSettings) && !empty($resultSettings)){
      unset($_POST['setting_id']);
     $this->common_model->commonRecordUpdate('Catering_settings','location_id',$this->selected_location_id,$_POST);
     }else{
         unset($_POST['setting_id']);
    
     $this->common_model->commonRecordCreate('Catering_settings', $_POST);    
     } 
     echo "Success"; exit;
     }else{
         
      $data['settingsData'] = $this->common_model->fetchRecordsDynamically('Catering_settings');      
           
       }
    //   echo "<pre>"; print_r($data['locations']); exit;
       $this->load->view('general/header');
       $this->load->view('general/settings',$data); 
       $this->load->view('general/footer');
   }
   
   public function save_locations() {
    $locationIds = $this->input->post('location_id');
    $locationNames = $this->input->post('location_name');
    $deletedLocationIds = $this->input->post('deleted_location_ids');

    // Handle deletions
    if (!empty($deletedLocationIds)) {
        $ids = explode(',', rtrim($deletedLocationIds, ','));
        foreach ($ids as $id) {
            $this->common_model->commonRecordDelete('Catering_locations', 'location_id', $id);
        }
    }

    // Handle insertions and updates
    $data = [];
    for ($i = 0; $i < count($locationNames); $i++) {
        if (!empty($locationIds[$i])) {
            // Update existing location
            $data[] = [
                'location_id' => $locationIds[$i],
                'location_name' => $locationNames[$i]
            ];
        } else {
            // Insert new location
            $data[] = [
                'location_name' => $locationNames[$i]
            ];
        }
    }

    foreach ($data as $location) {
        if (isset($location['location_id'])) {
            // Update existing location
            $where = array('location_id' => $location['location_id']);
            unset($location['location_id']);
            $this->common_model->commonRecordUpdate('Catering_locations', 'location_id',$location['location_id'],$location);
        } else {
            // Insert new location
            $this->common_model->commonRecordCreate('Catering_locations', $location);
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Locations saved successfully']);
}

   public function fetchSettingsLocationWise() {
   

   
        $this->db->select('id,remittance_email, account_name, account_number, contact_number, abn, company_name, bsb,pickup_address');
        $this->db->from('Catering_settings');
        $this->db->where('location_id', $this->selected_location_id);
        $query = $this->db->get();

        if ($query) {
            $result = $query->row_array();
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Query failed']);
        }
    
}

   function deleteRecord(){
    $tableName = $this->input->post('table');
    $column = $this->input->post('column');
    $columnValue = $this->input->post('id');
    
    // in case of soft delete , just change the status from 1 to 0 else delete permanently
    if(isset($_POST['deleteType']) && $_POST['deleteType'] == 'hard_delete'){
    $this->common_model->commonRecordDelete($tableName, $column, $columnValue);   
    }else{
    $this->common_model->softDeleteRecord($tableName, $column, $columnValue);      
    }
     
      echo "success";
   }
   
    function commonUpdaterecord(){
    $tableName = $this->input->post('table');
    $column = $this->input->post('column');
    $columnValue = $this->input->post('columnValue');
    $columnToUpdate = $this->input->post('columnToUpdate');
    $columnValueToUpdate = $this->input->post('columnValueToUpdate');
    
    $data[$columnToUpdate]  = $columnValueToUpdate;
    $where = array($column => $columnValue);
    
    $this->common_model->update_record('Catering_'.$tableName, $column,$columnValue,$data);
      echo "success";
   }
   
  
   
   


    
    

}