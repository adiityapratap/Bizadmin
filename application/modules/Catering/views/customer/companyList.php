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
                        <h5 class="card-title mb-0">Companies</h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="#" class="btn btnAdd waves-effect waves-light shadow-none btn-success btn-sm" onclick="add_new_company()">
                                <i class="ri-add-line align-bottom me-1"></i> Add New Company
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
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for company ...">
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
                    <table class="table table-nowrap align-middle" id="companyTable">
                        <thead class="table-light">
                            <tr class="text-uppercase fs-13">
                                <th class="sort" data-sort="customer_name">Company Name</th>
                                <th class="sort" data-sort="product_name">Address</th>
                                <th class="sort" data-sort="date">Contact</th>
                                <th class="sort" data-sort="city">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <?php if (isset($listCompanies) && !empty($listCompanies)) { ?>
                                <?php foreach ($listCompanies as $list) { ?>
                                    <tr data-id="<?php echo $list['company_id']; ?>">
                                        <td class="customer_name"><?php echo $list['company_name']; ?></td>
                                        <td class="product_name"><?php echo $list['company_address']; ?></td>
                                        <td class="date"><?php echo $list['company_phone']; ?></td>
                                      
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                              
                          <li class="list-inline-item edit" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                            <a href="#" class="textEdit d-inline-block edit-item-btn" data-buttontype="edit"
                            data-companyid="<?php echo $list['company_id']; ?>" 
                            data-companyname="<?php echo $list['company_name']; ?>"
                            data-companyaddress="<?php echo $list['company_address']; ?>"
                            data-companyphone="<?php echo $list['company_phone']; ?>"
                            data-companyAbn="<?php echo $list['company_abn']; ?>"
                            data-bs-toggle="modal" data-bs-target="#new_company_modal">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder"  data-companyid="<?php echo $list['company_id']; ?>" >
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
                                    <h4>You are about to delete a company?</h4>
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
        $('#companyTable').DataTable({
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
        $('#companyTable').DataTable().search(searchValue).draw();
    });

    // Clear filters
    window.clearFilters = function() {
        $('#searchInput').val('');
        $('#searchInput').trigger('keyup');
    };
    
});

  $('#new_company_modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let buttontype = button.data('buttontype');

    // Check if this is an edit operation
    if (buttontype === 'edit') {
        let companyid = button.data('companyid');
        let companyAbn = button.data('companyabn');
        let companyname = button.data('companyname');
        let companyaddress = button.data('companyaddress');
        let companyphone = button.data('companyphone');
        
        $('#new_company_modal #company_id').val(companyid);
        $('#new_company_modal #newCompany').val(companyname);
         $('#new_company_modal #newCompanyAbn').val(companyAbn);
        $('#new_company_modal #newCompanyPhone').val(companyphone);
        $('#new_company_modal #newCompanyAddr').val(companyaddress);
            
    } else if (buttontype === 'add') {
       
    }
});

 $('#deleteOrder').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        companyId = button.data('companyid'); 
    });

 $('#delete-record').on('click', function() {
        if (!companyId) return;
        $.ajax({
            url: '<?php echo base_url("deleteRecord") ?>', 
            type: 'POST',
            data: {
                table: 'company',
                column: 'company_id',
                id: companyId
            },
            success: function(response) {
                if (response) {
                    $('tr[data-id="' + companyId + '"]').remove();
                    $('#deleteOrder').modal('hide');
                } 
            },
            error: function() {
                alert('Error occurred while deleting customer');
            }
        });
    });
</script>
