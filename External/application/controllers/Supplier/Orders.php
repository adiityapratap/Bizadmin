<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH.'third_party/phpmailer/src/Exception.php';
require APPPATH.'third_party/phpmailer/src/PHPMailer.php';
require APPPATH.'third_party/phpmailer/src/SMTP.php';
class Orders extends CI_Controller {

	function __construct() {
		parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('order_model');
	    $this->load->model('common_model');
	    if($this->session->userdata('tenantIdentifier')!=''){
	        initializeTenantDbConfig($this->session->userdata('tenantIdentifier'));
	    }
	}
	public function viewOrder($doubleEncodedParams)
	{ 
	       $decodedParams = urldecode(urldecode(urldecode($doubleEncodedParams)));
           $decryptedParams = $this->encryption->decrypt($decodedParams);
           list($tenantIdentifier, $orderId, $actionType) = explode('|', $decryptedParams);
           $this->session->set_userdata('tenantIdentifier',$tenantIdentifier);
     	   initializeTenantDbConfig($tenantIdentifier);
	  
	       $orderData = $this->order_model->getOrders($orderId); 

	      if(isset($orderData) && !empty($orderData)){
	       foreach($orderData as $index => $orderDt){
	           $supplierId = $orderDt['supplier_id'];
	           if(isset($orderDt['tier_type']) && $orderDt['tier_type'] == 't1'){
	            $conditions = array('product_UOM_id' => $orderDt['each_unit_uom']);   
	           }else{
	           $conditions = array('product_UOM_id' => $orderDt['cafe_unit_uom']);    
	           }
	      $UomResultName = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', ['product_UOM_name'], $conditions); 
	      $orderData[$index]['product_UOM_name'] = $UomResultName[0]['product_UOM_name'];
	       }
        // echo "<pre>"; print_r($orderData); exit;
	   $data['orderData'] =  $orderData; 
	   $locationId = (isset($data['orderData'][0]['location_id']) ? $data['orderData'][0]['location_id'] : '');
	   $configurationData = $this->order_model->getConfiguration('settings',$locationId);
       $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
       $data['cafeEmail'] = (isset($configData['email']) ? $configData['email'] : '');
       $data['cafeContactNumber'] = (isset($configData['phone']) ? $configData['phone'] : '');
       $data['orzName'] = (isset($configData['orzName']) ? $configData['orzName'] : '');
    //   echo $locationId;
      
	   $updateData['status'] = 2; // 2 = viewed
	   $this->order_model->updateOrder($orderId,$updateData); 
	   // action post order approval 
	   
	    $dataToUpdateForSupp['last_order_date'] = date('Y-m-d');
        $dataToUpdateForSupp['is_completed'] = 0;
	   $this->common_model->commonRecordUpdate('SUPPLIERS_suppliersList','supplier_id',$supplierId,$dataToUpdateForSupp);
	    $this->order_model->resetStockCount($supplierId);
	   
	   // END
	   
	   $data['headerTitle'] = 'Order Info';
	   
	   // if actionType is true than supplier need to confirm else supplier need to attach invoice
	   $data['actionType'] = $actionType;
	   //echo "<pre>"; print_r($data['orderData']); exit;
	   $this->load->view('general/header',$data);
	   $this->load->view('Supplier/Orders/viewOrder',$data);
	    $this->load->view('general/footer');
	   }else{
	       echo "Order has been cancelled by supplier"; exit;
	   }
	  
	}
	
	public function confirmOrder(){
	    $orderId = $this->input->post('order_id');
	    $supplierId = $this->input->post('supplierId');
	    initializeTenantDbConfig($this->session->userdata('tenantIdentifier'));
	     $updateData['supplierComments']  = $this->input->post('supplierComments'); 
	   //  $updateData['is_completed']  = 0;
	     $updateData['status'] = 3; // 2 = Confirmed
	    
	    $this->order_model->updateOrder($orderId,$updateData); 
	    $this->order_model->updateStock($supplierId);
	    $this->order_model->updateStockDetails($supplierId);
	    
	    // After orders is placed/ sent reset all the stock count and Order Qty to 0 so that they can again to do the fresh stock counting
	}
	
	public function uploadInvoice()
   {
    
    $tennantFolderName = $this->session->userdata('tenantIdentifier');
    $upload_path = dirname(FCPATH)  . '/uploaded_files/'.$tennantFolderName.'/Supplier/Invoices/';
  
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0755, true);
    }

    // Load CodeIgniter's upload library
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx';
    $config['max_size'] = 9048; // 9MB max size

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('orderInvoice')) {
        $data = $this->upload->data();
        
         $updateData['invoice'] = $data['file_name']; 
         $updateData['status'] = 7;
         $orderId = $this->input->post('orderId');
	    $this->order_model->updateOrder($orderId,$updateData); 
	    
        echo json_encode([
            'status' => 'success',
            'file_name' => $data['file_name'],
            'full_path' => $data['full_path']
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => $this->upload->display_errors('', '')
        ]);
    }
}

	
	
	function approveBudgetExceedOrder($doubleEncodedParams,$orderStatus){
           
        // $decodedParams = urldecode(urldecode(urldecode($doubleEncodedParams)));
        // $decryptedParams = $this->encryption->decrypt($decodedParams);
        // list($orderId, $supplierId , $tenantIdentifier)  = explode('|', $decryptedParams);
        // check if order has already been aprprove , if yes than do not send mail
       
       
        $encryptedData = urldecode(urldecode(urldecode($doubleEncodedParams)));
        $decryptedData = json_decode($this->encryption->decrypt($encryptedData), true);
         $orderId =  $decryptedData['order_id'];
         $tenantIdentifier =  $decryptedData['tenantIdentifier'];
         $supplierId =  $decryptedData['supplierId'];
         $location_id =  $decryptedData['location_id'];
         
         
        $this->session->set_userdata('tenantIdentifier',$tenantIdentifier);
     	  initializeTenantDbConfig($tenantIdentifier);
     	  
     	  $conditions = array('status' => 1,'location_id' => $location_id,'id' =>$orderId);
     	  $fields = array('status');
        $orderDetails = $this->order_model->fetchRecordsDynamically('SUPPLIERS_orders',$fields,$conditions);
       if(!empty($orderDetails)){
           echo "Order already approved and sent to supplier"; exit;
       }
     	  
        // 5 = manager approved the order and  send mail to supplier
        if($orderStatus == 5){
        $data['status'] = 1;    
        $ressSup = $this->order_model->getSuppliers($supplierId,'supplier_name,email',$location_id);
        
        $this->sendMailToSupplier($decryptedData,$ressSup);
        $this->order_model->orderCommonUpdate($orderId,$data);
        echo "Thank You. Order has been sent to supplier."; 
        }else{
         $data['status'] = 6;    
         $this->order_model->orderCommonUpdate($orderId,$data);  
         echo "Thank You. Order has been cancelled."; 
        }
            
    }
    
    function sendMailToSupplier($decryptedData,$ressSup){
         $mail_from =  $decryptedData['mail_from'];
         $supplierId =  $decryptedData['supplierId'];
         $username =  $decryptedData['username'];
         $supplierEmail = $decryptedData['supplierMail'];
         $supplier_CCemail = $decryptedData['supplierCCMail'];
         $location_id =  $decryptedData['location_id'];   
         $order_id =  $decryptedData['order_id'];
         $tenantIdentifier =  $decryptedData['tenantIdentifier'];
         $location_name =  $decryptedData['location_name'];
         $mail_protocol = $decryptedData['mail_protocol'];
        $configurationData = $this->order_model->getConfiguration('settings',$location_id);
       $configData = (isset($configurationData[0]['data']) ? unserialize($configurationData[0]['data']) : array());
      
       $data['cafeEmail'] = (isset($configData['email']) ? $configData['email'] : '');
       $data['cafeContactNumber'] = (isset($configData['phone']) ? $configData['phone'] : '');
   

     $paramsToEncrypt = $tenantIdentifier . '|' . $order_id;
     $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
     $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
    //  $encodedParams = urlencode($encryptedParams);
     $data['orderUrl'] = base_url().'External/viewOrder/'.$encodedParams;
     $data['orzName'] = (isset($configData['orzName']) ? $configData['orzName'] : '');
     $data['locationName'] = $location_name;
     $data['cafeEmail'] = (isset($configData['email']) ? $configData['email'] : '');
     $data['cafeContactNumber'] = (isset($configData['phone']) ? $configData['phone'] : '');
     $data['supplierName'] = (isset($ressSup[0]['supplier_name']) ? $ressSup[0]['supplier_name'] : '');
     
     $mailContent = $this->load->view('Supplier/Mail/placeOrder',$data,TRUE);  
     $dataToUpdateForSupp['last_order_date'] = date('Y-m-d');
     $dataToUpdateForSupp['is_completed'] = 0;
      $this->setSmtpSettings($decryptedData); 
      
     if($this->sendEmail($supplierEmail,'New Order Received',$mailContent,$mail_from,$supplier_CCemail,$username,$mail_protocol)){
      $this->order_model->supplierCommonUPdate($supplierId,$dataToUpdateForSupp); 
       // reset the stock count of this supplier to 0 once order is placed
       $this->order_model->resetStockCount($supplierId);     
     }
      
       
     return true;
   }
    
    public function setSmtpSettings($decryptedData){
        $this->phpmailer = new PHPMailer(true);
       
        $this->phpmailer->isSMTP();
        $this->phpmailer->SMTPDebug = 0; // Set to 2 for debugging
        $this->phpmailer->Host = $decryptedData['smtp_host'];
        $this->phpmailer->Port = $decryptedData['smtp_port'];
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Username = $decryptedData['smtp_username'];
        $this->phpmailer->Password = $decryptedData['smtp_pass'];
        $this->phpmailer->SMTPSecure = 'tls';
        $this->phpmailer->CharSet = 'UTF-8';  
        
    } 
    
    public function sendEmail($to, $subject, $message,$from='',$cc='',$fromName='Bizadmin',$mail_protocol) {
    
        if ($mail_protocol == 'smtp') {
          
            

            // Receipent
            if (is_array($to)) {
               
             foreach ($to as $recipient) {
                $this->phpmailer->addAddress($recipient);
             }
              } else {
            
            $mailTo = explode(",",$to);
            if (is_array($mailTo)) {
             foreach ($mailTo as $recipient) {
                $this->phpmailer->addAddress($recipient);
             }
            }

           }
           
           //CC
           
           if($cc !=''){
             if (is_array($cc)) {
             foreach ($cc as $CCrecipient) {
                $this->phpmailer->addCC($CCrecipient);
             }
              } else {
            $this->phpmailer->addCC($cc);
           }
             
           }
           
            // $this->phpmailer->setFrom($from);
            $this->phpmailer->setFrom($from, $fromName);
            $this->phpmailer->isHTML(true); 
            $this->phpmailer->Subject = $subject;
            $this->phpmailer->Body = $message;

            if ($this->phpmailer->send()) {
                // echo "success mail sent"; exit;
                return true; // Email sent successfully
            } else {
                // echo "failed"; exit;
                return true; // Email sending failed
            }
        } else {
            // Fallback to CodeIgniter's Email library for mail protocol
            $this->load->library('email');

            // $this->email->from('your-email@example.com', 'Your Name');
            if (is_array($to)) {
            foreach ($to as $recipient) {
                $this->email->to($recipient);
            }
             } else {
            $this->email->to($to);
           }
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                return true; // Email sent successfully
            } else {
                return false; // Email sending failed
            }
        }
    }
	

}

?>