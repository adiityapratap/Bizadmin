<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Product extends MY_Controller {
    function __construct() {
		parent::__construct();
	   $this->load->model('internalorder_model');
	   $this->load->model('supplier_model');
	   $this->load->model('common_model');
	   $this->location_id = $this->session->userdata('location_id');
	   $this->system_id = $this->session->userdata('system_id');
	  !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	  $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
// 	  ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	}
	




	public function productList(){
	    $data['productList'] = $this->internalorder_model->fetchProducts();
	    $data['locationList'] = $this->internalorder_model->fetchLocations($this->location_id,'id,name','notIsKitchen');
	    $conditions = array('is_deleted'=>'0');
        $data['categoryLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditions);
        $data['uomLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', array('product_UOM_id','product_UOM_name'), $conditions);
     
	    $this->load->view('general/header');
      	$this->load->view('Internalorder/productList',$data);
      	$this->load->view('general/footer');
	}
	function fetchProductData(){
	$productData = $this->internalorder_model->fetchProducts($_POST['id']); 
	
	echo json_encode($productData);
	}
	
	public function manageProducts($type=""){
        
         if($type == 'edit'){
             $id = $_POST['productIdToUpdate'];
           $result = $this->internalorder_model->updateProduct($id,$_POST);
             return redirect(base_url('/Supplier/internalorder/products'));
        }else if($type == 'add'){
            
          $result = $this->internalorder_model->addProduct($_POST);
           return redirect(base_url('/Supplier/internalorder/products'));
        }
    }
    public function productStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        $table = $_POST['table'];
        if($status=='delete'){
         $data = array( 'is_deleted' => 1  );   
        }else{
         $data = array( 'status' => $status  );   
        }
        
        $result = $this->internalorder_model->productStatus($id,$data,$table);
        echo "success";
    }
     public function productUpdateSortOrder(){
       $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

       foreach ($newOrder as $index => $itemId) {
        $prdctID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $prdctID);
        $this->tenantDb->update('SUPPLIERS_internalOrderProducts');
      }
    echo "success";
    }
    
    function productCount($id=''){
         $conditionsSub = array('is_kitchen'=> 0,'location_id' => $this->location_id); $colsToFetchSub = array('id,name');
         $data['locationList'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderLocations', $colsToFetchSub, $conditionsSub);
         $locationWithkictchen = $this->internalorder_model->fetchLocations($this->location_id,'is_kitchen,email,ccemail');
         $conditions = array('is_deleted'=>'0');
         $data['categoryLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditions);
         $data['productList'] = $this->internalorder_model->fetchProducts();
         $data['productCountData'] = $this->internalorder_model->fetchProductCountData(); 
        // echo  $this->location_id; exit;
         $data['selectedSubLoc'] = $id;
         $kithendetails = array_filter($locationWithkictchen, function ($value) {
            return $value['is_kitchen'] == 1;
        });
      
         $data['form_type'] = 'add';
         $data['kithendetails'] = reset($kithendetails);
         $data['uomLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', array('product_UOM_id','product_UOM_name'), $conditions);
        $this->load->view('general/header');
      	$this->load->view('Internalorder/productCount',$data);
      	$this->load->view('general/footer');  
        
    }
    
    function addProductCount(){
      $dataToInsert = array();
      $dataToUpdate = array();
      // at once we can submit only one sub location data 
      $selectedSubLocationId  = $_POST['selectedSubLocationId'];
      
       foreach ($_POST['productID'] as $key => $productCount) {
        $locationAndProductID = explode('_', $productCount);
      
        if(isset($locationAndProductID[1]) &&  $locationAndProductID[1] == $selectedSubLocationId){
          
        if(isset($locationAndProductID[0]) && isset($locationAndProductID[1])){
          
        $existingProductCountData =   $this->internalorder_model->fetchProductCountData($locationAndProductID[0],$locationAndProductID[1]); 
        
        }
        if(isset($existingProductCountData) && !empty($existingProductCountData)){
          $rowUpdateData = array(
          'id' => $existingProductCountData[0]['id'],
          'dailtQtyNeed' => (isset($_POST['dailtQtyNeed'][$key]) && $_POST['dailtQtyNeed'][$key] !='' ? $_POST['dailtQtyNeed'][$key] : NULL),
          'qtyToMake' => (isset($_POST['qtyToMake'][$key]) && $_POST['qtyToMake'][$key] !='' ? $_POST['qtyToMake'][$key] : NULL),
        );  
          $dataToUpdate[] = $rowUpdateData;    
        }else{
          $rowData = array(
          'product_id' => isset($locationAndProductID[0]) ? $locationAndProductID[0] : null,
          'sublocation_id' => isset($locationAndProductID[1]) ? $locationAndProductID[1] : null,
          'dailtQtyNeed' => (isset($_POST['dailtQtyNeed'][$key]) && $_POST['dailtQtyNeed'][$key] !='' ? $_POST['dailtQtyNeed'][$key] : NULL),
          'qtyToMake' => (isset($_POST['qtyToMake'][$key]) && $_POST['qtyToMake'][$key] !='' ? $_POST['qtyToMake'][$key] : NULL),
          'location_id' => $this->location_id,
          'date_completed' => date('y-m-d')
        );
        $dataToInsert[] = $rowData;  
        // $dataLocation['last_countedAt'] = date('Y-m-d');
        // //  echo "<pre>"; print_r($rowData); exit;
        //  $this->internalorder_model->updateLocation($locationAndProductID[1],$dataLocation);
        }
       
        }
       
     }
    
    //  echo "<pre>"; print_r($dataToInsert); exit;
    if(!empty($dataToInsert)){
     $this->internalorder_model->insertProductCountBatch($dataToInsert);
    }
     if(!empty($dataToUpdate)){
         $this->internalorder_model->updateProductCountBatch($dataToUpdate); 
     }
    return redirect(base_url('/Supplier/internalorder/productCount/'.$selectedSubLocationId));  
     

    }
    
    function categoryList(){
        $conditions = array('is_deleted'=>'0');
        $data['categoryLists'] = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditions);
        $this->load->view('general/header');
      	$this->load->view('Internalorder/categoryList',$data);
      	$this->load->view('general/footer'); 
    }
    
    function addCategory(){
        $data['category_name'] = $this->input->post('category_name');
        $data['location_id'] = $this->location_id;
        $this->common_model->commonRecordCreate('SUPPLIERS_internalOrderCategory',$data); 
        echo "success";
    }
    function updateCategory(){
        $data['category_name'] = $this->input->post('category_name');
        $idCat = $this->input->post('id');
        $this->common_model->commonRecordUpdate('SUPPLIERS_internalOrderCategory','id',$idCat,$data);   
        echo "success";
    }
    
    public function download_sample($supplierId='') {
    // Load required libraries and models

    // $conditions = array('status'=>'1','is_deleted'=>'0');
    // $categoryList = $this->common_model->fetchRecordsDynamically('SUPPLIERS_internalOrderCategory', '', $conditions);
    
  
    $uomLists = $this->common_model->fetchRecordsDynamically('SUPPLIERS_product_UOM', array('product_UOM_id','product_UOM_name'), $conditions);
    $uomListFormatted = array();
foreach ($uomLists as $uomList) {
    $uomListFormatted[] = '['.$uomList['product_UOM_id'] . ']' . $uomList['product_UOM_name'];
}

// $categoryListFormatted = array();
// foreach ($categoryList as $category) {
//     $categoryListFormatted[] = '['.$category['id'] . ']' . $category['category_name'];
// }

$locationList = $this->internalorder_model->fetchLocations($this->location_id, 'id,name', 'notIsKitchen');
$subLocationList = array();
foreach ($locationList as $subLocation) {
    $subLocationList[] = '['.$subLocation['id'] . ']' . $subLocation['name'];
}

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headings
$sheet->setCellValue('A1', 'name');
$sheet->setCellValue('B1', 'category_id');
$sheet->setCellValue('C1', 'price');
$sheet->setCellValue('D1', 'sublocation_id');
$sheet->setCellValue('E1', 'requireAttach');
$sheet->setCellValue('F1', 'requireTemp');
$sheet->setCellValue('G1', 'UOM');

// Populate default values
$startingRow = 2;
$numRows = 800;
for ($row = $startingRow; $row <= $startingRow + $numRows - 1; $row++) {
    $sheet->setCellValue('A' . $row, '');  // Input field, leave blank
    $sheet->setCellValue('B' . $row, '');
    $sheet->setCellValue('E' . $row, '0'); // Input field
    $sheet->setCellValue('F' . $row, '0');
}

// Populate dropdowns
for ($row = $startingRow; $row <= $startingRow + $numRows - 1; $row++) {
    // // Add dropdown for category_id
    // $validation = $sheet->getCell('B' . $row)->getDataValidation();
    // $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
    // $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
    // $validation->setShowInputMessage(true);
    // $validation->setShowErrorMessage(true);
    // $validation->setShowDropDown(true);
    // $validation->setErrorTitle('Input error');
    // $validation->setError('Please pick correct value from the drop-down list only, manual entry is not allowed');
    // $validation->setPromptTitle('Pick from list');
    // $validation->setPrompt('Please pick a value from the drop-down list');
    // $validation->setFormula1('"'.implode(',', $categoryListFormatted).'"');
     
     $validation = $sheet->getCell('G' . $row)->getDataValidation();
    $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
    $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
    $validation->setShowInputMessage(true);
    $validation->setShowErrorMessage(true);
    $validation->setShowDropDown(true);
    $validation->setErrorTitle('Input error');
    $validation->setError('Please pick correct value from the drop-down list only, manual entry is not allowed');
    $validation->setPromptTitle('Pick from list');
    $validation->setPrompt('Please pick a value from the drop-down list');
    $validation->setFormula1('"'.implode(',', $uomListFormatted).'"');
    
    // Add dropdown for sublocation_id
    $validation = $sheet->getCell('D' . $row)->getDataValidation();
    $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
    $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
    $validation->setShowInputMessage(true);
    $validation->setShowErrorMessage(true);
    $validation->setShowDropDown(true);
    $validation->setErrorTitle('Input error');
    $validation->setError('Please pick correct value from the drop-down list only, manual entry is not allowed');
    $validation->setPromptTitle('Pick from list');
    $validation->setPrompt('Please pick a value from the drop-down list');
    $validation->setFormula1('"'.implode(',', $subLocationList).'"');
}

// Set column widths for readability
$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(40);
$sheet->getColumnDimension('F')->setWidth(40);

// Create Xlsx writer object
$writer = new Xlsx($spreadsheet);

// Set headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="InternalProductSample.xlsx"');
header('Cache-Control: max-age=0');

// Save the spreadsheet to php://output (download it)
$writer->save('php://output');
}

    public function importProduct() {
        // Load necessary libraries and models
        
    $orzName = $this->tenantIdentifier;    
    $config['upload_path'] = './uploaded_files/'.$orzName.'/Supplier/ProductImport/';
    $config['allowed_types'] = 'xlsx|xls';
    $config['encrypt_name'] = TRUE;
    $config['max_size']      = 90240;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

        // Check if the file is successfully uploaded
        if ($this->upload->do_upload('file')) {
            // Get the uploaded file data
            $fileData = $this->upload->data();
            $filePath = $fileData['full_path'];

            // Load the spreadsheet reader
            $spreadsheet = IOFactory::load($filePath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
              
            // Process and save the data to the database
            $count = 1;
            foreach ($sheetData as $row) {
              if($count > 1 ){
          $sublocation_id = (preg_match('/\[(.*?)\]/', $row['D'], $matches) ? $matches[1] : '');  
          $uom_id = (preg_match('/\[(.*?)\]/', $row['G'], $matches) ? $matches[1] : '');
            $price = str_replace(['$', ' '], '', $row['C']);
                $data = array(
                    'productName' => $row['A'],
                    'category_id' => $row['B'],
                    'price' => $price,
                    'uom' => $uom_id,
                    'requireAttach' => $row['E'],
                    'requireTemp' => $row['F'],
                );
                $data['subLocId'] = array($sublocation_id);
                $data['par_level'] = array('');

          if ($data['productName'] == '') {
            break; 
            }  
               $result = $this->internalorder_model->addProduct($data);   
              }
               
               $count++;
            }

         return redirect(base_url('/Supplier/internalorder/products'));
        } else {
            // Display the upload error
            echo $this->upload->display_errors();
        }
    }
    
    
    
	
}

?>