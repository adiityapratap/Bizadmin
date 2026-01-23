<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;


class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('notification');
		$this->load->model('EmployeesDeatils_model');
		$this->load->model('employees_model');
		$this->load->model('general_model');
		$this->load->model('dashboard_model');
        $this->load->database();
        $this->lang->load('auth');
        $this->load->helper('language');
    //===========================================================phpmailer start =================================================
	      $this->phpmailermail = new PHPMailer();
	      $this->branch_id = $this->session->userdata('branch_id');
	      $this->type = $this->session->userdata('role');
	     
               
        $this->phpmailermail->isSMTP();
        // $this->phpmailermail->SMTPDebug = 2;
        $this->phpmailermail->Mailer = "smtp";
        $this->phpmailermail->Host     = $this->config->item('Host');
        $this->phpmailermail->SMTPAuth = $this->config->item('SMTPAuth');
        $this->phpmailermail->SMTPSecure = $this->config->item('SMTPSecure');
        $this->phpmailermail->Username = $this->config->item('Username');
        $this->phpmailermail->Password = $this->config->item('Password');
        $this->phpmailermail->Port     = $this->config->item('Port');
        $this->phpmailermail->setFrom($this->config->item('setFrom'), 'Cafeadmin');
				
			  //=========================================================php mailer end ======================================================
    }
    
    function checkEmployeeAttendanceForToday(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        	$employees = $this->dashboard_model->employeeIdList($this->branch_id);
        	
        	foreach($employees as $EmpID){
        	    
        	    	$employeesTodayRoster = $this->dashboard_model->employeeTodayRoster($EmpID);
        	    
        	    
        	}
        

    }
    
}