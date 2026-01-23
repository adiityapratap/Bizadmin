
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
 <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0 text-black">Order #<?php echo $orderData['order_id'] ?></h5>
                                        <input type="hidden" id="order_id" value="<?php echo $orderData['order_id'] ?>">
                                       <input type="hidden" id="customer_name" value="<?php echo $orderData['firstname'] ?>">
                                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                                        <a class="btn btn-sm btn-dark me-2" onclick="window.history.back();"><i class="ri-arrow-go-back-line me-1"></i> Back</a>    
                                         <?php if(isset($orderData['is_quote']) && $orderData['is_quote'] == 1){ ?>
                                        <a href="javasccript:void(0;)" class="btn btn-soft-success btn-sm mt-2 mt-sm-0" onclick="open_modal('quoteApproval')"><i class="ri-mail-line align-middle me-1"></i>Send Approve Email</a>    
                                        <?php } else {  ?>    
                                        <a href="<?php echo base_url('collectPayment/'.$orderData['order_id']); ?>" class="btn btn-primary btn-sm mt-2 mt-sm-0"><i class=" ri-money-dollar-circle-line align-middle me-1"></i>Payment</a>
                                        <a href="#" onclick="open_modal('sendInvoice')" class="btn bgView btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Send Invoice</a>
                                        <a href="#" onclick="open_modal('sendPaymentLink')" class="btn bgEdit btn-sm mt-2 mt-sm-0"><i class="ri-bank-card-fill align-middle me-1"></i> Send Payment Link</a>
                                        <a href="<?php echo htmlspecialchars(base_url('downloadInvoice/'.$orderData['order_id']), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success btn-sm">
                                         <i class="ri-download-2-fill align-middle me-1"></i>Download Invoice
                                          </a>
                                        <?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-borderless mb-0">
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
                                                                <?php if($discountSign == '%') {  ?>
                                                                <?php echo number_format($coupon_discount ?? 0, 0); ?>(<?php echo $discountSign; ?>) 
                                                                <?php }else {   ?>
                                                                $<?php echo number_format($coupon_discount ?? 0, 2); ?>
                                                                <?php }  ?>
                                                               
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
                                                    <td  class="fw-bold">Order Comments :</td>
                                                    <td colspan="1" class="fw-medium p-0 text-black"><?php echo $orderData['order_comments'] ?></td>
                                                    </tr>
                                        <tr class="border-top border-top-dashed ">
                                                    <td class="fw-bold">Company Name : </td>
                                                    <td ><?php echo $settingsData[0]['company_name'] ?></td>
                                                     <td class="fw-bold">Company ABN : </td>
                                                    <td><?php echo $settingsData[0]['abn'] ?></td>
                                                    <!--<td class="fw-bold">BSB : </td>-->
                                                    <!--<td><?php echo $settingsData[0]['bsb'] ?></td>-->
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
                                        <h5 class="card-title flex-grow-1 mb-0 text-black"><i class=" ri-cake-3-line align-middle me-1 text-muted"></i> Order Details</h5>
                                        <div class="flex-shrink-0">
                                            <a href="<?php echo base_url('/Catering/customerList') ?>" class="link-secondary">View Customer</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                   
                                        
                                        <span><i class="ri-user-3-line me-2 align-middle text-muted fs-16"></i><?php echo $orderData['firstname'].' '.$orderData['lastname'] ?></span></br>
                                        <span><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i><?php echo $orderData['accounts_email']; ?></span></br>
                                        <span><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i><?php echo $orderData['delivery_contact']; ?></span></br>
                                        <span><i class="ri-calendar-event-line me-2 align-middle text-muted fs-16"></i><?php echo "Order Date :  ".date('d/m/Y',strtotime($orderData['date_added'])); ?></span></br>
                                       <span class="text-danger fw-semibold"><i class="ri-message-line me-2 align-middle text-danger fs-16"></i><?php echo "Approval Comments :  ".$orderData['approval_comments']; ?></span>
                                  
                                </div>
                            </div>
                           
                            <!--end card-->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-black"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Delivery Details</h5>
                                </div>
                                <div class="card-body">
                                     <h6 class="mt-2 text-black">Delivery Date & Time</h6>
                                    <?php echo date('l, jS F, Y',strtotime($orderData['delivery_date'])); ?>
                                    <?php echo $orderData['delivery_time']; ?>
                                    <h6 class="mt-2 text-black">Company Details</h6>
                                    <?php echo "Company : ". $orderData['company_name'] ?></br>
                                     <?php echo "Department : ". $orderData['department_name'] ?>
                                     <?php if($orderData['cost_center'] !='') { ?>
                                     <h6 class="mt-2 text-black">Cost Center : <?php echo $orderData['cost_center'] ?></h6>
                                     
                                     <?php } ?>
                                   
                                     <h6 class="mt-2 text-black">Delivery Addrees</h6>
                                    <?php echo $orderData['delivery_address'] ?>
                                    <h6 class="mt-2 text-black">Delivery Notes</h6>
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
    <div class="modal fade" id="email_modal" tabindex="-1" aria-labelledby="email_modal_title" aria-hidden="true">                
   
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-black" id="email_modal_title">Email</h5>
					 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-auto">
							Please enter the email ID to send to:
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<input type="email" class="form-control" id="email" value="<?php echo $orderData['accounts_email']; ?>"><div class="invalid-feedback">Please enter an email address!</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				  <input type="hidden" id="emailType" value="">
					<button type="button" onclick="sendEmail()" class="btn btn-primary buttonContent">
						Send Mail
					</button>
				</div>
			</div>
		</div>
	</div>                
   


<script>
      function open_modal(emailType)
	  {  
        $("#email_modal").modal('show');
        $("#emailType").val(emailType);
	 }
		function sendEmail(){
		 let emailType = $("#emailType").val();   
		 if(emailType =='quoteApproval'){
		     sendQuoteApprovalEmail()
		 }
		 if(emailType =='sendPaymentLink'){
		     sendPaymentLink();
		 }
		 if(emailType =='sendInvoice'){
		     sendInvoice();
		 }
		}
		
	function sendQuoteApprovalEmail()
	{
		    $(".buttonContent").html('<i class="fa fa-spinner fa-spin"></i>In progress...');
			$("#email").removeClass('is-invalid');
			if($.trim($("#email").val())=='')
			{
				$("#email").addClass('is-invalid');
				return false;
			}
			$.ajax({
			  url: '<?php echo base_url("/Catering/send_quote_email/"); ?>' + $("#order_id").val(),
				method:"POST",
				data:{
                    "ajaxCall":true,
					"email":$("#email").val(),
                    "firstname": $("#customer_name").val(),

				  },
				complete:function(){
				 $(".buttonContent").html('Mail Sent');
				 $("#email_modal").modal('hide');
				}
			})
		}
		
	function sendPaymentLink(){
	    if($.trim($("#email").val())==''){
	     alert("Please enter email");
		   return false;
			}
		$(".buttonContent").html("Sending...");	
        	$.ajax({
    url: '<?php echo base_url("/Catering/sendPaymentLink/"); ?>',
    method: "POST",
    data: {
        email: $("#email").val(),
        order_id: $("#order_id").val(),
        customer_name: $("#customer_name").val()
    },
    complete: function() {
        $(".buttonContent").html('Mail Sent');
        $("#email_modal").modal('hide');
    }
});
  
	}
	
	function sendInvoice(){
	    if($.trim($("#email").val())==''){
	     alert("Please enter email");
		   return false;
			}
		$(".buttonContent").html("Sending...");	
        	$.ajax({
           url: '<?php echo base_url("/Catering/sendInvoice/"); ?>',
           method: "POST",
           data: {
           email: $("#email").val(),
           order_id: $("#order_id").val(),
           customer_name: $("#customer_name").val()
         },
    complete: function() {
        $(".buttonContent").html('Mail Sent');
        $("#email_modal").modal('hide');
    }
});
  
	}
  </script>