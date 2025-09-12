<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploaddocs extends MY_Controller {
    function __construct() {
		parent::__construct();
		 !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		  $this->load->model('common_model');
		 $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
	    $this->selected_location_id = $this->session->userdata('location_id');
	}
	
 
     
    function docsList($subFolderId,$folderId){
     $data['allDocsOfThisFolders'] = $this->common_model->fetchAllDocsOfThisFolders($folderId,$subFolderId); 
     $data['file_path'] = base_url('/uploaded_files/'.$this->tenantIdentifier.'/Dms/');
     $data['folderId'] = $folderId;
     $data['subFolderId'] = $subFolderId;
     $this->load->view('general/header');
     $this->load->view('common/uploadDocs',$data);
     $this->load->view('general/footer');
        
    } 
    
    public function uploadSubFolderDoc(){
       
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
						'subfolder_id' => $_POST['subFolderId'],
						'status'=> 1,
						'location_id' => $this->session->userdata('location_id'),
						'created_date' => date('Y-m-d'),
					);
      	$result = $this->common_model->add($doc_data,'DMS_documents');
      
       echo    $filename;
    }
    
    public function delete(){
       
      $res = $this->common_model->deleteFolder($this->POST['id'],'DMS_documents');
		echo $res;
		}
  
    
}