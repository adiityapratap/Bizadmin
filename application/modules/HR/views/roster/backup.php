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
        <div class="col-md-2">
        <select class="form-select bg-primary-subtle fw-bold" style="color:#4b38b3">
            <?php if(isset($sites) && !empty($sites)) {  ?>
        <option selected=""> Select Site</option> 
            <?php foreach($sites as $site) {  ?>
         <option  value="<?php echo $site['id'] ?>"><?php echo $site['site_name'] ?></option>
         <?php }  ?>
        <?php }  ?>
         </select>
         </div>
        <div class="col-md-3 d-flex gap-2">
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none prevWeek"><i class="ri-arrow-left-s-line fw-bold"></i></button>   
        <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek"><?php echo $date_text; ?></button>    
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none nextWeek"><i class="ri-arrow-right-s-line fw-bold"></i></button>   
        </div>
        <div class="col-md-2">
        <select class="form-select bg-primary-subtle fw-bold weekAreaAndTeam" style="color:#4b38b3">
         <option  value="1">Week by Area</option>
         <option selected="" value="2">Week by Team Member</option>
         </select>
        </div>
        
        <div class="col-md-2">
       <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none w-100 fw-bold"><i class="ri-file-copy-fill fw-bold"></i>  Recreate</button>
        </div>
        <div class="col-md-2">
       <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none w-100 fw-bold" onclick="publishRoster()"><i class="ri-save-2-fill fw-bold"></i>  Publish</button>
        </div>
    </div> 
    
       <div class="row">
        <div class="col-12">
        <div class="card h-100 shadow-none">
        <div class="card-header"><h4 class="card-title mb-0 text-black">Employees</h4> </div>
                  
           <div class="card-body">

           
           <div class="col-12"> 
           
           <div class="table-responsive">
               <div class="mb-3 px-3">
                 <input type="text" class="form-control filterEmployeeLeftPanel" placeholder="Search employee">
                     <a id="clearFilter" href="#"><small class="text-danger float-end">clear</small></a>
                     </div>    
                            <table class="table align-middle table-nowrap table-bordered">
                                <thead class="table-light">
                                   <tr>
    <th class="text-center">Employee</th> 
    <?php for ($hour = 0; $hour < 24; $hour++) : ?>
        <?php
        // Calculate the hour in 12-hour format with AM/PM
        $hourStr = ($hour % 12 == 0) ? '12' : ($hour % 12);
        $ampm = ($hour < 12) ? 'AM' : 'PM';
        ?>
        <th class="text-center"><?php echo $hourStr . $ampm; ?></th> 
    <?php endfor; ?>
</tr>
                                </thead>
                                <tbody>
            <?php if(isset($empLists) && !empty($empLists)) {  ?>
            <?php  foreach($empLists as $empList) { ?>      
            <?php $strEmp = $empList['first_name'].' '.$empList['last_name']; ?>
            
             <tr> 
          <td class="px-1 text-center custom_border-solid"><?php echo $strEmp; ?></td>
         <?php for ($hour = 0; $hour < 24; $hour++) { ?>
         
         <?php  $class = '';
          $hourTime = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
          $hourStr = date('H:i', strtotime($hourTime));
         
            if(isset($rosterDayWiseData[$empList['emp_id']]) && !empty($rosterDayWiseData[$empList['emp_id']])){
             $allPreps = $rosterDayWiseData[$empList['emp_id']];
             if(isset($allPreps) && !empty($allPreps)){
              foreach($allPreps as $allPrep){
                  
               $workHrs =   $allPrep['workHrs'];
               $workingHrsText = '';
               $workHrsArray = explode('-', str_replace(' ', '', $workHrs));
               $startTime = date('H:i', strtotime($workHrsArray[0]));
               $endTime = date('H:i', strtotime($workHrsArray[1]));
               $breakHour = date('H:i', strtotime($allPrep['breakHrs']));
               
               if ($hourStr >= $startTime && $hourStr <= $endTime) {
                $class = 'bg-success text-success'; // Apply background color for work hours
                $workingHrsText = $workHrs.'('.$rosterDayWiseData[$empList['emp_id']]['prep_name'].')';
                }
               if ($hourStr === $breakHour) {
                $class = 'bg-danger';   
               }
              }   
             }
                
            }
            ?>
        
        <td rel="<?php echo $hourStr; ?>" class="px-0"><span class="badge <?php echo $class; ?> w-100 rounded-0" >-</span></td>

    <?php } ?>
    </tr>    
            <?php } }  ?>                    
            </tbody>
            
           </div>
           </div>
          </div> 
          </div>
       </div>
</div>

</div>
</div>
</div>
<script>
$(".weekAreaAndTeam").on('change', function() {
   let rosterId = '<?php echo $rosterId; ?>';
    if ($(this).val() == '2') {
        window.location.href = '/HR/rosterViewByTM/' + parseInt(rosterId);
    } else {
        window.location.href = '/HR/rosterView/' + parseInt(rosterId);
    }
});
</script>