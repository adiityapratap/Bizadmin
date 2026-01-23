 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="col-12">
               <div class="alert alert-success fade show" role="alert" style="display:none">
                  Tll Added Succesfully
                    </div>
                    </div>
                      

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">Manage Register</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#flipModal"> <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Register</button>
                                                <button type="button" class="btn btn-primary" id="editModal" data-bs-toggle="modal" data-bs-target="#flipEditModal" style="display:none"></button>
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="tillList">
                                           
                                            
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="tillListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            
                                                            <th class="sort" data-sort="customer_name">Register Name</th>
                                                            <th class="sort" data-sort="status">Status</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php if(!empty($till_detail)) {  ?>
                                                        <?php foreach($till_detail as $till){  ?>
                                                        <tr id="row_<?php echo  $till['id']; ?>" >
                                                            <td class="customer_name"><?php echo $till['till_name']; ?></td>
                                                            
                                                            
                                                            
                                                            <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $till['id']; ?>" <?php if(isset($till['status']) && $till['status']  == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            
                                            
                                                           
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <a  onclick="showEditModal('<?php echo $till['till_name']; ?>',<?php echo $till['id']; ?>)" class="btn btn-sm btn-secondary edit-item-btn">
                                                                            <i class="ri-edit-box-line label-icon align-middle fs-12 me-2"></i>Edit</a>
                                                                    </div>
                                                                    <div class="remove">
                                                                        <button class="btn btn-sm btn-danger remove-item-btn "  data-rel-id="<?php echo  $till['id']; ?>">
                                                                             <i class="ri-delete-bin-line label-icon align-middle fs-12 me-2"></i>Remove</button>
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
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

               
            </div>
 
        

        <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Register </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                             
                                                                <div>
                                                                    <label for="name-field" class="form-label">Register Name</label>
                                                                    <input type="text"  name="input_till_name" id="input_till_name" class="form-control" placeholder="Enter till name" required="">
                                                                <div class="invalid-feedback tillNameError" style="display:none">
                                                                    Please enter register name
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonTill" onclick="addTill()">Add </button>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Register</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                
                                                                <div>
                                                                    <label for="name-field" class="form-label">Register Name</label>
                                                                    <input type="hidden" id="tillIdToUpdate" value="">
                                                                    <input type="text" id="edited_input_till_name" class="form-control" placeholder="Enter till name" required="">
                                                                <div class="invalid-feedback tillNameError" style="display:none">
                                                                    Please enter register name
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonTill" onclick="updateTill()">Save </button>
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
                            url: "Tills/delete",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
      $('#tillListDatatable').DataTable({
                pageLength: 100,
                bPaginate: false,
                bInfo : false,
                lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
        });
        
        function showEditModal(tillName,tillId){
            $("#edited_input_till_name").val(tillName);
            $("#tillIdToUpdate").val(tillId)
           $("#flipEditModal").modal('show');
        }
        function addTill(){
            let tillName = $("#input_till_name").val()
            if(tillName == ''){
               $(".tillNameError").show();
               return false;
            }else{
                $(".submitButtonTill").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "Tills/add",
                 data:'till_name='+tillName,
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updateTill(){
            let tillName = $("#edited_input_till_name").val();
            console.log("edited_input_till_name",edited_input_till_name)
            let id = $("#tillIdToUpdate").val()
            if(tillName == ''){
               $(".tillNameError").show();
               return false;
            }else{
                $(".submitButtonTill").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "Tills/updateTill",
                 data:'till_name='+tillName+'&id='+id,
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
         let till_id = $(this).attr('id');
        
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
        url: "Tills/change_status",
        data: {"status":status,"till_id":till_id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })   
        </script>
 