<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
class Quote extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('genric_model');
		$this->load->model('orders_model');
		$this->load->model('common_model');
      !$this->ion_auth->logged_in() ? redirect('auth/login') : '';
      $this->selected_location_id = $this->session->userdata('location_id');
      $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
    //  ini_set('display_errors', 1);
    //   ini_set('display_startup_errors', 1);
    //   error_reporting(E_ALL);
	}
	
	// this is for placing order directly withhout quote
	function orderForm($editOrderId = '') {
    if ($editOrderId != '') {
        $orderResult = $this->orders_model->viewOrderDetails($editOrderId);
        $data['orderData'] = reset($orderResult);
        $data['editOrderId'] = $editOrderId;
        $data['pageHeading'] = 'Edit Order';
        $this->session->set_userdata('order_product', $orderResult[$editOrderId]['products']);
    } else {
        $data['pageHeading'] = 'New Order';
    }

    $table = 'Catering_company';
    $tabledepartment = 'Catering_department';
    $tablecustomer = 'Catering_customer';
    $tablelocations = 'Catering_locations';

    $conditionsComp = array('status' => 1);
    $conditions = array('status' => 1);

    $orderByLoca = 'location_name';
    $orderByComp = 'company_name';
    $orderByDept = 'department_name';

    $fieldsToFetchComp = ['company_id', 'company_name'];
    $fieldsToFetchDept = ['department_id', 'department_name', 'company_id'];
    $fieldsToFetchCust = ['customer_id', 'firstname', 'lastname', 'company_id', 'department', 'telephone', 'email'];
    $fieldsToFetchPickup = ['pickup_address', 'location_id'];

    $data['companies'] = $this->common_model->fetchRecordsDynamically($table, $fieldsToFetchComp, $conditionsComp, $orderByComp);
    $data['departments'] = $this->common_model->fetchRecordsDynamically($tabledepartment, $fieldsToFetchDept, array(), $orderByDept);
    $data['customers'] = $this->common_model->fetchRecordsDynamically($tablecustomer, $fieldsToFetchCust, $conditions);
    $data['stores'] = $this->common_model->fetchRecordsDynamically($tablelocations, array(), array(), $orderByLoca);
    $data['pickupAddressList'] = $this->common_model->fetchRecordsDynamically('Catering_settings', $fieldsToFetchPickup);

    $this->session->set_userdata('is_quote', '0');
    $this->load->view('general/header');
    $this->load->view('quote/quoteForm', $data);
    $this->load->view('general/footer');
}

	
	function quoteForm($editOrderId = '') {
    if ($editOrderId != '') {
        $orderResult = $this->orders_model->viewOrderDetails($editOrderId);
        $data['orderData'] = reset($orderResult);
        $data['editOrderId'] = $editOrderId;
        $data['pageHeading'] = 'Edit Details';
        $this->session->set_userdata('order_product', $orderResult[$editOrderId]['products']);
    } else {
        $data['pageHeading'] = 'New Quote';
    }

    $table = 'Catering_company';
    $tabledepartment = 'Catering_department';
    $tablecustomer = 'Catering_customer';
    $tablelocations = 'Catering_locations';

    $conditionsComp = array('status' => 1);
    $conditions = array('status' => 1);

    $orderByLoca = 'location_name';
    $orderByComp = 'company_name';
    $orderByDept = 'department_name';

    $fieldsToFetchComp = ['company_id', 'company_name'];
    $fieldsToFetchDept = ['department_id', 'department_name', 'company_id'];
    $fieldsToFetchCust = ['customer_id', 'firstname', 'lastname', 'company_id', 'department', 'telephone', 'email'];
    $fieldsToFetchPickup = ['pickup_address', 'location_id'];

    $data['companies'] = $this->common_model->fetchRecordsDynamically($table, $fieldsToFetchComp, $conditionsComp, $orderByComp);
    $data['departments'] = $this->common_model->fetchRecordsDynamically($tabledepartment, $fieldsToFetchDept, array(), $orderByDept);
    $data['customers'] = $this->common_model->fetchRecordsDynamically($tablecustomer, $fieldsToFetchCust, $conditions);
    $data['stores'] = $this->common_model->fetchRecordsDynamically($tablelocations, array(), array(), $orderByLoca);
    $data['pickupAddressList'] = $this->common_model->fetchRecordsDynamically('Catering_settings', $fieldsToFetchPickup);
    // echo "<pre>"; print_r($data['companies']);
    // print_r($data['departments']);
    // print_r($data['stores']);
    // print_r($data['pickupAddressList']);
    // exit;
    $this->session->set_userdata('is_quote', '1');
    // $this->load->view('general/header');
    $this->load->view('quote/quoteForm', $data);
    // $this->load->view('general/footer');
    
}

	
	public function newQuoteSave()
	{  
	   // 	echo "<pre>"; print_r($_POST); exit;
	        $orderData = array(
        'company_id' => htmlspecialchars($this->input->post('company_id')),
        'department_id' => htmlspecialchars($this->input->post('department_id')),
        'location_id' => $this->selected_location_id,
        'customer_id' => htmlspecialchars($this->input->post('customer_id')),
        'accounts_email' => htmlspecialchars($this->input->post('accounts_email')),
        'cost_center' => htmlspecialchars($this->input->post('cost_center')),
        'delivery_contact' => empty($this->input->post('delivery_contact')) ? 'null' : htmlspecialchars($this->input->post('delivery_contact')),
        'delivery_date' => empty($this->input->post('delivery_date')) ? 'null' : date('Y-m-d', strtotime($this->input->post('delivery_date'))),
        'delivery_time' => empty($this->input->post('delivery_time')) ? 'null' : $this->input->post('delivery_time'),
        'delivery_notes' => empty($this->input->post('delivery_notes')) ? 'null' : htmlspecialchars($this->input->post('delivery_notes')),
        'shipping_method' => empty($this->input->post('shipping_method')) ? 'null' : htmlspecialchars($this->input->post('shipping_method')),
        'delivery_address' => isset($_POST['shipping_method']) && $_POST['shipping_method'] == 2 ? htmlspecialchars($this->input->post('customer_pickup_address')) : htmlspecialchars($this->input->post('delivery_address')),
        'pickup_location' => empty($this->input->post('pickup_location')) ? 'null' : htmlspecialchars($this->input->post('pickup_location')),
        'delivery_fee' => empty($this->input->post('delivery_fee')) ? 0 : $this->input->post('delivery_fee')
     );
           $this->session->set_userdata('order_data', $orderData);
           $this->session->set_userdata('selectedLocationBeingEdited',  $this->selected_location_id);
	     	$data['customer_order_email'] = $this->input->post('email');
		    $conditionsProduct = array('status' => 1);
			$data['products']=$this->common_model->fetchRecordsDynamically('Catering_product','', $conditionsProduct);
			$data['categories']=$this->common_model->fetchRecordsDynamically('Catering_category','', $conditionsProduct);
			
			// order existing product, when editing
			if($this->input->post('editOrderId') !=''){
			 $data['order_products'] = $this->session->userdata('order_product');
			 $data['editOrderId'] = $this->input->post('editOrderId');
			 $conditionsOrder = array('order_id' => $this->input->post('editOrderId'));
			 
			 // existing applied coupon id
			 $res=$this->common_model->fetchRecordsDynamically('Catering_orders', ['coupon_id','coupon_code'],$conditionsOrder);
			 if(!empty($res)){
			 $res = reset($res);
			 $data['coupon_id'] = $res['coupon_id']; 
			 $data['coupon_code'] = $res['coupon_code'];  
			 }else{
			   $data['coupon_id'] = '';  
			   $data['coupon_code'] = '';
			 }
			 
			}
            $data['delivery_fee'] = empty($this->input->post('delivery_fee')) ? 0 : $this->input->post('delivery_fee');
            // $this->load->view('general/header');
			$this->load->view('quote/quoteProducts',$data);
			
// 			echo "<pre>"; print_r($data['products']);print_r($data['categories']); exit;
// 			$this->load->view('general/footer');
		
	}
	
	public function placeQuote()
	{
	   
        $order_data = $this->session->userdata('order_data');
        $order_data['date_added'] = date('Y-m-d');
        $order_data['is_quote'] = $this->session->userdata('is_quote');
        $order_data['status'] = 1;
        $order_data['location_id'] = $this->selected_location_id;
        $order_data['order_comments'] = $_POST['order_comments'] ?? '';
        $order_data['order_total'] = $_POST['cart_total'] ?? '';
        $order_data['coupon_id'] = $_POST['coupon_id'] ?? '';
        $order_data['coupon_code'] = $_POST['coupon_code'] ?? '';

		$orderId = $this->common_model->commonRecordCreate('Catering_orders', $order_data);
// 		echo "<pre>"; print_r($_POST); exit;
		
		 $orderProductData = array();
		 $productComment = $_POST['order_product_comment'];
		 $productPrice = $_POST['product_price'];
		 $index = 0;
// 		 echo "<pre>";  print_r($_POST['qty']);  exit;
		 if(isset($_POST['qty']) && !empty($_POST['qty'])){
		   foreach($_POST['qty'] as $productId => $qtyPrdct){
		      $orderProductData[$index]['quantity'] = $qtyPrdct;
		      $orderProductData[$index]['product_id'] = $productId;
		      $orderProductData[$index]['order_product_comment'] = $productComment[$productId];
		      $orderProductData[$index]['price'] = $productPrice[$productId];
		      $orderProductData[$index]['order_id'] = $orderId;
		      $orderProductData[$index]['total'] = $qtyPrdct * $productPrice[$productId];
		      $orderProductData[$index]['sort_order'] = $index;
		      $index++;
		   }  
		 }
		 
		 $_POST['firstname'] = $order_data['firstname'] ?? '';
	     $this->common_model->commonBulkRecordCreate('Catering_order_product', $orderProductData);
	     
		$this->session->unset_userdata('order_data');
	
		if(isset($_POST['saveAndSend']) && $_POST['saveAndSend'] == true){
		    $order_total = $formattedNumber = number_format($order_data['order_total'], 4, '.', '');
		  //  echo "<pre>"; print_r($orderData); exit;
         $_POST['order_id'] = $orderId;	    
         $this->send_quote_email($_POST, $this->selected_location_id);
         }
         
         
	  if($this->session->userdata('is_quote')){
	     $this->session->unset_userdata('is_quote');
	    redirect('/Catering/quoteList');  
	  }else{
	     $this->session->unset_userdata('is_quote');
	     redirect('/Catering/futureOrder'); 
	  }
     		
	
	}
	
	function updateQuote(){
	 
	    $order_data = $this->session->userdata('order_data');
	    $order_data['order_comments'] = $_POST['order_comments'];
	    $order_data['order_total'] = $_POST['cart_total'];
	    $order_id = $_POST['editOrderId'];
	    $order_data['coupon_id'] = $_POST['coupon_id'];
	    $order_data['coupon_code'] = $_POST['coupon_code'];
	    $where = array('order_id' => $order_id);
	    $this->common_model->commonRecordUpdate('Catering_orders','order_id',$order_id, $order_data);
	    $this->common_model->commonRecordDelete('Catering_order_product',$order_id, 'order_id'); 
	     $orderProductData = array();
		 $productComment = $_POST['order_product_comment'];
		 $productPrice = $_POST['product_price'];
		 $index = 0;
		 
	    if(isset($_POST['qty']) && !empty($_POST['qty'])){
		   foreach($_POST['qty'] as $productId => $qtyPrdct){
		      $orderProductData[$index]['quantity'] = $qtyPrdct;
		      $orderProductData[$index]['product_id'] = $productId;
		      $orderProductData[$index]['order_product_comment'] = $productComment[$productId];
		      $orderProductData[$index]['price'] = $productPrice[$productId];
		      $orderProductData[$index]['order_id'] = $order_id;
		      $orderProductData[$index]['total'] = $qtyPrdct * $productPrice[$productId];
		      $index++;
		   }  
		 }
	 $this->common_model->commonBulkRecordCreate('Catering_order_product', $orderProductData); 
	 $this->session->unset_userdata('order_data');
	 $this->session->unset_userdata('order_product');
	 if($this->session->userdata('editType') == 'Quote'){
	  $this->session->unset_userdata('editType');   
	  redirect('/Catering/quoteList');   
	 }else{
	 $urlToRedirect =  $this->session->userdata('editType') ? $this->session->userdata('editType') : '/Catering/futureOrder';  
	 $this->session->unset_userdata('editType'); 
// 	 redirect($urlToRedirect);    
    // commented by ady on 07-05-2025
	 redirect('/Catering/futureOrder');  
	 }
	 
	}
	
	public function send_quote_email($postedData,$location_id='')
	{       
            $whereS = array('location_id' =>  $this->selected_location_id);
            $settingsData = $this->common_model->fetchRecordsDynamically('Catering_settings',['contact_number','remittance_email'],$whereS); 
            $data['cafePhone'] = (isset($settingsData[0]['contact_number']) ? $settingsData[0]['contact_number'] : '');
            $replyToEmail = (isset($settingsData[0]['remittance_email']) ? $settingsData[0]['remittance_email'] : '');
            // echo "<pre>"; print_r($settingsData); exit;
		    if(isset($_POST['ajaxCall']) && $_POST['ajaxCall']){
		    $toemail = $_POST["email"];
		    $data['firstname'] = $_POST["firstname"];
		    $order_id = $postedData;
		    }else{
		     $toemail = $postedData["customerOrderEmailToSendApprovalMail"];
		     $data['firstname'] = $postedData["firstname"];
		     $order_id = $postedData['order_id'];
		    }
		    
		    // url encoding for security purpose
		  
          
           
           $paramsToEncrypt = $this->tenantIdentifier . '|' . $order_id;
           $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
           $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
           
           $data['url'] = base_url().'External/order_approval/'.$encodedParams;
         
         
        //   $data['url'] = ROOTURL.'tiny/'.$encoded_order_id;
          $stores =$this->common_model->fetchRecordsDynamically('Catering_locations',['location_name'],$whereS);
          $stores = reset($stores);
          $data['locationName'] = $stores['location_name'];
          $body = $this->load->view('quote/quote_email', $data,TRUE);
           
          $mail= $this->sendEmail($toemail,'Catering Quote',$body,$this->session->userdata('mail_from'),'','','',$replyToEmail);

            if(isset($_POST['ajaxCall']) && $_POST['ajaxCall']){
             if($mail) {
             echo 'Ok';
             $updateData['status'] = 4;
             $this->common_model->commonRecordUpdate('Catering_orders','order_id',$order_id, $updateData);
            } else {
            echo 'not ok';
            }  
            }else{
             $updateData['status'] = 4;
             
             $this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$order_id,$updateData);
            }
            	
	}
	
	

	function quoteList(){
	    
	 $conditionsQuote = array('Catering_orders.is_quote' => 1,'Catering_orders.status !=' => 0);
	 $orderFields = 'Catering_orders.order_id,Catering_orders.location_id,Catering_orders.delivery_date,Catering_orders.delivery_time,Catering_orders.status';
	 $data['listData'] = $this->orders_model->fetchOrders($conditionsQuote,$orderFields);
// 	 echo "<pre>"; print_r($data['listData']); exit;
	 $data['locations']=$this->common_model->fetchRecordsDynamically('Catering_locations');
     $data['pageTitle'] = 'Quotes';
     $data['is_quote'] = 1;
     $data['selectedLocationBeingEdited'] = $this->session->userdata('selectedLocationBeingEdited') ?? '';
     $this->session->unset_userdata('selectedLocationBeingEdited');
     $data['addUrl'] = base_url('new_quote');
     $data['addBtnText'] = 'Add New Quote';
     $this->session->set_userdata('editType', 'Quote');
     $this->load->view('general/header');
	 $this->load->view('quote/quoteList',$data);
	 $this->load->view('general/footer');
	}
	
	function viewOrderDetails($orderId){
	    
	   $orderResult = $this->orders_model->viewOrderDetails($orderId);
	   
	   if(!empty($orderResult)){
	   
	   $data['orderData'] = reset($orderResult);
	   $where = array('location_id' =>  $this->selected_location_id);
       $data['settingsData'] = $this->common_model->fetchRecordsDynamically('Catering_settings','',$where); 
      
       if(isset($data['orderData']['coupon_id']) && $data['orderData']['coupon_id']){
      $Cwhere = array('coupon_id' => $data['orderData']['coupon_id']);
      $coupon_discount = $this->common_model->fetchRecordsDynamically('Catering_coupon','',$Cwhere); 
      $coupon_discount = reset($coupon_discount);
      $data['coupon_discount'] = $coupon_discount['coupon_discount'];
      $data['coupon_code'] = $coupon_discount['coupon_code'];
      $data['discountSign'] = $coupon_discount['type'] == 'P' ? '%' : '';
       }else{
      $data['coupon_discount'] = '';
      $data['coupon_code'] = '';
      $data['discountSign'] = '';
     }
     
       $data['grandTotal'] = $this->genric_model->calculateOrderTotal($orderId);
	   $this->load->view('general/header');
	    $this->load->view('quote/viewOrderDetails',$data);
	    $this->load->view('general/footer');
	        
	   }
	   // echo "<pre>"; print_r($data['orderData']); exit;
	}
	
	function convertToInvoice(){
	    $order_id = $this->input->post('order_id');
	    $updateData['is_quote'] = 0;
        
        $this->common_model->commonRecordUpdate('Catering_orders','order_id',$order_id, $updateData);
	}
	
	public function chnage_product_sort_order()
    {
      
        $i = 0;
       foreach ($_POST['cart-product'] as $value) {
        $updateData['sort_order'] = $i;    
        $where = array('order_product_id' => $value);
        $this->common_model->commonRecordUpdate('Catering_order_product','order_product_id',$value, $updateData);
         $i++;
         }
     	}
     	
     	
    function add_late_fee($orders,$latefee){
       $orders = explode(".",$orders);
      
       for($index = 0; $index <= sizeof($orders); $index++){
           $this->db->query("UPDATE Catering_orders SET late_fee=".$latefee." WHERE order_id=".$orders[$index]);
           
       }
       echo 'late fee added';  
    //   redirect('orders/order_history');
      
   } 	
	

}