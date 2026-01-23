<!-- rosterViewWTM.php -->
<div class="main-content">
    <div class="page-content" style="margin-top: 20px;">
        <div class="container-fluid">
            <div class="row mb-4 mt-2 gap-3">
                <div class="col-md-2 col-sm-2 col-lg-1">
                    <a class="btn btn-orange btn-icon waves-effect waves-light shadow-none w-100" onclick="goBack()">
                        <i class="mdi mdi-reply align-bottom me-1"></i> Back
                    </a>
                </div>
                <div class="col-md-3 col-lg-2 col-sm-4">
                    <input type="text" name="rosterName" class="form-control" id="rosterName" placeholder="Roster Name" value="<?php echo isset($rosterInfo[0]['rosterName']) ? $rosterInfo[0]['rosterName'] : ''; ?>">
                </div>
                <div class="col-md-4 col-sm-8 col-lg-3 d-flex gap-2">
                    <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none prevWeek">
                        <i class="ri-arrow-left-s-line fw-bold"></i>
                    </button>
                    <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek">
                        <?php
                        $startFormatted = date('jS M', strtotime($rosterInfo[0]['start_date']));
                        $endFormatted = date('jS M', strtotime($rosterInfo[0]['end_date']));
                        echo "$startFormatted - $endFormatted";
                        ?>
                    </button>
                    <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none nextWeek">
                        <i class="ri-arrow-right-s-line fw-bold"></i>
                    </button>
                </div>
                <div class="col-md-4 col-sm-5 col-lg-2">
                    <select class="form-select bg-primary-subtle fw-bold weekAreaAndTeam" style="color:#4b38b3">
                        <option value="1">Week by Area</option>
                        <option value="2" selected>Week by Team Member</option>
                        <option value="3">Day by Team Member</option>
                    </select>
                </div>
                <div class="col-md-2 col-lg-1">
                    <button data-bs-toggle="modal" onclick="showRosterRecreateModal(<?php echo $rosterId; ?>)" class="btn btn-warning">
                        <i class="ri-file-copy-fill fw-bold"></i> Recreate
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card h-100 shadow-none">
                        <div class="card-body table-responsive">
                            <?php if (empty($rosterViewWTM)) { ?>
                                <div class="alert alert-info text-center">
                                    No roster details found for this week.
                                </div>
                            <?php } else { ?>
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Team Member</th>
                                            <th>Prep Area</th>
                                            <?php foreach ($days as $day) { ?>
                                                <th><?php echo ucfirst($day['day']) . ' ' . date('d-m', strtotime($day['date'])); ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rosterViewWTM as $empId => $empData) { ?>
                                            <tr>
                                                <td><?php echo $empData['emp_name']; ?></td>
                                                <td><?php echo $empData['prep_name']; ?></td>
                                                <?php foreach ($days as $day) { ?>
                                                    <?php $dayKey = $day['day']; ?>
                                                    <td>
                                                        <?php if (!empty($empData[$dayKey]['start_time'])) { ?>
                                                            <div class="border-1 bg-success-subtle rounded-2 p-2">
                                                                <b class="fs-12"><?php echo $empData['emp_name']; ?></b><br>
                                                                <span class="fs-12">
                                                                    <i class="bx bx-stopwatch text-success fs-16"></i>
                                                                    <?php echo $empData[$dayKey]['start_time'] . ' - ' . $empData[$dayKey]['end_time']; ?>
                                                                </span>
                                                                <?php if (!empty($empData[$dayKey]['break_time'])) { ?>
                                                                    <br>
                                                                    <span class="pt-1 fs-12">
                                                                        <i class="bx bx-coffee text-danger fs-16"></i>
                                                                        Break: <?php echo $empData[$dayKey]['break_time']; ?>
                                                                    </span>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include the recreate roster modal -->
<?php $this->load->view('roster/recreateRosterModal'); ?>

<script>
function goBack() {
    window.history.back();
}

function formatDate(date) {
    return date.getDate() + ' ' + date.toLocaleDateString('en-us', { month: 'short' });
}

function getCurrentWeekStartDate() {
    let startDate = '<?php echo $rosterInfo[0]['start_date']; ?>';
    return new Date(startDate);
}

var currentWeekStartDate = getCurrentWeekStartDate();

function updateCurrentWeekText(fetchRosterData) {
    const endDate = new Date(currentWeekStartDate);
    endDate.setDate(currentWeekStartDate.getDate() + 6);
    const buttonText = formatDate(currentWeekStartDate) + ' - ' + formatDate(endDate);
    const encodedButtonText = encodeURIComponent(buttonText);
    $('.currentWeek').text(buttonText);
    if (fetchRosterData) {
        window.location.href = '/HR/fetchRosterOnArrowClick/' + encodedButtonText + '/WTM';
    }
}

function updatePrevWeekText() {
    currentWeekStartDate.setDate(currentWeekStartDate.getDate() - 7);
    updateCurrentWeekText(true);
}

function updateNextWeekText() {
    currentWeekStartDate.setDate(currentWeekStartDate.getDate() + 7);
    updateCurrentWeekText(true);
}

$('.prevWeek').click(function() {
    updatePrevWeekText();
});

$('.nextWeek').click(function() {
    updateNextWeekText();
});

$(".weekAreaAndTeam").on('change', function() {
    let rosterId = '<?php echo $rosterId; ?>';
    if (!rosterId || rosterId.trim() === '' || isNaN(parseInt(rosterId))) {
        rosterId = 0;
    }
    rosterId = parseInt(rosterId);

    if ($(this).val() == '1') {
        window.location.href = '/HR/rosterView/' + rosterId;
    } else if ($(this).val() == '3') {
        window.location.href = '/HR/rosterViewByTM/' + rosterId;
    } else {
        window.location.href = '/HR/rosterViewWTM/' + rosterId;
    }
});

function showRosterRecreateModal(roster_id) {
    $(".recreate_roster_id").val(roster_id);
    $("#recreateRosterModal").modal("show");
}
</script>