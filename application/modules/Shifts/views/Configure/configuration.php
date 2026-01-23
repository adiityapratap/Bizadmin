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
               <table class="table table-bordered">
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
             <option value="tempExceed_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'tempExceed_mail'  ? 'selected'  : '')) ?>>Temperature Exceed</option>
             <option value="nonCompleted_mail" <?php echo  ((isset($emails['configureFor']) && $emails['configureFor'] == 'nonCompleted_mail'  ? 'selected'  : '')) ?>>Non-Completed Temps</option>
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
                         <option value="tempExceed_mail">Temperature Exceed </option>
                          <option value="nonCompleted_mail">Non-Completed Temps </option>
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
                        <!-- FOOD TEMPERATE SETTINGS  -->
               <form action="<?php echo base_url(); ?>Temp/configureFoodTempsubmit" method="post" class="form-horizontal mt-5">
        <input type="hidden" name="foodTempConfigId" value="<?php echo (isset($foodTempConfigurationData[0]['id']) ? $foodTempConfigurationData[0]['id'] : '') ?>">  
        
        <?php 
       
        if(isset($foodTempConfigurationData[0]['data'])){
            $foodTemp = unserialize($foodTempConfigurationData[0]['data']);
          $maxFoodTemp =  $foodTemp['foodMaxTemp'];
          $minFoodTemp =  $foodTemp['foodMinTemp'];
        }else{
           $maxFoodTemp  =''; 
           $minFoodTemp  =''; 
        }
        ?>
        <input type="hidden" name="configureFor" value="foodTemp">
                  <div class="row">       
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
             newRow +='<option value="" >Select option</option>';
             newRow +='<option value="tempExceed">Temperature Exceed</option>';
             newRow +='<option value="nonCompletedTemp">Non-Completed Temps</option>';
             newRow +='</select>';
             newRow +='</td>'; 
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter Cc email" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });

            // Remove row on minus button click
            $('form').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
            
           
        });
        
            </script>
          