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
                                    <h5 class="card-title mb-0">Users</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/create_user"><i class="ri-add-line align-bottom me-1"></i> Add User</a>
                                   
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
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                
                                <table class="table align-middle" id="customerDataTable">
                                    <thead class="table-light">
                                        <tr>
                                            
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="no-sort text-center">Action</th>
                                         </tr>
                                    </thead>
                                    <?php if(!empty($users)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($users as $row){ ?>
                                        <tr>
                                           <td class="username"><?php echo $row->username; ?></td>
                                            <td class="email"><?php echo $row->email; ?></td>
                                            <td class="phone"><?php echo $row->phone; ?></td>
                                            
                                            <td class="text-center">
                                                <ul class="list-inline gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/create_user/<?php echo $row->customer_user_id; ?>">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->customer_user_id ?>" href="javascript:void(0)">
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
                                
                                <div class="noresult" <?php if(!empty($users)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
                url: "<?php echo base_url();?>index.php/admin/user_delete",
                data:'id='+id,
                success: function(data){
                  if(data == 'deleted'){
                      Swal.fire({ 
                          title: "Deleted!", 
                          text: "Your record has been deleted.", 
                          icon: "success", 
                          confirmButtonClass: "btn btn-info w-xs mt-2", 
                          buttonsStyling: !1 
                      }).then(function (e) {
                            if (e.value) {
                                location.reload();
                            }
                        });
                  }
                  
                }
            });
            
        
              
          }
      })
});
$(document).ready(function () {
            
    <?php if(empty($users)){ ?>
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
           "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
    <?php  } ?>
});
</script> 
