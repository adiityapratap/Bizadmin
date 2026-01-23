<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Genric_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_record($table, $data) {
        
        if (empty($table) || empty($data) || !is_array($data)) {
            return false;
        }
        // Insert data into the specified table
        if ($this->tenantDb->insert($table, $data)) {
            return $this->tenantDb->insert_id(); 
        } else {
            return false;
        }
    }

    // example table = 'orders'; $data['order_status'] = 1 $where['order_id'] =2;
    
    public function update_record($table, $data, $where) {
        
    if (empty($table) || empty($data) || !is_array($data) || empty($where) || !is_array($where)) {
        return false;
    }
   
    // Update data in the specified table based on the given conditions
      $this->tenantDb->where($where);
    if ($this->tenantDb->update($table, $data)) {
        return true;
    } else {
        return false; 
    }
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
    
    
    public function bulk_insert($table_name, $data) {
        if (empty($table_name) || empty($data)) {
            return false;
        }

        // Use CodeIgniter's batch insert method
        $inserted = $this->tenantDb->insert_batch($table_name, $data);
        
        // Check if insert was successful
        if ($inserted) {
            return $this->tenantDb->affected_rows();
        } else {
            return false;
        }
    }
    
    public function deleteRecord($table, $column, $id) {
    $this->tenantDb->where($column, $id);
    $this->tenantDb->delete($table);
    return $this->tenantDb->affected_rows() > 0; // Returns true if deletion was successful
    }
    
    public function softDeleteRecord($table, $column, $id) {
    $data['status'] = 0;    
    $this->tenantDb->where($column, $id);
    $this->tenantDb->update($table, $data);
 
    return true;
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
    
    
    function fetchProductList(){
       
     $this->tenantDb->select('Catering_product.*, Catering_category.*');
     $this->tenantDb->from('Catering_product');
     $this->tenantDb->join('Catering_category', 'Catering_product.category_id = Catering_category.category_id','left');
     $this->tenantDb->where('Catering_product.status', 1);
     $this->tenantDb->order_by('Catering_category.category_name', 'ASC');
     $query = $this->tenantDb->get();
    //  echo $this->tenantDb->last_query(); exit;
     return $query->result_array();
    
    }

    
  
}
