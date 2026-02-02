<style>
.shift-cell {
    padding: 8px;
    font-size: 12px;
    background-color: #f8f9fa;
    border-left: 3px solid #4CAF50;
}
.shift-time {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 4px;
}
.shift-break {
    color: #7f8c8d;
    font-size: 11px;
    margin-bottom: 2px;
}
.shift-prep {
    color: #3498db;
    font-size: 11px;
    font-style: italic;
}
.total-hours {
    font-weight: bold;
    color: #27ae60;
}
.empty-cell {
    background-color: #ecf0f1;
    text-align: center;
    color: #95a5a6;
}
</style>
<div class="main-content">
 <div class="page-content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <!--Loader-->
<?php 
    // Use roster dates if available, otherwise default to current week
    if (isset($rosterInfo[0]['start_date'])) {
        $monday = new DateTime($rosterInfo[0]['start_date']);
    } else {
        $monday = new DateTime('monday this week');
    }
    $sunday = clone $monday;
    $sunday->modify('+6 days');
    $date_text = $monday->format('d M') . ' - ' . $sunday->format('d M');
?>                    
<div id="loader-overlayAjax">
  <div class="spinner-border text-light" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>   

<div class="row mb-4 justify-content-between align-items-center mt-2">
        <div class="col-md-4">
            <h4 class="mb-0">Roster: <?php echo isset($rosterInfo[0]['rosterName']) ? htmlspecialchars($rosterInfo[0]['rosterName']) : 'Week View'; ?></h4>
        </div>
        
        <div class="col-md-8 d-flex gap-2 justify-content-end">
        <select class="form-select bg-primary-subtle fw-bold weekAreaAndTeam" style="color:#4b38b3; max-width: 200px;">
         <option  value="1">Week by Area</option>
         <option selected="" value="2">Week by Team Member</option>
         </select>
       <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold"><i class="ri-file-copy-fill fw-bold"></i>  Recreate</button>
        </div>
       
    </div> 
    
    
      <div class="card shadow-sm">
       <div class="card-body p-0">
       <div class="table-responsive">
       <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">   
                        <th style="min-width: 150px; position: sticky; left: 0; background-color: #f8f9fa; z-index: 10;">Employee</th>
                        <?php 
                        // Use the days array from controller
                        if (isset($days) && !empty($days)) {
                            foreach ($days as $dayInfo) { 
                                $dateObj = new DateTime($dayInfo['date']);
                        ?>               
                        <th style="min-width: 180px;">
                            <?php echo ucfirst($dayInfo['day']) . '<br><small class="text-muted">' . $dateObj->format('d M') . '</small>'; ?>
                        </th>
                        <?php 
                            }
                        }
                        ?> 
                         <th style="min-width: 100px;">Total Hrs</th>
      </thead>
     <tbody>
    <?php if(isset($rosterViewWTM) && !empty($rosterViewWTM)) {  ?>  
    <?php foreach($rosterViewWTM as $empId => $empData) {  ?> 
    <tr>
    <?php $weekTotalHrs = 0; ?>
    <td style="position: sticky; left: 0; background-color: white; z-index: 9; font-weight: 600;">
        <?php echo htmlspecialchars($empData['emp_name']); ?>
    </td>
  <?php  
    // Iterate through each day
    if (isset($days) && !empty($days)) {
        foreach ($days as $dayInfo) { 
            $dayKey = $dayInfo['day'];
            if (isset($empData[$dayKey]) && !empty($empData[$dayKey]['start_time'])) { 
                $shiftData = $empData[$dayKey];
                // Calculate hours
                $startTime = $shiftData['start_time'];
                $endTime = $shiftData['end_time'];
                $breakDuration = !empty($shiftData['break_duration']) ? (int)$shiftData['break_duration'] : 0;
                
                $totalHoursForDay = 0;
                if ($startTime && $endTime) {
                    $startDateTime = DateTime::createFromFormat('h:i A', $startTime);
                    $endDateTime = DateTime::createFromFormat('h:i A', $endTime);
                    if ($startDateTime && $endDateTime) {
                        $timeDifference = $endDateTime->diff($startDateTime);
                        $totalMinutes = ($timeDifference->h * 60) + $timeDifference->i + ($timeDifference->days * 24 * 60);
                        $totalMinutes -= $breakDuration;
                        $totalHoursForDay = round($totalMinutes / 60, 2);
                        $weekTotalHrs += $totalHoursForDay;
                    }
                }
  ?>  
    <td class="shift-cell">
        <div class="shift-time">
            <i class="ri-time-line"></i> <?php echo htmlspecialchars($startTime . ' - ' . $endTime); ?>
        </div>
        <?php if ($breakDuration > 0) { ?>
        <div class="shift-break">
            <i class="ri-cup-line"></i> Break: <?php echo $breakDuration; ?> min
        </div>
        <?php } ?>
        <div class="shift-prep">
            <i class="ri-map-pin-line"></i> <?php echo htmlspecialchars($empData['prep_name']); ?>
        </div>
        <div class="text-end mt-1">
            <span class="badge bg-success"><?php echo number_format($totalHoursForDay, 2); ?> hrs</span>
        </div>
    </td>
    <?php } else {  ?> 
    <td class="empty-cell">-</td>    
       <?php } 
       } // end foreach days
    } // end if days
    ?>  
        <td class="text-center total-hours"><?php echo number_format($weekTotalHrs, 2); ?> hrs</td>     
    </tr>    
        
     <?php } // end foreach employees ?> 
      <?php } else { ?> 
      <tr>
          <td colspan="<?php echo (isset($days) ? count($days) : 7) + 2; ?>" class="text-center text-muted py-4">
              <i class="ri-calendar-line" style="font-size: 24px;"></i><br>
              No roster data available
          </td>
      </tr>
      <?php } ?> 
      
     </tbody>
    
    
    </table>
    </div>
    <!-- rest code here -->
    
    </div> 
    </div> 
    </div> 
    </div>
    </div>
    <script>
  $(".weekAreaAndTeam").on('change', function() {
   let rosterId = '<?php echo isset($rosterId) ? $rosterId : 0; ?>';
    if ($(this).val() == '2') {
        window.location.href = '/HR/roster/rosterViewWTM/' + parseInt(rosterId);
    } else {
        window.location.href = '/HR/roster/rosterView/' + parseInt(rosterId); 
    }
});
    </script>