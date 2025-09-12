<div class="container" style="margin-top: 130px !important;">
   <div class="row">
           <div class="card mb-5">
       <?php if(isset($equpData->id)) {   ?> 
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("Temp/equip/edit/".$equpData->id) ?>" method="post">  
     <input type="hidden" name="id" value="<?php echo $equpData->id; ?>">
            <?php }else { ?>
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("Temp/equip/add") ?>" method="post">        
            <?php } ?>            
            <div class="card-header align-items-center d-flex">
                         <h4 class="card-title mb-0 flex-grow-1 text-black">Add Equipment</h4>
              <div class="flex-shrink-0"><a type="button" class="btn bg-orange add-btn" id="create-btn" href="<?php echo base_url('Temp/equip/fetchEquipList') ?>"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                            </a>
                        <?php if(isset($equpData->id)) {  ?>        
                         <button type="submit"  class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Update Equipment</button>
                          <?php }else{  ?>
                         <button type="submit"  class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Add Equipment</button> 
                          <?php  } ?>
                          <input type="hidden" name="submit" />
                         </div>
                      </div>
        <div class="card-body px-5">
        <div id="infoMessage" class="mb-3"><?php  echo (isset($message) ? $message : '');?></div>
            <div class="row row-inner mb-2">
                        
                           <div class="col-4 col-md-6 col-sm-6">
                             <label for="title" class="form-label fw-semibold">Equipment Name *</label>
                               <input type="text" class="form-control" id="equip_name" name="equip_name"  value="<?php echo (isset($equpData->equip_name) ? $equpData->equip_name : ''); ?>" required>
                            <div class="invalid-feedback">Please enter Equipment Name.</div> 
                           </div>  
                           <?php $selectedPrepId = (isset($equpData->prep_id) && $equpData->prep_id !='' ? ($equpData->prep_id) : ''); ?>
                           <?php 
                           if($selectedPrepId !=''){ $disabled='disabled'; ?>
                           <input type="hidden" name="prep_id" value="<?php echo $selectedPrepId; ?>">
                          <?php  }else{
                              $disabled= '';
                           }
                           ?>
                            <div class=" col-3 col-md-4 col-sm-6">
                                           <label for="role_id" class="form-label fw-semibold">Area *</label>
                                            <select <?php echo $disabled; ?> class="js-example-basic-multiple" name="prep_id"  >
                                             <?php if(isset($prep_detail) && !empty($prep_detail)) {  ?>  
                                             <?php foreach($prep_detail as $prep) {  ?>
                                             <?php if($prep['id'] == $selectedPrepId) {  ?>
                                             <option selected="selected" value="<?php echo $prep['id'] ?>"><?php echo $prep['prep_name'].' ['.$prep['site_name'].'] '; ?></option>
                                             <?php } else { ?>
                                             <option  value="<?php echo $prep['id'] ?>"><?php echo $prep['prep_name'].' ['.$prep['site_name'].'] '; ?></option>
                                             <?php } ?>
                                             <?php } ?>
                                             <?php } ?>
                                            </select>
                            <small>Select the  area where this equipment will be available. </small>  
                            </div>
                                        
                              <div class="col-3 col-md-6 col-sm-6">
                               <label for="schedule_at" class="form-label fw-semibold">Frequency of notification to manager *</label>
                    <select class="form-select " name="mailFrequency" id="mailFrequency" required>
                    <option value="daily" <?php (isset($equpData->mailFrequency) && $equpData->mailFrequency !='' ? 'selected' : '') ?>>Daily</option>
                    <option value="weekly" <?php (isset($equpData->mailFrequency) && $equpData->mailFrequency !='' ? 'selected' : '') ?>>Weekly</option>
                    </select>   
                               </div>             
                           
                             <div class="col-2 col-md-6 col-sm-6">
                            <div class="form-check form-check-success mt-4">
                                
                               <input class="form-check-input" type="checkbox" id="attachCheck" <?php echo (isset($equpData->is_attchmentRequired) && $equpData->is_attchmentRequired == 1 ? 'checked' : ''); ?> name="is_attchmentRequired">
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
                    <option <?php echo (isset($equpData->schedule_at) ? '' :'selected'); ?> value="">Select Schedule</option>
                    <?php foreach(TEMPSCHEDULE as $key=>$sch) {  ?>
                    <option <?php echo (isset($equpData->schedule_at) && $equpData->schedule_at == $key ? 'selected' : '' ) ?> value="<?php echo $key; ?>"><?php echo $sch ?></option>
                     <?php }  ?>
                    </select>
                  <small>Schedule the Equipment to automatically appear on scheduled dates</small>
                 </div>  
                 
                 
                  <div class="col-md-3 mt-2 custom_date_schedule <?php // echo (isset($checklistData->schedule_at) && $checklistData->schedule_at == 5 ? 'showDaterange' : 'hideDateRange'); ?>">
                      <label class="form-label mb-0 fw-semibold">Date</label>
                      <input type="text" required value="<?php echo (isset($equpData->schedule_date) ? date('d-m-Y',strtotime($equpData->schedule_date)) : '') ?>" class="form-control flatpickr-input active" data-provider="flatpickr" data-date-format="d-m-Y"   name="schedule_date"   placeholder="Select date" readonly="readonly">         
                      <small>Date - Select the date from which the scheduling should start. If you would like to select a single date, double click on it.</small>   
                    </div>
                                                
                    
                    
              
               <div class="col-md-3">
                  <label for="sort_order" class="form-label fw-semibold">Add Time</label>
               <table class="table table-bordered">
            <tbody>
                <?php if(isset($equpData->equip_time)) { ?>
                
               
              
                    <tr>
                    <td class="gap-2 d-flex">
                    <input required type="text" name="equip_time[]" class="form-control item  JUItimepicker " value="<?php echo (isset($equpData->equip_time) ? $equpData->equip_time : ''); ?>" placeholder="Enter time" autocomplete="off" />
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                    <td><button type="button" class="btn btn-danger remove-row">-</button></td>
                </tr>
                       
               <?php      }  else {   ?>
             <tr>
                    <td class="gap-2 d-flex">
                    <input type="text" name="equip_time[]" class="form-control item  JUItimepicker " placeholder="Enter time" autocomplete="off" required />
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                </tr>  
               
               <?php  } ?>
               
            </tbody>
        </table> 
        <small>Add the time by which the equipment should be recorded. Multiple times can be added if required. </small> 
                 </div>
                 
            
            </div>
            
            <div class="row row-inner mb-2">
                
                 <div class="col-md-5">
               <label for="schedule_at" class="form-label fw-semibold">Temperature in Degrees/Calibration in Secs </label>
               
              <div class="d-inline-flex gap-2 mb-3">
                  
              <input required name="temp_min" type="text" value="<?php echo (isset($equpData->temp_min) && $equpData->temp_min !='' ? $equpData->temp_min : '') ?>" class="form-control form-control-sm w-xs shadow-none" min="-50" max="100" step="1" id="input-select">
             <input required name="temp_max" type="text" value="<?php echo (isset($equpData->temp_max) && $equpData->temp_max !='' ? $equpData->temp_max : '') ?>" class="form-control form-control-sm w-xs shadow-none" min="-50" max="100" step="1" id="input-number">
             </div>
              </div><!-- end col -->               
             <small> Enter the acceptable temperature limit for this equipment.  </small>               
                 
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
let newRow = '<tr><td class="gap-2 d-flex"><input type="text" name="equip_time[]" class="form-control item JUItimepicker" placeholder="Enter time" autocomplete="off"  />';
                 newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });

            // Remove row on minus button click
            $('tbody').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
            
            
        });
        
                </script>
                