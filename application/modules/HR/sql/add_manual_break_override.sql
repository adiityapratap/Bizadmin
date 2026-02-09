-- Add manual break override columns to HR_timesheet_details table
-- This allows managers to manually override the automatic break calculation

ALTER TABLE `HR_timesheet_details` 
ADD COLUMN `manual_break_override` TINYINT(1) DEFAULT 0 COMMENT 'Flag to indicate if break is manually set by manager',
ADD COLUMN `manual_break_minutes` INT DEFAULT NULL COMMENT 'Manual break duration in minutes set by manager',
ADD COLUMN `manager_comment` TEXT DEFAULT NULL COMMENT 'Manager notes/comments for this timesheet entry';

-- Add index for better query performance
CREATE INDEX `idx_manual_break_override` ON `HR_timesheet_details` (`manual_break_override`);
