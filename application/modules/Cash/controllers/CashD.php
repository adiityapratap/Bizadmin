<?php
class CashD extends MY_Controller
{
    public function __construct() 
    {   
        $this->load->model('cash_model');
        $this->load->model('common_model');
        $this->load->model('config_model');
        $this->load->model('tills_model');
        $this->load->library('form_validation');
        $this->POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->selected_location_id = $this->session->userdata('location_id');
        $this->locationName = fetchLocationNamesFromIds($this->selected_location_id,true);
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        parent::__construct();
        // role id 1= Admin , 2 = Manager ,  3 = Supervisor,  4 =  staff
        $this->roles = $this->ion_auth->get_users_groups()->result();
        
    }
   	public function index($tillId=''){
   	   
             ($tillId !='' ? $this->session->set_userdata('tillId', $tillId) : '');
			$data['cashDepositList'] = $this->cash_model->get_all_cashD($this->session->userdata('tillId'));
			$data['tillName'] = (isset($data['cashDepositList'][0]['till_name']) ? $data['cashDepositList'][0]['till_name'] : '');;
            $this->load->view('general/header');
            $this->load->view('Shift/cashDepositsList', $data);
            $this->load->view('general/footer');
		
		}
	public function view($id=''){
	
			$data['cashDepositList'] = $this->cash_model->getCashDepositByID($id);
			 $data['managerdisabled'] = (isset($data['cashDepositList']['IsManagerfinalSubmissionDone']) && $data['cashDepositList']['IsManagerfinalSubmissionDone'] == 'yes' ? 'disabled' : '');
            $data['staffdisabled'] = (isset($data['cashDepositList']['IsStafffinalSubmissionDone']) && $data['cashDepositList']['IsStafffinalSubmissionDone'] == 'yes' ? 'disabled' : '');

			 $data['till_list'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
			 $data['disabled'] = 'disabled';
			 $endTime = unserialize($data['cashDepositList']['items_detail']);
			 $data['role_id'] = $this->roles[0]->id;
			 if(isset($endTime['end_time'])){
             $this->load->view('general/header');
             $this->load->view('Shift/viewEndShift', $data);
             $this->load->view('general/footer');
			 }else{
			 $this->load->view('general/header');
			 $this->load->view('Shift/cashView', $data);
			 $this->load->view('general/footer');    
			 }
           
		}
	public function edit($id=''){
			$data['cashDepositList'] = $this->cash_model->getCashDepositByID($id);
			$data['managerdisabled'] = (isset($data['cashDepositList']['IsManagerfinalSubmissionDone']) && $data['cashDepositList']['IsManagerfinalSubmissionDone'] == 'yes' ? 'disabled' : '');
            $data['staffdisabled'] = (isset($data['cashDepositList']['IsStafffinalSubmissionDone']) && $data['cashDepositList']['IsStafffinalSubmissionDone'] == 'yes' ? 'disabled' : '');
             $data['till_list'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
			 $data['disabled'] = '';
			 $data['role_id'] = $this->roles[0]->id;
			 $endTime = unserialize($data['cashDepositList']['items_detail']);
			 if(isset($endTime['end_time'])){
			     $data['disabled'] = '';
                $this->load->view('general/header');
                $this->load->view('Shift/editEndShift', $data);
                $this->load->view('general/footer');
			 }else{
			 $this->load->view('general/header');
			 $this->load->view('Shift/editEndShift', $data);
			 $this->load->view('general/footer');    
			 }
			 
	}
	public function cashdAdd($tillId=''){
	
		
       ($tillId !='' ? $this->session->set_userdata('tillId', $tillId) : '');
      
			if(isset($this->POST['staff_name'])){
				
					$items_detail =  array(
							'staff_name' => $this->POST['staff_name'],
							'start_time' => date("Y-m-d h:i:s A"),
						);
					$items_detail = serialize($items_detail);

					$coins =  array(
							'2d' => (isset($this->POST['2d']) ? $this->POST['2d'] :''),
							'1d' => (isset($this->POST['1d']) ? $this->POST['1d'] :''),
							'20c' => (isset($this->POST['20c']) ? $this->POST['20c'] :''),
							'10c' => (isset($this->POST['10c']) ? $this->POST['10c'] :''),
							'050c' => (isset($this->POST['050c']) ? $this->POST['050c'] :''),
							'5c' => (isset($this->POST['5c']) ? $this->POST['5c'] :''),
						);
					$coins = serialize($coins);
					$notes =  array(
							'100d' => (isset($this->POST['100d']) ? $this->POST['100d'] :''),
							'50d' => (isset($this->POST['50d']) ? $this->POST['50d'] :''),
							'20d' => (isset($this->POST['20d']) ? $this->POST['20d'] : 0),
							'10d' => (isset($this->POST['10d']) ? $this->POST['10d'] : 0),
							'5d' => (isset($this->POST['5d']) ? $this->POST['5d'] : 0),
						);
					$notes = serialize($notes);
                             // here till name corresponds to till id
					$account_data = array(
						'till_id' => (isset($this->POST['selectedTillID']) ? $this->POST['selectedTillID'] : ''),
						'startShiftCoins' => $coins,
						'endShiftNotes' => $notes,
						'items_detail' => $items_detail,
						'startShiftEntrytotal' => (isset($this->POST['entrytotal']) ? $this->POST['entrytotal'] : ''),
						'stdcashfloat' => (isset($this->POST['stdcashfloat']) ? $this->POST['stdcashfloat'] : ''),
						'varience' => (isset($this->POST['varience']) ? $this->POST['varience'] : ''),
						'IsfinalSubmissionDoneForStartShift' => (isset($this->POST['IsfinalSubmissionDoneForStartShift']) && $this->POST['IsfinalSubmissionDoneForStartShift'] !='' ? $this->POST['IsfinalSubmissionDoneForStartShift'] : ''),
						'shiftStarted' => 1,
						'status'=>1,
						'Year' => date("Y"),
						'Month' => date('F'),
						'created_date' => date('Y-m-d'),
						'location_id' => $this->session->userdata('location_id'),
					);

					$insertedId = $this->cash_model->add_cashD($account_data);
					
					// if variance is more than 2 dollar send mail to admin/manager
                     if(isset($this->POST['varience']) && abs($this->POST['varience']) > 2){
                         $mailConfigData = $this->config_model->getConfiguration('startShift_mail');
                         if(isset($mailConfigData[0]) && !empty($mailConfigData[0])){
                           $emailTo = unserialize($mailConfigData[0]['data']);
                           $emailSendTo =  (isset($emailTo[0]) && !empty($emailTo[0]) ? $emailTo[0] : 'kaushika@kjcreate.com.au ');
                         }else{
                            $emailSendTo = 'kaushika@aaria.com.au';
                         }
                       
                         $data['varience']=  $this->POST['varience'];
                         $data['tillName'] = $this->POST['tillName'];
                         $data['locationName'] = $this->locationName;
                         $mailContent = $this->load->view('Mail/startShiftVariance',$data,TRUE);
                        $this->sendEmail($emailSendTo, 'Cash Variance', $mailContent,$this->session->userdata('mail_from'));
                       $Notificationmsg = 'Start Shift Variance exceeded $2.00 at location '.$this->locationName;  
                       createNotification($this->tenantDb,$this->session->userdata('system_id'),$this->selected_location_id,'alert',$Notificationmsg); 
                     }
                     
					if($insertedId){
					 return redirect(base_url('/Cash/'.$this->session->userdata('system_id')));
					}
			}
			else{
			    $data['cashDepositListStartOfShift'] = $this->cash_model->getCashDepositByID($tillId,true); 
			   
			    $data['disabled'] = (isset($data['cashDepositListStartOfShift']['IsfinalSubmissionDoneForStartShift']) && $data['cashDepositListStartOfShift']['IsfinalSubmissionDoneForStartShift'] == 'yes' ? 'disabled' : '');
			 //  echo $data['disabled']; exit;
			    $data['updateForm'] = (empty($data['cashDepositListStartOfShift']) || $data['cashDepositListStartOfShift'] == '' ? false : true);
			   $data['tillName'] = $this->common_model->getTillNameByID($tillId);
                $data['selectedTillID'] = $tillId;
                
                $this->load->view('general/header');
                $this->load->view('Shift/cashdAdd', $data);
                $this->load->view('general/footer');
			}
			
		}
	public function update(){
// 		ini_set('display_errors', 1);
    
			if(isset($this->POST['staff_name'])){
				
					$items_detail =  array(
							'staff_name' => (isset($this->POST['staff_name']) ? $this->POST['staff_name']: ''),
							'start_time' => (isset($this->POST['start_time']) ? $this->POST['start_time']: ''),
							'end_staff_name' => (isset($this->POST['end_staff_name']) ? $this->POST['end_staff_name'] : ''),
							'manager_name' => (isset($this->POST['manager_name']) ? $this->POST['manager_name'] : ''),
						);
				
					$items_detail = serialize($items_detail);

					 $coins =  array(
							'2d' => (isset($this->POST['2d']) ? $this->POST['2d'] :''),
							'1d' => (isset($this->POST['1d']) ? $this->POST['1d'] :''),
							'20c' => (isset($this->POST['20c']) ? $this->POST['20c'] :''),
							'10c' => (isset($this->POST['10c']) ? $this->POST['10c'] :''),
							'050c' => (isset($this->POST['050c']) ? $this->POST['050c'] :''),
							'5c' => (isset($this->POST['5c']) ? $this->POST['5c'] :''),
						);
					$coins = serialize($coins);
					$notes =  array(
							'100d' => (isset($this->POST['100d']) ? $this->POST['100d'] :''),
							'50d' => (isset($this->POST['50d']) ? $this->POST['50d'] :''),
							'20d' => (isset($this->POST['20d']) ? $this->POST['20d'] : 0),
							'10d' => (isset($this->POST['10d']) ? $this->POST['10d'] : 0),
							'5d' => (isset($this->POST['5d']) ? $this->POST['5d'] : 0),
						);
					$notes = serialize($notes);

					$cashDepositData = array(
				// 		'till_id' => $this->POST['till_name'],
						'startShiftCoins' => $coins,
						'endShiftNotes' => $notes,
						'items_detail' => $items_detail,
						'startShiftEntrytotal' => (isset($this->POST['entrytotal']) ? $this->POST['entrytotal'] : 0),
						'stdcashfloat' => (isset($this->POST['stdcashfloat']) ? $this->POST['stdcashfloat'] : 0),
						'varience' => (isset($this->POST['varience']) ? $this->POST['varience'] : 0),
						'IsfinalSubmissionDoneForStartShift' => (isset($this->POST['IsfinalSubmissionDoneForStartShift']) && $this->POST['IsfinalSubmissionDoneForStartShift'] !='' ? $this->POST['IsfinalSubmissionDoneForStartShift'] : ''),
						'status'=>1,
						'updated_date' => date('Y-m-d'),
					);
                    $cashDepositId = (isset($this->POST['cashDepositId']) ? $this->POST['cashDepositId'] : '');
                    // echo $cashDepositId;
                    // echo "<pre>"; print_r($cashDepositData); exit;
					$result = $this->cash_model->update_cashD($cashDepositData,$cashDepositId);
					
					if($result){
					  return redirect(base_url('/Cash/'.$this->session->userdata('system_id')));
					}
			}
			else{
                $data['till_list'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
                
                // echo "<pre>"; print_r($data['till_list']); exit;
                $this->load->view('general/header');
                $this->load->view('Shift/cashdAdd', $data);
                $this->load->view('general/footer');
			}
			
		}
    public function endShift($id=''){
// 		ini_set('display_errors', 1);
    //   echo "<pre>"; print_r($this->POST); exit;

    // Assuming the user has only one role, you can access its ID like this:
   
			if(isset($this->POST['end_staff_name']) || isset($this->POST['manager_name'])){
				
					$items_detail =  array(
							'end_staff_name' => (isset($this->POST['end_staff_name']) ? $this->POST['end_staff_name'] : ''),
							'staff_name' => (isset($this->POST['staff_name']) ? $this->POST['staff_name'] : ''),
							'manager_name' => (isset($this->POST['manager_name']) ? $this->POST['manager_name'] : ''),
							'start_time' => (isset($this->POST['start_time']) ? $this->POST['start_time'] : ''),
							'end_time' => date("Y-m-d h:i:s A"),
						);
					$items_detail = serialize($items_detail);

				
					$cashDepositData = array(
						'items_detail' => $items_detail,
						'shiftEnded' => 1,
						'status'=>1,
						'updated_date' => date('Y-m-d'),
						'location_id' => $this->session->userdata('location_id'),
					);
					
					  if($this->ion_auth->get_users_groups()->row()->name == 'Staff'){
					    $coins =  array(
							'2d' => (isset($this->POST['2d']) ? $this->POST['2d'] :''),
							'1d' => (isset($this->POST['1d']) ? $this->POST['1d'] :''),
							'20c' => (isset($this->POST['20c']) ? $this->POST['20c'] :''),
							'10c' => (isset($this->POST['10c']) ? $this->POST['10c'] :''),
							'050c' => (isset($this->POST['050c']) ? $this->POST['050c'] :''),
							'5c' => (isset($this->POST['5c']) ? $this->POST['5c'] :''),
						);
					    $coins = serialize($coins);
					    $notes =  array(
							'100d' => (isset($this->POST['100d']) ? $this->POST['100d'] :''),
							'50d' => (isset($this->POST['50d']) ? $this->POST['50d'] :''),
							'20d' => (isset($this->POST['20d']) ? $this->POST['20d'] : 0),
							'10d' => (isset($this->POST['10d']) ? $this->POST['10d'] : 0),
							'5d' => (isset($this->POST['5d']) ? $this->POST['5d'] : 0),
						);
					    $notes = serialize($notes);  
					    $cashDepositData['IsStafffinalSubmissionDone'] = (isset($this->POST['IsfinalSubmissionDone']) && $this->POST['IsfinalSubmissionDone'] !=''  ? $this->POST['IsfinalSubmissionDone'] : '');
				     	$cashDepositData['coins'] = $coins;
				     	$cashDepositData['notes'] = $notes;
				     	$cashDepositData['depositM1'] = (isset($this->POST['depositM1']) ? $this->POST['depositM1'] : 0);
						$cashDepositData['entrytotal'] = (isset($this->POST['entrytotal']) ? $this->POST['entrytotal'] : 0);
						$cashDepositData['regtotal'] = (isset($this->POST['coinBagCash']) ? $this->POST['coinBagCash'] : 0);
						$cashDepositData['registerFloat'] = (isset($this->POST['registerFloat']) ? $this->POST['registerFloat'] : 0);
						$cashDepositData['pettyCash'] = (isset($this->POST['pettyCash']) ? $this->POST['pettyCash'] : 0);
						$cashDepositData['requiredRegisterAmount'] = (isset($this->POST['requiredRegisterAmount']) ? $this->POST['requiredRegisterAmount'] : 0);
						$cashDepositData['staffVariance'] = (isset($this->POST['staffVariance']) ? $this->POST['staffVariance'] : 0);
						$cashDepositData['staffComments'] = (isset($this->POST['staffComments']) ? $this->POST['staffComments'] : 0);
					}
					
					
				
					if($this->ion_auth->get_users_groups()->row()->name != 'Staff'){
					    
					$coins1 =  array(
							'2d1' => (isset($this->POST['2d1']) ? $this->POST['2d1'] : 0),
							'1d1' => (isset($this->POST['1d1']) ? $this->POST['1d1'] : 0),
							'20c1' => (isset($this->POST['20c1']) ? $this->POST['20c1'] : 0),
							'10c1' => (isset($this->POST['10c1']) ? $this->POST['10c1'] : 0),
							'5c1' => (isset($this->POST['5c1']) ? $this->POST['5c1'] : 0),
							'050c1' => (isset($this->POST['050c1']) ? $this->POST['050c1'] : 0),
						);
					$coins1 = serialize($coins1);
					$notes1 =  array(
							'100d1' => (isset($this->POST['100d1']) ? $this->POST['100d1'] : 0),
							'50d1' => (isset($this->POST['50d1']) ? $this->POST['50d1'] : 0),
							'20d1' => (isset($this->POST['20d1']) ? $this->POST['20d1'] : 0),
							'10d1' => (isset($this->POST['10d1']) ? $this->POST['10d1'] : 0),
							'5d1' =>  (isset($this->POST['5d1']) ? $this->POST['5d1'] : 0),
						);
					    $notes1 = serialize($notes1);
				        $cashDepositData['IsManagerfinalSubmissionDone'] = (isset($this->POST['IsfinalSubmissionDone']) && $this->POST['IsfinalSubmissionDone'] !=''  ? $this->POST['IsfinalSubmissionDone'] : '');    
						$cashDepositData['coins1'] = $coins1;
				     	$cashDepositData['notes1'] = $notes1;
				     	$cashDepositData['entrytotal1'] = (isset($this->POST['entrytotal1']) ? $this->POST['entrytotal1'] : 0);
						$cashDepositData['regtotal1'] = (isset($this->POST['coinBagCash1']) ? $this->POST['coinBagCash1'] : 0);
					    $cashDepositData['registerFloat1'] = (isset($this->POST['registerFloat1']) ? $this->POST['registerFloat1'] : 0);
						$cashDepositData['pettyCash1'] = (isset($this->POST['pettyCash1']) ? $this->POST['pettyCash1'] : 0);
						$cashDepositData['depositM2'] = (isset($this->POST['depositM2']) ? $this->POST['depositM2'] : 0);
						$cashDepositData['requiredRegisterAmount1'] = (isset($this->POST['requiredRegisterAmount1']) ? $this->POST['requiredRegisterAmount1'] : 0);
						$cashDepositData['managerVariance'] = (isset($this->POST['managerVariance']) ? $this->POST['managerVariance'] : 0);
						$cashDepositData['managerComments'] = (isset($this->POST['managerComments']) ? $this->POST['managerComments'] : 0);
					    
					}
                     // if variance is more than 5 dollar send mail to admin/manager
                     if(isset($this->POST['managerVariance']) && abs($this->POST['managerVariance']) > 5){
                         $mailConfigData = $this->config_model->getConfiguration('endShift_mail');
                         if(isset($mailConfigData[0]) && !empty($mailConfigData[0])){
                           $emailTo = unserialize($mailConfigData[0]['data']);
                           $emailSendTo =  (isset($emailTo[0]) && !empty($emailTo[0]) ? $emailTo[0] : 'kaushika@kjcreate.com.au ');
                         }else{
                            $emailSendTo = 'kaushika@aaria.com.au';
                         }
                       
                         $data['managerVariance']= $this->POST['managerVariance'];
                         $data['tillName'] = $this->POST['tillName'];
                         $data['locationName'] = fetchLocationNamesFromIds($this->session->userdata('location_id'),true);
                         $mailContent = $this->load->view('Mail/endShiftVariance',$data,TRUE);
                        $this->sendEmail($emailSendTo, 'Cash Variance', $mailContent,$this->session->userdata('mail_from'));
                         $Notificationmsg = 'End Shift Variance exceeded $5.00 at location '.$this->locationName;  
                       createNotification($this->tenantDb,$this->session->userdata('system_id'),$this->selected_location_id,'alert',$Notificationmsg);

                     }
					  $cashDepositId = $this->POST['cashDepositId'];
				// echo "<pre>"; print_r($cashDepositData); exit;
					$result = $this->cash_model->update_cashD($cashDepositData,$cashDepositId);
					if($result){
					   
					  return redirect(base_url('/Cash/'.$this->session->userdata('system_id')));
					}
			}
			else{  
			    
                $data['cashDepositList'] = $this->cash_model->getCashDepositByID($id,true); // true means it wil bring only todays data date wise
                $data['managerdisabled'] = (isset($data['cashDepositList']['IsManagerfinalSubmissionDone']) && $data['cashDepositList']['IsManagerfinalSubmissionDone'] == 'yes' ? 'disabled' : '');
                $data['staffdisabled'] = (isset($data['cashDepositList']['IsStafffinalSubmissionDone']) && $data['cashDepositList']['IsStafffinalSubmissionDone'] == 'yes' ? 'disabled' : '');
                $data['role_id'] = $this->roles[0]->id;
                $data['tillName'] = $this->common_model->getTillNameByID($id); 
                $this->load->view('general/header');
                $this->load->view('Shift/cashEndShift', $data);
                $this->load->view('general/footer');
			}
			
		}
   
    public function delete(){
        
      $res = $this->cash_model->deleteCashDeposit($this->POST['id']);
		echo $res;
		}
   
   
    

}
?>