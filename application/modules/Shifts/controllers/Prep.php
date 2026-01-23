<?php

class Prep extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
      	 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
   	     $this->load->model('general_model');
   	     $this->load->model('prep_model');
   	     $this->load->model('common_model');
        $this->load->model('site_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->selected_location_id = $this->session->userdata('location_id');
    }
   	public function index(){
			$conditions['is_deleted'] = 0;
 		    $data['prepLists'] = $this->common_model->fetchRecordsDynamically('Shifts_prep', ['id','name','status'], $conditions);
			$this->load->view('general/header');
            $this->load->view('prep/prepList',$data);
            $this->load->view('general/footer');
		}
	public function add(){
		
			if(isset($this->POST['prep_name'])){
			$data = array(
			'name' => $this->POST['prep_name'],
			'location_id' => $this->selected_location_id,
			);
			$result = $this->common_model->commonRecordCreate('Shifts_prep',$data);		
			
			echo "success";
			}
			
			
		}
	function change_status(){
		$data = array(
		'status' => $this->POST['status'],
		);
	  $result = $this->common_model->commonRecordUpdate('Shifts_prep','id',$this->POST['id'],$data);
		 
	}
    function updatePrep(){

	if(isset($this->POST['prep_name'])){
					$data = array(
						'name' => $this->POST['prep_name'],
					);
		  $result = $this->common_model->commonRecordUpdate('Shifts_prep','id',$this->POST['id'],$data);
		 }
	}
	public function delete(){
     $result = $this->common_model->commonRecordDelete('Shifts_prep',$this->POST['id'],'id');
		echo $res;
		}
   
   
    

}
