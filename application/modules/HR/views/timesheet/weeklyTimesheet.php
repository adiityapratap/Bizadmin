<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        window.FontAwesomeConfig = { autoReplaceSvg: 'nest' };
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "sans-serif"]
                    },
                    colors: {
                        primary: {
                            50: "#f0f9ff",
                            100: "#e0f2fe",
                            500: "#0ea5e9",
                            600: "#0284c7",
                            700: "#0369a1"
                        },
                        success: "#10B981",
                        warning: "#F59E0B"
                    }
                }
            }
        };
    </script>
   
 
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { display: none; }
        .highlighted-section {
            outline: 2px solid #3F20FB;
            background-color: rgba(63, 32, 251, 0.1);
        }
        .edit-button {
            position: absolute;
            z-index: 1000;
        }
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;500;600;700;800;900&display=swap">
</head>
<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content custom-page-content">
                <div class="custom-container">
                    <div class="flex h-screen overflow-hidden">
                        <!-- Sidebar -->
                        <aside id="sidebar" class="w-72 bg-white border-r border-gray-200 overflow-y-auto">
                            <div class="p-4">
                                <div class="relative">
                                    <input type="text" id="member-search" placeholder="Search members..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                            </div>
                            <div class="px-4 py-2">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs font-medium text-gray-500 uppercase">Team Members</span>
                                    <span class="text-xs text-gray-500"><?php echo count(array_unique(array_column($timesheets, 'employee_id'))); ?> members</span>
                                </div>
                            </div>
                            <ul id="team-members-list" class="space-y-1">
                                <?php
                                $employee_timesheets = [];
                                foreach ($timesheets as $timesheet) {
                                    $employee_timesheets[$timesheet['employee_id']][] = $timesheet;
                                }
                                $avatar_colors = ['bg-primary-600', 'bg-green-600', 'bg-purple-600', 'bg-amber-600', 'bg-rose-600', 'bg-blue-600'];
                                $color_index = 0;
                                foreach ($employee_timesheets as $employee_id => $timesheets) {
                                    // echo "<pre>"; print_r($employee_timesheets); exit;
                                    $employee_name = $timesheets[0]['employee_name'];
                                    $total_hours = 0;
                                  
                                    foreach ($timesheets as $ts) {
                                        
                                       list($hours, $minutes, $seconds) = explode(':', $ts['total_hours']);
                                       $h = is_numeric($hours) ? (int)$hours : 0;
                                       $m = is_numeric($minutes) ? (int)$minutes : 0;
                                       $s = is_numeric($seconds) ? (int)$seconds : 0;
                                       $total_hours += ($h * 3600) + ($m * 60) + $s;
                                       
                                    }
                                    $total_break = array_sum(array_column($timesheets, 'total_break_duration'));
                                    
                                    if ($total_hours > 0) {
                                     $net_seconds = $total_hours - ($total_break * 60); // subtract break in seconds
                                     $hours = floor($net_seconds / 3600);
                                     $minutes = floor(($net_seconds % 3600) / 60);
                                     $formatted_hours = "{$hours} hrs {$minutes} min";
                                     } else {
                                      $formatted_hours = "0 hrs 0 min";
                                    }
                                    
                                    $timesheet_count = count($timesheets);
                                    $avatar_color = $avatar_colors[$color_index % count($avatar_colors)];
                                    $color_index++;
                                    $is_active = $color_index === 1 ? 'border-primary-500' : 'border-transparent';
                                    

                                   
                                ?>
                                <li class="px-3 py-2 hover:bg-gray-50 cursor-pointer border-l-4 <?php echo $is_active; ?> employee-item" data-employee-id="<?php echo $employee_id; ?>" data-employee-name="<?php echo strtolower($employee_name); ?>">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full <?php echo $avatar_color; ?> flex items-center justify-center text-white font-medium flex-shrink-0">
                                            <?php echo strtoupper(substr($employee_name, 0, 2)); ?>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-800"><?php echo $employee_name; ?></span>
                                                <span class="text-xs text-gray-500"><?php echo $formatted_hours; ?></span>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <?php echo $timesheet_count; ?> | <?php echo $formatted_hours; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </aside>

                        <!-- Main Content -->
                        <div id="main-content" class="flex-1 overflow-y-auto">
                            <!-- Filter Bar -->
                            <div id="filter-bar" class="bg-white border-b border-gray-200 p-4">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <div class="relative">
                                            <select id="status-filter" class="appearance-none bg-white border border-gray-300 rounded-md pl-10 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 min-w-[180px]">
                                                <option value="all">All Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="approved">Approved</option>
                                            </select>
                                            <i class="fa-solid fa-filter absolute left-3 top-2.5 text-gray-400"></i>
                                            <i class="fa-solid fa-chevron-down absolute right-3 top-2.5 text-gray-400 text-xs"></i>
                                        </div>
                                        <div class="relative">
                                            <button class="flex items-center bg-white border border-gray-300 rounded-md pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 min-w-[220px]">
                                                <span><?php echo date('D d M', strtotime($start_date)) . ' - ' . date('D d M', strtotime($end_date)); ?></span>
                                                <i class="fa-solid fa-calendar ml-2 text-gray-400"></i>
                                            </button>
                                            <i class="fa-solid fa-calendar-days absolute left-3 top-2.5 text-gray-400"></i>
                                        </div>
                                        <div class="relative">
                                            <select class="appearance-none bg-white border border-gray-300 rounded-md pl-10 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 min-w-[200px]">
                                                <option>All Preps</option>
                                              <?php if(isset($prepAreaLists) && !empty($prepAreaLists)) {  ?>
                                              <?php  foreach($prepAreaLists as $prepAreaList) {  ?>
                                              <option <?php echo $prepAreaList['id'] ?>><?php echo $prepAreaList['prep_name'] ?></option>
                                              <?php }  ?>
                                              <?php }  ?>
                                            </select>
                                            <i class="fa-solid fa-layer-group absolute left-3 top-2.5 text-gray-400"></i>
                                            <i class="fa-solid fa-chevron-down absolute right-3 top-2.5 text-gray-400 text-xs"></i>
                                        </div>
                                        <button class="p-2 text-gray-500 hover:text-gray-700 border border-gray-300 rounded-md bg-white">
                                            <i class="fa-solid fa-sliders"></i>
                                        </button>
                                    </div>
                                    <button class="bg-primary-600 hover:bg-primary-700 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Add Timesheet
                                    </button>
                                </div>
                            </div>

                            <!-- Timesheet Summary -->
                            <div id="timesheet-summary">
                                <div class="bg-white  mb-2">
                                    <div class="p-4">
                                        <div class="flex flex-wrap items-center">
                                            <div>
                                                <h2 class="text-lg font-medium text-gray-800 text-black">Timesheets Summary</h2>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>

                                <!-- Timesheet Groups -->
                                <?php
                                $color_index = 0;
                                foreach ($employee_timesheets as $employee_id => $timesheets) {
                                    $employee_name = $timesheets[0]['employee_name'];
                                    $employee_type = $timesheets[0]['employee_type'] ? " ({$timesheets[0]['employee_type']})" : '';
                                    $total_hours = 0;
                                  
                                    foreach ($timesheets as $ts) {
                                        
                                       list($hours, $minutes, $seconds) = explode(':', $ts['total_hours']);
                                       $h = is_numeric($hours) ? (int)$hours : 0;
                                       $m = is_numeric($minutes) ? (int)$minutes : 0;
                                       $s = is_numeric($seconds) ? (int)$seconds : 0;
                                       $total_hours += ($h * 3600) + ($m * 60) + $s;
                                       
                                    }
                                    $total_break = array_sum(array_column($timesheets, 'total_break_duration'));
                                    
                                    if ($total_hours > 0) {
                                     $net_seconds = $total_hours - ($total_break * 60); // subtract break in seconds
                                     $hours = floor($net_seconds / 3600);
                                     $minutes = floor(($net_seconds % 3600) / 60);
                                     $formatted_hours = "{$hours} hrs {$minutes} min";
                                     } else {
                                      $formatted_hours = "0 hrs 0 min";
                                    }
                                    $timesheet_count = count($timesheets);
                                    $avatar_color = $avatar_colors[$color_index % count($avatar_colors)];
                                    $color_index++;
                                    $all_approved = true;
                                    foreach ($timesheets as $ts) {
                                        if ($ts['approval_status'] !== 'approved') {
                                            $all_approved = false;
                                            break;
                                        }
                                    }
                                   
                                ?>
                                <div id="timesheet-group-<?php echo $employee_id; ?>" class="bg-white rounded-lg border border-gray-200 mb-6 overflow-hidden employee-group" data-employee-id="<?php echo $employee_id; ?>" data-employee-name="<?php echo strtolower($employee_name); ?>">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 border-b border-gray-200 cursor-pointer" onclick="toggleSection('timesheet-<?php echo $employee_id; ?>')">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full <?php echo $avatar_color; ?> flex items-center justify-center text-white font-medium mr-3">
                                                <?php echo strtoupper(substr($employee_name, 0, 2)); ?>
                                            </div>
                                            <div>
                                                <h3 class="text-base font-medium text-gray-800 text-black"><?php echo $employee_name . $employee_type; ?></h3>
                                                <p class="text-sm text-gray-500"><?php echo $timesheet_count; ?> timesheets, <?php echo $formatted_hours; ?> total</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <?php if (!$all_approved): ?>
                                            <button onclick="approveEmployee(<?php echo $employee_id; ?>, '<?php echo $start_date; ?>', '<?php echo $end_date; ?>')" data-emp-id="<?php echo $employee_id; ?>" class="bg-success text-white px-3 py-1 rounded-md text-sm flex items-center space-x-2 approve-btn">
                                                <i class="fa-solid fa-check"></i>
                                                <span>Approve </span>
                                            </button>
                                            <?php endif; ?>
                                            <i id="timesheet-<?php echo $employee_id; ?>-chevron" class="fa-solid fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div id="timesheet-<?php echo $employee_id; ?>">
                                        <?php foreach ($timesheets as $timesheet): ?>
                                        <div class="p-4 border-b border-gray-200 hover:bg-gray-50 timesheet-item" data-status="<?php echo $timesheet['approval_status']; ?>">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-2">
                                                        <span class="text-sm font-medium text-gray-800 mr-2"><?php echo date('l, d M Y', strtotime($timesheet['roster_date'])); ?></span>
                                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-<?php echo $timesheet['approval_status'] == 'approved' ? 'success' : 'danger'; ?>-subtle text-<?php echo $timesheet['approval_status'] == 'approved' ? 'success' : 'danger'; ?>">
                                                            <?php echo ucfirst($timesheet['approval_status']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="flex flex-wrap gap-4">
                                                        <div class="flex items-center text-sm text-gray-600">
    <i class="fa-regular fa-clock mr-1.5"></i>
    <span 
        onclick="editTime(<?php echo $timesheet['timesheet_id']; ?>, 'clock_in_time', '<?php echo $timesheet['clock_in_time']; ?>')" 
        class="cursor-pointer hover:underline">
        <?php 
        echo (!empty($timesheet['clock_in_time']) && strtotime($timesheet['clock_in_time'])) 
            ? date('h:i A', strtotime($timesheet['clock_in_time'])) 
            : '';
        ?>
    </span> – 
    <span 
        onclick="editTime(<?php echo $timesheet['timesheet_id']; ?>, 'clock_out_time', '<?php echo $timesheet['clock_out_time']; ?>')" 
        class="cursor-pointer hover:underline">
        <?php 
        echo (!empty($timesheet['clock_out_time']) && strtotime($timesheet['clock_out_time'])) 
            ? date('h:i A', strtotime($timesheet['clock_out_time'])) 
            : '';
        ?>
    </span>
</div>

                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fa-solid fa-coffee mr-1.5"></i>
                                                         <span><?php echo ($timesheet['total_break_duration'] ?? 0) > 0 ? $timesheet['total_break_duration'] . ' Mins' : '00 min'; ?></span>
                                                        </div>
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fa-regular fa-clock mr-1.5"></i>
                                                            <span><?php echo $formatted_hours; ?></span>
                                                        </div>
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fa-solid fa-building mr-1.5"></i>
                                                            <span><?php echo $timesheet['prep_name'] . ', ' . $timesheet['position_name']; ?></span>
                                                        </div>
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fa-regular fa-calendar mr-1.5"></i>
                                                            <span>Roster: <?php echo $timesheet['shift_start_time'] ? date('h:i A', strtotime($timesheet['shift_start_time'])) : '-'; ?> – <?php echo $timesheet['shift_end_time'] ? date('h:i A', strtotime($timesheet['shift_end_time'])) : '-'; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                   
                                                    <button class="text-gray-500 hover:text-gray-700 p-1">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSection(id) {
            const section = document.getElementById(id);
            const chevron = document.getElementById(id + '-chevron');
            if (section.classList.contains('hidden')) {
                section.classList.remove('hidden');
                chevron.classList.remove('fa-chevron-up');
                chevron.classList.add('fa-chevron-down');
            } else {
                section.classList.add('hidden');
                chevron.classList.remove('fa-chevron-down');
                chevron.classList.add('fa-chevron-up');
            }
        }

        function editTime(timesheetId, field, currentValue) {
            let newValue = prompt(`Enter new ${field.replace('_', ' ')}:`, currentValue);
            if (newValue) {
                let $btn = $(`[onclick="editTime(${timesheetId}, '${field}', '${currentValue}')"]`);
                let originalHtml = $btn.html();
                $btn.html('<svg class="animate-spin h-5 w-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Saving...')
                    .prop('disabled', true);
                $.ajax({
                    url: '/HR/timesheet/update_timesheet',
                    type: 'POST',
                    data: {
                        timesheet_id: timesheetId,
                        [field]: newValue
                    },
                    success: function(response) {
                        let result = JSON.parse(response);
                        alert(result.message);
                        if (result.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Error updating timesheet');
                    },
                    complete: function() {
                        $btn.html(originalHtml).prop('disabled', false);
                    }
                });
            }
        }

        function approveEmployee(employeeId, startDate, endDate) {
            if (confirm('Are you sure you want to approve all timesheets for this employee?')) {
                let $btn = $('[data-emp-id="' + employeeId + '"].approve-btn');
                let originalHtml = $btn.html();
                $btn.html('<svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Approving...')
                    .prop('disabled', true);
                $.ajax({
                    url: '/HR/timesheet/approve_employee_timesheets',
                    type: 'POST',
                    data: {
                        employee_id: employeeId,
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        let result = JSON.parse(response);
                        alert(result.message);
                        if (result.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Error approving timesheets');
                    },
                    complete: function() {
                        $btn.html(originalHtml).prop('disabled', false);
                    }
                });
            }
        }

        function approveSingle(timesheetId) {
            if (confirm('Are you sure you want to approve this timesheet?')) {
                let $btn = $('[data-timesheet-id="' + timesheetId + '"].single-approve-btn');
                let originalHtml = $btn.html();
                $btn.html('<svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Approving...')
                    .prop('disabled', true);
                $.ajax({
                    url: '/HR/timesheet/approve_single_timesheet',
                    type: 'POST',
                    data: {
                        timesheet_id: timesheetId
                    },
                    success: function(response) {
                        let result = JSON.parse(response);
                        alert(result.message);
                        if (result.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Error approving timesheet');
                    },
                    complete: function() {
                        $btn.html(originalHtml).prop('disabled', false);
                    }
                });
            }
        }

        $(document).ready(function() {
            // Employee search functionality
            $('#member-search').on('input', function() {
                let searchTerm = $(this).val().toLowerCase().trim();
                $('.employee-item').each(function() {
                    let employeeName = $(this).data('employee-name');
                    let matches = searchTerm === '' || employeeName.includes(searchTerm);
                    $(this).toggle(matches);
                });
                $('.employee-group').each(function() {
                    let employeeName = $(this).data('employee-name');
                    let matches = searchTerm === '' || employeeName.includes(searchTerm);
                    $(this).toggle(matches);
                });
            });

            // Status filter functionality
            $('#status-filter').on('change', function() {
                let status = $(this).val();
                $('.employee-group').each(function() {
                    let $group = $(this);
                    let $timesheets = $group.find('.timesheet-item');
                    let hasMatchingTimesheet = false;
                    $timesheets.each(function() {
                        let timesheetStatus = $(this).data('status');
                        if (status === 'all' || timesheetStatus === status) {
                            hasMatchingTimesheet = true;
                        }
                    });
                    $group.toggle(hasMatchingTimesheet);
                });
                // Update sidebar to show only employees with matching timesheets
                $('.employee-item').each(function() {
                    let employeeId = $(this).data('employee-id');
                    let $group = $('#timesheet-group-' + employeeId);
                    $(this).toggle($group.is(':visible'));
                });
            });
        });
    </script>
</body>
</html>