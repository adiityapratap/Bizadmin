
<?php if ($this->session->flashdata('couponMessage')): ?>
    <div class="alert alert-success" id="flash-messageAlert">
        <?php echo $this->session->flashdata('couponMessage'); ?>
    </div>
   
<?php endif; ?>
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div class="row">
					<div class="col-12">
						<div class="card">
						    <div class="card-header border-0">
                <div class="row align-items-center gy-3">
                    <div class="col-sm">
                        <h5 class="card-title mb-0 text-black">Coupons</h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="#" class="btn btnAdd waves-effect waves-light shadow-none new_coupon btn-success">
                                <i class="ri-add-line align-bottom me-1"></i> Add New Coupon
                            </a>
                        </div>
                    </div>
                </div>
            </div>
							<div class="card-body">
								<div class="row">
    <?php if (!empty($coupons)) {
        foreach ($coupons as $coupon) {
            echo "<div class=\"col-xl-3 col-sm-6 mb-4\">";
            echo "<div class=\"card card-shadow btnAdd text-white coupon-card\" 
                  data-coupon-id=\"{$coupon['coupon_id']}\" 
                  data-coupon-code=\"{$coupon['coupon_code']}\" 
                  data-coupon-description=\"{$coupon['coupon_description']}\" 
                  data-coupon-discount=\"{$coupon['coupon_discount']}\" 
                  data-coupon-type=\"{$coupon['type']}\">";
            echo "<div class=\"card-body\">";
            echo "<p class=\"f24 text-black \">{$coupon['coupon_code']}</p>";
            echo "<h6 class=\"mb-0 pull-left text-black \">{$coupon['coupon_description']}</h6>";
            if ($coupon['status'] == 1) {
                echo '<a href="' . base_url('couponsStatusUpdate/' . $coupon['coupon_id'] . '/0') . '" class="btn btn-sm btn-danger mt-2 pull-right">Deactivate</a>';
            } else {
                echo '<a href="' . base_url('couponsStatusUpdate/' . $coupon['coupon_id'] . '/1') . '" class="btn btn-sm btn-success mt-2 pull-right">Activate</a>';
            }
            //  echo '<a  class="btn btn-sm btn-secondary mt-2 mx-2 pull-right">Edit</a>';
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } ?>
</div>

							</div>
						</div>
					</div>
				</div>

</div>
</div>
</div>  
<div class="modal fade" id="new_coupon_modal" tabindex="-1" role="dialog" aria-labelledby="new_coupon_label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?php echo base_url('coupons');?>" method="POST">
			<div class="modal-header">
				<h5 class="modal-title" id="new_coupon_label">New Coupon</h5>
				<button type="button" class="close btn btn-sm btn-danger mb-2" data-bs-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    			</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 mb-3">
						Coupon Code
						<input type="text" class="form-control" name="coupon_code" required>
					</div>
					<div class="col-12 mb-3">
						Coupon Description
						<input type="text" class="form-control" name="coupon_description" required>
					</div>
					<div class="col-12 mb-3">
						Coupon Discount (Enter numbers ONLY)
						<input type="number" step="0.1" class="form-control" name="coupon_discount" required>
					</div>
					<div class="col-12 mb-3">
						Type
						<select name="type" class="form-control">
							<option value="P">Percentage Discount</option>
							<option value="F">Fixed Discount</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="coupon_id" >
				<button type="submit" class="btn btn-dark">
					Save
				</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    $(".coupon-card").on('click', function() {
        // Get data from the clicked coupon card
        let couponId = $(this).data('coupon-id');
        let couponCode = $(this).data('coupon-code');
        let couponDescription = $(this).data('coupon-description');
        let couponDiscount = $(this).data('coupon-discount');
        let couponType = $(this).data('coupon-type');

        // Set the modal form fields with the coupon data
        $("#new_coupon_modal [name='coupon_id']").val(couponId);
        $("#new_coupon_modal [name='coupon_code']").val(couponCode);
        $("#new_coupon_modal [name='coupon_description']").val(couponDescription);
        $("#new_coupon_modal [name='coupon_discount']").val(couponDiscount);
        $("#new_coupon_modal [name='type']").val(couponType);

        

        // Show the modal
        $("#new_coupon_modal").modal('show');
    });

    // Handle new coupon button separately
    $(".new_coupon").on('click', function(e) {
        e.preventDefault();
        
        // Reset the form fields for a new coupon
        $("#new_coupon_modal form")[0].reset();
        $("#new_coupon_modal form").attr("action", "<?php echo base_url('coupons');?>");

        // Show the modal
        $("#new_coupon_modal").modal('show');
    });
});

$(document).ready(function() {
            setTimeout(function() {
                $('#flash-messageAlert').fadeOut('slow', function() {
                    $(this).remove(); // Remove the element from the DOM
                });
            }, 4000); // 5 seconds
        });    

</script>
