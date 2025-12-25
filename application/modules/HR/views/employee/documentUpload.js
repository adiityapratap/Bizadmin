$(document).ready(function(){

        $('#save_continue_documents').click(function(){
            let formData = new FormData($('#documentDetailsForm')[0]);
            $('#loaderContainer').show();
            // Check if files are selected
            let files = formData.getAll('userfile[]');
            if (files.length === 0) {
                $('#result').html('<p>Please select at least one file.</p>');
                return;
            }

            // Check if file names are empty
            let fileNames = $('[name="file_name[]"]');
            let hasEmptyFileName = false;
            fileNames.each(function() {
                if ($(this).val() === '') {
                    hasEmptyFileName = true;
                    return false; // exit loop early if found an empty file name
                }
            });

            if (hasEmptyFileName) {
                $('#result').html('<p>Please provide a name for each file.</p>');
                return;
            }
           
            // Show progress bar
            $('#progress').show();
            $('#save_continue_documents').val("Saving...");
            $.ajax({
                url: '/HR/contractors/submitContractorDocs',
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            $('#progress_bar').css('width', percent + '%');
                        }, true);
                    }
                    return xhr;
                },
                success: function(response){
                    $('#loaderContainer').hide();
                    if(response.error){
                        $('#result').html('<p>Error: ' + response.error + '</p>');
                    } else {
                        
                      alert("Contractor created successfully");
        window.location.href = "https://bizadmin.com.au/HR/employees";
                        
                        // $('#result').html('<p>Files uploaded successfully.</p>');
                    }
                    // Hide progress bar
                    $('#progress').hide();
                    $('#save_continue_documents').val("SAVE");
                },
                error: function(xhr, status, error){
                    $('#result').html('<p>Error: ' + error + '</p>');
                    // Hide progress bar
                    $('#progress').hide();
                }
            });
        });
    });