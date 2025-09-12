<div class="container" style="margin-top: 130px !important;">
   <div class="row">
           <div class="card mb-5">
       <?php if(isset($checklistData->id)) {  ?> 
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("checklist/editChecklist/".$checklistData->id) ?>" method="post">  
     <input type="hidden" name="checklist_id" value="<?php echo $checklist_id; ?>">
            <?php }else { ?>
     <form class="row g-3 needs-validation checkListForm" novalidate action="<?php echo base_url("checklist/checklist") ?>" method="post">  
     
            <?php } ?>            
            <div class="card-header align-items-center d-flex">
                         <h4 class="card-title mb-0 flex-grow-1 text-black">Create Checklist</h4>
              <div class="flex-shrink-0"><a type="button" class="btn bg-orange add-btn" id="create-btn" href="<?php echo base_url('checklist/checklistListing') ?>"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                            </a>
                        <?php if(isset($checklistData->id)) {  ?>        
                         <button type="submit"  class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Update Checklist</button>
                          <?php }else{  ?>
                         <button type="submit"   class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Add Checklist</button> 
                          <?php  } ?>
                          <input type="hidden" name="submit" />
                         </div>
                      </div>
        <div class="card-body px-5">
        <div id="infoMessage" class="mb-3"><?php  echo (isset($message) ? $message : '');?></div>
            <div class="row row-inner mb-2">
                        <input type="hidden" name="sort_order" value="<?php echo (isset($checklistData->sort_order) ? $checklistData->sort_order : ''); ?>">
                           <div class="col-md-4">
                             <label for="title" class="form-label fw-semibold">Topic *</label>
                               <input type="text" class="form-control" id="title" name="title"  value="<?php echo (isset($checklistData->title) ? $checklistData->title : ''); ?>" required>
                            <div class="invalid-feedback">Please enter the task name.</div> 
                           </div>   
                           
                          
                           
                            <div class="col-md-5">
                             <label for="description" class="form-label fw-semibold">Description </label>
                               <textarea class="form-control" id="description" name="description"  rows="2" col="3"><?php echo (isset($checklistData->descr) ? $checklistData->descr : ''); ?> </textarea>
                                
                              
                         <div class="invalid-feedback">Please enter description.</div> 
                           </div>   
                           
                        <div class="col-md-1" style="width: 12.5%;">
                             <label for="deadline_time" class="form-label fw-semibold"> Time</label>
                               <div class="input-group">
                                   
                                 <input name="deadline_time" class="form-control JUItimepicker" id="deadline_time" value="<?php echo (isset($checklistData->deadline_time) && $checklistData->deadline_time !='' ?  date('H:i A', strtotime($checklistData->deadline_time)) : '') ; ?>" autocomplete="off" >        
                                 </div>
                            <small>Deadline time before which this checklist needs to be completed</small> 
                            </div>
                            
                          
                        
                        
                        </div>   
                        <div class="row row-inner mb-2">
                            
                             <div class="col-md-7">
                  <label for="sort_order" class="form-label fw-semibold">Add Sub Tasks </label>
               <table class="table table-bordered">
            <tbody>
                <?php if(isset($subchecklistData) && !empty($subchecklistData)) { $allSubChecklistIds = array();  ?>
                <?php foreach($subchecklistData as $subchecklistrec) {  $allSubChecklistIds[] = $subchecklistrec->id; ?>
                <tr>
                    <td class="gap-2 d-flex">
                    <input type="text" name="subtask[<?php echo $subchecklistrec->id; ?>]" class="form-control item w-75" value="<?php echo $subchecklistrec->descr ?>" />
                    
                    <input type="text" name="subchecklist_time[<?php echo $subchecklistrec->id; ?>]" value="<?php echo (isset($subchecklistrec->subchecklist_time) && $subchecklistrec->subchecklist_time !='' ? date('H:i A', strtotime($subchecklistrec->subchecklist_time)) : '') ; ?>" class="form-control item w-25 JUItimepicker" autocomplete="off" />
                   <input type="hidden" name="subchecklist_id[]" value="<?php echo $subchecklistrec->id; ?>">
                   
                  
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                    <td><button type="button" class="btn btn-danger remove-row">-</button></td>
                </tr>
                <?php }  ?>
                <input type="hidden" name="Allsubchecklist_id" value="<?= htmlspecialchars(serialize($allSubChecklistIds)) ?>">
                <?php }else { ?>
                
                <tr>
                    <td class="gap-2 d-flex">
                        <input type="text" name="subtask[]" class="form-control item w-75" />
                    <input type="text" name="subchecklist_time[]" class="form-control item w-25 JUItimepicker " placeholder="Enter time" autocomplete="off" />
                  
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                </tr>
                <?php }  ?>
            </tbody>
        </table>  
                 </div>
                 
                            </div>
            <div class="row row-inner mb-2">
                 <?php if(!empty($system_details)){  $i =0 ?>   
                         <div class="col-lg-3 col-md-3">
                                           
                                            <label for="system_id" class="form-label fw-semibold"> For System  </label>
                                             <select class="form-select" name="system_id" id="system_id">
                                                  <option <?php echo (isset($checklistData->system_id) ? '' :'selected'); ?>  value="">Select System</option>
                                               <?php foreach($system_details as $system){ ?>
                                                 <option <?php echo (isset($checklistData->system_id) && $checklistData->system_id ===$system['system_id'] ? 'selected' : '' ) ?>   value="<?php echo $system['system_id']; ?>"><?php echo $system['system_name']; ?> </option>
                                                  <?php } ?>
                                            </select>
                                            <small>Select system if the task belongs to any of the systems for faster navigation</small> 
                                             <div class="invalid-feedback">Please select system.</div> 
                       </div>
                        <?php } ?> 
                             <div class="col-md-3">
                                           <label for="role_id" class="form-label fw-semibold">Role *</label>
                                            <select class="js-example-basic-multiple" name="role_id[]" multiple="multiple" id="checkListRole">
                                                
                                               <?php    foreach($roles as $role){ ?>
                                               <?php if(isset($checklistData) && is_array(unserialize($checklistData->role_id)) && in_array((int)$role['id'],unserialize($checklistData->role_id))) { ?>
                                                 <option   value="<?php echo $role['id'] ?>"  selected="selected"><?php echo $role['name'] ?></option>  
                                                  <?php }else { ?>
                                                <option   value="<?php echo $role['id']?>" ><?php echo $role['name'] ?></option>  
                                                   <?php } ?>
                                                  <?php } ?>
                                            </select>
                                            <div class="invalid-feedback roleInvalid">Please select roles , this checklist will be assigned to.</div>
                                        <small>Only select if this checklist is for any specific role </small>  
                                        </div>
                
                
                  <div class="col-md-3">
                                                    <label for="schedule_at" class="form-label fw-semibold">Schedule *</label>
                                                    <select class="form-select " name="schedule_at" id="schedule_at" required>
                                                        <option <?php echo (isset($checklistData->schedule_at) ? '' :'selected'); ?> value="">Select Schedule</option>
                                                        <?php foreach(CHECKLISTSCHEDULE as $key=>$sch) {  ?>
                                                        <option <?php echo (isset($checklistData->schedule_at) && $checklistData->schedule_at == $key ? 'selected' : '' ) ?> value="<?php echo $key; ?>"><?php echo $sch ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                   <small>Schedule the checklist to automatically appear on scheduled dates</small>
                                                </div>  
                 <div class="col-md-3 mt-2 custom_date_schedule <?php // echo (isset($checklistData->schedule_at) && $checklistData->schedule_at == 5 ? 'showDaterange' : 'hideDateRange'); ?>">
                                                    <label class="form-label mb-0 fw-semibold">Date</label>
                                                    <?php if(isset($checklistData)) { ?>
                                                    <?php if($checklistData->checklist_start_date !='' && $checklistData->checklist_end_date !='') { ?>
                                                    <input type="text" class="form-control flatpickr-input" value="<?php echo date("d F, Y", strtotime($checklistData->checklist_start_date)); ?> to <?php echo date("d F, Y", strtotime($checklistData->checklist_end_date)); ?>" data-provider="flatpickr"  name="date_range" data-date-format="d M, Y" data-range-date="true"  readonly="readonly">
                                                      <small><?php echo date("d-m-Y", strtotime($checklistData->checklist_start_date)).' to ' ?>  <?php echo date("d-m-Y", strtotime($checklistData->checklist_end_date)); ?></small>
                                                      
                                                      <?php } elseif($checklistData->checklist_start_date !='' && $checklistData->checklist_end_date =='') { ?>
                                                   <input type="text" value="<?php echo date("d F, Y", strtotime($checklistData->checklist_start_date)); ?>" class="form-control flatpickr-input" data-provider="flatpickr"  name="date_range" data-date-format="d M, Y" data-range-date="true"  placeholder="Select date" readonly="readonly">      
                                                      <small><?php echo date("d-m-Y", strtotime($checklistData->checklist_start_date)) ?></small>
                                                      <?php }else{ ?>
                                                   <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"  name="date_range" data-date-format="d M, Y" data-range-date="true"  placeholder="Select date" readonly="readonly">   
                                                     <small>Date - Select the date from which the scheduling should start. If you would like to select a single date, double click on it.</small>  
                                                       <?php }  ?>
                                                       <?php } else { ?>
                                                  <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"  name="date_range" data-date-format="d M, Y" data-range-date="true"  placeholder="Select date" readonly="readonly">         
                                                     <small>Date - Select the date from which the scheduling should start. If you would like to select a single date, double click on it.</small>   
                                                        <?php }  ?>
                                                 
                                                    
                                                </div>
           
            </div>
            
        </div>
         </form>
                </div> 
                </div>
                </div>
                
                
                
                <script>
                $(".checkListForm").submit(function(event) {
                if (!validateFormAndSubmit()) {
                 event.preventDefault();
                 return false;
                }
                });
  
                function validateFormAndSubmit(){
                 let checklistRole = $("#checkListRole").val();
                 if(checklistRole ==''){
                   $(".roleInvalid").show();
                   return false;
                 }else{
                  $(".roleInvalid").hide();
                  return true;
                 }
                }
                
                 $(document).ready(function () {
        $('.JUItimepicker').timepicker({
           timeFormat: 'h:mm p',
           interval: 30,
        //   minTime: '01.00 am',
        //   maxTime: '12.30 am',
        //   defaultTime: '6',
        //   startTime: '06:00',
           dynamic: true,
           dropdown: true,
           scrollbar: true
           });
           
           $(document).on('focus', '.JUItimepicker', function() {
          $(this).timepicker();
         })
         });


    
               $(document).ready(function () {
            // Add new row on plus button click
            $('tbody').on('click', '.add-row', function () {
let newRow = '<tr><td class="gap-2 d-flex"><input name="subtask[]" type="text" class="form-control item w-75 " /><input type="text" name="subchecklist_time[]" class="form-control item JUItimepicker w-25" placeholder="Enter time" autocomplete="off"  />';
                 newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });

            // Remove row on minus button click
            $('tbody').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
        });
                $(".showDaterange").show(); $(".hideDateRange").hide(); 
               
                </script>