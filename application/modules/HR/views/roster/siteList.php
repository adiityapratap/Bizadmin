 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="col-12">
               <div class="alert alert-success fade show" role="alert" style="display:none">
                  Site Added Succesfully
                    </div>
                    </div>
           <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">Manage Sites</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#flipModal"> <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Site</button>
                                                <button type="button" class="btn btn-primary" id="editModal" data-bs-toggle="modal" data-bs-target="#flipEditModal" style="display:none"></button>
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="siteList">
                                           
                                            
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="siteListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            
                                                            <th class="sort" data-sort="customer_name">Site Name</th>
                                                            <th class="sort" data-sort="status">Status</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php if(!empty($site_detail)) {  ?>
                                                        <?php foreach($site_detail as $site){  ?>
                                                        <tr id="row_<?php echo  $site['id']; ?>" >
                                                            <td class="customer_name"><?php echo $site['site_name']; ?></td>
                                                            <td>
                                                            <div class="form-check form-switch form-switch-custom form-switch-success">
                                                            <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $site['id']; ?>" <?php if(isset($site['status']) && $site['status']  == '1'){ echo 'checked'; }?>>
                                                            </div>
                                                            </td>
                                                            
                                                            
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <a  onclick="showEditModal('<?php echo $site['site_name']; ?>',<?php echo $site['site_id']; ?>,<?php echo $site['id']; ?>)" class="text-primary d-inline-block edit-item-btn">
                                                                            <i class="ri-pencil-fill fs-16"></i></a>
                                                                    </div>
                                                                    <div class="remove">
                                                                        <a class="text-danger remove-item-btn"  data-rel-id="<?php echo  $site['id']; ?>">
                                                                              <i class="ri-delete-bin-5-fill fs-16"></i></a>
                                                                    </div>
                                                                </div>
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
       
                </div>
        </div>
 
        

        <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Site </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form siteAdd" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                             
                                                                <div>
                                                                    <label for="name-field" class="form-label">Site Name</label>
                                                                    <input type="text"  name="site_name" id="input_site_name" class="form-control" placeholder="Enter site name" required="">
                                                                <div class="invalid-feedback siteNameError" style="display:none">
                                                                    Please enter site name
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="addSite()">Add </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div><!-- /.modal -->
        <div id="flipEditModal" class="modal fade flip"  role="dialog">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Site</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form updateSite" autocomplete="off">
                                                    <div class="modal-body">
                                                    
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                
                                                                <div>
                                                                    <label for="name-field" class="form-label">Site Name</label>
                                                                    <input type="hidden" id="siteIdToUpdate" value="" name="id">
                                                                    <input type="text" id="edited_input_site_name" name="site_name" class="form-control" placeholder="Enter site name" required="">
                                                                <div class="invalid-feedback siteNameError" style="display:none">
                                                                    Please enter site name
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonSite" onclick="updateSite()">Save </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div><!-- /.modal -->

     
      
       
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
                            url: "/HR/Site/delete",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
      $('#siteListDatatable').DataTable({
                pageLength: 100,
                bPaginate: false,
                bInfo : false,
                lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        
        function showEditModal(site_name,siteId){
            $("#edited_input_site_name").val(site_name);
            $("#siteIdToUpdate").val(siteId)
           $("#flipEditModal").modal('show');
        }
        function addSite(){
            let siteName = $("#input_site_name").val()
            if(siteName == ''){
               $(".siteNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
           let formData = $(".siteAdd").serialize();
            $.ajax({
                 type: "POST",
                 url: "/HR/site/add",
                 data:formData,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updateSite(){
            let siteName = $("#edited_input_site_name").val();
           
            let id = $("#siteIdToUpdate").val()
            if(siteName == ''){
               $(".siteNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            let formData = $(".updateSite").serialize();
            $.ajax({
                 type: "POST",
                 url: "/HR/site/edit",
                 data:formData,
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
         let site_id = $(this).attr('id');
        
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
        url: "/HR/Site/change_status",
        data: {"status":status,"id":site_id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })   
        </script>
 