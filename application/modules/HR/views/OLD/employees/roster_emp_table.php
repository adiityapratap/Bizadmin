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
                                    <h5 class="card-title mb-0">MANAGE ROSTERS</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    
						        <?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
						        <button class="btn btn-primary add-btn" onclick="view_all_roster()" ><i class="ri-eye-line align-bottom me-1"></i> View Selected Roster</button>
                                    <a href="<?php echo base_url(); ?>index.php/admin/add_roster_beta" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Add Roster</a>
                                    
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
                                
                                <table class="table table-striped nowrap align-middle" id="customerDataTable">
                                    <thead class="table-light">
                                        <tr>
                    						<th class="text-center no-sort" style="width:50px;" >
                    							<span class="custom-checkbox">
                    								<input type="checkbox" id="selectAll">
                    								<label for="selectAll"></label>
                    							</span>
                    						</th>
                                            <th class="w-130">Start Date</th>
                                            <th class="w-130">End Date</th>
                    						<th>Roster Name</th>
                    						<?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                    						<th>Status</th>
                    						<?php } ?>
                    						<?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                                            <th class="text-center no-sort">Re Create</th>
                                            	<?php } ?>
                                            <th class="text-center no-sort">Actions</th>
                                        </tr>
                                    </thead>
                                    <?php if(isset($roster) && !empty($roster)){ ?>
                                    <tbody class="list form-check-all">
                                       <form id="roster_list_form" action="<?php echo base_url(); ?>index.php/admin/view_all_roster" method="post">
                                            	<?php 
                            				$i = 0;
                            				foreach($roster as $row){ ?>
                                        <tr>
                                            <td style="width:50px;" class="text-center">
                    							<span class="custom-checkbox">
                    								<input type="checkbox"  name="options[]" value="<?php echo $row->roster_group_id ?>">
                    								<label></label>
                    							</span>
                    						</td>
                                            <td><?php echo date("d-m-Y", strtotime($row->start_date)); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row->end_date)); ?></td>
                                            <td><?php echo $row->roster_name; ?></td>
                                            <?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $row->roster_group_id ?>" <?php if(isset($row->roster_status) && $row->roster_status == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            <?php } ?>
                                            <?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                                                <td class="text-center">
                                                    <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/recreate">Recreate</a></td>
                                                <?php } ?> <td class="text-center">
                                               
                                                <ul class="list-inline gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                       <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/view">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/edit">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a> 
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->roster_group_id ?>" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                        
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </form>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(isset($roster) && !empty($roster)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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



<!--<script src="<?php echo base_url(); ?>assets/js/roster.js"></script>-->
<script type="text/javascript">

function view_all_roster(){
  if($('input[name="options[]"]:checked').length > 0){
   $("#roster_list_form").submit();    
  }else{
      alert("Please Select Roster");
  }
 
}
  
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
        url: "<?php echo base_url(); ?>index.php/admin/update_roster_status",
        data: {"roster_status":status,"id":id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })
  });
  
  
  $(document).ready(function(){
	// Activate tooltip
// 	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody .custom-checkbox input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
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
                url: "<?php echo base_url();?>index.php/admin/delete_roster",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});

        $(document).ready(function () {
            
    <?php if(empty($roster)){ ?>
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