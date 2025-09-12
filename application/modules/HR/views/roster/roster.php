<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>window.FontAwesomeConfig = { autoReplaceSvg: 'nest'};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;500;600;700;800;900&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif !important;
        }
        .fa, .fas, .far, .fal, .fab {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
        }
        ::-webkit-scrollbar {
            display: none;
        }
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .dragEmployeeBox div {
            cursor: pointer;
        }
        
     
    </style>
    <script>
        tailwind.config = {
            "theme": {
                "extend": {
                    "colors": {
                        "primary": "#4F46E5",
                        "primary-light": "#EEF2FF",
                        "shift-green": "#E6F4EA",
                        "shift-border": "#CAEBD0"
                    },
                    "fontFamily": {
                        "sans": ["Inter", "sans-serif"]
                    }
                },
                "fontFamily": {
                    "sans": ["Inter", "sans-serif"]
                }
            }
        };
    </script>
    
    <style>
    
    #loader-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex; /* Ensure Flexbox is applied */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
    }
    .spinner {
        width: 130px; 
        height: 130px;
        border: 3px solid #f3f3f3; 
        border-top: 3px solid #172153;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    </style>
</head>
<body class="bg-gray-50 font-sans mb-5 mt-5">
    <div id="loader-overlay">
    <div class="spinner"></div>
</div>
    <div class="flex h-screen overflow-hidden">
        <!-- Left Sidebar (Employee List) -->
        <div id="employee-sidebar" class="w-72 bg-white border-r border-gray-200 flex flex-col mt-3">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg text-black font-semibold text-gray-800">Team Members</h2>
                    <span class="badge bg-primary text-white px-2 py-1 rounded-full"><?php echo count($empLists); ?> members</span>
                </div>
                <div class="relative mb-3">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Search employees" class="filterEmployeeLeftPanel w-full pl-10 pr-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                </div>
            </div>
            <div class="overflow-y-auto flex-grow">
                <ul id="employee-list" class="px-2">
                    <?php 
                     $avatar_colors = ['bg-primary', 'bg-green-600', 'bg-purple-600', 'bg-amber-600', 'bg-rose-600', 'bg-blue-600'];
                     $color_index = 0;
                     ?>
                    <?php if (isset($empLists) && !empty($empLists)) { ?>
                        <?php foreach ($empLists as $empList) { ?>
                            <li class="my-1.5">
                                <a class="text-reset employee-div dragSourceElement" data-employee-name="<?php echo $empList['name']; ?>" data-bs-toggle="collapse" href="#collapse<?php echo $empList['emp_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $empList['emp_id']; ?>">
                                    <span class="flex items-center p-2.5 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <?php
                                     $avatar_color = $avatar_colors[$color_index % count($avatar_colors)];
                                    $color_index++;
                                    $is_active = $color_index === 1 ? 'border-primary-500' : 'border-transparent';
                                     ?>

<div class="w-10 h-10 rounded-full <?php echo $avatar_color; ?> text-white flex items-center justify-center font-medium mr-3">
    <?php echo strtoupper(substr($empList['name'], 0, 2)); ?>
</div>

                                        <div class="flex-grow-1">
                                            <p class="text-sm font-medium text-gray-800"><?php echo $empList['name']; ?></p>
                                            <p class="text-xs text-gray-500">
                                                <?php
                                                $positionDetail = array_filter($positionLists, function ($value) use ($empList) {
                                                    return $value['position_id'] == $empList['position_id'];
                                                });
                                                $positionDetail = reset($positionDetail);
                                                echo isset($positionDetail['position_name']) ? $positionDetail['position_name'] : '';
                                                ?>
                                            </p>
                                            <input type="hidden" class="position_id" value="<?php echo $empList['position_id']; ?>">
                                            <input type="hidden" class="empId" value="<?php echo $empList['emp_id']; ?>">
                                            <input type="hidden" class="empName" value="<?php echo $empList['name']; ?>">
                                        </div>
                                        <span class="ml-auto text-xs font-medium bg-green-100 text-green-800 py-1 px-2 rounded-full">
                                            <?php $timesheets = isset($empList['timesheets']) ? $empList['timesheets'] : 0; ?>
                                            <?php echo $timesheets; ?>h
                                        </span>
                                    </span>
                                </a>
                                <div class="collapse mx-3 bg-gray-100 fs-12 py-2" id="collapse<?php echo $empList['emp_id']; ?>"></div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden mt-3">
            <!-- Top Bar (Header Section) -->
            <header id="header" class="bg-white border-b border-gray-200 py-3 px-4 md:px-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-3">
        <!-- Left Section -->
        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="flex items-center bg-white border border-gray-300 rounded-lg overflow-hidden">
                <button class="prevWeek px-2 py-1.5 text-gray-500 hover:bg-gray-100">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <div class="currentWeek px-2 py-1.5 font-medium text-gray-800 text-sm md:text-base">
                    <?php
                    if (isset($weekRange) && $weekRange != '') {
                        $date_text = $weekRange;
                    } else {
                        $monday = new DateTime('monday this week');
                        $date_text = $monday->format('d M') . ' - ' . $monday->modify('+6 days')->format('d M');
                    }
                    if (isset($rosterInfo[0]['start_date']) && $rosterInfo[0]['start_date'] != '') {
                        $sdate = $rosterInfo[0]['start_date'];
                        $endDate = $rosterInfo[0]['end_date'];
                        $startDateTime = new DateTime($sdate);
                        $endDateTime = new DateTime($endDate);
                        $startFormatted = $startDateTime->format('d M');
                        $endFormatted = $endDateTime->format('d M');
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
                    echo $date_text;
                    ?>
                </div>
                <button class="nextWeek px-2 py-1.5 text-gray-500 hover:bg-gray-100">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
            <div class="relative">
                <select class="weekAreaAndTeam px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm">
                    <option selected value="1">Week by Area</option>
                    <option value="2">Week by Team Member</option>
                    <option value="3">Day by Team Member</option>
                </select>
            </div>
            <div class="relative flex-1 md:flex-none">
                <input type="text" name="rosterName" id="rosterName" placeholder="Roster Name" class="w-full px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm" value="<?php echo isset($rosterInfo[0]['rosterName']) ? $rosterInfo[0]['rosterName'] : ''; ?>">
            </div>
        </div>
        <!-- Right Section -->
        <div class="flex items-center gap-2 w-full md:w-auto justify-center md:justify-end">
            <button data-bs-toggle="modal" onclick="showRosterRecreateModal(<?php echo isset($rosterId) ? $rosterId : 0; ?>)" class="px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm hover:bg-gray-50">
                <i class="fa-solid fa-rotate mr-1"></i> Recreate
            </button>
            <button onclick="publishRoster('save')" class="px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm hover:bg-gray-50">
                <i class="fa-regular fa-save mr-1"></i> Save
            </button>
            <button onclick="publishRoster('publish')" class="px-3 py-1.5 bg-primary text-white rounded-lg text-sm hover:bg-primary/90">
                <i class="fa-solid fa-paper-plane mr-1"></i> Publish
            </button>
        </div>
    </div>
</header>

            <!-- Middle Body Section (Schedule Grid) -->
            <div id="schedule-grid" class="flex-1 overflow-auto p-6">
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <!-- Table Header -->
                    <div class="grid grid-cols-8 border-b border-gray-200">
                        <div class="px-4 py-3 font-medium text-gray-500 text-sm bg-gray-50 border-r border-gray-200">Area</div>
                        <?php
                        $currentMonday = date('Y-m-d', strtotime($sdate));
                        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                        foreach ($days as $day) { ?>
                            <div class="px-4 py-3 font-medium text-gray-800 text-sm text-center">
                                <div><?php echo $day; ?></div>
                                <div class="text-gray-500 text-xs"><?php echo date('d/m', strtotime($currentMonday)); ?></div>
                            </div>
                            <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
                        <?php } ?>
                    </div>

                    <!-- Dynamic Areas -->
                    <?php if (isset($prepAreas) && !empty($prepAreas)) { ?>
                        <?php foreach ($prepAreas as $prepArea) { ?>
                            <div id="area-<?php echo $prepArea['id']; ?>">
                                <div class="grid grid-cols-8 border-b border-gray-200">
                                    <div class="px-4 py-3 font-medium text-gray-800 bg-gray-50 border-r border-gray-200 flex items-center justify-between">
                                        <span><?php echo $prepArea['prep_name']; ?></span>
                                        <button class="text-gray-500 hover:text-gray-700" data-bs-toggle="collapse" data-bs-target="#prep_<?php echo $prepArea['id']; ?>">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </button>
                                    </div>
                                    <?php
                                    $currentMonday = date('Y-m-d', strtotime($sdate));
                                    foreach ($days as $day) {
                                        $dayName = strtolower($day);
                                        $dateNumber = date('d', strtotime($currentMonday));
                                        $shiftBoxName = $dateNumber . '_' . $prepArea['id'];
                                    ?>
                                        <div class="p-2 <?php echo $day !== 'Sunday' ? 'border-r border-gray-200' : ''; ?>">
                                            <div class="allocatedEmpShift_<?php echo $shiftBoxName; ?> dragEmployeeBox"></div>
                                            <button class="addShiftForPrep w-full py-1 text-xs text-gray-500 hover:bg-gray-50 rounded border border-dashed border-gray-300" data-shiftBoxName="<?php echo $shiftBoxName; ?>" data-date="<?php echo date('d-m-Y', strtotime($currentMonday)); ?>" data-prepArea="<?php echo $prepArea['prep_name']; ?>" data-prepAreaId="<?php echo $prepArea['id']; ?>">
                                                <i class="fa-solid fa-plus mr-1"></i> Add shift
                                            </button>
                                        </div>
                                        <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Shift Modal -->
    <div class="modal fade" id="addShift-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-gray-100">
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
                                        <i class="fa-regular fa-calendar text-black text-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="d-block fw-semibold mb-0 text-black" id="shift-start-date-tag"></h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="fa-solid fa-map-pin text-black text-lg"></i>
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
                                    <label class="form-label text-sm font-medium">Employees</label>
                                    <select class="simpleSearchSelect w-full border border-gray-300 rounded-lg p-2 text-sm" name="empName-shift" id="empName-shift">
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
                                            <label class="form-label text-sm font-medium">Start Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control timeInput empShiftStartTime border-gray-300 rounded-lg p-2 text-sm" placeholder="Select time">
                                                <small class="text-xs text-gray-500">choose or manually enter time in 12 hrs format (e.g., 9:00 AM)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-medium">End Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control timeInput empShiftEndTime border-gray-300 rounded-lg p-2 text-sm" placeholder="Select time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 addBreakText icon-demo-content">
                                <div class="mb-3">
                                    <i class="fa-solid fa-mug-hot text-green-500 text-lg mt-2"></i>
                                    <span class="text-sm text-black font-semibold"> Add Break </span>
                                </div>
                            </div>
                            <div class="col-12 addBreakTimes d-none" id="breakTime">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-medium">Break Type</label>
                                            <select class="form-select border-gray-300 rounded-lg p-2 text-sm" name="breakType">
                                                <option value="unpaid" selected>Unpaid Break</option>
                                                <option value="paid">Paid Break</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-medium">Break</label>
                                            <select class="form-select border-gray-300 rounded-lg p-2 text-sm" name="breakDuration">
                                                <option value="15">15 Mins</option>
                                                <option value="30">30 Mins</option>
                                                <option value="45">45 Mins</option>
                                                <option value="60">60 Mins</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label text-sm font-medium">Break Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control timeInput empBreakTime border-gray-300 rounded-lg p-2 text-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-4">
                                        <i class="fa-solid fa-trash text-red-500 text-lg deleteBreak cursor-pointer"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-sm font-medium">Shift Tasks</label>
                                    <textarea class="form-control border-gray-300 rounded-lg p-2 text-sm" placeholder="Enter shift task" name="taskDescr" id="shift-note"></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="shiftBoxName" name="shiftBoxName" value="" />
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-soft-danger px-3 py-1.5 text-sm" id="btn-delete-shift" data-bs-dismiss="modal">
                                <i class="fa-solid fa-times align-bottom mr-1"></i> Close
                            </button>
                            <button type="button" class="btn btn-success btnAddShift px-3 py-1.5 text-sm" onclick="addEmpShift()">
                                Add Shift
                            </button>
                            <button type="button" class="btn btn-success btnUpdateShift px-3 py-1.5 text-sm d-none" onclick="updateEmpShift()">
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
                            <input type="text" name="start_date" id="startdatepicker" class="form-control flatpickr-input border-gray-300 rounded-lg p-2 text-sm" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="col-form-label">Roster End Date:</label>
                            <input type="text" name="end_date" id="enddatepicker" class="form-control flatpickr-input border-gray-300 rounded-lg p-2 text-sm" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light px-3 py-1.5 text-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success px-3 py-1.5 text-sm">Recreate</button>
                    </div>
                </form>
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
                $("#empName-shift").prop('disabled', false);
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
                $(".empBreakTime").val('');
            });

            // Initialize time picker
            $('.timeInput').datetimepicker({
                format: 'hh:mm A',
                icons: {
                    up: 'fa-solid fa-chevron-up',
                    down: 'fa-solid fa-chevron-down',
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

            $('.addShiftForPrep').droppable({
                accept: '.dragSourceElement',
                drop: function(event, ui) {
                    let emp_id = ui.draggable.find('.empId').val();
                    let position_id = ui.draggable.find('.position_id').val();
                    let emp_name = ui.draggable.find('.empName').val();
                    let shiftBoxName = $(this).data('shiftboxname');
                    let rosterDate = $(this).data('date');
                    let prepAreaName = $(this).data('preparea');
                    let prepAreaId = $(this).data('prepareaid');

                    $("#empName-shift").val(emp_id);
                    $("#empName-shift").prop('disabled', true);
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
                $("#empName-shift").prop('disabled', true);
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

        function loadRosterFromLocalStorage() {
            for (var key in localStorage) {
                if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
                    let formDataS = localStorage.getItem(key);
                    let formData = JSON.parse(formDataS);

                    formData.empShiftStartTime = convertTo12HourFormat(formData.empShiftStartTime);
                    formData.empShiftEndTime = convertTo12HourFormat(formData.empShiftEndTime);
                    formData.empBreakTime = formData.empBreakTime ? convertTo12HourFormat(formData.empBreakTime) : '';

                    localStorage.setItem(key, JSON.stringify(formData));

                    let shiftBoxName = key.split('_')[1] + '_' + key.split('_')[2];
                    let shiftHtml = '';
                    shiftHtml += '<div class="bg-shift-green p-2 rounded-lg border border-shift-border mb-2" id="' + key + '">';
                    shiftHtml += '<div class="flex justify-between items-start">';
                    shiftHtml += '<span class="font-medium text-sm">' + formData.selectedEmpName + '</span>';
                    shiftHtml += '<button class="text-gray-400 hover:text-red-500 text-xs" onclick="clearStorage(\'' + key + '\', event, this)">';
                    shiftHtml += '<i class="fa-solid fa-times"></i>';
                    shiftHtml += '</button>';
                    shiftHtml += '</div>';
                    shiftHtml += '<div class="text-xs text-gray-600 mt-1">';
                    shiftHtml += '<i class="fa-regular fa-clock mr-1"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime;
                    shiftHtml += '</div>';
                    if (formData.empBreakTime && formData.empBreakTime !== '') {
                        shiftHtml += '<div class="text-xs text-gray-600 mt-1">';
                        shiftHtml += '<i class="fa-solid fa-mug-hot mr-1"></i> Break: ' + formData.empBreakTime;
                        shiftHtml += '</div>';
                    }
                    shiftHtml += '</div>';

                    let boxName = ".allocatedEmpShift_" + shiftBoxName;
                    $(boxName).append(shiftHtml);
                }
            }
        }

        function convertTo12HourFormat(time) {
            if (!time || !time.match(/^\d{2}:\d{2}:\d{2}$/)) {
                return time;
            }

            let [hours, minutes] = time.split(':');
            hours = parseInt(hours, 10);
            let period = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            return `${hours}:${minutes} ${period}`;
        }

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
            shiftHtml += '<div class="bg-shift-green p-2 rounded-lg border border-shift-border mb-2" id="' + keyForStorage + '">';
            shiftHtml += '<div class="flex justify-between items-start">';
            shiftHtml += '<span class="font-medium text-sm">' + formData.selectedEmpName + '</span>';
            shiftHtml += '<button class="text-gray-400 hover:text-red-500 text-xs" onclick="clearStorage(\'' + keyForStorage + '\', event, this)">';
            shiftHtml += '<i class="fa-solid fa-times"></i>';
            shiftHtml += '</button>';
            shiftHtml += '</div>';
            shiftHtml += '<div class="text-xs text-gray-600 mt-1">';
            shiftHtml += '<i class="fa-regular fa-clock mr-1"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime;
            shiftHtml += '</div>';
            if (formData.empBreakTime && formData.empBreakTime !== '') {
                shiftHtml += '<div class="text-xs text-gray-600 mt-1">';
                shiftHtml += '<i class="fa-solid fa-mug-hot mr-1"></i> Break: ' + formData.empBreakTime;
                shiftHtml += '</div>';
            }
            shiftHtml += '</div>';

            let boxName = ".allocatedEmpShift_" + shiftBoxName;
            $(boxName).append(shiftHtml);
            $("#addShift-modal").modal('hide');
            $("#form-shift")[0].reset();
            $(".addBreakTimes").addClass('d-none');
            $(".addBreakText").removeClass('d-none');
        }

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
            shiftHtml += '<div class="bg-shift-green p-2 rounded-lg border border-shift-border mb-2" id="' + storageKey + '">';
            shiftHtml += '<div class="flex justify-between items-start">';
            shiftHtml += '<span class="font-medium text-sm">' + formData.selectedEmpName + '</span>';
            shiftHtml += '<button class="text-gray-400 hover:text-red-500 text-xs" onclick="clearStorage(\'' + storageKey + '\', event, this)">';
            shiftHtml += '<i class="fa-solid fa-times"></i>';
            shiftHtml += '</button>';
            shiftHtml += '</div>';
            shiftHtml += '<div class="text-xs text-gray-600 mt-1">';
            shiftHtml += '<i class="fa-regular fa-clock mr-1"></i>' + formData.empShiftStartTime + ' - ' + formData.empShiftEndTime;
            shiftHtml += '</div>';
            if (formData.empBreakTime && formData.empBreakTime !== '') {
                shiftHtml += '<div class="text-xs text-gray-600 mt-1">';
                shiftHtml += '<i class="fa-solid fa-mug-hot mr-1"></i> Break: ' + formData.empBreakTime;
                shiftHtml += '</div>';
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
            $(clickedElement).parent().parent().remove();
            localStorage.removeItem(keyStorage);
            event.stopPropagation();
        }

        function publishRoster(savetype = 'save') {
            var empData = {};
            $('#loader-overlay').show();
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
                        $('#loader-overlay').hide();
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
                            $('#loader-overlay').hide();
                            alert('Error: ' + (res.message || 'Unknown error'));
                            
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error posting data:", error);
                        $('#loader-overlay').hide();
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
        
        
        document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("loader-overlay").style.display = "none";
    });
    </script>
</body>
</html>