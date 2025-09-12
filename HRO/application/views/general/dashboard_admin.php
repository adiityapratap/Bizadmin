<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <!-- start page title -->
        <div class="page-title bg-primary">
            <div class="container-fluid">

                
                <div class="row"> 
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 text-white">Dashboard</h4>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
         <!-- end page title -->           
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card crm-widget">
                            <div class="card-body p-0">
                                <div class="row row-cols-xxl-4 row-cols-md-4 row-cols-1 g-0">
                                   
                                    <div class="col">
                                        <div class="mt-3 mt-md-0 py-4 px-3">
                                            <h5 class="text-muted text-uppercase fs-13">Late SignIn <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <i class="mdi mdi-login display-6 text-muted"></i>
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
                    <div class="col-xxl-6 col-xl-6 col-md-12 mb-4 ">
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
                                                <th scope="col" >Status</th>
                                                <th scope="col" class="text-center">Re-Create</th>
                                                <th scope="col" class="text-center">View</th>
                                            </tr>
                                        </thead>
                                         
                                        <tbody>
                                            <?php if(!empty($roster)){ ?>
                                             <?php foreach($roster as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row->roster_name; ?></td>
                                                    <td><?php echo date('d-m-Y',strtotime($row->start_date)); ?></td>
                                                    <td><?php echo date('d-m-Y',strtotime($row->end_date)); ?></td>
                                                    <td><?php if($row->roster_status == 1){ ?><span class="badge badge-soft-success p-2">Enable</span><?php }else{ ?><span class="badge badge-soft-warning p-2">Disable</span><?php } ?></td>
                                                    <td class="text-center"><a class="btn btn-success p-2 fs-12 w76" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/recreate">Re Create</a></td>
                                                    <td class="text-center"><a class="btn btn-primary p-2 fs-12 w76" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>">View</a></td>
                                                </tr>
                                            <?php } } ?>
                                          
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xxl-6 col-xl-6 col-md-12 mb-4">
                        <div class="card h-100 mb-0">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">What's Happening</h4>
                                <div class="flex-shrink-0">
                                    
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
            <!-- End Page-content -->

            
        </div>
        <!-- end main content-->
 