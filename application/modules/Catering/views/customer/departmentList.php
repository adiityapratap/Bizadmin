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
                        <h5 class="card-title mb-0">Departments</h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="#" class="btn btnAdd waves-effect waves-light shadow-none btn-success btn-sm" onclick="add_new_department()">
                                <i class="ri-add-line align-bottom me-1"></i> Add New Department
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
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for department ...">
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
                    <table class="table table-nowrap align-middle" id="departmentTable">
                        <thead class="table-light">
                            <tr class="text-uppercase fs-13">
                                <th class="sort" data-sort="customer_name">Department Name</th>
                                <th class="sort" data-sort="product_name">Company Name</th>
                               
                                <th class="sort" data-sort="city">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <?php if (isset($listDepartments) && !empty($listDepartments)) { ?>
                                <?php foreach ($listDepartments as $list) { ?>
                                    <tr data-id="<?php echo $list['department_id']; ?>">
                                        <td class="customer_name"><?php echo $list['department_name']; ?></td>
                                        <td class="product_name"><?php echo $list['company_name']; ?></td>
                                       
                                      
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                            <a href="#" class="textEdit d-inline-block edit-item-btn" data-buttontype="edit"
                            data-departmentid="<?php echo $list['department_id']; ?>" 
                            data-departmentname="<?php echo $list['department_name']; ?>"
                            data-companyid="<?php echo $list['company_id']; ?>"
                         
                            data-bs-toggle="modal" data-bs-target="#new_department_modal">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder" data-departmentid="<?php echo $list['department_id']; ?>">
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
                                    <h4>You are about to delete a department?</h4>
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
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables
    function initializeDataTables() {
        $('#departmentTable').DataTable({
            lengthChange: false,
            pageLength: 25,
            searching: true, // Enable the DataTables search box
            ordering: true,
            order: [[0, 'asc']]
        });
    }

    initializeDataTables();

    // Handle search input
    $('#searchInput').on('keyup', function () {
        let searchValue = $(this).val();
        $('#departmentTable').DataTable().search(searchValue).draw();
    });

    // Clear filters
    window.clearFilters = function() {
        $('#searchInput').val('');
        $('#searchInput').trigger('keyup');
    };
    
});

$('#new_department_modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let buttontype = button.data('buttontype');

    // Check if this is an edit operation
    if (buttontype === 'edit') {
        let companyid = button.data('companyid');
        let departmentname = button.data('departmentname');
        let departmentid = button.data('departmentid');
      
        $('#new_department_modal #department_id').val(departmentid);
        $('#new_department_modal #newDept').val(departmentname);
        $('#new_department_modal #newDeptComp').val(companyid);
       
            
    } else if (buttontype === 'add') {
       
    }
});

 $('#deleteOrder').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        departmentId = button.data('departmentid'); 
    });

 $('#delete-record').on('click', function() {
        if (!departmentId) return;
        $.ajax({
            url: '<?php echo base_url("deleteRecord") ?>', 
            type: 'POST',
            data: {
                table: 'department',
                column: 'department_id',
                id: departmentId
            },
            success: function(response) {
                if (response) {
                    $('tr[data-id="' + departmentId + '"]').remove();
                    $('#deleteOrder').modal('hide');
                } 
            },
            error: function() {
                alert('Error occurred while deleting customer');
            }
        });
    });
</script>
