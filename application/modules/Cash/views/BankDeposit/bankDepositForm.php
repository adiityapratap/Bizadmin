<?php if(isset($type) && $type == 'view'){ $disabled = 'disabled'; }else{ $disabled = ''; } ?>
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                            <div class="card-header">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">Bank Deposit</h4>
                                </div>
                                </div>       

                    <div class="card-body">
                    <form enctype='multipart/form-data' id="bankDepositForm" action="<?php echo base_url(); ?>Cash/BankDeposit/update" method="post" class="form-horizontal" >   
                    <input type="hidden" name="cashDepositId" value="<?php echo (isset($cashDepositList['id']) ? $cashDepositList['id'] : '');  ?>">
                    <div class="card-body">
                    <div>
                             
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row" style="justify-content: end;">
                                                    <div class="col-sm-auto mb-3">
                                                        <div>
                                                            <?php if(!$disabled) {  ?>
                                        
                                             <input class="btn btn-success"  type="button" onclick="submitBankDepositForm()" value="Save">
                                                            <?php }  ?>
                             
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
                                                                                <label>Day </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Date</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Coin Bag </label>
                                                                            </td>
                                                                               <td class="menuinput-width">
                                                                                 <label>Manager Bag Counted</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Variance</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Actual Banking</label>
                                                                            </td>
                                                                            
                                                                            
                                                                            <td class="menuinput-width">
                                                                            </td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                   
                                                                    
                                                                    <?php if(!empty(ALLDAYSNAMEANDDATE)){
                                                                        
                                                                        $i=1;
                                                                        $todaySDate = date('Y-m-d');
                                                                      
                                                                    foreach(ALLDAYSNAMEANDDATE as $dayName => $date ){  $currentLoopDate= date('Y-m-d',strtotime($date));  ?>
                                                                       <?php if($todaySDate != $currentLoopDate ) { $className = 'hideThisRow'; }else { $className = 'showThisRow';  } ?>
                                                                        <tr class="menurow coinsCalculationRow <?php echo $className; ?>">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo explode("_",$dayName)[0] ?>" name="<?php echo $dayName ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                            <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo $date ?>" name="<?php echo $dayName ?>">
                                                                                
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" class="form-control form-control-icon coin_bag" id="<?php echo (isset($dayName) ? $dayName : ''); ?>" value="<?php echo (isset($coinBagsData[$currentLoopDate]) ? $coinBagsData[$currentLoopDate] : ''); ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input class="form-control form-control-icon managerBagCounted"  value="<?php echo (isset($bankDepositData[$currentLoopDate]['managerBagCounted']) && $bankDepositData[$currentLoopDate]['managerBagCounted'] != '' ? $bankDepositData[$currentLoopDate]['managerBagCounted'] : '') ?>" name="<?php echo "managerBagCounted_".$currentLoopDate ?>" >
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input class="form-control form-control-icon varianceValue" value="<?php echo (isset($bankDepositData[$currentLoopDate]['varianceValue']) && $bankDepositData[$currentLoopDate]['varianceValue'] != '' ? $bankDepositData[$currentLoopDate]['varianceValue'] : '') ?>" readonly="readonly" name="<?php echo "varianceValue_".$currentLoopDate ?>">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input class="form-control form-control-icon actualAmount"  readonly="readonly" name="<?php echo "actualAmount_".$currentLoopDate ?>" value="<?php echo (isset($bankDepositData[$currentLoopDate]['actualAmount']) && $bankDepositData[$currentLoopDate]['actualAmount'] != '' ? $bankDepositData[$currentLoopDate]['actualAmount'] : '') ?>">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        
                                                                    <?php  } } ?>
                                                                   
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
                          <div class="text-center mb-3">
                         <a href="javascript:void(0);"  class="text-dark loadAllrecordsOfBankDeposit"><i class="mdi mdi-arrow-down-bold fs-20 align-middle me-2"></i><h5 class="fs-16 mb-1">Load all records</h5> </a>
                        <a href="javascript:void(0);"  class="text-dark loadLessRecordOfBankDeposit hideThisRow"><i class="mdi mdi-arrow-up-bold fs-20 align-middle me-2"></i><h5 class="fs-16 mb-1">Show today's record</h5> </a>

                         </div>
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
            <!-- end main content-->

        </div>
    
<script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
   