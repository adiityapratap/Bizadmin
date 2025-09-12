<style>
  .square-box {
    background-color: lightgray; 
    text-align: center; 
    vertical-align: middle;
    width: 100px; 
    height: 100px;
  }
  .dropdown-menu .btn .glyphicon{
      color:black !important;
  }
  

</style>

 <div class="main-content">
     
  <?php 
  if(isset($weekRange) && $weekRange !=''){
   $date_text =  $weekRange;  
  }else { 
   $monday = new DateTime('monday this week'); 
   $date_text = $monday->format('d M') . ' - ' . $monday->modify('+6 days')->format('d M');
   }
   ?>
  <?php
  if(isset($rosterInfo[0]['start_date']) && $rosterInfo[0]['start_date'] !=''){ 
  $sdate = $rosterInfo[0]['start_date'];     $endDate = $rosterInfo[0]['end_date'];

  $startDateTime = new DateTime($sdate); $endDateTime = new DateTime($endDate);
  $startFormatted = $startDateTime->format('jS F'); $endFormatted = $endDateTime->format('jS F');
  $date_text = "$startFormatted - $endFormatted";
  }else if(isset($rosterStartDate) && $rosterStartDate !=''){
   $sdate = $rosterStartDate;
  }else{
  $cdate = date('Y-m-d'); 
  $timestamp = strtotime($cdate);
  $dayOfWeek = date("N", $timestamp);
  $daysToMonday = $dayOfWeek - 1;
  $sdate = date("Y-m-d", strtotime("-$daysToMonday days", $timestamp));
  }
  
  ?>
            <div class="page-content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <!--Loader-->
                <div id="loader-overlayAjax">
  <div class="spinner-border text-light" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div> 

     
        <div class="row mb-4 mt-2 gap-3">
        <div class="col-md-2 col-sm-2 col-lg-1">
       <a  class="btn btn-orange btn-icon waves-effect waves-light shadow-none w-100" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i>  Back</a>
        </div> 
        <div class="col-md-3 col-lg-2 col-sm-4">
        <input type="text" name="rosterName" class="form-control" id="rosterName" placeholder="Roster Name" value="<?php echo $rosterInfo[0]['rosterName'] ?>">
         </div>
        <div class="col-md-4  col-sm-8 col-lg-3 d-flex gap-2">
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none prevWeek"><i class="ri-arrow-left-s-line fw-bold"></i></button>   
        <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek"><?php echo $date_text; ?></button>    
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none nextWeek"><i class="ri-arrow-right-s-line fw-bold"></i></button>   
        </div>
        <div class="col-md-4 col-sm-5 col-lg-2">
        <select class="form-select bg-primary-subtle fw-bold weekAreaAndTeam" style="color:#4b38b3">
        <option selected="" value="1">Week by Area</option>
         <option value="2">Week by Team Member</option>
         <option  value="3">Day by Team Member</option>
         </select>
        </div>
        
        <div class="col-md-2 col-lg-1">
       <button  data-bs-toggle="modal" onclick="showRosterRecreateModal(<?php echo $rosterId ?>)" class="btn btn-warning"><i class="ri-file-copy-fill fw-bold"></i>  Recreate</button>
        </div>
       
       <div class="col-md-2 col-sm-2 col-lg-1">
       <button type="button" class="btn btn-success" onclick="publishRoster('save')"><i class="ri-save-2-fill fw-bold"></i>  Save</button>
        </div>    
        <div class="col-md-2 col-sm-2 col-lg-1">
       <button type="button" class="btn btn-primary" onclick="publishRoster('publish')"><i class="ri-save-2-fill fw-bold"></i>  Publish</button>
        </div>
    </div>    
                   
                        
                            <div class="row">
                               <div class="col-xl-2 col-lg-2 col-sm-4 overflow-auto">
                                    <div class="card h-100 shadow-none">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0 text-black">Employees</h4>
                                        </div><!-- end card header -->

           <div class="card-body">
                <div class="mx-n3 h-100">
                  <div class="mb-3 px-3">
                 <input type="text" class="form-control filterEmployeeLeftPanel" placeholder="Search employee">
                     <a id="clearFilter" href="#"><small class="text-danger float-end">clear</small></a>
                     </div>
                    <?php if(isset($empLists) && !empty($empLists)) {  ?>
                    <?php  foreach($empLists as $empList) { ?>
<a  class="text-reset notification-item dropdown-item border-bottom border-light employee-div" data-employee-name="<?php echo $empList['name']; ?>" data-bs-toggle="collapse" href="#collapse<?php echo $empList['emp_id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $empList['emp_id'] ?>">
                   <div class="d-flex">
                    <div class="flex-shrink-0 avatar-xs me-3">
                    <span class="avatar-title bg-success-subtle text-info rounded-circle fs-16 shadow">
                    <i class="ri-user-follow-fill text-success"></i></span>
                    </div>
                    <div class="flex-grow-1 text-black dragSourceElement">
                    <h6 class="mb-1 fs-14 text-black"><?php echo $empList['name']; ?></h6>
                    <?php $positionDetail = array_filter($positionLists, function($value) use ($empList) {
                        return $value['position_id'] == $empList['position_id'];
                       });
                       $positionDetail = reset($positionDetail); ?>
                      <small><?php echo  $positionDetail['position_name'] ? $positionDetail['position_name'] : '';?></small>    
                       
                      
                    <input type="hidden" class="position_id" value="<?php echo $empList['position_id']; ?>">
                    <input type="hidden" class="empId" value="<?php echo $empList['emp_id']; ?>">
                    <input type="hidden" class="empName" value="<?php echo $empList['name']; ?>">
                    </div>
                    </div>
                    </a>
                   
                    <div class="collapse mx-3 bg-light-subtle fs-12 py-2" id="collapse<?php echo $empList['emp_id'] ?>">
                   
                    </div>
                    
                    <?php } }  ?>
             
             
                </div>
                </div>
                </div>
                </div>
                         <div class="col-xl-10 col-lg-10 col-sm-8">
                             <div class="card h-100 shadow-none">
                              <div class="card-body table-responsive">
                             
                             <table class="table table-bordered">
                        <?php  $currentMonday = date('Y-m-d', strtotime($sdate)); ?>
                        <?php  $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); ?>
                                       
                        <thead class="table-light">               
                        <?php foreach ($days as $day) { ?>               
                        <th><?php echo $day.' '.date('d-m', strtotime($currentMonday)); ?></th>
                        <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
                        <?php } ?> 
                        </thead>
                        
                        <tbody>
                        <?php if(isset($prepAreas) && !empty($prepAreas)) { ?>  
                        <?php foreach($prepAreas as $prepArea) { ?>
                        <?php  $currentMonday = date('Y-m-d', strtotime('monday this week')); ?>
                        <tr class="accordion-button accordion accordion-primary border-bottom" type="button" data-bs-toggle="collapse" data-bs-target="#prep_<?php echo $prepArea['id'] ?>" aria-expanded="true" aria-controls="<?php echo $prepArea['id'] ?>">
                        <th colspan="7" class="border-0"><?php echo $prepArea['prep_name']; ?></th></tr>
      
             <tr id="prep_<?php echo $prepArea['id'] ?>" class="accordion-collapse collapse show">
                            
        <?php foreach ($days as $day) { ?>  
        <?php
        $dayName = strtolower($day);
        if(isset($rosterData[0][$dayName])){
        $rosterDetails = json_decode($rosterData[0][$dayName]); 
        }
        
        ?>
        <td class="square-box addShiftForPrep h-100" data-shiftBoxName="<?php echo date('d', strtotime($currentMonday)).'_'.$prepArea['id']; ?>" data-date="<?php echo date('d-m-Y', strtotime($currentMonday)); ?>" data-prepArea="<?php echo $prepArea['prep_name']; ?>" data-prepAreaId="<?php echo $prepArea['id'] ?>">  
        <div class="allocatedEmpShift_<?php echo date('d', strtotime($currentMonday)).'_'.$prepArea['id']; ?> dragEmployeeBox">
        <?php
        // existing roster data saved data
    $dateNumber = date('d', strtotime($currentMonday)); 

   // Check if $rosterData is an array and has at least one element
   if (is_array($rosterData) && count($rosterData) > 0) {
    $empDatas = $rosterData[0];
    if (isset($empDatas[$dayName])) {
        $currentDayData = (array) json_decode($empDatas[$dayName]);
        $keyToFind = 'emp_' . $dateNumber . '_' . $prepArea['id'];
        
        if (is_array($currentDayData)) {
            $filteredData = array_filter(
                $currentDayData,
                function ($k) use ($keyToFind) {
                    return preg_match('/^' . preg_quote($keyToFind, '/') . '/', $k);
                },
                ARRAY_FILTER_USE_KEY
            );
            
        } else {
            $filteredData = [];
        }
    } else {
        $filteredData = [];
    }
} else {
    $filteredData = [];
}
if(isset($filteredData) && !empty($filteredData)){
    foreach($filteredData as $fd){  $rosterEmpData =  json_decode($fd);
    $storageKey = $keyToFind.'_'.$rosterEmpData->employeeId;
    ?>
     <i class="fas fa-times text-danger fw-bold mt-1 mx-4 float-end" style="cursor: pointer;" onclick="clearStorage('<?php echo $storageKey; ?>', event,this)"></i>
     <div class="border-1 bg-success-subtle rounded-2 mt-2" id="<?php echo $storageKey; ?>"><b class="pt-1 fs-12"><?php echo $rosterEmpData->selectedEmpName ?></b></br>
        <span class="fs-12"><i class="bx bx-stopwatch text-success fs-16"></i><?php echo $rosterEmpData->empShiftStartTime.' - '.$rosterEmpData->empShiftEndTime; ?></span>
    <?php if(isset($rosterEmpData->empBreakTime) && $rosterEmpData->empBreakTime !=''){ ?>
    </br><span class="pt-1 fs-12"><i class="bx bx-coffee text-danger fs-16"></i> Break : <?php echo $rosterEmpData->empBreakTime ?></span>
    <?php } ?>
        </div>
   <?php  } } ?>
  </div>
        <i class="ri-add-fill"></i>    
        </td> 
        <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
        <?php }  ?>
        </tr>
        <?php }  ?>
        <?php }  ?>
                        </tbody>    
                                 </table>
                                    
                                </div><!-- end col -->
                            </div>
                             </div><!-- end col -->
                            </div>
                            <!--end row-->

                            <div style='clear:both'></div>

                            <!-- Add New Shift MODAL -->
                            <div class="modal fade" id="addShift-modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0">
                                        <div class="modal-header p-3 bg-info-subtle">
                                            <h5 class="modal-title text-black" id="modal-title">Create Shift</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form class="needs-validation" name="shift-form" id="form-shift" novalidate>
                                                <input type="hidden" id="localStorageKey">
                                                <div class="text-end">
                                                    <a href="#" class="btn btn-sm btn-soft-primary" id="edit-shift-btn" data-id="edit-shift" onclick="editshift(this)" role="button">Edit</a>
                                                </div>
                                                <div class="shift-details d-block">
                                                    <div class="d-flex mb-2 gap-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="ri-calendar-event-line text-black fs-16"></i>
                                                            </div>
                                                            <div class="">
                                                                <h6 class="d-block fw-semibold mb-0 text-black" id="shift-start-date-tag"></h6>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <i class="ri-map-pin-line text-black fs-16"></i>
                                                        </div>
                                                        <div class="">
                                                            <h6 class="d-block fw-semibold mb-0 text-black"> <span id="shift-location-tag" class="text-black"></span></h6>
                                                        </div>
                                                    </div>
                                                    </div>

                                                </div>
                                                <div class="row shift-form">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <input type="hidden" id="empPositionId">
                                                            <label class="form-label">Employees</label>
                                                   <select class="simpleSearchSelect" name="productname-field" id="empName-shift" name="state">
                                                               <?php if(isset($empLists) && !empty($empLists)) {  ?>
                                                               <?php  foreach($empLists as $empList) { ?>
                                                               <option value="<?php echo $empList['emp_id']; ?>"><?php echo $empList['name']; ?></option>
                                                               <?php }  ?>
                                                               <?php }  ?>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <!--end col-->
                                                    <div class="col-12" id="shift-time">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Time</label>
                                                            <div class="input-group">
                                                            <input type="text" class="form-control timeInput empShiftStartTime" placeholder="Select time">
                                                            <small>choose or manually enter time in 24 hrs format i.e 1,2,14,15..</small>
                                                            </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Time</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control timeInput empShiftEndTime" placeholder="Select time">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12  addBreakText icon-demo-content">
                                                         <div class="mb-3">
                                                    <i class="ri-cup-fill fs-22 text-success mt-2"></i><span class="fs-14 text-black fw-semibold"> Add Break  </span> 
                                                    </div>    
                                                    </div> 
                                                     <div class="col-12 addBreakTimes d-none" id="breakTime">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="mb-3">
                                                                     <label class="form-label">Break Type</label>
                                                                    <select class="form-select" name="breakType">
                                                                        <option value="unpaid" selected>Unpaid Break</option>
                                                                        <option value="paid">Paid Break</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="mb-3">
                                                              <label class="form-label">Break Duration</label>
                                                              <select class="form-select" name="breakDuration">
                                                               <option value="15">15 Mins</option>
                                                               <option value="30">30 Mins</option>
                                                               <option value="45">45 Mins</option>
                                                               <option value="60">60 Mins</option>
                                                              </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Break Time</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control timeInput empBreakTime">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                             <div class="col-2 mt-4">
                                                          
                                                            <i class="ri-delete-bin-5-fill text-danger fs-22 deleteBreak"></i>        
                                                        
                                                    </div>
                                                      </div>
                                                    </div>
                                                    <!--end col-->
                                                    
                                                    <!--end col-->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Shift Tasks</label>
                                                            <textarea class="form-control" placeholder="Enter shift task" type="text" name="title" id="shift-note" ></textarea>
                                                           
                                                        </div>
                                                    </div>
                                                  
                                                    <input type="hidden" id="shiftBoxName" name="shiftBoxName" value="" />
                                                   
                                                </div>
                                                <!--end row-->
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-soft-danger" id="btn-delete-shift" data-bs-dismiss="modal"><i class="ri-close-line align-bottom"></i> Close</button>
                                                    <button type="button" class="btn btn-success btnAddShift" id="btn-save-shift" onclick="addEmpShift()">Add Shift</button>
                                                    <button type="button" class="btn btn-success btnUpdateShift" id="btn-save-shift" onclick="updateEmpShift()">Update Shift</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div> <!-- end modal-content-->
                                </div> <!-- end modal dialog-->
                            </div> <!-- end modal-->
                            <!-- end modal-->
                        
                  

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

         
        </div>
        
        <div class="modal fade" id="recreateRosterModal" tabindex="-1" aria-labelledby="recreateRoster" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="recreateRoster">Select date for roster</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                         <form action="<?php echo base_url('/HR/recreateRoster') ?>" method="post" id="recreateRosterForm">
                                                        <div class="modal-body">
                                                          <input type="hidden" name="roster_id" class="recreate_roster_id">
                                                                <div class="mb-3">
                                                                    <label for="startDate" class="col-form-label">Roster Start Date:</label>
                                                                    <input type="text" name="start_date" id="startdatepicker" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="endDate" class="col-form-label">Roster End Date:</label>
                                                                  <input type="text" name="end_date" id="enddatepicker" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                                                </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Recreate</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
     
 <script>  
 
function showRosterRecreateModal(roster_id){
  $(".recreate_roster_id").val(roster_id);
  $("#recreateRosterModal").modal("show");
}

 document.addEventListener("DOMContentLoaded", function () {
 
    var addshift = new bootstrap.Modal(document.getElementById('addShift-modal'), {
        keyboard: false
    });
  
 $(".addShiftForPrep").on('click',function(){
     let shiftDate = $(this).data('date');
     let prepAreaName = $(this).data('preparea');
     let prepAreaId = $(this).data('prepareaid');
     let shiftBoxName = $(this).data('shiftboxname');
     $("#shift-start-date-tag").html(shiftDate);
     $("#shiftBoxName").val(shiftBoxName);
     $("#shift-location-tag").html(prepAreaName);
     $(".btnUpdateShift").hide();
     $(".btnAddShift").show();
      addshift.show();
 })     
 });
 
 $(".addBreakText").on('click',function(){
   $(".addBreakTimes").removeClass('d-none');  
   $(".addBreakText").addClass('d-none');
 });
 
 $(".deleteBreak").on('click',function(){
   $(this).parents('.addBreakTimes').addClass('d-none');
   $(".addBreakText").removeClass('d-none');  
 });
 
 $(document).ready(function() {
  $('.timeInput').datetimepicker({
    format: 'hh:mm A',
    // debug: true,
    icons: {
      up: 'ri-arrow-up-s-line', // Set the up arrow icon
      down: 'ri-arrow-down-s-line', // Set the down arrow icon
    },
    useCurrent: false
   
  });
  
  $('.filterEmployeeLeftPanel').on('input', function() {
    let inputText = $(this).val().trim().toLowerCase(); // Get the input text and convert to lowercase
    $('.employee-div').hide().filter(function() {
        return $(this).data('employee-name').toLowerCase().includes(inputText);
    }).show();
});
  
   $('#clearFilter').click(function(){
    $('.filterEmployeeLeftPanel').val('');
    $('.employee-div').show(); // Show all divs when filter is cleared
  });
  
  var allDayRosterData = <?php echo json_encode($allDayRosterData, JSON_UNESCAPED_SLASHES); ?>;
  
   for (var key in allDayRosterData) {
    if (allDayRosterData.hasOwnProperty(key)) {
     localStorage.setItem(key, allDayRosterData[key]);
    }
}

  
 // fetch roster 
   $('.currentWeek').text();
//   $.ajax({
//             type: "POST",
//             url: "/HR/roster/fetchRoster",
//             data: 'weekRange='+$('.currentWeek').text(),
//             success: function(response) {
//           // Assuming we want to process the first element of the responseArray
//           if(response && response !='null' && response !=''){ 
         
//           let data = JSON.parse(response)[0];
//           console.log("response",response)
//           let daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
//           // Iterate over each day of the week
//       if (typeof data !== 'undefined') {   
//          daysOfWeek.forEach(function(day) {
   
//         if (data[day] && data[day] !== "") {
//          let dayData = JSON.parse(data[day]);
//          // Iterate over the parsed data to set key-value pairs in localStorage
//          for (let key in dayData) {
//             if (dayData.hasOwnProperty(key)) {
//                 let innerData = JSON.parse(dayData[key]);
//                 localStorage.setItem(key, JSON.stringify(innerData));
//             }
//         }
//          }
//         });
//       }
//             }
//             },
//             error: function(xhr, status, error) {
//                 console.error("Error posting data:", error);
//             }
//         });
   


});

function addEmpShift() {
    let shiftBoxName = $("#shiftBoxName").val();
    let formData = {
        employeeId: $("#empName-shift").val(),
        position_id: $("#empPositionId").val(),
        selectedEmpName: $("#empName-shift option:selected").text(),
        empShiftStartTime: $(".empShiftStartTime").val(),
        empShiftEndTime: $(".empShiftEndTime").val(),
        empBreakTime: $(".empBreakTime").val(),
        breakType: $('[name="breakType"]').val(),
        breakDuration: $('[name="breakDuration"]').val(),
        taskDescr: $("#shift-note").val(),
        rosterDate:$("#shift-start-date-tag").text()
        
    };
    let formDataS = JSON.stringify(formData);
    let keyForStorage = 'emp_'+shiftBoxName+'_'+formData.employeeId;
    saveInLocalStorage(keyForStorage, formDataS);
   
   let shiftHtml = '<i class="fas fa-times text-danger fw-bold mt-1 mx-4 float-end" style="cursor: pointer;" onclick="clearStorage(\'' + keyForStorage + '\', event,this)"></i>';
    shiftHtml += '<div class="border-1 bg-success-subtle rounded-2 mt-2" id="' + keyForStorage + '">';
    shiftHtml += '<b class="pt-1 fs-12">' + formData.selectedEmpName + '</b></br>';   
    shiftHtml += '<span class="fs-12"><i class="bx bx-stopwatch text-success fs-16"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime + '</span></br>';
    if (formData.empBreakTime !== undefined && formData.empBreakTime !== '') {
        shiftHtml += '<span class="pt-1 fs-12"><i class="bx bx-coffee text-danger fs-16"></i> Break : ' + formData.empBreakTime + '</span>';      
    }
    shiftHtml += '</div>';   

    
    let boxName = ".allocatedEmpShift_" + shiftBoxName; 
    $(boxName).append(shiftHtml); 
    $("#addShift-modal").modal('hide');
    $("#form-shift input").val("");
    
}
function saveInLocalStorage(key, value) {
    localStorage.setItem(key, value);
}

$(document).on('click', '[id^="emp_"]', function() {
    let employeeIdPrepId = $(this).attr('id'); // Extract the third part after splitting
    let formDataS = localStorage.getItem(employeeIdPrepId);
    let formData = JSON.parse(formDataS);
   
    $("#empName-shift").val(formData.employeeId);
    $("#empName-shift").trigger('change'); // Trigger change event if necessary
    $(".empShiftStartTime").val(formData.empShiftStartTime);
    $(".empShiftEndTime").val(formData.empShiftEndTime);
    $(".empBreakTime").val(formData.empBreakTime);
    $('[name="breakType"]').val(formData.breakType)
    $('[name="breakDuration"]').val(formData.breakDuration)
    $("#shift-note").val(formData.taskDescr);
    $("#localStorageKey").val(employeeIdPrepId);
    
    $(".btnUpdateShift").show();
    $(".btnAddShift").hide();
    $("#addShift-modal").modal('show');
});

function updateEmpShift(){
    let storageKey = $("#localStorageKey").val();
    let data = JSON.parse(localStorage.getItem(storageKey));
    let formData = {
    employeeId: $("#empName-shift").val(),
    selectedEmpName: $("#empName-shift option:selected").text(),
    empShiftStartTime: $(".empShiftStartTime").val(),
    empShiftEndTime: $(".empShiftEndTime").val(),
    empBreakTime: $(".empBreakTime").val(),
    breakType: $('[name="breakType"]').val(),
    breakDuration: $('[name="breakDuration"]').val(),
    taskDescr: $("#shift-note").val(),
    rosterDate:$("#shift-start-date-tag").text()
};
    data = formData;
    localStorage.setItem(storageKey, JSON.stringify(data));
    // let shiftHtml = '<i class="fas fa-times text-danger fw-bold mt-1 mx-4 float-end" style="cursor: pointer;" onclick="clearStorage('+storageKey+')"></i>'; 
    let shiftHtml = '<b class="pt-1 fs-12">' + formData.selectedEmpName + '</b></br>';   
    shiftHtml += '<span class="fs-12"><i class="bx bx-stopwatch text-success fs-16"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime + '</span></br>';
    if (formData.empBreakTime !== undefined && formData.empBreakTime !== '') {
        shiftHtml += '<span class="pt-1 fs-12"><i class="bx bx-coffee text-danger fs-16"></i> Break : ' + formData.empBreakTime + '</span>';      
    }
    $("#"+storageKey).html(shiftHtml);
    $("#addShift-modal").modal('hide');
    $("#form-shift input").val("");
    publishRoster();

}


$(function() {
    // Make employees draggable
    $("#form-shift input").val("");
    $('.dragSourceElement').draggable({
        helper: 'clone',
        revert: 'invalid',
        zIndex: 1000,
        opacity: 0.7,
        appendTo: 'body'
    });

    // Make calendar cells droppable
    $('.square-box').droppable({
        accept: '.dragSourceElement',
        drop: function(event, ui) {
            let emp_id = ui.draggable.find('.empId').val();
            let position_id = ui.draggable.find('.position_id').val();
            let emp_name = ui.draggable.find('.empName').val(); 
            let shiftBoxName = $(this).data('shiftboxname'); 
            let rosterDate = $(this).data('date'); 
            $("#empName-shift").val(emp_id);
            $("#shift-start-date-tag").html(rosterDate);
            $("#empPositionId").val(position_id);
            $("#shiftBoxName").val(shiftBoxName)
            addEmpShift();
           
        }
    });
});

function clearStorage(keyStorage,event,clickedElement){
    $(clickedElement).remove();
    $('.dragEmployeeBox').find('#'+keyStorage).remove();
    localStorage.removeItem(keyStorage);
    event.stopPropagation();
}


function publishRoster(savetype='save') {
    var empData = {};
   
   for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            empData[key] = localStorage.getItem(key);
            if(savetype == 'publish'){
            localStorage.removeItem(key);
            }
        }
    }    
    
  
     empData.week = $('.currentWeek').text();
     empData.rosterName = $('#rosterName').val();
     empData.savetype = savetype;
    // Make sure there is data to send
    if (Object.keys(empData).length > 0) {
        // Send the data to CI controller using AJAX
        $.ajax({
            type: "POST",
            url: "/HR/roster/add",
            data: empData,
            success: function(response) {
                // Handle success response
                console.log("Data posted successfully");
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error("Error posting data:", error);
            }
        });
    } else {
        console.log("No data to send");
    }
}

$(".weekAreaAndTeam").on('change', function() {
    let rosterId = '<?php echo $rosterId; ?>';

    if (!rosterId || rosterId.trim() === '' || isNaN(parseInt(rosterId))) {
      rosterId = '';
    }
    rosterId = parseInt(rosterId); 

    if ($(this).val() == '3') {
        window.location.href = '/HR/rosterViewByTM/' + rosterId;
    } else if ($(this).val() == '2') {
        window.location.href = '/HR/rosterViewWTM/' + rosterId;
    } else {
        window.location.href = '/HR/rosterView/' + rosterId;
    }
});



 </script>
 <!--prev and next week feature onclick of icon-->
<script>
  // Function to format date in "dd Mmm" format
  function formatDate(date) {
    return date.getDate() + ' ' + date.toLocaleDateString('en-us', { month: 'short' });
  }

  // Function to get the start date of the current week (Monday)
  function getCurrentWeekStartDate() {
    let rosterStartDate = '<?php echo $rosterStartDate; ?>';
    let today = new Date(); 
    if(rosterStartDate !=''){
     today = new Date(rosterStartDate);    
    }
    
    const currentDay = today.getDay();
    const monday = new Date(today);
    monday.setDate(today.getDate() - currentDay + (currentDay === 0 ? -6 : 1)); // Adjust if Sunday
    return monday;
  }

  var currentWeekStartDate = getCurrentWeekStartDate();
 console.log("currentWeekStartDate",currentWeekStartDate);
  function updateCurrentWeekText(fetchRosterData) {
    const endDate = new Date(currentWeekStartDate);
    endDate.setDate(currentWeekStartDate.getDate() + 6);
    
    const buttonText = formatDate(currentWeekStartDate) + ' - ' + formatDate(endDate);
    console.log("buttonText",buttonText)
    const encodedButtonText = encodeURIComponent(buttonText);
    $('.currentWeek').text(buttonText);
    if(fetchRosterData){
  window.location.href = '/HR/fetchRosterOnArrowClick/' + encodedButtonText+'/WBA';     
    }
    
  }

  function updatePrevWeekText() {
    currentWeekStartDate.setDate(currentWeekStartDate.getDate() - 7);
    updateCurrentWeekText(true);
  }

  function updateNextWeekText() {
    currentWeekStartDate.setDate(currentWeekStartDate.getDate() + 7);
    updateCurrentWeekText(true);
  }
//   let rosterID = '<?php echo $rosterId; ?>';
//   if(rosterID != ''){
//     updateCurrentWeekText(false);  
//   }
  

  $('.prevWeek').click(function() {
    for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            localStorage.removeItem(key);
        }
    }     
    updatePrevWeekText();
  });

  $('.nextWeek').click(function() {
    for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            localStorage.removeItem(key);
        }
    }     
    updateNextWeekText();
  });
  
  
  $(document).ready(function(){
    setTimeout(function() {
        $(".alert").fadeOut("slow");
    }, 4000);
  
    flatpickr("#startdatepicker", {
        dateFormat: "d M, Y",
        disable: [
            function(date) {
                // Disable all days except Mondays for roster start date selection
                return (date.getDay() !== 1);
            }
        ]
    });
    
    flatpickr("#enddatepicker", {
        dateFormat: "d M, Y",
        disable: [
            function(date) {
                // Disable all days except Sunday for roster end date selection
                return (date.getDay() !== 0);
            }
        ]
    });
    

    $('#recreateRosterForm').on('submit', function() {
        $('#loaderContainer').show();
    });

});
  
</script>   


