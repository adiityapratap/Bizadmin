 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="col-12">
               <div class="alert alert-success fade show" role="alert" style="display:none">
                   Area Added Succesfully
                    </div>
                    </div>
                      

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black ">Area</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#flipModal"> <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Area </button>
                                                <button type="button" class="btn btn-primary" id="editModal" data-bs-toggle="modal" data-bs-target="#flipEditModal" style="display:none"></button>
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="siteList">
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="prepListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="prep_name">Area Name</th>
                                                           
                                                            <th class="sort" data-sort="status">Status</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all" id="sortable">
                                                        <?php if(!empty($prepLists)) {  ?>
                                                        <?php foreach($prepLists as $prep){   ?>
                                                        <tr id="row_<?php echo  $prep['id']; ?>" >
                                                            <td class="customer_name"><?php echo $prep['name']; ?></td>
                                                            

                                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $prep['id']; ?>" <?php if(isset($prep['status']) && $prep['status']  == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            
                                                            <td>
                                                                
                                                         <ul class="list-inline hstack gap-2 mb-0">
                                                               
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Edit">
                                                                    <a onclick="showEditModal('<?php echo $prep['name']; ?>',<?php echo $prep['id']; ?>)"  class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        data-rel-id="<?php echo  $prep['id']; ?>">
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Area </h5>
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
                                                               
                                                                    <label for="name-field" class="form-label">Area Name</label>
                                                                    <input type="text"  name="input_prep_name" id="input_prep_name" class="form-control" placeholder="Enter prep area name" required="">
                                                                <div class="invalid-feedback prepNameError" style="display:none">
                                                                    Please enter  area name
                                                                    </div>
                                                                </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="addPrep()">Add </button>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Area</h5>
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
                                                                    <label for="name-field" class="form-label">Area Name</label>
                                                                    <input type="hidden" id="prepIdToUpdate" value="">
                                                                    <input type="text" id="edited_input_prep_name" class="form-control" placeholder="Enter prep area name" required="">
                                                                <div class="invalid-feedback prepNameError" style="display:none">
                                                                    Please enter area name
                                                                    </div>
                                                                </div>
                                                                
                                            
                                        
                                        
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="updatePrep()">Save </button>
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
                            url: "/Shifts/prep/delete",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
      $('#prepListDatatable').DataTable({
                 lengthChange: false,
                 ordering: false,
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        
        function showEditModal(prepName,prepId){
           
            $("#edited_input_prep_name").val(prepName);
            
            $("#prepIdToUpdate").val(prepId)
           $("#flipEditModal").modal('show');
        }
        function addPrep(){
            
            let prepName = $("#input_prep_name").val();
            
            if(prepName == ''){
               $(".prepNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
        
            $.ajax({
                 type: "POST",
                 url: "/Shifts/prep/add",
                 data:'prep_name='+prepName,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updatePrep(){
            let prepName = $("#edited_input_prep_name").val();
            
            console.log("edited_input_prep_name",edited_input_prep_name)
            let id = $("#prepIdToUpdate").val()
            if(prepName == ''){
               $(".prepNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "/Shifts/prep/updatePrep",
                 data:'prep_name='+prepName+'&id='+id,
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
        url: "/Shifts/prep/change_status",
        data: {"status":status,"id":id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })   
    

        </script>
 