<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="RosterModel">
            <form method="post" id="rosterForm" action="<?php echo base_url(); ?>index.php/admin/submit_roster">
                <input type="hidden" name="roster_template" value="1">
            
                <div class="modal-header py-2 px-3 bg-primary bg-gradient">
                    <div><h5 class="modal-title text-white" id="addRosterLabel">Create Roster</h5></div>
                    <div>
                        <button type="button" onclick="rosterFormSubmit()" class="btn btn-success mr-1">Create</button>
                    <a href="<?php echo base_url(); ?>index.php/admin/get_roster_weeks" class="btn btn-warning">Cancel</a>
                    </div>
                </div>  
                <div class="px-3">
                    <div class="row py-4">
                    <div class="col-lg-3">
                            <div class="align-items-center d-flex">
                                            
                            <div class="flex-shrink-0"><span class="w76 px-2">Roster Name <span class="text-danger fw-700">*</span></span></div>
                            <div class="flex-grow-1">
                                <input type='text' class="form-control" name="roster_name" autocomplete="off" required placeholder="Roster Name"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="align-items-center d-flex">
                            <div class="flex-shrink-0"><span class="w76 px-2">Start Date <span class="text-danger fw-700">*</span></span></div>
                            <div class="flex-grow-1">
                                   <input type="text" class="form-control" id="start_date" name="start_date" data-provider="flatpickr" data-date-format="d-m-Y" placeholder="Start Date" requied> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="align-items-center d-flex">
                            <div class="flex-shrink-0"><span class="w76 px-2">End Date <span class="text-danger fw-700">*</span></span></div>
                            <div class="flex-grow-1">
                                    <input type="text" class="form-control" id="end_date" name="end_date" data-provider="flatpickr" data-date-format="d-m-Y" placeholder="End Date" requied>
                            </div>
                         </div>
                    </div>
                </div>
                </div>
                <div class="">
               
                  <table class="gridjs-table table table-striped table-hover">
                      <thead>
                          <tr>
                            <td class="gridjs-td text-center" width="150">Employee</th>
                            <td class="gridjs-td text-center"> Mon</td>   
                            <td class="gridjs-td text-center"> Tue</td>  
                            <td class="gridjs-td text-center"> Wed</td>  
                            <td class="gridjs-td text-center"> Thu</td>  
                            <td class="gridjs-td text-center"> Fri</td>  
                            <td class="gridjs-td text-center"> Sat</td>  
                            <td class="gridjs-td text-center"> Sun</td>
                            <!--<td class="gridjs-td text-center">Department</td>-->
                            <td class="gridjs-td text-center">Comments</td>
                            <td class="gridjs-td text-center"></td>
                          </tr>
                          </thead>
                          <tbody>
                          
                          <tr class="employeeRole" id="empRosterRow_1" data-count="1">
                              <td class="gridjs-td hrsTag">
                                  
                                  <div class="addemp btn btn-soft-secondary waves-effect waves-light" title="Add Employee" data-rel-id="empRosterRow_1" onclick="addEmployee(this)"><i class=" ri-user-add-fill fs-16"></i></div>
                                  
                                    <div class="empDetails" style="display:none;">
                                        <span class="empName px-2"></span>
                                        <div class="align-items-center d-flex">
                                            <div class="flex-grow-1">
                                                <span class="fs-12 empRoleName text-mute px-2"></span>
                                            </div>
                                            <div class="flex-shrink-0 px-1">
                                                <span class="text-success px-2 editEmpWrap" data-rel-id="empRosterRow_1" onclick="editEmployee(this)" title="Edit Employee details"><i class="ri-pencil-fill"></i></span>
                                            </div>
                                        </div>
                                        <div class="empInputs">
                                            <input type="hidden" name="emp_id[]" id="employeeIdSelected" class="employeeIds">
                                            <!--<input type="hidden" name="roster_department[]" class="empDepartmentId">-->
                                            <input type="hidden" readonly name="role[]" value=""  class="form-control empRoleId">
                                        </div>
                                    </div>
        						</td>
        						<?php	$week_days = array('mon','tues','wed','thus','fri','sat','sun');
                                   
            						for ($i = 0; $i < 7; $i++) { 
            						$startName = $week_days[$i].'_start[]';
                                    $endName = $week_days[$i].'_end[]';
                                    // $value = $week_days[$i].'_end_time';
                                    $breakName = $week_days[$i].'_break_time[]';
                                    $layout = $week_days[$i].'_layout[]'; ?>
                                <td class="gridjs-td hrsTag min-w100 <?php echo $week_days[$i]; ?>_col" rel="<?php echo $week_days[$i]; ?>" id="row_<?php echo $week_days[$i]; ?>_1">
                                    <div class="addHrs <?php echo $week_days[$i]; ?>Hrs" title="Add Hours" rel="<?php echo $week_days[$i]; ?>" data-rel-id="row_<?php echo $week_days[$i]; ?>_1" onclick="addRosterTime(this)">+</div>
                                    <div class="approvedHrs pointerCursor <?php echo $week_days[$i]; ?>Hrs" title="Edit Hours" rel="<?php echo $week_days[$i]; ?>" data-rel-id="row_<?php echo $week_days[$i]; ?>_1" onclick="editRosterTime(this)" style="display:none">
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
                                <?php } ?>
                               <!--<td class="gridjs-td hrsTag w140">-->
                               <!--    <textarea class="form-control rosterfield empDepartment" readonly ></textarea>-->
                               <!--   </td>-->
                               <td class="gridjs-td hrsTag w140"><textarea name="roster_comment[]" class="form-control rosterfield"></textarea></td>
                               <td class="gridjs-td hrsTag w140">
                                   <div class="ct-col-right ct-btns">
                                     <span class="add_field_wrap px-1"><a href="javascript:void(0)" class="btn btn-success add_field_button" >+</a></span>
                                    </div>
                                </td>
                          </tr>
                         
                      </tbody>
                  </table>
                </div>
           </form>
        </div>
    </div>
        <!-- End Page-content -->

        
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
                            
                            <div class="col-xxl-12 col-lg-12" >
                                <div class="alert alert-danger shadow mb-xl-0" id="timealert" role="alert" style="display:none">
                                    <strong> Start Time </strong>and<strong> End Time </strong>fields are mandatory.
                                </div>
                            
                                <div class="alert alert-warning shadow mb-xl-0" id="unavailibilityAlert" role="alert" style="display:none">
                                    Employee not available from <strong id="dataUnavailableWrap">  </strong>
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
                            <!--<div class="col-xxl-6 col-lg-6 col-sm-12">-->
                            <!--    <div>-->
                            <!--        <label class="form-label">Department</label>-->
                            <!--        <select class="form-control " id="empDept">-->
                            <!--    	  <option value="">Select</option>-->
                            <!--    	  <?php foreach($emp_departments as $emp_department){ ?> -->
                            <!--    	     <option value="<?php echo $emp_department->emp_department_id; ?>"><?php echo $emp_department->department_name; ?></option>-->
                            <!--    	  <?php } ?>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--end col-->
                          
                            <div class="col-lg-12 mt-4" id="emp_availability_details" style="display:none;">
                               
                                
                            </div>
                            
                            
                        </div><!--end row-->
                   
                </div>
 
            </div>
        </div>
</div>   
   
 <!--<script src="<?php echo base_url(); ?>assets/js/roster.js"></script>   -->
  
<script type="text/javascript">

function update_days(obj){
    var startDate = $(obj).val();
    consle.log('startDate'+startDate);
}

function fetchRole(obj){
 
    // $('#emp_slt').removeClass('border-danger');
    // $('.emperror').remove();
    var emp_id = $(obj).val();
    var rowIdEmp = $('#rowIdEmp').val();
      
    var employeeIdSelected = $('#'+rowIdEmp).find("#employeeIdSelected");
    var empRoleId = $('#'+rowIdEmp).find(".empRoleId");
    var empRoleName = $('#'+rowIdEmp).find(".empRoleName");
    var empName = $('#'+rowIdEmp).find(".empName");
	    
//   var empcheck = 0;
//     $('.employeeIds').each(function(){
//       if($(this).val() == emp_id){
//          empcheck = 1;
//          return false;
//       }
//     });
    
//     console.log('empcheck'+empcheck);
//   if(empcheck == 0){
    //   $('#addEmployeeBtn').removeAttr('disabled');
        
            	 
        employeeIdSelected.val(emp_id);
    //   console.log($(obj).html());
     
          $.ajax({
            url:"/HR/index.php/admin/fetch_emp_role", 
    		method:"POST", 
    		data:{emp_id:emp_id},
    	    success:function(resp){
    	       var prePopulat = JSON.parse(resp);
    	       
            	 empRoleId.val('');
            	 empRoleName.val('');
            	 empName.val('');
            	 
            	 empRoleId.val(prePopulat[0]['role']);
            	 empRoleName.html(prePopulat[0]['role_name']); 
            	 empName.html(prePopulat[0]['first_name']+' '+prePopulat[0]['last_name']);
                 $("#empRoleNameModal").val(prePopulat[0]['role_name']);
                 $("#emp_availability_details").css('display','none');
                 $("#append_employee_availability").html('');
                 
                 if(typeof prePopulat[0]['rate'] != "undefined" && prePopulat[0]['rate'] !== null){
        	           if(prePopulat[0]['rate'] != '' && prePopulat[0]['rate'] != null){ var rate = '$'+prePopulat[0]['rate']; }else{ var rate = ''; }
            	       if(prePopulat[0]['Saturday_rate'] != '' && prePopulat[0]['Saturday_rate'] != null){ var Saturday_rate = '$'+prePopulat[0]['Saturday_rate']; }else{ var Saturday_rate = ''; }
            	       if(prePopulat[0]['Sunday_rate'] != '' && prePopulat[0]['Sunday_rate'] != null){ var Sunday_rate = '$'+prePopulat[0]['Sunday_rate']; }else{ var Sunday_rate = ''; }
            	       if(prePopulat[0]['holiday_rate'] != '' && prePopulat[0]['holiday_rate'] != null){ var holiday_rate = '$'+prePopulat[0]['holiday_rate']; }else{ var holiday_rate = ''; }
            	       
            	       var tablehtml = '<table><tr><td>Weekdays Rate:</td><td>'+rate+'</td></tr><tr><td>Saturday Rate:</td><td>'+Saturday_rate+'</td></tr><tr><td>Sunday Rate:</td><td>'+Sunday_rate+'</td></tr><tr><td>Holiday Rate:</td><td>'+holiday_rate+'</td></tr></table>';
        	         
                        $("#payRatesetails").html(tablehtml);
                        $("#empPopupCol").addClass('col-lg-8');
                        $("#empPopupCol").removeClass('col-lg-12');
                        $("#empRatesCol").css('display','block');
                 }
                 else{
                    $("#empPopupCol").removeClass('col-lg-8');
                    $("#empPopupCol").addClass('col-lg-12');
                    $("#empRatesCol").css('display','none');
                 }
    
    			}
    	});  
//   }else{
//         $('#emp_slt').addClass('border-danger');
//         $('#emp_slt').after('<p class="emperror text-danger mb-1">Selected employee is already rostered.</p>');
//         $('#addEmployeeBtn').attr('disabled','disabled');
//         $("#empPopupCol").removeClass('col-lg-8');
//         $("#empPopupCol").addClass('col-lg-12');
//         $("#empRatesCol").css('display','none');
	 
// 	    empRoleId.val('');
// 	    empRoleName.val('');
// 	    empName.val('');
// 	    employeeIdSelected.val('');
//   }

      
}
//  For getting employee availability in add , edit and recreate roster

function GetEmpAvailData(obj){
    // 	var form = $("#hack_submit");
	   // var formdata =  form.serialize();
	   var start_date = $('#start_date').val();
	   var rowIdEmp = $('#rowIdEmp').val();
        var emp_id = $('#'+rowIdEmp).find("#employeeIdSelected").val();
	   // var emp_id = $(obj).closest('.hrsTag').find('#employeeIdSelected').val();
	    console.log('emp_id='+emp_id);
        // var emp_id = $(obj).prev("#employeeIdSelected").val();
        if(emp_id !=''){
             $.ajax({
        url:"/HR/index.php/employees/fetch_employee_availability_for_next_week",
		method:"POST",
// 		 data:formdata + '&employee_id=' + emp_id,
		 data:'start_date='+start_date + '&employee_id=' + emp_id,
	    success:function(resp){
	          
	        try { 
	       //  var dayName = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
	            var data = '<span role="button" class="emp_avai_btn text-primary fw-medium collapsed" data-bs-toggle="collapse" data-bs-target="#collapseinline" aria-expanded="false" aria-controls="collapseinline"><span id="availability_collapse_text_show">Show</span><span id="availability_collapse_text_hide">Hide</span> the availability of selected employee for next week.</span><div class="collapse" id="collapseinline"><div class="mb-0 mt-3" id="append_employee_availability"> <table class="table"> <tbody>';
	         
	            var employee_availability = JSON.parse(resp);
	            var unavailabletype = '';
	            $.each(employee_availability, function(i, value) {
	               unavailabletype=value.type;
	              if(unavailabletype =='all_day'){
                    data += '<tr><td>'+value.start_date+'</td> <td>Full Day </td></tr>';
	              }else{
                    data += '<tr><td>'+value.start_date+'</td> <td> '+value.start_time+'-'+value.end_time+'</td></tr>';
	              }
	                  
	              });
          
	          
	          data +=' </tbody></table></div></div>';
	           $("#emp_availability_details").html(data);
	           $("#emp_availability_details").css('display','block');
	          
	        }catch(e){
	       (resp =='error' ? alert('Please select the start date') : '' )
	        
	        }
	        }
	   
		
	});
        }else{
            alert('Please select the employee to view the availability');
        }
     
   
 
  }
  

function addRoster(){
        $("#addRoster").addClass('show');
        $("#addRoster").css('display','block');
    }
    
    $('#addRosterClose').click(function(){
        $('#addRoster').find('.addHrs').css('display','flex');
        $('#addRoster').find('.approvedHrs').css('display','none');
    });
    
    function addRosterTime(that){
        var empID = $( that ).closest( '.employeeRole' ).find('#employeeIdSelected').val();
        var dataUnavailable ='';
        if(empID == ''){
            Swal.fire({
              title: "Please select employee first.",
              icon: "warning",
              showCancelButton: !0,
              confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
              cancelButtonClass: "btn btn-danger w-xs mt-2",
              confirmButtonText: "Okay",
              buttonsStyling: !1,
              showCloseButton: !0,
          });
        }else{
            console.log('empID'+empID);
            var rowId= $(that).attr('data-rel-id');
            var rowrel= $(that).attr('rel');
            dataUnavailable= $(that).attr('data-unavailable');
            $("#addRosterTime").find('input').val('');
            $("#outletName").val('');
            $("#addRosterTime").addClass('show');
            $("#addRosterTime").css('display','block');
            $("#rowId").val(rowId);
            $("#addRosterTimeLabel").html('Add '+rowrel+' Hours');
            $("#addRosterTimeBtn").html('Add');
            console.log(dataUnavailable);
            if(dataUnavailable != '' && dataUnavailable !== undefined){
                $('#unavailibilityAlert').css('display','block');
                $('#dataUnavailableWrap').html(dataUnavailable);
            }
        }
    } 
    function editRosterTime(that){
        var rowId= $(that).attr('data-rel-id');
        var rowrel= $(that).attr('rel');
        var dataUnavailable= $(that).attr('data-unavailable');
        $("#addRosterTime").addClass('show');
        $("#addRosterTime").css('display','block'); 
        $("#rowId").val(rowId);
        $("#addRosterTimeLabel").html('Update '+rowrel+' Hours');
        
        if(dataUnavailable != '' && dataUnavailable !== undefined){
            $('#unavailibilityAlert').css('display','block');
            $('#dataUnavailableWrap').html(dataUnavailable);
        }
            
        var startTime = $('#'+rowId).find('.startTimeInputValue').val();
        var finishTime = $('#'+rowId).find('.finishTimeInputValue').val();
        var breakDuration = $('#'+rowId).find('.breakTimeInputValue').val();
        var outletName = $('#'+rowId).find('.outletNameID').val();
        var break_start = $('#'+rowId).find('.'+rowrel+'_break_start').val();
        var break_finish = $('#'+rowId).find('.'+rowrel+'_break_finish').val();
        // var i = 0;
        // var breaktimehtml = '';
        // var diff = 0;
        // $(break_start).each(function(){
        //     var startTm = $(this).val();
        //     var endTm = $(break_finish[i]).val();
        //     if(startTm != '' && endTm != ''){
        //     diff = ( new Date("2023-02-01 " + endTm) - new Date("2023-02-01 " + startTm) ) / 1000 / 60;
        //     breaktimehtml += '<div class="breakTimeRow"><div class="align-items-center row g-2 "><div class="col-lg-5 col-sm-5 col-xs-12 mt-3"><label for="breakTimeStart" class="form-label">Break Time Start</label>';
        //     breaktimehtml += '<input type="text" class="form-control breakTimeStart" data-provider="timepickr" data-time-basic="true" placeholder="Break Time Start" value="'+startTm+'"></div>';
        //     breaktimehtml += '<div class="col-lg-5 col-sm-5 col-xs-12 mt-3"><label for="breakTimeFinish" class="form-label">Break Time Finish</label><input type="text"  value="'+endTm+'"class="form-control breakTimeFinish" data-provider="timepickr" data-time-basic="true" placeholder="Break Time Finish"></div>';
        //     breaktimehtml += '<div class="col-lg-2 col-sm-2 col-xs-12 mt-3"><label for="breakTimeDuration" class="form-label">Duration</label><input type="text" class="form-control breakTimeDuration" value="'+diff+'" readonly placeholder="Hours"></div></div>';
        //     breaktimehtml += '<p class="pointerCursor mt-2 mb-0 fw-medium text-end breakBtns"><span class="delBreakTimeBtn text-danger align-items-center justify-content-end d-flex"><i class="ri-delete-bin-5-fill px-1"></i> Del Break Time</span></p></div>';
        //     }
            
        //   i++;
        // });
        // $(breaktimehtml).insertBefore('.breakTimeRow');
        $("#startTime").val(startTime);
        $("#finishTime").val(finishTime);
        $(".breakTimeStart").val(break_start);
        $(".breakTimeFinish").val(break_finish);
        $(".breakTimeDuration").val(breakDuration);
        var options ='';
        $("#outletName option").each(function()
            {
                if($(this).val() == outletName){
                    options += '<option value="'+$(this).val()+'" selected>'+$(this).text()+'</option>';
                }else{
                    if($(this).val() == 'add_outlet'){
                        options += '<option value="add_outlet" class="text-center text-primary fw-medium bg-soft-secondary py-1">+ Add New Outlet</option>';
                    }else{
                        options += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
                    }
                }
            });
        $('#outletName').html(options);
        $("#addRosterTimeBtn").html('Update');
    } 
    $('#addRosterTimeClose').click(function(){
        $('#timealert').css('display','none');
    });
    
    function addtime(){
        var startTime = $("#startTime").val();
        var finishTime = $("#finishTime").val();
        var breakTimeStart = '';
        var breakTimeFinish = '';
        var html = '';
        var outletid = $("#outletName").val();  
        var outletName = $("#outletName option:selected").text();
        var rowid = $("#rowId").val();
        var rowWeek = $('#'+rowid).attr('rel');
        if(startTime != '' && finishTime != ''){
            
            var totalBreakDuration = $('.breakTimeDuration').val();
            // var totalBreakDuration = 0;
            // $('.breakTimeDuration').each(function(){
            //     totalBreakDuration = totalBreakDuration + parseInt($(this).val());
            // });
            var empID = $('#'+rowid).closest('.employeeRole').find('#employeeIdSelected').val();
            $('.breakTimeStart').each(function(){
                
                breakTimeStart = $(this).val();
                breakTimeFinish = $(this).closest('.row').find('.breakTimeFinish').val();
                html += '<input type="hidden" name="'+rowWeek+'_break_start['+empID+']['+startTime+'][]" class="'+rowWeek+'_break_start break_values" value="'+breakTimeStart+'"><input type="hidden" name="'+rowWeek+'_break_finish['+empID+']['+startTime+'][]" class="'+rowWeek+'_break_finish break_values" value="'+breakTimeFinish+'">';
                
            }); 
            
            $('#'+rowid).find('.breakInOutTime').html(html);
            $('#'+rowid).find('.startTimeInputValue').val(startTime);
            $('#'+rowid).find('.startTimeValue').html(startTime);
            $('#'+rowid).find('.finishTimeInputValue').val(finishTime);
            $('#'+rowid).find('.finishTimeValue').html(finishTime);
            if(totalBreakDuration != ''){
                $('#'+rowid).find('.breakTimeInputValue').val(totalBreakDuration);
            }
            $('#'+rowid).find('.breakTimeValue').html(totalBreakDuration);
            if(outletName != 'Select'){
                $('#'+rowid).find('.outletNameValue').html(outletName);
                $('#'+rowid).find('.outletNameID').val(outletid);
            }else{
                $('#'+rowid).find('.outletNameID').val('');
            }
            
            $('#'+rowid).find('.addHrs').css('display','none');
            $('#'+rowid).find('.approvedHrs').css('display','block');
            $("#addRosterTime").find('input').val('');
            $("#addRosterTime").removeClass('show');
            $("#addRosterTime").css('display','none');
            $('.alert').css('display','none');
        }else{
            $('#timealert').css('display','block');
        }
    }
    $(document).on( 'change', '.breakTimeStart, .breakTimeFinish', function () {
        breakTimeStart = $(this).closest('.row').find('.breakTimeStart').val();
        breakTimeFinish = $(this).closest('.row').find('.breakTimeFinish').val();
        var diff = ( new Date("2023-02-01 " + breakTimeFinish) - new Date("2023-02-01 " + breakTimeStart) ) / 1000 / 60;
        if(diff > 0){
            $(this).closest('.row').find('.breakTimeDuration').val(diff);
        }else{
            $(this).closest('.row').find('.breakTimeDuration').val('0')
        }
    });
    function addEmployee(that){
        var rowId= $(that).attr('data-rel-id');
        $("#addEmployeeModel").addClass('show');
        $("#addEmployeeModel").css('display','block');
        $("#rowIdEmp").val(rowId);
        $("#addEmployeeModelLabel").html('Add Employee');
        $("#addEmployeeBtn").html('Add');
    } 
    $('#addEmployeeClose').click(function(){ 
        if($("#addEmployeeBtn").html() == 'Add'){
            var rowId= $("#rowIdEmp").val();
            $("#"+rowId).find('.empInputs input').val('');
            $("#payRatesetails").html('');
            $("#empPopupCol").removeClass('col-lg-8');
            $("#empPopupCol").addClass('col-lg-12');
            $("#empRatesCol").css('display','none');
        }
        $('#emp_slt').removeClass('border-danger');
        $('.emperror').remove();
        $('#addEmployeeBtn').removeAttr('disabled');
        
    });
    function addEmployeeDetails(){
        var startDate = $("#start_date").val();
        if(startDate != ''){
            var emp_slt = $("#emp_slt").val();
            // var empDept = $( "#empDept option:selected" ).text();
            // var empDeptId = $( "#empDept" ).val();
            var rowid = $("#rowIdEmp").val();
            
            $('#'+rowid).find('.addHrs').css('pointer-events','unset');
            $('#'+rowid).find('.addHrs').css('color','#212529');
            $('#'+rowid).find('.addHrs').html('+');
            $('#'+rowid).find('.addHrs').removeAttr('data-unavailable');
            if(emp_slt != ''){ 
                
                $('#'+rowid).find('.addemp').css('display','none');
                $('#'+rowid).find('.empDetails').css('display','block');
                $("#addEmployeeModel").find('.form-control').val('');
                $("#addEmployeeModel").removeClass('show');
                $("#addEmployeeModel").css('display','none');
                $('#empalert').css('display','none');
                $("#empPopupCol").removeClass('col-lg-8');
                    $("#empPopupCol").addClass('col-lg-12');
                    $("#empRatesCol").css('display','none');
                    $('#emp_slt').removeClass('border-danger');
                    $('.emperror').remove();
                    $('#addEmployeeBtn').removeAttr('disabled');
                    var weekday=new Array('sun','mon','tues','wed','thus','fri','sat');
                    
                $.ajax({
                    url:"/HR/index.php/employees/fetch_employee_availability_for_next_week",
            		method:"POST",
            		 data:'start_date='+startDate + '&employee_id=' + emp_slt,
            	    success:function(resp){
            	        if(resp){
            	            var employee_availability = JSON.parse(resp);
            	            $.each(employee_availability, function(i, value) {
    	                        unavailabletype=value.type;
            	                if(unavailabletype == 'all_day'){
            	                    if(value.start_date == value.end_date){
            	                        var d = new Date(value.start_date);
            	                        var unavday = weekday[d.getDay()];
            	                        $('#'+rowid).find('.'+unavday+'Hrs').css('pointer-events','none');
            	                        $('#'+rowid).find('.'+unavday+'Hrs').css('color','#f00');
            	                        $('#'+rowid).find('.'+unavday+'Hrs').html('Employee not available');
            	                    }    
            	                       
            	                }else if(unavailabletype == 'by_time'){
            	                    if(value.start_date == value.end_date){
            	                        var d = new Date(value.start_date);
            	                        var unavday = weekday[d.getDay()];
            	                        console.log(unavday);
            	                        $('#'+rowid).find('.'+unavday+'Hrs').attr('data-unavailable',value.start_time+' - '+value.end_time);
            	                    } 
            	                    
            	                }else{}
            	            });
            	        }
            	   }
            	});
            }else{
                $('#empalert').css('display','block');
            }
        }else{
            alert('Please select the start date');
        }
    }
    function editEmployee(that){
        var rowId= $(that).attr('data-rel-id');
        $("#addEmployeeModel").addClass('show');
        $("#addEmployeeModel").css('display','block');
        $("#rowIdEmp").val(rowId);
        $("#addEmployeeModelLabel").html('Edit Employee');
        $("#addEmployeeBtn").html('Update');
        $("#emp_availability_details").css('display','none');
        $("#append_employee_availability").html('');
        var emp_id = $('#'+rowId).find("#employeeIdSelected").val();
        // var empDeptId = $('#'+rowId).find(".empDepartmentId").val();
        var empRoleName = $('#'+rowId).find(".empRoleName").html();
        
        $("#empRoleNameModal").val(empRoleName);
        var options = '';
        $("#emp_slt option").each(function()
            {
                if($(this).val() == emp_id){
                    options += '<option value="'+$(this).val()+'" selected>'+$(this).text()+'</option>';
                }else{
                    options += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
                }
            });
        $('#emp_slt').html(options);
        
        // var optionsDept = '';
        // $("#empDept option").each(function()
        //     {
        //         if($(this).val() == empDeptId){
        //             optionsDept += '<option value="'+$(this).val()+'" selected>'+$(this).text()+'</option>';
        //         }else{
        //             optionsDept += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
        //         }
        //     });
        // $('#empDept').html(optionsDept);
        
    } 
       
    $('.ModalClose').click(function(){
        $(this).closest('.modal').removeClass('show');
        $(this).closest('.modal').css('display','none');
        $(this).closest('.modal').find('input, textarea').val('');
        $(this).closest('.modal').find('select').val('');
        $(this).closest('.modal').find('#emp_availability_details').css('display','none'); 
        $(this).closest('.modal').find('.alert').css('display','none');
    });
    
    // multiple break time
    $(document).on( 'click', '.addBreakTimeBtn', function () {
        
        var thisRow = $( this ).closest( '.breakTimeRow' );
        
        $( thisRow ).clone().insertAfter( thisRow ).find('.form-control').val( '' );
        $( thisRow ).find('.breakBtns').html('<span class="delBreakTimeBtn text-danger align-items-center justify-content-end d-flex"><i class="ri-delete-bin-5-fill px-1"></i> Del Break Time</span>');
        
    });
    $(document).on("click", ".delBreakTimeBtn" , function() {
        $(this).closest('.breakTimeRow').remove();
    });
    
    $(document).on("change", "#outletName" , function() {
        var outletval = $(this).val();
        if(outletval == 'add_outlet'){
            $(this).val('');
            Swal.fire({
                title: "Add New Outlet",
                html: '<div class="mt-3 text-start"><label for="input-outlet" class="form-label fs-13">Outlet Name</label><input type="text" class="form-control" id="input-outlet" placeholder="Enter Outlet Name"></div>',
                confirmButtonClass: "btn btn-primary w-xs mb-2",
                confirmButtonText: 'Create',
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function (t) {
                if (t.value) {
                    var outletNameval = $('#input-outlet').val(); 
                    console.log(outletNameval); 
                    $.ajax({
                        url:"/HR/index.php/admin/saveOutlet", 
                		method:"POST", 
                		data:{outletNameval:outletNameval},
                	    success:function(resp){
	                        
                            if(resp != 'error'){
                               $('#outletName').append('<option value="'+resp+'" selected>'+outletNameval+'</option>');
                                Swal.fire({ title: "Outlet Saved!", icon: "success", confirmButtonClass: "btn btn-primary w-xs", buttonsStyling: !1 }); 
                            }else{
                                Swal.fire({ title: "Outlet not saved", icon: "info", confirmButtonClass: "btn btn-primary w-xs", buttonsStyling: !1 });
                            }
                            
                	    }
                    });
                }
            });
        }
    });
    



$('.remove-item-btn').click(function(){
    var id = $(this).attr('data-rel-id');
    Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: !0,
          confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
          cancelButtonClass: "btn btn-danger w-xs mt-2",
          confirmButtonText: "Yes, delete it!",
          buttonsStyling: !1,
          showCloseButton: !0,
      }).then(function (e) {
          if (e.value) {
              
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/admin/delete_roster",
                data:'id='+id,
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});


	// clone row for wrap

$(document).on( 'click', '.add_field_button', function () {
    
    var thisRow = $( this ).closest( '.employeeRole' );
    
    var RowCount = $( thisRow ).attr('data-count');
    $( thisRow ).clone().insertAfter( thisRow ).find('input, select').val( '' );
    $( thisRow ).next('.employeeRole').find('textarea').html('');
    $( thisRow ).next('.employeeRole').find('textarea').val('');
    $( thisRow ).next('.employeeRole').find('.break_values').remove();
    $( thisRow ).next('.employeeRole').find('.addHrs').css('display','flex');
    $( thisRow ).next('.employeeRole').find('.approvedHrs').css('display','none');
    $( thisRow ).next('.employeeRole').find('.addemp').css('display','flex');
    $( thisRow ).next('.employeeRole').find('.empDetails').css('display','none');
    $( thisRow ).next('.employeeRole').find('.addHrs').css('pointer-events','unset');
    $( thisRow ).next('.employeeRole').find('.addHrs').css('color','#212529');
    $( thisRow ).next('.employeeRole').find('.addHrs').html('+');
    $( thisRow ).next('.employeeRole').find('.addHrs').removeAttr('data-unavailable');
    
    var thisRowAddbtn = $( thisRow ).next('.employeeRole').find( '.add_field_wrap' );
    if (!$(thisRow).has(".remove_field_button").length) {
        $('<span><a href="#" class="btn btn-danger remove_field_button">-</a></span>').insertAfter(thisRowAddbtn);
    } 
    
    var RowCountnext = RowCount;
    var weekddays = ['mon','tues','wed','thus','fri','sat','sun'];
    var tempRow = $( thisRow ).nextAll( '.employeeRole' );
    tempRow.each(function() {
        RowCountnext = parseInt(RowCountnext) + 1;
        $( this ).attr('data-count',RowCountnext);
        $( this ).attr('id','empRosterRow_'+RowCountnext);
        $( this ).find('.addemp').attr('data-rel-id','empRosterRow_'+RowCountnext);
        $( this ).find('.editEmpWrap').attr('data-rel-id','empRosterRow_'+RowCountnext);
        
        for(var i=0;i<7;i++){
            $( this ).find('.'+weekddays[i]+'_col').attr('id','row_'+weekddays[i]+'_'+RowCountnext);
            $( this ).find('.'+weekddays[i]+'_col [rel = '+weekddays[i]+']').attr('data-rel-id','row_'+weekddays[i]+'_'+RowCountnext);
        }
    });
    
});
$(document).on("click", ".remove_field_button" , function() {
    $(this).closest('.employeeRole').remove();
});

function rosterFormSubmit(){
	
	var form = $("#rosterForm");
	var formdata =  form.serialize();
	
	     $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/submit_roster",
		        data:formdata,
		      //  beforeSend: function(){
        //         $("#loader").show();
        //          },
        //         complete:function(data){
        //         $("#loader").hide();
        //          },
		        success: function(data){
		        console.log(data);
		        if(data=='Sucess'){
		        $msg = "Roster Added Succesfully";
		        $icon = "success";
		        }else if(data=='validation'){
		         $msg = "Ensure all mandatory fields are populated";
		         $icon = "warning";
		        }
		         <!--start 6Jan 2021 work-->
		         
		         // else if(data=='alreadyAssigned'){
		         // $msg = "Shift Timings are already assigned for the selected employee";
		         // $icon = "warning";
		        //  }
		        
		         <!--End 6Jan 2021 work-->
		        else if(data=='leaveValidation'){
		         $msg = "One of the employees is on leave during the selected shift time. Please ensure the employee is not rostered for the leave days.";
		         $icon = "warning";
		        }else{
		         $msg = "Shift Timings are overlapping for the employee selected";
		         $icon = "warning";
		        } 
		        Swal.fire({
		            
                text: $msg,
                 icon: $icon,
          }).then((value) => {
          if(data=='Sucess'){
               window.location = "<?php echo base_url();?>index.php/admin/get_roster_weeks";
            }
       });
		  }
	       });
	}
  
</script>
    
    