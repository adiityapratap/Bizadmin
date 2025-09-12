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
                                    <h5 class="card-title mb-0">Resumes</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/resume_form"><i class="ri-add-line align-bottom me-1"></i> Add Resume</a>
                                   
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
                                            <th class="text-left">Name</th>						
                    						<th class="text-left">Email</th>						
                    						<th class="text-left">Phone</th>						
                    						<th class="text-center">Job role</th>
                    					
                    						<th class="no-sort text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($resumes)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($resumes as $row){ ?>
                                        <tr>
                                           <td class="text-left"><?php echo $row->candidate_name; ?></td>
                    						<td class="text-left"><?php echo $row->email; ?></td>
                    						<td class="text-left"><?php echo $row->phone; ?></td>
                    						<td class="text-center"><?php echo $row->job_role; ?></td>
                                            
                                            <td class="text-center">
                                                <ul class="list-inline gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/resume_view/<?php echo $row->resume_id;?>">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/resume_form/<?php echo $row->resume_id;?>">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->resume_id ?>" href="javascript:void(0)">
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
                                
                                <div class="noresult" <?php if(!empty($resumes)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
    <?php if(empty($resumes)){ ?>
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
                url: "<?php echo base_url();?>index.php/admin/resume_del",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});

$("#resume_filters").on('submit',function(e){
	    
		e.preventDefault();
	
		if($.trim($("#name").val())=='')
			name='unset';
		else name=$("#name").val();
	
		if($.trim($("#phone").val())=='')
			phone='unset';
		else phone=$("#phone").val();
		
		if($("#email").val()=='')
			email='unset';
		else email=$("#email").val();
		
		$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/resumes",
		        data:'candidate_name='+name+'&phone='+phone+'&email='+email,
		        success: function(data){
		            console.log(data);
		            if(data){
		                var htmlData = '';
		            var resumesData = JSON.parse(data)
		            resumesData.forEach(val => {
		                htmlData +='<tr class="tr">';
    						htmlData +='<td class="text-left">'+val.candidate_name+'</td>';
    						htmlData +='<td class="text-left">'+val.email+'</td>';
    						htmlData +='<td class="text-left">'+val.phone+'</td>';
    						htmlData +='<td class="text-center">'+val.job_role+'</td>';
    					    
    						htmlData +='<th class="text-center"><a href="<?php echo base_url(); ?>index.php/admin/resume_view/'+val.resume_id+'"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;';
    						 htmlData +='<a href="<?php echo base_url(); ?>index.php/admin/resume_form/'+val.resume_id+'"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;';
    						htmlData +='<a href="<?php echo base_url(); ?>index.php/admin/resume_del/'+val.resume_id+'"><span class="glyphicon glyphicon-trash"></span></a></th>';
    					htmlData +='</tr>';
		            });
		        
		        }else{
		            htmlData +='<tr class="tr"><td colspan="5" class="text-center">No record found</td></tr>';
		        }
		        $("#resume_wrap").html(htmlData);
		        }
	        });

});
</script> 
