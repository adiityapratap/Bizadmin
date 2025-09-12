<?php 
// this is controller path : public_html/application/module/HR/controllers/home.php
$monday = new DateTime('monday this week'); 
$date_text = $monday->format('d M Y') . ' - ' . $monday->modify('+6 days')->format('d M Y');
?>
<style>
.prepAreaButton .active{
     border: 1px solid #000000;   
}
</style>
<div class="main-content bg-white">

    <div class="page-content">
        <div class="row gap-2 px-3 prepAreaButton">
            
            <?php if(!empty($prepAreas)) {  ?>
            <?php foreach($prepAreas as $prep){   ?>
        <div class="<?php echo $prep['color']; ?> p-2 px-2 py-2 col-sm-3 col-md-3 col-lg-2 col-xl-1 filter-btn" id="<?php echo $prep['id']; ?>"><span class="px-2 fw-semibold fs-10"><?php echo $prep['prep_name']; ?></span></div>
       
         <?php } ?>
         <?php } ?>
          
            </div>
       <div class="row mb-4 justify-content-start mt-2">
        <div class="col-md-2">
        <input type="text" name="rosterName" class="form-control" id="rosterName" placeholder="Search Employee Name" value="<?php echo $rosterInfo[0]['rosterName'] ?>">
         </div>
        <div class="col-md-3 d-flex gap-2">
        <button type="button" class="btn btn-soft-primary waves-effect waves-light shadow-none fw-bold currentWeek"><?php echo $date_text; ?></button>    
        </div>
        
    </div>     
         <div class="table-responsive">
        <table class="table align-middle table-nowrap timesheet-record table-striped-columns">
    <thead class="table-dark text-white">
       
      <tr>
        <th>Employee Name</th>
        <th>Position</th>
        
        <th>Prep Area</th>
        <th>Clock In</th>
        <th>Break Start Time</th>
        <th>Break End Time</th>
        <th>Clock Out</th>
        <th>Total Hrs</th>
      </tr>
    </thead>
    <tbody>
        
        <?php  if(isset($empLists) && !empty($empLists)) {  ?>
        <?php foreach($empLists as $empList){   ?>
        
       <tr class="<?php echo $empList['prep_id'] ?>">
           <input type="hidden" class="emp_pin" value="<?php echo base64_encode($empList['pin']); ?>">
           <input type="hidden" name="selectedEmp" class="selectedEmp" value="<?php echo $empList['emp_id'] ?>_<?php echo $empList['position_id'] ?>_<?php echo $empList['prep_id'] ?>">
        <td><?php echo $empList['name']; ?></td>
         <td><?php echo $empList['position_name']; ?></td>
         <td><?php echo $empList['prep_name']; ?></td>
        <td class="w-25">
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-plus"></i></span>
            <input class="form-control" readonly="readonly" data-timeType="in_time" type="text" name="" placeholder="Enter Time">
          </div>
        </td>
        <td class="w-25">
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-plus"></i></span>
            <input class="form-control " readonly="readonly " data-timeType="break_in_time"  type="text" name=""  placeholder="Enter Time">
          </div>
        </td>
        <td class="w-25">
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-plus"></i></span>
            <input class="form-control " readonly="readonly " data-timeType="break_out_time" type="text" name=""  placeholder="Enter Time">
          </div>
        </td>
        <td class="w-25">
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-plus"></i></span>
            <input class="form-control " readonly="readonly" data-timeType="out_time" type="text"  name=""  placeholder="Enter Time">
          </div>
        </td>
        <td>1:00</td>
      </tr>
      
      <?php }  ?>
      <?php }  ?>
     
    </tbody>
  </table>
       </div> 
        
        </div>
        </div>
<!-- PIN Input Modal -->
<div class="modal fade" id="pinModal" tabindex="-1" aria-labelledby="pinModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pinModalLabel">Enter PIN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <input type="password" class="form-control" id="pinInput" placeholder="****"  maxlength="4">
           <input type="hidden" id="timeType">
          <button class="btn btn-outline-secondary" type="button" id="togglePinVisibility">
            <i class="fa fa-eye" id="toggleEyeIcon"></i>
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  let currentInput;
  let selectedEmp;
  let timeType = '';
  let currentTime = '';
  
  function encodePin(pin) {
      return btoa(pin);
  }
  
  function decodePin(encodedPin) {
      return atob(encodedPin);
  }

  $('input[readonly]').on('click', function() {
    currentInput = $(this); 
    timeType = $(this).attr('data-timetype');
    selectedEmp = $(this).closest('tr').find('.selectedEmp').val();
    $('#pinModal').modal('show'); 
  });

  function loadTimesFromLocalStorage() {
    $('input[readonly]').each(function() {
      let empTimeType = $(this).closest('tr').find('.selectedEmp').val() + '_' + $(this).attr('data-timetype');
      let storedTime = localStorage.getItem(empTimeType);
      if (storedTime) {
        $(this).val(storedTime);
      }
    });
  }
  
  loadTimesFromLocalStorage();

  $('#pinModal').on('shown.bs.modal', function () {
    $('#pinInput').focus();
    $('#timeType').val(timeType);
  });
  
  $('#togglePinVisibility').on('click', function() {
    let pinInput = $('#pinInput');
    let pinType = pinInput.attr('type');
    let eyeIcon = $('#toggleEyeIcon');

    if (pinType === 'password') {
      pinInput.attr('type', 'text');
      eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      pinInput.attr('type', 'password');
      eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });

  function verifyPinOnClientSide(pin, encodedPin) {
    return encodePin(pin) === encodedPin;
  }

  function recordTime() {
    clockInTimeType = $('#timeType').val();
    currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
    $('#loaderContainer').show();
    $.ajax({
       url: "/HR/Clockin/verify_pin_and_log_time",
      type: 'POST',
      data: { selectedEmp: selectedEmp, clockInTimeType: clockInTimeType, currentTime: currentTime },
      success: function(response) {
        currentInput.val(currentTime); 
        $('#pinModal').modal('hide'); 
        $('#pinInput').val(''); 
        let empTimeType = selectedEmp + '_' + clockInTimeType;
        localStorage.setItem(empTimeType, currentTime);
        $('#loaderContainer').hide();
      },
      error: function() {
        alert('An error occurred');
      }
    });
  }

  $('#pinInput').on('input', function() {
    let pin = $(this).val();
    if (pin.length === 4) {
      let encodedPin = currentInput.closest('tr').find('.emp_pin').val();
      
      if (verifyPinOnClientSide(pin, encodedPin)) {
        recordTime();
      } else {
        alert('Invalid PIN');
      }
    }
  });

  function clearLocalStorageAtMidnight() {
    localStorage.clear();
    console.log("LocalStorage cleared at midnight");
  }

  function getMillisecondsUntilMidnight() {
    const now = new Date();
    const midnight = new Date(now);
    midnight.setHours(24, 0, 0, 0); // Set time to midnight
    return midnight.getTime() - now.getTime();
  }

  setTimeout(function() {
    clearLocalStorageAtMidnight();
    setInterval(clearLocalStorageAtMidnight, 24 * 60 * 60 * 1000);
  }, getMillisecondsUntilMidnight());
});

// showing emp with prep area baed on click of prep area train at the top
$(document).ready(function() {
  $('.filter-btn').click(function() {
    var buttonId = $(this).attr('id');
    
    $(this).toggleClass('active');

    if ($(this).hasClass('active')) {
      $('tr').hide();
      $('tr.' + buttonId).show();
    } else {
      $('tr').show();
    }
  });
});
</script>
