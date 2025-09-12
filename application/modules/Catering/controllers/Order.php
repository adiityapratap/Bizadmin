<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
class Order extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('genric_model');
		$this->load->model('orders_model');
		$this->load->model('common_model');
      !$this->ion_auth->logged_in() ? redirect('auth/login') : '';
      $this->selected_location_id = $this->session->userdata('location_id');
        $this->locationName = fetchLocationNamesFromIds($this->selected_location_id,true);
      
    //   ini_set('display_errors', 1);
    //   ini_set('display_startup_errors', 1);
    //   error_reporting(E_ALL);
    
	}
	
		// Orders related code
	function orderList()
	{
	 $data['pageTitle'] = 'Future Orders';
	 $data['is_quote'] = 0;
	 $conditionsOrder = array('Catering_orders.is_quote' => 0,'Catering_orders.status !=' => 0,'Catering_orders.delivery_date >=' => date('Y-m-d'));
	 $orderFields = 'Catering_orders.order_id,Catering_orders.location_id,Catering_orders.delivery_date,Catering_orders.delivery_time,Catering_orders.status';
	 $data['listData'] = $this->orders_model->fetchOrders($conditionsOrder,$orderFields); 
     $data['selectedLocationBeingEdited'] = $this->session->userdata('selectedLocationBeingEdited') ?? '';
     $this->session->unset_userdata('selectedLocationBeingEdited');
	 $data['locations']=$this->common_model->fetchRecordsDynamically('Catering_locations');
	 $data['addUrl'] = base_url('new_order');
	 $data['addBtnText'] = 'Place New Order';
	 $this->session->set_userdata('editType', 'futureOrder');
	 $this->load->view('general/header');
	 $this->load->view('quote/quoteList',$data);
	 $this->load->view('general/footer');
// 	 echo "<pre>"; print_r($data['listData']); exit;
	}
	
	function viewProductionPage($orderId){
	  
	   $orderResult = $this->orders_model->viewOrderDetails($orderId);
	   $data['orderData'] = reset($orderResult);
	   $this->load->view('general/header');
	   $this->load->view('quote/viewProductionPage',$data);
	   $this->load->view('general/footer');
	   
	}
	
	public function updatePreparedStatus() {
        $order_product_id = $this->input->post('order_product_id');
     
        $data['is_prepared'] = $this->input->post('is_prepared');
        
        $this->common_model->commonRecordUpdate('Catering_order_product', 'order_product_id',$order_product_id,$data);
        echo json_encode(['status' => 'success']);
    }
	
	function pastOrderList()
	{
	 
     $data['selectedLocationBeingEdited'] = $this->session->userdata('selectedLocationBeingEdited') ?? '';
     $this->session->unset_userdata('selectedLocationBeingEdited');
	 $data['pageTitle'] = 'Past Orders';
	 $data['is_quote'] = 0;
	 $conditionsOrder = array('Catering_orders.is_quote' => 0,'Catering_orders.delivery_date <' => date('Y-m-d'),'Catering_orders.status !=' => 0);
	 $orderFields = 'Catering_orders.order_id,Catering_orders.location_id,Catering_orders.delivery_date,Catering_orders.delivery_time,Catering_orders.status';
	 $data['listData'] = $this->orders_model->fetchOrders($conditionsOrder,$orderFields);
	 $data['locations']=$this->common_model->fetchRecordsDynamically('Catering_locations');
	 $data['addUrl'] = base_url('new_order');
	 $data['addBtnText'] = 'Place New Order';
	 $this->session->set_userdata('editType', 'pastOrder');
	 $this->load->view('general/header');
	 $this->load->view('quote/quoteList',$data);
	 $this->load->view('general/footer');
	    
	}
	
	function generatePaymentLink($orderId){
	    // processPayment is located at the root of project
	  $totalAmount = $this->genric_model->calculateOrderTotal($orderId);
	  $encodedOrderId = base64_encode($orderId);
      $encodedTotalAmount = base64_encode($totalAmount);
      $url = ROOTURL.'/processPayment.php?order='.$encodedOrderId.'&amount='.$encodedTotalAmount;
		
	  $encodedUrl = urlencode($url);
      $apiUrl = "http://tinyurl.com/api-create.php?url=$encodedUrl";
      $paymentLink = file_get_contents($apiUrl);
      return $paymentLink;
	}
	
	function sendPaymentLink(){

		$data['download_link'] = '';
		$data['order_id'] = $_POST["order_id"];
		
        $data['paymentLink'] = $this->generatePaymentLink($_POST["order_id"]);

	    $data['customer_name']  = $_POST["customer_name"]; 
		$body = $this->load->view('mail/payment_link_email', $data,TRUE);
	    $subject= CAFENAME.'- '.$_POST["order_id"];
	    
	     $where = array('order_id'=>$_POST["order_id"]);
	     $order_info = $this->common_model->fetchRecordsDynamically('Catering_orders',['location_id'],$where);
         $order_info = reset($order_info);
         
         $emailToList = array($_POST["email"]);
         
	     $replyToEmail = $this->sendFromMail();  
	     $pdf = $this->generateInvoice($_POST["order_id"]);
         // Save PDF to file
         $pdfFilePath = FCPATH . 'uploads/invoice_' . $_POST["order_id"] . '.pdf';
         $pdf->Output($pdfFilePath, 'F');
        
		$this->sendEmail($emailToList,$subject,$body,$this->session->userdata('mail_from'),'','',$pdfFilePath,$replyToEmail);
		
	}
	
	function downloadInvoice($order_id){
	    $pdf = $this->generateInvoice($order_id);
	    $pdfFileName = 'invoice-' . $order_id . '.pdf';
        $pdf->Output($pdfFileName, 'D');
	}
	
	public function markPaid() {
    
        $order_id = $this->input->post('order_id');
        $mark_paid_comments = $this->input->post('mark_paid_comments');
        if ($order_id) {
            $data = array(
                'status' => 2,
                'mark_paid_comment' => $mark_paid_comments
            );
          
            if ($this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$order_id,$data)) {
               echo json_encode(array('status' => 'success'));
            } else {
             echo json_encode(array('status' => 'error', 'message' => 'Failed to update record'));
            }
        }
    }
    
    public function markCompleted()
	{ 
	 $orderId = $this->input->post('orderId');  
	 $conditionsOrder = array('Catering_orders.order_id' => $orderId);
	 $orderFields = 'Catering_orders.accounts_email,Catering_orders.status,Catering_orders.location_id';
	 $orderData = $this->orders_model->fetchOrders($conditionsOrder,$orderFields);
	 $orderData = reset($orderData);
	 
	 $data['customerName'] = $orderData['fullname'];
	 $data['orderId'] = $orderId;
	 
	 $replyToEmail = $this->sendFromMail();  
	 $pdf = $this->generateInvoice($orderId);
     
     $pdfFilePath = FCPATH . 'uploads/invoice_' . $orderId . '.pdf';
     $pdf->Output($pdfFilePath, 'F');
     $body = $this->load->view('mail/orderEmail', $data,TRUE);
     $subject= CAFENAME.' Invoice - '.$orderId;
     if($orderData['status'] == 2){
       $emailToList = array($orderData["customer_email"]);   
     }else{
      $emailToList = array($orderData["customer_email"],$orderData['accounts_email']);   
     }
	 
	 $this->sendEmail($emailToList,$subject,$body,$this->session->userdata('mail_from'),'','',$pdfFilePath,$replyToEmail);

	 $where = array('order_id' => $orderId );
	 $updateData['is_completed'] = 1;
	 $this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$orderId,$updateData);
	
	 echo "success";
		
        }
	
	function generateInvoice($order_id){
	  
	  $orderData = $this->orders_model->viewOrderDetails($order_id);
        $order_info = reset($orderData);
        
        $where = array('location_id' =>  $this->selected_location_id);
        $settingsData = $this->common_model->fetchRecordsDynamically('Catering_settings','',$where); 
        $settingsData = reset($settingsData);
        
        // fetch from settings page
        $addd_text = $settingsData['company_name'].' | ABN : '.$settingsData['abn'];
        
        // Generate PDF
        $this->load->library('CustomFPDF');
        $pdf = $this->customfpdf->getInstance('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        // to draw border on page side
        $this->borderpdf($pdf);
        // Logo
        $pdf->Ln(-5);
        $pdf->Image(ROOTURL.'assets/images/logo-dark.png', 10, 6, 40);
        $pdf->Ln(8);
        define('FPDF_FONTPATH', APPPATH . 'third_party/font/');
        $pdf->AddFont('Montserrat', '', 'montserrat.php');
        $pdf->AddFont('MontserratB', '', 'Montserrat-Bold.php');
        $pdf->SetTopMargin(2);
        $pdf->setFont('Montserrat', '', 8);
        // $pdf->Cell(185,7, $company_name.'  | ABN: '.$abn ,0,0,'R'); $pdf->Ln();
        $pdf->Cell(185 ,3,$addd_text ,0,0,'R'); 
        $pdf->Ln(5);
       
       $pdf->setFont('MontserratB', '', 14);
       $pdf->Cell(190, 10, ' Tax Invoice #'.$order_id, 0, 0, 'C');
       
       
        $pdf->Ln(10);
        $pdf->setFont('Montserrat', '', 14);

        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.3);
        // Header
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->setFont('MontserratB', '', 10);

       $pdf->Cell(95, 8, "Order Details", 0, 0, 'L', true);
       $pdf->Cell(94, 8, "Customer Information", 0, 1, 'R', true);
       
       $pdf->SetFillColor(255);
      $pdf->SetTextColor(0);
      $pdf->ln(16);

      $pdf->SetFont("MontserratB", '', 8.5);
      $pdf->Cell(25, 4, " ", 0, 0);

     $pdf->SetFont("MontserratB", '', 8.5);
     $pdf->Cell(150, 5, 'Deliver To', 0, 0, 'R');
     $pdf->Ln(8);
     $pdf->SetFont("Montserrat", '', 8.5);
     $pdf->Cell(190, 5, $order_info['firstname'].' '.$order_info['lastname']. ' | '.$order_info['customer_telephone'], 0, 1, 'R'); 
     
      $encodedString = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $order_info['delivery_address']);
     $pdf->MultiCell(180, 5, ltrim($encodedString), 0, 'R');
     $pdf->SetLeftMargin(10);

     $length_del_addr = strlen($order_info['delivery_address']);
     if ($length_del_addr > 69) {
     $pdf->Ln(-35);
     } else {
     $pdf->Ln(-20);
     } 
     
     
   $pdf->SetFont("MontserratB", '', 8.5);
   $pdf->Cell(25, 4, "Invoice ID : ", 0, 0);
   $pdf->SetFont("Montserrat", '', 9);
   $pdf->Cell(10, 4, '      '.$order_id, 0, 1);

   $pdf->SetFont("MontserratB", '', 8.5);
   $pdf->Cell(25, 4, "Order Date : ", 0, 0, 'L', true);
   $pdf->SetFont("Montserrat", '', 8.5);
   $orderdate = date('g:i A, l - d M Y', strtotime($order_info['date_added']));
   $pdf->Cell(35, 4, '      '.$orderdate, 0, 1);

if ($order_info['status'] == 3) {
    $paiddate = date('g:i A, l - d M Y', strtotime($order_info['date_modified']));
    $pdf->SetFont("MontserratB", '', 8.5);
    $pdf->Cell(25, 4, "Paid Date : ", 0, 0, 'L', true);
    $pdf->setFont("Montserrat", '', 8.5);
    $pdf->Cell(35, 4, '      '.$paiddate, 0, 1);
}

        if($order_info['shipping_method'] == 1){
         $sm =  "Delivery";
         }else{
         $sm =  "Pickup";
         }
     if($order_info['status'] == 3){
       $pm =  "Credit Card";
        }else{
       $pm = '';  
        }
        
        
        if($pm !=''){
        $pdf->SetFont("MontserratB", '', 8.5);
        $pdf->Cell(30, 4, "Payment Type : ", 0, 0, 'L', true);

        $pdf->setFont("Montserrat", '', 8.5);
        $pdf->Cell(10, 4, $pm, 0, 0, 'L', true);
        $pdf->ln(5);
        }
        
         $pdf->SetFont("MontserratB", '', 8.5);
         $pdf->Cell(30, 4, "Shipping Type : ", 0, 0, 'L', true);
         
         
        $pdf->setFont("Montserrat", '', 8.5);
        $pdf->Cell(10, 4, $sm, 0, 0, 'L', true);
        $pdf->ln(5);
       
        $delivery_date = date('g:i A, l - d M Y',strtotime($order_info['delivery_date']));
        $pdf->SetFont("MontserratB", '', 9);
        
        $pdf->Cell(30, 4, "Delivery Date :", 0, 0, 'L', true);
        
        $pdf->setFont("Montserrat", '', 9);
        $pdf->Cell(10, 4, $delivery_date , 0, 0, 'L', true);
        
        
        if(isset($order_info['delivery_notes']) && $order_info['delivery_notes'] !=''){
        $pdf->ln();
        $pdf->SetFont("MontserratB", '', 8.5);
        $pdf->Cell(30, 8, "Delivery Notes :", 0, 0, 'L', true);
        
        $pdf->setFont("Montserrat", '', 8.5);
        $x_axis=$pdf->getx();
        $foo_pickup_delivery_notes = preg_replace('/\s+/', ' ', $order_info['delivery_notes']);
        $pdf->left_vcell(10, 8, $x_axis,$foo_pickup_delivery_notes);
        }
        
        if(isset($order_info['order_comments']) && $order_info['order_comments'] != '')
        { 
        $pdf->ln();
        $pdf->SetFont("MontserratB", '', 8.5);
        $pdf->Cell(30, 8, "Order Comments :", 0, 0, 'L', true);
        $pdf->setFont("Montserrat", '', 8.5);
        $x_axis=$pdf->getx();
        $pdf->left_vcell(10, 8, $x_axis,trim($order_info['order_comments']));
        $pdf->ln(-10);
        }
        
        $pdf->ln(32);

        // Colors, line width and bold font
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        
        $pdf->SetDrawColor(200, 200, 200);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('MontserratB', '');
        
        $header = ['Item Name', 'Comments','Qty','Price','Total'];
        $w = array(64,  74, 18, 18,18);
        for ($i = 0; $i < count($header); $i++){
            if($i == 4 || $i == 3){
            //   to allign right the last header
            $pdf->Cell($w[$i], 7, $header[$i], 0, 0, 'L', true);
            }else{
               $pdf->Cell($w[$i], 7, $header[$i], 0, 0, 'L', true);
            }
        }
         $pdf->Ln();
        // // Color and font restoration
        $pdf->SetFillColor(255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Montserrat', '',8.5);
        $i= 1;
        $pdf->SetWidths(array(64,74,18, 18,18));
        foreach ($order_info['products'] as $product) {
         if($i % 2 == 0){
            $fill = true;
            }else{
             $fill = false;
            }
           
          $pdf->Row(array($product['product_name'],$product['order_product_comment'],$product['quantity'],number_format($product['price'],2),number_format($product['total'],2)),$fill);    
           $pdf->Ln(1);
          $i++;  
        }  
        
         $pdf->SetFillColor(0, 0, 0);
         $pdf->Ln(4);
         
         $tot = $this->genric_model->calculateOrderTotal($order_id);
      
        
         $gst = number_format(($tot/11),2, '.', '');
         
         $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(188, 0.5, "", 1, 1, 'C');
        $pdf->Ln(4);

        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Subtotal (inc GST): ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $minus_sign ='';
        $pdf->Cell($w[4]-2, 5, $minus_sign."$".number_format($order_info['order_total'],2), '', 1, 'R');
        
        if(isset($order_info['delivery_fee']) && $order_info['delivery_fee'] != 0 )
        {
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Delivery Fee : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $pdf->Cell($w[4]-2, 5, "$".number_format($order_info['delivery_fee'],2), '', 1, 'R');
        }
        
         if(isset($order_info['late_fee']) && $order_info['late_fee'] != 0 )
        {
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Late Fee : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $pdf->Cell($w[4]-2, 5, "$".number_format($order_info['late_fee'],2), '', 1, 'R');
        }
        
        if(isset($order_info['coupon_id']) && $order_info['coupon_id']){
        $Cwhere = array('coupon_id' => $order_info['coupon_id']);
        $coupon_discount = $this->common_model->fetchRecordsDynamically('Catering_coupon','',$Cwhere); 
        $coupon_discount = reset($coupon_discount);
        $coupon_code = $coupon_discount['coupon_code'];
        $discountSign = $coupon_discount['type'] == 'P' ? '%' : '';
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Discount (".$coupon_code.") : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $pdf->Cell($w[4]-2, 5, "$".number_format($coupon_discount['coupon_discount'], 2).$discountSign, '', 1, 'R');
        
       }
       
        
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "GST : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $pdf->Cell($w[4]-2, 5, "$".number_format($gst, 2), '', 1, 'R');
        
        if($order_info['status'] ==2){
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Amount Paid : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $pdf->Cell($w[4]-2, 5, "$".number_format($tot, 2), '', 1, 'R');
        
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Balance Due : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
        $pdf->Cell($w[4]-2, 5, "$0", '', 1, 'R');
      
         }else{
        
        $pdf->SetFont('MontserratB', '',8.5);
        $pdf->Cell($w[0]+$w[1]+$w[2]+14, 5, "Total : ", '', 0, 'R');
        $pdf->SetFont('Montserrat', '',8.5);
      
        $pdf->Cell($w[4]-2, 5, $minus_sign."$".number_format($tot, 2), '', 1, 'R');
        $pdf->SetFont('Montserrat', '',6);
         }
         
         $pdf->SetFont('Montserrat', '',6);
         $pdf->Cell(170, 4, "All items are inclusive GST", '', 1, 'R');
         $pdf->SetFont('Montserrat', '',8.5);
         
         $pdf->Ln(4);
         $pdf->SetFillColor(0, 0, 0);
         $pdf->SetTextColor(255, 255, 255);
        
         $pdf->setFont('MontserratB', '', 10);

         $pdf->Cell(95, 8, "Payment Details", 0, 0, 'L', true);
         $pdf->Cell(94, 8, "Payment Terms", 0, 1, 'R', true);
         $pdf->SetFillColor(255);
          $pdf->SetTextColor(0);
         $pdf->Ln(4);
         
          $pdf->SetFont("MontserratB", '', 8.5);
         $pdf->Cell(25, 4, "Account Name : ", 0, 0);

         $pdf->SetFont("Montserrat", '', 9);
         $pdf->Cell(10, 4, '      '.$settingsData['account_name'], 0, 0);
         
          $pdf->Ln(4);
         $pdf->SetFont("MontserratB", '', 8.5);
         $pdf->Cell(25, 4, "BSB : ", 0, 0);
         

         $pdf->SetFont("Montserrat", '', 9);
         $pdf->Cell(10, 4, '     '.$settingsData['bsb'], 0, 0);
         
         $pdf->Ln(4);
         $pdf->SetFont("MontserratB", '', 8.5);
         $pdf->Cell(25, 4, "Account Number : ", 0, 0);

         $pdf->SetFont("Montserrat", '', 9);
         $pdf->Cell(10, 4, '     '.$settingsData['account_number'], 0, 0);
         
       
          
         $pdf->Ln(4);
         $pdf->SetFont("MontserratB", '', 8.5);
         $pdf->Cell(25, 4, "Phone Number : ", 0, 0);

         $pdf->SetFont("Montserrat", '', 9);
         $pdf->Cell(10, 4, '  '.$settingsData['contact_number'], 0, 0);
         
         
        $pdf->Ln(-10);
        $pdf->SetFont("Montserrat", '', 8);
        $pdf->Cell(190, 6, "Payment must be made 7 days from the delivery date. Late payment fees will incur after 21 days.", 0, 0, 'R');
        
        
        $pdf->Ln(5);
        $remittance_email = $settingsData['remittance_email'];
        $email_length = strlen($remittance_email);
        if($email_length > 30){
        $pdf->SetFont("Montserrat", '', 8);
        $pdf->Cell(123, 4, 'Please email the remittance to:   ', 0, 0,'R');
        $pdf->SetFont("MontserratB", '', 8);
        $pdf->Cell(67, 4,$remittance_email, 0, 0,'R');     
        }else{
           $pdf->SetFont("Montserrat", '', 8);
        $pdf->Cell(138, 4, 'Please email the remittance to: ', 0, 0,'R');
        $pdf->SetFont("MontserratB", '', 8);
        $pdf->Cell(52, 4,$remittance_email, 0, 0,'R');  
        }
       
        
        $pdf->Ln(4);
        $pdf->SetFont("Montserrat", '', 8.5);
        $pdf->Cell(190, 4, 'Please ensure to add the Invoice Number in the Payment Reference', 0, 0,'R');
        
        return $pdf;
  
	}
	
	public function sendInvoice() {
        $order_id = $this->input->post('order_id');
        $email = $this->input->post('email');
        $customerName = $this->input->post('customer_name');
        $pdf = $this->generateInvoice($order_id);
        // Save PDF to file
        $pdfFilePath = FCPATH . 'uploads/invoice_' . $order_id . '.pdf';
        $pdf->Output($pdfFilePath, 'F');

        // Send email with PDF attachment
        $body =   'Dear ' . $customerName . ',<br><br>Please find attached the invoice for your recent order.<br><br>Best regards,<br>Bizadmin';
        $replyToEmail = $this->sendFromMail();  
        $this->sendEmail($email,'Invoice for your Order',$body,$this->session->userdata('mail_from'),'','',$pdfFilePath,$replyToEmail);

        echo json_encode(['status' => 'success']);
    }
    
    public function cateringCheckList($order_id){
       
	    $conditionsOrder = array('order_id' => $order_id);
	    $result =$this->common_model->fetchRecordsDynamically('Catering_catering_checklist','', $conditionsOrder);
	    $where = array('order_id' => $order_id);
	    $fields = 'Catering_orders.order_id,Catering_orders.delivery_date,Catering_orders.status,Catering_orders.delivery_notes,Catering_orders.delivery_contact,Catering_orders.shipping_method,Catering_orders.delivery_address,Catering_company.company_address';
	    $order_info=$this->orders_model->fetchOrders($where,$fields);
	  	$data['order_info'] = reset($order_info);
	  	

	    $data['catering_checkList'] = $result;
	    $data['order_id'] = $order_id;
	   //echo "<pre>"; print_r($data); exit;
	   $this->load->view('general/header');
	   $this->load->view('quote/catering_checkList',$data);
	   $this->load->view('general/footer');
	   
	}
	
	public function submitCateringCheckList(){
	    
	    $checklist_status = 0;
	    $checklistSection1 = 0;
	    $checklistSection2 = 0;
	    $checklistSection3 = 0;
	    $checklistSection4 = 0;
	    
	    
	   if (isset($_POST['catering_location']) && $_POST['catering_location'] == '1') {
    $data['catering_location'] = $_POST['catering_location']; 
    $checklistSection1++;
} else {
    $data['catering_location'] = '';
}

if (isset($_POST['catering_time']) && $_POST['catering_time'] == '1') {
    $data['catering_time'] = $_POST['catering_time']; 
    $checklistSection1++;
} else {
    $data['catering_time'] = '';
}

if (isset($_POST['catering_people']) && $_POST['catering_people'] == '1') {
    $data['catering_people'] = $_POST['catering_people']; 
    $checklistSection1++;
} else {
    $data['catering_people'] = '';
}

if (isset($_POST['catering_delivery_instructions']) && $_POST['catering_delivery_instructions'] == '1') {
    $data['catering_delivery_instructions'] = $_POST['catering_delivery_instructions']; 
    $checklistSection1++;
} else {
    $data['catering_delivery_instructions'] = '';
}

if (isset($_POST['catering_dietary_req']) && $_POST['catering_dietary_req'] == '1') {
    $data['catering_dietary_req'] = $_POST['catering_dietary_req']; 
    $checklistSection1++;
} else {
    $data['catering_dietary_req'] = '';
}

if (isset($_POST['day_before_location']) && $_POST['day_before_location'] == '1') {
    $data['day_before_location'] = $_POST['day_before_location']; 
    $checklistSection2++;
} else {
    $data['day_before_location'] = '';
}

if (isset($_POST['day_before_time']) && $_POST['day_before_time'] == '1') {
    $data['day_before_time'] = $_POST['day_before_time']; 
    $checklistSection2++;
} else {
    $data['day_before_time'] = '';
}

if (isset($_POST['day_before_people']) && $_POST['day_before_people'] == '1') {
    $data['day_before_people'] = $_POST['day_before_people']; 
    $checklistSection2++;
} else {
    $data['day_before_people'] = '';
}

if (isset($_POST['day_before_delivery_instructions']) && $_POST['day_before_delivery_instructions'] == '1') {
    $data['day_before_delivery_instructions'] = $_POST['day_before_delivery_instructions']; 
    $checklistSection2++;
} else {
    $data['day_before_delivery_instructions'] = '';
}

if (isset($_POST['day_before_dietary_req']) && $_POST['day_before_dietary_req'] == '1') {
    $data['day_before_dietary_req'] = $_POST['day_before_dietary_req']; 
    $checklistSection2++;
} else {
    $data['day_before_dietary_req'] = '';
}

if (isset($_POST['delivery_day_check_everything']) && $_POST['delivery_day_check_everything'] == '1') {
    $data['delivery_day_check_everything'] = $_POST['delivery_day_check_everything']; 
    $checklistSection3++;
} else {
    $data['delivery_day_check_everything'] = '';
}

if (isset($_POST['delivery_day_others']) && $_POST['delivery_day_others'] == '1') {
    $data['delivery_day_others'] = $_POST['delivery_day_others']; 
    $checklistSection3++;
} else {
    $data['delivery_day_others'] = '';
}

if (isset($_POST['delivery_day_start_packing']) && $_POST['delivery_day_start_packing'] == '1') {
    $data['delivery_day_start_packing'] = $_POST['delivery_day_start_packing']; 
    $checklistSection3++;
} else {
    $data['delivery_day_start_packing'] = '';
}

if (isset($_POST['delivery_day_call_customer']) && $_POST['delivery_day_call_customer'] == '1') {
    $data['delivery_day_call_customer'] = $_POST['delivery_day_call_customer']; 
    $checklistSection3++;
} else {
    $data['delivery_day_call_customer'] = '';
}

if (isset($_POST['kitchen_catering_labels']) && $_POST['kitchen_catering_labels'] == '1') {
    $data['kitchen_catering_labels'] = $_POST['kitchen_catering_labels']; 
    $checklistSection4++;
} else {
    $data['kitchen_catering_labels'] = '';
}

if (isset($_POST['kitchen_check_dietary']) && $_POST['kitchen_check_dietary'] == '1') {
    $data['kitchen_check_dietary'] = $_POST['kitchen_check_dietary']; 
    $checklistSection4++;
} else {
    $data['kitchen_check_dietary'] = '';
}

if (isset($_POST['kitchen_check_all_items']) && $_POST['kitchen_check_all_items'] == '1') {
    $data['kitchen_check_all_items'] = $_POST['kitchen_check_all_items']; 
    $checklistSection4++;
} else {
    $data['kitchen_check_all_items'] = '';
}

if (isset($_POST['kitchen_staff_name']) && $_POST['kitchen_staff_name'] != '') {
    $data['kitchen_staff_name'] = $_POST['kitchen_staff_name'];
} else {
    $data['kitchen_staff_name'] = '';
}

	    
	    $checklistSectionCount = 0;
	    if($checklistSection1 == 5){
	        $checklistSectionCount++;
	    }
	    if($checklistSection2 == 5){
	        $checklistSectionCount++;
	    }
	    if($checklistSection3 == 4){
	        $checklistSectionCount++;
	    }
	    if($checklistSection4 == 3){
	        $checklistSectionCount++;
	    }
	    if($checklistSectionCount == 1){
            $checklist_status = 1;
        }elseif($checklistSectionCount == 2){
            $checklist_status = 2;
        }elseif($checklistSectionCount == 3){
            $checklist_status = 3;
        }elseif($checklistSectionCount == 4){
            $checklist_status = 4;
        }
        
        // echo "<pre>"; print_r($_POST); exit;
	    $order_id = $_POST['order_id'];
	    $conditionsOrder = array('order_id' => $order_id);
	    $res = $this->common_model->fetchRecordsDynamically('Catering_catering_checklist','', $conditionsOrder); 
	    
	     $where = array('order_id' => $order_id );
	    if(!empty($res)){
	      $this->common_model->commonRecordUpdate('Catering_catering_checklist', 'order_id',$order_id,$data);
	    }else{
	     $data['order_id'] = $order_id;
	     $this->common_model->commonRecordCreate('Catering_catering_checklist', $data); 
	    }
	      $orderdata['is_catering_checklist_added'] = $checklist_status;
	      $this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$order_id,$orderdata);
	    
	    redirect('Catering/112');
	}
	
    
    
    public function borderpdf($pdf){
	     $width=$pdf->GetPageWidth(); // Width of Current Page
        $height=$pdf->GetPageHeight(); // Height of Current Page
        $edge=2; // Gap between line and border , change this value
        $pdf->Line($edge, $edge,$width-$edge,$edge); // Horizontal line at top
        $pdf->Line($edge, $height-$edge,$width-$edge,$height-$edge); // Horizontal line at bottom
        $pdf->Line($edge, $edge,$edge,$height-$edge); // Vetical line at left 
        $pdf->Line($width-$edge, $edge,$width-$edge,$height-$edge); // Vetical line at Right
	}
	

	function collectPayment($orderId){
	 
     $orderTotal = $this->genric_model->calculateOrderTotal($orderId);
     $data['orderTotal'] = $orderTotal;
     $data['orderId'] = $orderId;
     $this->load->view('general/header');
	 $this->load->view('quote/collectPayment',$data);  
	 $this->load->view('general/footer');
	}
	
	function sendFromMail(){
	    
	$whereS = array('location_id' => $this->selected_location_id);
    $settingsData = $this->common_model->fetchRecordsDynamically('Catering_settings',['remittance_email'],$whereS); 
    $replyToEmail = (isset($settingsData[0]['remittance_email']) ? $settingsData[0]['remittance_email'] : '');  
    return $replyToEmail;
	}
	
	function paymentProcess(){
	    
	    if($_POST['rescode']=='00'||$_POST['rescode']=='08'||$_POST['rescode']=='11'){
			$data['status'] = 2;
			$where = array('order_id' => $_POST['refid']);
			$this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$_POST['refid'],$data);
			$data['order_id'] = $_POST['refid'];
			$data['order_total'] = $this->genric_model->calculateOrderTotal($_POST['refid']);
			$data['cafeName'] = CAFENAME;
			
	       $body = $this->load->view('mail/markPaidEmail', $data,TRUE);
	       $subject= 'Bizadmin - '.$_POST["refid"];
	       $fields = 'Catering_orders.location_id';
	        $order_info = $this->orders_model->fetchOrders($where, $fields);
            $order_info = reset($order_info);
	        $replyToEmail = $this->sendFromMail();  
	        $emailToList = array($order_info["customer_email"]);   
	     
	      
	        $this->sendEmail($emailToList,$subject,$body);
	        
			redirect('/Catering/pastOrder');
		}
		else{
        echo "Payment failed ! Please try again";
		}
	}
	
	
	function reminderOrders(){
	$where = array(
    'Catering_orders.delivery_date <=' => date('Y-m-d', strtotime('-6 days')),
    'Catering_orders.status !=' => 2,
    'Catering_orders.is_quote =' => 0
     );
     $data['selectedLocationBeingEdited'] = '';
     $fields = 'Catering_orders.order_id,Catering_orders.location_id,Catering_orders.isMailSent,Catering_orders.delivery_date,Catering_orders.status,Catering_orders.delivery_notes,Catering_orders.delivery_contact,Catering_orders.shipping_method,Catering_orders.delivery_address,Catering_company.company_address';
     $data['unpaid_orders'] = $this->orders_model->fetchOrders($where, $fields);
     $data['locations']=$this->common_model->fetchRecordsDynamically('Catering_locations');
     
     $this->load->view('general/header');
	 $this->load->view('quote/reminder_orders',$data); 
	 $this->load->view('general/footer');

	}
	
	function sendPaymentReminderMail(){
       $inputData = file_get_contents("php://input");
       $jsonData = json_decode($inputData, true);
       $orderIds = $jsonData['checkedValues'];
       
    if(!empty($orderIds)){

       $updateData['isMailSent'] = 'Yes';   
       foreach ($orderIds as $unpaid_orderID) {
         $this->sendReminderMaillLink($unpaid_orderID);
        }
      $this->db->where_in('order_id', $orderIds);
      $this->db->update('Catering_orders', $updateData);
       }
    //   echo "<pre>"; print_r($data['unpaid_orders']); exit;
       
   }
   
   public function sendReminderMaillLink($order_id)
   {   
	   
	 $where = array(
    'Catering_orders.order_id' => $order_id,
    'Catering_orders.status !=' => 2
     );
     
     $fields = 'Catering_orders.order_id,Catering_orders.location_id,Catering_orders.isMailSent,Catering_orders.delivery_date,Catering_orders.status,Catering_orders.delivery_notes,Catering_orders.delivery_contact,Catering_orders.shipping_method,Catering_orders.delivery_address,Catering_company.company_address';
     $order_info = $this->orders_model->fetchOrders($where, $fields);
     $order_info = reset($order_info);
     
	    $data['download_link'] = '';
	    $data['paymentLink'] = $this->generatePaymentLink($order_id);
	    $subject= CAFENAME.'- '.$order_id;
		$data['order_id'] = $order_id;
		$data['total'] = $this->genric_model->calculateOrderTotal($order_id);
	    $data['customer_name']  = $order_info['fullname'];
		$body = $this->load->view('mail/payment_link_email', $data,TRUE);
	    $emailToList = $order_info['customer_email']; 
	    $replyToEmail = $this->sendFromMail();
	    
	     $pdf = $this->generateInvoice($order_id);
         $pdfFilePath = FCPATH . 'uploads/invoice_' . $order_id . '.pdf';
         $pdf->Output($pdfFilePath, 'F');
        
		MailSendData($body,$emailToList,$subject,$replyToEmail,$pdfFilePath);
	    
	    return true;
           
	}
	
	public function uploadOrderImage($order_id){
	    $data['order_id'] = $order_id; 
	    $this->load->view('general/header');
	    $this->load->view('order/uploadOrderImage',$data);
	    $this->load->view('general/footer');
	}
	
	public function viewOrderImage($order_id){
	    $data['order_id'] = $order_id;
	    $conditions = array('order_id' => $order_id);
	    $data['orderImages'] = $this->common_model->fetchRecordsDynamically('Catering_order_images', '',$conditions);
	    $this->load->view('general/header');
	    $this->load->view('order/viewOrderImage',$data);
	    $this->load->view('general/footer');
	}
	
		public function saveUploadedFile(){
	   
	    $order_id = $_POST['order_id'];
	    $data = [];
	   
         $count = count($_FILES['hc_image']['name']);
       $failedUploadImageCount = 0;
       $successfullyUploadedImageCount = $count;
        for ($i = 0; $i < $count; $i++) {
        if (!empty($_FILES['hc_image']['name'][$i])) {
        // Create a new instance of the CI_Upload library for each iteration
        $this->load->library('upload');

        // Create a new $_FILES array for each iteration
        $fileData = array(
            'name'     => $_FILES['hc_image']['name'][$i],
            'type'     => $_FILES['hc_image']['type'][$i],
            'tmp_name' => $_FILES['hc_image']['tmp_name'][$i],
            'error'    => $_FILES['hc_image']['error'][$i],
            'size'     => $_FILES['hc_image']['size'][$i]
        );

        $_FILES['file'] = $fileData;

        $config['upload_path']   = './uploadedFiles/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
        $config['max_size']       = '500000';
        $config['file_name']      = $_FILES['hc_image']['name'][$i];

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $uploadData = $this->upload->data();
            $data['order_image']   = $uploadData['file_name'];
            $data['order_id'] = $order_id;
	        $this->common_model->commonRecordCreate('Catering_order_images', $data); 
            $this->session->set_flashdata('msg', 'Image successfully uploaded for OrderId: '.$order_id);
            
            // Process the uploaded file, save to the database, etc.
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg', 'Error: Failed to upload image for OrderId: '.$order_id);
            $failedUploadImageCount++;
            // echo $this->upload->display_errors();
          
            // Handle the upload error
        }
    }
   }
       if($failedUploadImageCount > 0){
       echo $failedUploadImageCount. " Image upload failed.";
       echo "</br>";
       $successfullyUploadedImageCount = $count - $failedUploadImageCount;
       }
        echo $successfullyUploadedImageCount . 'Image successfully uploaded for OrderId: '.$order_id;
	    }
	
	
	// Coupon related code start here ======================================== COUPONS 
	
	
	function couponsList(){
	     
	     $conditions = array('status' => 1);
	     $data['coupons'] = $this->common_model->fetchRecordsDynamically('Catering_coupon', '',$conditions);
	     
	    if(isset($_POST['coupon_id']) && $_POST['coupon_id'] !=''){
	       // for updating 
	     $conditionsCoupon = array('coupon_id' => $_POST['coupon_id']);
	     unset($_POST['coupon_id']);
         $this->common_model->commonRecordUpdate('Catering_coupon', 'coupon_id',$_POST['coupon_id'],$_POST);
	     redirect('/Catering/coupons');
	    }else if(isset($_POST['coupon_code']) && $_POST['coupon_code'] !=''){
	   // for validating if coupon code  already exist     
	     $where = array('coupon_code' => $_POST['coupon_code']);   
	     $result = $this->common_model->fetchRecordsDynamically('Catering_coupon','', $where);   
	     if(empty($result)){
	     $this->common_model->commonRecordCreate('Catering_coupon', $_POST);
	     redirect('/Catering/coupons');
	     }else{
	     $this->session->set_flashdata('couponMessage', 'Coupon code already exist.');    
	     $this->load->view('general/header');
	     $this->load->view('coupon/couponsList',$data);   
	     $this->load->view('general/footer');
	     }
	     
	     }else{
        $this->load->view('general/header');
		$this->load->view('coupon/couponsList',$data);   
		$this->load->view('general/footer');
	    }
	}
	
	function couponsStatusUpdate($couponId,$status=1){
	    $data['status'] = $status;
        $where = array('coupon_id' => $couponId);
        $this->common_model->commonRecordUpdate('Catering_coupon','coupon_id', $couponId,$data);
        redirect('/Catering/coupons');
	}
	
	
	function validateCoupon($code=''){
	   $conditions = array('coupon_code' => $code);
	   $result = $this->common_model->fetchRecordsDynamically('Catering_coupon','', $conditions);
	   echo (!empty($result) ? json_encode($result) :  0);
	}
	function removeCoupon($orderId){
	    $data['coupon_id'] = ''; $data['coupon_code'] = '';
        $where = array('order_id' => $orderId);
        $this->common_model->commonRecordUpdate('Catering_orders', 'order_id',$orderId,$data);
        echo "success";
	}
	
	public function reorder()
    {
    $order_id = $this->input->post('order_id');
    $delivery_date = $this->input->post('delivery_date');
    $delivery_time = $this->input->post('delivery_time');

    $new_order_id = $this->orders_model->reorder($order_id, $delivery_date, $delivery_time);

    if ($new_order_id) {
        echo json_encode(['status' => 'success', 'new_order_id' => $new_order_id]);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

	
}