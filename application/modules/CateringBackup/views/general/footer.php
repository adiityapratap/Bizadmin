 <?php 
 //  we have a common footer for all the Apps like HR, Cash , Supplier etc where we load all our asset JS
     $allJsSourceFiles = APPPATH . 'views/general/AllJs.php';
     include($allJsSourceFiles);
     
?>
<script>
function explode(){
      $('.hideMeAlert').remove();
      <?php 
        $this->session->unset_userdata('sucess_msg');
        $this->session->unset_userdata('error_msg');
        ?>
    }
    setTimeout(explode, 2000);
    
function goBack() {
    window.history.back();
}   

function add_customer() {
    console.log("Add Customer clicked");
    // Clear all fields and reset the form
  
    $('#addNewCustomerForm input, #addNewCustomerForm textarea').val('');
    $(".department_wrap-input").hide();

    // Remove checked attribute from customer status
    $("#customer_status-input").removeAttr("checked");

    // Set the data attribute to indicate this is an add operation
    $("#customer_new_modal").data('buttontype', 'add');

    // Open the modal
    $("#customer_new_modal").modal('show');
}

function add_new_company(){
     $('#new_company_info input, #new_company_info textarea, #new_company_info select').val('');
	$("#new_company_modal").modal('show');
	$("#customer_new_modal").modal('hide');
}
function save_new_company(){
    
    if($('#newCompany').val() == ''){
        alert('Please enter required fields');
        return false;
    }
    
    let btnLoad = $(".btnSubmitLoad");
    btnLoad.html("Loading...");
    
    $(".saveCompany").html("Loading...");
	$.ajax({
		url:'new_company',
		method:"POST",
		data:$("#new_company_info").serialize(),
		success:function(data){
		  //  fetchCompaniesAndDepartment();
		   btnLoad.html("Add/Update");
		  postAjaxAction(data);
		  console.log("response",response);
			
		}
	})
}

function postAjaxAction(data){
    console.log("data",data)
    let response = JSON.parse(data);
    
    if(response?.status == 'failed'){
		   $(".alertMessage").removeClass('d-none').show().delay(3000).fadeOut(function() {
             $(this).addClass('d-none');
           }) 
		   $(".alertMessage").text(response?.message)   
		  }else{
		  location.reload();    
		  }
}
function add_new_department(){
// 	$("#department_name").val('');

	$("#new_department_modal").modal('show');
	$("#customer_new_modal").modal('hide');
}
function save_new_department(){
    
     if($('#newDept').val() == '' || $('#newDeptComp').val() == ''){
        alert('Please enter required fields');
        return false;
    }
    let btnLoad = $(".btnSubmitLoad");
     btnLoad.html("Loading...");
     $(".saveDepartment").html("Loading...");
	$.ajax({
		url:'new_department',
		method:"POST",
		data:$("#new_department_info").serialize(),
		success:function(data){
		     btnLoad.html("Add/Update");
		postAjaxAction(data);
       fetchCompaniesAndDepartment();
		}
	})
}
function addNewCustomerForm() {
    // Collect form data
    let formData = $("#addNewCustomerForm").serialize();
     let firstName = $("#first_name-input").val().trim();
    let lastName = $("#last_name-input").val().trim();
    let email = $("#email-input").val().trim();
    let btnLoad = $(".btnSubmitLoad");

    // Validation check for mandatory fields
    if (firstName === "" || lastName === "" || email === "") {
        alert("First Name, Last Name, and Email are mandatory fields.");
        return;
    }
    btnLoad.html("Loading...");
    $.ajax({
        type: "POST",
        url: "new_customer", // Adjust the URL as per your routing setup
        data: formData,
        success: function(data) {
        btnLoad.html("Add/Update");
           postAjaxAction(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            alert("An error occurred while adding the customer.");
        }
    });
}

</script>