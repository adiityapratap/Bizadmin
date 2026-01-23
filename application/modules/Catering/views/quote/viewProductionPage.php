
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div class="row">
 <div class="page-heading">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="page-breadcrumb">
                        <h3>Production</h3>
                    </div>
                </div>
               
            </div>
        </div>
</div>
<div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                               
                               <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Order #<?php echo $orderData['order_id'] ?></h5>
                                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                                        <a href="#" class="btn btnAdd mt-2 mt-sm-0" onclick="window.print(); return false;"><i class="ri-printer-fill align-middle me-1"></i>Print</a>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-borderless mb-0">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Product Comments</th>
                                                    <th scope="col" class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php $subtotal = 0; ?>        
                                        <?php if(isset($orderData['products']) && !empty($orderData['products'])) {  ?>
                                        <?php foreach($orderData['products'] as $products) {  ?>
                                                <tr class="border-top border-solid-dark">
                                                     <td><?php echo $products['quantity'] ?></td>
                                                    <td> <?php echo $products['product_name'] ?></td>
                                                    <td> <?php echo $products['order_product_comment'] ?></td>
                                                    <td class="fw-medium">
                                                    <div class="form-check mb-2 text-end">
    <input class="form-check-input" type="checkbox" id="<?php echo $products['order_product_id'] ?>" <?php echo $products['is_prepared'] ? 'checked' : ''; ?> data-id="<?php echo $products['order_product_id'] ?>">
                                                        <label class="form-check-label" for="<?php echo $products['order_product_id'] ?>">
                                                            Is Prepared
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                         <?php $subtotal += $products['total'];}  ?>
                                        <?php }  ?>
                                        
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                      
                    </div>
</div>
</div>
</div>                    

<script>
$(document).ready(function() {
    $('.form-check-input').change(function() {
        var orderProductId = $(this).data('id');
        var isPrepared = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '<?php echo base_url('updatePreparedStatus'); ?>',
            type: 'POST',
            data: {
                order_product_id: orderProductId,
                is_prepared: isPrepared
            },
            success: function(response) {
                // Handle success response
                console.log('Status updated successfully');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.log('Error updating status');
            }
        });
    });
});
</script>
