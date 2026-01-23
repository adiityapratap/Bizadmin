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
                                    <h5 class="card-title mb-0">LEAVE HISTORY</h5>
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
                    					
                    						<th>Start Date</th>
                    						<th>End Date</th>
                    						<th>Leave Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($leaves)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($leaves as $row){ 
                                        if($row->leave_status == 'Pending'){
            								$color = "class='badge text-bg-warning'";								
            								$btn_name = "Pending";
            							}else if($row->leave_status == 'Approve'){
            								$color = "class='badge text-bg-success'";
            								$btn_name = "Approved"; 
            							}
            							else if($row->leave_status == 'Comment'){
            								$color = "class='badge text-bg-primary'";
            								$btn_name = "Commens Added";
            							}
            							else if($row->leave_status == 'Reject'){
            								$color = "class='badge text-bg-danger'";
            								$btn_name = "Rejected";
            							}
                                        ?>
                                        <tr>
                                            <td><?php echo  date('d-m-Y',strtotime($row->start_date)); ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($row->end_date)); ?></td>
                                            <td><?php echo $row->leave_type; ?></td>
                                            <td><div <?php echo $color; ?> class="status-color" ><?php echo $btn_name;  ?>
                                            <?php if($row->comments != ''){ ?>
                                            <br>
                        						<textarea class="form-control" rows="3" disabled><?php echo $row->comments; ?></textarea>						
                        						<?php  } ?>
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
