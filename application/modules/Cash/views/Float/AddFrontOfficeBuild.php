<?php 
if(isset($frontOfficeBuildData) && !empty($frontOfficeBuildData)){
 $data = unserialize($frontOfficeBuildData['otherDetails']);   
}else{
  $data = array();  
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
                                    <h4 class="mb-sm-0 text-black" style="z-index: 9999;"> Front Counter Reset </h4>
                                      </div>
                                   </div> 

                                    <div class="card-body">
                                        <?php if(isset($edit) && $edit == 'edit') {  ?>
                             <form id="frontOfficeBuildForm" action="<?php echo base_url(); ?>Cash/frontOfficeBuildUpdate/<?php echo $frontOfficeBuildId; ?>" method="post" class="form-horizontal">  
                                        <?php } else {  ?>
                             <form id="frontOfficeBuildForm" action="<?php echo base_url(); ?>Cash/frontOfficeBuildAdd" method="post" class="form-horizontal">             
                                        <?php } ?>
                    
              <input type="hidden" id="frontOfficeBuildId" value="<?php echo (isset($frontOfficeBuildId) ? $frontOfficeBuildId : '') ?>">
                  <div class="alert alert-success shadow showSuccessAlert" role="alert" style="display:none">
                    <strong> Success </strong> Mail sent to bank.
                 </div>
                     
                    <div class="card-body">
                          <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                          
                                                             <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label>Manager name </label>
                                                                <input type="text"  class="form-control" id="manager_name" value="<?php echo (isset($data['manager_name']) ? $data['manager_name'] : '') ?>" name="manager_name"  placeholder="Manager name" required>
                                                            </div>
                                                                <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label> Date & Time </label>
                                                                <input readonly value="<?php echo (isset($items_detail['start_time']) ? $items_detail['start_time'] : date('d-m-Y h:i A')) ?>" type="text" <?php echo (isset($disabled) ? $disabled : ''); ?> class="form-control" id="datetime" name="start_time"  placeholder="Date" required>
                                                            </div>
                                                            <?php if(isset($frontOfficeBuildData['bankComments']) && $frontOfficeBuildData['bankComments'] !=''){  ?>
                                                             <div class="col-12 col-lg-6 col-md-4 mb-3">
                                                                <label>Bank  Comments </label>
                                                                <input readonly  class="form-control" value="<?php echo (isset($frontOfficeBuildData['bankComments']) ? $frontOfficeBuildData['bankComments'] : '') ?>">
                                                            </div>
                                                            <?php } ?>
                                                         </div>
                                                   
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div>
                        
                         <!--<button type="button" class="btn btn-secondary btn-animation waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#sendMailModal"> <i class=" ri-mail-line align-bottom me-1"></i>Send Mail </button>-->
                         <?php if(isset($disabled) && $disabled == ''){ ?>
                         <button class="btn btn-success"  type="button" onclick="submitfrontOfficeBuildForm()">
                         <i class="ri-send-plane-line label-icon align-middle fs-12 me-2"></i>Submit</button> 
                         <?php } ?>
                         
                             <a class="btn bg-orange" href="#" onclick="goBack()"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                      </div>
                                                    </div>
                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="">
                                                             <table class="row-border table-condensed bankOrderTable" id="bankOrderTable" cellspacing="0" width="100%">
                                                              
                                                                <thead class="bg-primary text-white">
                                                                    <tr class="menurow tableHeader">
                                                                           
                                                                            <td class="menuinput-width">
                                                                                <label>Denomination </label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Amount per item</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Build to</label>
                                                                            </td>
                                                                             <td class="menuinput-width">
                                                                                 <label>Amount in float</label>
                                                                            </td>
                                                                            <td class="menuinput-width">
                                                                                 <label>Money to  swap </label>
                                                                            </td>
                                                                            <!-- <td class="menuinput-width">-->
                                                                            <!--     <label>  Amount of cash</label>-->
                                                                            <!--</td>-->
                                                                            
                                                                           
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                    
                                                                    
                                                                    <?php if(!empty(FLOATCOINS)){
                                                                        $i=1;
                                                                    
                                                                    foreach(FLOATCOINS as $row ){    ?>
                                                                    <?php  if($row['inputName'] != '20d' && $row['inputName'] != '50d' && $row['inputName'] != '100d') {  ?>
                                                                    <?php $numberInService = "NIS_".$row['inputName'];  $orderFromBank = "OFB_".$row['inputName']; $amountOfCash = "AOC_".$row['inputName'];  ?>
                                                                        <tr class="menurow">
                                                                            <td class="menuinput-width">
                                                                                <div class="form-icon">
                                                                                    <input  readonly="readonly" readonly class="form-control form-control-icon"  value="<?php echo $row['coinNameLabel'] ?>">
                                                                                 <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input readonly  class="form-control form-control-icon amountPerItem" value="<?php echo $row['floatBuildAmount'] ?>" id="<?php echo $row['inputId1'] ?>" >
                                                                                <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                           <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input readonly class="form-control form-control-icon buildTo"  value="<?php echo $row['FBamountPerItem'] ?>" >
                                                                                </div>
                                                                            </td>
                                                                            
                                                                             <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="text" class="form-control form-control-icon numberInsafe" <?php echo (isset($disabled) ? $disabled : ''); ?> name="<?php echo $numberInService; ?>" value="<?php echo  (isset($data[$numberInService]) ? $data[$numberInService] : '') ?>">
                                                                                   
                                                                                </div>
                                                                            </td>
                                                                            
                                                                             <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="text" readonly class="form-control form-control-icon OrderFromBank" name="<?php echo $orderFromBank ?>" value="<?php echo (isset($data[$orderFromBank]) ? $data[$orderFromBank] : '') ?>">
                                                                                   <i class="bx bx-dollar"></i>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <!-- <td class="menuinput-width">-->
                                                                            <!--     <div class="form-icon">-->
                                                                            <!--        <input class="form-control form-control-icon amountOfCash" id="<?php echo "AOC".$row['inputId2'] ?>" name="<?php echo $amountOfCash ?>" readonly="readonly"  value="<?php echo (isset($data[$amountOfCash]) ? $data[$amountOfCash] : '') ?>">-->
                                                                            <!--        <i class="bx bx-dollar"></i>-->
                                                                            <!--    </div>-->
                                                                            <!--</td>-->
                                                                        </tr>
                                                                    <?php $i++; } } } ?>
                                                                    <tr class="menurow">
    <td class="menuinput-width" colspan="3"> </td>
    <td class="menuinput-width tableFooterTotals antiquewhite totalNUmberInSafe"><label>Total to Swap with Office </label> </td>
    <td class="menuinput-width">
              <div class="form-icon">
             <input readonly  class="form-control form-control-icon amountInCashTotalInput"  name="amountInCashTotal" value="<?php echo (isset($frontOfficeBuildData['amountInCashTotal']) ? $frontOfficeBuildData['amountInCashTotal'] : '') ?>" >
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

     
         <div id="sendMailModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Send Email </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                              
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                   <p style="font-weight:800" id="uploadMessage"></p>
                                                                   <div class="mb-3">
                                                <!--<label for="employeeName" class="form-label">Bank Email</label>-->
                                                <input type="text" class="form-control"  name="bankMail" id="bankMail" placeholder="Enter Bank Email">
                                            </div>
                                                              <div class="mb-3">
                                                <!--<label for="employeeName" class="form-label">Bank Name</label>-->
                                                <input type="text" class="form-control"  name="bankName" id="bankName" placeholder="Enter Bank Name">
                                            </div>
                                                             
                                                                </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            
                                                            <button type="button" class="btn btn-light btn-animation waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary btn-animation waves-effect waves-light" id="sendEmailButton">Send </button>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                        </div>
                                                </div>
          <div id="EOSConfirmFinalModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                               
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <div class="position-relative d-inline-block">
                                                                        <div class="position-absolute  bottom-0 end-0">
                                                                            <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                                        </div>
                                                                        <div class="avatar-lg p-1">
                                                                            <div class="avatar-title bg-light rounded-circle">
                                                                                <img src="<?php echo base_url() ?>/assets/images/users/user-dummy-img.jpg" id="customer-img" class="avatar-md rounded-circle object-cover">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                   <h5>
                                                                   <p><span id="confirmEmployeeName"></span> Verifies register is $600.00<p>
                                                                   <p>and cash for coin bag is $<span id="confrimCoinBagAmont"></span>.</p></p>Click Yes to agree.</p>
                                                                  </h5>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-success" onclick="recordStaffConfirmationForEndOfShift()" data-bs-dismiss="modal">Yes</button>
                                                           <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>

<div id="FINALSUBMITConfirmFinalModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                               <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <div class="position-relative d-inline-block">
                                                                      
                                                                   <p>Reminder to take <b id="reminderTotal"></b> from the front counter float to the office float.<p>
                                                                   <p>Click Yes to submit.</p>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-success" onclick="finalSubmitAfterConfirmation()" data-bs-dismiss="modal">Yes</button>
                                                           <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>


      <?php $this->load->view('Float/floadModal'); ?>
  
      <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
       <script>
       
       $(document).ready(function() {
         
  $('#sendEmailButton').click(function() {
  if($('#frontOfficeBuildId').val() == ''){
      alert("Please save form first")
      return false;
  }
    if($('#bankMail').val() == '' || $('#bankName').val() == ''){
        alert("Please enter bank details");
        return false;
    }
   
    // $("#sendMailModal").modal('hide');
    
      $.ajax({
       url: '<?php echo base_url('sendBankOrderEmail') ?>',
        method: 'POST',
        data: {
          bankEmail: $('#bankMail').val(),
          orderNumber: $('#frontOfficeBuildId').val(),
          bankName: $('#bankName').val(),
        
        },
        success: function(response) {
            $("#sendMailModal").modal('hide');
            $(".showSuccessAlert").show();  
         
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText); // Handle the error response
        }
      });
  

  });
});


     function finalSubmitAfterConfirmation(){
       $("#frontOfficeBuildForm").submit();  
     }
    
       function submitfrontOfficeBuildForm(){
           if($("#manager_name").val() == ''){
            alert("Please select manager name"); return false;   
            
           }else{
              $("#reminderTotal").html($(".amountInCashTotalInput").val());
           $("#FINALSUBMITConfirmFinalModal").modal('show');      
           }
         
       }
       </script>
   