 <div class="container-fluid" style="margin-top: 130px !important;">
 <div class="row" >
                        <div class="col-lg-12">
                            <div class="card" id="orderList">
                                <div class="card-header  border-0">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1 text-black">Users</h5>
                                        <div class="flex-shrink-0">
                                            <a type="button" class="btn btn-primary add-btn" 
                                                id="create-btn" href="<?php echo base_url('auth/create_user') ?>"><i
                                                    class="ri-add-line align-bottom me-1"></i> Add User
                                                </a>
                                           
                                             <button class="btn btn-soft-danger fs-14" onClick="deleteMultipleChecklist()"><i class="ri-delete-bin-6-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border border-dashed border-end-0 border-start-0">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-xxl-5 col-sm-6 col-lg-6 col-md-6">
                                                <div class="search-box">
                                                    <input type="text" class="form-control search"
                                                        placeholder="Search for User Id, Full name, Email or something...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->
                                          
                                            <!--end col-->
                                           
                                           
                                            <!--end col-->
                                            <!--<div class="col-xxl-1 col-sm-4">-->
                                            <!--    <div>-->
                                            <!--        <button type="button" class="btn btn-primary w-100"-->
                                            <!--            onclick="SearchData();"> <i-->
                                            <!--                class="ri-equalizer-fill me-1 align-bottom"></i>-->
                                            <!--            Filters-->
                                            <!--        </button>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <div class="card-body pt-0">
                                    <div>
                                        
                                       <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link py-3 active" data-bs-toggle="tab" href="#activeuserTab" role="tab" aria-selected="false">
                                                    <i class="ri-store-2-fill me-1 align-bottom"></i> Active   
                                                </a>
                                               
                                                
                                            </li>
                                           
                                            <li class="nav-item">
                                                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab"
                                                    href="#cancelledUserTab" role="tab" aria-selected="false">
                                                    <i class="ri-close-circle-line me-1 align-bottom"></i> Inactive
                                                </a>
                                            </li>
                                            
                                        </ul>
                                        
                                       
                                        
                                       
                                        
                                        <div class="tab-content  text-muted"> 
                                         <div class="tab-pane active" id="activeuserTab" role="tabpanel">
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-nowrap align-middle" id="orderTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkAll checkbox-item" type="checkbox" id="checkAll" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="id">User ID</th>
                                                        <th class="sort" data-sort="customer_name">Full name</th>
                                                        <th class="sort" data-sort="product_name">Locations</th>
                                                        <th class="sort" data-sort="date">Email</th>
                                                        <th class="sort" data-sort="role">Role</th>
                                                        <!--<th class="sort" data-sort="status">Status</th>-->
                                                        <th class="sort" data-sort="status">Status</th>
                                                        <th class="sort" data-sort="city">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php if(!empty($activeUsers)) {   ?>
                                                     <?php foreach($activeUsers as $allActiveUser) { ?>
                                                     <?php $locationNames = fetchLocationNamesFromIds(unserialize($allActiveUser->location_ids));  $locationNames = implode(', ', $locationNames);?>
                                                      <?php  $groups = $this->ion_auth->get_users_groups($allActiveUser->id)->result(); ?>
                                                     <?php $rolename =  (!empty($groups) ?  $groups[0]->name : ''); ?>
                                                    <tr class="recordRow">
                                                       <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkAll checkbox-item" type="checkbox" name="checkAll" value="<?php echo $allActiveUser->id;  ?>">
                                                            </div>
                                                        </th>
                                                        <td class="id"><?php echo $allActiveUser->id;  ?></td>
                                                        <td class="customer_name"><?php echo $allActiveUser->first_name;  ?></td>
                                                        <td class="product_name"><?php echo $locationNames;  ?></td>
                                                        <td class="amount"><?php echo $allActiveUser->email;  ?></td>
                                                         <td class="amount"><?php echo $rolename;  ?></td>
                                                       <td>
                                                       <div class="form-check form-switch form-switch-custom form-switch-success">
                                                        <input class="form-check-input userlisttoggle-demo" type="checkbox" role="switch" data-value="<?php echo $allActiveUser->active; ?>" data-id="<?php echo  $allActiveUser->id; ?>" <?php echo ($allActiveUser->active ? 'checked' : '');  ?>>
                                                       </div>
                                                       </td>
                                                       
                                                        <!--<td class="status"><span class="badge bg-success-subtle text-success">Active</span>-->
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="View">
                                                                    <a href="<?php echo base_url('auth/edit_user/'.$allActiveUser->id) ?>" class="text-primary d-inline-block">
                                                                        <i class="ri-eye-fill fs-16"></i>/<i class="ri-pencil-line fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            <?php  if($rolename !='Admin') { ?>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo $allActiveUser->id;  ?>" data-bs-toggle="modal"><i class="ri-delete-bin-5-fill fs-16"></i></a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <?php }  ?>
                                                    <?php }  ?>
                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#0ab39c"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted">We've searched /</p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="tab-pane" id="cancelledUserTab" role="tabpanel">
                                         <div class="table-responsive table-card mb-1 cccc">
                                            <table class="table table-nowrap align-middle" id="orderTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="id">User ID</th>
                                                        <th class="sort" data-sort="customer_name">Full name</th>
                                                        <th class="sort" data-sort="product_name">Username</th>
                                                        <th class="sort" data-sort="date">Email</th>
                                                        <th class="sort" data-sort="role">Role</th>
                                                        <th class="sort" data-sort="status">Status</th>
                                                        <th class="sort" data-sort="city">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php if(!empty($InActiveUsers)) {  ?>
                                                     <?php foreach($InActiveUsers as $allInactiveUser) {  ?>
                                                     <?php  $groups = $this->ion_auth->get_users_groups($allInactiveUser->id)->result(); ?>
                                                     <?php $rolename =  (!empty($groups) ?  $groups[0]->name : ''); ?>
                                                    <tr class="recordRow">
                                                       <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkAll checkbox-item" type="checkbox" name="checkAll" value="<?php echo $allInactiveUser->id;  ?>">
                                                            </div>
                                                        </th>
                                                        <td class="id"><a href="apps-ecommerce-order-details.html" class="fw-medium link-primary"><?php echo $allInactiveUser->id;  ?></a></td>
                                                        <td class="customer_name"><?php echo $allInactiveUser->first_name;  ?></td>
                                                        <td class="product_name"><?php echo $allInactiveUser->username;  ?></td>
                                                       
                                                        <td class="amount"><?php echo $allInactiveUser->email;  ?></td>
                                                        <td class="amount"><?php echo $rolename;  ?></td>
                                                        <td class="status"><a href="#" onclick="revertTheUser(this,<?php echo $allInactiveUser->id; ?>)"><span class=" badge-warning text-uppercase">Revert</span></a>
                                                        </td>
                                                        <td>
                                                            
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="View">
                                                                    <a href="<?php echo base_url('auth/edit_user/'.$allInactiveUser->id) ?>" class="text-primary d-inline-block">
                                                                        <i class="ri-eye-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                          <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo $allInactiveUser->id;  ?>" data-bs-toggle="modal">
                                                                        
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
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#0ab39c"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted">We've searched /</p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                         
                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="#">
                                                    Previous
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="#">
                                                    Next
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete a User ?</h4>
                                                        <p class="text-black fs-15 mb-4">Deleting your user will remove
                                                            all of
                                                            the information from our database.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button
                                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                                data-bs-dismiss="modal"><i
                                                                    class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                                <input class="deletedRecordId" type="hidden">
                                                            <button class="btn btn-danger" id="delete-record">Yes,
                                                                Delete It</button>
                                                        </div>
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
</div>

<div class="modal fade flip" id="deleteMultipleChecklist" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete multiple Users </h4>
                                                        <p class="fs-15 mb-4 text-black">Deleting user will remove
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
<script>
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
                    table_name: 'Global_users', 
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

$(".userlisttoggle-demo").on('change',function(){
         let user_id = $(this).attr('data-id');
         let value = $(this).attr('data-value');
         let methodName = ''
          if(value == 1){
            methodName = 'deactivate';   
          }else{
            methodName = 'activate';   
          }
          console.log("value",value);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/auth/"+methodName+"/"+user_id,
                success: function(data){
                 console.log("user updated");
                }
                });    
});

       
function revertTheUser(obj,user_id){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/auth/revertUser/"+user_id,
                success: function(){
                 console.log("user reverted");
                 $(obj).parents(".recordRow").remove();
                }
                });  
}

$('#delete-record').click(function(){
    
     let deleteId =  $(".deletedRecordId").val();
  
               $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/general/record_delete",
                data:'id='+deleteId+'&table_name=Global_users',
                success: function(data){
                //   location.reload();
                  if(data == 'deleted'){
                    $("tr[data-delete-id='" + deleteId + "']").remove();
                  }
                   $("#deleteOrder").modal('hide');
                }
                });
   
    
});
$('.remove-item-btn').click(function(){
    $("#deleteOrder").modal('show');
    let id = $(this).attr('data-rel-id');
    $(".deletedRecordId").val(id);
    $(this).closest('.recordRow').attr("data-delete-Id", id);
    
     
});
</script>