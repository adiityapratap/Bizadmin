
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
                        
                        
                        <button type="button" rel="day-filter" class="roster_filter_btn btn btn-soft-dark waves-effect waves-light shadow-none active">Day</button>
                        <button type="button" rel="emp-name-filter" class="roster_filter_btn btn btn-soft-dark waves-effect waves-light shadow-none ">Week</button>
                        <span id="todayDate" class="btn btn-ghost-success waves-effect waves-light shadow-none px-2 mx-4">Today: <?php echo date('d-m-Y'); ?></span>
                    </div>
                </div>
            <?php } ?>
            <?php
                    $datee = new DateTime($start_date);
                    $mondate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuesdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   
                ?>
            
            <div class="roster-wrap bg-white" id="day-filter">
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
                                        <th class="gridjs-th text-center text-muted">00:00</th> 
                                        <th class="gridjs-th text-center text-muted">01:00</th> 
                                        <th class="gridjs-th text-center text-muted">02:00</th> 
                                        <th class="gridjs-th text-center text-muted">03:00</th> 
                                        <th class="gridjs-th text-center text-muted">04:00</th> 
                                        <th class="gridjs-th text-center text-muted">05:00</th> 
                                        <th class="gridjs-th text-center text-muted">06:00</th> 
                                        <th class="gridjs-th text-center text-muted">07:00</th> 
                                        <th class="gridjs-th text-center text-muted">08:00</th> 
                                        <th class="gridjs-th text-center text-muted">09:00</th> 
                                        <th class="gridjs-th text-center text-muted">10:00</th> 
                                        <th class="gridjs-th text-center text-muted">11:00</th> 
                                        <th class="gridjs-th text-center text-muted">12:00</th> 
                                        <th class="gridjs-th text-center text-muted">13:00</th> 
                                        <th class="gridjs-th text-center text-muted">14:00</th> 
                                        <th class="gridjs-th text-center text-muted">15:00</th> 
                                        <th class="gridjs-th text-center text-muted">16:00</th> 
                                        <th class="gridjs-th text-center text-muted">17:00</th> 
                                        <th class="gridjs-th text-center text-muted">18:00</th> 
                                        <th class="gridjs-th text-center text-muted">19:00</th> 
                                        <th class="gridjs-th text-center text-muted">20:00</th> 
                                        <th class="gridjs-th text-center text-muted">21:00</th> 
                                        <th class="gridjs-th text-center text-muted">22:00</th> 
                                        <th class="gridjs-th text-center text-muted">23:00</th>  
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
<script src="<?php echo base_url(); ?>hr-assets/js/roster/roster_by_day.js"></script>
<input type="hidden" id="total_hrs_of_all_employee" value='<?php echo $total_hrs_of_all_employee; ?>'>
            <input type="hidden" id="total_cost" value='<?php echo $week_earning; ?>'>
            <input type="hidden" id="total_budget" value="<?php echo $budget; ?>">

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
    
    