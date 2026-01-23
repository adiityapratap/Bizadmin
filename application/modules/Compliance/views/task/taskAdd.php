<div class="container" style="margin-top: 130px !important;">
   <div class="row">
       <div class="card mb-5">

       <?php if(isset($taskData->id)) { ?> 
            <form class="row g-3 needs-validation" novalidate 
                action="<?php echo base_url('Compliance/task/edit/'.(isset($taskData->id) ? $taskData->id : '')); ?>" 
                method="post">

            <input type="hidden" name="id" value="<?php echo (isset($taskData->id) ? $taskData->id : ''); ?>">

       <?php } else { ?>

            <form class="row g-3 needs-validation" novalidate 
                action="<?php echo base_url('Compliance/task/add'); ?>" 
                method="post">

       <?php } ?>            

            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1 text-black">Create Compliance</h4>

                <div class="flex-shrink-0">
                    <a type="button" class="btn bg-orange add-btn" id="create-btn" onclick="goBack()">
                        <i class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                    </a>

                    <?php if(isset($taskData->id)) { ?>        
                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                            <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Update Task
                        </button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                            <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Add Task
                        </button> 
                    <?php } ?>

                    <input type="hidden" name="submit" />
                </div>
            </div>

            <div class="card-body px-5">

                <div id="infoMessage" class="mb-3">
                    <?php echo (isset($message) ? $message : ''); ?>
                </div>

                <div class="row row-inner mb-2">

                    <div class="col-4 col-md-6 col-sm-6">
                        <label for="title" class="form-label fw-semibold">Task Name *</label>
                        <input type="text" class="form-control" id="task_name" name="task_name"  
                            value="<?php echo (isset($taskData->task_name) ? $taskData->task_name : ''); ?>" required>
                        <div class="invalid-feedback">Please enter Task Name.</div> 
                    </div>

                    <?php 
                        $selectedPrepId = (isset($taskData->prep_id) ? $taskData->prep_id : '');
                    ?>

                    <?php 
                        if($selectedPrepId != '') { 
                            $disabled = 'disabled'; 
                    ?>
                        <input type="hidden" name="prep_id" value="<?php echo $selectedPrepId; ?>">
                    <?php } else { 
                        $disabled = ''; 
                    } ?>

                    <div class="col-3 col-md-4 col-sm-6">
                        <label class="form-label fw-semibold">Area *</label>
                        <select <?php echo $disabled; ?> class="js-example-basic-multiple" name="prep_id">
                            <?php if(isset($prep_detail) && !empty($prep_detail)) { ?>
                                <?php foreach($prep_detail as $prep) { ?>
                                    <option value="<?php echo $prep['id']; ?>"
                                        <?php echo ($prep['id'] == $selectedPrepId ? 'selected' : ''); ?>>
                                        <?php echo $prep['prep_name'].' ['.$prep['site_name'].'] '; ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <small>Select the area where this task will be available.</small>  
                    </div>

                    <div class="col-4 col-md-4 col-sm-6">
                        <label class="form-label fw-semibold">Role *</label>
                        <select class="js-example-basic-multiple" name="role_id[]" multiple>
                            <?php 
                                $selectedRoleId = (isset($taskData->role_id) && $taskData->role_id != '' 
                                    ? unserialize($taskData->role_id) : []);
                            ?>

                            <?php if(isset($roles)) { ?>
                                <?php foreach($roles as $role) { ?>
                                    <option value="<?php echo $role['id']; ?>"
                                        <?php echo (in_array($role['id'], $selectedRoleId) ? 'selected' : ''); ?>>
                                        <?php echo $role['name']; ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <small>Select the roles to assign this task to.</small>  
                    </div>

                    <div class="col-2 col-md-6 col-sm-6">
                        <div class="form-check form-check-success mt-4">
                            <input class="form-check-input" type="checkbox" id="attachCheck"
                                <?php echo (isset($taskData->is_attchmentRequired) && $taskData->is_attchmentRequired == 1 ? 'checked' : ''); ?>
                                name="is_attchmentRequired">

                            <label class="form-check-label" for="attachCheck">
                                Is Attachment Required?
                            </label>
                        </div> 
                    </div>

                </div>

                <!-- SCHEDULE INPUTS -->
                <div class="row row-inner mb-2">

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Schedule *</label>
                        <select class="form-select" name="schedule_at" id="schedule_at" required>
                            <option value="" <?php echo (!isset($taskData->schedule_at) ? 'selected' : ''); ?>>Select Schedule</option>

                            <?php foreach(CLEANSCHEDULE as $key => $sch) { ?>
                                <option value="<?php echo $key; ?>"
                                    <?php echo (isset($taskData->schedule_at) && $taskData->schedule_at == $key ? 'selected' : ''); ?>>
                                    <?php echo $sch; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <small>Schedule the task to automatically appear.</small>
                    </div>

                    <?php
                        // Default hidden values
                        $schedule_typeClassName = "hideSST";
                        $schedule_dayNameClassName = "hideSDN";
                        $repeatWhichWeekClassName = "hideRWW";

                        if(isset($taskData->schedule_at) && $taskData->schedule_at == 2) {
                            $schedule_typeClassName = "";
                            if(isset($taskData->schedule_type) && $taskData->schedule_type == "day") {
                                $schedule_dayNameClassName = "";
                                $repeatWhichWeekClassName = "";
                            }
                        }
                    ?>

                    <div class="col-md-3 schedule_type <?php echo $schedule_typeClassName; ?>">
                        <label class="form-label fw-semibold">Select schedule Type *</label>
                        <select class="form-select" name="schedule_type" id="schedule_type">
                            <option value="">Select schedule Type</option>
                            <option value="day" <?php echo (isset($taskData->schedule_type) && $taskData->schedule_type == 'day' ? 'selected' : ''); ?>>Day</option>
                            <option value="date" <?php echo (isset($taskData->schedule_type) && $taskData->schedule_type == 'date' ? 'selected' : ''); ?>>Date</option>
                        </select>
                    </div>

                    <div class="col-md-3 schedule_dayName <?php echo $schedule_dayNameClassName; ?>">
                        <label class="form-label fw-semibold">Select Which Day *</label>
                        <select class="form-select" name="schedule_dayName" id="schedule_dayName">
                            <option value="">Select Which Day</option>
                            <?php 
                                for ($i = 0; $i < 7; $i++) {
                                    $timestamp = strtotime("Sunday +$i days");
                                    $dayName  = date('l', $timestamp);
                            ?>
                                <option value="<?php echo $dayName; ?>"
                                    <?php echo (isset($taskData->schedule_dayName) && $taskData->schedule_dayName == $dayName ? 'selected' : ''); ?>>
                                    <?php echo $dayName; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3 repeatWhichWeek <?php echo $repeatWhichWeekClassName; ?>">
                        <label class="form-label fw-semibold">Repeat Which Week *</label>
                        <select class="form-select" name="repeatWhichWeek">
                            <?php for($w=1;$w<=4;$w++) { ?>
                                <option value="<?php echo $w; ?>"
                                    <?php echo (isset($taskData->repeatWhichWeek) && $taskData->repeatWhichWeek == $w ? 'selected' : ''); ?>>
                                    <?php echo $w; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3 mt-2 custom_date_schedule 
                        <?php echo (isset($taskData->schedule_at) && $taskData->schedule_at == 2 ? 'hideDateRange' : 'showDaterange'); ?>">

                        <label class="form-label fw-semibold mb-0">Date</label>

                        <input type="text" class="form-control flatpickr-input active"
                            value="<?php echo (isset($taskData->schedule_date) ? date('d-m-Y', strtotime($taskData->schedule_date)) : ''); ?>"
                            data-provider="flatpickr" data-date-format="d-m-Y"
                            name="schedule_date" placeholder="Select date" readonly>

                        <small>Select a date or double-click for single date.</small>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Add Time</label>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="gap-2 d-flex">
                                        <input type="text" name="task_time[]" 
                                            class="form-control item JUItimepicker"
                                            value="<?php echo (isset($taskData->task_time) ? $taskData->task_time : ''); ?>"
                                            placeholder="Enter time" autocomplete="off" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <small>Add multiple times if required.</small>
                    </div>

                </div>

            </div> <!-- card body -->
        </form>

        </div>
    </div>
</div>
