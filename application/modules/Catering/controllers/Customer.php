<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('genric_model');
	   $this->load->model('customer_model');
	   $this->load->model('common_model');
      !$this->ion_auth->logged_in() ? redirect('auth/login') : '';
      $this->selected_location_id = $this->session->userdata('location_id');
	 }
	 
	 function commonrecord(){
	  
	  $table = 'Catering_company';   $tabledepartment = 'Catering_department';  $tablecustomer = 'Catering_customer'; $tablelocations = 'Catering_locations';
	    $conditionsComp = array( 'status' => 1 );
	     $conditionsCustomer = array('status' => 1);
        $orderByComp = 'company_name';    $orderByDept = 'department_name';   $orderByLoca = 'location_name';
        $fieldsToFetchComp = 'company_id,company_abn,company_name,company_phone,company_address'; 
        $fieldsToFetchDept = 'department_id,department_name,company_id';
	     $commondata['companies']=$this->common_model->fetchRecordsDynamically($table, $fieldsToFetchComp,$conditionsComp,$orderByComp);
		$commondata['departments']=$this->common_model->fetchRecordsDynamically($tabledepartment,$fieldsToFetchDept,'',$orderByDept);   
		$commondata['stores']=$this->common_model->fetchRecordsDynamically($tablelocations,'','',$orderByLoca);
		return $commondata;
	 }
	 
	 function customerList(){
	     $resultCommon = $this->commonrecord();
	     $data['companies'] = $resultCommon['companies'];
	     $data['departments'] = $resultCommon['departments'];
	     $data['stores'] = $resultCommon['stores'];
	     $tablecustomer = 'Catering_customer';
	     $conditionsCustomer = array('status' => 1);
	     $commondata['listCustomer']=$this->common_model->fetchRecordsDynamically($tablecustomer, '','','');
	     
	     
	   //  echo "<pre>"; print_r($data['listCustomer']); exit;
	   $this->load->view('general/header');
	     $this->load->view('customer/customerList',$data);
	     $this->load->view('general/footer');
	 }
	 
	 function companyList(){
	     $resultCommon = $this->commonrecord();
	    
	     $data['departments'] = $resultCommon['departments'];
	     $data['stores'] = $resultCommon['stores'];
	     $data['listCompanies']=$resultCommon['companies'];
	     
	   //  echo "<pre>"; print_r($data['listCustomer']); exit;
	     $this->load->view('general/header');
	     $this->load->view('customer/companyList',$data);
	     $this->load->view('general/footer');
	 }
	 
	 function departmentList(){
	 
	     $resultCommon = $this->commonrecord();
	     $data['companies'] = $resultCommon['companies'];
	     $data['listDepartments']=$this->customer_model->departmentList(); 
	     $this->load->view('general/header');
	     $this->load->view('customer/departmentList',$data);
	     $this->load->view('general/footer');
	 }
	 
	 function addNewCustomer() {
    $this->load->model('customer_model');
    // if customer already exist than update else insert
     $data = array(
        'firstname' => $this->input->post('firstname'),
        'lastname' => $this->input->post('lastname'),
        'email' => $this->input->post('email'),
        'telephone' => $this->input->post('phone'),
        'company_id' => $this->input->post('company_id'),
        'department' => $this->input->post('department_id'),
        'location_id' => $this->selected_location_id,
        'status' => 1,
        
    );
     if($this->input->post('customer_id') !=''){
      $data['date_modified'] = date('Y-m-d H:i:s');
      
      $whereC = array('customer_id' => $this->input->post('customer_id'),'email' => $this->input->post('email')); 
      $customer_idRes =$this->common_model->fetchRecordsDynamically('Catering_customer',['customer_id'],$whereC);
      if(!empty($customer_idRes)){
           
      $this->common_model->commonRecordUpdate('Catering_customer', 'customer_id',$this->input->post('customer_id'),$data); 
      echo json_encode(array('status' => 'success', 'message' => 'Customer updated successfully')); 
      }else{
      echo json_encode(array('status' => 'failed', 'message' => 'Customer with this email already exists'));    
      }
       
       
     }else{
    
     if ($this->customer_model->email_exists($data['email'])) {
        echo json_encode(array('status' => 'failed', 'message' => 'Customer with this email already exists'));
        return;
    } 
    $data['date_added'] = date('Y-m-d H:i:s');
    $this->common_model->commonRecordCreate('Catering_customer', $data);
    echo json_encode(array('status' => 'success', 'message' => 'Customer added successfully'));  
     }
    
     
     }

	function addNewCompany(){
	    $companyName = $_POST['company_name'];
	     $data = array(
                'company_name' => $companyName,
                'company_phone' => !empty($_POST['company_phone']) ? $_POST['company_phone'] : null,
                'company_abn' => !empty($_POST['abn']) ? $_POST['abn'] : null,
                'company_address' => !empty($_POST['company_address']) ? $_POST['company_address'] : null
            );
      if($this->input->post('company_id') !=''){
        
        $this->common_model->commonRecordUpdate('Catering_company','company_id',$this->input->post('company_id'), $data);  
        echo json_encode(array('status' => 'success', 'message' => 'Company updated successfully'));  
       }else{
       
         $conditions = array( 'company_name' => $companyName);
         $existingCompany  = $this->common_model->fetchRecordsDynamically('Catering_company', '',$conditions);  
       
         if(empty($existingCompany)){
         $company_id = $this->common_model->commonRecordCreate('Catering_company', $data);
         echo json_encode(array('status' => 'success', 'message' => 'Company added successfully'));  
         }else{
         echo json_encode(array('status' => 'failed', 'message' => 'This company name already exists'));      
         }
              
      }
        
        
	 }
	
	 function addNewDepartment(){
	     $departmentName = $_POST['department_name'];
	     $data = array(
                'company_id' => $_POST['company_id'],
                'department_name' => !empty($_POST['department_name']) ? $_POST['department_name'] : null,
            );
            
            if($this->input->post('department_id') !=''){
                // update record scenerio
                
                $this->common_model->commonRecordUpdate('Catering_department', 'department_id',$this->input->post('department_id'),$data);    
                 echo json_encode(array('status' => 'success', 'message' => 'Department updated successfully')); 
            }else{
              $conditions = array( 'department_name' => $departmentName,'company_id' => $_POST['company_id']);
              $existingDepartment  = $this->common_model->fetchRecordsDynamically('Catering_department','', $conditions);
              
            if(empty($existingDepartment)){
             $department_id = $this->common_model->commonRecordCreate('Catering_department', $data);
             echo json_encode(array('status' => 'success', 'message' => 'Department added successfully'));  
           }else{
           echo json_encode(array('status' => 'failed', 'message' => 'This department name already exists'));      
         }

            }
         
	 }
	 
     function fetchCompaniesAndDepartment(){
   
	$table = 'Catering_company'; 
	$tabledepartment = 'Catering_department'; 
    $conditions = array( 'status' => 1);
    $data['companies']  = $this->common_model->fetchRecordsDynamically($table,'', $conditions);
    $data['departments']  = $this->common_model->fetchRecordsDynamically($tabledepartment, '',$conditions);
    
    echo  json_encode($data);

	}

    

	
	
}
	
	?>