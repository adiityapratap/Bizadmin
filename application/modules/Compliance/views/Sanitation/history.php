<div class="container-fluid mb-5" style="margin-top: 130px !important;">
    <div class="row">
        <div class="col-12 tempDiv">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 text-faded">Sanitation  Management History</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('/Compliance/Sanitation/Home/historyData'); ?>" method="post">
                        <div class="col-md-10 mt-2 d-flex gap-3">
                            <div class="date col-md-4">
                                <label class="form-label mb-0 fw-semibold">Date</label>
                                <input type="text" required class="form-control flatpickr-input" data-provider="flatpickr" name="date_range" data-date-format="d M, Y" data-range-date="true" placeholder="Select date" readonly="readonly">
                                <small>Select from and to date to view the history, Please select date in weekly range i.e 1st to 7th</small>
                            </div>
                            <div class="date col-md-4">
                                <label class="form-label mb-0 fw-semibold">Site</label>
                                <select class="form-select siteDropdown" name="site_id">
                                    <option value="">Select Site</option>
                                    <?php foreach ($site_detail as $index => $site): ?>
                                        <option <?php echo $index == 0 ? 'selected' : ''; ?> value="<?php echo htmlspecialchars($site['id']); ?>">
                                            <?php echo htmlspecialchars($site['site_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="buttonTemp col-md-1 mt-3">
                                <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                    <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> View
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>