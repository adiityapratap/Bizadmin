<?php 
$manager1Disabled = '';
$manager2Disabled = '';

if(isset($floatData) && !empty($floatData)){
  $coin = unserialize($floatData['coins']);
  $notes = unserialize($floatData['notes']);
  
  $coin1 = unserialize($floatData['coins1']);
  $notes1 = unserialize($floatData['notes1']);
  
  $items_detail = unserialize($floatData['items_detail']);
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
  
  $frontCounterFloat = unserialize($floatData['frontCounterFloatCoinsNotesM1']);
  $frontCounterFloatM2 = unserialize($floatData['frontCounterFloatCoinsNotesM2']);
  $frontCounterFloatTableFooterTotals = unserialize($floatData['frontCounterFloatTableFooterTotals']);   
}else{
  $coins1 = array(); 
   $coins = array();
   $items_detail = array();
}



if(!empty($items_detail)){
 
  if(isset($floatData['IsfinalSubmissionDoneForFloat']) && $floatData['IsfinalSubmissionDoneForFloat'] =='yes'){
  
   if(isset($items_detail['staff_name']) && $items_detail['staff_name'] !=''){
   $manager1Disabled = 'readonly'; 
   }
   
    if(isset($floatData['manager2finalSubmissionDoneForFloat']) && $floatData['manager2finalSubmissionDoneForFloat'] =='yes' && isset($items_detail['manager_name']) && $items_detail['manager_name'] !=''){
      $manager2Disabled = 'readonly'; 
    }
    
  }
 
}

  
//   echo "<pre>"; print_r($frontCounterFloatTableFooterTotals); exit;
   ?>
   
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black" style="z-index: 9999;"><?php echo ucfirst($float_type) ?> Float Count </h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                  

                                    <div class="card-body">
                               <form  id="floatForm" action="<?php echo base_url(); ?>/Cash/Floatbc/update/<?php echo (isset($float_type) ? $float_type : ''); ?>" method="post" class="form-horizontal" >   
                               <input type="hidden" name="floatId" value="<?php echo (isset($floatData['id']) ? $floatData['id'] : '');  ?>">
                                <input type="hidden" name="IsfinalSubmissionDoneForFloat" class="IsfinalSubmissionDoneForFloat" value=""> 
                               <div class="card-body">
                         
                                <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Manager name * </label>
                                                                
                                                                <input type="text" <?php echo $manager1Disabled; ?> value="<?php echo (isset($items_detail['staff_name']) ? $items_detail['staff_name'] : '') ?>"  class="form-control" id="staff_name" name="staff_name"  placeholder="Manager name" required>
                                                            </div>
                                                              <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label>Second Manager name * </label>
                                                                
                                                                <input type="text" <?php echo $manager2Disabled; ?> value="<?php echo (isset($items_detail['manager_name']) ? $items_detail['manager_name'] : '') ?>"  class="form-control" id="manager_name" name="manager_name"  placeholder="Second Manager name" required>
                                                            </div>
                                                                  <div class="col-12 col-lg-3 col-md-3 mb-3">
                                                                <label> Date & Time </label>
                                                                <input value="<?php echo (isset($items_detail['start_time']) ? date('d-m-Y',strtotime($items_detail['start_time'])) : '') ?>" type="text" <?php echo $manager2Disabled; ?> class="form-control" id="datetime" name="start_time"  placeholder="Date" required>
                                                            </div>
                                                            <!--      <div class="col-12 col-lg-3 col-md-3 mb-3">-->
                                                            <!--      <label>  </label>-->
                                                            <!--    <a id="dateselect" class="btn btn-success text-light mt-20">Date and Time </a>-->
                                                            <!--</div>-->
             
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <?php if(!$manager2Disabled) {  ?>
                                        
                                             <input class="btn btn-warning"  type="button" onclick="submitfloatForm()" value="Save and return">
                                             <input class="btn btn-success"  type="button" onclick="FinalsubmitfloatForm()" value="Submit">
                                                            <?php }  ?>
                             
                             <a class="btn bg-orange" href="#" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                           
                                                          
                                                           
                                                        </div>
                                                    </div>
                                                </div>    
                                              
                                                
                                            <?php if(isset($configData['hideSecondSection']) && $configData['hideSecondSection'] == 1) {
                                            $show = true;
                                            }else{
                                            if($configData == ''){
                                             $show = true;   
                                            }else{
                                            $show = false;    
                                            }   
                                             
                                            }?>
                                             <?php if($show) { ?>
                                             <div class="row">  
                                               <span class="floatTypeHeading">Front Counter Float</span>
                                                    <div class="col-lg-6 col-md-6">
                                                      
                                                        <div class="">
                                                             <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                                <span class="innderTbheader"> Manager 1</span>
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
                                                                    
                                                                    
                                                                    
                                                                    <?php if(!empty(FLOATCOINS)){
                                                                        $i=1;
                                                                    foreach(FLOATCOINS as $row ){ ?>
                                                                    
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" readonly class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo $manager1Disabled; ?> class="form-control" value="<?php echo (isset($frontCounterFloat['m1_'.$row['inputName']]) ? $frontCounterFloat['m1_'.$row['inputName']] : '') ?>" id="<?php echo "m1_".$row['inputId1'] ?>"  name="<?php echo "m1_".$row['inputName'] ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo (isset($row['inputId2']) ? "m1_".$row['inputId2'] : '')  ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    <?php $i++; } } ?>
                                                                   
                                                                </tbody>
                                                                <tbody>
                                                                   
                                                                <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Cash Counted </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="m1_entrytotal" name="m1_entrytotal" value="<?php  echo (isset($frontCounterFloatTableFooterTotals['m1_entrytotal']) ?  sprintf("%.2f", $frontCounterFloatTableFooterTotals['m1_entrytotal']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                 <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly type="number" class="form-control form-control-icon" id="m1_floatTotal" name="m1_floatTotal" value="<?php  echo (isset($frontCounterFloatTableFooterTotals['m1_floatTotal']) ?  sprintf("%.2f", $frontCounterFloatTableFooterTotals['m1_floatTotal']) : '') ; ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr> 
                                                                  <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="m1_floatvarience" name="m1_floatvarience"  value="<?php  echo (isset($frontCounterFloatTableFooterTotals['m1_floatvarience']) ?  sprintf("%.2f", $frontCounterFloatTableFooterTotals['m1_floatvarience']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                             <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Action Taken</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  type="text" <?php echo $manager1Disabled; ?> step="any" class="form-control form-control-icon" value="<?php echo (isset($floatData['staffFrontCounterFloatComments']) ? $floatData['staffFrontCounterFloatComments'] : '' );  ?>" id="staffFrontCounterFloatComments" name="staffFrontCounterFloatComments" >
                                                                               
                                                                                </div>
                                                                            </td>
                                                                          </tr>              
                                                               
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                </div>
                                                
                                                 <!-- Manager part data --> 
                                                 <div class="col-lg-6 col-md-6">
                                                     <span class="innderTbheader"> Manager 2</span>
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
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                            </td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if(!empty(FLOATCOINS)){
                                                                        $i=1;
                                                                    foreach(FLOATCOINS as $row ){ ?>
                                                                    
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo $manager2Disabled;   ?> class="form-control" value="<?php echo (isset($frontCounterFloatM2['m2_'.$row['managerInputName']]) ? $frontCounterFloatM2['m2_'.$row['managerInputName']] : '') ?>"  id="<?php echo (isset($row['managerInputName']) ? "m2_".$row['managerInputName'] : '' )  ?>" name="<?php echo (isset($row['managerInputName']) ? "m2_".$row['managerInputName'] : '' ) ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo (isset($row['managerinputId2']) ? "m2_".$row['managerinputId2'] : '') ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo (isset($row['managerinputId2']) ? "m2_variance_".$row['managerinputId2'] : '')  ?>" readonly="readonly">
                                                                                    <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>    

                                                                        </tr>
                                                                    <?php $i++; } } ?>
                                                                   
                                                                </tbody>
                                                                <tbody>
                                                                    <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Cash Counted </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="m2_entrytotal1" name="m2_entrytotal1" value="<?php  echo (isset($frontCounterFloatTableFooterTotals['m2_entrytotal1']) ?  sprintf("%.2f", $frontCounterFloatTableFooterTotals['m2_entrytotal1']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                    <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly type="number" class="form-control form-control-icon" id="m2_managerFloatTotal" name="m2_managerFloatTotal" value="<?php  echo (isset($frontCounterFloatTableFooterTotals['m2_managerFloatTotal']) ?  sprintf("%.2f", $frontCounterFloatTableFooterTotals['m2_managerFloatTotal']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr> 
                                                             <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="m2_floatvarience1" name="m2_managerVarience" value="<?php  echo (isset($frontCounterFloatTableFooterTotals['m2_managerVarience']) ?  sprintf("%.2f", $frontCounterFloatTableFooterTotals['m2_managerVarience']) : ''); ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>   
                                                                          
                                                        <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Action Taken</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  type="text" <?php echo $manager2Disabled; ?> step="any" class="form-control form-control-icon" value="<?php echo (isset($floatData['managerFrontCounterFloatComments']) ? $floatData['managerFrontCounterFloatComments'] : '');  ?>" id="managerFrontCounterFloatComments" name="managerFrontCounterFloatComments" >
                                                                               
                                                                                </div>
                                                                            </td>
                                                                          </tr>  
                                                                          
                                                                          
                                                                        
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                </div>
                                                   
                                            </div>
                                              <?php } ?>
                                             <br></br>
                                             
                                             <div class="row">  
                                                 <span class="floatTypeHeading">Office Float</span>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="">
                                                             <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                                <span class="innderTbheader"> Manager 1</span>
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
                                                                    
                                                                    
                                                                    
                                                                    <?php if(!empty(FLOATCOINS)){
                                                                        $i=1;
                                                                    foreach(FLOATCOINS as $row ){ ?>
                                                                    
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" readonly class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo $manager1Disabled; ?> class="form-control" value="<?php echo (isset($coins[$row['inputName']]) ? $coins[$row['inputName']] : '') ?>" id="<?php echo $row['inputId1'] ?>"  name="<?php echo $row['inputName'] ?>">
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
                                                                            <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Cash Counted </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="entrytotal" name="entrytotal" value="<?php echo (isset($floatData['entrytotal']) ?  sprintf("%.2f", $floatData['entrytotal']) : '') ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" readonly class="form-control form-control-icon" id="floatTotal" name="floatTotal" value="<?php echo (isset($configData['floatTotal']) ?  sprintf("%.2f", $configData['floatTotal']) : '') ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr> 
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="floatvarience" name="staffVarience" value="<?php echo (isset($floatData['staffVarience']) ?  sprintf("%.2f", $floatData['staffVarience']) : '') ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                           <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Action Taken </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  type="text" step="any" <?php echo $manager1Disabled; ?> class="form-control form-control-icon" id="staffOfficeFloatComments" name="staffOfficeFloatComments" value="<?php echo (isset($floatData['staffOfficeFloatComments']) ? $floatData['staffOfficeFloatComments'] : '') ?>">
                                                                               
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          
                                                                      
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                </div>
                                                 <!-- Manager part data --> 
                                                 <div class="col-lg-6 col-md-6">
                                                     <span class="innderTbheader"> Manager 2</span>
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
                                                                            <td class="menuinput-width" colspan="2">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            
                                                                            <td class="menuinput-width">
                                                                            </td>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if(!empty(FLOATCOINS)){
                                                                        $i=1;
                                                                    foreach(FLOATCOINS as $row ){ ?>
                                                                    
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="number" <?php echo $manager2Disabled; ?> class="form-control" value="<?php echo (isset($coins1[$row['managerInputName']]) ? $coins1[$row['managerInputName']] : '') ?>"  id="<?php echo $row['managerInputName'] ?>" name="<?php echo $row['managerInputName'] ?>">
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input class="form-control form-control-icon" id="<?php echo $row['managerinputId2'] ?>" readonly="readonly">
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
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Cash Counted </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="entrytotal1" name="entrytotal1" value="<?php echo (isset($floatData['entrytotal1']) ?  sprintf("%.2f", $floatData['entrytotal1']) : '') ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                    <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input type="number" readonly class="form-control form-control-icon" id="managerFloatTotal" name="managerFloatTotal" value="<?php echo (isset($configData['floatTotal']) ?  sprintf("%.2f", $configData['floatTotal']) : '') ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr> 
                                                             <tr class="menurow footer-labels">
                                                                            <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="floatvarience1" name="managerVarience" value="<?php echo (isset($floatData['managerVarience']) ? $floatData['managerVarience'] : '') ?>">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                          <tr class="menurow footer-labels">
                                                                             <td class="menuinput-width antiquewhite">
                                                                            </td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite">
                                                                                <label>Action Taken</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  type="text" step="any" <?php echo $manager2Disabled; ?> class="form-control form-control-icon" id="managerOfficeFloatComments" name="managerOfficeFloatComments" value="<?php echo (isset($floatData['managerOfficeFloatComments']) ? $floatData['managerOfficeFloatComments'] : '') ?>">
                                                                                
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                                           
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>       
                                                </div>
                                                   
                                            </div>
                                               <?php if($show) { ?>
                                              <div class="row"> 
                                              <div class="col-lg-6 col-md-6">
                                                  <table class="row-border table-condensed" cellspacing="0" width="100%">
                                                   <tbody >
                                                 <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Total </label>
                                                                            </td>
                                                                            <td class="menuinput-width" >
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="of_fc_Total" name="of_fc_Total">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                <tr class="menurow footer-labels">
                                                     <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly type="number" class="form-control form-control-icon" id="of_fc_floatTotal" name="of_fc_floatTotal" value="2500">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr> 
                                                <tr class="menurow footer-labels">
                                                     <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="of_fc_floatvarience" name="of_fc_floatvarience" >
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                 <tr class="menurow footer-labels">
                                                      <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Action Taken</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                             <input type="text" <?php echo $manager1Disabled; ?> class="form-control form-control-icon" id="staffComments" name="staffComments" value="<?php echo (isset($floatData['staffComments']) ? $floatData['staffComments'] : ''); ?>">
                                                                            </td>
                                                                          </tr>
                                                 </tbody> 
                                                 </table>
                                              </div>
                                               <div class="col-lg-6 col-md-6">
                                                  <table class="row-border table-condensed" cellspacing="0" width="100%">
                                                   <tbody >
                                                 <tr class="menurow footer-labels">
                                                                           <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                            <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Total </label>
                                                                            </td>
                                                                            <td class="menuinput-width" >
                                                                                <div class="form-icon">
                                                                                <input  readonly class="form-control form-control-icon" id="m2_of_fc_Total" name="m2_of_fc_Total">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                <tr class="menurow footer-labels">
                                                     <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input readonly type="number" class="form-control form-control-icon" id="m2_of_fc_floatTotal" name="m2_of_fc_floatTotal" value="2500">
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr> 
                                                <tr class="menurow footer-labels">
                                                     <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Variance </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                <input  step="any" readonly class="form-control form-control-icon" id="m2_of_fc_floatvarience" name="m2_of_fc_floatvarience" >
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                          </tr>
                                                 <tr class="menurow footer-labels">
                                                      <td class="menuinput-width antiquewhite" colspan="2"></td>
                                                                             <td class="menuinput-width tableFooterTotals antiquewhite" colspan="4">
                                                                                <label>Action Taken</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                             <input type="text" <?php echo $manager2Disabled; ?> class="form-control form-control-icon" id="m1_staffComments" name="managerComments" value="<?php echo (isset($floatData['managerComments']) ? $floatData['managerComments'] : ''); ?>">
                                                                            </td>
                                                                          </tr>
                                                 </tbody> 
                                                 </table>
                                              </div>
                                              </div>
                                              <?php } ?>
                                              
                                              
                                   
                                    </div>
                                </div>
                                <!--form end-->
                               
                            </div>
                        </div>
                    </form>         
                    
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
               

     <?php $this->load->view('commonModal') ?>  
  
<script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
    