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
        <!--       <form action="<?php echo base_url(); ?>Clean/configuresubmit" method="post" class="form-horizontal mt-5">-->
                 
        <!--          <input type="hidden" name="configureFor" value="mail">-->
        <!--          <div class="row">       -->
        <!--                           <div class="col-md-6 col-sm-12">-->
        <!--          <label for="sort_order" class="form-label fw-semibold">Add Notification Email</label>-->
                 
        <!--       <table class="table table-bordered mt-3" id="notificationMailTable">-->
        <!--    <tbody>-->
        <!--        <?php   if(isset($mailConfigData) && !empty($mailConfigData)) {  ?>-->
        <!--        <?php foreach($mailConfigData as $emails) { ?>-->
        <!--         <input type="hidden" name="configId[]" value="<?php echo $emails['id'] ?>">-->
        <!--        <?php $emailTo = unserialize($emails['data']);  ?>-->
        <!--        <?php foreach($emailTo as $emailId) { ?>-->
        <!--       <tr>-->
        <!--       <td>-->
        <!--     <select class="form-select notificationMailoptions" name="mailType[]">-->
        <!--     <option value="--" >Select option</option>-->
          
        <!--     </select>-->
        <!--     </td>-->
        <!--            <td class="gap-2 d-flex">-->
        <!--            <input required type="text" name="emailTo[]" class="form-control " value="<?php echo (isset($emailId) ? $emailId : ''); ?>" placeholder="Enter mail" autocomplete="off" />-->
        <!--            </td>-->
        <!--            <td><button class="btn btn-success add-row " type="button">+</button></td>-->
        <!--            <td><button type="button" class="btn btn-danger remove-row">-</button></td>-->
        <!--        </tr>-->
        <!--         <?php } ?>-->
        <!--        <?php } ?>-->
        <!--       <?php      }  else {   ?>-->
        <!--     <tr>-->
        <!--                 <td>-->
        <!--                  <select class="form-select notificationMailoptions" name="mailType[]">-->
        <!--                 <option value="--">Select option</option>-->
                        
        <!--                   </select>-->
        <!--                   </td>-->
        <!--            <td class="gap-2 d-flex">-->
        <!--            <input type="text" name="emailTo[]" class="form-control" placeholder="Enter mail" autocomplete="off" required />-->
        <!--            </td>-->
        <!--            <td><button class="btn btn-success add-row " type="button">+</button></td>-->
        <!--        </tr>  -->
               
        <!--       <?php  } ?>-->
               
        <!--    </tbody>-->
        <!--</table> -->
          
        <!--<small>Add the email and Cc emails in comma seprated value,  who will receive the notification mail for this system . </small> -->
        <!--</div>  -->
        <!--          </div> -->
        <!--          <div class="col-xxl-3 col-md-6 mt-2">-->
        <!--                             <input class="btn btn-success"  type="submit" value="Save"> -->
        <!--                                </div>-->
        <!--                </form> -->
                        
            <!-- Setting for notification that will run using cron job -->
            
             <form action="<?php echo base_url(); ?>Clean/configureAutomatedNotificationsubmit" method="post" class="form-horizontal mt-5">
                 
                 
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
             <option value="uncompleted_cleanTaskMail" <?php echo  ((isset($cronemails['configureFor']) && $cronemails['configureFor'] == 'uncompleted_cleanTaskMail'  ? 'selected'  : '')) ?>>Non-Completed Tasks</option>
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
                        
                          <option value="uncompleted_cleanTaskMail">Non-Completed Tasks </option>
                         
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
             newRow +='<select class="form-select notificationMailoptions" name="mailType[]">';
             newRow +='<option value="--" >Select option</option>';
            
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
             newRow +='<option value="--" >Select option</option>';
             newRow +='<option value="uncompleted_cleanTaskMail">Non-Completed Tasks </option>';
             newRow +='</select>';
             newRow +='</td>'; 
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter Email" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });
            
            
            // to ensure user cannot select same option again and again in next rows
    
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
          