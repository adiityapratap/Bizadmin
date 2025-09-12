<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div class="row">
    <div class="col">
        <!-- breadcrumb -->
        
       <?php if(isset($editOrderId) && $editOrderId !='') { ?>
       <form action="<?php echo base_url('Catering/edit_quote_products') ?>" method="POST" id="new_order_form" novalidate>
        <input type="hidden" name="editOrderId" value="<?php echo $editOrderId; ?>" />
       <?php }else{ ?>
       <form action="<?php echo base_url('Catering/new_quote_products') ?>" method="POST" id="new_order_form" novalidate>
       <?php } ?>
		<div class="row mb-4">
						<!--Report widget start-->
						<div class="col-lg-6 col-sm-12 col-12 mb-4">
							<div class="card card-shadow">
							<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0 text-black">Select Products</h5>
    <button class="btn btnAdd d-flex align-items-center gap-2 btn-sm btn-success" type="button" data-bs-toggle="modal" data-bs-target="#newProductModal">
        <i class="ri-cup-line fs-16"></i> New Product
    </button>
</div>

								<div class="card-body">
									<div class="row">
										
										<div class="col-12">
											<div class="row">
												<div class="col-12 col-md-9 mb-3">
														<input type="text" class="form-control" id="search" placeholder="Search for products">
													</div>
												</div>
											</div>
										</div>
										<div class="row mt-2">
											<div class="col-12">
												<div class="table-responsive">
													<table class="table table-striped table-sm ">
														<thead class="table-light">
															<tr>
																<th>Product Name</th>
																<th>Category</th>
																<th>Price</th>
																<th>Quantity</th>
																<th>Add</th>
															</tr>
														</thead>
	<tbody id="products_list">
	<?php if(!empty($products)){
															
foreach ($products as $product) {
   

    echo "<input type=\"hidden\" id=\"price-{$product['product_id']}\" value=\"{$product['product_price']}\">";

    echo "<tr id=\"product-row-{$product['product_id']}\">";
    echo "<td>{$product['product_name']}</td>";
   echo "<td>" . ucwords($product['category_name'] ?? '') . "</td>";
    echo "<td>$" . number_format($product['product_price'], 2,'.',',') . "</td>";
    echo "<td>";
    echo "<input class=\"form-control\" type=\"text\" id=\"qty-{$product['product_id']}\" placeholder=\"0\">";
    echo "</td>";
    echo "<td>";
    echo "<button type=\"button\" class=\"btn btn-success new-product-form\" id=\"new-product-{$product['product_id']}\"><i class='ri-shopping-cart-2-line'></i></button>";
    echo "</td>";
    echo "</tr>";
}
}?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										
									
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12 mb-4">
								<div class="card card-shadow">
									<div class="card-header">
									</div>
									<div class="card-body">
								        <div class="table-responsive">
    										<table class="table table-striped table-sm mt-2 grid">
    											<thead class="table-light">
    												<tr>
    													<th>Product</th>
    													<th>Quantity</th>
    													<th>Total</th>
    													<th>Product Comment</th>
    												</tr>
    											</thead>
    											<tbody>
    											
    		<?php  if(isset($order_products) && !empty($order_products)) { ?>
    		<?php foreach ($order_products as $order_product){ ?>
            <tr data-product-id="<?php echo $order_product['product_id']; ?>" id="cart-product-<?php echo $order_product['product_id']; ?>">
                <td><?php echo htmlspecialchars($order_product['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($order_product['quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>$<?php echo number_format($order_product['total'], 2,'.',''); ?></td>
                <td>
                    <p>  <input type="hidden" name="qty[<?php echo $order_product['product_id']; ?>]" value="<?php echo $order_product['quantity']; ?>" id="hidden-product-<?php echo $order_product['product_id']; ?>">
                        <input type="hidden" class="form-control" name="product_price[<?php echo $order_product['product_id']; ?>]" value="<?php echo htmlspecialchars($order_product['price'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="text" class="form-control" name="order_product_comment[<?php echo $order_product['product_id']; ?>]" value="<?php echo htmlspecialchars($order_product['order_product_comment'], ENT_QUOTES, 'UTF-8'); ?>">
                    </p>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="remove_product_from_cart(<?php echo $order_product['product_id']; ?>)">
                        <i class="ri-delete-bin-5-line"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>
 <tr id="coupon_id">
  <td>Coupon Code</td>
  <td colspan="3">
    <div class="d-flex align-items-center">
      <input type="text" class="form-control me-2" id="coupon_code" value="<?php echo $coupon_code ?? ''; ?>" name="coupon_code" data-discount="0" data-type="F">
      <button type="button" class="btn btn-sm btn-success me-2">Apply</button>
        <button type="button" class="btn btn-sm btn-danger" onclick="removeCoupon(<?php echo $editOrderId ?>)">Remove</button>
      
    </div>
    <div class="invalid-feedback">Invalid coupon code!</div>
  </td>
</tr>
                               <?php if($delivery_fee) {  ?>
	                            <tr>
    							<td>Delivery fee</td>
    							<td colspan="3">$<?php echo number_format($delivery_fee,2); ?></td>
    							</tr>
    							<?php } ?>
    							<tr>
    							<td>Total</td>
    						    <input type="hidden" class="cart_total" name="cart_total" value="">
    							<td colspan="3" id="total-cart"></td>
    							</tr>
    							<tr>
    							<td>Order Comments</td>
    						    <td colspan="3"><input type="text" class="form-control" name="order_comments"></td>
    							</tr>
    												
    	<tr id="submit-button-row">
    <td colspan="2" class="text-end">
        <?php if(isset($editOrderId) && $editOrderId !='') { ?>
    <div class="d-inline-flex">
            <button type="submit" class="btn btn-info submit-button d-flex align-items-center me-2" name="save">
                <i class="ri-shopping-basket-line me-2"></i> Update
            </button>
            
        </div>    
        <?php }else{ ?>
      <div class="d-inline-flex">
            <button type="submit" class="btn btnGrey submit-button d-flex align-items-center me-2 btn-success" disabled name="save">
                <i class="ri-shopping-basket-line me-2 "></i> Save
            </button>
            <button type="button" class="btn btn-dark submit-button d-flex align-items-center" onclick="openApproveMail_modal()" disabled>
                Send to Customer <i class="ri-mail-send-line ms-2"></i>
            </button>
        </div>    
        <?php } ?>
        
    </td>
</tr>




    											
    											</tbody>
    										</table>
									    </div>
									</div>
								</div>
								
										
							</div>
							<!--Report widget end-->
						</div>
		<input type="hidden" name="coupon_id" id="applied_coupon_id" value="<?php echo $coupon_id ?? ''; ?>" >	
		<input type="hidden" id="delivery_fee" value="<?php echo $delivery_fee ?? ''; ?>">
	    <input type="hidden" name="saveAndSend" id="saveAndSend" value="">
    	<input type="hidden" name="customerOrderEmailToSendApprovalMail" id="customerOrderEmailToSendApprovalMail">
    	</form>
          </div>
        </div>
        
          </div>
        </div>
          </div>
        
       <div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="product-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product-modal-title">New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="new_product">
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label" >Product Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="new-product-name" name="product_name" placeholder="New Product" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Product Price</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="new-product-price" name="product_price" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Quantity to add</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="new-product-qty" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btnAdd loadingBtn btn-success" id="product_add" onclick="add_new_product_to_cart(this)">Add</button>
            </div>
        </div>
    </div>
    <div id="loading" style="display:none;">
        <p><img style="height: 30px; width: 304px;" src="<?php echo base_url();?>assets/images/ajax-loader.gif" /></p>
    </div>
</div>
		<div class="modal fade" id="email_modal" tabindex="-1" role="dialog" aria-labelledby="email_modal_title">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="email_modal_title">Email</h5>
					<button type="button" class="btn-close btn-danger btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-auto">
							Please enter the email ID to send to:
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<input type="email" class="form-control" id="customerOrderEmail" value="<?php echo $customer_order_email;?>"><div class="invalid-feedback">Please enter an email address!</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				
					<button type="button" onclick="send_mailAndSubmitForm()" class="btn btnAdd buttonContent btn-sm btn-success">
						Send Mail
					</button>
				</div>
			</div>
		</div>
	</div>	
	
		<script>
		
    
		 $('.grid tbody').sortable({
         axis: 'y',
         update: function (event, ui) {
         let sortedIDs = $(this).sortable('toArray', { attribute: 'data-product-id' });
         let $hiddenFieldsContainer = $('#new_order_form');
         console.log("sortedIDs",sortedIDs)
         $.each(sortedIDs, function(index, productId) {
                var $hiddenField = $('#hidden-product-' + productId);
                $hiddenFieldsContainer.append($hiddenField);
            });
            
        var data = $(this).sortable('serialize');
        // var data = data.replace("cart-product", "cart-existing-item");
         $.ajax({
		 url:"<?php echo base_url('Catering/chnage_product_sort_order');?>",
		 method:"POST",
		 data:data,
		 success:function(data){
		 console.log("position saved");
		}
		})
    }
});	
      

		 function openApproveMail_modal()
		{   
			$("#email_modal").modal('show');
		}
		function send_mailAndSubmitForm(){
		    // when creating quote manager has 2 option either send mail to customer directly or just save the quote, in case of sendmail to customer this code is executed
		    $(".buttonContent").html('Sending...')
		    $("#saveAndSend").val('true');
		    $("#customerOrderEmailToSendApprovalMail").val($("#customerOrderEmail").val());
		    $("#new_order_form").submit();
		}
		
			$(function(){
				var base_item_price=0;
				var base_item_id=0;
				var base_item_name='';
				opt_required=0;
				category_map=<?php echo json_encode($categories);?>;
			
				rebind_submit();
				
			
				calculate_total();
			})
			function calculate_total()
			{
				let total=0.0;
				if($("[id*='cart-product-']").length!=0){
					$("[id*='cart-product-']").each(function(){
						if($.trim($(this).find('td:nth-child(3)').html())!='')
						{
							let val=parseFloat($(this).find('td:nth-child(3)').html().split('$')[1]);
							console.log("val 323",val);
							if($(this).find('td:nth-child(3)').html().split('$')[0]=='-')
								total-=val;
							else 
								total+=val;
						}
					})
				}
				console.log("total",total);
				$(".cart_total").val(total.toFixed(2));
					//Coupon exists too, factor in to total
					if($("#coupon_code").data('type')=='F')
					{
						total=total-parseFloat($("#coupon_code").data('discount'));
						console.log(parseFloat($("#coupon_code").data('discount')));
					}
					else{
						discount=total*parseFloat($("#coupon_code").data('discount'))/100;
						total=total-discount;
						console.log(discount);
					}
				let delivery_fee = parseFloat($("#delivery_fee").val());
				total = total + delivery_fee;
				$("#total-cart").html('$'+total.toFixed(2));
				
			}
			
			function rebind_submit()
			{
				
				$("body").on('click','.new-product-form',function(e){
					let id=$(this).prop('id');
					console.log("id= "+id);
					let prod_id=id.split('-')[2];
					
					$("#qty-"+prod_id).removeClass('is-invalid');
					let qty=parseInt($("#qty-"+prod_id).val());
				
					if(qty<=0||isNaN(qty)){
						$("#qty-"+prod_id).addClass('is-invalid');
						return false;
					}
					let prod_name=$("#product-row-"+prod_id).find('td').first().html();
				
					let price=parseFloat($("#price-"+prod_id).val());
					let total=qty*price;
					//Check if product is already added; If it is, update quantity and total
					if($("#cart-product-"+prod_id).length!=0){
						//Product already in cart
						let prod_total=parseFloat($("#cart-product-"+prod_id).find('td:nth-child(3)').html().split('$')[1]);
						let old_qty=parseInt($("#cart-product-"+prod_id).find('td:nth-child(2)').html());
						let new_total=total+prod_total;
						let new_qty=qty+old_qty;
						qty=new_qty;
						$("#cart-product-"+prod_id).find('td:nth-child(2)').html(new_qty);
						$("#cart-product-"+prod_id).find('td:nth-child(3)').html('$'+new_total.toFixed(2));
					}
					else{
	       $("#coupon_id").before("<tr data-product-id="+prod_id+" id=\"cart-product-" + prod_id + "\"><td>" + prod_name + "</td><td>" + qty + "</td><td>$" + total.toFixed(2) + "</td><td><p><input type=\"hidden\" class=\"form-control\" name=\"product_price[" + prod_id + "]\" value=\"" + price + "\"><input type=\"text\" class=\"form-control\" name=\"order_product_comment[" + prod_id + "]\"></p></td><td><button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"remove_product_from_cart(" + prod_id + ")\"><i class='ri-delete-bin-5-line'></i></button></td></tr>");
					}
					$("#qty-"+prod_id).val('');
					//Add the product and qty as input type="hidden" fields
					$("#new_order_form").append("<input type=\"hidden\" name=\"qty["+prod_id+"]\" value=\""+qty+"\" id=\"hidden-product-"+prod_id+"\">");
					//Remove disabled if one value is entered
					$(".submit-button").prop('disabled',false);
					calculate_total();
				})
			}
			$("#search").on('keyup', function() {
             let searchTerm = $(this).val().toLowerCase();
              $("#products_list tr").each(function() {
            let productName = $(this).find("td:first").text().toLowerCase();
            if (productName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
	function remove_product_from_cart(prod_id){
		prod_id=prod_id.toString();
		if(prod_id.indexOf("_")==-1)
		{
			//If it is parent, remove options too
			prod_id=prod_id.split("_")[0];
			$("[id^='hidden-product-"+prod_id+"']").each(function(){$(this).remove()});
			$("[id^='cart-product-"+prod_id+"']").each(function(){$(this).remove()});
		}
		//Check if it has a parent product which is not a base qty
		if(prod_id.indexOf("_")!=-1&&prod_id.indexOf('_base_qty')==-1){
			//It is a child product without a parent in display
			//Find the parent and update qty to current-deletedQty
			parent_prod_id=prod_id.split("_")[0];
			current_val=$("#hidden-product-"+parent_prod_id).val();
			deleted_val=$("#hidden-product-"+prod_id).val();
			$("#hidden-product-"+parent_prod_id).val(current_val-deleted_val);
		}
		console.log("prod_id",prod_id)
		//Finally, rmeove the options themselves
		$("#hidden-product-"+prod_id).remove();
		$("#cart-product-"+prod_id).remove();
		calculate_total();
	}
		
	function add_new_product_to_cart(obj){
	             let btnObj = obj;
			     $(obj).html("Adding...");
				//Add new product to db
				$("#new-product-qty").removeClass('is-invalid');
				var qty=parseInt($("#new-product-qty").val());
			
				if(qty==0||isNaN(qty)){
					$("#new-product-qty").addClass('is-invalid');
					return false;
				}
				else{
					$.ajax({
						url:'new_product',
						method:"POST",
						data:$("#new_product").serialize(),
						success:function(prod_id){
						    
							let qty=parseInt($("#new-product-qty").val());
							let prod_name=$("#new-product-name").val();
							let price=$("#new-product-price").val();
							let total=qty*price;
							//Check if product is already added; If it is, update quantity and total
							$("#coupon_id").before("<tr data-product-id="+prod_id+" id=\"cart-product-"+prod_id+"\"><td>"+prod_name+"</td><td>"+qty+"</td><td>$"+total.toFixed(2)+"</td><td><p><input type=\"hidden\" class=\"form-control\" name=\"product_price[" + prod_id + "]\" value=\"" + price + "\"><input type=\"text\" class=\"form-control\" name=\"order_product_comment["+prod_id+"]\"></p></td><td><button type=\"button\" class=\"btn btn-danger\" onclick=\"remove_product_from_cart('"+prod_id+"')\"><i class='ri-delete-bin-5-line'></i></button></td></tr>");
							$("#new_order_form").append("<input type=\"hidden\" name=\"qty["+prod_id+"]\" value=\""+qty+"\" id=\"hidden-product-"+prod_id+"\">");
							//Remove disabled if one value is entered
							$(".submit-button").prop('disabled',false);
							$("#newProductModal").modal('hide');
							$("#new_product").trigger('reset');
							$(obj).html("Add");
							let newRowHtml = '<tr id="product-row-' + prod_id + '" data-heading="">';
        newRowHtml += '<td>' + prod_name + '</td>';
        newRowHtml += '<td></td>'; // Category name, can be left blank for now
        newRowHtml += '<td>$' + parseFloat(price).toFixed(2) + '</td>';
        newRowHtml += '<td><input class="form-control" type="text" id="qty-' + prod_id + '" placeholder="0"></td>';
        newRowHtml += '<td><button type="button" class="btn btn-success new-product-form" id="new-product-' + prod_id + '"><i class="ri-shopping-cart-2-line"></i></button></td>';
        newRowHtml += '</tr>';

        // Insert the new row with price input before the existing products_list tbody
        $("#products_list").prepend(newRowHtml);

        // Also append the hidden input for price
        $("#product-row-" + prod_id).prepend('<input type="hidden" id="price-' + prod_id + '" value="' + parseFloat(price).toFixed(2) + '">');

							
						},
						complete:function(data){
   
                         $("#loading").hide();
                         $(".loader_backkground").css('opacity','1');
                         $("#product_add").attr("disabled", false);
                             }
					})
				}
				calculate_total();
			}
			
	$(document).ready(function() {
    var $couponCode = $("#coupon_code");
    var $loader = $("#loading");
   

    // Event to detect click outside the coupon code input field
    $(document).on('click', function(event) {
        if (!$(event.target).closest($couponCode).length) {
            if ($couponCode.val() !== '') {
                // Show loader
                $loader.show();
                // Perform AJAX request
                let coupon_code = $couponCode.val();
                $couponCode.removeClass('is-invalid');
                console.log("VALLL c",$("#coupon_code").val())
                $.ajax({
                    url: '<?php echo base_url("Catering/validateCoupon/"); ?>' + coupon_code,
                    method: "POST",
                    success: function(data) {
                        console.log('AJAX Response:', data);

                        if (data == "0") {
                            $couponCode.addClass('is-invalid');
                            $couponCode.data('discount', 0);
                            $couponCode.data('type', 'F');
                            $("#applied_coupon_id").val('')
                        } else {
                            $couponCode.removeClass('is-invalid');
                            data = JSON.parse(data);
                            $couponCode.data('discount', data[0].coupon_discount);
                            $couponCode.data('type', data[0].type);
                            $("#applied_coupon_id").val(data[0].coupon_id)
                            console.log('Coupon Data:', data[0]);
                        }

                        // Hide loader after response is received
                        $loader.hide();

                        // Call to recalculate total after setting discount and type
                        calculate_total();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);

                        // Hide loader if an error occurs
                        $loader.hide();
                    }
                });
            }else{
                $couponCode.data('discount', 0);
                $couponCode.data('type', 'F');
                $("#applied_coupon_id").val('')
                
                calculate_total();
            }
        }
    });

    // Prevent triggering outside click event when clicking inside the input
    $couponCode.on('click', function(event) {
        event.stopPropagation();
    });
});

function removeCoupon(orderId){
    $couponCode = $("#coupon_code");
      
      $("#applied_coupon_id").val('');
      $couponCode.val('');
      $couponCode.data('discount', 0);
      $couponCode.data('type', 'F');
      $("#applied_coupon_id").val('')
                
      calculate_total();
     $.ajax({
     url: '<?php echo base_url("Catering/removeCoupon/"); ?>' + orderId,
     method: "POST",
     success: function(data) {
      
      },
     error: function(xhr, status, error) {
     console.error('AJAX Error:', error);
        }
       });
    
    }
		
			
			</script>
