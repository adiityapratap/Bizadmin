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
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black" style="z-index:9999">End of Shift </h4>
                                      </div>
                                   </div>  

                                    <div class="card-body">
                               <form enctype='multipart/form-data' id="updateDepositForm" action="<?php echo base_url(); ?>Cash/endshift/1" method="post" class="form-horizontal" novalidate>   
                               <input type="hidden" name="cashDepositId" value="<?php echo (isset($cashDepositList['id']) ? $cashDepositList['id'] : '');  ?>">
                               <input type="hidden" name="IsfinalSubmissionDone" class="IsfinalSubmissionDone">
                    <div class="card-body">
                            <div>
                             
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                           
                                                           
                                                            <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label>End Shift Staff name </label>
                                                                <input type="text" <?php echo (isset($disabled) ? $disabled : ''); ?> value="<?php echo (isset($items_detail['end_staff_name']) ? $items_detail['end_staff_name'] : '') ?>"  class="form-control" id="end_staff_name" name="end_staff_name"  placeholder="End Shift Staff name" required>
                                                            <div class="invalid-feedback end_staff_name">Please enter staff name.</div>
                                                            </div>
                                                            
                                                           
                                                            <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label>Manager name </label>
                                                                <input type="text" <?php echo (isset($disabled) ? $disabled : ''); ?> value="<?php echo (isset($items_detail['manager_name']) ? $items_detail['manager_name'] : '') ?>"  class="form-control" id="manager_name" name="manager_name"  placeholder="Manager name" required>
                                                            </div>
                                                        
                                                             <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <input type="hidden" name="start_time" value="<?php echo (isset($items_detail['start_time']) ? $items_detail['start_time'] : '')  ?>">
                                                                <input type="hidden" name="staff_name" value="<?php echo (isset($items_detail['staff_name']) ? $items_detail['staff_name'] : '') ?>">
                                                                <label> Date & Time </label>
                                                                <input value="<?php echo (isset($items_detail['end_time']) ? date('d-m-Y h:i A',strtotime($items_detail['end_time'])) : date('d-m-Y h:i A')) ?>" type="text" <?php echo (isset($disabled) ? $disabled : ''); ?> class="form-control" id="datetime" name="end_time"  placeholder="Date" required>
                                                            </div>
                                                          <!--<div class="col-12 col-lg-3 col-md-3 mb-3">-->
                                                          <!--        <label>  </label>-->
                                                          <!--      <a id="dateselect" class="btn btn-success text-light mt-20">Date and Time </a>-->
                                                          <!--  </div>-->
                                                            
             
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                      <?php  //echo $role_id; exit; ?>
                                                            <?php if(($role_id ==4 && !$staffdisabled) || ($role_id ==2 && !$managerdisabled)) {  ?>
                             <button class="btn btn-success"  type="button" onclick="finalSubmitEndShift()">
                         <i class="ri-send-plane-line label-icon align-middle fs-12 me-2"></i>Submit</button>   
                                                            <?php }  ?>
                             <a class="btn bg-orange" href="#" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                           
                                                      
                                                    </div>
                                                </div>    
                                                <div class="row"> 
                                                <?php if($this->ion_auth->get_users_groups()->row()->name == 'Manager'){ ?>
                                                  <?php $staffdisabled = 'disabled'; } ?>
                                                    <div class="col-lg-6 col-md-6">
                                                        <span class="innderTbheader"> Staff</span>
                                                        <div class="">
                                                             <table class="row-border table-condensed endShiftTable" cellspacing="0" width="100%">
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
                                                                                    <input type="number" <?php echo (isset($staffdisabled) ? $staffdisabled : '');   ?> class="form-control"  value="<?php echo (isset($coins[$row['inputName']]) ? $coins[$row['inputName']] : '') ?>"  id="<?php echo $row['inputId1'] ?>" name="<?php echo $row['inputName'] ?>">
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
                                                                          <small> Remove all money from the register</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Cash Counted</small> </label>
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
                                                                             <small>Count float of $600 and record amounts above, place the $600 float into the register</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Float</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly class="form-control form-control-icon" id="registerFloat" name="registerFloat" value="<?php echo (isset($cashDepositList['registerFloat']) && $cashDepositList['registerFloat'] !=0 ? sprintf("%.2f", $cashDepositList['registerFloat']) : '600.00'); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                         
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                               <small>Amount on register printout called - "Total Cash Sale"</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Required Register Amount</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly class="form-control form-control-icon" id="requiredRegisterAmount" name="requiredRegisterAmount" value="<?php echo (isset($cashDepositList['requiredRegisterAmount']) ? sprintf("%.2f", $cashDepositList['requiredRegisterAmount']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                          <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                              <small>Count Remaining money and add petty cash receipt to total deposit</small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Deposit</small> </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="depositM1" name="depositM1" value="<?php echo (isset($cashDepositList['depositM1']) ? sprintf("%.2f", $cashDepositList['depositM1']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                            <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                               <small>Variance is money missing or gained - if gained this is still included in deposit </small>
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Variance</small> </label>
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
                                                            <small>What actions were taken regarding variance eg: counted twice, another staff checked it etc.</small>                           
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Comments<small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                               
                                                                                <input type="text" readonly class="form-control form-control-icon" id="staffComments" name="staffComments" value="<?php echo (isset($cashDepositList['staffComments']) ? $cashDepositList['staffComments'] : ''); ?>">
                                                                               
                                                                            </td>
                                                                          </tr>   
                                                                          
                                                                  
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                    </div>
                                                    
                                                <!-- Manager part data --> 
                                                <?php if($this->ion_auth->get_users_groups()->row()->name == 'Manager' || $this->ion_auth->is_admin()){ ?>
                                                 <div class="col-lg-6 col-md-6">
                                                     <span class="innderTbheader"> Manager</span>
                                                        <div class="">
                                                             <table class="row-border table-condensed endShiftTable" cellspacing="0" width="100%">
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
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Variance </label>
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
                                                                                    <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo (isset($row['coinNameLabel']) ? $row['coinNameLabel'] : '') ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo (isset($managerdisabled) ? $managerdisabled : '');   ?> class="form-control"  value="<?php echo (isset($coins1[$row['managerInputName']]) ? $coins1[$row['managerInputName']] : '') ?>" id="<?php echo $row['managerInputName'] ?>" name="<?php echo $row['managerInputName'] ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo (isset($row['managerinputId2']) ? $row['managerinputId2'] : '') ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo "variance_".$row['managerinputId2'] ?>" readonly="readonly">
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
                                                                                <label><small>Cash Counted </small></label>
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
                                                                                <label><small>Float </small></label><br></br>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly  class="form-control form-control-icon" <?php echo ($this->ion_auth->is_admin() ? '' : 'disabled')  ?> id="registerFloat1" name="registerFloat1" value="<?php echo (isset($cashDepositList['registerFloat1']) && $cashDepositList['registerFloat1'] !=0 ? sprintf("%.2f", $cashDepositList['registerFloat1']) : '600.00'); ?>">
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
                                                                               <label><small> Required Register Amount</small></label><br></br>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="requiredRegisterAmount1" name="requiredRegisterAmount1" value="<?php echo (isset($cashDepositList['requiredRegisterAmount1']) ? sprintf("%.2f", $cashDepositList['requiredRegisterAmount1']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                          <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                           
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Deposit</small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly  class="form-control form-control-icon" id="depositM2" name="depositM2" value="<?php echo (isset($cashDepositList['depositM2']) ? sprintf("%.2f", $cashDepositList['depositM2']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                             
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label><small>Variance</small></label>
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
                                                                                <label><small>Comments</small></label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                               <input type="text" readonly class="form-control form-control-icon" id="managerComments" name="managerComments" value="<?php echo (isset($cashDepositList['managerComments']) ? $cashDepositList['managerComments'] : ''); ?>">
                                                                              </td>
                                                                          </tr>   
                                                                           
                                                                          
                                                                          
                                                                  
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                </div>
                                                   <?php } ?>
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

        </div>
        <!-- END layout-wrapper -->
<?php $this->load->view('commonModal') ?>   
    
 <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
   