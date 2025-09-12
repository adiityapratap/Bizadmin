<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->selected_location_id = $this->session->userdata('location_id');
       
    }
    public function email_exists($email) {
    $this->tenantDb->where('email', $email);
    $this->tenantDb->where('status', 1);
    $query = $this->tenantDb->get('Catering_customer');
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
  }

function customerList() {
    // Fetch data from the database
    $this->tenantDb->select('CONCAT(Catering_customer.firstname, " ", Catering_customer.lastname) AS fullname, Catering_locations.location_name, Catering_customer.location_id,Catering_customer.customer_id,Catering_customer.email, Catering_customer.telephone, Catering_company.company_name,Catering_company.company_id, Catering_department.department_name,Catering_department.department_id');
    $this->tenantDb->from('Catering_customer');
    $this->tenantDb->join('Catering_company', 'Catering_customer.company_id = Catering_company.company_id');
    $this->tenantDb->join('Catering_locations', 'Catering_locations.location_id = Catering_customer.location_id');
    $this->tenantDb->join('Catering_department', 'Catering_customer.department = Catering_department.department_id');
    $this->tenantDb->where('Catering_customer.status', 1);
    $query = $this->tenantDb->get();

    $results = $query->result_array();

    return $results;
}

function departmentList() {
    // Fetch data from the database
    $this->tenantDb->select('Catering_department.company_id, Catering_department.department_id,Catering_department.department_name, Catering_company.company_name');
    $this->tenantDb->from('Catering_department');
    $this->tenantDb->join('Catering_company', 'Catering_company.company_id = Catering_department.company_id');
    $this->tenantDb->where('Catering_department.status', 1);
    $query = $this->tenantDb->get();

    if ($query === false) {
        // Log the error message
        log_message('error', 'Database error: ' . $this->tenantDb->error()['message']);
        return false;
    }

    $results = $query->result_array();

    return $results;
}

  
    

}

?>