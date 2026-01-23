<?php
if(isset($frontOfficeBuildData) && !empty($frontOfficeBuildData)){
$data = unserialize($frontOfficeBuildData['otherDetails'])  ; 
}else{
  $data = array();  
}
 ?>
            

                <div class="page-content">
                    <div class="container-fluid">

                            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                <div class="alert alert-success shadow showSuccessAlert" role="alert" style="display:none">
                 
                 </div>
                     
                    <div class="card-body">
                          <!--form start-->
                                <div class="row with_tabs">
                                    <div class="col-lg-12">
                                            <div class="create_menu_wrap">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <!--   <div class="col-12 col-lg-3 col-md-4 mb-3">-->
                                                            <!--    <label> Bank Comments </label>-->
                                                            <!--    <input name="bank_comments"  type="text" class="form-control" id="bank_comments">-->
                                                            <!--</div> -->
                                                                <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                <label> Date & Time </label>
                                                                <input readonly value="<?php echo date('d-m-Y'); ?>" type="text" <?php echo $disabled; ?> class="form-control" id="datetime" name="start_time">
                                                                </div>
                                                            
                                                            
                                                            <div class="col-12 col-lg-3 col-md-4 mb-3">
                                                                     <label></label>
                                                                <input class="btn btn-success confirmOrder mt-4" type="button" onclick="confirmOrder()" value="Confirm Order">
                                                            </div> 
                                                            
                                                         </div>
                                                   
                                                    </div>
                                             
                            <input type="hidden" value="<?php echo $orderNumber; ?>" id="orderNumber">

                                                </div>    
                                                <div class="row">    
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="">
                                                             <table class="row-border table-condensed bankOrderTable" id="bankOrderTable" cellspacing="0" width="100%">
                                                              
                                                                <thead class="bg-primary text-white">
                                                                    <tr class="menurow tableHeader">
                                                                           
                                                                            <td class="menuinput-width text-center">
                                                                                <label>Denomination </label>
                                                                            </td>
                                                                          
                                                                            <td class="menuinput-width text-center">
                                                                                 <label>Amount Per Item</label>
                                                                            </td>
                                                                             <td class="menuinput-width text-center">
                                                                                 <label>Number of Rolls/Notes</label>
                                                                            </td>
                                                                            
                                                                           
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                    
                                                                    
                                                                    <?php if(!empty(FLOATCOINS)){
                                                                        $i=1;
                                                                    
                                                                    foreach(FLOATCOINS as $row ){    ?>
                                                                    <?php  if($row['inputName'] != '20d' && $row['inputName'] != '50d' && $row['inputName'] != '100d') {  ?>
                                                                    <?php $numberInService = "NIS_".$row['inputName'];  $orderFromBank = "OFB_".$row['inputName']; $amountOfCash = "AOC_".$row['inputName'];  ?>
                                                                      <?php
                                                                      
                                                                      if(isset($data[$numberInService]) && $data[$numberInService] !=''){
                                                                          
                                                                          $amoubtOfCash =  $row['FBamountPerItem'] - $data[$numberInService];
                                                                      }else{
                                                                          $amoubtOfCash = '';
;                                                                      }
                                                                      
                                                                     ?>
                                                                      
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
                                                                                    <input readonly  class="form-control form-control-icon amountPerItem" value="<?php echo $amoubtOfCash ?>"  >
                                                                               
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                           
                                                                        </tr>
                                                                    <?php $i++; } } } ?>
                                                                   
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
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                       

                       

                    </div>
                    <!-- container-fluid -->
                </div>
              
           
          
         
       <script src="<?php echo base_url() ?>/assets/js/common.js"></script>
       <script>
       
    
       function confirmOrder(){
           $(".confirmOrder").val("In Progress...")
           $.ajax({
         url: '<?php echo base_url('/Cash/cfb') ?>',
         method: 'POST',
         data: {
          orderNumber: $('#orderNumber').val(),
          bankComments: $('#bank_comments').val(),
         
        
        },
        success: function(response) {
            $(".confirmOrder").val("Confirm");
            if(response){
                $(".confirmOrder").attr("disabled");
                $(".showSuccessAlert").html("Order has been confirmed succesfully.Thank you.")
               $(".showSuccessAlert").show();
            }else{
                $(".showSuccessAlert").html("Some error occured, Please try again. If issue persist please contact on mail mentioned.")
                $(".showSuccessAlert").show();
               
            }
            
       
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText); // Handle the error response
        }
      });
         
       }
       </script>
   