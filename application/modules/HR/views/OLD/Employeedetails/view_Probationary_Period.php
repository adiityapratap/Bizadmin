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
                                    <h5 class="card-title mb-0">PROBATIONARY PERIOD</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <?php if($role =='employee'){ ?>
                                        <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/Probationary_Period"><i class="ri-add-line align-bottom me-1"></i> Add <span>New Request</span></a>
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
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                
                                <table class="table align-middle" id="customerDataTable">
                                    <thead class="table-light">
                                        <tr>
                    					
                    						<th>Name</th>
                    						<th>Start Date</th>
                    						<th>End Time</th>
                                            <th class="no-sort text-center">Action</th>
                                               
                                        </tr>
                                    </thead>
                                    <?php if(!empty($record_data)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($record_data as $row){ ?>
                                        <tr>
                                            <td><?php echo $row->name; ?></td>
                                            <td class="job_type"><?php echo date("d-m-Y", strtotime($row->start_date)); ?></td>
                                            <td class="job_type"><?php echo date("h:i A", strtotime($row->end_date)); ?></td>
                                            <td class="text-center">
                                                <ul class="list-inline gap-2 mb-0">
                                                    <?php if($role =='employee'){ ?>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                            <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/edit_Probationary_Period/<?php echo $row->Probationary_Period_id ?>/view">
                                                                <i class="ri-eye-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    <?php }else{ ?>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                            <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/edit_Probationary_Period/<?php echo $row->Probationary_Period_id ?>/edit">
                                                                <i class="ri-pencil-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($record_data)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
 
<script>
$(document).ready(function () {
    <?php if(empty($record_data)){ ?>
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