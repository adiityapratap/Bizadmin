<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
 
class Admin extends MY_Controller {

    function __construct() {
        parent::__construct(); 
       !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->load->helper('notification');
        $this->load->library('form_validation');
       
		$this->load->model('admin_model'); 
		$this->load->model('general_model');
       
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
       $this->location_id = $this->session->userdata('location_id');
    }
    
   
    function download_employee_list(){
        
	    $branch_id = $this->location_id;
	    $type = $this->session->userdata('role');
		$employees_details = $this->admin_model->get_employees_branchwise($branch_id,$type);

        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
        
          //set heading of excel
      $sheet->setCellValue('A1', 'S.No');
      $sheet->setCellValue('B1', 'Employee Name');
      $sheet->setCellValue('C1', 'Email ');
      $sheet->setCellValue('D1', 'Phone');
      $sheet->setCellValue('E1', 'Employee Type	');
      $sheet->setCellValue('F1', 'Effective Start Date	');
      $sheet->setCellValue('G1', 'Status');
      $sheet->setCellValue('H1', 'Vaccinated');
      $sheet->setCellValue('I1', 'Email View');
      $x = 2;
      foreach($employees_details as $employees_detail){
      	if($employees_detail->agree_terms_one == '1' && $employees_detail->agree_terms_two == '1' && $employees_detail->agree_terms_three == '1'){
			$status = "Completed";
	      }else{
	     $status = "Not Started";
		}    
          
        $sheet->setCellValue('A'.$x, $x-1);
        $sheet->setCellValue('B'.$x, $employees_detail->first_name." ".$employees_detail->last_name);
        $sheet->setCellValue('C'.$x, $employees_detail->email);
        $sheet->setCellValue('D'.$x, $employees_detail->phone);
        $sheet->setCellValue('E'.$x, $employees_detail->employee_type);
        $sheet->setCellValue('F'.$x, $employees_detail->effective_start_date);
        $sheet->setCellValue('G'.$x, $status);
        $sheet->setCellValue('H'.$x, ($employees_detail->vaccination_certificate !='' ? 'Vaccinated' : 'Not vaccinated'));
        $sheet->setCellValue('I'.$x, $employees_detail->tracking_mail); 
  
         $x++;
        
          }

       $writer = new Xlsx($spreadsheet); 
        $filename = 'Employee list';
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
	    
	    
	}
	
    public function ex_employee(){
		$employees = $this->admin_model->get_disbaled_employees($this->location_id);

				foreach($employees as $k => $employee){
					$i = 0;
					$exmail = $employee->email; 
					
					foreach($employee as $key => $val){
					   
					if($val == ''){
						$i = $i+1;
					}
				}
				$employees[$k]->emptyclmn = $i;
				}

				$data['employees'] = $employees;
				
				$data['type'] = '';
				$data['ex_employee_listing'] = 1;
				$this->load->view('general/header');
				$this->load->view('employees/manage_employee',$data);
				$this->load->view('general/footer');
	}
	
    public function selectEmployeeName(){
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
       $keyword = $this->input->post('keyword');
       $branchid = $this->session->userdata('branch_id');
        $branchempResult = $this->admin_model->filter_get_employees_branchwise($branchid,$keyword,'unset','unset');
        
        if(!empty($branchempResult)) { ?>

<ul id="emp-list">
<?php
foreach($branchempResult as $branchemp) {
?>
<li onClick="selectEmployeeName('<?php echo $branchemp->emp_id .'_'.$branchemp->first_name .' '.$branchemp->last_name; ?>');"><?php echo $branchemp->first_name; ?>  <?php echo ' '.$branchemp->last_name; ?></li>
<?php } ?>
</ul>
<?php }  ?>

 <?php        
   // enndddddd   of method
    }
    
   
    
    public function pagination_data_buildup($branch_id,$table_name,$type,$total_records,$link){
        if($type=="employee"){
               $result_data  = $this->admin_model->get_roster_weeks($branch_id,$type,'',$config["per_page"], $this->uri->segment(3));
           }else{
               $result_data  = $this->admin_model->get_roster_weekss($branch_id,$type,'',$config["per_page"], $this->uri->segment(3));
           }
        
    }
    
    public function getrosterreport(){
        
      
       $days = array('Week 1','Week 2','Week 3','Week 4');
        $roleName = $this->ion_auth->get_users_groups()->row()->name;
         
		if($roleName=='employee'){
			   $user_email = $this->ion_auth->user()->row()->email;
				
			 	$id = $this->admin_model->get_emp_details_fromemail($user_email);
			   $type = 'employee';
			}else{
			    $emp_id ='';
			    $type = 'admin';
			    $id = $this->session->userdata('branch_id');
			}
				
		    $roster = $this->admin_model->get_roster_weeks($this->location_id,$type,'dash');
		    
		    
		    $week_days = array('mon','tues','wed','thus','fri','sat','sun');
		    
		    
		     $count =0;
		    foreach($roster as $row){ 
		       
		        $rate = $this->admin_model->get_emp_details_fieldwise($row->emp_id,'rate');
		        $week_earning =  0;
		        for ($i = 0; $i < 7; $i++) {
		          $start_nameofday = $week_days[$i].'_start_time';
                 $end_nameofday = $week_days[$i].'_end_time'; 
                  $break_nameofday = $week_days[$i].'_break_time'; 
                   
                   
                   
                $break_hrs = $row->$break_nameofday;
                $time1 = strtotime($row->$start_nameofday);
                $time2 = strtotime($row->$end_nameofday);
                if($time1 !='' && $time2 !=''){
                $difference = round(abs(($time2 - $time1)) / 3600,2);
                 if($difference !='') {
                $hr_in_min = $difference* 60;
                $difference = $hr_in_min - $break_hrs;
                 }else{
                 $difference = 0;     
                 }
                }else{
                   $difference = 0; 
                }
     
      
      // calculate the per min rate of employee and muliply by total no of minutes worked
      
      $total_pay = (($rate)/60) * $difference;
       
      // convert total mins worked in hrs
       
      $difference = date('G:i', mktime(0, $difference)); 
      

     // sum total earning of the week       
      $week_earning = $week_earning + $total_pay;
		        }
		        
		        $this_week_earning[] = $week_earning;
		        $dataPoints[] = array("label"=> "Week ".$count, "y"=> $week_earning);
	            $count++;
		    }
		echo json_encode($dataPoints);
    }
    
  
     public  function manage_careers() {
        $data['title'] = "Carrer List";
        $careers = $this->admin_model->fetch_careers();
        $data['careers'] = $careers;
            
       
	$this->load->view('general/header');
	$this->load->view('Careers/career_list',$data);
	$this->load->view('general/footer');  
     }
     
     public function manage_applications(){
         
        $data['title'] = "Applications List";
        $applications = $this->admin_model->fetch_applications();
        $data['applications'] = $applications;
        // print_r($applications); exit;
            
       
	$this->load->view('general/header');
	$this->load->view('Careers/applications_list',$data);
	$this->load->view('general/footer'); 
	
     }
     
      public function view_applicants_data($id){
         $applicant_data = $this->admin_model->fetch_applications($id); 
          $data['details'] = $applicant_data;
        //   echo "<pre>";
        // print_r($applicant_data); exit;
            
       
	$this->load->view('general/header');
	$this->load->view('Careers/applicant_view',$data);
	$this->load->view('general/footer'); 
      }
      public  function add_new_job($id='',$type='') {
          $data = array();
          $data['disabled'] = '';
          $data['type'] = $type;
        if($id !=''){
        $careers = $this->admin_model->fetch_careers($id);
        $data['details'] = $careers;
        ($type == 'view' ? $data['disabled'] = 'disabled' :  '');
        } 
            
       
    $this->load->view('general/header');
	$this->load->view('Careers/add_new_job',$data);
	$this->load->view('general/footer'); 
      }
       public  function post_job($id='',$type='') {
           $data=array();
            $data['job_name'] = $this->input->post('job_name');
            $data['salary'] = $this->input->post('salary');
            $data['job_type'] = $this->input->post('job_type');
            $data['job_desc'] = $this->input->post('job_desc');
             $data['responsibilites'] = $this->input->post('responsibilites');
            $data['additional_info'] = $this->input->post('additional_info');
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
         
            $data['date_posted'] = date('Y-m-d');
            $insert_id = $this->admin_model->post_job($data,$id,$type); 
			($id =='' ? $message = 'Job posted succesfully' : $message = 'Job updated succesfully');
			 $this->session->set_flashdata('success', $message);
            redirect("admin/manage_careers", 'refresh');
            
       }
       	public function update_job_status(){
         $status = $this->input->post('status');
			  $id = $this->input->post('id');
			   $data = array(
            	'status' => $status
            	);
			$updated = $this->admin_model->update_job_status($data,$id);
			echo $updated; exit;
	}
       	public function delete_job(){
           $id = $this->input->post('id');
			$delete = $this->admin_model->delete_job($id);
	}
      
   
   
    
    public function send_pin_email(){
        
        if(isset($_POST['employee_email']) && $_POST['employee_email'] !=''){
            $email = trim($_POST['employee_email']);
            $emp_pin = $this->admin_model->get_emp_details_fieldwise($email,'pin','email_id');
            $first_name = $this->admin_model->get_emp_details_fieldwise($email,'first_name','email_id');
            
             $html = '<html> <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <title></title> 
    </head> 
    <body> 
    <p>Hello '. $first_name.',</p>
     <p> Welcome to your HR portal.</p
    <p> Please see your timesheet pin number below and use the login pin to clock in and clock out.</p>
   
      <p><span>Pin Number - : '.(($emp_pin) ? $emp_pin : "No Pin Exist").' </span></p>
    <p>Please contact your manager if you have any queries.</p>
        <span>Kind Regards,</span>
         <span>HR Team.</span>
         <p><b>Disclaimer: </b> Do not share your pin number with anyone.</p>
         </body> 
         </html>';
                
                $email = (($email) ? $email : 'aditkohli786@gmail.com');
             
		        $subject = "HR Timesheet Pin Number";
	
				
				//Phpmailer ============================================================
					 $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = $subject;
                     $this->phpmailermail->Body = $html;
                     $this->phpmailermail->send();
					
			 
			   echo "Sent";
		
          
        }else{
          
            $menu_items = $this->display_menu();
		
        $this->load->view('general/header');
        $this->load->view('auth/send_pin'); 
        }
        

		
		  
         
    }
     public  function send_cred_email() {
         ob_clean();
        if(isset($_POST['emp_id']) && $_POST['emp_id'] !=''){
            $emp_id = $_POST['emp_id'];
            $res = $this->send_onboarding_form($emp_id);
           
        }elseif(isset($_POST['employee_email']) && $_POST['employee_email'] !=''){
            $email = trim($_POST['employee_email']);
            $emp_id = $this->admin_model->get_emp_details_fieldwise($email,'emp_id','email_id');
            echo $emp_id;
        }else{
        $menu_items = $this->display_menu();
		
        $this->load->view('general/header');
        $this->load->view('auth/send_cred_email');
        }
    }
    public function send_onboarding_form($emp_id=''){
        $this->tenantDb->select('*');
		$this->tenantDb->from('HR_employee');
	   // mail('adityakohli467@gmail.com','testhr','HRM');
	   // exit;
// 		$this->db->where('status',1);
// 		$this->db->where('branch_id',57);
        $this->tenantDb->where('emp_id',$emp_id);
// 		$this->db->where('email','kaushika@kjcreate.com.au');
		$query = $this->tenantDb->get();
		$footscray_users = $query->result();

	    $i=0;
        foreach($footscray_users as $footscray_user){ 
        $html = '<html> <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <title></title> 
    </head> 
    <body> 
    <p>Hello '. $footscray_user->first_name.' ,</p>
    <p> Welcome to your new HR Portal for Zouki.</p>
    In this portal you will be able to check your rosters and timesheets,<br>
    communicate with the management, update your employee and leave details as<br>
    well as submit any compliance forms required by Cafe admin.
   <br><br>
      <span>To set up your account please complete your onboarding by clicking below button: </span><br><br>
      </br>
      <a href="https://www.cafeadmin.com.au/HR/index.php/admin/onboarding_process/'.$emp_id.'" style="text-decoration:none;cursor:pointer;"><button style="cursor:pointer;display: block;width: 250px;height: 45px;background: #4caf50;padding: 4px;text-align: center;border-radius: 5px;color: #fff;font-weight: bold;line-height: 25px;border: 0;font-size: 18px;">Complete Onboarding</button></a><br></br>
       
        <p>Please contact your manager if you have any queries.</p>
        <span>Kind Regards,</span><br></br>
         <span>HR Team</span>
         </body> 
         </html>';
         
                $email = $footscray_user->email;
		        $subject = "Cafe Admin - Welcome to HR management";
	
             
					  $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = $subject;
                     $this->phpmailermail->Body = $html;
                     $this->phpmailermail->send();
					
			 
			   echo "Sent";
			 
			  $i++;
        }
		exit;	  
         
    }
    public function onboarding_process($id){
        
            $updateData=array(
                'tracking_mail' => 'Yes',
                );
		  $updateEmail = $this->admin_model->email_view_update($id,$updateData);
		 
          $employee = $this->admin_model->get_emp_update($id);
         
          $employee_uniform = $this->admin_model->get_emp_uniform($id);
         
		 
          $data['employee'] = $employee; 
          $data['role'] = $role; 
          $data['userID'] = $this->session->userdata('user_id');
          $data['employee_uniform'] = $employee_uniform;
          
          if($employee[0]->onboarding_status == 1){
              redirect('auth/login/employee');
		    }
        //   $this->load->view('general/header');
		  $this->load->view('employees/onboarding_process',$data);
		  //$this->load->view('general/footer');
		
    }
   
    public function submit_onboarding_process(){
   	
            // echo "<pre>";print_r($this->input->post());exit;
    
		
            $id = $this->input->post('emp_id');
            if (!empty($_FILES['police']['name'])){
                $uploaded_files =  array(
                    'police' => isset($_FILES['police']['name'])  ? $_FILES['police']['name']  :  '',
                    );
    	}
                // echo "<pre>";print_r($_FILES['police']['name']);exit;
        if(!empty($uploaded_files)) {
          
           
        foreach($uploaded_files as $key=>$values){
            
            if(isset($values) && $values !=''){
               
                 $config['upload_path'] = './uploaded_files/';
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
                 $config['max_size'] = 200000;
                 $config['max_width'] = 20000;
                 $config['max_height'] = 20000;
                 $new_name = uniqid().'_'.$_FILES[$key]['name'];
                 $new_name = preg_replace('/\s+/', '_', $new_name);
                 
                 $config['file_name'] = $new_name;

                 $this->load->library('upload', $config);

                 

                if (!$this->upload->do_upload($key, $new_name)) {
          
                $error = array('error' => $this->upload->display_errors());
                 
                $this->session->set_flashdata('error_msg', $error['error']);
                   echo "err";
                } else{
                    
                    '$'.$$key = $new_name;
                    
                    //   echo "elsenn==".$new_name; exit;
                }
                }
            else{
            '$'.$$key = '';
            }
        }
        }
           
            
            // $dob = $this->input->post('dob');
            
             $posted_data = $this->input->post();
             foreach($posted_data as $key=> $valuue){
                 if( $key == 'check_tfn_type'){
                     
                 }
                 else{
                     ($valuue !='' ? $data_user[$key] = $valuue : '');
                 }
              
             }
             
            
		         $data_user['surname'] = '';
		         if($this->input->post('check_tfn_type') == 'tfn_number'){
		             $data_user['tfn_type'] = '';
		         }
		         else{
		            $data_user['tfn_number'] = '';
		         }
		        
		      //   $data_user['dob'] = $dob;
		      //   $data_user['fire_emg_completed_date'] = $fire_emg_completed_date;
		      //   $data_user['oh_s_completed_date'] = $oh_s_completed_date;
		    
				
				if($tax_declaration !=''){
				   $data_user['tax_declaration'] = $tax_declaration;
				}
				if($completed_super_annu !=''){
				   $data_user['completed_super_annu'] = $completed_super_annu;
				}
				if($advice_of_tax_file !=''){
				   $data_user['advice_of_tax_file'] = $advice_of_tax_file;
				}
				if($quality_assurance !=''){
				   $data_user['quality_assurance'] = $quality_assurance;
				}
				if($police !=''){
				   $data_user['police_certificate'] = $police;
				}
				if($vaccination_certificate !=''){
				   $data_user['vaccination_certificate'] = $vaccination_certificate;
				}
				
			
				// if($this->input->post('password') != ''){
				// $user_pass = $this->input->post('password');
    //             $result = $this->ion_auth_model->update_pass($user_pass,$id,'employee');
				// }

    
                if($this->input->post('agree_terms_one') == '1'){
			        
                    $data_user['updated_at'] = date("Y-m-d");
                    $data_user['status'] = 1;
                    $data_user['onboarding_status'] = 1;
                }
                // echo "<pre>";print_r($data_user);exit;
            // $update_user_uniform = $this->admin_model->update_employee_uniform($uniform_data_emp,$id);
			$update_user = $this->admin_model->update_employee($data_user,$id);
				// echo $this->db->last_query();exit;
				// echo "a== ".$this->input->post('agree_terms_one'); exit;
			
			if($update_user){
			   
			    if($this->input->post('agree_terms_one') == '1'){
                    $branch_id = $this->admin_model->get_emp_details_fieldwise($id,'branch_id');
                    add_notification('emp_update','manager',$id);
    			     
    			     $employee_data = $this->send_credential_email($id);
                    
                    
                    $branches = $this->admin_model->fetch_branches($branch_id);
                    $location = $branches[0]->branch_name;
        		    $empname = $employee_data[0]->first_name.' '.$employee_data[0]->last_name;
        		    $empEmail = $employee_data[0]->email;
        			    
        			$html = '<html> <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <title></title> 
                    </head> 
                    <body> 
                    <p>Hi HR team,</p>
                    <p> Onboarding of  '.$empname.' ('.$location.') has been completed. Please ensure the documents uploaded are correct.</p>
                    
                    <p><a href="https://www.cafeadmin.com.au/HR/index.php/auth/homepage">Click here to login your portal</a></p>
                      <p>Kind Regards,<br></br>
                      Cafeadmin</p>
                
                     
                         </body> 
                         </html>'; 
                  
                            // $emails = array(
                            //     'kaushika@1800mycatering.com.au',
                            //     );
                        $email = 'kaushika@1800mycatering.com.au';
                        $email1 = 'hr@zoukiaccounts.com.au';
                        $email2 = 'wang@zoukiaccounts.com.au';
                        // $email = 'mqaddarkasikandar@gmail.com';
                        // $email = 'adityakohli467@gmail.com';
        		        $subject = "New Onboarding Form Submitted";
        	                 $this->phpmailermail->ClearAddresses();
        					 $this->phpmailermail->isHTML(true);
        					 $this->phpmailermail->addAddress($email1);
        					 $this->phpmailermail->addAddress($email2);
        				     $this->phpmailermail->addCC($email);
        				     $this->phpmailermail->addCC($empEmail);
                             $this->phpmailermail->Subject = $subject;
                             $this->phpmailermail->Body = $html;
                             $this->phpmailermail->send();
                             
                        // add_notification('feedback','manager',$id);
			    }
		  
        					
			     
// 			$emp_info = $this->admin_model->get_emp_update($id);
		

			echo "success";
				// $this->session->set_flashdata('sucess_msg', 'Employee information has been sucessfully updated');
				
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update Employee');
			}
			
		  //  redirect('/admin/onboarding_process/'.$id);
		  
		          //$this->load->view('general/footer');
	
      
	}
	
// 	resume
    public function resumes(){
        $dataFilter = array();
        if(isset($_REQUEST['candidate_name']) && $_REQUEST['candidate_name'] != 'unset'){
            $dataFilter['candidate_name'] = $_REQUEST['candidate_name'];
        }
        if(isset($_REQUEST['phone']) && $_REQUEST['phone'] != 'unset'){
            $dataFilter['phone'] = $_REQUEST['phone'];
        }
        if(isset($_REQUEST['email']) && $_REQUEST['email'] != 'unset'){
            $dataFilter['email'] = $_REQUEST['email'];
            
            echo "<pre>";print_r($dataFilter);
        }
        
      
	      
      
      $resumes = $this->admin_model->get_resumes('',$dataFilter); 
     
      $data['resumes'] = $resumes;
      if(!empty($dataFilter)){
          echo json_encode($resumes);
      }else{
            //   echo "<pre>";print_r($data);exit;
          $this->load->view('general/header');
    	  $this->load->view('employees/resumes',$data);
    	  $this->load->view('general/footer');
        }
    		
    }
    public function resume_view($resume_id = ''){
            
            
        
        if($resume_id != ''){
            $resume = $this->admin_model->get_resumes($resume_id,''); 
             
              $data['resume'] = $resume;
              $data['form'] = 'view';
        }
        // echo "<pre>";print_r($data);exit;
        
            $this->load->view('general/header');
    		$this->load->view('employees/resume_form',$data);
    		$this->load->view('general/footer');
        
        	
    }
    public function resume_del($resume_id = ''){
        if($resume_id != ''){
            $resume = $this->admin_model->resume_del($resume_id); 
           if($resume){
				$this->session->set_flashdata('sucess_msg', 'Resume deleted sucessfully');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to delete the resume');
			}  
        }
        redirect('admin/resumes');	
    }
    public function resume_form($resume_id = ''){
            
            
        
        if($resume_id != ''){
            $resume = $this->admin_model->get_resumes($resume_id,''); 
             
              $data['resume'] = $resume;
              $data['form'] = 'edit';
              
        }else{
            $data['form'] = 'add';
        }
        
        // echo "<pre>";print_r($data);exit;
        
            $this->load->view('general/header');
    		$this->load->view('employees/resume_form',$data);
    		$this->load->view('general/footer');
        
        	
    }
    public function resume_form_submit(){
            
            
        
        
         
        if($_POST['resume_id'] != ''){
            $resume_id = $_POST['resume_id'];
            $data = array(
                'candidate_name' => $_POST['candidate_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'job_role' => $_POST['job_role'],
                'notes' => $_POST['notes'],
                'date_updated' => date('Y-m-d')
             );
            $target_dir = 'assets/job_resumes/';
            if($_FILES['resume']['name'] != ''){
                
    		  	$userfile_name = $_FILES['resume']['name'];
                $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
    		  	$file_name = 'resume_'.rand('10000','99999');
    		  	$i = ".";
                $resume_file_name=$file_name.$i.$userfile_extn;
                $target_file = $target_dir . $resume_file_name;
                $file = move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
                $data['resume'] = $resume_file_name;
            }
            if($_FILES['cover_letter']['name'] != ''){
                
    		  	$userfile_name1 = $_FILES['cover_letter']['name'];
                $userfile_extn1 = substr($userfile_name1, strrpos($userfile_name1, '.')+1);
    		  	$file_name1 = 'cover_letter_'.rand('10000','99999');
    		  	$j = ".";
                $cover_letter_file_name=$file_name1.$j.$userfile_extn1;
                $target_file1 = $target_dir . $cover_letter_file_name;
                $file1 = move_uploaded_file($_FILES["cover_letter"]["tmp_name"], $target_file1);
                $data['cover_letter'] = $cover_letter_file_name;
            }
            
            
            //  echo "<pre>";print_r($data);
            $result = $this->admin_model->submitResume($data,$resume_id,'update');
            if($result){
				$this->session->set_flashdata('sucess_msg', 'Resume has been sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update the resume');
			} 
        }
        else{
            $target_dir = 'assets/job_resumes/';
            if($_FILES['resume']['name'] != ''){
                
    		  	$userfile_name = $_FILES['resume']['name'];
                $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
    		  	$file_name = 'resume_'.rand('10000','99999');
    		  	$i = ".";
                $resume_file_name=$file_name.$i.$userfile_extn;
                $target_file = $target_dir . $resume_file_name;
                $file = move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
            }
            if($_FILES['cover_letter']['name'] != ''){
                
    		  	$userfile_name1 = $_FILES['cover_letter']['name'];
                $userfile_extn1 = substr($userfile_name, strrpos($userfile_name, '.')+1);
    		  	$file_name1 = 'cover_letter_'.rand('10000','99999');
    		  	$j = ".";
                $cover_letter_file_name=$file_name1.$j.$userfile_extn1;
                $target_file1 = $target_dir . $cover_letter_file_name;
                $file1 = move_uploaded_file($_FILES["cover_letter"]["tmp_name"], $target_file1);
            }
            $branch_id = $this->location_id;
            $data = array(
                'branch_id' => $branch_id,
                'candidate_name' => $_POST['candidate_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'job_role' => $_POST['job_role'],
                'resume' => $resume_file_name,
                'cover_letter' => $cover_letter_file_name,
                'notes' => $_POST['notes'],
                'date_added' => date('Y-m-d')
             );
            //  echo "<pre>";print_r($data);
             
            $result = $this->admin_model->submitResume($data,'','create');
            if($result){
				$this->session->set_flashdata('sucess_msg', 'Resume has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the resume');
			} 
            
        }
        	
    		redirect('admin/resumes');
    }
        
// 	survey
    public function survey_list(){
            
            
            $branch_id = $this->location_id;
    		      
              
              $survey = $this->admin_model->get_all_survey($branch_id); 
            
    		 
              $data['survey'] = $survey;
              
            //   echo "<pre>";print_r($data);exit;
              $this->load->view('general/header');
    		  $this->load->view('employees/survey_list',$data);
    		  $this->load->view('general/footer');
    		
    }
    public function view_survey_form($id){
            
            // $id = $this->session->userdata('user_id');
            $branch_id = $this->location_id;
    		      
              
              $survey = $this->admin_model->get_survey($id,$branch_id);
            //  	echo $this->db->last_query();exit;
    		 
              $data['survey'] = $survey;
              
            //   echo "<pre>";print_r($data);exit;
              $this->load->view('general/header');
    		  $this->load->view('employees/survey',$data);
    		  $this->load->view('general/footer');
    		
        }
    public function survey_form(){
            
            $id = $this->ion_auth->user()->row()->id;
              $survey = $this->admin_model->get_survey($id);
            $data['survey'] = $survey;
              $this->load->view('general/header');
    		  $this->load->view('employees/survey',$data);
    		  $this->load->view('general/footer');
    		
        }
    public function submit_survey_form(){
   	  $posted_data = $this->input->post();
                 foreach($posted_data as $key=> $valuue){
                         ($valuue !='' ? $data[$key] = $valuue : '');
                 }
            $id=$this->ion_auth->user()->row()->id;
            $data['emp_id']=$id;
            
            $data['submitted_at'] = date("Y-m-d");
            $data['status'] = 1;
            $data['updated_at_IP'] = $_SERVER['REMOTE_ADDR'];
            
			$emp = $this->admin_model->get_employees_branchwise($id);
			 // echo "<pre>";print_r($emp);exit;
			 
			$data['branch_id']= $emp[0]->branch_id;
// 			if($emp[0]->branch_id == 61 && $id == 295){
// 			    echo $data['updated_at_IP'];
// 			}
			$insert_survey = $this->admin_model->save_survey($data);
				// echo $this->db->last_query();exit;
			
			if($insert_survey){
			    echo "success";	
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update Employee');
			}
			
	
      
	}
	
   
    
    
    
    public function employee_filter(){
          
        $name=  $this->input->post('name');
        $phone = $this->input->post('phone');
        $email =  	$this->input->post('email');
        $is_ex_employee_listing =  	$this->input->post('is_ex_employee_listing');
        	
        $branch_id = $this->location_id;
        
		$type = $this->ion_auth->get_users_groups()->row()->name;
		
	    if($is_ex_employee_listing == 1){
	        $employees = $this->admin_model->filter_get_disabled_employees_branchwise($branch_id,$name,$phone,$email);
	    }
	    else{
	        $employees = $this->admin_model->filter_get_employees_branchwise($branch_id,$name,$phone,$email);
	    }
	   
	    $base_url  = base_url();
	   if(!empty($employees)){
	       $table ='';
	   	foreach($employees as $k => $employee){
					$i = 0;
					foreach($employee as $key => $val){
					if($val == ''){
						$i = $i+1;
					}
				}
				$employees[$k]->emptyclmn = $i;
			  if($employee->agree_terms_one == '1' && $employee->agree_terms_two == '1' && $employee->agree_terms_three == '1'){
								$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block'";						
								  $btn_name = "Completed";
							
							}else{
							    $color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block'";
							 	$btn_name = "Not Started";
							}
				
				$table .= '<tr class="tr odd" role="row">';
				$table .='<td class="text-left"><a href='. $base_url. 'index.php/admin/update_employee/'. $employee->emp_id.'>'.$employee->first_name.' '.$employee->last_name.'</a>'.'</td>';
                $table .='<td class="text-left">'. $employee->email.'</td>';
                $table .='<td class="text-center">'. $employee->phone.'</td>';
                $table .='<td class="text-center" style="text-transform: uppercase;">'. $employee->employee_type.'</td>';
                if($employee->effective_start_date == '00-00-0000' || $employee->effective_start_date == '0000-00-00'){ $dateeffective_start_date = ''; }else{ $dateeffective_start_date = date("d-m-Y",strtotime($row->effective_start_date)); }
                $table .='<td class="text-center">'. $effective_start_date.'</td>';
                $table .='<td class="text-center"><div '. $color.'>'.$btn_name.'</div></td>';
                 if($employee->vaccination_certificate != ''){ $vaccination_certificate = 'Yes'; }else{ $vaccination_certificate = 'No'; }
                $table .='<td class="text-center">'. $vaccination_certificate.'</td>';
                if($employee->tracking_mail != ''){ $tracking_mail = $employee->tracking_mail; }else{ $tracking_mail = 'No'; }
                $table .='<td class="text-center">'.$tracking_mail.'</td>';
                $table .='<td  class="text-center" style="width:150px;">';
                if( $employee->fingerprint_auth_status == 1) {
                            
                    $table .='<input type="checkbox" class="toggle-demo" id="'.$employee->emp_id.'" checked data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">';
                } else { 
                          
                 $table .='<input type="checkbox" class="toggle-demo" id="'.$employee->emp_id .'"  data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">';

                  } 
                
                $table .='</td>';
                if($is_ex_employee_listing == 1){
        	         $table .='<td class="text-center"><a><type="button" onclick="revert_delete_row('.$employee->emp_id.');"><span class="glyphicon glyphicon-remove"></span> Revert</type="button"></a></td>';
        	    }
        	    else{
        	       $table .='<td class="text-center"><a><type="button" onclick="delete_row('.$employee->emp_id.');"><span class="glyphicon glyphicon-remove"></span> Delete</type="button"></a></td>';
        	    }
               
                
                $table .='</tr>';
				
	   }
	   
	        echo $table; exit;
	   }
	  
				// $data['employees'] = $employees;
				// 
				// $data['type'] = $type;
				// $this->load->view('general/header');
				// $this->load->view('employees/manage_employee',$data);
				// $this->load->view('general/footer');
    }
	
    public function add_employee(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->location_id;
		    $roles=$this->admin_model->fetch_role($branch_id);
		    $departments=$this->admin_model->fetch_record('emp_department',$branch_id);
		    $data['roles'] = $roles;
		    $data['departments'] = $departments;
		    
			
			$this->load->view('general/header');
			$this->load->view('employees/add_employee',$data);
			$this->load->view('general/footer');
		}
	}
	
   public function submit_employee(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		  
			$this->form_validation->set_rules('first_name','first_name','trim|required');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[employee.email]');
            $this->form_validation->set_message('is_unique', 'Another user exists with the same email id');
		  if ($this->form_validation->run() == true) {
           $branch_id = $this->location_id;
		   
		    $target_dir = 'assets/job_desc/';
		  	$userfile_name = $_FILES['job_desc']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
		  	$file_name = 'job_'.rand('10000','99999');
		  	//$file_name = $_FILES["resume"]["name"];
		  	$i = ".";
            $final_file_name=$file_name.$i.$userfile_extn;
            $target_file = $target_dir . $final_file_name;
            $file = move_uploaded_file($_FILES["job_desc"]["tmp_name"], $target_file);
		   
			$data=array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'pin' => $this->input->post('pin'),
			'rate' => $this->input->post('rate'),
			'department' => $this->input->post('department'),
			'role' => $this->input->post('role'),
			'rate' => $this->input->post('rate'),
			'Saturday_rate' => $this->input->post('Saturday_rate'),
			'Sunday_rate' => $this->input->post('Sunday_rate'),
			'holiday_rate' => $this->input->post('holiday_rate'),
			'branch_id' => $branch_id,
			'job_desc' => $final_file_name,
			'manager_id' => $this->session->userdata('user_id'),
			'manager_email' => $this->session->userdata('email'),
			'manager_name' => $this->session->userdata('username'),
			'status' => 1,
			'created_at' => date("Y-m-d")
			
			);
			//echo '<pre>';print_r($data);exit;
		    $insert_id = $this->admin_model->add_employee($data);

			$data_user_groups = array(
				'user_id' => $insert_id,
				'group_id' => '2'
				); 
				$user_groups = $this->admin_model->user_group_insert($data_user_groups);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Employee has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Employee');
			}
		    redirect('admin/manage_employee');
		}else{
			 
				
			$this->load->view('general/header');
			$this->load->view('employees/add_employee');
			$this->load->view('general/footer');
		}
      }
	}
	
	public function update_employee($id){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->location_id;
		     $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles;
          $employee = $this->admin_model->get_emp_update($id);
          $roleName = $this->ion_auth->get_users_groups()->row()->name;
        
          $employee_uniform = $this->admin_model->get_emp_uniform($id);
          
          $data['branch_id'] = $branch_id;
		  
          $data['employee'] = $employee;
          $data['role'] = $roleName; 
          $data['userID'] = $this->session->userdata('user_id');
          $data['employee_uniform'] = $employee_uniform;
          
        //   if($branch_id == '61'){
            //   echo "<pre>";print_r($employee);exit;
        //   }
          $this->load->view('general/header');
          $this->load->view('employees/updateEmpTab',$data);
		  //$this->load->view('employees/update_employee',$data);
		  $this->load->view('general/footer');
		}
      }	
      
    public function view_employee($id){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->location_id;
		     $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles;
          $employee = $this->admin_model->get_emp_update($id);
          $roleName = $this->ion_auth->get_users_groups()->row()->name;
        
          $employee_uniform = $this->admin_model->get_emp_uniform($id);
          
          $data['branch_id'] = $branch_id;
		  
          $data['employee'] = $employee;
          $data['role'] = $roleName; 
          $data['userID'] = $this->session->userdata('user_id');
          $data['employee_uniform'] = $employee_uniform;
          
        //   if($branch_id == '61'){
            //   echo "<pre>";print_r($employee);exit;
        //   }
          $this->load->view('general/header');
          $this->load->view('employees/view_employee',$data);
		  //$this->load->view('employees/update_employee',$data);
		  $this->load->view('general/footer');
		}
      }
      
      public function edit_employee_job_desc($id){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->location_id;
		     $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles;
          $employee = $this->admin_model->get_emp_update($id);
          $roleName = $this->ion_auth->get_users_groups()->row()->name;
         
          $employee_uniform = $this->admin_model->get_emp_uniform($id);
          
          $data['branch_id'] = $branch_id;
		  
          $data['employee'] = $employee;
          $data['role'] = $roleName;
          $data['employee_uniform'] = $employee_uniform;
          $this->load->view('general/header');
		  $this->load->view('employees/edit_employee_job_desc',$data);
		  $this->load->view('general/footer');
		}
      }
      
      public function update_employee_job_desc(){
   			if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $id = $this->input->post('emp_id');
		    
		    if(isset($_FILES['job_desc']['name']) && $_FILES['job_desc']['name'] !=''){
		    $target_dir = 'assets/job_desc/';
		  	$userfile_name = $_FILES['job_desc']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
		  	$file_name = 'job_'.rand('10000','99999');
		  	//$file_name = $_FILES["resume"]["name"];
		  	$i = ".";
            $final_file_name=$file_name.$i.$userfile_extn;
            $target_file = $target_dir . $final_file_name;
            $file = move_uploaded_file($_FILES["job_desc"]["tmp_name"], $target_file);
		   
			$data=array(
				'job_desc' => $final_file_name
			);
			
                $this->admin_model->update_employee_job_desc($data,$id);
                }
            else{
            
            }
		    
           redirect('admin/manage_employee');
		}
      }
	
	public function submit_update_employee(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{


			$this->form_validation->set_rules('first_name','first_name','trim|required');
          
		  if ($this->form_validation->run() == true) {
            $id = $this->input->post('emp_id');

            $uploaded_files =  array(
                'police' => isset($_FILES['police']['name'])  ? $_FILES['police']['name']  :  '',
                'tax_declaration' => isset($_FILES['tax_declaration']['name'])  ? $_FILES['tax_declaration']['name']  :  '',
                'completed_super_annu' => isset($_FILES['completed_super_annu']['name'])  ? $_FILES['completed_super_annu']['name']  :  '' ,
                'advice_of_tax_file' => isset($_FILES['advice_of_tax_file']['name'])  ? $_FILES['advice_of_tax_file']['name']  :  '',
                'quality_assurance' => isset($_FILES['quality_assurance']['name'])  ? $_FILES['quality_assurance']['name']  :  '',
                 'vaccination_certificate' => isset($_FILES['vaccination_certificate']['name'])  ? $_FILES['vaccination_certificate']['name']  :  '',
                 );
                
        if(!empty($uploaded_files)) {
          
           
        foreach($uploaded_files as $key=>$values){
            
            if(isset($values) && $values !=''){
               
                 $config['upload_path'] = './uploaded_files/';
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
                 $config['max_size'] = 200000;
                 $config['max_width'] = 20000;
                 $config['max_height'] = 20000;
                 $new_name = uniqid().'_'.$_FILES[$key]['name'];
                 $new_name = preg_replace('/\s+/', '_', $new_name);
                 
                 $config['file_name'] = $new_name;

                 $this->load->library('upload', $config);

                 '$'.$$key = $new_name;
                 
                if (!$this->upload->do_upload($key, $new_name)) {
          
                $error = array('error' => $this->upload->display_errors());
                 
                $this->session->set_flashdata('error_msg', $error['error']);
                redirect('admin/update_employee/'.$id);
                } else{
                    //   echo "elsenn==".$new_name; exit;
                }
                }
            else{
            '$'.$$key = '';
            }
        }
        }
      

                 $dob = $this->input->post('dob');
                 $fire_emg_completed_date = $this->input->post('fire_emg_completed_date');
                 $oh_s_completed_date = $this->input->post('oh_s_completed_date');
         

                 $uniform_data_emp = array(
                'id' =>$id,
		    	'Green_Polo_Shirt_S_qty' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty'],
		    	'Green_Polo_Shirt_S_total' =>$this->input->post('uniform')['Green_Polo_Shirt_S_total'],
		    	'Green_Polo_Shirt_M_qty' =>$this->input->post('uniform')['Green_Polo_Shirt_M_qty'],
		    	'Green_Polo_Shirt_S_qty_M_total' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_M_total'],
		    	'Green_Polo_Shirt_S_qty_L_qty' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_L_qty'],
		    	'Green_Polo_Shirt_S_qty_L_total' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_L_total'],
		    	'Green_Polo_Shirt_S_qty_XL_qty' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_XL_qty'],
		    	'Green_Polo_Shirt_S_qty_XL_total' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_XL_total'],
		    	'Green_Polo_Shirt_S_qty_XXL_qty' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_XXL_qty'],
		    	'Green_Polo_Shirt_S_qty_XXL_total' =>$this->input->post('uniform')['Green_Polo_Shirt_S_qty_XXL_total'],
		    	'Contemporary_Shirt_S_qty' =>$this->input->post('uniform')['Contemporary_Shirt_S_qty'],
		    	'Contemporary_Shirt_S_total' =>$this->input->post('uniform')['Contemporary_Shirt_S_total'],
		    	'Contemporary_Shirt_M_qty' =>$this->input->post('uniform')['Contemporary_Shirt_M_qty'],
		    	'Contemporary_Shirt_M_total' =>$this->input->post('uniform')['Contemporary_Shirt_M_total'],
		    	'Contemporary_Shirt_L_qty' =>$this->input->post('uniform')['Contemporary_Shirt_L_qty'],
		    	'Contemporary_Shirt_L_total' =>$this->input->post('uniform')['Contemporary_Shirt_L_total'],
		    	'Contemporary_Shirt_XL_qty' =>$this->input->post('uniform')['Contemporary_Shirt_XL_qty'],
		    	'Contemporary_Shirt_XL_total' =>$this->input->post('uniform')['Contemporary_Shirt_XL_total'],
		    	'Contemporary_Shirt_XXL_qty' =>$this->input->post('uniform')['Contemporary_Shirt_XXL_qty'],
		    	'Contemporary_Shirt_XXL_total' =>$this->input->post('uniform')['Contemporary_Shirt_XXL_total'],
		    	'Cap_Suede_Twill_Brown_onesize_qty' =>$this->input->post('uniform')['Cap_Suede_Twill_Brown_onesize_qty'],
		    	'Cap_Suede_Twill_Brown_onesize_total' =>$this->input->post('uniform')['Cap_Suede_Twill_Brown_onesize_total'],
		    	'Chef_Hat_Custom_Brown_onesize_qty' =>$this->input->post('uniform')['Chef_Hat_Custom_Brown_onesize_qty'],
		    	'Chef_Hat_Custom_Brown_onesize_total' =>$this->input->post('uniform')['Chef_Hat_Custom_Brown_onesize_total'],
		    	'Bib_Apron_Custom_Brown_onesize_qty' =>$this->input->post('uniform')['Bib_Apron_Custom_Brown_onesize_qty'],
		    	'Bib_Apron_Custom_Brown_onesize_total' =>$this->input->post('uniform')['Bib_Apron_Custom_Brown_onesize_total'],
		    	'Continental_Apron_Custom_Brown_onesize_qty' =>$this->input->post('uniform')['Continental_Apron_Custom_Brown_onesize_qty'],
		    	'Continental_Apron_Custom_Brown_onesize_total' =>$this->input->post('uniform')['Continental_Apron_Custom_Brown_onesize_total'],
		    	  
				);

             $posted_data = $this->input->post();
             foreach($posted_data as $key=> $valuue){
                if($key !='check_tfn_type'){
                  ($valuue !='' && $key !='password'    && $key !='emp_id' && $key !='required_docs_name'  ? $data_user[$key] = $valuue : '');   
                }
             
             }
             
            
		         $data_user['surname'] = '';
		         $data_user['dob'] = $dob;
		         
		        
                 $data_user['last_updated_at'] = date("Y-m-d");
		         $data_user['last_updated_by']  =  $this->session->userdata('email');
		         $data_user['fire_emg_completed_date'] = $fire_emg_completed_date;
		         $data_user['oh_s_completed_date'] = $oh_s_completed_date;
		    
				
				if($tax_declaration !=''){
				   $data_user['tax_declaration'] = $tax_declaration;
				}
				if($completed_super_annu !=''){
				   $data_user['completed_super_annu'] = $completed_super_annu;
				}
				if($advice_of_tax_file !=''){
				   $data_user['advice_of_tax_file'] = $advice_of_tax_file;
				}
				if($quality_assurance !=''){
				   $data_user['quality_assurance'] = $quality_assurance;
				}
				if($police !=''){
				   $data_user['police_certificate'] = $police;
				}
				if($vaccination_certificate !=''){
				   $data_user['vaccination_certificate'] = $vaccination_certificate;
				}
				
			
				if($this->input->post('password') != ''){
				$user_pass = $this->input->post('password');
			
                $result = $this->ion_auth_model->update_pass($user_pass,$id,'employee');
                
				}
		  //    echo $id; 
		  //   echo "<pre>";
    //          print_r($data_user);
    //          exit;

            $update_user_uniform = $this->admin_model->update_employee_uniform($uniform_data_emp,$id);
			$update_user = $this->admin_model->update_employee($data_user,$id);
    // 		if($this->session->userdata('branch_id') != '61'){
    		  // echo $this->db->last_query();exit;
    		  //echo $update_user; exit;
    			if($update_user){
    			    
    			 //   if(!empty($_FILES['required_docs']['name'])){
    			 //       $total = $_FILES['required_docs']['name'];
    			 //       for($i=0; $i<$total; $i++){ 
    			 //           $new_name = uniqid().'_'.$_FILES['required_docs']['name'][$i];
        //                     $new_name = preg_replace('/\s+/', '_', $new_name);
                             
        //                     $config['file_name'] = $new_name;
        //                     $this->load->library('upload', $config);
        //                     if (!$this->upload->do_upload('required_docs', $new_name)) {
        //                         echo "error";
        //                         // $error = array('error' => $this->upload->display_errors());
                                 
        //                         // $this->session->set_flashdata('error_msg', $error['error']);
        //                     }else{
        //                          echo "success";
        //                     }
    			 //       }
    			 //      exit; 
    			 //   }
    			    
    			    
    			 //add_notification('emp_update','manager',$id);    
    // 			$emp_info = $this->admin_model->get_emp_update($id);
    			
    // 	        $to = $emp_info[0]->manager_email;
    // 	        $name = $emp_info[0]->first_name .''. $emp_info[0]->last_name;
    // 	        $msg = "<p>Hi ,".$name." has updated the employee induction form. Please login to the HR portal to view the updates.</p> <p>Kind Regards,</p>
    //         <p>HR Team</p>";
    			 
    // 			 $emp_details = array(
    // 			     'send_to' =>$to,
    // 			     'subject' => 'Employee Information Updated'
    // 			     );   
    // 			$this->get_content_and_send_mail($emp_details,$msg);
    			
    				$this->session->set_flashdata('sucess_msg', 'Employee information has been sucessfully updated');
    			}else{
    				$this->session->set_flashdata('error_msg', 'Unable to update Employee');
    			}
		  //}
		    redirect('admin/manage_employee');
		}
      }
	}
	
	function add_unavailability(){
	     ob_clean();
	    $data = array(
            	    'emp_id' => $this->ion_auth->user()->row()->id,
            	    'type' => $this->input->post('unavail_type'),
            	    'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
            	    'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
            	    'start_time' => $this->input->post('start_time'),
            	    'end_time' => $this->input->post('end_time'),
    	        );
    	$result = $this->admin_model->add_unavailability($data);
    	if($result != ''){
    	    echo $result;
    	}else{
    	    echo "error";
    	}
	}
	function del_unavailability(){
	     ob_clean();
	    $id = $this->input->post('id');
    	$result = $this->admin_model->del_unavailability($id);
    // 	echo $this->db->last_query();
    	if($result){
    	    echo 'success';
    	}else{
    	    echo "error";
    	}
	}
	
	function employee_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			//echo $id;exit;
			$res=$this->admin_model->employee_delete($id);
			redirect('admin/manage_employee');
			$this->load->view('general/footer');
		}
	}
	
	function user_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			//echo $id;exit;
			$res=$this->admin_model->user_delete($id);
		echo "deleted";
		}
	}
	
		function role_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
		
			$res=$this->admin_model->role_delete($id);
		echo "deleted";
		}
	}
	
	
    function open_timesheet() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
            $branch_id = $this->location_id;
            $type='admin';
			$result = $this->admin_model->get_employees_branchwise($branch_id,$type);
          
          $data['employees'] = $result;
          $this->load->view('employees/open_timesheet',$data);
		}
	}
	function emp_timesheet($id) {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
          $result = $this->admin_model->get_employee_timesheet($id);
          $get_time = $this->admin_model->get_timesheet($id);
          
        
          
          if(!empty($get_time)){
              
              
             
          	$time_out = '';
          	 foreach($get_time as $time_row){ 
          		if($time_row->in_time != "00:00:00"){
          		     $in_time = "in_time_exist";
          		     $time_in = $time_row->in_time;
          		     $time_sheet_id = $time_row->timesheet_id;
          		     $comments = $time_row->comment;
          		     
          		     if($time_row->out_time != "00:00:00"){
	          	      	  $time_out = $time_row->out_time;
	          	      }
          	      }else{
          	      	 $in_time = "in_time_not_exist";
          	      	 
          	      	 $in_time="";
          	$time_in = "";
          	$time_out = "";
          	$time_sheet_id = "";
          	$comments = "";
          	$out_time="";
          	$time_record = "inactive";
          	      }
          	      
          		}
          	 $time_record = "active";
          }else{
          	$in_time="";
          	$time_in = "";
          	$time_out = "";
          	$time_sheet_id = "";
          	$comments = "";
          	$out_time="";
          	$time_record = "inactive";
          }
          
          $data['time_sheet_id'] = $time_sheet_id;
          $data['time_in'] = $time_in;
          $data['time_out'] = $time_out;
          $data['in_time'] = $in_time;
          $data['comments'] = $comments;
          $data['time_record'] = $time_record; 
          $data['timesheet'] = $get_time;
          $data['employees'] = $result;
         
          $this->load->view('employees/employee_timesheet',$data);
		}
	}
	function submit_employee_timesheet() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
          	$id = $this->input->post('time_sheet_id');
          	if($id != ""){
          		//$get_time = $this->admin_model->get_timesheet_id($id);
          		$data_out = array(
          			'out_time' => $this->input->post('out_time')
          			);
          		$out_update = $this->admin_model->out_update($data_out,$id);
          	}else{
            $data = array(
            	'employee_id' => $this->input->post('emp_id'),
            	'date' => date('Y-m-d'),
            	'in_time' => $this->input->post('in_time'),
            	'comment' => $this->input->post('comments')
            	);
            $result = $this->admin_model->submit_employee_timesheet($data); 
          	}
		 redirect('admin/open_timesheet');
		}
	}
	
	function careers(){
		$this->load->view('job_application');
	}
	
	function add_job_applicant(){
		$this->form_validation->set_rules('position','position','trim|required');
		  if ($this->form_validation->run() == true) {
		  	$target_dir = 'assets/resume/';
		  	$userfile_name = $_FILES['resume']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
		  	$file_name = 'resume_'.rand('10000','99999');
		  	//$file_name = $_FILES["resume"]["name"];
		  	$i = ".";
            $final_file_name=$file_name.$i.$userfile_extn;
            $target_file = $target_dir . $final_file_name;
            $file = move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
            $cover = $this->input->post('coverletter');
            //cover letter
            $target_dir1 = 'assets/cover_letter/';
		  	$userfile_name1 = $_FILES['coverletter']['name'];
            $userfile_extn1 = substr($userfile_name1, strrpos($userfile_name1, '.')+1);
		  	$file_name1 = 'coverletter_'.rand('10000','99999');
		  	$i = ".";
            $final_file_name1=$file_name1.$i.$userfile_extn1;
            $target_file1 = $target_dir1 . $final_file_name1;
            $file = move_uploaded_file($_FILES["coverletter"]["tmp_name"], $target_file1);
            
            if($final_file_name1 == ""){
            	$final_file_name1 = "";
            }
            $fname = $this->input->post('first_name');
            $position = $this->input->post('position');
            $lname = $this->input->post('last_name');
            $email_posted = $this->input->post('email');
            $mobile = $this->input->post('phone');
            $date = $this->input->post('dob');
            $visa = $this->input->post('visa_status');
            $avail = $this->input->post('availability');
            $exp = $this->input->post('experience');
            $qualify = $this->input->post('qualification');
            
            //echo $final_file_name;exit; 
		    $data = array(
		    	'position' => $this->input->post('position'),
		    	'cafe_location' => $this->input->post('cafe_location'),
		    	'title' => $this->input->post('title'),
		    	'first_name' => $this->input->post('first_name'),
		    	'last_name' => $this->input->post('last_name'),
		    	'email' => $this->input->post('email'),
		    	'mobile' => $this->input->post('phone'),
		    	'date_of_birth' => $this->input->post('dob'),
		    	'visa_status' => $this->input->post('visa_status'),
		    	'availability' => $this->input->post('availability'),
		    	'experience' => $this->input->post('experience'),
		    	'qualification' => $this->input->post('qualification'),
		    	'notes' => $this->input->post('notes'),
		    	'resume' => $final_file_name,
		    	'coverletter' => $final_file_name1
				);
			$result = $this->admin_model->add_job_applicant($data);
		
		      $email = "careers@cafeadmin.com.au";   
		      $msg = "First name : ".$fname."<br>Last name : ".$lname."<br>Email : ".$email_posted."<br>Phone number : ".$mobile."<br> Date of birth : ".$date."<br>Visa status : ".$visa."<br>Availability : ".$avail."<br>Experience : ".$exp."<br>Qualification : ".$qualify."";
			
			  $this->email->from('info@cafeadmin.com.au', "Cafe Admin HRM");
			  $this->email->to($email);
			  $this->email->subject("New Job Applicant ".$position."");
			  $this->email->message($msg);
			  $attched_file= FCPATH."/assets/resume/".$final_file_name;
			  $attched_file1= FCPATH."/assets/cover_letter/".$final_file_name1;
			  //echo $attched_file;exit;
        //       $this->email->attach($attched_file);
        //       $this->email->attach($attched_file1);
	       //   $this->email->send();
	          
	          	//Phpmailer ============================================================
					  $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = "New Job Applicant ".$position."";
                      $this->phpmailermail->addAttachment($attched_file);
                      $this->phpmailermail->addAttachment($attched_file1);
                     $this->phpmailermail->Body = $msg;
                     $this->phpmailermail->send();
	          
	          
	          
	          
	          
	          
			if($result){
				$this->session->set_flashdata('sucess_msg', 'Thank you for submitting your application! One of our Staff will contact you shortly');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to submit Job Application');
			}
			redirect('admin/careers');
		}else{
			redirect('admin/careers');
		}
	}
	function leave_management(){
		$this->load->view('job_application');
	}
	public function manage_leave(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
           
			   
				
				$leaves = $this->admin_model->get_leaves();
			
				$data['leaves'] = $leaves;
				
				// 	echo "<pre>"; print_r($data['leaves']); exit;
				$this->load->view('general/header');
				$this->load->view('employees/manage_leave',$data);
				$this->load->view('general/footer');
		}
	}
	public function manager_leave_filter($name='',$date='',$status=''){
	    
	        $params=array();
			if($name!=''&&$name!='unset')
				$params['first_name']=$name;
				
			if($date!=''&&$date!='unset')
				$params['start_date']=$date;
			if($status!=''&&$status!='unset')
				$params['status']=$status;
	

	    			
	    $leaves = $this->admin_model->getleaves($params);	
		
				
			
				$data['leaves'] = $leaves;
				
				$this->load->view('general/header');
				$this->load->view('employees/manage_leave',$data);
				$this->load->view('general/footer');

	}
	public function manager_leave_update($id){
	    
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			    
				
				$leaves = $this->admin_model->get_leaves_manager_update($id);
				 $fname = $this->admin_model->get_emp_details_fieldwise($leaves[0]->emp_id,'first_name');
				 $lname = $this->admin_model->get_emp_details_fieldwise($leaves[0]->emp_id,'last_name');
				 $fullname = $fname.' '.$lname;
				// echo '<pre>';print_r($leaves);exit;
				$data['leaves'] = $leaves;
				$data['leave_id'] = $id;
				$data['emp_name'] = $fullname;
				
				$this->load->view('general/header');
				$this->load->view('employees/manager_leave_update',$data);
				$this->load->view('general/footer');
		}
	}
	public function update_leave_manager(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$leave_id = $this->input->post('leave_id');
		$data = array(
		   'leave_status' => $this->input->post('leave_status'),
		   'comments' => $this->input->post('comment'),
		    'new_nominated_person' => $this->input->post('new_nominated_person')
		);
		//echo '<pre>';print_r($data);exit;
		$result = $this->admin_model->update_leave_manager($data,$leave_id);
		
		$emp_id = $this->admin_model->get_leaves_manager_update($leave_id);
		
	    $emp_info = $this->admin_model->get_emp_update($emp_id[0]->emp_id);
	    
	    	
		if($result){
		       add_notification('leave_update_to_emp','employee',$emp_id[0]->emp_id);
		       
		    $to = $emp_info[0]->email;
		    
		  
		    $subject = "Manager has an update on your leave request"; 
		    $loginlink = base_url()."index.php/auth/login";
		    
		    $data['employee_name']= $emp_info[0]->first_name;
             $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "Leave Status Updated"
			    
			     );
			     $body='<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <style>
    a.LinkButton {
  background: #f98d07;
    padding: 5px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
  
    text-decoration: none;
}
    </style>
        <title></title> 
    </head> 
    <body> 
        <p>Hi '.$emp_info[0]->first_name.'</p><p> 
          This email is to inform you that an update to your leave request was made.
Please login to the HR portal to view the update. Responses to the request can be submitted via the HR portal. 

        </p> 
        <p>Kind Regards,</p>
        <p>HR Team</p>


</body> 
</html>';

			 // $body = $this->load->view('email/leave_status', $data,TRUE);
		      if($this->get_content_and_send_mail($emp_details,$body)){ 
                  
              $this->session->set_flashdata('sucess_msg', 'Leave has been sucessfully updated'); 
              	redirect('admin/manage_leave');
  
               }else{ 
  	$this->session->set_flashdata('error_msg', 'Unable to update Leave');
  		redirect('admin/manage_leave');
               }
				
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update Leave');
					redirect('admin/manage_leave');
			}
			redirect('admin/manage_leave');
       }
	}
	public function roster_emp_table(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
			//echo $branch_id;exit;
			    
			    $type='admin';
		   if($branch_id ==''){
		     	$user_email = $this->ion_auth->user()->row()->email;
				
			 	$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
		    
		     $branch_id = $emp_id;
		     $type='employee';
		   }
				
				$employees = $this->admin_model->get_employees_branchwise($branch_id,$type);

				$get_employees_roster = $this->admin_model->get_employees_roster();
                $data['roster'] = $get_employees_roster;
				$data['employees'] = $employees;
				
				$this->load->view('general/header');
				$this->load->view('employees/roster_emp_table',$data);
				$this->load->view('general/footer');
       }
	}
	public function create_roster($id){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
		    
			$roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles; 
			$employees = $this->admin_model->get_emp_details($id);  
		
		    $data['employee'] = $employees;
				
				$data['emp_id'] = $employees[0]->emp_id;
				$this->load->view('general/header');
				$this->load->view('employees/create_roster',$data);
				$this->load->view('general/footer');
				
				

				
       }
	}
	function insert_roster() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
          	$title = $this->input->post('title');
            $date = $this->input->post('start');
			
            $date = $this->input->post('start');
            $data = array(
            	'emp_id' => $this->input->post('emp_id'),
				'date' => $date,
				'title' => $title,
				'roster_status' => 1,
            	'work_start_time' => '',
            	'work_end_time' => '',
            	'break_start_time' => '',
				'break_end_time' => ''
            	);
				//echo '<pre>';print_r($data);exit;
            $result = $this->admin_model->insert_roster($data); 

		 redirect('admin/roster_emp_table');
		}
	}
	public function view_roster($id){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
			//echo $id;exit;
			   
				//$id = $this->input->post();
				//$view_roster = $this->admin_model->view_roster($id);
				//echo '<pre>';print_r($view_roster);exit;
                //$data['roster'] = $view_roster;
				
				$data['emp_id'] = $id;
				$this->load->view('general/header');
				$this->load->view('employees/view_roster',$data);
				$this->load->view('general/footer');
       }
	}
	public function get_emp_roster($id){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
			//echo $id;exit;
			   
				//$id = $this->input->post();
				$view_roster = $this->admin_model->get_emp_roster($id);
				//echo '<pre>';print_r($view_roster);exit;
                echo json_encode($view_roster);
       }
	}
	public function delete_roster(){
           $id = $this->input->post('id');
			$delete = $this->admin_model->delete_roster($id);
	}
	
	
	public function update_roster_status(){

			  $roster_status = $this->input->post('roster_status');
			  $id = $this->input->post('id');
			  
			   $data = array(
            	'roster_status' => $roster_status
            	);
            
			$updated = $this->admin_model->update_roster($data,$id);
			echo $updated; exit;
	}
	public function update_fingerprint_auth_status(){

			  $fingerprint_auth_status = $this->input->post('fingerprint_auth_status');
			  $emp_id = $this->input->post('emp_id');
			   $data = array(
            	'fingerprint_auth_status' => $fingerprint_auth_status
            	);
			$updated = $this->admin_model->update_employee($data,$emp_id);
	}
	
		public function update_interview_status(){

			  $hired = $this->input->post('hired');
			  $interview_assesment_id = $this->input->post('interview_assesment_id');
			   $data = array(
            	'hired' => $hired
            	);
            
			$updated = $this->admin_model->update_interview_status($data,$interview_assesment_id);
	}
	public function delete_document(){

			  $id = $this->input->post('id');
			$delete = $this->admin_model->delete_document($id);
	}
	
		public function delete_single_roster(){

			  $roster_group_id = $this->input->post('id');
			  $roster_id = $this->input->post('roster_id');  
			  
			  
			$delete = $this->admin_model->delete_single_roster($roster_group_id,$roster_id);
// 			echo "<pre>";print_r($delete);
// 			if($delete){
// 			    echo "success";
// 			}else{
// 			    echo "error";
// 			}
	}
	
	
	
	function update_roster() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$roster_id = $this->input->post('roster_id');
            $date = $this->input->post('date');
            $data = array(
            	'emp_id' => $this->input->post('emp_id'),
				'date' => date('Y-m-d', strtotime($date)),
            	'work_start_time' => $this->input->post('starttime'),
            	'work_end_time' => $this->input->post('endtime'),
            	'break_start_time' => $this->input->post('break_starttime'),
				'break_end_time' => $this->input->post('break_end_time')
            	);
				//echo '<pre>';print_r($data);exit;
            $result = $this->admin_model->update_roster($data,$roster_id); 

		 redirect('admin/roster_emp_table');
		}
	}
	public function roster_emp_table2($error_msg=''){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
		    $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles; 
			
			    
			$type='admin';
		   if($branch_id ==''){
		     $emp_id = $this->session->userdata('customerId'); 
		     $branch_id = $emp_id;
		     $type='employee';
		   }
				$employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
				$get_employees_roster = $this->admin_model->get_employees_roster();
                $data['roster'] = $get_employees_roster;
				$data['employees'] = $employees;
				$data['link'] = base_url()."index.php/admin/get_roster_weeks";
				
				$this->load->view('general/header');
				$this->load->view('employees/add_roster',$data);
				//$this->load->view('general/footer');
       }
	}
	
	public function add_roster_beta($error_msg=''){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
		    $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles; 
			
			    
			$type='admin';
		   if($branch_id ==''){
		     $emp_id = $this->session->userdata('customerId'); 
		     $branch_id = $emp_id;
		     $type='employee';
		   }
				$employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
				$data['employees'] = $employees;
				
				$emp_departments = $this->admin_model->get_emp_departments_branchwise($branch_id);
				$data['emp_departments'] = $emp_departments;
				
				$outlet = $this->admin_model->get_outlet_branchwise($branch_id);
				$data['outlet'] = $outlet;
				
                $data['user_id']  = $this->session->userdata('user_id'); 
                $data['role'] = $roleName;
				
				$this->load->view('general/header');
				$this->load->view('employees/add_roster_beta',$data);
				$this->load->view('general/footer');
       }
	}
	function fetch_emp_role(){
	  $emp_id =  $_POST['emp_id'];
	  $user_role = $this->session->userdata('role');
	  
        $user_id = $this->session->userdata('user_id');
        $emp_rate = $this->admin_model->check_emp_rates_for_roster($user_id);
        
	  $employes = $this->admin_model->fetch_emp_role($emp_id,$emp_rate[0]->show_emp_rates_in_roster);
	  
	  echo json_encode($employes);

	}
	
	public function submit_roster(){
	   ob_clean();
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {

			$start_date = date('Y-m-d', strtotime($_POST['start_date']));
			$end_date   = date('Y-m-d', strtotime($_POST['end_date']));
			if(isset($_POST['month'])){
			    $month = $_POST['month'];
			}
			else{
			   $month = ''; 
			}
			if(isset($_POST['roster_template'])){
			    $roster_template = $_POST['roster_template'];
			}
			else{
			   $roster_template = 0; 
			}	
// 		echo "<pre>";print_r($_POST);exit;
			
			$emp_ids    = $_POST['emp_id'];
						
						
						// start 6Jan 2021 work
// 			foreach($emp_ids as $emp_id){
// 			    $employees_validation[] = $this->admin_model->get_emps_roster_week($emp_id,$start_date,$end_date);
			    
// 			}
// 			foreach($employees_validation as $key =>$val){
// 			if(!empty($val)){
// 			      echo "alreadyAssigned";
//     			    exit;
// 			    }
// 			}
			
// 			foreach($emp_ids as $emp_id){
// 			    $employees_validation_time[] = $this->admin_model->get_emps_roster_week_time($emp_id,$start_date,$end_date);
// 			    echo "<pre>";
// 			    print_r($employees_validation_time);
// 			}
			
			// End 6Jan 2021 work
			
			// check if any employee of this roster is on leave if yes show a warning message .but the roster still can be recreated
			//commented on 08-04-2022
		
// 		if($_POST['leavecontinueApproval'] == ''){
// 		foreach($emp_ids as $emp_id){
// 			 $employees_leave_validation = $this->admin_model->get_leavesdate_all_emps($emp_id,$start_date,$end_date);
// 			 foreach($employees_leave_validation as $employees_leave_vali){
		  
//     			if (($start_date >= date('Y-m-d', strtotime($employees_leave_vali->start_date))) && ($start_date <= date('Y-m-d', strtotime($employees_leave_vali->end_date)))){
//                     echo "leaveValidation";
//     			    exit;
//                 }
//                 if (($end_date >= date('Y-m-d', strtotime($employees_leave_vali->start_date))) && ($end_date <= date('Y-m-d', strtotime($employees_leave_vali->end_date)))){
//                   echo "leaveValidation";
//     			  exit;
//                 }
//     			}
// 			}
//         }
		
	
		if(isset($_POST['roster_name']) && $_POST['roster_name'] !=''){
			  $roster_name = $_POST['roster_name'];  
			}else{
			   $roster_name = '';
			}
			
			if(($start_date =='') || ($end_date =='') || ($roster_name =='')){
			    echo "validation";
			    exit;
			}
			
			$roster_department = $_POST['roster_department'];
			$roster_comment = $_POST['roster_comment'];
			
			$monday_start = $_POST['mon_start'];
			$monday_end = $_POST['mon_end'];
			$monday_break = $_POST['mon_break_time'];
			$monday_layout = $_POST['mon_layout'];
			
			$tuesday_start = $_POST['tues_start'];
			$tuesday_end = $_POST['tues_end'];
			$tuesday_break = $_POST['tues_break_time'];
			$tuesday_layout = $_POST['tues_layout'];
			
			$wed_start_time = $_POST['wed_start'];
			$wed_end_time = $_POST['wed_end'];
			$wed_break_time = $_POST['wed_break_time'];
			$wed_layout = $_POST['wed_layout'];
			
			$thus_start_time = $_POST['thus_start'];
			$thus_end_time = $_POST['thus_end'];
			$thus_break_time = $_POST['thus_break_time'];
			$thus_layout = $_POST['thus_layout'];
			
			$fri_start_time = $_POST['fri_start'];
			$fri_end_time = $_POST['fri_end'];
			$fri_break_time = $_POST['fri_break_time'];
			$fri_layout = $_POST['fri_layout'];
			
			$sat_start_time = $_POST['sat_start'];
			$sat_end_time = $_POST['sat_end'];
			$sat_break_time = $_POST['sat_break_time'];
			$sat_layout = $_POST['sat_layout'];
			
			$sun_start_time = $_POST['sun_start'];
			$sun_end_time = $_POST['sun_end'];
			$sun_break_time = $_POST['sun_break_time'];
			$sun_layout = $_POST['sun_layout'];
			
		  $count_no_of_roster = count($emp_ids);
         
			 $i= 1;
			 $processed = array();
			foreach($emp_ids as $key=>$emp_id){
			    $error = false;
			   if($emp_id == ''){
			       echo "validation"; exit;
			   }
			 //  get multiple breaktimes
			 $mon_break_in_out = [];
			 $tues_break_in_out = [];
			 $wed_break_in_out = [];
			 $thus_break_in_out = [];
			 $fri_break_in_out = [];
			 $sat_break_in_out = [];
			 $sun_break_in_out = [];
			 //mon
			    $tempMonStart = $monday_start[$key];
			    $mon_break_start = $_POST['mon_break_start'][$emp_id][$tempMonStart];
		        $mon_break_finish = $_POST['mon_break_finish'][$emp_id][$tempMonStart];
			    $loopcount = 0;
			    foreach($mon_break_start as $row){
			        if($row != ''){
			        $mon_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $mon_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //tues
			    $tempTuesStart = $tuesday_start[$key];
			    $tues_break_start = $_POST['tues_break_start'][$emp_id][$tempTuesStart];
		        $tues_break_finish = $_POST['tues_break_finish'][$emp_id][$tempTuesStart];
			    $loopcount = 0;
			    foreach($tues_break_start as $row){
			        if($row != ''){
			        $tues_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $tues_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			   
			    //wed
			    $tempWedStart = $wed_start_time[$key];
			    $wed_break_start = $_POST['wed_break_start'][$emp_id][$tempWedStart];
		        $wed_break_finish = $_POST['wed_break_finish'][$emp_id][$tempWedStart];
			    $loopcount = 0;
			    foreach($wed_break_start as $row){
			        if($row != ''){
			        $wed_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $wed_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //thus
			    $tempThusStart = $thus_start_time[$key];
			    $thus_break_start = $_POST['thus_break_start'][$emp_id][$tempThusStart];
		        $thus_break_finish = $_POST['thus_break_finish'][$emp_id][$tempThusStart];
			    $loopcount = 0;
			    foreach($thus_break_start as $row){
			        if($row != ''){
			        $thus_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $thus_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    
			    //fri
			    $tempFriStart = $fri_start_time[$key];
			    $fri_break_start = $_POST['fri_break_start'][$emp_id][$tempFriStart];
		        $fri_break_finish = $_POST['fri_break_finish'][$emp_id][$tempFriStart];
			    $loopcount = 0;
			    foreach($fri_break_start as $row){
			        if($row != ''){
			        $fri_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $fri_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //sat
			    $tempSatStart = $sat_start_time[$key];
			    $sat_break_start = $_POST['sat_break_start'][$emp_id][$tempSatStart];
		        $sat_break_finish = $_POST['sat_break_finish'][$emp_id][$tempSatStart];
			    $loopcount = 0;
			    foreach($sat_break_start as $row){
			        if($row != ''){
			        $sat_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $sat_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //sun
			    $tempSunStart = $sun_start_time[$key];
			    $sun_break_start = $_POST['sun_break_start'][$emp_id][$tempSunStart];
		        $sun_break_finish = $_POST['sun_break_finish'][$emp_id][$tempSunStart];
			    $loopcount = 0;
			    foreach($sun_break_start as $row){
			        if($row != ''){
			        $sun_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $sun_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			   
			  $data = array(
			  'emp_id' => $emp_id,
			  'roster_status' => 0,
			  'start_date' => $start_date,
              'end_date' => $end_date,
              'month' => $month,
              'roster_template' => $roster_template,
              'roster_name' => $roster_name,
              'roster_department' => empty($roster_department[$key]) ? NULL  : $roster_department[$key],
              'roster_comment' => empty($roster_comment[$key]) ? NULL  : $roster_comment[$key],
              'mon_start_time' => empty($monday_start[$key]) ? NULL  : $monday_start[$key],
			  'mon_end_time' =>   empty($monday_end[$key]) ? NULL  : $monday_end[$key],
              'mon_break_time' => empty($monday_break[$key]) ? NULL  : $monday_break[$key],
              'mon_break_in_out' => serialize($mon_break_in_out),
              'Monday_layout' => empty($monday_layout[$key]) ? NULL  : $monday_layout[$key],
              
              'tues_start_time' => empty($tuesday_start[$key]) ? NULL  : $tuesday_start[$key],
			  'tues_end_time' =>   empty($tuesday_end[$key]) ? NULL  : $tuesday_end[$key],
              'tues_break_time' => empty($tuesday_break[$key]) ? NULL  : $tuesday_break[$key],
              'tues_break_in_out' => serialize($tues_break_in_out),
              'Tuesday_layout' => empty($tuesday_layout[$key]) ? NULL  : $tuesday_layout[$key],
              
              'wed_start_time' => empty($wed_start_time[$key]) ? NULL  : $wed_start_time[$key],
			  'wed_end_time' =>   empty($wed_end_time[$key]) ? NULL  : $wed_end_time[$key],
              'wed_break_time' => empty($wed_break_time[$key]) ? NULL  : $wed_break_time[$key],
              'wed_break_in_out' => serialize($wed_break_in_out),
              'Wednesday_layout' =>     empty($wed_layout[$key]) ? NULL  :       $wed_layout[$key],
              
              'thus_start_time' => empty($thus_start_time[$key]) ? NULL  : $thus_start_time[$key],
			  'thus_end_time' =>   empty($thus_end_time[$key]) ? NULL  : $thus_end_time[$key],
              'thus_break_time' => empty($thus_break_time[$key]) ? NULL  : $thus_break_time[$key],
              'thus_break_in_out' => serialize($thus_break_in_out),
              'Thursday_layout' => empty($thus_layout[$key]) ? NULL  : $thus_layout[$key],
              
              'fri_start_time' => empty($fri_start_time[$key]) ? NULL  : $fri_start_time[$key],
			  'fri_end_time' =>   empty($fri_end_time[$key]) ? NULL  : $fri_end_time[$key],
              'fri_break_time' => empty($fri_break_time[$key]) ? NULL  : $fri_break_time[$key],
              'fri_break_in_out' => serialize($fri_break_in_out),
               'Friday_layout' => empty($fri_layout[$key]) ? NULL  :     $fri_layout[$key],
              
              'sat_start_time' => empty($sat_start_time[$key]) ? NULL  : $sat_start_time[$key],
			  'sat_end_time' =>   empty($sat_end_time[$key]) ? NULL  : $sat_end_time[$key],
              'sat_break_time' => empty($sat_break_time[$key]) ? NULL  : $sat_break_time[$key],
              'sat_break_in_out' => serialize($sat_break_in_out),
              'Saturday_layout' => empty($sat_layout[$key]) ? NULL  : $sat_layout[$key],
              
              'sun_start_time' => empty($sun_start_time[$key]) ? NULL  : $sun_start_time[$key],
			  'sun_end_time' =>   empty($sun_end_time[$key]) ? NULL  : $sun_end_time[$key],
              'sun_break_time' => empty($sun_break_time[$key]) ? NULL  : $sun_break_time[$key],
              'sun_break_in_out' => serialize($sun_break_in_out),
              'Sunday_layout' => empty($sun_layout[$key]) ? NULL  : $sun_layout[$key],
              'branch_id' => $this->session->userdata('branch_id')			  
			  );
		$lapped = "false"; 	  
// 		if(!empty($employees_leave_validation)){
// 		 // if the employee in posted roster is on the leave give error   
// 		  echo "error"; exit;
// 		}

// ====================================================================  Time overlapping validation start here =============================
	 // time overlapping validation , for now commented on 08-04-2022		        
	// check time difference for all day seprately , if more than one roster added		       
	$indexes = array_keys($emp_ids, $emp_id);		     
    
//     if(!empty($indexes) && count($indexes) > 1)  {
//     //Monday

// if((isset($monday_start) && $monday_start[0] !='') && (isset($monday_end) && $monday_end[0] !='')){ 
//     $date1 = DateTime::createFromFormat('H:i a', $monday_start[$indexes[0]]);
//     $date2 = DateTime::createFromFormat('H:i a', $monday_start[$indexes[1]]);
//     $date3 = DateTime::createFromFormat('H:i a', $monday_end[$indexes[1]]);
//     $date4 = DateTime::createFromFormat('H:i a', $monday_end[$indexes[0]]);

//     $reversecchk_current_key_date1 = $monday_end[$indexes[0]];
//     $reversecchk_current_key_date2 = $monday_start[$indexes[1]];
//     $reversecchk_current_key_date3 = $monday_end[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }
// }

// //Tuesday
// if((isset($tuesday_start) && $tuesday_start[0] !='') && (isset($tuesday_end) && $tuesday_end[0] !='')){
// $date1 = DateTime::createFromFormat('H:i a', $tuesday_start[$indexes[0]]);
// $date2 = DateTime::createFromFormat('H:i a', $tuesday_start[$indexes[1]]);
// $date3 = DateTime::createFromFormat('H:i a', $tuesday_end[$indexes[1]]);
// $date4 = DateTime::createFromFormat('H:i a', $tuesday_end[$indexes[0]]);

// $reversecchk_current_key_date1 = $tuesday_end[$indexes[0]];
// $reversecchk_current_key_date2 = $tuesday_start[$indexes[1]];
// $reversecchk_current_key_date3 =  $tuesday_end[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }		           
// }
 
// // wednesday

// if((isset($wed_start_time) && $wed_start_time[0] !='') && (isset($wed_end_time) && $wed_end_time[0] !='')){ 
// $date1 = DateTime::createFromFormat('H:i a', $wed_start_time[$indexes[0]]);
// $date2 = DateTime::createFromFormat('H:i a', $wed_start_time[$indexes[1]]);
// $date3 = DateTime::createFromFormat('H:i a', $wed_end_time[$indexes[1]]);
// $date4 = DateTime::createFromFormat('H:i a', $wed_end_time[$indexes[0]]);

// $reversecchk_current_key_date1 = $wed_end_time[$indexes[0]];
// $reversecchk_current_key_date2 = $wed_start_time[$indexes[1]];
// $reversecchk_current_key_date3 =  $wed_end_time[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }
// }     
  
// // thursday
       
// if((isset($thus_start_time) && $thus_start_time[0] !='') && (isset($thus_end_time) && $thus_end_time[0] !='')){     
// $date1 = DateTime::createFromFormat('H:i a', $thus_start_time[$indexes[0]]);
// $date2 = DateTime::createFromFormat('H:i a', $thus_start_time[$indexes[1]]);
// $date3 = DateTime::createFromFormat('H:i a', $thus_end_time[$indexes[1]]);
// $date4 = DateTime::createFromFormat('H:i a', $thus_end_time[$indexes[0]]);

// $reversecchk_current_key_date1 = $thus_end_time[$indexes[0]];
// $reversecchk_current_key_date2 = $thus_start_time[$indexes[1]];
// $reversecchk_current_key_date3 =  $thus_end_time[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }
// }

// //friday
//  if((isset($fri_start_time) && $fri_start_time[0] !='') && (isset($fri_end_time) && $fri_end_time[0] !='')){ 
// $date1 = DateTime::createFromFormat('H:i a', $fri_start_time[$indexes[0]]);
// $date2 = DateTime::createFromFormat('H:i a', $fri_start_time[$indexes[1]]);
// $date3 = DateTime::createFromFormat('H:i a', $fri_end_time[$indexes[1]]);
// $date4 = DateTime::createFromFormat('H:i a', $fri_end_time[$indexes[0]]);

// $reversecchk_current_key_date1 = $fri_end_time[$indexes[0]];
// $reversecchk_current_key_date2 = $fri_start_time[$indexes[1]];
// $reversecchk_current_key_date3 =  $fri_end_time[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }
// }
// // saturday
// if((isset($sat_start_time) && $sat_start_time[0] !='') && (isset($sat_end_time) && $sat_end_time[0] !='')){ 
// $date1 = DateTime::createFromFormat('H:i a', $sat_start_time[$indexes[0]]);
// $date2 = DateTime::createFromFormat('H:i a', $sat_start_time[$indexes[1]]);
// $date3 = DateTime::createFromFormat('H:i a', $sat_end_time[$indexes[1]]);
// $date4 = DateTime::createFromFormat('H:i a', $sat_end_time[$indexes[0]]);

// $reversecchk_current_key_date1 = $sat_end_time[$indexes[0]];
// $reversecchk_current_key_date2 = $sat_start_time[$indexes[1]];
// $reversecchk_current_key_date3 =  $sat_end_time[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }

// }

// //sunday

// // saturday
// if((isset($sun_start_time) && $sun_start_time[0] !='') && (isset($sun_end_time) && $sun_end_time[0] !='')){ 
// $date1 = DateTime::createFromFormat('H:i a', $sun_start_time[$indexes[0]]);
// $date2 = DateTime::createFromFormat('H:i a', $sun_start_time[$indexes[1]]);
// $date3 = DateTime::createFromFormat('H:i a', $sun_end_time[$indexes[1]]);
// $date4 = DateTime::createFromFormat('H:i a', $sun_end_time[$indexes[0]]);

// $reversecchk_current_key_date1 = $sun_end_time[$indexes[0]];
// $reversecchk_current_key_date2 = $sun_start_time[$indexes[1]];
// $reversecchk_current_key_date3 =  $sun_end_time[$indexes[1]];

// if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
// {
//   $lapped = "true";
// }
       
//      }
    
    
//   // commented this code for now, this will check if shift times are overlapping for  same employee ,uncomment it and put employee name too in message.
    
//     //  if($lapped == "true"){
//     //     echo "error"; exit;        
//     //  }           
//     }

// ====================================================================   Time overlapping validation Ends here =============================
			  $roster_id = $this->admin_model->insert_roster($data);
			  
			  
			  
			    add_notification('roster_added','employee',$emp_id);
			  if($i==1){
			     $this->session->set_userdata('rostergroup_id', $roster_id); 
			  }
			  
			  
			  $this->admin_model->update_rostergroup_id($roster_id);
			  $i++;
			}
		    
			  if($roster_id){
			      
			      $this->session->unset_userdata('rostergroup_id');
			      echo "Sucess"; exit;
			}else{
			    
				// $this->session->set_flashdata('error_msg', 'Unable to add Roster');
				echo "error_"; exit; 
			}
		  //  redirect('admin/get_roster_weeks');					
       }
	}
	
	
	public function update_complete_roster(){
	    ob_clean();
	    $return_data = array();
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
            
			$roster_id = $_POST['roster_id'];
			$roster_group_id = $_POST['roster_group_id'];
// 			echo "<pre>";print_r($roster_id);exit;
			$start_date = date('Y-m-d', strtotime($_POST['start_date']));
			$end_date = date('Y-m-d', strtotime($_POST['end_date']));
			$roster_name = $_POST['roster_name'];
			$month = $_POST['month'];
			$emp_ids =  $_POST['emp_id'];
			$prev_emp =  $_POST['prev_emp'];
			
			
		// to add or remove (UPDATE) newly addded employee while updating the roster to timesheet also ========================================================== 22-06-2021
			
// 		$existing_employeeOfthisRoster = $this->admin_model->fetch_emp_idofthisroster($roster_group_id);
       
// 		$newlyaddedEmployees = array_diff($emp_ids,array_column($existing_employeeOfthisRoster,'emp_id'));
		
		 $timeSheetID = $this->admin_model->get_timesheet_by_roster_group_id($roster_group_id);
// echo "newlyaddedEmployees<pre>";print_r($newlyaddedEmployees);
	
		 

		// end =========================================================================================================================================
			
		
			
// 		if($_POST['leavecontinueApproval'] == ''){
// 			foreach($emp_ids as $emp_id){
// 			 $employees_leave_validation = $this->admin_model->get_leavesdate_all_emps($emp_id,$start_date,$end_date);
// 			  $emp_name= $this->admin_model->get_emp_details_fieldwise($emp_id,'first_name');
// 			 foreach($employees_leave_validation as $employees_leave_vali){
		  
//     			if (($start_date >= date('Y-m-d', strtotime($employees_leave_vali->start_date))) && ($start_date <= date('Y-m-d', strtotime($employees_leave_vali->end_date)))){
//                     $return_data['result'] = 'leaveValidation';
//                     $return_data['emp_name'] = $emp_name;
//                     echo json_encode($return_data); exit;
                   
//                 }
//                 if (($end_date >= date('Y-m-d', strtotime($employees_leave_vali->start_date))) && ($end_date <= date('Y-m-d', strtotime($employees_leave_vali->end_date)))){
//                   $return_data['result'] = 'leaveValidation';
//                     $return_data['emp_name'] = $emp_name;
//                     echo json_encode($return_data); exit;
//                 }
//     			}
// 			}
// 			}
			
		      
			$roster_department = (!empty($_POST['roster_department'])) ? $_POST['roster_department'] : '';
			$roster_comment = (!empty($_POST['roster_comment'])) ? $_POST['roster_comment'] : '';
			
			$monday_start = (!empty($_POST['mon_start_time'])) ? $_POST['mon_start_time'] : '';
			$monday_end = (!empty($_POST['mon_end_time'])) ? $_POST['mon_end_time'] : '';
			$monday_break = (!empty($_POST['mon_break_time'])) ? $_POST['mon_break_time'] :'';
			$tuesday_start = (!empty($_POST['tues_start_time'])) ? $_POST['tues_start_time']: '';
			$tuesday_end = (!empty($_POST['tues_end_time'])) ?  $_POST['tues_end_time'] : '';
			$tuesday_break = (!empty($_POST['tues_break_time'])) ? $_POST['tues_break_time']: '';
			$wed_start_time = (!empty($_POST['wed_start_time'])) ? $_POST['wed_start_time']: '';
			$wed_end_time = (!empty($_POST['wed_end_time'])) ?  $_POST['wed_end_time']: '';
			$wed_break_time = (!empty($_POST['wed_break_time'])) ?  $_POST['wed_break_time']: '';
			$thus_start_time = (!empty($_POST['thus_start_time'])) ? $_POST['thus_start_time']: '';
			$thus_end_time = (!empty($_POST['thus_end_time'])) ? $_POST['thus_end_time']: '';
			$thus_break_time = (!empty($_POST['thus_break_time'])) ? $_POST['thus_break_time']: '';
			$fri_start_time = (!empty($_POST['fri_start_time'])) ? $_POST['fri_start_time']: '';
			$fri_end_time = (!empty($_POST['fri_end_time'])) ?  $_POST['fri_end_time']: '';
			$fri_break_time = (!empty($_POST['fri_break_time'])) ? $_POST['fri_break_time']: '';
			$sat_start_time = (!empty($_POST['sat_start_time'])) ?  $_POST['sat_start_time']: '';
			$sat_end_time = (!empty($_POST['sat_end_time'])) ?  $_POST['sat_end_time']: '';
			$sat_break_time = (!empty($_POST['sat_break_time'])) ? $_POST['sat_break_time']: '';
			$sun_start_time = (!empty($_POST['sun_start_time'])) ? $_POST['sun_start_time']: '';
			$sun_end_time = (!empty($_POST['sun_end_time'])) ? $_POST['sun_end_time']: '';
			$sun_break_time = (!empty($_POST['sun_break_time'])) ? $_POST['sun_break_time']: '';
			
			
			
			    $monday_layout = $_POST['Monday_layout'];
			    $tuesday_layout = $_POST['Tuesday_layout'];
				$wed_layout = $_POST['Wednesday_layout'];
				$thus_layout = $_POST['Thursday_layout'];
				$fri_layout = $_POST['Friday_layout'];
				$sat_layout = $_POST['Saturday_layout'];
			    $sun_layout = $_POST['Sunday_layout'];
			
		        $count = 0;
		        
		    
	
			foreach($emp_ids as $key=>$emp_id){
			    
			    //  get multiple breaktimes
			 $mon_break_in_out = [];
			 $tues_break_in_out = [];
			 $wed_break_in_out = [];
			 $thus_break_in_out = [];
			 $fri_break_in_out = [];
			 $sat_break_in_out = [];
			 $sun_break_in_out = [];
			 //mon
			    $tempMonStart = $monday_start[$key];
			    $mon_break_start = $_POST['mon_break_start'][$emp_id][$tempMonStart];
		        $mon_break_finish = $_POST['mon_break_finish'][$emp_id][$tempMonStart];
			    $loopcount = 0;
			    foreach($mon_break_start as $row){
			        if($row != ''){
			        $mon_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $mon_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //tues
			    $tempTuesStart = $tuesday_start[$key];
			    $tues_break_start = $_POST['tues_break_start'][$emp_id][$tempTuesStart];
		        $tues_break_finish = $_POST['tues_break_finish'][$emp_id][$tempTuesStart];
			    $loopcount = 0;
			    foreach($tues_break_start as $row){
			        if($row != ''){
			        $tues_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $tues_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			   
			    //wed
			    $tempWedStart = $wed_start_time[$key];
			    $wed_break_start = $_POST['wed_break_start'][$emp_id][$tempWedStart];
		        $wed_break_finish = $_POST['wed_break_finish'][$emp_id][$tempWedStart];
			    $loopcount = 0;
			    foreach($wed_break_start as $row){
			        if($row != ''){
			        $wed_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $wed_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //thus
			    $tempThusStart = $thus_start_time[$key];
			    $thus_break_start = $_POST['thus_break_start'][$emp_id][$tempThusStart];
		        $thus_break_finish = $_POST['thus_break_finish'][$emp_id][$tempThusStart];
			    $loopcount = 0;
			    foreach($thus_break_start as $row){
			        if($row != ''){
			        $thus_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $thus_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    
			    //fri
			    $tempFriStart = $fri_start_time[$key];
			    $fri_break_start = $_POST['fri_break_start'][$emp_id][$tempFriStart];
		        $fri_break_finish = $_POST['fri_break_finish'][$emp_id][$tempFriStart];
			    $loopcount = 0;
			    foreach($fri_break_start as $row){
			        if($row != ''){
			        $fri_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $fri_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //sat
			    $tempSatStart = $sat_start_time[$key];
			    $sat_break_start = $_POST['sat_break_start'][$emp_id][$tempSatStart];
		        $sat_break_finish = $_POST['sat_break_finish'][$emp_id][$tempSatStart];
			    $loopcount = 0;
			    foreach($sat_break_start as $row){
			        if($row != ''){
			        $sat_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $sat_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    //sun
			    $tempSunStart = $sun_start_time[$key];
			    $sun_break_start = $_POST['sun_break_start'][$emp_id][$tempSunStart];
		        $sun_break_finish = $_POST['sun_break_finish'][$emp_id][$tempSunStart];
			    $loopcount = 0;
			    foreach($sun_break_start as $row){
			        if($row != ''){
			        $sun_break_in_out[] = array(
			            'break_start' => $row,
			            'break_finish' => $sun_break_finish[$loopcount],
			            );
			        }
			    $loopcount++;
			    }
			    
			  $data = array(
			  'emp_id' => $emp_id,
			  'start_date' => $start_date,
              'end_date' => $end_date,
              'month' => $month,
              'roster_name' => $roster_name,
              'roster_department' => empty($roster_department[$key]) ? NULL  : $roster_department[$key],
              'roster_comment' => empty($roster_comment[$key]) ? NULL  : $roster_comment[$key],
              'mon_start_time' => empty($monday_start[$key]) ? NULL  : $monday_start[$key],
			  'mon_end_time' =>   empty($monday_end[$key]) ? NULL  : $monday_end[$key],
              'mon_break_time' => empty($monday_break[$key]) ? NULL  : $monday_break[$key],
              'mon_break_in_out' => serialize($mon_break_in_out),
              'tues_start_time' => empty($tuesday_start[$key]) ? NULL  : $tuesday_start[$key],
			  'tues_end_time' =>   empty($tuesday_end[$key]) ? NULL  : $tuesday_end[$key],
              'tues_break_time' => empty($tuesday_break[$key]) ? NULL  : $tuesday_break[$key],
              'tues_break_in_out' => serialize($tues_break_in_out),
              'wed_start_time' => empty($wed_start_time[$key]) ? NULL  : $wed_start_time[$key],
			  'wed_end_time' =>   empty($wed_end_time[$key]) ? NULL  : $wed_end_time[$key],
              'wed_break_time' => empty($wed_break_time[$key]) ? NULL  : $wed_break_time[$key],
              'wed_break_in_out' => serialize($wed_break_in_out),
              'thus_start_time' => empty($thus_start_time[$key]) ? NULL  : $thus_start_time[$key],
			  'thus_end_time' =>   empty($thus_end_time[$key]) ? NULL  : $thus_end_time[$key],
              'thus_break_time' => empty($thus_break_time[$key]) ? NULL  : $thus_break_time[$key],
              'thus_break_in_out' => serialize($thus_break_in_out),
              'fri_start_time' => empty($fri_start_time[$key]) ? NULL  : $fri_start_time[$key],
			  'fri_end_time' =>   empty($fri_end_time[$key]) ? NULL  : $fri_end_time[$key],
              'fri_break_time' => empty($fri_break_time[$key]) ? NULL  : $fri_break_time[$key],
              'fri_break_in_out' => serialize($fri_break_in_out),
              'sat_start_time' => empty($sat_start_time[$key]) ? NULL  : $sat_start_time[$key],
			  'sat_end_time' =>   empty($sat_end_time[$key]) ? NULL  : $sat_end_time[$key],
              'sat_break_time' => empty($sat_break_time[$key]) ? NULL  : $sat_break_time[$key],
              'sat_break_in_out' => serialize($sat_break_in_out),
              'sun_start_time' => empty($sun_start_time[$key]) ? NULL  : $sun_start_time[$key],
			  'sun_end_time' =>   empty($sun_end_time[$key]) ? NULL  : $sun_end_time[$key],
              'sun_break_time' => empty($sun_break_time[$key]) ? NULL  : $sun_break_time[$key],
              'sun_break_in_out' => serialize($sun_break_in_out),
              
              'Monday_layout' => empty($monday_layout[$key]) ? NULL  : $monday_layout[$key],
              'Tuesday_layout' => empty($tuesday_layout[$key]) ? NULL  : $tuesday_layout[$key],
              'Wednesday_layout' => empty($wed_layout[$key]) ? NULL  : $wed_layout[$key],
              'Thursday_layout' => empty($thus_layout[$key]) ? NULL  : $thus_layout[$key],
              'Friday_layout' => empty($fri_layout[$key]) ? NULL  : $fri_layout[$key],
              'Saturday_layout' => empty($sat_layout[$key]) ? NULL  : $sat_layout[$key],
              'Sunday_layout' => empty($sun_layout[$key]) ? NULL  : $sun_layout[$key],
              
              
              'roster_group_id'=> $roster_group_id,
              'branch_id' => $this->session->userdata('branch_id')			  
			  );
			 
		  $no_of_roster	= count($roster_id);
		
		 $no_of_employee = count($emp_ids);
   
   
  
    // time overlapping validation 		        
	// check time difference for all day seprately , if more than one roster added		       
	$indexes = array_keys($emp_ids, $emp_id);		     
    $lapped = "false"; 
    if(!empty($indexes) && count($indexes) > 1)  {
     //Monday

    if((isset($monday_start) && $monday_start[0] !='') && (isset($monday_end) && $monday_end[0] !='')){ 
$date1 = DateTime::createFromFormat('H:i a', $monday_start[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $monday_start[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $monday_end[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $monday_end[$indexes[0]]);

$reversecchk_current_key_date1 = $monday_end[$indexes[0]];
$reversecchk_current_key_date2 = $monday_start[$indexes[1]];
$reversecchk_current_key_date3 =  $monday_end[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
   $lapped = "true";
}
}


//Tuesday
if((isset($tuesday_start) && $tuesday_start[0] !='') && (isset($tuesday_end) && $tuesday_end[0] !='')){
$date1 = DateTime::createFromFormat('H:i a', $tuesday_start[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $tuesday_start[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $tuesday_end[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $tuesday_end[$indexes[0]]);

$reversecchk_current_key_date1 = $tuesday_end[$indexes[0]];
$reversecchk_current_key_date2 = $tuesday_start[$indexes[1]];
$reversecchk_current_key_date3 =  $tuesday_end[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
   $lapped = "true";
}		           
}
 
// wednesday



if((isset($wed_start_time) && $wed_start_time[0] !='') && (isset($wed_end_time) && $wed_end_time[0] !='')){ 
$date1 = DateTime::createFromFormat('H:i a', $wed_start_time[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $wed_start_time[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $wed_end_time[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $wed_end_time[$indexes[0]]);

$reversecchk_current_key_date1 = $wed_end_time[$indexes[0]];
$reversecchk_current_key_date2 = $wed_start_time[$indexes[1]];
$reversecchk_current_key_date3 =  $wed_end_time[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
  $lapped = "true";
}
}     
  
// thursday
       
 if((isset($thus_start_time) && $thus_start_time[0] !='') && (isset($thus_end_time) && $thus_end_time[0] !='')){     
$date1 = DateTime::createFromFormat('H:i a', $thus_start_time[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $thus_start_time[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $thus_end_time[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $thus_end_time[$indexes[0]]);

$reversecchk_current_key_date1 = $thus_end_time[$indexes[0]];
$reversecchk_current_key_date2 = $thus_start_time[$indexes[1]];
$reversecchk_current_key_date3 =  $thus_end_time[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
   $lapped = "true";
}
}

//friday
 if((isset($fri_start_time) && $fri_start_time[0] !='') && (isset($fri_end_time) && $fri_end_time[0] !='')){ 
$date1 = DateTime::createFromFormat('H:i a', $fri_start_time[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $fri_start_time[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $fri_end_time[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $fri_end_time[$indexes[0]]);

$reversecchk_current_key_date1 = $fri_end_time[$indexes[0]];
$reversecchk_current_key_date2 = $fri_start_time[$indexes[1]];
$reversecchk_current_key_date3 =  $fri_end_time[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
   $lapped = "true";
}
}
// saturday
if((isset($sat_start_time) && $sat_start_time[0] !='') && (isset($sat_end_time) && $sat_end_time[0] !='')){ 
$date1 = DateTime::createFromFormat('H:i a', $sat_start_time[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $sat_start_time[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $sat_end_time[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $sat_end_time[$indexes[0]]);

$reversecchk_current_key_date1 = $sat_end_time[$indexes[0]];
$reversecchk_current_key_date2 = $sat_start_time[$indexes[1]];
$reversecchk_current_key_date3 =  $sat_end_time[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
   $lapped = "true";
}

}

//sunday

// saturday
if((isset($sun_start_time) && $sun_start_time[0] !='') && (isset($sun_end_time) && $sun_end_time[0] !='')){ 
$date1 = DateTime::createFromFormat('H:i a', $sun_start_time[$indexes[0]]);
$date2 = DateTime::createFromFormat('H:i a', $sun_start_time[$indexes[1]]);
$date3 = DateTime::createFromFormat('H:i a', $sun_end_time[$indexes[1]]);
$date4 = DateTime::createFromFormat('H:i a', $sun_end_time[$indexes[0]]);

$reversecchk_current_key_date1 = $sun_end_time[$indexes[0]];
$reversecchk_current_key_date2 = $sun_start_time[$indexes[1]];
$reversecchk_current_key_date3 =  $sun_end_time[$indexes[1]];

if (($date1 > $date2 && $date1 < $date3) || ($reversecchk_current_key_date1 > $reversecchk_current_key_date2 && $reversecchk_current_key_date1 < $reversecchk_current_key_date3) || ($date1 == $date2 && ($date4 == $date3 || $date4 > $date3)) || ($date1 < $date2 && $date4 > $date3) )
{
   $lapped = "true";
}
       
     }
    
    //  if($lapped == "true"){
    //      $return_data['result'] = 'error';
    //      echo json_encode($return_data); exit;
      
    //  }           
    }
		
			 //   echo "<pre>";print_r($roster_id);
       if (isset($roster_id[$count]) && (in_array($roster_id[$count], $roster_id) && $roster_id[$count] != '')){
    //             echo "oldrecord";
			 //   echo "<pre>";print_r($data);
			    $roster = $this->admin_model->update_complete_roster($data,$roster_id[$count]);
			 
			
			$timesheetID = (isset($timeSheetID[0]->timesheet_id) ? $timeSheetID[0]->timesheet_id : '');
			   
			        if($emp_id != $prev_emp[$count]){
                        $this->admin_model->update_employee_timesheet_emps($prev_emp[$count],$emp_id,$timesheetID);
			        }
			   
			}else{
			 //   echo "newrecord";
			    	// 	 echo "<pre>";print_r($data); exit;
			    $roster = $this->admin_model->insert_roster($data);

		
		
		
		//  To add new added roster and employee to timehsheet while updating  roster	  ======================================  
			
// 		foreach($newlyaddedEmployees as $newlyaddedEmployeeID){
		 for($i=0;$i<7;$i++){
              $all_seven_days_of_roster = date("Y-m-d", strtotime($start_date . ' + ' . $i . 'day')); 
            $datafortimesheet = array(
          'employee_id' =>$emp_id,
          'roster_group_id' => $roster_group_id,
          'timesheet_id' => (isset($timeSheetID[0]->timesheet_id) ? $timeSheetID[0]->timesheet_id : ''),
          'roster_id' => $roster,
          'date'   => $all_seven_days_of_roster
            );
        //   echo "fgdh<pre>";print_r($datafortimesheet);
           
// if($roster_group_id ==14464){
// 	   	 echo $roster_group_id;
// 		 echo "<pre>";
// 		 print_r($datafortimesheet);
		 
// 	}

         $this->admin_model->submit_employee_timesheet($datafortimesheet);
//           if($roster_group_id == 12388){
//                 echo "<pre>";
// print_r($datafortimesheet);
// // exit;
//             }
           }
         
// 		}
			 
		// END =====================================================================================================================
		}
	
			  $count++;
			 
			}
// 	exit;
			if($roster){ 
			    	// $this->updateEmployeeTimesheet($roster_group_id);
			 // $this->session->set_flashdata('sucess_msg', 'Roster sucessfully added');
			   $return_data['result'] = 'Sucess';
			}else{
				// $this->session->set_flashdata('error_msg', 'Unable to add Roster');
				$return_data['result'] = 'result';
			}
	
			echo json_encode($return_data);
		   					
       }
	}
	
	
	function get_roster_weeks() {
	    $roleName = $this->ion_auth->get_users_groups()->row()->name;
	   $this->session->unset_userdata("rosterArr"); 
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
		
			 
			 
			$type='admin';
		   if($branch_id ==''){
		     	$user_email = $this->ion_auth->user()->row()->email;
			 	$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			   
		     $branch_id = $emp_id;
		     $type='employee';
		   }
			  
				
			   $total_records = $this->admin_model->get_total('roster',$branch_id,$type);

			   $records = $this->pagination_data_buildup($branch_id,'roster',$type,$total_records,'admin/get_roster_weeks');
			 //  echo "<pre>";
			 //  print_r($records);
			 //  exit;
			   if(!empty($records)){ 
			       $roster_list_for_dash = $records['records_data'];
                 $roster_list_for_dash = array_values($roster_list_for_dash);
                 	$data['roster']  = $roster_list_for_dash;
				$data['result_count']  = $records['result_count'];
			   }
                $employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
				$data['employees'] = $employees;
				
				$emp_departments = $this->admin_model->get_emp_departments_branchwise($branch_id);
				$data['emp_departments'] = $emp_departments;
				
				$outlet = $this->admin_model->get_outlet_branchwise($branch_id);
				$data['outlet'] = $outlet;
				
              $data['user_id']  = $this->session->userdata('user_id');
			
			    $data['role'] = $roleName;
				
				// echo "";print_r($data);exit;
				$this->load->view('general/header');
				$this->load->view('employees/roster_emp_table',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	
function fetchemp(){
    $rgID =$this->input->post('RGID');
   $rgIDS = unserialize($rgID);
    $EmpID = $this->input->post('EMPID');
     $roster = $this->admin_model->week_roster($rgIDS,$EmpID,true);
 
 // create UI fot data received
 
 $week_days = array('mon','tues','wed','thus','fri','sat','sun');
 $outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
if(!empty($roster)){
  foreach($roster as $row){ ?>

<input type='hidden' class="form-control" name="edit_view_all_roster" id="roster_group_id" value='<?php echo $rgIDS; ?>' >
<tr>
<td class="start_end" style="width:85px !important"></td>

<?php  for ($i = 0; $i < 7; $i++) { ?>
<td class="start_end">
<table class="sub-table">
<tr>
      <td class="child">Start</td>
      <td class="child">End</td>
      <td class="child">Break</td>
      <td class="child">Hrs</td>
</tr>
<tr>
      <?php $start_nameofday = $week_days[$i].'_start_time'; ?>
      <?php $start_name = $week_days[$i].'_start[]'; ?>
      <?php $end_name = $week_days[$i].'_end[]'; ?>
      <?php $break_name = $week_days[$i].'_break[]'; ?>
      <?php $outlet_name = $week_days[$i].'_layout[]'; ?>
      <?php $end_nameofday = $week_days[$i].'_end_time'; ?>
      <?php $break_nameofday = $week_days[$i].'_break_time'; ?>
       <?php $layout_nameofday = $outletweek_days[$i].'_layout'; ?>
     
      <?php 
      $time1 = strtotime($row->$start_nameofday);
      $time2 = strtotime($row->$end_nameofday);
      $break_hrs = $row->$break_nameofday;
      if($time2 !='' && $time1){
       $difference = round(abs(($time2 - $time1)) / 3600,2);
     $hr_in_min = $difference* 60;
     $difference = $hr_in_min - $break_hrs;
      $difference = floor($difference / 60).':'.($difference -   floor($difference / 60) * 60);    
      }else{
          $difference = 0;
      }
    
     ?>
     
      <td class="child start_height date datetimepicker3">
     
      <input class="editable_field" readonly type='text' name="<?php echo $start_name;  ?>" value="<?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i',strtotime($row->$start_nameofday)); } ?>">
     </td>
      
      <td class="child start_height date datetimepicker3">
      <input  class="editable_field" type='text' readonly name="<?php echo $end_name;  ?>" value="<?php if($row->$end_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i',strtotime($row->$end_nameofday)); }?>">
      </td>
      
      <td class="child start_height">
     <input  class="editable_field" type='text' readonly name="<?php echo $break_name;  ?>" value="<?php if($row->$break_nameofday > 0) { echo $row->$break_nameofday ;  } else {  echo '   '; }?>"> 
      </td>
      
      <td class="child start_height""><?php echo $difference; ?></td>
     
   </tr>
   <tr>
        <td colspan="4" class="child ct-font-td">Outlet</td>
    </tr>
    
   <tr>      
        <td colspan="4" class="child start_height ct-outlet">
        <input class="editable_field" type='text' readonly name="<?php echo $outlet_name;  ?>" value="<?php if(!empty($row->$layout_nameofday)) { echo $row->$layout_nameofday;  } else {  echo '   '; }?>">
    </td>
    </tr>
   </table>
   </td>
   <?php } ?>
   
</tr>
  <?php  } }else{ ?>
      
    <tr><b> <?php echo "No Roster Found For This Employee"; ?></b></tr>  
  <?php }
  
  
  
  // End of method=====================

    
}

	function view_all_roster(){
	  
	   $week_days = array('mon','tues','wed','thus','fri','sat','sun');
	   
	   $weekdaysnew  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	   $user_type='admin';
	   $branch_id = $this->location_id;
	   // get all public holiday to check the emp rate for holiday
	   $public_holidays = $this->admin_model->get_public_holidays();
	   
	   
	       
	    $employees = $this->admin_model->get_employees_branchwise($branch_id,$user_type);
	    $branches = $this->admin_model->fetch_branches($branch_id);
	    
	   
	    $user_email = $this->ion_auth->user()->row()->email;
		$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
	    
        foreach($weekdaysnew as $weekday){
        $index_name = $weekday.'_budget';
        $data[$weekday.'_budget'] = $branches[0]->$index_name;
        }
	    
	  
	  $week_earning_total = array();
	  $total_hrs_of_all_employee = 0;
	  
	   if(isset($_POST['options'])){         
	  foreach( $_POST['options'] as $roster_group_id){
	      
	     $roster[$roster_group_id] = $this->admin_model->week_roster($roster_group_id,$emp_id);
	     
	  }
	    $data['all_roster_group_ids'] = serialize($_POST['options']);

	   }else{
	       $rosterdatas = unserialize($this->session->userdata("rosterArr"));

	       foreach( $rosterdatas as $roster_group_id){
	      
	     $roster[$roster_group_id] = $this->admin_model->week_roster($roster_group_id,'');
	     
	  }
	    $data['all_roster_group_ids'] = serialize($rosterdatas);
	     
	   }
	   
	 if(!empty($roster)){
	       $week_earning =  0;
	       $avg_rate = 0;
	     
	        $total_hrs_of_all_emp_of_this_roster = 0;
                 
	     
				foreach($roster as $key1 => $roser_group){
				foreach($roser_group as $key => $ros){
				     
				     //now we will increment date part 
				     $roster_date = new DateTime($ros->start_date);
				     $roster_date->modify('-1 day');
				     $one_past_date = $roster_date->format('Y-m-d');

				    
				     $emp_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'first_name');
				     $emp_lastname= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'last_name');
				     $emp_email= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'email');
				     $emp_type= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'employee_type');
				    
				     $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         
				      // for getting the saturday and sunday and public holiday rate for the employess of this roster
				         
				     $roster_date = new DateTime($one_past_date);
				     $roster_date->modify('+1 day');
				     $todaysdate = $roster_date->format('Y-m-d');
				     $one_past_date = $todaysdate;
				     
				       $array_holiday = array_combine(array_map(function ($o) { return $o->date; }, $public_holidays), $public_holidays);
				    //   $array_holiday_branc_IDS = array_combine(array_map(function ($o) { return $o->branch_ids; }, $public_holidays), $public_holidays);
				       
				       //branch wise code needs to be done  not done now  
				    //   echo $week_days[$i]."</br>";;
                         if (array_key_exists($todaysdate,$array_holiday)){
                          // if today is punblic holiday get holiday emp rate 
                          $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'holiday_rate');
                         
                         }elseif($week_days[$i] == "sat"){
                             // if today is saturday get holiday satrday rate 
                             $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'Saturday_rate');
                          
                         }elseif($week_days[$i] == "sun"){
                             // iif today is sunday get holiday sunday rate 
                              $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'Sunday_rate');
                          
                         }else{
                              $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
                         }
                        
                      $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         
				         $break_hrs = $ros->$break_nameofday;
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
                         
                         if($time1 !='' && $time2 !=''){
                              $difference = round(abs(($time2 - $time1)) / 3600,2);
                               if($difference !='') {
                              $hr_in_min = $difference* 60;
                             $difference = $hr_in_min - $break_hrs;
                               }else{
                                  $difference = 0;
                               }
                             
                            if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                           $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 1; 
                            }else{
                           $data[$weekdaysnew[$i]."_average_hr_rate"] =  $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] =  1; 
                            } 
                                
                         }else{
                             
                             $difference =0;
                             if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                               $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + 0;
                               $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 0;   
                             }else{
                              $data[$weekdaysnew[$i]."_average_hr_rate"] =  0;
                              $data[$weekdaysnew[$i]."no_of_employee"] =  0;    
                             }
                         }
                        
                         $total_hrs_of_this_employee = $total_hrs_of_this_employee + $difference;
                         $total_pay = (($rate)/60) * $difference;
                        // convert total mins worked in hrs
                        //  $difference = date('G:i', mktime(0, $difference));
                        
                         $week_earning = $week_earning + $total_pay;
                         $index_name = $weekdaysnew[$i].'_budget';
                         $todays_budget =  $branches[0]->$index_name;
                         if(isset($data[$weekdaysnew[$i]."_cost"])){
                          $data[$weekdaysnew[$i]."_cost"] = $data[$weekdaysnew[$i]."_cost"] + $total_pay;
                         }else{
                          $data[$weekdaysnew[$i]."_cost"] = $total_pay;   
                         }
                         
                         
                         if(isset($daily[$weekdaysnew[$i]."_variance"])){
                              $daily[$weekdaysnew[$i]."_variance"] = $daily[$weekdaysnew[$i]."_variance"] + $total_pay;
                              $data[$weekdaysnew[$i]."_variance"] =  $todays_budget - $daily[$weekdaysnew[$i]."_variance"];
                         }else{
                             $daily[$weekdaysnew[$i]."_variance"] = $total_pay;
                             $data[$weekdaysnew[$i]."_variance"] =  $todays_budget- $total_pay;
                         }
                         
                         if(isset($branches[0]->$index_name) && $branches[0]->$index_name !='') {
                         if(isset($data[$weekdaysnew[$i]."_percentage"])){
                              $ad_perc = ( $total_pay / $branches[0]->$index_name ) * 100;
                              $data[$weekdaysnew[$i]."_percentage"] = $data[$weekdaysnew[$i]."_percentage"] + $ad_perc;
                         }else{
                            $data[$weekdaysnew[$i]."_percentage"] = ( $total_pay / $branches[0]->$index_name ) * 100;
                         }
                         }else{
                             $data[$weekdaysnew[$i]."_percentage"] = '';
                             
                         }

                         if(isset($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"])){
                             $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] + $difference;
                             $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"], '%02d Hours, %02d Minutes');;
                         }else{
                              $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $difference;
                              $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($difference, '%02d Hours, %02d Minutes');;
                              
                         }
                         
				     }
			
				    //   echo $avg_rate; echo "</br>";

				     $total_hrs_of_all_emp_of_this_roster = $total_hrs_of_all_emp_of_this_roster + $total_hrs_of_this_employee;
			         $total_hrs_of_individual_emp = $this->hoursandmins($total_hrs_of_this_employee, '%02d Hours, %02d Minutes');
				     $roster[$key1][$key]->emp_name = $emp_name.' '.$emp_lastname;
				     $roster[$key1][$key]->emp_type = str_replace("_"," ",ucfirst($emp_type));

				     $roster[$key1][$key]->start_date =  date("d-m-Y", strtotime($ros->start_date));
				     $roster[$key1][$key]->end_date = date("d-m-Y", strtotime($ros->end_date));
				     $roster[$key1][$key]->total_hrs = $total_hrs_of_this_employee;
				     $roster[$key1][$key]->emp_hours_worked_this_week = $total_hrs_of_individual_emp;
				     $roster[$key1][$key]->emp_email = $emp_email;
				     $roster[$key1][$key]->emp_rate = $rate;
				     $roster[$key1][$key]->roster_name = $ros->roster_name;
				     $data['roster_group_id'] = $ros->roster_group_id;
				    	}
				  	}
				
				  	if($this->session->userdata('supervisor') !=''){ 
			          $roleName= 'supervisor';
			      }else{
			          $roleName = $this->ion_auth->get_users_groups()->row()->name;
			      }
				  	//calculate total hour of all employee of this particular roster 
				  	
				$total_hrs_of_all_emp_of_this_roster = $this->hoursandmins($total_hrs_of_all_emp_of_this_roster, '%02d Hours, %02d Minutes');
				
				//Week earning is the total amount spent to pay employee salary this week,add casual employee hrly rate plus full time empoloyee weeekly salary
				$week_earning = $week_earning + $branches[0]->gross_salary_weekly;
				// check if weekly spent exceed the budget ,save a record in database and on weekeend send the report using cron job
				if($week_earning > $branches[0]->budget){
				   $exceeded_amount =  $week_earning - $branches[0]->budget;
				   $data_branch_exceed_amount = array(
				       'exceeded_amount' => $exceeded_amount
				       );
				  $this->admin_model->update_branch($this->branch_id,$data_branch_exceed_amount);  
				}
				
                // $data['daily_hrs_allocated' ] = $daily_hrs_allocated;
			    $data['total_hrs_of_all_emp_of_this_roster' ] = $total_hrs_of_all_emp_of_this_roster;
				$data['total_hrs_of_all_employee' ] = $total_hrs_of_this_employee;
                $data['week_earning' ] = number_format($week_earning,2);
                $percentage = ( $week_earning / $branches[0]->budget ) * 100;
                $data['percenatge' ] = number_format($percentage,2);
			    $data['user_type' ] = $user_type;
			    $data['role' ] = $roleName;
                $data['roster'] = $roster;
				$data['budget'] = $branches[0]->budget;
				$data['employees'] = $employees;
				$data['variance' ] =  number_format($branches[0]->budget - $week_earning,2);
				
				
            }
            	  	   
            	 
            	  $this->load->view('general/header');
            	  $this->load->view('employees/edit_view_all_roster',$data);
            	  $this->load->view('general/footer');
            	}
            	
            	function hoursandmins($time, $format = '%:%')
            {
                if ($time < 1) {
                    return;
                }
                $hours = floor($time / 60);
                $minutes = ($time % 60);
                return sprintf($format, $hours, $minutes);
            }
            	function update_multiple_roster(){
            	    	if (!$this->ion_auth->logged_in()) {
                        redirect('auth/login');
                    }else {
            
             $roster_ids = $_POST['roster_id'];
             $edit_view_all_roster = $_POST['edit_view_all_roster'];
             $this->session->unset_userdata("rosterArr"); 
             $this->session->set_userdata("rosterArr",$edit_view_all_roster);
			$roster_group_id = $_POST['roster_group_id'];
			
			$monday_start = (!empty($_POST['mon_start'])) ? $_POST['mon_start'] : '';
			$monday_end = (!empty($_POST['mon_end'])) ? $_POST['mon_end'] : '';
			$monday_break = (!empty($_POST['mon_break'])) ? $_POST['mon_break'] :'';
			$tuesday_start = (!empty($_POST['tues_start'])) ? $_POST['tues_start']: '';
			$tuesday_end = (!empty($_POST['tues_end'])) ?  $_POST['tues_end'] : '';
			$tuesday_break = (!empty($_POST['tues_break'])) ? $_POST['tues_break']: '';
			$wed_start_time = (!empty($_POST['wed_start'])) ? $_POST['wed_start']: '';
			$wed_end_time = (!empty($_POST['wed_end'])) ?  $_POST['wed_end']: '';
			$wed_break_time = (!empty($_POST['wed_break'])) ?  $_POST['wed_break']: '';
			$thus_start_time = (!empty($_POST['thus_start'])) ? $_POST['thus_start']: '';
			$thus_end_time = (!empty($_POST['thus_end'])) ? $_POST['thus_end']: '';
			$thus_break_time = (!empty($_POST['thus_break'])) ? $_POST['thus_break']: '';
			$fri_start_time = (!empty($_POST['fri_start'])) ? $_POST['fri_start']: '';
			$fri_end_time = (!empty($_POST['fri_end'])) ?  $_POST['fri_end']: '';
			$fri_break_time = (!empty($_POST['fri_break'])) ? $_POST['fri_break']: '';
			$sat_start_time = (!empty($_POST['sat_start'])) ?  $_POST['sat_start']: '';
			$sat_end_time = (!empty($_POST['sat_end'])) ?  $_POST['sat_end']: '';
			$sat_break_time = (!empty($_POST['sat_break'])) ? $_POST['sat_break']: '';
			$sun_start_time = (!empty($_POST['sun_start'])) ? $_POST['sun_start']: '';
			$sun_end_time = (!empty($_POST['sun_end'])) ? $_POST['sun_end']: '';
			$sun_break_time = (!empty($_POST['sun_break'])) ? $_POST['sun_break']: '';
			
			
			
			    $monday_layout = $_POST['mon_layout'];
			    $tuesday_layout = $_POST['tues_layout'];
				$wed_layout = $_POST['wed_layout'];
				$thus_layout = $_POST['thus_layout'];
				$fri_layout = $_POST['fri_layout'];
				$sat_layout = $_POST['sat_layout'];
			    $sun_layout = $_POST['sun_layout'];
			
		$count = 0;
			foreach($roster_ids as $key=>$roster_id){
			  $data = array(
			
              'mon_start_time' => empty($monday_start[$key]) ? NULL  : $monday_start[$key],
			  'mon_end_time' =>   empty($monday_end[$key]) ? NULL  : $monday_end[$key],
              'mon_break_time' => empty($monday_break[$key]) ? NULL  : strtok($monday_break[$key],' '),
              'tues_start_time' => empty($tuesday_start[$key]) ? NULL  : $tuesday_start[$key],
			  'tues_end_time' =>   empty($tuesday_end[$key]) ? NULL  : $tuesday_end[$key],
              'tues_break_time' => empty($tuesday_break[$key]) ? NULL  : strtok($tuesday_break[$key],' '),
              'wed_start_time' => empty($wed_start_time[$key]) ? NULL  : $wed_start_time[$key],
			  'wed_end_time' =>   empty($wed_end_time[$key]) ? NULL  : $wed_end_time[$key],
              'wed_break_time' => empty($wed_break_time[$key]) ? NULL  : strtok($wed_break_time[$key],' '),
              'thus_start_time' => empty($thus_start_time[$key]) ? NULL  : $thus_start_time[$key],
			  'thus_end_time' =>   empty($thus_end_time[$key]) ? NULL  : $thus_end_time[$key],
              'thus_break_time' => empty($thus_break_time[$key]) ? NULL  : strtok($thus_break_time[$key],' '),
              'fri_start_time' => empty($fri_start_time[$key]) ? NULL  : $fri_start_time[$key],
			  'fri_end_time' =>   empty($fri_end_time[$key]) ? NULL  : $fri_end_time[$key],
              'fri_break_time' => empty($fri_break_time[$key]) ? NULL  : strtok($fri_break_time[$key],' '),
              'sat_start_time' => empty($sat_start_time[$key]) ? NULL  : $sat_start_time[$key],
			  'sat_end_time' =>   empty($sat_end_time[$key]) ? NULL  : $sat_end_time[$key],
              'sat_break_time' => empty($sat_break_time[$key]) ? NULL  : strtok($sat_break_time[$key],' '),
              'sun_start_time' => empty($sun_start_time[$key]) ? NULL  : $sun_start_time[$key],
			  'sun_end_time' =>   empty($sun_end_time[$key]) ? NULL  : $sun_end_time[$key],
              'sun_break_time' => empty($sun_break_time[$key]) ? NULL  : strtok($sun_break_time[$key],' '),
              
              'Monday_layout' => empty($monday_layout[$key]) ? NULL  : $monday_layout[$key],
              'Tuesday_layout' => empty($tuesday_layout[$key]) ? NULL  : $tuesday_layout[$key],
              'Wednesday_layout' => empty($wed_layout[$key]) ? NULL  : $wed_layout[$key],
              'Thursday_layout' => empty($thus_layout[$key]) ? NULL  : $thus_layout[$key],
              'Friday_layout' => empty($fri_layout[$key]) ? NULL  : $fri_layout[$key],
              'Saturday_layout' => empty($sat_layout[$key]) ? NULL  : $sat_layout[$key],
              'Sunday_layout' => empty($sun_layout[$key]) ? NULL  : $sun_layout[$key],
              
              
              'roster_group_id'=> $roster_group_id,
              'branch_id' => $this->session->userdata('branch_id')			  
			  );
			 
		  $roster = $this->admin_model->update_complete_roster($data,$roster_id);
			}
	
			  if($roster){ 
			  $this->session->set_flashdata('sucess_msg', 'Roster sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add Roster');
			}
		    redirect('admin/view_all_roster');					
       }
	}
	function send_email(){
	    
	      $roster_group_id = $this->input->post('roster_group_id');
	      $Emaildata['loginlink'] = base_url()."index.php/auth/login/employee";
		  $msg = $this->load->view('emails/roster_update',$Emaildata,true);
		  $subject = "Manager has an update on your roster";

	     $rosterGroupIds = @unserialize($roster_group_id);
	     // check if there are multiple roster group id or just one in case of view all roster we can have multple roster grp ids
         if ($rosterGroupIds !== false) {
             
         foreach($rosterGroupIds as $rosterGroupId){
        $roster = $this->admin_model->week_roster($rosterGroupId,'');
        $this->MailSendRosterUpdate($roster,$msg,$subject); 
          }
         } else {
          
        $roster = $this->admin_model->week_roster($roster_group_id,'');
        $this->MailSendRosterUpdate($roster,$msg,$subject);
          }
         
     echo "success"; exit;
	 	}
	
	function MailSendRosterUpdate($roster=array(),$msg,$subject){
	 

	    if(!empty($roster)){
	     	foreach($roster as $key => $ros){

		    $emp_email= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'email');
		 
			$this->phpmailermail->ClearAddresses();
		    $this->phpmailermail->isHTML(true);
			$this->phpmailermail->addAddress($emp_email);
            $this->phpmailermail->Subject = $subject;
            $this->phpmailermail->Body = $msg;
                   
			 if($this->phpmailermail->send()){ 
			      echo "Mail sent to ".$emp_email;
			  }else{
			      echo "Email cannot send";
			  }
			}
	      }
	}
	
	function roster_filter($start_date,$end_date,$roster_name){
	    
	  $branch_id = $this->location_id;
			$type='admin';
		   if($branch_id ==''){
		   $user_email = $this->ion_auth->user()->row()->email;
		   $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
		   $branch_id = $emp_id;
		     $type='employee';
		   }
		   
	
	  $roster = $this->admin_model->roster_filter($start_date,$end_date,$branch_id,$roster_name,$type); 
	  
	  
	  $roleName = $this->ion_auth->get_users_groups()->row()->name;	
 $data['user_id']  = $this->session->userdata('user_id');
                $data['role'] =   $roleName;			
			    $data['roster'] = $roster;
				
				$this->load->view('general/header');
				$this->load->view('employees/roster_emp_table',$data);
				$this->load->view('general/footer');
	}
	function week_roster($roster_groupid,$type='') {
	  
	    if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			      $branch_id = $this->location_id;
			      
			      if($this->session->userdata('supervisor') !=''){ 
			          $roleName= 'supervisor';
			      }else{
			          $roleName = $this->ion_auth->get_users_groups()->row()->name;
			      }
			     // echo $role; exit;
	              $data['link'] = base_url()."index.php/admin/get_roster_weeks";
			    	
			      if($roleName=='employee'){
			       
			     	$user_email = $this->ion_auth->user()->row()->email;
			 	    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			        $user_type='employee';
		  	       }else{
			       $emp_id ='';
			       $user_type='admin';
			      }
			      
			   
			   $employees = $this->admin_model->get_employees_branchwise($branch_id,$user_type);
			   
			   $roster = $this->admin_model->week_roster($roster_groupid,$emp_id);
			   $branches = $this->admin_model->fetch_branches($branch_id);
			   
			    $week_days = array('mon','tues','wed','thus','fri','sat','sun');
			    $weekdaysnew  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
				$week_earning =  0;
			
	            $total_hrs_of_all_employee = 0;
	             foreach($weekdaysnew as $weekday){
                    $index_name = $weekday.'_budget';
                    $data[$weekday.'_budget'] = $branches[0]->$index_name;
                       }
	            
	            if(!empty($roster)){
				foreach($roster as $key => $ros){
				    
				     $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
				     $emp_first_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'first_name');
				     $emp_last_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'last_name');
				     $emp_email= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'email');
				     $emp_type= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'employee_type');
				     
				   
				     
				     $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         $break_hrs = $ros->$break_nameofday;
				         
				         if($break_hrs ==''){
				              $break_hrs = 0;
				         }
				         
				         
				         if((isset($start_nameofday) && $start_nameofday !='') && (isset($end_nameofday) && $end_nameofday !='')){
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
                         
                         if($time2 !='' && $time1 !=''){
                             $difference = round(abs(($time2 - $time1)) / 3600,2);
                             if($difference !='' && $difference !=0){
                             $hr_in_min = $difference* 60;
                             $difference = $hr_in_min - $break_hrs;
                             $total_hrs_of_this_employee = $total_hrs_of_this_employee + $difference;
                             $total_pay = (($rate)/60) * $difference;
                             //  $difference = date('G:i', mktime(0, $difference));
                        
                         $week_earning = $week_earning + $total_pay;
                         $index_name = $weekdaysnew[$i].'_budget';
                         $todays_budget =  $branches[0]->$index_name;
                         if(isset($data[$weekdaysnew[$i]."_cost"])){
                          $data[$weekdaysnew[$i]."_cost"] = $data[$weekdaysnew[$i]."_cost"] + $total_pay;
                         }else{
                          $data[$weekdaysnew[$i]."_cost"] = $total_pay;   
                         }
                         
                         
                         
                         if(isset($daily[$weekdaysnew[$i]."_variance"])){
                              $daily[$weekdaysnew[$i]."_variance"] = $daily[$weekdaysnew[$i]."_variance"] + $total_pay;
                              $data[$weekdaysnew[$i]."_variance"] =  $todays_budget - $daily[$weekdaysnew[$i]."_variance"];
                         }else{
                             $daily[$weekdaysnew[$i]."_variance"] = $total_pay;
                             $data[$weekdaysnew[$i]."_variance"] =  $todays_budget- $total_pay;
                         }
                         
                         if(isset($data[$weekdaysnew[$i]."_percentage"])){
                              $ad_perc = ( $total_pay / $branches[0]->$index_name ) * 100;
                              $data[$weekdaysnew[$i]."_percentage"] = $data[$weekdaysnew[$i]."_percentage"] + $ad_perc;
                         }else{
                            $data[$weekdaysnew[$i]."_percentage"] = ( $total_pay / $branches[0]->$index_name ) * 100;
                         }

                         if(isset($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"])){
                             $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] + $difference;
                             $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"], '%02d Hours, %02d Minutes');;
                         }else{
                              $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $difference;
                              $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($difference, '%02d Hours, %02d Minutes');;
                              
                         }
                             }
                             
                             
                        if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                           $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 1; 
                            }else{
                               
                           $data[$weekdaysnew[$i]."_average_hr_rate"] =  $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] =  1; 
                            } 
                                
                         }else{
                             
                             $difference =0;
                             if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                               $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + 0;
                               $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 0;   
                             }else{
                              $data[$weekdaysnew[$i]."_average_hr_rate"] =  0;
                              $data[$weekdaysnew[$i]."no_of_employee"] =  0;    
                             }
                         }
				     }
				     }
				     
				     $total_hrs_of_all_employee = $total_hrs_of_this_employee + $total_hrs_of_all_employee;
			         $total_hrs_of_this_employee = floor($total_hrs_of_this_employee / 60).':'.($total_hrs_of_this_employee -   floor($total_hrs_of_this_employee / 60) * 60);
			         
                     	$roles=$this->admin_model->fetch_role($branch_id);
		                $data['roles'] = $roles;


				     $data['role'] = $roleName;
				     $roster[$key]->emp_name = 	$emp_first_name.' '.	$emp_last_name;
				     $roster[$key]->emp_type = 	str_replace("_"," ",ucfirst($emp_type));;
				     $roster[$key]->emp_hours_worked_this_week = $total_hrs_of_this_employee;
				     $roster[$key]->emp_email = $emp_email;
				     $roster[$key]->emp_rate = $rate;
				     $s_datee = $ros->start_date;
				     $e_date = $ros->end_date;
				     $roster_name = $ros->roster_name;
				     $data['roster_group_id'] = $ros->roster_group_id;
				     $data['total_hrs_of_this_employee'] = $total_hrs_of_this_employee;
				     	}
			
			$total_hrs_of_all_employee = floor($total_hrs_of_all_employee / 60).':'.($total_hrs_of_all_employee -   floor($total_hrs_of_all_employee / 60) * 60);
            
                $data['total_hrs_of_all_employee' ] = $total_hrs_of_all_employee;
                $data['week_earning' ] = $week_earning;
			    $data['user_type' ] = $user_type;
				$data['employees'] = $employees;
                $data['roster'] = $roster;
                $data['start_date'] = $newDate = date("d-m-Y", strtotime($s_datee));
				$data['budget'] = $branches[0]->budget;
				$data['end_date'] = $e_date = date("d-m-Y", strtotime($e_date));
				$data['roster_name'] = $roster_name;
				
				
				$weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                 foreach($weekdays as $weekday){
                     $index_name = $weekday.'_budget';
                     $data[$weekday.'_budget'] = $branches[0]->$index_name;
                 }
             
             
          
				$this->load->view('general/header');

				if($type == 'edit'){
				  $this->load->view('employees/edit_roster',$data); 
				}elseif($type == 'recreate'){
				  $this->load->view('employees/re_create_roster',$data);   
				}
				else{
				$this->load->view('employees/edit_view_roster',$data);
				}
        }
				// $this->load->view('general/footer');
          	
		}
	}
	function week_roster_beta($roster_groupid,$type='') {
	  
	    if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			      $branch_id = $this->location_id;
			      if($this->session->userdata('supervisor') !=''){ 
			          $roleName= 'supervisor';
			      }else{
			          $roleName = $this->ion_auth->get_users_groups()->row()->name;
			      }
			   
	              $data['link'] = base_url()."index.php/admin/get_roster_weeks";
			    	
			      if($roleName=='employee'){
			       
			     	$user_email = $this->ion_auth->user()->row()->email;
			 	    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			        $user_type='employee';
		  	       }else{
			       $emp_id ='';
			       $user_type='admin';
			      }
			      
			   
			   $employees = $this->admin_model->get_employees_branchwise($branch_id,$user_type);
	
			   $roster = $this->admin_model->week_roster_beta($roster_groupid,$emp_id);
			   	 //  echo "<pre>";print_r($roster);exit;
			   $branches = $this->admin_model->fetch_branches($branch_id);
			   
			    $week_days = array('mon','tues','wed','thus','fri','sat','sun');
			    $weekdaysnew  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
				$week_earning =  0;
			
	            $total_hrs_of_all_employee = 0;
	             foreach($weekdaysnew as $weekday){
                    $index_name = $weekday.'_budget';
                    $data[$weekday.'_budget'] = $branches[0]->$index_name;
                       }
	            
	            if(!empty($roster)){
				foreach($roster as $key => $ros){
				    
				     $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
				     $emp_first_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'first_name');
				     $emp_last_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'last_name');
				     $emp_email= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'email');
				     $emp_type= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'employee_type');
				     
				    
				     $Monday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Monday_layout);
				     $Tuesday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Tuesday_layout);
				     $Wednesday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Wednesday_layout);
				     $Thursday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Thursday_layout);
				     $Friday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Friday_layout);
				     $Saturday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Saturday_layout);
				     $Sunday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Sunday_layout);
				     
				   
				     
				     $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         $break_hrs = $ros->$break_nameofday;
				         
				         if($break_hrs ==''){
				              $break_hrs = 0;
				         }
				         
				         
				         if((isset($start_nameofday) && $start_nameofday !='') && (isset($end_nameofday) && $end_nameofday !='')){
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
                         
                         if($time2 !='' && $time1 !=''){
                             $difference = round(abs(($time2 - $time1)) / 3600,2);
                             if($difference !='' && $difference !=0){
                             $hr_in_min = $difference* 60;
                             $difference = $hr_in_min - $break_hrs;
                             $total_hrs_of_this_employee = $total_hrs_of_this_employee + $difference;
                             $total_pay = (($rate)/60) * $difference;
                             //  $difference = date('G:i', mktime(0, $difference));
                        
                         $week_earning = $week_earning + $total_pay;
                         $index_name = $weekdaysnew[$i].'_budget';
                         $todays_budget =  $branches[0]->$index_name;
                         if(isset($data[$weekdaysnew[$i]."_cost"])){
                          $data[$weekdaysnew[$i]."_cost"] = $data[$weekdaysnew[$i]."_cost"] + $total_pay;
                         }else{
                          $data[$weekdaysnew[$i]."_cost"] = $total_pay;   
                         }
                         
                         
                         
                         if(isset($daily[$weekdaysnew[$i]."_variance"])){
                              $daily[$weekdaysnew[$i]."_variance"] = $daily[$weekdaysnew[$i]."_variance"] + $total_pay;
                              $data[$weekdaysnew[$i]."_variance"] =  $todays_budget - $daily[$weekdaysnew[$i]."_variance"];
                         }else{
                             $daily[$weekdaysnew[$i]."_variance"] = $total_pay;
                             $data[$weekdaysnew[$i]."_variance"] =  $todays_budget- $total_pay;
                         }
                         
                         if(isset($data[$weekdaysnew[$i]."_percentage"])){
                              $ad_perc = ( $total_pay / $branches[0]->$index_name ) * 100;
                              $data[$weekdaysnew[$i]."_percentage"] = $data[$weekdaysnew[$i]."_percentage"] + $ad_perc;
                         }else{
                            $data[$weekdaysnew[$i]."_percentage"] = ( $total_pay / $branches[0]->$index_name ) * 100;
                         }

                         if(isset($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"])){
                             $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] + $difference;
                             $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"], '%02d , %02d');;
                         }else{
                              $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $difference;
                              $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($difference, '%02d: %02d');;
                              
                         }
                             }
                             
                             
                        if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                           $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 1; 
                            }else{
                               
                           $data[$weekdaysnew[$i]."_average_hr_rate"] =  $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] =  1; 
                            } 
                                
                         }else{
                             
                             $difference =0;
                             if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                               $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + 0;
                               $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 0;   
                             }else{
                              $data[$weekdaysnew[$i]."_average_hr_rate"] =  0;
                              $data[$weekdaysnew[$i]."no_of_employee"] =  0;    
                             }
                         }
				     }
				     }
				     
				     $total_hrs_of_all_employee = $total_hrs_of_this_employee + $total_hrs_of_all_employee;
			         $total_hrs_of_this_employee = floor($total_hrs_of_this_employee / 60).':'.($total_hrs_of_this_employee -   floor($total_hrs_of_this_employee / 60) * 60);
			         
                     	$roles=$this->admin_model->fetch_role($branch_id);
		                $data['roles'] = $roles;


				     $data['role'] = $roleName;
				     $roster[$key]->emp_name = 	$emp_first_name.' '.	$emp_last_name;
				     $roster[$key]->emp_type = 	str_replace("_"," ",ucfirst($emp_type));;
				     $roster[$key]->emp_hours_worked_this_week = $total_hrs_of_this_employee;
				     $roster[$key]->emp_email = $emp_email;
				     $roster[$key]->emp_rate = $rate;
				     
				     $roster[$key]->Monday_layout_name = $Monday_layout;
				     $roster[$key]->Tuesday_layout_name = $Tuesday_layout;
				     $roster[$key]->Wednesday_layout_name = $Wednesday_layout;
				     $roster[$key]->Thursday_layout_name = $Thursday_layout;
				     $roster[$key]->Friday_layout_name = $Friday_layout;
				     $roster[$key]->Saturday_layout_name = $Saturday_layout;
				     $roster[$key]->Sunday_layout_name = $Sunday_layout;
				     
				     $s_datee = $ros->start_date;
				     $e_date = $ros->end_date;
				     $month = $ros->month;
				     $roster_department = $ros->roster_department;
				     $roster_comment = $ros->roster_comment;
				     $roster_name = $ros->roster_name;
				     $data['roster_group_id'] = $ros->roster_group_id;
				     $data['total_hrs_of_this_employee'] = $total_hrs_of_this_employee;
				     	}
			
			$total_hrs_of_all_employee = floor($total_hrs_of_all_employee / 60).':'.($total_hrs_of_all_employee -   floor($total_hrs_of_all_employee / 60) * 60);
            
                $data['total_hrs_of_all_employee' ] = $total_hrs_of_all_employee;
                $data['week_earning' ] = $week_earning;
			    $data['user_type' ] = $user_type;
				$data['employees'] = $employees;
                $data['roster'] = $roster;
                $data['start_date'] = $newDate = date("d-m-Y", strtotime($s_datee));
				$data['budget'] = $branches[0]->budget;
				$data['end_date'] = $e_date = date("d-m-Y", strtotime($e_date));
				$data['month'] = $month;
				$data['roster_department'] = $roster_department;
				$data['roster_comment'] = $roster_comment;
				$data['roster_template'] = 1;
				$data['roster_name'] = $roster_name;
				
				
				$weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                 foreach($weekdays as $weekday){
                     $index_name = $weekday.'_budget';
                     $data[$weekday.'_budget'] = $branches[0]->$index_name;
                 }
             
             $emp_departments = $this->admin_model->get_emp_departments_branchwise($branch_id);
				$data['emp_departments'] = $emp_departments;
				
				$outlet = $this->admin_model->get_outlet_branchwise($branch_id);
				$data['outlet'] = $outlet;
        //   echo "<pre>";print_r($data);exit;
				$this->load->view('general/header');

				if($type == 'edit'){
				    
				  $this->load->view('employees/edit_roster_beta',$data); 
				}elseif($type == 'recreate'){
				  $this->load->view('employees/re_create_roster_beta',$data);   
				}
				else{
				$this->load->view('employees/edit_view_roster_beta',$data);
				}
        }
				$this->load->view('general/footer');
          	
		}
	}
	function week_roster_by_day($roster_groupid,$type='') {
	  
	    if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			      $branch_id = $this->location_id;
			      if($this->session->userdata('supervisor') !=''){ 
			          $roleName= 'supervisor';
			      }else{
			          $roleName = $this->ion_auth->get_users_groups()->row()->name;
			      }
			   
	              $data['link'] = base_url()."index.php/admin/get_roster_weeks";
			    	
			      if($roleName=='employee'){
			       
			     	$user_email = $this->ion_auth->user()->row()->email;
			 	    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			        $user_type='employee';
		  	       }else{
			       $emp_id ='';
			       $user_type='admin';
			      }
			      
			   
			   $employees = $this->admin_model->get_employees_branchwise($branch_id,$user_type);
	
			   $roster = $this->admin_model->week_roster_beta($roster_groupid,$emp_id);
			   	 //  echo "<pre>";print_r($roster);exit;
			   $branches = $this->admin_model->fetch_branches($branch_id);
			   
			    $week_days = array('mon','tues','wed','thus','fri','sat','sun');
			    $weekdaysnew  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
				$week_earning =  0;
			
	            $total_hrs_of_all_employee = 0;
	             foreach($weekdaysnew as $weekday){
                    $index_name = $weekday.'_budget';
                    $data[$weekday.'_budget'] = $branches[0]->$index_name;
                       }
	            
	            if(!empty($roster)){
				foreach($roster as $key => $ros){
				    
				     $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
				     $emp_first_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'first_name');
				     $emp_last_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'last_name');
				     $emp_email= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'email');
				     $emp_type= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'employee_type');
				     
				    
				     $Monday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Monday_layout);
				     $Tuesday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Tuesday_layout);
				     $Wednesday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Wednesday_layout);
				     $Thursday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Thursday_layout);
				     $Friday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Friday_layout);
				     $Saturday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Saturday_layout);
				     $Sunday_layout = $this->admin_model->get_outlet_details_fieldwise($ros->Sunday_layout);
				     
				   
				     
				     $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         $break_hrs = $ros->$break_nameofday;
				         
				         if($break_hrs ==''){
				              $break_hrs = 0;
				         }
				         
				         
				         if((isset($start_nameofday) && $start_nameofday !='') && (isset($end_nameofday) && $end_nameofday !='')){
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
                         
                         if($time2 !='' && $time1 !=''){
                             $difference = round(abs(($time2 - $time1)) / 3600,2);
                             if($difference !='' && $difference !=0){
                             $hr_in_min = $difference* 60;
                             $difference = $hr_in_min - $break_hrs;
                             $total_hrs_of_this_employee = $total_hrs_of_this_employee + $difference;
                             $total_pay = (($rate)/60) * $difference;
                             //  $difference = date('G:i', mktime(0, $difference));
                        
                         $week_earning = $week_earning + $total_pay;
                         $index_name = $weekdaysnew[$i].'_budget';
                         $todays_budget =  $branches[0]->$index_name;
                         if(isset($data[$weekdaysnew[$i]."_cost"])){
                          $data[$weekdaysnew[$i]."_cost"] = $data[$weekdaysnew[$i]."_cost"] + $total_pay;
                         }else{
                          $data[$weekdaysnew[$i]."_cost"] = $total_pay;   
                         }
                         
                         
                         
                         if(isset($daily[$weekdaysnew[$i]."_variance"])){
                              $daily[$weekdaysnew[$i]."_variance"] = $daily[$weekdaysnew[$i]."_variance"] + $total_pay;
                              $data[$weekdaysnew[$i]."_variance"] =  $todays_budget - $daily[$weekdaysnew[$i]."_variance"];
                         }else{
                             $daily[$weekdaysnew[$i]."_variance"] = $total_pay;
                             $data[$weekdaysnew[$i]."_variance"] =  $todays_budget- $total_pay;
                         }
                         
                         if(isset($data[$weekdaysnew[$i]."_percentage"])){
                              $ad_perc = ( $total_pay / $branches[0]->$index_name ) * 100;
                              $data[$weekdaysnew[$i]."_percentage"] = $data[$weekdaysnew[$i]."_percentage"] + $ad_perc;
                         }else{
                            $data[$weekdaysnew[$i]."_percentage"] = ( $total_pay / $branches[0]->$index_name ) * 100;
                         }

                         if(isset($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"])){
                             $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] + $difference;
                             $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"], '%02d , %02d');;
                         }else{
                              $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $difference;
                              $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($difference, '%02d: %02d');;
                              
                         }
                             }
                             
                             
                        if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                           $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 1; 
                            }else{
                               
                           $data[$weekdaysnew[$i]."_average_hr_rate"] =  $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] =  1; 
                            } 
                                
                         }else{
                             
                             $difference =0;
                             if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                               $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + 0;
                               $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 0;   
                             }else{
                              $data[$weekdaysnew[$i]."_average_hr_rate"] =  0;
                              $data[$weekdaysnew[$i]."no_of_employee"] =  0;    
                             }
                         }
				     }
				     }
				     
				     $total_hrs_of_all_employee = $total_hrs_of_this_employee + $total_hrs_of_all_employee;
			         $total_hrs_of_this_employee = floor($total_hrs_of_this_employee / 60).':'.($total_hrs_of_this_employee -   floor($total_hrs_of_this_employee / 60) * 60);
			         
                     	$roles=$this->admin_model->fetch_role($branch_id);
		                $data['roles'] = $roles;


				     $data['role'] = $roleName;
				     $roster[$key]->emp_name = 	$emp_first_name.' '.	$emp_last_name;
				     $roster[$key]->emp_type = 	str_replace("_"," ",ucfirst($emp_type));;
				     $roster[$key]->emp_hours_worked_this_week = $total_hrs_of_this_employee;
				     $roster[$key]->emp_email = $emp_email;
				     $roster[$key]->emp_rate = $rate;
				     
				     $roster[$key]->Monday_layout_name = $Monday_layout;
				     $roster[$key]->Tuesday_layout_name = $Tuesday_layout;
				     $roster[$key]->Wednesday_layout_name = $Wednesday_layout;
				     $roster[$key]->Thursday_layout_name = $Thursday_layout;
				     $roster[$key]->Friday_layout_name = $Friday_layout;
				     $roster[$key]->Saturday_layout_name = $Saturday_layout;
				     $roster[$key]->Sunday_layout_name = $Sunday_layout;
				     
				     $s_datee = $ros->start_date;
				     $e_date = $ros->end_date;
				     $month = $ros->month;
				     $roster_department = $ros->roster_department;
				     $roster_comment = $ros->roster_comment;
				     $roster_name = $ros->roster_name;
				     $data['roster_group_id'] = $ros->roster_group_id;
				     $data['total_hrs_of_this_employee'] = $total_hrs_of_this_employee;
				     	}
			
			$total_hrs_of_all_employee = floor($total_hrs_of_all_employee / 60).':'.($total_hrs_of_all_employee -   floor($total_hrs_of_all_employee / 60) * 60);
            
                $data['total_hrs_of_all_employee' ] = $total_hrs_of_all_employee;
                $data['week_earning' ] = $week_earning;
			    $data['user_type' ] = $user_type;
				$data['employees'] = $employees;
                $data['roster'] = $roster;
                $data['start_date'] = $newDate = date("d-m-Y", strtotime($s_datee));
				$data['budget'] = $branches[0]->budget;
				$data['end_date'] = $e_date = date("d-m-Y", strtotime($e_date));
				$data['month'] = $month;
				$data['roster_department'] = $roster_department;
				$data['roster_comment'] = $roster_comment;
				$data['roster_template'] = 1;
				$data['roster_name'] = $roster_name;
				
				
				$weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                 foreach($weekdays as $weekday){
                     $index_name = $weekday.'_budget';
                     $data[$weekday.'_budget'] = $branches[0]->$index_name;
                 }
             
             $emp_departments = $this->admin_model->get_emp_departments_branchwise($branch_id);
				$data['emp_departments'] = $emp_departments;
				
				$outlet = $this->admin_model->get_outlet_branchwise($branch_id);
				$data['outlet'] = $outlet;
                //   echo "<pre>";print_r($data);exit;
				$this->load->view('general/header');

				if($type == 'edit'){
				    
				  $this->load->view('employees/edit_roster_by_day',$data); 
				}elseif($type == 'recreate'){
				  $this->load->view('employees/re_create_roster_by_day',$data);   
				}
				else{
				$this->load->view('employees/view_roster_by_day',$data);
				}
            }
				$this->load->view('general/footer');
          	
		}
	}

	function create_roster_by_day() {
	    $roleName = $this->ion_auth->get_users_groups()->row()->name;
	   $this->session->unset_userdata("rosterArr"); 
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$branch_id = $this->location_id;
		
			 
			 
			$type='admin';
		   if($branch_id ==''){
		     	$user_email = $this->ion_auth->user()->row()->email;
			 	$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			   
		     $branch_id = $emp_id;
		     $type='employee';
		   }
			  
				
			   $total_records = $this->admin_model->get_total('roster',$branch_id,$type);

			   $records = $this->pagination_data_buildup($branch_id,'roster',$type,$total_records,'admin/get_roster_weeks');
			 //  echo "<pre>";
			 //  print_r($records);
			 //  exit;
			   if(!empty($records)){ 
			       $roster_list_for_dash = $records['records_data'];
                 $roster_list_for_dash = array_values($roster_list_for_dash);
                 	$data['roster']  = $roster_list_for_dash;
				$data['result_count']  = $records['result_count'];
			   }
                $employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
				$data['employees'] = $employees;
				
				$emp_departments = $this->admin_model->get_emp_departments_branchwise($branch_id);
				$data['emp_departments'] = $emp_departments;
				
				$outlet = $this->admin_model->get_outlet_branchwise($branch_id);
				$data['outlet'] = $outlet;
				
              $data['user_id']  = $this->session->userdata('user_id');
			
			    $data['role'] = $roleName;
				
				// echo "<pre>";print_r($data);exit;
				$this->load->view('general/header');
				$this->load->view('employees/create_roster_by_day',$data);
				$this->load->view('general/footer');
          	
		}
	}
		function week_roster_download($roster_groupid,$type='') {
// 		    ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	  
	    if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			      $branch_id = $this->location_id;
			      if($this->session->userdata('supervisor') !=''){ 
			          $roleName = 'supervisor';
			      }else{
			          $roleName = $this->ion_auth->get_users_groups()->row()->name;
			      }
			   
	              $data['link'] = base_url()."index.php/admin/get_roster_weeks";
			    	
			      if($roleName=='employee'){
			       
			     	$user_email = $this->ion_auth->user()->row()->email;
			 	    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			        $user_type='employee';
		  	       }else{
			       $emp_id ='';
			       $user_type='admin';
			      }
			      
			   
			   $employees = $this->admin_model->get_employees_branchwise($branch_id,$user_type);
	
			   $roster = $this->admin_model->week_roster_beta($roster_groupid,$emp_id);
			   	 //  echo "<pre>";print_r($roster);exit;
			   $branches = $this->admin_model->fetch_branches($branch_id);
			   
			    $week_days = array('mon','tues','wed','thus','fri','sat','sun');
			    $weekdaysnew  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
				$week_earning =  0;
			
	            $total_hrs_of_all_employee = 0;
	             foreach($weekdaysnew as $weekday){
                    $index_name = $weekday.'_budget';
                    $data[$weekday.'_budget'] = $branches[0]->$index_name;
                       }
	            
	            if(!empty($roster)){
				foreach($roster as $key => $ros){
				    
				     $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
				     $emp_first_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'first_name');
				     $emp_last_name= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'last_name');
				     $emp_email= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'email');
				     $emp_type= $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'employee_type');
				     
				   
				     
				     $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         $break_hrs = $ros->$break_nameofday;
				         
				         if($break_hrs ==''){
				              $break_hrs = 0;
				         }
				         
				         
				         if((isset($start_nameofday) && $start_nameofday !='') && (isset($end_nameofday) && $end_nameofday !='')){
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
                         
                         if($time2 !='' && $time1 !=''){
                             $difference = round(abs(($time2 - $time1)) / 3600,2);
                             if($difference !='' && $difference !=0){
                             $hr_in_min = $difference* 60;
                             $difference = $hr_in_min - $break_hrs;
                             $total_hrs_of_this_employee = $total_hrs_of_this_employee + $difference;
                             $total_pay = (($rate)/60) * $difference;
                             //  $difference = date('G:i', mktime(0, $difference));
                        
                         $week_earning = $week_earning + $total_pay;
                         $index_name = $weekdaysnew[$i].'_budget';
                         $todays_budget =  $branches[0]->$index_name;
                         if(isset($data[$weekdaysnew[$i]."_cost"])){
                          $data[$weekdaysnew[$i]."_cost"] = $data[$weekdaysnew[$i]."_cost"] + $total_pay;
                         }else{
                          $data[$weekdaysnew[$i]."_cost"] = $total_pay;   
                         }
                         
                         
                         
                         if(isset($daily[$weekdaysnew[$i]."_variance"])){
                              $daily[$weekdaysnew[$i]."_variance"] = $daily[$weekdaysnew[$i]."_variance"] + $total_pay;
                              $data[$weekdaysnew[$i]."_variance"] =  $todays_budget - $daily[$weekdaysnew[$i]."_variance"];
                         }else{
                             $daily[$weekdaysnew[$i]."_variance"] = $total_pay;
                             $data[$weekdaysnew[$i]."_variance"] =  $todays_budget- $total_pay;
                         }
                         
                         if(isset($data[$weekdaysnew[$i]."_percentage"])){
                              $ad_perc = ( $total_pay / $branches[0]->$index_name ) * 100;
                              $data[$weekdaysnew[$i]."_percentage"] = $data[$weekdaysnew[$i]."_percentage"] + $ad_perc;
                         }else{
                            $data[$weekdaysnew[$i]."_percentage"] = ( $total_pay / $branches[0]->$index_name ) * 100;
                         }

                         if(isset($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"])){
                             $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] + $difference;
                             $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"], '%02d , %02d');;
                         }else{
                              $daily_hrs_allocated[$weekdaysnew[$i]."_hrs_allocated"] = $difference;
                              $data[$weekdaysnew[$i]."_hrs_allocated"] = $this->hoursandmins($difference, '%02d: %02d');;
                              
                         }
                             }
                             
                             
                        if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                           $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 1; 
                            }else{
                               
                           $data[$weekdaysnew[$i]."_average_hr_rate"] =  $rate;  
                           $data[$weekdaysnew[$i]."no_of_employee"] =  1; 
                            } 
                                
                         }else{
                             
                             $difference =0;
                             if(isset($data[$weekdaysnew[$i]."_average_hr_rate"]) && $data[$weekdaysnew[$i]."_average_hr_rate"] !=''){
                               $data[$weekdaysnew[$i]."_average_hr_rate"] = $data[$weekdaysnew[$i]."_average_hr_rate"] + 0;
                               $data[$weekdaysnew[$i]."no_of_employee"] = $data[$weekdaysnew[$i]."no_of_employee"] + 0;   
                             }else{
                              $data[$weekdaysnew[$i]."_average_hr_rate"] =  0;
                              $data[$weekdaysnew[$i]."no_of_employee"] =  0;    
                             }
                         }
				     }
				     }
				     
				     $total_hrs_of_all_employee = $total_hrs_of_this_employee + $total_hrs_of_all_employee;
			         $total_hrs_of_this_employee = floor($total_hrs_of_this_employee / 60).':'.($total_hrs_of_this_employee -   floor($total_hrs_of_this_employee / 60) * 60);
			         
                     	$roles=$this->admin_model->fetch_role($branch_id);
		                $data['roles'] = $roles;


				     $data['role'] = $roleName;
				     $roster[$key]->emp_name = 	$emp_first_name.' '.	$emp_last_name;
				     $roster[$key]->emp_type = 	str_replace("_"," ",ucfirst($emp_type));;
				     $roster[$key]->emp_hours_worked_this_week = $total_hrs_of_this_employee;
				     $roster[$key]->emp_email = $emp_email;
				     $roster[$key]->emp_rate = $rate;
				     $s_datee = $ros->start_date;
				     $e_date = $ros->end_date;
				     $month = $ros->month;
				     $roster_department = $ros->roster_department;
				     $roster_name = $ros->roster_name;
				     $data['roster_group_id'] = $ros->roster_group_id;
				     $data['total_hrs_of_this_employee'] = $total_hrs_of_this_employee;
				     	}
			
			$total_hrs_of_all_employee = floor($total_hrs_of_all_employee / 60).':'.($total_hrs_of_all_employee -   floor($total_hrs_of_all_employee / 60) * 60);
            
    //             $data['total_hrs_of_all_employee' ] = $total_hrs_of_all_employee;
    //             $data['week_earning' ] = $week_earning;
			 //   $data['user_type' ] = $user_type;
				// $data['employees'] = $employees;
    //             $data['roster'] = $roster;
                $start_date= date("d-m-Y", strtotime($s_datee));
				// $data['budget'] = $branches[0]->budget;
				$end_date = date("d-m-Y", strtotime($e_date));
				// $data['month'] = $month;
				// $data['roster_department'] = $roster_department;
				// $data['roster_template'] = 1;
				// $data['roster_name'] = $roster_name;
				// 
				
				$weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                 foreach($weekdays as $weekday){
                     $index_name = $weekday.'_budget';
                     $data[$weekday.'_budget'] = $branches[0]->$index_name;
                 }
             
            //  spreadsheet code
            $datee = new DateTime($start_date);
            $mondate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuedate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   
                     
            $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffef8a');
        $spreadsheet->getActiveSheet()->getStyle('A2:J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
        $spreadsheet->getActiveSheet()->getStyle('A2:J2')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
       
        
         $spreadsheet->getActiveSheet()->getStyle('B5:I5')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B:H')->setWidth(100);
       
        
          //set heading of excel
      $sheet->setCellValue('A1', $month);
      $sheet->setCellValue('B1', 'Mon ('.$mondate.')');
      $sheet->setCellValue('C1', 'Tue ('.$tuedate.')');
      $sheet->setCellValue('D1', 'Wed ('.$weddate.')');
      $sheet->setCellValue('E1', 'Thu ('.$thudate.')');
      $sheet->setCellValue('F1', 'Fri ('.$fridate.')');
      $sheet->setCellValue('G1', 'Sat ('.$satdate.')');
      $sheet->setCellValue('H1', 'Sun ('.$sundate.')');
     
  $week_days = array('mon','tues','wed','thus','fri','sat','sun');
  
        $sheet->setCellValue('A2', 'Employee Name');          
        $sheet->setCellValue('B2', 'Time/Hrs');
        $sheet->setCellValue('C2', 'Time/Hrs');
        $sheet->setCellValue('D2', 'Time/Hrs');
        $sheet->setCellValue('E2', 'Time/Hrs');
        $sheet->setCellValue('F2', 'Time/Hrs');
        $sheet->setCellValue('G2', 'Time/Hrs');
        $sheet->setCellValue('H2', 'Time/Hrs');
        $sheet->setCellValue('I2', 'Department');
        $sheet->setCellValue('J2', 'Total Hrs');
       
       
     $x = 3;
     $sheetIndex = array('B','C','D','E','F','G','H');
      foreach($roster as $row){
          if($x%2 == 0){
          $spreadsheet->getActiveSheet()->getStyle('A'.$x.':I'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('EFEFEF');
          }else{
            $spreadsheet->getActiveSheet()->getStyle('A'.$x.':I'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FAFAFA');  
          }
        // $sheet->setCellValue('A'.$x, $row->emp_name.' \n('.$row->role_name.')');
        $spreadsheet->getActiveSheet()->getCell('A'.$x)->setValue($row->emp_name." \n(".$row->role_name.")");
        $spreadsheet->getActiveSheet()->getStyle('A'.$x)->getAlignment()->setWrapText(true);
        for ($i = 0; $i < 7; $i++) { 
            
            $start_nameofday = $week_days[$i].'_start_time';
            $end_nameofday = $week_days[$i].'_end_time'; 
            $break_nameofday = $week_days[$i].'_break_time'; 
            $layout_nameofday = $outletweek_days[$i].'_layout'; 
            $time1 = strtotime($row->$start_nameofday);
            $time2 = strtotime($row->$end_nameofday);
            $break_hrs = $row->$break_nameofday;
            if($time2 !='' && $time1 !=''){
                 $difference = round(abs(($time2 - $time1)) / 3600,2);
             $hr_in_min = $difference* 60;
        
            $difference = $hr_in_min - $break_hrs;
            $difference = floor($difference / 60).':'.($difference -   floor($difference / 60) * 60);  
            }else{
                  $difference = 0;
            }
            
            if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { $startTime = '';  } else {   $startTime = date ('H:i A',strtotime($row->$start_nameofday)); }
            if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) {  $endTime = ''; } else {   $endTime = date ('H:i A',strtotime($row->$end_nameofday)); }
            if($row->$break_nameofday > 0) { $breakTime = $row->$break_nameofday;  } else {  $breakTime = '   '; }
            if($row->$layout_nameofday != '') {  $outletName = $row->$layout_nameofday; }else{ $outletName = '';}
            
            // $sheet->setCellValue($sheetIndex[$i].$x, 'Start Time = '.$startTime.', Finish Time = '.$endTime.'Break Time = '.$breakTime.', Outlet = '.$outletName.', Hours = '.$difference);
    //   $spreadsheet->getActiveSheet()->setCellValue($sheetIndex[$i].$x, 'Start Time = '.$startTime.', \n Finish Time = '.$endTime.', \n Break Time = '.$breakTime.', Outlet = '.$outletName.',\n Hours = '.$difference);

        $spreadsheet->getActiveSheet()->getCell($sheetIndex[$i].$x)->setValue("Start Time = ".$startTime." \nFinish Time = ".$endTime." \nBreak Time = ".$breakTime." \nOutlet = ".$outletName."\nHours = ".$difference);

        $spreadsheet->getActiveSheet()->getStyle($sheetIndex[$i].$x)->getAlignment()->setWrapText(true);
          }
          $sheet->setCellValue('I'.$x, $row->roster_department);
          $spreadsheet->getActiveSheet()->getStyle('J'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0E0E');
          $spreadsheet->getActiveSheet()->getStyle('J'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
          $sheet->setCellValue('J'.$x, $row->emp_hours_worked_this_week);
            $x = $x+1;
        }
       $writer = new Xlsx($spreadsheet); 
        $filename = 'Roster_'.$roster_name.'_'.$start_date.'to'.$end_date;
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
	    
        }
				
          	
		}
	}
		public function employee_roster_reports(){
	
	    $Email = $this->input->post('emp_email'); 
	    $start_date = $this->input->post('start_date');
	    $end_date = $this->input->post('end_date');
	   
	    $empID= $this->admin_model->get_emp_details_fieldwise($Email,'emp_id',true);
	    $firstName= $this->admin_model->get_emp_details_fieldwise($empID,'first_name');
	    $lastName= $this->admin_model->get_emp_details_fieldwise($empID,'last_name');
	 
	   // echo $empID; exit;
	   // if($Email !='' && ($end_date !='' || $start_date !='') ){
	   if($Email !=''){
	    $reports = $this->admin_model->employee_roster_reports($start_date,$end_date,$empID); 
	  
	    $data['roster'] = $reports;
	    $data['empName'] = $firstName . '' . $lastName;
	    $data['Email'] = $Email;
	    $data['start_date'] = $start_date;
	    $data['end_date'] = $end_date;
	    }else{
	       $data['weekly_reports'] = ''; 
	    }
	
	
	   $hdata['menus'] = $this->display_menu();
	   $this->load->view('general/header');
	   $this->load->view('employees/employee_roser_report',$data); 
	}
	
	
	public function roster_weekly_reports($start_date='',$end_date=''){
	    
	    if($start_date !='' && $end_date !=''){
	    $reports = $this->admin_model->roster_weekly_reports($start_date,$end_date); 
	    $data['weekly_reports'] = unserialize($reports[0]->roster_data);
	    $data['start_date'] = $start_date;
	    $data['end_date'] = $end_date;
	    }else{
	       $data['weekly_reports'] = ''; 
	    }
	 
	
	   $hdata['menus'] = $this->display_menu();
	   $this->load->view('general/header');
	   $this->load->view('employees/weekly_roser_report_list',$data); 
	}
	public function save_weekly_report(){
	      
	      $start_date = date('Y-m-d', strtotime($_POST['start_date']));
		   $end_date   = date('Y-m-d', strtotime($_POST['end_date']));
	      $week_roster_name =  $_POST['week_roster_name'];
	   
	    $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	    foreach($weekdays as $weekday){
         
         $report_data[$weekday.'_budget'] = $_POST[$weekday.'_sales'];
         $report_data[$weekday.'_cost'] = $_POST[$weekday.'_cost'];
         $report_data[$weekday.'_variance'] = $_POST[$weekday.'_variance'];
         $report_data[$weekday.'_percentage'] = $_POST[$weekday.'_percentage'];
         $report_data[$weekday.'_hrs_allocated'] = $_POST[$weekday.'_hrs_allocated'];
         $report_data[$weekday.'_average_hr_rate'] = $_POST[$weekday.'_avg_hrs'];
         
        
	    }
	    
	    
	  $roster = $this->admin_model->save_weekly_report($start_date,$end_date,$week_roster_name,$report_data); 
	}
	function fetch_employee_for_roles(){
	  $role_id =  $_POST['role_id'];
	  
	  $employes = $this->admin_model->get_employeesbyrole($role_id);

	  echo json_encode($employes);

	}
	function saveOutlet(){
	  $outletName =  $_POST['outletNameval'];
	  $branch_id = $this->location_id;
	  
	  $data = array(
	      'outlet_name' => $outletName,
	      'branch_id' => $branch_id,
	      'status' => 1,
	      'added_at' => date('Y-m-d'),
	  );
	  
	  $insertid = $this->admin_model->saveOutlet($data);
        if($insertid){
	        echo $insertid;
        }else{
            echo "error";
        }

	}
	function saveDepartment(){
	  $departmentName =  $_POST['departmentNameval'];
	  $branch_id = $this->location_id;
	  
	  $data = array(
	      'department_name' => $departmentName,
	      'branch_id' => $branch_id,
	      'status' => 1,
	      'added_at' => date('Y-m-d'),
	  );
	  $tablename = 'emp_department';
	  $insertid = $this->admin_model->saveData($tablename,$data);
        if($insertid){
	        echo $insertid;
        }else{
            echo "error";
        }

	}
	function saveRole(){
	  $roleNameval =  $_POST['roleNameval'];
	  $branch_id = $this->location_id;
	  
	  $data = array(
	      'role_name' => $roleNameval,
	      'branch_id' => $branch_id,
	      'status' => 1,
	      'added_at' => date('Y-m-d'),
	  );
	  $tablename = 'role';
	  $insertid = $this->admin_model->saveData($tablename,$data);
        if($insertid){
	        echo $insertid;
        }else{
            echo "error";
        }

	}
	
		public function reports()
	{
			  
		       
		        $this->load->view('general/header');
				$this->load->view('employees/reports');
				$this->load->view('general/footer');
		
	}

	function generate_report(){
	      $start_date =  $_POST['date_from'];
	      $end_date =  $_POST['date_to'];
	      $branch_id = $this->location_id;
	 
	      $roster = $this->admin_model->roster_filter_for_report($start_date,$end_date,$branch_id); 
	     
	            $week_days = array('mon','tues','wed','thus','fri','sat','sun');
				$week_earning =  0;
	            $total_hrs_of_employee_daywise =  array();
	            $j=0;
	            
	            if(!empty($roster)){

				foreach($roster as $key => $ros){
				 $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
				  if($rate == ''){  $rate = 1;  }
				    $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         $difference = 0;
				         $break_hrs = $ros->$break_nameofday;
				         
				         if((isset($start_nameofday) && $start_nameofday !='') && (isset($end_nameofday) && $end_nameofday !='')){
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
if($time1 !='' && $time2 !=''){
                         $difference = round(abs(($time2 - $time1)) / 3600,2);
                         $hr_in_min = intval($difference* 60);
                         //hour worked worked on that minus break taken on that day
                         $difference = $hr_in_min - $break_hrs;
}else{
    $difference = 0;
}
                         // convert per hour rate to per min rate and multply to no of min worked
                         
                         $total_pay = (($rate)/60) * $difference;
                         $total_hrs_of_employee_daywise[$key][$week_days[$i]][] =  $difference; 
                         $average_rate_of_employee_daywise[$key][$week_days[$i]][] =  $rate; 
                         $total_earning_of_employee_daywise[$key][$week_days[$i]][] =  $total_pay;     
				     
				         }
				     } 
				}  
				
			   $no_of_emp = count($roster);
			
			   
			   for($j=0;$j<7;$j++){
				      $start_val = 0;
				      $start_val_cost =0;
				       $start_val_average_rate =0;
				      $total_hrs_inmin  = 0;
				      for($i=0; $i < count($total_hrs_of_employee_daywise); $i++){ 
				       
				      $start_val = $total_hrs_of_employee_daywise[$i][$week_days[$j]][0] + $start_val;
				      $start_val_average_rate = $average_rate_of_employee_daywise[$i][$week_days[$j]][0] + $start_val_average_rate;
				      $start_val_cost = $total_earning_of_employee_daywise[$i][$week_days[$j]][0] + $start_val_cost;

				  }
				    // convert total mins worked in hrs
				  $total_hrs_inmin = $start_val;
                  $start_val = $this->hoursandmins($start_val, '%02d Hrs, %02d Mins');
				  $total_hrs[$week_days[$j]] = $start_val;
				  $total_cost[$week_days[$j]] = $start_val_cost;
				  $total_hrs_min[$week_days[$j]] = $total_hrs_inmin;
				  $averate_rate[$week_days[$j]] = number_format($start_val_average_rate/$no_of_emp,2);
				  }
				
			
				$total_hrsof_all_day = array_sum($total_hrs_min);
			
		$data['total_hrs'] = $total_hrs;
        $data['total_hrsof_all_day'] = $this->hoursandmins($total_hrsof_all_day, '%02d Hrs, %02d Mins');
        $data['total_cost'] = $total_cost;
        $data['averate_rate'] = $averate_rate;
        }
                else{
                    $data['blank'] = "Yes";
                }
                $data['start_date'] = $start_date;
                $data['end_date'] = $end_date;
     
	            
	            
		        $this->load->view('general/header');
				$this->load->view('employees/generate_reports',$data);
				$this->load->view('general/footer');
	    
	}
	
		function add_report(){
		    
		 $week_days = array('mon','tues','wed','thus','fri','sat','sun'); 
		$branch_id = $this->location_id;
		   foreach($week_days as $week_day){
		       
		       if(!empty($_POST[$week_day.'_sales'])){
		         $sales[$week_day] = $_POST[$week_day.'_sales'];  
		     }else{
		       $sales[$week_day] = 00.00;   
		     }
		     
		    
		   }
		   if($_POST['total_sales'] == ''){
		        $total_sales = array_sum($sales);
		   }else{
		       $total_sales = $_POST['total_sales'];
		   }
		  
		   $sales['total_sales'] = $total_sales;
		 foreach($week_days as $week_day){
		     if(!empty($_POST[$week_day.'_sales_gst'])){
		         $sales_gst[$week_day] = $_POST[$week_day.'_sales_gst']; 
		     }else{
		       $sales_gst[$week_day] = 00.00;   
		     }
		     
		   }
		  
		    if($_POST['total_sales_gst'] == ''){
		       $total_sales_gst = array_sum($sales_gst);
		   }else{
		       $total_sales_gst = $_POST['total_sales_gst'];
		   }
		   $sales_gst['total_sales_gst'] = $total_sales_gst;
		 foreach($week_days as $week_day){
		     
		     
		     if(!empty($_POST[$week_day.'_hrs'])){
		         $hrs[$week_day] = $_POST[$week_day.'_hrs']; 
		     }else{
		         $hrs[$week_day] = 00.00;   
		     }
		   }
		
		   $hrs['total_hrs'] = $_POST['total_hrs'];;
		 foreach($week_days as $week_day){
		      
		     if(!empty($_POST[$week_day.'_avg_rate'])){
		      $averate_rate[$week_day] = $_POST[$week_day.'_avg_rate'];
		     }else{
		         $averate_rate[$week_day] = 00.00;   
		     }
		   }
		   $total_averate_rate = array_sum($averate_rate);
		   $averate_rate['total_averate_rate'] = $total_averate_rate;
		   
		   foreach($week_days as $week_day){
		       
		        if(!empty($_POST[$week_day.'_total_cost'])){
		       $total_cost[$week_day] = $_POST[$week_day.'_total_cost']; 
		        $labour_cost_of_day = $_POST[$week_day.'_total_cost'];
		     }else{
		         $total_cost[$week_day] = 00.00;   
		          $labour_cost_of_day = 00.00;
		     }
		     
		      if(!empty($_POST[$week_day.'_sales'])){
		       $sales_of_day = $_POST[$week_day.'_sales'];
		     }else{
		         $sales_of_day = 00.00;   
		     }
		     
		     if($sales_of_day > 0 && $labour_cost_of_day > 0){
		       $total_cost_percentage[$week_day] = ($labour_cost_of_day/$sales_of_day)*100;  
		     }else{
		           $total_cost_percentage[$week_day] = 0;
		     }
		      
		     
		   }
		   $grandtotal_cost = array_sum($total_cost);
		   if($grandtotal_cost > 0){
		    
		   $total_cost['total_labour_cost'] = $grandtotal_cost;
		   $total_cost_percentage['total_percentage'] = ($grandtotal_cost/$total_sales)*100;      
		   }else{
		       $total_cost_percentage = 00.00;
		   }
		   
	       
	       
	       foreach($week_days as $week_day){

		     if(!empty($_POST[$week_day.'_catering_sales'])){
		      $catering_sales[$week_day] = $_POST[$week_day.'_catering_sales'];
		     }else{
		         $catering_sales[$week_day] = 00.00;   
		     }
		   }
		   if($_POST['total_catering_sales'] == ''){
		       $total_catering_sales = array_sum($catering_sales);
		   }else{
		       $total_catering_sales = $_POST['total_catering_sales'];
		   }
		   
		   $catering_sales['total_catering_sales'] = $total_catering_sales;
		   
		   
		   foreach($week_days as $week_day){

		      if(!empty($_POST[$week_day.'_totals'])){
		      $totals[$week_day] = $_POST[$week_day.'_totals']; 
		     }else{
		         $totals[$week_day] = 00.00;   
		     }
		   }
		   $total_totals = array_sum($totals);
		   $totals['total_totals'] = $total_totals;
		   

		   $sales =  serialize($sales);
		   $sales_gst = serialize($sales_gst);
		   $hrs = serialize($hrs);
		   $labour_cost = serialize($total_cost);
		   $total_labour_cost_percentage = serialize($total_cost_percentage);
		   $averate_rate = serialize($averate_rate);
		   
		   $totals = serialize($totals);
		   $catering_sales = serialize($catering_sales);
		   
		   $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
		   $end_date =  date('Y-m-d', strtotime($this->input->post('end_date')));
		   $report_name = $this->input->post('report_name');

		    
		    $data=array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'report_name' => $report_name,
			'sales' => $sales,
			'sales_gst' => $sales_gst,
			'average_hours' => $averate_rate,
			'labour_cost' => $labour_cost,
			'labour_percent' => $total_labour_cost_percentage,
			'hours' => $hrs,
			'catering_sales' => $catering_sales,
			'totals' => $totals,
			'branch_id' => $branch_id,
			);
			
		    $insert_id = $this->admin_model->add_report($data);
		    if($insert_id){
		       	redirect('admin/view_details_reports/'.$insert_id);
		    }
		    
		}
		function view_reports(){
		       
		      
		        $reports = $this->admin_model->fetch_reports();
		        $i=0;
		         
		        foreach($reports as $report){
		          $reports[$i]->sales = unserialize($report->sales); 
		          $reports[$i]->sales_gst = unserialize($report->sales_gst);
		          $reports[$i]->average_hours = unserialize($report->average_hours);
		          $reports[$i]->hours = unserialize($report->hours);
		         
		          $i++;
		        }
		  
			    $data['reports'] = $reports;
		        
		        
		        $this->load->view('general/header');
				$this->load->view('employees/listing.php',$data);
				$this->load->view('general/footer'); 
		}
		function report_filter($start_date,$end_date){
	    $reports = $this->admin_model->report_filter($start_date,$end_date); 
	   
		        $i=0;
		      
		        foreach($reports as $report){
		          $reports[$i]->sales = unserialize($report->sales); 
		          $reports[$i]->sales_gst = unserialize($report->sales_gst);
		          $reports[$i]->average_hours = unserialize($report->average_hours);
		          $reports[$i]->hours = unserialize($report->hours);
		         
		          $i++;
		        }
		  
			    $data['reports'] = $reports;
		        
		        
		        $this->load->view('general/header');
				$this->load->view('employees/listing.php',$data);
				$this->load->view('general/footer'); 
	    }
		function view_details_reports($report_id='',$purpose=''){
		       
		      
		        $reports = $this->admin_model->view_details_reports($report_id);
		  //      echo "<pre>";
			 //   print_r($reports);
			 //   exit;
		        $i=0;
		         
		        foreach($reports as $report){
		            
		          $reports[$i]->sales = unserialize($report->sales); 
		          $reports[$i]->sales_gst = unserialize($report->sales_gst);
		          $reports[$i]->average_hours = unserialize($report->average_hours);
		          $reports[$i]->hours = unserialize($report->hours);
		          $reports[$i]->labour_cost = unserialize($report->labour_cost);
		          $reports[$i]->labour_percent = unserialize($report->labour_percent); 
		          
		          if(!empty($report->catering_sales)){
		           $reports[$i]->catering_sales = unserialize($report->catering_sales);   
		          }
		          
		           if(!empty($report->totals)){
		           $reports[$i]->totals = unserialize($report->totals);   
		           }
		          
		         
		          $i++;
		        }
		        
		        if($purpose=="called_to_get_export_data"){
		           return  (array)$reports[0];
		        }
			    $data['reports'] = (array)$reports[0];
			    
			    $data['report_id'] = $report_id;
			    $data['report_name'] = $reports[0]->report_name;
		        
		        
		        $this->load->view('general/header');
				$this->load->view('employees/view_details_reports.php',$data);
				$this->load->view('general/footer'); 
		}
		function view_all_reports(){
		       
		       if(isset($_POST['options'])){         
	      foreach( $_POST['options'] as $report_id){
	      
	     $reports[$report_id] =  $this->admin_model->view_details_reports($report_id);
	     
	      }
	        }
	          
		        $i=0;
		        foreach($reports as $key=> $report){
		          $reports_data[$i]->report_id = $report[0]->report_id;
			      $reports_data[$i]->report_name = $report[0]->report_name;
			      $reports_data[$i]->start_date = $report[0]->start_date;
			      $reports_data[$i]->end_date = $report[0]->end_date;
		          $reports_data[$i]->sales = unserialize($report[0]->sales); 
		          $reports_data[$i]->sales_gst = unserialize($report[0]->sales_gst);
		          $reports_data[$i]->average_hours = unserialize($report[0]->average_hours);
		          $reports_data[$i]->hours = unserialize($report[0]->hours);
		          $reports_data[$i]->labour_cost = unserialize($report[0]->labour_cost);
		          $reports_data[$i]->labour_percent = unserialize($report[0]->labour_percent); 
		          
		          if(!empty($reports_data->catering_sales)){
		           $reports_data[$i]->catering_sales = unserialize($report[0]->catering_sales);   
		          }
		          
		           if(!empty($reports_data->totals)){
		           $reports_data[$i]->totals = unserialize($report[0]->totals);   
		           }
		          
		         
		          $i++;
		        }
		 
		      
			    $data['all_reports'] = (array)$reports_data;
			 //    echo "<pre>";
			 //   print_r($data['all_reports']);
		  //      exit;
			   
		        
		        
		       
		       
		}
	
	function export_report(){
	    
	    if(isset($_POST['report_id'])){
	        $report_id = $_POST['report_id'];
	        $this->session->set_userdata('report_id', $report_id);
	    }
	  $report_id = $this->session->userdata('report_id');
	  
	  $report_details  = $this->view_details_reports($report_id,"called_to_get_export_data");
	  

	  
	      $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
       
    
        $spreadsheet->getActiveSheet()->getStyle('A1:A8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('70878c');
        $spreadsheet->getActiveSheet()->getStyle('J2:J8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffef8a');
         $spreadsheet->getActiveSheet()->getStyle('K2:K8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
         $spreadsheet->getActiveSheet()->getStyle('B5:I5')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
       
        
          //set heading of excel
      $sheet->setCellValue('A1', '');
      $sheet->setCellValue('A2', 'Sales');
       $sheet->setCellValue('A3', 'Catering Sales');
      $sheet->setCellValue('A4', 'Sales Less Gst');
      $sheet->setCellValue('A5', 'Hours');
      $sheet->setCellValue('A6', 'Average Hr');
      $sheet->setCellValue('A7', 'Labour Cost');
      $sheet->setCellValue('A8', 'Labour %');
     
  
      $sheet->setCellValue('B1', 'Monday');
      $sheet->setCellValue('C1', 'Tuesday');
      $sheet->setCellValue('D1', 'Wednesday');
      $sheet->setCellValue('E1', 'Thursday');
      $sheet->setCellValue('F1', 'Friday');
      $sheet->setCellValue('G1', 'Saturday');
      $sheet->setCellValue('H1', 'Sunday');
       $sheet->setCellValue('I1', 'Total');
       $sheet->setCellValue('J1', 'Totals');
       $sheet->setCellValue('K1', 'Value');
       
       
     $totals_values = array('','','Sales','Catering Sales','Totals','Sales Less Gst','Labour Cost','','');
     $total_sale_plus_catering =  $report_details['sales']['total_sales'] + $report_details['catering_sales']['total_catering_sales'];
     $totals_values_value = array('','',$report_details['sales']['total_sales'],$report_details['catering_sales']['total_catering_sales'],$total_sale_plus_catering,$report_details['sales_gst']['total_sales_gst'],$report_details['labour_cost']['total_labour_cost'],'','');
       $name = "sales";
       $total ="total_sales";
       $symbol = "$";
      for($x = 2; $x < 9; $x++){ 
        $sheet->setCellValue('B'.$x, $symbol.$report_details[$name]['mon']);
        $sheet->setCellValue('C'.$x, $symbol.$report_details[$name]['tues']);
        $sheet->setCellValue('D'.$x, $symbol.$report_details[$name]['wed']);
        $sheet->setCellValue('E'.$x, $symbol.$report_details[$name]['thus']);
        $sheet->setCellValue('F'.$x, $symbol.$report_details[$name]['fri']);
        $sheet->setCellValue('G'.$x, $symbol.$report_details[$name]['sat']);
        $sheet->setCellValue('H'.$x, $symbol.$report_details[$name]['sun']);
        $sheet->setCellValue('I'.$x, $symbol.$report_details[$name][$total]); 
        $sheet->setCellValue('J'.$x, $totals_values[$x]); 
        $sheet->setCellValue('K'.$x, $symbol.$totals_values_value[$x]); 
         
         if($x == 2){
           $name = "catering_sales";
           $total ="total_catering_sales";
           $symbol = "$";
         }elseif($x == 3){
              $name = "sales_gst";
           $total ="total_sales_gst";
           $symbol = "$";
          
         }elseif($x == 4){
                $name = "hours";
           $total ="total_hrs";
           $symbol = "";
          
         }elseif($x == 5){
              $name = "average_hours";
           $total ="total_averate_rate";
           $symbol = "";
          
         }elseif($x == 6){
               $name = "labour_cost";
           $total ="total_labour_cost";
           $symbol = "$";
          
         }elseif($x == 7){
                $name = "labour_percent";
           $total ="total_percentage";  
            $symbol = "";
          
         }
          }

       $writer = new Xlsx($spreadsheet); 
        $filename = 'Reports data';
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
	    
	    
	}
	
	function mapLocationMarker(){
	   
				$this->load->view('employees/mapLocationMarker.php');
			

	    
	}
	
	
}
