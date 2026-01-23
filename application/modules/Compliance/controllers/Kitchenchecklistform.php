<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitchenchecklistform extends MY_Controller {
    public function __construct() {
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        parent::__construct();
        $this->load->model('common_model');
        $this->selected_location_id = $this->session->userdata('location_id');
	   $this->system_id = $this->session->userdata('system_id');
	   $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
    }

    public function index() {
        
        
           $data['records'] = $this->common_model->fetchRecordsDynamically('Compliance_kitchen_production_record', 
            ['id', 'date', 'product_name', 'internal_batch_code_allocated', 
             'start_slicing', 'time_finished_slicing', 'temp_of_product_at_end_of_slicing', 
             'time_chilling_process_started', 'time_chilling_process_finished', 
             'temp_of_product_at_end_of_chilling', 'comments', 'name', 'signature'],
            ['is_deleted' => 0,'location_id' => $this->selected_location_id],
            'date DESC'
        );
            $this->load->view('general/header');
            $this->load->view('forms/kitchenchecklistform', $data);
            $this->load->view('general/footer');
        
    }

  
    
    
    public function save_record() {
        
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        $data = $this->input->post();
$data['date'] = date('Y-m-d', strtotime($data['date'])); 

// Prepare the record data to match the table structure
$record = [
    'date' => $data['date'],  
    'product_name' => $data['product_name'], 
    'internal_batch_code_allocated' => $data['internal_batch_code_allocated'],  
    'start_slicing' => $data['start_slicing'],  
    'time_finished_slicing' => $data['time_finished_slicing'],
    'temp_of_product_at_end_of_slicing' => $data['temp_of_product_at_end_of_slicing'],  
    'time_chilling_process_started' => $data['time_chilling_process_started'],  
    'time_chilling_process_finished' => $data['time_chilling_process_finished'], 
    'temp_of_product_at_end_of_chilling' => $data['temp_of_product_at_end_of_chilling'], 
    'name' => $data['name'], 
    'location_id' => $this->selected_location_id,  
    'signature' => $data['signature'],  
    'created_at' => date('Y-m-d H:i:s'),  
    'updated_at' => date('Y-m-d H:i:s') 
];

// Insert the record into the database
$this->common_model->commonRecordCreate('Compliance_kitchen_production_record', $record);

// Redirect after insertion
redirect('Compliance/Kitchenchecklistform');

    }
    
}