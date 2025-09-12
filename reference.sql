-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2024 at 10:39 AM
-- Server version: 8.0.39
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bizadmincom_tarator`
--

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_bank_deposit`
--

CREATE TABLE `CASH_ci_bank_deposit` (
  `id` int NOT NULL,
  `till_id` int DEFAULT NULL,
  `depositMonth` varchar(10) DEFAULT NULL,
  `depositYear` varchar(10) DEFAULT NULL,
  `bank_deposit_data` varchar(300) NOT NULL,
  `location_id` int DEFAULT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_bank_reconcile`
--

CREATE TABLE `CASH_ci_bank_reconcile` (
  `id` int NOT NULL,
  `item_details` mediumtext NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `month` varchar(12) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `completedRecordDates` varchar(5000) DEFAULT NULL,
  `datesBanked` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_bank_reconcile_attachments`
--

CREATE TABLE `CASH_ci_bank_reconcile_attachments` (
  `id` int NOT NULL,
  `upload_date` date DEFAULT NULL,
  `file_name` varchar(300) DEFAULT NULL COMMENT 'bank receipt image',
  `ip` varchar(30) NOT NULL,
  `location_id` int NOT NULL COMMENT 'or branch_id'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_cash_deposit`
--

CREATE TABLE `CASH_ci_cash_deposit` (
  `id` int NOT NULL,
  `admin_id` int DEFAULT NULL,
  `till_id` varchar(100) DEFAULT NULL,
  `startShiftCoins` varchar(500) DEFAULT NULL COMMENT 'this is to store coins and notes for start shift',
  `endShiftNotes` varchar(500) DEFAULT NULL COMMENT 'this is to store coins and notes for start shift',
  `coins` text,
  `notes` text,
  `coins1` text,
  `notes1` text,
  `items_detail` longtext,
  `entrytotal` varchar(255) DEFAULT NULL,
  `startShiftEntrytotal` float DEFAULT '0',
  `regtotal` varchar(255) DEFAULT NULL COMMENT 'cash in coin bag for staff',
  `registerFloat` float DEFAULT '0',
  `pettyCash` float DEFAULT '0',
  `requiredRegisterAmount` float DEFAULT NULL,
  `staffVariance` float DEFAULT '0',
  `stdcashfloat` varchar(255) DEFAULT NULL,
  `entrytotal1` varchar(255) DEFAULT NULL,
  `regtotal1` varchar(255) DEFAULT NULL COMMENT 'cash in coin bag for manager',
  `registerFloat1` float DEFAULT '0',
  `pettyCash1` float DEFAULT '0',
  `depositM1` float(10,2) DEFAULT NULL,
  `depositM2` float(10,2) DEFAULT NULL,
  `requiredRegisterAmount1` float DEFAULT NULL,
  `managerVariance` float DEFAULT '0',
  `varience` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `Month` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `deleted` int DEFAULT '0',
  `staffComments` varchar(500) DEFAULT NULL,
  `managerComments` varchar(500) DEFAULT NULL,
  `shiftStarted` tinyint(1) DEFAULT '0',
  `shiftEnded` tinyint(1) DEFAULT '0',
  `IsStafffinalSubmissionDone` varchar(5) DEFAULT NULL,
  `IsManagerfinalSubmissionDone` varchar(5) DEFAULT NULL,
  `IsfinalSubmissionDoneForStartShift` varchar(5) DEFAULT NULL,
  `location_id` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_configuration`
--

CREATE TABLE `CASH_ci_configuration` (
  `id` int NOT NULL,
  `configureFor` varchar(100) DEFAULT NULL,
  `data` varchar(2000) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  `metaData` varchar(1000) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `time_of_notification` varchar(22) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_floats`
--

CREATE TABLE `CASH_ci_floats` (
  `id` int NOT NULL,
  `till_id` varchar(100) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `coins` text,
  `notes` text,
  `coins1` text,
  `notes1` text,
  `frontCounterFloatCoinsNotesM1` varchar(2000) DEFAULT NULL COMMENT 'coins and notes for manager one',
  `frontCounterFloatCoinsNotesM2` varchar(2000) DEFAULT NULL COMMENT 'coins and notes for manager two',
  `items_detail` longtext,
  `entrytotal` varchar(255) DEFAULT NULL,
  `floatTotal` varchar(255) DEFAULT NULL,
  `managerFloatTotal` float DEFAULT NULL,
  `totalcash` varchar(255) DEFAULT NULL,
  `entrytotal1` varchar(255) DEFAULT NULL,
  `managerVarience` float DEFAULT NULL,
  `staffVarience` float DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `status` int DEFAULT NULL,
  `deleted` int DEFAULT '0',
  `float_type` varchar(10) DEFAULT 'weekly',
  `commentsEntered` varchar(500) DEFAULT NULL,
  `staffComments` varchar(500) DEFAULT NULL,
  `managerComments` varchar(500) DEFAULT NULL,
  `frontCounterFloatTableFooterTotals` varchar(1000) DEFAULT NULL,
  `staffOfficeFloatComments` varchar(500) DEFAULT NULL,
  `managerOfficeFloatComments` varchar(500) DEFAULT NULL,
  `m2_of_fc_floatvarience` varchar(11) DEFAULT NULL,
  `staffFrontCounterFloatComments` varchar(500) DEFAULT NULL,
  `managerFrontCounterFloatComments` varchar(500) DEFAULT NULL,
  `IsfinalSubmissionDoneForFloat` varchar(33) DEFAULT NULL,
  `manager2finalSubmissionDoneForFloat` varchar(4) DEFAULT 'no',
  `location_id` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_frontOfficeBuild`
--

CREATE TABLE `CASH_ci_frontOfficeBuild` (
  `id` int NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted` int DEFAULT '0',
  `status` int DEFAULT NULL COMMENT 'this status is for hide and show this record',
  `otherDetails` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `orderStatus` varchar(30) DEFAULT NULL COMMENT 'New,Confirmed,Viewed',
  `amountInCashTotal` float(10,2) DEFAULT NULL,
  `bankComments` varchar(300) DEFAULT NULL,
  `location_id` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_officeBuild`
--

CREATE TABLE `CASH_ci_officeBuild` (
  `id` int NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted` int DEFAULT '0',
  `status` int DEFAULT NULL,
  `otherDetails` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `amountInCashTotal` float(10,2) DEFAULT NULL,
  `orderStatus` varchar(30) DEFAULT NULL,
  `bankComments` varchar(500) DEFAULT NULL,
  `location_id` tinyint(1) DEFAULT NULL,
  `isBankmailSent` varchar(4) DEFAULT NULL COMMENT 'to know if bank order mail is already sent'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CASH_ci_tills`
--

CREATE TABLE `CASH_ci_tills` (
  `id` int NOT NULL,
  `till_name` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `status` int NOT NULL,
  `location_id` tinyint(1) DEFAULT NULL,
  `deleted` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `CLEAN_configuration`
--

CREATE TABLE `CLEAN_configuration` (
  `id` int NOT NULL,
  `configureFor` varchar(20) DEFAULT NULL,
  `data` varchar(400) NOT NULL,
  `location` int NOT NULL,
  `metaData` varchar(200) DEFAULT NULL,
  `created_date` date NOT NULL,
  `time_of_notification` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CLEAN_prepArea`
--

CREATE TABLE `CLEAN_prepArea` (
  `id` int NOT NULL,
  `prep_name` varchar(50) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `site_id` tinyint DEFAULT NULL COMMENT 'to wch site this prep area belongs to',
  `sort_order` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CLEAN_record_History`
--

CREATE TABLE `CLEAN_record_History` (
  `id` int NOT NULL,
  `site_id` int NOT NULL,
  `prep_id` int DEFAULT NULL,
  `task_id` int NOT NULL,
  `date_entered` date NOT NULL,
  `staff_comments` varchar(200) NOT NULL,
  `manager_comments` varchar(200) NOT NULL,
  `entered_by` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'name of person entering this record',
  `location_id` int NOT NULL,
  `entered_time` varchar(40) DEFAULT NULL,
  `attachment` varchar(1000) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CLEAN_sites`
--

CREATE TABLE `CLEAN_sites` (
  `id` int NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `location_id` int NOT NULL,
  `emailNotify` tinyint DEFAULT '0',
  `emailToNotify` varchar(50) DEFAULT NULL,
  `manager_comments` varchar(5000) DEFAULT NULL,
  `staff_comments` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CLEAN_tasks`
--

CREATE TABLE `CLEAN_tasks` (
  `id` int NOT NULL,
  `task_name` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prep_id` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'wch prep area this task belongs to',
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `task_time` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `role_id` varchar(220) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_attchmentRequired` tinyint(1) DEFAULT NULL,
  `schedule_at` tinyint(1) DEFAULT NULL COMMENT '0=Daily,1=Weekly,2=Monthly, 3=every 3 months,4= every 4 months,5= every 6 months',
  `schedule_date` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `schedule_type` varchar(5) DEFAULT NULL COMMENT 'day or date',
  `schedule_dayName` varchar(15) DEFAULT NULL COMMENT 'day name like monday,tuesday etc',
  `repeatWhichWeek` int DEFAULT NULL COMMENT 'can be 1,2,3,4'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compliance_prepArea`
--

CREATE TABLE `Compliance_prepArea` (
  `id` int NOT NULL,
  `prep_name` varchar(50) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `site_id` tinyint DEFAULT NULL COMMENT 'to wch site this prep area belongs to',
  `sort_order` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compliance_record_History`
--

CREATE TABLE `Compliance_record_History` (
  `id` int NOT NULL,
  `site_id` int NOT NULL,
  `prep_id` int DEFAULT NULL,
  `task_id` int NOT NULL,
  `date_entered` date NOT NULL,
  `staff_comments` varchar(200) NOT NULL,
  `manager_comments` varchar(200) NOT NULL,
  `entered_by` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'name of person entering this record',
  `location_id` int NOT NULL,
  `entered_time` varchar(40) DEFAULT NULL,
  `attachment` varchar(1000) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compliance_sites`
--

CREATE TABLE `Compliance_sites` (
  `id` int NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `location_id` int NOT NULL,
  `emailNotify` tinyint DEFAULT '0',
  `emailToNotify` varchar(50) DEFAULT NULL,
  `manager_comments` varchar(5000) DEFAULT NULL,
  `staff_comments` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compliance_tasks`
--

CREATE TABLE `Compliance_tasks` (
  `id` int NOT NULL,
  `task_name` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prep_id` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'wch prep area this task belongs to',
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `task_time` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `role_id` varchar(220) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_attchmentRequired` tinyint(1) DEFAULT NULL,
  `schedule_at` tinyint(1) DEFAULT NULL COMMENT '0=Daily,1=Weekly,2=Monthly, 3=every 3 months,4= every 4 months,5= every 6 months',
  `schedule_date` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `schedule_type` varchar(5) DEFAULT NULL COMMENT 'day or date',
  `schedule_dayName` varchar(15) DEFAULT NULL COMMENT 'day name like monday,tuesday etc',
  `repeatWhichWeek` int DEFAULT NULL COMMENT 'can be 1,2,3,4'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DMS_documents`
--

CREATE TABLE `DMS_documents` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `file_display_name` varchar(200) DEFAULT NULL COMMENT 'this is whatever user enter file name while uploading',
  `folder_id` int NOT NULL,
  `subfolder_id` int NOT NULL,
  `status` int NOT NULL,
  `created_date` date NOT NULL,
  `location_id` int NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DMS_folders`
--

CREATE TABLE `DMS_folders` (
  `id` int NOT NULL,
  `folder_name` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `role_ids` varchar(200) NOT NULL COMMENT 'which roles can access this folder',
  `status` tinyint(1) NOT NULL,
  `location_id` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DMS_sub_folders`
--

CREATE TABLE `DMS_sub_folders` (
  `id` int NOT NULL,
  `subfolder_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `folder_id` int NOT NULL COMMENT 'sch folder this sub folder belongs to',
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `role_ids` varchar(200) NOT NULL COMMENT 'which roles can access this folder',
  `status` tinyint(1) NOT NULL,
  `location_id` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_checklist`
--

CREATE TABLE `Global_checklist` (
  `id` int NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `descr` varchar(300) NOT NULL,
  `system_id` tinyint(1) NOT NULL COMMENT 'for which system this checklist is for',
  `has_subtask` tinyint(1) DEFAULT '0',
  `urlSystem` varchar(15) NOT NULL,
  `role_id` varchar(100) DEFAULT NULL COMMENT 'if checklist is for any specific role',
  `is_temp_checked` varchar(4) DEFAULT NULL,
  `temp` varchar(20) DEFAULT NULL,
  `schedule_at` varchar(100) DEFAULT NULL COMMENT '0=Daily,1= weekly,2=15days,3=monthly,5=custom dates,4=yearly',
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `location_id` tinyint(1) DEFAULT NULL,
  `created_at` date NOT NULL,
  `checklist_start_date` varchar(100) DEFAULT NULL,
  `checklist_end_date` varchar(100) DEFAULT NULL,
  `sort_order` int DEFAULT NULL,
  `deadline_time` varchar(10) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `deleted_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='store all checklist for all system, kindof reminder for empl';

-- --------------------------------------------------------

--
-- Table structure for table `Global_checklistToDateCompleted`
--

CREATE TABLE `Global_checklistToDateCompleted` (
  `id` int NOT NULL,
  `checklist_id` int NOT NULL,
  `attachment` varchar(500) DEFAULT NULL,
  `checklistComments` varchar(1000) DEFAULT NULL,
  `date_completed` date NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `date_modified` date DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='to track of checklist complted on a particular day/date';

-- --------------------------------------------------------

--
-- Table structure for table `Global_configuration`
--

CREATE TABLE `Global_configuration` (
  `id` int NOT NULL,
  `data` varchar(500) NOT NULL,
  `metaData` varchar(100) DEFAULT NULL,
  `configureFor` varchar(50) DEFAULT NULL,
  `location` int DEFAULT NULL,
  `created_date` date NOT NULL,
  `time_of_notification` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'at what time this notification will be sent',
  `methodName` varchar(100) DEFAULT NULL COMMENT 'this field will be used while sending notification using cron job',
  `system_id` int DEFAULT NULL,
  `systemName` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_locations`
--

CREATE TABLE `Global_locations` (
  `location_id` int NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `sub_locations_ids` varchar(100) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_notification`
--

CREATE TABLE `Global_notification` (
  `id` int NOT NULL,
  `system_id` int DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `descr` varchar(200) DEFAULT NULL,
  `location_id` int NOT NULL,
  `role_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1= not read, 0 = read',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notification_type` varchar(20) NOT NULL COMMENT 'to know if its [alert,msg,info]alert,simple message,or information etc',
  `is_deleted` int NOT NULL DEFAULT '0',
  `deleted_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='for all the notification in system';

-- --------------------------------------------------------

--
-- Table structure for table `Global_roleId_to_menu`
--

CREATE TABLE `Global_roleId_to_menu` (
  `id` int NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `menu_id` tinyint(1) NOT NULL COMMENT 'parent_menu_id',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `system_id` tinyint(1) NOT NULL,
  `sub_menu_id` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_roleId_to_subMenuId`
--

CREATE TABLE `Global_roleId_to_subMenuId` (
  `id` int NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `sub_menu_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_roles`
--

CREATE TABLE `Global_roles` (
  `id` mediumint UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `displayName` varchar(50) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `menu_ids` varchar(2000) DEFAULT NULL,
  `sub_menu_ids` varchar(4000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `showSeprateChecklist` tinyint(1) DEFAULT '0',
  `location_id` tinyint(1) NOT NULL COMMENT 'location sopecificr role, role_id 0 is common for all locations'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='different roles ,please dont chnage id for any role it will break system, as we have conditions based on role_id';

-- --------------------------------------------------------

--
-- Table structure for table `Global_SmtpSettings`
--

CREATE TABLE `Global_SmtpSettings` (
  `id` int NOT NULL,
  `location_id` int NOT NULL COMMENT '9999 -> is global smtp wch can be used as a backup to send email id orifinal smtp of orz. is not working',
  `system_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `smtp_host` varchar(50) NOT NULL,
  `smtp_username` varchar(100) NOT NULL,
  `smtp_pass` varchar(50) NOT NULL,
  `smtp_port` varchar(20) NOT NULL,
  `smtp_encryptionType` varchar(10) DEFAULT NULL,
  `mail_protocol` varchar(10) NOT NULL COMMENT 'mail or smtp',
  `mail_port` int DEFAULT NULL,
  `mail_from` varchar(100) DEFAULT NULL,
  `reply_to` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='one smtp with username "info@bizadmin" shld always be there for backup';

-- --------------------------------------------------------

--
-- Table structure for table `Global_subchecklist`
--

CREATE TABLE `Global_subchecklist` (
  `id` int NOT NULL,
  `parent_checklistId` int NOT NULL,
  `descr` varchar(500) NOT NULL,
  `is_completed` tinyint NOT NULL COMMENT '1=complted,0 - not complted,2 deadline reached but not completed',
  `file_uploaded` varchar(200) DEFAULT NULL,
  `is_temp_checked` varchar(3) DEFAULT '0' COMMENT '1=checked for temperature',
  `comments` varchar(500) DEFAULT NULL COMMENT 'comments/execuse by staff or manager',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subchecklist_time` varchar(12) DEFAULT NULL,
  `temp` varchar(4) DEFAULT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_sublocations`
--

CREATE TABLE `Global_sublocations` (
  `id` int NOT NULL,
  `name` int NOT NULL,
  `status` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Global_system`
--

CREATE TABLE `Global_system` (
  `system_id` int NOT NULL,
  `name` int NOT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='This will store all the system like HR, Cash, Supplier etc';

-- --------------------------------------------------------

--
-- Table structure for table `Global_todoList`
--

CREATE TABLE `Global_todoList` (
  `id` int NOT NULL,
  `descr` varchar(400) NOT NULL,
  `location_id` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='user specific todo list wch will be deleted everyday automat';

-- --------------------------------------------------------

--
-- Table structure for table `Global_userid_to_roles`
--

CREATE TABLE `Global_userid_to_roles` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group_id` mediumint UNSIGNED NOT NULL COMMENT 'it is role id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='user id and group id connection';

-- --------------------------------------------------------

--
-- Table structure for table `Global_users`
--

CREATE TABLE `Global_users` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `url_identifier` varchar(100) DEFAULT NULL COMMENT 'used to redirect user when doing reset pass',
  `email` varchar(254) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` int DEFAULT NULL COMMENT 'Orz_id , to establish relation between superadmin orz table and this users table',
  `password` varchar(255) NOT NULL,
  `role_id` tinyint(1) DEFAULT NULL,
  `location_ids` varchar(1000) NOT NULL,
  `menu_ids` varchar(1000) DEFAULT NULL,
  `sub_menu_ids` varchar(2000) DEFAULT NULL,
  `sub_locations_ids` varchar(1000) DEFAULT NULL,
  `system_ids` varchar(1000) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int UNSIGNED NOT NULL,
  `last_login` int UNSIGNED DEFAULT NULL,
  `active` tinyint UNSIGNED DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL,
  `deleted_at` date DEFAULT NULL,
  `overwriteRoleLevelMenu` tinyint NOT NULL DEFAULT '0' COMMENT 'overwrite Role Level Menu bu user level menu',
  `prepIds` varchar(200) DEFAULT NULL COMMENT 'this is for HR timesheet logins only'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='list all users for this company';

-- --------------------------------------------------------

--
-- Table structure for table `Global_users_to_location`
--

CREATE TABLE `Global_users_to_location` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `location_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_addon_items`
--

CREATE TABLE `HR_addon_items` (
  `addon_id` int NOT NULL,
  `users` int NOT NULL,
  `u_amount` double NOT NULL,
  `branches` int NOT NULL,
  `b_amount` double NOT NULL,
  `orders` int NOT NULL,
  `o_amount` int NOT NULL,
  `package_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_applicants_details`
--

CREATE TABLE `HR_applicants_details` (
  `applicants_details_id` int NOT NULL,
  `job_id` int DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `first_name` varchar(222) NOT NULL,
  `last_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `mobile` varchar(222) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `experience` varchar(222) NOT NULL,
  `education` varchar(222) DEFAULT NULL,
  `message_to_manager` varchar(1000) DEFAULT NULL,
  `resume` varchar(222) NOT NULL,
  `docs` varchar(200) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_careers`
--

CREATE TABLE `HR_careers` (
  `id` int NOT NULL,
  `job_name` varchar(300) NOT NULL,
  `job_desc` varchar(2000) DEFAULT NULL,
  `responsibilites` varchar(2000) DEFAULT NULL,
  `job_type` varchar(10) DEFAULT NULL,
  `salary` varchar(200) DEFAULT NULL,
  `additional_info` varchar(1000) DEFAULT NULL,
  `branch_id` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `date_posted` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_configuration`
--

CREATE TABLE `HR_configuration` (
  `id` int NOT NULL,
  `configureFor` varchar(20) DEFAULT NULL,
  `data` varchar(400) NOT NULL,
  `location` int NOT NULL,
  `metaData` varchar(200) DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_contractors`
--

CREATE TABLE `HR_contractors` (
  `id` int NOT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `unit_number` varchar(20) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `street_name` varchar(200) DEFAULT NULL,
  `suburb` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `nextkin_name_two` varchar(70) DEFAULT NULL,
  `nextkin_relationship_two` varchar(70) DEFAULT NULL,
  `nextkin_email_two` varchar(100) DEFAULT NULL,
  `nextkin_phone_no` varchar(100) DEFAULT NULL,
  `nextkin_street` varchar(70) DEFAULT NULL,
  `nextkin_suburb` varchar(100) DEFAULT NULL,
  `nextkin_state` varchar(100) DEFAULT NULL,
  `nextkin_postcode` varchar(20) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `Saturday_rate` float DEFAULT NULL,
  `Sunday_rate` float DEFAULT NULL,
  `holiday_rate` float DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_descr` varchar(300) DEFAULT NULL,
  `company_contactEmail` varchar(100) DEFAULT NULL,
  `company_contactName` varchar(100) DEFAULT NULL,
  `company_contactNumber` varchar(16) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` date DEFAULT NULL,
  `location_id` int DEFAULT NULL COMMENT 'this is primary location',
  `locationIds` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for contractors';

-- --------------------------------------------------------

--
-- Table structure for table `HR_contractorsToLocationId`
--

CREATE TABLE `HR_contractorsToLocationId` (
  `id` int NOT NULL,
  `contractorId` int NOT NULL,
  `location_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='to know a employee is allocated to how many location ,for Hr';

-- --------------------------------------------------------

--
-- Table structure for table `HR_covid`
--

CREATE TABLE `HR_covid` (
  `covid_id` int NOT NULL,
  `staff_name` varchar(1055) NOT NULL,
  `reporting_date` date DEFAULT NULL,
  `reporting_time` time DEFAULT NULL,
  `temperature` varchar(11) NOT NULL,
  `Chills` varchar(11) NOT NULL,
  `Cough` varchar(11) NOT NULL,
  `sore_throat` varchar(11) NOT NULL,
  `breath` varchar(11) NOT NULL,
  `running_nose` varchar(11) NOT NULL,
  `smell` varchar(11) NOT NULL,
  `comment` varchar(1055) NOT NULL,
  `emp_id` int DEFAULT NULL,
  `emp_name` varchar(1055) DEFAULT NULL,
  `branch_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_docs`
--

CREATE TABLE `HR_docs` (
  `doc_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `path` varchar(250) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_document`
--

CREATE TABLE `HR_document` (
  `document_id` int NOT NULL,
  `doc_name` varchar(500) DEFAULT NULL,
  `document_name` varchar(1055) NOT NULL,
  `role` int NOT NULL,
  `branch_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_empIdToLocationId`
--

CREATE TABLE `HR_empIdToLocationId` (
  `id` int NOT NULL,
  `empId` int NOT NULL,
  `location_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='to know a employee is allocated to how many location ,for Hr';

-- --------------------------------------------------------

--
-- Table structure for table `HR_employee`
--

CREATE TABLE `HR_employee` (
  `emp_id` int NOT NULL,
  `userId` int NOT NULL COMMENT 'column to establish relation between user table and employee table, as all employee we add in user table also, for future modification we need user_id',
  `onboarding_status` int NOT NULL,
  `first_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pin` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `emp_availability` varchar(3000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `employee_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '1= full time\r\n2=part time\r\n3= casual',
  `email` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rate` float DEFAULT NULL,
  `Saturday_rate` float DEFAULT NULL,
  `Sunday_rate` float DEFAULT NULL,
  `holiday_rate` float DEFAULT NULL,
  `uniform_allowance` float DEFAULT NULL,
  `early_start` float DEFAULT NULL,
  `late_night` float DEFAULT NULL,
  `title` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dob` date NOT NULL,
  `effective_start_date` date NOT NULL,
  `unit_number` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `street_name` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `street` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `suburb` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `postcode` int NOT NULL,
  `state` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stress_profile` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tfn_number` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `super_fund_name` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `super_annuation_no` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `heighest_acd_achmts` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pre_emp_hstry_one` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pre_emp_hstry_two` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pre_emp_hstry_three` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `visa_status` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_name_one` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_email_one` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_phone_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nextkin_relationship_one` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_name_two` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_email_two` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_relationship_two` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_street` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_suburb` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_state` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nextkin_postcode` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agree_terms_one` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agree_terms_two` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agree_terms_three` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `location_id` int NOT NULL COMMENT 'main location id ',
  `location_ids` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'all the locations allocated to this employee',
  `bank_1` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bsb_1` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `account_no_1` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `percentage_1` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `account_name_1` varchar(222) NOT NULL,
  `bank_2` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bsb_2` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `account_no_2` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `entity` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `police_surname` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `given_name` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `percentage_2` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `account_name_2` varchar(222) NOT NULL,
  `bank_3` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bsb_3` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `account_no_3` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `percentage_3` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `account_name_3` varchar(222) NOT NULL,
  `police_certificate` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `medical_history` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fire_emg_completed_date` date NOT NULL,
  `oh_s_completed_date` date NOT NULL,
  `tax_declaration` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vaccination_certificate` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `completed_super_annu` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `advice_of_tax_file` varchar(222) NOT NULL,
  `quality_assurance` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `job_desc` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `manager_id` int DEFAULT NULL,
  `manager_email` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `manager_name` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `tracking_mail` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'No',
  `pdf_first_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pdf_emp_id_no` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pdf_apra_fund_abh` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `check_super_type` varchar(4) DEFAULT 'no',
  `pdf_apra_fund_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pdf_apra_fund_usi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pdf_apra_fund_member_no` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `check_tfn_type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'tfn_number',
  `tfn_type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `previous_surname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `have_surname_changed` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `resident_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `loan_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `job_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `claim_tax_free` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `last_updated_at` date NOT NULL,
  `last_updated_by` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_deleted` date NOT NULL,
  `stepsCompleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'to track how many steps employee completed in onboarding form',
  `nominatedByEmployer` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Employee_reimbursement`
--

CREATE TABLE `HR_Employee_reimbursement` (
  `receipt` varchar(1055) DEFAULT NULL,
  `Employee_reimbursement_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `file` varchar(300) DEFAULT NULL,
  `emp_name` varchar(1055) NOT NULL,
  `completed_date` date NOT NULL,
  `total_reimbursement` varchar(1055) NOT NULL,
  `reason` varchar(1055) NOT NULL,
  `br_date` date DEFAULT NULL,
  `business_manager` varchar(300) NOT NULL,
  `branch_id` int DEFAULT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Employee_Self_Assessment`
--

CREATE TABLE `HR_Employee_Self_Assessment` (
  `Employee_Self_Assessment_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `emp_name` varchar(500) NOT NULL,
  `completed_date` date NOT NULL,
  `improve_on` varchar(1055) NOT NULL,
  `steps` varchar(1055) NOT NULL,
  `goals` varchar(1055) NOT NULL,
  `branch_id` int DEFAULT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_employee_timesheet`
--

CREATE TABLE `HR_employee_timesheet` (
  `employee_timesheet_id` int NOT NULL,
  `timesheet_id` int DEFAULT NULL,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `break_in_time` time DEFAULT NULL,
  `break_out_time` time DEFAULT NULL,
  `in_verify` int DEFAULT NULL,
  `out_verify` int DEFAULT NULL,
  `comment` text,
  `roster_group_id` int DEFAULT NULL,
  `roster_id` varchar(100) DEFAULT NULL,
  `outletname` varchar(560) DEFAULT NULL,
  `status` int DEFAULT '1',
  `running_status` int NOT NULL DEFAULT '0' COMMENT '0=Not Started, 1=running, 2=on break, 3=completed',
  `duplicacy_flag` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_emp_availability`
--

CREATE TABLE `HR_emp_availability` (
  `emp_availability_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_emp_department`
--

CREATE TABLE `HR_emp_department` (
  `emp_department_id` int NOT NULL,
  `department_name` varchar(200) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `added_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deteled_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_emp_document`
--

CREATE TABLE `HR_emp_document` (
  `emp_document_id` int NOT NULL,
  `emp_document_name` varchar(200) DEFAULT NULL,
  `emp_document_path` varchar(200) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_emp_evaluation_form`
--

CREATE TABLE `HR_emp_evaluation_form` (
  `emp_evaluation_form_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `emp_id` int DEFAULT NULL,
  `emp_name` varchar(55) DEFAULT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `manager` varchar(200) DEFAULT NULL,
  `rev_period_from` date DEFAULT NULL,
  `rev_period_to` date DEFAULT NULL,
  `options_rating` varchar(4000) DEFAULT NULL,
  `performance_comments` varchar(1000) DEFAULT NULL,
  `qw_comments` varchar(1000) DEFAULT NULL,
  `ap_comments` varchar(1000) DEFAULT NULL,
  `rd_comments` varchar(1000) DEFAULT NULL,
  `cs_comments` varchar(1000) DEFAULT NULL,
  `jdm_comments` varchar(10000) DEFAULT NULL,
  `if_comments` varchar(1000) DEFAULT NULL,
  `kp_comments` varchar(1000) DEFAULT NULL,
  `td_comments` varchar(1000) DEFAULT NULL,
  `ct_comments` varchar(1000) DEFAULT NULL,
  `ol_rating_comments` varchar(1000) DEFAULT NULL,
  `emp_comments` varchar(1000) DEFAULT NULL,
  `emp_sign` varchar(200) DEFAULT NULL,
  `emp_sign_date` date DEFAULT NULL,
  `manager_sign` varchar(200) DEFAULT NULL,
  `manager_sign_date` date DEFAULT NULL,
  `acknowledgement` varchar(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_emp_satisfaction_survey`
--

CREATE TABLE `HR_emp_satisfaction_survey` (
  `emp_satisfaction_survey_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `emp_name` varchar(500) NOT NULL,
  `compensation` varchar(33) NOT NULL,
  `oppurtinity` varchar(33) NOT NULL,
  `benefits` varchar(33) NOT NULL,
  `work_environment` varchar(33) NOT NULL,
  `training` varchar(33) NOT NULL,
  `performance_evaluation` varchar(33) NOT NULL,
  `guidance` varchar(33) NOT NULL,
  `job_satisfaction` varchar(33) NOT NULL,
  `emp_morale` varchar(33) NOT NULL,
  `recommendation` varchar(1055) NOT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_emp_survey`
--

CREATE TABLE `HR_emp_survey` (
  `survey_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `resources` varchar(50) NOT NULL,
  `support` varchar(50) NOT NULL,
  `trainingOptions` varchar(50) NOT NULL,
  `trainingType` varchar(50) NOT NULL,
  `workingConditions` varchar(50) NOT NULL,
  `emergencyInst` varchar(50) NOT NULL,
  `clearRequirements` varchar(50) NOT NULL,
  `communication` varchar(50) NOT NULL,
  `approachableManager` varchar(50) NOT NULL,
  `unlawfulAct` varchar(50) NOT NULL,
  `updatedPolicies` varchar(50) NOT NULL,
  `reportAccident` varchar(50) NOT NULL,
  `terminate` varchar(50) NOT NULL,
  `feelValued` varchar(50) NOT NULL,
  `organizationalValues` varchar(50) NOT NULL,
  `creativity` varchar(50) NOT NULL,
  `progresReviewed` varchar(50) NOT NULL,
  `compensated` varchar(50) NOT NULL,
  `professional` varchar(50) NOT NULL,
  `submitted_at` date NOT NULL,
  `updated_at_IP` varchar(100) NOT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_hr_complaints`
--

CREATE TABLE `HR_hr_complaints` (
  `hr_complaint_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `first_name` varchar(222) NOT NULL,
  `last_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `mobile` varchar(222) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Incident_Report`
--

CREATE TABLE `HR_Incident_Report` (
  `Incident_Report_id` int NOT NULL,
  `emp_id` int DEFAULT NULL,
  `incident_date` date NOT NULL,
  `person_completing_report_name` varchar(230) NOT NULL,
  `incident_time` time NOT NULL,
  `incident_detail` varchar(1055) NOT NULL,
  `action_to_take` varchar(1055) NOT NULL,
  `report_complete_signtaure_date` date NOT NULL,
  `incident_effected_to` varchar(20) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `firstname` varchar(500) DEFAULT NULL,
  `initial` varchar(200) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `postcode` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `incident_place` varchar(100) DEFAULT NULL,
  `is_witness` varchar(4) DEFAULT NULL,
  `witness_name` varchar(100) DEFAULT NULL,
  `witness_Address` varchar(1000) DEFAULT NULL,
  `witness_postcode` varchar(100) DEFAULT NULL,
  `witness_position` varchar(100) DEFAULT NULL,
  `witness_contact` varchar(12) DEFAULT NULL,
  `person_reporting_incident_sign` varchar(200) DEFAULT NULL,
  `person_reporting_incident_sign_date` date DEFAULT NULL,
  `supervisor_comments` varchar(1000) DEFAULT NULL,
  `supervisor_sign` varchar(200) DEFAULT NULL,
  `supervisor_sign_date` date DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `incident_by` varchar(5) DEFAULT NULL,
  `is_acknowdledeged` varchar(4) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Injury_Report`
--

CREATE TABLE `HR_Injury_Report` (
  `injury_file` varchar(500) NOT NULL,
  `Injury_Report_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `work_area` varchar(1055) NOT NULL,
  `supervisor_on_duty` varchar(200) NOT NULL,
  `injury_date` date NOT NULL,
  `injury_time` time NOT NULL,
  `team` varchar(1055) NOT NULL,
  `employee_reporting_injury` varchar(255) NOT NULL,
  `injury_detail` varchar(1055) NOT NULL,
  `injury_time_details` varchar(1055) NOT NULL,
  `body_part_injured` varchar(255) NOT NULL,
  `preventive_measures` varchar(255) NOT NULL,
  `further_information` varchar(1055) NOT NULL,
  `business_manager` varchar(255) NOT NULL,
  `br_date` date NOT NULL,
  `branch_id` int DEFAULT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_interview_assesment`
--

CREATE TABLE `HR_interview_assesment` (
  `interview_assesment_id` int NOT NULL,
  `applicant_name` varchar(100) DEFAULT NULL,
  `rank` int DEFAULT NULL,
  `job_applied_for` varchar(100) DEFAULT NULL,
  `worksite` varchar(100) NOT NULL,
  `first_interviewer_result` int DEFAULT NULL,
  `first_interviewer_name` varchar(100) DEFAULT NULL,
  `first_interviewer_title` varchar(100) DEFAULT NULL,
  `first_interviewer_sign` varchar(100) DEFAULT NULL,
  `first_interviewer_signDate` date DEFAULT NULL,
  `first_interviewer_comment` varchar(200) DEFAULT NULL,
  `second_interviewer_comment` varchar(200) DEFAULT NULL,
  `second_interviewer_name` varchar(100) DEFAULT NULL,
  `second_interviewer_result` int DEFAULT NULL,
  `second_interviewer_title` varchar(100) DEFAULT NULL,
  `second_interviewer_sign` varchar(100) DEFAULT NULL,
  `second_interviewer_signDate` date DEFAULT NULL,
  `Notice_Period` varchar(20) DEFAULT NULL,
  `expected_salary` int DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `Overall_rating` varchar(1000) DEFAULT NULL,
  `sitemanager_sign` varchar(200) DEFAULT NULL,
  `sitemanager_comments` varchar(500) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `hr_status` varchar(1) DEFAULT '1' COMMENT '1=waiting',
  `int_status` varchar(1) NOT NULL DEFAULT '1',
  `hired` int NOT NULL DEFAULT '0',
  `date_added` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Jobkeeper_Nomination_Notice`
--

CREATE TABLE `HR_Jobkeeper_Nomination_Notice` (
  `Jobkeeper_Nomination_Notice_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `business_name` varchar(500) NOT NULL,
  `business_abn` varchar(255) NOT NULL,
  `emp_full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `street_addr` varchar(500) NOT NULL,
  `phone_no` int NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `agree_terms_one` varchar(222) NOT NULL DEFAULT '1',
  `branch_id` int DEFAULT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_job_application`
--

CREATE TABLE `HR_job_application` (
  `job_application_id` int NOT NULL,
  `position` varchar(222) NOT NULL,
  `cafe_location` varchar(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `first_name` varchar(222) NOT NULL,
  `last_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `mobile` varchar(222) NOT NULL,
  `date_of_birth` date NOT NULL,
  `visa_status` varchar(222) NOT NULL,
  `availability` varchar(222) NOT NULL,
  `experience` varchar(222) NOT NULL,
  `qualification` varchar(222) NOT NULL,
  `notes` varchar(222) NOT NULL,
  `resume` varchar(222) NOT NULL,
  `coverletter` varchar(222) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_leaves`
--

CREATE TABLE `HR_leaves` (
  `id` int NOT NULL,
  `leaveTypeName` varchar(150) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `entitlements` int DEFAULT '0' COMMENT 'this is no of leaves allowed per year.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for storing setting ,like leave type etc';

-- --------------------------------------------------------

--
-- Table structure for table `HR_leave_management`
--

CREATE TABLE `HR_leave_management` (
  `leave_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `leave_type` varchar(222) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_status` varchar(222) NOT NULL,
  `new_nominated_person` varchar(200) NOT NULL,
  `medical_certificate` varchar(222) NOT NULL,
  `comments` varchar(222) NOT NULL,
  `branch_id` int NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_memo`
--

CREATE TABLE `HR_memo` (
  `memo_id` int NOT NULL,
  `subject` varchar(1055) DEFAULT NULL,
  `message` varchar(3000) NOT NULL,
  `role` varchar(50) NOT NULL,
  `branch_id` int DEFAULT NULL,
  `emp_id` int DEFAULT NULL,
  `all_role` int DEFAULT NULL,
  `all_staff` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_module_access`
--

CREATE TABLE `HR_module_access` (
  `id` int NOT NULL,
  `moduleId` varchar(225) NOT NULL,
  `userId` int NOT NULL,
  `empId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_notification`
--

CREATE TABLE `HR_notification` (
  `id` int NOT NULL,
  `emp_id` int DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT 'leave,roster etc',
  `send_to` varchar(20) DEFAULT NULL COMMENT 'manager,employee etc',
  `date_added` date NOT NULL,
  `branch_id` int NOT NULL,
  `status` int DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_outlet`
--

CREATE TABLE `HR_outlet` (
  `outlet_id` int NOT NULL,
  `outlet_name` varchar(200) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `added_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deteled_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_packages`
--

CREATE TABLE `HR_packages` (
  `package_id` int NOT NULL,
  `package_name` varchar(250) NOT NULL,
  `validity` varchar(250) NOT NULL,
  `no_of_users` int NOT NULL,
  `no_of_branches` int NOT NULL,
  `no_of_orders` int NOT NULL,
  `amount` int NOT NULL,
  `trail_period` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Probationary_Period`
--

CREATE TABLE `HR_Probationary_Period` (
  `Probationary_Period_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `notes` varchar(500) NOT NULL,
  `branch_id` int NOT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_public_holidays`
--

CREATE TABLE `HR_public_holidays` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `branch_ids` varchar(600) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_reports`
--

CREATE TABLE `HR_reports` (
  `report_id` int NOT NULL,
  `report_name` varchar(500) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sales` varchar(5000) DEFAULT NULL,
  `sales_gst` varchar(5000) DEFAULT NULL,
  `average_hours` varchar(5000) DEFAULT NULL,
  `labour_cost` varchar(5000) DEFAULT NULL,
  `labour_percent` varchar(5000) DEFAULT NULL,
  `hours` varchar(5000) DEFAULT NULL,
  `branch_id` varchar(100) DEFAULT NULL,
  `catering_sales` varchar(5000) DEFAULT NULL,
  `totals` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_Resignation_Letter`
--

CREATE TABLE `HR_Resignation_Letter` (
  `Resignation_Letter_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `resign_note` varchar(500) NOT NULL,
  `resign_date` date NOT NULL,
  `resign_letter` varchar(1055) NOT NULL,
  `branch_id` int DEFAULT NULL,
  `comment` varchar(1055) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_resumes`
--

CREATE TABLE `HR_resumes` (
  `resume_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `candidate_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `job_role` varchar(100) DEFAULT NULL,
  `resume` varchar(200) DEFAULT NULL,
  `cover_letter` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_role`
--

CREATE TABLE `HR_role` (
  `role_id` int NOT NULL,
  `role_name` varchar(500) NOT NULL,
  `branch_id` int NOT NULL,
  `status` int DEFAULT '1',
  `added_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deteled_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_roster`
--

CREATE TABLE `HR_roster` (
  `roster_group_id` int DEFAULT '0',
  `roster_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `month` varchar(50) DEFAULT NULL,
  `roster_name` varchar(100) DEFAULT NULL,
  `mon_start_time` time DEFAULT NULL,
  `mon_end_time` time DEFAULT NULL,
  `mon_break_time` varchar(222) DEFAULT NULL,
  `mon_break_in_out` varchar(500) DEFAULT NULL,
  `tues_start_time` time DEFAULT NULL,
  `tues_end_time` time DEFAULT NULL,
  `tues_break_time` varchar(222) DEFAULT NULL,
  `tues_break_in_out` varchar(500) DEFAULT NULL,
  `wed_start_time` time DEFAULT NULL,
  `wed_end_time` time DEFAULT NULL,
  `wed_break_time` varchar(222) DEFAULT NULL,
  `wed_break_in_out` varchar(500) DEFAULT NULL,
  `thus_start_time` time DEFAULT NULL,
  `thus_end_time` time DEFAULT NULL,
  `thus_break_time` varchar(222) DEFAULT NULL,
  `thus_break_in_out` varchar(500) DEFAULT NULL,
  `fri_start_time` time DEFAULT NULL,
  `fri_end_time` time DEFAULT NULL,
  `fri_break_time` varchar(222) DEFAULT NULL,
  `fri_break_in_out` varchar(500) DEFAULT NULL,
  `sat_start_time` time DEFAULT NULL,
  `sat_end_time` time DEFAULT NULL,
  `sat_break_time` varchar(222) DEFAULT NULL,
  `sat_break_in_out` varchar(500) DEFAULT NULL,
  `sun_start_time` time DEFAULT NULL,
  `sun_end_time` time DEFAULT NULL,
  `sun_break_time` varchar(222) DEFAULT NULL,
  `sun_break_in_out` varchar(500) DEFAULT NULL,
  `Monday_layout` varchar(500) DEFAULT NULL,
  `Tuesday_layout` varchar(500) DEFAULT NULL,
  `Wednesday_layout` varchar(500) DEFAULT NULL,
  `Thursday_layout` varchar(500) DEFAULT NULL,
  `Friday_layout` varchar(500) DEFAULT NULL,
  `Saturday_layout` varchar(500) DEFAULT NULL,
  `Sunday_layout` varchar(500) DEFAULT NULL,
  `branch_id` int NOT NULL,
  `roster_department` varchar(150) DEFAULT NULL,
  `roster_comment` varchar(200) DEFAULT NULL,
  `roster_template` int DEFAULT '0',
  `roster_status` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_stressProfile`
--

CREATE TABLE `HR_stressProfile` (
  `id` int NOT NULL,
  `stressProfileName` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `maxHrsPWeek` int DEFAULT NULL,
  `maxDaysPWeek` int DEFAULT NULL,
  `maxHrsPDay` int DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `is_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='to store all the stree profile';

-- --------------------------------------------------------

--
-- Table structure for table `HR_timesheet`
--

CREATE TABLE `HR_timesheet` (
  `timesheet_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `timesheet_name` varchar(500) DEFAULT NULL,
  `roster_group_id` int DEFAULT NULL,
  `multiple_roster_group_id` varchar(5000) DEFAULT NULL,
  `timesheet_type` varchar(10) DEFAULT NULL,
  `status` int DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_timesheet_comments`
--

CREATE TABLE `HR_timesheet_comments` (
  `timesheet_comment_id` int NOT NULL,
  `timesheet_id` int NOT NULL,
  `roster_id` int NOT NULL,
  `manager_id` int DEFAULT NULL,
  `employee_id` int NOT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  `posted_by` varchar(200) NOT NULL,
  `posted_at_date` datetime DEFAULT NULL,
  `posted_at_time` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HR_weekly_roster_report`
--

CREATE TABLE `HR_weekly_roster_report` (
  `report_id` int NOT NULL,
  `roster_data` varchar(10000) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `branch_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `NotificationEmailConfiguration`
--

CREATE TABLE `NotificationEmailConfiguration` (
  `id` int NOT NULL,
  `data` varchar(3000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `system_id` int NOT NULL,
  `systemName` varchar(30) DEFAULT NULL,
  `time_of_notification` varchar(20) DEFAULT NULL COMMENT 'the time at cron job will work for this notification',
  `location` int DEFAULT NULL,
  `configureFor` varchar(33) DEFAULT NULL,
  `metaData` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `methodName` varchar(100) DEFAULT NULL COMMENT 'for sending cron mail we will create sam method name in cron.php'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_areaId_to_supplierId`
--

CREATE TABLE `SUPPLIERS_areaId_to_supplierId` (
  `id` int NOT NULL,
  `area_id` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_areaList`
--

CREATE TABLE `SUPPLIERS_areaList` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `location_id` tinyint NOT NULL,
  `supplier_ids` varchar(100) DEFAULT NULL,
  `created_at` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `is_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_budgetRecord`
--

CREATE TABLE `SUPPLIERS_budgetRecord` (
  `id` int NOT NULL,
  `subcatId` int NOT NULL,
  `supplier_id` int NOT NULL,
  `weeklyBudget` float DEFAULT '0',
  `monthlyBudget` float NOT NULL DEFAULT '0',
  `weeklySpent` float DEFAULT NULL,
  `monthlySpent` float DEFAULT NULL,
  `weeklyPercentage` float DEFAULT NULL,
  `monthlyPercentage` float DEFAULT NULL,
  `date_entered` date NOT NULL,
  `location_id` int NOT NULL,
  `weekNumber` int NOT NULL COMMENT 'for which week like first,second...',
  `monthNumber` int NOT NULL COMMENT 'for which month like Jan,Feb...',
  `Year` int NOT NULL COMMENT 'for which year like\r\n2023,2024...'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for storing budget assigned for individual supplier';

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_configuration`
--

CREATE TABLE `SUPPLIERS_configuration` (
  `id` int NOT NULL,
  `configureFor` varchar(20) DEFAULT NULL,
  `data` varchar(400) NOT NULL,
  `location` int NOT NULL,
  `metaData` varchar(200) DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderCategory`
--

CREATE TABLE `SUPPLIERS_internalOrderCategory` (
  `id` int NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `location_id` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderLocations`
--

CREATE TABLE `SUPPLIERS_internalOrderLocations` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_kitchen` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `location_id` int NOT NULL COMMENT 'main location like footscray,northshore etc',
  `ccemail` varchar(50) DEFAULT NULL,
  `requireDD` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'require delivery date',
  `comments` varchar(500) DEFAULT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `last_countedAt` date DEFAULT NULL COMMENT 'to know if product count for this sub location has been done today or not',
  `last_deliveryDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderPlacedOrders`
--

CREATE TABLE `SUPPLIERS_internalOrderPlacedOrders` (
  `id` int NOT NULL,
  `location_id` int NOT NULL,
  `sublocation_id` int NOT NULL,
  `delivery_date` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `order_total` double(10,2) DEFAULT NULL,
  `cc_email` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `temp` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `orderProductComments` varchar(300) DEFAULT NULL,
  `driversComment` varchar(200) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderPlacedOrdersProducts`
--

CREATE TABLE `SUPPLIERS_internalOrderPlacedOrdersProducts` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `orderQty` int DEFAULT NULL,
  `date_completed` date DEFAULT NULL,
  `orderProductComments` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `foodTemp` varchar(10) DEFAULT NULL,
  `is_qtyUpdated` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'to check if qty is later updated after placing order',
  `price` double(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='this stores all the product_id for all the internal orders';

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderProductCount`
--

CREATE TABLE `SUPPLIERS_internalOrderProductCount` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `sublocation_id` int NOT NULL COMMENT 'internal locations',
  `dailtQtyNeed` varchar(233) DEFAULT NULL,
  `qtyToMake` varchar(233) DEFAULT NULL,
  `date_completed` date NOT NULL,
  `location_id` int NOT NULL COMMENT 'its main branch id like bendigo, werribee etc'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderProducts`
--

CREATE TABLE `SUPPLIERS_internalOrderProducts` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `sublocation_id` varchar(100) DEFAULT NULL,
  `location_id` int NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `requireAttach` int DEFAULT '0',
  `requireTemp` int DEFAULT '0',
  `uom` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_internalOrderProductsToSubLocation`
--

CREATE TABLE `SUPPLIERS_internalOrderProductsToSubLocation` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `sublocation_id` int NOT NULL,
  `par_level` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_LocationWisebudgetRecord`
--

CREATE TABLE `SUPPLIERS_LocationWisebudgetRecord` (
  `id` int NOT NULL,
  `weeklyLocationBudget` varchar(233) NOT NULL DEFAULT '0',
  `monthlyLocationBudget` varchar(233) NOT NULL DEFAULT '0',
  `weeklyAllocatedBudget` varchar(233) NOT NULL DEFAULT '0',
  `monthlyAllocatedBudget` varchar(233) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL,
  `location_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_monthly_stockCount`
--

CREATE TABLE `SUPPLIERS_monthly_stockCount` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `opening_stock_count` int NOT NULL,
  `purchase_units` int DEFAULT NULL,
  `closing_stock_count` int NOT NULL,
  `units_sold` int NOT NULL,
  `month_name` varchar(10) NOT NULL,
  `year_name` int NOT NULL,
  `created_at` date NOT NULL,
  `date_modified` date NOT NULL,
  `location_id` int NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_orderDetails`
--

CREATE TABLE `SUPPLIERS_orderDetails` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `product_unit_price` float(10,2) NOT NULL COMMENT 'qty x product unit price',
  `total` float(10,2) NOT NULL COMMENT 'qty x product unit price',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_orders`
--

CREATE TABLE `SUPPLIERS_orders` (
  `id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `order_total` float(10,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_info` varchar(10000) NOT NULL,
  `order_comments` varchar(10000) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_CCemail` varchar(100) NOT NULL,
  `status` int NOT NULL COMMENT '0=disabled\r\n1= sent\r\n2=viewed\r\n3=confirmed\r\n4=received\r\n5=pending manager approval incase budget exceeded while placing order\r\n6=rejected by manager',
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `location_id` int NOT NULL,
  `supplierComments` varchar(300) DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `invoice1` varchar(100) DEFAULT NULL,
  `invoice2` varchar(100) DEFAULT NULL,
  `invoice3` varchar(100) DEFAULT NULL,
  `any_damaged_goods` tinyint(1) NOT NULL DEFAULT '0',
  `damaged_goods_attachment` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `location_name` varchar(133) DEFAULT NULL,
  `receiving_person` varchar(200) DEFAULT NULL,
  `temp` int DEFAULT NULL COMMENT 'temperature when receiving the order',
  `paid_in_cash` tinyint(1) DEFAULT NULL,
  `receiver_sign` varchar(1000) DEFAULT NULL,
  `receiving_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_orderStatusList`
--

CREATE TABLE `SUPPLIERS_orderStatusList` (
  `order_status_id` tinyint NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_products`
--

CREATE TABLE `SUPPLIERS_products` (
  `product_id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `product_category_id` int DEFAULT NULL,
  `product_uom_id` int DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `product_status` int DEFAULT NULL COMMENT '0=''deleted'', 1= ''enabled'', 2=''disabled''',
  `is_unapproved` int NOT NULL DEFAULT '1' COMMENT '0=unapproved,1=approved',
  `location_id` tinyint(1) NOT NULL,
  `date_added` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` tinyint NOT NULL DEFAULT '0',
  `account_number` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `tax_code` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_productToBuilto`
--

CREATE TABLE `SUPPLIERS_productToBuilto` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `tier_type` varchar(5) NOT NULL,
  `cafe_unit_uom` int NOT NULL COMMENT 'Boxes,outer most packaging,supplier will identify how many qty need to send in order from this,valid for tier 1 & tier 3',
  `inner_unit_uom` int DEFAULT NULL COMMENT '2nd level tier, inside box , like eggs (tray) inside cafe unit uom(box)',
  `each_unit_uom` int DEFAULT NULL COMMENT 'individial qty, like (eggs,pieces) in a tray\r\n(inner unit uom)\r\nvalid for tier 3',
  `cafe_unit_uomQty` int NOT NULL COMMENT 'how many trays in cafe unit UOM(BOX)',
  `inner_unit_uomQty` int NOT NULL COMMENT 'how many eggs in cafe unit UOM(BOX)',
  `is_sameOnAllDays` int NOT NULL COMMENT 'checkbox to know if buildTo Qty same on all days of week ',
  `PARLevelQty` varchar(233) DEFAULT NULL COMMENT 'buildTo Qty same on all days of week',
  `AllDaysPARLevelQty` varchar(300) DEFAULT NULL COMMENT 'if buildTo qty not same on all days than store diff qty on diff days ',
  `supplier_id` int NOT NULL,
  `cafe_unit_uomCount` int DEFAULT NULL,
  `inner_unit_uomCount` int DEFAULT NULL,
  `orderQty` int DEFAULT NULL,
  `totalStockCountTotalValue` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='store info about all product''s build to qty and tier details';

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_productToBuiltoToAreaQty`
--

CREATE TABLE `SUPPLIERS_productToBuiltoToAreaQty` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `uom_id` varchar(30) NOT NULL,
  `area_id` int NOT NULL,
  `area_count` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='this table is connected to productToBuilto table to store qty for specific areas';

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_product_category`
--

CREATE TABLE `SUPPLIERS_product_category` (
  `product_category_id` int NOT NULL,
  `product_category_name` varchar(200) DEFAULT NULL,
  `product_category_status` int DEFAULT NULL COMMENT '0=''deleted'', 1= ''enabled'', 2=''disabled''',
  `location_id` tinyint(1) NOT NULL,
  `date_added` date DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_product_UOM`
--

CREATE TABLE `SUPPLIERS_product_UOM` (
  `product_UOM_id` int NOT NULL,
  `product_UOM_name` varchar(200) DEFAULT NULL,
  `product_UOM_status` int DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  `location_id` tinyint(1) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_subCategoryBudgetRecord`
--

CREATE TABLE `SUPPLIERS_subCategoryBudgetRecord` (
  `id` int NOT NULL,
  `subcatId` int NOT NULL,
  `weeklyBudget` float DEFAULT '0',
  `monthlyBudget` float NOT NULL DEFAULT '0',
  `weeklyPercentage` float DEFAULT NULL,
  `weeklySpent` float DEFAULT NULL,
  `monthlySpent` float DEFAULT NULL,
  `date_entered` date NOT NULL,
  `location_id` int NOT NULL,
  `weekNumber` int NOT NULL COMMENT 'for which week like first,second...',
  `monthNumber` int NOT NULL COMMENT 'for which month like Jan,Feb...',
  `Year` int NOT NULL COMMENT 'for which year like\r\n2023,2024...',
  `monthlyPercentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for storing budget assigned at sub category ;level';

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_suppliersList`
--

CREATE TABLE `SUPPLIERS_suppliersList` (
  `supplier_id` int NOT NULL,
  `supplier_name` varchar(226) NOT NULL,
  `contact_full_name` varchar(30) DEFAULT NULL,
  `email` varchar(226) NOT NULL,
  `category_id` int DEFAULT NULL COMMENT 'this is sub categry id',
  `cc` varchar(250) NOT NULL,
  `cc2` varchar(250) DEFAULT NULL,
  `mobile` varchar(226) NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0=''disabled'', 1= ''enabled'',',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `haccp_expiry_date` date DEFAULT NULL,
  `cfr_expiry_date` date DEFAULT NULL,
  `budget_type` varchar(33) DEFAULT NULL,
  `cutofftime` varchar(200) DEFAULT NULL,
  `account_code` varchar(30) DEFAULT NULL,
  `non_mandatory` tinyint(1) DEFAULT NULL COMMENT '1= NonMandatory , 0=Mandatory ',
  `mandatory_days` varchar(200) DEFAULT NULL,
  `non_mandatory_days` varchar(200) DEFAULT NULL,
  `location_id` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` date DEFAULT NULL,
  `is_completed` tinyint NOT NULL DEFAULT '0' COMMENT '0=not completed , 1= completed',
  `min_order` varchar(233) DEFAULT '0',
  `storageArea` varchar(500) DEFAULT NULL COMMENT 'storage location',
  `requireTC` tinyint DEFAULT NULL,
  `requireDD` tinyint DEFAULT NULL,
  `requirePL` tinyint NOT NULL DEFAULT '1' COMMENT 'require PAR Level or not',
  `requireSC` tinyint NOT NULL DEFAULT '1' COMMENT 'REquire stock count or not',
  `requireMST` tinyint NOT NULL DEFAULT '0' COMMENT 'Monthly stock take ',
  `allowForceOrder` tinyint DEFAULT NULL COMMENT 'to check if order can be placed if budget exceed for this supplier',
  `delivery_info` varchar(10000) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `last_order_date` date NOT NULL COMMENT 'when last time order placed fro this supp,so that we can know on dashbrd if order is being placed twice in a day for this supp',
  `isTopFive` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_date_type` varchar(10) DEFAULT NULL COMMENT 'Number of days after which supplier products will be delivered',
  `deliveryDateFreq` varchar(100) DEFAULT NULL COMMENT 'related to delivery_date_type',
  `deliveryDayFreq` varchar(10) DEFAULT NULL COMMENT 'related to delivery_date_type',
  `weekly_budget` float NOT NULL COMMENT 'supplier current week budget,do not delete',
  `monthly_budget` float NOT NULL COMMENT 'supplier current month budget,do not delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list all suppliers';

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_supplier_categories`
--

CREATE TABLE `SUPPLIERS_supplier_categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `location_id` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIERS_supplier_subcategories`
--

CREATE TABLE `SUPPLIERS_supplier_subcategories` (
  `id` int NOT NULL,
  `category_id` int NOT NULL COMMENT 'tells wch category this sub category belongs to',
  `category_name` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `location_id` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_chillingPrepArea`
--

CREATE TABLE `TEMP_chillingPrepArea` (
  `id` int NOT NULL,
  `prep_name` varchar(50) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `site_id` tinyint DEFAULT NULL COMMENT 'to wch site this prep area belongs to',
  `sort_order` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_chillingSites`
--

CREATE TABLE `TEMP_chillingSites` (
  `id` int NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `location_id` int NOT NULL,
  `emailNotify` tinyint DEFAULT '0',
  `emailToNotify` varchar(50) DEFAULT NULL,
  `manager_comments` varchar(5000) DEFAULT NULL,
  `staff_comments` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_chillingTemprecordHistory`
--

CREATE TABLE `TEMP_chillingTemprecordHistory` (
  `id` int NOT NULL,
  `site_id` int NOT NULL,
  `prep_id` int DEFAULT NULL,
  `foodName` varchar(200) DEFAULT NULL,
  `startTime` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `finishTime` varchar(10) NOT NULL,
  `tempAtFinish` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `chillingStartTime` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `entered_by` varchar(100) NOT NULL,
  `location_id` int NOT NULL,
  `timeAfterTwohours` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tempAfterTwohours` varchar(10) DEFAULT NULL,
  `timeAfterFourhours` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tempAfterFourhours` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  `isTempok` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date_entered` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_ci_configuration`
--

CREATE TABLE `TEMP_ci_configuration` (
  `id` int NOT NULL,
  `configureFor` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `data` varchar(400) NOT NULL,
  `location` int NOT NULL,
  `metaData` varchar(200) DEFAULT NULL,
  `time_of_notification` varchar(30) DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_eqipment`
--

CREATE TABLE `TEMP_eqipment` (
  `id` int NOT NULL,
  `equip_name` varchar(55) NOT NULL,
  `prep_id` varchar(200) DEFAULT NULL COMMENT 'wch prep area this equip belongs to',
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `equip_time` varchar(20) DEFAULT NULL,
  `temp_min` varchar(22) DEFAULT NULL,
  `temp_max` int DEFAULT NULL,
  `mailFrequency` varchar(22) DEFAULT NULL,
  `is_attchmentRequired` tinyint(1) DEFAULT NULL,
  `schedule_at` tinyint(1) DEFAULT NULL COMMENT '0=Daily,1=Weekly,2=Monthly',
  `schedule_date` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `sort_order` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_foodPrepArea`
--

CREATE TABLE `TEMP_foodPrepArea` (
  `id` int NOT NULL,
  `prep_name` varchar(50) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `site_id` tinyint DEFAULT NULL COMMENT 'to wch site this prep area belongs to',
  `sort_order` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_foodSites`
--

CREATE TABLE `TEMP_foodSites` (
  `id` int NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `location_id` int NOT NULL,
  `emailNotify` tinyint DEFAULT '0',
  `emailToNotify` varchar(50) DEFAULT NULL,
  `manager_comments` varchar(5000) DEFAULT NULL,
  `staff_comments` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_foodTemprecordHistory`
--

CREATE TABLE `TEMP_foodTemprecordHistory` (
  `id` int NOT NULL,
  `site_id` int NOT NULL,
  `prep_id` int DEFAULT NULL,
  `foodName` varchar(200) DEFAULT NULL,
  `foodType` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '1= hotfood, 2 = cold food',
  `date_entered` date NOT NULL,
  `staff_comments` varchar(200) NOT NULL,
  `manager_comments` varchar(200) NOT NULL,
  `entered_by` varchar(100) NOT NULL,
  `location_id` int NOT NULL,
  `entered_time` varchar(40) DEFAULT NULL,
  `food_temp` int DEFAULT NULL,
  `correctedTemp` int DEFAULT NULL COMMENT 'this is for temp entered by manager , if earlier temp was exceeded earlier',
  `attachment` varchar(1000) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  `food_IsTempok` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `currentFoodMaxTempAllowed` int DEFAULT NULL COMMENT 'we store the max temp set in config here, so that if it chnage in future, this particular food can be tracked as per this value',
  `currentFoodMinTempAllowed` int DEFAULT NULL COMMENT 'we store the min temp set in config here, so that if it chnage in future, this particular food can be tracked as per this value'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_prepArea`
--

CREATE TABLE `TEMP_prepArea` (
  `id` int NOT NULL,
  `prep_name` varchar(50) NOT NULL,
  `status` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  `site_id` tinyint DEFAULT NULL COMMENT 'to wch site this prep area belongs to',
  `sort_order` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_record_tempHistory`
--

CREATE TABLE `TEMP_record_tempHistory` (
  `id` int NOT NULL,
  `site_id` int NOT NULL,
  `prep_id` int DEFAULT NULL,
  `equip_id` int NOT NULL,
  `date_entered` date NOT NULL,
  `staff_comments` varchar(200) NOT NULL,
  `manager_comments` varchar(200) NOT NULL,
  `entered_by` varchar(100) NOT NULL,
  `location_id` int NOT NULL,
  `entered_time` varchar(40) DEFAULT NULL,
  `equip_temp` int DEFAULT NULL,
  `correctedTemp` int DEFAULT NULL COMMENT 'this is for temp entered by manager , if earlier temp was exceeded earlier',
  `attachment` varchar(1000) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  `equip_IsTempok` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `HR_prepArea` (
  `id` int NOT NULL,
  `prep_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_date` date NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `site_id` int NOT NULL,
  `sort_order` DEFAULT NULL,
  `color` varchar(40) DEFAULT NULL,
  `location_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `HR_prepArea` ADD PRIMARY KEY (`id`);
ALTER TABLE `HR_prepArea` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


CREATE TABLE `HR_sites` (
  `id` int NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `location_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `HR_sites` ADD PRIMARY KEY (`id`);
ALTER TABLE `HR_sites` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `TEMP_sites`
--

CREATE TABLE `TEMP_sites` (
  `id` int NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `location_id` int NOT NULL,
  `emailNotify` tinyint DEFAULT '0',
  `emailToNotify` varchar(50) DEFAULT NULL,
  `manager_comments` varchar(5000) DEFAULT NULL,
  `staff_comments` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;







CREATE TABLE `Catering_category` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_category` ADD PRIMARY KEY (`category_id`);
ALTER TABLE `Catering_category` MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_catering_checklist` (
  `catering_checklist_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `catering_location` int DEFAULT NULL,
  `catering_time` int DEFAULT NULL,
  `catering_people` int DEFAULT NULL,
  `catering_delivery_instructions` int DEFAULT NULL,
  `catering_dietary_req` int DEFAULT NULL,
  `day_before_location` int DEFAULT NULL,
  `day_before_time` int DEFAULT NULL,
  `day_before_people` int DEFAULT NULL,
  `day_before_delivery_instructions` int DEFAULT NULL,
  `day_before_dietary_req` int DEFAULT NULL,
  `delivery_day_check_everything` int DEFAULT NULL,
  `delivery_day_others` int DEFAULT NULL,
  `delivery_day_start_packing` int DEFAULT NULL,
  `delivery_day_call_customer` int DEFAULT NULL,
  `kitchen_catering_labels` int DEFAULT NULL,
  `kitchen_check_dietary` int DEFAULT NULL,
  `kitchen_check_all_items` int DEFAULT NULL,
  `kitchen_staff_name` varchar(200) DEFAULT NULL,
  `date_updated` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_catering_checklist` ADD PRIMARY KEY (`catering_checklist_id`);
ALTER TABLE `Catering_catering_checklist` MODIFY `catering_checklist_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_company` (
  `company_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_abn` varchar(15) DEFAULT NULL,
  `company_phone` varchar(15) DEFAULT NULL,
  `company_address` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_from` varchar(100) DEFAULT NULL,
  `company_created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_company` ADD PRIMARY KEY (`company_id`);
ALTER TABLE `Catering_company` MODIFY `company_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1340;
CREATE TABLE `Catering_coupon` (
  `coupon_id` int NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_description` varchar(255) NOT NULL,
  `coupon_discount` float(10,2) NOT NULL,
  `type` varchar(1) NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_coupon` ADD PRIMARY KEY (`coupon_id`);
ALTER TABLE `Catering_coupon` MODIFY `coupon_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_customer` (
  `customer_id` int NOT NULL,
  `location_id` int DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `customer_fax` varchar(15) DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `customer_address` text,
  `is_cost_centre_account` tinyint(1) DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `approved` tinyint(1) DEFAULT '0',
  `date_added` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_customer` ADD PRIMARY KEY (`customer_id`);
ALTER TABLE `Catering_customer` MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_customer_feedback` (
  `feedback_id` int NOT NULL,
  `order_id` int NOT NULL,
  `cname` varchar(500) NOT NULL,
  `company_name` varchar(1000) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `website_experience` varchar(1000) DEFAULT NULL,
  `FOOD` int NOT NULL,
  `PRICING` int NOT NULL,
  `MENU` int NOT NULL,
  `EXPERIENCE` int NOT NULL,
  `DELIVERY` int NOT NULL,
  `PACKAGING` int NOT NULL,
  `SERVICE` int NOT NULL,
  `commentText` varchar(10000) NOT NULL,
  `deliveredOnTime` varchar(20) DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `suggestions` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_customer_feedback` ADD PRIMARY KEY (`feedback_id`);
ALTER TABLE `Catering_customer_feedback` MODIFY `feedback_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_department` (
  `department_id` int NOT NULL,
  `company_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_from` varchar(100) DEFAULT NULL,
  `department_created_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_department` ADD PRIMARY KEY (`department_id`);
ALTER TABLE `Catering_department` MODIFY `department_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_locations` (
  `location_id` int NOT NULL,
  `location_name` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_locations` ADD PRIMARY KEY (`location_id`);
ALTER TABLE `Catering_locations` MODIFY `location_id` int NOT NULL AUTO_INCREMENT;
CREATE TABLE `Catering_notification` (
  `id` int NOT NULL,
  `description` varchar(500) NOT NULL,
  `orderID` int NOT NULL,
  `userID` int DEFAULT NULL,
  `date_added` date NOT NULL,
  `time_added` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_notification` ADD PRIMARY KEY (`id`);
ALTER TABLE `Catering_notification` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_orders` (
  `order_id` int NOT NULL,
  `company_id` int NOT NULL,
  `department_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Cancelled 1 = New 2 = Paid 4 = Awaiting approval 7 = Approved 8 = Rejected 9 = Modified',
  `date_added` date NOT NULL,
  `date_modified` date DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` varchar(20) NOT NULL,
  `order_comments` varchar(300) DEFAULT NULL,
  `delivery_address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pickup_location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `accounts_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cost_center` varchar(50) DEFAULT NULL,
  `approval_comments` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mark_paid_comment` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `delivery_contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_catering_checklist_added` tinyint(1) NOT NULL,
  `is_completed` tinyint(1) NOT NULL,
  `order_total` float NOT NULL,
  `delivery_fee` float DEFAULT NULL,
  `late_fee` float DEFAULT NULL,
  `coupon_id` int NOT NULL,
  `coupon_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'if any coupon code applied foir this order',
  `location_id` int NOT NULL,
  `delivery_notes` varchar(200) DEFAULT NULL,
  `shipping_method` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '1= delivery, 2 = pickup',
  `is_quote` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'to identify if it is quote or order',
  `isMailSent` varchar(5) DEFAULT 'No' COMMENT 'this is for reminder orders page to know if mail already sent to customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
ALTER TABLE `Catering_orders` ADD PRIMARY KEY (`order_id`);
ALTER TABLE `Catering_orders` MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_order_images` (
  `order_image_id` int NOT NULL,
  `order_id` int NOT NULL,
  `order_image` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_order_images` ADD PRIMARY KEY (`order_image_id`);
ALTER TABLE `Catering_order_images` MODIFY `order_image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_order_product` (
  `order_product_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(15,4) DEFAULT NULL,
  `total` decimal(15,4) DEFAULT NULL,
  `sort_order` int NOT NULL,
  `order_product_comment` varchar(5000) DEFAULT NULL,
  `exclude_GST` int NOT NULL,
  `is_prepared` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_order_product` ADD PRIMARY KEY (`order_product_id`);
ALTER TABLE `Catering_order_product` MODIFY `order_product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_product` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text,
  `product_price` decimal(15,4) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `date_added` date NOT NULL,
  `date_modified` date NOT NULL,
  `location_id` int NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_product` ADD PRIMARY KEY (`product_id`);
ALTER TABLE `Catering_product` MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_product_to_category` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_product_to_category` ADD PRIMARY KEY (`product_id`,`category_id`);
CREATE TABLE `Catering_settings` (
  `id` int NOT NULL,
  `location_id` int NOT NULL COMMENT 'diff locations will have diff bank account details',
  `remittance_email` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `contact_number` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `abn` varchar(24) DEFAULT NULL,
  `company_name` varchar(300) DEFAULT NULL,
  `bsb` varchar(44) DEFAULT NULL,
  `pickup_address` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_settings` ADD PRIMARY KEY (`id`);
ALTER TABLE `Catering_settings` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_store` (
  `location_id` int NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `subdomain` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `state` int NOT NULL,
  `postalcode` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `is_delivery` tinyint(1) DEFAULT '1',
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_store` ADD PRIMARY KEY (`location_id`);
ALTER TABLE `Catering_store` MODIFY `location_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `Catering_survey` (
  `id` int NOT NULL,
  `location_id` int DEFAULT NULL,
  `person_name` varchar(100) DEFAULT NULL,
  `person_email` varchar(100) DEFAULT NULL,
  `patronage` varchar(300) DEFAULT NULL,
  `dietry` varchar(300) DEFAULT NULL,
  `dietry_feedback` varchar(300) DEFAULT NULL,
  `quality_of_food` varchar(11) DEFAULT NULL,
  `variety_of_food` varchar(11) DEFAULT NULL,
  `food_portion_size` varchar(11) DEFAULT NULL,
  `food_label` varchar(11) DEFAULT NULL,
  `value_for_Money` varchar(11) DEFAULT NULL,
  `staff_helpfulness` varchar(11) DEFAULT NULL,
  `staff_courtesy` varchar(11) DEFAULT NULL,
  `staff_presentation` varchar(11) DEFAULT NULL,
  `staff_knowledge` varchar(11) DEFAULT NULL,
  `biodegradable_package` varchar(11) DEFAULT NULL,
  `coffee_quality` varchar(11) DEFAULT NULL,
  `outlet_ambience` varchar(11) DEFAULT NULL,
  `outlet_cleanliness` varchar(11) DEFAULT NULL,
  `dietry_requirement` varchar(11) DEFAULT NULL,
  `ordering_online` varchar(11) DEFAULT NULL,
  `catering` varchar(11) DEFAULT NULL,
  `age` varchar(11) DEFAULT NULL,
  `sex` varchar(11) DEFAULT NULL,
  `are_you` varchar(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `Catering_survey` ADD PRIMARY KEY (`id`);
ALTER TABLE `Catering_survey` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CASH_ci_bank_deposit`
--
ALTER TABLE `CASH_ci_bank_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_bank_reconcile`
--
ALTER TABLE `CASH_ci_bank_reconcile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_bank_reconcile_attachments`
--
ALTER TABLE `CASH_ci_bank_reconcile_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_cash_deposit`
--
ALTER TABLE `CASH_ci_cash_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_configuration`
--
ALTER TABLE `CASH_ci_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_floats`
--
ALTER TABLE `CASH_ci_floats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_frontOfficeBuild`
--
ALTER TABLE `CASH_ci_frontOfficeBuild`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_officeBuild`
--
ALTER TABLE `CASH_ci_officeBuild`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CASH_ci_tills`
--
ALTER TABLE `CASH_ci_tills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CLEAN_configuration`
--
ALTER TABLE `CLEAN_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CLEAN_prepArea`
--
ALTER TABLE `CLEAN_prepArea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CLEAN_record_History`
--
ALTER TABLE `CLEAN_record_History`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CLEAN_sites`
--
ALTER TABLE `CLEAN_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CLEAN_tasks`
--
ALTER TABLE `CLEAN_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Compliance_prepArea`
--
ALTER TABLE `Compliance_prepArea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Compliance_record_History`
--
ALTER TABLE `Compliance_record_History`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Compliance_sites`
--
ALTER TABLE `Compliance_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Compliance_tasks`
--
ALTER TABLE `Compliance_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `DMS_documents`
--
ALTER TABLE `DMS_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `DMS_folders`
--
ALTER TABLE `DMS_folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `DMS_sub_folders`
--
ALTER TABLE `DMS_sub_folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_checklist`
--
ALTER TABLE `Global_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_checklistToDateCompleted`
--
ALTER TABLE `Global_checklistToDateCompleted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_configuration`
--
ALTER TABLE `Global_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_locations`
--
ALTER TABLE `Global_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `Global_notification`
--
ALTER TABLE `Global_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_roles`
--
ALTER TABLE `Global_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_SmtpSettings`
--
ALTER TABLE `Global_SmtpSettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_subchecklist`
--
ALTER TABLE `Global_subchecklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_sublocations`
--
ALTER TABLE `Global_sublocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_todoList`
--
ALTER TABLE `Global_todoList`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Global_userid_to_roles`
--
ALTER TABLE `Global_userid_to_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `Global_users`
--
ALTER TABLE `Global_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `Global_users_to_location`
--
ALTER TABLE `Global_users_to_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_addon_items`
--
ALTER TABLE `HR_addon_items`
  ADD PRIMARY KEY (`addon_id`),
  ADD KEY `packages_package_id` (`package_id`);

--
-- Indexes for table `HR_applicants_details`
--
ALTER TABLE `HR_applicants_details`
  ADD PRIMARY KEY (`applicants_details_id`);

--
-- Indexes for table `HR_careers`
--
ALTER TABLE `HR_careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_configuration`
--
ALTER TABLE `HR_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_contractors`
--
ALTER TABLE `HR_contractors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_contractorsToLocationId`
--
ALTER TABLE `HR_contractorsToLocationId`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_covid`
--
ALTER TABLE `HR_covid`
  ADD PRIMARY KEY (`covid_id`);

--
-- Indexes for table `HR_docs`
--
ALTER TABLE `HR_docs`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `partner_id` (`employee_id`);

--
-- Indexes for table `HR_document`
--
ALTER TABLE `HR_document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `HR_empIdToLocationId`
--
ALTER TABLE `HR_empIdToLocationId`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_employee`
--
ALTER TABLE `HR_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `HR_Employee_reimbursement`
--
ALTER TABLE `HR_Employee_reimbursement`
  ADD PRIMARY KEY (`Employee_reimbursement_id`);

--
-- Indexes for table `HR_Employee_Self_Assessment`
--
ALTER TABLE `HR_Employee_Self_Assessment`
  ADD PRIMARY KEY (`Employee_Self_Assessment_id`);

--
-- Indexes for table `HR_employee_timesheet`
--
ALTER TABLE `HR_employee_timesheet`
  ADD PRIMARY KEY (`employee_timesheet_id`);

--
-- Indexes for table `HR_emp_availability`
--
ALTER TABLE `HR_emp_availability`
  ADD PRIMARY KEY (`emp_availability_id`);

--
-- Indexes for table `HR_emp_department`
--
ALTER TABLE `HR_emp_department`
  ADD PRIMARY KEY (`emp_department_id`);

--
-- Indexes for table `HR_emp_document`
--
ALTER TABLE `HR_emp_document`
  ADD PRIMARY KEY (`emp_document_id`);

--
-- Indexes for table `HR_emp_evaluation_form`
--
ALTER TABLE `HR_emp_evaluation_form`
  ADD PRIMARY KEY (`emp_evaluation_form_id`);

--
-- Indexes for table `HR_emp_satisfaction_survey`
--
ALTER TABLE `HR_emp_satisfaction_survey`
  ADD PRIMARY KEY (`emp_satisfaction_survey_id`);

--
-- Indexes for table `HR_emp_survey`
--
ALTER TABLE `HR_emp_survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `HR_hr_complaints`
--
ALTER TABLE `HR_hr_complaints`
  ADD PRIMARY KEY (`hr_complaint_id`);

--
-- Indexes for table `HR_Incident_Report`
--
ALTER TABLE `HR_Incident_Report`
  ADD PRIMARY KEY (`Incident_Report_id`);

--
-- Indexes for table `HR_Injury_Report`
--
ALTER TABLE `HR_Injury_Report`
  ADD PRIMARY KEY (`Injury_Report_id`);

--
-- Indexes for table `HR_interview_assesment`
--
ALTER TABLE `HR_interview_assesment`
  ADD PRIMARY KEY (`interview_assesment_id`);

--
-- Indexes for table `HR_Jobkeeper_Nomination_Notice`
--
ALTER TABLE `HR_Jobkeeper_Nomination_Notice`
  ADD PRIMARY KEY (`Jobkeeper_Nomination_Notice_id`);

--
-- Indexes for table `HR_job_application`
--
ALTER TABLE `HR_job_application`
  ADD PRIMARY KEY (`job_application_id`);

--
-- Indexes for table `HR_leaves`
--
ALTER TABLE `HR_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_leave_management`
--
ALTER TABLE `HR_leave_management`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `HR_memo`
--
ALTER TABLE `HR_memo`
  ADD PRIMARY KEY (`memo_id`);

--
-- Indexes for table `HR_module_access`
--
ALTER TABLE `HR_module_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_notification`
--
ALTER TABLE `HR_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_outlet`
--
ALTER TABLE `HR_outlet`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `HR_packages`
--
ALTER TABLE `HR_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `HR_Probationary_Period`
--
ALTER TABLE `HR_Probationary_Period`
  ADD PRIMARY KEY (`Probationary_Period_id`);

--
-- Indexes for table `HR_public_holidays`
--
ALTER TABLE `HR_public_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_reports`
--
ALTER TABLE `HR_reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `HR_Resignation_Letter`
--
ALTER TABLE `HR_Resignation_Letter`
  ADD PRIMARY KEY (`Resignation_Letter_id`);

--
-- Indexes for table `HR_resumes`
--
ALTER TABLE `HR_resumes`
  ADD PRIMARY KEY (`resume_id`);

--
-- Indexes for table `HR_role`
--
ALTER TABLE `HR_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `HR_roster`
--
ALTER TABLE `HR_roster`
  ADD PRIMARY KEY (`roster_id`);

--
-- Indexes for table `HR_stressProfile`
--
ALTER TABLE `HR_stressProfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HR_timesheet`
--
ALTER TABLE `HR_timesheet`
  ADD PRIMARY KEY (`timesheet_id`);

--
-- Indexes for table `HR_timesheet_comments`
--
ALTER TABLE `HR_timesheet_comments`
  ADD PRIMARY KEY (`timesheet_comment_id`);

--
-- Indexes for table `HR_weekly_roster_report`
--
ALTER TABLE `HR_weekly_roster_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `NotificationEmailConfiguration`
--
ALTER TABLE `NotificationEmailConfiguration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_areaId_to_supplierId`
--
ALTER TABLE `SUPPLIERS_areaId_to_supplierId`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_areaList`
--
ALTER TABLE `SUPPLIERS_areaList`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_budgetRecord`
--
ALTER TABLE `SUPPLIERS_budgetRecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_configuration`
--
ALTER TABLE `SUPPLIERS_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderCategory`
--
ALTER TABLE `SUPPLIERS_internalOrderCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderLocations`
--
ALTER TABLE `SUPPLIERS_internalOrderLocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderPlacedOrders`
--
ALTER TABLE `SUPPLIERS_internalOrderPlacedOrders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderPlacedOrdersProducts`
--
ALTER TABLE `SUPPLIERS_internalOrderPlacedOrdersProducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderProductCount`
--
ALTER TABLE `SUPPLIERS_internalOrderProductCount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderProducts`
--
ALTER TABLE `SUPPLIERS_internalOrderProducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_internalOrderProductsToSubLocation`
--
ALTER TABLE `SUPPLIERS_internalOrderProductsToSubLocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_LocationWisebudgetRecord`
--
ALTER TABLE `SUPPLIERS_LocationWisebudgetRecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_monthly_stockCount`
--
ALTER TABLE `SUPPLIERS_monthly_stockCount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_orderDetails`
--
ALTER TABLE `SUPPLIERS_orderDetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_orders`
--
ALTER TABLE `SUPPLIERS_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_orderStatusList`
--
ALTER TABLE `SUPPLIERS_orderStatusList`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `SUPPLIERS_products`
--
ALTER TABLE `SUPPLIERS_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `SUPPLIERS_productToBuilto`
--
ALTER TABLE `SUPPLIERS_productToBuilto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_productToBuiltoToAreaQty`
--
ALTER TABLE `SUPPLIERS_productToBuiltoToAreaQty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_product_category`
--
ALTER TABLE `SUPPLIERS_product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `SUPPLIERS_product_UOM`
--
ALTER TABLE `SUPPLIERS_product_UOM`
  ADD PRIMARY KEY (`product_UOM_id`);

--
-- Indexes for table `SUPPLIERS_subCategoryBudgetRecord`
--
ALTER TABLE `SUPPLIERS_subCategoryBudgetRecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SUPPLIERS_suppliersList`
--
ALTER TABLE `SUPPLIERS_suppliersList`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `SUPPLIERS_supplier_categories`
--
ALTER TABLE `SUPPLIERS_supplier_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `SUPPLIERS_supplier_subcategories`
--
ALTER TABLE `SUPPLIERS_supplier_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_chillingPrepArea`
--
ALTER TABLE `TEMP_chillingPrepArea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_chillingSites`
--
ALTER TABLE `TEMP_chillingSites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_chillingTemprecordHistory`
--
ALTER TABLE `TEMP_chillingTemprecordHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_ci_configuration`
--
ALTER TABLE `TEMP_ci_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_eqipment`
--
ALTER TABLE `TEMP_eqipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_foodPrepArea`
--
ALTER TABLE `TEMP_foodPrepArea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_foodSites`
--
ALTER TABLE `TEMP_foodSites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_foodTemprecordHistory`
--
ALTER TABLE `TEMP_foodTemprecordHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_prepArea`
--
ALTER TABLE `TEMP_prepArea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_record_tempHistory`
--
ALTER TABLE `TEMP_record_tempHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TEMP_sites`
--
ALTER TABLE `TEMP_sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CASH_ci_bank_deposit`
--
ALTER TABLE `CASH_ci_bank_deposit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_bank_reconcile`
--
ALTER TABLE `CASH_ci_bank_reconcile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_bank_reconcile_attachments`
--
ALTER TABLE `CASH_ci_bank_reconcile_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_cash_deposit`
--
ALTER TABLE `CASH_ci_cash_deposit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_configuration`
--
ALTER TABLE `CASH_ci_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_floats`
--
ALTER TABLE `CASH_ci_floats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_frontOfficeBuild`
--
ALTER TABLE `CASH_ci_frontOfficeBuild`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_officeBuild`
--
ALTER TABLE `CASH_ci_officeBuild`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CASH_ci_tills`
--
ALTER TABLE `CASH_ci_tills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CLEAN_configuration`
--
ALTER TABLE `CLEAN_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CLEAN_prepArea`
--
ALTER TABLE `CLEAN_prepArea`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `CLEAN_record_History`
--
ALTER TABLE `CLEAN_record_History`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CLEAN_sites`
--
ALTER TABLE `CLEAN_sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `CLEAN_tasks`
--
ALTER TABLE `CLEAN_tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compliance_prepArea`
--
ALTER TABLE `Compliance_prepArea`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compliance_record_History`
--
ALTER TABLE `Compliance_record_History`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compliance_sites`
--
ALTER TABLE `Compliance_sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compliance_tasks`
--
ALTER TABLE `Compliance_tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DMS_documents`
--
ALTER TABLE `DMS_documents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DMS_folders`
--
ALTER TABLE `DMS_folders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DMS_sub_folders`
--
ALTER TABLE `DMS_sub_folders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_checklist`
--
ALTER TABLE `Global_checklist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Global_checklistToDateCompleted`
--
ALTER TABLE `Global_checklistToDateCompleted`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_configuration`
--
ALTER TABLE `Global_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Global_locations`
--
ALTER TABLE `Global_locations`
  MODIFY `location_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_notification`
--
ALTER TABLE `Global_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Global_roles`
--
ALTER TABLE `Global_roles`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_SmtpSettings`
--
ALTER TABLE `Global_SmtpSettings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_subchecklist`
--
ALTER TABLE `Global_subchecklist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Global_sublocations`
--
ALTER TABLE `Global_sublocations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_todoList`
--
ALTER TABLE `Global_todoList`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_userid_to_roles`
--
ALTER TABLE `Global_userid_to_roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_users`
--
ALTER TABLE `Global_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Global_users_to_location`
--
ALTER TABLE `Global_users_to_location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_addon_items`
--
ALTER TABLE `HR_addon_items`
  MODIFY `addon_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_applicants_details`
--
ALTER TABLE `HR_applicants_details`
  MODIFY `applicants_details_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_careers`
--
ALTER TABLE `HR_careers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_configuration`
--
ALTER TABLE `HR_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_contractors`
--
ALTER TABLE `HR_contractors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_contractorsToLocationId`
--
ALTER TABLE `HR_contractorsToLocationId`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_covid`
--
ALTER TABLE `HR_covid`
  MODIFY `covid_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_docs`
--
ALTER TABLE `HR_docs`
  MODIFY `doc_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_document`
--
ALTER TABLE `HR_document`
  MODIFY `document_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_empIdToLocationId`
--
ALTER TABLE `HR_empIdToLocationId`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_employee`
--
ALTER TABLE `HR_employee`
  MODIFY `emp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Employee_reimbursement`
--
ALTER TABLE `HR_Employee_reimbursement`
  MODIFY `Employee_reimbursement_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Employee_Self_Assessment`
--
ALTER TABLE `HR_Employee_Self_Assessment`
  MODIFY `Employee_Self_Assessment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_employee_timesheet`
--
ALTER TABLE `HR_employee_timesheet`
  MODIFY `employee_timesheet_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_emp_availability`
--
ALTER TABLE `HR_emp_availability`
  MODIFY `emp_availability_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_emp_department`
--
ALTER TABLE `HR_emp_department`
  MODIFY `emp_department_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_emp_document`
--
ALTER TABLE `HR_emp_document`
  MODIFY `emp_document_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_emp_evaluation_form`
--
ALTER TABLE `HR_emp_evaluation_form`
  MODIFY `emp_evaluation_form_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_emp_satisfaction_survey`
--
ALTER TABLE `HR_emp_satisfaction_survey`
  MODIFY `emp_satisfaction_survey_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_emp_survey`
--
ALTER TABLE `HR_emp_survey`
  MODIFY `survey_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_hr_complaints`
--
ALTER TABLE `HR_hr_complaints`
  MODIFY `hr_complaint_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Incident_Report`
--
ALTER TABLE `HR_Incident_Report`
  MODIFY `Incident_Report_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Injury_Report`
--
ALTER TABLE `HR_Injury_Report`
  MODIFY `Injury_Report_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_interview_assesment`
--
ALTER TABLE `HR_interview_assesment`
  MODIFY `interview_assesment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Jobkeeper_Nomination_Notice`
--
ALTER TABLE `HR_Jobkeeper_Nomination_Notice`
  MODIFY `Jobkeeper_Nomination_Notice_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_job_application`
--
ALTER TABLE `HR_job_application`
  MODIFY `job_application_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_leaves`
--
ALTER TABLE `HR_leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_leave_management`
--
ALTER TABLE `HR_leave_management`
  MODIFY `leave_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_memo`
--
ALTER TABLE `HR_memo`
  MODIFY `memo_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_module_access`
--
ALTER TABLE `HR_module_access`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_notification`
--
ALTER TABLE `HR_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_outlet`
--
ALTER TABLE `HR_outlet`
  MODIFY `outlet_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_packages`
--
ALTER TABLE `HR_packages`
  MODIFY `package_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Probationary_Period`
--
ALTER TABLE `HR_Probationary_Period`
  MODIFY `Probationary_Period_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_public_holidays`
--
ALTER TABLE `HR_public_holidays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_reports`
--
ALTER TABLE `HR_reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_Resignation_Letter`
--
ALTER TABLE `HR_Resignation_Letter`
  MODIFY `Resignation_Letter_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_resumes`
--
ALTER TABLE `HR_resumes`
  MODIFY `resume_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_role`
--
ALTER TABLE `HR_role`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_roster`
--
ALTER TABLE `HR_roster`
  MODIFY `roster_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_stressProfile`
--
ALTER TABLE `HR_stressProfile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_timesheet`
--
ALTER TABLE `HR_timesheet`
  MODIFY `timesheet_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_timesheet_comments`
--
ALTER TABLE `HR_timesheet_comments`
  MODIFY `timesheet_comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HR_weekly_roster_report`
--
ALTER TABLE `HR_weekly_roster_report`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `NotificationEmailConfiguration`
--
ALTER TABLE `NotificationEmailConfiguration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `SUPPLIERS_areaId_to_supplierId`
--
ALTER TABLE `SUPPLIERS_areaId_to_supplierId`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_areaList`
--
ALTER TABLE `SUPPLIERS_areaList`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_budgetRecord`
--
ALTER TABLE `SUPPLIERS_budgetRecord`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_configuration`
--
ALTER TABLE `SUPPLIERS_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderCategory`
--
ALTER TABLE `SUPPLIERS_internalOrderCategory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderLocations`
--
ALTER TABLE `SUPPLIERS_internalOrderLocations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderPlacedOrders`
--
ALTER TABLE `SUPPLIERS_internalOrderPlacedOrders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderPlacedOrdersProducts`
--
ALTER TABLE `SUPPLIERS_internalOrderPlacedOrdersProducts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderProductCount`
--
ALTER TABLE `SUPPLIERS_internalOrderProductCount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5378;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderProducts`
--
ALTER TABLE `SUPPLIERS_internalOrderProducts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `SUPPLIERS_internalOrderProductsToSubLocation`
--
ALTER TABLE `SUPPLIERS_internalOrderProductsToSubLocation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2453;

--
-- AUTO_INCREMENT for table `SUPPLIERS_LocationWisebudgetRecord`
--
ALTER TABLE `SUPPLIERS_LocationWisebudgetRecord`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_monthly_stockCount`
--
ALTER TABLE `SUPPLIERS_monthly_stockCount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_orderDetails`
--
ALTER TABLE `SUPPLIERS_orderDetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_orders`
--
ALTER TABLE `SUPPLIERS_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_orderStatusList`
--
ALTER TABLE `SUPPLIERS_orderStatusList`
  MODIFY `order_status_id` tinyint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_products`
--
ALTER TABLE `SUPPLIERS_products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_productToBuilto`
--
ALTER TABLE `SUPPLIERS_productToBuilto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_productToBuiltoToAreaQty`
--
ALTER TABLE `SUPPLIERS_productToBuiltoToAreaQty`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_product_category`
--
ALTER TABLE `SUPPLIERS_product_category`
  MODIFY `product_category_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_product_UOM`
--
ALTER TABLE `SUPPLIERS_product_UOM`
  MODIFY `product_UOM_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SUPPLIERS_subCategoryBudgetRecord`
--
ALTER TABLE `SUPPLIERS_subCategoryBudgetRecord`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_suppliersList`
--
ALTER TABLE `SUPPLIERS_suppliersList`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_supplier_categories`
--
ALTER TABLE `SUPPLIERS_supplier_categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SUPPLIERS_supplier_subcategories`
--
ALTER TABLE `SUPPLIERS_supplier_subcategories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TEMP_chillingPrepArea`
--
ALTER TABLE `TEMP_chillingPrepArea`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `TEMP_chillingSites`
--
ALTER TABLE `TEMP_chillingSites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `TEMP_chillingTemprecordHistory`
--
ALTER TABLE `TEMP_chillingTemprecordHistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `TEMP_ci_configuration`
--
ALTER TABLE `TEMP_ci_configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `TEMP_eqipment`
--
ALTER TABLE `TEMP_eqipment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `TEMP_foodPrepArea`
--
ALTER TABLE `TEMP_foodPrepArea`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `TEMP_foodSites`
--
ALTER TABLE `TEMP_foodSites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `TEMP_foodTemprecordHistory`
--
ALTER TABLE `TEMP_foodTemprecordHistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `TEMP_prepArea`
--
ALTER TABLE `TEMP_prepArea`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `TEMP_record_tempHistory`
--
ALTER TABLE `TEMP_record_tempHistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- AUTO_INCREMENT for table `TEMP_sites`
--
ALTER TABLE `TEMP_sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
