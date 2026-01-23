<div class="container" style="margin-top: 130px !important;">
   <div class="row">
           <div class="card mb-5">
       <?php if(isset($taskData->id)) {   ?> 
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("Shifts/task/edit/".$taskData->id) ?>" method="post">  
     <input type="hidden" name="id" value="<?php echo $taskData->id; ?>">
            <?php }else { ?>
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("Shifts/task/add") ?>" method="post">        
            <?php } ?>            
            <div class="card-header align-items-center d-flex">
                         <h4 class="card-title mb-0 flex-grow-1 text-black">Create Task</h4>
              <div class="flex-shrink-0"><a type="button" class="btn bg-orange add-btn" id="create-btn" onclick="goBack()"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                            </a>
                        <?php if(isset($taskData->id)) {  ?>        
                         <button type="submit"  class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Update Task</button>
                          <?php }else{  ?>
                         <button type="submit"  class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Add Task</button> 
                          <?php  } ?>
                          <input type="hidden" name="submit" />
                         </div>
                      </div>
        <div class="card-body px-5">
        <div id="infoMessage" class="mb-3"><?php  echo (isset($message) ? $message : '');?></div>
            <div class="row row-inner mb-2">
                        
                           <div class="col-4 col-md-6 col-sm-6">
                             <label for="title" class="form-label fw-semibold">Task Name *</label>
                               <input type="text" class="form-control" id="task_name" name="task_name"  value="<?php echo (isset($taskData->task_name) ? $taskData->task_name : ''); ?>" required>
                            <div class="invalid-feedback">Please enter Task Name.</div> 
                           </div>  
                           <div class="col-4 col-md-6 col-sm-6">
                             <label for="shift_id" class="form-label fw-semibold">Select Shift *</label>
                           <select <?php echo $disabled; ?> class="form-select" name="shift_id"  >
                            <?php if(isset($shiftLists) && !empty($shiftLists)) {  ?>  
                             <?php foreach($shiftLists as $shiftList) {  ?>
                             <?php if($shiftList['id'] == $taskData->shift_id) {  ?>
                              <option selected="selected" value="<?php echo $shiftList['id'] ?>"><?php echo $shiftList['name']; ?></option>
                               <?php } else { ?>
                               <option  value="<?php echo $shiftList['id'] ?>"><?php echo $shiftList['name']; ?></option>
                               <?php } ?>
                               <?php } ?>
                             <?php } ?>
                            </select>
                              </div>  
                           <?php $selectedPrepId = (isset($taskData->prep_id) && $taskData->prep_id !='' ? ($taskData->prep_id) : ''); ?>
                           
                           
                            <div class=" col-3 col-md-4 col-sm-6">
                                           <label for="role_id" class="form-label fw-semibold">Area *</label>
                                            <select  class="js-example-basic-multiple" name="prep_id"  >
                                            <option  value="">Select area</option>       
                                             <?php if(isset($prep_detail) && !empty($prep_detail)) {  ?>  
                                             <?php foreach($prep_detail as $prep) {  ?>
                                             <?php if($prep['id'] == $selectedPrepId) {  ?>
                                             <option selected="selected" value="<?php echo $prep['id'] ?>"><?php echo $prep['name']; ?></option>
                                             <?php } else { ?>
                                             <option  value="<?php echo $prep['id'] ?>"><?php echo $prep['name']; ?></option>
                                             <?php } ?>
                                             <?php } ?>
                                             <?php } ?>
                                            </select>
                                        <small>Select the  area where this task will be available. </small>  
                                        </div>
                                        
                             <div class="col-4 col-md-4 col-sm-6">
                                           <label for="role_id" class="form-label fw-semibold">Role *</label>
                                            <select class="js-example-basic-multiple" name="role_id[]"  multiple>
                                             <?php if(isset($roles) && !empty($roles)) {  ?> 
                                             <?php $selectedRoleId  =  (isset($taskData->role_id) && $taskData->role_id !='' ? unserialize($taskData->role_id) :'') ?>
                                             <?php foreach($roles as $role) {  ?>
                                             <?php if (is_array($selectedRoleId) && in_array($role['id'], $selectedRoleId)) { ?>
                                             <option  value="<?php echo $role['id'] ?>" selected><?php echo $role['name']; ?></option>
                                             <?php }else {  ?>
                                             <option  value="<?php echo $role['id'] ?>"><?php echo $role['name']; ?></option>
                                             <?php } ?>
                                             <?php } ?>
                                             <?php } ?>
                                            </select>
                                        <small>Select the  roles to assign this task to. </small>  
                                        </div>
                                               
                           
                             <div class="col-2 col-md-6 col-sm-6">
                            <div class="form-check form-check-success mt-4">
                                
                               <input class="form-check-input" type="checkbox" id="attachCheck" <?php echo (isset($taskData->is_attchmentRequired) && $taskData->is_attchmentRequired == 1 ? 'checked' : ''); ?> name="is_attchmentRequired">
                               <label class="form-check-label" for="attachCheck">
                                Is Attachment Required ?
                                </label>
                               </div> 
                           </div> 
                           
                          
                        
                        </div>   
                       
         
             <div class="row row-inner mb-2">
                  <div class="col-md-3">
                      <label for="schedule_at" class="form-label fw-semibold">Schedule *</label>
                    <select class="form-select " name="schedule_at" id="schedule_at" required>
                    <option <?php echo (isset($taskData->schedule_at) ? '' :'selected'); ?> value="">Select Schedule</option>
                    <?php foreach(CLEANSCHEDULE as $key=>$sch) {  ?>
                    <option <?php echo (isset($taskData->schedule_at) && $taskData->schedule_at == $key ? 'selected' : '' ) ?> value="<?php echo $key; ?>"><?php echo $sch ?></option>
                     <?php }  ?>
                    </select>
                  <small>Schedule the Task to automatically appear on scheduled dates</small>
                 </div> 
                 <?php if(isset($taskData->schedule_at) && $taskData->schedule_at == 2){
                 
                 if($taskData->schedule_type == 'day'){
                  $schedule_dayNameClassName='';
                   $repeatWhichWeekClassName =''; 
                   $schedule_typeClassName='';  
                 }else{
                    $schedule_typeClassName='';  
                    $schedule_dayNameClassName ='hideSDN';
                     $repeatWhichWeekClassName ='hideRWW';
                    
                 }
                 
                 }
                 else{
                     $schedule_typeClassName ='hideSST';
                     $schedule_dayNameClassName ='hideSDN';
                     $repeatWhichWeekClassName ='hideRWW';
                     
                 } ?>
                 <div class="col-md-3 schedule_type <?php echo $schedule_typeClassName; ?>">
                      <label for="schedule_at" class="form-label fw-semibold">Select schedule Type *</label>
                    <select class="form-select " name="schedule_type" id="schedule_type">
                    <option <?php echo (isset($taskData->schedule_type) ? '' :'selected'); ?> value="">Select schedule Type</option>
                    <option <?php echo (isset($taskData->schedule_type) && $taskData->schedule_type == 'day' ? 'selected' :''); ?> value="day">Day</option>
                     <option <?php echo (isset($taskData->schedule_type) && $taskData->schedule_type == 'date' ? 'selected' :''); ?> value="date">Date</option>
                    </select>
                 
                 </div>  
                 
                 <div class="col-md-3 schedule_dayName <?php echo $schedule_dayNameClassName; ?>">
                      <label for="schedule_at" class="form-label fw-semibold">Select Which Day *</label>
                    <select class="form-select " name="schedule_dayName" id="schedule_dayName">
                    <option <?php echo (isset($taskData->schedule_dayName) && $taskData->schedule_dayName =='' ? 'selected' :''); ?> value="">Select Which Day</option>
                   <?php  for ($i = 0; $i < 7; $i++) {
                    $timestamp = strtotime("Sunday +$i days"); $dayName =  date('l', $timestamp); ?>
                     <option <?php echo (isset($taskData->schedule_dayName) && $taskData->schedule_dayName == $dayName ? 'selected' :''); ?> value="<?php echo $dayName; ?>"><?php echo $dayName; ?></option>    
                      <?php  } ?>
                    </select>
                 </div>
                 
                 <div class="col-md-3 repeatWhichWeek <?php echo $repeatWhichWeekClassName; ?>">
                      <label for="repeatWhichWeek" class="form-label fw-semibold">Repeat Which Week *</label>
                     <select class="form-select " name="repeatWhichWeek">
                    <option value="1" <?php echo (isset($taskData->repeatWhichWeek) && $taskData->repeatWhichWeek == '1' ? 'selected' :''); ?>>1</option>
                    <option value="2" <?php echo (isset($taskData->repeatWhichWeek) && $taskData->repeatWhichWeek == '2' ? 'selected' :''); ?>>2</option> 
                    <option value="3" <?php echo (isset($taskData->repeatWhichWeek) && $taskData->repeatWhichWeek == '3' ? 'selected' :''); ?>>3</option> 
                    <option value="4" <?php echo (isset($taskData->repeatWhichWeek) && $taskData->repeatWhichWeek == '4' ? 'selected' :''); ?>>4</option> 
                     </select>
                  </div>
                  
                  
                  <div class="col-md-3 mt-2 custom_date_schedule <?php echo (isset($taskData->schedule_at) && $taskData->schedule_at == 2 ? 'hideDateRange' : 'showDaterange'); ?>">
                      <label class="form-label mb-0 fw-semibold">Date</label>
                      <input type="text" required value="<?php echo (isset($taskData->schedule_date) ? date('d-m-Y',strtotime($taskData->schedule_date)) : '') ?>" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="d-m-Y"   name="schedule_date"   placeholder="Select date" readonly="readonly">         
                      <small>Date - Select the date from which the scheduling should start. If you would like to select a single date, double click on it.</small>   
                    </div>
                                                
                    
                    
              
               <div class="col-md-3">
                  <label for="sort_order" class="form-label fw-semibold">Add Time</label>
               <table class="table table-bordered">
            <tbody>
                <?php if(isset($taskData->task_time)) { ?>
                
               
              
                    <tr>
                    <td class="gap-2 d-flex">
                    <input  type="text" name="task_time" class="form-control item  JUItimepicker " value="<?php echo (isset($taskData->task_time) ? $taskData->task_time : ''); ?>" placeholder="Enter time" autocomplete="off" />
                    </td>
                    <!--<td><button class="btn btn-success add-row " type="button">+</button></td>-->
                    <!--<td><button type="button" class="btn btn-danger remove-row">-</button></td>-->
                </tr>
                       
               <?php      }  else {   ?>
             <tr>
                    <td class="gap-2 d-flex">
                    <input type="text" name="task_time" class="form-control item  JUItimepicker " placeholder="Enter time" autocomplete="off"  />
                    </td>
                    <!--<td><button class="btn btn-success add-row " type="button">+</button></td>-->
                </tr>  
               
               <?php  } ?>
               
            </tbody>
        </table> 
        <small>Add the time by which the task should be recorded. </small> 
                 </div>
                 
            
            </div>
            
          
                            
                            
                            
                    
              
                            
        </div>
         </form>
                </div> 
                </div>
                </div>
                <script>
                
               $(document).ready(function () {
            // Add new row on plus button click
            $('tbody').on('click', '.add-row', function () {
let newRow = '<tr><td class="gap-2 d-flex"><input type="text" name="task_time[]" class="form-control item JUItimepicker" placeholder="Enter time" autocomplete="off"  />';
                 newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });

            // Remove row on minus button click
            $('tbody').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
              $(".hideSST").hide();  $(".hideSDN").hide();$(".hideRWW").hide();
              
           $("#schedule_at").on('change', function () {
           let schedule_period = $(this).val();
           // 2  = monthly
             if (schedule_period == 2) {
             $(".schedule_type").show();
             $(".custom_date_schedule").hide();
             } else {
             $(".schedule_type").hide();
             $(".schedule_dayName").hide();
             $(".repeatWhichWeek").hide();
             $(".custom_date_schedule").show();
             }
             });

$("#schedule_type").on('change', function () {
    let schedule_type = $(this).val();
    if (schedule_type == 'day') {
        $(".schedule_dayName").show();
        $(".repeatWhichWeek").show();
    } else {
        $(".schedule_dayName").hide();
        $(".repeatWhichWeek").hide();
        $(".custom_date_schedule").show();
    }
});

            
            
        });
        
                </script>
                