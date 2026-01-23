<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('budget_model');
		$this->load->model('common_model');
		
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->location_id = $this->session->userdata('location_id');
	  
	}
	public function index(){
	    
	    $supplier_categories = $this->supplier_model->fetchSuppliersSubCategory($this->location_id);
	    $supplier_Maincategories = $this->supplier_model->fetchSuppliersCategory($this->location_id);
	    $supplier_MaincategoriesId = array_column($supplier_Maincategories,'category_id');
	    $data['locationBudgetDetails'] = fetchLocationBudget($this->tenantDb,$this->location_id);
        // echo "<pre>"; print_r($data['locationBudgetDetails']); exit;
        $supplier_CurrentWeekBudgetData = $this->budget_model->fetchCurrentWeekBudgetData($this->location_id);

         
        $allCatAndSub = array();
        foreach($supplier_MaincategoriesId as $mainCatId){
         foreach($supplier_categories as $subCat){ 
             
           
        if($mainCatId == $subCat['category_id']){
            // this is not supplier used budget, but this is budget used for individual sub category on weekly and monthly basis
         
        // merge supplier_CurrentWeekBudgetData with suppCat based on ID
       if(isset($supplier_CurrentWeekBudgetData) && !empty($supplier_CurrentWeekBudgetData)){
         foreach($supplier_CurrentWeekBudgetData as $currentWeekBudgetData){  
         if($currentWeekBudgetData->subcatId == $subCat['id']){
         $budgetUsedForThisSubCatInCurrentWeek = $this->budget_model->getSuppliersUsedBudget($subCat['id'],'weekly',true); 
         $budgetUsedForThisSubCatInCurrentMonth = $this->budget_model->getSuppliersUsedBudget($subCat['id'],'monthly',true); 
        
             
         $subCat['weeklyBudget']  = $currentWeekBudgetData->weeklyBudget;
         $subCat['monthlyBudget']  = $currentWeekBudgetData->monthlyBudget;
         $subCat['weeklyPercentage']  =  $currentWeekBudgetData->weeklyPercentage;
         $subCat['monthlyPercentage']  =  $currentWeekBudgetData->monthlyPercentage;
         $subCat['weeklySpent']  = $budgetUsedForThisSubCatInCurrentWeek;
         $subCat['monthlySpent']  = $budgetUsedForThisSubCatInCurrentMonth;
           
         }
         
         
         }
       }     
        // for highlighting the btns  , if a sub category is assigned to multiple suppliers, so that they can enter budget for those supplier also 
         $this->tenantDb->select('supplier_id', FALSE);
         $this->tenantDb->where('location_id', $this->location_id);
         $this->tenantDb->where('category_id', $subCat['id']);
         $query = $this->tenantDb->get('SUPPLIERS_suppliersList');
         $SupplierIdsToSubCatId = $query->result_array();
         if(isset($SupplierIdsToSubCatId) && !empty($SupplierIdsToSubCatId)){ 
         $subCat['noOfSuppliers'] = count($SupplierIdsToSubCatId);
         }else{
         $subCat['noOfSuppliers'] = 0;;    
         }
        $indexName = $mainCatId.'_'.$subCat['mainCategoryName'];
        $allCatAndSub[$indexName][] =   $subCat;
        }  
        
        
        }
        }
        $data['allCatAndSubs'] = $allCatAndSub;
        
        

	    $this->load->view('general/header');
        $this->load->view('Budget/budgetAdd',$data);
      	$this->load->view('general/footer');  
	}
	
	// save sub cat budget from listing page
	function saveBudget(){
	    
	  if (!empty($_POST['subCatId'])) {
	    $postedSubCatId = $_POST['subCatId'];
	    $budgetData = array();
	    $locationBudgetData = array();
        foreach ($postedSubCatId as $subCatId) {
         
        //  echo "<pre>"; print_r($_POST); exit;
         $budgetData['subcatId']  =  $subCatId;
         $budgetData['weeklyBudget']  =  $_POST['weekly_'.$subCatId] ?? '';
         $budgetData['monthlyBudget']  =  $_POST['monthly_'.$subCatId] ?? '';
         $budgetData['weeklyPercentage'] =    $_POST['weeklyPercentage_'.$subCatId] ?? '';
         $budgetData['monthlyPercentage'] =    $_POST['monthlyPercentage_'.$subCatId] ?? '';
         $budgetData['date_entered']  =  date('Y-m-d');
         $budgetData['location_id']  =  $this->location_id;
         
         $this->budget_model->saveBudget($budgetData);
         
        }
        
        $locationBudgetData['weeklyLocationBudget'] = (isset($_POST['weeklyLocationBudget']) ? $_POST['weeklyLocationBudget']: '');
        $locationBudgetData['monthlyLocationBudget'] = (isset($_POST['monthlyLocationBudget']) ? $_POST['monthlyLocationBudget']: '');
        $locationBudgetData['weeklyAllocatedBudget'] = (isset($_POST['weeklyAllocatedBudget']) ? $_POST['weeklyAllocatedBudget']: '');
        $locationBudgetData['monthlyAllocatedBudget'] = (isset($_POST['monthlyAllocatedBudget']) ? $_POST['monthlyAllocatedBudget']: '');
        $locationBudgetData['weeklyBudgetSpent'] = (isset($_POST['weeklyBudgetSpent']) ? $_POST['weeklyBudgetSpent']: '');
        $locationBudgetData['monthlyBudgetSpent'] = (isset($_POST['monthlyBudgetSpent']) ? $_POST['monthlyBudgetSpent']: '');
        $locationBudgetData['location_id'] = $this->location_id; 
        $locationBudgetData['date_modified'] = date('Y-m-d');
        $this->budget_model->updateBudgetDetails($locationBudgetData);

        return redirect(base_url('Supplier/Budget/index'));
	  }
	    
	}
	
	
	
	function saveSupplierBudget(){
	    $bulkDataWeekly_budget = array();
	    $bulkPriceMonthly_budget = array(); 
	    
	   if(isset($_POST) && !empty($_POST)){
	   foreach ($_POST['supplier_id'] as $index => $SupplierId) {
	     
	     $budgetData['subcatId']  =  $_POST['subCat_id'];
	     $budgetData['supplier_id']  =  $SupplierId;
         $budgetData['weeklyBudget']  =  (isset($_POST['weeklySuppBudget'][$index]) ? $_POST['weeklySuppBudget'][$index]: '');
         $budgetData['monthlyBudget']  =  (isset($_POST['monthlySuppBudget'][$index]) ? $_POST['monthlySuppBudget'][$index]: '');
         $budgetData['date_entered']  =  date('Y-m-d');
         $budgetData['location_id']  =  $this->location_id;  
	      $this->budget_model->saveSupplierBudget($budgetData); 
	     }  

       
         
         
        echo "success";
	   }else{
	       echo "Please enter values to save";
	   }
	   
	}

}