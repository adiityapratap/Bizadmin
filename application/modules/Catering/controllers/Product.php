<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('genric_model');
			$this->load->model('common_model');
      !$this->ion_auth->logged_in() ? redirect('auth/login') : '';
    
	}
	
	function addNewProduct(){
	    $data = $_POST;
	    $data['date_added'] = date('Y-m-d');
	     if($this->input->post('product_id') !=''){
	    $where = array('product_id' => $this->input->post('product_id')); 
        $this->common_model->commonRecordUpdate('Catering_product','product_id',$this->input->post('product_id'), $data); 
         echo 'success';
	    }else{
	    $productId = $this->common_model->commonRecordCreate('Catering_product',$data); 
	    echo $productId;
	    }
	}
	
	
	
	function productsList(){
	    $conditionsProd = array( 'status' => 1 );
	  	$data['listProducts']=$this->genric_model->fetchProductList(); 
	  	$data['listCategory']=$this->common_model->fetchRecordsDynamically('Catering_category',['category_id','category_name'],'','category_name');
	  	$this->load->view('general/header');
	  	 $this->load->view('productsList',$data);
	  	 $this->load->view('general/footer');
	}
	
	function addNewCategory(){
	    $data = $_POST;
	    
	   if($this->input->post('category_id') !=''){
	   
        $this->common_model->commonRecordUpdate('Catering_category','category_id', $this->input->post('category_id'),$data); 
         echo 'success';
	    }else{
	    $categoryId = $this->common_model->commonRecordCreate('Catering_category',$data); 
	    echo $categoryId;
	    }
	}
	
	function categoryList(){
	   
	  	$data['listCategory']=$this->common_model->fetchRecordsDynamically('Catering_category',['category_id','category_name'],'','category_name'); 
	  	$this->load->view('general/header');
	  	 $this->load->view('categoryList',$data);
	  	 $this->load->view('general/footer');
	} 
	
}
?>