<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-11-23 22:12:26 --> 220 SY5P282CA0097.outlook.office365.com Microsoft ESMTP MAIL Service ready at Sun, 23 Nov 2025 11:12:20 +0000 [08DE2A6028D26C22]
<br /><pre>hello: 250-SY5P282CA0097.outlook.office365.com Hello [172.105.184.101]
250-SIZE 157286400
250-PIPELINING
250-DSN
250-ENHANCEDSTATUSCODES
250-STARTTLS
250-8BITMIME
250-BINARYMIME
250-CHUNKING
250 SMTPUTF8
</pre><pre>starttls: 220 2.0.0 SMTP server ready
</pre><pre>hello: 250-SY5P282CA0097.outlook.office365.com Hello [172.105.184.101]
250-SIZE 157286400
250-PIPELINING
250-DSN
250-ENHANCEDSTATUSCODES
250-AUTH LOGIN XOAUTH2
250-8BITMIME
250-BINARYMIME
250-CHUNKING
250 SMTPUTF8
</pre><pre>from: 250 2.1.0 Sender OK
</pre><pre>to: 250 2.1.5 Recipient OK
</pre><pre>data: 354 Start mail input; end with <CRLF>.<CRLF>
</pre>554 5.2.252 SendAsDenied; info@bizadmin.com.au not allowed to send as noreply@bizadmin.com.au; STOREDRV.Submission.Exception:SendAsDeniedException.MapiExceptionSendAsDenied; Failed to process message due to a permanent exception with message [BeginDiagnosticData]Cannot submit message. 1.84300:0A000000, 1.84300:0A000000, 1.84300:0E000000, 1.84300:32000000, 1.73948:00000000, 1.108572:00000000, 0.117068:0B000000, 1.79180:0A000000, 1.79180:0A000000, 1.79180:0E000000, 1.79180:32000000, 1.79180:FA000000, 255.731<br /><pre>quit: 00:00000000, 5.95292:67000000446F526F70730072, 8.111356:9552F9FE86593ECC1F1F572B2F8F6BAC1F1F572B, 0.38698:A6536B31, 1.41134:86000000, 1.41134:46000000, 0.37692:140F7FA4, 0.37948:86000000, 5.33852:00000000534D545000000000, 7.36354:010000000000010900000000, 1.46439:0A000000, 1.115228:00000000, 0.104668:86000100, 1.44903:25000000, 1.115228:00000000, 5.56248:DC04000053656E64417320636865636B206661696C65642062656375617365204149206973206E756C6C0000, 7.40748:010000000000010B12000000, 7.57132:000000000000000074654372, 4.39640:DC040000, 1.63016:32000000, 8.45434:DFEE9A4FC0E67D4583EEB2102B8C3EEF00636570, 0.104348:00000000, 5.46798:040000004D61696C4974656D5375626D697373696F6E00363A663764, 7.51330:0885112F812ADE083262362D, 5.10786:0000000031352E32302E393334332E3031313A4D4559503238324D42313937363A66376432336161322D616162322D343262362D396332612D3766303863643737313838393A3138303335363A2E4E455420382E302E323100000000, 0.39570:12000000, 1.55954:0A000000, 1.33010:0A000000, 2.54258:00000000, 0.40002:00000000, 1.56562:00000000, </pre>The following SMTP error was encountered: 00:00000000, 5.95292:67000000446F526F70730072, 8.111356:9552F9FE86593ECC1F1F572B2F8F6BAC1F1F572B, 0.38698:A6536B31, 1.41134:86000000, 1.41134:46000000, 0.37692:140F7FA4, 0.37948:86000000, 5.33852:00000000534D545000000000, 7.36354:010000000000010900000000, 1.46439:0A000000, 1.115228:00000000, 0.104668:86000100, 1.44903:25000000, 1.115228:00000000, 5.56248:DC04000053656E64417320636865636B206661696C65642062656375617365204149206973206E756C6C0000, 7.40748:010000000000010B12000000, 7.57132:000000000000000074654372, 4.39640:DC040000, 1.63016:32000000, 8.45434:DFEE9A4FC0E67D4583EEB2102B8C3EEF00636570, 0.104348:00000000, 5.46798:040000004D61696C4974656D5375626D697373696F6E00363A663764, 7.51330:0885112F812ADE083262362D, 5.10786:0000000031352E32302E393334332E3031313A4D4559503238324D42313937363A66376432336161322D616162322D343262362D396332612D3766303863643737313838393A3138303335363A2E4E455420382E302E323100000000, 0.39570:12000000, 1.55954:0A000000, 1.33010:0A000000, 2.54258:00000000, 0.40002:00000000, 1.56562:00000000, <br />The following SMTP error was encountered: 554 5.2.252 SendAsDenied; info@bizadmin.com.au not allowed to send as noreply@bizadmin.com.au; STOREDRV.Submission.Exception:SendAsDeniedException.MapiExceptionSendAsDenied; Failed to process message due to a permanent exception with message [BeginDiagnosticData]Cannot submit message. 1.84300:0A000000, 1.84300:0A000000, 1.84300:0E000000, 1.84300:32000000, 1.73948:00000000, 1.108572:00000000, 0.117068:0B000000, 1.79180:0A000000, 1.79180:0A000000, 1.79180:0E000000, 1.79180:32000000, 1.79180:FA000000, 255.731<br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Sun, 23 Nov 2025 22:12:25 +1100
From: &quot;Bizadmin&quot; &lt;noreply@bizadmin.com.au&gt;
Return-Path: &lt;noreply@bizadmin.com.au&gt;
To: adityakohli467@gmail.com
Subject: =?UTF-8?Q?Bizadmin=20-=20Forgotten=20Password=20Verification?=
Reply-To: &lt;noreply@bizadmin.com.au&gt;
User-Agent: CodeIgniter
X-Sender: noreply@bizadmin.com.au
X-Mailer: CodeIgniter
X-Priority: 3 (Normal)
Message-ID: &lt;6922ec19cc2f2@bizadmin.com.au&gt;
Mime-Version: 1.0


Content-Type: multipart/alternative; boundary=&quot;B_ALT_6922ec19cc307&quot;

This is a multi-part message in MIME format.
Your email application may not support this format.

--B_ALT_6922ec19cc307
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit

Dear Customer
 A new password was requested for your Bizadmin staff account.
 To reset your password, please click on the link below:

Please click this link to Reset Your Password.
Kind regards,
 Bizadmin

--B_ALT_6922ec19cc307
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: quoted-printable

&lt;html&gt;=0A&lt;body&gt;=0A    &lt;p&gt; Dear Customer&lt;/p&gt;=0A    &lt;p&gt;A new password was req=
uested for your Bizadmin staff account.&lt;/p&gt;=0A    &lt;p&gt;To reset your password=
, please click on the link below:&lt;/p&gt;=0A=0A=09&lt;p&gt;Please click this link to =
&lt;a href=3D&quot;https://bizadmin.com.au/index.php/auth/reset_password/5da0133d08=
2326d63145.9bd5a87b2cf5f9f5b9fd6ab1d2d1da890ab393356e8c122e41202e42eae0b757=
9522abd35a139817&quot;&gt;Reset Your Password&lt;/a&gt;.&lt;/p&gt;=0A&lt;p&gt;Kind regards,&lt;/p&gt;=0A&lt;p&gt;=
 Bizadmin&lt;/p&gt;=0A&lt;/body&gt;=0A&lt;/html&gt;

--B_ALT_6922ec19cc307--</pre>
ERROR - 2025-11-23 22:13:33 --> 404 Page Not Found: /index
ERROR - 2025-11-23 22:14:19 --> 404 Page Not Found: /index
ERROR - 2025-11-23 22:14:27 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-11-23 22:14:27 --> Severity: Warning --> Undefined property: stdClass::$sunday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-11-23 22:14:27 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-11-23 22:15:55 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-11-23 22:16:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '*
FROM (`HR_employee` `e`, `HR_emp_position`)
LEFT JOIN `HR_empIdToLocationId` `' at line 1 - Invalid query: SELECT DISTINCT CONCAT_WS(" ", `e`.`first_name`, e.last_name) as name, `e`.`company_name`, `e`.`userId`, `e`.`created_at`, `e`.`emp_id`, `e`.`email`, `e`.`phone`, `e`.`status`, `e`.`stress_profile`, `ep`.`position_id`, *
FROM (`HR_employee` `e`, `HR_emp_position`)
LEFT JOIN `HR_empIdToLocationId` `el` ON `e`.`emp_id` = `el`.`empId`
LEFT JOIN `HR_emp_to_position` `ep` ON `e`.`emp_id` = `ep`.`emp_id`
WHERE `e`.`is_deleted` = 0
AND `is_deleted` = 0
ERROR - 2025-11-23 22:16:01 --> Database query failed: SELECT DISTINCT CONCAT_WS(" ", `e`.`first_name`, e.last_name) as name, `e`.`company_name`, `e`.`userId`, `e`.`created_at`, `e`.`emp_id`, `e`.`email`, `e`.`phone`, `e`.`status`, `e`.`stress_profile`, `ep`.`position_id`, *
FROM (`HR_employee` `e`, `HR_emp_position`)
LEFT JOIN `HR_empIdToLocationId` `el` ON `e`.`emp_id` = `el`.`empId`
LEFT JOIN `HR_emp_to_position` `ep` ON `e`.`emp_id` = `ep`.`emp_id`
WHERE `e`.`is_deleted` = 0
AND `is_deleted` = 0
ERROR - 2025-11-23 22:16:01 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-11-23 22:16:02 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-11-23 22:16:02 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-11-23 22:16:02 --> Query error: Table 'bizadmincom_mainwebsite.Global_userid_to_roles' doesn't exist - Invalid query: SELECT `Global_userid_to_roles`.`group_id` as `id`, `Global_roles`.`name`, `Global_roles`.`description`
FROM `Global_userid_to_roles`
JOIN `Global_roles` ON `Global_userid_to_roles`.`group_id`=`Global_roles`.`id`
WHERE `Global_userid_to_roles`.`user_id` IS NULL
ERROR - 2025-11-23 22:16:02 --> Severity: error --> Exception: Call to a member function result() on bool /home/bizadmincom/public_html/application/controllers/Auth.php 28
ERROR - 2025-11-23 22:16:07 --> Severity: Warning --> Undefined variable $empId /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 35
ERROR - 2025-11-23 22:16:07 --> Severity: Warning --> Undefined property: stdClass::$sunday /home/bizadmincom/public_html/application/modules/HR/controllers/Home.php 40
ERROR - 2025-11-23 22:16:07 --> Severity: Warning --> filemtime(): stat failed for style.css /home/bizadmincom/public_html/application/views/general/header.php 8
ERROR - 2025-11-23 23:04:41 --> Query error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist - Invalid query: SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = 9999 AND system_id = 9999
ERROR - 2025-11-23 23:04:41 --> DB error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist
ERROR - 2025-11-23 23:04:43 --> Query error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist - Invalid query: SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = 9999 AND system_id = 9999
ERROR - 2025-11-23 23:04:43 --> DB error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist
ERROR - 2025-11-23 23:04:53 --> Query error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist - Invalid query: SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = 9999 AND system_id = 9999
ERROR - 2025-11-23 23:04:53 --> DB error: Table 'bizadmincom_mainwebsite.Global_SmtpSettings' doesn't exist
