
	<style>
    .dataTables_filter {
        display: none;
    }
</style>
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
	<div class="row">

					<div class="col-xl-12 mb-4">
						<div class="card card-shadow">
							<div class="card-header">
							    <div class="alert alert-success d-none">
  <strong>Success!</strong> Mail sent succesfully
</div>
								<div class="card-title">
			<button class="btn btnAdd btn-sm mt-2 mt-sm-0" id="sendReminderBtn">Send Reminder Email <i class="ri-mail-send-line align-middle me-1"></i></button>
								</div>
							</div>
				<div class="card-body border border-dashed border-end-0 border-start-0">
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-6">
                            <div class="search-box">
                                <!-- This is where DataTables search box will be added -->
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for company ...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        
                        <div class="col-xxl-2 col-sm-6">
                          <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M Y"  id="dateRangePicker" placeholder="Select date">
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
                <div class="card-body">
                   
                <div class="tab-content">
                       
              
                
			   <div class="table-responsive table-card mb-1">
                    <table class="table align-middle"  id="reminderOrderTable">
								  <thead class="table-light">
											<tr>
											    <th></th>
												<th>Order id #</th>
												<th>Customer</th>
												<th>Company Name</th>
												<th>Delivery Date</th>
												
												<th>Email id</th>
												<th>Mail Sent</th>
												
											</tr>
										</thead>
										<tbody class="reminderOrderList">
											<?php if(!empty($unpaid_orders)){
												foreach($unpaid_orders as $order){ ?>
                                            <?php
                                             $deliveryDate = date("Y-m-d", strtotime($order['delivery_date']));
                                             $currentDate = date("Y-m-d");
                                             $sevenDaysAgo = date("Y-m-d", strtotime('-7 days'));
                                             $isExactly7DaysOld = ($deliveryDate == $sevenDaysAgo);
                                             if($isExactly7DaysOld){
                                               $className ='bg-danger text-white';  
                                             }else{
                                                 $className = '';
                                             }
                                            ?>	
												
											
											 <tr class="<?php echo $className; ?>">
											    
											 <td> <div class="form-check form-check-success mb-3">
                                             <input class="form-check-input reminderOrderListCheckbox" type="checkbox" id="formCheck8" value="<?php echo $order['order_id'] ?>">
                                             </div> </td>  
											  <td> <?php echo $order['order_id'] ?></td>	 
											 <td> <?php echo $order['fullname']?></td>
											 <td> <?php echo $order['company_name'] ?></td>
											 <td> <?php echo date("d M Y",strtotime($order['delivery_date'])); ?></td>
											 <td> <?php echo $order['customer_email'] ?></td>
											 <td> <?php echo $order['isMailSent'] ?></td>
											
											 </tr>
												
											<?php   } } ?>
											
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
</div>			
	<script>
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

    
    
    // Clear all filters from DataTables
    $.fn.dataTable.ext.search.pop(); // Remove custom search functions

    $('.tab-pane').each(function () {
        let table = $(this).find('table').DataTable();
        table.draw();
    });
}

     $(document).ready(function () {
		  $('#sendReminderBtn').on('click', function () {
      // Select all checked checkboxes with the class "reminderOrderListCheckbox" inside the tbody
      let checkedValues = $('.reminderOrderList  .reminderOrderListCheckbox:checked').map(function () {
        return $(this).val();
      }).get();
      
      console.log("checkedValues",checkedValues)
     
      // Send the array via AJAX to a CodeIgniter controller
       let jsonData = JSON.stringify({ checkedValues: checkedValues });

    	$.ajax({
    		url:"<?php echo base_url('sendPaymentReminderMail');?>",
    		method:"POST",
    		contentType: 'application/json',
    		data: jsonData,
    		success:function(data){
    		$(".alert-success").removeClass("d-none")	
    		}
    	})
    
      
      
      
      
    });
  });
						
						</script>