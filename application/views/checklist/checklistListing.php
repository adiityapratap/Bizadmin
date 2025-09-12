 <div class="container-fluid" style="margin-top: 130px !important;">
 <div class="row" >
                        <div class="col-lg-12">
                            <div class="card py-3" id="orderList">
                                <div class="card-header  border-0 py-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="card-title mb-0 flex-grow-1 text-black">Checklist</h5>
                                        <a type="button" class="btn btn-warning btn-sm fs-14" 
                                                id="create-btn" href="<?php echo base_url('config/configureAddUpdate') ?>"><i
                                                    class="ri-mail-settings-fill align-bottom "></i> Settings
                                                </a>
                                       <a type="button" class="btn btn-primary btn-sm fs-14" 
                                                id="create-btn" href="<?php echo base_url('checklist/checklist') ?>"><i
                                                    class="ri-add-line align-bottom "></i> Create Task
                                                </a>
                                        <a href="<?php echo base_url('checklist/viewAttachments') ?>" class="btn btn-green btn-sm fs-14 d-flex gap-2">
                                                <i class="ri-attachment-fill align-bottom"></i><span class="d-none d-sm-block"> View Attachments</span> </a>
                                 <button class="btn btn-soft-danger fs-14" onClick="deleteMultipleChecklist()"><i class="ri-delete-bin-6-line"></i></button>                
                                    </div>
                                </div>
                              
                                <div class="card-body pt-0">
                                       <small>*Drag and drop to adjust sort order</small>
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                          
                                             <li class="nav-item">
                                                <a class="nav-link py-3 Delivered active" data-bs-toggle="tab"
                                                    href="#activeChecklist" role="tab" aria-selected="false">
                                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> All Checklist
                                                </a>
                                            </li>
                                           
                                           
                                          
                                           
                                        </ul>

                                        <div class="table-responsive table-card mb-1">
                                          
                                            <table class="table table-nowrap align-middle" id="activeChecklist">
                                               
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                            </div>
                                                        </th>
                                                       
                                                        <th class="sort" data-sort="customer_name">Topic</th>
                                                        <th class="sort" data-sort="product_name">Roles</th>
                                                        <th class="sort" data-sort="date">Time</th>
                                                        <th class="sort" data-sort="product_name">Schedule</th>
                                                        <th class="sort" data-sort="product_name">System</th>
                                                        <th class="sort" data-sort="status">Status</th>
                                                        <th class="sort" data-sort="city">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all" id="sortable">
                                                    <?php if(!empty($checklistData)) {  ?>
                                                     <?php foreach($checklistData as $checklist) {  ?>
                                                    <tr id="<?php echo 'row_'.$checklist->id;  ?>" >
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkAll checkbox-item" type="checkbox" name="checkAll" value="<?php echo $checklist->id;  ?>">
                                                            </div>
                                                        </th>
                                                       
                                                        <td class="descr text-wrap handle"><?php echo (isset($checklist->title) ? $checklist->title : '');  ?></td>
                                                         <td class="descr text-wrap handle">
                                                             
                                                          <?php foreach($roles as $role){ 
                                                if(is_array(unserialize($checklist->role_id)) && in_array((int)$role['id'],unserialize($checklist->role_id))) { 
                                                echo $role['name']."  ";
                                                   } 
                                                } ?>   
                                                             
                                                             
                                                         </td>
                                                        <td class="deadline_time"><?php echo (isset($checklist->deadline_time) && $checklist->deadline_time !='' ? date("H:i A", strtotime($checklist->deadline_time)) : ''); ?></td>
                                                        <?php if($checklist->checklist_start_date !='' && $checklist->checklist_end_date !='') { ?>
                                                       
                                                        <td class="date"><?php echo date("d-m-Y", strtotime($checklist->checklist_start_date)).' to '.date("d-m-Y", strtotime($checklist->checklist_end_date));  ?></td>
                                                        <?php } elseif($checklist->checklist_start_date !='' && $checklist->checklist_end_date =='') { ?>
                                                        <td class="date"><?php echo date("d-m-Y", strtotime($checklist->checklist_start_date));  ?></td>
                                                        <?php }else{ ?>
                                                        <td class="schedule_at"><?php echo $checklist->schedule_name;  ?></td>   
                                                        <?php }  ?>
                                                       <td class="systemName"><?php echo $checklist->systemName;  ?></td> 
                                                       <td>
                                                       <div class="form-check form-switch form-switch-custom form-switch-success">
                                                        <input class="form-check-input checklisttoggle-demo" data-tablename="Global_checklist" type="checkbox" role="switch" data-id="<?php echo  $checklist->id; ?>" <?php echo ($checklist->status ? 'checked' : '');  ?>>
                                                       </div>
                                                       </td>
                                                      
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                               
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Edit">
                                                                    <a href="<?php echo base_url('checklist/editChecklist/'.$checklist->id) ?>"  class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        onclick="deleteThisChecklist(this,<?php echo  $checklist->id; ?>)">
                                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <?php }  ?>
                                                    <?php }  ?>
                                                </tbody>
                                            </table>
                                          
                                           
                                        </div>
                                       
                                    </div>
                                  

                                    <!-- Modal -->
                                    <div class="modal fade flip" id="deleteChecklist" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete a Checklist ?</h4>
                                                        <p class="fs-15 mb-4 text-black">Deleting checklist will remove
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
                                     <div class="modal fade flip" id="deleteMultipleChecklist" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete multiple Checklists </h4>
                                                        <p class="fs-15 mb-4 text-black">Deleting checklist will remove
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
// $('#activeChecklist').DataTable({
//                 lengthChange: false,
//                 "columnDefs": [ {
//                   "targets"  : 'no-sort',
//                   "orderable": false
//                 }]
//         });
        
function deleteMultipleChecklist(){
  $("#deleteMultipleChecklist").modal('show');  
}
function deleteMultipleCheckl(){
    let selectedValues = [];
   $('.checkbox-item:checked').each(function() {
            selectedValues.push($(this).val());
        });
        
      if (selectedValues.length > 0) {
            $.ajax({
                url: '/Checklist/deleteMultiple',
                type: 'POST',
                data: { 
                    table_name: 'Global_checklist', 
                    selected_values: selectedValues 
                },
                success: function(response) {
                  $("#deleteMultipleChecklist").modal('hide'); 
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
function deleteThisChecklist(obj,checklistId){
    $("#deleteChecklist").modal('show');
    $("#delete-record").val(checklistId);
    
}
 $(document).on("click", "#delete-record" , function() {
     let id = $(this).val();
       $.ajax({
         type: "POST",
         url: "/General/record_delete",
         data:'id='+id+'&table_name=Global_checklist',
          success: function(data){
          $('#row_'+id).remove();
          $("#deleteChecklist").modal('hide');
           }
          });
            });
            


$(function() {
    // Make the table rows sortable
    $("#sortable").sortable({
      
        update: function(event, ui) {
            let sortOrder = $(this).sortable("toArray", { attribute: "id" });

            $.ajax({
                url: "/Checklist/updateSortOrdersOfChecklist",
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