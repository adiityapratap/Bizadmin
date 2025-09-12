<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Placeorder extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('internalorder_model');
	   $this->load->model('supplier_model');
	   $this->load->model('common_model');
	   $this->location_id = $this->session->userdata('location_id');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	   $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	}
	
	
	function placeOrderInternal($id=''){

         $conditionsSub = array('is_kitchen'=> 0,'location_id' => $this->location_id,'is_deleted' => 0,'status' => 1); $colsToFetchSub = array('id,name');
         $data['locationList'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub, $conditionsSub);
         $data['productList'] = $this->internalorder_model->fetchProducts();
         $data['productCountData'] = $this->internalorder_model->fetchProductCountData();
         $data['selectedSubLoc'] = $id;
         $conditions = array('is_kitchen'=> 1,'location_id' => $this->location_id); $colsToFetch = array('email');
         $data['subLocationData'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetch, $conditions);
        //  echo "<pre>";print_r($data['subLocationData']);exit;
        $conditionscat = array('is_deleted'=>'0');
        $data['categoryLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditionscat);
        $data['uomLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', array('product_UOM_id','product_UOM_name'), $conditionscat);
        $data['form_type'] = 'add';
        $this->load->view('general/header');
      	$this->load->view('Internalorder/placeOrder',$data);
      	$this->load->view('general/footer');  
        
    }
    function validateOrderIfAlreadyPlacedToday(){
        $deliveryDate = date('Y-m-d',strtotime($_POST['deliveryDate']));
      $conditions = array('delivery_date'=> $deliveryDate,'sublocation_id' => $_POST['selectedSubLocationId'],'location_id' => $this->location_id,'is_deleted' => 0);
            $colsToFetch = array('id');
            $orderCheckData = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderPlacedOrders', $colsToFetch, $conditions);
            if(isset($orderCheckData) && !empty($orderCheckData)){
             echo "Order for this sublocation has been already placed today, please update quantity if needed"; 
             exit;
            }else{
           echo "success"; exit;
            }  
    }
    function saveInternalOrder(){
            
            
            $placeOrderProducts = array();
           
            $orderData['delivery_date'] = (isset($_POST['delivery_date']) ? date('Y-m-d',strtotime($_POST['delivery_date'])) : '');
             $orderData['email'] = (isset($_POST['email']) ? $_POST['email'] : '');
             $orderData['cc_email'] = (isset($_POST['ccemail']) ? $_POST['ccemail'] : '');
             $orderData['comments'] = (isset($_POST['comments']) ? $_POST['comments'] : '');
             $orderData['sublocation_id'] = $_POST['selectedSubLocationId'];
             $orderData['location_id'] = $this->session->userdata('location_id');
             $orderData['date_added'] = date('Y-m-d');
             $orderId = $this->internalorder_model->placeOrder($orderData);
             $selectedSubLocationId = $_POST['selectedSubLocationId'];
        // order will be placed one sub location at a time
        $orderTotal = 0;
        $totProduct =0;
         foreach ($_POST['productID'] as $key => $orderProducts) {
              $locationAndProductID = explode('_', $orderProducts);
            //   echo "sublocId==".$locationAndProductID[1]."</br>"; 
            //   echo "QTY = ".$_POST['qtyToMake'][$key];
         if((isset($locationAndProductID[1]) &&  $locationAndProductID[1] == $selectedSubLocationId)){
           if((isset($_POST['qtyToMake'][$key]) && $_POST['qtyToMake'][$key] > 0)){
            $productID = (isset($locationAndProductID[0]) ? $locationAndProductID[0] : '');
            $productPrice = (isset($locationAndProductID[2]) ? $locationAndProductID[2] : '');
            $rowUpdateData = array(
                'order_id' => $orderId,
                'product_id' => $productID,
                 'price' => $productPrice,
                'orderQty' => $_POST['qtyToMake'][$key]
                );
             $placeOrderProducts[] = $rowUpdateData;
             $totProduct = $productPrice * $_POST['qtyToMake'][$key];
             $orderTotal = $orderTotal+ $totProduct;
             }
             $orderTotalUpdate['order_total'] = $orderTotal;
             $this->common_model->commonRecordUpdate('SUPPLIERS_internalOrderPlacedOrders','id',$orderId,$orderTotalUpdate);
             
          // complete Product Count feature here =====================================================================
          
           if(isset($locationAndProductID[0]) && isset($locationAndProductID[1])){
          $existingProductCountData =   $this->internalorder_model->fetchProductCountData($locationAndProductID[0],$locationAndProductID[1]); 
            }
            
            if(isset($existingProductCountData) && !empty($existingProductCountData)){
          $rowUpdateData = array(
          'id' => $existingProductCountData[0]['id'],
          'dailtQtyNeed' => '',
          'qtyToMake' => '',
        //   'dailtQtyNeed' => (isset($_POST['dailtQtyNeed'][$key]) && $_POST['dailtQtyNeed'][$key] !='' ? $_POST['dailtQtyNeed'][$key] : NULL),
        //   'qtyToMake' => (isset($_POST['qtyToMake'][$key]) && $_POST['qtyToMake'][$key] !='' ? $_POST['qtyToMake'][$key] : NULL),
        );  
          $dataToUpdate[] = $rowUpdateData;    
          if(isset($_POST['email']) && $_POST['email'] !=''){
            // Means product count is completed
         $dataLocation['last_countedAt'] = date('Y-m-d');
         $this->internalorder_model->updateLocation($locationAndProductID[1],$dataLocation);
        }
        }else{
          $rowData = array(
          'product_id' => isset($locationAndProductID[0]) ? $locationAndProductID[0] : null,
          'sublocation_id' => isset($locationAndProductID[1]) ? $locationAndProductID[1] : null,
          'dailtQtyNeed' => '',
          'qtyToMake' => '',
        //   'dailtQtyNeed' => (isset($_POST['dailtQtyNeed'][$key]) && $_POST['dailtQtyNeed'][$key] !='' ? $_POST['dailtQtyNeed'][$key] : NULL),
        //   'qtyToMake' => (isset($_POST['qtyToMake'][$key]) && $_POST['qtyToMake'][$key] !='' ? $_POST['qtyToMake'][$key] : NULL),
          'location_id' => $this->location_id,
          'date_completed' => date('y-m-d')
        );
        $dataToInsert[] = $rowData;
      
        if(isset($_POST['email']) && $_POST['email'] !=''){
            // Means product count is completed
         $dataLocation['last_countedAt'] = date('Y-m-d');
         $this->internalorder_model->updateLocation($locationAndProductID[1],$dataLocation);
        }
    
        }
             
         }    
         // END PRODUCT COUNT PROCESS =========================================================================================================    
             
        }
        // echo "<pre>"; print_r($placeOrderProducts); exit;
        if(!empty($placeOrderProducts)){
        $this->internalorder_model->placeOrderInsertproducts($placeOrderProducts);    
        }
        
        if(!empty($dataToInsert)){
        $this->internalorder_model->insertProductCountBatch($dataToInsert);
        }
       if(!empty($dataToUpdate)){
         $this->internalorder_model->updateProductCountBatch($dataToUpdate); 
       }
       
        // fetch sublocation Name from sublocation Id
        $where = 'id = '.$_POST['selectedSubLocationId'];
        $subLocationResult = $this->internalorder_model->fetchLocations($this->location_id,'name','','',$where);
    if(isset($_POST['email']) && $_POST['email'] !=''){
    $mailData['subLocationName'] = (isset($subLocationResult[0]['name']) ? $subLocationResult[0]['name'] : '');
    $mailContent = $this->load->view('Mail/placeInternalOrder',$mailData,TRUE);
    $this->sendEmail($_POST['email'],'New Order Received',$mailContent,$this->session->userdata('mail_from'),(isset($_POST['ccemail']) && $_POST['ccemail'] !='' ? $_POST['ccemail'] : ''),$this->session->userdata('username'));        
    }     
        return redirect(base_url('/Supplier/'.$this->session->userdata('system_id')));
        
        
    }
    

function makeOrderInternal(){
      $internalOrder = array();
 
      $colsToFetch= array('id' ,'name');
      $conditionsP = array('is_kitchen' => 0,'is_deleted' => 0 ,'status' => 1);
      $allInternalOrdersSubLocations = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetch, $conditionsP);
      $data['allInternalOrdersSubLocations'] =  $allInternalOrdersSubLocations;
     
      $colsToFetch='sio.id as order_id,sip.category_id,sio.delivery_date,siop.is_qtyUpdated,siop.id as order_product_id,siop.product_id,siop.date_completed,siop.foodTemp,sio.sublocation_id,siop.orderQty,sip.uom,sip.name as product_name,sip.requireAttach,sip.requireTemp, sil.name as sublocName';
      $where = "sio.delivery_date ='".date('Y-m-d')."' AND sio.is_deleted = 0";
      $internalOrders = $this->internalorder_model->fetchInternalOrder($colsToFetch,$where);  
      $conditionscat = array('is_deleted' => 0);
      $data['uomLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', array('product_UOM_id','product_UOM_name'), $conditionscat);
      
      $conditionscat = array('is_deleted'=>'0');
      $data['categoryLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditionscat);
        
      $data['allInternalOrders'] = $internalOrders;
    //   echo "<pre>"; print_r($data['allInternalOrders']); exit;
       $this->load->view('general/header');
      $this->load->view('Internalorder/makeOrder',$data);
      $this->load->view('general/footer'); 
      
    }
    
    function markCompleted(){
       $orderId = $_POST['orderId'];
       $productId = $_POST['productId'];
      
       $data['date_completed'] = date('Y-m-d');
       $data['foodTemp'] = $_POST['foodTemp'];
       $this->internalorder_model->updateOrderProduct($orderId,$productId,$data);
    }
    
    function markdelivered(){
       $subLocId = $_POST['subLocId'];
       $data['last_deliveryDate'] = date('Y-m-d');
       $this->common_model->commonRecordUpdate('SUPPLIERS_internalOrderLocations','id',$subLocId,$data); 
       $wherefields = array('sublocation_id' => $subLocId , 'delivery_date' => date('y-m-d'));
       $dataOrder['temp'] = $_POST['temp'];
       $dataOrder['driversComment'] = $_POST['driversComment'];
       $this->common_model->commonRecordUpdateMultipleConditions('SUPPLIERS_internalOrderPlacedOrders',$wherefields,$dataOrder);
 
    }
    
public function uploadOrderAttachment()
{        
    $orzName = $this->tenantIdentifier; 
    $config['upload_path'] = './uploaded_files/'.$orzName.'/Supplier/InternalOrderAttachments/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; // Add allowed file types
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 8048; // Maximum file size in KB (2MB)

    $this->load->library('upload', $config);

    $uploaded_files = [];


      // Count total files
      $countfiles = count($_FILES['userfile']['name']);
 
      // Looping all files
      for($i=0;$i<$countfiles;$i++){
 
        if(!empty($_FILES['userfile']['name'][$i])){
 
          // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['userfile']['name'][$i];
          $_FILES['file']['type'] = $_FILES['userfile']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['userfile']['error'][$i];
          $_FILES['file']['size'] = $_FILES['userfile']['size'][$i];

          // Set preference
          $config['upload_path'] = './uploaded_files/'.$orzName.'/Supplier/InternalOrderAttachments/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];
 
          //Load upload library
          $this->load->library('upload',$config); 
 
    
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
          
            // Initialize array
            $uploaded_files[$i] = $filename;
          }
        }
      }

    $data = array(
	'attachment'=> serialize($uploaded_files),
	'orderProductComments'=> (isset($_POST['orderAttachmentComments']) ? $_POST['orderAttachmentComments'] :'')
	);
	
   $wherefields = array('sublocation_id' => $_POST['subLocationId'] , 'delivery_date' => date('Y-m-d'));
   
   $this->common_model->commonRecordUpdateMultipleConditions('SUPPLIERS_internalOrderPlacedOrders',$wherefields,$data);    
   // Return a response with information about the uploaded files
    echo "Uploaded Files: " . implode(', ', $uploaded_files);
}
	
}