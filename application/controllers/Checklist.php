<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('auth_model');
		!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
		$this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
// 	echo date_default_timezone_get(); exit;
	}
	
	public function saveToDoList(){
	    $listData['descr'] = $this->input->post('listDescr'); $listData['location_id'] = $this->session->userdata('location_id');
	    $listData['user_id'] = $this->session->userdata('user_id'); $listData['date'] = date('Y-m-d');
	   $insrtedChecklistid =$this->general_model->insertDataInOrzDb('Global_todoList',$listData); 
	}
	public function updateSortOrdersOfChecklist(){
	 
	 $newOrder = $this->input->post('order');
   
    // Update the database with the new sort order

    foreach ($newOrder as $index => $itemId) {
        $checklistID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $checklistID);
        $this->tenantDb->update('Global_checklist');
    }
    echo "success";
	}   
	
	public function checklist(){
	     // for creating checklist
	     (!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '');
		 $data['roles'] = get_all_roles($this->ion_auth,$this->session->userdata('location_id'));;	
	    
	 
	     
	     if (isset($_POST['submit']))
		{     
		 $this->form_validation->set_rules('schedule_at', 'Select Schedule', 'trim|required');
	     $this->form_validation->set_rules('title', ' task name', 'trim|required|min_length[2]');
	     $customValidation = TRUE;
	     if(empty($this->input->post('role_id'))){
	         $customValidation = FALSE;
	     }
	 
	     
	        
	          if ($this->form_validation->run() === TRUE && $customValidation == TRUE){
		       $dateRange = $this->validateChecklistDate($this->input->post('date_range'),$this->input->post('schedule_at'));
		       if($this->input->post('system_id') !=''){
		        $systemDetails =  fetchSystemDetailsFromSystem_id($this->input->post('system_id'));
		        $urlSystem = $systemDetails->slug."/".$systemDetails->system_details_id;
		       }else{
		           $urlSystem = '';
		       }
		       
		      //echo "<pre>"; print_r($this->input->post('subtask')); exit;
		    	$checklistData = [
				'temp' => $this->input->post('temp'),
				'system_id' => $this->input->post('system_id'),
				'urlSystem' => $urlSystem,
				'role_id' => serialize($this->input->post('role_id')),
				'schedule_at' => $this->input->post('schedule_at'),
				// 'is_temp_checked' => $this->input->post('checklist_temp'),
				'has_subtask' => (!empty($this->input->post('subtask')[0]) ? 1 : 0),
				'sort_order' => $this->input->post('sort_order'),
				'deadline_time' => (isset($_POST['deadline_time']) && $_POST['deadline_time'] !='' ? $_POST['deadline_time'] : NULL),
				'descr' => $this->input->post('description'),
				'title' => $this->input->post('title'),
				'location_id' => $this->session->userdata('location_id'),
				'created_at' => date('y-m-d'),
				'checklist_start_date' => (isset($dateRange['startDate']) ? $dateRange['startDate']: NULL),
				'checklist_end_date' => (isset($dateRange['endDate']) ? $dateRange['endDate'] : NULL),
			   ];
			   
		    $insrtedChecklistid =$this->general_model->insertDataInOrzDb('Global_checklist',$checklistData);
		    if(!empty($this->input->post('subtask')[0])){
		    foreach($this->input->post('subtask') as $indexNumber => $valSubChecklist){
		        $subChecklistData['descr'] = $valSubChecklist;
		        $subChecklistData['parent_checklistId'] = $insrtedChecklistid;
		        $subChecklistData['subchecklist_time'] =  (isset($this->input->post('subchecklist_time')[$indexNumber]) && $this->input->post('subchecklist_time')[$indexNumber] !='' ? $this->input->post('subchecklist_time')[$indexNumber] : NULL);
		      //  $subChecklistData['is_temp_checked'] = (isset($this->input->post('temp_rec')[$indexNumber]) ? $this->input->post('temp_rec')[$indexNumber] : '');
		      $this->general_model->insertDataInOrzDb('Global_subchecklist',$subChecklistData);  
		    }    
		    }

			$data['message'] = $this->session->set_flashdata('message', 'Checklist Added');
			redirect("checklist/checklistListing", $data);
	          }else{
	          
	        $data['message'] = (validation_errors()) ? validation_errors() : 'Please select the role this task should be assigned to';  
	        $allSystems = get_system_details_for_user($this->session->userdata('user_id'),$this->tenantDb,$this->db);
            $data['system_details'] = $allSystems;
	        $this->load->view('general/landingPageHeader');
    		$this->load->view('checklist/checklist',$data);
    		$this->load->view('general/landingPageFooter');
    		
    		
	              
	              
	          }
			
		}
		else
		{ 
	    $allSystems = get_system_details_for_user($this->session->userdata('user_id'),$this->tenantDb,$this->db);
        $data['system_details'] = $allSystems;
	        $this->load->view('general/landingPageHeader');
    		$this->load->view('checklist/checklist',$data);
    		$this->load->view('general/landingPageFooter');
		}
	}
	
	public function editChecklist($checklistId='')
	{    
	    (!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '');   
	    
	     $data['roles'] = get_all_roles($this->ion_auth,$this->session->userdata('location_id'));;	
	    
	   //  echo "<pre>"; print_r($data['roles']); exit;    
	     
	     if (isset($_POST['submit']))
		 {  
		 $this->form_validation->set_rules('schedule_at', 'Select Schedule', 'trim|required');
	     $this->form_validation->set_rules('title', 'Add Topic/Title', 'trim|required|min_length[2]');
	     $customValidation = TRUE;
	     if(empty($this->input->post('role_id'))){
	         $customValidation = FALSE;
	     }
		  
	       if ($this->form_validation->run() === TRUE && $customValidation == TRUE){
	           
		    $dateRange = $this->validateChecklistDate($this->input->post('date_range'),$this->input->post('schedule_at'));
		  //   echo "<pre>"; print_r($dateRange); exit;
		  // echo "<pre>"; print_r($this->input->post('subchecklist_time')); exit;
		    if(!empty($this->input->post('subtask')) &&  !empty($this->input->post('subtask')) ){
		    $has_subtask = 1;  
		    
		   $existingids = ($this->input->post('Allsubchecklist_id') !='' ? unserialize($this->input->post('Allsubchecklist_id')) : '');
		    $postedids = $this->input->post('subchecklist_id');
		    if(isset($existingids) && !empty($existingids)){
		        $subidstoBeDeleted = array_diff($existingids, $postedids);
		       
		      foreach($subidstoBeDeleted as $Idd){
		      $this->tenantDb->where('id', $Idd);
              $this->tenantDb->delete('Global_subchecklist');   
		      }      
		      }
		      
		    
		    $data = array();
		  
		    foreach($this->input->post('subtask') as $key=> $desc){
		        if($desc !=''){
		         if(is_array($postedids) && in_array($key,$postedids)){
		        $data['descr'] = $desc;
		           $data['subchecklist_time'] =  (isset($this->input->post('subchecklist_time')[$key]) && $this->input->post('subchecklist_time')[$key] !='' ? $this->input->post('subchecklist_time')[$key] : NULL);
                // $data['is_temp_checked'] = (isset($this->input->post('temp_rec')[$key]) ?  $this->input->post('temp_rec')[$key] : '');
            //   echo "<pre>"; print_r($data);exit;
                $this->tenantDb->where('id', $key);
                $this->tenantDb->update('Global_subchecklist', $data);
		        }else{
		           
		           $dataToInsert['descr'] =  $desc;
		           $dataToInsert['parent_checklistId'] =  $this->input->post('checklist_id');
		           $dataToInsert['subchecklist_time'] =  (isset($this->input->post('subchecklist_time')[$key]) && $this->input->post('subchecklist_time')[$key] !='' ? $this->input->post('subchecklist_time')[$key] : NULL);
		          // $dataToInsert['is_temp_checked'] =  (isset($this->input->post('temp_rec')[$key]) ? $this->input->post('temp_rec')[$key] : ''); 
		           
		          // echo "<pre>"; print_r($dataToInsert);exit;
		           $this->tenantDb->insert('Global_subchecklist', $dataToInsert);
		          // echo $lastQuery = $this->tenantDb->last_query();
		        }   
		        }
		        
		    }
		    
		    }else{
		      //  echo "LEO"; exit;
		      $has_subtask = 0;   
		      $existingids = ($this->input->post('Allsubchecklist_id') !='' ? unserialize($this->input->post('Allsubchecklist_id')) : '');
		      if(isset($existingids) && !empty($existingids)){
		      foreach($existingids as $Idd){
		      $this->tenantDb->where('id', $Idd);
              $this->tenantDb->delete('Global_subchecklist');   
		      }      
		      }
		      
		    }
		    
		   
		   

		    $checklistData = [
				'temp' => $this->input->post('temp'),
				'system_id' => $this->input->post('system_id'),
				// 'is_temp_checked' => $this->input->post('checklist_temp'),
				'role_id' => serialize($this->input->post('role_id')),
				'schedule_at' => $this->input->post('schedule_at'),
				'sort_order' => $this->input->post('sort_order'),
				
				'deadline_time' => (isset($_POST['deadline_time']) && $_POST['deadline_time'] !='' ? $_POST['deadline_time'] : NULL),
				'descr' => $this->input->post('description'),
				'title' => $this->input->post('title'),
				'has_subtask' => $has_subtask,
				'checklist_start_date' => (isset($dateRange['startDate']) ? $dateRange['startDate']: NULL),
				'checklist_end_date' => (isset($dateRange['endDate']) ? $dateRange['endDate'] : NULL),
			];
// 			echo "<pre>"; print_r($checklistData); exit;
             if($this->input->post('system_id') !=''){
		        $systemDetails =  fetchSystemDetailsFromSystem_id($this->input->post('system_id'));
		        $urlSystem = $systemDetails->slug."/".$systemDetails->system_details_id;
		        $checklistData['urlSystem'] =  $urlSystem;
		       }
			$checkListId = $this->input->post('checklist_id');
		    $res=$this->general_model->updateDataInOrzDb('Global_checklist','id',$checkListId,$checklistData);
		    
		    	redirect("checklist/checklistListing");
		    	
	       }else{
	         $data['message'] = (validation_errors()) ? validation_errors() : 'Please select the role this task should be assigned to';  
	        $data['checklistData']=$this->general_model->fetchAllRecordForThisUser('Global_checklist','id',$checklistId)[0]; 
	        $data['subchecklistData']=$this->general_model->fetchAllRecordForThisUser('Global_subchecklist','parent_checklistId',$checklistId);
	        $allSystems = get_system_details_for_user($this->session->userdata('user_id'),$this->tenantDb,$this->db);
            $data['system_details'] = $allSystems;
            $data['checklist_id'] = $checklistId;
	        $this->load->view('general/landingPageHeader');
    		$this->load->view('checklist/checklist',$data);
    		$this->load->view('general/landingPageFooter');

	       }	
		    	
		    	
		    	
		}else{ 
		    
	        $data['checklistData']=$this->general_model->fetchAllRecordForThisUser('Global_checklist','id',$checklistId)[0]; 
	        $data['subchecklistData']=$this->general_model->fetchAllRecordForThisUser('Global_subchecklist','parent_checklistId',$checklistId);
	        
	       
	         $allSystems = get_system_details_for_user($this->session->userdata('user_id'),$this->tenantDb,$this->db);
             $data['system_details'] = $allSystems;
             $data['checklist_id'] = $checklistId;
	        $this->load->view('general/landingPageHeader');
    		$this->load->view('checklist/checklist',$data);
    		$this->load->view('general/landingPageFooter');
		}
	     
	}
	
	public function deleteMultiple() {
        $table_name = $this->input->post('table_name');
        $selected_values = $this->input->post('selected_values');

        if (!empty($selected_values)) {
          $checklistData=$this->general_model->deleteMultiple($table_name,$selected_values);
            echo 'Success';
        } else {
            echo 'Error';
        }
    }
	public function checklistListing()
 	{     
 	    (!$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '');
	         $location_id = $this->session->userdata('location_id');
	        $fieldToRetrieve = 'id,sort_order,system_id,title,date,status,deadline_time,checklist_start_date,checklist_end_date,schedule_at,role_id';
	        $checklistData=$this->general_model->fetchAllRecordForThisUser('Global_checklist','location_id',$location_id,$fieldToRetrieve,'',true);
	       // fetchSystemNameFromId();
	       foreach ($checklistData as $key=> $checklist) {
             $sysName= fetchSystemNameFromId($checklist->system_id);
              $checklistData[$key]->systemName = $sysName;
              $checklistData[$key]->schedule_name = (isset(CHECKLISTSCHEDULE[$checklist->schedule_at]) ? CHECKLISTSCHEDULE[$checklist->schedule_at] : '');
                }
           $data['roles'] = get_all_roles($this->ion_auth,$this->session->userdata('location_id'));;
            
            $data['checklistData'] = $checklistData;
	        $this->load->view('general/landingPageHeader');
    		$this->load->view('checklist/checklistListing',$data);
    		$this->load->view('general/landingPageFooter');
	     
	}
	function validateChecklistDate($daterange='',$schedule_at=''){
	    $dateArray = array();
	     if($daterange !=''){
		    
		    $dateComponents = explode(" to ", $daterange);
		   
		    if(isset($dateComponents[0])){
		     $startDateTimestamp = strtotime($dateComponents[0]);
		    $startDate = date("Y-m-d", $startDateTimestamp);
		    }else{
		         $startDate = NULL;  
		    }
		    if(isset($dateComponents[1])){
		    $endDateTimestamp = strtotime($dateComponents[1]);
            $endDate = date("Y-m-d", $endDateTimestamp);     
		    }else{
		    $endDate = NULL;    
		    }
           
		    }else{
		    $startDate = NULL;   
		    $endDate = NULL;
		    }
		    // if user select anything except custom date range remove start and end date from db
		  //  if($schedule_at != 5){
		  //     $startDate = NULL;   
		  //    $endDate = NULL; 
		  //  }
		   $dateArray['startDate'] = $startDate;
		   $dateArray['endDate'] = $endDate;
		   return $dateArray;
	}
	
	function markChecklistCompleted(){
	  
	    if ($this->ion_auth->logged_in()) {
	   $checklistId = $this->input->post('checklistId');
	   $tableName = $this->input->post('tableName');
	   $checklistStatus = $this->input->post('checklistStatus');
	   $data =  array(
	       'is_completed'=> $checklistStatus
	       );
	    $this->general_model->updateDataInOrzDb($tableName,'id',$checklistId,$data);
	    echo "success";
	    }else{
	        echo "Please login to update checklist";
	    }
	}
	
	function updateCheckListForTodays(){
	  
	  if ($this->ion_auth->logged_in()) {
	   $checklistId = $this->input->post('checklistId');
	  
	   $checklistStatus = $this->input->post('checklistStatus');
	   $data =  array(
	       'is_completed'=> $checklistStatus,
	       );
	    $this->general_model->updateCheckListForTodays($checklistId,$data);
	    echo "success";
	    }else{
	        echo "Please login to update checklist";
	    }
	}
	
	



public function uploadChecklistAttachment()
{
    $orzName = $this->tenantIdentifier; 
    $config['upload_path'] = './uploaded_files/'.$orzName.'/Checklist/checklistAttachments/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; // Add allowed file types
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 8048; // Maximum file size in KB (2MB)

    $this->load->library('upload', $config);

    $uploaded_files = [];


      // Count total files
      $countfiles = count($_FILES['userfile']['name']);
 
      // Looping all files
      for($i=0;$i<$countfiles;$i++){
 
        if(!empty($_FILES['userfile']['name'][$i])){
 
          // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['userfile']['name'][$i];
          $_FILES['file']['type'] = $_FILES['userfile']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['userfile']['error'][$i];
          $_FILES['file']['size'] = $_FILES['userfile']['size'][$i];

          // Set preference
          $config['upload_path'] = './uploaded_files/'.$orzName.'/Checklist/checklistAttachments/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];
 
          //Load upload library
          $this->load->library('upload',$config); 
 
    
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
          
            // Initialize array
            $uploaded_files[$i] = $filename;
          }
        }
 
      }

 
    
    $data =  array(
	       'attachment'=> serialize($uploaded_files),
	       'checklistComments'=> (isset($_POST['checklistComments']) ? $_POST['checklistComments'] :'')
	       );
	    $this->general_model->updateCheckListForTodays($_POST['checklistId'],$data,TRUE);
    // Return a response with information about the uploaded files
    echo "Uploaded Files: " . implode(', ', $uploaded_files);
}

public function viewAttachments(){
    
    $data['roles'] = get_all_roles($this->ion_auth,$this->session->userdata('location_id'));;        
    $data['checklistHistoyData']  = $this->general_model->viewChecklistAttachments($checklistId,$data);
    $data['orzName']  = $this->tenantIdentifier; 
//  echo "<pre>"; print_r($data['checklistHistoyData']); exit;
            $this->load->view('general/landingPageHeader');
    		$this->load->view('checklist/checklistHistoricalData',$data);
    		$this->load->view('general/landingPageFooter');  
}

	
}
	?>