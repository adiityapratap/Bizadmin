<?php 
if(isset($cashDepositList) && !empty($cashDepositList)){
  $coin = unserialize($cashDepositList['coins']);
  $notes = unserialize($cashDepositList['notes']);
  
  $coin1 = unserialize($cashDepositList['coins1']);
  $notes1 = unserialize($cashDepositList['notes1']);
  
  $items_detail = unserialize($cashDepositList['items_detail']);
  if(is_array($coin) && is_array($notes)){
   $coins = array_merge($coin,$notes);   
  }else{
      $coins = array();
  }
  
  if(is_array($coin1) && is_array($notes1)){
   $coins1 = array_merge($coin1,$notes1);  
  }else{
    $coins1 = array();  
  }
}else{
   $coins = array();
   $items_detail = array();
   $notes = array();
   $coin = array();
   
 }
 
 
 
   ?>
    <?php
         $disableAdminEdit = ''; 
       if($this->ion_auth->get_users_groups()->row()->name == 'Manager'){ 
       $staffdisabled = 'disabled'; $disableAdminEdit = 'disabled'; } 
        if($this->ion_auth->get_users_groups()->row()->name == 'Admin'){ 
      $disableAdminEdit = 'disabled'; 
      } ?>

   
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                       <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">End of Shift</h4>
                                        </div>
                                    </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  

                                    <div class="card-body">
                            
                             <form enctype='multipart/form-data' id="updateDepositForm" action="<?php echo base_url(); ?>Cash/endshift/1" method="post" class="form-horizontal" novalidate>  
                               <input type="hidden" name="cashDepositId" value="<?php echo $cashDepositList['id'];  ?>">
                    <div class="card-body">
                            <div>
                             
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <!--<div class="col-12 col-lg-3 col-md-3 mb-3">-->
                                                            <!--    <label>Start Shift Staff name </label>-->
                                                            <!--    <input readonly type="text" <?php // echo $disabled; ?> value="<?php // echo (isset($items_detail['staff_name']) ? $items_detail['staff_name'] : '') ?>"  class="form-control" id="staff_name" name="staff_name"  placeholder="Start Shift Staff name" required>-->
                                                            <!--</div>-->
                                                           
                                                            <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>End Shift Staff name </label>
                                                                <input type="text" <?php echo $disabled; ?> value="<?php echo (isset($items_detail['end_staff_name']) ? $items_detail['end_staff_name'] : '') ?>"  class="form-control" id="end_staff_name" name="end_staff_name"  placeholder="End Shift Staff name" required>
                                                            </div>
                                                            
                                                           
                                                            <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Manager name </label>
                                                                <input type="text" <?php echo $disabled; ?> value="<?php echo (isset($items_detail['manager_name']) ? $items_detail['manager_name'] : '') ?>"  class="form-control" id="manager_name" name="manager_name"  placeholder="Staff name" required>
                                                            </div>
                                                        
                                                             
                                                           
                                                            
                                                             
                                                                
                                                           
                                                            
                                                             <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <input type="hidden" name="start_time" value="<?php echo (isset($items_detail['start_time']) ? $items_detail['start_time'] : '') ?>">
                                                                <label> End Date & Time </label>
                                                                <input readonly value="<?php echo (isset($items_detail['end_time']) ? $items_detail['end_time'] : date('d-m-Y h:i')) ?>" type="text" <?php echo $disabled; ?> class="form-control" id="datetime" name="end_time"  placeholder="Date" required>
                                                            </div>
                                                          <!--<div class="col-12 col-lg-2 col-md-3 mb-3">-->
                                                          <!--        <label>  </label>-->
                                                          <!--      <a id="dateselect" class="btn btn-success text-light mt-20">Date & Time </a>-->
                                                          <!--  </div>-->
                                                            
             
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <?php if(!$disabled) {  ?>
                                        
                                             <input class="btn btn-primary"  type="button" onclick="finalSubmitEndShift()" value="Update">
                                                            <?php }  ?>
                             
                             <a class="btn btn-danger" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                           
                                                          
                                                           
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-6 col-md-6">
                                                        <span class="innderTbheader"> Staff</span>
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
                                                                                    <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo (isset($row['coinNameLabel']) ? $row['coinNameLabel']: '') ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo $disabled;   ?> class="form-control"  readonly value="<?php echo (isset($coins[$row['inputName']]) ? $coins[$row['inputName']] :'') ?>" id="<?php echo $row['inputId1'] ?>" name="<?php echo $row['inputName'] ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo $row['inputId2'] ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    <?php $i++; } } ?>
                                                                   
                                                                </tbody>
                                                                <tbody>
                                                                    <tr class="menurow footer-labels">
                                                                       <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                          <small class="text-white"> Remove all money from the register</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Cash Counted</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="entrytotal" name="entrytotal" value="<?php echo (isset($cashDepositList['entrytotal']) ? sprintf("%.2f", $cashDepositList['entrytotal']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                          
                                                                          
                                                                     <tr class="menurow footer-labels">
                                                                         <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                             <small class="text-white">Count float of $600, record amounts above and place into register. Put leftover money to the side. </small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Float</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  <?php echo ((isset($staffdisabled) && $staffdisabled !='') || $disableAdminEdit !=''  ? 'disabled' : '');   ?> class="form-control form-control-icon" <?php echo ($this->ion_auth->is_admin() ? '' : 'disabled')  ?> id="registerFloat" name="registerFloat" value="<?php echo (isset($cashDepositList['registerFloat']) && $cashDepositList['registerFloat'] !=0 ? sprintf("%.2f", $cashDepositList['registerFloat']) : '600.00'); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                         
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                               <small class="text-white">Amount on register printout called - "Total Cash Sale"</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Required Register Amount *</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input <?php echo ((isset($staffdisabled) && $staffdisabled !='') || $disableAdminEdit !=''  ? 'disabled' : '');   ?> required class="form-control form-control-icon required" id="requiredRegisterAmount" name="requiredRegisterAmount" value="<?php echo (isset($cashDepositList['requiredRegisterAmount']) ? sprintf("%.2f", $cashDepositList['requiredRegisterAmount']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                          <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                              <small class="text-white">Count remaining money from the side and add petty cash receipt to total deposit</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Deposit *</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  <?php echo ((isset($staffdisabled) && $staffdisabled !='') || $disableAdminEdit !=''  ? 'disabled' : '');   ?> class="form-control form-control-icon required" id="depositM1" name="depositM1" value="<?php echo (isset($cashDepositList['depositM1']) ? sprintf("%.2f", $cashDepositList['depositM1']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                            <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                               <small class="text-white">Variance is money missing or gained - if gained this is still included in deposit </small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Variance</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly class="form-control form-control-icon" id="staffVariance" name="staffVariance" value="<?php echo (isset($cashDepositList['staffVariance']) ?  sprintf("%.2f", $cashDepositList['staffVariance']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                        <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                            <small class="text-white">What actions were taken regarding variance eg: counted twice, another staff checked it etc.</small>                           
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Comments</small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                      <input <?php echo ((isset($staffdisabled) && $staffdisabled !='') || $disableAdminEdit !=''  ? 'readonly' : '');   ?> type="text" class="form-control form-control-icon" id="staffComments" name="staffComments" value="<?php echo (isset($cashDepositList['staffComments']) ? $cashDepositList['staffComments'] : ''); ?>">
                                                                         </td>
                                                                          </tr>   
                                                                          
                                                                  
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                    </div>
                                                <!-- Manager part data --> 
                                                 <div class="col-lg-6 col-md-6">
                                                     <span class="innderTbheader"> Manager</span>
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
                                                                                    <input type="number" <?php echo $disabled;   ?> class="form-control"  value="<?php echo (isset($coins1[$row['managerInputName']]) ? $coins1[$row['managerInputName']] : '') ?>" id="<?php echo $row['managerInputName'] ?>" name="<?php echo $row['managerInputName'] ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo $row['managerinputId2'] ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    <?php $i++; } } ?>
                                                                   
                                                                </tbody>
                                                                <tbody>
                                                                    <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                             
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Cash Counted </small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="entrytotal1" name="entrytotal1" value="<?php echo (isset($cashDepositList['entrytotal1']) ? sprintf("%.2f", $cashDepositList['entrytotal1']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                          
                                                                          
                                                                     <tr class="menurow footer-labels">
                                                                       <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                          
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Float </small></label><br></br>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input <?php echo (isset($managerdisabled) ? $managerdisabled : '');   ?> class="form-control form-control-icon" <?php echo ($this->ion_auth->is_admin() ? '' : 'disabled')  ?> id="registerFloat1" name="registerFloat1" value="<?php echo (isset($cashDepositList['registerFloat1']) && $cashDepositList['registerFloat1'] !=0 ? sprintf("%.2f", $cashDepositList['registerFloat1']) : '600.00'); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          <!-- <tr class="menurow footer-labels">-->
                                                                          <!-- <td class="menuinput-width antiquewhite">-->
                                                                          <!--  </td>-->
                                                                          <!--  <td class="menuinput-width tableFooterTotals antiquewhite">-->
                                                                          <!--      <label>Petty Cash</label>-->
                                                                          <!--  </td>-->
                                                                          <!--  <td class="menuinput-width">-->
                                                                          <!--      <div class="form-icon">-->
                                                                          <!--      <input  class="form-control form-control-icon" id="pettyCash1" name="pettyCash1" value="<?php echo (isset($cashDepositList['pettyCash1']) ? $cashDepositList['pettyCash1'] : ''); ?>">-->
                                                                          <!--      <i class="bx bx-dollar"></i>-->
                                                                          <!--      </div>-->
                                                                          <!--  </td>-->
                                                                          <!--</tr>-->
                                                                          
                                                                          <!--  <tr class="menurow footer-labels">-->
                                                                          <!--<td class="menuinput-width antiquewhite">-->
                                                                          <!--  </td>-->
                                                                          <!--  <td class="menuinput-width tableFooterTotals antiquewhite">-->
                                                                          <!--      <label>Coins Bag Cash </label>-->
                                                                          <!--  </td>-->
                                                                          <!--  <td class="menuinput-width">-->
                                                                          <!--      <div class="form-icon">-->
                                                                          <!--      <input readonly type="number"  class="form-control form-control-icon" id="regtotal1" <?php echo (isset($disabled) ? $disabled : '');   ?> name="coinBagCash1" value="<?php echo (isset($cashDepositList['regtotal1']) && $cashDepositList['regtotal1'] != '' ? number_format($cashDepositList['regtotal1'],2) : '-600.00'); ?>">-->
                                                                          <!--      <i class="bx bx-dollar"></i>-->
                                                                          <!--      </div>-->
                                                                          <!--  </td>-->
                                                                          <!--</tr>-->
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                          <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                            
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                               <label><small class="text-white"> Required Register Amount *</small></label><br></br>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  <?php echo (isset($managerdisabled) ? $managerdisabled : '');   ?> class="form-control form-control-icon required" id="requiredRegisterAmount1" name="requiredRegisterAmount1" value="<?php echo (isset($cashDepositList['requiredRegisterAmount1']) ? sprintf("%.2f", $cashDepositList['requiredRegisterAmount1']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                          <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                           
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Deposit *</small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  <?php echo (isset($managerdisabled) ? $managerdisabled : '');   ?> class="form-control form-control-icon required" id="depositM2" name="depositM2" value="<?php echo (isset($cashDepositList['depositM2']) ? sprintf("%.2f", $cashDepositList['depositM2']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                             
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Variance</small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly class="form-control form-control-icon" id="managerVariance" name="managerVariance" value="<?php echo (isset($cashDepositList['managerVariance']) ? sprintf("%.2f", $cashDepositList['managerVariance']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                           <tr class="menurow footer-labels">
                                                                         <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                          
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small class="text-white">Comments</small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                               <input type="text" <?php echo (isset($managerdisabled) ? $managerdisabled : '');   ?> class="form-control form-control-icon" id="managerComments" name="managerComments" value="<?php echo (isset($cashDepositList['managerComments']) ? $cashDepositList['managerComments'] : ''); ?>">
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

     
        <!-- END layout-wrapper -->
<?php $this->load->view('commonModal') ?>   
    
 <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
    