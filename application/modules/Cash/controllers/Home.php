<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('tills_model');
		$this->load->model('general_model');
	   $this->selected_location_id = $this->session->userdata('location_id');
	   !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
	}
	
	  public function index($system_id='')
      {   
         (isset($system_id) && $system_id !=''  ? $this->session->set_userdata('system_id',$system_id) : '');
         $data['allTills'] = $this->tills_model->get_allActive_tills($this->selected_location_id);
        
          // 9999 -> is global smtp wch can be used as a backup to send email id orifinal smtp of orz. is not working
          $emailSettings = $this->general_model->fetchSmtpSettings($this->selected_location_id,$system_id);
           if(empty($emailSettings)){
           $emailSettings = $this->general_model->fetchSmtpSettings('9999','9999');
           $this->configureSMTP($emailSettings);
          }else{
           if ($emailSettings->mail_protocol === 'smtp') {
          $this->configureSMTP($emailSettings);
          }   
          }
          if(isset($emailSettings->mail_from)){
           $this->session->set_userdata('mail_from',$emailSettings->mail_from);
          }
          
        //   $this->sendEmail('adityakohli467@gmail.com', 'TESTSMTP', 'Mail from bizadmin Cash site',$emailSettings->mail_from);
         
        $data['roleId'] = $this->ion_auth->get_users_groups()->row()->id; 
      	$this->load->view('general/header');
      	$this->load->view('Home/dashboard',$data);
      	$this->load->view('general/footer');
  
    	
        
    }
    
	
}