<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
    public function getSuppliers($id='',$columnsToFetch='',$requireMST=''){
        if($columnsToFetch==''){
           $cols = '*'; 
        }else{
            $cols = $columnsToFetch;
        }
	   $query = "SELECT ".$cols." FROM `SUPPLIERS_suppliersList` WHERE status != 0 and is_deleted = 0 and location_id=".$this->location_id;
	 
      if ($requireMST !== null && $requireMST !== '') {
        $query .= " AND requireMST = ".$requireMST;  
      }
	  if($id !=''){
	    $query .= " AND supplier_id = ".$id;
	  }
	  
        $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
        
	}
	
	
	public function fetchAreaAssignedToThisSupplier($suppId){
    $query = "SELECT sai.supplier_id,sa.name,sa.id FROM `SUPPLIERS_areaList` sa left join SUPPLIERS_areaId_to_supplierId sai on sa.id = sai.area_id WHERE  sai.supplier_id=".$suppId;
        $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
	    
	}
	public function fetchAllAreas(){
        
	   $query = "SELECT name,id FROM `SUPPLIERS_areaList` WHERE status = 1 and is_deleted = 0  and location_id=".$this->location_id;

        $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
        
	}
	
	public function fetchSuppliersSortBYCutoffTime($branch_id,$sort_by='cutofftime',$accordingToCategory=false){
        
	   $query = "SELECT s.*,ssc.category_name as supplier_category_name,sc.category_name as main_category_name FROM `SUPPLIERS_suppliersList` s left join `SUPPLIERS_supplier_subcategories` ssc on s.category_id = ssc.id left join `SUPPLIERS_supplier_categories` sc on sc.category_id = ssc.category_id WHERE s.status = 1 and s.location_id=".$this->location_id." order by s.".$sort_by." ASC";

        $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        
        $allSuppliers = array();

      foreach ($res as $supplier) {
        $mainCategory = $supplier['main_category_name'];

        // Check if the main category key exists in the array, if not, initialize it
       if (!isset($allSuppliers[$mainCategory])) {
        $allSuppliers[$mainCategory] = array();
      }

    // Add the supplier to the corresponding main category
    $allSuppliers[$mainCategory][] = $supplier;
}
       if($accordingToCategory == false && !empty($res)){
            return $res;
       }else
        if(!empty($allSuppliers)){
            return $allSuppliers;
        }else{
            return false;
        }
        
	}
	
		public function fetchTopFiveSuppliers(){
        
	   $this->tenantDb->select('s.supplier_name, sbr.weeklyBudget, sbr.monthlyBudget, SUM(so.order_total) as totalOrder');
$this->tenantDb->from('SUPPLIERS_suppliersList s');
$this->tenantDb->join('SUPPLIERS_budgetRecord sbr', 's.supplier_id = sbr.supplier_id', 'left');
$this->tenantDb->join('SUPPLIERS_orders so', 'so.supplier_id = s.supplier_id', 'left'); // Join with SUPPLIERS_orders table

$delivery_date = date('Y-m-d');
$this->tenantDb->where('s.status', 1);
$this->tenantDb->where('s.isTopFive', 1);
$this->tenantDb->where('s.location_id', $this->location_id);
$this->tenantDb->group_start();
$this->tenantDb->where('YEARWEEK(sbr.date_entered) = YEARWEEK(' . $this->db->escape($delivery_date) . ')', null, false);
$weekNumber = date('W', strtotime($delivery_date));
$this->tenantDb->or_where('WEEK(sbr.date_entered) <=', $weekNumber);
$this->tenantDb->group_end();

$this->tenantDb->group_by('s.supplier_id'); // Group by supplier_id to get total order per supplier

$query = $this->tenantDb->get();
return $query->result_array();



        
	}
	
		public function fetchInactiveSuppliersSortBYCutoffTime($branch_id){
        
	   $query = "SELECT * FROM `SUPPLIERS_suppliersList` WHERE status = 2 and location_id=".$this->location_id." order by cutofftime ASC";

	  
        $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
        
	}
	public function fetchSuppliers($cols='*',$conditions = array()){
	    

        $this->tenantDb->select($cols);
        $this->tenantDb->from('SUPPLIERS_suppliersList');
        $this->tenantDb->where('status !=', 0);
        $this->tenantDb->where('location_id', $this->location_id);
        $this->tenantDb->where('is_deleted', 0);
        
        // Where conditions
        if (!empty($conditions)) {
            $this->tenantDb->where($conditions);
        }  

       $query = $this->tenantDb->get();

        if ($query->num_rows() > 0) {
         return $query->result_array();
         } else {
        return false;
      }
        
	}
	public function fetchDashboardSuppliers($branch_id){
	   $query = "SELECT * FROM `SUPPLIERS_suppliersList` WHERE status != 0 and location_id=".$this->location_id;
	   
        $query=$this->tenantDb->query($query);
              
        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
        
	}
	public function addSupplier($data){
        if($data['status'] == ''){
            $status = 1;
        }else{
            $status = $data['status'];
        }
    //   echo "<pre>"; print_r($data); exit;
    $insertData = array(
    'non_mandatory' => isset($data['non_mandatory']) && $data['non_mandatory'] == 'on' ? 1 : 0,
    'requireTC' => isset($data['requireTC']) && $data['requireTC'] == 'on' ? 1 : 0,
    'requireDD' => isset($data['requireDD']) && $data['requireDD'] == 'on' ? 1 : 0,
    'requirePL' => isset($data['requirePL']) && $data['requirePL'] == 'on' ? 1 : 0,
    'requireSC' => isset($data['requireSC']) && $data['requireSC'] == 'on' ? 1 : 0,
    'requireMST' => isset($data['requireMST']) && $data['requireMST'] == 'on' ? 1 : 0,
    'allowForceOrder' => isset($data['allowForceOrder']) && $data['allowForceOrder'] == 'on' ? 1 : 0,
    'account_code' => (isset($data['account_code']) ? $data['account_code'] : ''),
    'supplier_name' => (isset($data['supplier_name']) ? $data['supplier_name']: ''),
    'contact_full_name' => (isset($data['contact_full_name']) ? $data['contact_full_name']: ''),
    'email' => (isset($data['email']) ? $data['email']: ''),
    'cc' =>  isset($data['cc']) ? $data['cc'] :'',
    'cc2' => isset($data['cc2']) ? $data['cc2'] :'',
    'mobile' => isset($data['mobile']) ? $data['mobile'] :'',
    'budget_type' => isset($data['budget_type']) ? $data['budget_type'] :'',
    'category_id' => isset($data['category_id']) ? $data['category_id'] :'',
    'haccp_expiry_date' => date('Y-m-d', strtotime($data['haccp_expiry_date'])),
    'cfr_expiry_date' => date('Y-m-d', strtotime($data['cfr_expiry_date'])),
    // 'weekly_budget' => isset($data['weekly_budget']) ? $data['weekly_budget'] :'',
    // 'monthly_budget' => isset($data['monthly_budget']) ? $data['monthly_budget'] :'',
    'cutofftime' => isset($data['cutofftime']) ? $data['cutofftime'] :'',
    'status' => $status,
    'min_order' => isset($data['min_order']) ? $data['min_order'] :'',
    'delivery_info' =>isset($data['delivery_info']) ? $data['delivery_info'] :'',
    'delivery_date_type' => (isset($data['delivery_date_type']) ? $data['delivery_date_type']: ''),
    'deliveryDayFreq' => (isset($data['deliveryDayFreq']) ? $data['deliveryDayFreq'] : ''),
    'deliveryDateFreq' => (isset($data['deliveryDateFreq']) ? $data['deliveryDateFreq'] : ''),
    'storageArea' => (isset($data['storageArea']) ? serialize($data['storageArea']): ''),
    'location_id' => $this->location_id
);
 if(isset($_POST['mandatory_days']) && !empty($_POST['mandatory_days'])){
     $insertData['mandatory_days'] = serialize($_POST['mandatory_days']);
 }
$this->tenantDb->insert('SUPPLIERS_suppliersList', $insertData);
$last_inserted_areaId = $this->tenantDb->insert_id();

foreach($data['storageArea'] as $areaId){
       $storageAreaData = array(
        'supplier_id' => $last_inserted_areaId,
        'area_id' => $areaId,
    );
    $this->tenantDb->insert('SUPPLIERS_areaId_to_supplierId', $storageAreaData); 
}        
	}
	public function updateSupplier($id,$data){
         if($data['status'] == ''){
            $status = 1;
        }else{
            $status = $data['status'];
        }
       
	 $updateData = array(
    'non_mandatory' => isset($data['non_mandatory']) && $data['non_mandatory'] == 'on' ? 1 : 0,
    'requireTC' => isset($data['requireTC']) && $data['requireTC'] == 'on' ? 1 : 0,
    'requireDD' => isset($data['requireDD']) && $data['requireDD'] == 'on' ? 1 : 0,
    'requirePL' => isset($data['requirePL']) && $data['requirePL'] == 'on' ? 1 : 0,
    'requireSC' => isset($data['requireSC']) && $data['requireSC'] == 'on' ? 1 : 0,
    'requireMST' => isset($data['requireMST']) && $data['requireMST'] == 'on' ? 1 : 0,
    'allowForceOrder' => isset($data['allowForceOrder']) && $data['allowForceOrder'] == 'on' ? 1 : 0,
    'supplier_name' => $data['supplier_name'],
    'contact_full_name' => $data['contact_full_name'],
    'email' => $data['email'],
    'cc' => $data['cc'],
    'cc2' => $data['cc2'],
    'mobile' => $data['mobile'],
    'budget_type' => $data['budget_type'],
    'category_id' => $data['category_id'],
    'haccp_expiry_date' => date('Y-m-d', strtotime($data['haccp_expiry_date'])),
    'cfr_expiry_date' => date('Y-m-d', strtotime($data['cfr_expiry_date'])),
    // 'weekly_budget' => $data['weekly_budget'],
    // 'monthly_budget' => $data['monthly_budget'],
    'account_code' => $data['account_code'],
    'cutofftime' => $data['cutofftime'],
    'status' => $status,
    'min_order' => $data['min_order'],
    'delivery_info' => $data['delivery_info'],
    'storageArea' => serialize($data['storageArea']),
    'delivery_date_type' => (isset($data['delivery_date_type']) ? $data['delivery_date_type']: ''),
    'deliveryDayFreq' => (isset($data['deliveryDayFreq']) ? $data['deliveryDayFreq'] : ''),
    'deliveryDateFreq' => (isset($data['deliveryDateFreq']) ? $data['deliveryDateFreq'] : ''),
    'location_id' => $this->location_id
    );
   if(isset($_POST['mandatory_days']) && !empty($_POST['mandatory_days'])){
     $updateData['mandatory_days'] = serialize($_POST['mandatory_days']);
   }

   $this->tenantDb->where('supplier_id', $id);
   $this->tenantDb->update('SUPPLIERS_suppliersList', $updateData);
   
   
    $this->tenantDb->where('supplier_id', $id);
     $this->tenantDb->delete('SUPPLIERS_areaId_to_supplierId');
     
     foreach($data['storageArea'] as $areaId){
       $storageAreaData = array(
        'supplier_id' => $id,
        'area_id' => $areaId,
    );
    $this->tenantDb->insert('SUPPLIERS_areaId_to_supplierId', $storageAreaData);   
     }
     
   
	}
	public function supplierCommonUPdate($id,$data){
	  $this->tenantDb->where('supplier_id', $id);
   $this->tenantDb->update('SUPPLIERS_suppliersList', $data);   
	}
	
	public function supplierStatus($id,$data){
	    echo $query = "UPDATE `SUPPLIERS_suppliersList` SET `status` = '".$data['status']."' WHERE supplier_id = ".$id;
        
        return $query=$this->tenantDb->query($query);
	}
	

	public function fetchSuppliersCategory($branch_id='',$id='',$fetchAll=''){
        
	 if($fetchAll == ''){
	 $query = "SELECT * FROM `SUPPLIERS_supplier_categories` WHERE status != 0 AND  is_deleted=0 AND location_id=".$this->location_id;     
	 }else{
	 $query = "SELECT * FROM `SUPPLIERS_supplier_categories` WHERE  is_deleted=0 AND location_id=".$this->location_id;    
	 }
	    
        if($id !=''){
	        $query .= " AND category_id = ".$id;
	    }
        $query=$this->tenantDb->query($query);
              
        
         if (!$query) {
          return false;
        } else {
         $res = $query->result_array();
         return $res;
        }  
        
	}
	public function fetchSuppliersSubCategory($branch_id='',$id='',$fetchAll=''){
        
	 if($fetchAll == ''){
	 $query = "SELECT sssc.*,ssc.category_name as mainCategoryName FROM `SUPPLIERS_supplier_subcategories` sssc left join SUPPLIERS_supplier_categories ssc on sssc.category_id = ssc.category_id WHERE sssc.status != 0 AND  sssc.is_deleted=0 AND sssc.location_id=".$this->location_id;     
	 }else{
	 $query = "SELECT sssc.*,ssc.category_name as mainCategoryName FROM `SUPPLIERS_supplier_subcategories` sssc left join SUPPLIERS_supplier_categories ssc on sssc.category_id = ssc.category_id WHERE  sssc.is_deleted=0 AND sssc.location_id=".$this->location_id;
	 }
	    
        if($id !=''){
	        $query .= " AND sssc.category_id = ".$id;
	    }
	    
	     $query .= " order by sssc.sort_order ASC";
        $query=$this->tenantDb->query($query);
              
        
         if (!$query) {
          return false;
        } else {
         $res = $query->result_array();
         return $res;
        }  
        
	}
	public function updateSuppliersCategory($id='',$data){
        
	    $query = "UPDATE `SUPPLIERS_supplier_categories` SET `category_name` = '".$data['category_name']."' WHERE category_id = ".$id;
        
        $query=$this->tenantDb->query($query);
           
	}
	
	public function updateSuppliersSubCategory($id='',$data){
        
	    $query = "UPDATE `SUPPLIERS_supplier_subcategories` SET `category_name` = '".$data['category_name']."',`category_id` = ".$data['category_id']." WHERE id = ".$id;
        
        $query=$this->tenantDb->query($query);
           
	}
	public function addSuppliersCategory($data,$tableName='SUPPLIERS_supplier_categories'){
        
       $dataC = array(
      'location_id' => $this->location_id,
       'category_name' => $data['category_name'],
      'status' => (isset($data['status']) ? $data['status'] : 1),
      'date_added' => date('Y-m-d')
       );
       if($tableName=='SUPPLIERS_supplier_subcategories'){
          $dataC['category_id'] = $data['category_id'];
       }
 
       $this->tenantDb->insert($tableName, $dataC);
       
           
	}
	public function supplierCategoryStatus($id,$data){
	    if(isset($data['is_deleted']) && $data['is_deleted'] == 1){
	    $query = "UPDATE `SUPPLIERS_supplier_categories` SET `is_deleted` = '1' WHERE category_id = ".$id; 
	    }else{
	    $query = "UPDATE `SUPPLIERS_supplier_categories` SET `status` = '".$data['status']."' WHERE category_id = ".$id;    
	    }
	    
        return $query=$this->tenantDb->query($query);
	}
	public function supplierSubCategoryStatus($id,$data){
	    if(isset($data['is_deleted']) && $data['is_deleted'] == 1){
	    $query = "UPDATE `SUPPLIERS_supplier_subcategories` SET `is_deleted` = '1' WHERE id = ".$id; 
	    }else{
	    $query = "UPDATE `SUPPLIERS_supplier_subcategories` SET `status` = '".$data['status']."' WHERE id = ".$id;    
	    }
	    
        return $query=$this->tenantDb->query($query);
	}
	
    // 	products
    public function getProducts($branch_id='',$id=''){
        
	    $this->tenantDb->select('*');
        $this->tenantDb->from('SUPPLIERS_products as p');
        $this->tenantDb->join('SUPPLIERS_product_category as pc', 'p.product_category_id = pc.product_category_id', 'LEFT');
        $this->tenantDb->join('suppliers as s', 'p.supplier_id = s.supplier_id', 'LEFT');
        $this->tenantDb->where('p.product_status NOT IN (0)');
        $this->tenantDb->where('p.is_deleted', 0);
        $this->tenantDb->where('p.location_id =', $this->location_id);
        if ($id != '') {
        $this->tenantDb->where('p.product_id', $id);
         }

        $query = $this->tenantDb->get();

        $res = $query->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
	}
	public function fetchProducts($id='',$supplier_id='',$allProducts=''){

    $this->tenantDb->select('p.*, PBT.*, pc.product_category_name');
    $this->tenantDb->from('SUPPLIERS_products as p');
    $this->tenantDb->join('SUPPLIERS_productToBuilto as PBT', 'p.product_id = PBT.product_id', 'LEFT');
    $this->tenantDb->join('SUPPLIERS_product_category as pc', 'p.product_category_id = pc.product_category_id', 'LEFT');
    $this->tenantDb->join('SUPPLIERS_suppliersList as s', 'p.supplier_id = s.supplier_id', 'LEFT');
    if($allProducts ==''){ 
     $this->tenantDb->where('p.product_status !=', 0);   
    }
    
    $this->tenantDb->where('p.is_deleted', 0);
    if(isset($supplier_id) && $supplier_id != ''){
    $this->tenantDb->where('p.supplier_id',$supplier_id);    
    }
    $this->tenantDb->where('p.location_id', $this->location_id);
    if ($id != '') {
    $this->tenantDb->where('p.product_id', $id);
    }

    $this->tenantDb->order_by('p.sort_order', 'ASC');

    $query = $this->tenantDb->get();
  
   
   if (!$query) {
    return false;
    } else {
    $res = $query->result_array();
    return $res;
    }
        
        
	}
	
    public function fetchProductsFromSupplierId($supplier_id='',$cols='*'){
       
    $this->tenantDb->select($cols);
    $this->tenantDb->from('SUPPLIERS_products as p');
  
    $this->tenantDb->where('p.is_deleted', 0);
    $this->tenantDb->where('p.product_status', 1);
    $this->tenantDb->where('p.supplier_id',$supplier_id); 
    $this->tenantDb->where('p.location_id', $this->location_id);
    $query = $this->tenantDb->get();
    if (!$query) {
    return false;
    } else {
    $res = $query->result_array();
    return $res;
    }
         
    }
	
	public function fetchInactiveProducts($id='',$supplier_id=''){
        
	   $where = (isset($supplier_id) && $supplier_id !='' ? 'p.supplier_id = '.$supplier_id : '1');
	    $query = "SELECT * FROM `SUPPLIERS_products` as p LEFT JOIN SUPPLIERS_product_category as pc ON p.product_category_id = pc.product_category_id LEFT JOIN SUPPLIERS_suppliersList as s ON p.supplier_id = s.supplier_id  WHERE p.product_status = 0 and ".$where." AND p.location_id=".$this->location_id;
        if($id !=''){
	        $query .= " AND product_id = ".$id;
	    }
	   // echo $query; exit;
        $query=$this->tenantDb->query($query);
        if (!$query) {
          return false;
        } else {
         $res = $query->result_array();
         return $res;
        }       
      
       
        
	}
	
	
	public function updateProduct($id='',$data){
         
    //  echo "<pre>"; print_r($data); exit;
      $this->tenantDb->set('supplier_id', $data['supplier_id']);
      $this->tenantDb->set('product_name', $data['product_name']);
      $this->tenantDb->set('product_code', $data['product_code']);
      $this->tenantDb->set('product_category_id', $data['product_category_id']);
      $this->tenantDb->set('price', $data['price']);
      $this->tenantDb->set('account_number', $data['account_number']);
      $this->tenantDb->set('account_name', $data['account_name']);
      $this->tenantDb->set('tax_code', $data['tax_code']);
      $this->tenantDb->set('product_status', 1);
      $this->tenantDb->set('date_updated', date('Y-m-d'));
      $this->tenantDb->where('product_id', $id);
      $this->tenantDb->update('SUPPLIERS_products');

      
      // Update 'SUPPLIERS_productToBuilto'  which stores info about buildTo of all products
      foreach (DaysOfWeek as $day) {
      $product_stockQty[$day.'_stockQty']  = (isset($data[$day.'_stockQty']) ? $data[$day.'_stockQty'] : 0);
        } 
     
      $this->tenantDb->set('supplier_id', $data['supplier_id']);
      $this->tenantDb->set('tier_type', $data['tier_type']);
      $this->tenantDb->set('cafe_unit_uom', $data['cafe_unit_uom']);
      $this->tenantDb->set('inner_unit_uom', (isset($data['inner_unit_uom']) ? $data['inner_unit_uom'] : ''));
      $this->tenantDb->set('each_unit_uom', (isset($data['each_unit_uom']) ? $data['each_unit_uom'] : ''));
      $this->tenantDb->set('cafe_unit_uomQty', (isset($data['cafe_unit_uomQty']) ? $data['cafe_unit_uomQty'] : ''));
      $this->tenantDb->set('inner_unit_uomQty', (isset($data['inner_unit_uomQty']) ? $data['inner_unit_uomQty'] : ''));
      $this->tenantDb->set('PARLevelQty', (isset($data['PARLevelQty']) ? $data['PARLevelQty'] : ''));
      $this->tenantDb->set('is_sameOnAllDays', (isset($data['sameStockforAllDays']) && $data['sameStockforAllDays'] == 'on') ? 1 : 0);
      $this->tenantDb->set('AllDaysPARLevelQty', serialize($product_stockQty));
      $this->tenantDb->where('product_id', $id);
      $this->tenantDb->update('SUPPLIERS_productToBuilto');
    //   echo $this->tenantDb->last_query(); exit;
           
	}
	public function addProduct($location_id,$data){
        
       
	$productData = array(
    'supplier_id' => (isset($data['supplier_id']) ? $data['supplier_id'] : 0),
    'product_name' => $data['product_name'],
    'location_id' => $this->location_id,
    'product_code' => $data['product_code'],
    'product_category_id' => $data['product_category_id'],
    'price' => $data['price'],
    'account_number' => (isset($data['account_number']) ? $data['account_number'] : ''),
    'account_name' => (isset($data['account_name']) ? $data['account_name'] : ''),
    'tax_code' => (isset($data['tax_code']) ? $data['tax_code'] : ''),
    'product_status' => 1,
    'date_added' => date('Y-m-d')
    );
// echo "ddd<pre>"; print_r($productData); exit; 
    $this->tenantDb->insert('SUPPLIERS_products', $productData);
    $lastInsertProductId = $this->tenantDb->insert_id();
    
    // echo $this->tenantDb->last_query(); exit;
// Add to 'SUPPLIERS_productToBuilto'  which stores info about buildTo of all products
   
    foreach (DaysOfWeek as $day) {
      $product_stockQty[$day.'_stockQty']  = (isset($data[$day.'_stockQty']) ? $data[$day.'_stockQty'] : 0);
        }
       
     $BuilToData = array(
    'supplier_id' => $data['supplier_id'],
    'tier_type' => $data['tier_type'],
    'cafe_unit_uom' => $data['cafe_unit_uom'],
    'inner_unit_uom' => (isset($data['inner_unit_uom']) ? $data['inner_unit_uom'] : ''),
    'each_unit_uom' => (isset($data['each_unit_uom']) ? $data['each_unit_uom'] : ''),
    'cafe_unit_uomQty' => (isset($data['cafe_unit_uomQty']) ? $data['cafe_unit_uomQty'] : ''),
    'inner_unit_uomQty' => (isset($data['inner_unit_uomQty']) ? $data['inner_unit_uomQty'] : ''),
    'PARLevelQty' => (isset($data['PARLevelQty']) ? $data['PARLevelQty'] : ''),
    'is_sameOnAllDays' => (isset($data['sameStockforAllDays']) && $data['sameStockforAllDays'] == 'on') ? 1 : 0,
    'AllDaysPARLevelQty' => serialize($product_stockQty),
    'product_id' => $lastInsertProductId
    );

    $this->tenantDb->insert('SUPPLIERS_productToBuilto', $BuilToData);

	}
	public function ProductStatus($id,$productStatus){
	    $query = "UPDATE `SUPPLIERS_products` SET `product_status` = '".$productStatus."' WHERE product_id = ".$id;
        
        return $query=$this->tenantDb->query($query);
	}
	public function productUnapprove($id,$data){
	    $query = "UPDATE `SUPPLIERS_products` SET `is_unapproved` = '".$data['is_unapproved']."',`date_updated` = '".date('Y-m-d')."' WHERE product_id = ".$id;
        
        return $query=$this->tenantDb->query($query);
	}
	
	// 	product category
   
	public function fetchProductCategory($id='',$fetchAll='no'){
        
	    $query = "SELECT * FROM `SUPPLIERS_product_category` WHERE is_deleted = 0 AND location_id=".$this->location_id;
        if($fetchAll='no'){
            $query .= " AND product_category_id != '0'";  
        }
        if($id !=''){
	        $query .= " AND product_category_id = ".$id;
	    }
        $query=$this->tenantDb->query($query);
              
         if (!$query) {
          return false;
        } else {
         $res = $query->result_array();
         return $res;
        }    
        
	}
    public function updateProductCategory($id = '', $data) {
    $this->tenantDb->set('product_category_name', $data['product_category_name']);
   
    $this->tenantDb->where('product_category_id', $id);
    $this->tenantDb->update('SUPPLIERS_product_category');
    }

	public function addProductCategory($data) {
    $insert_data = array(
        'location_id' => $this->location_id,
        'product_category_name' => $data['product_category_name'],
        'product_category_status' => 1,
        'date_added' => date('Y-m-d')
    );
    $this->tenantDb->insert('SUPPLIERS_product_category', $insert_data);
   }

	public function productCategoryStatus($id, $data) {
   
    $this->tenantDb->where('product_category_id', $id);
    $this->tenantDb->update('SUPPLIERS_product_category',$data);
   
    return true;
    }

	
	// 	product UOM
	public function fetchUOM($location_id, $id = '', $fetchAll = '') {
    $this->tenantDb->select('*');
    $this->tenantDb->from('SUPPLIERS_product_UOM');
    $this->tenantDb->where('location_id', $location_id);
    $this->tenantDb->where('is_deleted', 0);
    
    if ($fetchAll == '') {
        $this->tenantDb->where('product_UOM_status', 1);
    }
    
    if ($id != '') {
        $this->tenantDb->where('product_UOM_id', $id);
    }

    $query = $this->tenantDb->get();

    if (!$query) {
        return false;
    } else {
        $res = $query->result_array();
        return $res;
    }
   }

  
	
	public function updateUOM($id = '', $data) {
    $this->tenantDb->set('product_UOM_name', $data['product_UOM_name']);
    $this->tenantDb->set('product_UOM_status', '1');
    $this->tenantDb->where('product_UOM_id', $id);
    $this->tenantDb->update('SUPPLIERS_product_UOM');
    }

     public function addUOM($location_id, $data) {
    $insertData = array(
        'product_UOM_name' => $data['product_UOM_name'],
        'product_UOM_status' => '1',
        'location_id' => $location_id,
        'date_added' => date('Y-m-d')
    );

    $this->tenantDb->insert('SUPPLIERS_product_UOM', $insertData);
}

	public function UOMStatus($id, $data) {
    if (isset($data['is_deleted']) && $data['is_deleted'] == 1) {
        $this->tenantDb->set('is_deleted', '1');
    } else {
        $this->tenantDb->set('product_UOM_status', $data['product_UOM_status']);
    }
    $this->tenantDb->where('product_UOM_id', $id);
    $this->tenantDb->update('SUPPLIERS_product_UOM');
}

}
