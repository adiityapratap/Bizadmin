<!-- EMPLOYEE SIDE PANEL -->
<?php
$savedWeekly = [];

if (!empty($availability) && isset($availability[0]['weekly_json'])) {
    $savedWeekly = json_decode($availability[0]['weekly_json'], true);
}

$sameHours = (isset($availability[0]) && isset($availability[0]['same_hours'])) ? $availability[0]['same_hours'] : 0;

// echo "<pre>"; print_r($savedWeekly); exit;

$days = [
    "mon" => "Monday",
    "tue" => "Tuesday",
    "wed" => "Wednesday",
    "thu" => "Thursday",
    "fri" => "Friday",
    "sat" => "Saturday",
    "sun" => "Sunday",
];
?>

<div class="offcanvas offcanvas-end" tabindex="-1" id="unavailabilityOffcanvas" aria-labelledby="unavailabilityOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="mb-0 text-black" id="unavailabilityOffcanvasLabel">My Availability</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-3">

        <form id="offcanvasAvailabilityForm">

            <input type="hidden" name="emp_id" value="<?= $employee['emp_id'] ?? '' ?>">

            <!-- SAME HOURS SWITCH -->
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="ocSameHours" name="same_hours"
                       <?= $sameHours ? "checked" : "" ?>>
                <label class="form-check-label">Same hours for all days</label>
            </div>

            <!-- SAME HOURS BLOCK -->
            <div id="ocSameHoursBlock" class="<?= $sameHours ? '' : 'd-none' ?> mb-3">
                <div class="row g-2">
                    <div class="col-6">
                        <label class="small">Start</label>
                        <input type="text" class="form-control form-control-sm timepicker"
                               id="oc_same_start" name="same_start"
                               value="<?= $sameHours ? ($savedWeekly['mon']['start'] ?? '') : '' ?>">
                    </div>
                    <div class="col-6">
                        <label class="small">End</label>
                        <input type="text" class="form-control form-control-sm timepicker"
                               id="oc_same_end" name="same_end"
                               value="<?= $sameHours ? ($savedWeekly['mon']['end'] ?? '') : '' ?>">
                    </div>
                </div>
            </div>

            <!-- DAY WISE TABLE -->
            <div id="ocDaysBlock" class="<?= $sameHours ? 'd-none' : '' ?>">

                <table class="table table-bordered small align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Day</th>
                            <th width="120">Start</th>
                            <th width="120">End</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($days as $key => $label): ?>
                        <tr>
                            <td class="fw-semibold"><?= $label ?></td>
                            <td>
                                <input type="text" class="form-control form-control-sm timepicker"
                                    name="weekly[<?= $key ?>][start]"
                                    value="<?= $savedWeekly[$key]['start'] ?? '' ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm timepicker"
                                    name="weekly[<?= $key ?>][end]"
                                    value="<?= $savedWeekly[$key]['end'] ?? '' ?>">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <!-- SAVE BUTTON -->
            <button type="submit" id="ocSaveBtn" class="btn btn-primary btn-sm w-100 mt-3">
                <span class="btn-text">Save Availability</span>
                <span class="spinner-border spinner-border-sm d-none" id="ocBtnLoader"></span>
            </button>

        </form>

    </div>

</div>

<script>
$(function () {

    // INIT TIME PICKER
    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        dropdown: true,
        scrollbar: true
    });

    // TOGGLE SAME HOURS
    $("#ocSameHours").on("change", function () {
        $("#ocSameHoursBlock").toggle(this.checked);
        $("#ocDaysBlock").toggle(!this.checked);
    });

    // SAVE AVAILABILITY AJAX
    $("#offcanvasAvailabilityForm").submit(function (e) {
        e.preventDefault();

        $("#ocSaveBtn").prop("disabled", true);
        $("#ocBtnLoader").removeClass("d-none");
        $(".btn-text").text("Saving...");

        $.ajax({
            url: "<?= base_url('HR/Employees/save_availability') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (res) {

                $("#ocSaveBtn").prop("disabled", false);
                $("#ocBtnLoader").addClass("d-none");
                $(".btn-text").text("Save Availability");

                if (res.status === "success") {
                    alert("Availability updated successfully");
                } else {
                    alert(res.message);
                }
            },
            error: function () {
                $("#ocSaveBtn").prop("disabled", false);
                $("#ocBtnLoader").addClass("d-none");
                $(".btn-text").text("Save Availability");
                alert("Something went wrong!");
            }
        });

    });

});
</script>
