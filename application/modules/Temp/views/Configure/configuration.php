<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                             <div class="col-12">
                                <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black" style="z-index: 9999;">Configure</h4>
                                </div>
                            </div>
                                    </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-body">
               <form action="<?php echo base_url(); ?>Temp/configuresubmit" method="post" class="form-horizontal mt-5">
                 
                  <input type="hidden" name="configureFor" value="mail">
                  <div class="row">       
                                   <div class="col-md-6 col-sm-12">
                  <label for="sort_order" class="form-label fw-semibold">Add Notification Email</label>
                 
               <table class="table table-bordered mt-3" id="notificationMailTable">
            <tbody>
                <?php   if(isset($mailConfigData) && !empty($mailConfigData)) {   ?>
                <?php foreach($mailConfigData as $emails) { ?>
                 <input type="hidden" name="configId[]" value="<?php echo $emails['id'] ?>">
                <?php $emailTo = unserialize($emails['data']);  ?>
                <?php foreach($emailTo as $emailId) { ?>
               <tr>
               <td>
             <select class="form-select notificationMailoptions" name="mailType[]">
             <option value="" >Select option</option>
             <option value="tempExceed_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'tempExceed_mail'  ? 'selected'  : '')) ?>>Equipment Temp Exceed </option>
             <option value="foodTempExceed_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'foodTempExceed_mail'  ? 'selected'  : '')) ?>>Food Temperature Exceed</option>
             <option value="chillingTempExceed_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'chillingTempExceed_mail'  ? 'selected'  : '')) ?>>Chilling Temperature Exceed</option>
             </select>
             </td>
                    <td class="gap-2 d-flex">
                    <input required type="text" name="emailTo[]" class="form-control " value="<?php echo (isset($emailId) ? $emailId : ''); ?>" placeholder="Enter mail" autocomplete="off" />
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                    <td><button type="button" class="btn btn-danger remove-row">-</button></td>
                </tr>
                 <?php } ?>
                <?php } ?>
               <?php      }  else {   ?>
             <tr>
                         <td>
                          <select class="form-select notificationMailoptions" name="mailType[]">
                         <option value="">Select option</option>
                         <option value="tempExceed_mail">Temperature Exceed </option>
                          <option value="foodTempExceed_mail">Food Temperature Exceed</option>
                         <option value="chillingTempExceed_mail">Chilling Temperature Exceed</option>
                           </select>
                           </td>
                    <td class="gap-2 d-flex">
                    <input type="text" name="emailTo[]" class="form-control" placeholder="Enter mail" autocomplete="off" required />
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                </tr>  
               
               <?php  } ?>
               
            </tbody>
        </table> 
          
        <small>Add the email and Cc emails in comma seprated value,  who will receive the notification mail for this system . </small> 
        </div>  
                  </div> 
                  <div class="col-xxl-3 col-md-6 mt-2">
                                     <input class="btn btn-success"  type="submit" value="Save"> 
                                        </div>
                        </form> 
                        
            <!-- Setting for notification that will run using cron job -->
            
             <form action="<?php echo base_url(); ?>Temp/configureAutomatedNotificationsubmit" method="post" class="form-horizontal mt-5">
                 
                 
                  <div class="row">       
                                   <div class="col-md-6 col-sm-12">
                  <label for="sort_order" class="form-label fw-semibold">Add Automated Notification Email</label>
                 
               <table class="table table-bordered mt-3" id="cronNotificationMailTable">
            <tbody>
                <?php   if(isset($cronMailConfigData) && !empty($cronMailConfigData)) {  ?>
                <?php foreach($cronMailConfigData as $cronemails) { ?>
                 <input type="hidden" name="cronMailNotificationConfigId[]" value="<?php echo $cronemails['id'] ?>">
                <?php $emailTo = unserialize($cronemails['data']);  ?>
                <?php foreach($emailTo as $emailId) { ?>
               <tr>
               <td>
             <select class="form-select notificationMailoptions" name="mailType[]">
             <option value="" >Select option</option>
             <option value="uncompleted_equipTempMail" <?php echo  ((isset($cronemails['configureFor']) && $cronemails['configureFor'] == 'uncompleted_equipTempMail'  ? 'selected'  : '')) ?>>Non-Completed Temps</option>
             </select>
             </td>
                    <td class="gap-2 d-flex">
                    <input required type="text" name="emailTo[]" class="form-control" value="<?php echo (isset($emailId) ? $emailId : ''); ?>" placeholder="Enter mail" autocomplete="off" />
                    </td>
                    <td><button class="btn btn-success add-cronRow " type="button">+</button></td>
                    <td><button type="button" class="btn btn-danger remove-row">-</button></td>
                </tr>
                 <?php } ?>
                <?php } ?>
               <?php      }  else {   ?>
             <tr>
                         <td>
                          <select class="form-select notificationMailoptions" name="mailType[]">
                         <option value="">Select option</option>
                        
                          <option value="uncompleted_equipTempMail">Non-Completed Temps </option>
                         
                           </select>
                           </td>
                    <td class="gap-2 d-flex">
                    <input type="text" name="emailTo[]" class="form-control" placeholder="Enter mail" autocomplete="off" required />
                    </td>
                    <td><button class="btn btn-success add-cronRow " type="button">+</button></td>
                </tr>  
               
               <?php  } ?>
               
            </tbody>
        </table> 
          
        <small>Add the email and Cc emails in comma seprated value,  who will receive the notification mail for this system . </small> 
        <br></br>
         <label for="sort_order" class="form-label">Add Notification Time</label><br></br>
                  <input required type="text" name="time_of_notification" class="form-control item  JUItimepicker w-50" value="<?php echo (isset($cronMailConfigData[0]['time_of_notification']) ? $cronMailConfigData[0]['time_of_notification'] : ''); ?>" placeholder="Enter time" autocomplete="off" />
                 </div>  
                  </div> 
                  <div class="col-xxl-3 col-md-6 mt-2">
                                     <input class="btn btn-success"  type="submit" value="Save"> 
                                        </div>
                        </form>
                        
        <!------------------------------------------------------- END ------------------------------------------------------------------------------->
                        
                        
                        <!-- FOOD TEMPERATE SETTINGS  -->
     <form action="<?php echo base_url(); ?>Temp/configureFoodTempsubmit" method="post" class="form-horizontal mt-5">
        <input type="hidden" name="foodTempConfigId" value="<?php echo (isset($foodTempConfigurationData[0]['id']) ? $foodTempConfigurationData[0]['id'] : '') ?>">  
        <?php 
        if(isset($foodTempConfigurationData[0]['data'])){
         $foodTemp = unserialize($foodTempConfigurationData[0]['data']);
          $maxFoodTemp =  $foodTemp['foodMaxTemp'];
          $minFoodTemp =  $foodTemp['foodMinTemp'];
          $showFoodTemp =  $foodTemp['showFoodTemp'];
        //   echo "<pre>"; print_r($foodTemp); exit;
        }else{
           $maxFoodTemp  =''; 
           $minFoodTemp  =''; 
           $showFoodTemp = '';
        }
        ?>
        <input type="hidden" name="configureFor" value="foodTemp">
        <div class="row">       
             <div class="col-md-6 col-sm-12">
                   <div class="form-check form-switch form-switch-lg" dir="ltr">
                    <input type="checkbox" class="form-check-input" id="showFoodTemp" <?php echo (isset($showFoodTemp) && $showFoodTemp == 1  ? 'checked' : '') ?> name="showFoodTemp">
                     <label class="form-check-label" for="showFoodTemp">Display Record Food Temperature on Dashboard</label>
                     </div>
                      </div>
            </div>
         <div class="row mt-3">       
            <div class="col-md-6 col-sm-12">
            <label for="sort_order" class="form-label fw-semibold">Add Food Temp</label>
               <table class="table table-bordered">
            <tbody>
                 <tr>
                 <td> <span>Hot Food Minimum Acceptable Temperature </span></td>
                   <td class="gap-2 d-flex">
                    <input type="text" name="foodMaxTemp" class="form-control" placeholder="Hot Food Max Temp" autocomplete="off" required  value="<?php echo $maxFoodTemp; ?>"/>
                </td>
                </tr>
                 <tr>
                 <td> <span>Cold Food Maximum Acceptable Temperature</span></td>
                   <td class="gap-2 d-flex">
                    <input type="text" name="foodMinTemp" class="form-control" placeholder=" Food Min Temp" autocomplete="off" required  value="<?php echo $minFoodTemp; ?>"/>
                </td>
                </tr>  
               
            </tbody>
        </table> 
       
                 </div>  
                  </div> 
         <div class="col-xxl-3 col-md-6 mt-2">
         <input class="btn btn-success"  type="submit" value="Save"> 
         </div>
         </form>    
         
         
         <!-- CHILLING TEMPERATE SETTINGS  -->
     <form action="<?php echo base_url(); ?>Temp/configureChillingTempsubmit" method="post" class="form-horizontal mt-5">
     <input type="hidden" name="chillingTempConfigId" value="<?php echo (isset($chillingTempConfigurationData[0]['id']) ? $chillingTempConfigurationData[0]['id'] : '') ?>">  
        <?php 
        if(isset($chillingTempConfigurationData[0]['data'])){
         $chillingTemp = unserialize($chillingTempConfigurationData[0]['data']);
          $tempAtFinishMin =  $chillingTemp['tempAtFinishMin'];
          $tempAfterTwoHrs =  $chillingTemp['tempAfterTwoHrs'];
          $tempAfterFourHrs =  $chillingTemp['tempAfterFourHrs'];
          $showChillingTemp =  $chillingTemp['showChillingTemp'];
        //   echo "<pre>"; print_r($foodTemp); exit;
        }else{
           $tempAtFinishMin  =''; 
           $tempAfterTwoHrs = '';
           $tempAfterFourHrs  =''; 
           $showChillingTemp='';
        }
        ?>
        <input type="hidden" name="configureFor" value="chillingTemp">
        <div class="row">       
             <div class="col-md-6 col-sm-12">
               <div class="form-check form-switch form-switch-lg" dir="ltr">
               <input type="checkbox" class="form-check-input" id="showChillingTemp" <?php echo (isset($showChillingTemp) && $showChillingTemp == 1  ? 'checked' : '') ?> name="showChillingTemp">
               <label class="form-check-label" for="showChillingTemp">Display Chilling  Process on Dashboard</label>
                </div>
             </div>
            </div>
         <div class="row mt-3">       
            <div class="col-md-6 col-sm-12">
            <label for="sort_order" class="form-label fw-semibold">Add Temp</label>
               <table class="table table-bordered">
            <tbody>
                 <tr>
                 <td> <span>Temperature at Finish Minimum </span></td>
                   <td class="gap-2 d-flex">
                    <input type="text" name="tempAtFinishMin" class="form-control" autocomplete="off"  value="<?php echo $tempAtFinishMin; ?>"/>
                </td>
                </tr>
                 <tr>
               <td> <span>Temperature after 2 hours Minimum </span></td>
                <td class="gap-2 d-flex">
               <input type="text" name="tempAfterTwoHrs" class="form-control" autocomplete="off"  value="<?php echo $tempAfterTwoHrs; ?>"/>
                </td>
                </tr> 
                
                <tr>
               <td> <span>Temperature after 4 hours Minimum </span></td>
                <td class="gap-2 d-flex">
               <input type="text" name="tempAfterFourHrs" class="form-control" autocomplete="off"  value="<?php echo $tempAfterFourHrs; ?>"/>
                </td>
                </tr>
            </tbody>
        </table> 
       
                 </div>  
                  </div> 
         <div class="col-xxl-3 col-md-6 mt-2">
         <input class="btn btn-success"  type="submit" value="Save"> 
         </div>
         </form>           
                       
       </div><!-- end card -->
                               
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                       </div>
                    <!-- container-fluid -->
                </div>
              
            </div>
            
            <script>
            
              $(document).ready(function () {
            // Add new row on plus button click
            $('form').on('click', '.add-row', function () {
             let newRow = '<tr>';
             newRow +='<td>';
             newRow +='<select class="form-select notificationMailoptions" name="mailType[]">';
             newRow +='<option value="" >Select option</option>';
             newRow +='<option value="tempExceed">Equipment Temp Exceed</option>';
             newRow +='<option value="foodTempExceed_mail">Food Temperature Exceed</option>';
             newRow +='<option value="chillingTempExceed_mail">Chilling Temperature Exceed</option>';
             newRow +='</select>';
             newRow +='</td>'; 
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter Email" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });

            // Remove row on minus button click
            $('form').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
            
            
            
            
            $('form').on('click', '.add-cronRow', function () {
             let newRow = '<tr>';
             newRow +='<td>';
             newRow +='<select class="form-select notificationMailoptions" name="mailType[]">';
             newRow +='<option value="" >Select option</option>';
             newRow +='<option value="uncompleted_equipTempMail">Non-Completed Temps</option>';
             newRow +='</select>';
             newRow +='</td>'; 
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter Email" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });
            
            
            // to ensure user cannot select same option again and again in next rows
    
    $('#notificationMailTable').on('change', '.notificationMailoptions', function () {
      var selectedOption = $(this).val();
      var allPreviousOptions = [];

      // Iterate over all previous rows
      $(this).parents('#notificationMailTable').find('tr').each(function () {
        let prevOption = $(this).find('.notificationMailoptions').val(); 
        allPreviousOptions.push(prevOption);
      });

       let count = allPreviousOptions.filter(item => item === selectedOption).length;
      
      if(count > 1) {
        alert('Option already selected in a previous row.');
        $(this).val('');
        return false;
      }
    });
    
    
      $('#cronNotificationMailTable').on('change', '.notificationMailoptions', function () {
      var selectedOption = $(this).val();
      var allPreviousOptions = [];

      // Iterate over all previous rows
      $(this).parents('#cronNotificationMailTable').find('tr').each(function () {
        let prevOption = $(this).find('.notificationMailoptions').val(); 
        allPreviousOptions.push(prevOption);
      });

      let count = allPreviousOptions.filter(item => item === selectedOption).length;
      
      if(count > 1) {
        alert('Option already selected in a previous row.');
        $(this).val('');
        return false;
      }
    });
           
        });
        
            </script>
          