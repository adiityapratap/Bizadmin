<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		 $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	}
	
	 public function index($system_id='')
    { 
        (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
        $data['allFolders'] = $this->common_model->fetchAllFolders();
        $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);
      	$this->load->view('general/header');
      	$this->load->view('common/folderList',$data);
      	$this->load->view('general/footer');
     }
    
    public function uploadFolderDoc(){
       
    $config['upload_path'] = './uploaded_files/'.$this->tenantIdentifier.'/Dms/';
    $config['allowed_types'] = '*'; 
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 8048; 
    $config['file_name'] = $_FILES['file']['name'];

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
        }else{
            $filename = '';
        }
        $doc_data = array(
						'name' => $filename,
						'file_display_name'=> $_POST['docName'],
						'folder_id' => $_POST['folderId'],
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
      	$result = $this->common_model->add($doc_data,'DMS_documents');
      
       echo    $filename;
    }
    
    public function add(){
// 		ini_set('display_errors', 1);
			if(isset($this->POST['folder_name'])){
					$folder_data = array(
						'folder_name' => $this->POST['folder_name'],
						'role_ids' => ($this->POST['role_ids']),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
					
					$result = $this->common_model->add($folder_data,'DMS_folders');
			echo "success";
			}
			
			
		}
		
	public function edit($id=''){
// 		ini_set('display_errors', 1);
	
			if(isset($this->POST['site_name'])){
					$data = array(
						'folder_name' => $this->POST['folder_name'],
						'role_ids' => ($this->POST['role_ids']),
						'site_id' => (isset($this->POST['site_id']) ? $this->POST['site_id'] : ''),
						'updated_date' => date('Y-m-d'),
					);
		
				$result = $this->common_model->update($data,$id,'DMS_folders');	
				
			
			}
			
			
		}
		
		
	function change_status(){

		$this->common_model->change_status($this->POST,'DMS_folders');
	}
   function updateFolder(){
               
		$this->common_model->update($this->POST,$this->POST['id'],'DMS_folders');
	}
	
  public function updateSortOrder(){
	 
	 $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $equipID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $equipID);
        $this->tenantDb->update('DMS_folders');
    }
    echo "success";
	}  	
   
    public function delete(){
      $res = $this->common_model->deleteFolder($this->POST['id'],'DMS_folders');
		echo $res;
	}
    
	
}