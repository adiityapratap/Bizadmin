<div class="modal fade rounded-0 border-0" id="customer_new_modal" tabindex="-1" role="dialog" aria-labelledby="customer_new_modal_title" aria-hidden="true">
    <div class="modal-dialog rounded-0 border-0" role="document">
         <div class="alert alert-danger shadow alertMessage d-none" role="alert"> </div>
    	<div class="modal-content rounded-0 border-0">
    	    
    		<div class="modal-header bg-light rounded-0" style="display: inline;">
    			<h7 class="modal-title text-black" id="customer_new_modal_title">Company and Department not listed ? Click button below.</h7>
    			 <button type="button" class="btn btn-sm btnAdd  mb-2 mt-3 btn-success" onclick="add_new_company()"><i class="fa fa-plus icon-padding"></i>Add Company</button>
    			 <button type="button" class="btn  btn-sm btn-warning mx-2 mb-2 mt-3" onclick="add_new_department()"><i class="fa fa-plus icon-padding"></i>Add Department</button>
    		</div>
    	
    		<form  id="addNewCustomerForm" method="POST">
    		  <input type="hidden" name="customer_id" id="customer_id" value="">
        	<div class="modal-body">
           
    <div class="input-group mt-3">
        
        <select class="form-control companyIDList" name="company_id" id="company_id-input" onchange="fetch_departments(this)" required>
            <?php if (!empty($companies)) { ?>
                <option value="">Select Company</option>
                <?php foreach ($companies as $comp) {
                    $comp = (array)$comp; // Convert stdClass to array
                    echo "<option value=\"" . $comp['company_id'] . "\">" . $comp['company_name'] . "</option>";
                } ?>
            <?php } else { ?>
                <option value="">No Company Found</option>
            <?php } ?>
        </select>
    </div>

    <div class="input-group mt-3 department_wrap-input" style="display:none;">
        
        <select class="form-control deptList" name="department_id" id="department_id-input">
        </select>
    </div>

    <div class="input-group mt-3">
        
        <input type="text" class="form-control" name="firstname" id="first_name-input" placeholder="First Name">
    </div>
    <div class="input-group mt-3">
        
        <input type="text" class="form-control" name="lastname" id="last_name-input" placeholder="Last Name">
    </div>

    <div class="input-group mt-3">
        
        <input type="text" class="form-control" name="phone" id="phone-input" placeholder="Phone">
    </div>
    <div class="input-group mt-3">
        
        <input type="email" class="form-control" name="email" id="email-input" placeholder="Email">
        <div class="invalid-feedback">Customer with this email already exists</div>
    </div>
</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">
        				Close
        			</button>
        			<button type="button" class="btn btnAdd btn-sm btnSubmitLoad btn-success" onclick="addNewCustomerForm()">
        			 Add/Update
        			</button>
        		</div>
    		</form>
    	</div>
    </div>
</div>
<div class="modal fade rounded-0 border-0" id="new_company_modal" tabindex="-1" role="dialog" aria-labelledby="new_company_modal_title" aria-hidden="true">
    <div class="modal-dialog rounded-0 border-0" role="document">
        
         <div class="alert alert-danger shadow alertMessage d-none" role="alert"> </div>

    	<div class="modal-content rounded-0 border-0">
    		<div class="modal-header bg-light rounded-0">
    		   
    			<h5 class="modal-title text-black mb-2" id="new_company_modal_title">Add/Update Company</h5>
    			<button type="button" class="close btn btn-sm btn-danger mb-2" data-bs-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    			</button>
    		</div>
    		<div class="modal-body">
    			<form id="new_company_info">
    			      <input type="hidden" name="company_id" id="company_id" value="">
    			    <div class="mb-3">
                     <label for="fullName" class="form-label">Name</label>
                     <input type="text" class="form-control" name="company_name" id="newCompany" placeholder="Enter company name">
                     </div>
                     
                     <div class="mb-3">
                     <label for="fullName" class="form-label">ABN</label>
                     <input type="text" class="form-control" name="abn" id="newCompanyAbn" placeholder="Enter ABN">
                     </div>
                     
                     <div class="mb-3">
                     <label for="fullName" class="form-label">Phone</label>
                     <input type="text" class="form-control" name="company_phone" id="newCompanyPhone" placeholder="Enter phone">
                     </div>
                     
    			    
    			<div class="mb-3">
    			
    		  <textarea name="company_address" class="form-control btnSubmitLoad" id="newCompanyAddr"></textarea>
    				</div>
    			
    			</form>
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">
    				Cancel
    			</button>
    			<button type="button" class="btn btnAdd saveCompany btn-sm btn-success" onclick="save_new_company()">
    				Add/Update
    			</button>
    		</div>
    	</div>
    </div>

</div>
<div class="modal fade rounded-0 border-0" id="new_department_modal" tabindex="-1" role="dialog" aria-labelledby="new_department_modal_title" aria-hidden="true">
    <div class="modal-dialog rounded-0 border-0" role="document">
         <div class="alert alert-danger shadow alertMessage d-none" role="alert"> </div>
    	<div class="modal-content rounded-0 border-0">
    		<div class="modal-header bg-light rounded-0">
    			<h5 class="modal-title text-black mb-2" id="new_department_modal_title">New Department</h5>
    			<button type="button" class="close btn btn-sm btn-danger mb-2" data-bs-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    			</button>
    		</div>
    		<div class="modal-body">
    			<form id="new_department_info">
    			      <input type="hidden" name="department_id" id="department_id" value="">   
    			    <div class="input-group">
    			
    				<select class="form-select companyIDList mb-3" name="company_id" id="newDeptComp">
    				     <option selected="">Select company</option>
                     <?php if(!empty($companies)){
						foreach($companies as $company){ ?>
						<option value="<?php echo $company['company_id']; ?>"><?php echo $company['company_name']; ?></option>
							<?php } }?>
                          </select>
    					
    				</div>
    				
    				<div>
                 <label for="newDeptComp" class="form-label">Department Name</label>
                 <input type="text" class="form-control" id="newDept" name="department_name" placeholder="Enter department name">
                  </div>
    			
    				
    			</form>
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-dark" data-bs-dismiss="modal">
    				Close
    			</button>
    			<button type="button" class="btn btnAdd btnSubmitLoad saveDepartment btn-success" onclick="save_new_department()">
    				Add/Update
    			</button>
    		</div>
    	</div>
    </div>
</div>

<script>
function fetchCompaniesAndDepartment(){
     
     $.ajax({
		url:'fetchCompaniesAndDepartment',
		method:"GET",
		success:function(data){
		    console.log("data==",data);
		    return false;
		    data = JSON.parse(data);
		    company_map = data['companies']
		    department_map = data['departments'];

		    let options = '<option value="" >Select Company</option>';
		    let deptOptions = '<option value="" >Select Department</option>';;
		    company_map.map((compDetails)=>{
		      options +='<option value="'+compDetails.company_id+'">'+compDetails.company_name+'</option>'  
		    });
		     department_map.map((deptDetails)=>{
		      deptOptions +='<option value="'+deptDetails.department_id+'">'+deptDetails.department_name+'</option>'  
		    });
		  
		    
		   $("#company_id-input").html('');
		   $("#department_id-input").html('');
		   $(".companyIDList").html(options);
		   $(".deptList").html(deptOptions);
		    
		    $("#new_company_modal").modal('hide');
		    $("#new_department_modal").modal('hide');
		   $("#customer_new_modal").modal('show');
			location.reload();
		}
	})
 }
 
function fetch_departments(obj){
    
    let company_id = $(obj).val();
    let htmlOpt = '<option>Select Department</option>';
    let checkFlag=0;
    for(let i=0;i<department_map.length;i++){
		if(department_map[i].company_id==company_id){
		checkFlag=1;
		htmlOpt += '<option value="'+department_map[i].department_id+'">'+department_map[i].department_name+'</option>';
		}
	}
	if(checkFlag == 1){
	    $("#department_id-input").html(htmlOpt);
	    $(".department_wrap-input").css('display','flex');
	}else{
	    $("#department_id-input").html('<option value="">No department found</option>');
	    $(".department_wrap-input").css('display','none');
	}
}
</script>
