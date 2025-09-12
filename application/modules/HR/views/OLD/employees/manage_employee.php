<style>
    .table-card td:first-child, .table-card th:first-child {
    padding-left: 12px;
}
.table-card td:last-child, .table-card th:last-child {
    padding-right: 12px;
}
</style>

<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">EMPLOYEE</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <?php  if(isset($type) && $type =='admin') { ?>
                                        <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/download_employee_list"><i class="ri-download-2-line align-bottom me-1"></i> Excel</a>
                                        <a class="btn btn-primary add-btn" href="<?php echo base_url(); ?>index.php/admin/add_employee"><i class="ri-add-line align-bottom me-1"></i> Add Employee</a>
                                   <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   
                    <div class="card-body">
                       <div>
                             <?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
                            <div class='hideMe'>
                                <p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
                            </div>
                            <?php } ?>
                            <?php if(null !==$this->session->userdata('error_msg')) { ?>  
                            <div class='hideMe'>
                                <p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
                            </div>
                            <?php } ?>
                        </div>
                           
                                
                                <table class="table table-striped nowrap align-middle" id="customerDataTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="fs-13 sort" >Employee Name</th>
                                            <th class="fs-13">Employee Type</th>
                                            <th class="fs-13">DOB</th>
                                            <th class="fs-13 sort">Start Date</th>
                                            <th class="fs-13 sort">Stress Profile</th>
                                            <th class="fs-13" >Email View</th>
                                            <th class="fs-13">Status</th>
                                            <th class="fs-13 no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($employees)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($employees as $row){ 
                                        
                                        if($row->agree_terms_one == '1' && $row->agree_terms_two == '1' && $row->agree_terms_three == '1'){
                        				$color = "class='badge badge-soft-success text-uppercase'";						
                        				$btn_name = "Completed";
                        				}	
                        				else if($row->tracking_mail == 'Yes'){
                        				$color = "class='badge badge-soft-warning text-uppercase'";						
                        				$btn_name = "In Progress";
                        				}
                        				
                        				else{
                        				$color = "class='badge badge-soft-danger text-uppercase'";
                        				$btn_name = "Not Started";
                        				} ?>
                                        <tr>
                                           <td class="fs-14"><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                           <td class="fs-14"><?php echo str_replace("_", ' ', ucfirst($row->employee_type)); ?></td>
                                           <td class="fs-14"><?php if($row->dob == '00-00-0000' || $row->dob == '0000-00-00'){ echo ""; }else{ echo date("d-m-Y",strtotime($row->dob)); } ?></td>
                                           <td class="fs-14"><?php if($row->effective_start_date == '00-00-0000' || $row->effective_start_date == '0000-00-00'){ echo ""; }else{ echo date("d-m-Y",strtotime($row->effective_start_date)); } ?></td>
                                           <td class="fs-14"><?php echo $row->stress_profile; ?></td>
                                          
                                           <td class="fs-14"><?php if($row->tracking_mail != ''){ echo $row->tracking_mail; }else{ echo 'No'; }  ?></td>
                                          
                                            <td class="fs-14"><span <?php echo $color; ?>><?php echo $btn_name;  ?></span></td>
                                          
                                            
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                              
                                                    <?php if(isset($row->status) && $row->status == 0){ ?>
                                                    <!--<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Revert">-->
                                                    <!--    <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->emp_id ?>" data-rel="revert" href="javascript:void(0)">-->
                                                    <!--        <i class="ri-refresh-line fs-16"></i>-->
                                                    <!--    </a>-->
                                                    <!--</li>-->
                                                    <div class="d-flex gap-2">
                                                        <div class="view">
                                                        <a class="btn btn-sm btn-primary edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/view_employee/<?php echo $row->emp_id ?>">
                                                          View</a>
                                                        </div>
                                                        <div class="remove">
                                                          <button class="btn btn-sm btn-danger remove-item-btn" data-rel="revert" data-rel-id="<?php echo  $row->emp_id ?>" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Revert</button>
                                                           </div>
                                                    </div>
                                                     <?php } else{ ?>
                                                     <div class="d-flex gap-2">
                                                        <div class="view">
                                                        <a class="btn btn-sm btn-primary edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/view_employee/<?php echo $row->emp_id ?>">
                                                          View</a>
                                                        </div>
                                                        <div class="edit">
                                                        <a class="btn btn-sm btn-success edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/update_employee/<?php echo $row->emp_id ?>">
                                                          Edit</a>
                                                        </div>
                                                         <div class="remove">
                                                          <button class="btn btn-sm btn-danger remove-item-btn" data-rel="delete" data-rel-id="<?php echo  $row->emp_id ?>" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                                           </div>
                                                        </div>
                                                        <?php } ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($employees)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We did not find any record for you search.</p>
                                    </div>
                                </div>
                               
                          
                           
                      
                       
                    </div>
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
           
    </div>
       

        
    </div>
   
</div>

<script type="text/javascript">
$('.remove-item-btn').click(function(){
    var id = $(this).attr('data-rel-id');
    var data_rel = $(this).attr('data-rel');
    if(data_rel == 'revert'){
        Swal.fire({
          title: "Are you sure?",
          icon: "warning",
          showCancelButton: !0,
          confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
          cancelButtonClass: "btn btn-danger w-xs mt-2",
          confirmButtonText: "Yes, revert it!",
          buttonsStyling: !1,
          showCloseButton: !0,
      }).then(function (e) {
          if (e.value) {
              
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/employees/revert_deleted_emp",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
    }else{
        Swal.fire({
          title: "Are you sure?",
          icon: "warning",
          showCancelButton: !0,
          confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
          cancelButtonClass: "btn btn-danger w-xs mt-2",
          confirmButtonText: "Yes, delete it!",
          buttonsStyling: !1,
          showCloseButton: !0,
      }).then(function (e) {
          if (e.value) {
              
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/employees/employee_delete",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
    }
    
});
    $(document).ready(function () {
            
    <?php if(empty($employees)){ ?>
        $('#customerDataTable').DataTable({
            paging: false,
            info: false,
           "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
    <?php  }else{ ?>
        $('#customerDataTable').DataTable({
            pageLength: 100,
            lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
           "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
    <?php  } ?>
});
</script> 
