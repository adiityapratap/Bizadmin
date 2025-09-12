

<div class="toast" id="successToast" style="position: absolute; top: 20px; right: 20px;" data-delay="3000">
    <div class="toast-header">
        <strong class="mr-auto text-primary">Success</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
        Customer added successfully!
    </div>
</div>

<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div class="row">
    <div class="col">
        <!-- breadcrumb -->
        <div class="page-heading">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="page-breadcrumb">
                        <h3 class="text-black"><?php echo $pageHeading; ?></h3>
                    </div>
                </div>
               
            </div>
        </div>
        <form action="<?php echo base_url('Catering/new_quotes_save'); ?>" method="POST" id="new_order_form" novalidate>
            <?php $editOrderId = $editOrderId ?? ''; ?>
            <input type="hidden" name="editOrderId" value='<?php echo $editOrderId; ?>'> 
            <div class="row mb-4"> 
                <!--Report widget start-->
                <div class="col-lg-6 col-sm-12 col-12 mb-4">
                    <div class="card card-shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0 text-black">Customer Details</h3>
                            <button type="button" class="btn btnAdd btn-success btn-sm" onclick="add_customer()">
                                <span class="icon-on">
                                    <i class="ri-add-line align-bottom me-1 "></i> Add Customer
                                </span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3">Company</div>
                                <div class="col-12 col-md-9">
              <select class="form-control" name="company_id" id="company_id" data-choices data-choices-sorting-false>                                                            
                                  <option value="0" selected disabled>Select Company</option>
                                        <?php if (!empty($companies)) {
                                           
                                            foreach ($companies as $company) {
                                                $company = (array)$company;
                                                $selected = !empty($orderData['company_id']) && $orderData['company_id'] == $company['company_id'] ? 'selected' : '';
                                                echo "<option value=\"" . $company['company_id'] . "\" $selected>" . $company['company_name'] . "</option>";
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Department</div>
                                <div class="col-12 col-md-9">
            <select class="form-control" name="department_id" id="department_id" >                         
                               <option value="0" selected>All Departments</option>
                                        <?php if (!empty($departments)) {
                                            foreach ($departments as $department) {
                                                $department = (array)$department;
                                                $selected = !empty($orderData['department_id']) && $orderData['department_id'] == $department['department_id'] ? 'selected' : '';
                                                echo "<option value=\"" . $department['department_id'] . "\" $selected>" . $department['department_name'] . "</option>";
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Customer</div>
                                <div class="col-12 col-md-9">
             <select class="form-control" name="customer_id" id="customer_id">                         
                                        <option value="0" selected disabled>Select Customer</option>
                                        <?php if (!empty($customers)) {
                                            foreach ($customers as $customer) {
                                                $customer = (array)$customer;
                                                $selected = !empty($orderData['customer_id']) && $orderData['customer_id'] == $customer['customer_id'] ? 'selected' : '';
                                                echo "<option value=\"" . $customer['customer_id'] . "\" $selected>" . $customer['firstname'] . " " . $customer['lastname'] . "</option>";
                                            }
                                        } ?>
                                    </select>
                                    <div class="invalid-feedback">Please select a customer</div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Phone</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           value="<?php echo !empty($orderData['delivery_contact']) ? $orderData['delivery_contact'] : ''; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Email</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" name="email" id="email"
                                           value="<?php echo !empty($orderData['accounts_email']) ? $orderData['accounts_email'] : ''; ?>">
                                </div>
                            </div>

                        
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 mb-4">
                    <div class="card card-shadow">
                        <div class="card-header">
                            <h3 class="card-title text-black">Delivery Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3">Delivery Date</div>
                                <div class="col-12 col-md-9">
                                <div class="input-group">
                                <input type="text" name="delivery_date" id="delivery_date" value="<?php echo !empty($orderData['delivery_date']) ? date('d M, Y', strtotime($orderData['delivery_date'])) : ''; ?>" class="form-control dash-filter-picker shadow flatpickr-input active" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                 <div class="input-group-text bg-dark border-dark text-white">
                                  <i class="ri-calendar-2-line"></i>
                                  </div>
                                 </div>
                                 <div class="invalid-feedback">Please enter a delivery date</div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Delivery Time</div>
                                <div class="col-12 col-md-9">
                                <input type="text" autocomplete="off" class="form-control timepicker-input" name="delivery_time" id="delivery_time" value="<?php echo !empty($orderData['delivery_time']) ? $orderData['delivery_time'] : ''; ?>">
                                 <div class="invalid-feedback">Please enter a delivery time</div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Account Email</div>
                                <div class="col-12 col-md-9">
                            <input type="text" autocomplete="off" class="form-control" name="accounts_email" id="accounts_email" value="<?php echo !empty($orderData['accounts_email']) ? $orderData['accounts_email'] : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Cost Center</div>
                                <div class="col-12 col-md-9">
                            <input type="text" autocomplete="off" class="form-control" name="cost_center" id="cost_center" value="<?php echo !empty($orderData['cost_center']) ? $orderData['cost_center'] : ''; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Delivery Contact</div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control "
                                           autocomplete="off" placeholder="Delivery contact number" name="delivery_contact"
                                           id="delivery_contact"
                                           value="<?php echo !empty($orderData['delivery_contact']) ? $orderData['delivery_contact'] : ''; ?>">
                                    <div class="invalid-feedback">Please enter delivery contact</div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Delivery Notes</div>
                                <div class="col-12 col-md-9">
   										 
<textarea name="delivery_notes" id="deliver_notes_customer" class="form-control" rows="4">
<?php echo !empty($orderData['delivery_notes'])?$orderData['delivery_notes']:'Time:    
Location: 
Number:
Name :';?></textarea>                        
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-3">Delivery Method</div>
                                <div class="col-12 col-md-9">
                                    <label class="control control-solid control-solid-info control--radio">Delivery
                                        <input type="radio" name="shipping_method" class="shipping_radio" value="1"
                                            <?php echo !empty($orderData['shipping_method']) && $orderData['shipping_method'] == 1 ? 'checked' : ''; ?>>
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label class="control control-solid control-solid-info control--radio">Pickup
                                        <input type="radio" name="shipping_method" class="shipping_radio" value="2"
                                            <?php echo !empty($orderData['shipping_method']) && $orderData['shipping_method'] == 2 ? 'checked' : ''; ?>>
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            </div>
                            
                           <div class="row mt-3 delivery">
                                <div class="col-12 col-md-3">Delivery Address</div>
                                <div class="col-12 col-md-9">
                                    <textarea class="form-control"  name="delivery_address" id="delivery_address" rows="4">
                                       <?php echo !empty($orderData['delivery_address'])?$orderData['delivery_address']: ''; ?></textarea>
                                    <div class="invalid-feedback">Please enter delivery address</div>
                                </div>
                            </div>
                            
                            	<div class="row mt-3 delivery">
										<div class="col-12 col-md-3">Delivery Fee</div>
										<div class="col-12 col-md-9"><input type="text" name="delivery_fee" id="delivery_fee" class="form-control" value="<?php echo !empty($orderData['delivery_fee'])?$orderData['delivery_fee']: ''; ?>">
										<div class="invalid-feedback">Please enter numbers only!</div></div>
									</div>

                           
                            
                            <div class="row mt-3 pickup">
										<div class="col-12 col-md-3">Pickup Address</div>
										<div class="col-12 col-md-9" id="pickup_address"></div>
										<input type="hidden"  value="" name="customer_pickup_address" id="customer_pickup_address">
									</div>
							<div class="row mt-3">
										<div class="col-12 text-right ">
											<button type="submit" class="btn btnAdd float-end btn-success">
											     <span class="icon-on"> <i class="ri-shopping-cart-2-fill align-bottom me-1"></i> Proceed  </span>
											</button>
										</div>
									</div> 
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
           
        </form>
    </div>
</div>
  </div>
</div>
</div>


<?php $this->load->view('customer/customerCommon'); ?>


<script>
$(function(){
    
	company_map=<?php echo json_encode($companies);?>;
	customer_map=<?php echo json_encode($customers);?>;
	department_map=<?php echo json_encode($departments);?>;

	pickupAddressList=<?php echo json_encode($pickupAddressList);?>;

	$(".pickup").hide();
	$(".shipping_radio").on('change',function(){
		if($(".shipping_radio:checked").val()==1){
			$(".pickup").hide();
			$(".delivery").show();
			 $('#delivery_fee').prop("disabled", false);
		}
		else{
			$(".delivery").hide();
// 			$("#delivery").remove();
			$(".pickup").show();
			 $('#delivery_fee').prop("disabled", true);
		}
	})

	
	if($("#company_id").val()!=0){
	    
		for(var i=0;i<customer_map.length;i++){
			if(customer_map[i].company_id==$("#company_id").val()){
				if($.trim(<?php echo empty($pre_customer)?"''":$pre_customer;?>)!=''&&<?php echo empty($pre_customer)?"''":$pre_customer;?>==customer_map[i].customer_id)
					$("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\" selected>"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
				else $("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\">"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
			}
		}
	}
	
	
	$("#company_id").on('change',function(){
     console.log("department_map ",department_map);

		$("#department_id").empty();
		$("#department_id").append("<option value=\"0\" selected>All Departments</option>");
		for(var i=0;i<department_map.length;i++){
			if(department_map[i].company_id==$(this).val()){
				$("#department_id").append("<option value=\""+department_map[i].department_id+"\">"+department_map[i].department_name+"</option>");
			}
		}
				//Also customers that don't have a department
		$("#customer_id").empty();
		$("#customer_id").append("<option value=\"0\" selected disabled>Select Customer</option>");
		for(var i=0;i<customer_map.length;i++){
			if(customer_map[i].company_id==$(this).val()){
				if($.trim(<?php echo empty($pre_customer)?"''":$pre_customer;?>)!=''&&<?php echo empty($pre_customer)?"''":$pre_customer;?>==customer_map[i].customer_id)
					$("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\" selected>"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
				else $("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\">"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
			}
		}
	})
	$("#department_id").on('change',function(){
		$("#customer_id").empty();
		$("#customer_id").append("<option value=\"0\" selected disabled>Select Customer</option>");
		
		for(var i=0;i<customer_map.length;i++){
		    if(typeof customer_map[i].department_id === 'undefined') {
		        // because in frontend customer db we have column name as department_id and in backend we have it department
           if((customer_map[i].department==$(this).val()&&customer_map[i].company_id==$("#company_id").val()) || (customer_map[i].department_id==$(this).val())){
    				if($.trim(<?php echo empty($pre_customer)?"''":$pre_customer;?>)!=''&&<?php echo empty($pre_customer)?"''":$pre_customer;?>==customer_map[i].customer_id)
    					$("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\" selected>"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
    				else $("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\">"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
    			}
          }else if(customer_map[i].department != ''){
    			if(customer_map[i].department_id==$(this).val()&&customer_map[i].company_id==$("#company_id").val()){
    				if($.trim(<?php echo empty($pre_customer)?"''":$pre_customer;?>)!=''&&<?php echo empty($pre_customer)?"''":$pre_customer;?>==customer_map[i].customer_id)
    					$("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\" selected>"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
    				else $("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\">"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
    			}
		    }else{
		        if(customer_map[i].department==$(this).val()&&customer_map[i].company_id==$("#company_id").val()){
    				if($.trim(<?php echo empty($pre_customer)?"''":$pre_customer;?>)!=''&&<?php echo empty($pre_customer)?"''":$pre_customer;?>==customer_map[i].customer_id)
    					$("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\" selected>"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
    				else $("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\">"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
    			}
		    }
		}
		if($(this).val()==0){
			for(var i=0;i<customer_map.length;i++){
				if(customer_map[i].company_id==$("#company_id").val()){
					if($.trim(<?php echo empty($pre_customer)?"''":$pre_customer;?>)!=''&&<?php echo empty($pre_customer)?"''":$pre_customer;?>==customer_map[i].customer_id)
						$("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\" selected>"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
					else $("#customer_id").append("<option value=\""+customer_map[i].customer_id+"\">"+customer_map[i].firstname+" "+customer_map[i].lastname+"</option>");
				}
			}
		}
	})
	$("#customer_id").on('change',function(){
		for(var i=0;i<customer_map.length;i++){
			if($(this).val()==customer_map[i].customer_id){
				$("#phone").val(customer_map[i].telephone);
				$("#email").val(customer_map[i].email);
				// $("#cost_centre").val(customer_map[i].customer_cost_centre);
			}
		}
	})
	

	$("#new_order_form").on('submit',function(e){
		var flag=0;
	
		$(".is-invalid").removeClass('is-invalid');
		if($("#customer_id option").filter(':selected').val()==0){
			$("#customer_id").addClass('is-invalid');
			flag=1;
		}
		if($.trim($("#delivery_date").val())=='')
		{
			$("#delivery_date").addClass('is-invalid');
			flag=1;
		}
		if($.trim($("#delivery_time").val())=='')
		{
			$("#delivery_time").addClass('is-invalid');
			flag=1;
		}
		if($.trim($("#delivery_contact").val())=='')
		{
			$("#delivery_contact").addClass('is-invalid');
			flag=1;
		}
	
	
		let regexp=/^\d*$/;
		if(!regexp.test($("#delivery_fee").val())){
		flag=1;
		$("#delivery_fee").addClass("is-invalid");
			}
		if(flag===1){
			e.preventDefault();
		}
	})
})


$(document).ready(function() {
    $('.timepicker-input').timepicker({
        timeFormat: 'h:mm p',
        interval: 05,
        minTime: '12:00am',
        maxTime: '11:30pm',
        startTime: '12:00am',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    
//     if($(".shipping_radio:checked").val()==1){
// 			$(".pickup").hide();
// 			$(".delivery").show();
			
// 			$('#delivery_fee').removeAttr("disabled");    
// 			}
// 		else{
// 		    $("#delivery_fee").attr('disabled', 'disabled');
// 			$(".delivery").hide();
// 			$(".pickup").show();
		
// 		}

})
</script>