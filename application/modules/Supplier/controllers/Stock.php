<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('stock_model');
		$this->load->model('admin_model');
		$this->load->model('supplier_model');
	   $this->location_id = $this->session->userdata('location_id');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	}
	
	 public function index($suppId='')
     {   
        $result = $this->supplier_model->getSuppliers('','',0);
        $data['suppliers_list'] = $result;
        $data['areaList'] = $this->admin_model->fetchArea($this->location_id);
        $data['product_UOM'] = $this->supplier_model->fetchUOM($this->location_id);
        $data['suppId'] = $suppId;
      
      	$this->load->view('general/header');
      	$this->load->view('Stock/stockAdd',$data);
      	$this->load->view('general/footer');
    }
    
    public function monthlystockCount($suppId='')
     {   
        $result = $this->supplier_model->getSuppliers('','',1);
        $data['suppliers_list'] = $result;
        $data['areaList'] = $this->admin_model->fetchArea($this->location_id);
        $data['product_UOM'] = $this->supplier_model->fetchUOM($this->location_id);
        $data['suppId'] = $suppId;
      
      	$this->load->view('general/header');
      	$this->load->view('Stock/monthlyStockAdd',$data);
      	$this->load->view('general/footer');
    }
    
      public function monthlystockUpdate(){
        if (strpos($this->input->post('supplier_id'), '_') !== false) {
         list($supplier_id, $isPARLevelRequired) = explode('_', $this->input->post('supplier_id'));
        }else{
            $supplier_id = $this->input->post('supplier_id');
        }
      
         $data['supplier_id'] =  $supplier_id;
         $data['month_name'] =  date('F');
         $data['year_name'] =  date('Y');
         $data['location_id'] =  $this->location_id;
         $data['created_at'] =   date('Y-m-d');
         $suppdata['is_completed']  = $this->input->post('is_completed');
         $allProductsPosted = $this->input->post('product_id');
         $opening_stock_count = $this->input->post('opening_stock_count');
         $purchase_units = $this->input->post('purchase_units');
         $closingStockCount = $this->input->post('closing_stock_count');
         $units_sold = $this->input->post('units_sold');
         $data['isTopFive'] = $this->input->post('status');
         $this->supplier_model->supplierCommonUPdate($supplier_id,$suppdata);
         foreach($allProductsPosted as $index => $productId){
             $data['opening_stock_count']  =  $opening_stock_count[$index];
             $data['purchase_units']       =  $purchase_units[$index];
             $data['closing_stock_count']  =  $closingStockCount[$index];
             $data['units_sold']  = $units_sold[$index];
             $data['product_id']  = $productId; 
             $this->stock_model->updateMonthlystockUpdate($data,$productId);
            // update prdctbuiltohere
        }
        
         
      }
    public function updateStock(){
        if (strpos($this->input->post('supplier_id'), '_') !== false) {
         list($supplier_id, $isPARLevelRequired) = explode('_', $this->input->post('supplier_id'));
        }else{
            $supplier_id = $this->input->post('supplier_id');
        }
         $data['supplier_id'] =  $supplier_id;
         $data['is_completed'] = $this->input->post('is_completed');
         $data['location_id'] =  $this->location_id;
         $data['created_at'] =   date('Y-m-d');
        //  echo "<pre>"; print_r($data); exit;
         
         $allProductsPosted = $this->input->post('product_id');
         $cafe_unit_uomCount = $this->input->post('cafe_unit_uomCount');
         $inner_unit_uomCount = $this->input->post('inner_unit_uomCount');
         $orderQtyValue = $this->input->post('orderQtyValue');
         $totalStockCountTotalValue = $this->input->post('totalStockCountTotalValue');
       
        
    // this is to get count entered for specific/All products for all areas,we are extracting all index from post wch is like productid_area_id 44_1 ... etc
         foreach ($this->input->post() as $key => $value) {
          if (preg_match('/^\d+_\d+$/', $key)) {
             $extractedData[$key] = $value;
             }
           }
    
           $Details = array();
           $dataDetails = array();
           
        foreach($allProductsPosted as $index => $productId){
             $Details['cafe_unit_uomCount']  =  $cafe_unit_uomCount[$index];
             $Details['inner_unit_uomCount'] = $inner_unit_uomCount[$index];
             $Details['orderQty']            = $orderQtyValue[$index];
             $Details['totalStockCountTotalValue']  = $totalStockCountTotalValue[$index];
             $this->stock_model->updateStock($Details,$productId);
            // update prdctbuiltohere
        }
         
        foreach($extractedData as $indexx => $extractedAreaData){
              $prdctAreaId = explode("_",$indexx);
              if(is_array($prdctAreaId)){
                  $dataDetails['product_id'] =  $prdctAreaId[0];
                  $dataDetails['supplier_id'] = $supplier_id;
                  $dataDetails['area_id'] =     $prdctAreaId[1];
                  $dataDetails['area_count'] =  $this->input->post($indexx);
                  $this->stock_model->insertstockDetails($dataDetails);
              }
           }
           
           $query = "UPDATE `SUPPLIERS_suppliersList` SET `is_completed` = '".$data['is_completed']."' WHERE supplier_id = ".$supplier_id;
           $query=$this->tenantDb->query($query);
         echo "success";
    }
    
	
}