
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>

    .tooltip .empFieldName {
    font-size: 13px;
    color: #000;
    margin: 0 !important;
}

.text_overflow_Name {
    white-space: nowrap;
    width: 90px;
    overflow: hidden;
    text-overflow: ellipsis;
}
span.roleName {
    color: #000;
}
#rosterDetails .tooltip {
    position: relative;
    display: inline-block;
    opacity: 1;
    cursor: pointer;
    font-size: 11px;
}
#rosterDetails .tooltip .tooltiptext {
    font-size: 13px;
    visibility: hidden;
    width: max-content;
    max-width: 220px;
    background: #fff;
    color: #000;
    text-align: center;
    border-radius: 4px;
    padding: 10px;
    position: absolute;
    z-index: 999;
    bottom: calc(100% + 11px);
    left: calc(50% + 3px);
    box-shadow: 0px 2px 26px rgb(0 0 0 / 26%);
    transform: translateX(-50%);
    font-weight: 400;
}
#rosterDetails .tooltip.left-tooltip  span.tooltiptext {
    left: 50%;
    transform: none;
}
#rosterDetails.tooltiptext p {
    margin: 6px 0 0;
    font-size: 11px;
    line-height: 12px;
}
#rosterDetails .tooltip:hover .tooltiptext {
    visibility: visible;
}
#rosterDetails .tooltip .tooltiptext {
    font-size: 13px;
    visibility: hidden;
    width: max-content;
    max-width: 220px;
    background: #fff;
    color: #000;
    text-align: center;
    border-radius: 4px;
    padding: 10px;
    position: absolute;
    z-index: 999;
    bottom: calc(100% + 11px);
    left: calc(50% + 3px);
    box-shadow:0px 2px 17px rgb(116 116 116 / 21%);
    transform: translateX(-50%);
    font-weight: 400;
}
#rosterDetails .tooltiptext p {
    margin: 6px 0 0;
    font-size: 11px;
    line-height: 12px;
}
.hrsTag{
    padding:1px !important;
}
.approvedHrs {
    border: 1px solid #26e900;
    background-color: #dbffd478;
    border-radius: .2rem;
    padding: 4px;
}
.totalHrs {
    border: 1px solid #26e900;
    background-color: #dbffd478;
    border-radius: .2rem;
    padding: 4px;
}
#rosterDetails.table > thead {
    border-bottom-width: 3px;
    border-top-width: 3px;
}
#rosterDetails td.gridjs-td {
    vertical-align: middle;
}
.sortBtns button {
    box-shadow: none !important;
}
.sortBtns button.active{
    background-color: #000;
    border-color:#000;
    color:#fff;
}
.modal-dialog.modal-fullscreen{
    max-width:100%;
    width:100%;
}

/*08-02-2023*/
.day-active {
    height: 4px;
}
.day-shift td {
    padding-left: 0;
    padding-right: 0;
    vertical-align: middle;
}
</style>
<div class="main-content">

    <div class="page-content">
                
        <div id="rosterDetails">
            <div class="modal-header py-2 px-3 bg-primary bg-gradient">
                <div><h5 class="modal-title text-white" id="rosterDetailsLabel">View Roster</h5><span class="text-white"></div>
                <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/admin/get_roster_weeks"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
            </div>
            <div class="card m-3">
                <div class="card-body">
                    <div class="row">
                <div class="col-xxl-4 col-lg-12">
                    <div class="mb-4 pb-2 custom_border-b-solid">
                        <span class="roster-details-title fw-medium">Roster Name :</span>
                        <span class="text-muted"><?php if(isset($roster_name) && $roster_name !='') {echo $roster_name;} ?></span>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-lg-6">
                    <div class="mb-4 pb-2 custom_border-b-solid">
                        <span class="roster-details-title fw-medium">Start date of the week :</span>
                        <span class="text-muted"><?php echo date("d-m-Y", strtotime($start_date) ); ?></span>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6">
                    <div class="mb-4 pb-2 custom_border-b-solid">
                        <span class="roster-details-title fw-medium">End date of the week :</span>
                        <span class="text-muted"><?php echo date("d-m-Y", strtotime($end_date) ); ?></span>
                    </div>
                </div>
                
                
                <div class="col-lg-4">
                    <div class="mb-4 pb-2 custom_border-b-solid">
                        <span class="roster-details-title fw-medium">Proj. Sales: :</span>
                        <span class="text-muted"><?php echo (isset($budget) && $budget != '') ? '$'.$budget.'.00' : ''; ?></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-4 pb-2 custom_border-b-solid">
                        <span class="roster-details-title fw-medium">Cost :</span>
                        <span class="text-muted" id="totall_cost"><?php echo number_format((float)$week_earning, 2, '.', ''); ?></span>
                    </div>
                </div>
                <div class="col-lg-4">
                        <div class="mb-4 pb-2 custom_border-b-solid">
                            <span class="roster-details-title fw-medium">Hours Allocated :</span>
                            <span class="text-muted" id="hours_worked"><?php echo $total_hrs_of_all_employee; ?></span>
                        </div>
                    </div>
                   
            </div>
                </div>
            </div>
            <?php if($role != 'employee'){ ?>
                <div class="sortBtns px-3 py-2">                   
                    <div class="btn-group" role="group" aria-label="Sort">
                        
                        <button type="button" rel="emp-name-filter" class="roster_filter_btn btn btn-soft-dark waves-effect waves-light shadow-none active">Employee</button>
                        <button type="button" rel="day-filter" class="roster_filter_btn btn btn-soft-dark waves-effect waves-light shadow-none">Day</button>
                        <span id="todayDate" style="display:none;" class="btn btn-ghost-success waves-effect waves-light shadow-none px-2 mx-4">Today: <?php echo date('d-m-Y'); ?></span>
                    </div>
                </div>
            <?php } ?>
            <?php
                    $datee = new DateTime($start_date);
                    $mondate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuesdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   
                ?>
            <div class="roster-wrap" id="emp-name-filter">
                <div class="table-responsive">
                
                 <table class="gridjs-table table table-striped table-hover">
                     <thead>
                        <tr>
                            <td class="gridjs-td text-center" width="150"> <input type="text" id="searchEmp" placeholder="Search Employee..." class="form-control fs-12"></th>
                            <td class="gridjs-td text-center"> Mon<br><span class="fs-12">(<?php echo $mondate; ?>)</span></td>   
                            <td class="gridjs-td text-center"> Tue<br><span class="fs-12">(<?php echo $tuesdate; ?>)</span></td>  
                            <td class="gridjs-td text-center"> Wed<br><span class="fs-12">(<?php echo $weddate; ?>)</span></td>  
                            <td class="gridjs-td text-center"> Thu<br><span class="fs-12">(<?php echo $thudate; ?>)</span></td>  
                            <td class="gridjs-td text-center"> Fri<br><span class="fs-12">(<?php echo $fridate; ?>)</span></td>  
                            <td class="gridjs-td text-center"> Sat<br><span class="fs-12">(<?php echo $satdate; ?>)</span></td>  
                            <td class="gridjs-td text-center"> Sun<br><span class="fs-12">(<?php echo $sundate; ?>)</span></td>
                            <!--<td class="gridjs-td text-center">Department</td>-->
                            <td class="gridjs-td text-center">Comment</td>
                            <td class="gridjs-td text-center">Total Hrs.</td>
                        </tr>
                        </thead>
                        <tbody>
                          	<?php foreach($roster as $row){ 
                          if($row->emp_name != '') {  $strEmp = $row->emp_name; }else{ $strEmp = ''; }  $empSubstr = stristr($strEmp," ",true); ?>
                          <tr>
                              <td class="gridjs-td hrsTag "><span class="tooltip text-center left-tooltip"><p class="empFieldName text_overflow_Name"><b><?php echo $strEmp; ?></b></p><span class="roleName text-muted"><?php echo $row->role_name; ?></span>
        							  <span class="tooltiptext">
        							      <b><?php echo $strEmp; ?></b>
        							  <p class="text-muted"><?php echo "( ".str_replace('_', ' ', $row->emp_type). " )"; ?><br><span><?php echo $row->emp_hours_worked_this_week.' Hrs'; ?></span></p>
        							  </span>
        						</span>
        					</td>
        					<?php  
        					$week_days = array('mon','tues','wed','thus','fri','sat','sun');
                            $outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        					for ($i = 0; $i < 7; $i++) { 
                    
                                $start_nameofday = $week_days[$i].'_start_time';
                                $end_nameofday = $week_days[$i].'_end_time'; 
                                $break_nameofday = $week_days[$i].'_break_time'; 
                                
                                $break_in_outName = $week_days[$i].'_break_in_out';
                                           
                                $break_in_out = unserialize($row->$break_in_outName);
                                
                                
                                $layout_nameofday = $outletweek_days[$i].'_layout_name'; 
                                $time1 = strtotime($row->$start_nameofday);
                                $time2 = strtotime($row->$end_nameofday);
                                // $breaktime1 = strtotime($row->$break_startname);
                                // $breaktime2 = strtotime($row->$break_endname);
                                $break_hrs = $row->$break_nameofday;
                                if($time2 !='' && $time1 !=''){
                                     $difference = round(abs(($time2 - $time1)) / 3600,2);
                                 $hr_in_min = $difference* 60;
                            
                                $difference = $hr_in_min - $break_hrs;
                                $difference = floor($difference / 60).':'.($difference -   floor($difference / 60) * 60);  
                                }else{
                                      $difference = 0;
                                }
                                // if($breaktime1 !='' && $breaktime2 !=''){
                                //      $breakdifference = round(abs(($breaktime2 - $breaktime1)) / 3600,2);
                                //  $break_hr_in_min = $breakdifference* 60;
                            
                               
                                // $breakdifference = floor($break_hr_in_min / 60).':'.($break_hr_in_min -   floor($break_hr_in_min / 60) * 60);  
                                // }else{
                                //       $breakdifference = 0;
                                // }
                                
                            ?>
                            <td class="gridjs-td hrsTag">
                              
                                <?php if($row->$start_nameofday != 0 && $row->$end_nameofday != 0) {?>
                                <div class="approvedHrs">
                                        <div class="align-items-center d-flex">
                                            <div class="flex-grow-1">
                                                <span class="tooltip">
                                                    <?php echo date ('H:i',strtotime($row->$start_nameofday)); ?>
                                                    -
                                                    <?php echo date ('H:i',strtotime($row->$end_nameofday)); ?>
                                                    
                                                    <span class="tooltiptext">
                                                        <table border="0" style="border: 0 !important;">
                                                            <tbody><tr>
                                                                <td class="text-muted fs-12 px-1" style="border: 0!important;border-right: 1px solid #ccc  !important;">Start<br><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i A',strtotime($row->$start_nameofday)); } ?></td>
                                                                <td class="text-muted fs-12 px-1" style="border: 0 !important;border-right: 1px solid #ccc  !important;">Finish<br><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i A',strtotime($row->$end_nameofday)); }?></td>
                                                                <td class="text-muted fs-12 px-1" style="border: 0 !important;">Hrs<br><?php echo $difference; ?></td>
                                                            </tr></tbody>
                                                        </table>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="flex-shrink-0"><span class="badge bg-primary"><?php echo $difference; ?></span></div>
                                        </div>
                                    <span class="text-muted px-1 fs-10">Break Time: </span> 
                                    
                                                <span class="tooltip p-0">
                                                    <?php echo $break_hrs; ?>
                                                   
                                                    <span class="tooltiptext">
                                                        <table border="0" style="border: 0 !important;">
                                                            <tbody><tr>
                                                                <td class="text-muted fs-12 px-1" style="border: 0!important;border-right: 1px solid #ccc  !important;">Break Start<br><?php if($break_in_out[0]['break_start'] == 0 && $break_in_out[0]['break_start'] ==0) { echo '   ';  } else {   echo date ('H:i A',strtotime($break_in_out[0]['break_start'])); } ?></td>
                                                                <td class="text-muted fs-12 px-1" style="border: 0 !important;border-right: 1px solid #ccc  !important;">Break End<br><?php if($break_in_out[0]['break_start'] == 0 && $break_in_out[0]['break_finish'] ==0) {  echo '   '; } else {   echo date ('H:i A',strtotime($break_in_out[0]['break_finish'])); }?></td>
                                                                <td class="text-muted fs-12 px-1" style="border: 0 !important;">Hrs<br><?php echo $break_hrs; ?></td>
                                                            </tr></tbody>
                                                        </table>
                                                    </span>
                                                </span>
        
                                    
                                        <?php if($row->$layout_nameofday != '') {  
                                                   $str = $row->$layout_nameofday; 
                                             }else{ $str = ''; } 
                                    
                                    
                                    if ($str !=''){ $outletSubstr = substr($str,0,8);?>
                                    <br>
                                    <span class="tooltip p-0"><span class="text-muted px-1 fs-10">Outlet - </span> <?php echo $outletSubstr; ?>
        								  <span class="tooltiptext">Outlet : <?php echo $str; ?></span>
        							</span>
        							<?php } ?>
        						   </div>
                                <?php } ?>
                            </td>
                            <?php } ?>
                           <!--<td class="gridjs-td"><?php echo $row->department_name; ?></td>-->
                           <td class="gridjs-td"><?php echo $row->roster_comment; ?></td>
                           <td class="gridjs-td"><span class="badge bg-danger"><?php echo $row->emp_hours_worked_this_week.' Hrs'; ?></span> </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                </div>
            </div>
            <div class="roster-wrap bg-white" id="day-filter" style="display:none;">
                <?php  
                $today = date('d-m-Y');
                    if($mondate == $today){
                        $week_days = 'mon';
                    }else if($tuesdate == $today){
                       $week_days = 'tues';
                    }else if($weddate == $today){
                        $week_days = 'wed';
                    }else if($thudate == $today){
                        $week_days = 'thus';
                    }else if($fridate == $today){
                        $week_days = 'fri';
                    }else if($satdate == $today){
                        $week_days = 'sat';
                    }else if($sundate == $today){
                        $week_days = 'sun';
                    }else{
                        $week_days = '';
                    }
                    
                    $weekdate = new DateTime($start_date);
                     
					    if($i == 0){
					        $dt = $weekdate->format('d-m-Y');
					    }else{
					        $weekdate->modify('+1 day');
					        $dt = $weekdate->format('d-m-Y');
					    }
					    
					?>
                        
                        <div class="table-responsive">
                            <table class="gridjs-table table table-striped day-shift">
                                <thead>
                                    <tr>
                                        <th class="gridjs-th text-center text-muted">Employee</th> 
                                        <th class="gridjs-th text-center text-muted">1AM</th> 
                                        <th class="gridjs-th text-center text-muted">2AM</th> 
                                        <th class="gridjs-th text-center text-muted">3AM</th> 
                                        <th class="gridjs-th text-center text-muted">4AM</th> 
                                        <th class="gridjs-th text-center text-muted">5AM</th> 
                                        <th class="gridjs-th text-center text-muted">6AM</th> 
                                        <th class="gridjs-th text-center text-muted">7AM</th> 
                                        <th class="gridjs-th text-center text-muted">8AM</th> 
                                        <th class="gridjs-th text-center text-muted">9AM</th> 
                                        <th class="gridjs-th text-center text-muted">10AM</th> 
                                        <th class="gridjs-th text-center text-muted">11AM</th> 
                                        <th class="gridjs-th text-center text-muted">12PM</th> 
                                        <th class="gridjs-th text-center text-muted">1PM</th> 
                                        <th class="gridjs-th text-center text-muted">2PM</th> 
                                        <th class="gridjs-th text-center text-muted">3PM</th> 
                                        <th class="gridjs-th text-center text-muted">4PM</th> 
                                        <th class="gridjs-th text-center text-muted">5PM</th> 
                                        <th class="gridjs-th text-center text-muted">6PM</th> 
                                        <th class="gridjs-th text-center text-muted">7PM</th> 
                                        <th class="gridjs-th text-center text-muted">8PM</th> 
                                        <th class="gridjs-th text-center text-muted">9PM</th> 
                                        <th class="gridjs-th text-center text-muted">10PM</th> 
                                        <th class="gridjs-th text-center text-muted">11PM</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $datacount = 0; foreach($roster as $row){ 
                                        if($row->emp_name != '') {  $strEmp = $row->emp_name; }else{ $strEmp = ''; }  $empSubstr = stristr($strEmp," ",true); ?>
                                        <?php  
                                            $start_nameofday = $week_days.'_start_time';
                                            $end_nameofday = $week_days.'_end_time'; 
                                            $break_nameofday = $week_days.'_break_time'; 
                                            
                                            $break_in_outName = $week_days.'_break_in_out';
                                                       
                                            $break_in_out = unserialize($row->$break_in_outName);
                                            
                                            $time1 = strtotime($row->$start_nameofday);
                                            $time2 = strtotime($row->$end_nameofday);
                                            $break_hrs = $row->$break_nameofday;
                                            if($time2 !='' && $time1 !=''){
                                                 $difference = round(abs(($time2 - $time1)) / 3600,2);
                                             $hr_in_min = $difference* 60;
                                        
                                            $difference = $hr_in_min - $break_hrs;
                                            $difference = floor($difference / 60).':'.($difference -   floor($difference / 60) * 60);  
                                            }else{
                                                  $difference = 0;
                                            }
                                            if($row->$start_nameofday != ''){
                                                $startDate = date('H:i',strtotime($row->$start_nameofday));
                                            }else{
                                                $startDate = ''; 
                                            }
                                            if($row->$end_nameofday != ''){
                                                $endDate = date('H:i',strtotime($row->$end_nameofday));
                                            }else{
                                                $endDate = ''; 
                                            }
                                            if($row->$end_nameofday != ''){
                                                $break_start = date('H:i',strtotime($break_in_out[0]['break_start']));
                                            }else{
                                                $break_start = ''; 
                                            }
                                            if($row->$end_nameofday != ''){
                                                $break_finish = date('H:i',strtotime($break_in_out[0]['break_finish']));
                                            }else{
                                                $break_finish = ''; 
                                            }
                                            
                                           if($startDate != '' && $endDate != ''){
                                        ?>
                                        <tr> 
                                            <td class="px-1 text-center custom_border-solid"><?php echo $strEmp; ?></td>
                                            <td rel="00:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '00:00') && ($break_finish != '' && $break_finish >= '00:00') ){ echo 'bg-warning'; } else if( $startDate <= '00:00' && $endDate >= '00:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="01:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '01:00') && ($break_finish != '' && $break_finish >= '01:00') ){ echo 'bg-warning'; } else if( $startDate <= '01:00' && $endDate >= '01:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="02:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '02:00') && ($break_finish != '' && $break_finish >= '02:00') ){ echo 'bg-warning'; } else if( $startDate <= '02:00' && $endDate >= '02:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="03:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '03:00') && ($break_finish != '' && $break_finish >= '03:00') ){ echo 'bg-warning'; } else if( $startDate <= '03:00' && $endDate >= '03:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="04:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '04:00') && ($break_finish != '' && $break_finish >= '04:00') ){ echo 'bg-warning'; } else if( $startDate <= '04:00' && $endDate >= '04:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="05:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '05:00') && ($break_finish != '' && $break_finish >= '05:00') ){ echo 'bg-warning'; } else if( $startDate <= '05:00' && $endDate >= '05:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="06:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '06:00') && ($break_finish != '' && $break_finish >= '06:00') ){ echo 'bg-warning'; } else if( $startDate <= '06:00' && $endDate >= '06:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="07:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '07:00') && ($break_finish != '' && $break_finish >= '07:00') ){ echo 'bg-warning'; } else if( $startDate <= '07:00' && $endDate >= '07:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="08:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '08:00') && ($break_finish != '' && $break_finish >= '08:00') ){ echo 'bg-warning'; } else if( $startDate <= '08:00' && $endDate >= '08:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="09:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '09:00') && ($break_finish != '' && $break_finish >= '09:00') ){ echo 'bg-warning'; } else if( $startDate <= '09:00' && $endDate >= '09:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="10:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '10:00') && ($break_finish != '' && $break_finish >= '10:00') ){ echo 'bg-warning'; } else if( $startDate <= '10:00' && $endDate >= '10:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="11:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '11:00') && ($break_finish != '' && $break_finish >= '11:00') ){ echo 'bg-warning'; } else if( $startDate <= '11:00' && $endDate >= '11:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="12:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '12:00') && ($break_finish != '' && $break_finish >= '12:00') ){ echo 'bg-warning'; } else if( $startDate <= '12:00' && $endDate >= '12:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="13:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '13:00') && ($break_finish != '' && $break_finish >= '13:00') ){ echo 'bg-warning'; } else if( $startDate <= '13:00' && $endDate >= '13:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="14:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '14:00') && ($break_finish != '' && $break_finish >= '14:00') ){ echo 'bg-warning'; } else if( $startDate <= '14:00' && $endDate >= '14:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="15:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '15:00') && ($break_finish != '' && $break_finish >= '15:00') ){ echo 'bg-warning'; } else if( $startDate <= '15:00' && $endDate >= '15:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="16:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '16:00') && ($break_finish != '' && $break_finish >= '16:00') ){ echo 'bg-warning'; } else if( $startDate <= '16:00' && $endDate >= '16:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="17:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '17:00') && ($break_finish != '' && $break_finish >= '17:00') ){ echo 'bg-warning'; } else if( $startDate <= '17:00' && $endDate >= '17:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="18:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '18:00') && ($break_finish != '' && $break_finish >= '18:00') ){ echo 'bg-warning'; } else if( $startDate <= '18:00' && $endDate >= '18:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="19:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '19:00') && ($break_finish != '' && $break_finish >= '19:00') ){ echo 'bg-warning'; } else if( $startDate <= '19:00' && $endDate >= '19:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="20:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '20:00') && ($break_finish != '' && $break_finish >= '20:00') ){ echo 'bg-warning'; } else if( $startDate <= '20:00' && $endDate >= '20:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="21:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '21:00') && ($break_finish != '' && $break_finish >= '21:00') ){ echo 'bg-warning'; } else if( $startDate <= '21:00' && $endDate >= '21:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="22:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '22:00') && ($break_finish != '' && $break_finish >= '22:00') ){ echo 'bg-warning'; } else if( $startDate <= '22:00' && $endDate >= '22:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                            <td rel="23:00"><div class="day-active w-100 <?php if( ($break_start != '' && $break_start <= '23:00') && ($break_finish != '' && $break_finish >= '23:00') ){ echo 'bg-warning'; } else if( $startDate <= '23:00' && $endDate >= '23:00' ){ echo 'bg-success'; }else{ echo ''; } ?>"></div> </td>
                                          
                                        </tr>
                                        
                                    <?php $datacount = 1;} } ?>
                                        <?php if($datacount == 0){ ?>
                                            <tr><td class="px-1 text-center text-muted" colspan="24">No employee rosted today</td></tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>   
            </div>
        </div>
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
    
            
</div>
<!-- END layout-wrapper -->
<input type="hidden" id="total_hrs_of_all_employee" value='<?php echo $total_hrs_of_all_employee; ?>'>
            <input type="hidden" id="total_cost" value='<?php echo $week_earning; ?>'>
            <input type="hidden" id="total_budget" value="<?php echo $budget; ?>">
    
    <script>
        function rosterDetails(){
            $("#rosterDetails").addClass('show');
            $("#rosterDetails").css('display','block');
        }
        $('#rosterDetailsClose').click(function(){
            $("#rosterDetails").removeClass('show');
            $("#rosterDetails").css('display','none');
        });
        
    </script>
    <script>
function send_email(){

var roster_group_id = $("#roster_group_id").val();
    

   $.ajax({
		url:"<?php echo base_url();?>index.php/admin/send_email",
		method:"POST",
		data:{roster_group_id:roster_group_id},
		beforeSend: function(){
        $("#overlayplaceorder").show();
        },
	    success:function(data){
		Swal.fire("Email sent succesfully", {
         buttons: {
           ok: "Ok",
    
  },
})
			},
			complete:function(data){
         $("#overlayplaceorder").hide();
        }
	})

}
// var budget = Number.parseFloat($("#total_budget").val());
// var cost = Number.parseFloat($("#total_cost").val());
// var balance = Number(budget) - Number(cost) ;
// var balance = Math.abs(balance);

// console.log('cost'+cost.toFixed(2));

// $("#totall_cost").val('$'+cost.toFixed(2));
// if(Number(budget) < Number(cost)){
// $("#balance").val('- $'+balance.toFixed(2));
// }else{
// $("#balance").val('$'+balance.toFixed(2));
// }

// $("#hours_worked").val($("#total_hrs_of_all_employee").val());


 $(document).on("click", ".roster_filter_btn" , function() {
     var id = $(this).attr('rel');
     $('.roster_filter_btn').removeClass('active');
     $('.roster-wrap').css('display','none');
     $(this).addClass('active');
     $('#'+id).css('display','block');
     if(id == 'day-filter'){
        $('#todayDate').show();
     }else{
         $('#todayDate').hide();
     }
 });
</script>
    
    