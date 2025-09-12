<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('budget_model');
		$this->load->model('common_model');
		
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->location_id = $this->session->userdata('location_id');
		
	
	
	}
	public function weeklyReport($filteredReportResult=array()){
	   
	    $result = $this->fetchMainAndSubCat();
	    $data['supplier_Subcategories'] = $result['supplier_Subcategories'];
	    $data['supplier_Maincategories'] = $result['supplier_Maincategories'];
       
	       //echo "<pre>"; print_r($data['supplier_Maincategories']);exit;
	    $this->load->view('general/header');
        $this->load->view('Report/weeklyreport',$data);
      	$this->load->view('general/footer'); 
	    
	}
	
	public function monthlyReport($filteredReportResult=array()){
	   
	   

	   $result = $this->fetchMainAndSubCat();
	    $data['supplier_Subcategories'] = $result['supplier_Subcategories'];
	    $data['supplier_Maincategories'] = $result['supplier_Maincategories'];
	       //echo "<pre>"; print_r($data['supplier_Maincategories']);exit;
	    $this->load->view('general/header');
        $this->load->view('Report/monthlyreport',$data);
      	$this->load->view('general/footer'); 
	    
	}
	
	function filterReportWeekly(){
	
	  $deliveryDateFrom = $this->input->post('from_delivery_date');
      $deliveryDateTo = $this->input->post('to_delivery_date');
      $selectedSubCategories = $this->input->post('selectedSubCategories');
      $selectedMainCategories = $this->input->post('selectedMainCategories');
      $filteredReportResult = $this->budget_model->filterReportWeekly($deliveryDateFrom,$deliveryDateTo,$selectedSubCategories,$selectedMainCategories); 
    //   echo "<pre>"; print_r($_POST);exit;
       $result = $this->fetchMainAndSubCat();
	    $data['supplier_Subcategories'] = $result['supplier_Subcategories'];
	    $data['supplier_Maincategories'] = $result['supplier_Maincategories'];
	    $data['filteredReportResult'] = $filteredReportResult;
	     $this->load->view('general/header');
        $this->load->view('Report/weeklyreport',$data);
      	$this->load->view('general/footer'); 
	    
	}
	
	 function filterReportMonthly() {
        $month = $this->input->post('filter_month'); 
        $year = $this->input->post('filter_year');  
       
        $selectedSubCategories = $this->input->post('selectedSubCategories');
        $selectedMainCategories = $this->input->post('selectedMainCategories');

        // Call the updated model method with month and year
        $filteredReportResult = $this->budget_model->filterReportMonthly($month, $year, $selectedSubCategories,$selectedMainCategories);

        $data['selected_month'] =$month;
        $data['selected_year'] =$year;
        
        $result = $this->fetchMainAndSubCat();
        $data['supplier_Subcategories'] = $result['supplier_Subcategories'];
        $data['supplier_Maincategories'] = $result['supplier_Maincategories'];
        $data['filteredReportResult'] = $filteredReportResult;

        // Load views (unchanged)
        $this->load->view('general/header');
        $this->load->view('Report/monthlyreport', $data);
        $this->load->view('general/footer');
    }
	
	function fetchMainAndSubCat(){
	    $supplier_Subcategories = $this->supplier_model->fetchSuppliersSubCategory($this->location_id);
	    $supplier_Maincategories = $this->supplier_model->fetchSuppliersCategory($this->location_id);
	     $result['supplier_Subcategories'] = $supplier_Subcategories;
	     $result['supplier_Maincategories'] = $supplier_Maincategories;
	     return $result;
	}
	
}