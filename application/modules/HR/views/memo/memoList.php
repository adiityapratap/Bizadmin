<div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="email-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                        <div class="email-menu-sidebar">
                            <div class="p-4 d-flex flex-column h-100">
                                <div class="pb-4 border-bottom border-bottom-dashed">
                                    <button type="button" class="btn bg-orange w-100" data-bs-toggle="modal" data-bs-target="#composemodal"><i data-feather="plus-circle" class="icon-xs me-1 icon-dual-light"></i> New Memo</button>
                                </div>
                                <div class="mx-n4 px-4 email-menu-sidebar-scroll" data-simplebar>
                                    <div class="mail-list mt-3">
                                        <a href="#"><i class="ri-inbox-archive-fill me-3 align-middle fw-medium"></i> <span class="mail-list-link">Inbox</span> <span class="badge bg-success-subtle text-success ms-auto  ">5</span></a>
                                        <a href="#"><i class="ri-send-plane-2-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Sent</span></a>
                                         <a href="#"><i class="ri-delete-bin-5-fill me-3 align-middle fw-medium"></i><span class="mail-list-link">Trash</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end email-menu-sidebar -->

                        <div class="email-content">
                            <div class="p-4 pb-0">
                                <div class="border-bottom border-bottom-dashed">
                                    <div class="row mt-n2 mb-3 mb-sm-0">
                                        <div class="col col-sm-auto order-1 d-block d-lg-none">
                                            <button type="button" class="btn btn-soft-success btn-icon btn-sm fs-16 email-menu-btn">
                                                <i class="ri-menu-2-fill align-bottom"></i>
                                            </button>
                                        </div>
                                        <div class="col-sm order-3 order-sm-2">
                                            <div class="hstack gap-sm-1 align-items-center flex-wrap email-topbar-link">
                                                <div class="form-check fs-14 m-0">
                                                    <input class="form-check-input" type="checkbox" value="" id="checkall">
                                                    <label class="form-check-label" for="checkall"></label>
                                                </div>
                                                <div id="email-topbar-actions">
                                                    <div class="hstack gap-sm-1 align-items-center flex-wrap">
                                                        
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Trash">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm shadow-none fs-16" data-bs-toggle="modal" data-bs-target="#removeItemModal">
                                                                <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vr align-self-center mx-2"></div>
                                              
                                                
                                                </div>
                                                <div class="alert alert-warning alert-dismissible unreadConversations-alert px-4 fade show " id="unreadConversations" role="alert">
                                                    No Unread Conversations
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="row align-items-end mt-3">
                                        <div class="col">
                                            <div id="mail-filter-navlist">
                                                <ul class="nav nav-tabs nav-tabs-custom gap-1 text-center border-bottom-0" role="tablist">
                                                    <li class="nav-item">
                                                        <button class="nav-link fw-semibold active" id="pills-primary-tab" data-bs-toggle="pill" data-bs-target="#pills-primary" type="button" role="tab" aria-controls="pills-primary" aria-selected="true">
                                                            <i class="ri-inbox-fill align-bottom d-inline-block"></i>
                                                            <span class="ms-1 d-none d-sm-inline-block">Memo List</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                      
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="pills-primary" role="tabpanel" aria-labelledby="pills-primary-tab">
                                        <div class="message-list-content mx-n4 px-4 message-list-scroll">
                                            <!--<div id="elmLoader">-->
                                            <!--    <div class="spinner-border text-primary avatar-sm" role="status">-->
                                            <!--        <span class="visually-hidden">Loading...</span>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                          <ul class="message-list" id="mail-list">
                                        
                                          
                                          </ul>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        
                        <div class="email-detail-content">
                            <div class="p-4 d-flex flex-column h-100">
                                <div class="pb-4 border-bottom border-bottom-dashed">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="">
                                                <button type="button" class="btn btn-soft-danger btn-icon btn-sm fs-16 close-btn-email shadow-none id="close-btn-email"">
                                                    <i class="ri-close-fill align-bottom"></i>
                                                </button>
                                            </div>
                                        </div>
                                         <div class="col">
                                         <h3 class="text-black">Memo Details</h3>    
                                         </div>    
                                        <div class="col-auto">
                                            <div class="hstack gap-sm-1 align-items-center flex-wrap email-topbar-link">
                                              
                                               
                                                <button class="btn btn-ghost-secondary btn-icon btn-sm shadow-none fs-16 remove-mail" data-remove-id=""  data-bs-toggle="modal" data-bs-target="#removeItemModal">
                                                    <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                </button>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mx-n4 px-4 email-detail-content-scroll" data-simplebar>
                                    <div class="mt-4 mb-3">
                                        <h5 class="fw-bold email-subject-title text-black"></h5>
                                    </div>

                                    <div class="accordion accordion-flush">
                                         <div id="email-collapseThree" class="accordion-collapse collapse show">
                                                <div class="accordion-body memoBody text-body px-0">
                                                    
                                                </div>
                                            </div>
                                        

                                    
                                    </div>
                                    <!-- end accordion -->
                                </div>
                                <div class="mt-auto">
                                    <form class="mt-2 memoCommentsForm">
                                        <input type="hidden" class="selectedMemo" name="memo_id">
                                        <div>
                                            <label for="exampleFormControlTextarea1" class="form-label">Comments :</label>
                                            <textarea class="form-control border-bottom-0 rounded-top rounded-0 border" name="memoComments" id="exampleFormControlTextarea1" rows="3" placeholder="Enter message"></textarea>
                                            <div class="bg-light px-2 py-1 rouned-bottom border">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="btn-group" role="group">
                                                            <!--<button type="button" class="btn btn-sm py-0 fs-15 btn-light shadow-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Bold"><i class="ri-bold align-bottom"></i></button>-->
                                                            <!--<button type="button" class="btn btn-sm py-0 fs-15 btn-light shadow-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Italic"><i class="ri-italic align-bottom"></i></button>-->
                                                            <!--<button type="button" class="btn btn-sm py-0 fs-15 btn-light shadow-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Link"><i class="ri-link align-bottom"></i></button>-->
                                                            <!--<button type="button" class="btn btn-sm py-0 fs-15 btn-light shadow-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Image"><i class="ri-image-2-line align-bottom"></i></button>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-success shadow-none" onclick="addMemoComments(this)"><i class="ri-send-plane-2-fill align-bottom"></i> Reply </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>    
                        </div>
                      
                    </div>
                    <!-- end email wrapper -->

                 
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

          
        </div>

    <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="composemodalTitle">New Memo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="newMemo">
                     <div class="mb-3">   
                     <div class="form-check form-check-success mb-3">
                     <input class="form-check-input" type="checkbox" id="sendToAllEmp" name="sendToAllEmp">
                      <label class="form-check-label" for="sendToAllEmp">Send to all employees</label>
                     </div> 
                     </div>
                     <div class="mb-3 selectedMemo">
                     <label for="choices-multiple-remove-button" class="form-label text-black">Employees</label>
                     <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem  multiple>
                     <?php if(isset($empLists) && !empty($empLists)) {  ?>
                     <?php foreach($empLists as $empList) {  ?>
                     <option value="<?php echo $empList['emp_id'] ?>"><?php echo $empList['first_name'].' '.$empList['last_name'] ?></option>
                     <?php } ?>
                     <?php } ?>
                    </select>
                    </div>
                    
                    <div class="mb-3 selectedMemo">
                     <label for="choices-multiple-remove-button" class="form-label text-black">Positions</label>
                     <select class="form-control" name="position_ids[]" id="choices-multiple-remove-button-pids" data-choices data-choices-removeItem  multiple>
                     <?php if(isset($positionLists) && !empty($positionLists)) {  ?>
                     <?php foreach($positionLists as $positionList) {  ?>
                     <option value="<?php echo $positionList['position_id'] ?>"><?php echo $positionList['position_name']; ?></option>
                     <?php } ?>
                     <?php } ?>
                    </select>
                    </div>
                                            

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>
                        <div class="ck-editor-reverse">
                            <div id="email-editor"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="ri-delete-back-2-fill"></i> Discard</button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-success sendMemoBtn"><i class="ri-send-plane-fill"></i> Send</button>
                       
                        <!--<ul class="dropdown-menu dropdown-menu-end">-->
                        <!--    <li><a class="dropdown-item" href="#"><i class="ri-timer-line text-muted me-1 align-bottom"></i> Schedule Send</a></li>-->
                        <!--</ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-14 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-black mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    
    <!-- mailbox init -->
    <script src="/theme-assets/js/pages/mailbox.init.js"></script>
<script>
 
  
let editor;

ClassicEditor
    .create( document.querySelector( '#email-editor' ) )
    .then( newEditor => {
        editor = newEditor;
         editor.ui.view.editable.element.style.height = '200px';
    } )
    .catch( error => {
        console.error( error );
    });
    
    $(".sendMemoBtn").on("click",function(){
     if($("#sendToAllEmp").is(':checked')){
      $('#choices-multiple-remove-button').val('');
      $('#choices-multiple-remove-button-pids').val(''); 
     }    
     const editorData = editor.getData();
     const selectedValues = $('#choices-multiple-remove-button').val();
     $button = $(this);
     $button.html('Sending...');
      let formData = new FormData($(".newMemo")[0]);
      formData.append('editorData', editorData);
      formData.append('emp_ids[]', selectedValues);
      $.ajax({
       url: '/HR/memo/sendMemo',
       method: 'post',
       data: formData,
       contentType: false,
       processData: false,
       success: function() {
       console.log("AJAX request successful");
       $button.html('Memo Sent');
       },
       error: function(xhr, status, error) {
       console.error('Error:', error);
       }
       });
     
      setTimeout(function() {
        $(".sendMemoBtn").html('Send');
        $("#composemodal").modal('hide');
    }, 2000);
    })


 
   
   $(document).ready(function() {
    $('#delete-record').on('click', function() {
        let valuesArray = [];
        $('.form-check-input').each(function() {
            if ($(this).is(':checked')) {
                valuesArray.push($(this).val());
            }
        });
      console.log("valuesArray",valuesArray)
        $.ajax({
            url: '/HR/memo/deleteMemo',
            type: 'POST',
            data: { values: valuesArray },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

   $('#sendToAllEmp').change(function() {
    if ($(this).is(':checked')) {
     $(".selectedMemo").addClass("d-none");
    } else {
     $(".selectedMemo").removeClass("d-none");
    }
});  

   function addMemoComments(obj){
       let formData = new FormData($(".memoCommentsForm")[0]);
       let btnHtml = $(obj);
       btnHtml.html('<i class="ri-send-plane-2-fill align-bottom"></i> Sending...');
      $.ajax({
            url: '/HR/memo/addMemoComments',
            type: 'POST',
             processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting content type
            data: formData,
            success: function(response) {
                console.log(response);
                btnHtml.html('<i class="ri-send-plane-2-fill align-bottom"></i> Reply');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        }); 
       
   }


     
    


  
</script>