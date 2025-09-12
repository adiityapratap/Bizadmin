<div class="container-fluid" style="margin-top: 130px !important;">
 <div class="row" >
                        <div class="col-lg-12">
                            <div class="card py-3" id="orderList">
                                <div class="card-header  border-0 ">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="card-title mb-0 flex-grow-1 text-black">Tasks</h5>
                                       <a type="button" class="btn btn-primary btn-sm fs-14" 
                                                id="create-btn" href="<?php echo base_url('Shifts/task') ?>"><i
                                                    class="ri-add-line align-bottom "></i> Create Tasks 
                                                </a>
                                        
                                 <button class="btn btn-soft-danger fs-14" onClick="deleteMultipleEquipment()"><i class="ri-delete-bin-6-line"></i></button>                
                                    </div>
                                </div>
                              
                                <div class="card-body pt-0">
                                      <div class="table-responsive table-card mb-1">
                                          
                                           <table class="table table-nowrap align-middle" id="activeEquip">
    <thead class="text-muted table-light">
        <tr class="text-uppercase">
            <th scope="col" style="width: 25px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                </div>
            </th>
            <th class="sort" data-sort="customer_name">Task Name</th>
            <th class="sort" data-sort="customer_name">Prep Area</th>
            <th class="sort" data-sort="product_name">Schedule</th>
            <th class="sort" data-sort="date">Time</th>
            <th class="sort" data-sort="product_name">Shift</th>
            <th class="sort" data-sort="product_name">Role</th> <!-- New Role Column -->
            <th class="sort" data-sort="status">Status</th>
            <th class="sort" data-sort="city">Action</th>
        </tr>
    </thead>
    <tbody class="list form-check-all" id="sortable">
        <?php if (!empty($taskList)) { ?>
            <?php foreach ($taskList as $task) { ?>
                <?php 
                if ($task->schedule_at == 2 && $task->schedule_type == 'day') {
                    $repeatText = '( Every ' . $task->repeatWhichWeek . ' ' . $task->schedule_dayName . ')';
                } else {
                    $repeatText = '';
                }

                // Deserialize role_id to get array of role IDs
                $role_ids = unserialize($task->role_id);
                $role_names = [];

                // Fetch role names using Ion Auth
                if (!empty($role_ids) && is_array($role_ids)) {
                    $this->load->library('ion_auth'); // Ensure Ion Auth library is loaded
                    foreach ($role_ids as $role_id) {
                        $group = $this->ion_auth->group($role_id)->row();
                        if ($group) {
                            $role_names[] = $group->name;
                        }
                    }
                }

                // Join role names with commas
                $role_display = !empty($role_names) ? implode(', ', $role_names) : '-';
                ?>
                <tr id="<?php echo 'row_' . $task->id; ?>">
                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input checkAll checkbox-item" type="checkbox" name="checkAll" value="<?php echo $task->id; ?>">
                        </div>
                    </th>
                    <td class="descr text-wrap handle"><?php echo (isset($task->task_name) ? $task->task_name : ''); ?></td>
                    <td class="descr text-wrap handle"><?php echo (isset($task->name) ? $task->name : ''); ?></td>
                    <td class="descr text-wrap handle"><?php echo (isset(CLEANSCHEDULE[$task->schedule_at]) ? CLEANSCHEDULE[$task->schedule_at] : ''); ?><?php echo $repeatText; ?></td>
                    <td class="descr text-wrap handle"><?php echo (isset($task->task_time) ? $task->task_time : ''); ?></td>
                    <td class="descr text-wrap handle"><?php echo (isset($task->shift_name) ? $task->shift_name : ''); ?></td>
                    <td class="descr text-wrap handle"><?php echo $role_display; ?></td> <!-- Display Role Names -->
                    <td>
                        <div class="form-check form-switch form-switch-custom form-switch-success">
                            <input class="form-check-input checklisttoggle-demo" type="checkbox" role="switch" data-tablename="Shifts_task" data-id="<?php echo $task->id; ?>" <?php echo ($task->status ? 'checked' : ''); ?>>
                        </div>
                    </td>
                    <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                <a href="<?php echo base_url('Shifts/Task/edit/' . $task->id); ?>" class="text-primary d-inline-block edit-item-btn">
                                    <i class="ri-pencil-fill fs-16"></i>
                                </a>
                            </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" onclick="deleteThisTask(this, <?php echo $task->id; ?>)">
                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
                                          
                                           
                                        </div>
                                       
                                
                                  

                                    <!-- Modal -->
                                    <div class="modal fade flip" id="deleteTask" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete a equipment ?</h4>
                                                        <p class="fs-15 mb-4 text-black">Deleting equipment will remove
                                                            all of
                                                            the information from our database.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button
                                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                                data-bs-dismiss="modal"><i
                                                                    class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                            <button class="btn btn-danger" value="" id="delete-record">Yes,
                                                                Delete It</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="modal fade flip" id="deleteMultipleEquipment" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete multiple equipment </h4>
                                                        <p class="fs-15 mb-4 text-black">Deleting equipment will remove
                                                            all of
                                                            the information from our database.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button
                                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                                data-bs-dismiss="modal"><i
                                                                    class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                            <button class="btn btn-danger" value="" onclick="deleteMultipleCheckl()">Yes,
                                                                Delete It</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end modal -->
                                </div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
</div>
<script>
$('#activeEquip').DataTable({
                lengthChange: false,
                pageLength: 100,
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        
function deleteMultipleEquipment(){
  $("#deleteMultipleEquipment").modal('show');  
}
function deleteMultipleCheckl(){
    let selectedValues = [];
   $('.checkbox-item:checked').each(function() {
            selectedValues.push($(this).val());
        });
        
      if (selectedValues.length > 0) {
            $.ajax({
                url: '/Shifts/Task/deleteMultiple',
                type: 'POST',
                data: { 
                    table_name: 'Shifts_task', 
                    selected_values: selectedValues 
                },
                success: function(response) {
                  $("#deleteMultipleEquipment").modal('hide'); 
                  for (var i = 0; i < selectedValues.length; i++) {
                  let id = selectedValues[i];
                  $('#row_'+id).remove();
                  }
                   
                }
            });
        } else {
            alert('No checkboxes selected.');
        }        
          
}
function deleteThisTask(obj,checklistId){
    $("#deleteTask").modal('show');
    $("#delete-record").val(checklistId);
    
}
 $(document).on("click", "#delete-record" , function() {
     let id = $(this).val();
       $.ajax({
         type: "POST",
         url: "/Shifts/Task/deleteTask",
         data:'id='+id,
          success: function(data){
          $('#row_'+id).remove();
          $("#deleteTask").modal('hide');
           }
          });
            });

    

$(function() {
    // Make the table rows sortable
    $("#sortable").sortable({
      
        update: function(event, ui) {
            let sortOrder = $(this).sortable("toArray", { attribute: "id" });

            $.ajax({
                url: "/Shifts/Task/updateSortOrder",
                type: "POST",
                data: { order: sortOrder },
                success: function(response) {
                    console.log("Order updated successfully");
                },
                error: function() {
        
                    console.log("Error updating order");
                }
            });
        }
    });
    
});





</script>