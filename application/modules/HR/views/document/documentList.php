<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="col-12">
                <div class="alert alert-success fade show" role="alert" style="display:none">
                    Documents Added Successfully
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 text-black">Manage Documents</h4>
                                <div class="page-title-right">
                                    <div class="d-flex justify-content-sm-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#flipModal">
                                            <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Document
                                        </button>
                                        <button type="button" class="btn btn-primary" id="editModal" data-bs-toggle="modal" data-bs-target="#flipEditModal" style="display:none"></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="siteList">
                                <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle table-nowrap" id="docListDatatable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="document_name">Document Name</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all" id="sortable">
                                            <?php if (!empty($documentLists)) : ?>
                                                <?php foreach ($documentLists as $documentList) : ?>
                                                    <tr id="row_<?php echo $documentList['id']; ?>">
                                                        <td class="customer_name"><?php echo $documentList['doc_name']; ?></td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-custom form-switch-success">
                                                                <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo $documentList['id']; ?>" <?php echo ($documentList['status'] == '1') ? 'checked' : ''; ?>>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <a onclick="showEditModal('<?php echo $documentList['doc_name']; ?>', <?php echo $documentList['role_id']; ?>, <?php echo $documentList['id']; ?>, '<?php echo $documentList['color']; ?>')" class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="remove">
                                                                    <a class="text-danger remove-item-btn" data-rel-id="<?php echo $documentList['id']; ?>">
                                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We did not find any record for your search.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
            </div>
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
</div><!-- main-content -->



<!-- Add Modal -->
<div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title">Add Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="tablelist-form documentAdd" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id-field">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="input_document_name" class="form-label">Document Name</label>
                            <input type="text" name="document_name" id="input_document_name" class="form-control" placeholder="Enter document name" required>
                            <div class="invalid-feedback prepNameError" style="display:none">Please enter document name</div>
                        </div>
                        <div class="col-md-12">
                            <h6 class="fw-semibold">Select Role</h6>
                            <select class="form-select" name="role_id" id="edited_role_id">
                                <?php if (!empty($roles)) :
                                    foreach ($roles as $role) : ?>
                                        <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                      
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submitButtonSite" onclick="addDocument()">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="flipEditModal" class="modal fade flip" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title">Update Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <input type="hidden" id="prepIdToUpdate" value="">
                            <label for="edited_input_document_name" class="form-label">Document Name</label>
                            <input type="text" name="document_name" id="edited_input_document_name" class="form-control" placeholder="Enter Document name" required>
                            <div class="invalid-feedback prepNameError" style="display:none">Please enter Document name</div>
                        </div>
                        <div class="col-md-12">
                            <h6 class="fw-semibold">Select Role</h6>
                            <select class="form-select" name="role_id" id="edited_role_id">
                                <?php if (!empty($roles)) :
                                    foreach ($roles as $role) : ?>
                                        <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateDocument()">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

 <script>
     $(document).on("click", ".remove-item-btn" , function() {
                var id = $(this).attr('data-rel-id');
                    Swal.fire({
                      title: "Are you sure?",
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
                            url: "/HR/document/delete",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
      $('#docListDatatable').DataTable({
                 lengthChange: false,
                 ordering: false,
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        
        function showEditModal(prepName,role_id,prepId,colorClass){
            console.log("role_id",role_id);
            $("#edited_input_document_name").val(prepName);
            $("#edited_color").val(colorClass);
            $("#edited_role_id").val(role_id);
            $("#prepIdToUpdate").val(prepId)
           $("#flipEditModal").modal('show');
        }
       function addDocument(){
            let prepName = $("#input_document_name").val()
            if(prepName == ''){
               $(".prepNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
           let formData = $(".documentAdd").serialize();
            $.ajax({
                 type: "POST",
                 url: "/HR/document/add",
                 data:formData,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updateDocument(){
            let docName = $("#edited_input_document_name").val();
            let colorClass = $("#edited_color").val();
            
            let role_id = $("#edited_role_id").val()
            console.log("edited_input_document_name",edited_input_document_name)
            let id = $("#prepIdToUpdate").val()
            if(docName == ''){
               $(".prepNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "/HR/document/updateDocument",
                 data:'doc_name='+docName+'&id='+id+'&role_id='+role_id,
                 success: function(data){
                    location.reload();
                }
                });
        }
        
        $(document).ready(()=>{
            setTimeout(()=>{
              $(".alert-success").fadeOut();   
            },7000);
        })
        $('.toggle-demo').on('change',function() {
         let id = $(this).attr('id');
        
        let status = 1;
     if($(this).prop('checked')){
          status = 1;
     }else{
          status = 0;
         
     }
     
      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
        url: "/HR/document/change_status",
        data: {"status":status,"id":id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    })   
    
    $(function() {
    // Make the table rows sortable
    $("#sortable").sortable({
      
        update: function(event, ui) {
            let sortOrder = $(this).sortable("toArray", { attribute: "id" });

            $.ajax({
                url: "/Temp/Prep/updateSortOrder",
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
 
