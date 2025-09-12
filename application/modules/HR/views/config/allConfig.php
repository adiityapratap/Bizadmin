<div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-3 col-lg-2 col-xl-2">
                         <div class="card h-100">
                         <div class="card-body">    
                         <div class="nav flex-column nav-pills text-center nav-customd" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                          <a class="nav-link mb-4 fs-16" id="generalSettings-tab" data-bs-toggle="pill" href="#generalSettings" role="tab" aria-selected="false">General Config</a>    
                         <a class="nav-link mb-4 active fs-16" id="stressProfile-tab" data-bs-toggle="pill" href="#stressProfile" role="tab" aria-selected="true">Stress Profile</a>
                         <a class="nav-link mb-4 fs-16" id="emailSettings-tab" data-bs-toggle="pill" href="#emailSettings" role="tab"  aria-selected="false">Email</a>
                         <a class="nav-link mb-4 fs-16" id="docsSettings-tab" data-bs-toggle="pill" href="#docsSettings" role="tab" aria-selected="false">Documents</a>
                         <a class="nav-link mb-4 fs-16" id="leaveSettings-tab" data-bs-toggle="pill" href="#leaveSettings" role="tab" aria-selected="false">Leaves</a>
                         <a class="nav-link mb-4 fs-16" id="positionSettings-tab" data-bs-toggle="pill" href="#positionSettings" role="tab" aria-selected="false">Positions</a>
                        </div>
                        </div>
                        </div>
                        </div>
                          <div class="col-md-9 col-lg-2 col-xl-10">
                          <div class="card h-100">
                         <div class="card-body">      
                           <div class="tab-content text-black mt-4 mt-md-0" id="v-pills-tabContent">
                             <div class="tab-pane fade show active" id="stressProfile" role="tabpanel" aria-labelledby="stressProfile-tab">
                            <div class="row">
                            <div class="col"></div>  
                            <div class="col-auto text-right">    
                            <button type="button" class="btn btn-success w-auto mx-5" onclick="addNewStressProfile()"><i class="ri-user-add-fill"></i>  New Stress Profile</button>    
                            </div>  
                            </div>
                           <div class="row mt-2">  
                            <table id="stressProfileList" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th data-ordering="false">Name</th>
                                                <th data-ordering="false">Maximum Hrs Per Week</th>
                                                <th data-ordering="false">Maximum Hrs Per Day</th>
                                                <th data-ordering="false">Maximum hours per shift </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php if(isset($allStressProfile) && $allStressProfile) {  ?>
                                            <?php foreach($allStressProfile as $stresprofile){ ?>
                                            <tr data-delete-id="<?php echo $stresprofile['id'] ?>">
                                                <td><?php echo $stresprofile['stressProfileName'] ?></td>
                                                <td><?php echo $stresprofile['maxHrsPWeek'] ?></td>
                                                <td><?php echo $stresprofile['maxHrsPDay'] ?></td>
                                                <td><?php echo $stresprofile['maxDaysPWeek'] ?></td>
                                                <td>
                                              <div class="d-inline-block">
                                                <button type="button" class="btn btn-success btn-icon waves-effect waves-light" onclick="editStressProfile(<?php echo $stresprofile['id'] ?>,'<?php echo $stresprofile['stressProfileName'] ?>',<?php echo $stresprofile['maxHrsPWeek'] ?>,<?php echo $stresprofile['maxHrsPDay'] ?>,<?php echo $stresprofile['maxDaysPWeek'] ?>)"><i class="ri-edit-box-line"></i></button>  
                                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light" onclick="deleteRow(<?php echo $stresprofile['id'] ?>,'HR_stressProfile')"><i class="ri-delete-bin-5-line"></i></button>
                                               </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                            </table>
                           </div>  
                            </div> 
                             <div class="tab-pane fade" id="emailSettings" role="tabpanel" aria-labelledby="emailSettings-tab">
             <form  method="post" class="form-horizontal" id="emailSettingForm">
                  <div class="row">       
                   <div class="col-md-6 col-sm-12">
                  <label for="sort_order" class="form-label fw-semibold">Add Notification Email</label>
                 
               <table class="table table-bordered mt-3" id="notificationMailTable">
            <tbody>
                <?php   if(isset($mailConfigData) && !empty($mailConfigData)) {  ?>
                <?php foreach($mailConfigData as $emails) { ?>
                 <input type="hidden" name="configId[]" value="<?php echo $emails['id'] ?>">
                <?php $emailTo = unserialize($emails['data']);  ?>
                <?php foreach($emailTo as $emailId) { ?>
               <tr>
               <td>
             <select class="form-select notificationMailoptions" name="mailType[]">
             <option value="" >Select option</option>
             <option value="managerEmail" <?php echo  ((isset($emails['metaData']) && $emails['metaData'] == 'managerEmail'  ? 'selected'  : '')) ?>>Manager Email </option>
             </select>
             </td>
             <td class="gap-2 d-flex">
              <input required type="text" name="emailTo[]" class="form-control " value="<?php echo (isset($emailId) ? $emailId : ''); ?>" placeholder="Enter mail" autocomplete="off" />
              </td>
              <td><button class="btn btn-success add-row " type="button">+</button></td>
              <td><button type="button" class="btn btn-danger remove-row">-</button></td>
                </tr>
                 <?php } ?>
                <?php } ?>
               <?php      }  else {   ?>
             <tr>
                         <td>
            <select class="form-select notificationMailoptions" name="mailType[]">
             <option value="">Select option</option>
             <option value="managerEmail">Manager Email </option>
             </select>
                           </td>
                    <td class="gap-2 d-flex">
                    <input type="text" name="emailTo[]" class="form-control" placeholder="Enter mail" autocomplete="off" required />
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                </tr>  
               
               <?php  } ?>
               
            </tbody>
        </table> 
          
        <small>Add the email and Cc emails in comma seprated value,  who will receive the notification mail for this system . </small> 
        </div>  
                  </div> 
                  <div class="col-xxl-3 col-md-6 mt-2">
                                     <button class="btn btn-success saveEmailSettingsBtn"  type="button" onclick="saveEmailSettings()" >Save</button>
                                        </div>
                        </form>     
                                                   
                              </div>
                             <div class="tab-pane fade" id="docsSettings" role="tabpanel" aria-labelledby="docsSettings-tab">
                               
                               <div class="row">
                             <div class="col-lg-6 col-md-12">
                                  <small>* choose pdf,jpeg,jpg file and click upload button</small>
                               <form role="form" id="policiesForm" method="post" action="" enctype="multipart/form-data">
                                   <input type="hidden" name="file_type" value="policy">
                                 <label class="label-control">Policies</label>  
        				        <input type="file" id="policyfile" name="userfile[]" class="form-control" multiple>
        				       
	 <input type="button" class="btn btn-success uploadConfigFile" value="Upload" data-formId="policiesForm" data-inputId="policyfile">
	 
	 <?php if(isset($uploadedFiles) && !empty($uploadedFiles)){  ?>
    <?php foreach($uploadedFiles as $uploadedFile) {  ?>
  <?php if($uploadedFile['metaData'] == 'policy') { $attachment = unserialize($uploadedFile['data']);  ?>   
    <a href="<?php echo base_url().'uploaded_files/'.$this->tenantIdentifier.'/HR/OtherFiles/'.$attachment[0] ?>" target="_blank" class="btn btn-orange my-3">View Policy File</a>
     <?php } ?>
     <?php } ?>
   <?php } ?>
                				 </form>
                			 </div>
                			 
                			  <div class="col-lg-6 col-md-12">
                			       <small>* choose pdf,jpeg,jpg file and click upload button</small>
                               <form role="form" id="inductionFileForm" method="post" action="" enctype="multipart/form-data">
                                 <input type="hidden" name="file_type" value="induction">
                                 <label class="label-control">Induction File</label>  
        				        <input type="file" id="inductionfile" name="userfile[]" class="form-control" multiple>
						        <input type="button" data-formId="inductionFileForm" data-inputId="inductionfile" class="btn btn-success uploadConfigFile" value="Upload">
                				 
   <?php if(isset($uploadedFiles) && !empty($uploadedFiles)){ ?>
    <?php foreach($uploadedFiles as $uploadedFile) {  ?>
  <?php if($uploadedFile['metaData'] == 'induction') { $attachment = unserialize($uploadedFile['data']);  ?>   
  <?php if(isset($attachment) && !empty($attachment)){ ?>
    <a href="<?php echo base_url().'uploaded_files/'.$this->tenantIdentifier.'/HR/OtherFiles/'.$attachment[0] ?>" target="_blank" class="btn  btn-orange my-3">View Induction File</a>
     <?php } ?>
     <?php } ?>
     <?php } ?>
   <?php }else { ?>
    <p><small>Refresh page to view already upladed document</small></p>
    <?php } ?> 
    </form>
                			 </div>
                				 
                				 </div>
                                                   
                              </div>   
                             <div class="tab-pane fade" id="leaveSettings" role="tabpanel" aria-labelledby="leaveSettings-tab">
                            <div class="row">
                            <div class="col"></div>  
                            <div class="col-auto text-right">
                            <button type="button" class="btn btn-success w-auto mx-5" onclick="addNewLeave()"><i class="ri-user-add-fill"></i> Add New</button>    
                            </div>   
                            </div>  
                           <div class="row mt-2">  
                            <table id="leaveList" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th data-ordering="false">Leave Type Name</th>
                                                 <th data-ordering="false">Entitlements</th>
                                                <th data-ordering="false">Paid Leave</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php if(isset($allLeaveTypes) && $allLeaveTypes) {  ?>
                                            <?php foreach($allLeaveTypes as $allLeaveType){  ?>
                                            <tr data-delete-id="<?php echo $allLeaveType['id'] ?>">
                                                <td><?php echo $allLeaveType['leaveTypeName'] ?></td>
                                                <td><?php echo $allLeaveType['entitlements'] ?></td>
                                                <td><?php echo $allLeaveType['is_paid'] == '1' ? 'Yes' : 'No' ?></td>
                                             
                                                <td>
                                              <div class="d-inline-block">
                                                <button type="button" class="btn btn-success btn-icon waves-effect waves-light" onclick="editLeave(<?php echo $allLeaveType['id'] ?>,'<?php echo $allLeaveType['leaveTypeName'] ?>',<?php echo $allLeaveType['entitlements'] ?>,<?php echo $allLeaveType['is_paid'] ?>)"><i class="ri-edit-box-line"></i></button>  
                                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light" onclick="deleteRow(<?php echo $allLeaveType['id'] ?>,'HR_leaves')"><i class="ri-delete-bin-5-line"></i></button>
                                               </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                            </table>
                           </div>  
                            </div> 
                            <div class="tab-pane fade" id="positionSettings" role="tabpanel" aria-labelledby="positionSettings-tab">
                             <form  method="post" class="form-horizontal" id="positionSettingsForm">
                            <div class="row">       
                          <div class="col-md-6 col-sm-12">
                         <label for="sort_order" class="form-label fw-semibold">Add Position Name</label>
                 
                      <table class="table table-bordered mt-3" id="notificationMailTable">
                     <tbody>
                   <?php   if(isset($positionConfigData) && !empty($positionConfigData)) {  ?>
                   <?php foreach($positionConfigData as $position) { ?>
                  <tr>
                 <td class="gap-2 d-flex">
                <input type="hidden" name="position_id[]" value="<?php echo (isset($position['position_id']) ? $position['position_id'] : ''); ?>">     
                <input  type="text" name="position_name[]" required class="form-control " value="<?php echo (isset($position['position_name']) ? $position['position_name'] : ''); ?>" placeholder="Enter position name" autocomplete="off" />
              </td>
              <td><button class="btn btn-success add-Positionrow" type="button">+</button></td>
              <td><button type="button" class="btn btn-danger remove-Positionrow">-</button></td>
                </tr>
                <?php } ?>
               <?php }  else {   ?>
                 <tr>
                    <td class="gap-2 d-flex">
                    <input type="text" name="position_name[]" class="form-control" placeholder="Enter position name" autocomplete="off" required />
                    </td>
                    <td><button class="btn btn-success add-Positionrow" type="button">+</button></td>
                </tr>  
               <?php  } ?>
               
            </tbody>
        </table> 

        </div>  
        </div> 
        <div class="col-xxl-3 col-md-6 mt-2">
         <button class="btn btn-success savePositionSettingsBtn"  type="button" onclick="savePositionSettings()" >Save</button>
        </div>
       </form>     
         </div>
                             <div class="tab-pane fade" id="generalSettings" role="tabpanel" aria-labelledby="generalSettings-tab">
                            <div class="row">
                            <div class="col"></div>  
                            
                            </div>  
                           <div class="row mt-2">  
                            <table id="leaveList" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th data-ordering="false">Settings Name</th>
                                                 <th data-ordering="false">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody >
                                          
                                            <tr>
                                                <td>Enable face verification for timesheet clockIn</br>
                                                <small>If disabled pin verification will be activated for timesheet portal clockIn/Out</small>
                                                </td>
                                                <td>
                                               <div class="form-check form-switch mb-3" dir="ltr">
    <input type="checkbox" 
           class="form-check-input config-toggle" 
           id="customSwitchsizesm" 
           data-config-key="feature_toggle" 
           <?php echo (isset($generalConfigData['feature_toggle']) && $generalConfigData['feature_toggle'] === '1') ? 'checked' : ''; ?>>
</div>    
                                                </td>
                                            </tr>
                                           
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
    <div class="modal fade createStressProfileModal" tabindex="-1" role="dialog" aria-labelledby="newStressProfileModal" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                           <h5 class="modal-title text-black fw-bold">Add New Stress Profile</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                            <form id="stressProfileForm">    
                                            <input type="hidden" name="id" id="stressProfileId">
                                            <div class="row gy-4">
                                            <div class="col-xxl-3 col-md-6">
                                                <div>
                                                    <label for="stressProfileName" class="form-label">Name*</label>
                                                    <input type="text" name="stressProfileName" class="form-control" id="stressProfileName">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-3 col-md-6">
                                                <div>
                                                    <label for="maxHrsPWeek" class="form-label">Maximum hours per week</label>
                                                    <input type="text" name="maxHrsPWeek" class="form-control" id="maxHrsPWeek">
                                                    <small>The maximum number of hours that an employee should be expected to work within a week</small>
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-xxl-3 col-md-6">
                                                <div>
                                                    <label for="maxDaysPWeek" class="form-label">Maximum hours per shift </label>
                                                    <div class="form-icon">
                                                    <input type="number" name="maxDaysPWeek" class="form-control form-control-icon" id="maxDaysPWeek">
                                                     
                                                    </div>
                                                    <small>The maximum number of days that an employee should be expected to work per shift.</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xxl-3 col-md-6">
                                                <div>
                                                    <label for="maxHrsPDay" class="form-label">Maximum hours per day</label>
                                                    <div class="form-icon">
                                                    <input type="number" name="maxHrsPDay" class="form-control form-control-icon" id="maxHrsPDay">
                                                     
                                                    </div>
                                                <small>The maximum number of hours that an employee should be expected to work within a day</small>    
                                                </div>
                                            </div>
                                           </div> 
                                           </form>
                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:void(0);" class="btn btn-link link-success shadow-none fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                            <button type="button" class="btn btn-primary createStressProfileBtn" onclick="createStressProfile()">Create</button>
                                                            <button type="button" class="btn btn-primary updateStressProfileBtn d-none" onclick="updateStressProfile(this)">Update</button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
     <div class="modal fade addEditLeaveModal" tabindex="-1" role="dialog" aria-labelledby="newleaveModal" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                           <h5 class="modal-title text-black fw-bold">Add Leave Type</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                            <form id="leaveForm">   
                                            <input type="hidden" name="id" class="form-control" id="leaveId">
                                            <div class="row gy-4">
                                          
                                            <div class="col-xxl-3 col-md-6">
                                                <div>
                                                    <label for="maxHrsPWeek" class="form-label">Leave Type Name</label>
                                                    <input type="text" name="leaveTypeName" class="form-control" id="leaveTypeName">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xxl-3 col-md-6">
                                                <div class="form-check mb-3">
                                                <label for="entitlements" class="form-label">Number of entitlements</label>
                                                 <input class="form-control" type="text" id="entitlements" name="entitlements">
                                            </div>
                                            </div>

                                            <div class="col-xxl-3 col-md-6">
                                                <div class="form-check mb-3">
                                                 <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid">
                                                 <label class="form-check-label" for="is_paid">Paid Leave</label>
                                            </div>
                                            </div>
                                           </div> 
                                           </form>
                                           </div>
                                          <div class="modal-footer">
                                          <a href="javascript:void(0);" class="btn btn-link link-success shadow-none fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                          <button type="button" class="btn btn-primary addLeaveTypeBtn" onclick="addLeaveType()">Create</button>
                                          <button type="button" class="btn btn-primary updateLeaveTypeBtn d-none" onclick="updateLeaveType(this)">Update</button>
                                             </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
    <div class="modal fade flip" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete a record ?</h4>
                                                       
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button
                                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                                data-bs-dismiss="modal"><i
                                                                    class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                            
                                                                <input class="deletedRecordId" type="hidden">
                                                                <input class="deletedtableName" type="hidden">
                                                            <button class="btn btn-danger" id="delete-record" onclick="deleteRowRecord(this)">Yes,
                                                                Delete It</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                          
                                            
   <script>
   $(document).ready(function(){
     $('form').on('click', '.add-row', function () {
             let newRow = '<tr>';
             newRow +='<td>';
             newRow +='<select class="form-select notificationMailoptions" name="mailType[]">';
             newRow +='<option value="" >Select option</option>';
             newRow +='<option value="managerEmail">Manager Email</option>';
             newRow +='</select>';
             newRow +='</td>'; 
             newRow +='<td class="gap-2 d-flex"><input type="text" name="emailTo[]" class="form-control " placeholder="Enter Email" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });

     // Remove row on minus button click
     $('form').on('click', '.remove-row, .remove-Positionrow', function () {
     $(this).closest('tr').remove();
     });
            
        // for adding new positions
     $('form').on('click', '.add-Positionrow', function () {
             let newRow = '<tr>';
             newRow +='<td class="gap-2 d-flex"><input type="text" name="position_name[]" class="form-control " placeholder="Enter position name" autocomplete="off"  />';
             newRow +='</td><td><button type="button" class="btn btn-success add-Positionrow">+</button></td><td><button type="button" class="btn btn-danger remove-Positionrow">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });
            
   })
   let table = $('#stressProfileList').DataTable({
    pageLength: 10,
     paging: false,
     "language": {
            "info": ""
        }
   });
   
   function createStressProfile(){
       if($("#stressProfileName").val() ==''){
         alert("Please enter stress profile name");
         return false;
       } 
       $(".createStressProfileBtn").html('Creating...');
       let formData = $("#stressProfileForm").serialize();
       $.ajax({
           "url" : "/HR/Config/createStressProfile",
           "method" :"post",
           "data" :formData,
           "success" :function(response){
             $(".createStressProfileBtn").html('Stress Profile Created');
           }
       });
       
       setTimeout(function () {
        $(".createStressProfileBtn").html('Create');
        $('.createStressProfileModal').modal('hide');
      }, 2500);
   }
   
  $('.uploadConfigFile').click(function(e){
     let err=0;
     let formId = $(this).data('formid');
     let fileInputId = $(this).data('inputid');
     let self = $(this);
     console.log("id","#"+fileInputId)
     if($("#"+fileInputId).val() == "") { err=1; }
     
    if(err == '0'){
        $(this).val("Uploading..."); 
       let formData = new FormData($("#"+formId)[0]);
           $.ajax({
            type: "POST",
            url: '/HR/uploadConfigFiles',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
        	    let res = JSON.parse(response)
        	     console.log("res=",res)
        	    if(res?.status=='success'){
        	        console.log("res",res)
		         self.val("File Uploaded"); 
		        }
		        else{
		        alert("Some error occured,Please refresh page and try again.")
		        } 
        	},
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
        e.preventDefault();
    }
    else{ alert('Please select file to upload'); return false; }
	}); 
	
	function addLeaveType(){
       if($("#leaveTypeName").val() ==''){
         alert("Please enter leave type name");
         return false;
       } 
       $(".addLeaveTypeBtn").html('Adding...');
       let formData = $("#leaveForm").serialize();
       $.ajax({
           "url" : "/HR/Config/addleaveType",
           "method" :"post",
           "data" :formData,
           "success" :function(response){
             $(".addLeaveTypeBtn").html('Leave Type Added.');
           }
       });
       
       setTimeout(function () {
        $(".addLeaveTypeBtn").html('Create');
        $('.addEditLeaveModal').modal('hide');
      }, 2000);
   }
   
  function deleteRow(id,tableName){
   $("#deleteRecordModal").modal("show");
   $(".deletedRecordId").val(id);
   $(".deletedtableName").val(tableName);
  }
  function deleteRowRecord(obj){
     let id = $(".deletedRecordId").val();
     let btn = $(obj); btn.html("Deleting....")
     let tableName = $(".deletedtableName").val();
      $.ajax({
      type: "POST",
      "url" : "/HR/Leave/delete",
      data:'id='+id+'&tableName='+tableName,
      success: function(data){
      $("tr[data-delete-id='" + id + "']").remove();
      btn.html("Yes,Delete It")
      $("#deleteRecordModal").modal('hide');
      }
      });
  }
  
  function saveEmailSettings(){
      $(".saveEmailSettingsBtn").html('Saving...');
     let formData = $("#emailSettingForm").serialize();
       $.ajax({
           "url" : "/HR/Config/emailSetting",
           "method" :"post",
           "data" :formData,
           "success" :function(response){
             $(".saveEmailSettingsBtn").html('Save');;
           }
       });  
  }
  function savePositionSettings(){
      $(".savePositionSettingsBtn").html('Saving...');
     let formData = $("#positionSettingsForm").serialize();
       $.ajax({
           "url" : "/HR/Config/positionSetting",
           "method" :"post",
           "data" :formData,
           "success" :function(response){
             $(".savePositionSettingsBtn").html('Save');;
           }
       });  
  }
  function editLeave(id, leaveTypeName, entitlements, is_paid) {
    $("#leaveTypeName").val(leaveTypeName);
    $("#leaveId").val(id);
    $("#entitlements").val(entitlements);
    if (is_paid == 1) {
        $("#is_paid").prop('checked', true); // Add attr checked
    } else {
        $("#is_paid").prop('checked', false); // Remove attr checked
    }
     $('.updateLeaveTypeBtn').removeClass('d-none');
     $('.addLeaveTypeBtn').addClass('d-none');
    $('.addEditLeaveModal').modal('show');
}
function addNewLeave(){
$("#leaveForm")[0].reset();    
$('.updateLeaveTypeBtn').addClass('d-none');
$('.addLeaveTypeBtn').removeClass('d-none');    
$('.addEditLeaveModal').modal('show');    
}
function updateLeaveType(obj){
  let formData = $("#leaveForm").serialize();
  $(obj).html("Updating...")
       $.ajax({
           "url" : "/HR/Config/updateleaveType",
           "method" :"post",
           "data" :formData,
           "success" :function(response){
             $(".updateLeaveTypeBtn").html('Leave Updated');
           }
       });  
}

function addNewStressProfile(){
$("#leaveForm")[0].reset();    
$('.updateStressProfileBtn').addClass('d-none');
$('.createStressProfileBtn').removeClass('d-none');    
$('.createStressProfileModal').modal('show');    
}
function editStressProfile(id,stressProfileName,maxHrsPWeek,maxDaysPWeek,maxHrsPDay){
 $("#stressProfileId").val(id);    
 $("#stressProfileName").val(stressProfileName);
 $("#maxHrsPWeek").val(maxHrsPWeek);
 $("#maxDaysPWeek").val(maxDaysPWeek);
 $("#maxHrsPDay").val(maxHrsPDay);
 $('.createStressProfileBtn').addClass('d-none');
 $(".updateStressProfileBtn").removeClass("d-none")
 $('.createStressProfileModal').modal('show');
}
function updateStressProfile(obj){
    $(obj).html("Updating...")
    let formData = $("#stressProfileForm").serialize();
       $.ajax({
           "url" : "/HR/Config/updateStressProfile",
           "method" :"post",
           "data" :formData,
           "success" :function(response){
           location.reload();
           }
       });
}


  	
   </script>
   
   <script>
$(document).ready(function() {
    $('.config-toggle').on('change', function() {
        let isChecked = $(this).is(':checked') ? 1 : 0;
        let configKey = $(this).data('config-key');
        
        $.ajax({
            url: '/HR/Config/saveGeneralConfig',
            type: 'POST',
            data: {
                config_key: configKey,
                value: isChecked,
            },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    alert('Configuration saved successfully!');
                } else {
                    alert('Error saving configuration: ' + response.message);
                    // Revert toggle state on error
                    $(this).prop('checked', !isChecked);
                }
            },
            error: function(xhr, status, error) {
                alert('Network error occurred');
                // Revert toggle state on error
                $(this).prop('checked', !isChecked);
            }
        });
    });
});
</script>
                                            
           
                                            