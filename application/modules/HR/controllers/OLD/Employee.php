<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Employee extends MY_Controller {

    function __construct() {
        parent::__construct();
        !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->location_id = $this->session->userdata('location_id');
    }
    
    function employeeList(){
        echo "fdsds"; exit;
    }
    
    
    
}