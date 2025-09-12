<div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">Bank Deposit</h4>
     </div>
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  

                    <div class="card-body">
                    <form enctype='multipart/form-data' id="bankReconcileForm" action="<?php echo base_url(); ?>/submitreconcile" method="post" class="form-horizontal" >   
                  <input type="hidden" class="isFinalSave" name="isFinalSave" value="">
                  <div class="alert alert-success shadow showSuccessAlert" rolev="alert" style="display:none">
                    <strong> Success </strong> Data Saved.
                 </div>
                    <div class="card-body">
                    <div>
                             
                             
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                   
                                                    <div class="col-md-2 mb-4">
                                                     <div class="form-group">
                                                <label for="inputField">Date From</label>
                                                <?php 
                                                 
                                                if(!empty($existingCompletedDates)){
                                                    $maxDate = max($existingCompletedDates);
                                                  $newMinDate = date('Y-m-d', strtotime($maxDate . ' +1 day'));   
                                                //   $newMinDate = date('Y-m-d', strtotime($maxDate));  
                                                }else{
                                                     $newMinDate = '';
                                                }
                                        
                                               
                                                ?>
                                                <input class="form-control" type="date" id="dateFrom" name="dateFrom"  min="<?php echo (isset($newMinDate) && $newMinDate != '' ? $newMinDate : '') ?>"   max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" >
                                                     </div>
                                                                     
                                                    </div>
                                                    <div class="col-md-2 mb-4">
                                                     <div class="form-group">
                                                <label for="inputField">Date To</label>
                                                <input class="form-control" type="date" id="dateTo" name="dateTo" min="<?php echo (isset($newMinDate) && $newMinDate != '' ? $newMinDate : '') ?>"   max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
                                                     </div>
                                                    </div>
                                                    <div class="col-md-2 mt-4">
                                                    <button type="button" class="btn btn-primary btn-animation waves-effect waves-light" onclick="filterDate()">Filter <i class="ri-filter-line"></i></button>
                                                    </div>
                                                    <?php if(isset($disabled) && !$disabled) {  ?>
                                                     <div class="col-md-2 mt-4">
                                           <button type="submit" class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Save</button>
                                                          
                                                    </div>
                                                      <?php }  ?>
                                                   
                                                     
                                                  
                                                    <div class="col-md-6 mt-4 d-flex gap-2" style="justify-content:end;height:50%">
                                                       
                            <button type="button" class="btn btn-warning btn-animation waves-effect waves-light markSave" onclick="markCompleted('save')"> <i class="ri-double-line align-bottom me-1"></i>Save & Return </button>                                                    
                            <button type="button" class="btn btn-success btn-animation waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#flipModal"> <i class="ri-calendar-check-line align-bottom me-1"></i>Submit </button>                    
                             <a data-bs-toggle="offcanvas" class="btn btn-danger btn-animation waves-effect waves-light" href="#offcanvasExample" aria-controls="offcanvasExample">History</a>                                
                            
                             <!--<a class="btn btn-danger" href="<?php echo base_url(); ?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>-->
                                                         
                                                    </div>
                                                    
                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-12">
                                                        <div class="tableContainer">
                                                             <table class="row-border table-condensed bankReconsileTable" cellspacing="0" width="100%">
                                                               
                                                                <thead class="bg-primary text-white">
                                                                    <tr class="menurow tableHeader">
                                                                           
                                                                            <td class="menuinput-width">
                                                                                <label>Day </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Date</label>
                                                                            </td>
                                                                            <?php foreach($till_detail as $till) { ?>
                                                                             <td class="menuinput-width">
                                                                                 <label><?php echo $till['till_name']; ?> </label>
                                                                            </td>
                                                                            <?php } ?>
                                                                           
                                                                             <td class="menuinput-width">
                                                                                 <label>Date Banked</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Manager Banked</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Bank Counted</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Variance</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                            </td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                    <?php if(isset($allDatesOfSelectedMonth) && !empty($allDatesOfSelectedMonth)) { 
                                                                     $monthsDate =    $allDatesOfSelectedMonth;
                                                                    }else{
                                                                     $monthsDate =    ALLDAYSNAMEANDDATE; 
                                                                    }
                                                                    // echo "<pre>"; print_r($existingCompletedDates); exit;
                                                                    ?>
                                                                    
                                                                 
                                                                    
                                                                    <?php if(!empty($monthsDate)){
                                                                        
                                                                        $i=1;
                                                                        $todaySDate = date('Y-m-d');
                                                                        $thisTillsDateWiseTotal = 0;
                                                                        $thisTillsDateWiseTotalME = 0;
                                                                        $managerBankedDateWiseTotal = 0;
                                                                        $bankCountedDateWiseTotal = 0;
                                                                        $varianceDateWiseTotal = 0;
                                                                    foreach($monthsDate as $dayName => $date ){  $currentLoopDate= date('d-m-Y',strtotime($date)); 
                                                                    $currentLoopDateYrFormat = date('Y-m-d',strtotime($date));
                                                                   
                                                                    // if(isset($bankReconcileData[$currentLoopDate]) && strpos($bankReconcileData[$currentLoopDate], "_completed") !== false ){
                                                                    //  $readonly = 'readonly';   
                                                                    // }
                                                                    if(in_array($currentLoopDateYrFormat,$existingCompletedDates)) { $readonly = 'readonly'; }else{ $readonly = ''; }
                                                                    if(isset($bankReconcileData["dateBanked_".$currentLoopDate])){
                                                                      $datee =  explode("_",$bankReconcileData["dateBanked_".$currentLoopDate]);
                                                                        $currentDateBanked = (is_array($datee) ? $datee[0] : '');
                                                                    }else{
                                                                        $currentDateBanked = '';
                                                                    }
                                                                    
                                                                    ?>
                                                                  
                                                                    
                                                                       <?php $className = 'hideThisRow commonRowClass '.$currentLoopDateYrFormat; ?>
                                                                       <?php $classNameForCompletedDates = 'hideThisRow showRowToAdmin commonRowClass '.$currentLoopDateYrFormat; ?>
                                                                       
                                                                        <tr class="menurow calculationRow <?php echo $className; ?>">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" class="form-control column-input NanInput"  value="<?php $dn= explode("_",$dayName)[0]; echo $dn; ?>" name="<?php echo $dayName ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                            <input  readonly="readonly" class="form-control column-input NanInput" id="<?php echo (isset($bankReconcileData[$currentLoopDate]) ? $bankReconcileData[$currentLoopDate] : $currentLoopDate) ?>"  value="<?php echo  $currentLoopDate  ?>" name="<?php echo $currentLoopDate ?>">
                                                                                </div>
                                                                            </td>

                                                                             <?php $thisTillTotal = 0; $manualEnteredTillTotal = 0;$amountBanked =0;?>
                                                                             <?php if(isset($till_detail) && !empty($till_detail)) { 
                                                                                 
                                                                                 foreach($till_detail as $till) { 
                                                                               $indexName = $till['id'].'_'.$currentLoopDate;
                                                                               $valueOfThisTill = (isset($coinBagsTillWise[$indexName]['depositM2']) ? $coinBagsTillWise[$indexName]['depositM2'] : ''); 
                                                                               $thisTillTotal =  $thisTillTotal + (float)$valueOfThisTill;
                                                                               $manualEnteredTillTotal += (float)(isset($bankReconcileData[$indexName]) ? $bankReconcileData[$indexName] : 0);
                                                                               $amountBanked = $thisTillTotal + $manualEnteredTillTotal;
                                                                               ?>
                                                                              <td class="menuinput-width tillAmountCol">
                                                                                  <div style="display:flex" class="gap-1">
                                                                           <div class="form-icon">           
                                                                           <input style="background-color: #c5c5c53b;" readonly="readonly"  name="<?php echo 'deposit_'.$indexName ?>" class="form-control form-control-icon column-input"  value="<?php echo (isset($valueOfThisTill) ? sprintf("%.2f", $valueOfThisTill) : '') ?>" >    
                                                                            <i class="bx bx-dollar"></i>
                                                                           </div>  
                                                                                
                                                                          <div class="form-icon">
                                                                          <input class="form-control tillWiseAmount form-control-icon column-input"  type="text" <?php echo $readonly; ?> name="<?php echo $indexName ?>"  value="<?php echo (isset($bankReconcileData[$indexName]) ? sprintf("%.2f", $bankReconcileData[$indexName]) : ''); ?>"/>
                                                                            <i class="bx bx-dollar"></i>
                                                                            </div>
                                                                                 
                                                                                 </div>
                                                                            </td>
                                                                            <?php } }else {   ?>
                                                                     <td class="menuinput-width tillAmountCol">
                                                                         <div style="display:flex">
                                                                              <div class="form-icon">
                                                                            <input style="background-color: #c5c5c53b;" readonly="readonly" class="form-control form-control-icon column-input"  value="" >
                                                                            <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                             <div class="form-icon">
                                                                         <input class="form-control tillWiseAmount form-control-icon column-input" type="text" readonly="readonly"  value=""/>   
                                                                            <i class="bx bx-dollar"></i>
                                                                                </div> 
                                                                             
                                                                             </div>
                                                                         </td>        
                                                                            <?php }  ?>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                         <input type="date" <?php echo $readonly; ?> value="<?php echo $currentDateBanked; ?>" class="NanInput dateBankedInput column-input form-control <?php echo "dateBanked_".$currentLoopDateYrFormat ?>"  name="<?php echo "dateBanked_".$currentLoopDate ?>">
                                                                                </div>
                                                                            </td>
                                                                             <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input class="form-control form-control-icon column-input amountBanked <?php echo "amountBanked_".$currentLoopDate ?>" readonly value="<?php echo sprintf("%.2f", $manualEnteredTillTotal);  ?>" name="<?php echo "amountBanked_".$currentLoopDate ?>">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input readonly class="form-control form-control-icon amountReconcile NanInput" >
                                                                                    
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            
                                                                             <?php if(isset($bankReconcileData["bankCounted_".$currentLoopDate]) && $bankReconcileData["bankCounted_".$currentLoopDate] > 0){
                                                                             $varianceAmount = (float)$thisTillTotal - (float)$bankReconcileData["bankCounted_".$currentLoopDate]; }else{ $varianceAmount = 0;}
                                                                             ?>
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
             <input type="text" class="form-control form-control-icon column-input reconcileVarianceAmount NanInput"  readonly  >                                                                          
                                                                                    <!--<input type="text" class="form-control form-control-icon column-input reconcileVarianceAmount NanInput"  readonly name="<?php echo "reconcileVarianceAmount_".$currentLoopDate ?>" value="<?php echo sprintf("%.2f", $varianceAmount); ?>" >-->
                                                                                    <!--<i class="bx bx-dollar"></i>-->
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                   
               <!------------------------------------------------------------------------------- ToTal Row StART---------------------------------->
                                                                     
                                                                     <?php 
                                                                    //  echo "<pre>"; print_r($existingCompletedDates); exit;
                                                                     if(in_array($currentLoopDateYrFormat,$existingCompletedDates)) { $readonly = 'readonly'; }else{ $readonly = ''; } ?>   
                                                                     <?php   if(isset($bankReconcileData["bankCountedTotalManulEntry_".$currentLoopDateYrFormat]) && $bankReconcileData["bankCountedTotalManulEntry_".$currentLoopDateYrFormat] !='' && $bankReconcileData["bankCountedTotalManulEntry_".$currentLoopDateYrFormat] > 0) { ?>
                                                                     <tr class="menurow totalRow <?php echo $classNameForCompletedDates; ?>" style="display:none;background-color: #1a2a6dbd;" >
                                                                    <?php  }else{?>
                                                                    <tr class="menurow totalRow <?php echo $className; ?>" style="display:none"> 
                                                                   <?php   } ?>     
                                                                   
                                                                            <td class="menuinput-width">
                                                                               <input class="form-control NanInput" value="Total" readonly>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                <input class="form-control NanInput "  readonly>
                                                                            </td>

                                                                      <?php if(isset($till_detail) && !empty($till_detail)) {
                                                                        foreach($till_detail as $till) { ?>
                                                                        
                                                                        <td class="menuinput-width tillAmountCol">
                                                                        <div style="display:flex" class="gap-1">
                                                                            <div class="form-icon">
                                                                        <input type="hidden" style="background-color: #c5c5c53b;" readonly  class="form-control form-control-icon"  name="depositedDaytill_<?php echo $indexName; ?>"  value="<?php echo (isset($bankReconcileData['depositedDaytill_'.$indexName]) ? sprintf("%.2f", $bankReconcileData['depositedDaytill_'.$indexName]) : '');  ?>">    
                                                                         
                                                                          </div>
                                                                          <div class="form-icon">
                                                                         <input type="hidden" class="form-control tillWiseAmount form-control-icon" readonly type="text"  name="depositedDayManualEntrytill_<?php echo $indexName; ?>" value="<?php echo (isset($bankReconcileData['depositedDayManualEntrytill_'.$indexName]) ? sprintf("%.2f", $bankReconcileData['depositedDayManualEntrytill_'.$indexName]) : '');  ?>" />
                                                                          
                                                                           </div>
                                                                           
                                                                         </div>
                                                                        </td>
                                                                            <?php } }else {   ?>
                                                                    <td class="menuinput-width tillAmountCol">
                                                                         <div style="display:flex">
                                                                              <div class="form-icon">
                                                                            <input type="hidden" style="background-color: #c5c5c53b;" readonly="readonly" class="form-control form-control-icon"  value="" >
                                                                           
                                                                                </div>
                                                                             <div class="form-icon">
                                                                         <input type="hidden" class="form-control tillWiseAmount form-control-icon" type="text" readonly  value=""/>   
                                                                           
                                                                                </div> 
                                                                             
                                                                             </div>
                                                                         </td>        
                                                                            <?php }  ?>
                                                                            
                                                                           <td class="menuinput-width">
                                                                           <input class="form-control form-control-icon NanInput" readonly>     
                                                                            </td>
                                                                            
                                                                            
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" readonly name="depositedDaymanagerBanked_<?php echo $currentLoopDateYrFormat; ?>" value="<?php echo (isset($bankReconcileData['depositedDaymanagerBanked_'.$currentLoopDateYrFormat]) ? sprintf("%.2f", $bankReconcileData['depositedDaymanagerBanked_'.$currentLoopDateYrFormat]) : '');  ?>">
                                                                                  <i class="bx bx-dollar"></i> 
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input <?php echo $readonly; ?> class="form-control form-control-icon NanInput" oninput="calculateVariance()" value="<?php echo (isset($bankReconcileData["bankCountedTotalManulEntry_".$currentLoopDateYrFormat]) ? sprintf("%.2f", $bankReconcileData["bankCountedTotalManulEntry_".$currentLoopDateYrFormat]) : '') ?>" name="bankCountedTotalManulEntry_<?php echo $currentLoopDateYrFormat; ?>">
                                                                                 <i class="bx bx-dollar"></i> 
                                                                                </div>
                                                                            </td>
                                                                             
                                                                            <td class="menuinput-width">
                                                                                  <div class="form-icon">
                                                                                    <input type="text" class="form-control form-control-icon reconcileVarianceAmount NanInput" readonly  name="depositedDayVariance_<?php echo $currentLoopDateYrFormat; ?>"  value="<?php echo (isset($bankReconcileData["depositedDayVariance_".$currentLoopDateYrFormat]) ? sprintf("%.2f", $bankReconcileData["depositedDayVariance_".$currentLoopDateYrFormat]) : '') ?>">
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
                        <a href="javascript:void(0);"  class="text-dark loadLessRecordOfBankDeposit hideThisRow"><i class="mdi mdi-arrow-up-bold fs-20 align-middle me-2"></i><h5 class="fs-16 mb-1">Hide records</h5> </a>

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
                <!-- End Page-content -->

                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
    <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="offcanvasExample">
                                        <!--end offcanvas-header-->
                                        <div class="offcanvas-body profile-offcanvas p-0">
                                            <div class="team-cover">
                                                <img src="/theme-assets/images/small/img-1.jpg" alt="" class="img-fluid" />
                                            </div>
                                            <div class="p-3">
                                                <div class="team-settings">
                                                    
                                                </div><!--end col-->
                                            </div>
                                           <form  action="<?php echo base_url(); ?>Cash/archiveBankReconcile" method="post">   
                                            <div class="row mt-20"style="margin-top: 100px;padding: 10px;">
                                            <div class="col-lg-6">
                                                <select class="form-select mb-3" name="monthName" aria-label="Default select example" required>
                                                    <option >Select month </option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option><option value="July">July</option>
                                                    <option value="August">August</option><option value="September">September</option>
                                                    <option value="October">October</option><option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                            
                                             <div class="col-lg-6">
                                                <select class="form-select mb-3" name="yearName" aria-label="Default select example" required>
                                                    <option >Select Year </option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-9">
                                          <button type="submit" class="btn btn-success btn-animation waves-effect waves-light"><i class="ri-file-search-line align-bottom ms-1"></i> Explore historical data</button>
                                           </div>
                                        </div>
                                            </form>
                                            
                                            <div class="row"style="margin-top: 30px;padding: 10px;">
                                            <div class="col-lg-12">
                                              <div>
                                                    <label class="form-label mb-0">Date Uploaded</label>
                                                    <p class="text-muted"> <code>Select date to view uploaded bank receipt on that date.</code></p>
                                                    <input type="date" class="form-control " id="receiptDateUploadedID">
                                                </div>  
                                                <button type="button" class="mt-4 btn btn-dark btn-animation waves-effect waves-light" onclick="viewBankreceiptAttachment()">View Receipt</button>
                                            </div>    
                                             </div>  
                                        </div><!--end offcanvas-body--> 
                                        
                                       
                                    </div>
                                      
   <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Bank Receipt </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                              
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                   <p style="font-weight:800" id="uploadMessage"></p>
                                                                <span> Please note , Once the date selected is marked completed cannot be edited anymore.</br> Click Confirm to mark the date selected as completed.  </span>
                                                                </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <?php $this->load->view('partials/fileUpload') ?>
                                                        <div class="hstack gap-2 justify-content-end">
                                                            
                                                            <button type="button" class="btn btn-light btn-animation waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                                                           <button type="button" class="btn btn-dark btn-animation waves-effect waves-light" onclick="showUploadFileModal()">Upload Bank Receipt</button>
                                                            <button type="button" class="btn btn-purple btn-animation waves-effect waves-light" onclick="markCompleted()">Confirm </button>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                        </div>
                                                </div>    
   <div id="flipModalTotal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                              
                                              
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                <span class="selectedDatedAmountBankedTotal"></span>
                                                                </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light btn-animation waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                        </div>
                                                </div>                                                

 <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
 
    
   <script>
   function showUploadFileModal(){
     $("#fileUploadModal").modal('show');    
   }
   
   // to fetch the bank receipt image 
   
   function viewBankreceiptAttachment() {
       let date = $("#receiptDateUploadedID").val();
                $.ajax({
                    url: '<?php echo base_url('Cash/fetchBankReceipt'); ?>',
                    type: 'POST',
                     data: { date: date },
                    success: function(response) {
                        console.log("response",response);
                        if (response) {
                             console.log("response",response);
                            var imageUrl = response;
                            window.open(imageUrl, '_blank');
                        } else {
                            alert('No bank receipt found for the selected date.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            
            
   $(document).ready(function(){
     let dateFrom =  localStorage.getItem("dateFrom",$("#dateFrom").val())
     let dateTo = localStorage.getItem("dateTo",$("#dateTo").val())
     $("#dateFrom").val(dateFrom); $("#dateTo").val(dateTo);
   
    // $(".commonRowClass").addClass("hideThisRow")
    //  let result = getDates(dateFrom, dateTo); 
    //  result.map((value,index)=>{
    //  $("."+value).removeClass('hideThisRow');
    //  if (index === result.length - 1) {
    //   $("."+value).next(".totalRow").show();   
      filterDate('firstLoad');
    //  }
    //  })  
   })
   $(".tillWiseAmount").on('change keyup', function() {
       let sum = 0;
       let element = $(this).parents(".commonRowClass").find('.tillWiseAmount')
     $(element).each(function() {
      const value = parseFloat($(this).val());
      if (!isNaN(value)) {
      sum += value;
      }
});
       $(this).parents(".commonRowClass").find(".amountBanked").val(sum.toFixed(2));
       filterDate();
});
  
   let showAllrecords = '<?php echo $showAllrecords; ?>';
   if(showAllrecords){
       $(".coinsCalculationRow").removeClass("hideThisRow");;
	    $(".calculationRow").removeClass("hideThisRow");;
	   $(".loadAllrecordsOfBankDeposit").addClass("hideThisRow");;
	   $(".loadLessRecordOfBankDeposit").removeClass("hideThisRow");;
   }
   console.log("showAllrecords",showAllrecords);
   
   
  function filterDate(isPageLoadCall=''){
  
   localStorage.setItem("dateFrom",$("#dateFrom").val())
   localStorage.setItem("dateTo",$("#dateTo").val())
   const today = new Date();
    // const todaysDate = today.toISOString().split('T')[0];
     const dateTo = $("#dateTo").val();
     if(isPageLoadCall == '' && ($("#dateFrom").val() =='' || $("#dateTo").val() =='')){
         alert("Please enter date from and date to values");
         return false;
     }

    $(".commonRowClass").addClass("hideThisRow")
     let result = getDates($("#dateFrom").val(), $("#dateTo").val()); 
     $(".totalRow").hide();
     result.map((value,index)=>{
     $("."+value).removeClass('hideThisRow');
     $("."+value).next(".totalRow").removeClass('putcolumnTotals');
     
     if (index === result.length - 1) {
      $("."+value).parent().find('.totalRow.'+dateTo).show();   
      $("."+value).parent().find('.totalRow.'+dateTo).addClass("putcolumnTotals");
     }
     });
     
         const numColumns = $(".bankReconsileTable tbody tr:first .form-control").length;
         let columnTotals = Array(numColumns).fill(0);
          
         
            // Iterate through each row and update column totals
            $(".bankReconsileTable tbody tr:not(.hideThisRow)").each(function() {
                $(this).find(".column-input").each(function(index) {
                    if(!$(this).hasClass("reconcileVarianceAmount")){
                    const value = parseFloat($(this).val()) || 0;
                    columnTotals[index] += value;
                    }
                });
            });
                  console.log("columnTotals",columnTotals)
                  const newRow = $(".putcolumnTotals");

            // // Update the <td> elements in the new row with the column totals
            newRow.find("td .form-control").each(function(index) {
                if(!$(this).hasClass("NanInput")){
                $(this).val(columnTotals[index]); 
                }
                
            });
            
     

   calculateVariance();
    
   }
   
   function calculateVariance(){
       
    const dateBeingBanked = $("#dateTo").val();
    let firstValue = parseFloat($('[name="depositedDaymanagerBanked_' + dateBeingBanked + '"]').val()) || 0;
    let secondValue = parseFloat($('[name="bankCountedTotalManulEntry_' + dateBeingBanked + '"]').val()) || 0;
    let resultTot = firstValue - secondValue;
   $('[name="depositedDayVariance_' + dateBeingBanked + '"]').val(!isNaN(resultTot) ? parseFloat(resultTot).toFixed(2) : 0);

  
   }
   
 
  function getDates(startDate, endDate) {
  var dates = [];
  var currentDate = new Date(startDate);
  endDate = new Date(endDate);

  while (currentDate <= endDate) {
    dates.push(currentDate.toISOString().split('T')[0]);
    currentDate.setDate(currentDate.getDate() + 1);
  }

  return dates;
}
 
  function markCompleted(typeF=''){
     
    const today = new Date();
    const todaysDate = today.toISOString().split('T')[0];
    const dateCompleted = $("#dateTo").val();
    
    if($("#dateFrom").val() == '' ||  $("#dateTo").val() == ''){
       alert("Please select From and To Date");
    }  
    let result = getDates($("#dateFrom").val(), $("#dateTo").val());
    
   if(typeF !='save'){
     $(".isFinalSave").val('yes');
     localStorage.removeItem('dateFrom');
     localStorage.removeItem('dateTo');
    result.map((value)=>{
     $("."+value).find(".amountReconcile,.tillWiseAmount").attr('readonly', 'readonly');
     $(".dateBanked_"+value).attr('readonly', 'readonly');
      $(".dateBanked_"+value).val(todaysDate);
      
     });
     $("[name='bankCountedTotalManulEntry_" + dateCompleted + "']").attr('readonly', 'readonly');
   }
     
    
     
      const formDataArray = $("#bankReconcileForm").serializeArray();
      let formDataSerialized = '';
      
     if(typeF=='save'){
       $(".markSave").html("Saving...");
         formDataArray.forEach(function(item) {
             const elementName = item.name;
         const dateMatch = elementName.match(/\d{2}-\d{2}-\d{4}/);
        let itemId = $('input[name="' + elementName + '"]').attr("id");
        if(typeof itemId != 'undefined' && itemId.includes("_completed")){
        item.value = item.value + "_completed";  
         }
         });
       
       formDataSerialized = $.param(formDataArray);  
     }else{

     formDataArray.forEach(function(item) {

    
    function hasHideThisRowParent(element) {
        return $(element).parents(".hideThisRow").length > 0;
    }

    const elementName = item.name;
    const dateMatch = elementName.match(/\d{2}-\d{2}-\d{4}/);
    let itemId = $('input[name="' + elementName + '"]').attr("id");
    if(typeof itemId != 'undefined' && itemId.includes("_completed")){
       item.value = item.value + "_completed";  
    }
   
    if (dateMatch && !item.value.includes("_completed") && !hasHideThisRowParent($(`[name="${item.name}"]`))) {
        item.value = item.value + "_completed";
    } else if (item.value == "0.00" || item.value == "0") {
        item.value = ""; // Make it blank
    }
    });

         formDataSerialized = $.param(formDataArray);
     }
          let jsonStringResult = JSON.stringify(result);
                           $.ajax({
                            type: "POST",
                            url: "/Cash/markSelectedDateAsCompleted",
                            data: formDataSerialized,
                            success: function(data){
                            $("#flipModal").modal('hide'); 
                            $(".markSave").html("Save")
                            $(".showSuccessAlert").show();  
                            // location.reload();
                            }
                        });
    
  }



	$(".loadAllrecordsOfBankDeposit").on('click', function() {	
	   $(".coinsCalculationRow").removeClass("hideThisRow");;
	    $(".calculationRow").removeClass("hideThisRow");;
	   $(".loadAllrecordsOfBankDeposit").addClass("hideThisRow");;
	   $(".loadLessRecordOfBankDeposit").removeClass("hideThisRow");;
	   $(".showRowToAdmin").show();
	   //$(".hideThisRow").show();
	   // show all the total rows on wch date it has been banked
	   let uniqueDates = new Set();
       $(".dateBankedInput").each(function () {
        let dateValue = $(this).val();
        uniqueDates.add(dateValue);
       });

      let uniqueDatesArray = Array.from(uniqueDates);
      uniqueDatesArray.forEach(function (date) {
       let selector = '.hideThisRow.totalRow.' + date;
       let matchingElement = $(selector);
        if (matchingElement.length > 0) {
         matchingElement.show();
         }
        });
	   
	   
	   
		});
		
	$(".loadLessRecordOfBankDeposit").on('click', function() {	
	   $(".coinsCalculationRow").not('.showThisRow').addClass("hideThisRow");;
	   $(".calculationRow").not('.showThisRow').addClass("hideThisRow");;
	   $(".loadAllrecordsOfBankDeposit").removeClass("hideThisRow");;
	   $(".loadLessRecordOfBankDeposit").addClass("hideThisRow");
	   $(".showRowToAdmin").hide();
	  let uniqueDates = new Set();
      $(".dateBankedInput").each(function () {
        let dateValue = $(this).val();
        uniqueDates.add(dateValue);
      });

      let uniqueDatesArray = Array.from(uniqueDates);
      uniqueDatesArray.forEach(function (date) {
       let selector = '.hideThisRow.totalRow.' + date;
       let matchingElement = $(selector);
        if (matchingElement.length > 0) {
         matchingElement.hide();
         }
        });
		});	
		

   </script>
