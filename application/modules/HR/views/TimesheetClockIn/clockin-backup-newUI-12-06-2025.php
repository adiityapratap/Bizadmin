<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>window.FontAwesomeConfig = { autoReplaceSvg: 'nest' };</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.materialdesignicons.com/5.9.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">
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
        .highlighted-section {
            outline: 2px solid #3F20FB;
            background-color: rgba(63, 32, 251, 0.1);
        }
        .edit-button {
            position: absolute;
            z-index: 1000;
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <header id="header" class="bg-white shadow-sm py-4 px-6 border-b border-gray-200">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Bizadmin</h1>
                    <p class="text-gray-500 text-sm mt-1">Track employee work hours</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2">
                        <i class="fa-regular fa-calendar text-orange-primary mr-2"></i>
                        <span class="text-sm text-gray-700"><?php echo htmlspecialchars(date('l, F j, Y', strtotime($currentDate))); ?></span>
                    </div>
                    <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2">
                        <i class="fa-solid fa-location-dot text-orange-primary mr-2"></i>
                        <span class="text-sm text-gray-700"><?php echo htmlspecialchars($location_name); ?></span>
                    </div>
                    <div class="relative">
                        <div id="user-icon" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center cursor-pointer">
                            <i class="fa-regular fa-user text-gray-600"></i>
                        </div>
                        <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                            <a class="dropdown-item flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?php echo base_url('auth/logout'); ?>">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto py-6 px-4">
        <section class="mb-6 bg-white rounded-lg shadow-sm p-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input id="search-employee" type="text" placeholder="Search employee..." class="pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-primary text-gray-800">
                        <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <div class="relative">
                        <select id="prep-filter" class="appearance-none pl-4 pr-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 text-gray-800">
                            <option value="">All Outlets</option>
                            <?php foreach ($prepAreas as $area): ?>
                                <option value="<?php echo htmlspecialchars($area['id']); ?>"><?php echo htmlspecialchars($area['prep_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-white border rounded-full cursor-pointer text-gray-700 hover:bg-gray-50 flex items-center">
                        <i class="fa-solid fa-filter mr-2 text-gray-500"></i> Filter
                    </button>
                    <button onclick="location.reload()" class="px-4 py-2 bg-orange-primary text-white rounded-full cursor-pointer hover:bg-orange-600 flex items-center">
                        <i class="fa-solid fa-recycle mr-2"></i> Reload
                    </button>
                </div>
            </div>
        </section>

        <section id="timesheet-table" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="py-3 px-4 text-left font-semibold text-gray-700">Employee</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-700">Outlet</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-700">Clock In</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-700">Break</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-700">Clock Out</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-700">Total Hrs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empLists as $index => $emp): ?>
                            <tr id="employee-<?php echo htmlspecialchars($emp['employee_id']); ?>" class="border-b border-gray-200 hover:bg-gray-50" data-prep-id="<?php echo htmlspecialchars($emp['prep_area_id']); ?>">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <img src="<?php echo htmlspecialchars('https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-' . (($index % 1) + 1) . '.jpg'); ?>" alt="Employee" class="w-10 h-10 rounded-full mr-3">
                                        <div>
                                            <p class="font-medium text-gray-800"><?php echo htmlspecialchars($emp['name']); ?></p>
                                            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($emp['position_name'] ?? 'Not Assigned'); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="text-gray-700"><?php echo htmlspecialchars($emp['prep_name'] ?? 'None'); ?></p>
                                        
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <?php if ($emp['clock_in_time']): ?>
                                        <button class="px-4 py-2 bg-green-primary text-white rounded-full flex items-center clock-in-btn opacity-50 cursor-not-allowed" disabled>
                                            <i class="fa-solid fa-play mr-2"></i>
                                            <?php echo date('h:i A', strtotime($emp['clock_in_time'])); ?>
                                        </button>
                                    <?php else: ?>
                                        <button class="px-4 py-2 bg-green-primary text-white rounded-full hover:bg-green-600 flex items-center clock-in-btn cursor-pointer" data-action="clock_in" onclick="clockAction('<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>', '<?php echo htmlspecialchars($emp['employee_id']); ?>', $(this))">
                                            <i class="fa-solid fa-play mr-2"></i> Clock In
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-4">
                                    <?php if ($emp['latest_break_start_time'] && !$emp['latest_break_end_time']): ?>
                                        <button class="px-4 py-2 bg-sky-primary text-white rounded-full hover:bg-blue-600 flex items-center break-btn cursor-pointer" data-action="break_end" onclick="clockAction('<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>', '<?php echo htmlspecialchars($emp['employee_id']); ?>', $(this))">
                                            <i class="fa-solid fa-pause mr-2"></i> End Break @ <?php echo date('h:i A', strtotime($emp['latest_break_start_time'])); ?>
                                        </button>
                                    <?php else: ?>
                                        <button class="px-4 py-2 bg-sky-primary text-white rounded-full flex items-center break-btn <?php echo $emp['clock_in_time'] && !$emp['clock_out_time'] ? 'hover:bg-blue-600 cursor-pointer' : 'opacity-50 cursor-not-allowed'; ?>" data-action="break_start" onclick="clockAction('<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>', '<?php echo htmlspecialchars($emp['employee_id']); ?>', $(this))" <?php echo $emp['clock_in_time'] && !$emp['clock_out_time'] ? '' : 'disabled'; ?>>
                                            <i class="fa-solid fa-pause mr-2"></i> Start Break
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-4">
                                    <?php if ($emp['clock_out_time']): ?>
                                        <button class="px-4 py-2 bg-orange-primary text-white rounded-full flex items-center clock-out-btn opacity-50 cursor-not-allowed" disabled>
                                            <i class="fa-solid fa-stop mr-2"></i> <?php echo date('h:i A', strtotime($emp['clock_out_time'])); ?>
                                        </button>
                                    <?php elseif ($emp['clock_in_time']): ?>
                                        <button class="px-4 py-2 bg-orange-primary text-white rounded-full hover:bg-orange-600 flex items-center clock-out-btn cursor-pointer" data-action="clock_out" onclick="clockAction('<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>', '<?php echo htmlspecialchars($emp['employee_id']); ?>', $(this))">
                                            <i class="fa-solid fa-stop mr-2"></i> Clock Out
                                        </button>
                                    <?php else: ?>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-500 rounded-full flex items-center clock-out-btn opacity-50 cursor-not-allowed" disabled>
                                            <i class="fa-solid fa-stop mr-2"></i> Clock Out
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center timer">
                                        <?php
                                        if ($emp['clock_in_time'] && $emp['clock_out_time']) {
                                            $diff = strtotime($emp['clock_out_time']) - strtotime($emp['clock_in_time']) - (($emp['actual_break_duration'] ?? 0) * 60);
                                            $hours = floor($diff / 3600);
                                            $minutes = floor(($diff % 3600) / 60);
                                            echo '<i class="fa-regular fa-clock text-gray-500 mr-2"></i>' . sprintf('%d Hours %d Min', max(0, $hours), max(0, $minutes));
                                        } elseif ($emp['clock_in_time']) {
                                            echo '<i class="fa-regular fa-clock text-gray-500 mr-2"></i>Active';
                                        } else {
                                            echo '<i class="fa-regular fa-clock text-gray-500 mr-2"></i>0 Hours';
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: { 
                            "orange-primary": "#ff631a", 
                            "green-primary": "#22b353",
                            "sky-primary": "#1e88e5"
                        },
                        fontFamily: { sans: ["Inter", "sans-serif"] }
                    }
                }
            };

            function clockAction(timesheetId, employeeId, button) {
                var action = button.data('action') || 'unknown';
                var originalContent = button.html();
                button.html('<i class="fa-solid fa-spinner fa-spin mr-2"></i>Loading...').prop('disabled', true);

                console.log('Performing action:', { timesheetId, employeeId, action });

                $.ajax({
                    url: '/HR/timesheet/clock_action',
                    method: 'POST',
                    data: { 
                        timesheet_id: timesheetId, 
                        employee_id: employeeId, 
                        action: action 
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log('AJAX response:', response);
                        if (response.status === 'success') {
                            var row = $('#employee-' + employeeId);
                            if (action === 'clock_in') {
                                button.html('<i class="fa-solid fa-play mr-2"></i>' + response.clock_in_time)
                                    .prop('disabled', true)
                                    .addClass('opacity-50 cursor-not-allowed')
                                    .removeClass('hover:bg-green-600');
                                row.find('.clock-out-btn')
                                    .prop('disabled', false)
                                    .removeClass('opacity-50 cursor-not-allowed bg-gray-200 text-gray-500')
                                    .addClass('hover:bg-orange-600 bg-orange-primary text-white');
                                row.find('.break-btn')
                                    .prop('disabled', false)
                                    .removeClass('opacity-50 cursor-not-allowed')
                                    .addClass('hover:bg-blue-600 bg-sky-primary text-white')
                                    .data('action', 'break_start');
                                    updateTimer(row, response.clock_in_time, null, 0);
                            } else if (action === 'clock_out') {
                                button.html('<i class="fa-solid fa-stop mr-2"></i>' + response.clock_out_time)
                                    .prop('disabled', true)
                                    .addClass('opacity-50 cursor-not-allowed')
                                    .removeClass('hover:bg-orange-600');
                                row.find('.clock-in-btn')
                                    .prop('disabled', true)
                                    .addClass('opacity-50 cursor-not-allowed')
                                    .removeClass('hover:bg-green-600');
                                row.find('.break-btn')
                                    .prop('disabled', true)
                                    .addClass('opacity-50 cursor-not-allowed')
                                    .removeClass('hover:bg-blue-600 ')
                                    .data('action', 'break_start');
                                updateTimer(row, response.clock_in_time || row.find('.clock-in-btn').text().replace(/.*\s/, ''), response.clock_out_time, response.break_duration || 0);
                            } else if (action === 'break_start') {
                                button.html('<i class="fa-solid fa-pause mr-2"></i>End Break ' + response.break_start_time)
                                    .data('action', 'break_end')
                                    .prop('disabled', false)
                                    .removeClass('opacity-50 cursor-not-allowed')
                                    .addClass('hover:bg-blue-600 bg-sky-primary');
                                    updateTimer(row, row.find('.clock-in-btn').text().replace(/.*\s/, ''), null, response.break_duration || 0);
                            } else if (action === 'break_end') {
                                button.html('<i class="fa-solid fa-pause mr-2"></i>Start Break')
                                    .data('action', 'break_start')
                                    .prop('disabled', false)
                                    .removeClass('opacity-50 cursor-not-allowed')
                                    .addClass('hover:bg-blue-600 bg-sky-primary');
                                updateTimer(row, row.find('.clock-in-btn').text().replace(/.*\s/, ''), null, response.break_duration || 0);
                            }
                        } else {
                            alert('Error: ' + response.message);
                            button.html(originalContent)
                                .prop('disabled', false)
                                .removeClass('opacity-50 cursor-not-allowed');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', { xhr, status, error });
                        alert('Failed to perform action');
                        button.html(originalContent)
                            .prop('disabled', false)
                            .removeClass('opacity-50 cursor-not-allowed');
                    }
                });
            }

            function updateTimer(row, clockIn, clockOut, breakDuration) {
                if (clockIn && clockOut) {
                    // Normalize time formats (e.g., "10:00 AM" to "10:00AM")
                    let normalizedClockIn = clockIn.replace(/\s/g, '');
                    let normalizedClockOut = clockOut.replace(/\s/g, '');
                    let clockInTime = new Date('1970-01-01T' + normalizedClockIn);
                    let clockOutTime = new Date('1970-01-01T' + normalizedClockOut);

                    console.log('Timer inputs:', { clockIn, clockOut, normalizedClockIn, normalizedClockOut, breakDuration });

                    if (isNaN(clockInTime.getTime()) || isNaN(clockOutTime.getTime())) {
                        console.error('Invalid date parsing:', { clockIn, clockOut });
                        row.find('.timer').html('<i class="fa-regular fa-clock text-gray-500 mr-2"></i>');
                        return;
                    }

                    let diff = (clockOutTime - clockInTime) / 1000 - ((breakDuration || 0) * 60);
                    let hours = Math.floor(diff / 3600);
                    let minutes = Math.floor((diff % 3600) / 60);

                    if (hours < 0 || minutes < 0) {
                        console.warn('Negative duration:', { hours, minutes });
                        row.find('.timer').html('<i class="fa-regular fa-clock text-gray-500 mr-2"></i>0 Hours');
                        return;
                    }

                    row.find('.timer').html(`<i class="fa-regular fa-clock text-gray-500 mr-2"></i>${hours} Hours ${minutes} Min`);
                } else if (clockIn) {
                    row.find('.timer').html('<i class="fa-regular fa-clock text-gray-500 mr-2"></i>Active');
                } else {
                    row.find('.timer').html('<i class="fa-regular fa-clock text-gray-500 mr-2"></i>0 Hours');
                }
            }

            $(document).ready(function() {
                $('#prep-filter').change(function() {
                    var prepId = $(this).val();
                    $('tbody tr').each(function() {
                        var rowPrepId = $(this).data('prep-id') || '';
                        $(this).toggle(prepId === '' || rowPrepId === prepId);
                    });
                });

                $('#search-employee').on('input', function() {
                    var search = $(this).val().toLowerCase();
                    $('tbody tr').each(function() {
                        var name = $(this).find('td:first p:first').text().toLowerCase();
                        $(this).toggle(name.includes(search));
                    });
                });

                $('#user-icon').on('click', function(e) {
                    e.stopPropagation();
                    $('#user-dropdown').toggleClass('hidden');
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('#user-icon, #user-dropdown').length) {
                        $('#user-dropdown').addClass('hidden');
                    }
                });

                $('#user-dropdown a').on('click', function() {
                    $('#user-dropdown').addClass('hidden');
                });
            });
        </script>
        
        
    </footer>
</body>
</html>