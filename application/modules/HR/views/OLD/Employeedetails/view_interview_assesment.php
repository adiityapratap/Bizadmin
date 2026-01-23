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
                                    <h5 class="card-title mb-0">Interview Assesment</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <?php if($role !='employee'){ ?>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/interview_assesment"><i class="ri-add-line align-bottom me-1"></i> Add <span>New Assesment</span></a>
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
                                            
                                            <th>Date Added</th>
                                            <th>Applicant Name</th>
                                            <th>Job applied for</th>
                                            <th>Interviewer 1 Status</th>
                                            <th>HR Inteview Status</th>
                                            <th class="no-sort">Result</th>
                                            <th class="no-sort text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($record_data)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($record_data as $row){ ?>
                                        <tr>
                                           <td class="date_added"><?php echo date("d-m-Y", strtotime($row->date_added)); ?></td>
                                            <td class="applicant_name"><?php echo $row->applicant_name; ?></td>
                                            <td class="job_applied_for"><?php echo $row->job_applied_for; ?></td>
                                            
                                            <td><input type="hidden" id="ia_id" value="<?php echo $row->interview_assesment_id ?>">
                                                 <select class="form-control ia_status" id="int_status">
                                                     <option value="1" <?php echo ($row->int_status == 1 ? 'selected': '') ?>>Waiting</option>
                                                     <option value="2" <?php echo ($row->int_status == 2 ? 'selected': '') ?>>In Progress</option>
                                                     <option value="3" <?php echo ($row->int_status == 3 ? 'selected': '') ?>>Complete</option>
                                                 </select>
                                            </td>
                                            <td><input type="hidden" id="ia_id" value="<?php echo $row->interview_assesment_id ?>">
                                                 <select class="form-control ia_status" id="hr_status">
                                                     <option value="1" <?php echo ($row->hr_status == 1 ? 'selected': '') ?>>Waiting</option>
                                                     <option value="2" <?php echo ($row->hr_status == 2 ? 'selected': '') ?>>In Progress</option>
                                                     <option value="3" <?php echo ($row->hr_status == 3 ? 'selected': '') ?>>Complete</option>
                                                 </select>
                                            </td>
                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $row->id ?>" <?php if(isset($row->hired) && $row->hired == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <ul class="list-inline gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/edit_interview_assesment/<?php echo $row->interview_assesment_id; ?>/view">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/edit_interview_assesment/<?php echo $row->interview_assesment_id; ?>/edit">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->interview_assesment_id ?>" href="javascript:void(0)">
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

<script type="text/javascript">

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
                url: "<?php echo base_url();?>index.php/Employeedetails/delete_ia",
                data:'ia_id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});

$(".ia_status").on('change',function(){
    var status_id = $(this).val();
      var status_type = $(this).attr('id')
    var ia_id  = $("#ia_id").val();
 console.log(status_type);
  $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/update_ia_status",
		method:"POST",
		data:{status:status_id,ia_id:ia_id,status_type:status_type},
	    success:function(data){
		swal({
          text: "Status Updated Successfuly",
          icon: "success",
          timer: 1300
          });
			}
			
	});
    
})

$(function() {
    $('.toggle-demo').on('change',function() {
         var id = $(this).attr('id')
     if($(this).prop('checked')){
         var status = 1;
     }else{
         var status = 0;
     }
     
      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
        url: "<?php echo base_url(); ?>index.php/admin/update_interview_status",
        data: {"hired":status,"interview_assesment_id":id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })
  });
  
</script> 
