<div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                <div class="card">
            <div class="card-body">  
            <ul class="nav nav-tabs nav-justified mb-3 d-flex" role="tablist">
                
              <li class="nav-item" rel="personalDetails">
              <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#personalDetails" role="tab">Personal Details</a>
              </li>

              <li class="nav-item" rel="emergencyDetails">
              <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#emergencyDetails" role="tab">Emergency Details</a>
              </li>
              
              <li class="nav-item" rel="companyDetails">
              <a class="nav-link fw-semibold" value="companyDetails" data-bs-toggle="tab" href="#companyDetails" role="tab">Company Info</a>
              </li>
              
              <li class="nav-item" rel="documentDetails">
              <a class="nav-link fw-semibold" value="documentDetails" data-bs-toggle="tab" href="#documentDetails" role="tab">Documents</a>
              </li>
              
           
           </ul> 
           <div class="tab-content text-black">
            <div class="tab-pane fade show active" id="personalDetails" role="tabpanel">
                <div class="alert alert-danger shadow mb-xl-0 dangerEmployee" role="alert" style="display:none"></div>

                      <form  role="form" id="personalDetailsForm" method="post" class="mt-4" enctype="multipart/form-data">
                           <input type="hidden" name="emp_id" class="contracterId">
                           <input type="hidden" name="is_contractor" value="1">
                           <input type="hidden" class="form-control"  name="userId" id="lastInsertedUserId">
                            <input type="hidden" name="positionIdToRemove" class="allPositionIdsToRemove" value="">
                	   <div class="row gy-4">
                	   <h4 class="text-black">Personal Details</h4>
                	  
                		<div class="col-lg-3 col-md-6">
                			<label for="first_name" class=" control-label">First Name:<span>*</span></label>
                			<input type="text" id="first_name" class="form-control required" name="first_name"  autocomplete="off" >
                			<span class="fieldError" id="first_name_error"></span>
                		</div>
                		<div class="col-lg-3 col-md-6">
                		<label for="last_name" class=" control-label">Last Name:<span>*</span></label>
                		<input type="text" class="form-control required" id="last_name" name="last_name"  autocomplete="off" >
                		<span class="fieldError" id="last_name_error"></span>
                		</div>
                	     <div class="col-lg-3 col-md-6">
                    	<label for="email" class="form-label">Email Address:<span>*</span></label>
                    	<input type="text"  class="form-control required" id="email" name="email">
                    	<span class="fieldError" id="email_error"></span>
                    	</div>
                    	 <div class="col-lg-3 col-md-6">
                    	<label for="phone" class="form-label">Contact Number:<span>*</span></label>
                    	<input type="text" class="form-control required" id="phone" name="phone" onkeypress='validate(event)' autocomplete="off">
                    	<span class="fieldError" id="phone_error"></span>
                    	</div>
                    	
                    	<!--<div class="col-lg-3 col-md-6">-->
                    	<!--<label for="role" class="form-label">Role:</label>-->
                    	<!--<input type="text" class="form-control" id="role" name="role"  autocomplete="off">-->
                    
                    	<!--</div>-->
                    				
                    	<?php if(isset($locations) && !empty($locations)){  ?>   
                        <div class="col-lg-3 col-md-6">
                                            <h6 class="fw-semibold text-black">Location Access *</h6>
                                            <select class="js-example-basic-multiple locationIds required" name="locationIds[]" multiple="multiple">
                                               <?php foreach($locations as $location){ ?>     
                                                 <option value=" <?php echo $location['location_id']; ?> "> <?php echo $location['location_name']; ?>   </option>
                                                  <?php } ?>
                                            </select>
                                        <small> click in the box to view and select multiple locations</small>    
                                        	<span class="fieldError" id="locationIds_error"></span>
                                        </div>
                        <?php } ?>	
                 <h4 class="text-black">Pay Details</h4>	
                 
                  <div class="row">       
         <div class="col-md-12 col-sm-12 table-responsive">
         <table class="table table-bordered mt-3" id="positionTable">
                     <tbody>
                  
     <tr class="positionMainRow">
                    <td class="gap-2 d-flex">
                   <div class="col-lg-3 col-md-3">
							<label for="businessname" class="form-label">Position<span>*</span></label>
							<select class="form-select" name="position_id[]" id="position_id">
								<option value="">Select</option>
							   <?php if(isset($positions) && !empty($positions)) {  ?>
							   <?php foreach($positions as $position) {  ?>
							    <?php  if($position['position_id'] == $employee['position_id']) { ?> 
							   <option selected value="<?php echo $position['position_id'] ?>"><?php echo $position['position_name'] ?></option>
							   <?php }else {  ?>
							   <option  value="<?php echo $position['position_id'] ?>"><?php echo $position['position_name'] ?></option>
							    <?php } ?>
							   <?php } ?>
							   <?php } ?>
							</select>
						</div>
						<div class="col-lg-2 col-md-2">
                							<label for="rate" class=" control-label">Weekday Rate:<span>*</span></label>
                							<div class="form-icon">
                							<input type="number" id="rate" class="form-control form-control-icon" name="rate[]" value="" autocomplete="off" >
                						    <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>  
                	    <div class="col-lg-2 col-md-2">
                							<label for="Saturday_rate" class=" control-label">Saturday Rate:<span>*</span></label>
                							<div class="form-icon">
                							<input type="number" id="Saturday_rate" class="form-control form-control-icon" name="Saturday_rate[]" value="" autocomplete="off" >
                					       <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>
                		 <div class="col-lg-2 col-md-2">
                							<label for="Sunday_rate" class=" control-label">Sunday Rate:<span>*</span></label>
                							<div class="form-icon">
                							<input type="number" id="Sunday_rate" class="form-control form-control-icon" name="Sunday_rate[]" value="" autocomplete="off" >
                					       <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>
                		<div class="col-lg-2 col-md-2">
                							<label for="holiday_rate" class=" control-label">Public Holiday:<span>*</span></label>
                						   <div class="form-icon">	
                							<input type="number" id="holiday_rate" class="form-control form-control-icon" name="holiday_rate[]" value="" autocomplete="off" >
                					        <i class="bx bx-dollar"></i>
                                            </div>
                					       </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2 mt-3">
                     <button class="btn btn-success add-Positionrow" type="button">+</button>
                     <button class="btn btn-danger remove-Positionrow" type="button">-</button>
                     </div>
                    </td>
                </tr> 
    </tbody>
        </table> 
        </div>  
        </div> 

				  <h4 class="text-black">Address</h4>	
				    
					<div class="col-lg-6 col-md-12">
    <label for="address" class="form-label">Address :</label>
    <input type="text" class="form-control" id="address" name="address"
           placeholder="Start typing your address…" autocomplete="off">
</div>

					</div>
			  		
				<input type="button" name="contact_submit" id="save_continue_personal" class="btn btn-success btn-ph" value="Save and Continue" rel="emergencyDetails">		
                	</form>
                                                </div>
            <div class="tab-pane" id="emergencyDetails" role="emergencyDetails">
              <form  role="form" id="emergencyDetailsForm" method="post" action="" enctype="multipart/form-data">
                     <input type="hidden" name="emp_id" class="contracterId">       	     
                                       <div class="row gy-4">      	    
                    					 <div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="control-label ">Name:<span>*</span></label>
                    						<input type="text" id="nextkin_name_two" class="form-control"  name="nextkin_name_two" autocomplete="off">
                    						<span class="fieldError" id="nextkin_name_two_error"></span>
                    						</div>
                    					<div class="col-lg-3 col-md-6">
                    						<label for="businessname"   class="control-label ">Relationship:<span>*</span></label>
                    						<input type="text" class="form-control"  id="nextkin_relationship_two"  name="nextkin_relationship_two" autocomplete="off" >
                    							<span class="fieldError" id="nextkin_relationship_two_error"></span>
                    						</div>
                    					<div class="col-lg-3 col-md-6">
                    						<label for="businessname" class="form-label">Email Address:</label>
                    						<input type="text" class="form-control " name="nextkin_email_two"  autocomplete="off" >
                    						
                    						</div>
                    							     
                    					<div class="col-lg-3 col-md-6">
                    						<label for="Phone No"  class="control-label ">Contact No:<span>*</span></label>
                    						<input type="text" id="nextkin_phone_no" class="form-control"  name="nextkin_phone_no" autocomplete="off" >
                    							<span class="fieldError" id="nextkin_phone_no_error"></span>
                    						</div>
                    						
                    					 
                                        <div class="col-lg-6 col-md-12">
    <label for="emergency_address" class="form-label">Address :</label>
    <input type="text" class="form-control" id="emergency_address" name="emergency_address"
           placeholder="Start typing your address…" autocomplete="off">
</div>

                    						</div>   
               <input type="button" rel="bankDetails" name="contact_submit" id="save_continue_emergency" class="btn btn-success btn-ph" value="Save and Continue">		
                						</form>                             
               </div>  
            <div class="tab-pane" id="companyDetails" role="tabpanel">
                      <form  role="form" id="companyDetailsForm" method="post" class="mt-4" enctype="multipart/form-data">
                         <input type="hidden" name="emp_id" class="contracterId">  
                	   <div class="row gy-4">
                	   <h4 class="text-black">Company Details</h4>
                	  
                		<div class="col-lg-3 col-md-6">
                			<label for="company_name" class=" control-label">Company Name:<span>*</span></label>
                			<input type="text" id="company_name" class="form-control" name="company_name"  autocomplete="off" >
                		</div>
                		
                	     <div class="col-lg-3 col-md-6">
                    	  <label for="company_contactName" class="form-label">Company Contact Name:<span>*</span></label>
                    	  <input type="text"  class="form-control" id="company_contactName" name="company_contactName">
                    	   </div>
                    	 <div class="col-lg-3 col-md-6">
                    	  <label for="company_contactEmail" class="form-label">Email Address:<span>*</span></label>
                    	  <input type="text"  class="form-control" id="company_contactEmail" name="company_contactEmail">
                    	   </div>  
                    	 <div class="col-lg-3 col-md-6">
                    	  <label for="company_contactNumber" class="form-label">Contact Number:<span>*</span></label>
                    	  <input type="text" class="form-control" id="company_contactNumber" name="company_contactNumber" onkeypress='validate(event)' autocomplete="off">
                    	  </div> 
                    	  
                    	  <div class="col-lg-3 col-md-6">
                		 <label for="company_descr" class=" control-label">Company Description:<span>*</span></label>
                		 
                		  <textarea class="form-control" id="company_descr" name="company_descr" rows="3"></textarea>
                		  </div>
                    	</div> 
                    	
                <input type="button"  name="contact_submit" id="save_continue_company" class="btn btn-success btn-ph" value="Save and Continue">    	
                    			</form>
                    </div>
            <div class="tab-pane" id="documentDetails" role="tabpanel">
             <h4 class="text-black">Upload Documents</h4>    
            <form  role="form" id="documentDetailsForm" method="post" action="" enctype="multipart/form-data" class="mt-3">
               <table class="table table-bordered" id="cronNotificationMailTable">
            <tbody>
              <tr>
                 <td>
                <input type="text" name="file_name[]" class="form-control" placeholder="Enter document name" autocomplete="off" required />
                </td>
                    <td class="gap-2 d-flex">
                    <input type="file" name="userfile[]" class="form-control" multiple/>
                    </td>
                    <td><button class="btn btn-success add-row " type="button">+</button></td>
                </tr>  

            </tbody>
        </table>  
         <input type="button"  name="contact_submit" id="save_continue_documents" class="btn btn-success btn-ph" value="Save and Continue"> 
        
            </form>
            
            </div>         
            </div>            

            
             </div>
             </div>
                </div>
                </div>     
            </div>
             </div>
             <script>
            $('form').on('click', '.add-row', function () {
              let newRow = '<tr>';
              newRow +='<td>';
              newRow +='<input type="text" name="file_name[]" class="form-control" placeholder="Enter document name" autocomplete="off" required />';
              newRow +=  '</td>';
              newRow +='<td class="gap-2 d-flex"><input type="file" name="userfile[]" class="form-control" multiple/>';
              newRow +='</td><td><button type="button" class="btn btn-success add-row">+</button></td><td><button type="button" class="btn btn-danger remove-row">-</button></td></tr>';
                $(this).closest('tr').after(newRow);
            });
            
            $('form').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
            
    $('#save_continue_personal').click(function(e) {
    e.preventDefault(); 
    
      let isValid = true;

        // Clear previous error messages
        $('.fieldError').text("");

        // Loop through all required fields
       $('.required').each(function() {
    let inputField = $(this);
    let errorField = $(this).parent().find('.fieldError');

    // Convert value to string safely
    let value = $.trim(String(inputField.val() || ""));

    if (value === "") {
        errorField.text("This field is required!");
        isValid = false;
    } else {
        errorField.text("");
    }
});


        // If validation fails, stop here
        if (!isValid) return;
    $('#loaderContainer').show();
    $('#save_continue_personal').val("Saving...");
    
    // Create userData object
    let userData = {
        first_name: $("#first_name").val(),
        last_name: $("#last_name").val(),
        email: $("#email").val(),
        username: $("#email").val(),
        password: $("#first_name").val() + '_contractor', // Default password
        role_id: '4',
        locationIds: $(".locationIds").val(),
        ajaxSubmit: true
    };
    
    $.ajax({
        url: '/auth/create_user',
        method: 'post',
        data: userData, // Send userData object directly
        success: function(response) {
            try {
                let responseData = JSON.parse(response);
                if (responseData?.status === 'success') {
                    $("#lastInsertedUserId").val(responseData?.user_id);
                    addRecordToEmployeeTable();
                } else {
                    $('.dangerEmployee').html(responseData?.message);
                    $('.dangerEmployee').show();
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error("AJAX request failed:", errorThrown);
        }
    });
    
     setTimeout(function () {
        $('.dangerEmployee').hide();
      }, 5000);
});

	
	function addRecordToEmployeeTable(){
	     let data1 = $('#personalDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/contractors/submitContractorForm',
        	data: data1,
        	success: function(response){
         let res = JSON.parse(response)
        addHiddenInputFields(res?.positionAddedDetails);     
        localStorage.removeItem("positionIdsToRemove")
         $('#save_continue_personal').val("SAVE");	
         $('#loaderContainer').hide();
         activaTab('emergencyDetails');
        	}
        }); 
	    
	}
    $('#save_continue_emergency').click(function(e){
      if($(".contracterId").val()==''){
      alert("Please enter personal details"); return false;    
      }    
       $('#save_continue_emergency').val("Saving...");
       $('#loaderContainer').show();
        let data1 = $('#emergencyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/contractors/submitContractorForm',
        	data: data1,
        	success: function(response){
        	    $('#loaderContainer').hide();
        	     $('#save_continue_emergency').val("SAVE"); 
        	     activaTab('companyDetails');
        	}
        });
   
	});
	$('#save_continue_company').click(function(e){
    if($(".contracterId").val()==''){
      alert("Please enter details in previous steps"); return false;    
      }  
      $('#loaderContainer').show();
     $('#save_continue_company').val("Saving...");
        let data1 = $('#companyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: '/HR/contractors/submitContractorForm',
        	data: data1,
        	success: function(response){
        	     $('#save_continue_company').val("SAVE");
        	    $('#loaderContainer').hide();
        	     activaTab('documentDetails');
        	     
		        
        	}
        });
	}); 
	function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
   };
   
   $(document).ready(function(){
   $(document).on('click', '.add-Positionrow', function() {
        let $positionMainRow = $(this).closest('.positionMainRow');
        let clonedRow = $positionMainRow.clone();
        clonedRow.find('.position_unique_id').remove(); // Remove the element with the class "position_unique_id" from the cloned row
        $positionMainRow.after(clonedRow);
    });


     

 $(document).on('click', '.remove-Positionrow', function() {
    if ($('.positionMainRow').length > 1) {
        // Retrieve the existing array from localStorage
        let storedPositionIds = JSON.parse(localStorage.getItem("positionIdsToRemove")) || [];
        let positionIdToRemove = $(this).closest(".positionMainRow").find('input[name="position_unique_id[]"]').val();
        storedPositionIds.push(positionIdToRemove);
        localStorage.setItem("positionIdsToRemove", JSON.stringify(storedPositionIds));
        $(this).closest('.positionMainRow').remove();
    }
});

});

// adding updating multiple employee position 

 function addHiddenInputFields(data) {

        $('.positionMainRow').each(function(index) {
            var positionId = $(this).find('select[name="position_id[]"]').val();
            var positionData = data.find(item => item.position_id == positionId);
            if (positionData) {
           // Check if the hidden input field already exists within this element
            var hiddenInput = $(this).find('input[name="position_unique_id[]"]');

          if (hiddenInput.length) {
             // If it exists, update its value
           hiddenInput.val(positionData.id);
          } else {
        // If it doesn't exist, append a new hidden input field
        $(this).append('<input type="hidden" class="position_unique_id" name="position_unique_id[]" value="' + positionData.id + '">');
       }
       }
        });
     console.log("ajax data= ",data);   
 if (data && data.length > 0) {
    let contractorId = data[0]?.contractor_id;
    $(".contracterId").val(contractorId);
} else {
    console.error("positionAddedDetails is empty or undefined");
}
    }
             </script>
             
             
     <script src="<?php echo base_url('application/modules/HR/views/employee/documentUpload.js'); ?>"></script>
                
                    