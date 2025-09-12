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
                                    <h5 class="card-title mb-0">TIMESHEETS</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <button class="btn btn-success mx-1" onClick="ButtonFunctions()"><i class="ri-download-2-line align-bottom me-1"></i> Fortnight Txt</a>
                                    <button class="btn btn-primary" onClick="downloadTotalHours()"><i class="ri-download-2-line align-bottom me-1"></i> <span>Total</span> Hours</a>
                                   
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
                                
                                <table class="table align-middle" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                    					<th style="width:50px;">
                							<span class="custom-checkbox">
                								<input type="checkbox" id="selectAll">
                								<label for="selectAll"></label>
                							</span>
                						</th>
                                        <th>Timesheet Name</th>
                                        <th>Timesheet Week</th>
                                        <th class="no-sort text-center">Actions</th>
                                               
                                        </tr>
                                    </thead>
                                    <?php if(!empty($record_data)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($record_data as $row){ ?>
                                        <tr>
                                           <td style="width:50px;">
                    							<span class="custom-checkbox">
                    								<input type="checkbox" class="timesheetIds" name="options[]" value="<?php echo $row->timesheet_id; ?>_<?php echo $row->roster_group_id ?>">
                    								<label for="timesheetIds"></label>
                    							</span>
                    						</td>
                                           <td><?php echo $row->timesheet_name; ?></td>
                                            <td><?php echo "( From ".date("d-m-Y", strtotime($row->start_date))." To ".date("d-m-Y", strtotime($row->end_date)).")"; ?></td>
                                           
                                           <td class="text-center">
                                                <ul class="list-inline gap-2 mb-0">
                                                   <?php if(isset($row->multiple_roster_group_id) && $row->multiple_roster_group_id != '') {  ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>/multiple">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                        
                                                    </li>
                                                   <?php } else { ?>    
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block rdit-item-btn" href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                        
                                                    </li>
                                                    <?php }  ?>
                                                    <?php if($role !="employee") { ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->timesheet_id ?>" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                        
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Refresh">
                                                        <a class="text-primary d-inline-block rdit-item-btn" onClick="refreshTimesheet(<?php echo $row->timesheet_id ?>)" href="javascript:void(0)">
                                                            <i class="bx bx-refresh fs-22"></i>
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

function ButtonFunctions(){
    var TimehseetId = [];
    var RosterGroupId= [];
    $('.timesheetIds:checked').each(function() {
        var tidandRosterId = $(this).val();
        const TidRid = tidandRosterId.split("_");
      
        TimehseetId.push(TidRid[0])
        RosterGroupId.push(TidRid[1])
       
    });
    var TImeIDS = TimehseetId.join();
     var RGIDS = RosterGroupId.join();
//   alert("https://www.cafeadmin.com.au/HR/index.php/Employeedetails/download_FortnightTextfile/"+TImeIDS+"/"+RGIDS)
 window.location.href = "https://www.cafeadmin.com.au/HR/index.php/Employeedetails/download_FortnightTextfile?TimehseetIds="+TImeIDS+"&RGId="+RGIDS;

}
function downloadTotalHours(){
    var TimehseetId = [];
    var RosterGroupId= [];
    $('.timesheetIds:checked').each(function() {
        var tidandRosterId = $(this).val();
        const TidRid = tidandRosterId.split("_");
      
        TimehseetId.push(TidRid[0])
        RosterGroupId.push(TidRid[1])
       
    });
    var TImeIDS = TimehseetId.join();
     var RGIDS = RosterGroupId.join();
//   alert("https://www.cafeadmin.com.au/HR/index.php/Employeedetails/download_FortnightTextfile/"+TImeIDS+"/"+RGIDS)
 window.location.href = "https://www.cafeadmin.com.au/HR/index.php/Employeedetails/download_total_hours?TimehseetIds="+TImeIDS+"&RGId="+RGIDS;

}

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
                url: "<?php echo base_url();?>index.php/employeedetails/delete_timesheet",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});


$("#timesheet_filters").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#end_date").val())=='')
			end_date='unset';
		else end_date=$("#end_date").val();
		if($.trim($("#start_date").val())=='')
			start_date='unset';
		else start_date=$("#start_date").val();
		if($.trim($("#timesheet_name").val())=='')
			timesheet_name='unset';
		else timesheet_name=$("#timesheet_name").val();
		
		if($.trim($("#exEmployee").val())=='')
			exEmployee='unset';
		else exEmployee=$("#exEmployee").val();
		
		
	window.location.href="<?php echo base_url(); ?>index.php/employeedetails/timesheet_filters/"+start_date+"/"+end_date+"/"+timesheet_name+"/"+exEmployee;

		
});

function refreshTimesheet(timesheet_id){
        
		
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/fixing_timesheet",
		    data: {"timesheet_id":timesheet_id},
		    success: function(data){
                   alert("Timesheet Fixed");
                 location.reload();
		    }
		});
        
    }
    
// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
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

</script> 
