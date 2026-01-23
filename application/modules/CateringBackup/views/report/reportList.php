<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<style>
    .dataTables_filter {
        display: none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card px-2" id="orderList">
            <div class="card-header border-0">
                <div class="row align-items-center gy-3">
                    <div class="col-sm">
                        <h5 class="card-title mb-0">Reports</h5>
                    </div>
                    
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-6">
                            <div class="search-box">
                                <!-- This is where DataTables search box will be added -->
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for orderid,compnay name, customer etc ...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xxl-1 col-sm-4">
                            <div>
                                <button type="button" class="btn btn-dark waves-effect waves-light shadow-none w-100" onclick="clearFilters();">
                                    <i class="ri-equalizer-fill me-1 align-bottom"></i> Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive table-card mb-1">
                    <table class="table table-nowrap align-middle" id="reportTable">
                        <thead class="table-light">
                            <tr class="text-uppercase fs-13">
                                <th class="sort" data-sort="customer_name">Order Id</th>
                                <th class="sort" data-sort="product_nam">Order Date</th>
                                <th class="sort" data-sort="product_name">Delivery Date</th>
                                <th class="sort" data-sort="Customer">Customer</th>
                                <th class="sort" data-sort="Department">Company</th>
                                <th class="sort" data-sort="Department">Department</th>
                                <th class="sort" data-sort="Subtotal">Subtotal</th>
                                <th class="sort" data-sort="DeliveryFee">Delivery Fee</th>
                                <th class="sort" data-sort="Discount">Discount</th>
                                <th class="sort" data-sort="Gst">Gst</th>
                                <th class="sort" data-sort="Total">Total</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <?php $subtotalSum = 0; $totalSum = 0; $gstSum = 0; $deliveryFeeSum = 0; ?>
                            <?php if (isset($reportResults) && !empty($reportResults)) { ?>
                                <?php foreach ($reportResults as $list) { ?>
                                <?php $total = $list['order_total'] + $list['delivery_fee'] + $list['late_fee']; ?>
                                <?php if($list['type'] == 'F'){
                                $total = $total - $list['coupon_discount'];
                                $discountAmount = $list['coupon_discount'];
                                }else{
                                 $discountAmount = ($list['order_total']*$list['coupon_discount'])/100;   
                                 $total = $total - $percentDiscount;
                                }
                                ?>
                                <?php $gst = $total/11; ?>
                                <?php $gstSum = $gstSum + $gst; ?> <?php $deliveryFeeSum = $deliveryFeeSum + $list['delivery_fee']; ?>
                                <?php $subtotalSum = $subtotalSum + $list['order_total'] ; ?> <?php $totalSum = $total + $totalSum; ?>
                                    <tr>
                                        <td class="product_name"><?php echo $list['order_id']; ?></td>
                                        <td class="product_name"><?php echo date('d-m-Y',strtotime($list['date_added'])); ?></td>
                                        <td class="product_price"><?php echo date('d-m-Y',strtotime($list['delivery_date'])); ?></td>
                                        <td class="category"><?php echo $list['fullname']; ?></td>
                                        <td class="category"><?php echo $list['company_name']; ?></td>
                                        <td class="category"><?php echo $list['department_name']; ?></td>
                                        <td class="category">$<?php echo number_format($list['order_total'], 2, '.', ','); ?></td>
                                        <td class="category">$<?php echo number_format($list['delivery_fee'], 2, '.', ','); ?></td>
                                        <td class="category">$<?php echo number_format($discountAmount,2); ?></td> 
                                         <td class="category">$<?php echo number_format($gst, 2, '.', ','); ?></td> 
                                        <td class="category">$<?php echo number_format($total, 2, '.', ','); ?></td> 

                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                        <th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1"></th>
                        <th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1"></th>
                        <th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1"><b>Totals</b></th>
                        <th rowspan="1" colspan="1">$<?php echo number_format($subtotalSum, 2, '.', ','); ?></th>
                        <th rowspan="1" colspan="1">$<?php echo number_format($deliveryFeeSum, 2, '.', ','); ?></th>
                        <th rowspan="1" colspan="1"></th>
                        <th rowspan="1" colspan="1">$<?php echo number_format($gstSum, 2, '.', ','); ?></th>
                        <th rowspan="1" colspan="1">$<?php echo number_format($totalSum, 2, '.', ','); ?></th>
                        </tr>
                        </tfoot>
                    </table>
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
                    <input type="hidden" name="product_id" id="product_id" value="">
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
                        <label class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="category">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary loadingBtn" id="product_add" onclick="add_new_product()">Add/Update</button>
            </div>
        </div>
    </div>
    <div id="loading" style="display:none;">
        <p><img style="height: 30px; width: 304px;" src="<?php echo base_url();?>assets/images/ajax-loader.gif" /></p>
    </div>
</div>
</div>
</div>
</div>  

<script>

                      	
					
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables
    function initializeDataTables() {
    let table = new DataTable('#reportTable', {
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'csv',
            className: 'btn-soft-primary'
        },
        {
            extend: 'excel',
            className: 'btn-soft-success'
        },
        {
            extend: 'print',
            className: 'btn-soft-secondary'
        }
    ]
});



    }

    initializeDataTables();

    // Handle search input
    $('#searchInput').on('keyup', function () {
        let searchValue = $(this).val();
        $('#reportTable').DataTable().search(searchValue).draw();
    });

    // Clear filters
    window.clearFilters = function() {
        $('#searchInput').val('');
        $('#searchInput').trigger('keyup');
    };
    
});



</script>
