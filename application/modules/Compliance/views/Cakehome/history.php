<div class="container-fluid" style="margin-top: 130px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="card py-3" id="orderList">
                <h3 class="text-black mx-5">View Best Records</h3>
                <div class="card-header border-0">
                    <div class="d-flex align-items-center gap-2">
                        <div class="col-md-3">
                            <label>From Date</label>
                            <input type="date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>To Date</label>
                            <input type="date" id="to_date" class="form-control">
                        </div>
                        <div class="col-md-3 mt-4">
                            <button id="view_record" class="btn btn-primary mt-2" type="button">
                                <span class="spinner-border spinner-border-sm d-none" id="button-loader" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden">Loading...</span>
                                View Record
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive table-card mb-1">
                        <table id="recordTable" class="table table-nowrap align-middle">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>No of Cake</th>
                                    <th>Best Before</th>
                                    <th>Date Entered</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    let table = $('#recordTable').DataTable({
        "pageLength": 100
    });

    $('#view_record').on('click', function () {
        var from = $('#from_date').val();
        var to = $('#to_date').val();

        if (!from || !to) {
            alert('Please select both dates');
            return;
        }

        // Show loader inside button
        $(this).prop('disabled', true); // Disable button to prevent multiple clicks
        $('#button-loader').removeClass('d-none');
        $(this).find('span.visually-hidden').text('Loading...');
        $(this).find('span:contains("View Record")').addClass('d-none');

        $.ajax({
            url: "<?= base_url('Compliance/Cake/Cakehome/getCakeRecords') ?>",
            method: "POST",
            data: {
                from_date: from,
                to_date: to
            },
            dataType: "json",
            success: function (data) {
                table.clear().draw();
                $.each(data, function (index, row) {
                    table.row.add([
                        row.product_name,
                        row.no_of_cake,
                        row.best_before,
                        row.date_entered_formatted
                    ]).draw(false);
                });
            },
            complete: function () {
                // Hide loader and restore button state
                $('#view_record').prop('disabled', false);
                $('#button-loader').addClass('d-none');
                $('#view_record').find('span.visually-hidden').text('');
                $('#view_record').find('span:contains("View Record")').removeClass('d-none');
            }
        });
    });
});
</script>