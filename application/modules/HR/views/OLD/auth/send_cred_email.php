<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList">
                   
                    <form method="post" class="form-horizontal" id="form_find_emp">
                   
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Send Email</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <input type="button"  id="find_emp" onclick="find_emp_id()" class="btn btn-primary" value="Find Id">
                                   
                                </div> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                           
                             <div id="message_box" class="alert alert-success" role="alert" style="font-size: 18px;display:none">Email has been sent successfully</div>
                           
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                           
                                <div class="row">
                                    <div class="col-lg-6 col-md-12"> 
                                      <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Email</label>
                                              <div class="controls">
                                                <input type="text" name="employee_email" id="email" class ='form-control' required>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6 mb-4 emp_id_show" style='display: none;'>  
                                            <div class="control-group">
                                              <label class="control-label">Employee Fingerprint Id</label>
                                              <div class="controls">
                                                <input type="text" name="emp_id" id="emp_id" class ='form-control'  readonly >
                                              </div>
                                            </div>
                                          </div>
                                       
                                      </div>
                                    </div> 
                                    
                                </div>
                             
                              
                        </div>
                       
                       
                    </div>
                    </form>
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<script>
    function find_emp_id(){
    	var form = $("#form_find_emp");
	    var formdata =  form.serialize();
	   
		 $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/send_cred_email",
		        data:formdata,
		        beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
                $("#loader").hide();
                 },
                 success: function(response){
                     console.log(response);
                     if(response=="Sent"){
                     $("#emp_id").val('');
                      $("#find_emp").html(" ");
                      $("#find_emp").html("Find Id");
                       $(".emp_id_show").css("display","none");
                     $("#message_box").css("display","block");
                     setTimeout(function() { $("#message_box").css("display","none"); }, 1000);
                      
                     }else{
                     $("#emp_id").val(response);
                     $(".emp_id_show").css("display","block");
                      $("#find_emp").html(" ");
                      $("#find_emp").html("Send Email");
                     }
                     
                 }
		 });
                 
                 
                 
    
}
</script>

