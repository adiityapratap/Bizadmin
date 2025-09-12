<div class="modal fade" id="recreateRosterModal" tabindex="-1" aria-labelledby="recreateRoster" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recreateRoster">Select date for roster</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('/HR/recreateRoster'); ?>" method="post" id="recreateRosterForm">
                <div class="modal-body">
                    <input type="hidden" name="roster_id" class="recreate_roster_id">
                    <div class="mb-3">
                        <label for="startDate" class="col-form-label">Roster Start Date:</label>
                        <input type="text" name="start_date" id="startdatepicker" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="col-form-label">Roster End Date:</label>
                        <input type="text" name="end_date" id="enddatepicker" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Recreate</button>
                </div>
            </form>
        </div>
    </div>
</div>