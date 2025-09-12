<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php date_default_timezone_set('Australia/Melbourne'); ?>
<style>
    .empShiftBoard{
        width:400px;
        padding: 0 15px;  
        background-color: #fff;
        height:100vh;
    }
    .empDashboardWrapper{
        width: calc(100% - 400px);
        padding: 0;
    }
    .empDashboardContent{
        width: 100%;
        padding: 0 15px;
        
    }
    .empDashboard {
        padding: 0 15px;
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
    div#shift_status_dot {
        position: absolute;
        right: 0;
        bottom: -2px;
        display: flex;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="empDashboard">
              <div class="row">
                  <div class="empShiftBoard">
                      <?php $timesheetRunningStatus = $todaysTimesheet[0]['running_status']; 
                            if($timesheetRunningStatus == 1){
                                $dateObject = new DateTime($todaysTimesheet[0]['in_time']);
                                $inTime = $dateObject->format('h:iA');
                                $shift_active = '<span class="text-success">On Shift</span>';
                                $shift_status = 'Started <span id="startTime">'.$inTime.'</span> at '.$todaysTimesheet[0]['outlet_name'];
                                $shift_status_dot = '<i class="mdi mdi-circle fs-20 align-middle me-1 text-success"></i>';
                            }else if($timesheetRunningStatus == 2){
                                // $todaysTimesheet[0]['break_in_time'];
                                
                                
                                // $breaktime = new DateTime($todaysTimesheet[0]['break_in_time']);
                                // echo 'break '.$breaktime1 = $breaktime->format('h:i:s');
                                
                                // $currtime =  date('h:i:s'); 
                                // $breaktime2 = new DateTime($currtime);
                                // echo '</br>curr '.$breaktime2 = $breaktimecr->format('h:i:s');
                                
                               
                
                               
                                // $hours = ($t2 - $t1)/3600;
                                // echo '</br> diff'.floor($hours) . ':' . ( ($hours-floor($hours)) * 60 );
                
                
                                $shift_active = '<span class="text-warning">On Break</span>';
                                $shift_status = '<span id="Timer">0</span>m taken of your break';
                                $shift_status_dot = '<i class="mdi mdi-circle fs-20 align-middle me-1 text-warning"></i>';
                            }
                    
                      ?>
                      
                      <div class="card shadow-none mt-4">
                        <div class="card-body p-4 text-center">
                            <div class="mx-auto avatar-lg mb-4">
                                
                                <div class="custom-avtar"><?php echo substr($this->session->userdata('username'),0,1)?><?php echo substr($this->session->userdata('userlastname'),0,1)?>
                                    <div id="shift_status_dot"><?php if(isset($shift_status_dot)){ echo $shift_status_dot; } ?></div>
                                </div>
                            </div>
                            <h5 class="card-title fs-18 fw-bold mb-1"><?php echo $this->session->userdata('username').' '.$this->session->userdata('userlastname');?></h5>
                            <div class="mt-4">
                                <p class="fs-14 mb-0 fw-bold" id="shift_active"><?php if(isset($shift_active)){ echo $shift_active; } ?></p>
                                <p class="text-muted fs-14 mt-1 mb-0 shift_status"><?php if(isset($shift_status)){ echo $shift_status; }else{ echo "No scheduled shifts"; } ?></p>
                            </div>
                            <div class="timeBtns mt-3">
                                
                                <button <?php if($timesheetRunningStatus != 0){ ?>style="display:none"<?php } ?> type="button" id="startBtn" class="btn btn-success bg-gradient waves-effect waves-light fw-bold">Start Shift</button>
                                
                                <div id="endBtns" <?php if($timesheetRunningStatus == 0){ ?>style="display:none"<?php }else{ ?> style="display:block"<?php } ?>>
                                    <button <?php if($timesheetRunningStatus == 2){ ?>style="display:none"<?php } ?> <?php if($todaysTimesheet[0]['break_out_time'] != '' && $todaysTimesheet[0]['break_out_time'] != null){ ?>disabled<?php } ?> type="button" id="breakstartBtn" class="btn btn-soft-secondary waves-effect waves-light shadow-none mx-1 fw-bold">Start Break</button>
                                    <button <?php if($timesheetRunningStatus != 2){ ?>style="display:none"<?php } ?> type="button" id="breakendBtn" class="btn btn-soft-secondary waves-effect waves-light shadow-none mx-1 fw-bold">End Break</button>
                                    <button <?php if($timesheetRunningStatus == 2){ ?>disabled<?php } ?> type="button" id="endBtn" class="btn btn-danger bg-gradient waves-effect waves-light mx-1 fw-bold">End Shift</button>
                                    
                                </div>                            
                            </div>
                            <div>
                                <input type="hidden" id="employee_timesheet_id" value="<?php echo $todaysTimesheet[0]['employee_timesheet_id']; ?>">
                                <input type="hidden" id="roster_id" value="<?php echo $todaysTimesheet[0]['roster_id']; ?>">
                                <input type="hidden" id="outlet_id" value="<?php echo $todaysTimesheet[0]['outlet_id']; ?>">
                                <input type="hidden" id="outlet_name" value="<?php echo $todaysTimesheet[0]['outlet_name']; ?>">
                            </div>
                        </div>
                        
                    </div>
                  </div>
                  <div class="empDashboardWrapper">
                        <div class="dashboard_title mb-3 px-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-light  py-2 d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">Dashboard</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="empDashboardContent">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card crm-widget">
                                        <div class="card-body p-0">
                                            <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                                                <div class="col">
                                                    <div class="py-4 px-3">
                                                        <h5 class="text-muted text-uppercase fs-13">Roster Total <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-briefcase-alt-2 display-6 text-muted"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value" data-target="40">0</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col">
                                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                                        <h5 class="text-muted text-uppercase fs-13">Roster Today <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-briefcase-alt-2 display-6 text-muted"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value" data-target="5">0</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col">
                                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                                        <h5 class="text-muted text-uppercase fs-13">Employee on Leave <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-calendar-x display-6 text-muted"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value" data-target="2">0</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col">
                                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                                        <h5 class="text-muted text-uppercase fs-13">Leave Requestes <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-calendar-x display-6 text-muted"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value" data-target="4">0</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col">
                                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                                        <h5 class="text-muted text-uppercase fs-13">Total Employees <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="ri-user-line display-6 text-muted"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value" data-target="20">0</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                            </div><!-- end row -->
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div><!-- end row -->
               
                            <div class="row">
                                <div class="col-xl-6 col-md-12 mb-4 ">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Latest Roster</h4>
                                        </div><!-- end card header -->
            
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col">Roster Name</th>
                                                            <th scope="col" style="width: 20%;">Start Date</th>
                                                            <th scope="col" >End Date</th>
                                                            <th scope="col" class="text-center" >View</th>
                                                        </tr>
                                                    </thead>
                                                     
                                                    <tbody>
                                                        <?php if(!empty($roster)){ ?>
                                                         <?php foreach($roster as $row){ ?>
                                                            <tr>
                                                                <td><?php echo $row->roster_name; ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($row->start_date)); ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($row->end_date)); ?></td>
                                                                <td class="text-center"><a class="btn btn-primary p-2 fs-12 w76" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>">View</a></td>
                                                            </tr>
                                                        <?php } } ?>
                                                      
                                                    </tbody><!-- end tbody -->
                                                </table><!-- end table -->
                                            </div><!-- end table responsive -->
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                                <div class="col-xxl-6 col-md-12 mb-4">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">What's Happening</h4>
                                            <div class="flex-shrink-0">
                                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Request Time Off</button>
                                            </div>
                                        </div><!-- end card header -->
                                        <div class="card-body pt-0">
                                            <ul class="list-group list-group-flush border-dashed">
                                                <li class="list-group-item ps-0">
                                                    <div class="row align-items-center g-3">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3 shadow">
                                                                <div class="text-center">
                                                                     <h5 class="mb-0">25</h5>
                                                                     <div class="text-muted">Tue</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-muted mt-0 mb-1 fs-13">12:00am - 03:30pm</h5>
                                                            <a href="#" class="text-reset fs-14 mb-0">Aditya is on leave.</a>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- end row -->
                                                </li><!-- end -->
                                                <li class="list-group-item ps-0">
                                                    <div class="row align-items-center g-3">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3 shadow">
                                                                <div class="text-center">
                                                                    <h5 class="mb-0">20</h5>
                                                                    <div class="text-muted">Wed</div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-muted mt-0 mb-1 fs-13">02:00pm - 03:45pm</h5>
                                                            <a href="#" class="text-reset fs-14 mb-0">kau jin submitted leave request.</a>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- end row -->
                                                </li><!-- end -->
                                                <li class="list-group-item ps-0">
                                                    <div class="row align-items-center g-3">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3 shadow">
                                                                <div class="text-center">
                                                                    <h5 class="mb-0">17</h5>
                                                                    <div class="text-muted">Wed</div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-muted mt-0 mb-1 fs-13">04:30pm - 07:15pm</h5>
                                                            <a href="#" class="text-reset fs-14 mb-0">Roja Boora is on leave.</a>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- end row -->
                                                </li><!-- end -->
                                                <li class="list-group-item ps-0">
                                                    <div class="row align-items-center g-3">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3 shadow">
                                                                <div class="text-center">
                                                                    <h5 class="mb-0">12</h5>
                                                                    <div class="text-muted">Tue</div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-muted mt-0 mb-1 fs-13">10:30am - 01:15pm</h5>
                                                            <a href="#" class="text-reset fs-14 mb-0">Roja Boora submitted leave request.</a>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- end row -->
                                                </li><!-- end -->
                                            </ul><!-- end -->
                                            <div class="align-items-center mt-2 row g-3 text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-muted">Showing<span class="fw-semibold">4</span> of <span class="fw-semibold">125</span> Results
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto">
                                                    <ul class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
                                                        <li class="page-item disabled">
                                                            <a href="#" class="page-link">←</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">1</a>
                                                        </li>
                                                        <li class="page-item active">
                                                            <a href="#" class="page-link">2</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">→</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                                
                            </div><!-- end row -->
                        </div>
                  </div>
              </div>  
        </div>
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header border-bottom">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="bx bxs-user-circle display-6 text-muted"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <h5 class="mb-0"><?php echo $this->session->userdata('username').' '.$this->session->userdata('userlastname');?></h5>
                </div>
            </div>
          
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 overflow-hidden">
            <div data-simplebar style="height: calc(100vh - 112px);">
                <div class="p-3">
                    <div class="unavailability-wrap">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-2">
                                <h5 class="mb-0">Unavailability</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#addUnavailability" aria-controls="offcanvasScrolling">+ Add</button>
                            </div>
                        </div>
                        
                        <div class="unavailability-list mt-4">
                            <?php if(!empty($unavailability)){ 
                            foreach($unavailability as $unavail){
                            $start_date = new DateTime($unavail->start_date);
                            $end_date = new DateTime($unavail->end_date);
                            if($start_date == $end_date){
                               $abs_diff = 1; 
                            }else{
                                $abs_diff = $end_date->diff($start_date)->format("%a");
                            }
                            if($unavail->type == 'all_day'){
                            ?>
                                <div class="card custom_border-solid mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-2">
                                                <span class="badge rounded-pill text-bg-primary mb-2 p-2 px-3"><?php echo $abs_diff; ?> Day</span><br>
                                                <span class="fw-bold"><?php echo date('d-m-Y', strtotime($unavail->start_date)).' TO '.date('d-m-Y', strtotime($unavail->end_date)); ?></span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" rel="<?php echo $unavail->emp_availability_id; ?>" class="delUnavailability btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="card custom_border-solid mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-2">
                                                <span class="badge rounded-pill text-bg-primary mb-2 p-2 px-3"><?php echo $abs_diff; ?> Hours</span><br>
                                                <span class="fw-bold"><?php echo date('d-m-Y', strtotime($unavail->start_date)); ?></span><br>
                                                <span><?php echo $unavail->start_time.'-'.$unavail->end_time; ?></span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" rel="<?php echo $unavail->emp_availability_id; ?>" class="delUnavailability btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            
                            <?php } } } ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    
     <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="addUnavailability" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header border-bottom">
            
          
          <button type="button" class="btn btn-light btn-sm text-reset" id="addUnavailabilityCloseBtn">Back</button>
        </div>
        <div class="offcanvas-body p-0 overflow-hidden">
            <div data-simplebar style="height: calc(100vh - 112px);">
                <div class="p-3">
                    <div class="unavailability-wrap">
                        <form id="addUnavailabilityForm">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1 ms-2">
                                    <h5 class="mb-0">Add Unavailability</h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-primary btn-sm" id="addUnavailabilityFormBtn">Add</button>
                                </div>
                                
                            </div>
                            <div class="alldayopt mb-4">
                                <label class="form-check-label">All day</label>
                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                    <input type="checkbox" id="allDayBtn" class="form-check-input" id="allday" checked>
                                </div>
                                <input type="hidden" id="unavail_type" value="all_day">
                            </div>
                            <div class="row" id="allDayWrap">
                                <div class="col-lg-6 col-6 mb-3">
                                    <label for="businessname" class="control-label text-dark">From</label>
                                    <input type="text" class="form-control" data-provider="flatpickr" id="all_day_start_date" data-date-format="d-m-Y"  autocomplete="off">
                                </div>
                                <div class="col-lg-6 col-6 mb-3">
                                    <label for="businessname" class="control-label text-dark">To</label>
                                    <input type="text" class="form-control" data-provider="flatpickr" id="all_day_end_date" data-date-format="d-m-Y" autocomplete="off">
                                </div>
                            </div>
                            <div class="row" id="singleDayWrap" style="display:none;">
                                <div class="col-lg-12">
                                    <label for="businessname" class="control-label text-dark">From</label>
                                    <div class="row">
                                        <div class="col-lg-6 col-6 mb-3">
                                            <input type="text" class="form-control" data-provider="flatpickr" id="start_date" data-date-format="d-m-Y"  autocomplete="off">
                                        </div>
                                        <div class="col-lg-6 col-6 mb-3">
                                            <input type="text" class="form-control" data-provider="timepickr" id="start_time" data-time-basic="true" placeholder="Time">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <label for="businessname" class="control-label text-dark">To</label>
                                    <div class="row">
                                        <div class="col-lg-6 col-6 mb-3">
                                            <input type="text" class="form-control" data-provider="flatpickr" id="end_date" data-date-format="d-m-Y"  autocomplete="off">
                                        </div>
                                        <div class="col-lg-6 col-6 mb-3">
                                            <input type="text" class="form-control" data-provider="timepickr" id="end_time" data-time-basic="true" placeholder="Time">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
            
</div>
<!-- END layout-wrapper -->
<script>
    timerInterval = null;
    function breaktimer(){
        var minutes = 0;
        var seconds = 0;
        timerInterval = setInterval(function() {
            seconds = seconds + 1;
            if(seconds > 59){
                seconds = 0;
                minutes = minutes+1;
            }
            console.log('minutes'+minutes);
            console.log('seconds'+seconds);
            $('#Timer').text(minutes);
        }, 1000);
    }
  

    function getLocation() {
        
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition,error);
  } else { 
    console.log("Geolocation is not supported by this browser.");
  }
}
    function showPosition(position) {
      const obj={}
 
      obj.latitude = position.coords.latitude,
      obj.longitude=  position.coords.longitude
      console.log("obj",obj)
  return  obj 
}

function error(err) {
  return {
      'latitude' : '',
      'longitude' : ''
  }
}
    $(document).on( 'click', '#startBtn', function () {
        const coordinates = getLocation();
        
        // return false;
        var time = setClockTime();
        $.ajax({
		    url:"<?php echo base_url();?>index.php/Timesheet/fetchEmpTimesheets",
		    method:"POST",
	        success:function(response){
	            if(response){
    	           var timesheetrecord = JSON.parse(response);
    	           if(timesheetrecord.length != 0){
            	           var html = '<select class="form-control" id="timesheetID"><option value="">Select Timesheet</option>';
        	            
            	           $.each(timesheetrecord, function(i, value) {
            	               //if(value.out_time != null && value.out_time != ''){
            	               //    html += '<option class="text-uppercase" disabled value="'+value.employee_timesheet_id+'" data-roster="'+value.roster_id+'" data-outlet="'+value.outlet_id+'">'+value.timesheet_name+' ('+value.outlet_name+')</option>';
            	               //}else{
            	                   html += '<option class="text-uppercase"  value="'+value.employee_timesheet_id+'" data-roster="'+value.roster_id+'" data-outlet="'+value.outlet_id+'" data-outlet_name="'+value.outlet_name+'">'+value.timesheet_name;
            	                   if(value.outlet_name != '' && value.outlet_name != null){
            	                    html += ' ('+value.outlet_name+')';
            	                   }
            	                   html += '</option>';
            	               //}
            	               
            	           });
            	           Swal.fire({
                                title: "Select Timesheet",
                                html: '<div class="mt-3 text-start">'+html+'</div>',
                                confirmButtonClass: "btn btn-primary w-xs mb-2",
                                confirmButtonText: 'Start',
                                buttonsStyling: !1,
                                showCloseButton: !0,
                            }).then(function (t) {
                                if (t.value) {
                                    var timesheetID = $('#timesheetID').val();
                                    var roster_id = $("#timesheetID option:selected").attr('data-roster');
                                    var outlet_id = $("#timesheetID option:selected").attr('data-outlet');
                                    var outlet_name = $("#timesheetID option:selected").attr('data-outlet_name');
                                    $('#employee_timesheet_id').val(timesheetID);
                                    $('#roster_id').val(roster_id);
                                    $('#outlet_id').val(outlet_id);
                                    $('#outlet_name').val(outlet_name);
                                    
                                    // save the intime to db
                                    var result = save_record('in_time',time);
                                    var d = new Date(time);
                                    let hours = d.getHours();
                                    let am_pm = (hours >= 12) ? "PM" : "AM";
                                    if(result == 'success'){
                                        $('#startBtn').css('display','none');
                                        $('#endBtns').css('display','block');
                                        $('#shift_active').html('<span class="text-success ">On Shift</span>');
                                        $('.shift_status').html('Started <span id="startTime">'+time+am_pm+'</span> at '+outlet_name);
                                        $('#shift_status_dot').html('<i class="mdi mdi-circle fs-20 align-middle me-1 text-success"></i>');
                                    }else if(result == 'Early'){
                                        Swal.fire({
                                            title: "Login time not must not exceed 15 mins as per your rosterd time.Please Try again in some time",
                                            icon: "warning",
                                            showCancelButton: 0,
                                            confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                                            cancelButtonClass: "btn btn-danger w-xs mt-2",
                                            confirmButtonText: "Okay",
                                            buttonsStyling: !1,
                                            showCloseButton: 0,
                                        });
                                    }else{
                                        Swal.fire({
                                            title: "Something went wrong!",
                                            text: "Contact Your Manager.",
                                            icon: "error",
                                            showCancelButton: 0,
                                            confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                                            cancelButtonClass: "btn btn-danger w-xs mt-2",
                                            confirmButtonText: "Okay",
                                            buttonsStyling: !1,
                                            showCloseButton: 0,
                                        });
                                    }
                                     
                                    
                                }
                            });
    	            }else{
    	                Swal.fire({
    	                    icon: 'warning',
                            title: "Today you have not assigned any timesheet.",
                            confirmButtonClass: "btn btn-primary w-xs mb-2",
                            confirmButtonText: 'Okay',
                            buttonsStyling: !1,
                            showCloseButton: !0,
                        });
    	            }
	            }else{
	                Swal.fire({
	                    icon: 'warning',
                        title: "Something went wrong.",
                        confirmButtonClass: "btn btn-primary w-xs mb-2",
                        confirmButtonText: 'Okay',
                        buttonsStyling: !1,
                        showCloseButton: !0,
                    });
	            }
			}
	    });
        
    });
    $(document).on( 'click', '#endBtn', function () {
        var time = setClockTime();
        var result = save_record('out_time',time);
        if(result == 'success'){
            $('#endBtns').css('display','none');
            $('#breakstartBtn').removeAttr('disabled');
            $('#startBtn').css('display','inline-block');
            $('#shift_active').html('');
            $('#shift_status_dot').html('');
            $('.shift_status').html('No scheduled shifts');
            Swal.fire({
                title: "You have finished your shift.",
                icon: "success",
                showCancelButton: 0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: "Okay",
                buttonsStyling: !1,
                showCloseButton: 0,
            });
        }else{
            Swal.fire({
                title: "Something went wrong!",
                text: "Contact Your Manager.",
                icon: "error",
                showCancelButton: 0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: "Okay",
                buttonsStyling: !1,
                showCloseButton: 0,
            });
        }
    });
    $(document).on( 'click', '#breakstartBtn', function () {
        var result = save_break_record('break_in_time');
        if(result == 'success'){
            $('#breakstartBtn').css('display','none');
            $('#endBtn').attr('disabled','disabled');
            $('#breakendBtn').css('display','inline-block');
            $('#shift_status_dot').html('<i class="mdi mdi-circle fs-20 align-middle me-1 text-warning"></i>');
            $('#shift_active').html('<span class="text-warning">On Break</span>');
            $('.shift_status').html('<span id="Timer">0</span>m taken of your break');
            breaktimer();
            var t;
            Swal.fire({
                title: "Break Time!",
                icon: 'success',
                html: '<p>Enjoy your break.</p>',
                timer: 2e3,
                timerProgressBar: !0,
                showCloseButton: !0,
                showConfirmButton: !1,
                didOpen: function () {
                    // Swal.showLoading(),
                        (t = setInterval(function () {
                            var t = Swal.getHtmlContainer();
                            t && (t = t.querySelector("b")) && (t.textContent = Swal.getTimerLeft());
                        }, 100));
                },
                onClose: function () {
                    clearInterval(t);
                },
            }).then(function (t) {
            });
        }else{
            Swal.fire({
                title: "Something went wrong!",
                text: "Contact Your Manager.",
                icon: "error",
                showCancelButton: 0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: "Okay",
                buttonsStyling: !1,
                showCloseButton: 0,
            });
        }
    });
    $(document).on( 'click', '#breakendBtn', function () {
        
        var result = save_break_record('break_out_time');
        if(result){
            clearInterval(timerInterval);
            $('#breakendBtn').css('display','none');
            $('#endBtn').removeAttr('disabled');
            $('#breakstartBtn').attr('disabled','disabled');
            $('#breakstartBtn').css('display','inline-block');
            $('#shift_status_dot').html('<i class="mdi mdi-circle fs-20 align-middle me-1 text-success"></i>');
            $('#shift_active').html('<span class="text-success">On Shift</span>');
            var outlet_name = $('#outlet_name').val();
            $('.shift_status').html('Started <span id="startTime">5:55pm</span> at '+outlet_name);
        }else{
            Swal.fire({
                title: "Something went wrong!",
                text: "Contact Your Manager.",
                icon: "error",
                showCancelButton: 0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: "Okay",
                buttonsStyling: !1,
                showCloseButton: 0,
            });
        }
    });
     
    
    function save_record(type,time){
        
        var employee_timesheet_id = $('#employee_timesheet_id').val();
        var roster_id = $('#roster_id').val();
        var outlet_id = $('#outlet_id').val();
        
        var result = '';
        
        $.ajax({
		    url:"<?php echo base_url();?>index.php/Timesheet/save_record",
		    async: false,
		    method:"POST",
		    data:{in_time:time,type:type,employee_timesheet_id:employee_timesheet_id,roster_id:roster_id,outlet_id:outlet_id},
	        success:function(response){
	            result = response;
	           // console.log('result inner st'+result);
			}
			
	    });
	    return result;
	    
    }
    function save_break_record(break_type){
        
        var employee_timesheet_id = $('#employee_timesheet_id').val();
        var break_time = setClockTime();
        
        var result = '';
        $.ajax({
		    url:"<?php echo base_url();?>index.php/Timesheet/save_break_record",
		    async: false,
		    method:"POST",
		    data:{break_time:break_time,break_type:break_type,employee_timesheet_id:employee_timesheet_id},
	        success:function(response){
		        result = response;
	            console.log('result inner st'+result);
			}
    	});
    	return result;
    }
    function setClockTime() {
        var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes()))); 
    }
    
    
    $(document).on( 'change', '#allDayBtn', function () {
        if( $(this).prop('checked') == true ){
            $('#singleDayWrap').hide();
            $('#singleDayWrap').find('input').val('');
            $('#allDayWrap').show();
            $('#unavail_type').val('all_day');
        }else{
            $('#allDayWrap').hide();
            $('#allDayWrap').find('input').val();
            $('#singleDayWrap').show();
            $('#unavail_type').val('by_time');
        }
    });
    $(document).on( 'click', '.btn-close', function () {
        $('#offcanvasScrolling').removeClass('show');
    });
    $(document).on( 'click', '#addUnavailabilityCloseBtn', function () {
        $('#addUnavailability').removeClass('show');
        $('#offcanvasScrolling').addClass('show');
    });
    $(document).on( 'click', '#addUnavailabilityFormBtn', function () {
        var unavail_type = $('#unavail_type').val();
        var start_date = '';
        var end_date = '';
        var start_time = '';
        var end_time = '';
        if(unavail_type == 'all_day'){
            start_date = $('#all_day_start_date').val();
            end_date = $('#all_day_end_date').val();
        }else{
            start_date = $('#start_date').val();
            end_date = $('#end_date').val();
            start_time = $('#start_time').val();
            end_time = $('#end_time').val();
        }
        var html = '';
        $.ajax({
		    url:"<?php echo base_url();?>index.php/admin/add_unavailability",
		    method:"POST",
		    data:{unavail_type:unavail_type,start_date:start_date,end_date:end_date,start_time:start_time,end_time:end_time},
	        success:function(response){
	            console.log(response);
	            if(response != 'error' && response != ''){
	                const diffInMs   = new Date(end_date) - new Date(start_date)
                    const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
	                
	                
	                if(unavail_type == 'all_day'){
    	                html += '<div class="card custom_border-solid mb-4"><div class="card-body"><div class="d-flex align-items-center"><div class="flex-grow-1 ms-2">';
                        html += '<span class="badge rounded-pill text-bg-primary mb-2 p-2 px-3">'+diffInDays+' Day</span><br><span class="fw-bold">'+start_date+' TO '+end_date+'</span>';
                        html += '</div><div class="flex-shrink-0"><button type="button" class="delUnavailability btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button></div></div></div></div>';
    	            }else{
    	                var time1 = start_time.split(':');
                        var time2 = end_time.split(':');
                        var hours1 = parseInt(time1[0], 10), 
                        hours2 = parseInt(time2[0], 10),
                        mins1 = parseInt(time1[1], 10),
                        mins2 = parseInt(time2[1], 10);
                        var hours = hours2 - hours1, mins = 0;
                        if(hours < 0) hours = 24 + hours;
                        if(mins2 >= mins1) {
                            mins = mins2 - mins1;
                        }
                        else {
                          mins = (mins2 + 60) - mins1;
                          hours--;
                        }
                        if(mins < 9)
                        {
                          mins = '0'+mins;
                        }
                        if(hours < 9)
                        {
                          hours = '0'+hours;
                        }
                        html += '<div class="card custom_border-solid"><div class="card-body"><div class="d-flex align-items-center"><div class="flex-grow-1 ms-2">';
                        html += '<span class="badge rounded-pill text-bg-primary mb-2 p-2 px-3">'+hours+':'+mins+' Hours</span><br><span class="fw-bold">'+start_date+'</span><br><span>'+start_time+'-'+end_time+'</span>';
                        html += '</div><div class="flex-shrink-0"><button type="button" rel="'+response+'" class="delUnavailability btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button></div></div></div></div>';
    	            }
    	            $('.unavailability-list').append(html);
    	            $('#addUnavailability').removeClass('show');
                    $('#offcanvasScrolling').addClass('show');
	            }
			}
    	});
    });
    
    $(document).on( 'click', '.delUnavailability', function () {
        var thisRow = $(this).closest('.card');
        var id = $(this).attr('rel');
        
        if(id != ''){
        $.ajax({
		    url:"<?php echo base_url();?>index.php/admin/del_unavailability",
		    method:"POST",
		    data:{id:id},
	        success:function(response){
	            console.log(response);
	            if(response == 'success'){
	                $(thisRow).remove();
	            }
			}
    	});
        }
    });
</script>