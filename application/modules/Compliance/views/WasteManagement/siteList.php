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
                                    <h4 class="mb-sm-0 text-black">Waste Management Site</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                                <a href="<?php echo  base_url('Compliance/Waste/site/add') ?>" class="btn btn-primary"> <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Site</a>
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
                                                             <th class="sort" data-sort="customer_name">Email Notify</th>
                                                            <th class="sort" data-sort="status">Status</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php if(!empty($site_detail)) {  ?>
                                                        <?php foreach($site_detail as $site){   ?>
                                                        <tr id="row_<?php echo  $site['id']; ?>" >
                                                            <td class="site_name"><?php echo $site['site_name']; ?></td>
                                                           <td class="emailNotify"><?php echo (isset($site['emailNotify']) && $site['emailNotify'] == 1 ? 'Yes' : 'No'); ?></td>
                                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                       <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $site['id']; ?>" <?php if(isset($site['status']) && $site['status']  == '1'){ echo 'checked'; }?>>
                                                       </div>
                                                    </td>
                                            
                                            
                                                           
                                                            <td>
                                                       <ul class="list-inline hstack gap-2 mb-0">
                                                               
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Edit">
                                                                    <a href="<?php echo base_url('Compliance/Waste/site/edit/'.$site['id']); ?>"  class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Remove">
                                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                                                        data-rel-id="<?php echo  $site['id']; ?>">
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
                            url: "Site/delete",
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
        
        function showEditModal(siteName,siteId){
            $("#edited_input_site_name").val(siteName);
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
            $.ajax({
                 type: "POST",
                 url: "Site/add",
                 url: "/Compliance/Waste/Site/add",
                 data:'site_name='+siteName,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updatesite(){
            let siteName = $("#edited_input_site_name").val();
            console.log("edited_input_site_name",edited_input_site_name)
            let id = $("#siteIdToUpdate").val()
            if(siteName == ''){
               $(".siteNameError").show();
               return false;
            }else{
                $(".submitButtonSite").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "/Compliance/Waste/Site/updatesite",
                 data:'site_name='+siteName+'&id='+id,
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
        url: "/Compliance/Waste/Site/change_status",
        data: {"status":status,"id":id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })   
        </script>
 