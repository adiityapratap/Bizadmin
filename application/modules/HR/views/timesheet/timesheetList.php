 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">Timesheets</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                                <a href="/HR/addTimesheetWithoutRoster" class="btn btn-primary btn-sm" > <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Timesheet W/o Roster</a>
                                               <a href="/HR/timesheet/weeklyTimesheet" class="btn btn-success mx-3 btn-sm" > <i class="ri-add-line fs-14 align-bottom me-1"></i>Timesheet</a>
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="siteList">
                                           
                                            
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="rosterListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                           
                                                             <th data-sort="customer_name">Timesheet Name</th>
                                                            <th class="sort" data-sort="customer_name">Timesheet Week</th>
                                                            <!--<th class="sort" data-sort="status">Status</th>-->
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php if(!empty($timesheetList)) {  ?>
                                                        <?php foreach($timesheetList as $timesheet){  ?>
                                                        <tr id="row_<?php echo  $timesheet['timesheet_id']; ?>" >
                                                            <?php
                                                            $start_datetime = new DateTime($timesheet['start_date']);
                                                            $end_datetime = new DateTime($timesheet['end_date']);
                                                            
                                                            $start_formatted = $start_datetime->format('jS F');
                                                            $end_formatted = $end_datetime->format('jS F');

                                                             $week_range = $start_formatted . ' - ' . $end_formatted;
                                                            ?>
                                                            
                                                            <td class="week"><?php echo  $timesheet['rosterName']; ?></td>
                                                            <td class="week"><?php echo $week_range; ?></td>
                                                            <!--<td>-->
                                                            <!--<div class="form-check form-switch form-switch-custom form-switch-success">-->
                                                            <!--<input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $roster['roster_id']; ?>" <?php if(isset($timesheet['status']) && $timesheet['status']  == '1'){ echo 'checked'; }?>>-->
                                                            <!--</div>-->
                                                            <!--</td>-->
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                 <!--<button class="btn btn-orange btn-sm"><i class=" ri-creative-commons-sa-fill align-bottom me-1"></i> Recreate</button>-->
                                                                 <?php if($timesheet['without_roster']){ ?>
                                                                    <a href="/HR/timesheetWoRosterView/<?php echo  $timesheet['timesheet_id']; ?>" class="btn btn-success btn-sm"> <i class="ri-eye-2-line align-bottom me-1"></i>View</a>
                                                                   <?php } else { ?>
                                                                  <a href="/HR/viewWeeklyTimesheet/<?php echo  $timesheet['start_date']; ?>/<?php echo  $timesheet['end_date']; ?>" class="btn btn-success btn-sm"> <i class="ri-eye-2-line align-bottom me-1"></i>View</a> 
                                                                   <?php } ?>
                                                                   <a class="btn btn-danger btn-sm"  data-rel-id="<?php echo  $timesheet['timesheet_id']; ?>"><i class="ri-delete-bin-5-fill align-bottom me-1"></i> Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                          <?php } ?>
                                                    </tbody>
                                                </table>
                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                                       <p class="text-muted mb-0">We did not find any record for you search.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                    </div><!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
       
                </div>
        </div>
        <script>
    $('#rosterListDatatable').DataTable({
    pageLength: 100,
    bPaginate: false,
    bInfo: false,
    lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
    columnDefs: [{
        targets: 'no-sort',
        orderable: false
    }],
    order: [[0, 'desc']] // Sort by the first column in descending order
});
        </script>
 