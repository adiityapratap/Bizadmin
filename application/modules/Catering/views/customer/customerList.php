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
        <div class="card" id="orderList">
            <div class="card-header border-0">
                <div class="row align-items-center gy-3">
                    <div class="col-sm">
                        <h5 class="card-title mb-0">Customers</h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="#" class="btn btnAdd waves-effect waves-light shadow-none btn-success btn-sm" data-buttonType="Add" onclick="add_customer()">
                                <i class="ri-add-line align-bottom me-1"></i> Add New Customer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-6">
                            <div class="search-box">
                                <!-- This is where DataTables search box will be added -->
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for customer name, company, department ...">
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
                    <table class="table table-nowrap align-middle" id="customerTable">
                        <thead class="table-light">
                            <tr class="text-uppercase fs-13">
                                <th class="sort" data-sort="customer_name">Customer Name</th>
                                <th class="sort" data-sort="product_name">Email</th>
                                
                                <th class="sort" data-sort="date">Contact</th>
                                <th class="sort" data-sort="amount">Company</th>
                                <th class="sort" data-sort="status">Department</th>
                                <th class="sort" data-sort="city">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <?php if (isset($listCustomer) && !empty($listCustomer)) { ?>
                                <?php foreach ($listCustomer as $list) { ?>
                                    <tr data-customerId="<?php echo $list['customer_id']; ?>">
                                        <td class="customer_name"><?php echo $list['fullname']; ?></td>
                                        <td class="product_name"><?php echo $list['email']; ?></td>
                                       
                                        <td class="date"><?php echo $list['telephone']; ?></td>
                                        <td class="amount"><?php echo $list['company_name']; ?></td>
                                        <td class="status"><?php echo $list['department_name']; ?></td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                              
                                                <li class="list-inline-item edit" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
    <a href="#" class="textEdit d-inline-block edit-item-btn" 
   data-bs-toggle="modal" 
   data-bs-target="#customer_new_modal" 
   data-buttontype="edit"
   
   data-customer_id="<?php echo $list['customer_id']; ?>"
   data-fullname="<?php echo $list['fullname']; ?>"
   data-email="<?php echo $list['email']; ?>"
   data-telephone="<?php echo $list['telephone']; ?>"
   data-company_id="<?php echo $list['company_id']; ?>"
   data-department_id="<?php echo $list['department_id']; ?>">
    <i class="ri-pencil-fill fs-16"></i>
</a>

</li>
  <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder" data-customer_id="<?php echo $list['customer_id']; ?>">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
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
                <!-- Modal -->
                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-5 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                <div class="mt-4 text-center">
                                    <h4>You are about to delete a customer?</h4>
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
                <!--end modal -->
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('customer/customerCommon'); ?>
</div>
</div>
</div>  
<script>
company_map=<?php echo json_encode($companies);?>;
department_map=<?php echo json_encode($departments);?>;
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables
    function initializeDataTables() {
        $('#customerTable').DataTable({
            lengthChange: false,
            pageLength: 50,
            searching: true, // Enable the DataTables search box
            ordering: true,
            order: [[0, 'asc']]
        });
    }

    initializeDataTables();

    // Handle search input
    $('#searchInput').on('keyup', function () {
        let searchValue = $(this).val();
        $('#customerTable').DataTable().search(searchValue).draw();
    });

    // Clear filters
    window.clearFilters = function() {
        $('#searchInput').val('');
        $('#searchInput').trigger('keyup');
    };
    
   $('#customer_new_modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let buttontype = button.data('buttontype');

    // Check if this is an edit operation
    if (buttontype === 'edit') {
       
        let customer_id = button.data('customer_id');
        let fullname = button.data('fullname');
        let email = button.data('email');
        let telephone = button.data('telephone');
        let company_id = button.data('company_id');
        let department_id = button.data('department_id');
     
        // Split fullname into first name and last name
      
            let nameParts = fullname.split(' ');
            let firstname = nameParts[0];
            let lastname = nameParts.slice(1).join(' ');

            // Populate the modal fields
             
            $('#customer_new_modal #customer_id').val(customer_id);
            $('#customer_new_modal #first_name-input').val(firstname);
            $('#customer_new_modal #last_name-input').val(lastname);
            $('#customer_new_modal #email-input').val(email);
            $('#customer_new_modal #phone-input').val(telephone);
            $('#customer_new_modal #company_id-input').val(company_id);

            // Trigger change event to populate departments if required
            $('#customer_new_modal #company_id-input').trigger('change');
            $('#customer_new_modal #department_id-input').val(department_id);
        
    } else if (buttontype === 'add') {
       
    }
});

    var customerId; 

    $('#deleteOrder').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        customerId = button.data('customer_id'); 
    });

 $('#delete-record').on('click', function() {
        if (!customerId) return;
        $.ajax({
            url: '<?php echo base_url("deleteRecord") ?>', 
            type: 'POST',
            data: {
                table: 'customer',
                column: 'customer_id',
                id: customerId
            },
            success: function(response) {
                if (response) {
                    $('tr[data-customerid="' + customerId + '"]').remove();
                    $('#deleteOrder').modal('hide');
                } 
            },
            error: function() {
                alert('Error occurred while deleting customer');
            }
        });
    });

});
</script>
