<style>
.table tr td{
    padding: 4px 2px !important;
}
</style>
<div class="container-fluid">
   <div class="alert alert-success shadow d-none" role="alert">
                       <strong> Success !</strong> Order Confirmed succesfully .
                       </div>
                       <div class="alert alert-danger shadow mb-xl-0 d-none" role="alert">
                         <strong> Something went wrong! </strong> Please try after some time!
                         </div>
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="card">
                                    <div class="card-header">
                                       <div class="d-flex align-items-center">
                                            <h5 class="card-title flex-grow-1 mb-0 text-black">Purchase Order Number #<?php if(isset($orderData) && !empty($orderData)) { echo $orderData[0]['orderId']; }?>
                                              (  <?php if(isset($orderData) && !empty($orderData)) { echo $orderData[0]['supplier_name']; }?> ) </h5>
                                        
                                            <div class="flex-shrink-0">
                                                <a onclick="window.print()" class="btn btn-success btn-sm"><i class="ri-printer-line align-middle me-1"></i>Print</a>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-nowrap align-middle table-bordered mb-0 fs-10">
                                                <thead class="table-light text-white">
                                                    <tr>
                                                      <th scope="col" class="text-white">Product Code</th>
                                                      <th scope="col" class="text-white">Product Name</th>
                                                      <th scope="col" class="text-white">UOM</th>
                                                      <th scope="col" class="text-white">Order Quantity</th>
                                                     
                                                    </tr>
                                                  </thead>
                                                <tbody>
                                                    <?php $count =1; if(isset($orderData) && !empty($orderData)) {  ?>
                                                    <?php foreach($orderData as $orderInfo){
                                                    $locationName = (isset($orderInfo['location_name']) ? $orderInfo['location_name'] : '');
                                                     ?>
                                                    <?php $orderTotal = (isset($orderInfo['order_total']) ? $orderInfo['order_total'] : ''); ?>
                                                    <?php $orderStatus = (isset($orderInfo['status']) ? $orderInfo['status'] : ''); ?>
                                                    <?php $supplier_name = (isset($orderInfo['supplier_name']) ? $orderInfo['supplier_name'] : ''); ?>
                                                    <?php $supplier_id = (isset($orderInfo['supplier_id']) ? $orderInfo['supplier_id'] : ''); ?>
                                                     <?php $order_comments = (isset($orderInfo['order_comments']) ? $orderInfo['order_comments'] : ''); ?>
                                                     <?php $supplierComments = (isset($orderInfo['supplierComments']) ? $orderInfo['supplierComments'] : ''); ?>
                                                     <?php $delivery_info = (isset($orderInfo['delivery_info']) ? $orderInfo['delivery_info'] : ''); ?> 
   <?php $delivery_date = (isset($orderInfo['delivery_date']) && $orderInfo['delivery_date'] !='' && $orderInfo['delivery_date'] !='0000-00-00' ? date('d-m-Y',strtotime($orderInfo['delivery_date'])) : ''); ?>  
                                                      <?php if($orderInfo['qty'] > 0) {  ?>
                                                    <tr>
                                                        <input type="hidden" class="orderId" value="<?php echo $orderInfo['orderId']; ?>">
                                                       
                                                        
                                                        <td><?php echo $orderInfo['product_code']; ?></td>
                                                        <td><?php echo $orderInfo['product_name']; ?></td>
                                                        <td><?php echo $orderInfo['product_UOM_name']; ?></td>
                                                        <td><?php echo $orderInfo['qty']; ?></td>
                                                       
                                                       
                                                    </tr>
                                                    <?php } ?>
                                                   <?php $count++; } } ?>
                                                   
                                                   <!-----------SUBTOTAL FOOTER START--------->
                                                  
                                                    <tr>
                                             <td>
                                            <textarea type="text" class="form-control text-left" id="supplierComments" placeholder="Supplier Comments">
                                                     <?php echo (isset($supplierComments) && $supplierComments !='' ? $supplierComments : ''); ?>  
                                                   </textarea>
                                                   <input type="hidden" id="supplierId" value="<?php echo (isset($supplier_id) && $supplier_id !='' ? $supplier_id : '') ?>">     
                                             </td>
                                                       
                                             </tr>
                                             
                                             <tr>
                                             
                                             <?php if($actionType) { ?>
                                              <td  class="text-end">
                                                <?php if(isset($orderStatus) && $orderStatus == 3 ) { ?>  
                                            <a href="#" class="btn btn-soft-success btn-sm btnAfterAjax"><i class=" ri-check-fill align-middle me-1"></i>Order Confirmed</a>     
                                             <?php }else {  ?>
                                             <a href="#" class="btn btn-blue btn-sm btnAfterAjax" onclick="confirmOrder()"><i class=" ri-check-fill align-middle me-1"></i>Confirm Order</a>
                                              <button type="button" class="btn btn-blue btn-load btnBeforeAjax">
                                                            <span class="d-flex align-items-center">
                                                                <span class="spinner-grow flex-shrink-0" role="status">
                                                                    <span class="visually-hidden">Confirming...</span>
                                                                </span>
                                                                <span class="flex-grow-1 ms-2">
                                                                    Confirming...
                                                                </span>
                                                            </span>
                                                        </button>          
                                            <?php }  ?>
                                             </td>     
                                             <?php } else{  ?>
                                             <td>
  <form id="uploadInvoiceForm" enctype="multipart/form-data">
    <div class="col-md-9 col-lg-9 col-sm-9">
      <label class="form-label text-center">Attach Invoice</label>
      <input type="file" name="orderInvoice" class="form-control" required>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-9 mt-3">
      <button type="submit" class="btn btn-success btn-sm">
        <i class="ri-upload-cloud-fill align-middle me-1"></i> Upload
      </button>
    </div>
  </form>
</td>
                                             <?php }  ?>
                                             </tr>
                                             
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!--end card-->
                             
                            </div><!--end col-->
                            <div class="col-xl-3">
                              
                                
                                <div class="card">
                                    <div class="card-header">
                                       <div class="d-flex">
                                            <h5 class="card-title flex-grow-1 mb-0 text-black">Customer Details</h5>
                                           
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0 vstack gap-3">
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="/theme-assets/images/users/user-dummy-img.jpg" alt="" class="avatar-sm rounded shadow">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                       <h6 class="fs-14 mb-1 text-black"><?php echo ucfirst($orzName); ?></h6>
                                                       <p class="text-black mb-0"><b>Location: <?php echo $locationName; ?></b></p>
                                                    </div>
                                                </div>
                                            </li>
                                             <li><i class=" ri-calendar-event-line align-middle me-2 text-black fs-16"></i><b>Delivery Date : </b><?php echo $delivery_date; ?></li>
                                            <li><i class="ri-mail-line me-2 align-middle text-black fs-16"></i><b>Email :</b> <?php echo  $cafeEmail; ?></li>
                                            <li><i class="ri-phone-line me-2 align-middle text-black fs-16"></i><b>Phone : </b><?php echo  $cafeContactNumber; ?></li>
                                        </ul>
                                    </div>
                                </div><!--end card-->
                                <?php if(isset($order_comments) && $order_comments !='') {  ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 text-black"><i class=" ri-message-3-fill me-4 align-middle me-1 text-muted"></i>Order Comments</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                            <li class="fw-medium fs-14"><?php echo $order_comments; ?></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                                 <?php if(isset($delivery_info) && $delivery_info !='') {  ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 text-black"><i class="ri-message-fill me-4 align-middle me-1 text-muted"></i>Delivery Info</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                            <li class="fw-medium fs-14"><?php echo $delivery_info; ?></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                 <?php } ?>
                               

                              
                            </div><!--end col-->
                        </div><!--end row-->
                       
                    </div><!-- container-fluid -->
               
<script>
$(document).ready(function () {
          $(".btnBeforeAjax").hide();
});
    function confirmOrder(){
       $(".btnBeforeAjax").show();
        $(".btnAfterAjax").hide();    
      let orderId = $(".orderId").val();
      let supplierComments = $("#supplierComments").val();
      let supplierId = $("#supplierId").val();
            $.ajax({
                url: '/External/Orders/confirmOrder',
                type: 'POST',
                data: { 
                    order_id: orderId,
                    supplierComments: supplierComments,
                    supplierId: supplierId
                },
                success: function(response) {
                    $(".btnBeforeAjax").hide();$(".btnAfterAjax").show();
                
                 $(".alert-success").removeClass('d-none');
                }
            });
}

$(document).ready(function() {
    $('#uploadInvoiceForm').on('submit', function(e) {
        e.preventDefault();

       let formData = new FormData(this);
       let orderId = $(".orderId").val();
       formData.append('orderId', orderId);


        $.ajax({
            url: '/External/Orders/uploadInvoice',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Invoice uploaded succesfully');
            },
            error: function(xhr, status, error) {
                alert('Upload failed: Please send invoice on email.');
            }
        });
    });
});
</script>
              
          