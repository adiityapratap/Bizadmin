<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subfolder extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		 $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	   $this->selected_location_id = $this->session->userdata('location_id');
	}
	
// 	 public function index($system_id='')
//     {   
//         (isset($system_id) && $system_id !='' ? $this->session->set_userdata('system_id',$system_id) : '');
//             $data['allSubFolders'] = $this->common_model->fetchAllSubFolders();
//             $data['allFolders'] = $this->common_model->fetchAllFolders();
//             $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);
//       	$this->load->view('general/header');
//       	$this->load->view('common/subfolderList',$data);
//       	$this->load->view('general/footer');
  
    	
        
//     }
    
    function subfolderList($folderId=''){
       $data['allSubFolders'] = $this->common_model->fetchAllSubFolders($folderId);
       $data['file_path'] = base_url('/uploaded_files/'.$this->tenantIdentifier.'/Dms/');
       $data['allFolders'] = $this->common_model->fetchAllFolders();
       $data['allDocsOfThisFolders'] = $this->common_model->fetchAllDocsOfThisFolders($folderId);
       $data['folderId'] = $folderId;
       $data['roles'] = get_all_roles($this->ion_auth,$this->selected_location_id);
       	$this->load->view('general/header');
      	$this->load->view('common/subfolderList',$data);
      	$this->load->view('general/footer');
    }
    
    public function add(){
// 		ini_set('display_errors', 1);
			if(isset($this->POST['subfolder_name'])){
					$site_data = array(
						'subfolder_name' => $this->POST['subfolder_name'],
						'folder_id' => $this->POST['folder_id'],
						'role_ids' => ($this->POST['role_ids']),
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
					
					$result = $this->common_model->add($site_data,'DMS_sub_folders');
			echo "success";
			}
			
			
		}
		
	public function edit($id=''){
// 		ini_set('display_errors', 1);
	
			if(isset($this->POST['site_name'])){
					$data = array(
						'subfolder_name' => $this->POST['subfolder_name'],
						'role_ids' => ($this->POST['role_ids']),
						'site_id' => (isset($this->POST['site_id']) ? $this->POST['site_id'] : ''),
						'updated_date' => date('Y-m-d'),
					);
		
				$result = $this->common_model->update($data,$id,'DMS_sub_folders');	
				
			
			}
			
			
		}
		
		
	function change_status(){

		$this->common_model->change_status($this->POST,'DMS_sub_folders');
	}
   function updateFolder(){

		$this->common_model->update($this->POST,$this->POST['id'],'DMS_sub_folders');
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
        
      $res = $this->common_model->deleteFolder($this->POST['id'],$this->POST['tableName']);
		echo $res;
		}
    
	
}