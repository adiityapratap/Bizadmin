<div class="container" style="margin-top: 130px !important;">
   <div class="row">
           <div class="card mb-5">
       <?php if(isset($prepData->id)) {  ?> 
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("prep/editPrep/".$checklistData->id) ?>" method="post">  
     <input type="hidden" name="checklist_id" value="<?php echo $prep_id; ?>">
            <?php }else { ?>
     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("prep/prepAdd") ?>" method="post">        
            <?php } ?>            
            <div class="card-header align-items-center d-flex">
                         <h4 class="card-title mb-0 flex-grow-1 text-black">Add Equipment</h4>
              <div class="flex-shrink-0"><a type="button" class="btn bg-orange add-btn" id="create-btn" href="<?php echo base_url('prep/prepListing') ?>"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                            </a>
                        <?php if(isset($prepData->id)) {  ?>        
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
                        
                           <div class="col-md-4">
                             <label for="title" class="form-label fw-semibold">Equipment Name *</label>
                               <input type="text" class="form-control" id="equip_name" name="equip_name"  value="<?php echo (isset($prepData->equip_name) ? $prepData->equip_name : ''); ?>" required>
                            <div class="invalid-feedback">Please enter Equipment Name.</div> 
                           </div>  
                           
                            <div class="col-md-3">
                                           <label for="role_id" class="form-label fw-semibold">Prep Area *</label>
                                            <select class="js-example-basic-multiple" name="role_id[]" multiple="multiple" >
                                                
                                            </select>
                                        <small>Select for which prep areas this will belong to </small>  
                                        </div>
                           
                            <div class="col-md-4">
                             <label for="title" class="form-label fw-semibold">Time *</label>
                               <input type="text" class="form-control" id="equip_name" name="equip_name"  value="<?php echo (isset($prepData->time) ? $prepData->time : ''); ?>" >
                            <div class="invalid-feedback">Please enter time.</div> 
                             <small>Select up to 5 times </small>  
                           </div> 
                           
                        
                        
                        
                        </div>   
                       
            <div class="row row-inner mb-2">
                
                            <div class="col-md-2">
                            <div class="form-check form-check-success mb-3">
                               <input class="form-check-input" type="checkbox" id="formCheck8" checked="">
                               <label class="form-check-label" for="formCheck8">
                                Is Attachment Required ?
                                </label>
                               </div> 
                           </div> 
                           
                         
                                       <div class="col-md-3">
                                                    <label for="schedule_at" class="form-label fw-semibold">Schedule *</label>
                                                    <select class="form-select " name="schedule_at" id="schedule_at" required>
                                                        <option <?php echo (isset($checklistData->schedule_at) ? '' :'selected'); ?> value="">Select Schedule</option>
                                                        <?php foreach(CHECKLISTSCHEDULE as $key=>$sch) {  ?>
                                                        <option <?php echo (isset($checklistData->schedule_at) && $checklistData->schedule_at == $key ? 'selected' : '' ) ?> value="<?php echo $key; ?>"><?php echo $sch ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                   <small>Schedule the Equipment to automatically appear on scheduled dates</small>
                                                </div>  

            </div>
            
            
        </div>
         </form>
                </div> 
                </div>
                </div>
                