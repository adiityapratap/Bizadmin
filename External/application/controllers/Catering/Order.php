<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH.'third_party/phpmailer/src/Exception.php';
require APPPATH.'third_party/phpmailer/src/PHPMailer.php';
require APPPATH.'third_party/phpmailer/src/SMTP.php';
class Order extends CI_Controller {
    
    function __construct() {
		parent::__construct();
	  $this->load->model('Catering/orders_model');
	  
  
      $this->load->model('common_model');
//       ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	}
	
    public function order_approval($encoded_order_id)
	{
	  
	   $decodedParams = urldecode(urldecode(urldecode($encoded_order_id)));
           $decryptedParams = $this->encryption->decrypt($decodedParams);
           list($tenantIdentifier, $order_id) = explode('|', $decryptedParams);
           $this->session->set_userdata('tenantIdentifier',$tenantIdentifier);
     	   initializeTenantDbConfig($tenantIdentifier);
     	 

        if ($order_id === false) {
           echo "Invalid order ID";
        } else {
       $orderResult = $this->orders_model->viewOrderDetails($order_id);
      
	   $data['orderData'] = reset($orderResult); 
	   // echo "<pre>"; print_r($data['orderData']); exit;
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
     
       $data['grandTotal'] = $this->orders_model->calculateOrderTotal($order_id);
       $this->load->view('general/header');
	    $this->load->view('Catering/order_approval',$data);
	    $this->load->view('general/footer');
        }

	}
	
	function updateOrderStatus(){
	    
	    
     	   initializeTenantDbConfig($this->session->userdata('tenantIdentifier'));
	    
	   $order_id = $this->input->post('order_id'); 
	   $where = array('order_id' => $order_id);
	   $updateData['approval_comments'] = $this->input->post('approval_comments');
	   $updateData['status'] = $this->input->post('status');
	 
	   if($updateData['status'] == 7){
	    $notificationMsg = 'Order id #'.$order_id.' has been approved';   
	   }elseif($updateData['status'] == 8){
	     $notificationMsg = 'Order id #'.$order_id.' has been rejected';  
	   }else{
	       $notificationMsg = 'Order id #'.$order_id.' has been modified';   
	   }
	   
	   $notificationData  = array(
	       'description' => $notificationMsg,
	       'orderID' => $order_id,
	       'date_added' => date('Y-m-d'),
	       'time_added' => date('h:m:s')
	       
	   );
	   
	  
	   $this->common_model->commonRecordCreate('Catering_notification',$notificationData);
      $this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$order_id,$updateData); 
      echo "success";
	}
}
?>