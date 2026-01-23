<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList"> 
                   
                    <form action="<?php echo base_url(); ?>index.php/admin/submit_employee" method="post" class="form-horizontal" id="employee_add">
                   
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Add New Employee</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/manage_employee"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                   
                                    <input type="submit" class="btn btn-primary" name="contact_submit" value="Add New Employee">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                            <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert alert-success" role="alert" style="font-size: 18px;">
                                 <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                           
                                <div class="row">
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">First Name <span class="text-danger fw-medium">*</span></label>
                                            <input type="text" class="form-control" name="first_name" autocomplete="off" required>
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Last Name <span class="text-danger fw-medium">*</span></label>
                                            <input type="text" class="form-control" name="last_name" autocomplete="off" required>
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4"> 
                                        <div class="control-group">
                                            <label class="control-label">Email <span class="text-danger fw-medium">*</span></label>
                                            <input type="text" class="form-control" name="email"  autocomplete="off" required>
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4"> 
                                        <div class="control-group">
                                            <label class="control-label">Pin <span class="text-danger fw-medium">*</span></label>
                                            <input type="password" class="form-control" name="pin" autocomplete="off" required>
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Weekday<span>*</span></label>
                                            <input type="text" class="form-control" name="rate" onkeypress='validate(event)' required value="<?php echo $row->rate; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Saturday</label>
                                            <input type="text" class="form-control" name="Saturday_rate"  value="<?php echo $row->Saturday_rate; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Sunday</label>
                                            <input type="text" class="form-control" name="Sunday_rate" value="<?php echo $row->Sunday_rate; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Public Holiday</label>
                                            <input type="text" class="form-control" name="holiday_rate"  value="<?php echo $row->holiday_rate; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Department <span class="text-danger fw-medium">*</span></label>
                                            <select class="form-control" id="department" name="department" required>
                                                <option value="">Select</option>
                                                <option value="add_department" class="text-center text-primary fw-medium bg-soft-secondary py-1">+ Add New Department</option>
                                                <?php foreach($departments as $dt){ ?> 
                                            	    <option value="<?php echo $dt->emp_department_id; ?>"><?php echo $dt->department_name; ?></option>
                                            	<?php } ?>
                                                
                                                
                                                <option value="Admin">Admin</option>
                                                <option value="Admin">FOH</option>
                                                <option value="Admin">BOH</option>
                                                <option value="Catering">Catering</option>
                                                <option value="Coffee Box">Coffee Box</option>
                                                <option value="Coffee Box, Organice">Coffee Box, Organice</option>
                                                <option value="Coffee Box, Hot Food">Coffee Box, Hot Food</option>
                                                <option value="Coffee Station">Coffee Station</option>
                                                <option value="Dental">Dental</option>
                                                <option value="Hot Food">Hot Food</option>
                                                <option value="Hot Food, Jucie Bar">Hot Food, Jucie Bar</option>
                                                <option value="Hot Food, Coffee stattion">Hot Food, Coffee stattion</option>
                                                <option value="Juice Bar">Juice Bar</option>
                                                <option value="Juice Bar, Organic">Juice Bar, Organic</option>
                                                <option value="Kebab">Kebab</option>
                                                <option value="Kitchen">Kitchen</option>
                                                <option value="Organic">Organic</option>
                                                <option value="Outpatients">Outpatients</option>
                                                <option value="Sandwich Bar">Sandwich Bar</option>
                                                <option value="Salad, Hot Food">Salad, Hot Food</option>
                                                <option value="Store Room">Store Room</option>
                                                <option value="Sandwich Bar, Hot Food">Sandwich Bar, Hot Food</option>
                                                <option value="Sandwich Bar, Coffee Station">Sandwich Bar, Coffee Station</option>
                                                <option value="Therapy ">Therapy </option>
                                            </select>
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">  
                                        <div class="control-group">
                                          <label class="control-label">Role <span class="text-danger fw-medium">*</span></label>
                                            <select name="role" id="role" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="add_role" class="text-center text-primary fw-medium bg-soft-secondary py-1">+ Add New Role</option>
                                                <?php if(isset($roles) && !empty($roles)) { foreach($roles as $role) { ?>
                                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                          <label class="control-label">Job Description</label>
                                            <input type="file" class="form-control" name="job_desc">
                                        </div>
                                          
                                    </div> 
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Effective Start Date<span>*</span></label>
                                            <input type="date" class="form-control datetime" name="effective_start_date" data-provider="flatpickr" data-date-format="d M, Y"  required autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6 mb-4">
                                        <div class="control-group">
                                            <label class="control-label">Employee Type<span>*</span></label>
                                                <select name="employee_type" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option <?php  if($row->employee_type == "full_time"){ echo "selected"; } ?> value="full_time">Full Time</option>
                                                    <option <?php  if($row->employee_type == "part_time"){ echo "selected"; } ?> value="part_time">Part Time</option>
                                                    <option <?php  if($row->employee_type == "casual"){ echo "selected"; } ?> value="casual">Casual</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                </div>
                             
                              
                        </div>
                       
                       
                    </div>
                    </form>
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<script>
    $(document).on("change", "#department" , function() {
        var departmentval = $(this).val();
        if(departmentval == 'add_department'){
            $(this).val('');
            Swal.fire({
                title: "Add New Department",
                html: '<div class="mt-3 text-start"><label for="input-department" class="form-label fs-13">Department Name</label><input type="text" class="form-control" id="input-department" placeholder="Enter Department Name"></div>',
                confirmButtonClass: "btn btn-primary w-xs mb-2",
                confirmButtonText: 'Create',
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function (t) {
                if (t.value) {
                    var departmentNameval = $('#input-department').val(); 
                    console.log(departmentNameval); 
                    $.ajax({
                        url:"/HR/index.php/admin/saveDepartment", 
                		method:"POST", 
                		data:{departmentNameval:departmentNameval},
                	    success:function(resp){
	                        
                            if(resp != 'error'){
                               $('#department').append('<option value="'+resp+'" selected>'+departmentNameval+'</option>');
                                Swal.fire({ title: "Department Saved!", icon: "success", confirmButtonClass: "btn btn-primary w-xs", buttonsStyling: !1 }); 
                            }else{
                                Swal.fire({ title: "Department not saved", icon: "info", confirmButtonClass: "btn btn-primary w-xs", buttonsStyling: !1 });
                            }
                            
                	    }
                    });
                }
            });
        }
    });
    $(document).on("change", "#role" , function() {
        var departmentval = $(this).val();
        if(departmentval == 'add_role'){
            $(this).val('');
            Swal.fire({
                title: "Add New Role",
                html: '<div class="mt-3 text-start"><label for="input-role" class="form-label fs-13">Role Name</label><input type="text" class="form-control" id="input-role" placeholder="Enter Role Name"></div>',
                confirmButtonClass: "btn btn-primary w-xs mb-2",
                confirmButtonText: 'Create',
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function (t) {
                if (t.value) {
                    var roleNameval = $('#input-role').val(); 
                    console.log(roleNameval); 
                    $.ajax({
                        url:"/HR/index.php/admin/saveRole", 
                		method:"POST", 
                		data:{roleNameval:roleNameval},
                	    success:function(resp){
	                        
                            if(resp != 'error'){
                               $('#role').append('<option value="'+resp+'" selected>'+roleNameval+'</option>');
                                Swal.fire({ title: "Role Saved!", icon: "success", confirmButtonClass: "btn btn-primary w-xs", buttonsStyling: !1 }); 
                            }else{
                                Swal.fire({ title: "Role not saved", icon: "info", confirmButtonClass: "btn btn-primary w-xs", buttonsStyling: !1 });
                            }
                            
                	    }
                    });
                }
            });
        }
    });
</script>
