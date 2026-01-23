<div class="container-fluid" style="margin-top: 130px !important;">
   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
           <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("auth/create_group") ?>" method="post">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1 text-black">Add New Role</h4>
                                        <div class="flex-shrink-0">
                                            <a type="button" class="btn bg-orange add-btn" 
                                                id="create-btn" href="<?php echo base_url('auth/group_listing') ?>"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                                </a>
                                              <button class="btn btn-success" type="submit">Submit </button>
                                        </div>
                                    </div><!-- end card header -->
        
        
        <div class="card-body">
        <div id="infoMessage" class="mb-3"><?php echo $message;?></div>
        <div class="col-md-12 col-sm-4">
            
                             <div class="row row-inner mb-3">
                                     <div class="col-md-4">
                                                    <label for="group_name" class="form-label fw-semibold">Role Name</label>
                                                    <input type="text" name="group_name" class="form-control" id="group_name"  required>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback">Please enter role name.</div> 
                                                   
                                                </div>
                                                
                                                <div class="col-md-4" style="display:none">
                                                    <label for="group_name" class="form-label fw-semibold">Role Display Name</label>
                                                    <input type="text" name="displayName" class="form-control" id="displayName" >
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback">Please enter role display name.</div> 
                                                   
                                                </div>
                                        
                                        <div class="col-md-4">
                                                    <label for="username" class="form-label fw-semibold">Description</label>
                                                    <input type="text" class="form-control" id="description" name="description" >
                                                   
                                                </div>
                                                <div class="col-md-4">
                                                   
                                                 <div class="form-check form-check-dark mt-4">
                                                            <input class="form-check-input" type="checkbox" id="showSeprateChecklist" checked="" name="showSeprateChecklist">
                                                            <label class="form-check-label" for="showSeprateChecklist">
                                                            Show this role in a separate checklist section
                                                            </label>
                                                            
                                                        </div>
                                                         </div>
                                                
                                </div>       
                         </div> 
        </div>
         </form>
                </div> 
                </div>
                </div>
                </div>
                
            	<?php 
	 $menuConfigureCanvas = APPPATH . 'views/auth/MenuConfigureCanvas.php';
     include($menuConfigureCanvas);
     ?>    
              
