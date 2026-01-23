<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('organization_model');
		$this->load->model('general_model');
		!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	}
	public function index(){
	    if($this->session->userdata('IsUserLogged')){
	        
	        $res=$this->general_model->fetchAllRecord('organization_list');
	        $data['record'] = $res;
	        $data['controller_add'] = 'organization/add'; 
	        $data['controller_edit'] = 'organization/edit'; 
	        $data['controller_view'] = 'organization/view'; 
	        $data['controller_view_DB'] = 'organization/View_orz_db_details'; 
	        $data['page_title'] = 'Organization List';
	        $data['table_name'] = 'organization_list';
	        $data['table_columns'][] = array(
	                'column_title' =>'Organization Name',
	                'column_name' =>'orz_name',
	                'sort' => '1',
	            );
            $data['table_columns'][] = array(
                    'column_title' =>'Email',
                    'column_name' =>'orz_email',
                    'sort' => '1',
                );
            $data['table_columns'][] = array(
                    'column_title' =>'Phone',
                    'column_name' =>'orz_phone',
                    'sort' => '0',
                );
            $data['table_columns'][] = array(
                    'column_title' =>'Status',
                    'column_name' =>'organization_list_status',
                    'sort' => '1',
                ); 
            
	        $data['table_action'] = array('view','edit','delete');
	        
	        $this->load->view('general/header');
    		$this->load->view('general/listing',$data);
    		$this->load->view('general/footer');
		
	    }else{
	        redirect('auth');
	    }
	    
		
	}
	public function add(){ 
	    if($this->session->userdata('IsUserLogged')){
	        if($_POST){
	            $filename = ''; 
	            if(!empty($_FILES['orz_logo']['name'])){
    
                  $_FILES['file']['name'] = $_FILES['orz_logo']['name'];
                  $_FILES['file']['type'] = $_FILES['orz_logo']['type'];
                  $_FILES['file']['tmp_name'] = $_FILES['orz_logo']['tmp_name'];
                  $_FILES['file']['error'] = $_FILES['orz_logo']['error'];
                  $_FILES['file']['size'] = $_FILES['orz_logo']['size'];
          
                  $config['upload_path'] = './uploaded_files/organization_logos';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['max_size'] = '5000';
                  $config['file_name'] = $_FILES['orz_logo']['name'];
           
                  $this->load->library('upload',$config); 
            
                  if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                   
                  }else{
                     
                  }
                }
	           $postData= array(
	               'orz_name' => $_POST['orz_name'],
	               'orz_email' => $_POST['orz_email'],
	               'orz_phone' => $_POST['orz_phone'],
	               'orz_address' => $_POST['orz_address'],
	               'orz_password' => sha1($_POST['orz_password']),
	               'orz_logo' => $filename,
	               'organization_list_status' => $_POST['organization_list_status'],
	               'system_ids' => Serialize($_POST['system_ids']),
	               'date_added' => date('Y-m-d'),
	               );
	           $res=$this->general_model->add('organization_list',$postData);
	           if($res){
	               $this->session->set_userdata('sucess_msg','Record added successfully');
	           }else{
	               $this->session->set_userdata('error_msg','Failed to add record');
	           }
	           redirect('organization');
	        }else{
	            $res=$this->general_model->fetchRecord('system_details');
	            $data['system_details'] = $res;
	            $data['form_type'] = 'add';
    	        $this->load->view('general/header');
        		$this->load->view('organization/add',$data);
        		$this->load->view('general/footer');
	        }
	        
		
	    }else{
	        redirect('auth');
	    }	
	}
	public function edit($id=''){ 
	    if($this->session->userdata('IsUserLogged')){
	        if($_POST){
	            $id = $_POST['id'];
	           
	           $postData= array(
	               'orz_name' => $_POST['orz_name'],
	               'orz_email' => $_POST['orz_email'],
	               'orz_phone' => $_POST['orz_phone'],
	               'orz_address' => $_POST['orz_address'],
	               'organization_list_status' => $_POST['organization_list_status'],
	               'system_ids' => Serialize($_POST['system_ids']),
	               'date_updated' => date('Y-m-d'),
	               );
	               if($_POST['orz_password'] != ''){
	                  $postData['orz_password'] = sha1($_POST['orz_password']);
	               }
	               if(!empty($_FILES['orz_logo']['name'])){
    
                  $_FILES['file']['name'] = $_FILES['orz_logo']['name'];
                  $_FILES['file']['type'] = $_FILES['orz_logo']['type'];
                  $_FILES['file']['tmp_name'] = $_FILES['orz_logo']['tmp_name'];
                  $_FILES['file']['error'] = $_FILES['orz_logo']['error'];
                  $_FILES['file']['size'] = $_FILES['orz_logo']['size'];
          
                  $config['upload_path'] = './uploaded_files/organization_logos';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['max_size'] = '5000';
                  $config['file_name'] = $_FILES['orz_logo']['name'];
           
                  $this->load->library('upload',$config); 
            
                  if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                   $postData['orz_logo'] = $filename;
                  }
                }
                
	           $res=$this->general_model->update('organization_list',$id,$postData);
	           if($res){
	               $this->session->set_flashdata('sucess_msg','Record updated successfully');
	           }else{
	               $this->session->set_flashdata('error_msg','Failed to update record');
	           }
	           redirect('organization');
	        }else{
	            $res=$this->general_model->fetchAllRecord('organization_list',$id);
	            $data['record'] = $res;
	            $system_details=$this->general_model->fetchRecord('system_details');
	            $data['system_details'] = $system_details;
	            $data['form_type'] = 'edit';
    	        $this->load->view('general/header');
        		$this->load->view('organization/add',$data);
        		$this->load->view('general/footer');
	        }
	        
		
	    }else{
	        redirect('auth');
	    }
	  	
	}
	public function view($id){ 
	    if($this->session->userdata('IsUserLogged')){
	        
            $res=$this->general_model->fetchAllRecord('organization_list',$id);
            $data['record'] = $res;
            $system_details=$this->general_model->fetchRecord('system_details');
	        $data['system_details'] = $system_details;
            $data['form_type'] = 'view';
            $this->load->view('general/header');
    		$this->load->view('organization/add',$data);
    		$this->load->view('general/footer');
	       
		
	    }else{
	        redirect('auth');
	    }
	  	
	}
	
	public function system_listing(){
	    if($this->session->userdata('IsUserLogged')){
	        
	        $res=$this->general_model->fetchRecord('system_details');
	        $data['record'] = $res;
	        $data['controller_add'] = 'organization/add_system'; 
	        $data['controller_edit'] = 'organization/edit_system'; 
	        $data['controller_view'] = 'organization/view_system'; 
	        $data['page_title'] = 'System Details';
	        $data['table_name'] = 'system_details';
	        $data['table_columns'][] = array(
	                'column_title' =>'System Name',
	                'column_name' =>'system_name',
	                'sort' => '1',
	            ); 
            
	        $data['table_action'] = array('view','edit','delete');
	        
	        $this->load->view('general/header');
    		$this->load->view('general/listing',$data);
    		$this->load->view('general/footer');
		
	    }else{
	        redirect('auth');
	    }
	    
		
	}
	public function add_system(){ 
	    if($this->session->userdata('IsUserLogged')){
	        if($_POST){
	           $postData= array(
	               'system_name' => $_POST['system_name'],
	               'system_details_status' => '1',
	               'date_added' => date('Y-m-d'),
	               );
	           $res=$this->general_model->add('system_details',$postData);
	           if($res){
	               $this->session->set_userdata('sucess_msg','Record added successfully');
	           }else{
	               $this->session->set_userdata('error_msg','Failed to add record');
	           }
	           redirect('organization/system_listing');
	        }else{
	            $data['form_type'] = 'add';
    	        $this->load->view('general/header');
        		$this->load->view('organization/add_system_details',$data);
        		$this->load->view('general/footer');
	        }
	        
		
	    }else{
	        redirect('auth');
	    }	
	}
	public function edit_system($id=''){ 
	    if($this->session->userdata('IsUserLogged')){
	        if($_POST){
	            $id = $_POST['id'];
	           $postData= array(
	               'system_name' => $_POST['system_name'],
	               'date_updated' => date('Y-m-d'),
	               );
	           $res=$this->general_model->update('system_details',$id,$postData);
	           if($res){
	               $this->session->set_flashdata('sucess_msg','Record updated successfully');
	           }else{
	               $this->session->set_flashdata('error_msg','Failed to update record');
	           }
	           redirect('organization/system_listing');
	        }else{
	            $res=$this->general_model->fetchRecord('system_details',$id);
	            $data['record'] = $res;
	            $data['form_type'] = 'edit';
    	        $this->load->view('general/header');
        		$this->load->view('organization/add_system_details',$data);
        		$this->load->view('general/footer');
	        }
	        
		
	    }else{
	        redirect('auth');
	    }
	  	
	}
	public function view_system($id){ 
	    if($this->session->userdata('IsUserLogged')){
	        
            $res=$this->general_model->fetchRecord('system_details',$id);
            $data['record'] = $res;
            $data['form_type'] = 'view';
            $this->load->view('general/header');
    		$this->load->view('organization/add_system_details',$data);
    		$this->load->view('general/footer');
	       
		
	    }else{
	        redirect('auth');
	    }
	  	
	}
	
// 	not used
	public function orz_db_details(){
	    if($this->session->userdata('IsUserLogged')){
	        
	        $res=$this->organization_model->fetchDbDetails();
	        $data['record'] = $res;
	        $data['controller_add'] = 'organization/add_orz_db_details'; 
	        $data['controller_edit'] = 'organization/edit_orz_db_details'; 
	        $data['controller_view'] = 'organization/view_orz_db_details'; 
	        $data['page_title'] = 'Organization DB Details';
	        $data['table_name'] = 'orz_db_details';
	        $data['table_columns'][] = array(
	                'column_title' =>'Database Name',
	                'column_name' =>'db_name',
	                'sort' => '1',
	            ); 
	       $data['table_columns'][] = array(
	                'column_title' =>'Organization Name',
	                'column_name' =>'orz_name',
	                'sort' => '1',
	            ); 
            
	        $data['table_action'] = array('view','edit','delete');
	        
	        $this->load->view('general/header');
    		$this->load->view('general/listing',$data);
    		$this->load->view('general/footer');
		
	    }else{
	        redirect('auth');
	    }
	    
		
	}
	//not used 
	public function add_orz_db_details(){ 
	    if($this->session->userdata('IsUserLogged')){
	        if($_POST){
	           $postData= array(
	               'db_username' => $_POST['db_username'],
	               'db_name' => $_POST['db_name'],
	               'db_pass' => $_POST['db_pass'],
	               'db_host' => $_POST['db_host'],
	               'db_port' => $_POST['db_port'],
	               'orz_id' => $_POST['orz_id'],
	               'orz_db_details_status' => '1',
	               'date_added' => date('Y-m-d'),
	               );
	           $res=$this->general_model->add('orz_db_details',$postData);
	           if($res){
	               $this->session->set_userdata('sucess_msg','Record added successfully');
	           }else{
	               $this->session->set_userdata('error_msg','Failed to add record');
	           }
	           redirect('organization/orz_db_details');
	        }else{
	            $res=$this->general_model->fetchAllRecord('organization_list');
	            $data['organization_list'] = $res;
	            
	            $data['form_type'] = 'add';
    	        $this->load->view('general/header');
        		$this->load->view('organization/add_orz_db_details',$data);
        		$this->load->view('general/footer');
	        }
	        
		
	    }else{
	        redirect('auth');
	    }	
	}
		public function View_orz_db_details($id=''){ 
	    if($this->session->userdata('IsUserLogged')){
	        
            $res=$this->organization_model->fetchDbDetails($id);
            $data['record'] = $res;
            $res=$this->general_model->fetchAllRecord('organization_list');
            $data['organization_list'] = $res;
            $data['form_type'] = 'View';
	        $this->load->view('general/header');
    		$this->load->view('organization/add_orz_db_details',$data);
    		$this->load->view('general/footer');
	        
	    }else{
	        redirect('auth');
	    }
	  	
	}
}
?>