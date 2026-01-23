<style>
.approvedHrs{
    border: 1px solid #26e900;
    background-color: #dbffd478;
    border-radius: .2rem;
    padding: 4px;
}
</style>
<div class="main-content">
 <div class="page-content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <!--Loader-->
<?php $monday = new DateTime('monday this week'); ?>
  <?php $date_text = $monday->format('d M') . ' - ' . $monday->modify('+6 days')->format('d M'); ?>                    
<div id="loader-overlayAjax">
  <div class="spinner-border text-light" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>   

<div class="row mb-4 justify-content-end mt-2">
        
        <div class="col-md-3 d-flex gap-2">
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none prevWeek"><i class="ri-arrow-left-s-line fw-bold"></i></button>   
        <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek"><?php echo $date_text; ?></button>    
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none nextWeek"><i class="ri-arrow-right-s-line fw-bold"></i></button>   
        </div>
        <div class="col-md-2">
        <select class="form-select bg-primary-subtle fw-bold weekAreaAndTeam" style="color:#4b38b3">
         <option  value="1">Week by Area</option>
         <option selected="" value="2">Week by Team Member</option>
         <option  value="3">Day by Team Member</option>
         </select>
        </div>
        
        <div class="col-md-2">
       <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none w-100 fw-bold"><i class="ri-file-copy-fill fw-bold"></i>  Recreate</button>
        </div>
       
    </div> 
    
    
      <div class="card h-100 shadow-none">
       <div class="card-body table-responsive">
       <table class="table table-bordered">
                        <?php  $currentMonday = date('Y-m-d', strtotime('monday this week')); ?>
                        <?php  $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); ?>
                                       
                        <thead class="table-light">   
                        <th> Employee </th>
                        <?php foreach ($days as $day) { ?>               
                        <th><?php echo $day.' '.date('d-m', strtotime($currentMonday)); ?></th>
                        <?php $currentMonday = date('Y-m-d', strtotime('+1 day', strtotime($currentMonday))); ?>
                        <?php } ?> 
                         <th> Total Hrs </th>
      </thead>
     <tbody>
    <?php if(isset($rosterViewWTM) && !empty($rosterViewWTM)) {  ?>  
    <?php foreach($rosterViewWTM as $rosterViewWTMData) {  ?> 
    <tr class="accordion-collapse collapse show">
    <?php $lowercaseDays = array_map('strtolower', $days); $weekTotalHrs = 0; ?>
    <td> <?php echo $rosterViewWTMData['emp_name']; ?></td>
  <?php  foreach ($lowercaseDays as $lday) { ?> 
  <?php $rosterDayData = json_decode($rosterViewWTMData[$lday]); ?>
    <?php if(isset($rosterDayData) && !empty($rosterDayData)) { ?>  
    <td class="gridjs-td hrsTag">
       <div class="approvedHrs">
                                        <div class="align-items-center d-flex">
                                            <div class="flex-grow-1">
                                                <span>
                                                <?php echo $empShiftStartTime = $rosterDayData->empShiftStartTime ?>                                           -
                                                 <?php echo $empShiftEndTime = $rosterDayData->empShiftEndTime ?>    
                                                 <?php
                                             $startDateTime = DateTime::createFromFormat('h:i A', $empShiftStartTime);
                                             $endDateTime = DateTime::createFromFormat('h:i A', $empShiftEndTime);    
                                             $timeDifference = $endDateTime->diff($startDateTime);  
                                             $totalHoursForDay = $timeDifference->h + ($timeDifference->days * 24);    
                                             $breakMinutes = $rosterDayData->breakDuration ? $rosterDayData->breakDuration : '';
                                             if($breakMinutes !=''){
                                             $totalHoursForDay -= ($breakMinutes / 60);   $weekTotalHrs += $totalHoursForDay;    
                                             }else{
                                            $weekTotalHrs += $totalHoursForDay;         
                                             }
                                             
                                             
                                                 ?>
                                           </span>
                                            </div>
                        <div class="flex-shrink-0"><span class="badge bg-primary"><?php echo $totalHoursForDay; ?></span></div>
                                        </div>
                                    <span class="text-black px-1 fs-10">Break Time: </span> 
                                    <span class="p-0"><?php echo $breakMinutes; ?> </span>
                                     <br>
                                    <span class="p-0"><span class="text-black px-1 fs-10">Prep Area - </span> <?php echo $rosterViewWTMData['prep_name']; ?>
        							</span>
        							</div>
                                    </td>
    <?php }else {  ?> 
    <td class="gridjs-td hrsTag"></td>    
       <?php } ?>  
       <?php } ?>
        <td> <?php echo $weekTotalHrs; ?></td>     
    </tr>    
        
     <?php } ?> 
      <?php } ?> 
      
     </tbody>
    
    
    </table>
    <!-- rest code here -->
    
    </div> 
    </div> 
    </div> 
    </div>
    </div>
    <script>
  $(".weekAreaAndTeam").on('change', function() {
   let rosterId = '<?php echo $rosterId; ?>';
    if ($(this).val() == '3') {
        window.location.href = '/HR/rosterViewByTM/' + parseInt(rosterId);
    } else if($(this).val() == '2') {
        window.location.href = '/HR/rosterViewWTM/' + parseInt(rosterId);
    }else{
        window.location.href = '/HR/rosterView/' + parseInt(rosterId); 
    }
});
    </script>