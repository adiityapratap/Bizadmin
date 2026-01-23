<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('stock_model');
		$this->load->model('common_model');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->location_id = $this->session->userdata('location_id');
	}
	public function index(){
	    $this->load->view('Suppliers/dashboard');
	}
	

    public function listSupplier(){
    //   echo "Dsds"; exit;
    // pass last param as true if you want to fetch supplier list as per category id in nested array structure. print array for more details
        $result = $this->supplier_model->fetchSuppliersSortBYCutoffTime($this->location_id,'sort_order',false);
        
        // echo "<pre>"; print_r($result); exit;
        $data['inActiveSuppliers_list']  = $this->supplier_model->fetchInactiveSuppliersSortBYCutoffTime($this->location_id);
        $data['suppliers_list'] = $result;
        $this->load->view('general/header');
        $this->load->view('Suppliers/listSupplier',$data);
      	$this->load->view('general/footer');  
    } 
    
    function markTopFive(){
        $suppId = $this->input->post('suppId'); 
        $data['isTopFive'] = $this->input->post('status');
        $this->supplier_model->supplierCommonUPdate($suppId,$data);
    }
    public function manage_supplier($type="",$id=''){
         $data['supplier_Subcategories'] = $this->supplier_model->fetchSuppliersSubCategory($this->location_id);
         $data['supplier_Maincategories'] = $this->supplier_model->fetchSuppliersCategory($this->location_id);
        if($type == 'view'){
           
            $result = $this->supplier_model->getSuppliers($id);
            $data['record'] = $result;
            $data['form_type'] = 'view';
            $this->load->view('general/header');
            $this->load->view('Suppliers/supplier',$data);
            $this->load->view('general/footer');
        }else if($type == 'edit'){
           
            if($_POST){
               
                $result = $this->supplier_model->updateSupplier($id,$_POST);
                 return redirect(base_url('/Supplier/list'));
            }else{
                $supplier_categories = $this->supplier_model->fetchSuppliersSubCategory($this->location_id);
                $data['supplier_categories'] = $supplier_categories;
                $result = $this->supplier_model->getSuppliers($id);
                 $data['areaLists'] = $this->supplier_model->fetchAllAreas();
                $data['record'] = $result;
                $data['form_type'] = 'edit';
                $this->load->view('general/header');
                $this->load->view('Suppliers/supplier',$data);
                $this->load->view('general/footer');
            }
        }else if($type == 'add'){
            
            if($_POST){ 
                $result = $this->supplier_model->addSupplier($_POST);
                return redirect(base_url('/Supplier/list'));
            }else{
                 
                  $data['areaLists'] = $this->supplier_model->fetchAllAreas();
             
                $data['form_type'] = 'add';
                $this->load->view('general/header');
                $this->load->view('Suppliers/supplier',$data);
                $this->load->view('general/footer');
            }
        }
     
      
       
    }
    
    
    public function supplierStatus(){
        $id = $_POST['id'];
        $data =array(
            'status' => '0',
            );
        $result = $this->supplier_model->supplierStatus($id,$data);
    }
    public function listSupplierCategory(){

        $result = $this->supplier_model->fetchSuppliersCategory($this->location_id,'','fetchAll');
        $data['record'] = $result;
        $this->load->view('general/header');
        $this->load->view('Suppliers/listSupplierCategory',$data);
        $this->load->view('general/footer');
       
    }
    
    public function manageSupplierCategory($type=""){
        
       if($type == 'edit'){
           $id = $_POST['id'];
            $result = $this->supplier_model->updateSuppliersCategory($id,$_POST);
                echo "success";
        }else if($type == 'add'){
            
          $result = $this->supplier_model->addSuppliersCategory($_POST);
          echo "success";
        }

    }
    
    public function supplierUpdateSortOrder(){
       $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $supplierId) {
        $suppID = substr($supplierId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('supplier_id', $suppID);
        $this->tenantDb->update('SUPPLIERS_suppliersList');
    }
    echo "success";
    }
    public function supplierSubCatUpdateSortOrder(){
       $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $supplierId) {
        $suppID = substr($supplierId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $suppID);
        $this->tenantDb->update('SUPPLIERS_supplier_subcategories');
    }
    echo "success";
    }
    public function supplierCategoryStatus(){
      
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status=='delete'){
         $data = array( 'is_deleted' => 1  );   
        }else{
         $data =array( 'status' => $status  );   
        }
        $result = $this->supplier_model->supplierCategoryStatus($id,$data);
    }
    
    public function listSupplierSubCategory(){
        $supplier_categories = $this->supplier_model->fetchSuppliersCategory($this->location_id);
        $data['supplier_categories'] = $supplier_categories;
        $result = $this->supplier_model->fetchSuppliersSubCategory($this->location_id,'','fetchAll');
        $data['record'] = $result; 
        $this->load->view('general/header');
        $this->load->view('Suppliers/listSupplierSubCategory',$data);
        $this->load->view('general/footer');
       
    }
    public function manageSupplierSubCategory($type=""){
        
         if($type == 'edit'){
           $id = $_POST['id'];
           $result = $this->supplier_model->updateSuppliersSubCategory($id,$_POST);
        }else if($type == 'add'){
           $result = $this->supplier_model->addSuppliersCategory($_POST,'SUPPLIERS_supplier_subcategories');
        }

    }
    public function supplierSubCategoryStatus(){
      
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status=='delete'){
         $data = array( 'is_deleted' => 1  );   
        }else{
         $data =array( 'status' => $status  );   
        }
        $result = $this->supplier_model->supplierSubCategoryStatus($id,$data);
    }
    
    function fetchSupplierItems(){
        $supplierId = $this->input->post('supplier_id'); 
        $result = $this->supplier_model->fetchProducts('',$supplierId); 
        $resultStock = $this->stock_model->fetchProductsStockQtyAreaWise($supplierId); 
        $areaAssigned = $this->supplier_model->fetchAreaAssignedToThisSupplier($supplierId); 
        $cols = 'delivery_info,allowForceOrder,min_order,weekly_budget,monthly_budget,requireDD,email,cc,requireSC,requirePL,deliveryDateFreq,deliveryDayFreq,delivery_date_type';
        $suppDetails = $this->supplier_model->getSuppliers($supplierId,$cols);
        $response['productDetails'] = $result;
        $response['productStockQty'] = $resultStock;
        $response['areaAssigned'] = $areaAssigned;
        $response['suppDetails'] = $suppDetails;
        echo json_encode($response);
    }
    
    function fetchSupplierItemsForMonthlyStockUpdate(){
        $supplierId = $this->input->post('supplier_id'); 
        $productColumnsToFetch='product_id';
       
        $allProducts = $this->supplier_model->fetchProducts('',$supplierId);
        $resultStock = $this->stock_model->fetchProductsMonthlyStockQtyAreaWise($supplierId); 
        
        if(isset($allProducts) && !empty($allProducts)){
       
        foreach($allProducts as $index => $allProduct){
         $purchaseUnit = $this->stock_model->calculatePurchaseUnit($allProduct['product_id']);  
         $allProducts[$index]['purchase_unit'] = $purchaseUnit;
        
        }
        }
        
        
        $areaAssigned = $this->supplier_model->fetchAreaAssignedToThisSupplier($supplierId); 
        $cols = 'delivery_info,allowForceOrder,min_order,weekly_budget,monthly_budget,requireDD,email,cc,requireSC,requirePL,deliveryDateFreq,deliveryDayFreq,delivery_date_type';
        $suppDetails = $this->supplier_model->getSuppliers($supplierId,$cols);
        
        $response['productDetails'] = $allProducts;
        $response['productStockQty'] = $resultStock;
        $response['areaAssigned'] = $areaAssigned;
        $response['suppDetails'] = $suppDetails;
        echo json_encode($response);
    }
    
    // products
    public function listSupplierProducts($encodedParams){
    $decodedParams = urldecode(urldecode(urldecode($encodedParams)));
    $decryptedParams = $this->encryption->decrypt($decodedParams);
    list($supplier_id, $supplierName,$isPARLevelRequired,$imported) = explode('|', $decryptedParams);
    // echo $isPARLevelRequired; exit;
     // fetch prdct correcposnding to supplier id
        $result = $this->supplier_model->fetchProducts('',$supplier_id); 
        $inactiveRecord = $this->supplier_model->fetchInactiveProducts('',$supplier_id); 
        $data['product_UOM'] = $this->supplier_model->fetchUOM($this->location_id);
        
        $data['record'] = $result;
        $data['isPARLevelRequired'] = $isPARLevelRequired;
        $data['inactiveRecord'] = $inactiveRecord;
        $data['supplierName'] = $supplierName;
        $data['supplier_id'] = $supplier_id;
        $data['imported'] = (($imported !='') ? 'Product Imported Successfully' :'');
        $this->load->view('general/header'); 
        $this->load->view('Products/listProducts',$data);
        $this->load->view('general/footer');
       
    }
    
 
    public function manageProducts($type="",$encodedParams=''){
       $decodedParams = urldecode(urldecode(urldecode($encodedParams)));
       $decryptedParams = $this->encryption->decrypt($decodedParams);
        
        list($id,$supplierName,$isPARLevelRequired) = explode('|', $decryptedParams); 
       
        $data['suppliers'] = $this->supplier_model->fetchSuppliers('supplier_id,supplier_name');
        $selectedSupp = $this->supplier_model->fetchSuppliers('requireMST,requireSC',array('supplier_id' =>$id));
        $data['requireMonthlystockTake'] = (isset($selectedSupp[0]['requireMST'])  ?  $selectedSupp[0]['requireMST'] : 0);
        $data['requireStockCount'] = (isset($selectedSupp[0]['requireSC'])  ?  $selectedSupp[0]['requireSC'] : 0);
        
        $data['product_category'] = $this->supplier_model->fetchProductCategory();
        $data['product_UOM'] = $this->supplier_model->fetchUOM($this->location_id);
        $data['suppID'] = $id;
        $data['supplierName'] = $supplierName;
            // echo "<pre>"; print_r($data['suppliers']); exit;
        if($type == 'view'){ 
            $result = $this->supplier_model->fetchProducts($id);
            // echo "<pre>"; print_r($result); exit;
            $data['record'] = $result;
            $data['form_type'] = 'view';
            $this->load->view('general/header');
            $this->load->view('Products/products',$data);
            $this->load->view('general/footer');
        }else if(trim($type) == 'edit'){ 
            if($_POST){ 
               
                // echo "<pre>"; print_r($_POST); exit;
                $result = $this->supplier_model->updateProduct($id,$_POST);
                $paramsToEncrypt = $_POST['supplier_id'] . '|' .$supplierName.'|'. $_POST['isPARLevelRequired'];
                $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
                $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
                return redirect(base_url('/Supplier/supplier_item/'.$encodedParams));
            }else{
                $result = $this->supplier_model->fetchProducts($id); 
                //   echo "<pre>"; print_r($result); exit;
                
                $data['record'] = $result;
                $data['form_type'] = 'edit';
                $data['isPARLevelRequired'] = $isPARLevelRequired;
                $this->load->view('general/header');
                $this->load->view('Products/products',$data);
                $this->load->view('general/footer');
            }
        }else if($type == 'add'){
            if($_POST){  
                // echo "<pre>"; print_r($_POST); exit; 
                $result = $this->supplier_model->addProduct($this->location_id,$_POST);
                $paramsToEncrypt = $_POST['supplier_id'] . '|' .$supplierName.'|'. $_POST['isPARLevelRequired'];
                $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
                $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
                return redirect(base_url('/Supplier/supplier_item/'.$encodedParams));
            }else{ 
                $data['form_type'] = 'add'; 
                 $data['isPARLevelRequired'] = $isPARLevelRequired;
                $this->load->view('general/header');
                $this->load->view('Products/products',$data);
                $this->load->view('general/footer');
            }
        }
     
      
       
    }
    
    public function update_product_info() {
        // Check if request is AJAX
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        // Get POST data
        $product_id = $this->input->post('product_id', TRUE);
        $field_name = $this->input->post('field_name', TRUE);
        $value = $this->input->post('value', TRUE);

        // Define allowed fields
        $allowed_fields = ['product_code', 'product_name', 'price', 'PARLevelQty'];

        // Validate input
        if (empty($product_id) || empty($field_name) || !in_array($field_name, $allowed_fields) || $value === '') {
            $response = [
                'status' => 'error',
                'message' => 'Invalid product ID, field name, or value.'
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // Additional validation for price
        if ($field_name === 'price' && (!is_numeric($value) || $value < 0)) {
            $response = [
                'status' => 'error',
                'message' => 'Price must be a valid non-negative number.'
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // Additional validation for PARLevelQty
        if ($field_name === 'PARLevelQty' && (!is_numeric($value) || $value < 0 || !ctype_digit((string)$value))) {
            $response = [
                'status' => 'error',
                'message' => 'PAR Level Quantity must be a valid non-negative integer.'
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // Prepare data for update
        $data = [
            $field_name => $value
        ];
        // Update database
        if($field_name == 'PARLevelQty'){
           $this->tenantDb->set('PARLevelQty', (isset($data['PARLevelQty']) ? $data['PARLevelQty'] : '')); 
           $this->tenantDb->where('product_id', $product_id);
            $this->tenantDb->update('SUPPLIERS_productToBuilto');
            $result = true;
        }else{
            $result = $this->common_model->commonRecordUpdate('SUPPLIERS_products','product_id',$product_id,$data);
        }
       

        if ($result) {
            $response = [
                'status' => 'success',
                'message' => ucfirst(str_replace('_', ' ', $field_name)) . ' updated successfully.',
                'csrf_hash' => $this->security->get_csrf_hash()
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to update ' . str_replace('_', ' ', $field_name) . '.'
            ];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    
    
    public function productStatus(){
        $id = $_POST['id'];
       
        $result = $this->supplier_model->ProductStatus($id,$this->input->post('product_status'));
    }
    public function productUpdateSortOrder(){
       $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $prdctID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('product_id', $prdctID);
        $this->tenantDb->update('SUPPLIERS_products');
    }
    echo "success";
    }
    
    // product catregory
    public function listProductCategory(){
        
        
        $result = $this->supplier_model->fetchProductCategory('','yes');
        $data['record'] = $result;
         $this->load->view('general/header');
        $this->load->view('Products/listProductCategory',$data);
         $this->load->view('general/footer');
       
    }
    public function manageProductCategory($type=""){
        
         if($type == 'edit'){
           $id = $_POST['product_category_id'];
           $result = $this->supplier_model->updateProductCategory($id,$_POST);
        }else if($type == 'add'){
           $result = $this->supplier_model->addProductCategory($_POST);
        }

    }
    
   
    public function productCategoryStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        if($status=='delete'){
         $data = array( 'is_deleted' => 1  );   
        }else{
         $data =array( 'product_category_status' => $status  );   
        }    
        $result = $this->supplier_model->ProductCategoryStatus($id,$data);
    }
    
    // UOM
   
    public function listUOM(){
        
        
        $result = $this->supplier_model->fetchUOM($this->location_id,'','fetchAll');
        $data['record'] = $result;
         $this->load->view('general/header');
        $this->load->view('Suppliers/listUOM',$data);
         $this->load->view('general/footer');
       
    }
    public function manageUOM($type=""){
        
         if($type == 'edit'){
             $id = $_POST['id'];
           $result = $this->supplier_model->updateUOM($id,$_POST);
                echo "success";
        }else if($type == 'add'){
          $result = $this->supplier_model->addUOM($this->location_id,$_POST);
                echo "success";
        }
    }
    public function UOMStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status=='delete'){
         $data = array( 'is_deleted' => 1  );   
        }else{
         $data =array( 'product_UOM_status' => $status  );   
        }
        
          
        $result = $this->supplier_model->UOMStatus($id,$data);
    }
}