<?php
class Config extends MY_Controller
{
    public function __construct() 
    {   
        	parent::__construct();
        $this->load->model('common_model');
       $this->location_id = $this->session->userdata('location_id');
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
    }
    
    
    public function saveSettings(){
         $conditionsSettings['location_id'] = $this->location_id;
	     $configData = $this->common_model->fetchRecordsDynamically('Catering_settings', '',$conditionsSettings);
         
        	if(!empty($this->POST)){
        	   $data = array(
                'company_name' => $this->security->xss_clean($this->input->post('company_name')),
                'abn' => $this->security->xss_clean($this->input->post('abn')),
                'company_address' => $this->security->xss_clean($this->input->post('company_address')),
                'account_name' => $this->security->xss_clean($this->input->post('company_bank_account_name')),
                'bsb' => $this->security->xss_clean($this->input->post('company_bsb_number')),
                'account_number' => $this->security->xss_clean($this->input->post('company_account_number')),
                'payment_terms' => $this->security->xss_clean($this->input->post('payment_terms')),
                'contact_email' => $this->security->xss_clean($this->input->post('contact_email')),
                'contact_phone' => $this->security->xss_clean($this->input->post('contact_phone')),
                'merchant_id' => $this->security->xss_clean($this->input->post('merchant_id')),
                'merchant_password' => $this->security->xss_clean($this->input->post('merchant_password')),
                'location_id' => $this->location_id
            );
            if(isset($configData) && !empty($configData)){
              $this->common_model->commonRecordUpdate('Catering_settings', 'location_id',$this->location_id,$data);   
            }else{
             $this->common_model->commonRecordCreate('Catering_settings', $data);   
            }
		    echo "Success";
		  // return redirect(base_url('/Supplier/configuresubmit'));
           }else{
          
          $data['configData'] = (isset($configData) && !empty($configData) ? array_shift($configData) : array());
// echo "<pre>"; print_r(array_shift($configData)); exit;
          $this->load->view('general/header');   
          $this->load->view('Configure/configuration',$data);
          $this->load->view('general/footer');       
        }
    }
    
    
}