<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
   
     // place order
	public function sendOrder($data){
	     $this->tenantDb->insert('SUPPLIERS_orders', $data);
	     return $this->tenantDb->insert_id();

	}
	public function orderCommonUpdate($id,$data){
   $this->tenantDb->where('id', $id);
   $this->tenantDb->update('SUPPLIERS_orders', $data);   
	}
	
   public function orderProductsCommonUpdate($order_id,$product_id,$data){
   $this->tenantDb->where('order_id', $order_id);
   $this->tenantDb->where('product_id', $product_id);
   $this->tenantDb->update('SUPPLIERS_orderDetails', $data);   
	}
	
	public function insertOrderProduct($data,$product_id=''){
	    if($product_id!=''){
	        
	    $query = "SELECT qty FROM `SUPPLIERS_orderDetails` WHERE order_id = ".$data['order_id']." AND product_id=".$product_id;

        $query=$this->tenantDb->query($query);
        $res = $query->row();
        // echo "<pre>";
        // print_r($res); exit;
        if(!empty($res) || ((isset($res->qty) && $res->qty > 0))){
            // $updateData['qty'] = $res->qty + $data['qty'];
            $updateData['qty'] = $data['qty'];
            $this->tenantDb->where('product_id', $data['product_id']);
            $this->tenantDb->where('order_id', $data['order_id']);
            $this->tenantDb->update('SUPPLIERS_orderDetails', $updateData);
           
        }else{
	     $this->tenantDb->insert('SUPPLIERS_orderDetails', $data);
        }
        }else{
         $this->tenantDb->insert('SUPPLIERS_orderDetails', $data);    
        }
	     return true;

	}
	public function getOrders($where = array(),$sortBy='') {
    $this->tenantDb->distinct();
    $this->tenantDb->select('o.*, SL.supplier_name,osl.status_name');
    $this->tenantDb->from('SUPPLIERS_orders o');
    $this->tenantDb->join('SUPPLIERS_orderDetails od', 'o.id = od.order_id', 'left');
    $this->tenantDb->join('SUPPLIERS_orderStatusList osl', 'o.status = osl.order_status_id', 'left');
    $this->tenantDb->join('SUPPLIERS_suppliersList SL', 'o.supplier_id = SL.supplier_id', 'left');
    if($sortBy !=''){
    $this->tenantDb->order_by($sortBy, 'asc');    
    }
    $this->tenantDb->where('o.location_id', $this->location_id);
    
    // Add conditions from the $where array
    if (!empty($where)) {
        foreach ($where as $key => $value) {
            if (is_array($value)) {
                // If the value is an array, use where_in
                $this->tenantDb->where_in($key, $value);
            } else {
                // Otherwise, use regular where
                $this->tenantDb->where($key, $value);
            }
        }
    }

    $query = $this->tenantDb->get();
    // echo $query = $this->tenantDb->last_query(); exit;
    return $result = $query->result_array();
}
    
    public function getOrderDetails($orderID){
     
    $this->tenantDb->select('o.*, SL.supplier_name,SL.requireTC,osl.status_name,sp.product_name,sp.product_code,od.product_id,od.is_approved,od.qty,od.product_unit_price,od.total as itemTotal');
    $this->tenantDb->from('SUPPLIERS_orders o');
    $this->tenantDb->join('SUPPLIERS_orderDetails od', 'o.id = od.order_id', 'left');
    $this->tenantDb->join('SUPPLIERS_products sp', 'sp.product_id = od.product_id', 'left');
    $this->tenantDb->join('SUPPLIERS_orderStatusList osl', 'o.status = osl.order_status_id', 'left');
    $this->tenantDb->join('SUPPLIERS_suppliersList SL', 'o.supplier_id = SL.supplier_id', 'left');
    $this->tenantDb->where('o.id', $orderID);

    $query = $this->tenantDb->get();
    // echo $query = $this->tenantDb->last_query(); exit;
    return $result = $query->result_array();  
    }
    
    // only limited data we need while updating a order
    public function getOrderInfo($orderID){
     
    $this->tenantDb->select('o.delivery_date,o.delivery_info,o.order_comments');
    $this->tenantDb->from('SUPPLIERS_orders o');
    $this->tenantDb->where('o.id', $orderID);
    $query = $this->tenantDb->get();
    // echo $query = $this->tenantDb->last_query(); exit;
    return $result = $query->result_array();  
    }
    
     public function getOrderItems($orderID){
     
    $this->tenantDb->select('qty,product_id');
    $this->tenantDb->from('SUPPLIERS_orderDetails');
    $this->tenantDb->where('order_id', $orderID);
    $query = $this->tenantDb->get();
    // echo $query = $this->tenantDb->last_query(); exit;
    return $result = $query->result_array();  
    }
    
    public function deleteOrderProduct($productId='',$order_id){
        $this->tenantDb->where('order_id', $order_id);
        if($productId !=''){
       $this->tenantDb->where('product_id', $productId);     
        }
      $this->tenantDb->delete('SUPPLIERS_orderDetails');
      return true;
    }
    
    function fetchMonthlyOrderTotals() {
    try {
        // Fetch sum of order totals monthly
        $this->tenantDb->select('MONTH(delivery_date) as month, SUM(order_total) as monthlyTotal');
        $this->tenantDb->from('SUPPLIERS_orders');
        $this->tenantDb->where('location_id', $this->location_id);
        $this->tenantDb->group_by('MONTH(delivery_date)');
        $query = $this->tenantDb->get();

        $monthlyOrderTotals = [];
   
        if ($query->num_rows() > 0) {
            $result = $query->result();
        //   echo "<pre>";  print_r($result); exit;
            // Initialize an array with default values for each month
            $monthlyOrderTotals = array_fill_keys(range(1, 12), 0);

            foreach ($result as $row) {
                $month = $row->month;
                $monthlyTotal = $row->monthlyTotal;

                // Update the array with the fetched total for the corresponding month
                $monthlyOrderTotals[$month] = $monthlyTotal;
            }
        }

        return $monthlyOrderTotals;
    } catch (Exception $e) {
        // Handle database errors here
        return [];
    }
}


	
	}
	?>