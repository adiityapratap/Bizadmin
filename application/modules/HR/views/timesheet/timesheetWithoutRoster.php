 <?php $monday = new DateTime('monday this week'); ?>
  <?php $date_text = $monday->format('d M') . ' - ' . $monday->modify('+6 days')->format('d M'); ?>  
    <div id="layout-wrapper">

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                  <h3 class="card-title text-black">Add Timesheet</h3>

                    <div class="row g-10 mb-5">
                         <div class="col-sm-auto">
                            <div class="d-md-flex justify-content-sm-end gap-2">
                                <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                                    <input type="text" class="form-control" id="searchemployee" placeholder="Search for employee name ..." autocomplete="off">
                                    <i class="ri-search-line search-icon"></i>
                                </div>

                                <!--<select class="form-control w-md searchEmployeeType" data-choices data-choices-search-false>-->
                                <!--    <option value="All">All</option>-->
                                <!--    <option value="empDiv">Employee</option>-->
                                <!--    <option value="contractorsDiv" selected>Contractor</option>-->
                                  
                                <!--</select>-->
                            </div>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none prevWeek"><i class="ri-arrow-left-s-line fw-bold"></i></button>   
        <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek"><?php echo $date_text; ?></button>    
         <button type="button" class="btn btn-soft-primary btn-icon waves-effect waves-light shadow-none nextWeek"><i class="ri-arrow-right-s-line fw-bold"></i></button>   
        </div>
                        <div class="col-sm text-end">
                            <div>
                                <a onclick="goBack()" class="btn btn-orange">Back</a>
                                <a href="#" class="btn btn-success" id="saveTimesheetBtn"><i class="ri-save-line align-bottom me-1"></i> Save Timesheet</a>
                            </div>
                            
                        </div>
                        
                       
                    </div>

                    <div class="row gy-2 mb-2 table-responsive" id="candidate-list">
                        
                      <table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
           
            <th>Email</th>
            <th>Position</th>
            <th>Employment Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="candidate-list">
        <?php if (isset($empLists) && !empty($empLists)) { ?>
            <?php foreach ($empLists as $empList) { ?>
                <?php
                $positionId = $empList['position_id'];
                $filtered = array_filter($positionLists, function ($position) use ($positionId) {
                    return $position['position_id'] == $positionId;
                });
                $position = !empty($filtered) ? array_shift($filtered) : null;
                ?>
                <tr class="empRow empDiv" data-id="<?php echo $empList['emp_id']; ?>_<?php echo $empList['position_id']; ?>">
                    
                    <td><?php echo $empList['email']; ?></td>
                    <td><?php echo $position['position_name'] ?? ''; ?></td>
                    <td>
                        <span class="badge bg-danger-subtle text-danger">
                            <i class="ri-time-line text-primary me-1 align-bottom"></i> Part Time
                        </span>
                    </td>
                    <td>
                        <a href="#!" class="btn btn-success btn-sm">Add</a>
                        <a href="#!" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#flipModal">Add Task</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

                        
                       
                    </div>

                  

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

          
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    
    <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-modal="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="flipModalLabel">Add Task</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                         <textarea class="text-black form-control" row="5"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary ">Save</button>
                                                        </div>

                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>

<script>
$(document).ready(function() {
    // Initialize an empty array to store selected ids
    localStorage.removeItem('selectedIds');
    let selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
console.log("INSTART selectedIds",selectedIds)
    // Function to update localStorage
    function updateLocalStorage() {
        localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
    }

    // Handle empRow click event
    $('.empRow').on('click', function() {
        selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
        let empId = $(this).data('id');
        
        let index = selectedIds.indexOf(empId);
       
        if (index === -1) {
            // If the id is not selected, add it to the array
            selectedIds.push(empId);
            $(this).find(".setBgColor").addClass('bg-success-subtle');
        } else {
            // If the id is already selected, remove it from the array
            selectedIds.splice(index, 1);
            $(this).find(".setBgColor").removeClass('bg-success-subtle');
        }

        // Update localStorage
        updateLocalStorage();

        // Toggle the selected class
        $(this).toggleClass('selected');
    });

    // Handle Save Timesheet button click
    $('#saveTimesheetBtn').on('click', function(e) {
        e.preventDefault();
        let btnHtml =  $(this); btnHtml.html("Saving...");
        
        // Retrieve data from localStorage
        selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
        let date_range = $(".currentWeek").html();
        if(selectedIds.length > 0) {
            // Send AJAX request to CI 3 controller
            $.ajax({
                url: '<?php echo base_url('HR/timesheetwithoutroster/save_timesheet'); ?>',
                type: 'POST',
                data: { ids: selectedIds,date_range : date_range },
                success: function(response) {
                    // Handle success response
                    alert('Timesheet saved successfully!');
                    btnHtml.html('<i class="ri-save-line align-bottom me-1"></i> Save Timesheet');
                    // Clear the selected ids from localStorage
                    localStorage.removeItem('selectedIds');
                    // Remove the selected class from all rows
                    $('.empRow').removeClass('selected');
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('Error saving timesheet!');
                }
            });
        } else {
            alert('Please select at least one employee or contractor before saving.');
        }
    });

    // Restore the selected state on page load
    selectedIds.forEach(id => {
        let row = $(`.empRow[data-id="${id}"]`);
        row.addClass('selected');
    });
});

$(document).ready(function(){
    // Function to filter elements based on search text and dropdown selection
    function filterEmployees() {
        var searchText = $('#searchemployee').val().toLowerCase(); // Get the search text
        var selectedOption = $('.searchEmployeeType').val(); // Get the selected option
        
        // Loop through each employee div and filter based on search text and dropdown selection
        $('.empRow, .contractorRow').each(function() {
            var showElement = true;
            if (selectedOption !== 'All') {
                // If the selected option is not 'All', filter based on the selected option
                if ($(this).hasClass(selectedOption)) {
                    // Show the element if it belongs to the selected option
                    $(this).show();
                } else {
                    // Hide the element if it does not belong to the selected option
                    $(this).hide();
                    showElement = false;
                }
            }
            
            if (showElement) {
                // If the element should be shown based on the dropdown selection, also check search text
                var employeeName = $(this).find('.employeeName').text().toLowerCase(); // Get the employee name
                if (employeeName.includes(searchText)) {
                    $(this).show(); // Show the element if the name matches the search text
                } else {
                    $(this).hide(); // Hide the element if the name does not match the search text
                }
            }
        });
    }
    
    // Call the filter function when the search box value changes or dropdown selection changes
    $('#searchemployee, .searchEmployeeType').on('input change', filterEmployees);
});

 
</script>
 <!--prev and next week feature onclick of icon-->
<script>
  // Function to format date in "dd Mmm" format
  function formatDate(date) {
    return date.getDate() + ' ' + date.toLocaleDateString('en-us', { month: 'short' });
  }

  // Function to get the start date of the current week (Monday)
  function getCurrentWeekStartDate() {
    let rosterStartDate = '<?php echo $rosterStartDate; ?>';
    let today = new Date(); 
    if(rosterStartDate !=''){
     today = new Date(rosterStartDate);    
    }
    
    const currentDay = today.getDay();
    const monday = new Date(today);
    monday.setDate(today.getDate() - currentDay + (currentDay === 0 ? -6 : 1)); // Adjust if Sunday
    return monday;
  }

  var currentWeekStartDate = getCurrentWeekStartDate();
 console.log("currentWeekStartDate",currentWeekStartDate);
  function updateCurrentWeekText(fetchRosterData) {
    const endDate = new Date(currentWeekStartDate);
    endDate.setDate(currentWeekStartDate.getDate() + 6);
    
    const buttonText = formatDate(currentWeekStartDate) + ' - ' + formatDate(endDate);
    console.log("buttonText",buttonText)
    const encodedButtonText = encodeURIComponent(buttonText);
    $('.currentWeek').text(buttonText);
    
  }

  function updatePrevWeekText() {
    currentWeekStartDate.setDate(currentWeekStartDate.getDate() - 7);
    updateCurrentWeekText();
  }

  function updateNextWeekText() {
    currentWeekStartDate.setDate(currentWeekStartDate.getDate() + 7);
    updateCurrentWeekText();
  }
//   let rosterID = '<?php echo $rosterId; ?>';
//   if(rosterID != ''){
//     updateCurrentWeekText(false);  
//   }
  

  $('.prevWeek').click(function() {
    for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            localStorage.removeItem(key);
        }
    }     
    updatePrevWeekText();
  });

  $('.nextWeek').click(function() {
    for (var key in localStorage) {
        if (localStorage.hasOwnProperty(key) && key.startsWith("emp_")) {
            localStorage.removeItem(key);
        }
    }     
    updateNextWeekText();
  });
  
  
</script>  

    <script src="<?php echo base_url('assets/js/pages/job-candidate-grid.init.js'); ?>"></script>

   

