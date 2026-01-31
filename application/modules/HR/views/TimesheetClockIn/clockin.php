<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bizadmn Clockin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.materialdesignicons.com/5.9.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif !important; }
        .fa, .fas, .far, .fal, .fab { font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important; }
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }
        .highlighted-section { outline: 2px solid #3F20FB; background-color: rgba(63, 32, 251, 0.1); }
        .edit-button { position: absolute; z-index: 1000; }
        .pinpad-btn { width: 60px; height: 60px; font-size: 1.2rem; }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <header id="header" class="bg-white py-2 px-6 border-b border-gray-200">
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

    <main class="container-fluid mx-auto py-6 px-4">
        <!-- PIN Verification Modal -->
        <div class="modal fade" id="pinVerificationModal" tabindex="-1" aria-labelledby="pinVerificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:330px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pinVerificationModalLabel">Enter PIN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="pinError" class="alert alert-danger d-none" role="alert"></div>
                        <input type="password" id="pinInput" class="form-control mb-3" placeholder="Enter your PIN">
                        <div class="d-grid gap-2 pinpad">
                            <div class="row g-2">
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="1">1</button></div>
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="2">2</button></div>
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="3">3</button></div>
                            </div>
                            <div class="row g-2">
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="4">4</button></div>
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="5">5</button></div>
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="6">6</button></div>
                            </div>
                            <div class="row g-2">
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="7">7</button></div>
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="8">8</button></div>
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="9">9</button></div>
                            </div>
                            <div class="row g-2">
                                <div class="col-4"><button class="btn btn-outline-secondary pinpad-btn" data-value="0">0</button></div>
                                <div class="col-4"><button class="btn btn-danger" id="pinClear">Clear</button></div>
                                <div class="col-4"><button class="btn btn-success" id="pinSubmit">Submit</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
            
              <video id="clockVideo" style="display: none;" autoplay></video>
            <div class="overflow-x-auto">
                <?php if(isset($empLists) && !empty($empLists)) {  ?>
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
                                        <!--<img src="<?php echo htmlspecialchars('https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-' . (($index % 1) + 1) . '.jpg'); ?>" alt="Employee" class="w-10 h-10 rounded-full mr-3">-->
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
                                        <button class="px-3 py-2 bg-green-primary text-white rounded-full flex items-center clock-in-btn opacity-50 cursor-not-allowed" disabled>
                                            <i class="fa-solid fa-play mr-2"></i>
                                            <?php echo date('h:i A', strtotime($emp['clock_in_time'])); ?>
                                        </button>
                                    <?php else: ?>
                                        <button class="px-3 py-2 bg-green-primary text-white rounded-full hover:bg-green-600 flex items-center clock-in-btn cursor-pointer" data-action="clock_in" data-employee-id="<?php echo htmlspecialchars($emp['employee_id']); ?>" data-timesheet-id="<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>">
                                            <i class="fa-solid fa-play mr-2"></i> Clock In
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4">
    <?php if ($emp['latest_break_start_time'] && !$emp['latest_break_end_time']): ?>
        <button class="px-3 py-2 bg-sky-primary text-white rounded-full hover:bg-blue-600 flex items-center break-btn cursor-pointer" data-action="break_end" data-employee-id="<?php echo htmlspecialchars($emp['employee_id']); ?>" data-timesheet-id="<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>">
            <i class="fa-solid fa-pause mr-2"></i> End Break @ <?php echo htmlspecialchars(date('h:i A', strtotime($emp['latest_break_start_time']))); ?>
        </button>
    <?php else: ?>
        <button class="px-3 py-2 bg-sky-primary text-white rounded-full flex items-center break-btn <?php echo $emp['clock_in_time'] && !$emp['clock_out_time'] ? 'hover:bg-blue-600 cursor-pointer' : 'opacity-50 cursor-not-allowed'; ?>" data-action="break_start" data-employee-id="<?php echo htmlspecialchars($emp['employee_id']); ?>" data-timesheet-id="<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>" <?php echo $emp['clock_in_time'] && !$emp['clock_out_time'] ? '' : 'disabled'; ?>>
            <i class="fa-solid fa-pause mr-2"></i> Start Break
        </button>
    <?php endif; ?>
</td>
                                <td class="py-4 px-4">
                                    <?php if ($emp['clock_out_time']): ?>
                                        <button class="px-3 py-2 bg-orange-primary text-white rounded-full flex items-center clock-out-btn opacity-50 cursor-not-allowed" disabled data-action="clock_out" data-employee-id="<?php echo htmlspecialchars($emp['employee_id']); ?>" data-timesheet-id="<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>">
                                            <i class="fa-solid fa-stop mr-2"></i> <?php echo date('h:i A', strtotime($emp['clock_out_time'])); ?>
                                        </button>
                                    <?php elseif ($emp['clock_in_time']): ?>
                                        <button class="px-3 py-2 bg-orange-primary text-white rounded-full hover:bg-orange-600 flex items-center clock-out-btn cursor-pointer" data-action="clock_out" data-employee-id="<?php echo htmlspecialchars($emp['employee_id']); ?>" data-timesheet-id="<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>">
                                            <i class="fa-solid fa-stop mr-2"></i> Clock Out
                                        </button>
                                    <?php else: ?>
                                        <button class="px-3 py-2 bg-gray-200 text-gray-500 rounded-full flex items-center clock-out-btn opacity-50 cursor-not-allowed" data-action="clock_out" disabled data-employee-id="<?php echo htmlspecialchars($emp['employee_id']); ?>" data-timesheet-id="<?php echo htmlspecialchars($emp['timesheet_id'] ?: 0); ?>">
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
                <?php } else {  ?>
                        <h5><button id="info-button" class="w-6 h-6 bg-red-800 hover:bg-red-800 text-white rounded-full flex items-center justify-center">
                    <i class="text-sm" data-fa-i2svg=""><svg class="svg-inline--fa fa-info" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg=""><path fill="currentColor" d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path></svg></i>
                </button> No employee exist for today's date.Please check roaster for the date <?php echo date('d-m-y'); ?></h5>
                        <?php }  ?>
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

            // Global variable to store pending action
            let pendingAction = null;
            
          
// Modified clockAction function
function clockAction(timesheetId, employeeId, button) {
    const action = button.data('action') || 'unknown';
    const isFaceVerification = <?php echo json_encode((isset($generalConfigData) && isset($generalConfigData['feature_toggle']) && $generalConfigData['feature_toggle'] === '1') ? true : false); ?>;
    const originalContent = button.html(); // Store original content
    
    // Store pending action and show loader immediately
    pendingAction = { timesheetId, employeeId, button, action, originalContent };
    button.html('<i class="fa-solid fa-spinner fa-spin mr-2"></i>Verifying...').prop('disabled', true);
    
    if (isFaceVerification) {
        verifyFace(employeeId, (success) => {
            if (success) {
                performClockAction(timesheetId, employeeId, button, action);
            } else {
                button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
            }
        });
    } else {
        $('#pinInput').val('');
        $('#pinError').addClass('d-none');
        const modal = new bootstrap.Modal(document.getElementById('pinVerificationModal'));
        modal.show();
    }
}

// Modified verifyPin function
function verifyPin(employeeId, pin, callback) {
    const { button, originalContent } = pendingAction;
    $.ajax({
        url: '<?= base_url('HR/timesheet/verifyPin') ?>',
        method: 'POST',
        data: { employee_id: employeeId, pin: pin },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                callback(true);
            } else {
                $('#pinError').text(response.message).removeClass('d-none');
                button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
                callback(false);
            }
        },
        error: function() {
            $('#pinError').text('Failed to verify PIN. Please try again.').removeClass('d-none');
            button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
            callback(false);
        }
    });
}

// Modified verifyFace function
function verifyFace(employeeId, callback) {
    const { button, originalContent } = pendingAction;
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            const video = document.getElementById('clockVideo');
            video.srcObject = stream;
            video.style.display = 'block';
            setTimeout(() => {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                const base64Image = canvas.toDataURL('image/jpeg');
                stream.getTracks().forEach(track => track.stop());
                video.style.display = 'none';

                $.ajax({
                    url: '<?= base_url('HR/timesheet/verifyFace') ?>',
                    method: 'POST',
                    data: JSON.stringify({ employee_id: employeeId, captured_image: base64Image }),
                    contentType: 'application/json',
                    success: function(response) {
                        if (response.status === 'success') {
                            callback(true);
                        } else {
                            alert('Face verification failed: ' + response.message);
                            button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
                            callback(false);
                        }
                    },
                    error: function() {
                        alert('Failed to verify face. Please try again.');
                        button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
                        callback(false);
                    }
                });
            }, 1500);
        })
        .catch(error => {
            alert('Unable to access camera. Please check permissions.');
            button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
            callback(false);
        });
}

function performClockAction(timesheetId, employeeId, button, action) {
    const originalContent = button.html();
    button.html('<i class="fa-solid fa-spinner fa-spin mr-2"></i>Loading...').prop('disabled', true);

    // Capture geolocation for clock in and clock out actions
    if (action === 'clock_in' || action === 'clock_out') {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    
                    // Reverse geocode to get address
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                        .then(response => response.json())
                        .then(data => {
                            const address = data.display_name || 'Address not available';
                            sendClockActionRequest(timesheetId, employeeId, action, button, originalContent, latitude, longitude, address);
                        })
                        .catch(error => {
                            console.error('Error getting address:', error);
                            sendClockActionRequest(timesheetId, employeeId, action, button, originalContent, latitude, longitude, 'Address not available');
                        });
                },
                function(error) {
                    console.error('Geolocation error:', error);
                    alert('Unable to get your location. Please enable location services.');
                    button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            alert('Geolocation is not supported by your browser.');
            button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
        }
    } else {
        // For break actions, no location needed
        sendClockActionRequest(timesheetId, employeeId, action, button, originalContent);
    }
}

function sendClockActionRequest(timesheetId, employeeId, action, button, originalContent, latitude = null, longitude = null, address = null) {
    const requestData = { 
        timesheet_id: timesheetId, 
        employee_id: employeeId, 
        action: action 
    };
    
    // Add location data if available
    if (latitude !== null && longitude !== null) {
        requestData.latitude = latitude;
        requestData.longitude = longitude;
        requestData.address = address;
    }

    $.ajax({
        url: '/HR/timesheet/clock_action',
        method: 'POST',
        data: requestData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const row = $('#employee-' + employeeId);
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
                        .removeClass('hover:bg-blue-600')
                        .data('action', 'break_start');
                    // Fetch clock-in time from button and ensure proper format
                    const clockInTime = row.find('.clock-in-btn').text().replace(/.*\s/, '').trim();
                    updateTimer(row, clockInTime, response.clock_out_time, response.break_duration || 0);
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
                button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
            }
        },
        error: function(xhr, status, error) {
            alert('Failed to perform action');
            button.html(originalContent).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
        }
    });
}

function updateTimer(row, clockIn, clockOut, breakDuration) {
    if (clockIn && clockOut) {
        // Normalize time formats (e.g., "10:30 AM" to "10:30AM")
        let normalizedClockIn = clockIn.replace(/\s+/g, '');
        let normalizedClockOut = clockOut.replace(/\s+/g, '');
        
        // Parse times with AM/PM
        let clockInTime = new Date('1970-01-01 ' + normalizedClockIn);
        let clockOutTime = new Date('1970-01-01 ' + normalizedClockOut);

        if (isNaN(clockInTime.getTime()) || isNaN(clockOutTime.getTime())) {
            console.error('Invalid date parsing:', { clockIn, clockOut, normalizedClockIn, normalizedClockOut });
            row.find('.timer').html('<i class="fa-regular fa-clock text-gray-500 mr-2"></i>0 Hours');
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
        var prepId = $(this).val().toString(); // Ensure prepId is a string
        $('tbody tr').each(function() {
            var rowPrepId = $(this).data('prep-id') ? $(this).data('prep-id').toString() : '';
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

    // PIN pad functionality
    $('.pinpad-btn').click(function() {
        const value = $(this).data('value');
        const currentPin = $('#pinInput').val();
        $('#pinInput').val(currentPin + value);
    });

    $('#pinClear').click(function() {
        $('#pinInput').val('');
        $('#pinError').addClass('d-none');
    });

    $('#pinSubmit').click(function() {
        const pin = $('#pinInput').val();
        $('#pinSubmit').html("Verifying...")
        if (pin.length === 0) {
            $('#pinError').text('Please enter a PIN').removeClass('d-none');
            $('#pinSubmit').html("Submit")
            return;
        }
        
        console.log("pendingAction",pendingAction)

        verifyPin(pendingAction.employeeId, pin, (success) => {
             $('#pinSubmit').html("Submit");
            if (success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('pinVerificationModal'));
                modal.hide();
                performClockAction(pendingAction.timesheetId, pendingAction.employeeId, pendingAction.button, pendingAction.action);
            }
           
        });
    });

    // Handle modal close event (cross icon or outside click)
    $('#pinVerificationModal').on('hidden.bs.modal', function () {
        if (pendingAction && pendingAction.button) {
            pendingAction.button.html(pendingAction.originalContent)
                .prop('disabled', false)
                .removeClass('opacity-50 cursor-not-allowed');
            pendingAction = null; // Clear pending action
        }
        $('#pinSubmit').html("Submit")
        $('#pinInput').val('');
        $('#pinError').addClass('d-none');
        
    });

    // Attach click handlers to buttons
    $('.clock-in-btn, .break-btn, .clock-out-btn').click(function() {
        if (!$(this).prop('disabled')) {
            clockAction($(this).data('timesheet-id'), $(this).data('employee-id'), $(this));
        }
    });
});
        </script>
    </footer>
</body>
</html>

