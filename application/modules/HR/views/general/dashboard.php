<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> window.FontAwesomeConfig = { autoReplaceSvg: 'nest'};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>::-webkit-scrollbar { display: none;}</style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgb(31, 58, 95)',
                        teal: '#6EC1C2',
                        orange: '#F29A6E',
                        neutralgray: '#E7EAF0'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F4F6F9] font-inter">


<main class="max-w-[1920px] mx-auto px-6 py-8 mt-5">
    <div class="grid grid-cols-12 gap-6">
        
      <?php
$w = $employeeProfileWidgetData ?? [];

// Extract values safely
$employee_name       = ucfirst($w['employee_name']) ?? ' User';
$employee_position   = $w['employee_position'] ?? '';
$today_shift         = $w['today_shift'] ?? null;
$shift_started       = $w['shift_started'] ?? false;
$shift_clockin       = $w['shift_clockin_display'] ?? '--:-- --';
$hours_this_week     = $w['hours_this_week'] ?? '0h';
$tasks_completed     = $w['tasks_completed'] ?? 0;
$tasks_total         = $w['tasks_total'] ?? 0;
$attendance_rate     = $w['attendance_rate'] ?? 0;
?>
<aside id="profile-section" class="col-span-12 lg:col-span-3">
    <div class="bg-white rounded-[20px] p-6 shadow-lg">
        <div class="flex flex-col items-center mb-6">
            <div class="relative mb-4">
                <img src="https://bizadmin.com.au/theme-assets/images/users/avatar-1.jpg"
                     alt="Profile"
                     class="w-32 h-32 rounded-full border-4 border-teal">
                     <?php if($shift_started) {  ?>
                <div class="absolute bottom-0 right-0 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                <?php } else{ ?>
                <div class="absolute bottom-0 right-0 w-8 h-8 bg-gray-300 rounded-full border-4 border-white"></div>
                <?php } ?>
            </div>

            <h2 class="text-xl font-bold text-primary mb-1"><?= htmlspecialchars($employee_name) ?></h2>
            <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($employee_position) ?></p>

            <!-- TODAY'S SCHEDULE -->
            <div class="w-full bg-neutralgray rounded-xl p-4 mb-4">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-regular fa-calendar text-teal"></i>
                    <p class="text-sm text-gray-600 font-medium">Today's Schedule</p>
                </div>

                <?php if (!empty($today_shift) && !empty($today_shift['roster_start_time'])): ?>

                    <p class="text-sm text-gray-700">
                        <?= date('h:i A', strtotime($today_shift['roster_start_time'])) ?>
                         – 
                        <?= !empty($today_shift['roster_end_time'])
                              ? date('h:i A', strtotime($today_shift['roster_end_time']))
                              : '--:-- --' ?>
                    </p>

                    <?php if ($shift_started): ?>
                        <p class="text-xs text-green-600 mt-1">
                            Shift started at <?= htmlspecialchars($shift_clockin) ?>
                        </p>
                    <?php else: ?>
                        <p class="text-xs text-gray-500 mt-1">Shift not started</p>
                    <?php endif; ?>

                <?php else: ?>
                    <p class="text-xs text-gray-500"></p>
                <?php endif; ?>
            </div>

            <!-- START SHIFT BUTTON -->
            <button class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-[14px] mb-3 transition-all shadow-md hover:shadow-lg">
                <i class="fa-solid fa-play mr-2"></i>
                <?= $shift_started ? 'Shift Started' : ' Shift not started' ?>
            </button>

            <!-- CLOCK IN BUTTON -->
            <button class="w-full bg-green-100 hover:bg-green-200 text-green-700 font-semibold py-3 rounded-[14px] transition-all">
                <i class="fa-regular fa-clock mr-2"></i>
                <?= $shift_started ? 'Clocked In ' . htmlspecialchars($shift_clockin) : 'Clock In' ?>
            </button>
        </div>

        <!-- QUICK STATS -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-sm font-semibold text-primary mb-4">Quick Stats</h3>
            <div class="space-y-3">

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Hours This Week</span>
                    <span class="text-sm font-bold text-primary"><?= htmlspecialchars($hours_this_week) ?></span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Tasks Completed</span>
                    <span class="text-sm font-bold text-teal">
                        <?= $tasks_completed ?>/<?= $tasks_total ?>
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Attendance Rate</span>
                    <span class="text-sm font-bold text-green-600"><?= $attendance_rate ?>%</span>
                </div>

            </div>
        </div>
    </div>

    <!-- LEAVE BALANCE -->
    <div id="leave-balance-widget"
         class="bg-gradient-to-br from-teal to-primary rounded-[20px] p-6 shadow-lg mt-6 text-white">
        <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-umbrella-beach"></i>
            Leave Balance
        </h3>
        <div class="space-y-4">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm">Annual Leave</span>
                    <span class="text-sm font-bold">12/20 days</span>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2">
                    <div class="bg-white rounded-full h-2" style="width: 60%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm">Sick Leave</span>
                    <span class="text-sm font-bold">8/10 days</span>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2">
                    <div class="bg-white rounded-full h-2" style="width: 80%"></div>
                </div>
            </div>
        </div>
    </div>
</aside>



        <div class="col-span-12 lg:col-span-9">
            
            <div id="insights-row" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                <div class="bg-white rounded-[16px] p-5 shadow-md hover:shadow-xl transition-shadow border border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-calendar-days text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold text-primary">5</span>
                    </div>
                    <p class="text-sm text-gray-600 font-medium">Tasks Today</p>
                </div>
                
                <div class="bg-white rounded-[16px] p-5 shadow-md hover:shadow-xl transition-shadow border border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-lines text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold text-primary">4</span>
                    </div>
                    <p class="text-sm text-gray-600 font-medium">Leave Requests</p>
                </div>
                <div class="bg-white rounded-[16px] p-5 shadow-md hover:shadow-xl transition-shadow border border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-teal/20 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-clock text-teal text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold text-primary">8</span>
                    </div>
                    <p class="text-sm text-gray-600 font-medium">Upcoming Shifts</p>
                </div>
                <div class="bg-white rounded-[16px] p-5 shadow-md hover:shadow-xl transition-shadow border border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <?php if($shift_started) {  ?>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-user-check text-green-600 text-xl"></i>
                        </div>
                         <span class="text-3xl font-bold text-green-600">Present</span>
                         <?php } else{ ?>
                           <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-user-check text-red-600 text-xl"></i>
                        </div>
                         <span class="text-3xl font-bold text-red-600">Absent</span>
                         <?php }  ?>
                        
                        
                    </div>
                    <p class="text-sm text-gray-600 font-medium">Attendance Today</p>
                </div>
            </div>

         
    
            <!-- ROW 1: My Timesheets (50%) + My Tasks (50%) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                
                <!-- MY TIMESHEETS -->
                <div id="latest-timesheet-section" class="bg-white rounded-[20px] p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-primary flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-teal"></i>
                            My Timesheets
                        </h3>
                        <button class="text-teal hover:text-primary text-sm font-medium transition-colors">View All</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                   
                                    <th class="text-left py-3 px-4 text-xs font-semibold text-black uppercase">Start Date</th>
                                    <th class="text-left py-3 px-4 text-xs font-semibold text-black uppercase">End Date</th>
                                    <th class="text-center py-3 px-4 text-xs font-semibold text-black uppercase">Action</th>
                                </tr>
                            </thead>
                            <?php $timesheets = $employeeTimesheets ?? []; ?>

                            <tbody>
                            <?php if (!empty($timesheets)): ?>
                                
                                <?php foreach ($timesheets as $t): ?>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">

                                        <td class="py-4 px-4 text-sm text-gray-600">
                                            <?= date("F d, Y", strtotime($t['date_from'])) ?>
                                        </td>

                                        <td class="py-4 px-4 text-sm text-gray-600">
                                            <?= date("F d, Y", strtotime($t['date_to'])) ?>
                                        </td>

                                        <td class="py-4 px-4 text-center">
                                            <a href="<?= base_url('HR/viewTimesheetWithoutRoster/'. $t['date_from'] .'/'. $t['date_to'] .'/'. $t['id']) ?>"
                                               class="bg-teal hover:bg-primary text-white px-4 py-2 rounded-[10px] text-xs font-medium transition-colors">
                                               View
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-gray-400 text-sm">
                                        No timesheets found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
               
                <!-- MY TASKS -->
                <?php $tasks = $todayTasks ?? [];?>
                
                <div id="tasks-widget" class="bg-white rounded-[20px] p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-primary flex items-center gap-2">
                            <i class="fa-solid fa-tasks text-orange"></i>
                            My Tasks
                        </h3>
                         <a class="bg-teal hover:bg-primary text-white px-4 py-2 rounded-[12px] text-sm font-medium transition-colors" href="Employee/employeeprofile">
                                            Update Availability
                                        </a>
                    </div>

                    <div class="space-y-3">

                        <?php if (empty($tasks)) : ?>
                            <p class="text-gray-500 text-sm italic text-center py-4">
                                No tasks assigned for today.
                            </p>
                        <?php else : ?>

                            <?php foreach ($tasks as $t) : 
                                $taskText   = $t['task'];
                                $dueDate    = date("M d, Y", strtotime($t['due']));
                                $isDone     = $t['status'] == 1;

                                // Badge color logic
                                $badgeText  = $isDone ? "Done" : "Pending";
                                $badgeClass = $isDone 
                                    ? "bg-green-100 text-green-600"
                                    : "bg-yellow-100 text-yellow-600";
                            ?>
                            
                            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-[14px] hover:bg-gray-100 transition-colors">
                                
                                <input type="checkbox" 
                                       class="w-5 h-5 rounded border-gray-300 text-teal focus:ring-teal"
                                       <?= $isDone ? "checked" : "" ?>
                                >

                                <div class="flex-1">
                                    <p class="text-sm font-medium <?= $isDone ? 'text-gray-400 line-through' : 'text-gray-700' ?>">
                                        <?= htmlspecialchars($taskText) ?>
                                    </p>

                                    <p class="text-xs <?= $isDone ? 'text-gray-400' : 'text-gray-500' ?> mt-1">
                                        <?= $isDone ? 'Completed' : 'Due: ' . $dueDate ?>
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full text-xs font-medium <?= $badgeClass ?>">
                                    <?= $badgeText ?>
                                </span>
                            </div>

                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
            
            <!-- ROW 2: Today's Attendance Timeline (50%) + Upcoming Schedule (50%) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                
                <!-- TODAY'S ATTENDANCE TIMELINE -->
                <?php
                // $attendance should be provided by controller (array). Example shown in your message.
                if (!isset($attendance) || !is_array($attendance)) {
                    // safe default when attendance not available
                    $attendance = [
                        'date' => date('Y-m-d'),
                        'clock_in' => '--:-- --',
                        'break_start' => '--:-- --',
                        'resume' => '--:-- --',
                        'clock_out' => '--:-- --',
                        'worked_seconds' => 0,
                        'worked_label' => '0m',
                        'target_label' => '8h 00m',
                        'progress_percent' => 0
                    ];
                }

                $clockIn = $attendance['clock_in'] ?? '--:-- --';
                $breakStart = $attendance['break_start'] ?? '--:-- --';
                $resume = $attendance['resume'] ?? '--:-- --';
                $clockOut = $attendance['clock_out'] ?? '--:-- --';
                $workedLabel = $attendance['worked_label'] ?? '0m';
                $targetLabel = $attendance['target_label'] ?? '8h 00m';
                $progressPercent = (int) ($attendance['progress_percent'] ?? 0);

                // keep percent inside 0-100
                $progressPercent = max(0, min(100, $progressPercent));
                ?>

                <div id="attendance-timeline" class="bg-white rounded-[20px] p-6 shadow-lg">
                    <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-clock text-teal"></i>
                        Today's Attendance Timeline
                    </h3>

                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-1">Clock In</p>
                                <p class="text-sm font-bold text-green-600"><?= htmlspecialchars($clockIn) ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-1">Break</p>
                                <p class="text-sm font-bold text-orange-500"><?= htmlspecialchars($breakStart) ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-1">Resume</p>
                                <p class="text-sm font-bold text-orange-500"><?= htmlspecialchars($resume) ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-1">Clock Out</p>
                                <p class="text-sm font-bold text-gray-400"><?= htmlspecialchars($clockOut) ?></p>
                            </div>
                        </div>

                        <div class="relative w-full h-3 bg-neutralgray rounded-full overflow-hidden">
                            <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-green-500 to-teal rounded-full"
                                 style="width: <?= $progressPercent ?>%"></div>
                        </div>

                        <div class="flex justify-between items-center mt-3">
                            <p class="text-sm text-gray-600">Total Hours: <span class="font-bold text-primary"><?= htmlspecialchars($workedLabel) ?></span></p>
                            <p class="text-sm text-gray-600">Target: <span class="font-bold text-primary"><?= htmlspecialchars($targetLabel) ?></span></p>
                        </div>
                    </div>
                </div>

                <!-- UPCOMING SCHEDULE (CALENDAR) -->
                <?php
                // calender widget related code
                $taskDays = $taskDays ?? [];
                $today    = $today ?? (int) date("d");
                $year     = $year ?? date("Y");
                $month    = $month ?? date("m");

                // Calculate calendar structure
                $firstDayOfMonth = date("w", strtotime("$year-$month-01")); // 0=Sun
                $totalDays       = date("t", strtotime("$year-$month-01"));

                $weeks = [];
                $week  = [];

                // Fill initial blanks for first week
                for ($i = 0; $i < $firstDayOfMonth; $i++) {
                    $week[] = "";
                }

                // Fill days
                for ($d = 1; $d <= $totalDays; $d++) {
                    $week[] = $d;

                    if (count($week) == 7) {
                        $weeks[] = $week;
                        $week = [];
                    }
                }

                // Last week padding
                if (!empty($week)) {
                    while (count($week) < 7) $week[] = "";
                    $weeks[] = $week;
                }
                ?>

                <div id="calendar-widget" class="bg-white rounded-[20px] p-6 shadow-lg">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-primary flex items-center gap-2">
                            <i class="fa-solid fa-calendar-alt text-teal"></i>
                            Upcoming Schedule
                        </h3>
                        <a class="text-sm text-teal hover:text-primary font-medium" href="#tasks-widget">View Tasks</a>
                    </div>

                    <!-- WEEKDAYS -->
                    <div class="grid grid-cols-7 gap-2 mb-4">
                        <?php foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day): ?>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2"><?= $day ?></div>
                        <?php endforeach; ?>

                        <!-- DAYS -->
                        <?php foreach ($weeks as $week): ?>
                            <?php foreach ($week as $day): ?>
                                
                                <?php if ($day === ""): ?>
                                    <div class="text-center text-xs text-gray-400 py-2"></div>
                                    <?php continue; ?>
                                <?php endif; ?>

                                <?php
                                $isToday = ($day == $today);
                                $hasTask = isset($taskDays[$day]);
                                ?>

                                <div class="text-center text-xs py-2 relative
                                    <?= $isToday ? 'bg-teal text-white rounded-full font-bold' : 'text-gray-700' ?>
                                ">
                                    <?= $day ?>

                                    <?php if ($hasTask): ?>
                                        <div class="w-1 h-1 bg-orange rounded-full absolute bottom-0 left-1/2 transform -translate-x-1/2"></div>
                                    <?php endif; ?>
                                </div>

                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- Legend -->
                    <div class="flex items-center gap-4 text-xs">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-orange rounded-full"></div>
                            <span class="text-gray-600">Tasks</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-gray-600">Leave</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-teal rounded-full"></div>
                            <span class="text-gray-600">Today</span>
                        </div>
                    </div>

                </div>      
                 
            </div>

        </div>
    </div>
    
     <?php $this->load->view('unavailabilityCanvas'); ?>
</main>

</body>
</html>