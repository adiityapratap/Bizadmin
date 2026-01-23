<style>
  .square-box {
    background-color: lightgray;
    text-align: center;
    vertical-align: middle;
    width: 100px;
    height: 100px;
  }
  .dropdown-menu .btn .glyphicon {
    color: black !important;
  }
  .dragEmployeeBox div {
    cursor: pointer; /* Make shift boxes clickable for editing */
  }
</style>

<div class="main-content">
  <?php
  // Determine the week range for display
 if (isset($weekRange) && $weekRange != '') {
    $date_text = $weekRange;
} else {
    $monday = new DateTime('monday this week');
    $date_text = $monday->format('d M') . ' - ' . $monday->modify('+6 days')->format('d M');
}

  // Determine start and end dates for the roster
  if (isset($rosterInfo[0]['start_date']) && $rosterInfo[0]['start_date'] != '') {
    $sdate = $rosterInfo[0]['start_date'];
    $endDate = $rosterInfo[0]['end_date'];

    $startDateTime = new DateTime($sdate);
    $endDateTime = new DateTime($endDate);
    $startFormatted = $startDateTime->format('jS F');
    $endFormatted = $endDateTime->format('jS F');
    $date_text = "$startFormatted - $endFormatted";
  } else if (isset($rosterStartDate) && $rosterStartDate != '') {
    $sdate = $rosterStartDate;
  } else {
    $cdate = date('Y-m-d');
    $timestamp = strtotime($cdate);
    $dayOfWeek = date("N", $timestamp);
    $daysToMonday = $dayOfWeek - 1;
    $sdate = date("Y-m-d", strtotime("-$daysToMonday days", $timestamp));
  }
  ?>

  <div class="page-content" style="margin-top: 20px;">
    <div class="container-fluid">
      <!-- Loader -->
      <div id="loader-overlayAjax">
        <div class="spinner-border text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <div class="row mb-4 mt-2 gap-3">
        <div class="col-md-2 col-sm-2 col-lg-1">
          <a class="btn btn-orange btn-icon waves-effect waves-light shadow-none w-100" onclick="goBack()">
            <i class="mdi mdi-reply align-bottom me-1"></i> Back
          </a>
        </div>
        <div class="col-md-3 col-lg-2 col-sm-4">
          <input type="text" name="rosterName" class="form-control" id="rosterName" placeholder="Roster Name" value="<?php echo isset($rosterInfo[0]['rosterName']) ? $rosterInfo[0]['rosterName'] : ''; ?>">
        </div>
       <div class="col-md-4 col-sm-8 col-lg-3 d-flex gap-2">
    <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none prevWeek">
        <i class="ri-arrow-left-s-line fw-bold"></i>
    </button>
    <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek">
        <?php echo $date_text; ?>
    </button>
    <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none nextWeek">
        <i class="ri-arrow-right-s-line fw-bold"></i>
    </button>
</div>
        <div class="col-md-4 col-sm-5 col-lg-2">
          <select class="form-select bg-primary-subtle fw-bold weekAreaAndTeam" style="color:#4b38b3">
            <option selected value="1">Week by Area</option>
            <option value="2">Week by Team Member</option>
            <option value="3">Day by Team Member</option>
          </select>
        </div>
        <div class="col-md-2 col-lg-1">
          <button data-bs-toggle="modal" onclick="showRosterRecreateModal(<?php echo isset($rosterId) ? $rosterId : 0; ?>)" class="btn btn-warning">
            <i class="ri-file-copy-fill fw-bold"></i> Recreate
          </button>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-1">
          <button type="button" class="btn btn-success" onclick="publishRoster('save')">
            <i class="ri-save-2-fill fw-bold"></i> Save
          </button>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-1">
          <button type="button" class="btn btn-primary" onclick="publishRoster('publish')">
            <i class="ri-save-2-fill fw-bold"></i> Publish
          </button>
        </div>
      </div>

      <div class="row">
        <!-- Employee List -->
        <div class="col-xl-2 col-lg-2 col-sm-4 overflow-auto">
          <div class="card h-100 shadow-none">
            <div class="card-header">
              <h4 class="card-title mb-0 text-black">Employees</h4>
            </div>
            <div class="card-body">
              <div class="mx-n3 h-100">
                <div class="mb-3 px-3">
                  <input type="text" class="form-control filterEmployeeLeftPanel" placeholder="Search employee">
                  <a id="clearFilter" href="#"><small class="text-danger float-end">clear</small></a>
                </div>
                <?php if (isset($empLists) && !empty($empLists)) { ?>
                  <?php foreach ($empLists as $empList) { ?>
                    <a class="text-reset notification-item dropdown-item border-bottom border-light employee-div" data-employee-name="<?php echo $empList['name']; ?>" data-bs-toggle="collapse" href="#collapse<?php echo $empList['emp_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $empList['emp_id']; ?>">
                      <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs me-3">
                          <span class="avatar-title bg-success-subtle text-info rounded-circle fs-16 shadow">
                            <i class="ri-user-follow-fill text-success"></i>
                          </span>
                        </div>
                        <div class="flex-grow-1 text-black dragSourceElement">
                          <h6 class="mb-1 fs-14 text-black"><?php echo $empList['name']; ?></h6>
                          <?php
                          $positionDetail = array_filter($positionLists, function ($value) use ($empList) {
                            return $value['position_id'] == $empList['position_id'];
                          });
                          $positionDetail = reset($positionDetail);
                          ?>
                          <small><?php echo isset($positionDetail['position_name']) ? $positionDetail['position_name'] : ''; ?></small>
                          <input type="hidden" class="position_id" value="<?php echo $empList['position_id']; ?>">
                          <input type="hidden" class="empId" value="<?php echo $empList['emp_id']; ?>">
                          <input type="hidden" class="empName" value="<?php echo $empList['name']; ?>">
                        </div>
                      </div>
                    </a>
                    <div class="collapse mx-3 bg-light-subtle fs-12 py-2" id="collapse<?php echo $empList['emp_id']; ?>"></div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Roster Table -->
        <div class="col-xl-10 col-lg-10 col-sm-8">
          <div class="card h-100 shadow-none">
            <div class="card-body table-responsive">
              <table class="table table-bordered">
                <?php $currentMonday = date('Y-m-d', strtotime($sdate)); ?>
                <?php $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); ?>
                <thead class="table-light">
                  <?php foreach ($days as $day) { ?>
                    <th><?php echo $day . ' ' . date('d-m', strtotime($currentMonday)); ?></th>
                    <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
                  <?php } ?>
                </thead>
                <tbody>
                  <?php if (isset($prepAreas) && !empty($prepAreas)) { ?>
                    <?php foreach ($prepAreas as $prepArea) { ?>
                      <?php $currentMonday = date('Y-m-d', strtotime($sdate)); ?>
                      <tr class="accordion-button accordion accordion-primary border-bottom" type="button" data-bs-toggle="collapse" data-bs-target="#prep_<?php echo $prepArea['id']; ?>" aria-expanded="true" aria-controls="<?php echo $prepArea['id']; ?>">
                        <th colspan="7" class="border-0"><?php echo $prepArea['prep_name']; ?></th>
                      </tr>
                      <tr id="prep_<?php echo $prepArea['id']; ?>" class="accordion-collapse collapse show">
                        <?php foreach ($days as $day) { ?>
                          <?php
                          $dayName = strtolower($day);
                          $dateNumber = date('d', strtotime($currentMonday));
                          $shiftBoxName = $dateNumber . '_' . $prepArea['id'];
                          ?>
                          <td class="square-box addShiftForPrep h-100" data-shiftBoxName="<?php echo $shiftBoxName; ?>" data-date="<?php echo date('d-m-Y', strtotime($currentMonday)); ?>" data-prepArea="<?php echo $prepArea['prep_name']; ?>" data-prepAreaId="<?php echo $prepArea['id']; ?>">
                            <div class="allocatedEmpShift_<?php echo $shiftBoxName; ?> dragEmployeeBox">
                              <!-- Dynamically populated via JavaScript -->
                            </div>
                            <i class="ri-add-fill"></i>
                          </td>
                          <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Add/Edit Shift Modal -->
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
                  <a href="#" class="btn btn-sm btn-soft-primary d-none" id="edit-shift-btn" data-id="edit-shift" onclick="editshift(this)" role="button">Edit</a>
                </div>
                <div class="shift-details d-block">
                  <div class="d-flex mb-2 gap-3">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0 me-3">
                        <i class="ri-calendar-event-line text-black fs-16"></i>
                      </div>
                      <div>
                        <h6 class="d-block fw-semibold mb-0 text-black" id="shift-start-date-tag"></h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0 me-3">
                        <i class="ri-map-pin-line text-black fs-16"></i>
                      </div>
                      <div>
                        <h6 class="d-block fw-semibold mb-0 text-black">
                          <span id="shift-location-tag" class="text-black"></span>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row shift-form">
                  <div class="col-12">
                    <div class="mb-3">
                      <input type="hidden" id="empPositionId">
                      <label class="form-label">Employees</label>
                      <select class="simpleSearchSelect" name="empName-shift" id="empName-shift">
                        <?php if (isset($empLists) && !empty($empLists)) { ?>
                          <?php foreach ($empLists as $empList) { ?>
                            <option value="<?php echo $empList['emp_id']; ?>"><?php echo $empList['name']; ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12" id="shift-time">
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <label class="form-label">Start Time</label>
                          <div class="input-group">
                            <input type="text" class="form-control timeInput empShiftStartTime" placeholder="Select time">
                            <small>choose or manually enter time in 12 hrs format (e.g., 9:00 AM)</small>
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
                  <div class="col-12 addBreakText icon-demo-content">
                    <div class="mb-3">
                      <i class="ri-cup-fill fs-22 text-success mt-2"></i>
                      <span class="fs-14 text-black fw-semibold"> Add Break </span>
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
                  <div class="col-12">
                    <div class="mb-3">
                      <label class="form-label">Shift Tasks</label>
                      <textarea class="form-control" placeholder="Enter shift task" type="text" name="taskDescr" id="shift-note"></textarea>
                    </div>
                  </div>
                  <input type="hidden" id="shiftBoxName" name="shiftBoxName" value="" />
                </div>
                <div class="hstack gap-2 justify-content-end">
                  <button type="button" class="btn btn-soft-danger" id="btn-delete-shift" data-bs-dismiss="modal">
                    <i class="ri-close-line align-bottom"></i> Close
                  </button>
                  <button type="button" class="btn btn-success btnAddShift" onclick="addEmpShift()">
                    Add Shift
                  </button>
                  <button type="button" class="btn btn-success btnUpdateShift d-none" onclick="updateEmpShift()">
                    Update Shift
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Recreate Roster Modal -->
      <div class="modal fade" id="recreateRosterModal" tabindex="-1" aria-labelledby="recreateRoster" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="recreateRoster">Select date for roster</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('/HR/recreateRoster'); ?>" method="post" id="recreateRosterForm">
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
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var addshift = new bootstrap.Modal(document.getElementById('addShift-modal'), {
    keyboard: false
  });

  // Open modal when clicking on "Add Shift" area
  $(".addShiftForPrep").on('click', function() {
    let shiftDate = $(this).data('date');
    let prepAreaName = $(this).data('preparea');
    let prepAreaId = $(this).data('prepareaid');
    let shiftBoxName = $(this).data('shiftboxname');
    $("#shift-start-date-tag").html(shiftDate);
    $("#shiftBoxName").val(shiftBoxName);
    $("#shift-location-tag").html(prepAreaName);
    $(".btnUpdateShift").addClass('d-none');
    $(".btnAddShift").removeClass('d-none');
    $("#empName-shift").prop('disabled', false); // Enable employee selection
    addshift.show();
  });

  // Toggle break time section
  $(".addBreakText").on('click', function() {
    $(".addBreakTimes").removeClass('d-none');
    $(".addBreakText").addClass('d-none');
  });

  $(".deleteBreak").on('click', function() {
    $(this).parents('.addBreakTimes').addClass('d-none');
    $(".addBreakText").removeClass('d-none');
    $(".empBreakTime").val(''); // Clear break time
  });

  // Initialize time picker
  $('.timeInput').datetimepicker({
    format: 'hh:mm A',
    icons: {
      up: 'ri-arrow-up-s-line',
      down: 'ri-arrow-down-s-line',
    },
    useCurrent: false
  });

  // Filter employees in the left panel
  $('.filterEmployeeLeftPanel').on('input', function() {
    let inputText = $(this).val().trim().toLowerCase();
    $('.employee-div').hide().filter(function() {
      return $(this).data('employee-name').toLowerCase().includes(inputText);
    }).show();
  });

  $('#clearFilter').click(function() {
    $('.filterEmployeeLeftPanel').val('');
    $('.employee-div').show();
  });

  // Load existing roster data into localStorage
  var allDayRosterData = <?php echo json_encode($allDayRosterData ?? [], JSON_UNESCAPED_SLASHES); ?>;
  for (var key in allDayRosterData) {
    if (allDayRosterData.hasOwnProperty(key)) {
      localStorage.setItem(key, allDayRosterData[key]);
    }
  }

  // Display roster data from localStorage on page load
  loadRosterFromLocalStorage();

  // Drag and Drop Functionality
  $('.dragSourceElement').draggable({
    helper: 'clone',
    revert: 'invalid',
    zIndex: 1000,
    opacity: 0.7,
    appendTo: 'body'
  });

  $('.square-box').droppable({
    accept: '.dragSourceElement',
    drop: function(event, ui) {
      let emp_id = ui.draggable.find('.empId').val();
      let position_id = ui.draggable.find('.position_id').val();
      let emp_name = ui.draggable.find('.empName').val();
      let shiftBoxName = $(this).data('shiftboxname');
      let rosterDate = $(this).data('date');
      let prepAreaName = $(this).data('preparea');
      let prepAreaId = $(this).data('prepareaid');

      // Populate modal with dropped employee details
      $("#empName-shift").val(emp_id);
      $("#empName-shift").prop('disabled', true); // Disable employee selection after drop
      $("#shift-start-date-tag").html(rosterDate);
      $("#empPositionId").val(position_id);
      $("#shiftBoxName").val(shiftBoxName);
      $("#shift-location-tag").html(prepAreaName);
      $(".btnUpdateShift").addClass('d-none');
      $(".btnAddShift").removeClass('d-none');
      addshift.show();
    }
  });

  // Edit shift by clicking on the shift box
  $(document).on('click', '.dragEmployeeBox div[id^="emp_"]', function() {
    let employeeIdPrepId = $(this).attr('id');
    let formDataS = localStorage.getItem(employeeIdPrepId);
    let formData = JSON.parse(formDataS);

    $("#empName-shift").val(formData.employeeId);
    $("#empName-shift").prop('disabled', true); // Disable employee selection during edit
    $(".empShiftStartTime").val(formData.empShiftStartTime);
    $(".empShiftEndTime").val(formData.empShiftEndTime);
    $(".empBreakTime").val(formData.empBreakTime);
    $('[name="breakType"]').val(formData.breakType);
    $('[name="breakDuration"]').val(formData.breakDuration);
    $("#shift-note").val(formData.taskDescr);
    $("#localStorageKey").val(employeeIdPrepId);
    $("#shift-start-date-tag").html(formData.rosterDate);
    $("#shiftBoxName").val(employeeIdPrepId.split('_')[1] + '_' + employeeIdPrepId.split('_')[2]);
    $("#shift-location-tag").html($(this).closest('.addShiftForPrep').data('preparea'));

    $(".btnUpdateShift").removeClass('d-none');
    $(".btnAddShift").addClass('d-none');
    addshift.show();
  });
});

// Function to load roster data from localStorage on page load


function loadRosterFromLocalStorage() {
    for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            let formDataS = localStorage.getItem(key);
            let formData = JSON.parse(formDataS);

            // Convert 24-hour times to 12-hour format
            formData.empShiftStartTime = convertTo12HourFormat(formData.empShiftStartTime);
            formData.empShiftEndTime = convertTo12HourFormat(formData.empShiftEndTime);
            formData.empBreakTime = formData.empBreakTime ? convertTo12HourFormat(formData.empBreakTime) : '';

            // Update localStorage with the converted times
            localStorage.setItem(key, JSON.stringify(formData));

            let shiftBoxName = key.split('_')[1] + '_' + key.split('_')[2];
            let shiftHtml = '';
            shiftHtml += '<div class="border-1 bg-success-subtle rounded-2 mt-2" id="' + key + '">';
            shiftHtml+='<i class="fas fa-times text-danger fw-bold mt-1 mx-4 float-end" style="cursor: pointer;" onclick="clearStorage(\'' + key + '\', event, this)"></i>';
            shiftHtml += '<b class="pt-1 fs-12">' + formData.selectedEmpName + '</b><br>';
            shiftHtml += '<span class="fs-12"><i class="bx bx-stopwatch text-success fs-16"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime + '</span>';
            if (formData.empBreakTime && formData.empBreakTime !== '') {
                shiftHtml += '<br><span class="pt-1 fs-12"><i class="bx bx-coffee text-danger fs-16"></i> Break: ' + formData.empBreakTime + '</span>';
            }
            shiftHtml += '</div>';

            let boxName = ".allocatedEmpShift_" + shiftBoxName;
            $(boxName).append(shiftHtml);
        }
    }
}

// Helper function to convert 24-hour format to 12-hour format
function convertTo12HourFormat(time) {
    if (!time || !time.match(/^\d{2}:\d{2}:\d{2}$/)) {
        return time; // Return as-is if not in 24-hour format
    }

    let [hours, minutes] = time.split(':');
    hours = parseInt(hours, 10);
    let period = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert 0 or 12 to 12
    return `${hours}:${minutes} ${period}`; // e.g., "11:00:00" -> "11:00 AM"
}

// Add a new shift
function addEmpShift() {
  let shiftBoxName = $("#shiftBoxName").val();
  let empId = $("#empName-shift").val();
  let formData = {
    employeeId: empId,
    position_id: $("#empPositionId").val(),
    selectedEmpName: $("#empName-shift option:selected").text(),
    empShiftStartTime: $(".empShiftStartTime").val(),
    empShiftEndTime: $(".empShiftEndTime").val(),
    empBreakTime: $(".empBreakTime").val(),
    breakType: $('[name="breakType"]').val(),
    breakDuration: $('[name="breakDuration"]').val(),
    taskDescr: $("#shift-note").val(),
    rosterDate: $("#shift-start-date-tag").text()
  };

  let formDataS = JSON.stringify(formData);
  let keyForStorage = 'emp_' + shiftBoxName + '_' + formData.employeeId;
  saveInLocalStorage(keyForStorage, formDataS);

  let shiftHtml = '';
  shiftHtml += '<div class="border-1 bg-success-subtle rounded-2 mt-2" id="' + keyForStorage + '">';
  shiftHtml+='<i class="fas fa-times text-danger fw-bold mt-1 mx-4 float-end" style="cursor: pointer;" onclick="clearStorage(\'' + keyForStorage + '\', event, this)"></i>';
  shiftHtml += '<b class="pt-1 fs-12">' + formData.selectedEmpName + '</b><br>';
  shiftHtml += '<span class="fs-12"><i class="bx bx-stopwatch text-success fs-16"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime + '</span>';
  if (formData.empBreakTime && formData.empBreakTime !== '') {
    shiftHtml += '<br><span class="pt-1 fs-12"><i class="bx bx-coffee text-danger fs-16"></i> Break: ' + formData.empBreakTime + '</span>';
  }
  shiftHtml += '</div>';

  let boxName = ".allocatedEmpShift_" + shiftBoxName;
  $(boxName).append(shiftHtml);
  $("#addShift-modal").modal('hide');
  $("#form-shift")[0].reset();
  $(".addBreakTimes").addClass('d-none');
  $(".addBreakText").removeClass('d-none');
}

// Update an existing shift
function updateEmpShift() {
  let storageKey = $("#localStorageKey").val();
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
    rosterDate: $("#shift-start-date-tag").text()
  };

  localStorage.setItem(storageKey, JSON.stringify(formData));

  let shiftHtml = '';
  shiftHtml += '<div class="border-1 bg-success-subtle rounded-2 mt-2" id="' + storageKey + '">';
  shiftHtml+='<i class="fas fa-times text-danger fw-bold mt-1 mx-4 float-end" style="cursor: pointer;" onclick="clearStorage(\'' + storageKey + '\', event, this)"></i>';
  shiftHtml += '<b class="pt-1 fs-12">' + formData.selectedEmpName + '</b><br>';
  shiftHtml += '<span class="fs-12"><i class="bx bx-stopwatch text-success fs-16"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime + '</span>';
  if (formData.empBreakTime && formData.empBreakTime !== '') {
    shiftHtml += '<br><span class="pt-1 fs-12"><i class="bx bx-coffee text-danger fs-16"></i> Break: ' + formData.empBreakTime + '</span>';
  }
  shiftHtml += '</div>';

  $("#" + storageKey).replaceWith(shiftHtml);
  $("#addShift-modal").modal('hide');
  $("#form-shift")[0].reset();
  $(".addBreakTimes").addClass('d-none');
  $(".addBreakText").removeClass('d-none');
}

function saveInLocalStorage(key, value) {
  localStorage.setItem(key, value);
}

function clearStorage(keyStorage, event, clickedElement) {
  $(clickedElement).parent().remove();
  localStorage.removeItem(keyStorage);
  event.stopPropagation();
}

function publishRoster(savetype = 'save') {
    var empData = {};
    for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            empData[key] = localStorage.getItem(key);
        }
    }
    empData.week = $('.currentWeek').text();
    empData.rosterName = $('#rosterName').val();
    empData.savetype = savetype;

    if (Object.keys(empData).length > 0) {
        $.ajax({
            type: "POST",
            url: "/HR/roster/add",
            data: empData,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    if (savetype === 'publish') {
                        for (var key in localStorage) {
                            if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
                                localStorage.removeItem(key);
                            }
                        }
                        window.location.href = '/HR/roster';
                    }
                } else {
                    alert('Error: ' + (res.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error("Error posting data:", error);
                alert('Failed to save roster. Please try again.');
            }
        });
    } else {
        alert("No data to save.");
    }
}

function showRosterRecreateModal(roster_id) {
  $(".recreate_roster_id").val(roster_id);
  $("#recreateRosterModal").modal("show");
}

// Previous and Next Week Navigation


function formatDate(date) {
    const options = { day: '2-digit', month: 'short' };
    return date.toLocaleDateString('en-GB', options).replace(/ /g, ' ');
}

function getCurrentWeekStartDate() {
    let rosterStartDate = '<?php echo isset($rosterStartDate) ? $rosterStartDate : ''; ?>';
    let today = rosterStartDate ? new Date(rosterStartDate) : new Date();
    const currentDay = today.getDay();
    const monday = new Date(today);
    monday.setDate(today.getDate() - currentDay + (currentDay === 0 ? -6 : 1));
    return monday;
}

var currentWeekStartDate = getCurrentWeekStartDate();

function updateCurrentWeekText(fetchRosterData) {
    const endDate = new Date(currentWeekStartDate);
    endDate.setDate(currentWeekStartDate.getDate() + 6);
    const buttonText = formatDate(currentWeekStartDate) + ' - ' + formatDate(endDate);
    const encodedButtonText = encodeURIComponent(buttonText);
    const encodedStartDate = encodeURIComponent(currentWeekStartDate.toISOString().split('T')[0]);
    $('.currentWeek').text(buttonText);

    if (fetchRosterData) {
        // Pass weekRange and rosterStartDate as query parameters
        window.location.href = '/HR/fetchRosterByWeek?weekRange=' + encodedButtonText + '&rosterStartDate=' + encodedStartDate;
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

$(".weekAreaAndTeam").on('change', function() {
  let rosterId = '<?php echo isset($rosterId) ? $rosterId : 0; ?>';
  if (!rosterId || rosterId.trim() === '' || isNaN(parseInt(rosterId))) {
    rosterId = 0;
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

$(document).ready(function() {
  setTimeout(function() {
    $(".alert").fadeOut("slow");
  }, 4000);

  flatpickr("#startdatepicker", {
    dateFormat: "d M, Y",
    disable: [
      function(date) {
        return (date.getDay() !== 1);
      }
    ]
  });

  flatpickr("#enddatepicker", {
    dateFormat: "d M, Y",
    disable: [
      function(date) {
        return (date.getDay() !== 0);
      }
    ]
  });

  $('#recreateRosterForm').on('submit', function() {
    $('#loaderContainer').show();
  });
});
</script>