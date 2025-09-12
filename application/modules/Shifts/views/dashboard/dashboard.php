<div class="container-fluid mb-5" style="margin-top: 130px !important;">
    <div class="row">
        <div class="col-12 tempDiv">
            <?php 
$btnClasses = ['btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-dark'];
foreach ($shiftLists as $i => $shift): 
    $btnClass = $btnClasses[$i % count($btnClasses)];
?>
    <button class="btn btn-sm mb-2 shift-btn <?= $btnClass ?>"
            data-shift-id="shift_<?= $shift['id'] ?>"  
            data-shift-name="<?= htmlspecialchars($shift['name']) ?>">
        <?= htmlspecialchars($shift['name']) ?>
    </button>
<?php endforeach; ?>


            <?php foreach ($groupedTasks as $shiftId => $prepGroups): ?>
                <div class="card shift-block" id="shift_<?= $shiftId ?>" style="<?= ($shiftId == $shiftLists[0]['id']) ? '' : 'display: none;' ?>">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title shiftCardTitle mb-0 flex-grow-1 text-black">📋 Tasks - <?= date('d-m-Y') ?> <span class="shiftidTag"></span></h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="text-muted">
                                        <th>Prep</th>
                                        <th>Task Name</th>
                                        <th>Record by</th>
                                        <th>Record at</th>
                                        <th>Entered by</th>
                                        <th>Comments</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($prepGroups as $prepId => $tasks): ?>
                                    <th colspan="11" class="text-black w-100 " style="background-color: #dff0fa;"> <b><?= htmlspecialchars($tasks[0]->name ?? 'Prep ' . $prepId) ?></b></th>
                                     
                                        <?php foreach ($tasks as $task): ?>
                                            <tr>
                                                <td></td>
                                                <td><?= htmlspecialchars($task->task_name) ?></td>
                                                <td><input type="text" readonly class="form-control form-control-sm" name="record_by_<?= $task->id ?>" value="<?php echo $task->task_time ?? '' ?>"></td>
                                                <td><input type="text" readonly class="form-control form-control-sm capturedTime_<?= $task->id ?>" name="record_at_<?= $task->id ?>"></td>
                                                <td><input type="text" class="form-control form-control-sm" name="entered_by_<?= $task->id ?>" value="<?php echo $todaysEnteredData[$task->id]['entered_by'] ?? '' ?>"></td>
                                                <td>
                                                <input type="hidden" class=" prepId_<?= $task->id ?>" value="<?php echo $prepId; ?>">
                                                <input type="text" class="form-control form-control-sm" name="comments_<?= $task->id ?>" value="<?php echo $todaysEnteredData[$task->id]['comments'] ?? '' ?>">
                                                </td>
                                                <td>
                  <?php if(isset($todaysEnteredData[$task->id]['is_completed']) && $todaysEnteredData[$task->id]['is_completed'] == 1){ ?>
                  <button name="complete" class="btn btn-sm btn-success" readonly>⏰ <?php echo 'Completed'; ?></button>
                  <?php  }else { ?>
                 <button name="save" class="btn btn-sm btn-secondary" onclick="completeThisRow(this,<?php echo $task->id; ?>,'save')">⏰ <?php echo 'Save'; ?></button> 
                 <button name="complete" class="btn btn-sm btn-orange" onclick="completeThisRow(this,<?php echo $task->id; ?>,'complete')">⏰ Complete</button>
                   <?php  } ?> 
                  </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

                                         
          <div id="attachmentComplianceModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                               <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Attachments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                         </div>
                      <div class="modal-body appendAttachment">
                       <div class="card">
                          <div class="card-body">
                                        <div class="swiper pagination-progress-swiper rounded">
                                            <div class="swiper-wrapper appendSwiperImages">
                                                
                                            </div>
                                            <div class="swiper-button-next bg-white shadow"></div>
                                            <div class="swiper-button-prev bg-white shadow"></div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div><!-- end card-body -->
                            </div><!-- end card --> 
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
                            </div>
<script>
    document.querySelectorAll('.shift-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const shiftId = this.getAttribute('data-shift-id');
            const shiftName = this.getAttribute('data-shift-name');
            console.log("shiftName",$(".shiftidTag"));
            $(".shift-btn").removeClass("active");
            $(this).addClass("active");
           
            $(".shiftidTag").html("( "+shiftName+" ) ");

            // Toggle button style
            document.querySelectorAll('.shift-btn').forEach(b => b.classList.remove('btn-danger'));
            this.classList.add('btn-danger');

            // Hide all blocks, show selected
            document.querySelectorAll('.shift-block').forEach(block => block.style.display = 'none');
            const selectedBlock = document.getElementById(shiftId);
            if (selectedBlock) selectedBlock.style.display = 'block';
        });
    });
</script>

                            
<script>
function completeThisRow(obj, taskId, type) {
    let currentTime = getCurrentTime();
    let enteredBy = $('[name="entered_by_' + taskId + '"]').val();

    if (enteredBy === '') {
        alert("Please enter your name in the Entered By field to complete.");
        return false;
    }

    $(obj).html('Saving...');

    $(".capturedTime_" + taskId).html(currentTime);

    let data = [
        {
            task_id: taskId,
            is_completed: type === 'save' ? 0 : 1,
            entered_time: currentTime,
            prep_id: $(".prepId_" + taskId).val(),
            entered_by: enteredBy,
            comments: $('[name="comments_' + taskId + '"]').val()
        }
    ];

    $('[name="entered_by_' + taskId + '"], [name="complete_' + taskId + '"]').prop('disabled', true);
    $('[name="complete_' + taskId + '"]').html('Completed');
    $('[name="complete_' + taskId + '"]').removeClass('btn-orange').addClass('btn-success');

    let formData = JSON.stringify(data);

    $.ajax({
        type: 'POST',
        url: 'home/saveDashboardData',
        data: formData,
        contentType: 'application/json',
        success: function (response) {
            $(".successRecorded").removeClass("d-none");

            if (type === 'save') {
                $(obj).html('⏰ Saved');
            } else {
                $(obj).html('⏰ Completed');
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}


function showAttchmentModal(id){
 $("#task_id").val(id);
 $("#tempAttachmentModal").modal('show');
}



$(document).ready(function(){
   
  
  $(".uploadAttachmentButton").on("click", function () {
        var formData = new FormData($("#attachmentUploadForm")[0]);
        $(".uploadAttachmentButton").html("Loading...");
        // Debugging: Output FormData object to console
        console.log(formData);

        $.ajax({
            type: "POST",
            url: "/Compliance/home/uploadTemperatureAttachment", // Replace with your controller's URL
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#tempAttachmentModal").modal('hide');
                $(".uploadAttachmentButton").html("Save");
               let className = 'attchmentN_' + $("#task_id").val();
               $('.' + className).removeClass(className);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
    

 let selectedSite = localStorage.getItem('selectedSiteCleanDashBoard');
   
    if(selectedSite =='' || selectedSite == undefined){
      selectedSite = $(".siteDropdown").val();   
    }
    $(".siteDropdown").val(selectedSite);
   
    $(".tbodySite").addClass('d-none');
    $(".siteId_"+selectedSite).removeClass('d-none');
     $(".siteDropdown").on('change',function(){
      let selectedSite = $(this).val();  
      localStorage.setItem('selectedSiteCleanDashBoard',selectedSite);
      $(".tbodySite").addClass('d-none');
      $(".siteId_"+selectedSite).removeClass('d-none');
    });   
    
})

 function fetchAttachment(taskId){
     let orzName =  "<?php echo $this->session->userdata('tenantIdentifier'); ?>"
       $.ajax({
            type: "POST",
            url: "/Compliance/home/fetchAttachmentUploadedToday", 
            data: 'task_id='+taskId,
            success: function (response) {
                let result= JSON.parse(response);
                console.log(result)
           result.forEach(function (filename) {
           let imageUrl = "/uploaded_files/"+orzName+"/Compliance/ComplianceAttachments/" + filename;
           let slide = '<div class="swiper-slide">' +
                    '<img src="' + imageUrl + '" alt="" class="img-fluid" style="width: 100%;" />' +
                    '</div>';
            console.log("slide",slide)        
             $('.appendSwiperImages').append(slide);
           });
          },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
         $("#attachmentComplianceModal").modal('show');
    
}


</script>