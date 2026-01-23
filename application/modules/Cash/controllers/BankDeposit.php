<?php
class BankDeposit extends MY_Controller
{
    public function __construct() 
    {   
         parent::__construct();
        $this->load->model('bankdeposit_model');
        $this->load->model('common_model');
        $this->load->model('tills_model');
       !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->selected_location_id = $this->session->userdata('location_id');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
    }
   	public function index($tillId=''){
   	   
   	      ($tillId !='' ? $this->session->set_userdata('tillId', $tillId) : '');
   	     
			$coinBags= $this->bankdeposit_model->get_AllCoinBag($this->session->userdata('tillId'));
			$coinBagsData = array();
			 foreach($coinBags as $value){
			   $coinBagsData[$value['created_date']] = $value['regtotal1'];
			 }
			$data['coinBagsData'] = $coinBagsData;
		
			$thisMonthBankDepositData = $this->bankdeposit_model->get_bankDepositData(date('F'),$this->session->userdata('tillId', $tillId));
			$bankDepositrecordThisMonth = array();
			foreach($thisMonthBankDepositData as $value){
			   $bankDepositrecordThisMonth[$value['created_date']] = unserialize($value['bank_deposit_data']);
			}
		  // echo "<pre>"; print_r($bankDepositrecordThisMonth); exit;
		    $data['bankDepositData'] = $bankDepositrecordThisMonth;
			$this->load->view('general/header');
            $this->load->view('BankDeposit/bankDepositForm',$data);
            $this->load->view('general/footer');
		
		}
 
	public function update(){
		
 
	
				   $todaySDate = date('Y-m-d');
					$items_detail =  array(
							'managerBagCounted' => $this->POST['actualAmount_'.$todaySDate],
							'varianceValue' => $this->POST['varianceValue_'.$todaySDate],
							'actualAmount' => $this->POST['actualAmount_'.$todaySDate],
						);
					
					$items_detail = serialize($items_detail);

					$bankDepositData = array(
						'bank_deposit_data' => $items_detail,
						'till_id' => $this->session->userdata('tillId'),
						'depositYear' => date("Y"),
						'depositMonth' => date('F'),
						'created_date' => $todaySDate,
					);
                    // delete the existing record for same till on same date ,ii.e while updating
                    $this->bankdeposit_model->delete_bankDeposit($this->session->userdata('tillId'));
					$result = $this->bankdeposit_model->add_bankDeposit($bankDepositData);
					if($result){
					  return redirect()->to("BankDeposit");
					}
		
		
			
		}
	
	 public function fetchMonthlyBankReconcileData($monthName=''){
	    
	     return $bankReconcileData= $this->bankdeposit_model->fetchMonthlyBankReconcileData($monthName);
	    
	 }
	 
    function getAllDatesOfMonth($monthName, $year) {
  $dates = [];
  $monthNumber = date('m', strtotime("$monthName 1, $year"));

  $currentDate = strtotime("$year-$monthNumber-01");

  while (date('F', $currentDate) === $monthName) {
    $dayName = date('l', $currentDate);
    $dateFormatted = date('d-F-Y', $currentDate);
    $rand = rand(0,1234);
    $key = $dayName . '_' . $rand;
    $dates[$key] = $dateFormatted;
    $currentDate = strtotime('+1 day', $currentDate);
  }

  return $dates;
}



	public function archiveBankReconcile(){
	       
             $year = $this->POST['yearName'];
             $month = $this->POST['monthName'];
            $data['allDatesOfSelectedMonth'] = $this->getAllDatesOfMonth($month,$year);
	    	$coinBagsTillWise= $this->bankdeposit_model->get_TillWiseCoinBag();
	    
			$coinBagsTillWiseData = array();
			foreach($coinBagsTillWise as  $CValues){
			   $indexName = $CValues['till_id'].'_'.$CValues['created_date'];
			  $coinBagsTillWiseData[$indexName] =  $CValues;
			}
		
			 
				$data['coinBagsTillWise'] = $coinBagsTillWiseData;
				$data['till_detail'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
			   $fetchedarchiveBankReconcileData =  $this->bankdeposit_model->fetcharchiveBankReconcileData($this->POST['monthName'],$this->POST['yearName']);
			   
			 $data['bankReconcileData'] = (isset($fetchedarchiveBankReconcileData[0]) && !empty($fetchedarchiveBankReconcileData) ? unserialize($fetchedarchiveBankReconcileData[0]['item_details']) : array());              
			   $ListOfCompletedDatesOfThisMonth = $this->bankdeposit_model->fetchListOfCompletedDatesOfThisMonth(); 
			   if($ListOfCompletedDatesOfThisMonth){
			    $data['existingCompletedDates'] = unserialize($ListOfCompletedDatesOfThisMonth);   
			   }else{
			     $data['existingCompletedDates'] = array();
			   }
			   
			   $existingDatesBanked = $this->bankdeposit_model->fetchListOfDatesBankedForThisMonth(); 
			   if($existingDatesBanked){
			    $data['existingDatesBanked'] = unserialize($existingDatesBanked);   
			   }else{
			   $data['existingDatesBanked'] = array();
			   }
			   
		       $data['showAllrecords'] = true;
		    $this->load->view('general/header');  
            $this->load->view('BankDeposit/bankReconcileForm',$data);
             $this->load->view('general/footer');
	    
	}    
	public function reconcile(){
	    
      
	    	$coinBagsTillWise= $this->bankdeposit_model->get_TillWiseCoinBag();
	    	
			$coinBagsTillWiseData = array();
			if(!empty($coinBagsTillWise)){
			foreach($coinBagsTillWise as  $CValues){
			    $indexName = $CValues['till_id'].'_'.date('d-m-Y',strtotime($CValues['created_date']));
			  $coinBagsTillWiseData[$indexName] =  $CValues;
			  	
			}    
			}
			
		
				$data['coinBagsTillWise'] = $coinBagsTillWiseData;
				$data['till_detail'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
			   $ListOfCompletedDatesOfThisMonth = $this->bankdeposit_model->fetchListOfCompletedDatesOfThisMonth(); 
			   if($ListOfCompletedDatesOfThisMonth){
			    $data['existingCompletedDates'] = unserialize($ListOfCompletedDatesOfThisMonth);   
			   }else{
			     $data['existingCompletedDates'] = array();
			   }
			   
			   $existingDatesBanked = $this->bankdeposit_model->fetchListOfDatesBankedForThisMonth(); 
			   if($existingDatesBanked){
			    $data['existingDatesBanked'] = unserialize($existingDatesBanked);   
			   }else{
			     $data['existingDatesBanked'] = array();
			   }
			  
			   
			   $monthlyReconcileData = $this->fetchMonthlyBankReconcileData(date('F'));
			    
			  
			   if($monthlyReconcileData){
			     
			  $data['bankReconcileData'] = unserialize($monthlyReconcileData[0]['item_details']);  
			  
			   }else{
			      
			    $data['bankReconcileData'] = array();   
			   }
			    
			  
			   $data['showAllrecords'] = false;
			   $this->load->view('general/header');
            $this->load->view('BankDeposit/bankReconcileForm',$data);
             $this->load->view('general/footer');
	    
	}
	public function saveReconcileForm(){
		
                      $allTills = $this->tills_model->get_allActive_tills($this->selected_location_id);
				   $todaySDate = date('Y-m-d');
				   $items_detail = array();
				   foreach(ALLDATEOFTHISMONTH as $value){
				       $items_detail['amountReconcile_'.$value] = $this->POST['amountReconcile_'.$value];
				       $items_detail['amountBanked_'.$value] = $this->POST['amountBanked_'.$value];
				       $items_detail['dateBanked_'.$value] = $this->POST['dateBanked_'.$value];
				       foreach($allTills as $till){
				           $tillId = $till['id'];
				         $items_detail[$tillId.'_'.$value] = $this->POST[$tillId.'_'.$value];   
				       }
				      
				   }
		
					$items_detail = serialize($items_detail);
					$bankReconcileData = array(
						'item_details' => $items_detail,
					);
				
					// check if data for this month and year exist than update the current table row else insert new record
					$count = $this->bankdeposit_model->countBankReconcile();
				
                   if($count > 0){
                     $bankReconcileData['updated_date']  = $todaySDate;
                  	$result = $this->bankdeposit_model->update_bankReconcile($bankReconcileData);     
                   }else{
                     $bankReconcileData['created_date']  = $todaySDate;
                     $bankReconcileData['year']  = date("Y");
                     $bankReconcileData['month']  = date('F');
                    
                  	$result = $this->bankdeposit_model->add_bankReconcile($bankReconcileData);     
                   }
				
					if($result){
					  return redirect()->to("/reconcile");
					}
		
		
			
		}
// 	 public function uploadBankReceipt()
//     {
//     $config['upload_path'] = './uploaded_files/BankReceipt/';
//     $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; // Add allowed file types
//     $config['encrypt_name'] = TRUE;
//     $config['max_size'] = 8048; // Maximum file size in KB (2MB)

//     $this->load->library('upload', $config);

//     $uploaded_files = [];


//       // Count total files
//       $countfiles = count($_FILES['userfile']['name']);
 
//       // Looping all files
//       for($i=0;$i<$countfiles;$i++){
 
//         if(!empty($_FILES['userfile']['name'][$i])){
 
//           // Define new $_FILES array - $_FILES['file']
//           $_FILES['file']['name'] = $_FILES['userfile']['name'][$i];
//           $_FILES['file']['type'] = $_FILES['userfile']['type'][$i];
//           $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
//           $_FILES['file']['error'] = $_FILES['userfile']['error'][$i];
//           $_FILES['file']['size'] = $_FILES['userfile']['size'][$i];

//           // Set preference
//           $config['upload_path'] = './uploaded_files/BankReceipt/';
//           $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
//           $config['max_size'] = '5000'; // max_size in kb
//           $config['file_name'] = $_FILES['files']['name'][$i];
 
//           //Load upload library
//           $this->load->library('upload',$config); 
 
    
//           if($this->upload->do_upload('file')){
//             // Get data about the file
//             $uploadData = $this->upload->data();
//             $filename = $uploadData['file_name'];
          
//             // Initialize array
//             $uploaded_files[$i] = $filename;
//           }
//         }
 
//       }

 
    
    
// 	    $result =  $this->bankdeposit_model->addBankReceiptOfThisDate($uploaded_files);
//     // Return a response with information about the uploaded files
//     echo "Uploaded Files: " . implode(', ', $uploaded_files);
// }

  public function uploadBankReceipt()
    {
    $config['upload_path'] = APPPATH . 'modules/Cash/assets/BankReceipt/';
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
        //   $config['upload_path'] = './uploaded_files/TemperatureAttachments/';
          $config['upload_path'] = APPPATH . 'modules/Cash/assets/BankReceipt/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['userfile']['name'][$i];
  
          //Load upload library
          $this->load->library('upload',$config); 
 
    
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
          
            // Initialize array
            $uploaded_files[$i] = $filename;
          }else{
              echo $this->upload->data('full_path');
               echo 'File upload failed: ' . $this->upload->display_errors();
          }
        }
 
      }

 
    
	 $this->bankdeposit_model->addBankReceiptOfThisDate($uploaded_files);
    // Return a response with information about the uploaded files
    echo "Uploaded Files: " . implode(', ', $uploaded_files);
}

  public function fetchBankReceipt()
    { 
      $date = $this->input->post('date');
      $file_name =  $this->bankdeposit_model->fetchBankReceipt($date);
    //   for now just show one image uploadeed we can check later how to show multiple, altough multiple files can be uploaded now
  $uploadedFile =   unserialize($file_name);
  $fileName = (isset($uploadedFile[0]) ? $uploadedFile[0] : '');
      if ($fileName !='') {
         
           $imageUrl = base_url('application/modules/Cash/assets/BankReceipt/' . $fileName);
           echo $imageUrl;
         
        exit;
        }

       echo "failed"; exit;
      
    }
   		
	public function markSelectedDateAsCompleted(){
    //   echo "<pre>"; print_r($_POST); exit;
    
    
//     $dateTo = $_POST['dateTo'];
// $dateToFormatted = date('d-m-Y', strtotime($dateTo));
// $newKey = 'bankCountedTotalManulEntry_' . date('d-m-Y');
// $_POST[$newKey] = $_POST["bankCountedTotalManulEntry_$dateToFormatted"];
// $_POST["bankCountedTotalManulEntry_$dateToFormatted"] = '';

       $Data = serialize($_POST);
       $bankReconcileData = array();
     $CurrentcompletedDates = get_all_datesBetween($_POST['dateFrom'],$_POST['dateTo']);
	
    //  echo "<pre>"; print_r($CurrentcompletedDates); exit;
     $existingRecords = $this->bankdeposit_model->fetchListOfCompletedDatesOfThisMonth(); 
     $existingDatesBanked = $this->bankdeposit_model->fetchListOfDatesBankedForThisMonth();
          if(isset($_POST['isFinalSave']) && $_POST['isFinalSave'] == 'yes'){
			   if($existingRecords){
			    $existingCompletedDates = unserialize($existingRecords);  
			    $AllCompletedDatesSoFar = array_merge($existingCompletedDates, $CurrentcompletedDates); 
			    $bankReconcileData['completedRecordDates'] = serialize($AllCompletedDatesSoFar);
			   }else{
			      $bankReconcileData['completedRecordDates'] = serialize($CurrentcompletedDates); 
			   }
          }
			 if(isset($_POST['isFinalSave']) && $_POST['isFinalSave'] == 'yes'){
			 //if($existingDatesBanked){
			 //   $existingDatesBankedDates = unserialize($existingDatesBanked);  
			 //   array_push($existingDatesBankedDates, date('Y-m-d')); 
			 //   $bankReconcileData['datesBanked'] = serialize($existingDatesBankedDates);
			 //  }else{
			 //     $bankReconcileData['datesBanked'] = serialize([date('Y-m-d')]); 
			 //  }     
			 }
			   
			 //  echo "<pre>"; print_r($bankReconcileData); exit;
    
     $bankReconcileData['item_details'] = $Data;
	 $bankReconcileData['created_date'] = date('Y-m-d');
	 $bankReconcileData['location_id'] = $this->selected_location_id;
	 $bankReconcileData['status']  = 1;
	 $bankReconcileData['year']  = date("Y");
     $bankReconcileData['month']  = date('F');
     
	 
	 
      $result = $this->bankdeposit_model->add_bankReconcile($bankReconcileData);
      echo "success";
	}	
    
   
   
    

}
?>