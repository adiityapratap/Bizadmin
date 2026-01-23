<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
	public function updateStock($data,$productId){
	  
	     $this->tenantDb->where('product_id', $productId);
         $this->tenantDb->set('cafe_unit_uomCount', $data['cafe_unit_uomCount']);
         $this->tenantDb->set('inner_unit_uomCount', $data['inner_unit_uomCount']);
         $this->tenantDb->set('orderQty', $data['orderQty']);
          $this->tenantDb->set('totalStockCountTotalValue', $data['totalStockCountTotalValue']);
         $this->tenantDb->update('SUPPLIERS_productToBuilto');
	}
	
	public function insertstockDetails($data){
	    $this->tenantDb->select('id');
        $this->tenantDb->where('product_id', $data['product_id']);
        $this->tenantDb->where('area_id', $data['area_id']);
        $query = $this->tenantDb->get('SUPPLIERS_productToBuiltoToAreaQty');

        if ($query->num_rows() > 0) {
       // A record with the same product_id and area_id exists, so update it
          $existing_record = $query->row();
         $this->tenantDb->where('id', $existing_record->id);
         $this->tenantDb->set('area_count', $data['area_count']);
         $this->tenantDb->set('supplier_id', $data['supplier_id']);
         $this->tenantDb->update('SUPPLIERS_productToBuiltoToAreaQty');
          } else {
	     $this->tenantDb->insert('SUPPLIERS_productToBuiltoToAreaQty', $data);
          }
	    return true;
	}
	
	public function updateMonthlystockUpdate($data,$productId){
	    
	    $this->tenantDb->select('id');
        $this->tenantDb->where('product_id', $productId);
        $this->tenantDb->where('supplier_id', $data['supplier_id']);
        $this->tenantDb->where('month_name', date('F'));
        $this->tenantDb->where('year_name', date('Y'));
        $query = $this->tenantDb->get('SUPPLIERS_monthly_stockCount');

        if ($query->num_rows() > 0) {
       // as it is a monthly stock update, if A record with the same product_id and supplier_id exists for same month and year, so update it
          $existing_record = $query->row();
         $this->tenantDb->where('id', $existing_record->id);
         $this->tenantDb->set('opening_stock_count', $data['opening_stock_count']);
         $this->tenantDb->set('closing_stock_count', $data['closing_stock_count']);
         $this->tenantDb->set('is_completed', $data['is_completed']);
         $this->tenantDb->update('SUPPLIERS_monthly_stockCount');
          } else {
	     $this->tenantDb->insert('SUPPLIERS_monthly_stockCount', $data);
          }
	    return true;
	    
	}
	
	public function fetchProductsMonthlyStockQtyAreaWise($supplierId){
	    
	  $this->tenantDb->select('*');
      $this->tenantDb->from('SUPPLIERS_monthly_stockCount SMSC');
      $this->tenantDb->where('SMSC.supplier_id', $supplierId);
      $this->tenantDb->where('SMSC.month_name', date('F'));
      $this->tenantDb->where('SMSC.year_name', date('Y'));
      $query = $this->tenantDb->get();
      return $res = $query->result_array();
	    
	}
	
	public function calculatePurchaseUnit($productID){
	   $statusValues = array(1, 2, 3, 4);
	   $this->tenantDb->select('SUM(sod.qty) as total_qty, sod.product_id');
       $this->tenantDb->from('SUPPLIERS_orders as so');
       $this->tenantDb->join('SUPPLIERS_orderDetails as sod', 'so.id = sod.order_id', 'LEFT');
       $this->tenantDb->where_in('so.status', $statusValues);
       $this->tenantDb->where('sod.product_id', $productID);
       $this->tenantDb->where('MONTH(so.delivery_date)', date('m'));
       $this->tenantDb->where('YEAR(so.delivery_date)', date('Y'));

       $query = $this->tenantDb->get();
       $result = $query->row(); 

       return (isset($result->total_qty) ? $result->total_qty : 0);
    //   echo $query = $this->tenantDb->last_query(); exit;
       
	}
	
	public function fetchProductsStockQtyAreaWise($supplierId){
	    
	  $this->tenantDb->select('PBTAQ.area_count,PBTAQ.product_id,PBTAQ.area_id');
      $this->tenantDb->from('SUPPLIERS_productToBuiltoToAreaQty PBTAQ');
      $this->tenantDb->where('PBTAQ.supplier_id', $supplierId);
      $query = $this->tenantDb->get();
      return $res = $query->result_array();
	    
	}
	function resetStockCount($supplierId){
	    $this->tenantDb->where('supplier_id', $supplierId);
        $this->tenantDb->delete('SUPPLIERS_productToBuiltoToAreaQty');
        
        $this->tenantDb->where('supplier_id', $supplierId);
         $this->tenantDb->set('orderQty', 0);
         $this->tenantDb->set('totalStockCountTotalValue', 0);
         $this->tenantDb->update('SUPPLIERS_productToBuilto');
	    return true;
	}
	
	
     
}