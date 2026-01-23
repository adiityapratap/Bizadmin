<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
class Report extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('genric_model');
		$this->load->model('orders_model');
		$this->load->model('common_model');
      !$this->ion_auth->logged_in() ? redirect('auth/login') : '';
      $this->selected_location_id = $this->session->userdata('location_id');
    
	}
	
	function generateReport(){
	    $data['locations']=$this->common_model->fetchRecordsDynamically('Catering_locations');
	    $this->load->view('report/reportForm',$data);
	}
	
function fetchReport(){
    $where = array();

    if (isset($_POST["added_date_from"]) && $_POST["added_date_from"] !='') {
        $added_date_from = trim($_POST["added_date_from"]) == '' ? "1000-01-01" : date("Y-m-d", strtotime($_POST["added_date_from"]));
        $where['Catering_orders.date_added >='] = $added_date_from;
    }

    if (isset($_POST["added_date_to"]) && $_POST["added_date_to"] !='') {
        $added_date_to = trim($_POST["added_date_to"]) == '' ? "9999-12-31" : date("Y-m-d", strtotime($_POST["added_date_to"]));
        $where['Catering_orders.date_added <='] = $added_date_to;
    }

    if (isset($_POST["date_from"]) && $_POST["date_from"] !='') {
        $delivery_date_from = trim($_POST["date_from"]) == '' ? "1000-01-01" : date("Y-m-d", strtotime($_POST["date_from"]));
        $where['Catering_orders.delivery_date >='] = $delivery_date_from;
    }

    if (isset($_POST["date_to"]) && $_POST["date_to"] !='') {
        $delivery_date_to = trim($_POST["date_to"]) == '' ? "9999-12-31" : date("Y-m-d", strtotime($_POST["date_to"]));
        $where['Catering_orders.delivery_date <='] = $delivery_date_to;
    }

    if (isset($_POST["status"]) && $_POST["status"] !='') {
        $where['Catering_orders.status'] = $_POST["status"];
    }

   
        $where['Catering_orders.location_id'] = $this->selected_location_id;
    

    $fieldsToFetch = 'Catering_orders.order_id,coupon.coupon_discount,coupon.type,Catering_orders.date_added,Catering_orders.delivery_date,Catering_orders.order_total,Catering_orders.delivery_fee,Catering_orders.status,Catering_orders.mark_paid_comment,Catering_orders.date_modified';

    $data['reportResults'] = $this->orders_model->fetchOrders($where,$fieldsToFetch);
   $this->load->view('general/header');
    $this->load->view('report/reportList',$data);
    $this->load->view('general/footer');
    
    //  echo "<pre>"; print_r($orderResult); exit;
}

	
	
	
}
?>