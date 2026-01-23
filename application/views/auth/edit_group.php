<div class="container-fluid" style="margin-top: 130px !important;">
   <div class="row">
                            <div class="col-lg-12">
                                 <?php echo form_open(current_url());?>
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1 text-black">Update Role</h4>
                                        <div class="flex-shrink-0">
                                            <a type="button" class="btn btn-danger add-btn" 
                                                id="create-btn" href="<?php echo base_url('auth/group_listing') ?>"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                                </a>
                                                <button class="btn btn-success" type="submit">Update Role</button>
                                           <button type="button" class="btn btn-secondary custom-toggle active" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
    <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Configure Menu</span>
    <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Configure Menu</span>
</button>         

                                        </div>
                                    </div><!-- end card header -->
        
        
        <div class="card-body mt-5">
        <div id="infoMessage" class="mb-3"><?php echo $message;?></div>
        <div class="col-md-12 col-sm-4">
        
                             <div class="row row-inner mb-3">
                                     <div class="col-md-4">
                                                    <label for="group_name" class="form-label fw-semibold">Role Name</label>
                                                    <input type="text" value="<?php echo $group_name; ?>"  name="group_name" <?php echo ($group_name == 'Admin' || $group_name == 'Manager' ||  $group_name == 'Staff' ? 'readonly' : '') ?> class="form-control" id="group_name"  required>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback">Please enter role name.</div> 
                                                   
                                                </div>
                                                
                                                
                                                 <div class="col-md-4" style="display:none">
                                                    <label for="group_name" class="form-label fw-semibold">Role Display Name</label>
                                                    <input type="text" value="<?php echo $displayName; ?>" name="displayName" class="form-control" id="displayName" >
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback">Please enter role name.</div> 
                                                   
                                                </div>
                                        
                                        <div class="col-md-4">
                                                    <label for="username" class="form-label fw-semibold">Description</label>
                                                    <input type="text"  value="<?php echo $group_description; ?>" class="form-control" id="group_description" name="group_description" >
                                                   
                                                </div>
                                                
                          <div class="col-md-4">
                           <div class="form-check form-check-dark mt-4">
                          <input class="form-check-input" type="checkbox" id="showSeprateChecklist" <?php echo (isset($showSeprateChecklist) && $showSeprateChecklist == 1 ? 'checked' : '') ?> name="showSeprateChecklist">
                          <label class="form-check-label" for="showSeprateChecklist">
                         Show this role in a separate checklist section
                          </label>
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
                
            	<?php 
	 $menuConfigureCanvas = APPPATH . 'views/auth/MenuConfigureCanvas.php';
     include($menuConfigureCanvas);
     ?>    
              
