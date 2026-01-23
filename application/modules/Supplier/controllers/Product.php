<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
defined('BASEPATH') OR exit('No direct script access allowed');


class Product extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('product_model');
		$this->location_id = $this->session->userdata('location_id');
		!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
// 		ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	
	}
	
	// commented on 30-06-2025 as we changed the appraoch to update the product from listing page
// 	function bulkUpdate($encodedParams){
// 	    $decodedParams = urldecode(urldecode(urldecode($encodedParams)));
//       $decryptedParams = $this->encryption->decrypt($decodedParams);
        
//         list($supplierId,$supplierName,$isPARLevelRequired) = explode('|', $decryptedParams); 
        
// 	    $bulkPriceData = array();
// 	    $bulkDataProductCode = array();
// 	    if (!empty($_POST)) {
	       
//         foreach ($_POST as $productId => $UpdatepriceAndCode) {
//         $bulkDataProductCode[] = array('product_id' => $productId, 'product_code' => $UpdatepriceAndCode[0]);
//         $bulkPriceData[] = array('product_id' => $productId, 'price' => $UpdatepriceAndCode[1]);
       
//         }
//         //  echo "<pre>"; print_r($bulkDataProductCode); exit;
//       if (!empty($bulkPriceData)) {
//         $result = $this->product_model->bulkUpdate($bulkPriceData);   
//         }
        
//         if (!empty($bulkDataProductCode)) {
//         $result = $this->product_model->bulkUpdate($bulkDataProductCode);   
//         }
        
        
//         $paramsToEncrypt = $supplierId . '|' .$supplierName.'|'. $isPARLevelRequired;
//         $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
//         $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
//          return redirect(base_url('/Supplier/supplier_item/'.$encodedParams));
	   
	    
// 	    }
// 	}
	
	
	public function importProduct() {
        // Load necessary libraries and models
        
    $orzName = $this->tenantIdentifier;    
    $config['upload_path'] = './uploaded_files/'.$orzName.'/Supplier/ProductImport/';
    $config['allowed_types'] = 'xlsx|xls';
    $config['encrypt_name'] = TRUE;
    $config['max_size']      = 20240;
    $supplier_id = $_POST['supplier_id'];
    $paramsToEncrypt = $_POST['supplier_id'] . '|' .$_POST['supplier_name'].'|'. $_POST['isPARLevelRequired'].'|imported';
    $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
    $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
                
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
          $product_category_id = (preg_match('/\[(.*?)\]/', $row['D'], $matches) ? $matches[1] : '');        
          $tierTypeValue = (preg_match('/\[(.*?)\]/', $row['E'], $matches) ? $matches[1] : '');
          $cafe_unit_uomValue = (preg_match('/\[(.*?)\]/', $row['F'], $matches) ? $matches[1] : '');
          $inner_unit_uomValue = (preg_match('/\[(.*?)\]/', $row['H'], $matches) ? $matches[1] : '');        
          $each_unit_uomValue = (preg_match('/\[(.*?)\]/', $row['J'], $matches) ? $matches[1] : '');        
            
                $data = array(
                    'product_code' => $row['A'],
                    'product_name' => $row['B'],
                    'price' => $row['C'],
                    'product_category_id' => $product_category_id,
                    'tier_type' => $tierTypeValue,
                    'cafe_unit_uom' => $cafe_unit_uomValue,
                    'cafe_unit_uomQty' => $row['G'],
                    'inner_unit_uom' => $inner_unit_uomValue,
                    'inner_unit_uomQty' => $row['I'],
                    'each_unit_uom' => $each_unit_uomValue,
                    'sameStockforAllDays' => 'on',
                    'PARLevelQty' => $row['K'],
                    'account_number' => $row['L'],
                    'account_name' => $row['M'],
                    'tax_code' => $row['N'],
                    'supplier_id' => $supplier_id,
                );
          if ($data['product_name'] == '') {
            break; 
            }  
               $result = $this->supplier_model->addProduct($this->location_id,$data);   
              }
               
               $count++;
            }

         return redirect(base_url('/Supplier/supplier_item/'.$encodedParams));
        } else {
            // Display the upload error
            echo $this->upload->display_errors();
        }
    }
	

    
    public function download_sample($supplierId='') {
    // Load required libraries and models
    
    $product_category = $this->supplier_model->fetchProductCategory();
    $categoryList = array_map(function($category) {
    return '['.$category['product_category_id'] . ']' . $category['product_category_name'];
      }, $product_category);
    $tierTypes = array('[t1]UOM (Example: EACH)', '[t2]UOM(Example: BOX, EACH)', '[t3]UOM (Example: BOX, SLEEVE, EACH)');
    $product_UOM = $this->supplier_model->fetchUOM($this->location_id);
    
    $uomList = array_map(function($uom) {
    return '['.$uom['product_UOM_id'] . ']' . $uom['product_UOM_name'];
      }, $product_UOM);
    
    
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0);

    $spreadsheet->getActiveSheet()->setTitle('Product Import Template');

    // Set column headings
    $spreadsheet->getActiveSheet()->setCellValue('A1', 'product_code');
    $spreadsheet->getActiveSheet()->setCellValue('B1', 'product_name');
    $spreadsheet->getActiveSheet()->setCellValue('C1', 'price');
    $spreadsheet->getActiveSheet()->setCellValue('D1', 'product_category_id');
    $spreadsheet->getActiveSheet()->setCellValue('E1', 'tier_type');
    $spreadsheet->getActiveSheet()->setCellValue('F1', 'cafe_unit_uom');
    $spreadsheet->getActiveSheet()->setCellValue('G1', 'cafe_unit_uomQty');
    $spreadsheet->getActiveSheet()->setCellValue('H1', 'inner_unit_uom');
    $spreadsheet->getActiveSheet()->setCellValue('I1', 'inner_unit_uomQty');
    $spreadsheet->getActiveSheet()->setCellValue('J1', 'each_unit_uom');
    $spreadsheet->getActiveSheet()->setCellValue('K1', 'PARLevelQty');
    $spreadsheet->getActiveSheet()->setCellValue('L1', 'account_number');
    $spreadsheet->getActiveSheet()->setCellValue('M1', 'account_name');
    $spreadsheet->getActiveSheet()->setCellValue('N1', 'tax_code');
  
    

    // Populate default values and configure dropdowns
    $startingRow = 2;
    $numRows = 500; 
   for ($row = $startingRow; $row <= $startingRow + $numRows - 1; $row++) {    
    $spreadsheet->getActiveSheet()->setCellValue('A' . $row, '');  // Input field, leave blank
    $spreadsheet->getActiveSheet()->setCellValue('B' . $row, '');  // Input field
    $spreadsheet->getActiveSheet()->setCellValue('C' . $row, '');  // Input field
    $spreadsheet->getActiveSheet()->setCellValue('K' . $row, ''); 
   

  // Dropdown for product_category_id

$spreadsheet->getActiveSheet()
    ->getCell('D' . $row)
    ->setValue('')
    ->getDataValidation()
    ->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
    ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
    ->setAllowBlank(true)
    ->setShowInputMessage(true)
    ->setShowErrorMessage(true)
    ->setShowDropDown(true)
    ->setErrorTitle('Input error')
    ->setError('Please pick correct value from the drop-down list only, manual entry is not allowed')
    ->setPromptTitle('Pick from list')
    ->setPrompt('Please pick a value from the drop-down list')
    ->setFormula1('"'.implode(',', $categoryList).'"');

// Dropdown for tier_type

   $spreadsheet->getActiveSheet()
    ->getCell('E' . $row)
    ->setValue('')
    ->getDataValidation()
    ->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
    ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
    ->setAllowBlank(true)
    ->setShowInputMessage(true)
    ->setShowErrorMessage(true)
    ->setShowDropDown(true)
    ->setErrorTitle('Input error')
    ->setError('Please pick correct value from the drop-down list only, manual entry is not allowed')
    ->setPromptTitle('Pick from list')
    ->setPrompt('Please pick a value from the drop-down list')
    ->setFormula1('"'.implode(',', $tierTypes).'"');
    
    $spreadsheet->getActiveSheet()
    ->getCell('F' . $row)
    ->setValue('')
    ->getDataValidation()
    ->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
    ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
    ->setAllowBlank(true)
    ->setShowInputMessage(true)
    ->setShowErrorMessage(true)
    ->setShowDropDown(true)
    ->setErrorTitle('Input error')
    ->setError('Please pick correct value from the drop-down list only, manual entry is not allowed')
    ->setPromptTitle('Pick from list')
    ->setPrompt('Please pick a value from the drop-down list')
    ->setFormula1('"'.implode(',', $uomList).'"');
    
    
    $spreadsheet->getActiveSheet()
    ->getCell('H' . $row)
    ->setValue('')
    ->getDataValidation()
    ->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
    ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
    ->setAllowBlank(true)
    ->setShowInputMessage(true)
    ->setShowErrorMessage(true)
    ->setShowDropDown(true)
    ->setErrorTitle('Input error')
    ->setError('Please pick correct value from the drop-down list only, manual entry is not allowed')
    ->setPromptTitle('Pick from list')
    ->setPrompt('Please pick a value from the drop-down list')
    ->setFormula1('"'.implode(',', $uomList).'"');
    
    
    
    $spreadsheet->getActiveSheet()
    ->getCell('J' . $row)
    ->setValue('')
    ->getDataValidation()
    ->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
    ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
    ->setAllowBlank(true)
    ->setShowInputMessage(true)
    ->setShowErrorMessage(true)
    ->setShowDropDown(true)
    ->setErrorTitle('Input error')
    ->setError('Please pick correct value from the drop-down list only, manual entry is not allowed')
    ->setPromptTitle('Pick from list')
    ->setPrompt('Please pick a value from the drop-down list')
    ->setFormula1('"'.implode(',', $uomList).'"');

}



    // Set column widths for readability
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(40);
    

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // Set headers to force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="productSample.xlsx"');
    header('Cache-Control: max-age=0');

    // Save the spreadsheet to a file
    $writer->save('php://output');
}

    
    
	
}