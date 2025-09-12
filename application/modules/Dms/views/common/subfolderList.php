 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="col-12">
               <div class="alert alert-success fade show" role="alert" style="display:none">
                   Sub Folder Added Succesfully
                    </div>
                    </div>
                      

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black ">Sub Folders</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end gap-2">
                                                        
                                                <button onclick="goBack()" class="btn bg-orange"><i class="ri-reply-fill label-icon align-middle fs-16 me-2"></i>Back</button>
                                                <button onclick="switchUI()" class="btn-secondary btn switchUIBtns"><i class="ri-camera-switch-line fs-14 align-bottom me-1"></i>Table view</button>
                                                <button onclick="switchUI()" class="btn-secondary btn  d-none switchUIBtns"><i class=" ri-camera-switch-line fs-14 align-bottom me-1"></i>List view</button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#flipModal"> <i class="ri-add-line fs-14 align-bottom me-1"></i>Create Sub Folder </button>
                                                
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body switchUIclass d-none">
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link py-3 Delivered active" data-bs-toggle="tab"
                                                    href="#subFoldersTab" role="tab" aria-selected="false">
                                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Sub Folders
                                                </a>
                                            </li>
                                            
                                             <li class="nav-item">
                                                <a class="nav-link py-3 Delivered" data-bs-toggle="tab"
                                                    href="#docTab" role="tab" aria-selected="false">
                                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Uploaded Documents
                                                </a>
                                            </li>
                                           
                                           
                                            
                                        </ul>
                                       <div class="siteList tab-content mb-1">
                                            <div class="tab-pane   active show " id="subFoldersTab" role="tabpanel">
                                                <table class="table align-middle table-nowrap" id="folderListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="subfolder_name">Sub Folder Name</th>
                                                          <th class="sort" data-sort="folder_name">Permission</th>
                                                            <th class="sort" data-sort="status">Status</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all" id="sortable">
                                                        <?php if(!empty($allSubFolders)) {  ?>
                                                        <?php foreach($allSubFolders as $allSubFolder){ ?>
                                                        <tr id="row_<?php echo  $allSubFolder['id']; ?>" >
                                                            <td class="customer_name"><?php echo $allSubFolder['subfolder_name']; ?></td>
                                                            <?php 
                                                            $groupIdsArray = explode(',', $allSubFolder['role_ids']);
                                                             $groupNames = array_map(function ($groupId) {
                                                             $group = $this->ion_auth->group($groupId)->row();
                                                             return $group ? $group->name : "";
                                                             }, $groupIdsArray); ?>
                                                            <td class="customer_name"><?php echo implode(',', $groupNames);; ?></td> 
                                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $allSubFolder['id']; ?>" <?php if(isset($allSubFolder['status']) && $allSubFolder['status']  == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            
                                                            <td>
                                                                
                                                         <ul class="list-inline hstack gap-2 mb-0">
                                                               
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Edit">
                                                                    <a onclick="showEditModal('<?php echo $allSubFolder['subfolder_name']; ?>',<?php echo $allSubFolder['folder_id']; ?>,<?php echo $allSubFolder['id']; ?>,'<?php echo $allSubFolder['role_ids']; ?>')"  class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        data-rel-id="<?php echo  $allSubFolder['id']; ?>" data-rel-tableName='DMS_sub_folders'>
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
                                        <div class="mb-1 tab-pane" id="docTab" role="tabpanel">        
                                                <table class="table align-middle table-nowrap" id="documentsListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="folder_name">File Name</th>
                                                          
                                                          <th class="sort" data-sort="folder_name">View</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all" id="sortable">
                                                        <?php if(!empty($allDocsOfThisFolders)) {  ?>
                                                        <?php foreach($allDocsOfThisFolders as $allDocsOfThisFolder){  $fileName = $allDocsOfThisFolder['name']; ?>
                                                        <tr id="row_<?php echo  $allDocsOfThisFolder['id']; ?>" >
                                                            <td class="customer_name"><?php echo $allDocsOfThisFolder['file_display_name']; ?></td>
                                                             <td>
                                    <a class="btn btn-primary" href="<?php echo $file_path . $fileName; ?>" target="_blank" >View</a>                             
                                                  </td>  
                                                    <td>
                  <ul class="list-inline hstack gap-2 mb-0">
               
                                                               
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        data-rel-id="<?php echo  $allDocsOfThisFolder['id']; ?>" data-rel-tableName='DMS_documents'>
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
                                            
                                           
                                        </div>
                                    </div><!-- end card -->
                                    
                                     <!---------------------------------------------------------- Folder view -------------------------------------------------------------------- -->
                                    <div class="card-body d-flex  gap-5 switchUIclass">
                        <?php if(!empty($allSubFolders)) {  ?>
                       <?php foreach($allSubFolders as $allSubFolder){   ?>
                       <div class="text-center">
                            <img  onclick="openSubFolder(<?php echo $allSubFolder['id']; ?>)" src="<?php echo base_url('application/modules/Dms/assets/images/folderImage.png') ?>" width="150" height="150" class="img-fluid"></br>
                          <span class="folder-name"><?php echo $allSubFolder['subfolder_name']; ?></span>
                        </div>
                         <?php } ?>
                         <?php } ?> 
                         
                        <?php if(!empty($allDocsOfThisFolders)) {  ?>
               <?php foreach($allDocsOfThisFolders as $allDocsOfThisFolder){   ?>
              <?php  $fileName = $allDocsOfThisFolder['name'];
               $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
               ?>
                     <div class="text-center doc_<?php echo  $allDocsOfThisFolder['id']; ?>">
                      <a href="<?php echo $file_path . $fileName; ?>" target="_blank">
           <?php if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif', 'bmp'])){ ?>
        <img src="<?php echo $file_path . $fileName; ?>"  class="img-fluid mt-4 " alt="<?php echo $fileName; ?>" style="width:120px; height:120px">
        <?php } else if($fileExtension === 'pdf'){ ?>
        <img src="<?php echo base_url('application/modules/Dms/assets/images/PDF_file_icon.png'); ?>"  class="img-fluid mt-4" alt="<?php echo $fileName; ?>" style="width:120px; height:120px">
         <?php }else if (in_array($fileExtension, ['doc', 'docx'])){ ?>
        <img src="<?php echo base_url('application/modules/Dms/assets/images/microsoft-word-icon.png') ?>"  class="img-fluid mt-4" alt="<?php echo $fileName; ?>" style="width:120px; height:120px"> 
         <?php }else { ?>
         <img src="<?php echo base_url('application/modules/Dms/assets/images/docIcon.png') ?>"  class="img-fluid mt-4" alt="<?php echo $fileName; ?>" style="width:120px; height:120px">
         <?php } ?>
           </a></br>
           <span class="file-name"><?php echo $allDocsOfThisFolder['file_display_name']; ?></span>
                    </div>
                 <?php } ?>
                 <?php } ?> 
                         
                         
                        <div class="text-center">             
                      <img  onclick="uploadDoc(<?php echo $folderId; ?>)" src="<?php echo base_url('application/modules/Dms/assets/images/addUploadImage.png') ?>" width="160" style="height:140px" class="img-fluid"></br>                 
                        <span class="file-name">Upload Doc</span>  
                        </div>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Folder </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="folder_id" value="<?php echo $folderId; ?>">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <div class="position-relative d-inline-block">
                                                                        <div class="position-absolute  bottom-0 end-0">
                                                                           
                                                                            <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                                        </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                               
                                                                    <label for="name-field" class="form-label">Sub Folder Name</label>
                                                                    <input type="text"  name="input_subfolder_name" id="input_subfolder_name" class="form-control" placeholder="Enter sub folder name" required="">
                                                                <div class="invalid-feedback folderNameError" style="display:none">
                                                                    Please enter Sub Folder name
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
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="addSubFolder()">Add </button>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Sub Folder</h5>
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
                                                                    <label for="name-field" class="form-label">Sub Folder Name</label>
                                                                    <input type="hidden" id="folderIdToUpdate" value="">
                                                                    <input type="text" id="edited_input_subfolder_name" class="form-control" placeholder="Enter folder name" required="">
                                                                <div class="invalid-feedback folderNameError" style="display:none">
                                                                    Please enter sub folder name
                                                                    </div>
                                                                </div>
                                                                
                                          <div class="col-md-12">
                                            <h6 class="fw-semibold">Select Folder</h6>
                                            <select class="js-example-basic-single" name="folder_id" id="edited_folder_id">
                                                <?php if(isset($allFolders) && !empty($allFolders)) { ?>
                                                <?php foreach($allFolders as $allFolder){  ?>
                                           <option value="<?php echo $allFolder['id'] ?>"><?php echo $allFolder['folder_name'] ?></option>        
                                                <?php } ?>
                                                 <?php } ?>
                                               
                                            </select>
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
      <div id="flipUploadModal" class="modal fade flip"  role="dialog">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload Documents</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
         <form action="<?php echo base_url('/Dms/Folder/uploadFolderDoc');?>" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                  
                                                        <input type="hidden" id="folderId" name="folderId">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                   <input type="text" name="docName" class="form-control" placeholder="Enter Document Name">   
                                          <div class="dz-message needsclick">
                                          <div class="mb-3">
                                          <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                          </div>
                                          <h4 class="text-black">Drop your files here or click to upload.</h4>
                                          </div>
                                          </div>
                                      </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                           
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>   
      
       
        <script>
     $(document).on("click", ".remove-item-btn" , function() {
                let id = $(this).attr('data-rel-id');
                let tableName = $(this).attr('data-rel-tableName');
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
                           url: "<?php echo base_url('Dms/Subfolder/delete') ?>",
                           data:'id='+id+'&tableName='+tableName,
                            success: function(data){
                              $('#row_'+id).remove();
                              $('.doc_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
     
      function openSubFolder(folderId){
          let subFolderId = '<?php echo $folderId; ?>';
          window.location.href = '<?php echo base_url('/Dms/Uploaddocs/docsList/'); ?>' + folderId+'/'+subFolderId;
        }        
      function switchUI(){
            $('.switchUIclass').toggleClass('d-none');
            $('.switchUIBtns').toggleClass('d-none');
        } 
        
    function uploadDoc(folderId){
          $("#folderId").val(folderId);
          $("#flipUploadModal").modal('show');
        }
    
    var myDropzone = new Dropzone(".dropzone", {
        maxFilesize: 5, // MB
    acceptedFiles: 'image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        dictDefaultMessage: 'Drop your files here or click to upload',
         success: function(file, response){
             
             console.log(response);
                location.reload();
            }
       });
       
      $('#folderListDatatable,#documentsListDatatable').DataTable({
                 lengthChange: false,
                 ordering: false,
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        
        function showEditModal(folderName,folder_id,id,roleIds){
           let selectedroleIds = roleIds.split(',');
            $("#edited_input_subfolder_name").val(folderName);
           $("#edited_folder_id").val(folder_id);
            $("#folderIdToUpdate").val(id)
            $("#edit_role_id").val(selectedroleIds)
            $(".js-example-basic-single").select2();
           $("#flipEditModal").modal('show');
        }
        function addSubFolder(){
            
            let subfolderName = $("#input_subfolder_name").val();
            let folder_id = $("#folder_id").val()
            let role_ids = $("#role_id").val()
            if(subfolderName == ''){
               $(".folderNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
           
            $.ajax({
                 type: "POST",
                 url: "<?php echo base_url('Dms/Subfolder/add') ?>",
                 data:'subfolder_name='+subfolderName+'&folder_id='+folder_id+'&role_ids='+role_ids,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updateFolder(){
            let subfolderName = $("#edited_input_subfolder_name").val();
           
           let folderId = $("#edited_folder_id").val();
           let role_ids = $("#edit_role_id").val()
           console.log("folderId",folderId)
            let id = $("#folderIdToUpdate").val()
            if(subfolderName == ''){
               $(".folderNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "<?php echo base_url('Dms/Subfolder/updateFolder') ?>",
                 data:'subfolder_name='+subfolderName+'&id='+id+'&folder_id='+folderId+'&role_ids='+role_ids,
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
        url: "<?php echo base_url('Dms/Subfolder/change_status') ?>",
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
                url: "<?php echo base_url('Dms/Folder/updateSortOrder') ?>",
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
 