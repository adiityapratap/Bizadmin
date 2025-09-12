<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Employee Roster Report</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-primary" href="javascript:capture();"><i class="mdi mdi-download align-bottom me-1"></i> Download Report</a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                             <?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
                            <div class='hideMe'>
                                <p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
                            </div>
                            <?php } ?>
                            <?php if(null !==$this->session->userdata('error_msg')) { ?>  
                            <div class='hideMe'>
                                <p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                
                                <table class="table align-middle" id="customerTable">
                                    <thead class="table-dark text-white">
                                        <tr>
                                            
                                            <th scope="col">Name</th>
                                              <th scope="col">Email</th>
                                              <th scope="col">Start Date</th>
                                              <th scope="col">End Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="list form-check-all">
                                        <tr>
                                        <td><?php echo $empName; ?></td>
                                          <td><?php echo $Email; ?></td>
                                          <td><?php echo $start_date; ?></td>
                                          <td><?php echo $end_date; ?></td>
                                         
                                        </tr>
                                    </tbody>
                                   
                                </table>
                                <?php 

                                $week_days = array('mon','tues','wed','thus','fri','sat','sun');
                                $outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');;
                                ?>
                                <input type="hidden" id="roster_group_id" value="<?php echo $roster_group_id; ?>">
                                <?php 
                                if(!empty($roster)){
                                    
                                   
                                	foreach($roster as $row){ ?>
                                <?php	$CurrentRosterStartdatee = date('j F Y', strtotime($row->start_date));
                                        $CurrentRosterend_datee = date('j F Y', strtotime($row->end_date));
                                	?>
                                <table class="table align-middle mt-4" id="customerTable">
                                    <thead class="table-dark text-white">
                                        <tr>
                                            
                                            <th class="sort" data-sort="job_name">Job Name</th>
                                            <th class="sort" data-sort="start_date">Start Date</th>
                                            <th class="sort" data-sort="date_posted">Date Posted</th>
                                            <th class="sort" data-sort="job_type">Job Type</th>
                                            <th>Status</th>
                                            <th>Re Create</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        <tr>
                                        
                                        <td class="start_end" ><b></a><?php echo $row->roster_name; ?><br></br>(<?php echo $CurrentRosterStartdatee ." to ".$CurrentRosterend_datee  ?>)</b>
                                        <!--<p><span><?php // echo $row->emp_hours_worked_this_week.' Hrs'; ?></span></p>-->
                                        </td>
                                        
                                        <?php  for ($i = 0; $i < 7; $i++) { ?>
                                        <td class="start_end">
                                        <table class="sub-table">
                                        <tr>
                                              <td class="child">Start</td>
                                              <td class="child">End</td>
                                              <td class="child">Break</td>
                                               <td class="child">Hrs</td>
                                              </tr>
                                        <tr>
                                              <?php $start_nameofday = $week_days[$i].'_start_time'; ?>
                                              <?php $end_nameofday = $week_days[$i].'_end_time'; ?>
                                              <?php $break_nameofday = $week_days[$i].'_break_time'; ?>
                                               <?php $layout_nameofday = $outletweek_days[$i].'_layout'; ?>
                                             <?php 
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
                                            
                                             ?>
                                              <td class="child start_height"><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i A',strtotime($row->$start_nameofday)); } ?></td>
                                              <td class="child start_height"><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i A',strtotime($row->$end_nameofday)); }?></td>
                                              <td class="child start_height"><?php if($row->$break_nameofday > 0) { echo $row->$break_nameofday;  } else {  echo '   '; }?></td>
                                              
                                              <td class="child"><?php echo $difference; ?></td>
                                              <!--<td class="child"><b><?php //echo "$ ".$total_pay; ?></b></td>-->
                                            
                                           </tr>
                                           <tr>
                                            <td colspan="4" class="child ct-font-td">Outlet</td>
                                           </tr>
                                           <tr>
                                           
                                           <td colspan="4" class="child start_height" style="word-wrap: break-all"><?php if(!empty($row->$layout_nameofday)) { echo $row->$layout_nameofday;  } else {  echo '   '; }?></td>
                                           
                                           </tr>
                                           </table></td>
                                           
                                          <?php } ?>
                                        
                                        
                                        </tr>
                                        
                                        </tbody>
                                        <?php } } ?>
                                </table>
                               
                            </div>
                            <!--<div class="d-flex justify-content-end">-->
                            <!--    <div class="pagination-wrap hstack gap-2">-->
                            <!--        <a class="page-item pagination-prev disabled" href="#">-->
                            <!--            Previous-->
                            <!--        </a>-->
                            <!--        <ul class="pagination listjs-pagination mb-0"></ul>-->
                            <!--        <a class="page-item pagination-next" href="#">-->
                            <!--            Next-->
                            <!--        </a>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                       
                        <!-- Modal -->
                        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-2 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Are you sure ?</h4>
                                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn w-sm btn-danger" rel="" id="delete-record">Yes, Delete It!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal -->
                    </div>
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<script type="text/javascript">

function capture() {
  const captureElement = document.querySelector('.main-container')
  html2canvas(captureElement)
    .then(canvas => {
      canvas.style.display = 'none'
      document.body.appendChild(canvas)
      return canvas
    })
    .then(canvas => {
      const image = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream')
      const a = document.createElement('a')
      a.setAttribute('download', 'Roster_Employee_Report.png')
      a.setAttribute('href', image)
      a.click()
      canvas.remove()
    })
}
</script> 
