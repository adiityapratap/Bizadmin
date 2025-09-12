<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('stock_model');
		$this->load->model('admin_model');
		$this->load->model('order_model');
		$this->load->model('common_model');
		$this->load->model('budget_model');
		$this->load->model('supplier_model');
		$this->load->model('config_model');
	    $this->location_id = $this->session->userdata('location_id');
	    $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	    !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	   
		
	}
	
	public function index($suppId='')
    {  
         $result = $this->supplier_model->getSuppliers();
         if (strpos($suppId, '_') !== false) {
          list($supplierId, $part2,$isMonthlyStockOrder) = explode('_', $suppId);
          }else{
           if(isset($result) && !empty($result)){
          $supplierId = $result[0]['supplier_id']; 
         
           }else{
               echo "No Supplier Added,Please add supplier to place order."; exit;
           }
           
          }
        //   echo "<pre>"; print_r($result); exit;
         $selectedSupDetails = $this->supplier_model->getSuppliers($supplierId);
         
         $isMonthlyStockOrder = (isset($selectedSupDetails[0]['requireMST']) ? $selectedSupDetails[0]['requireMST'] : 0);
         
         // first check if stock count is required for this suuplier or not
         if($selectedSupDetails[0]['requireSC']){
            //  than check if stock count is completed or not
             if(isset($selectedSupDetails[0]['is_completed'])){
                $isStockCountCompleted = 1; 
             }else{
                 $isStockCountCompleted = 0;
             }
         }else{
             $isStockCountCompleted = '';
         }
        //  $isStockCountCompleted = (isset($selectedSupDetails[0]['is_completed']) ? $selectedSupDetails[0]['is_completed'] : '');
         if ($_SERVER['REMOTE_ADDR'] == '223.236.158.187') {
    // Perform print action or any IP-specific logic
    // echo "<pre>"; print_r($selectedSupDetails);
  } 

        // echo "<pre>"; print_r($selectedSupDetails); exit;
         $budgetUsedBySuppInCurrentWeek = $this->budget_model->getSuppliersUsedBudget($supplierId,$selectedSupDetails[0]['budget_type']);
            //  echo "<pre>"; echo $budgetUsedBySuppInCurrentWeek; print_r($selectedSupDetails); exit;
       
        $data['suppliers_list'] = $result;
        if($selectedSupDetails[0]['budget_type'] =='weekly'){
        $data['budgetRemaining'] =  (isset($selectedSupDetails[0]['weekly_budget']) ? $selectedSupDetails[0]['weekly_budget'] - $budgetUsedBySuppInCurrentWeek : 0);     
        $data['actualBudget'] =  (isset($selectedSupDetails[0]['weekly_budget']) ? $selectedSupDetails[0]['weekly_budget'] : 0); 
        }else{
        $data['budgetRemaining'] =  (isset($selectedSupDetails[0]['monthly_budget']) ? $selectedSupDetails[0]['monthly_budget'] - $budgetUsedBySuppInCurrentWeek : 0);    
        $data['actualBudget'] =  (isset($selectedSupDetails[0]['monthly_budget']) ? $selectedSupDetails[0]['monthly_budget'] : 0);
        }
        
        
        $data['allowForceOrder'] = (isset($selectedSupDetails[0]['allowForceOrder']) ? $selectedSupDetails[0]['allowForceOrder'] : 0);
        $data['isMonthlyStockOrder'] = $isMonthlyStockOrder;
        $data['isStockCountCompleted'] = $isStockCountCompleted;
        
       
        $data['selectedSupDetails'] = $selectedSupDetails;
        $data['areaList'] = $this->admin_model->fetchAreaWithSuppId($this->location_id); 
        $data['product_UOM'] = $this->supplier_model->fetchUOM($this->location_id);
        $data['suppId'] = $suppId;
      	$this->load->view('general/header');
      	$this->load->view('Orders/placeOrder',$data);
      	$this->load->view('general/footer');
    }
    
    public function editOrderDetails($supplierId,$orderId='')
    {  
        
         $result = $this->supplier_model->getSuppliers();
         $orderData = $this->order_model->getOrderInfo($orderId); 
         $orderItems = $this->order_model->getOrderItems($orderId); 
        //   echo "<pre>"; print_r($orderData); exit;
         $selectedSupDetails = $this->supplier_model->getSuppliers($supplierId);
       
       
         $budgetUsedBySuppInCurrentWeek = $this->budget_model->getSuppliersUsedBudget($supplierId,$selectedSupDetails[0]['budget_type']);
        
       
        $data['suppliers_list'] = $result;
        if($selectedSupDetails[0]['budget_type'] =='weekly'){
        $data['budgetRemaining'] =  (isset($selectedSupDetails[0]['weekly_budget']) ? $selectedSupDetails[0]['weekly_budget'] - $budgetUsedBySuppInCurrentWeek : 0);     
        $data['actualBudget'] =  (isset($selectedSupDetails[0]['weekly_budget']) ? $selectedSupDetails[0]['weekly_budget'] : 0); 
        }else{
        $data['budgetRemaining'] =  (isset($selectedSupDetails[0]['monthly_budget']) ? $selectedSupDetails[0]['monthly_budget'] - $budgetUsedBySuppInCurrentWeek : 0);    
        $data['actualBudget'] =  (isset($selectedSupDetails[0]['monthly_budget']) ? $selectedSupDetails[0]['monthly_budget'] : 0);
        }
        
        
        $data['allowForceOrder'] = (isset($selectedSupDetails[0]['allowForceOrder']) ? $selectedSupDetails[0]['allowForceOrder'] : 0);
       
        $data['selectedSupDetails'] = $selectedSupDetails;
      
        $data['product_UOM'] = $this->supplier_model->fetchUOM($this->location_id);
        $data['suppId'] = $supplierId;
        $data['order_id'] = $orderId;
        $data['orderData'] = $orderData;
        $data['orderItems'] = $orderItems;
      	$this->load->view('general/header');
      	$this->load->view('Orders/editOrder',$data);
      	$this->load->view('general/footer');
    }
    public function uploadInvoice($invoiceType='',$orderId=''){
    $config['upload_path'] = './uploaded_files/'.$this->tenantIdentifier.'/Supplier/Invoices/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; 
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 8048; 
    $config['file_name'] = $_FILES['file']['name'];

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
        }else{
            $filename = '';
        }
        
        	$data = array(
            $invoiceType => $filename
            );
       $this->order_model->orderCommonUpdate($orderId,$data);   
        return redirect(base_url('/Supplier/Orders/receiveOrder/'.$orderId));
          
    }
    
    function deleteInvoice(){
          $data = array(
            $this->input->post('invoiceType') => NULL
            );
        $this->order_model->orderCommonUpdate($this->input->post('order_id'),$data);
       $fileToDelete =  $this->input->post('fileName');
       $fileToDeleteCompletePath = './uploaded_files/'.$this->tenantIdentifier.'/Supplier/Invoices/'.$fileToDelete;
      
        if (file_exists($fileToDeleteCompletePath)) {
            unlink($fileToDeleteCompletePath);
         }
        exit;
    }
    
    function sendOrder($isOrderBudgetExceeded='no'){
      $allProducts = $this->input->post('product_id'); 

      $data['delivery_date'] = (isset($_POST['delivery_date']) && $_POST['delivery_date'] !='' ? date('Y-m-d',strtotime($_POST['delivery_date'])) : '');
      $data['supplier_id'] = $this->input->post('supplier_id');
      $data['supplier_email'] =$this->input->post('supplier_email');
      $data['order_comments'] =$this->input->post('order_comments');
      $data['delivery_info'] =$this->input->post('delivery_info');
      $data['supplier_email'] = $this->input->post('supplier_email');
      $data['supplier_CCemail'] = $this->input->post('supplier_CCemail');
      $data['subcategory_id'] =$this->input->post('subcategory_id');
      $data['order_total'] =$this->input->post('order_total');
      $data['location_id'] =$this->location_id;
      $data['status'] = ($isOrderBudgetExceeded=='no' ? 1 : 5);
      $data['location_name'] = $this->session->userdata('location_name');
     
      $data['date_created'] = date('Y-m-d');
      
      
      $order_id = $this->order_model->sendOrder($data); 
      $orderTotal = 0;
    //   echo "<pre>"; print_r($this->input->post()); exit;
      foreach($allProducts as $key=> $productId){
          $orderProductData['order_id'] = $order_id;
          $orderProductData['product_id'] = $productId;
          $orderProductData['product_unit_price'] = $this->input->post('product_unit_price')[$key];
          $orderProductData['qty'] = $this->input->post('orderQty_'.$productId);
          $orderProductData['total'] = $this->input->post('product_unit_price')[$key] * $this->input->post('orderQty_'.$productId);
          $orderTotal = $orderTotal + $orderProductData['total'];
          if($orderProductData['qty'] > 0){
         $this->order_model->insertOrderProduct($orderProductData);      
          }
          
      }
    //  echo "<pre>"; print_r($this->input->post()); exit; 
    // send Mail to supplier after succefull database insertion
     
     $supplierEmail = $this->input->post('supplier_email');
     $supplierId = $this->input->post('supplier_id');
     $supplier_CCemail = $this->input->post('supplier_CCemail');
     if($isOrderBudgetExceeded=='no'){
     $this->sendMailToSupplier($order_id,$supplierId,$supplierEmail,$supplier_CCemail);   
     }else{
         // seth the session to be used in another function while sending mail to manager
         $this->session->set_userdata('supplierEmail',$supplierEmail);
         $this->session->set_userdata('supplier_CCemail',$supplier_CCemail);
     }
     // After order is sent please update the remaing budget for this supplier and sub category both
     
      echo $order_id;
    
    }
    
    function updateOrder(){
       
        $order_id = $this->input->post('order_id');
        $this->order_model->deleteOrderProduct('',$order_id); 
        $allProducts = $this->input->post('product_id'); 
        $orderTotal = 0;
        foreach($allProducts as $key=> $productId){
          $orderProductData['order_id'] = $order_id;
          $orderProductData['product_id'] = $productId;
          $orderProductData['product_unit_price'] = $this->input->post('product_unit_price')[$key];
          $orderProductData['qty'] = $this->input->post('orderQty_'.$productId);
          $orderProductData['total'] = $this->input->post('product_unit_price')[$key] * $this->input->post('orderQty_'.$productId);
          $orderTotal = $orderTotal + $orderProductData['total'];
          if($orderProductData['qty'] > 0){
         $this->order_model->insertOrderProduct($orderProductData);      
          }
          
      }
      
        $data['delivery_date'] = (isset($_POST['delivery_date']) && $_POST['delivery_date'] !='' ? date('Y-m-d',strtotime($_POST['delivery_date'])) : '');
        $data['order_comments'] =$this->input->post('order_comments');
        $data['delivery_info'] = $this->input->post('delivery_info');
        $data['order_total'] = $orderTotal;
         $this->order_model->orderCommonUpdate($order_id,$data);
      echo "success";
        
    }
    
  // send mail to supplier wheh cafe manager/user... will place order
   function sendMailToSupplier($order_id,$supplierId,$supplierEmail,$supplier_CCemail='',$postMailAction=true){
     
     $ressSup = $this->supplier_model->getSuppliers($supplierId,'supplier_name');    
     $configurationData = $this->config_model->getConfiguration('settings');
     $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
     
     $paramsToEncrypt = $this->tenantIdentifier . '|' . $order_id.'|'.$postMailAction;
     
     $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
     $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
    //  $encodedParams = urlencode($encryptedParams);
     $data['orderUrl'] = base_url().'External/viewOrder/'.$encodedParams;
     $data['orzName'] = (isset($configData['orzName']) ? $configData['orzName'] : '');
     $data['locationName'] = $this->session->userdata('location_name');
     $data['cafeEmail'] = (isset($configData['email']) ? $configData['email'] : '');
     $data['cafeContactNumber'] = (isset($configData['phone']) ? $configData['phone'] : '');
     $reply_to = (isset($configData['reply_to']) ? $configData['reply_to'] : '');
     $data['supplierName'] = (isset($ressSup[0]['supplier_name']) ? $ressSup[0]['supplier_name'] : '');
     $data['orderId'] = $order_id;
     if($postMailAction){
         // this is when manager/staff places a new order
      $mailContent = $this->load->view('Mail/placeOrder',$data,TRUE); 
      $mailSubject = 'New Order Received - '.$order_id;
     }else{
     // this is when manager/staff receives order from delivery person
     $mailContent = $this->load->view('Mail/receiveOrder',$data,TRUE); 
     $mailSubject = 'Invoice for order';
     }
     
     
     $dataToUpdateForSupp['last_order_date'] = date('Y-m-d');
     $dataToUpdateForSupp['is_completed'] = 0;
       
     if($this->sendEmail($supplierEmail,$mailSubject,$mailContent,$this->session->userdata('mail_from'),$supplier_CCemail,$this->session->userdata('username'),'',$reply_to)){
      
      if($postMailAction){
          
       $this->supplier_model->supplierCommonUPdate($supplierId,$dataToUpdateForSupp); 
       // reset the stock count of this supplier to 0 once order is placed
       $this->stock_model->resetStockCount($supplierId);   
      }
           
     }
      
       
     return true;
   } 
    
	
    
    function completedOrder(){
        $whereConditionsAllOrders = array(
        'o.status' => array(1,2,3,5)
         );
       $data['result'] = $this->order_model->getOrders($whereConditionsAllOrders,'o.date_created'); 
       $whereConditions = array(
        'o.status' => array('4','7')
         );
        $data['receivedOrders'] = $this->order_model->getOrders($whereConditions,'o.delivery_date');
       	$this->load->view('general/header');
      	$this->load->view('Orders/completedOrder',$data);
      	$this->load->view('general/footer');
    //   echo "<pre>"; print_r($data['result']); exit;
    }
    
    function orderDelete(){
       $data['status'] = 0;
       $data['is_deleted'] = 1;
       $data['date_modified'] = date('Y-m-d');
       $order_id =  $this->input->post('order_id');
       $this->order_model->orderCommonUpdate($order_id,$data); 
    }
    
    // show the order details for manager to receive the order when delivery person delivers the orders , so manager can match if all items are there or not
    function receiveOrderDetails($orderId,$type=''){
       
        $orderData = $this->order_model->getOrderDetails($orderId); 
        $data['suppProducts'] = $this->supplier_model->fetchProducts('',$orderData[0]['supplier_id']); 
        $suppName = $this->supplier_model->getSuppliers($orderData[0]['supplier_id'],'supplier_name');
        //  echo "<pre>"; print_r($orderData); exit;
       $configurationData = $this->config_model->getConfiguration('settings');
       $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
            
        $data['orderData'] =$orderData;
        $data['orderId'] =$orderId;
        $data['configData'] =$configData;
        $data['tenantIdentifier'] =$this->tenantIdentifier;
        $data['supplierName'] =(isset($suppName[0]['supplier_name']) ? $suppName[0]['supplier_name'] : '');
        
        if($type=='view'){
        $this->load->view('general/header');
	    $this->load->view('Orders/viewOrder',$data);
	    $this->load->view('general/footer');     
        }else{
       	$this->load->view('general/header');
      	$this->load->view('Orders/receiveOrder',$data);
      	$this->load->view('general/footer');     
            
        }
       
      
    }
    
    // ajax call, when manager/user hit the confirmation/receive order button , means he acknowledes that cafe received the order
    function receiveOrder(){
      $receiver_sign = $this->input->post('receiver_sign');
      $receiver_signFileName = 'signature_' . uniqid() . '.png';
      $filePath = './uploaded_files/'.$this->tenantIdentifier.'/Supplier/Orders/'.$receiver_signFileName;
      // Save the image to the folder
       file_put_contents($filePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $receiver_sign)));
       $data['temp'] = $this->input->post('temp');
       $data['any_damaged_goods'] = $_POST['any_damaged_goods'] == 'false' ? 0 : 1;
       $data['paid_in_cash'] = $_POST['paid_in_cash']  == 'false' ? 0 : 1;
       $data['receiving_person'] = $this->input->post('receiving_person');
       $data['receiver_sign'] = $receiver_signFileName;
       $data['status'] = 4;
       $data['receiving_date'] = date('Y-m-d');
       $order_id =  $this->input->post('order_id');
    //   echo "<pre>"; print_r($_POST); print_r($data); exit;
       $this->order_model->orderCommonUpdate($order_id,$data); 
       $updatedApprovedProducts = $this->input->post('updatedApprovedProducts');
       $markOrderProductsAsApproved = json_decode($updatedApprovedProducts, true);
       foreach($markOrderProductsAsApproved as $productId){
        $updateOrderProductData['is_approved'] = 1;
        $this->order_model->orderProductsCommonUpdate($order_id,$productId,$updateOrderProductData);   
       }
        
     // send mail to supplier after receving order so that supplier can attach invoice
     $supplierEmail = $this->input->post('supplierEmail');
     $supplierId = $this->input->post('supplierId');
     // if orz settings allow us to send mail to supplier for attaching inv than only send
     $configurationData = $this->config_model->getConfiguration('settings');
     $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
     
     if(isset($configData['sendAttachInvoiceEmail']) && $configData['sendAttachInvoiceEmail']==1){
     $this->sendMailToSupplier($order_id,$supplierId,$supplierEmail,'',false);    
     }
     
       
    }
    
    
    // If budget is $500 and order placed in this week exceed $500 sends mail manager/supervisor/etc...
    function notifyManagerAboutBudgetExceededOrder(){
        
     $data['order_id'] =  $this->input->post('order_id');
     $data['locationName'] = $this->session->userdata('location_name');
     $data['order_date'] = date('d-m-Y');
     $supplierId = $this->input->post('supplierId');
    
    //  $paramsToEncrypt = $data['order_id'] . '|' . $supplierId . '|' . $this->tenantIdentifier;
    //  $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
    //  $encodedParams = urlencode(urlencode(urlencode($paramsToEncrypt)));
     
     $dataToEncrypt = array(
         'order_id' => $data['order_id'],
         'location_id' => $this->location_id,
         'location_name' => $this->session->userdata('location_name'),
         'tenantIdentifier' => $this->tenantIdentifier,
         'supplierId' => $supplierId,
         'supplierMail' => $this->session->userdata('supplierEmail'),
         'supplierCCMail' => $this->session->userdata('supplier_CCemail'),
         'mail_from' => $this->session->userdata('mail_from'),
         'username' => $this->session->userdata('username'),
         'mail_protocol' => $this->session->userdata('mail_protocol'),
         'smtp_host' => $this->session->userdata('smtp_host'),
         'smtp_port' => $this->session->userdata('smtp_port'),
         'smtp_username' => $this->session->userdata('smtp_username'),
         'smtp_pass' => $this->session->userdata('smtp_pass'),
         );
       
     $encryptedData = $this->encryption->encrypt(json_encode($dataToEncrypt));

     $data['approveOrderUrl'] = base_url().'External/Supplier/approveBudgetExceedOrder/'.urlencode(urlencode(urlencode($encryptedData))).'/5';
     $data['rejectOrderUrl'] = base_url().'External/Supplier/approveBudgetExceedOrder/'.urlencode(urlencode(urlencode($encryptedData))).'/6';
     $mailContent = $this->load->view('Mail/budgetExceedOrder',$data,TRUE);
     
      $configurationData = $this->config_model->getConfiguration('settings');
      $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
      $budgetExceedEmail = (isset($configData['budgetExceedEmail']) ? $configData['budgetExceedEmail'] : '');
      $reply_to = (isset($configData['reply_to']) ? $configData['reply_to'] : '');
      $this->session->unset_userdata('supplierEmail');
      $this->session->unset_userdata('supplier_CCemail');
      $this->sendEmail($budgetExceedEmail,'Supplier Budget Exceed Approval',$mailContent,$this->session->userdata('mail_from'),'','','',$reply_to);  
    }
    
    function deleteOrderProduct(){
      $productId =   $this->input->post('product_id'); 
      $order_id =   $this->input->post('order_id'); 
      $this->order_model->deleteOrderProduct($productId,$order_id);
    }
    
    public function addNewProductToOrder(){
         $orderProductData['product_id'] =   $this->input->post('product_id'); 
         $orderProductData['order_id'] =   $this->input->post('order_id'); 
         $orderProductData['product_unit_price'] =   $this->input->post('product_price'); 
         $orderProductData['is_approved'] =   1; 
         $orderProductData['qty'] =   $this->input->post('product_qty');
         $orderProductData['total'] = $this->input->post('product_qty') * $this->input->post('product_price');
         // check if product already exist than update just qty
         
       $this->order_model->insertOrderProduct($orderProductData,$this->input->post('product_id'));
       echo "success";
    }
    
}

