
<?php $status_colors = $this->config->item('status_colors');  ?>
<style>
.dataTables_filter {
    display: none;
}
</style>
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="orderList">
            <div class="card-header border-0">
                <div class="row align-items-center gy-3">
                    <div class="col-sm">
                        <h5 class="card-title mb-0 text-black"><?php echo $pageTitle; ?></h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="<?php echo $addUrl ?>" class="btn btnAdd waves-effect waves-light shadow-none">
                                <i class="ri-add-line align-bottom me-1"></i> <?php echo $addBtnText; ?>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-sm-4">
                            <div class="search-box">
                                <!-- This is where DataTables search box will be added -->
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for order ID, customer, order status or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-sm-4">
                            <div>
                             <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y"  id="dateRangePicker" placeholder="Select date">
                           
                            </div>
                        </div>
                        <div class="col-xxl-2 col-sm-4">
                            <div>
                                 <select class="form-select" id="statusFilter">
 
  <option value="all" selected>All</option>
  <?php foreach (ORDER_STATUS_LABELS as $statusCode => $statusLabel) : ?>
    <option value="<?= $statusLabel ?>"><?= $statusLabel ?></option>
  <?php endforeach; ?>
</select>
                            </div>
                        </div>
                        <div class="col-xxl-1 col-sm-4">
                            <div>
                                <button type="button" class="btn btn-dark waves-effect waves-light shadow-none w-100" onclick="clearFilters();">
                                    <i class="ri-equalizer-fill me-1 align-bottom"></i> Clear
                                </button>
                            </div>
                        </div>
                        <div class="col-xxl-1 col-md-2 col-sm-4">
						<input class="form-control " id="late_fee" type="text" placeholder="Enter Late Fee">
						</div>
						<div class="col-xxl-2 col-sm-4">
                          <button type="button" class="btn btn-dark waves-effect waves-light shadow-none" onclick="addLateFee(this,'add_late_fee')">
                                    <i class="ri-add-line me-1 align-bottom"></i> Add Late Fee
                         </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body pt-0">
                <div>
                   
                    <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="table-light">
                                        <tr class="text-uppercase fs-13">
                                            <th scope="col" style="width: 25px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="id">Order ID</th>
                                            <th class="sort" data-sort="customer_name">Customer Name </th>
                                            <th class="sort" data-sort="compnay_name">Company </th>
                                            <th class="sort" data-sort="department_name">Department </th>
                                            <!--<th class="sort" data-sort="customer_name">Customer Email</th>-->
                                            <th class="sort" data-sort="product_name">Delivery Date</th>
                                            <th class="sort" data-sort="date">Delivery Time</th>
                                            <th class="sort" data-sort="amount">Amount</th>
                                            <th class="sort" data-sort="status">Status</th>
                                            <th class="sort" data-sort="city">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <?php if(isset($listData) && !empty($listData)) { ?>
                                        <?php foreach($listData as $quote) { ?>
                                       
                                        <tr data-id="<?php echo $quote['order_id']; ?>">
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input running_sheet_check" type="checkbox" name="checkAll" value="<?php echo $quote['order_id']; ?>">
                                                </div>
                                            </th>
                                            <td class="id"><a href="viewOrderDetails/<?php echo $quote['order_id']; ?>" class="fw-medium link-primary">#<?php echo $quote['order_id']; ?></a></td>
                                            <td class="customer_name"><?php echo $quote['fullname']; ?></td>
                                            <td class="customer_name"><?php echo $quote['company_name']; ?></td>
                                            <td class="customer_name"><?php echo $quote['department_name']; ?></td>
                                            <!--<td class="customer_name"><?php echo $quote['customer_email']; ?></td>-->
                                            <td class="product_name"><?php echo date('d-m-Y',strtotime($quote['delivery_date'])); ?></td>
                                            <td class="date"><?php echo $quote['delivery_time']; ?></td>
                                            <?php  $grandTotal = $this->genric_model->calculateOrderTotal($quote['order_id']); ?>
                                            <td class="amount"><?php echo '$'.$grandTotal; ?></td>
                                            <td class="status"><span class="badge <?php echo $status_colors[$quote['status']]; ?> text-uppercase"><?php echo get_order_status_name($quote['status']); ?></span></td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a href="viewOrderDetails/<?php echo $quote['order_id']; ?>" class="textView d-inline-block">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item edit"  data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a href="<?php echo base_url('/Catering/edit_quote/'.$quote['order_id']) ?>" class="textEdit d-inline-block edit-item-btn">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(isset($is_quote) && $is_quote) { ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Convert to invoice">
                                                        <a class="textPink d-inline-block btnLoad" href="#" onclick="convertToInvoice(<?php echo $quote['order_id']; ?>,this)">
                                                            <i class="ri-file-list-3-line fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php }else if($quote['status'] != 2) { ?>
                                                    
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Mark Paid">
                                                        <a class="text-success d-inline-block btnLoad" href="#"  onclick="markPaid(<?php echo $quote['order_id']; ?>)">
                                                            <i class=" ri-refund-2-line fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php }  ?>
                                        
                                         <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Upload Image">
                                         <a target="_blank" class="text-success d-inline-block " href="<?php echo base_url('index.php/order/uploadOrderImage/' . $quote['order_id']); ?>">
                                         <i class="ri-upload-2-line fs-16 fw-bold"></i>
                                           </a>
                                          </li>
                                           <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View Order Image">
                                         <a target="_blank" class="text-warning d-inline-block " href="<?php echo base_url('index.php/order/viewOrderImage/' . $quote['order_id']); ?>">
                                         <i class="ri-image-line"></i>
                                           </a>
                                          </li>
                                         <?php  if($quote['status'] != 2) {  ?>
                                         <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                         <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder" data-orderid="<?php echo $quote['order_id']; ?>">
                                          <i class="ri-delete-bin-5-fill fs-16 "></i>
                                          </a>
                                          </li>  
                                           <?php }  ?> 

                                         <li class="list-inline-item" data-bs-toggle="tooltip"  title="Reorder">
                                         <a class="d-inline-block reorder-button text-dark" data-order-id="<?php echo $quote['order_id']; ?>">
                                          <i class="ri-recycle-fill fs-18 "></i>
                                          </a>
                                          </li>  
                                           
       
                                            </ul>
                                            </td>
                                        </tr>
                                   
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                </div>
                <!-- Delete Modal -->
                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-5 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                <div class="mt-4 text-center">
                                    <h4>You are about to delete an order?</h4>
                                    <p class="text-muted fs-15 mb-4">Deleting your order will remove all of your information from our database.</p>
                                    <div class="hstack gap-2 justify-content-center remove">
                                        <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal">
                                            <i class="ri-close-line me-1 align-middle"></i> Close
                                        </button>
                                        <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Mark Paid Modal-->
                <div class="modal fade" id="markPaidModal" tabindex="-1" role="dialog" aria-labelledby="mark_paid_title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mark_paid_title">Mark Paid Comments</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form  method="POST" id="mark_paid_form">
					<input type="hidden" name="order_id" id="mark_paid_orderid">
				
					<div class="row">
						<div class="col-12">
							<label>Comments</label>
							<textarea class="form-control" name="mark_paid_comments"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class='col-12'>
							<button type="button" class="btn btn-success btn-sm btn-Load" onclick="markPaidAjax()">
							    Mark Paid <i class="ri-send-plane-fill"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
                <!--Reorder Modal-->
                
                <div class="modal fade" id="reorderModal" tabindex="-1" role="dialog" aria-labelledby="reorderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reorderModalLabel">Reorder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reorderForm">
          <div class="form-group">
            <label for="delivery_date">Delivery Date</label>
            <div class="input-group">
                                <input type="text" name="delivery_date" id="delivery_date" value="<?php echo !empty($orderData['delivery_date']) ? date('d M, Y', strtotime($orderData['delivery_date'])) : ''; ?>" class="form-control dash-filter-picker shadow flatpickr-input active" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                 <div class="input-group-text bg-dark border-dark text-white">
                                  <i class="ri-calendar-2-line"></i>
                                  </div>
                                 </div>
          </div>
          <div class="form-group">
            <label for="delivery_time">Delivery Time</label>
            <input type="time" class="form-control" id="delivery_time" name="delivery_time" required>
          </div>
          <input type="hidden" id="order_id" name="order_id">
          <button type="submit" class="btn btn-primary btn-sm mt-3">Proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>
                <!--end modal -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
function markPaidAjax(){
    $(".btn-Load").html("In Progress....");
      $.ajax({
            url: '<?php echo base_url("markPaid") ?>', 
            type: 'POST',
            data: $('#mark_paid_form').serialize(), 
            dataType: 'json',
            success: function() {
                console.log("successs");
            setTimeout(function() {
             location.reload();
            }, 1000);
            }
        });  
}
function markPaid(orderId){
  $("#mark_paid_orderid").val(orderId)
  $("#markPaidModal").modal('show');  
}
function convertToInvoice(orderId,obj) {
     $(obj).html("Converting....");
  
    $.ajax({
        url: '<?php echo base_url("convertToInvoice"); ?>', // Ensure this URL is correct
        method: 'POST',
        data: {
            'order_id': orderId
        },
        success: function(response) {
            alert('Converted to invoice successfully');
            $('tr[data-id="' + orderId + '"]').remove();
        },
        error: function(xhr, status, error) {
            alert('Error: ' + xhr.responseText);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables for each tab's table
    function initializeDataTables() {
        $('.tab-pane').each(function () {
            let tableId = $(this).find('table').attr('id');
            if ($.fn.DataTable.isDataTable('#' + tableId)) {
                $('#' + tableId).DataTable().destroy(); // Destroy existing instance if exists
            }
            $(this).find('table').DataTable({
                pageLength:50,
                lengthChange: false,
                searching: true, 
                ordering: true,
                order: [[0, 'asc']]
            });
        });
    }

    initializeDataTables();

    // Handle search input
    $('#searchInput').on('keyup', function () {
        let searchValue = $(this).val();
        $('.tab-pane').each(function () {
            let table = $(this).find('table').DataTable();
            table.search(searchValue).draw();
        });
    });

    // Handle date range filter
    document.getElementById('dateRangePicker').addEventListener('change', function () {
        let dateValue = this.value;
       
        $('.tab-pane').each(function () {
            let table = $(this).find('table').DataTable();
             console.log("dateValue",dateValue)
            // Assuming the date column is the 3rd column (index 2)
            table.search(dateValue).draw();
        });
    });

    // Handle status filter
    document.getElementById('statusFilter').addEventListener('change', function () {
        let statusValue = this.value;
        console.log("statusValue",statusValue)
        $('.tab-pane').each(function () {
            let table = $(this).find('table').DataTable();
            if(statusValue =='all'){
            table.search('').draw();
           }else{
             table.search(statusValue).draw();   
           }
            // Assuming the status column is the 7th column (index 6)
           
        });
    });

    // Reinitialize DataTables on tab change
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
        initializeDataTables(); // Reinitialize DataTables when switching tabs
    });
});



function clearFilters() {
    // Clear search input
    $('#searchInput').val('');
    $('#searchInput').trigger('keyup');
    
    // Clear date range picker
    $('#dateRangePicker').val('');
    $('#dateRangePicker').data('dateRange', '');
    $('#dateRangePicker').trigger('change');

    // Reset status filter
    $('#statusFilter').val('all');
    $('#statusFilter').trigger('change');
    
    // Clear all filters from DataTables
    $.fn.dataTable.ext.search.pop(); // Remove custom search functions

    $('.tab-pane').each(function () {
        let table = $(this).find('table').DataTable();
        table.draw();
    });
}

$('#deleteOrder').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget); 
        orderId = button.data('orderid'); 
    });

 $('#delete-record').on('click', function() {
        if (!orderId) return;
        $.ajax({
            url: '<?php echo base_url("deleteRecord") ?>', 
            type: 'POST',
            data: {
                table: 'orders',
                column: 'order_id',
                id: orderId
            },
            success: function(response) {
                if (response) {
                    $('tr[data-id="' + orderId + '"]').remove();
                    $('#deleteOrder').modal('hide');
                } 
            },
            error: function() {
                alert('Error occurred while deleting customer');
            }
        });
    });
</script>

<!--   Reorder -->

<script>
  // Open modal and set order_id
  $('.reorder-button').on('click', function() {
    let orderId = $(this).data('order-id');
    $('#order_id').val(orderId);
    $('#reorderModal').modal('show');
  });

  // Handle form submission
  $('#reorderForm').on('submit', function(e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url("reorder"); ?>', // Adjust this URL as needed
      data: formData,
      success: function(response) {
        // Handle success response
        alert('Order successfully reordered.');
        $('#reorderModal').modal('hide');
      },
      error: function() {
        // Handle error response
        alert('Failed to reorder.');
      }
    });
  });
  
  
  function addLateFee(obj,name)
   {
       $(obj).html("Adding late fee...");
    let running_sheet=[];
    let late_fee_orders=[];

       let late_fee = $("#late_fee").val();
       $(".running_sheet_check").each(function(){
	      
		if($(this).is(':checked')){
		late_fee_orders.push($(this).val());
		}
	    })
	 
	 	late_fee_orders=late_fee_orders.join('.');
        
        $.ajax({
		url:'<?php echo base_url();?>add_late_fee/'+late_fee_orders+'/'+late_fee,
		method:"POST",
		success:function(data){
		location.reload();  
        $(".late_fee_text").show();
        $(".late_fee_text").fadeOut(3000);
         }
    	})
          // window.open('<?php echo base_url();?>index.php/orders/add_late_fee/'+late_fee_orders+'/'+late_fee);
        
}

</script>
