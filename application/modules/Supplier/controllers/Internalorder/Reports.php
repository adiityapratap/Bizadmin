<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('internalorder_model');
        $this->load->model('common_model');
    }

    public function index() {
     
         $data['products'] = $this->internalorder_model->fetchProductsSubLocationWise();
	    $data['locations'] = $this->internalorder_model->fetchLocations($this->location_id,'location_id,name','notIsKitchen');
	    $conditions = array('is_deleted'=>'0');
        $data['categories'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditions);
//  echo "<pre>"; print_r($data['products']); exit;
        $this->load->view('general/header');
    $this->load->view('Internalorder/reports', $data);
    $this->load->view('general/footer');
    }

   public function filter() {
    $from_delivery_date = $this->input->post('from_delivery_date');
    $to_delivery_date = $this->input->post('to_delivery_date');
    $product_ids = $this->input->post('product_ids');
    $location_ids = $this->input->post('location_ids');

        // Fetch filtered data
       $result =  $this->internalorder_model->getFilteredOrders($from_delivery_date, $to_delivery_date, $product_ids, $location_ids);
         
        $data['orders'] =$result['filteredData'];
         $data['totalPrice'] =$result['totalPrice'];
          $data['totalOrderQty'] =$result['totalOrderQty'];
          
        $data['products'] = $this->internalorder_model->fetchProductsSubLocationWise();
	    $data['locations'] = $this->internalorder_model->fetchLocations($this->location_id,'location_id,name','notIsKitchen');
	    $conditions = array('is_deleted'=>'0');
        $data['categories'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditions);
        
        
       
        $data['from_date'] = $from_delivery_date;
        $data['to_date'] = $to_delivery_date;
        $data['selected_product_ids'] = $product_ids;
        $data['selected_location_ids'] = $location_ids;

     $this->load->view('general/header');
    $this->load->view('Internalorder/reports', $data);
    $this->load->view('general/footer');
}

}
