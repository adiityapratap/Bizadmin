 <?php 
 if(isset($cashDepositListStartOfShift) && !empty($cashDepositListStartOfShift)){
   $coin = unserialize($cashDepositListStartOfShift['startShiftCoins']);
  $notes = unserialize($cashDepositListStartOfShift['endShiftNotes']);
 
  $items_detail = unserialize($cashDepositListStartOfShift['items_detail']);
  if(is_array($coin) && is_array($notes)){
   $coins = array_merge($coin,$notes);   
  }else{
  $coins = array();
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
                                     <h4 class="mb-sm-0 text-black" style="z-index:9999">Start of Shift [ <?php echo (isset($tillName) ? $tillName : ''); ?> ]</h4>
                                      </div>
                                   </div>  

                                    <div class="card-body">
                                <?php if(isset($updateForm) && $updateForm) { ?>
                                <form id="cashDepositForm" action="<?php echo base_url(); ?>Cash/cashD/update" method="post" class="form-horizontal" novalidate> 
                                 <input type="hidden" name="IsfinalSubmissionDoneForStartShift" class="IsfinalSubmissionDoneForStartShift">
                                  <input type="hidden" name="tillName" value="<?php echo (isset($tillName) ? $tillName : ''); ?>">
                               <input type="hidden" name="cashDepositId" value="<?php echo (isset($cashDepositListStartOfShift['id']) ? $cashDepositListStartOfShift['id'] : '');  ?>">
                               <?php } else { ?>
                               <form  id="cashDepositForm" action="<?php echo base_url(); ?>Cash/cashD/cashdadd" method="post" class="form-horizontal" >  
                                <input type="hidden" name="IsfinalSubmissionDoneForStartShift" class="IsfinalSubmissionDoneForStartShift">
                                <input type="hidden" name="tillName" value="<?php echo (isset($tillName) ? $tillName : ''); ?>">
                               <?php } ?>
                    <div class="card-body">
                            <div>
                             <input type="hidden" name="selectedTillID" value="<?php echo (isset($selectedTillID) ? $selectedTillID : ''); ?>">
                            
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label>Staff name *</label>
                                                                <input <?php echo (isset($disabled) ? $disabled : ''); ?> type="text"  class="form-control" id="staff_name" name="staff_name" value="<?php echo (isset($items_detail['staff_name']) ? $items_detail['staff_name'] : '') ?>"  placeholder="Staff name" required>
                                                            <div class="invalid-feedback staffNameError">Please enter staff name.</div>
                                                            </div>
                                                              <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label> Date & Time </label>
                                                                <input value="<?php echo (isset($items_detail['start_time']) ? date('d-m-Y h:i A',strtotime($items_detail['start_time'])) : date('d-m-Y h:i A')) ?>" readonly type="text" <?php echo $disabled; ?> class="form-control" id="datetime" name="start_time"  placeholder="Date" required>
                                                            </div>
                                                            <!--      <div class="col-12 col-lg-3 col-md-4 mb-3">-->
                                                            <!--      <label>  </label>-->
                                                            <!--    <a id="dateselect" class="btn btn-success text-light mt-20">Date and Time </a>-->
                                                            <!--</div>-->
             
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <?php if(isset($disabled) && $disabled == ''){ ?>
                                                            
                        <!--<input class="btn btn-primary"  type="button" onclick="submitcashDepositForm()" value="Save">-->
                      
                        <button class="btn btn-success"  type="button" onclick="finalSubmitEndShift()">
                         <i class="ri-send-plane-line label-icon align-middle fs-12 me-2"></i>Submit</button>  
                        <?php } ?>
                             <a class="btn bg-orange" href="#" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
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
                                                                    foreach(COINS as $row ){  ?>
                                                                    <?php  //if($row['inputName'] != '50d' && $row['inputName'] != '100d') { ?>
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" readonly class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo (isset($disabled) ? $disabled : ''); ?> class="form-control" value="<?php echo (isset($coins[$row['inputName']]) ? $coins[$row['inputName']] : '') ?>" id="<?php echo $row['inputId1'] ?>" name="<?php echo $row['inputName'] ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo (isset($row['inputId2']) ? $row['inputId2'] : '') ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                   
                                                                    <?php $i++;  } } ?>
                                                                   
                                                                </tbody>
                                                                <tbody>
                                                                   
                                                                    <tr class="menurow footer-labels">
                                                                        <td class="menuinput-width">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Cash Counted </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="entrytotal" name="entrytotal" value="<?php echo (isset($cashDepositListStartOfShift['startShiftEntrytotal']) ? $cashDepositListStartOfShift['startShiftEntrytotal'] : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                           <tr class="menurow footer-labels">
                                                                                <td class="menuinput-width">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Float </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    
                                           <input type="number" <?php echo ($this->ion_auth->is_admin() ? '' : 'disabled')  ?> <?php echo (isset($disabled) ? $disabled : ''); ?> class="form-control form-control-icon" id="stdcashfloat" name="stdcashfloat" value="<?php echo (isset($cashDepositListStartOfShift['stdcashfloat']) && $cashDepositListStartOfShift['stdcashfloat'] !='' ? number_format($cashDepositListStartOfShift['stdcashfloat'],2) : '600.00'); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                           <tr class="menurow footer-labels">
                                                                                <td class="menuinput-width">
                                                                            </td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="varience" name="varience" value="<?php echo (isset($cashDepositListStartOfShift['varience']) && $cashDepositListStartOfShift['varience'] !='' ? $cashDepositListStartOfShift['varience'] : 0.00); ?>">
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
  <div id="flipConfirmModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Warning ! </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                
                                                                <div>
                                                                   <h3>
                                                                       Please count again and if there is still a variance then contact the manager.
                                                                  </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
<div id="flipConfirmFinalModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                               <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Warning ! </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                               
                                                                <div>
                                                                   <h3>
                                                                   <?php echo (isset($items_detail['staff_name']) ? $items_detail['staff_name'] : ''); ?> Verifies register is <b id="agreeTotal"></b>.
                                                                  </h3>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-success" onclick="submitFormAfterConfirmation()" data-bs-dismiss="modal">Ok</button>
                                                           <!--<button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>-->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
 <?php $this->load->view('commonModal') ?>   
    
 <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
   