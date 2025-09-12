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
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">MANAGE LEAVE</h5>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                    
                   
                    <div class="card-body">
                       
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
                      
                      
                         
                                
                                <table class="table table-striped nowrap" id="customerDataTable">
                                    <thead class="table-light">
                                        <tr>
                                           <th>Employee Name</th>						
                    						<th>Leave Type</th>
                    						<th>New Nominated Person</th>
                    						<th >Start Date</th>
                    						<th >End Date</th>
                    						<th>Status</th>
                    						<th class="no-sort text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($leaves)){ ?>
                                    
                                    <tbody class="list form-check-all">
                                        <?php  foreach($leaves as $row){ 
                				            if($row->leave_status == 'Pending'){
                								$color = "class='badge badge-soft-primary text-uppercase'";								
                								$btn_name = "Pending";
                							}else if($row->leave_status == 'Approve'){
                								$color = "class='badge badge-soft-success text-uppercase'";
                								$btn_name = "Approved"; 
                							}
                							else if($row->leave_status == 'Comment'){
                								$color = "class='badge badge-soft-warning text-uppercase'";
                								$btn_name = "Comments ";
                							}
                							else if($row->leave_status == 'Reject'){
                								$color = "class='badge badge-soft-danger text-uppercase'";
                								$btn_name = "Rejected";
                							}
                			        	?>
                                        <tr>
                                           <td class="first_name"><?php echo $row->first_name; ?></td>
                                            <td class="text-left"><?php echo $row->leave_type; ?></td>
                    						<td class="text-left"><?php echo $row->new_nominated_person; ?></td>
                    						<td class="text-center"><?php echo  date('d-m-Y',strtotime($row->start_date)); ?></td>
                    						<td class="text-center"><?php echo date('d-m-Y',strtotime($row->end_date)); ?></td>
                    						 <td class="fs-14"><span <?php echo $color; ?>><?php echo $btn_name;  ?></span></td>
                    					
                    						<td class="text-center">
                                                <ul class="list-inline gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/manager_leave_update/<?php echo $row->leave_id ?>">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->leave_id ?>" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($leaves)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<script>
    $(document).ready(function () {
    <?php if(empty($leaves)){ ?>
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
            "responsive": true,
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false
            }]
        });
    <?php  } ?>
});
</script>

<script type="text/javascript">
$('.remove-item-btn').click(function(){
    var id = $(this).attr('data-rel-id');
    Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
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
                url: "<?php echo base_url();?>index.php/employees/leave_delete",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});


  
</script> 
