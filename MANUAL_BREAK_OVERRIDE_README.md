# Manual Break Override & Manager Comments Feature

## Overview
This update adds two powerful features for managers:
1. **Manual Break Override**: Allows managers to manually override automatic break calculations
2. **Manager Comments**: Enables managers to add notes/comments to individual timesheet entries

These features help prevent loss of pay when employees work without breaks and provide better communication and documentation.

## Changes Made

### 1. Database Changes
**File**: `application/modules/HR/sql/add_manual_break_override.sql`

Added three new columns to the `HR_timesheet_details` table:
- `manual_break_override` (TINYINT): Flag indicating if break is manually set (0 = automatic, 1 = manual)
- `manual_break_minutes` (INT): Manual break duration in minutes (NULL for automatic)
- `manager_comment` (TEXT): Manager notes/comments for the timesheet entry
- Added index for better query performance

**To apply the changes, run the SQL file**:
```sql
mysql -u your_username -p your_database < application/modules/HR/sql/add_manual_break_override.sql
```

Or execute the SQL commands directly in phpMyAdmin or your database client.

### 2. Model Changes
**File**: `application/modules/HR/models/Timesheet_model.php`

Updated `get_timesheets_by_date_range()` method to include the new columns:
- Added `HR_timesheet_details.manual_break_override` to the SELECT fields
- Added `HR_timesheet_details.manual_break_minutes` to the SELECT fields
- Added `HR_timesheet_details.manager_comment` to the SELECT fields

### 3. Controller Changes
**File**: `application/modules/HR/controllers/Timesheet.php`

#### New Method: `set_manual_break_override()`
- Handles AJAX requests to set/update manual break override
- Only accessible by Managers and Admins
- Parameters:
  - `timesheet_id`: ID of the timesheet entry
  - `break_minutes`: Break duration (0, 15, 30, 45, 60) or empty string for automatic
- Updates `manual_break_override` and `manual_break_minutes` columns

#### New Method: `save_manager_comment()`
- Handles AJAX requests to save manager comments
- Only accessible by Managers and Admins
- Parameters:
  - `timesheet_id`: ID of the timesheet entry
  - `comment`: Text comment/note from manager
- Updates `manager_comment` column
- Returns saved comment for display

#### Updated: Automatic Break Logic
- Changed threshold from `>= 5 hours` to `> 5 hours`
- Changed threshold from `>= 10 hours` to `> 10 hours`
- This ensures breaks are only added when worked hours exceed the threshold, not equal to it

### 4. View Changes
**File**: `application/modules/HR/views/timesheet/weeklyTimesheet.php`

#### Updated Break Calculation Logic
- Checks for `manual_break_override` flag before applying automatic breaks
- If manual override is set, uses `manual_break_minutes` instead of automatic calculation
- Changed automatic break thresholds from `>=` to `>` for 5 and 10 hours

#### New UI Element: Break Override Dropdown
- Added dropdown next to break display with options:
  - Auto (default - uses automatic calculation)
  - 0 min
  - 15 mins
  - 30 mins
  - 45 mins
  - 60 mins
- Only visible to Managers and Admins
- Styled with Tailwind CSS classes
- Shows current override status (Auto or manual value)

#### New UI Element: Comment Button
- Added "Comment" button next to each timesheet entry
- Only visible to Managers and Admins
- Shows blue checkmark badge when comment exists
- Opens modal on click for entering/editing comments
- Styled with Tailwind CSS and Font Awesome icons

#### New UI Component: Comment Modal
- Full-screen overlay modal with centered content
- Contains:
  - Title: "Manager Comment"
  - Close button (X icon)
  - Textarea for comment entry (5 rows, auto-expanding)
  - Cancel button (closes without saving)
  - Save Comment button (saves and reloads)
- Closes when:
  - Click outside modal
  - Press Escape key
  - Click Cancel button
  - Click X button
- Loads existing comment when opening (if exists)
- Shows loading spinner while saving

#### New JavaScript Function: `handleBreakOverride()`
- Handles dropdown change events
- Sends AJAX request to update manual break override
- Shows success/error messages using toast notifications
- Reloads page after successful update to reflect new break calculation
- Includes error handling and rollback on failure

#### New JavaScript Functions: Comment Modal
- `openCommentModal(timesheetId, existingComment)`: Opens modal with existing comment pre-filled
- `closeCommentModal()`: Closes modal and clears form
- `saveComment()`: Saves comment via AJAX, shows loading state, handles errors
- Event listeners for outside click and Escape key

#### Event Listener
- Added event delegation for `.break-override-dropdown` change events
- Placed in document.ready() section

## How It Works

### Feature 1: Manual Break Override

#### Automatic Break Calculation (Default)
1. When an employee clocks out, the system calculates worked hours
2. If worked hours > 10: adds 60 minutes break
3. If worked hours > 5: adds 30 minutes break
4. Break is only added if not already recorded

#### Manual Override
1. Manager navigates to weekly timesheet view
2. Finds the employee and specific day
3. Clicks the dropdown next to the break time
4. Selects desired break duration (or "Auto" to revert to automatic)
5. System updates the timesheet entry with manual override
6. Page reloads to show updated break calculation
7. Net hours are recalculated based on manual break duration

#### Override Behavior
- **Auto**: Uses automatic break logic (>5hrs = 30min, >10hrs = 60min)
- **0 min**: No break applied, even if worked >5 or >10 hours
- **15/30/45/60 mins**: Exact break duration applied regardless of worked hours
- Manual override persists until changed by a manager

### Feature 2: Manager Comments

#### Adding a Comment
1. Manager navigates to weekly timesheet view
2. Finds the employee and specific day
3. Clicks the "Comment" button (shows blue checkmark if comment exists)
4. Modal opens with textarea
5. If comment exists, it's pre-filled for editing
6. Manager types/edits comment
7. Clicks "Save Comment" button
8. System saves comment to database
9. Page reloads to show updated comment indicator
10. Blue checkmark badge appears on Comment button

#### Viewing Existing Comments
1. Click "Comment" button on any entry with blue checkmark badge
2. Modal opens showing existing comment
3. Can edit or leave as-is
4. Can clear comment by deleting text and saving

#### Comment Features
- Unlimited text length (TEXT field in database)
- Persists until manually changed or deleted
- Only visible to Managers and Admins
- Visual indicator (blue checkmark) shows entries with comments
- Modal closes on: Cancel, X button, outside click, or Escape key

## Usage Examples

### Example 1: Manual Break Override

**Scenario**: Employee works 8 hours without taking a break

**Without Manual Override**:
- Worked: 8 hours
- Automatic Break: 30 minutes (because 8 > 5)
- Net Pay Hours: 7.5 hours ❌ (Loss of 30 minutes pay)

**With Manual Override (set to 0 min)**:
- Worked: 8 hours
- Manual Break: 0 minutes
- Net Pay Hours: 8 hours ✅ (Full pay)

### Example 2: Manager Comment

**Scenario**: Employee clocked in 30 minutes late

**Manager Action**:
1. Opens comment modal for that day
2. Types: "Employee arrived late due to traffic accident on highway. Approved by supervisor."
3. Saves comment
4. Blue checkmark appears on Comment button
5. Other managers can view this note later

**Use Cases for Comments**:
- Explain late arrivals or early departures
- Note approved unpaid breaks
- Document special circumstances
- Clarify discrepancies between roster and actual times
- Record verbal approvals or adjustments
- Leave notes for payroll processing

## Security
- Only users with "Manager" or "Admin" roles can:
  - See the break override dropdown
  - Set manual break overrides
  - See the Comment button
  - Add/edit/view manager comments
- AJAX endpoints validate role permissions
- All updates are logged in the database with timestamps
- Comments are stored securely in the database

## Testing

### Test Break Override Feature
1. **Run the SQL migration** to add the new columns
2. **Login as a Manager or Admin**
3. **Navigate to**: HR > Timesheet > Weekly Timesheet
4. **Find an employee** with clock-in/clock-out times
5. **Test the dropdown**:
   - Select "0 min" - should remove automatic breaks
   - Select "30 mins" - should apply 30 min break
   - Select "Auto" - should revert to automatic calculation
6. **Verify**: Net hours update correctly after each change
7. **Test as Employee**: Dropdown should not be visible

### Test Comment Feature
1. **Login as a Manager or Admin**
2. **Navigate to**: HR > Timesheet > Weekly Timesheet
3. **Find an employee** timesheet entry
4. **Click "Comment" button** - modal should open
5. **Type a comment** - e.g., "Test comment for this entry"
6. **Click "Save Comment"** - should show success message and reload
7. **Verify**: Blue checkmark badge appears on Comment button
8. **Click "Comment" again** - should show your previously saved comment
9. **Edit the comment** - change text and save
10. **Clear comment** - delete all text and save, checkmark should disappear
11. **Test modal closing**:
    - Click outside modal - should close
    - Press Escape key - should close
    - Click X button - should close
    - Click Cancel - should close without saving
12. **Test as Employee**: Comment button should not be visible

## Browser Compatibility
- Chrome ✅
- Firefox ✅
- Safari ✅
- Edge ✅
- Mobile browsers ✅

## Dependencies
- jQuery (already included)
- Font Awesome icons (already included)
- Tailwind CSS (already included)
- CodeIgniter 3.x

## Future Enhancements
- Add bulk override for multiple days
- Add audit log to track who changed break overrides and comments
- Add reason field for manual overrides
- Export manual overrides and comments in reports
- Add notification when manual override or comment is applied
- Add comment history/versioning
- Add comment search/filter functionality
- Add ability to tag other managers in comments
- Add timestamp showing when comment was last updated
- Export comments in Excel/PDF reports
