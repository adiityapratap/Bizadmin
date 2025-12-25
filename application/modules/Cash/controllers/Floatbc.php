<?php

class Floatbc extends MY_Controller
{
    public function __construct() 
    {   
        	parent::__construct();
        $this->load->model('float_model');
        $this->load->model('common_model');
        $this->load->model('config_model');
       !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->load->model('tills_model');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->tenantIdentifier = $this->session->userdata('tenantIdentifier');
        $this->selected_location_id = $this->session->userdata('location_id');
      
    }
    
    // float front office  builds 
    function frontOfficeBuild(){
       if(isset($this->POST['manager_name'])){
                 $float_Builddata = array( 
						'otherDetails' => serialize($this->POST),
						'status'=>1,
						'orderStatus'=>'New',
						'amountInCashTotal'=> (isset($this->POST['amountInCashTotal']) ? $this->POST['amountInCashTotal'] : ''),
						'created_date' => date('Y-m-d'),
						'location_id' => $this->session->userdata('location_id'),
					);
				// 		echo "<pre>"; print_r($float_Builddata); exit;
		$insertedID = $this->float_model->addFloatBuild($float_Builddata);
	
		if($insertedID){
		return redirect(base_url('/Cash/frontOfficeBuild'));    
		}
         }else{
        $data['disabled'] = '';
        $this->load->view('general/header');
        $this->load->view('Float/AddFrontOfficeBuild',$data);
        $this->load->view('general/footer');
         }
    }
    function frontOfficeBuildUpdate($id){
    
                 $float_Builddata = array( 
						'otherDetails' => serialize($this->POST),
						'amountInCashTotal'=> (isset($this->POST['amountInCashTotal']) ? $this->POST['amountInCashTotal'] : ''),
						'updated_date' => date('Y-m-d'),
					);
		$result = $this->float_model->frontOfficeBuildUpdate($float_Builddata,$id);
        if($result){
		return redirect(base_url('/Cash/frontOfficeBuild'));    
		}
    }
    public function ListfrontOfficeBuild(){
   	    
			$data['frontOfficeBuildList'] = $this->float_model->get_all_frontOfficeBuild();
			$this->load->view('general/header');
            $this->load->view('Float/frontOfficeBuildList',$data);
            $this->load->view('general/footer');
		
		}
    function ViewEditfrontOfficeBuild($id,$actionType='view'){
        
      	$data['frontOfficeBuildData'] = $this->float_model->getFrontOfficeBuildByID($id); 
        $data['edit'] = ($actionType == 'edit' ? 'edit' : '');
		$data['disabled'] = ($actionType == 'view' ? 'disabled' : '');
		$data['frontOfficeBuildId'] = $id;
		$this->load->view('general/header');
        $this->load->view('Float/AddFrontOfficeBuild',$data);
       
        $this->load->view('general/footer');
         
    }
    public function DeletefrontOfficeBuild(){
       
      $res = $this->float_model->DeletefrontOfficeBuild($this->POST['id']);
		echo $res;
		}
 public function sendBankOrderMailToBank() {
        $this->load->library('email');
        
        $emailTo = $this->input->post('bankEmail');
        $bankName = $this->input->post('bankName');
        $orderNumber = $this->input->post('orderNumber');
        
        // Encrypt the orderNumber
        $paramsToEncrypt = $this->tenantIdentifier . '|' . $orderNumber;
     $encryptedParams = $this->encryption->encrypt($paramsToEncrypt);
     $encodedParams = urlencode(urlencode(urlencode($encryptedParams)));
        
     
        $data['orderUrl'] = base_url().'External/viewBankOrder/'.$encodedParams;
        $message = $this->load->view('Mail/bankOrder', $data, true);

        $this->email->from('bh@cjsgroup.net.au', 'Cjs Cafe');
        $this->email->reply_to('bh@cjsgroup.net.au', 'Cjs Cafe');
        $this->email->to($emailTo);
        $this->email->subject('Bank Order');
        $this->email->message($message);

        if ($this->email->send()) {
            $float_Builddata = array(
                'isBankmailSent' => 'yes',
                'updated_date' => date('Y-m-d'),
            );
            $this->float_model->officeBuildUpdate($float_Builddata, $orderNumber);

            echo 'Email sent successfully.';
        } else {
            echo 'Error sending email: ' . $this->email->print_debugger();
        }
    }
		
     // float  office  builds =============================================================================
     
    function officeBuild(){
       if(isset($this->POST['manager_name'])){
                 $float_Builddata = array( 
						'otherDetails' => serialize($this->POST),
						'status'=>1,
						'orderStatus'=>'New',
						'amountInCashTotal'=> (isset($this->POST['amountInCashTotal']) ? $this->POST['amountInCashTotal'] : ''),
						'created_date' => date('Y-m-d'),
						'location_id' => $this->session->userdata('location_id'),
					);
	
		$insertedID = $this->float_model->addOfficeBuild($float_Builddata);
		if($insertedID){
		 $data['officeBuildId'] = $insertedID;
		return redirect(base_url('/Cash/officeBuildAction/'.$insertedID));     
       
		}
         }else{
             $data['disabled'] = '';
         $this->load->view('general/header');    
         $this->load->view('Float/AddOfficeBuild',$data);
          $this->load->view('general/footer'); 
         }
    }
    function officeBuildUpdate($id){
    
                 $float_Builddata = array( 
						'otherDetails' => serialize($this->POST),
						'status'=>1,
						'amountInCashTotal'=> (isset($this->POST['amountInCashTotal']) ? $this->POST['amountInCashTotal'] : ''),
						'updated_date' => date('Y-m-d'),
					);
		$result = $this->float_model->officeBuildUpdate($float_Builddata,$id);
        if($result){
        
	return redirect(base_url('/Cash/officeBuildAction/'.$id));     
		}
    }
    public function ListofficeBuild(){
   	      
			$data['officeBuildList'] = $this->float_model->get_all_officeBuild();
             $this->load->view('general/header');     
             $this->load->view('Float/officeBuildList',$data);
             $this->load->view('general/footer');
		
		}
    function ViewEditofficeBuild($id,$actionType='view'){
        
      	$data['officeBuildData'] = $this->float_model->getOfficeBuildByID($id); 
    //   echo "<pre>"; print_r(($data['officeBuildData'])); exit;
        $data['edit'] = 'edit';
        $data['disabled'] =  (isset($data['officeBuildData']['isBankmailSent']) && $data['officeBuildData']['isBankmailSent'] == 'yes' ? 'disabled' : '');
// 		$data['disabled'] = ($actionType == 'view' ? 'disabled' : '');
		$data['officeBuildId'] = $id;
         $this->load->view('general/header');      
         $this->load->view('Float/AddOfficeBuild',$data);
         $this->load->view('general/footer');
         
    }
    public function DeleteofficeBuild(){
     
      $res = $this->float_model->DeleteofficeBuild($this->POST['id']);
		echo $res;
		}		
		
  // END FLOAD BUILD ====================================================================================================== 
  
  
    public function daily($tillId=''){
   	        ($tillId !='' ? $this->session->set_userdata('tillId', $tillId) : '');
			$data['floatList'] = $this->float_model->get_all_floats('daily');
// 			echo "<pre>"; print_r($data['floatList']); exit;
			$data['float_type'] = 'daily';
			$data['tillId'] = $tillId;
			
			$data['tillName'] = $this->common_model->getTillNameByID($tillId);
             $this->load->view('general/header');    
             $this->load->view('Float/floatsList',$data);
             $this->load->view('general/footer');
		
		}
   	public function weekly($tillId=''){
   	        ($tillId !='' ? $this->session->set_userdata('tillId', $tillId) : '');
			$data['floatList'] = $this->float_model->get_all_floats('weekly');
// 			echo "<pre>"; print_r($data['floatList']); exit;
			$data['float_type'] = 'weekly';
			$data['tillId'] = $tillId;
			
			$data['tillName'] = $this->common_model->getTillNameByID($tillId);
             $this->load->view('general/header');    
             $this->load->view('Float/floatsList',$data);
             $this->load->view('general/footer');
		
		}
	public function monthly($tillId=''){
		    ($tillId !='' ? $this->session->set_userdata('tillId', $tillId) : '');
		    $data['tillId'] = $tillId;
		     $data['tillName'] = $this->common_model->getTillNameByID($tillId);
			$data['floatList'] = $this->float_model->get_all_floats('monthly');
            $data['float_type'] = 'monthly'; 
   
    
             $this->load->view('general/header');   
             $this->load->view('Float/floatsList',$data);
             $this->load->view('general/footer');
		
		}
	public function view($id='',$float_type='weekly'){ 
			$data['floatData'] = $this->float_model->getFloatByID($id); 
// 			echo "<pre>";
// 			print_r($data['floatData']); exit;
		$floatConfigurationData = $this->config_model->getConfiguration($float_type,$float_type);
		if(isset($floatConfigurationData[0]['data']) && !empty($floatConfigurationData[0]['data'])){
		   $data['configData'] = unserialize($floatConfigurationData[0]['data']);
		}else{
		    $data['configData'] = '';
		}
			$data['float_type'] = $float_type;
			$data['type'] = (isset($data['floatData']['IsfinalSubmissionDoneForFloat']) && $data['floatData']['IsfinalSubmissionDoneForFloat'] == 'yes' ? 'view' : '');
			$data['tillId'] = $this->session->userdata('tillId');
			 //$data['type'] = 'view';
              $data['tillName'] = $this->common_model->getTillNameByID($this->session->userdata('tillId'));
               
			   $this->load->view('general/header'); 
			   $this->load->view('Float/floatView',$data);
			   $this->load->view('general/footer'); 
           
		}
	public function edit($id='',$float_type='weekly'){
	       $floatConfigurationData = $this->config_model->getConfiguration($float_type,$float_type);
	    	if(isset($floatConfigurationData) && !empty($floatConfigurationData)){
		   $data['configData'] = unserialize($floatConfigurationData[0]['data']);; 
	    	}else{
		    $data['configData'] = '';
	    	}
			$data['floatData'] = $this->float_model->getFloatByID($id);
			 $data['tillName'] = $this->common_model->getTillNameByID($this->session->userdata('tillId'));
			 $data['float_type'] = $float_type;
		     $data['tillId'] = $this->session->userdata('tillId');
		
			   $this->load->view('general/header'); 
			   $this->load->view('Float/floatView',$data);
			   $this->load->view('general/footer'); 
			 
	}
	public function floatAdd($float_type='weekly',$tillId=''){
// 		ini_set('display_errors', 1);
		$floatConfigurationData = $this->config_model->getConfiguration($float_type,$float_type);
		if(isset($floatConfigurationData[0]['data']) && !empty($floatConfigurationData[0]['data'])){
		   $data['configData'] = unserialize($floatConfigurationData[0]['data']);; 
		}else{
		    $data['configData'] = '';
		}
	
//         echo "<pre>";
// 			print_r($data['configData']); exit;
			if(isset($this->POST['staff_name'])){
				
					$items_detail =  array(
							'staff_name' => (isset($this->POST['staff_name']) ? $this->POST['staff_name'] : ''),
							'manager_name' => (isset($this->POST['manager_name']) ? $this->POST['manager_name'] : ''),
							'start_time' => date("Y-m-d h:i:s A"),
						);
					$items_detail = serialize($items_detail);

					 $coins =  array(
							'2d' => (isset($this->POST['2d']) ? $this->POST['2d'] : ''),
							'1d' => (isset($this->POST['1d']) ? $this->POST['1d'] : ''),
							'20c' => (isset($this->POST['20c']) ? $this->POST['20c'] : ''),
							'10c' => (isset($this->POST['10c']) ? $this->POST['10c'] : ''),
							'050c' => (isset($this->POST['050c']) ? $this->POST['050c'] : ''),
							'5c' => (isset($this->POST['5c']) ? $this->POST['5c'] : ''),
						);
					$coins = serialize($coins);
					
					$notes =  array(
							'100d' => (isset($this->POST['100d']) ? $this->POST['100d'] : ''),
							'50d' => (isset($this->POST['50d']) ? $this->POST['50d'] : ''),
							'20d' => (isset($this->POST['20d']) ? $this->POST['20d'] : ''),
							'10d' => (isset($this->POST['10d']) ? $this->POST['10d'] : ''),
							'5d' => (isset($this->POST['5d']) ? $this->POST['5d'] : ''),
						);
					$notes = serialize($notes);
					
					$coins1 =  array(
							'2d1' => (isset($this->POST['2d1']) ? $this->POST['2d1'] : ''),
							'1d1' => (isset($this->POST['1d1']) ? $this->POST['1d1'] : ''),
							'20c1' => (isset($this->POST['20c1']) ? $this->POST['20c1'] : ''),
							'10c1' => (isset($this->POST['10c1']) ? $this->POST['10c1'] : ''),
							'5c1' => (isset($this->POST['5c1']) ? $this->POST['5c1'] : ''),
							'050c1' => (isset($this->POST['050c1']) ? $this->POST['050c1'] : ''),
						);
					$coins1 = serialize($coins1);
					$notes1 =  array(
							'100d1' => (isset($this->POST['100d1']) ? $this->POST['100d1'] : ''),
							'50d1' => (isset($this->POST['50d1']) ? $this->POST['50d1'] : ''),
							'20d1' => (isset($this->POST['20d1']) ? $this->POST['20d1'] : ''),
							'10d1' => (isset($this->POST['10d1']) ? $this->POST['10d1'] : ''),
							'5d1' => (isset($this->POST['5d1']) ? $this->POST['5d1'] : ''),
						);
					$notes1 = serialize($notes1);
					
					// second part of float
					$frontCounterFloatCoinsNotesM1 =  array(
							'm1_2d' => (isset($this->POST['m1_2d']) ? $this->POST['m1_2d'] : ''),
							'm1_1d' => (isset($this->POST['m1_1d']) ? $this->POST['m1_1d'] : ''),
							'm1_20c' => (isset($this->POST['m1_20c']) ? $this->POST['m1_20c'] : ''),
							'm1_10c' => (isset($this->POST['m1_10c']) ? $this->POST['m1_10c'] : ''),
							'm1_050c' => (isset($this->POST['m1_050c']) ? $this->POST['m1_050c'] : ''),
							'm1_5c' => (isset($this->POST['m1_5c']) ? $this->POST['m1_5c'] : ''),
							'm1_100d' => (isset($this->POST['m1_100d']) ? $this->POST['m1_100d'] : ''),
							'm1_50d' => (isset($this->POST['m1_50d']) ? $this->POST['m1_50d'] : ''),
							'm1_20d' => (isset($this->POST['m1_20d']) ? $this->POST['m1_20d'] : ''),
							'm1_10d' => (isset($this->POST['m1_10d']) ? $this->POST['m1_10d'] : ''),
							'm1_5d' => (isset($this->POST['m1_5d']) ? $this->POST['m1_5d'] : ''),
						);
					$frontCounterFloatCoinsNotesM1 = serialize($frontCounterFloatCoinsNotesM1);
					
					$frontCounterFloatCoinsNotesM2 =  array(
							'm2_2d1' => (isset($this->POST['m2_2d1']) ? $this->POST['m2_2d1'] : ''),
							'm2_1d1' => (isset($this->POST['m2_1d1']) ? $this->POST['m2_1d1'] : ''),
							'm2_20c1' => (isset($this->POST['m2_20c1']) ? $this->POST['m2_20c1'] : ''),
							'm2_10c1' => (isset($this->POST['m2_10c1']) ? $this->POST['m2_10c1'] : ''),
							'm2_5c1' => (isset($this->POST['m2_5c1']) ? $this->POST['m2_5c1'] : ''),
							'm2_050c1' => (isset($this->POST['m2_050c1']) ? $this->POST['m2_050c1'] : ''),
							'm2_100d1' => (isset($this->POST['m2_100d1']) ? $this->POST['m2_100d1'] : ''),
							'm2_50d1' => (isset($this->POST['m2_50d1']) ? $this->POST['m2_50d1'] : ''),
							'm2_20d1' => (isset($this->POST['m2_20d1']) ? $this->POST['m2_20d1'] : ''),
							'm2_10d1' =>(isset($this->POST['m2_10d1']) ? $this->POST['m2_10d1'] : ''),
							'm2_5d1' => (isset($this->POST['m2_5d1']) ? $this->POST['m2_5d1'] : ''),
						);
					$frontCounterFloatCoinsNotesM2 = serialize($frontCounterFloatCoinsNotesM2);
				
					$frontCounterFloatTableFooterTotals = array(
					    'm1_entrytotal' => (isset($this->POST['m1_entrytotal']) ? $this->POST['m1_entrytotal'] : ''),
						'm2_entrytotal1' => (isset($this->POST['m2_entrytotal1']) ? $this->POST['m2_entrytotal1'] : ''),
					    'm1_floatTotal' => (isset($this->POST['m1_floatTotal']) ? $this->POST['m1_floatTotal'] : ''),
						'm2_managerFloatTotal' => (isset($this->POST['m2_managerFloatTotal']) ? $this->POST['m2_managerFloatTotal'] : ''),
						'm1_floatvarience' => (isset($this->POST['m1_floatvarience']) ? $this->POST['m1_floatvarience'] : ''),
						'm2_managerVarience' => (isset($this->POST['m2_managerVarience']) ? $this->POST['m2_managerVarience'] : ''),
						
						
					    );
				
					
					$float_data = array(
						
				// 		'till_id' => $tillId,
						'float_type' => $float_type,
						'coins' => $coins,
						'notes' => $notes,
						'coins1' => $coins1,
						'notes1' => $notes1,
						'frontCounterFloatCoinsNotesM1' => $frontCounterFloatCoinsNotesM1,
						'frontCounterFloatCoinsNotesM2' => $frontCounterFloatCoinsNotesM2,
						'items_detail' => $items_detail,
						'entrytotal' => (isset($this->POST['entrytotal']) ? $this->POST['entrytotal'] : ''),
						'entrytotal1' => (isset($this->POST['entrytotal1']) ? $this->POST['entrytotal1'] : ''),
						'floatTotal' => (isset($this->POST['floatTotal']) ? $this->POST['floatTotal'] : ''),
						'managerFloatTotal' => (isset($this->POST['managerFloatTotal']) ? $this->POST['managerFloatTotal'] : ''),
						'managerVarience' => (isset($this->POST['managerVarience']) ? $this->POST['managerVarience'] : ''),
						'staffVarience' => (isset($this->POST['staffVarience']) ? $this->POST['staffVarience'] : ''),
						'staffComments' => (isset($this->POST['staffComments']) ? $this->POST['staffComments'] : ''),
						'managerComments' =>(isset($this->POST['managerComments']) ? $this->POST['managerComments'] : ''),
						
						'staffOfficeFloatComments' => (isset($this->POST['staffOfficeFloatComments']) ? $this->POST['staffOfficeFloatComments'] : ''),
						'managerOfficeFloatComments' => (isset($this->POST['managerOfficeFloatComments']) ? $this->POST['managerOfficeFloatComments'] : ''),
						'staffFrontCounterFloatComments' => (isset($this->POST['staffFrontCounterFloatComments']) ? $this->POST['staffFrontCounterFloatComments'] : ''),
						'managerFrontCounterFloatComments' => (isset($this->POST['managerFrontCounterFloatComments']) ? $this->POST['managerFrontCounterFloatComments'] : ''),
						'm2_of_fc_floatvarience' => (isset($this->POST['m2_of_fc_floatvarience']) && $this->POST['m2_of_fc_floatvarience'] != '' ? $this->POST['m2_of_fc_floatvarience'] : 'disabled'),
				// 		'commentsEntered' => $this->POST['commentsEntered'],
						'frontCounterFloatTableFooterTotals' => serialize($frontCounterFloatTableFooterTotals),
						'status'=>1,
						'IsfinalSubmissionDoneForFloat' => (isset($this->POST['IsfinalSubmissionDoneForFloat']) ? $this->POST['IsfinalSubmissionDoneForFloat'] : ''),
						'created_date' => date('Y-m-d'),
						'location_id' => $this->session->userdata('location_id'),
					);
				// 	echo "<pre>"; print_r($float_data); exit;
				    if((isset($this->POST['m2_of_fc_floatvarience']) && abs($this->POST['m2_of_fc_floatvarience']) > 2 ) || (isset($this->POST['managerVarience']) && $this->POST['managerVarience'] > 2 ) && (isset($this->POST['IsfinalSubmissionDoneForFloat']))){
                         $mailConfigData = $this->config_model->getConfiguration($float_type.'Float_mail');
                         if(isset($mailConfigData[0]) && !empty($mailConfigData[0])){
                           $emailTo = unserialize($mailConfigData[0]['data']);
                           $emailSendTo =  (isset($emailTo[0]) && !empty($emailTo[0]) ? $emailTo[0] : 'kaushika@kjcreate.com.au ');
                         }else{
                            $emailSendTo = 'kaushika@aaria.com.au';
                         }
                         $data['managerVariance']= (isset($this->POST['m2_of_fc_floatvarience']) ? $this->POST['m2_of_fc_floatvarience'] : $this->POST['managerVarience']);
                         $data['locationName'] = fetchLocationNamesFromIds($this->session->userdata('location_id'),true);
                         $mailContent = $this->load->view('Mail/endShiftVariance',$data,TRUE);
                        $this->sendEmail($emailSendTo, ucfirst($float_type).' Float Variance', $mailContent,$this->session->userdata('mail_from'));
                          $Notificationmsg = ucfirst($float_type). ' Variance exceeded $2.00 at  location '.$data['locationName'];  
                       createNotification($this->tenantDb,$this->session->userdata('system_id'),$this->selected_location_id,'alert',$Notificationmsg);
                     }
		
					$result = $this->float_model->addFloat($float_data);
					if($result){
					   	return redirect(base_url('/Cash/'.$float_type));    
					  
					}else{
					   // echo "<pre>"; print_r($float_data); exit;
					}
			}
			else{
                
             $data['tillName'] = $this->common_model->getTillNameByID($tillId);
            //  $data['floatData'] = $this->float_model->getFloatByID($tillId,true,$float_type);
             $data['isUpdateForm']  = false;
            
             $data['tillId'] = $tillId;
             $data['float_type'] = $float_type;
              $this->load->view('general/header');
              $this->load->view('Float/floatAdd', $data);
               $this->load->view('general/footer'); 
			}
			
		}
	public function update($float_type='weekly',$tillId=''){
// 		ini_set('display_errors', 1);

			if(isset($this->POST['staff_name'])){
			
					$items_detail =  array(
							'staff_name' => $this->POST['staff_name'],
							'manager_name' => $this->POST['manager_name'],
							'start_time' => $this->POST['start_time'],
						);
					
					$items_detail = serialize($items_detail);

					  $coins =  array(
							'2d' => (isset($this->POST['2d']) ? $this->POST['2d'] : ''),
							'1d' => (isset($this->POST['1d']) ? $this->POST['1d'] : ''),
							'20c' => (isset($this->POST['20c']) ? $this->POST['20c'] : ''),
							'10c' => (isset($this->POST['10c']) ? $this->POST['10c'] : ''),
							'050c' => (isset($this->POST['050c']) ? $this->POST['050c'] : ''),
							'5c' => (isset($this->POST['5c']) ? $this->POST['5c'] : ''),
						);
					$coins = serialize($coins);
					
					$notes =  array(
							'100d' => (isset($this->POST['100d']) ? $this->POST['100d'] : ''),
							'50d' => (isset($this->POST['50d']) ? $this->POST['50d'] : ''),
							'20d' => (isset($this->POST['20d']) ? $this->POST['20d'] : ''),
							'10d' => (isset($this->POST['10d']) ? $this->POST['10d'] : ''),
							'5d' => (isset($this->POST['5d']) ? $this->POST['5d'] : ''),
						);
					$notes = serialize($notes);
					
					$coins1 =  array(
							'2d1' => (isset($this->POST['2d1']) ? $this->POST['2d1'] : ''),
							'1d1' => (isset($this->POST['1d1']) ? $this->POST['1d1'] : ''),
							'20c1' => (isset($this->POST['20c1']) ? $this->POST['20c1'] : ''),
							'10c1' => (isset($this->POST['10c1']) ? $this->POST['10c1'] : ''),
							'5c1' => (isset($this->POST['5c1']) ? $this->POST['5c1'] : ''),
							'050c1' => (isset($this->POST['050c1']) ? $this->POST['050c1'] : ''),
						);
					$coins1 = serialize($coins1);
					$notes1 =  array(
							'100d1' => (isset($this->POST['100d1']) ? $this->POST['100d1'] : ''),
							'50d1' => (isset($this->POST['50d1']) ? $this->POST['50d1'] : ''),
							'20d1' => (isset($this->POST['20d1']) ? $this->POST['20d1'] : ''),
							'10d1' => (isset($this->POST['10d1']) ? $this->POST['10d1'] : ''),
							'5d1' => (isset($this->POST['5d1']) ? $this->POST['5d1'] : ''),
						);
					$notes1 = serialize($notes1);
					
					// second part of float
					$frontCounterFloatCoinsNotesM1 =  array(
							'm1_2d' => (isset($this->POST['m1_2d']) ? $this->POST['m1_2d'] : ''),
							'm1_1d' => (isset($this->POST['m1_1d']) ? $this->POST['m1_1d'] : ''),
							'm1_20c' => (isset($this->POST['m1_20c']) ? $this->POST['m1_20c'] : ''),
							'm1_10c' => (isset($this->POST['m1_10c']) ? $this->POST['m1_10c'] : ''),
							'm1_050c' => (isset($this->POST['m1_050c']) ? $this->POST['m1_050c'] : ''),
							'm1_5c' => (isset($this->POST['m1_5c']) ? $this->POST['m1_5c'] : ''),
							'm1_100d' => (isset($this->POST['m1_100d']) ? $this->POST['m1_100d'] : ''),
							'm1_50d' => (isset($this->POST['m1_50d']) ? $this->POST['m1_50d'] : ''),
							'm1_20d' => (isset($this->POST['m1_20d']) ? $this->POST['m1_20d'] : ''),
							'm1_10d' => (isset($this->POST['m1_10d']) ? $this->POST['m1_10d'] : ''),
							'm1_5d' => (isset($this->POST['m1_5d']) ? $this->POST['m1_5d'] : ''),
						);
					$frontCounterFloatCoinsNotesM1 = serialize($frontCounterFloatCoinsNotesM1);
					
					$frontCounterFloatCoinsNotesM2 =  array(
							'm2_2d1' => (isset($this->POST['m2_2d1']) ? $this->POST['m2_2d1'] : ''),
							'm2_1d1' => (isset($this->POST['m2_1d1']) ? $this->POST['m2_1d1'] : ''),
							'm2_20c1' => (isset($this->POST['m2_20c1']) ? $this->POST['m2_20c1'] : ''),
							'm2_10c1' => (isset($this->POST['m2_10c1']) ? $this->POST['m2_10c1'] : ''),
							'm2_5c1' => (isset($this->POST['m2_5c1']) ? $this->POST['m2_5c1'] : ''),
							'm2_050c1' => (isset($this->POST['m2_050c1']) ? $this->POST['m2_050c1'] : ''),
							'm2_100d1' => (isset($this->POST['m2_100d1']) ? $this->POST['m2_100d1'] : ''),
							'm2_50d1' => (isset($this->POST['m2_50d1']) ? $this->POST['m2_50d1'] : ''),
							'm2_20d1' => (isset($this->POST['m2_20d1']) ? $this->POST['m2_20d1'] : ''),
							'm2_10d1' =>(isset($this->POST['m2_10d1']) ? $this->POST['m2_10d1'] : ''),
							'm2_5d1' => (isset($this->POST['m2_5d1']) ? $this->POST['m2_5d1'] : ''),
						);
					$frontCounterFloatCoinsNotesM2 = serialize($frontCounterFloatCoinsNotesM2);
				
					$frontCounterFloatTableFooterTotals = array(
					    'm1_entrytotal' => (isset($this->POST['m1_entrytotal']) ? $this->POST['m1_entrytotal'] : ''),
						'm2_entrytotal1' => (isset($this->POST['m2_entrytotal1']) ? $this->POST['m2_entrytotal1'] : ''),
					    'm1_floatTotal' => (isset($this->POST['m1_floatTotal']) ? $this->POST['m1_floatTotal'] : ''),
						'm2_managerFloatTotal' => (isset($this->POST['m2_managerFloatTotal']) ? $this->POST['m2_managerFloatTotal'] : ''),
						'm1_floatvarience' => (isset($this->POST['m1_floatvarience']) ? $this->POST['m1_floatvarience'] : ''),
						'm2_managerVarience' => (isset($this->POST['m2_managerVarience']) ? $this->POST['m2_managerVarience'] : ''),
					    );
				
				

					$floadUpdatedData = array(
					
				// 		'till_id' => $this->session->get('tillId'),
						'coins' => $coins,
						'notes' => $notes,
						'coins1' => $coins1,
						'notes1' => $notes1,
						'frontCounterFloatCoinsNotesM1' => $frontCounterFloatCoinsNotesM1,
						'frontCounterFloatCoinsNotesM2' => $frontCounterFloatCoinsNotesM2,
						'items_detail' => $items_detail,
						'entrytotal' => (isset($this->POST['entrytotal']) ? $this->POST['entrytotal'] : ''),
						'entrytotal1' => (isset($this->POST['entrytotal1']) ? $this->POST['entrytotal1'] : ''),
						'floatTotal' => (isset($this->POST['floatTotal']) ? $this->POST['floatTotal'] : ''),
						'managerVarience' => (isset($this->POST['managerVarience']) ? $this->POST['managerVarience'] : ''),
						'managerFloatTotal' => (isset($this->POST['managerFloatTotal']) ? $this->POST['managerFloatTotal'] : ''),
						'frontCounterFloatTableFooterTotals' => serialize($frontCounterFloatTableFooterTotals),
						'staffVarience' => (isset($this->POST['staffVarience']) ? $this->POST['staffVarience'] : ''),
						'staffComments' => (isset($this->POST['staffComments']) ? $this->POST['staffComments'] : ''),
						'managerComments' => (isset($this->POST['managerComments']) ? $this->POST['managerComments'] : ''),
						
						'staffOfficeFloatComments' => (isset($this->POST['staffOfficeFloatComments']) ? $this->POST['staffOfficeFloatComments'] : ''),
						'managerOfficeFloatComments' => (isset($this->POST['managerOfficeFloatComments']) ? $this->POST['managerOfficeFloatComments'] : ''),
						'staffFrontCounterFloatComments' => (isset($this->POST['staffFrontCounterFloatComments']) ? $this->POST['staffFrontCounterFloatComments'] : ''),
						'managerFrontCounterFloatComments' => (isset($this->POST['managerFrontCounterFloatComments']) ? $this->POST['managerFrontCounterFloatComments'] : ''),
					    'm2_of_fc_floatvarience' => (isset($this->POST['m2_of_fc_floatvarience']) && $this->POST['m2_of_fc_floatvarience'] != '' ? $this->POST['m2_of_fc_floatvarience'] : 'disabled'),
						'status'=>1,
				// 		'IsfinalSubmissionDoneForFloat' => (isset($this->POST['IsfinalSubmissionDoneForFloat']) ? $this->POST['IsfinalSubmissionDoneForFloat'] : ''),
						'updated_date' => date('Y-m-d'),
					);
					if(isset($this->POST['IsfinalSubmissionDoneForFloat']) && $this->POST['IsfinalSubmissionDoneForFloat'] =='yes' && $this->POST['manager_name'] !=''){
					 
					   $floadUpdatedData['manager2finalSubmissionDoneForFloat'] = 'yes';
					   
					   if((isset($this->POST['m2_of_fc_floatvarience']) && abs($this->POST['m2_of_fc_floatvarience']) > 2 ) || (isset($this->POST['managerVarience']) && $this->POST['managerVarience'] > 2 ) && (isset($this->POST['IsfinalSubmissionDoneForFloat']))){
                         $mailConfigData = $this->config_model->getConfiguration($float_type.'Float_mail');
                         if(isset($mailConfigData[0]) && !empty($mailConfigData[0])){
                           $emailTo = unserialize($mailConfigData[0]['data']);
                           $emailSendTo =  (isset($emailTo[0]) && !empty($emailTo[0]) ? $emailTo[0] : 'kaushika@kjcreate.com.au ');
                         }else{
                            $emailSendTo = 'bh@cjsgroup.net.au';
                         }
                         $data['managerVariance']= (isset($this->POST['m2_of_fc_floatvarience']) ? $this->POST['m2_of_fc_floatvarience'] : $this->POST['managerVarience']);
                         $data['locationName'] = fetchLocationNamesFromIds($this->session->userdata('location_id'),true);
                         $mailContent = $this->load->view('Mail/endShiftVariance',$data,TRUE);
                        $this->sendEmail($emailSendTo, ucfirst($float_type).' Float Variance', $mailContent,$this->session->userdata('mail_from'));
                        $Notificationmsg = ucfirst($float_type). ' Float Variance exceeded $2.00 at  location '.$data['locationName'];  
                       createNotification($this->tenantDb,$this->session->userdata('system_id'),$this->selected_location_id,'alert',$Notificationmsg);
                     }
		
					}
					if(isset($this->POST['IsfinalSubmissionDoneForFloat']) && $this->POST['IsfinalSubmissionDoneForFloat'] =='yes' && $this->POST['staff_name'] !='' && $this->POST['manager_name'] ==''){
					   $floadUpdatedData['IsfinalSubmissionDoneForFloat'] = 'yes';
					
					     
					}
                    $floatId = $this->POST['floatId'];
// echo "<pre>"; print_r($this->POST['IsfinalSubmissionDoneForFloat']); exit;
					$result = $this->float_model->update_cashD($floadUpdatedData,$floatId);
				
					if($result){
					  return redirect(base_url('/Cash/'.$float_type));
					}
			}
			else{
                $data['till_list'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
               
                // echo "<pre>"; print_r($data['till_list']); exit;
                 $this->load->view('general/header');
                 $this->load->view('Float/floatAdd', $data);
                 $this->load->view('general/footer'); 
			}
			
		}
   
   
    public function delete(){
      $res = $this->float_model->deleteFloat($this->POST['id']);
		echo $res;
		}
   
   
    

}
?>