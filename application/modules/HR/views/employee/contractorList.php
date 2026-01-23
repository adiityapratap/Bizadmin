<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0 text-black">Manage Contractors</h5>
              <a href="/HR/contractors/addEditContractor" class="btn btn-primary" id="addEmployeeBtn"><i class="ri-user-add-line"></i> Add Contractor</a>
            </div>
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                <li class="nav-item">
                 <a class="nav-link py-3 Delivered active" data-bs-toggle="tab" href="#activeContractorsTab" role="tab" aria-selected="false">
                 <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Active
                  </a>
                 </li>
                <li class="nav-item">
                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" href="#inactiveContractorsTab" role="tab" aria-selected="false">
                <i class="ri-close-circle-line me-1 align-bottom"></i> Inactive
                </a>
                 </li>
                </ul>
            <div class="tab-content mb-1">
            <div class="tab-pane   active show table-responsive" role="tabpanel"  id="activeContractorsTab">  
            <table id="employeeList" class="table dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead class="table-light">
                  <tr>
                    <th scope="col" style="width: 10px;">
                      <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        
                      </div>
                    </th>
                    <th data-ordering="false">Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Company Name</th>
                    <th>Status</th>
                    <th>Pay Rates</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  if(isset($activeContractorLists) && !empty($activeContractorLists)) { foreach($activeContractorLists as $contractorList) { ?>
                  <tr data-delete-id="<?php echo $contractorList['id']; ?>">
                    <th scope="row">
                      <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                        <label class="form-check-label"><i class="bx bx-chevron-down"></i></label>
                      </div>
                    </th>
                    <td><a href="/HR/editContractor/<?php echo $contractorList['id']; ?>"><?php echo $contractorList['name']; ?></a></td>
                    <td><a href="/HR/editContractor/<?php echo $contractorList['id']; ?>"><?php echo $contractorList['email']; ?></a></td>
                    <td><?php echo $contractorList['phone']; ?></td>
                    <td><?php echo $contractorList['company_name']; ?></td>
                    <td>
                    <div class="form-check form-switch form-switch-success">
                    <input class="form-check-input updateStatus" type="checkbox" rel-id="<?php echo $contractorList['id']; ?>" role="switch" <?php echo($contractorList['status'] == '1' ? 'checked' : '' ); ?>>
                    </div>
                    </td>
                    <td><div>
                    <strong>Weekday:</strong> $ <?php echo number_format($contractorList['rate'],2) ?? '0.00'; ?><br>
                    <strong>Saturday:</strong> $ <?php echo number_format($contractorList['Saturday_rate'],2) ?? '0.00'; ?><br>
                    <strong>Sunday:</strong> $ <?php echo number_format($contractorList['Sunday_rate'],2) ?? '0.00'; ?><br>
                    <strong>Public Holiday:</strong> $ <?php echo number_format($contractorList['holiday_rate'],2) ?? '0.00'; ?>
                    </div>
                    </td>
                    <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                         <a class="text-success"  href="/HR/editContractor/<?php echo $contractorList['id']; ?>"  class="text-primary d-inline-block edit-item-btn">
                         <i class="ri-pencil-fill fs-16"></i>
                         </a>
                         </li>
                         <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                          <a class="text-danger d-inline-block remove-item-btn"  href="#" onclick="deleteEmployee(this,<?php echo $contractorList['id']; ?>,<?php echo $contractorList['userId']; ?>)">
                         <i class="ri-delete-bin-5-fill fs-16"></i>
                         </a>
                         </li>
                        </ul>     
                        
                    </td>
                  </tr>
                  <?php }  } ?>
                </tbody>
              </table>
            </div>
            
            <div class="tab-pane table-responsive" role="tabpanel"  id="inactiveContractorsTab">  
            <table id="employeeList" class="table dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead class="table-light">
                  <tr>
                    <th scope="col" style="width: 10px;">
                      <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        
                      </div>
                    </th>
                    <th data-ordering="false">Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Company Name</th>
                    <!--<th>Status</th>-->
                    <th>Pay Rates</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($inActiveContractorLists) && !empty($inActiveContractorLists)) { foreach($inActiveContractorLists as $contractorList) { ?>
                  <tr>
                    <th scope="row">
                      <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                        <label class="form-check-label"><i class="bx bx-chevron-down"></i></label>
                      </div>
                    </th>
                    <td><?php echo $contractorList['name']; ?></td>
                    <td><a href="#!"><?php echo $contractorList['email']; ?></a></td>
                    <td><?php echo $contractorList['phone']; ?></td>
                    <td><?php echo $contractorList['company_name']; ?></td>
                    <!--<td>-->
                    <!--<div class="form-check form-switch form-switch-success">-->
                    <!--<input class="form-check-input updateStatus" type="checkbox" rel-id="<?php echo $contractorList['id']; ?>" role="switch" <?php echo($contractorList['status'] == '1' ? 'checked' : '' ); ?>>-->
                    <!--</div>-->
                    <!--</td>-->
                    <td><div data-v-35f8ce66="">
                    <strong>Weekday:</strong> <?php echo $contractorList['rate'] ?? ''; ?><br>
                    <strong>Saturday:</strong> <?php echo $contractorList['Saturday_rate'] ?? ''; ?><br>
                    <strong>Sunday:</strong> <?php echo $contractorList['Sunday_rate'] ?? ''; ?><br>
                    <strong>Public Holiday:</strong> <?php echo $contractorList['holiday_rate'] ?? ''; ?></div>
                    </td>
                    <td>
                     <a class="text-success d-inline-block" onclick="reHire(this,<?php echo $contractorList['id']; ?>)">
                     <i class="ri-recycle-fill fs-16"></i>
                     </a> 
                    </td>
                  </tr>
                  <?php }  } ?>
                </tbody>
              </table>
            </div>
          </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="varyingcontentModalLabel">Onboard New Employee</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                             <div class="alert alert-success shadow successEmployee" role="alert" style="display:none">
                                              Onboarding email succesfully sent to employee.
                                                </div> 
                                            <div class="alert alert-danger shadow mb-xl-0 dangerEmployee" role="alert" style="display:none">
                                             
                                                </div>    
                              
                     <form  role="form" id="onboardNewEmployeeForm" method="post" action="" enctype="multipart/form-data">                                            
                                                            <div class="row">
                                                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                                    <label for="customer-name" class="col-form-label">First Name:</label>
                                                                   <input type="text" name="first_name" class="form-control" id="first_name"  required>
                                                                </div>
                                                                 <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                                    <label for="customer-name" class="col-form-label">Last Name:</label>
                                                                    <input type="text" class="form-control" id="name" name="last_name">
                                                                </div>
                                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                                         <label for="customer-name" class="col-form-label">Email:</label>
                                                       <input type="text" class="form-control"  name="email" id="email" aria-describedby="inputGroupPrepend" required>
                                                      <input type="hidden" class="form-control"  name="username" id="username"> 
                                                      <input type="hidden" class="form-control"  name="password" id="password">
                                                      <!-- value 4 always belongs to employee role by default -->
                                                      <input type="hidden" class="form-control"  name="role_id" id="role_id" value="4">
                                                      <input type="hidden" class="form-control"  name="userId" id="lastInsertedUserId">
                                                      <input type="hidden" class="form-control"  name="ajaxSubmit" id="ajaxSubmit" value="true">
                                                        </div>
                                                        
                                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">  
                                    <label class="col-form-label">Job Descriptiopn</label>
                                       <input type="file" id="jd" name="userfile[]" class="form-control mt-2" multiple>
                                        </div>
                                                                
                                <?php if(isset($locations) && !empty($locations)){  ?>   
                              <div class="col-lg-12">
                                            <h6 class="fw-semibold">Location Access *</h6>
                                            <select class="js-example-basic-multiple" name="locationIds[]" multiple="multiple">
                                               <?php foreach($locations as $location){ ?>     
                                                 <option value=" <?php echo $location['location_id']; ?> "> <?php echo $location['location_name']; ?>   </option>
                                                  <?php } ?>
                                            </select>
                                        <small> click on the box to view and select multiple locations</small>    
                                        </div>
                                           <?php } ?> 
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success onboardNewEmployeeBtn" onclick="onboardNewEmployee()">Onboard</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
  <div class="modal fade flip" id="deleteRecord" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete a contractor.</h4>
                                                        <p class="text-black fs-15 mb-4">Deleting a contractor will make the profile inactive.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button
                                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                                data-bs-dismiss="modal"><i
                                                                    class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                                <input class="deletedRecordEmpId" type="hidden">
                                                                <input class="deletedRecordUserId" type="hidden">
                                                            <button class="btn btn-danger" id="delete-record">Yes,
                                                                Delete It</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                           

<script>
let table = $('#employeeList').DataTable({
    pageLength: 100,
});

function onboardNewEmployee(){
   
   $("#username").val($("#email").val());
   // by default we have to set any dummy password for new employee , so that later they can reset it, it must not be guessed by employee
 $("#password").val($("#email").val()+'#123!Allowed!');
 $(".onboardNewEmployeeBtn").html('Loading...');
  let formData = $("#onboardNewEmployeeForm").serialize();
  $.ajax({
  url: '/auth/create_user',
  method: 'post',
  data: formData,
  success: function (response) {
    try {
      let responseData = JSON.parse(response);
      if (responseData?.status === 'success') {
        $("#lastInsertedUserId").val(responseData?.user_id)    
        addRecordToEmployeeTable();
      } else {
        $('.dangerEmployee').html(responseData?.message);
        $('.dangerEmployee').show();
      }

    } catch (error) {
      console.error("Error parsing JSON:", error);
    }
  },
  error: function (xhr, textStatus, errorThrown) {
    console.error("AJAX request failed:", errorThrown);
  }
});
       setTimeout(function () {
        $('.dangerEmployee').hide();
      }, 5000);
}

function addRecordToEmployeeTable() {
    let formData = new FormData($("#onboardNewEmployeeForm")[0]); // Use FormData to serialize form data
    $.ajax({
        url: "/HR/onboardNewEmployee",
        method: "post",
        data: formData,
        processData: false, // Set processData to false when using FormData
        contentType: false, // Set contentType to false when using FormData
        success: function(response) {
            $('.successEmployee').show();
            $(".onboardNewEmployeeBtn").html('Success');
        }
    });
    setTimeout(function() {
        $('.successEmployee').hide();
        $('#addEmployeeModal').modal('hide');
    }, 4000);
}


   $(document).on("change", ".updateStatus" , function() {
     let id = $(this).attr('rel-id');
     let status = 0;
     if($(this).is(":checked")){ status = 1; }else{ status = 0; }
     $.ajax({
     type: "POST",
     "url" : "/HR/Employee/employeeStatusUpdate",
     data:'id='+id+'&status='+status,
      success: function(data){
    }
     });
        });
    function deleteEmployee(obj, emp_id,user_id){
     $("#deleteRecord").modal('show');   
     $(".deletedRecordEmpId").val(emp_id);
     $(".deletedRecordUserId").val(user_id);
    }   

    
       $('#delete-record').click(function(){
           let deleteContractorId =  $(".deletedRecordEmpId").val();
               $.ajax({
                type: "POST",
                "url" : "/HR/contractors/contractorUpdateStatus",
                data:'contractor_id='+deleteContractorId+'&is_deleted=1',
                success: function(data){
                 $("tr[data-delete-id='" + deleteContractorId + "']").remove();
                   $("#deleteRecord").modal('hide');
                }
                });
        });
   function reHire(obj,contractorId){
       $(obj).html("Loading...");
              $.ajax({
                type: "POST",
                "url" : "/HR/contractors/contractorUpdateStatus",
                data:'contractor_id='+contractorId+'&is_deleted=0',
                success: function(data){
                location.reload();
                }
                });     
    }  
 
</script>
