<?php
if(isset($officeBuildData) && !empty($officeBuildData)){
$data = unserialize($officeBuildData['otherDetails'])  ; 
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
                                    <h4 class="mb-sm-0 text-black" style="z-index: 9999;"> Office Reset </h4>
                                      </div>
                                   </div>  

                                    <div class="card-body">
                                        <?php if(isset($edit) && $edit == 'edit') {  ?>
                             <form id="officeBuildForm" action="<?php echo base_url(); ?>Cash/officeBuildUpdate/<?php echo (isset($officeBuildId) ? $officeBuildId : ''); ?>" method="post" class="form-horizontal">  
                          
                                        <?php } else {  ?>
                             <form id="officeBuildForm" action="<?php echo base_url(); ?>Cash/officeBuildAdd" method="post" class="form-horizontal">             
                                        <?php } ?>
               <input type="hidden" id="officeBuildId" value="<?php echo (isset($officeBuildId) ? $officeBuildId : '') ?>">
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
                                                            <!--<div class="col-12 col-lg-3 col-md-4 mb-3">-->
                                                            <!--    <label>Staff name </label>-->
                                                            <!--    <input type="text"  class="form-control" id="staff_name" value="<?php echo $data['staff_name'] ?>" name="staff_name"  placeholder="Staff name" required>-->
                                                            <!--</div>-->
                                                             <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label>Manager name </label>
                                                                <input type="text"  class="form-control" id="manager_name" value="<?php echo (isset($data['manager_name']) ? $data['manager_name'] : '') ?>" name="manager_name"  placeholder="Manager name" required>
                                                            </div>
                                                                <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label> Date & Time </label>
                                                              <input readonly value="<?php echo (isset($items_detail['start_time']) ? $items_detail['start_time'] : date('d-m-Y')) ?>" type="text" <?php echo (isset($disabled) ? $disabled : ''); ?> class="form-control" id="datetime" name="start_time"  placeholder="Date" required>
                                                            </div>
                                                         </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div>
                                                            <?php  if(isset($disabled) && $disabled == ''){  ?>
                                                             <?php  if(isset($officeBuildId) && $officeBuildId !='') {  ?>
                        <button type="button" class="btn btn-secondary waves-effect waves-light sendMailHideAfterSuccess" data-bs-toggle="modal" data-bs-target="#sendMailModal"> <i class=" ri-mail-line align-bottom me-1"></i>Send Mail </button>                                    
                       <?php  } ?>
                        <button class="btn btn-success"  type="button" onclick="submitofficeBuildForm()">
                         <i class="ri-send-plane-line label-icon align-middle fs-12 me-2"></i>Submit</button>   
                         <?php } ?>
                            
                            <a class="btn bg-orange" href="<?php echo base_url('Cash/officeBuild') ?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                                      </div>
                                                    </div>
                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="">
                                                             <table class="row-border table-condensed supplierCostTable" cellspacing="0" width="100%">
                                                              
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
                                                                          
                                                                            <!--<td class="menuinput-width">-->
                                                                            <!--     <label>Take from office</label>-->
                                                                            <!--</td>-->
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
                                                                                    <input type="number" class="form-control form-control-icon numberInsafe" <?php echo (isset($disabled) ? $disabled :'') ?> name="<?php echo $numberInService; ?>" value="<?php echo (isset($data[$numberInService]) ? $data[$numberInService] : '') ?>">
                                                                               
                                                                                </div>
                                                                            </td>
                                                                          
                                                                             <td class="menuinput-width">
                                                                                 <div class="form-icon">
                                                                                    <input type="hidden" readonly class="form-control form-control-icon OrderFromBank" name="<?php echo $orderFromBank ?>" value="<?php echo (isset($data[$orderFromBank]) ? $data[$orderFromBank] : '') ?>">
                                                                                  
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
                                                <td class="menuinput-width tableFooterTotals antiquewhite totalNUmberInSafe"><label>Total to Swap with Bank  </label> </td>
                                                <td class="menuinput-width">
                                                  <div class="form-icon">
                                                 <input readonly  class="form-control form-control-icon amountInCashTotalInput"  name="amountInCashTotal" value="<?php echo (isset($data['amountInCashTotal']) ? $data['amountInCashTotal'] : '') ?>" >
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
                                            <!--                  <div class="mb-3">-->
                                                <!--<label for="employeeName" class="form-label">Bank Name</label>-->
                                            <!--    <input type="text" class="form-control"  name="bankName" id="bankName" placeholder="Enter Bank Name">-->
                                            <!--</div>-->
                                                             
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
<?php $this->load->view('Float/floadModal') ?>
        
      <script src="<?php echo base_url('application/modules/Cash/assets/js/common.js') ?>"></script>
       <script>
       function submitofficeBuildForm(){
           if($("#manager_name").val() == ''){
            alert("Please select manager name"); return false;   
           }else{
            $("#officeBuildForm").submit();     
           }
         
       }
       $(document).ready(function() {
           
  $('#sendEmailButton').click(function() {
  if($('#officeBuildId').val() == ''){
      alert("Please save form first")
      return false;
  }
    if($('#bankMail').val() == ''){
        alert("Please enter bank details");
        return false;
    }
   
    // $("#sendMailModal").modal('hide');
    
      $.ajax({
       url: '<?php echo base_url('/Cash/sendBankOrderEmail') ?>',
        method: 'POST',
        data: {
          bankEmail: $('#bankMail').val(),
          orderNumber: $('#officeBuildId').val(),
        //   bankName: $('#bankName').val(),
        
        },
        success: function(response) {
            $("#sendMailModal").modal('hide');
            $(".sendMailHideAfterSuccess").attr("disabled","disabled");
            $(".showSuccessAlert").show();  
         
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText); // Handle the error response
        }
      });
  

  });
});
       </script>
    </body>

</html>