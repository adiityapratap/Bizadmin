<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Budget_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
	}
	
	function saveBudget($insertData){
	     $currentWeek = date('W');
	     $currentYear = date('Y');
	     
	     $this->tenantDb->where('WEEK(date_entered, 1) = ' . $currentWeek);
	     $this->tenantDb->where('YEAR(date_entered) = ' . $currentYear);
	     $this->tenantDb->where('location_id', $this->location_id); 
	     $this->tenantDb->where('subcatId', $insertData['subcatId']); 
	     $query = $this->tenantDb->get('SUPPLIERS_subCategoryBudgetRecord');
	     $existingCurrentWeekData = ($query ? $query->result_array() : '');
	     
  
	    if(isset($existingCurrentWeekData) && !empty($existingCurrentWeekData)){
	      $this->tenantDb->where('subcatId', $existingCurrentWeekData[0]['subcatId']);
	      $this->tenantDb->where('date_entered', $existingCurrentWeekData[0]['date_entered']);
          $this->tenantDb->update('SUPPLIERS_subCategoryBudgetRecord', $insertData);        
	     
	    }else{
	    $this->tenantDb->insert('SUPPLIERS_subCategoryBudgetRecord', $insertData); 
	    }
	    
	    // if this sub category is assigned to only one supplier than automatically assign budget at supplier level also
         $this->tenantDb->select('supplier_id', FALSE);
         $this->tenantDb->where('location_id', $this->location_id);
         $this->tenantDb->where('category_id', $insertData['subcatId']);

         $query = $this->tenantDb->get('SUPPLIERS_suppliersList');
         $SupplierIdsToSubCatId = $query->result_array();
         if(isset($SupplierIdsToSubCatId) && !empty($SupplierIdsToSubCatId) && count($SupplierIdsToSubCatId) < 2){
             
             
         $this->tenantDb->where('WEEK(date_entered, 1) = ' . $currentWeek);
	     $this->tenantDb->where('YEAR(date_entered) = ' . $currentYear);
	     $this->tenantDb->where('location_id', $this->location_id); 
	     $this->tenantDb->where('supplier_id', $SupplierIdsToSubCatId[0]['supplier_id']); 
	     $query = $this->tenantDb->get('SUPPLIERS_budgetRecord');
	     $existingCurrentWeekSupplierData = ($query ? $query->result_array() : '');
	     
	     $insertData['supplier_id']   = $SupplierIdsToSubCatId[0]['supplier_id'];
  
	    if(isset($existingCurrentWeekSupplierData) && !empty($existingCurrentWeekSupplierData)){
	      $this->tenantDb->where('subcatId', $existingCurrentWeekSupplierData[0]['subcatId']);
	      $this->tenantDb->where('date_entered', $existingCurrentWeekSupplierData[0]['date_entered']);
          $this->tenantDb->update('SUPPLIERS_budgetRecord', $insertData);        
	     
	    }else{
	   $this->tenantDb->insert('SUPPLIERS_budgetRecord', $insertData); 
	    }    
       
      	// update monthky and weekly budget in supplier list table also for easy fetching the data whenever needed
	   $budgetDataForSuppListTable['weekly_budget'] = $insertData['weeklyBudget'];  $budgetDataForSuppListTable['monthly_budget'] = $insertData['monthlyBudget']; 
	    $this->supplier_model->supplierCommonUPdate($insertData['supplier_id'],$budgetDataForSuppListTable);
         
             
         } 
	    
	  return true;
	}
	
	function fetchCurrentWeekBudgetData() {
    try {
        // Get the date of the most recently entered budget record
        $this->tenantDb->select_max('date_entered', 'lastBudgetRecordedDate');
        $this->tenantDb->from('SUPPLIERS_subCategoryBudgetRecord');
        $query = $this->tenantDb->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $lastBudgetRecordedDate = $row->lastBudgetRecordedDate;

            // Fetch budget data for the most recent date and current location
            $this->tenantDb->select('*');
            $this->tenantDb->from('SUPPLIERS_subCategoryBudgetRecord');
            $this->tenantDb->where('date_entered', $lastBudgetRecordedDate);
            $this->tenantDb->where('location_id', $this->location_id);
            $query = $this->tenantDb->get();

            return $query->result(); // Return the budget data
        } else {
            return []; // Return an empty array if no records found
        }
    } catch (Exception $e) {
        // Handle database errors here
        return false; // Or return a more informative error response
    }
}

	
	function saveSupplierBudget($insertData){
	     $currentWeek = date('W');
	     $currentYear = date('Y');
	     $this->tenantDb->where('WEEK(date_entered, 1) = ' . $currentWeek);
	     $this->tenantDb->where('YEAR(date_entered) = ' . $currentYear);
	     $this->tenantDb->where('location_id', $this->location_id); 
	     $this->tenantDb->where('subcatId', $insertData['subcatId']); 
	     $this->tenantDb->where('supplier_id', $insertData['supplier_id']);
	     $query = $this->tenantDb->get('SUPPLIERS_budgetRecord');
	     $existingCurrentWeekData = ($query ? $query->result_array() : '');
	     
   
	    if(isset($existingCurrentWeekData) && !empty($existingCurrentWeekData)){
	      $this->tenantDb->where('subcatId', $existingCurrentWeekData[0]['subcatId']);
	       $this->tenantDb->where('supplier_id', $existingCurrentWeekData[0]['supplier_id']);
	      $this->tenantDb->where('date_entered', $existingCurrentWeekData[0]['date_entered']);
          $this->tenantDb->update('SUPPLIERS_budgetRecord', $insertData);        
	     
	    }else{
	    $this->tenantDb->insert('SUPPLIERS_budgetRecord', $insertData);    
	    }
	    
	    	// update monthky and weekly budget in supplier list table also for easy fetching the data whenever needed
	   $budgetDataForSuppListTable['weekly_budget'] = $insertData['weeklyBudget'];  $budgetDataForSuppListTable['monthly_budget'] = $insertData['monthlyBudget']; 
	    $this->supplier_model->supplierCommonUPdate($insertData['supplier_id'],$budgetDataForSuppListTable);
	    

	   return true;
	    
	    
	   
	}
	
	function updateBudgetDetails($data){
	     $currentWeek = date('W');
	     $currentYear = date('Y');
	    $this->tenantDb->where('WEEK(date_modified, 1) = ' . $currentWeek);
	     $this->tenantDb->where('YEAR(date_modified) = ' . $currentYear);
	     $this->tenantDb->where('location_id', $this->location_id); 
	     $query = $this->tenantDb->get('SUPPLIERS_LocationWisebudgetRecord');
	     $existingCurrentWeekData = ($query ? $query->result_array() : '');
	     
   
	    if(isset($existingCurrentWeekData) && !empty($existingCurrentWeekData)){
	      $this->tenantDb->where('location_id', $this->location_id);
	      $this->tenantDb->where('date_modified', $existingCurrentWeekData[0]['date_modified']);
          $this->tenantDb->update('SUPPLIERS_LocationWisebudgetRecord', $data);        
	     
	    }else{
	    $this->tenantDb->insert('SUPPLIERS_LocationWisebudgetRecord', $data);    
	    }
	    
	}
	
	public function getSuppliersUsedBudget($id='',$budgetType='weekly',$fetchBudgetForSubCat=false){
	  //orderstatus = 2,3,4 only consider those order for budget , wch has been received,view,confirmed  //
	    $currentWeek = date('W');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $this->tenantDb->select('SUM(so.order_total) as total');
        $this->tenantDb->from('SUPPLIERS_orders so');
    //   $this->tenantDb->join('SUPPLIERS_suppliersList sl', 'so.supplier_id = sl.supplier_id', 'LEFT');
       
       if($id !=''){
        if($fetchBudgetForSubCat == true){
        $this->tenantDb->where('so.subcategory_id', $id);   
       }else{
       $this->tenantDb->where('so.supplier_id', $id);    
       }   
       }
       
       
       $this->tenantDb->where_in('so.status', array(2, 3, 4));
       $this->tenantDb->where('so.location_id', $this->location_id);
       
       if($budgetType =='weekly'){
       $this->tenantDb->where('WEEK(so.delivery_date, 1) = ' . $currentWeek);  
       }elseif($budgetType =='monthly'){
       $this->tenantDb->where('MONTH(so.delivery_date) = ' . $currentMonth);   
        }
       $this->tenantDb->where('YEAR(so.delivery_date) = ' . $currentYear);

      $query = $this->tenantDb->get();
    //   echo $this->tenantDb->last_query(); exit;
	    $res = $query->result_array();
	     if(!empty($res)){ 
            return (isset($res[0]['total']) ? $res[0]['total'] : 0);
        }else{
            return 0;
        }
	}
	
	
	
	function fetchMonthlyLocationBudgets() {
    try {
        // Get the current year
        $currentYear = date('Y');

        // Fetch all budget records for the current year
        $this->tenantDb->select('MONTH(date_modified) as month, monthlyLocationBudget');
        $this->tenantDb->from('SUPPLIERS_LocationWisebudgetRecord');
       $this->tenantDb->where('location_id', $this->location_id); 
        $this->tenantDb->where('YEAR(date_modified)', $currentYear);
        $this->tenantDb->order_by('date_modified', 'ASC');
        $query = $this->tenantDb->get();

        $monthlyBudgets = [];

        if ($query->num_rows() > 0) {
            $result = $query->result();

            // Initialize an array with default values for each month
            $monthlyBudgets = array_fill_keys(range(1, 12), 0);

            foreach ($result as $row) {
                $month = $row->month;
                $budget = $row->monthlyLocationBudget;

                // Update the array with the fetched budget for the corresponding month
                $monthlyBudgets[$month] = $budget;
            }
        }

        return $monthlyBudgets;
    } catch (Exception $e) {
        // Handle database errors here
        return [];
    }
}

	
	// for reports page only
	
	function filterReportWeekly($deliveryDateFrom,$deliveryDateTo='',$subCatId='',$categoryId=''){
	    
	    $dateDiff = strtotime($deliveryDateTo) - strtotime($deliveryDateFrom);
        $weeks = ceil($dateDiff / (7 * 24 * 60 * 60)); // Calculate number of weeks
  
	    $this->tenantDb->select('so.subcategory_id,so.delivery_date,SUM(so.order_total) as total,WEEK(so.delivery_date) AS week_number');
        $this->tenantDb->from('SUPPLIERS_orders so')
        ->join('SUPPLIERS_supplier_subcategories ssc', 'so.subcategory_id = ssc.id', 'LEFT')
         ->join('SUPPLIERS_supplier_categories sc', 'sc.category_id = ssc.category_id', 'LEFT')
        ->where('so.location_id', $this->location_id);
        
        
        // Apply WHERE clause for delivery date range
        $this->tenantDb->where('so.delivery_date >=', date('Y-m-d',strtotime($deliveryDateFrom)));
        if($deliveryDateTo ==''){
        $this->tenantDb->where('so.delivery_date <=', date('Y-m-d',strtotime($deliveryDateFrom)));    
         }else{
        $this->tenantDb->where('so.delivery_date <=', date('Y-m-d',strtotime($deliveryDateTo)));    
        }
       
       

         if ($subCatId) {
          $subCatArray = explode(',', $subCatId);
         $this->tenantDb->where_in('so.subcategory_id', $subCatArray);
         }
         
         if ($categoryId) {
            $CatArray = explode(',', $categoryId);
            $this->tenantDb->where_in('sc.category_id', $CatArray);
          }
      
      
        $this->tenantDb->group_by('so.subcategory_id, WEEK(so.delivery_date)'); // Group by supplier and week
        $query = $this->tenantDb->get();
        
//  echo $this->tenantDb->last_query(); exit;
      // Process results for multiple weeks
      $weeklyTotals = [];
     
      $resultOrder = method_exists($query, 'result_array') ? $query->result_array() : [];
    //   echo "<pre>"; print_r($resultOrder); exit;
  if(!empty($resultOrder)){
   foreach ($resultOrder as $row) { 
    $weekNumber = $row['week_number']; // Extract the week number from the delivery_date

    $queryInner = $this->tenantDb->select('subcatId, sbr.weeklyBudget, sbr.weeklyPercentage, ssc.category_name as subCategoryName, sc.category_name as mainCategoryName')
        ->from('SUPPLIERS_subCategoryBudgetRecord sbr')
        ->join('SUPPLIERS_supplier_subcategories ssc', 'sbr.subcatId = ssc.id', 'LEFT')
        ->join('SUPPLIERS_supplier_categories sc', 'sc.category_id = ssc.category_id', 'LEFT')
        ->where('sbr.subcatId', $row['subcategory_id'])
        ->where('sbr.location_id', $this->location_id)
        ->where('YEARWEEK(sbr.date_entered) = YEARWEEK(' . $this->db->escape($row['delivery_date']) . ')', null, false)
        ->order_by('sbr.date_entered', 'DESC') // Order by date_entered in descending order
        ->get();
   
      $budgetResult = method_exists($queryInner, 'row_array') ? $queryInner->row_array() : [];

 
    if (empty($budgetResult)) {
        // If no result is found for the given week, try to find the budget for previous latest week as we do not update budget every week or every month
        $queryInner = $this->tenantDb->select('subcatId, sbr.weeklyBudget,sbr.weeklyPercentage, ssc.category_name as subCategoryName, sc.category_name as mainCategoryName')
            ->from('SUPPLIERS_subCategoryBudgetRecord sbr')
            ->join('SUPPLIERS_supplier_subcategories ssc', 'sbr.subcatId = ssc.id', 'LEFT')
            ->join('SUPPLIERS_supplier_categories sc', 'sc.category_id = ssc.category_id', 'LEFT')
            ->where('sbr.subcatId', $row['subcategory_id'])
            ->where('sbr.location_id', $this->location_id)
            ->where('WEEK(sbr.date_entered) <=', $weekNumber)
            ->order_by('sbr.date_entered', 'DESC') // Order by date_entered in descending order
            ->limit(1) // Limit the result to 1 row
            ->get();

       $budgetResult = method_exists($queryInner, 'row_array') ? $queryInner->row_array() : [];
      
         
    }

    if (!empty($budgetResult)) {
        $weeklyTotals[$row['subcategory_id']][$weekNumber] = array(
            'delivery_date' => (isset($row['delivery_date']) ? $row['delivery_date'] :''),
            'subcategory_id' => (isset($row['subcategory_id']) ? $row['subcategory_id'] : ''),
            'subCategoryName' => (isset($budgetResult['subCategoryName']) ? $budgetResult['subCategoryName'] : ''),
            'mainCategoryName' => (isset($budgetResult['mainCategoryName']) ? $budgetResult['mainCategoryName'] : ''),
            'weeklyBudget' => (isset($budgetResult['weeklyBudget']) ? $budgetResult['weeklyBudget'] : 0),
            'weeklySpent' => (isset($row['total']) ? $row['total'] : 0),
            'weeklyPercentage' => (isset($budgetResult['weeklyPercentage']) ? $budgetResult['weeklyPercentage']: ''),
            'weeklyRemaining' => (isset($budgetResult['weeklyBudget']) ? $budgetResult['weeklyBudget'] : 0 ) - (isset($row['total']) ? $row['total'] : 0),
            'isBudgetExceeded' => ($row['total'] > (isset($budgetResult['weeklyBudget']) ? $budgetResult['weeklyBudget'] : 0) ? 'yes' : 'no')
            );
        

    } else {
        // Handle the case when no matching budget is found
        // You can set a default value or handle it as needed
        $weeklyTotals[$row['subcategory_id']][$weekNumber] = array(
            'delivery_date' => '',
            'subcategory_id' => '',
            'subCategoryName' => '',
            'mainCategoryName' => '',
            'weeklyBudget' => 0,
            'weeklySpent' => 0,
            'weeklyPercentage' => '',
            'weeklyRemaining' => 0,
            'isBudgetExceeded' => 'no'
            );
    }
}   
  }

      return $weeklyTotals;
	  
	}
	
	
     function filterReportMonthly($month, $year, $subCatId = '', $categoryId = '') {
        // Construct the date range for the selected month
        $firstDayOfMonth = "$year-$month-01";
        $lastDayOfMonth = date("Y-m-t", strtotime($firstDayOfMonth)); // Last day of the month

        $this->tenantDb->select('so.subcategory_id, so.delivery_date, SUM(so.order_total) as total, MONTH(so.delivery_date) AS month_number,sc.category_name as supplier_main_category');
        $this->tenantDb->from('SUPPLIERS_orders so')
        ->join('SUPPLIERS_supplier_subcategories ssc', 'so.subcategory_id = ssc.id', 'LEFT')
         ->join('SUPPLIERS_supplier_categories sc', 'sc.category_id = ssc.category_id', 'LEFT')
        ->where('so.location_id', $this->location_id);
        
        // Apply WHERE clause for the selected month and year
        $this->tenantDb->where('so.delivery_date >=', $firstDayOfMonth);
        $this->tenantDb->where('so.delivery_date <=', $lastDayOfMonth);

        if ($subCatId) {
            $subCatArray = explode(',', $subCatId);
            $this->tenantDb->where_in('so.subcategory_id', $subCatArray);
        }
        
        if ($categoryId) {
            $CatArray = explode(',', $categoryId);
            $this->tenantDb->where_in('sc.category_id', $CatArray);
        }

        $this->tenantDb->group_by('so.subcategory_id, MONTH(so.delivery_date)'); // Group by subcategory and month
        $query = $this->tenantDb->get();
        // echo $this->tenantDb->last_query(); exit;
        // Process results for the selected month
        $monthlyTotals = [];
        $resultOrder = method_exists($query, 'result_array') ? $query->result_array() : [];

        if (!empty($resultOrder)) {
            foreach ($resultOrder as $row) {
                $monthNumber = $row['month_number']; // Extract the month number from the delivery_date

                $queryInner = $this->tenantDb->select('subcatId, sbr.monthlyBudget, sbr.monthlyPercentage, ssc.category_name as subCategoryName, sc.category_name as mainCategoryName')
                    ->from('SUPPLIERS_subCategoryBudgetRecord sbr')
                    ->join('SUPPLIERS_supplier_subcategories ssc', 'sbr.subcatId = ssc.id', 'LEFT')
                    ->join('SUPPLIERS_supplier_categories sc', 'sc.category_id = ssc.category_id', 'LEFT')
                    ->where('sbr.subcatId', $row['subcategory_id'])
                    ->where('sbr.location_id', $this->location_id)
                    ->where('YEAR(sbr.date_entered)', $year)
                    ->where('MONTH(sbr.date_entered)', $month)
                    ->order_by('sbr.date_entered', 'DESC') // Order by date_entered in descending order
                    ->get();

                $budgetResult = method_exists($queryInner, 'row_array') ? $queryInner->row_array() : [];

                if (empty($budgetResult)) {
                    // If no budget is found for the selected month, try to find the budget from a previous month
                    $queryInner = $this->tenantDb->select('subcatId, sbr.monthlyBudget, sbr.monthlyPercentage, ssc.category_name as subCategoryName, sc.category_name as mainCategoryName')
                        ->from('SUPPLIERS_subCategoryBudgetRecord sbr')
                        ->join('SUPPLIERS_supplier_subcategories ssc', 'sbr.subcatId = ssc.id', 'LEFT')
                        ->join('SUPPLIERS_supplier_categories sc', 'sc.category_id = ssc.category_id', 'LEFT')
                        ->where('sbr.subcatId', $row['subcategory_id'])
                        ->where('sbr.location_id', $this->location_id)
                        ->where('YEAR(sbr.date_entered) <=', $year)
                        ->where('MONTH(sbr.date_entered) <=', $month)
                        ->order_by('sbr.date_entered', 'DESC') // Order by date_entered in descending order
                        ->limit(1) // Limit the result to 1 row
                        ->get();

                    $budgetResult = method_exists($queryInner, 'row_array') ? $queryInner->row_array() : [];
                }

                if (!empty($budgetResult)) {
                    $monthlyTotals[$row['subcategory_id']][$monthNumber] = [
                        'delivery_date' => $row['delivery_date'] ?? '',
                        'subcategory_id' => $row['subcategory_id'] ?? '',
                        'subCategoryName' => $budgetResult['subCategoryName'] ?? '',
                        'mainCategoryName' => $budgetResult['mainCategoryName'] ?? '',
                        'monthlyBudget' => $budgetResult['monthlyBudget'] ?? 0,
                        'monthlySpent' => $row['total'] ?? 0,
                        'monthlyPercentage' => $budgetResult['monthlyPercentage'] ?? '',
                        'monthlyRemaining' => ($budgetResult['monthlyBudget'] ?? 0) - ($row['total'] ?? 0),
                        'isBudgetExceeded' => ($row['total'] > ($budgetResult['monthlyBudget'] ?? 0) ? 'yes' : 'no'),
                    ];
                } else {
                    // Handle the case when no matching budget is found
                    $monthlyTotals[$row['subcategory_id']][$monthNumber] = [
                        'delivery_date' => '',
                        'subcategory_id' => '',
                        'subCategoryName' => '',
                        'mainCategoryName' => '',
                        'monthlyBudget' => 0,
                        'monthlySpent' => 0,
                        'monthlyPercentage' => '',
                        'monthlyRemaining' => 0,
                        'isBudgetExceeded' => 'no'
                    ];
                }
            }
        }

        return $monthlyTotals;
    }
	
	
}