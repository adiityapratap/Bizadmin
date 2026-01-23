 <div class="container-fluid" style="margin-top: 130px !important;">
 <div class="row" >
                        <div class="col-lg-12">
                            <div class="card py-3" id="orderList">
                                <div class="card-header  border-0 py-0">
                                    
                                </div>
                              
                                <div class="card-body pt-0">
                                  
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
                                            <table class="table table-nowrap align-middle" id="checklistAttachmentHistory">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="customer_name">Date</th>
                                                        <th class="sort" data-sort="product_name">Topic</th>
                                                        <th class="sort" data-sort="date">Role</th>
                                                        <th class="sort" data-sort="product_name">Time</th>
                                                        <th class="sort" data-sort="product_name">Attachments </th>
                                                        <th class="sort" data-sort="status">Comments</th>
                                                        <th class="sort" data-sort="city">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all" id="sortable">
                                                    <?php  if(!empty($checklistHistoyData)) {  ?>
                                                     <?php foreach($checklistHistoyData as $checklistHistoy) {   ?>
                                                       <?php   $attachments =  unserialize($checklistHistoy->attachment);?>
                                                    <tr id="<?php echo 'row_'.$checklistHistoy->attachId;  ?>" >
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkAll checkbox-item" type="checkbox" name="checkAll" value="<?php echo $checklistHistoy->id;  ?>">
                                                            </div>
                                                        </th>
                                                       <td class="date_completed"><?php echo (isset($checklistHistoy->date_completed) && $checklistHistoy->date_completed !='' && $checklistHistoy->date_completed !='0000-00-00' ? date("d-m-Y", strtotime($checklistHistoy->date_completed)) : '<b><i class="fas fa-info-circle" data-toggle="tooltip" title="Checklist was not completed"></i>
'.date("d-m-Y", strtotime($checklistHistoy->date_modified))).'</b>' ; ?></td>
                                                        <td class="descr text-wrap handle"><?php echo (isset($checklistHistoy->title) ? $checklistHistoy->title : '');  ?></td>
                                                         <td class="descr text-wrap handle">
                                                             
                                                          <?php foreach($roles as $role){ 
                                                if(is_array(unserialize($checklistHistoy->role_id)) && in_array((int)$role['id'],unserialize($checklistHistoy->role_id))) { 
                                                echo $role['name']."  ";
                                                   } 
                                                } ?>   
                                                             
                                                             
                                                         </td>
                                                        <td class="deadline_time"><?php echo date("H:i A", strtotime($checklistHistoy->deadline_time)); ?></td>
                                                       <td class="attachment"><a onclick="showAttachment('<?php echo $checklistHistoy->attachId; ?>')" class="btn btn-sm btn-green">View</a></td> 
                                                       <td class="systemName"><?php echo $checklistHistoy->checklistComments;  ?></td> 
                                                      
                                                    
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                               
                                                               
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        onclick="deleteThisChecklist(this,<?php echo  $checklistHistoy->checklistHostoryId; ?>)">
                                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    
                                                    
                                                    
<div id="attachmentChecklistModal_<?php echo $checklistHistoy->attachId; ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Attachments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body appendAttachment">
                <div class="card">
                              
                          <div class="card-body">
                                        
                                        <div class="swiper pagination-progress-swiper rounded">
                                            <div class="swiper-wrapper">
                                                <?php if(!empty($attachments)) {  ?>
                                                <?php foreach($attachments as $attachment) {  ?>
                                                <div class="swiper-slide">
                                               
                                                    <img src="/uploaded_files/<?php echo $orzName; ?>/Checklist/checklistAttachments/<?php echo $attachment ?>" alt="" class="img-fluid" style="width: 100%;"/>
                                                </div>
                                              <?php } } ?>
                                            </div>
                                            <div class="swiper-button-next bg-white shadow"></div>
                                            <div class="swiper-button-prev bg-white shadow"></div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div><!-- end card-body -->
                            </div><!-- end card --> 
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>            
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                  
                                                    
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
                                                        <h4 class="text-black">You are about to delete a record ?</h4>
                                                        <p class="fs-15 mb-4 text-black">Deleting record will remove
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
                                    
                                    <!--end modal -->
                                </div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
</div>



<!-- Default Modals -->

<!-- /.modal -->
<link href="/theme-assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
<script src="/theme-assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="/theme-assets/js/pages/swiper.init.js"></script>

<script>

function deleteThisChecklist(obj,checklistId){
    $("#deleteChecklist").modal('show');
    $("#delete-record").val(checklistId);
    
}

$('#checklistAttachmentHistory').DataTable({
                lengthChange: false,
                ordering: false,
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        

function showAttachment(checklistID){
    
    // let html = '<img width="100%" src="'+attachmentName+'" alt="Attachment">';
   
   $("#attachmentChecklistModal_"+checklistID).modal('show');
   
}

 $(document).on("click", "#delete-record" , function() {
     let id = $(this).val();
       $.ajax({
         type: "POST",
         url: "/General/record_delete",
         data:'id='+id+'&table_name=Global_checklistToDateCompleted',
          success: function(data){
          $('#row_'+id).remove();
          $("#deleteChecklist").modal('hide');
           }
          });
            });
            




</script>