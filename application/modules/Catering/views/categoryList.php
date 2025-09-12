
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
                        <h5 class="card-title mb-0">Category</h5>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex gap-1 flex-wrap">
                           <a href="#" class="btn btn-soft-primary waves-effect waves-light shadow-none btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newCatModal">
                                <i class="ri-add-line align-bottom me-1"></i> Add New Category
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
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for products ...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-xxl-1 col-sm-4">
                            <div>
                                <button type="button" class="btn btn-soft-danger waves-effect waves-light shadow-none w-100" onclick="clearFilters();">
                                    <i class="ri-equalizer-fill me-1 align-bottom"></i> Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive table-card mb-1">
                    <table class="table table-nowrap align-middle" id="categoryTable">
                        <thead class="table-light">
                            <tr class="text-uppercase fs-13">
                                <th class="sort" data-sort="customer_name">Category Name</th>
                                <th class="sort" data-sort="city">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <?php if (isset($listCategory) && !empty($listCategory)) { ?>
                                <?php foreach ($listCategory as $list) { ?>
                                    <tr data-id="<?php echo $list['category_id']; ?>">
                                        <td class="category_name"><?php echo $list['category_name']; ?></td>
                                      
                                      
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                            <a href="#" class="text-primary d-inline-block edit-item-btn"
                            data-buttontype="edit"
                            data-categoryid="<?php echo $list['category_id']; ?>"
                            data-categoryname="<?php echo $list['category_name']; ?>"
                           
                            data-bs-toggle="modal" 
                            data-bs-target="#newCatModal">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder" data-categoryid="<?php echo $list['category_id']; ?>">
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
                                    <h4>You are about to delete a product?</h4>
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

<div class="modal fade" id="newCatModal" tabindex="-1" aria-labelledby="product-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product-modal-title">New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="new_category">
                    <input type="hidden" name="category_id" id="category_id" value="">
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label" >Category Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="new-category-name" name="category_name" placeholder="New Category" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary loadingBtn btn-success btn-sm" id="category_add" onclick="add_new_category()">Add/Update</button>
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


function add_new_category(){
    $(".loadingBtn").html("Adding....");
$.ajax({
	url:'new_category',
    method:"POST",
    data:$("#new_category").serialize(),
    success:function(prod_id){
     $(".loadingBtn").html("Add/Update");
     location.reload();
    },
	})    
}
                      	
					
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables
    function initializeDataTables() {
        $('#categoryTable').DataTable({
            lengthChange: false,
            searching: true, // Enable the DataTables search box
            ordering: true,
            order: [[0, 'asc']]
        });
    }

    initializeDataTables();

    // Handle search input
    $('#searchInput').on('keyup', function () {
        let searchValue = $(this).val();
        $('#categoryTable').DataTable().search(searchValue).draw();
    });

    // Clear filters
    window.clearFilters = function() {
        $('#searchInput').val('');
        $('#searchInput').trigger('keyup');
    };
    
});

$('#newCatModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let buttontype = button.data('buttontype');

    // Check if this is an edit operation
    if (buttontype === 'edit') {
        let categoryid = button.data('categoryid');
        let categoryname = button.data('categoryname');
       
        $('#newCatModal #new-category-name').val(categoryname);
        $('#newCatModal #category_id').val(categoryid);
  
        } else if (buttontype === 'add') {
       
    }
});

 $('#deleteOrder').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        categoryid = button.data('categoryid'); 
    });

 $('#delete-record').on('click', function() {
        if (!categoryid) return;
        $.ajax({
            url: '<?php echo base_url("deleteRecord") ?>', 
            type: 'POST',
            data: {
                table: 'category',
                column: 'category_id',
                deleteType: 'hard_delete',
                id: categoryid
            },
            success: function(response) {
                if (response) {
                    $('tr[data-id="' + categoryid + '"]').remove();
                    $('#deleteOrder').modal('hide');
                } 
            },
            error: function() {
                alert('Error occurred while deleting customer');
            }
        });
    });
</script>
