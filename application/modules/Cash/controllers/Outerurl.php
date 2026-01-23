<?php
// this controller is to handle all the urls that we send out to customer which doesnt require authentication

class Outerurl extends MY_Controller
{
    
     public function __construct() 
    {   
        	parent::__construct();
        $this->load->model('float_model');
      
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
       
    }
    
   
    
    
}
?>