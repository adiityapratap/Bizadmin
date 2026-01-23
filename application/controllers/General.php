<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('auth_model');
	!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	}
	public function index(){
	    
	}
	// for fetching menus while creating or editing user
	public function fetchMenuFromHelper(){
	    $system_id = $this->input->post('system_id');
        $user_id = $this->input->post('user_id'); 
        if ($this->input->post('user_id') !== null || $this->input->post('role_id') !== null) {
            $menus = fetch_render_menu($system_id,$user_id,$this->input->post('role_id'));
        }else{
           $menus = fetch_render_menu($system_id); 
        }
	    
	   // echo "eee<pre>"; print_r($menus); exit;
	    echo json_encode($menus);
	}
	
	public function fetchMenuFromHelperForSettingPage(){
	    $system_id = $this->input->post('system_id');
        $user_id = $this->input->post('user_id'); 
        if ($this->input->post('user_id') !== null || $this->input->post('role_id') !== null) {
            $menus = fetch_render_menu_for_setting($system_id,$user_id,$this->input->post('role_id'));
        }else{
           $menus = fetch_render_menu_for_setting($system_id); 
        }
	    
	   // echo "eee<pre>"; print_r($menus); exit;
	    echo json_encode($menus);
	}
	
	
	
	function updateTableStatus(){
	  (!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '');
	   $id = $this->input->post('id');
	   $table_name = $this->input->post('table_name');
	   $data =  array(
	       'status'=> $this->input->post('status')
	       );
	    $this->general_model->updateDataInOrzDb($table_name,'id',$id,$data);
	    echo "success";
	}
	

	public function record_delete(){
	     (!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '');
	    $id = $_POST["id"];
    	$table_name = $_POST["table_name"];
    	
    	$postData = array(
    	    'is_deleted' => 1,
    	    'deleted_at' => date('Y-m-d'),
    	    );
    	 if($table_name =='Global_users'){
    	    $postData['active'] = 0;    
    	    }
    	$res=$this->general_model->update($table_name,$id,$postData,'id');
        if($res){
           echo "deleted";
        }else{
           echo "error";
        }
	}

}
?>