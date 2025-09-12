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
                                  <?php
                                  $arrayOfFloatType = array('daily','weekly','monthly');
                                  
                                  ?>

                                    <div class="card-body">
              
              
            <form action="<?php echo base_url(); ?>Cash/floatConfiguresubmit" method="post" class="form-horizontal mt-5">
                  <input type="hidden" name="configId" value="<?php echo $floatsConfigId ?>">
                  <input type="hidden" name="configureFor" value="floats">
                  <div class="row">
            
                  <table class="table table-bordered">
            <tbody>
                <?php $count = 0; foreach($arrayOfFloatType as $floatType) {   ?>
                <?php $dataFloat =  (isset($configData[$count]['data']) ? unserialize($configData[$count]['data']) : array()); ; ?>
              
                <input type="hidden" name="configId[]" value="<?php echo (isset($configData[$count]['id']) ? $configData[$count]['id'] : ''); ?>">
                 <tr>
               <td>
                    <select class="form-select" name="floatType[]">
                    <option value="<?php echo $floatType; ?>" selected><?php echo strtoupper($floatType); ?></option>
                    
                     </select>    
                   </td>
                   <td>
                    <div class="form-check form-switch form-switch-lg mx-4" dir="ltr">
                    <input type="checkbox" class="form-check-input" id="hideSecondSection" <?php echo (isset($dataFloat['hideSecondSection']) && $dataFloat['hideSecondSection'] == 1  ? 'checked' : '') ?> name="hideSecondSection_<?php echo $floatType; ?>">
                     <label class="form-check-label" for="hideSecondSection">Show Second Section</label>
                     </div>
                      
                       </td>
                       <td>
                     
                          <label for="basiInput" class="form-label">Office Float</label>
                         <input type="text" class="form-control" id="floatM1" name="floatTotal[]" value="<?php echo (isset($dataFloat['floatTotal'])  ? $dataFloat['floatTotal'] : '') ?>">
                       
                       </td>
                       <td>
               
                   <label for="placeholderInput" class="form-label">Front Office Float </label>
                    <input type="text" class="form-control" id="placeholderInput" placeholder="Front Counter Float" name="m1_floatTotal[]"  value="<?php echo (isset($dataFloat['m1_floatTotal'])  ? $dataFloat['m1_floatTotal'] : '') ?>">
                         
                       </td>
                       </tr>
                       
                <?php $count++; }  ?>       
                
                </tbody>
                </table>
                                         
                <div class="col-xxl-3 col-md-6 mt-2">
                                     <input class="btn btn-success"  type="submit" value="Save"> 
                                        </div>
                                        </div>
                                 </form>
                                 
                                 
             <form action="<?php echo base_url(); ?>Cash/configuresubmit" method="post" class="form-horizontal mt-5">
                 
                  <input type="hidden" name="configureFor" value="mail">
                  <div class="row">       
                                   <div class="col-md-6 col-sm-12">
                  <label for="sort_order" class="form-label fw-semibold">Add Notification Email</label>
               <table class="table table-bordered" id="notificationMailTable">
            <tbody>
                <?php   if(isset($mailConfigData) && !empty($mailConfigData)) {  ?>
                <?php foreach($mailConfigData as $emails) { ?>
                 <input type="hidden" name="configId[]" value="<?php echo $emails['id'] ?>">
                <?php $emailTo = unserialize($emails['data']);  ?>
                <?php foreach($emailTo as $emailId) { ?>
               <tr>
               <td>
             <select class="form-select" name="mailType[]">
             <option value="" >Select option</option>
             <option value="startShift_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'startShift_mail'  ? 'selected'  : '')) ?>>Start Shift Variance</option>
             <option value="endShift_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'endShift_mail'  ? 'selected'  : '')) ?>>End Shift Variance</option>
              <option value="dailyFloat_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'dailyFloat_mail'  ? 'selected'  : '')) ?>>Daily Float Variance</option>
             <option value="weeklyFloat_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'weeklyFloat_mail'  ? 'selected'  : '')) ?>>Weekly Float Variance</option>
             <option value="monthlyFloat_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'monthlyFloat_mail'  ? 'selected'  : '')) ?>>Monthly Float Variance</option>
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
                          <select class="form-select ssss" name="mailType[]">
                         <option value="">Select option</option>
                         <option value="startShift_mail">Start Shift Variance</option>
                          <option value="endShift_mail">End Shift Variance</option>
                          <option value="dailyFloat_mail">Daily Float Variance</option>
                           <option value="weeklyFloat_mail">Weekly Float Variance</option>
                           <option value="monthlyFloat_mail">Monthly Float Variance</option>
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
                        
             <form action="<?php echo base_url(); ?>Cash/configureAutomatedNotificationsubmit" method="post" class="form-horizontal mt-5">
                 
                 
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
             <option value="--" >Select option</option>
             <option value="shiftNotStartedMail" <?php echo  ((isset($cronemails['configureFor']) && $cronemails['configureFor'] == 'shiftNotStartedMail'  ? 'selected'  : '')) ?>>Shift not started mail</option>
             <option value="shiftNotEndedMail" <?php echo  ((isset($cronemails['configureFor']) && $cronemails['configureFor'] == 'shiftNotEndedMail'  ? 'selected'  : '')) ?>>Shift not ended mail</option>
             </select>
             </td>
                    <td class="gap-2 d-flex">
                    <input required type="text" name="emailTo[]" class="form-control " value="<?php echo (isset($emailId) ? $emailId : ''); ?>" placeholder="Enter mail" autocomplete="off" />
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
                         <option value="--">Select option</option>
                        
                          <option value="shiftNotStartedMail">Shift not started mail </option>
                          <option value="shiftNotEndedMail">Shift not ended mail </option>
                         
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
                         newRow +='<select class="form-select" name="mailType[]">';
                          newRow +='<option value="">Select option</option>';
                         newRow +='<option value="startShift_mail">Start Shift Variance</option>'; 
                         newRow +='<option value="endShift_mail">End Shift Variance</option>';
                         newRow +=  '<option value="dailyFloat_mail">Daily Float Variance</option>';
                         newRow +=  '<option value="weeklyFloat_mail">Weekly Float Variance</option>';
                         newRow +=  '<option value="monthlyFloat_mail">Monthly Float Variance</option>';
                         newRow +=  '</select>';
                         newRow +=  '</td>';
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter  email" autocomplete="off"  />';
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
             newRow +='<option value="--" >Select option</option>';
             newRow +='<option value="shiftNotStartedMail">Shift not started mail </option>';
             newRow +='<option value="shiftNotEndedMail">Shift not ended mail </option>';
             newRow +='</select>';
             newRow +='</td>'; 
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter Email" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });
            
            
            
            $('#notificationMailTable').on('change', '.notificationMailoptions', function () {
      var selectedOption = $(this).val();
      let allPreviousOptions = [];

      // Iterate over all previous rows
      $(this).parents('#notificationMailTable').find('tr').each(function () {
        let prevOption = $(this).find('.notificationMailoptions').val(); 
        allPreviousOptions.push(prevOption);
      });

      if ($.inArray(selectedOption, allPreviousOptions) !== -1) {
        alert('Option already selected in a previous row.');
        $(this).val('');
        return false;
      }
    });
    
    
      $('#cronNotificationMailTable').on('change', '.notificationMailoptions', function () {
      let selectedOption = $(this).val();
      let allPreviousOptions = [];

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
          