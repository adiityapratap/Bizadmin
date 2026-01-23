<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


     function viewOrderDetails($orderId){
         
     // Fetch data from the database
     $this->tenantDb->select('Catering_order_product.*, Catering_orders.*, Catering_product.product_name,Catering_customer.firstname,Catering_customer.email as customer_email,Catering_customer.telephone as customer_telephone, Catering_customer.lastname, Catering_company.company_name, Catering_department.department_name');
     $this->tenantDb->from('Catering_orders');
     $this->tenantDb->join('Catering_customer', 'Catering_orders.customer_id = Catering_customer.customer_id');
     $this->tenantDb->join('Catering_company', 'Catering_customer.company_id = Catering_company.company_id');
     $this->tenantDb->join('Catering_department', 'Catering_customer.department = Catering_department.department_id');
     $this->tenantDb->join('Catering_order_product', 'Catering_orders.order_id = Catering_order_product.order_id');
     $this->tenantDb->join('Catering_product', 'Catering_product.product_id = Catering_order_product.product_id');
     $this->tenantDb->where('Catering_orders.order_id', $orderId);
     $this->tenantDb->order_by('Catering_order_product.sort_order', 'ASC');
     $query = $this->tenantDb->get();
     
    //  echo $this->tenantDb->last_query(); exit;

    // Get the results
    $results = $query->result_array();

   // Initialize an array to hold the structured data
   $structuredData = [];
  
  // Iterate through results to structure the data
    foreach ($results as $row) {
    $orderId = $row['order_id'];

    // Check if the order ID already exists in the structured data
    if (!isset($structuredData[$orderId])) {
        // Initialize the order entry
        $structuredData[$orderId] = [
            'order_id' => $row['order_id'],
            'coupon_id' => $row['coupon_id'],
            'customer_id' => $row['customer_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'customer_email' => $row['customer_email'],
            'customer_telephone' => $row['customer_telephone'],
            'company_name' => $row['company_name'],
            'department_name' => $row['department_name'],
            'delivery_fee' => $row['delivery_fee'],
            'status' => $row['status'],
            'date_added' => $row['date_added'],
            'date_modified' => $row['date_modified'],
            'delivery_date' => $row['delivery_date'],
            'delivery_time' => $row['delivery_time'],
            'order_comments' => $row['order_comments'],
            'delivery_address' => $row['delivery_address'],
            'pickup_location' => $row['pickup_location'],
            'accounts_email' => $row['accounts_email'],
            'cost_center' => $row['cost_center'],
            'approval_comments' => $row['approval_comments'],
            'mark_paid_comment' => $row['mark_paid_comment'],
            'delivery_contact' => $row['delivery_contact'],
            'is_catering_checklist_added' => $row['is_catering_checklist_added'],
            'is_completed' => $row['is_completed'],
            'order_total' => $row['order_total'],
            'late_fee' => $row['late_fee'],
            'location_id' => $row['location_id'],
            'delivery_notes' => $row['delivery_notes'],
            'shipping_method' => $row['shipping_method'],
            'is_quote' => $row['is_quote'],
             'company_id' => $row['company_id'],
             'department_id' => $row['department_id'],
            'products' => [] // Initialize the products array
        ];
    }

    // Add the product to the order's products array
    $structuredData[$orderId]['products'][] = [
        'order_product_id' => $row['order_product_id'],
        'is_prepared' => $row['is_prepared'],
        'product_id' => $row['product_id'],
        'product_name' => $row['product_name'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'total' => $row['total'],
        'sort_order' => $row['sort_order'],
        'order_product_comment' => $row['order_product_comment'],
        'exclude_GST' => $row['exclude_GST']
       
    ];
}

// Now $structuredData contains the desired format
return $structuredData;



}

// $fieldsToFetch = 'company_name, company_phone, company_address'; pass in this format
    public function fetch_records($table, $conditions = array(),$fieldsToFetch='*',$order_by='') {
        if (empty($table)) {
            return false;
        }
        $this->tenantDb->select($fieldsToFetch);
        if (!empty($conditions) && is_array($conditions)) {
            $this->tenantDb->where($conditions);
        }
        if (!empty($order_by)) {
            $this->tenantDb->order_by($order_by);
        }
        $query = $this->tenantDb->get($table);
        
         if ($query === false) {
         log_message('error', 'Database error: ' . $this->tenantDb->last_query());
        return false;
          }
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

 // this is common method to get order total from anyehere
    function calculateOrderTotal($orderId){
        // any logic chnage for order total caluclations needs to done just here, like in future we have to add late fee, surcharge, handling fee etc
        $where = array('Catering_orders.order_id =' => $orderId);    
        $fields = 'Catering_orders.late_fee,Catering_orders.order_total,Catering_orders.delivery_fee,Catering_orders.coupon_id';
        $orderDetails = $this->fetch_records('Catering_orders',$where, $fields);
        $orderDetails = reset($orderDetails);
        
        $orderTotal = $orderDetails['order_total'] + $orderDetails['delivery_fee'] + $orderDetails['late_fee'];
        // echo $orderTotal; exit;
        // add coupon discount logic here once coupon feature is implemented
        if(isset($orderDetails['coupon_id']) && $orderDetails['coupon_id'] !=''){
        $Cfields = 'coupon_code,coupon_discount,type';
        $Cwhere = array('coupon_id =' => $orderDetails['coupon_id']);    
        $couponDetails = $this->fetch_records('Catering_coupon',$Cwhere, $Cfields); 
       
        if(!empty($couponDetails)){
         $couponDetails = reset($couponDetails);
         if($couponDetails['type'] == 'F'){
          $couponDiscountAmount = $couponDetails['coupon_discount'];   
         }else{
         $couponDiscountAmount =  ($orderDetails['order_total'] *$couponDetails['coupon_discount'])/100;
         }
            
        }else{
            $couponDiscountAmount  = 0;
        }
        // echo "<pre>"; print_r($orderDetails); exit;
        // echo $orderTotal; echo $couponDiscountAmount; exit;
        $orderTotal = $orderTotal - $couponDiscountAmount;
        }
       
      return  number_format($orderTotal, 2, '.', '');
            }

    

    
}

?>