 <link rel="stylesheet" href="/assets/libs/dropzone/dropzone.css" type="text/css" />
    <script src="/assets/libs/dropzone/dropzone-min.js"></script>
 <script src="/assets/js/pages/form-file-upload.init.js"></script>


 <div id="fileUploadModal" class="modal fade modal-lg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Upload Bank Receipt </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form id="attachmentUploadForm" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <label> Select multiple images and upload</label>
                                                     <div class="file-input-container">
                                                             <input type="file" id="userfile" name="userfile[]" class="form-control-file" multiple>
                                                        </div>
                                                        
                                                        </div>
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success uploadAttachmentButton">Save</button>
                                                        </div>

                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                            
                                            
   <script>
   
    $(".uploadAttachmentButton").on("click", function () {
        var formData = new FormData($("#attachmentUploadForm")[0]);
        $(".uploadAttachmentButton").html("Uploading...");
        // Debugging: Output FormData object to console
        console.log(formData);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('Cash/uploadBankReceipt'); ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#fileUploadModal").modal('hide');
                showMessage(response);
                $(".uploadAttachmentButton").html("Upload");
            },
            error: function (xhr, status, error) {
                console.error(error);
                showMessage("File upload failed");
            }
        });
    });
  
      function showMessage(message) {
        var uploadMessage = $("#uploadMessage");
        uploadMessage.text(message);
        uploadMessage.fadeIn();

        setTimeout(function() {
          uploadMessage.fadeOut();
        }, 3000);
      }
   </script>


