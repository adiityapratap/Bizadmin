
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
.custom-avtar {
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    border-radius: 50%;
    background-color: #efefef;
    padding: 20px;
    color: #5b5b5b;
    position: relative;
    font-weight: 700;
}
</style>
<div class="main-content">

    <div class="page-content">
                
        <div id="rosterDetails">
            <div class="modal-header py-2 px-3 bg-primary bg-gradient">
                <div><h5 class="modal-title text-white" id="rosterDetailsLabel">Create Roster</h5></div>
                <div><button type="button" onclick="rosterFormSubmit()" class="btn btn-success mr-1">Create</button>
                <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/admin/get_roster_day">Cancel</a>
            </div>
            </div>
            <div class="card m-3">
                <div class="card-body">
                    <div class="row py-4">
                    <div class="col-lg-3">
                            <div class="align-items-center d-flex">
                                            
                            <div class="flex-shrink-0"><span class="w76 px-2">Roster Name </span></div>
                            <div class="flex-grow-1">
                                <input type='text' class="form-control" name="roster_name" autocomplete="off" required placeholder="Roster Name"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="align-items-center d-flex">
                            <div class="flex-shrink-0"><span class="w76 px-2">Start Date </span></div>
                            <div class="flex-grow-1">
                                   <input type="text" class="form-control" id="start_date" name="start_date" data-provider="flatpickr" data-date-format="d-m-Y" placeholder="Start Date" requied> 
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
            <div class="roster-wrap bg-white px-3">
                <div class="row mt-4">
                    <div class="col-lg-2 p-0">
                        <div class="py-2">
                                    <label for="autoCompleteFruit" class="text-muted">Search Employee</label>
                                    <input id="autoCompleteFruit" class="form-control" type="text" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                                </div>
                        <div data-simplebar class="h-100">
                            <div class="acitivity-timeline acitivity-main">
                                
                                <?php if(!empty($employees)){ 
                                foreach($employees as $emp){
                                ?>
                                <div class="acitivity-item d-flex mt-4">
                                    <div class="flex-grow-1 ms-3">
                                        <div class="align-items-center d-flex gap-3">
                                            <div class="flex-shrink-0"><div class="mx-auto avatar-xs"><div class="custom-avtar custom-avtar fs-14 p-1 text-uppercase"><?php echo substr($emp->first_name,0,1)?></div></div></div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 lh-base"><?php echo $emp->first_name.' '.$emp->last_name; ?></h6>
                                            </div>
                                        </div>
                                        <div class="mt-3" style="display:none;">
                                            <p class="mb-1 lh-base">Total Hours: <span class="text-end">0</span></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">  
                        <div class="bg-light w-100 h-100">
                            <div class="table-responsive">
                                <table class="gridjs-table table table-striped day-shift">
                                    <thead>
                                        <tr> 
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
                                            <tr class="employeeRole" id="empRosterRow_1" data-count="1"> 
                                               
                                                <td colspan="24" class="gridjs-td hrsTag">
                                                    <div class="addHrs" title="Add Hours" rel="<?php echo $week_days[$i]; ?>" data-rel-id="row_<?php echo $week_days[$i]; ?>_1" onclick="addRosterTime(this)">+</div>
                                                    <div class="approvedHrs pointerCursor" title="Edit Hours" rel="<?php echo $week_days[$i]; ?>" data-rel-id="row_<?php echo $week_days[$i]; ?>_1" onclick="editRosterTime(this)" style="display:none">
                                                        <div class="fs-10"><span class="startTimeValue"></span> - <span class="finishTimeValue"></span></div>
                                                        <div class="fs-10">Break: <span class="breakTimeValue">0</span></div>
                                                        <div class=" fs-10">Outlet: <span class="outletNameValue"></span> </div>
                                                        <input type="hidden" class="startTimeInputValue" name="<?php echo $startName;  ?>" value="">
                                                        <input type="hidden" class="finishTimeInputValue" name="<?php echo $endName;  ?>" value="">
                                                        <input type="hidden" class="breakTimeInputValue" name="<?php echo $breakName;  ?>" value="">
                                                        <input type="hidden" class="outletNameID" name="<?php echo $layout;  ?>" value="">
                                                        <div class="breakInOutTime"></div>
                        						   </div>
                                                </td>
                                               
                                            </tr>
                                     
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
    
            
</div>

<div class="modal fade RosterModel" id="addRosterTime" tabindex="-1" aria-labelledby="addRosterTimeLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <div><h5 class="modal-title text-capitalize" id="addRosterTimeLabel">Add Time</h5></div>
                    <div>
                        <input type="hidden" class="form-control" id="rowId" value="">
                        <button type="button" id="addRosterTimeClose" class="btn btn-light btn-sm ModalClose" >Cancel</button>
                        <button type="button" id="addRosterTimeBtn" class="btn btn-primary btn-sm" onclick="addtime()">Add</button>
                    </div>
                </div>
                <div class="modal-body">
                        
                        <div class="row g-2">
                            
                            <div class="col-xxl-12 col-lg-12" id="timealert" style="display:none">
                                <div class="alert alert-danger shadow mb-xl-0" role="alert">
                                    <strong> Start Time </strong>and<strong> End Time </strong>fields are mandatory.
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-6 col-sm-12 mt-3">
                                <div>
                                    <label for="startTime" class="form-label">Start Time</label>
                                    <input type="text" class="form-control" id="startTime" data-provider="timepickr" data-time-basic="true" placeholder="Start Time">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6 col-lg-6 col-sm-12 mt-3">
                                <div>
                                    <label for="finishTime" class="form-label">Finish Time</label>
                                    <input type="text" class="form-control" id="finishTime" data-provider="timepickr" data-time-basic="true" placeholder="Finish Time">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                <div class="breakTimeRow">
                                    <div class="align-items-center row g-2 ">
                                        <div class="col-lg-5 col-sm-5 col-xs-12 mt-3">
                                            <label for="breakTimeStart" class="form-label">Break Time Start</label>
                                            <input type="text" class="form-control breakTimeStart" data-provider="timepickr" data-time-basic="true" placeholder="Break Time Start">
                                        </div>
                                        <div class="col-lg-5 col-sm-5 col-xs-12 mt-3">
                                            <label for="breakTimeFinish" class="form-label">Break Time Finish</label>
                                            <input type="text" class="form-control breakTimeFinish" data-provider="timepickr" data-time-basic="true" placeholder="Break Time Finish">
                                        </div>
                                        <div class="col-lg-2 col-sm-2 col-xs-12 mt-3">
                                            <label for="breakTimeDuration" class="form-label">Duration</label>
                                            <input type="text" class="form-control breakTimeDuration" readonly placeholder="Hours">
                                        </div>
                                    </div>
                                    <!--<p class="pointerCursor mt-2 mb-0 fw-medium text-end breakBtns"><span class="text-primary addBreakTimeBtn">+ Add Break Time</span></p>-->
                                </div>
                                
                            </div><!--end col-->
                           
                            <div class="col-xxl-12 col-lg-12 col-sm-12 mt-3">
                                <div> 
                                    <label for="outletName" class="form-label">Outlet Name</label>
                                    <!--<input type="text" class="form-control" id="outletName" placeholder="Outlet Name">-->
                                    <select class="form-control " id="outletName">
                                	  <option value="" class="text-mute">Select</option>
                                	  <option value="add_outlet" class="text-center text-primary fw-medium bg-soft-secondary py-1">+ Add New Outlet</option>
                                	  <?php foreach($outlet as $ot){ ?> 
                                	     <option value="<?php echo $ot->outlet_id; ?>"><?php echo $ot->outlet_name; ?></option>
                                	  <?php } ?>
                                    </select>
                                </div>
                            </div><!--end col-->
                           
                        </div><!--end row-->
                   
                </div>
 
            </div>
        </div>
</div>

<div class="modal fade RosterModel" id="addEmployeeModel" tabindex="-1" aria-labelledby="addEmployeeModelLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <div><h5 class="modal-title" id="addEmployeeModelLabel">Add Employee</h5></div>
                    <div>
                        <input type="hidden" class="form-control" id="rowIdEmp" value="">
                        <button type="button" id="addEmployeeClose" class="btn btn-light btn-sm ModalClose mr-2" >Cancel</button>
                        <button type="button" id="addEmployeeBtn" class="btn btn-primary btn-sm" onclick="addEmployeeDetails()">Add</button>
                    </div>
                </div>
                
               
                <div class="modal-body">
                        
                        <div class="row g-3">
                            
                            <div class="col-xxl-12 col-lg-12" id="empalert" style="display:none">
                                <div class="alert alert-danger shadow mb-xl-0" role="alert">
                                    <strong>Employee Name </strong>is mandatory.
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12" id="empPopupCol">
                                <div>
                                    <label class="form-label">Employee Name</label>
                                    <select class="form-control select1 " onChange="fetchRole(this)" id="emp_slt" required>
                                    	  <option value="">Select</option>
                                    	  <?php foreach($employees as $row){ ?> 
                                    	     <option value="<?php echo $row->emp_id; ?>"><?php echo $row->first_name.' '. $row->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option>
                                    	  <?php } ?>
                                    </select>
                                    <p id="searchEmp" class="pointerCursor mt-2 mb-0 text-primary fw-medium" onclick="GetEmpAvailData(this)">View employee availability</p>
                                       
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-4 col-lg-4 col-sm-12" id="empRatesCol" style="display:none;">
                                <div>
                                    <label class="form-label">Pay Rates</label>
                                     <div class="align-items-center row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div id="payRatesetails"></div>
                                        </div>
                                        
								    </div>
                                    
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                <div>
                                    <label class="form-label">Role</label>
                                    <input type="text" readonly value="" id="empRoleNameModal" placeholder="Role" class="form-control">
                                </div>
                            </div><!--end col-->
                            
                            <div class="col-lg-12 mt-4" id="emp_availability_details" style="display:none;">
                               
                                
                            </div>
                            
                            
                        </div><!--end row-->
                   
                </div>
 
            </div>
        </div>
</div>

<!-- END layout-wrapper -->
<script src="<?php echo base_url(); ?>hr-assets/js/roster/roster_by_day.js"></script>
    