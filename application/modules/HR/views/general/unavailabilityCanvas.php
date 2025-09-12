<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header border-bottom">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="bx bxs-user-circle display-6 text-black"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <h5 class="mb-0 text-black"><?php echo $this->session->userdata('username').' '.$this->session->userdata('userlastname');?></h5>
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
                                <h5 class="mb-0 text-black">Unavailability</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#addUnavailability" aria-controls="offcanvasScrolling">+ Add</button>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    
     <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="addUnavailability" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header border-bottom">
            
          
          <button type="button" class="btn btn-danger btn-sm" id="addUnavailabilityCloseBtn">Back</button>
        </div>
        <div class="offcanvas-body p-0 overflow-hidden">
            <div data-simplebar style="height: calc(100vh - 112px);">
                <div class="p-3">
                    <div class="unavailability-wrap">
                        <form id="addUnavailabilityForm">
                           <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $employee['emp_id']; ?>">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1 ms-2">
                                    <h5 class="mb-0 text-black">Add Unavailability</h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-success" id="addUnavailabilityFormBtn">Add</button>
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
                                    <label for="businessname" class="control-label text-black">To</label>
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
                            <div class="row">
                            <div class="col-lg-12">
                                    <label for="businessname" class="control-label text-black">Comments</label>
                                    <textarea name="unavailabilityComments"  id="comments" class="form-control" row="4"></textarea>
                                 </div>   
                            </div>       
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    <script>
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
        $("#addUnavailabilityFormBtn").html("Adding...");
        let unavail_type = $('#unavail_type').val();
        let start_date = '';
        let end_date = '';
        let start_time = '';
        let end_time = '';
        let comments = '';
        if(unavail_type == 'all_day'){
            start_date = $('#all_day_start_date').val();
            end_date = $('#all_day_end_date').val();
        }else{
            start_date = $('#start_date').val();
            end_date = $('#end_date').val();
            start_time = $('#start_time').val();
            end_time = $('#end_time').val();
        }
        comments = $('#comments').val();
        emp_id = $('#emp_id').val();
        let html = '';
        $.ajax({
		    url:"/HR/Employees/add_unavailability",
		    method:"POST",
		    data:{unavail_type:unavail_type,start_date:start_date,end_date:end_date,start_time:start_time,end_time:end_time,comments:comments,emp_id:emp_id},
	        success:function(response){
	            
	            $("#addUnavailabilityFormBtn").html("Add");
	            if(response != 'error' && response != ''){
	             
	                let startDateParts = start_date.split('-');
                    let endDateParts = end_date.split('-');
                    let startDate = new Date(startDateParts[2], startDateParts[1] - 1, startDateParts[0]);
                    let endDate = new Date(endDateParts[2], endDateParts[1] - 1, endDateParts[0]);

	                
	                const diffInMs = endDate.getTime() - startDate.getTime();
                    const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
	                console.log("diffInDays",diffInDays)
	                console.log("startDate",startDate);
	                console.log("endDate",endDate);
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
		    url:"/HR/Employees/del_unavailability",
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
          