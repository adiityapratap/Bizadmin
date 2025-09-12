 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="col-12">
               <div class="alert alert-success fade show" role="alert" style="display:none">
                   Folder Added Succesfully
                    </div>
                    </div>
                      

                        <div class="row">
                            
                            <div class="col-lg-12">
    
                                <div class="card" >
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black ">Folders</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end gap-3">
                                               
                                                <button onclick="switchUI()" class="btn-secondary btn switchUIBtns"><i class="ri-camera-switch-line fs-14 align-bottom me-1"></i>Table view</button>
                                                <button onclick="switchUI()" class="btn-secondary btn  d-none switchUIBtns"><i class=" ri-camera-switch-line fs-14 align-bottom me-1"></i>List view</button>
                                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#flipModal"> <i class="ri-add-line fs-14 align-bottom me-1"></i>Create Folder </button>
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>
               <!--------------------------------------- ------------------ Table View ------------------------------------------------------------ -->                        
                                    <div class="card-body switchUIclass d-none ">
                                        <div id="siteList">
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="folderListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="folder_name">Folder Name</th>
                                                           <th class="sort" data-sort="folder_name">Permission</th>
                                                            <th class="sort" data-sort="status">Status</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all" id="sortable">
                                                        <?php if(!empty($allFolders)) {  ?>
                                                        <?php foreach($allFolders as $allFolder){   ?>
                                                        <tr id="row_<?php echo  $allFolder['id']; ?>" >
                                                            
                                                            <?php 
                                                            $groupIdsArray = explode(',', $allFolder['role_ids']);
                                                             $groupNames = array_map(function ($groupId) {
                                                             $group = $this->ion_auth->group($groupId)->row();
                                                             return $group ? $group->name : "";
                                                             }, $groupIdsArray); ?>
                                                            <td class="customer_name"><?php echo $allFolder['folder_name']; ?></td>
                                                            <td class="customer_name"><?php echo implode(',', $groupNames); ?></td>

                                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $allFolder['id']; ?>" <?php if(isset($allFolder['status']) && $allFolder['status']  == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            
                                                            <td>
                                                                
                                                         <ul class="list-inline hstack gap-2 mb-0">
                                                               
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Edit">
                                                                    <a onclick="showEditModal('<?php echo $allFolder['folder_name']; ?>',<?php echo $allFolder['id']; ?>,'<?php echo $allFolder['role_ids']; ?>')"  class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        data-rel-id="<?php echo  $allFolder['id']; ?>">
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
                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                                       <p class="text-muted mb-0">We did not find any record for you search.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                    </div>    
                                    
                <!---------------------------------------------------------- Folder view -------------------------------------------------------------------- -->
                                    <div class="card-body d-flex  gap-5 switchUIclass">
                                       <?php if(!empty($allFolders)) {  ?>
                                    <?php foreach($allFolders as $allFolder){   ?>
                                    
                             <!--<lord-icon src="https://cdn.lordicon.com/wwmtsdzm.json"  trigger="hover"  style="width:150px;height:150px"> </lord-icon>  -->
                           
                              <div class="text-center folder_<?php echo  $allFolder['id']; ?>">
                            <img  onclick="openSubFolder(<?php echo $allFolder['id']; ?>)" src="<?php echo base_url('application/modules/Dms/assets/images/folderImage.png') ?>" width="150" height="150" class="img-fluid"></br>
                       <span class="folder-name"><?php echo $allFolder['folder_name']; ?></span>
                        </div>
                      
                 
                                                        
                                      <?php } ?>
                                     <?php } ?>    
                                      
                                    </div><!-- end card -->
                                    
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

               
            </div>
 
        
 <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Folder </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <div class="position-relative d-inline-block">
                                                                        <div class="position-absolute  bottom-0 end-0">
                                                                           
                                                                            <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                                        </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                               <div>
                                                                    <label for="name-field" class="form-label">Folder Name</label>
                                                                    <input type="text"  name="input_folder_name" id="input_folder_name" class="form-control" placeholder="Enter new folder name" required="">
                                                                <div class="invalid-feedback folderNameError" style="display:none">
                                                                    Please enter  Folder name
                                                                    </div>
                                                               </div>
                                                                 <div class="col-md-12">
                                            <h6 class="fw-semibold">Assign Permission</h6>
                                            <select class="js-example-basic-single" name="role_ids[]" id="role_id" multiple>
                                                <?php if(isset($roles) && !empty($roles)) { ?>
                                                <?php foreach($roles as $role){  ?>
                                           <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>        
                                                <?php } ?>
                                                 <?php } ?>
                                               
                                            </select>
                                        </div>
                                            
                                        
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="addFolder()">Add </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
 <div id="flipEditModal" class="modal fade flip"  role="dialog">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Folder</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <div class="position-relative d-inline-block">
                                                                        <div class="position-absolute  bottom-0 end-0">
                                                                            <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                                        </div>
                                                                      
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <label for="name-field" class="form-label">Folder Name</label>
                                                                    <input type="hidden" id="folderIdToUpdate" value="">
                                                                    <input type="text" id="edited_input_folder_name" class="form-control" placeholder="Enter folder name" required="">
                                                                <div class="invalid-feedback folderNameError" style="display:none">
                                                                    Please enter folder name
                                                                    </div>
                                                                </div>
                                                                
                                             <div class="col-md-12">
                                            <h6 class="fw-semibold">Assign Permission</h6>
                                            <select class="js-example-basic-single" name="role_ids[]" id="edit_role_id" multiple>
                                                <?php if(isset($roles) && !empty($roles)) { ?>
                                                <?php foreach($roles as $role){  ?>
                                           <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>        
                                                <?php } ?>
                                                 <?php } ?>
                                               
                                            </select>
                                        </div>
                                        
                                        
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="updateFolder()">Save </button>
                                                        </div>
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
                            url: "Folder/delete",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                              $('.folder_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
        
        var myDropzone = new Dropzone(".dropzone", {
        maxFilesize: 5, // MB
        acceptedFiles: 'image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        dictDefaultMessage: 'Drop your files here or click to upload',
         success: function(file, response){
             console.log(response);
                // location.reload();
            }
       });
        
        function switchUI(){
            $('.switchUIclass').toggleClass('d-none');
            $('.switchUIBtns').toggleClass('d-none');
        }
        
        function openSubFolder(folderId){
          window.location.href = '<?php echo base_url('/Dms/Subfolder/subfolderList/'); ?>' + folderId;
        }
    
        
        function showEditModal(folderName,id,roleIds){
            let selectedroleIds = roleIds.split(',');
           $("#edit_role_id").val(selectedroleIds)
            $(".js-example-basic-single").select2();
            
            $("#edited_input_folder_name").val(folderName);
           
            $("#folderIdToUpdate").val(id)
           $("#flipEditModal").modal('show');
        }
        function addFolder(){
            
            let folderName = $("#input_folder_name").val();
            let siteId = $("#site_id").val();
            let role_ids = $("#role_id").val()
            if(folderName == ''){
               $(".folderNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            console.log("Site id",siteId)
            $.ajax({
                 type: "POST",
                 url: "Folder/add",
                 data:'folder_name='+folderName+'&role_ids='+role_ids,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updateFolder(){
            let folderName = $("#edited_input_folder_name").val();
           
            let role_ids = $("#edit_role_id").val()
            let id = $("#folderIdToUpdate").val()
            if(folderName == ''){
               $(".folderNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "Folder/updateFolder",
                 data:'folder_name='+folderName+'&id='+id+'&role_ids='+role_ids,
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
      console.log("status",status)
      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
        url: "Folder/change_status",
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
                url: "Folder/updateSortOrder",
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
 