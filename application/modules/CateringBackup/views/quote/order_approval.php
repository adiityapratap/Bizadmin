<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<?php if($orderData['status'] == 4 || $orderData['status']==1){?>
<div class="row" style="margin-top: -60px;">
    <form id="approval_form" method="post">
	<label>Comments</label>
	<textarea name="approval_comments" class="form-control" placeholder="If you see anything that needs to be changed in the order, please make a note here. The manager handling the order will make the required changes."></textarea>
	<input type="hidden" name="order_id" value="<?php echo $orderData['order_id'] ?>">
	<button class="btn btn-soft-primary mt-2 submit fw-semibold" type="submit" data-orderstatus="7" id="approve">Approve <i class="ri-check-double-line label-icon align-middle"></i></button>
	<button class="btn btn-soft-danger mt-2 submit fw-semibold" type="submit" data-orderstatus="8" id="reject">Reject <i class="ri-close-fill label-icon align-middle"></i></button>
	<button class="btn btn-soft-success mt-2 submit fw-semibold" type="submit" data-orderstatus="9" id="modify">Modify the Order <i class="ri-edit-box-line label-icon align-middle"></i></button>
	</form>
    </div>
<?php } ?>
 <div class="row mt-3">
            <div class="col-xl-9">
            <div class="card">
            <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Order #<?php echo $orderData['order_id'] ?></h5>
                                        <input type="hidden" id="order_id" value="<?php echo $orderData['order_id'] ?>">
                                       <input type="hidden" id="customer_name" value="<?php echo $orderData['firstname'] ?>">
                                    </div>
                                </div>
            <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap align-middle table-borderless mb-0">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Product Comments</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col" class="text-end">Total Amount</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php $subtotal = 0; ?>        
                                        <?php if(isset($orderData['products']) && !empty($orderData['products'])) {  ?>
                                        <?php foreach($orderData['products'] as $products) {  ?>
                                                <tr class="border-top border-solid-dark">
                                                    <td> <?php echo $products['product_name'] ?></td>
                                                    <td> <?php echo $products['order_product_comment'] ?></td>
                                                    <td><?php echo $products['quantity'] ?></td>
                                                    <td>$<?php echo number_format($products['price'],2); ?></td>
                                                   
                                                    
                                                    <td class="fw-medium text-end">
                                                        $<?php echo number_format($products['total'],2); ?>
                                                    </td>
                                                </tr>
                                         <?php $subtotal += $products['total'];}  ?>
                                        <?php }  ?>
                                        <tr class="border-top border-top-dashed ">
                                                    <td colspan="3"></td>
                                                    <td colspan="2" class="fw-bold p-0">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Sub Total :</td>
                                                                    <td class="text-end">$<?php echo number_format($subtotal,2); ?></td>
                                                                </tr>
                                                                <!--<tr>-->
                                                                <!--    <td>Coupon <span class="text-muted"></span> :</td>-->
                                                                <!--    <td class="text-end">-$53.99</td>-->
                                                                <!--</tr>-->
                                                                 <?php if(isset($orderData['delivery_fee']) && $orderData['delivery_fee'] !='') {  ?>
                                                                 <tr>
                                                               <td>Delivery Fee :</td>
                                                               <td class="text-end">
                                                                $<?php echo number_format($orderData['delivery_fee'] ?? 0, 2); ?>
                                                                </td>
                                                                </tr>
                                                                <?php } ?>
                                                               
                                                                <?php if(isset($coupon_discount) && $coupon_discount) { ?>
                                                                 <tr>
                                                               <td>Coupon Discount (<?php echo $coupon_code ?>):</td>
                                                               <td class="text-end">
                                                                $<?php echo number_format($coupon_discount ?? 0, 2); ?>(<?php echo $discountSign; ?>)
                                                                </td>
                                                                </tr>
                                                                <?php } ?>
                                                                
                                                                <?php if(isset($orderData['late_fee']) && $orderData['late_fee'] !='') {  ?>
                                                                 <tr>
                                                               <td>Late Fee :</td>
                                                               <td class="text-end">
                                                                $<?php echo number_format($orderData['late_fee'] ?? 0, 2); ?>
                                                                </td>
                                                                </tr>
                                                                <?php } ?>
                                                                

                                                                <tr class="border-top border-top-dashed">
                                                                    <th scope="row">Total (Inc GST):</th>
                                                                    <th class="text-end">$<?php echo number_format($grandTotal,2); ?></th>
                                                                </tr>
                                                                <?php $gst = $grandTotal/11; ?>
                                                                <tr>
                                                                    <td>GST :</td>
                                                                    <td class="text-end">$<?php echo number_format($gst,2); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                        <tr class="border-top border-top-dashed ">
                                                    <td colspan="3" class="fw-bold">Order Comments</td>
                                                    <td colspan="2" class="fw-medium p-0"><?php echo $orderData['order_comments'] ?></td>
                                                    </tr>
                                          
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
            </div>
                           
                        </div>
                        <!--end col-->
                        <div class="col-xl-3">
                          
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <h5 class="card-title flex-grow-1 mb-0"><i class=" ri-cake-3-line align-middle me-1 text-muted"></i> Order Details</h5>
                                       
                                    </div>
                                </div>
                                <div class="card-body">
                                   
                                        
                                        <span><i class="ri-user-3-line me-2 align-middle text-muted fs-16"></i><?php echo $orderData['firstname'].' '.$orderData['lastname'] ?></span></br>
                                        <span><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i><?php echo $orderData['accounts_email']; ?></span></br>
                                        <span><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i><?php echo $orderData['delivery_contact']; ?></span></br>
                                        <span><i class="ri-calendar-event-line me-2 align-middle text-muted fs-16"></i><?php echo "Order Date :  ".date('d/m/Y',strtotime($orderData['date_added'])); ?></span>
                                      
                                  
                                </div>
                            </div>
                           
                            <!--end card-->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Delivery Details</h5>
                                </div>
                                <div class="card-body">
                                     <h6 class="mt-2">Delivery Date & Time</h6>
                                    <?php echo date('l, jS F, Y',strtotime($orderData['delivery_date'])); ?>
                                    <?php echo $orderData['delivery_time']; ?>
                                    <h6 class="mt-2">Company Details</h6>
                                    <?php echo "Company : ". $orderData['company_name'] ?></br>
                                     <?php echo "Department : ". $orderData['department_name'] ?>
                                     <h6 class="mt-2">Delivery Addrees</h6>
                                    <?php echo $orderData['delivery_address'] ?>
                                    <h6 class="mt-2">Delivery Notes</h6>
                                    <?php echo nl2br($orderData['delivery_notes']); ?>
                                   
                                </div>
                            </div>
                            <!--end card-->

                        </div>
                        <!--end col-->
                    </div>
   
</div>
</div>
</div>

<script>
   $(document).ready(function() {
    $('.submit').click(function(event) {
        event.preventDefault();
       
        $(this).html("Updating...")
       let orderStatus = $(this).data('orderstatus');
        let formData = $('#approval_form').serializeArray();
        formData.push({ name: 'status', value: orderStatus });

        $.ajax({
            url: '<?php echo base_url("updateExternalOrderStatus"); ?>',
            method: 'POST',
            data: $.param(formData),
            success: function(response) {
                // Handle success response
                alert('Order status updated successfully');
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('Error: ' + xhr.responseText);
                // Optionally, handle error and update the UI accordingly
            }
        });
    });
});
  </script>