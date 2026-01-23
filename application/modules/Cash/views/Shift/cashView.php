<?php $coin = unserialize($cashDepositList['startShiftCoins']);
  $notes = unserialize($cashDepositList['endShiftNotes']);
  $items_detail = unserialize($cashDepositList['items_detail']);
//   echo "<pre>"; print_r($cashDepositList); exit;
 
   if(is_array($coin) && is_array($notes)){
   $coins = array_merge($coin,$notes);   
  }else if(is_array($coin)){
      $coins = $coin;
  }else if(is_array($notes)){
      $coins = $notes;
  }
  ?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-body">
                               <form enctype='multipart/form-data' id="cashDepositForm" action="<?php echo base_url(); ?>Cash/cashD/update" method="post" class="form-horizontal" >   
                               <input type="hidden" name="cashDepositId" value="<?php echo $cashDepositList['id'];  ?>">
                               <input type="hidden" name="selectedTillID" value="<?php echo $cashDepositList['till_id']; ?>">
                    <div class="card-body">
                            <div>
                             <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Staff name </label>
                                                                <input type="text" <?php echo $disabled; ?> value="<?php echo $items_detail['staff_name'] ?>"  class="form-control" id="staff_name" name="staff_name"  placeholder="Staff name" required>
                                                            </div>
                                                           
                                                              
                                                                  <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label> Date & Time </label>
                                                                <input value="<?php echo (isset($items_detail['start_time']) ? $items_detail['start_time'] : date('d-m-Y h:i')) ?>" type="text" <?php echo $disabled; ?> class="form-control" readonly id="datetime" name="start_time"  placeholder="Date" required>
                                                            </div>
                                                            
             
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <?php if(!$disabled) {  ?>
                                        
                                             <input class="btn btn-primary"  type="button" onclick="submitcashDepositForm()" value="Update">
                                                            <?php }  ?>
                             
                             <a class="btn btn-danger" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                           
                                                          
                                                           
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-12">
                                                        <div class="">
                                                             <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                               
                                                                <thead class="bg-primary text-white">
                                                                    <tr class="menurow tableHeader">
                                                                           
                                                                            <td class="menuinput-width">
                                                                                <label>Type </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Count</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Total </label>
                                                                            </td>
                                                                            
                                                                            
                                                                            <td class="menuinput-width">
                                                                            </td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                   
                                                                    
                                                                    <?php if(!empty(COINS)){
                                                                        $i=1;
                                                                    foreach(COINS as $row ){ ?>
                                                                    
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo $disabled;   ?> class="form-control"  value="<?php echo (isset($coins[$row['inputName']]) ? $coins[$row['inputName']] : '') ?>" id="<?php echo (isset($row['inputId1']) ? $row['inputId1'] : '') ?>" name="<?php echo (isset($row['inputName']) ? $row['inputName'] : '') ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo (isset($row['inputId2']) ? $row['inputId2'] : '') ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    <?php $i++; } } ?>
                                                                   
                                                                </tbody>
                                                                <tbody>
                                                                   
                                                                    <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Cash Counted </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="entrytotal" name="entrytotal" value="<?php echo (isset($cashDepositList['entrytotal']) ? $cashDepositList['entrytotal'] : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                           <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Float </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number"  class="form-control form-control-icon" id="stdcashfloat" <?php echo $disabled;   ?> name="stdcashfloat" value="<?php echo (isset($cashDepositList['stdcashfloat']) && $cashDepositList['stdcashfloat'] != '' ? number_format($cashDepositList['stdcashfloat'],2) : '600.00'); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                           <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="varience" name="varience" value="<?php echo (isset($cashDepositList['varience']) ? $cashDepositList['varience'] :''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                </div>
                                                   
                                            </div>
                                   
                                    </div>
                                </div>
                                <!--form end-->
                               
                            </div>
                        </div>
                    </form>         
                    
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
                <!-- End Page-content -->

                
            </div>
            <!-- end main content-->

        

           <!--<div id="flipConfirmModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">-->
           <!--                                        <div class="modal-dialog modal-dialog-centered">-->
           <!--                                 <div class="modal-content border-0">-->
                                               
           <!--                                     <form class="tablelist-form" autocomplete="off">-->
           <!--                                         <div class="modal-body">-->
                                                        
           <!--                                             <div class="row g-3">-->
           <!--                                                 <div class="col-lg-12">-->
           <!--                                                     <div class="text-center">-->
           <!--                                                         <div class="position-relative d-inline-block">-->
           <!--                                                             <div class="position-absolute  bottom-0 end-0">-->
           <!--                                                                 <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">-->
           <!--                                                             </div>-->
           <!--                                                             <div class="avatar-lg p-1">-->
           <!--                                                                 <div class="avatar-title bg-light rounded-circle">-->
           <!--                                                                     <img src="<?php echo base_url() ?>/assets/images/users/user-dummy-img.jpg" id="customer-img" class="avatar-md rounded-circle object-cover">-->
           <!--                                                                 </div>-->
           <!--                                                             </div>-->
           <!--                                                         </div>-->
           <!--                                                     </div>-->
           <!--                                                     <div>-->
           <!--                                                        <h3 class="text-black">-->
           <!--                                                            Please count again and if there is still a variance then contact the manager.-->
           <!--                                                       </h3>-->
           <!--                                                     </div>-->
           <!--                                                 </div>-->
                                                            
                                                           
                                                          
           <!--                                             </div>-->
           <!--                                         </div>-->
           <!--                                         <div class="modal-footer" style="display: block;">-->
           <!--                                             <div class="hstack gap-2 justify-content-end">-->
           <!--                                                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>-->
           <!--                                             </div>-->
           <!--                                         </div>-->
           <!--                                     </form>-->
           <!--                                 </div>-->
           <!--                             </div>-->
           <!--                                     </div>-->
           <!-- <div id="flipConfirmFinalModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">-->
           <!--                                        <div class="modal-dialog modal-dialog-centered">-->
           <!--                                 <div class="modal-content border-0">-->
                                               
           <!--                                     <form class="tablelist-form" autocomplete="off">-->
           <!--                                         <div class="modal-body">-->
                                                        
           <!--                                             <div class="row g-3">-->
           <!--                                                 <div class="col-lg-12">-->
           <!--                                                     <div class="text-center">-->
           <!--                                                         <div class="position-relative d-inline-block">-->
           <!--                                                             <div class="position-absolute  bottom-0 end-0">-->
           <!--                                                                 <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">-->
           <!--                                                             </div>-->
           <!--                                                             <div class="avatar-lg p-1">-->
           <!--                                                                 <div class="avatar-title bg-light rounded-circle">-->
           <!--                                                                     <img src="<?php echo base_url() ?>/assets/images/users/user-dummy-img.jpg" id="customer-img" class="avatar-md rounded-circle object-cover">-->
           <!--                                                                 </div>-->
           <!--                                                             </div>-->
           <!--                                                         </div>-->
           <!--                                                     </div>-->
           <!--                                                     <div>-->
           <!--                                                        <h3>-->
           <!--                                                        <?php echo (isset($items_detail['staff_name']) ? $items_detail['staff_name']: ''); ?> verifies register is $600.-->
           <!--                                                       </h3>-->
           <!--                                                     </div>-->
           <!--                                                 </div>-->
                                                            
                                                           
                                                          
           <!--                                             </div>-->
           <!--                                         </div>-->
           <!--                                         <div class="modal-footer" style="display: block;">-->
           <!--                                             <div class="hstack gap-2 justify-content-end">-->
           <!--                                                 <button type="button" class="btn btn-success" onclick="submitFormAfterConfirmation()" data-bs-dismiss="modal">Yes</button>-->
           <!--                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>-->
           <!--                                             </div>-->
           <!--                                         </div>-->
           <!--                                     </form>-->
           <!--                                 </div>-->
           <!--                             </div>-->
           <!--                                     </div>-->


  
          <script src="<?php echo base_url('application/modules/Cash/assets/js/app.js') ?>"></script>
          <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
    </body>
    
 
</html>