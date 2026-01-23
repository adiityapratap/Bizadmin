<?php

class Document extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
      	 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
   	     $this->load->model('general_model');
   	     $this->load->model('roster_model');
   	     $this->load->model('common_model');
        // $this->load->model('site_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->selected_location_id = $this->session->userdata('location_id');
    }
   	public function index(){
			
			$conditions = array('location_id' => $this->selected_location_id, 'is_deleted' => '0','status' => '1');
   	        $data['documentLists'] = $this->common_model->fetchRecordsDynamically('HR_document','',$conditions);
		    $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);	
			$this->load->view('general/header');
            $this->load->view('document/documentList',$data);
            $this->load->view('general/footer');
		}
	public function add(){
		
		$data = $_POST;
		$data['created_at'] = date('Y-m-d'); $data['location_id'] = $this->selected_location_id;
	    $this->common_model->commonRecordCreate('HR_document',$data);	
		echo "success"; exit;	
		}
		
	
		public function edit($id=''){
		ini_set('display_errors', 1);
	
			if(isset($this->POST['doc_name'])){
					$data = array(
						'doc_name' => $this->POST['doc_name'],
						'role_id' => (isset($this->POST['role_id']) ? $this->POST['role_id'] : ''),
						'date_modified' => date('Y-m-d'),
					);
			$this->common_model->commonRecordUpdate('HR_document','id',$id,$data);

			}
		}
		
		
	function change_status(){

		$this->prep_model->change_status($this->POST);
	}
   function updatePrep(){
    //   echo "<pre>"; print_r($this->POST); exit;
      $this->common_model->commonRecordUpdate('HR_document','id',$this->POST['id'],$this->POST);
// 		$this->prep_model->updatePrep($this->POST,$this->POST['id']);
	}
	
   
   
   
    public function delete(){
       $data['is_deleted'] = 1; 
      $this->common_model->commonRecordUpdate('HR_document','id',$_POST['id'],$data);
		echo $res;
		}
   
   
    

}
