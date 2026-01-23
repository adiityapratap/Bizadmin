<?php

class Tills extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
   	     $this->load->model('tills_model');
       !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->selected_location_id = $this->session->userdata('location_id');
    }
   	public function index(){
			$data['till_detail'] = $this->tills_model->get_all_tills($this->selected_location_id);
			$this->load->view('general/header');
            $this->load->view('/tillsList',$data);
            $this->load->view('general/footer');
		}
	public function add(){
// 		ini_set('display_errors', 1);
			if(isset($this->POST['till_name'])){
					$till_data = array(
						'till_name' => $this->POST['till_name'],
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
					
					$result = $this->tills_model->add_till($till_data);
					echo $result;
			}
			else{
			    $data['form_type'] = 'add';
				$this->load->view('/till_add',$data);
			}
			
		}
	function change_status(){

		$this->tills_model->change_status($this->POST);
	}
   
    public function updateTill(){
        $result = $this->tills_model->update_till($this->POST);
		return $result;
		}
   
    public function delete(){
      $res = $this->tills_model->deleteTill($this->POST['id']);
		echo $res;
		}
   
   
    

}
?>
