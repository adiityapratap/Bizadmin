
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
	<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card card-shadow mb-4">
							<div class="card-header">
								<h3 class="card-title">COMMUNICATION WITH THE CUSTOMER</h3>
								<div style="width:200px; float:right; display:flex">
								    <a onclick="display_checlist_info()" class="btn btn-primary btn-sm me-2" target="_blank">Checklist Info</a>
								   	<a target="_blank" href="<?php echo base_url('edit_quote/'.$order_id); ?>" class="btn btn-success btn-sm">Edit Order</a>
								</div>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url('submitCateringCheckList');?>" method="post">
								    <input type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : ''; ?>">
								  
								    <table class="table table-stripped catering_checklist_table">
								        <tr>
								            <th colspan="2">CATERING ORDER IS FIRST RECEIVED - CALL PERSON WHO PLACED ORDER  TO CONFIRM</th>
								            <th></th>
								        </tr>
								        <tr>
								            <td colspan="2">Location</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['catering_location']) && $catering_checkList[0]['catering_location']){ echo "checked"; } ?> name="catering_location"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Time</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['catering_time']) && $catering_checkList[0]['catering_time']){ echo "checked"; } ?> name="catering_time"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">How many people </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['catering_people']) && $catering_checkList[0]['catering_people']){ echo "checked"; } ?> name="catering_people"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Delivery instructions -Eg Enter gate 4, left uphill etc</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['catering_delivery_instructions']) && $catering_checkList[0]['catering_delivery_instructions']){ echo "checked"; } ?> name="catering_delivery_instructions"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Confirm all dietary requirements</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['catering_dietary_req']) && $catering_checkList[0]['catering_dietary_req']){ echo "checked"; } ?> name="catering_dietary_req"><span class="control__indicator"></span></label></td>
								        </tr>
								        <!--next question-->
								        <tr>
								            <th colspan="2">DAY BEFORE DELIVERY - CALL PERSON WHO PLACED THE ORDER TO CONFIRM</th>
								            <th></th>
								        </tr>
								        <tr>
								            <td colspan="2">Location</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['day_before_location']) && $catering_checkList[0]['day_before_location']){ echo "checked"; } ?> name="day_before_location"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Time</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['day_before_time']) && $catering_checkList[0]['day_before_time']){ echo "checked"; } ?> name="day_before_time"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">How many people </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['day_before_people']) && $catering_checkList[0]['day_before_people']){ echo "checked"; } ?> name="day_before_people"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Delivery instructions -Eg Enter gate 4, left uphill etc</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['day_before_delivery_instructions']) && $catering_checkList[0]['day_before_delivery_instructions']){ echo "checked"; } ?> name="day_before_delivery_instructions"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Confirm all dietary requirements</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['day_before_dietary_req']) && $catering_checkList[0]['day_before_dietary_req']){ echo "checked"; } ?> name="day_before_dietary_req"><span class="control__indicator"></span></label></td>
								        </tr>
								            <!--next question-->
								        <tr>
								            <th colspan="2">DAY OF DELIVERY</th>
								            <th></th>
								        </tr>
								        <tr>
								            <td colspan="2">Double check everything on catering form before going to deliver.</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_check_everything']) && $catering_checkList[0]['delivery_day_check_everything']){ echo "checked"; } ?> name="delivery_day_check_everything"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Cutlery, Napkins, Tongs etc.  </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_others']) && $catering_checkList[0]['delivery_day_others']){ echo "checked"; } ?> name="delivery_day_others"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Cups</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_cups']) && $catering_checkList[0]['delivery_day_cups']){ echo "checked"; } ?> name="delivery_day_cups"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Coffee / Tea Supplies </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_coffee']) && $catering_checkList[0]['delivery_day_coffee']){ echo "checked"; } ?> name="delivery_day_coffee"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Sugar / Honey / Milk</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_sugar']) && $catering_checkList[0]['delivery_day_sugar']){ echo "checked"; } ?> name="delivery_day_sugar"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Plates</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_plates']) && $catering_checkList[0]['delivery_day_plates']){ echo "checked"; } ?> name="delivery_day_plates"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Serving Bowls / Trays </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_serving']) && $catering_checkList[0]['delivery_day_serving']){ echo "checked"; } ?> name="delivery_day_serving"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Signs – Gluten free, Dairy Free Etc. </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_signs']) && $catering_checkList[0]['delivery_day_signs']){ echo "checked"; } ?> name="delivery_day_signs"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Hot / Cold Holding </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_hot_cold']) && $catering_checkList[0]['delivery_day_hot_cold']){ echo "checked"; } ?> name="delivery_day_hot_cold"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Safety Pins </td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['delivery_day_safety']) && $catering_checkList[0]['delivery_day_safety']){ echo "checked"; } ?> name="delivery_day_safety"><span class="control__indicator"></span></label></td>
								        </tr>
								            <!--next question-->
								        <tr>
								            <th colspan="2">DELIVERING THE ORDER</th>
								            <th></th>
								        </tr>
								        <tr>
								            <td colspan="2">Double check that you are leaving with the right order.</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['right_order']) && $catering_checkList[0]['right_order']){ echo "checked"; } ?> name="right_order"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">When you arrive, greet and introduce yourself to the host.</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['greet_host']) && $catering_checkList[0]['greet_host']){ echo "checked"; } ?> name="greet_host"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Ask them to take you to the area where you will be setting up.</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['area_setup']) && $catering_checkList[0]['area_setup']){ echo "checked"; } ?> name="area_setup"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Introduce yourself to the service staff, let them know you are delivering for “COMPANY NAME”, in case they have any questions.</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['intro_service_staff']) && $catering_checkList[0]['intro_service_staff']){ echo "checked"; } ?> name="intro_service_staff"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Set up order based on customers specifications, refer to contract</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['setup_order']) && $catering_checkList[0]['setup_order']){ echo "checked"; } ?> name="setup_order"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Make sure to cover everything in the checklist and final touchups, e.g. flowers</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['final_touchups']) && $catering_checkList[0]['final_touchups']){ echo "checked"; } ?> name="final_touchups"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Remind them you are only delivering, if they have any questions, please direct them to “Manager Name”</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['remind_delivery_only']) && $catering_checkList[0]['remind_delivery_only']){ echo "checked"; } ?> name="remind_delivery_only"><span class="control__indicator"></span></label></td>
								        </tr>
								        <tr>
								            <td colspan="2">Wish them a great day and thank them for their business.</td>
								            <td><label class="control control-solid control-solid-info control--checkbox"><input type="checkbox" value="1" <?php if(isset($catering_checkList[0]['wish_them']) && $catering_checkList[0]['wish_them']){ echo "checked"; } ?> name="wish_them"><span class="control__indicator"></span></label></td>
								        </tr>
								    </table>
								    <button class="btn btn-primary" type="submit">Save Checklist</button>
								</form>
							</div>
						</div>
					</div>
					<!--Report widget end-->
				</div>
<div class="modal fade" id="checklist_info_modal"  tabindex="-1" role="dialog" aria-labelledby="email_modal_title">
		<div class="modal-dialog" role="document" style="max-width:1000px">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="email_modal_title">Order Checklist Info</h5>
				 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
		    	<table class="table table-bordered orderviewtable" style="font-size:18px;">
									<tr>
										<td colspan="2" width="50%">
											<strong class="mr-2">Order ID: </strong><?php echo $order_info['order_id'];?><br>
											<strong class="mr-2">Delivery: </strong><?php echo date('g:i A, l - d M Y',strtotime($order_info['delivery_date']));?><br>
										
										</td>
										<td colspan="2" width="50%">
											<strong class="mr-2">Name: </strong><?php echo $order_info['fullname'];?><br>
											<strong class="mr-2">Email: </strong><?php echo $order_info['customer_email'];?><br>
											<strong class="mr-2">Phone: </strong>
											<?php if(isset($order_info['customer_telephone']) && $order_info['customer_telephone'] !='') {
											    $phone = $order_info['customer_telephone'];
											    echo $order_info['customer_telephone'];
											}
											?><br><hr>
											<strong class="mr-2">Delivery Notes: </strong><?php echo $order_info['delivery_notes'];?><br>
											<strong class="mr-2">Delivery Contact: </strong>
											<?php if(isset($order_info['delivery_contact']) && $order_info['delivery_contact'] !='') {
											    $phone = $order_info['delivery_contact'];
											echo $order_info['delivery_contact'];
											}
											?><br>
											<strong class="mr-2">Shipping Method: </strong><?php echo $order_info['shipping_method']==1?"Delivery":"Pickup";?>
										</td>
									</tr>
									<thead>
										<tr>
											<?php if ($order_info['company_name'] === ''): ?>
											<th colspan="2" width="50%">Company Information</th>
											<th colspan="2" width="50%">Delivery/Pickup Address</th>
											<?php endif; ?>
										   <th colspan="2" width="50%">Company Information</th>
											<th colspan="2" width="50%">Delivery/Pickup Address</th>
										</tr>
									</thead>
									<tr>
										<td colspan="2">
									
											<?php echo $order_info['company_name']?><br>
											<?php echo $order_info['company_address'];?>
									
										</td>
										<td colspan="2">
										   <?php if(is_null($order_info['company_address'])) echo $order_info['company_address']; else echo $order_info['delivery_address'];?><br>
										
											<?php if(!is_null($phone)) echo "<i class=\"fa fa-phone\"></i> ".$phone;?>
										</td>
									</tr>
								</table>
		   	</div>
				<div class="modal-footer">
				 <button type="button" class="btn-danger btn btn-sm" data-bs-dismiss="modal" aria-label="Close">Close</button>
					
				</div>
			</div>
		</div>
	</div>				
</div>
</div>
</div>  

<script>
function display_checlist_info(){
// 	$("#department_name").val('');
	$("#checklist_info_modal").modal('show');
}
</script>
<!-- Content_right_End -->
