function fetchRole(obj){
   
  var emp_id = $(obj).val();
  var rowIdEmp = $('#rowIdEmp').val();
  $('#'+rowIdEmp).find("#employeeIdSelected").val(emp_id);
//   console.log($(obj).html());
 
      $.ajax({
        url:"/HR/index.php/admin/fetch_emp_role", 
		method:"POST", 
		data:{emp_id:emp_id},
	    success:function(resp){
	       var prePopulat = JSON.parse(resp);
	       
	       
	       
        	 var empRoleId = $('#'+rowIdEmp).find(".empRoleId");
        	 var empRoleName = $('#'+rowIdEmp).find(".empRoleName");
        	 var empName = $('#'+rowIdEmp).find(".empName");
        	 
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
	         var dayName = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
	         var data = '<span role="button" class="emp_avai_btn text-primary fw-medium collapsed" data-bs-toggle="collapse" data-bs-target="#collapseinline" aria-expanded="false" aria-controls="collapseinline"><span id="availability_collapse_text_show">Show</span><span id="availability_collapse_text_hide">Hide</span> the availability of selected employee for next week.</span><div class="collapse" id="collapseinline"><div class="mb-0 mt-3" id="append_employee_availability"> <table class="table"> <tbody>';
	         
	          var employee_availability = JSON.parse(resp);
	          for(let i=0;i<7;i++){
	              if (typeof employee_availability[dayName[i]+'_avail'] !== 'undefined') { 
	                  if(typeof employee_availability[dayName[i]+'_comment'] !== 'undefined' && employee_availability[dayName[i]+'_comment'] != ''){
	                      var cmnt = employee_availability[dayName[i]+'_comment'];
	                  }
	                  else{
	                      var cmnt = '';
	                  }
                  data += '<tr><td>'+[dayName[i]]+'</td> <td> '+employee_availability[dayName[i]+'_avail']+' </td><td> '+cmnt+'</td></tr>'
                }
          
	          }
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
  
  
  $(function() {
    $('.toggle-demo').on('change',function() {
         var id = $(this).attr('id')
     if($(this).prop('checked')){
         var status = 1;
     }else{
         var status = 0;
     }
     
      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
        url: "<?php echo base_url(); ?>index.php/admin/update_roster_status",
        data: {"roster_status":status,"id":id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })
  });
  
  
  $(document).ready(function(){
	// Activate tooltip
// 	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody .custom-checkbox input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

function addRoster(){
        $("#addRoster").addClass('show');
        $("#addRoster").css('display','block');
    }
    
    $('#addRosterClose').click(function(){
        $('#addRoster').find('.addHrs').css('display','flex');
        $('#addRoster').find('.approvedHrs').css('display','none');
    });
    
    function addRosterTime(that){
        var rowId= $(that).attr('data-rel-id');
        var rowrel= $(that).attr('rel');
        $("#addRosterTime").addClass('show');
        $("#addRosterTime").css('display','block');
        $("#rowId").val(rowId);
        $("#addRosterTimeLabel").html('Add '+rowrel+' Hours');
        $("#addRosterTimeBtn").html('Add');
    } 
    function editRosterTime(that){
        var rowId= $(that).attr('data-rel-id');
        var rowrel= $(that).attr('rel');
        $("#addRosterTime").addClass('show');
        $("#addRosterTime").css('display','block');
        $("#rowId").val(rowId);
        $("#addRosterTimeLabel").html('Update '+rowrel+' Hours');
        var startTime = $('#'+rowId).find('.startTimeValue').html();
        var finishTime = $('#'+rowId).find('.finishTimeValue').html();
        var breakTimeStart = $('#'+rowId).find('.breakTimeStartValue').html();
        var breakTimeFinish = $('#'+rowId).find('.breakTimeFinishValue').html();
        var outletName = $('#'+rowId).find('.outletNameValue').html();
        
        $("#startTime").val(startTime);
        $("#finishTime").val(finishTime);
        $("#breakTimeStart").val(breakTimeStart);
        $("#breakTimeFinish").val(breakTimeFinish);
        $("#outletName").val(outletName);
        $("#addRosterTimeBtn").html('Update');
    } 
    $('#addRosterTimeClose').click(function(){
        $("#addRosterTime").find('input').val('');
        $('#timealert').css('display','none');
    });
    
    function addtime(){
        var startTime = $("#startTime").val();
        var finishTime = $("#finishTime").val();
        var breakTimeStart = $("#breakTimeStart").val();
        var breakTimeFinish = $("#breakTimeFinish").val();
        var outletid = $("#outletName").val();
        var outletName = $("#outletName option:selected").text();
        var rowid = $("#rowId").val();
        if(startTime != '' && finishTime != ''){
            $('#'+rowid).find('.startTimeValue').html(startTime);
            $('#'+rowid).find('.finishTimeValue').html(finishTime);
            $('#'+rowid).find('.breakTimeStartValue').html(breakTimeStart);
            $('#'+rowid).find('.breakTimeFinishValue').html(breakTimeFinish);
            $('#'+rowid).find('.outletNameValue').html(outletName);
            $('#'+rowid).find('.outletNameID').val(outletid);
            $('#'+rowid).find('.addHrs').css('display','none');
            $('#'+rowid).find('.approvedHrs').css('display','block');
            $("#addRosterTime").find('input').val('');
            $("#addRosterTime").removeClass('show');
            $("#addRosterTime").css('display','none');
            $('#timealert').css('display','none');
        }else{
            $('#timealert').css('display','block');
        }
    }
    
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
        
    });
    function addEmployeeDetails(){
        var emp_slt = $("#emp_slt").val();
        var empDept = $( "#empDept option:selected" ).text();
        var empDeptId = $( "#empDept" ).val();
        var rowid = $("#rowIdEmp").val();
        if(emp_slt != ''){
            console.log('empDeptId'+empDeptId);
            if(empDeptId != ''){
                $('#'+rowid).find('.empDepartment').html(empDept);
                $('#'+rowid).find('.empDepartmentId').val(empDeptId);
            }else{
                $('#'+rowid).find('.empDepartment').html('');
                $('#'+rowid).find('.empDepartmentId').val('');
            }
            $('#'+rowid).find('.addemp').css('display','none');
            $('#'+rowid).find('.empDetails').css('display','block');
            $("#addEmployeeModel").find('.form-control').val('');
            $("#addEmployeeModel").removeClass('show');
            $("#addEmployeeModel").css('display','none');
            $('#empalert').css('display','none');
        }else{
            $('#empalert').css('display','block');
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
        var empDeptId = $(".empDepartmentId").val();
        var empRoleName = $(".empRoleName").html();
        
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
        
        var optionsDept = '';
        $("#empDept option").each(function()
            {
                if($(this).val() == empDeptId){
                    optionsDept += '<option value="'+$(this).val()+'" selected>'+$(this).text()+'</option>';
                }else{
                    optionsDept += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
                }
            });
        $('#empDept').html(optionsDept);
        
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
    
    