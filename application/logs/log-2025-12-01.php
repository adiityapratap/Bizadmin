<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-12-01 00:30:30 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 00:30:30 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 00:49:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 00:49:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 01:44:33 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 01:44:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 02:08:39 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 02:08:39 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 02:53:54 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 02:53:54 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 03:05:18 --> Query error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist - Invalid query: SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = 9999 AND system_id = 9999
ERROR - 2025-12-01 03:05:18 --> DB error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist
ERROR - 2025-12-01 03:40:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 03:40:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 03:43:10 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:43:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:43:17 --> 404 Page Not Found: ../modules/HR/controllers//index
ERROR - 2025-12-01 03:45:04 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:45:28 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:45:31 --> Severity: Warning --> Attempt to read property "date_from" on array /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 627
ERROR - 2025-12-01 03:45:31 --> Severity: Warning --> Attempt to read property "date_to" on array /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 628
ERROR - 2025-12-01 03:45:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `roster_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = ' at line 3 - Invalid query: SELECT `employee_id`
FROM `HR_timesheet_details`
WHERE `roster_date` > `IS` `NULL`
AND `roster_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '13'
GROUP BY `employee_id`
ERROR - 2025-12-01 03:45:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `task_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '1' at line 3 - Invalid query: SELECT *
FROM `HR_tasks`
WHERE `task_date` > `IS` `NULL`
AND `task_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '13'
ERROR - 2025-12-01 03:45:31 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:46:09 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 87
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 1 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:11 --> Severity: Warning --> Undefined array key 2 /home/bizadmincom/public_html/application/modules/HR/views/timesheet/weeklyTimesheet.php 201
ERROR - 2025-12-01 03:46:14 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:46:16 --> Severity: Warning --> Attempt to read property "date_from" on array /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 627
ERROR - 2025-12-01 03:46:16 --> Severity: Warning --> Attempt to read property "date_to" on array /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 628
ERROR - 2025-12-01 03:46:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `roster_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = ' at line 3 - Invalid query: SELECT `employee_id`
FROM `HR_timesheet_details`
WHERE `roster_date` > `IS` `NULL`
AND `roster_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '13'
GROUP BY `employee_id`
ERROR - 2025-12-01 03:46:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `task_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '1' at line 3 - Invalid query: SELECT *
FROM `HR_tasks`
WHERE `task_date` > `IS` `NULL`
AND `task_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '13'
ERROR - 2025-12-01 03:46:16 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:46:20 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:48:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:50:49 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:50:53 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:50:53 --> Severity: Warning --> Undefined array key "display" /home/bizadmincom/public_html/application/modules/HR/views/timesheet/timesheetWithoutRoster.php 84
ERROR - 2025-12-01 03:51:20 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:51:24 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:51:24 --> Severity: Warning --> Undefined array key "display" /home/bizadmincom/public_html/application/modules/HR/views/timesheet/timesheetWithoutRoster.php 84
ERROR - 2025-12-01 03:54:55 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:54:59 --> Severity: Warning --> Undefined variable $dateRange /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 654
ERROR - 2025-12-01 03:54:59 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:54:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/timesheet/timesheetWithoutRoster.php 94
ERROR - 2025-12-01 03:54:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/timesheet/timesheetWithoutRoster.php 95
ERROR - 2025-12-01 03:55:49 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:55:53 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:55:58 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:56:02 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:56:12 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:56:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:56:22 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:59:12 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 03:59:12 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:12:59 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:12:59 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:20:37 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:20:39 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:23:10 --> Severity: Warning --> Undefined array key 0 /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 630
ERROR - 2025-12-01 04:23:10 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 630
ERROR - 2025-12-01 04:23:10 --> Severity: Warning --> Undefined array key 0 /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 631
ERROR - 2025-12-01 04:23:10 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/controllers/Timesheet.php 631
ERROR - 2025-12-01 04:23:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `roster_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = ' at line 3 - Invalid query: SELECT `employee_id`
FROM `HR_timesheet_details`
WHERE `roster_date` > `IS` `NULL`
AND `roster_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '13'
GROUP BY `employee_id`
ERROR - 2025-12-01 04:23:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `task_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '1' at line 3 - Invalid query: SELECT *
FROM `HR_tasks`
WHERE `task_date` > `IS` `NULL`
AND `task_date` < `IS` `NULL`
AND `is_deleted` = 0
AND `location_id` = '13'
ERROR - 2025-12-01 04:23:10 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:23:12 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:23:35 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:23:37 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:25:44 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:25:48 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:26:19 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:26:21 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:26:50 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:26:57 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:27:18 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:27:20 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:27:25 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:27:46 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:30:19 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:31:50 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:33:30 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:35:42 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:35:45 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:35:47 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:35:52 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:35:56 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:35:59 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:36:00 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:37:33 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:37:44 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:37:48 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:37:48 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:38:03 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:38:19 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:38:27 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-12-01 04:38:27 --> Severity: Warning --> Undefined property: stdClass::$monday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-12-01 04:38:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:38:29 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:38:32 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:38:45 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:38:47 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:39:03 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:39:03 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:39:47 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:40:01 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:40:24 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:40:24 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:40:25 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:40:25 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:40:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:40:59 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:40:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:41:08 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:41:13 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:41:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:41:16 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:41:19 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:41:19 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:41:22 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:41:42 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:41:42 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:42:07 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:42:14 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:42:16 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:45:26 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-12-01 04:45:26 --> Severity: Warning --> Undefined property: stdClass::$monday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-12-01 04:45:26 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:45:29 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_street" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 543
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_suburb" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 548
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 552
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 556
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "location_ids" /home/bizadmincom/public_html/application/modules/HR/controllers/Employees.php 153
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 105
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 112
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 113
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 114
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 115
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 116
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "preferred_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 123
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 128
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 133
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "email" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 138
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "phone" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 143
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "dob" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 148
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "stress_profile" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 177
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "stress_profile" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 177
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "heighest_acd_achmts" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 185
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "address" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 195
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "unit_number" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 199
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "street" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 203
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "street_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 208
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "suburb" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 214
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 219
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 219
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 227
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 228
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 229
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 230
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 231
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 232
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 233
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 234
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 246
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 246
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 252
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "date_modified" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 258
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 269
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 270
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 271
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 272
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 273
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "position_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 353
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "position_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 353
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "position_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 353
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 509
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_name_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 513
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_relationship_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 518
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_email_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 523
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_phone_no" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 529
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emergency_address" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 535
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_street" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 543
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_suburb" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 548
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 552
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nextkin_state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 556
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 569
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "bank_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 576
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "account_name_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 580
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "bsb_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 584
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "account_no_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 588
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "percentage_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 592
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "bank_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 599
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "account_name_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 600
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "bsb_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 601
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "account_no_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 602
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "percentage_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 603
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "bank_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 608
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "account_name_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 609
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "bsb_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 610
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "account_no_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 611
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "percentage_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 612
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 631
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "tfn_number" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 648
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 656
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 657
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 658
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 672
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 673
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 673
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 678
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "previous_surname" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 682
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "previous_surname" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 682
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 687
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 690
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "resident_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 700
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "resident_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 701
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "resident_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 702
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 713
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 714
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 715
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 716
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 717
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "claim_tax_free" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 728
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "claim_tax_free" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 729
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 740
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 741
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 742
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 743
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 744
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 773
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 817
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "check_super_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 825
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "pdf_first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 837
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "pdf_emp_id_no" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 842
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "pdf_apra_fund_abh" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 849
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "pdf_apra_fund_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 854
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "pdf_apra_fund_usi" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 860
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "pdf_apra_fund_member_no" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 866
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nominatedByEmployer" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 874
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 898
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "agree_terms_one" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 926
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "agree_terms_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 957
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1034
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1034
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1051
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1051
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1068
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1068
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1213
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1213
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1293
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/general/unavailabilityCanvas.php 47
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "nominatedByEmployer" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1363
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "check_tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1364
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1365
ERROR - 2025-12-01 04:45:32 --> Severity: Warning --> Undefined array key "stepsCompleted" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1366
ERROR - 2025-12-01 04:45:32 --> Severity: Notice --> ob_get_clean(): Failed to discard buffer of zlib output compression (0) /home/bizadmincom/public_html/application/third_party/MX/Loader.php 370
ERROR - 2025-12-01 04:45:32 --> Severity: Notice --> ob_get_clean(): Failed to delete buffer of zlib output compression (0) /home/bizadmincom/public_html/application/third_party/MX/Loader.php 370
ERROR - 2025-12-01 04:45:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:45:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:46:07 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:46:07 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:47:28 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:48:34 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:48:34 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:49:13 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-12-01 04:49:13 --> Severity: Warning --> Undefined property: stdClass::$monday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-12-01 04:49:13 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:49:18 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:49:20 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 04:49:56 --> Severity: Warning --> Undefined variable $cafeName /home/bizadmincom/public_html/application/modules/HR/views/emails/onboardingEmail.php 21
ERROR - 2025-12-01 04:50:16 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:50:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:50:20 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:50:38 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:50:38 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 04:53:34 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:53:34 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:53:46 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:53:46 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:53:46 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:53:46 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:53:46 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:53:56 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:54:10 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:54:20 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:54:20 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:54:34 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:54:34 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:59:18 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:59:44 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:59:44 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 04:59:52 --> 404 Page Not Found: /index
ERROR - 2025-12-01 04:59:57 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 04:59:57 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 05:03:52 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:04:22 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:04:25 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:05:21 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:06:38 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:07:37 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:07:37 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:07:45 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:07:45 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:07:45 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:07:45 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:07:45 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:08:02 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:08:06 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-12-01 05:08:06 --> Severity: Warning --> Undefined property: stdClass::$monday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-12-01 05:08:06 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:08:11 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:32 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:09:32 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:09:42 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:42 --> Severity: Warning --> Undefined array key "role" /home/bizadmincom/public_html/application/modules/HR/views/employee/editContractor.php 56
ERROR - 2025-12-01 05:09:42 --> Severity: error --> Exception: number_format(): Argument #1 ($num) must be of type float, string given /home/bizadmincom/public_html/application/modules/HR/views/employee/editContractor.php 100
ERROR - 2025-12-01 05:09:43 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-12-01 05:09:43 --> Severity: Warning --> Undefined property: stdClass::$monday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-12-01 05:09:43 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:45 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:45 --> Severity: Warning --> Undefined array key "role" /home/bizadmincom/public_html/application/modules/HR/views/employee/editContractor.php 56
ERROR - 2025-12-01 05:09:45 --> Severity: error --> Exception: number_format(): Argument #1 ($num) must be of type float, string given /home/bizadmincom/public_html/application/modules/HR/views/employee/editContractor.php 100
ERROR - 2025-12-01 05:09:46 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:48 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:51 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:51 --> Severity: Warning --> Undefined array key "nextkin_street" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 543
ERROR - 2025-12-01 05:09:51 --> Severity: Warning --> Undefined array key "nextkin_suburb" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 548
ERROR - 2025-12-01 05:09:51 --> Severity: Warning --> Undefined array key "nextkin_postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 552
ERROR - 2025-12-01 05:09:51 --> Severity: Warning --> Undefined array key "nextkin_state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 556
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "location_ids" /home/bizadmincom/public_html/application/modules/HR/controllers/Employees.php 153
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 105
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 112
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 113
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 114
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 115
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "title" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 116
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "preferred_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 123
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 128
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 133
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "email" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 138
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "phone" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 143
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "dob" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 148
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_prep_area" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 159
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "stress_profile" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 177
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "stress_profile" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 177
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "heighest_acd_achmts" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 185
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "address" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 195
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "unit_number" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 199
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "street" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 203
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "street_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 208
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "suburb" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 214
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 219
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 219
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 227
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 228
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 229
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 230
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 231
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 232
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 233
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 234
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 246
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 246
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 252
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "date_modified" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 258
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 269
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 270
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 271
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 272
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "employee_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 273
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "position_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 353
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "position_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 353
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "position_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 353
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 509
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_name_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 513
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_relationship_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 518
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_email_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 523
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_phone_no" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 529
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emergency_address" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 535
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_street" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 543
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_suburb" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 548
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_postcode" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 552
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nextkin_state" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 556
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 569
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "bank_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 576
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "account_name_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 580
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "bsb_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 584
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "account_no_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 588
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "percentage_1" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 592
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "bank_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 599
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "account_name_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 600
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "bsb_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 601
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "account_no_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 602
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "percentage_2" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 603
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "bank_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 608
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "account_name_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 609
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "bsb_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 610
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "account_no_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 611
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "percentage_3" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 612
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 631
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "tfn_number" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 648
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 656
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 657
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 658
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 672
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 673
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 673
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 678
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "previous_surname" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 682
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "previous_surname" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 682
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 687
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 690
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "resident_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 700
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "resident_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 701
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "resident_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 702
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 713
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 714
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 715
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 716
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "loan_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 717
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "claim_tax_free" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 728
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "claim_tax_free" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 729
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 740
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 741
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 742
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 743
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "job_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 744
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 773
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 817
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "check_super_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 825
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "pdf_first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 837
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "pdf_emp_id_no" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 842
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "pdf_apra_fund_abh" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 849
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "pdf_apra_fund_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 854
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "pdf_apra_fund_usi" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 860
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "pdf_apra_fund_member_no" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 866
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nominatedByEmployer" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 874
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 898
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "agree_terms_one" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 926
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "agree_terms_two" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 957
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1034
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1034
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1051
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1051
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1068
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1068
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "first_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1213
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "last_name" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1213
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1293
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "emp_id" /home/bizadmincom/public_html/application/modules/HR/views/general/unavailabilityCanvas.php 47
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "nominatedByEmployer" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1363
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "check_tfn_type" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1364
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "have_surname_changed" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1365
ERROR - 2025-12-01 05:09:52 --> Severity: Warning --> Undefined array key "stepsCompleted" /home/bizadmincom/public_html/application/modules/HR/views/employee/editEmployee.php 1366
ERROR - 2025-12-01 05:09:52 --> Severity: Notice --> ob_get_clean(): Failed to discard buffer of zlib output compression (0) /home/bizadmincom/public_html/application/third_party/MX/Loader.php 370
ERROR - 2025-12-01 05:09:52 --> Severity: Notice --> ob_get_clean(): Failed to delete buffer of zlib output compression (0) /home/bizadmincom/public_html/application/third_party/MX/Loader.php 370
ERROR - 2025-12-01 05:09:52 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:09:52 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:09:56 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:10:12 --> Severity: Warning --> Undefined variable $cafeName /home/bizadmincom/public_html/application/modules/HR/views/emails/onboardingEmail.php 21
ERROR - 2025-12-01 05:10:18 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:11:14 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:11:14 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:11:31 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:11:31 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:11:39 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:11:58 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:11:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:12:49 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:12:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:13:03 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:13:24 --> Severity: Warning --> Undefined variable $generalConfigData /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:13:24 --> Severity: Warning --> Trying to access array offset on value of type null /home/bizadmincom/public_html/application/modules/HR/views/TimesheetClockIn/clockin.php 253
ERROR - 2025-12-01 05:13:56 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:14:12 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:14:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:15:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 05:15:19 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-12-01 05:15:19 --> Severity: Warning --> Undefined property: stdClass::$monday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-12-01 05:15:19 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 05:15:26 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 05:15:26 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 06:10:18 --> 404 Page Not Found: /index
ERROR - 2025-12-01 06:10:20 --> 404 Page Not Found: /index
ERROR - 2025-12-01 06:10:22 --> 404 Page Not Found: /index
ERROR - 2025-12-01 06:10:23 --> 404 Page Not Found: /index
ERROR - 2025-12-01 06:38:29 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 06:56:38 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 06:56:38 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 07:16:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:16:32 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:24:08 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:24:13 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:46:38 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 07:46:38 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 07:46:38 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 07:46:38 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 07:46:38 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 07:46:38 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 07:46:52 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:46:56 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:47:47 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:47:50 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 07:53:14 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 08:21:34 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:21:34 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:21:34 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:21:34 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:21:34 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:21:34 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:21:45 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 08:21:55 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 08:21:56 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:21:56 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:21:56 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:21:56 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:21:56 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:21:56 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:01 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:01 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:01 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:01 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:01 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:01 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:13 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 08:31:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:31:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 08:31:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 08:36:56 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 08:36:58 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 08:55:49 --> 404 Page Not Found: /index
ERROR - 2025-12-01 09:07:04 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:07:04 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:07:06 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:07:07 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:07:07 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:07:09 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:07:09 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 09:20:48 --> 404 Page Not Found: /index
ERROR - 2025-12-01 09:20:53 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:21:28 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:23:00 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:24:28 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:24:30 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:24:39 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:24:41 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:27:22 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:27:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:28:12 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 09:30:02 --> Severity: error --> Exception: Invalid address:  (to): test@gma /home/bizadmincom/public_html/application/third_party/phpmailer/src/PHPMailer.php 1181
ERROR - 2025-12-01 09:39:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 09:39:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 10:07:38 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:07:40 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:07:46 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:08:54 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:54 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:54 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:55 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:55 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:56 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:57 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:57 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:58 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:58 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:58 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:08:59 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:00 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:00 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:00 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:01 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:02 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:04 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:05 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:06 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:09:57 --> 404 Page Not Found: /index
ERROR - 2025-12-01 10:11:25 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:18:08 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:08 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:08 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:08 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:08 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:09 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:09 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:20 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:20 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:27 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:56 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:56 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:56 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:57 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:57 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:58 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:59 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:18:59 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 10:20:35 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:50:45 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 10:50:45 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 10:50:45 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 10:50:45 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 10:50:45 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 10:50:45 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 10:51:33 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:51:38 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:52:32 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 10:52:35 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 11:00:05 --> Not Found: Cron/sendMailForTempNotRecorded
ERROR - 2025-12-01 11:40:49 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:40:49 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:40:55 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:40:55 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:02 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:02 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:09 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:09 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:23 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:23 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:30 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:30 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:36 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:36 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 11:41:43 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 11:41:43 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:15:23 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:15:26 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:15:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:16:07 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:16:16 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:16:29 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:16:51 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:04 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:19 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:20 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:21 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:21 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:22 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:22 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:23 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:25 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:26 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:26 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:27 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:27 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:28 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:28 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:31 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:17:45 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:18:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:18:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:18:58 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:19:00 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:26:42 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:28:04 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:28:06 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:28:11 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:28:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:28:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:28:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:28:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:28:15 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:28:15 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:28:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:29:13 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:29:18 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:29:45 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:29:55 --> Severity: Warning --> Undefined array key "date_entered" /home/bizadmincom/public_html/application/modules/Temp/controllers/FoodTemp/Foodtemphome.php 107
ERROR - 2025-12-01 12:30:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:32:02 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:32:18 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:32:20 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:56:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:56:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:27 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:57:27 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:27 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:57:27 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:27 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:57:27 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:57:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:57:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 12:57:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 12:57:50 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:57:58 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 12:58:05 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 13:06:10 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 13:06:19 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 13:06:23 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 13:08:38 --> 404 Page Not Found: /index
ERROR - 2025-12-01 15:08:34 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 15:08:40 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 15:09:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 15:09:15 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:17 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:17 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:17 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 15:33:17 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 15:33:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 16:30:52 --> 404 Page Not Found: /index
ERROR - 2025-12-01 17:50:26 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 17:50:31 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 18:19:21 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 18:19:21 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 19:10:41 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 19:10:42 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 19:11:00 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 19:11:00 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 19:11:32 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 19:11:32 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 19:38:08 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 19:54:11 --> Query error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist - Invalid query: SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = 9999 AND system_id = 9999
ERROR - 2025-12-01 19:54:11 --> DB error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist
ERROR - 2025-12-01 19:57:47 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 19:57:47 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:30:04 --> Severity: error --> Exception: Invalid address:  (to): tesdt@gmai /home/bizadmincom/public_html/application/third_party/phpmailer/src/PHPMailer.php 1181
ERROR - 2025-12-01 20:31:46 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:31:46 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:34:18 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:34:18 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:35:33 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:35:33 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:35:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:35:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:35:33 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:35:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:54:52 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:54:52 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:47 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:47 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:48 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:48 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:48 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:48 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:49 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:49 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:49 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:49 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:50 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:50 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:50 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:50 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:51 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:51 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:52 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:52 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:52 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:52 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:53 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:53 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:53 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:53 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:54 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:54 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:54 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:54 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:55 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:55 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:55 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:55 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:56 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:56 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:56 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:56 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:57 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:57 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:57 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:57 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:58 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:58:58 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:58 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:58 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:58 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:59 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:59 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:58:59 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:58:59 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:00 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:00 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:01 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:01 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:01 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:01 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:02 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:02 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:02 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:02 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:03 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:04 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:04 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:04 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:04 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:05 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:05 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:05 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:05 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:06 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:06 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:06 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:06 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:07 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:07 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:07 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:08 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:08 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:08 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:08 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:08 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:09 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:10 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:10 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:10 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:10 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:10 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:11 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:11 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:11 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:11 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:11 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:11 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:12 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:12 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:12 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:12 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:12 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:13 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:13 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:13 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:13 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:13 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:14 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:14 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:14 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:14 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:14 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:14 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:15 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:15 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:15 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:15 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:15 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:16 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:16 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:16 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:16 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:16 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:16 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:17 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:17 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:18 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:18 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:18 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:18 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:19 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:19 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:19 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:19 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:20 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:20 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:20 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:20 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:21 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:21 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:22 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:22 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:22 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:22 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:23 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:23 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:23 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:23 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:24 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:24 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:24 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:24 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:25 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:25 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:25 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:25 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:26 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:26 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:26 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:26 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:27 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:27 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:27 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:27 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:29 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:29 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 20:59:29 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:29 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:30 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:30 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:30 --> 404 Page Not Found: Cron/.env
ERROR - 2025-12-01 20:59:30 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:30 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:31 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:31 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:31 --> 404 Page Not Found: Config/.env
ERROR - 2025-12-01 20:59:31 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:31 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:32 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:32 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:32 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:32 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:32 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:32 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:33 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:34 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:35 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:35 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:35 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:35 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:35 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:36 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:36 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:36 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:36 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:36 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:36 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:37 --> 404 Page Not Found: /index
ERROR - 2025-12-01 20:59:37 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 20:59:37 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 21:02:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 21:08:14 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 21:08:14 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 21:33:49 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 21:33:49 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 22:10:27 --> 404 Page Not Found: /index
ERROR - 2025-12-01 22:10:27 --> Query error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist - Invalid query: SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = 9999 AND system_id = 9999
ERROR - 2025-12-01 22:10:27 --> DB error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist
ERROR - 2025-12-01 23:01:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:01:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:01:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:01:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:01:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:01:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:01:28 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:01:28 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:20:53 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 23:20:57 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 23:20:57 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:20:57 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:20:57 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:20:57 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:20:57 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-12-01 23:20:57 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-12-01 23:22:19 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-12-01 23:22:24 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
