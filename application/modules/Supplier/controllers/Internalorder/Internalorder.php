<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internalorder extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('internalorder_model');
	   $this->load->model('supplier_model');
	   $this->load->model('common_model');
	   $this->location_id = $this->session->userdata('location_id');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	   $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	}
	
	public function locationList(){
	   
	    $data['locationList'] = $this->internalorder_model->fetchLocations($this->location_id);
	   
	    $data['mainLocationList'] = fetchLocationNamesFromIds($this->session->userdata('User_location_ids'));
	    $this->load->view('general/header');
      	$this->load->view('Internalorder/locationList',$data);
      	$this->load->view('general/footer');
	}
	
	 public function manageSubLocation($type=""){
        
         if($type == 'edit'){
         $id = $_POST['id'];
         $result = $this->internalorder_model->updateLocation($id,$_POST);
          echo "success";
        }else if($type == 'add'){
          $result = $this->internalorder_model->addLocation($_POST);
                echo "success";
        }
    }
    public function sublocationStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status=='delete'){
         $data = array( 'is_deleted' => 1 ,'status' => 0);   
        }else{
         $data = array( 'status' => $status  );   
        }
        
        $result = $this->internalorder_model->locationStatus($id,$data);
    }
    
    function orderHistory(){
    //  check if current location is a kitchen(is_production) if yes than show all sublocation    
     $conditionsSub = array('is_kitchen'=> 1,'location_id' => $this->location_id,'is_deleted' => 0,'status' => 1); $colsToFetchSub = array('id');
     $isProduction = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub, $conditionsSub);
     if(isset($isProduction) && !empty($isProduction)){
     $conditionsP = array('is_kitchen' => 0,'is_deleted' => 0 ,'status' => 1); $colsToFetchSub = array('id,name');
     $locationLists = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub, $conditionsP);    
     }else{
     $conditionsSub = array('is_kitchen'=> 0,'location_id' => $this->location_id,'is_deleted' => 0,'status' => 1); $colsToFetchSub = array('id,name');
     $locationLists = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub, $conditionsSub);      
     }
   
     
     $orderData = array();
     foreach($locationLists as $locationList){
     $conditions = array('sublocation_id' => $locationList['id'],'is_deleted' => 0);
     if(isset($_POST['date_from']) && $_POST['date_from'] !='' && isset($_POST['date_to']) && $_POST['date_to'] !=''){
     $internalOrder = $this->internalorder_model->filterOrder($_POST['date_from'],$_POST['date_to'],$_POST['sublocationId']); 
     }else{
     $internalOrder = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderPlacedOrders','',$conditions);     
     }
     
     
     $orderData[$locationList['id'].'_'.$locationList['name']] = $internalOrder;
     }
    //  echo "<pre>"; print_r($orderData); exit;
     $data['orders'] =  $orderData;
     $data['locationLists'] =  $locationLists; 
     $this->load->view('general/header');
     $this->load->view('Internalorder/orderHistory',$data);
     $this->load->view('general/footer');
    }
    
    function editInternalOrder($orderId,$subLocationName){
     $conditions = array('id' => $orderId);
     $conditionsProducts = array('order_id' => $orderId);
     $data['subLocationName'] =  urldecode($subLocationName);
     $data['order_id'] = $orderId;
     $data['internalOrderData'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderPlacedOrders','',$conditions); 
     $data['internalOrderProducts'] = $this->internalorder_model->fetchOrderProducts($orderId);
      $conditionsUOM = array('is_deleted'=>'0');
     $data['uomLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', array('product_UOM_id','product_UOM_name'), $conditionsUOM);
    //  echo "<pre>"; print_r($data['internalOrderData']); exit;
     $this->load->view('general/header');
     $this->load->view('Internalorder/viewEditOrder',$data);
     $this->load->view('general/footer');
    }
    
    function updateInternalOrder(){
       $orderTotal = 0;
       $currentTotal = 0;
       $orderId = $_POST['order_id'];
       
         foreach ($_POST['productID'] as $key => $orderProducts) {
          $priceAndProductID = explode('_', $orderProducts);

           if((isset($_POST['qtyToMake'][$key]) && $_POST['qtyToMake'][$key] > 0)){
            $orderproductID = (isset($priceAndProductID[0]) ? $priceAndProductID[0] : '');
            $productPrice = (isset($priceAndProductID[1]) ? $priceAndProductID[1] : '');
            $rowUpdateData = array(
                'order_id' => $orderId,
                 'is_qtyUpdated' => 1,
                 'price' => $productPrice,
                'orderQty' => $_POST['qtyToMake'][$key]
                );
             $currentTotal =     $productPrice * $_POST['qtyToMake'][$key];
             $orderTotal = $orderTotal + $currentTotal;
             $this->common_model->commonRecordUpdate('SUPPLIERS_internalOrderPlacedOrdersProducts','id',$orderproductID,$rowUpdateData);
             }
          } 
             $orderTotalUpdate['order_total'] = $orderTotal;
             $orderTotalUpdate['delivery_date'] = date('Y-m-d',strtotime($_POST['delivery_date']));
             $this->common_model->commonRecordUpdate('SUPPLIERS_internalOrderPlacedOrders','id',$orderId,$orderTotalUpdate);          
         return redirect(base_url('/Supplier/internalorder/history'));
    }
    
  function deleteOrder(){
      $orderId = $_POST['id'];
      $rowUpdateData['is_deleted'] = 1;
   $this->common_model->commonRecordUpdate('SUPPLIERS_internalOrderPlacedOrders','id',$orderId,$rowUpdateData); 
   echo "success";
  }  


	
}

?>