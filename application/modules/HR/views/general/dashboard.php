<div class="main-content">

    <div class="page-content">
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
                                
                                <div class="custom-avtar"><?php echo ucfirst(substr($this->session->userdata('username'),0,1)); ?><?php echo substr($this->session->userdata('userlastname'),0,1)?>
                                    <div id="shift_status_dot"><?php if(isset($shift_status_dot)){ echo $shift_status_dot; } ?></div>
                                </div>
                            </div>
                            <h5 class="card-title fs-14 mb-1 text-reset"><?php echo $this->session->userdata('username').' '.$this->session->userdata('userlastname');?></h5>
                            <div class="mt-4">
                                <p class="fs-14 mb-0 fw-bold" id="shift_active"><?php if(isset($shift_active)){ echo $shift_active; } ?></p>
                                <p class="text-reset fs-14 mt-1 mb-0 shift_status"><?php if(isset($shift_status)){ echo $shift_status; }else{ echo "No scheduled shifts"; } ?></p>
                            </div>
                            <div class="timeBtns mt-3">
                              <video id="clockVideo" autoplay playsinline style="display:none; width: 300px;"></video>
<button <?php if($timesheetRunningStatus != 0){ ?>style="display:none"<?php } ?> type="button" id="startBtn" class="btn btn-success bg-gradient waves-effect waves-light fw-bold">Start Shift</button>
                                
                                
                                <button  type="button" id="clockInBtn" class="btn btn-success bg-gradient waves-effect waves-light fw-bold">Clock In</button>
                                <div id="endBtns" <?php if($timesheetRunningStatus == 0){ ?>style="display:none"<?php }else{ ?> style="display:block"<?php } ?>>
                                    <button <?php if($timesheetRunningStatus == 2){ ?>style="display:none"<?php } ?> <?php if($todaysTimesheet[0]['break_out_time'] != '' && $todaysTimesheet[0]['break_out_time'] != null){ ?>disabled<?php } ?> type="button" id="breakstartBtn" class="btn btn-soft-secondary waves-effect waves-light shadow-none mx-1 fw-bold">Start Break</button>
                                    <button <?php if($timesheetRunningStatus != 2){ ?>style="display:none"<?php } ?> type="button" id="breakendBtn" class="btn btn-soft-secondary waves-effect waves-light shadow-none mx-1 fw-bold">End Break</button>
                                    <button <?php if($timesheetRunningStatus == 2){ ?>disabled<?php } ?> type="button" id="endBtn" class="btn btn-danger bg-gradient waves-effect waves-light mx-1 fw-bold">End Shift</button>
                                    
                                </div>                            
                            </div>
                           <video id="video" width="300" height="300" autoplay muted></video>
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
                       
                        <div class="empDashboardContent">
                            
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card crm-widget">
                                        <div class="card-body p-0">
                                            <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                                               
                                                <div class="col">
                                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                                        <h5 class="text-black text-uppercase fs-13">Roster Today <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-briefcase-alt-2 display-6 text-black"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value text-black" data-target="5">5</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col">
                                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                                        <h5 class="text-black text-uppercase fs-13">Employee on Leave <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-calendar-x display-6 text-black"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value text-black" data-target="2">2</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col">
                                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                                        <h5 class="text-black text-uppercase fs-13">Leave Requestes <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx bx-calendar-x display-6 text-black"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h2 class="mb-0"><span class="counter-value text-black" data-target="4">4</span></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col -->
                                                
                                            </div><!-- end row -->
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div>
                           
               
                            <div class="row">
                                <div class="col-6 mb-4 ">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1 text-black">Latest Roster</h4>
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
                                                        <?php } }else{  ?>
                                                        <tr>
                                                                <td>Sydney Cafe 1stFeb	</td>
                                                                <td>01-02-2024</td>
                                                                <td>07-02-2024</td>
                                                                <td class="text-center"><a class="btn btn-primary p-2 fs-12 w76" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/">View</a></td>
                                                            </tr>
                                                        <tr>
                                                                <td>Sydney Cafe 8thFeb	</td>
                                                                <td>08-02-2024</td>
                                                                <td>14-02-2024</td>
                                                                <td class="text-center"><a class="btn btn-primary p-2 fs-12 w76" href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/">View</a></td>
                                                            </tr>
                                                       
                                                       
                                                        
                                                        <?php }  ?>
                                                      
                                                    </tbody><!-- end tbody -->
                                                </table><!-- end table -->
                                            </div><!-- end table responsive -->
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                                <div class="col-6 mb-4">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1 text-black">What's Happening</h4>
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
                                                                     <h5 class="mb-0 text-dark">25</h5>
                                                                     <div class="text-black">Tue</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-black mt-0 mb-1 fs-13">12:00am - 03:30pm</h5>
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
                                                                    <h5 class="mb-0 text-dark">20</h5>
                                                                    <div class="text-black">Wed</div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-black mt-0 mb-1 fs-13">02:00pm - 03:45pm</h5>
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
                                                                    <h5 class="mb-0 text-dark">17</h5>
                                                                    <div class="text-black">Wed</div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-black mt-0 mb-1 fs-13">04:30pm - 07:15pm</h5>
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
                                                                    <h5 class="mb-0 text-dark">12</h5>
                                                                    <div class="text-black">Tue</div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="text-black mt-0 mb-1 fs-13">10:30am - 01:15pm</h5>
                                                            <a href="#" class="text-reset fs-14 mb-0">Roja Boora submitted leave request.</a>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- end row -->
                                                </li><!-- end -->
                                            </ul><!-- end -->
                                            <div class="align-items-center mt-2 row g-3 text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-black">Showing<span class="fw-semibold">4</span> of <span class="fw-semibold">125</span> Results
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
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
      <?php $this->load->view('unavailabilityCanvas'); ?>
</div>
<!-- END layout-wrapper -->
<style>
    .empShiftBoard{
        width:300px;
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
 <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
 
<script>
document.getElementById('clockInBtn').addEventListener('click', async () => {
    const video = document.getElementById('clockVideo');

    // Start webcam
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
        video.style.display = 'block';

        // Wait for camera to initialize
        await new Promise(resolve => setTimeout(resolve, 1500));

        // Capture image from video
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0);

        const base64Image = canvas.toDataURL('image/jpeg');

        // Stop the video stream
        stream.getTracks().forEach(track => track.stop());
        video.style.display = 'none';

        // Send to backend for comparison
        const response = await fetch("<?= base_url('HR/timesheet/verifyFace') ?>", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                employee_id: '69', // Use PHP variable or JS value
                captured_image: base64Image,
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            console.log("✅ Face match successful!");
            alert("✅ Face match successful!");
            // Call your clock-in logic here
        } else {
            console.error("❌ Face does not match!");
            alert("Face verification failed. Please try again.");
        }

    } catch (error) {
        console.error("Camera error:", error);
        alert("Unable to access camera. Please check permissions.");
    }
});
</script>



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
//     $(document).on( 'click', '#startBtn', function () {
//         const coordinates = getLocation();
        
//         // return false;
//         var time = setClockTime();
//         $.ajax({
// 		    url:"<?php echo base_url();?>index.php/Timesheet/fetchEmpTimesheets",
// 		    method:"POST",
// 	        success:function(response){
// 	            if(response){
//     	           var timesheetrecord = JSON.parse(response);
//     	           if(timesheetrecord.length != 0){
//             	           var html = '<select class="form-control" id="timesheetID"><option value="">Select Timesheet</option>';
        	            
//             	           $.each(timesheetrecord, function(i, value) {
//             	               //if(value.out_time != null && value.out_time != ''){
//             	               //    html += '<option class="text-uppercase" disabled value="'+value.employee_timesheet_id+'" data-roster="'+value.roster_id+'" data-outlet="'+value.outlet_id+'">'+value.timesheet_name+' ('+value.outlet_name+')</option>';
//             	               //}else{
//             	                   html += '<option class="text-uppercase"  value="'+value.employee_timesheet_id+'" data-roster="'+value.roster_id+'" data-outlet="'+value.outlet_id+'" data-outlet_name="'+value.outlet_name+'">'+value.timesheet_name;
//             	                   if(value.outlet_name != '' && value.outlet_name != null){
//             	                    html += ' ('+value.outlet_name+')';
//             	                   }
//             	                   html += '</option>';
//             	               //}
            	               
//             	           });
//             	           Swal.fire({
//                                 title: "Select Timesheet",
//                                 html: '<div class="mt-3 text-start">'+html+'</div>',
//                                 confirmButtonClass: "btn btn-primary w-xs mb-2",
//                                 confirmButtonText: 'Start',
//                                 buttonsStyling: !1,
//                                 showCloseButton: !0,
//                             }).then(function (t) {
//                                 if (t.value) {
//                                     var timesheetID = $('#timesheetID').val();
//                                     var roster_id = $("#timesheetID option:selected").attr('data-roster');
//                                     var outlet_id = $("#timesheetID option:selected").attr('data-outlet');
//                                     var outlet_name = $("#timesheetID option:selected").attr('data-outlet_name');
//                                     $('#employee_timesheet_id').val(timesheetID);
//                                     $('#roster_id').val(roster_id);
//                                     $('#outlet_id').val(outlet_id);
//                                     $('#outlet_name').val(outlet_name);
                                    
//                                     // save the intime to db
//                                     var result = save_record('in_time',time);
//                                     var d = new Date(time);
//                                     let hours = d.getHours();
//                                     let am_pm = (hours >= 12) ? "PM" : "AM";
//                                     if(result == 'success'){
//                                         $('#startBtn').css('display','none');
//                                         $('#endBtns').css('display','block');
//                                         $('#shift_active').html('<span class="text-success ">On Shift</span>');
//                                         $('.shift_status').html('Started <span id="startTime">'+time+am_pm+'</span> at '+outlet_name);
//                                         $('#shift_status_dot').html('<i class="mdi mdi-circle fs-20 align-middle me-1 text-success"></i>');
//                                     }else if(result == 'Early'){
//                                         Swal.fire({
//                                             title: "Login time not must not exceed 15 mins as per your rosterd time.Please Try again in some time",
//                                             icon: "warning",
//                                             showCancelButton: 0,
//                                             confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//                                             cancelButtonClass: "btn btn-danger w-xs mt-2",
//                                             confirmButtonText: "Okay",
//                                             buttonsStyling: !1,
//                                             showCloseButton: 0,
//                                         });
//                                     }else{
//                                         Swal.fire({
//                                             title: "Something went wrong!",
//                                             text: "Contact Your Manager.",
//                                             icon: "error",
//                                             showCancelButton: 0,
//                                             confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//                                             cancelButtonClass: "btn btn-danger w-xs mt-2",
//                                             confirmButtonText: "Okay",
//                                             buttonsStyling: !1,
//                                             showCloseButton: 0,
//                                         });
//                                     }
                                     
                                    
//                                 }
//                             });
//     	            }else{
//     	                Swal.fire({
//     	                    icon: 'warning',
//                             title: "Today you have not assigned any timesheet.",
//                             confirmButtonClass: "btn btn-primary w-xs mb-2",
//                             confirmButtonText: 'Okay',
//                             buttonsStyling: !1,
//                             showCloseButton: !0,
//                         });
//     	            }
// 	            }else{
// 	                Swal.fire({
// 	                    icon: 'warning',
//                         title: "Something went wrong.",
//                         confirmButtonClass: "btn btn-primary w-xs mb-2",
//                         confirmButtonText: 'Okay',
//                         buttonsStyling: !1,
//                         showCloseButton: !0,
//                     });
// 	            }
// 			}
// 	    });
        
//     });
//     $(document).on( 'click', '#endBtn', function () {
//         var time = setClockTime();
//         var result = save_record('out_time',time);
//         if(result == 'success'){
//             $('#endBtns').css('display','none');
//             $('#breakstartBtn').removeAttr('disabled');
//             $('#startBtn').css('display','inline-block');
//             $('#shift_active').html('');
//             $('#shift_status_dot').html('');
//             $('.shift_status').html('No scheduled shifts');
//             Swal.fire({
//                 title: "You have finished your shift.",
//                 icon: "success",
//                 showCancelButton: 0,
//                 confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//                 cancelButtonClass: "btn btn-danger w-xs mt-2",
//                 confirmButtonText: "Okay",
//                 buttonsStyling: !1,
//                 showCloseButton: 0,
//             });
//         }else{
//             Swal.fire({
//                 title: "Something went wrong!",
//                 text: "Contact Your Manager.",
//                 icon: "error",
//                 showCancelButton: 0,
//                 confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//                 cancelButtonClass: "btn btn-danger w-xs mt-2",
//                 confirmButtonText: "Okay",
//                 buttonsStyling: !1,
//                 showCloseButton: 0,
//             });
//         }
//     });
//     $(document).on( 'click', '#breakstartBtn', function () {
//         var result = save_break_record('break_in_time');
//         if(result == 'success'){
//             $('#breakstartBtn').css('display','none');
//             $('#endBtn').attr('disabled','disabled');
//             $('#breakendBtn').css('display','inline-block');
//             $('#shift_status_dot').html('<i class="mdi mdi-circle fs-20 align-middle me-1 text-warning"></i>');
//             $('#shift_active').html('<span class="text-warning">On Break</span>');
//             $('.shift_status').html('<span id="Timer">0</span>m taken of your break');
//             breaktimer();
//             var t;
//             Swal.fire({
//                 title: "Break Time!",
//                 icon: 'success',
//                 html: '<p>Enjoy your break.</p>',
//                 timer: 2e3,
//                 timerProgressBar: !0,
//                 showCloseButton: !0,
//                 showConfirmButton: !1,
//                 didOpen: function () {
//                     // Swal.showLoading(),
//                         (t = setInterval(function () {
//                             var t = Swal.getHtmlContainer();
//                             t && (t = t.querySelector("b")) && (t.textContent = Swal.getTimerLeft());
//                         }, 100));
//                 },
//                 onClose: function () {
//                     clearInterval(t);
//                 },
//             }).then(function (t) {
//             });
//         }else{
//             Swal.fire({
//                 title: "Something went wrong!",
//                 text: "Contact Your Manager.",
//                 icon: "error",
//                 showCancelButton: 0,
//                 confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//                 cancelButtonClass: "btn btn-danger w-xs mt-2",
//                 confirmButtonText: "Okay",
//                 buttonsStyling: !1,
//                 showCloseButton: 0,
//             });
//         }
//     });
//     $(document).on( 'click', '#breakendBtn', function () {
        
//         var result = save_break_record('break_out_time');
//         if(result){
//             clearInterval(timerInterval);
//             $('#breakendBtn').css('display','none');
//             $('#endBtn').removeAttr('disabled');
//             $('#breakstartBtn').attr('disabled','disabled');
//             $('#breakstartBtn').css('display','inline-block');
//             $('#shift_status_dot').html('<i class="mdi mdi-circle fs-20 align-middle me-1 text-success"></i>');
//             $('#shift_active').html('<span class="text-success">On Shift</span>');
//             var outlet_name = $('#outlet_name').val();
//             $('.shift_status').html('Started <span id="startTime">5:55pm</span> at '+outlet_name);
//         }else{
//             Swal.fire({
//                 title: "Something went wrong!",
//                 text: "Contact Your Manager.",
//                 icon: "error",
//                 showCancelButton: 0,
//                 confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//                 cancelButtonClass: "btn btn-danger w-xs mt-2",
//                 confirmButtonText: "Okay",
//                 buttonsStyling: !1,
//                 showCloseButton: 0,
//             });
//         }
//     });
     
    
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
    
    

</script>