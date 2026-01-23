
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
                    <div class="card-header">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">TIMESHEETS</h5>
                                </div>
                            </div>
                            
                            <div class="col-sm-auto">
                               <div>
                                   <?php if(($this->session->userdata('role')) !='employee'){  ?>
                                        <button class="btn btn-success mx-1" onClick="ButtonFunctions()"><i class="ri-printer-line align-bottom me-1"></i></button>
                                        <button class="btn btn-success mx-1" onClick="DownloadButtonFUn()"><i class="ri-download-2-line align-bottom me-1"></i> Casual Emp</button>
                                        <button class="btn btn-primary" onClick="DownloadButtonFUn2()"><i class="ri-download-2-line align-bottom me-1"></i> Text</button>
                                   <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                 <div class="card mt-4">
                     <div class="card-body">
                            <h5 class="card-title mb-3">Timesheet Details</h5>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap timesheet-details">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0" scope="row" colspan="2"><span class="w-224">Timesheet Name :</span>
                                            <span class="text-muted"><?php  echo ucfirst($timesheet_name); ?></span></th>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row"><span class="w-224">Date Range :</span>
                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($start_date) ); ?> To <?php echo  date("d-m-Y", strtotime($end_date)); ?></span></th>
                                            <th class="ps-0" scope="row"><span class="w-224">Total Hours of the this timesheet :</span>
                                            <span class="text-muted"><?php echo ((isset($employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet']) ? $employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet'] : '0')) ?></span></th>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                            <div class="col-xxl-12">
                               
                                <div class="row m-0 card-border">
                                    
                                        
                                            <div class="col-md-2 px-0">
                                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <?php if(!empty($employee_weekly_timesheet_details) ){  $icountTab = 1 ;
                                                    unset($employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet']);
                                                    foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet_tab){    ?>
                                                     <a class="nav-link text-uppercase <?php if($icountTab == 1){ echo 'active'; } ?>" id="v-tab-<?php echo $icountTab; ?>" data-bs-toggle="pill" href="#v-pills-<?php echo $icountTab; ?>" role="tab" aria-controls="v-pills-<?php echo $icountTab; ?>" aria-selected="true"><?php echo $employee_weekly_timesheet_tab[0]['employee_name']; ?><br><?php if($employee_weekly_timesheet_tab['total_hrsworked_this_week'] !='' ){ echo "( ".$employee_weekly_timesheet_tab['total_hrsworked_this_week']."  )"; }else{ echo "(0)";} ?></a>
                                                   <?php $icountTab++; } } ?>
                                                </div>
                                            </div><!-- end col -->
                                       
                                            
                                            <div class="col-md-10 px-0">
                                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                    <?php if(!empty($employee_weekly_timesheet_details) ){  $icount = 1 ;?>
                                                     <?php  foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet_detail){    ?>
                                                                 
                                                        
                                                    <div class="tab-pane fade show <?php if($icount == 1){ echo 'active'; } ?>" id="v-pills-<?php echo $icount; ?>" role="tabpanel" aria-labelledby="v-tab-<?php echo $icountTab; ?>">
                                                        <?php $icount++; ?>
                                                        <form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/update_multiple_timesheet" enctype="multipart/form-data">
                                                        <div class="row g-4 align-items-center mx-0 mt-2 mb-2">
                                                            <?php if(($this->session->userdata('role')) == 'employee'){  ?> <!-- Heading for employee login -->
                                                                <div class="col-lg-12 col-12 mt-0"><h4 class="text-muted text-center mb-0 fs-14 text-uppercase"><?php echo $employee_weekly_timesheet_detail[0]['employee_name']; ?></h4></div>
                                                                
                                                            <?php } else{ ?>     <!-- Heading for admin/manager login -->
                                                                <div class="col-lg-5 col-12 mt-0">
                                                                
                                                                    <select class="form-control status_chnage mx-1" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)">
                                                                        <option value="">Select Status</option>
                                                                        <option value="0" <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 0){ echo "selected"; } ?>>Pending</option>
                                                                        <option value="1" <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 1){ echo "selected"; } ?>>Approved</option>
                                                                        <option value="2" <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 2){ echo "selected"; } ?>>Rejected</option>
                                                                        <option value="3" <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 3){ echo "selected"; } ?>>Comments</option>
                                                                    </select>
                                                                
                                                            
                                                                    <button type="button" class="btn btn-info mx-1" title="Round Off"><i class="ri-refresh-line align-bottom me-1"></i></button>
                                                                    <button type="button" class="btn btn-primary mx-1" onclick='make_field_editable(this)'><i class="ri-pencil-fill align-bottom me-1"></i></button>
                                                                    <button type="submit" class="btn btn-success saveBtn" type="submit" style="display:none"><i class="ri-save-3-fill align-bottom me-1"></i></button>
                                                                
                                                                    
                                                                </div>
                                                                <div class="col-lg-2 col-12 mt-0"><h4 class="text-muted text-center mb-0 fs-14 text-uppercase"><?php echo $employee_weekly_timesheet_detail[0]['employee_name']; ?></h4></div>
                                                                <div class="col-lg-5 col-12 mt-0 text-end"><!--<button class="btn btn-secondary mx-1" >Next <i class="ri-arrow-right-s-line align-bottom me-1"></i></button>--></div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="table-responsive px-3">
                                                            <table class="table align-middle table-nowrap timesheet-record table-striped-columns" ><thead class="table-dark text-white"><tr>
         
                                                                <th></th>
                                                                     <?php  
                                                                // if(!empty($employee_weekly_timesheet_details)){
                                                                    // echo "<pre>";print_r($employee_weekly_timesheet_details);exit;
                                                                    // unset($employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet']);
                                                                    //  foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet){ 
                                                                     ?>
                                                                   <?php    for($count = 0;$count < 7;$count++ ) {  ?>
                                                                        <th style="text-align: center;"> <?php echo date("d-m-Y", strtotime($employee_weekly_timesheet_detail[$count]['date'])).'<br>('.strtoupper(date('D', strtotime($employee_weekly_timesheet_detail[$count]['date']))).')'; ?>
                                                                        </th>
                                                                     <?php }  ?>
                                                                     <?php // } } ?>
                                                                    </tr></thead>
                                                                  
                                                                      <tbody>
                                                                      
                                                                       
                                                                         <input type="hidden" name="timesheet_id" id="timesheet_id" value="<?php echo $employee_weekly_timesheet_detail[0]['timesheet_id']?>">
                                                                         <input type="hidden" name="roster_group_id" value="<?php echo $roster_group_id; ?>">
                                                                        <tr class="no_of_row">
                                                                       
                                                                        <input type="hidden" name="roster_id[]" value="<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>">
                                                                       
                                                                       <td class="start_end"><table>
                                                                         <tr><td class="child ct-font-td">In</td> </tr>
                                                                         <tr><td class="child ct-font-td">Out</td> </tr>
                                                                        <tr> <td class="child ct-font-td">Break In</td> </tr>
                                                                         <tr><td class="child ct-font-td">Break Out</td> </tr>
                                                                         <tr><td class="child ct-font-td">Outlet</td> </tr>
                                                                         
                                                                         </table>
                                                                         </td>
                                                                       <?php
                                                                        $loop_count = 0;
                                                                      for ($i = 0; $i < 7; $i++) { ?>
                                                                          
                                                                        <td class="start_end"><table><tr>
                                                                         
                                                                         <td class="child start_height date datetimepicker3"> <input class="editable_field custom_disable" readonly="" type="text" data-provider="timepickr" data-time-basic="true" name="in_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['in_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['in_time'])); }?>"> </td>
                                                                         
                                                                         </tr>
                                                                     <tr>
                                                                      
                                                                     <td class="child start_height date datetimepicker3"> <input class="editable_field custom_disable" readonly="" type="text" data-provider="timepickr" data-time-basic="true" name="out_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['out_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['out_time']));} ?>"></td>
                                                                
                                                                       </tr>
                                                                       <tr>
                                                                           
                                                                           <td class="child start_height date datetimepicker3"><input class="editable_field custom_disable" readonly="" type="text" data-provider="timepickr" data-time-basic="true" name="break_in_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['break_in_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['break_in_time'])); } ?>"></td>
                                                                         
                                                                       </tr>
                                                                       <tr>
                                                                            
                                                                            <td class="child start_height date datetimepicker3"><input class="editable_field custom_disable" readonly="" type="text" data-provider="timepickr" data-time-basic="true" name="break_out_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['break_out_time'] !='') { echo  date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['break_out_time'])); } ?>"></td>
                                                                       </tr>
                                                                       <tr>
                                                                              
                                                                            <td class="child start_height"><input class="editable_field custom_disable" readonly="" type="text" name="outletname@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php echo $employee_weekly_timesheet_detail[$loop_count]['outletname']; ?>"></td>
                                                                       </tr>
                                                                       
                                                                        <?php  $loop_count++;  ?>
                                                                       </table></td>
                                                                      <?php  } ?>
                                                                      
                                                                    
                                                                         </tr>
                                                                         <tr>
                                                                             <td class="text-muted fs-14 text-uppercase" colspan="8">Roster Details</td>
                                                                         </tr>
                                                                         <tr class="no_of_row">
                                                                       
                                                                        <input type="hidden" name="roster_id[]" value="<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>">
                                                                       
                                                                       <td class="start_end"><table><tr>
                                                                         <td class="child ct-font-td">Start</td> </tr>
                                                                         <tr><td class="child ct-font-td">End</td> </tr>
                                                                        <tr> <td class="child ct-font-td">Break</td> </tr>
                                                                        <tr> <td class="child ct-font-td">Outlet</td> </tr>
                                                                        
                                                                         </table>
                                                                         </td>
                                                                        
                                                                        <?php	$week_days = array('mon','tues','wed','thus','fri','sat','sun');
                                                                         $outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                                                                            $loop_count = 0;
                                                    						for ($i = 0; $i < 7; $i++) { 
                                                        						$startName = $week_days[$i].'_start_time';
                                                                                $endName = $week_days[$i].'_end_time';
                                                                                $breakDurationName = $week_days[$i].'_break_time'; 
                                                                                $outletName = $outletweek_days[$i].'_layout_name'; 
                                                                            ?>
                                                                            <td class="start_end"><table><tr>
                                                                         
                                                                            <td class="child start_height date datetimepicker3"> <input class="readonly_field <?php echo $startName; ?>" readonly="" type="text" value="<?php if($employee_weekly_timesheet_detail[$loop_count][$startName] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count][$startName])); }?>"> </td>
                                                                         
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="child start_height date datetimepicker3"> <input class="readonly_field <?php echo $endName; ?>" readonly="" type="text" value="<?php if($employee_weekly_timesheet_detail[$loop_count][$endName] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count][$endName])); }?>"></td>
                                                                            </tr>
                                                                            <tr>
                                                                           
                                                                                <td class="child start_height date datetimepicker3"><input class="readonly_field <?php echo $breakDurationName; ?>" readonly="" type="text" value="<?php echo $employee_weekly_timesheet_detail[$loop_count][$breakDurationName]; ?>"></td>
                                                                         
                                                                            </tr>
                                                                            <tr>
                                                                           
                                                                                <td class="child start_height date datetimepicker3"><input class="readonly_field <?php echo $outletName; ?>" readonly="" type="text" value="<?php echo $employee_weekly_timesheet_detail[$loop_count][$outletName]; ?>"></td>
                                                                         
                                                                            </tr>
                                                                     
                                                                       
                                                                        <?php  $loop_count1++;  ?>
                                                                       </table></td>
                                                                       
                                                                      <?php  } ?>
                                                                      
                                                                    
                                                                         </tr>
                                                                         
                                                                        
                                                                         </tbody>
                                                                      
                                                                        </table>
                                                        </div>
                                                         </form> 
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card-header border-bottom-dashed">
                                                                    <h5 class="card-title ">Comments</h5>
                                                                </div>
                                                                <div class="user-chat w-100 overflow-hidden">

                                                                        <div class="chat-content d-lg-flex">
                                                                             <!--start chat conversation section -->
                                                                            <div class="w-100 overflow-hidden position-relative">
                                                                                 <!--conversation user -->
                                                                                <div class="position-relative">
                                                                                    <div class="p-3 user-chat-topbar">
                                                                                        <div class="row align-items-center">
                                                                                            <div class="col-sm-12 col-12">
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                                                                        <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                                                                    </div>
                                                                                                    <div class="flex-grow-1 overflow-hidden">
                                                                                                        <div class="d-flex align-items-center">                            
                                                                                                            <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                                                               
                                                                                                                <span class="ri-account-circle-fill fs-24"></span>
                                                                                                            </div>
                                                                                                            <div class="flex-grow-1 overflow-hidden">
                                                                                                                <h5 class="text-truncate mb-0 fs-16"><span class="text-reset username text-uppercase"><?php echo $employee_weekly_timesheet_detail[0]['employee_name']; ?></span></h5>
                                                                                                                
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                            
                                                                                    </div>
                                                                                     <!--end chat user head -->
                                        
                                                                                    <div class="position-relative" id="users-chat" >
                                                                                    <div class="chat-conversation p-3 p-lg-4 " id="chat-conversation" data-simplebar>
                                                                                        <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                                                            <?php if(!empty($employee_weekly_timesheet_detail[0]['comments'])){ 
                                                                                                foreach($employee_weekly_timesheet_detail[0]['comments'] as $comment){
                                                                                                    if($role == $comment['posted_by']){
                                                                                            ?>
                                                                                            <li class="chat-list right">
                                                                                                <div class="conversation-list">
                                                                                                    <div class="user-chat-content">
                                                                                                        <div class="ctext-wrap">
                                                                                                            <div class="ctext-wrap-content">
                                                                                                                <p class="mb-0 ctext-content"><?php echo $comment['comments']; ?></p>
                                                                                                            </div>
                                                                                                           
                                                                                                        </div>
                                                                                                        <div class="conversation-name">
                                                                                                            <small class="text-muted time"><?php if($comment['posted_by'] == 'employee'){ echo $comment['first_name'].' '.$comment['last_name']; }else{ echo $comment['username']; } ?> <?php echo date("d-m-Y", strtotime($comment['posted_at_date'])); ?> <?php echo date("H:i", strtotime($comment['posted_at_time'])); ?></small></div>
                                                                                                    </div>                
                                                                                                </div>            
                                                                                            </li>
                                                                                            <?php } else{ ?>
                                                                                            <li class="chat-list left">
                                                                                                <div class="conversation-list">
                                                                                                    <div class="chat-avatar">
                                                                                                        <span class="ri-account-circle-fill fs-24"></span>
                                                                                                    </div>
                                                                                                    <div class="user-chat-content">
                                                                                                        <div class="ctext-wrap">
                                                                                                            <div class="ctext-wrap-content">
                                                                                                                <p class="mb-0 ctext-content"><?php echo $comment['comments']; ?></p>
                                                                                                            </div>
                                                                                                            
                                                                                                        </div>
                                                                                                        <div class="conversation-name">
                                                                                                            <small class="text-muted time"><?php if($comment['posted_by'] == 'employee'){ echo $comment['first_name'].' '.$comment['last_name']; }else{ echo $comment['username']; } ?> <?php echo date("d-m-Y", strtotime($comment['posted_at_date'])); ?> <?php echo date("H:i", strtotime($comment['posted_at_time'])); ?></small></div>
                                                                                                    </div>                
                                                                                                </div>            
                                                                                            </li>
                                                                                            <?php } ?>
                                                                                            
                                                                                            <?php }  }else{ ?>
                                                                                            <li class="chat-list center empty-chat"><span class="text-muted text-center w-100">No conversation</span></li>
                                                                                            <?php } ?>
                                                                                        </ul>
                                                                                         <!--end chat-conversation-list -->
                                                                                        
                                                                                    </div>
                                                                                    <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show " id="copyClipBoard" role="alert">
                                                                                        <!--Message copied-->
                                                                                    </div>
                                                                                </div>
                                                                                    
                                                                                     <!--end chat-conversation -->
                                        
                                                                                    <div class="chat-input-section p-3 p-lg-4"> 
                                                                   
                                                                                        <form id="chatinput-form" enctype="multipart/form-data" > 
                                                                                            <div class="row g-0 align-items-center">
                                                                                                
                                                                                                <div class="col">
                                                                                                    <div class="chat-input-feedback">
                                                                                                        <!--Please Enter a Message-->
                                                                                                    </div>
                                                                                                    <input type="text" class="form-control chat-input bg-light border-light" placeholder="Type your timesheet comment..." autocomplete="off">
                                                                                                </div>
                                                                                                <div class="col-auto">
                                                                                                    <div class="chat-input-links ms-2">
                                                                                                        <div class="links-list-item">
                                                                                                            <button type="button" data-roster="<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>" data-emp="<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>" class="btn btn-primary chat-send waves-effect waves-light shadow">
                                                                                                                <i class="ri-send-plane-2-fill align-bottom"></i>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                        
                                                                                            </div>
                                                                                        </form>    
                                                                                    </div>
                                        
                                                                                    <div class="replyCard">
                                                                                        <div class="card mb-0">
                                                                                            <div class="card-body py-3">
                                                                                                <div class="replymessage-block mb-0 d-flex align-items-start">
                                                                                                    <div class="flex-grow-1">
                                                                                                        <h5 class="conversation-name"></h5>
                                                                                                        <p class="mb-0"></p>
                                                                                                    </div>
                                                                                                    <div class="flex-shrink-0">
                                                                                                        <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18 shadow-none">
                                                                                                            <i class="bx bx-x align-middle"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        </div>
                                                                    </div>
                                                                  
                                                    </div>
                                                   
                                                      <?php $nameOfDay = array(); }  ?>
                                                     </tbody>
                                                   <?php } ?>
                                                </div>
                                            </div><!--  end col -->
                                        </div><!--end row-->
                                    
                            </div><!--end col-->
                            
                        </div><!--end row-->
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
<!-- glightbox js -->
        <script src="<?php echo base_url(""); ?>hr-assets/libs/glightbox/js/glightbox.min.js"></script>

        <!-- fgEmojiPicker js -->
        <script src="<?php echo base_url(""); ?>hr-assets/libs/fg-emoji-picker/fgEmojiPicker.js"></script>

        <!-- chat init js -->
        <script src="<?php echo base_url(""); ?>hr-assets/js/pages/chat.init.js"></script>
<script>
    function make_field_editable(obj){
        $(obj).parents(".tab-pane").find(".editable_field").removeAttr("readonly");
        $(obj).parents(".tab-pane").find(".editable_field").removeClass("custom_disable");
        $(obj).parents(".tab-pane").find(".editable_field").css("border","1px solid #60e59f");
        $(obj).parents(".tab-pane").find(".editable_field:first").focus();
        $(obj).parents(".tab-pane").find(".saveBtn").css('display','inline-block');
        
    }

function update_timesheet_status(emp_id,employee_timesheet_id,obj){
     var status_id =  $(obj).val();
     console.log(status_id);
     var comment = '';
      if(status_id==1){
          $msg = 'Timesheet Approved';
         
      }else if(status_id==2){
          $msg = 'Timesheet Rejected';
          
      }else if(status_id==3){
           
        //   Swal.fire({
        //         title: "Add Comment",
        //         html: '<div class="mt-3 text-start"><label for="input-comment" class="form-label fs-13">Add comment for this timesheet</label><input type="text" class="form-control" id="input-comment" placeholder="Enter Comment"></div>',
        //         confirmButtonClass: "btn btn-primary w-xs mb-2",
        //         confirmButtonText: 'Add',
        //         buttonsStyling: !1,
        //         showCloseButton: !0,
        //     }).then(function (t) {
        //         if (t.value) {
        //             comment = $('#input-comment').val();
        //         }
        //     });
            $msg = 'Comments Added';
      }
      else{
           $msg = 'Timesheet Pending';
      }
        $.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/Employeedetails/update_timesheet",
	        data:'employee_timesheet_id='+employee_timesheet_id+'&status='+status_id+'&comment='+comment+'&emp_id='+emp_id,
	        success: function(data){
	        Swal.fire({
            text: $msg,
             icon: "success",
            });
     
     
	        }
       });
}
 
$('.chat-send').click(function(){
    
    var comment = $(this).closest('#chatinput-form').find('.chat-input').val();
    var chatbox = $(this).closest('.chat-content').find('#users-conversation');
    var employee_id = $(this).attr('data-emp');
    var roster_id = $(this).attr('data-roster');
    var timesheet_id = $('#timesheet_id').val();
    
   console.log('comment '+comment);
   console.log('employee_id '+employee_id);
   console.log('timesheet_id '+timesheet_id);
   if(comment != ''){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/Employeedetails/addRosterComment",
            data:'comment='+comment+'&timesheet_id='+timesheet_id+'&employee_id='+employee_id+'&roster_id='+roster_id,
            success: function(data){
                var html = '';
                if(data != 'error'){
                    var chatdata = JSON.parse(data);
                    html += '<li class="chat-list right"><div class="conversation-list"><div class="user-chat-content"><div class="ctext-wrap"><div class="ctext-wrap-content">';
                    html += '<p class="mb-0 ctext-content">'+comment+'</p></div></div><div class="conversation-name"><small class="text-muted time">'+chatdata.posted_by_name+' '+chatdata.date+' '+chatdata.time+'</small></div></div></div></li>';
                  
                  
                    $('.empty-chat').remove();
                    $(chatbox).append(html);
                    $('.chat-input').val('');
                }else{
                  Swal.fire({ 
                      title: "Error!", 
                      text: "Something went wrong. Try again.", 
                      icon: "error", 
                      confirmButtonClass: "btn btn-info w-xs mt-2", 
                      buttonsStyling: !1 
                  })
                }
              
            }
        });
   }        
       
});

</script> 
