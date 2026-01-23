<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
	
	function bulkUpdate($bulkData){
	   $this->tenantDb->update_batch('SUPPLIERS_products', $bulkData, 'product_id'); 
	}
	
}