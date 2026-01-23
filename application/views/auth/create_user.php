<div class="container-fluid" style="margin-top: 130px !important;">
   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                     <form class="row g-3 needs-validation" novalidate action="<?php echo base_url("auth/create_user") ?>" method="post">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1 text-black">Add User</h4>
                                        <div class="flex-shrink-0">
                                            <a type="button" class="btn bg-orange add-btn" 
                                                id="create-btn" href="<?php echo base_url('auth/userListing') ?>">
                            <i class="ri-arrow-go-back-fill align-bottom me-1"></i> Back</a>
                             <button class="btn btn-success" type="submit">Submit</button>
   
                                        </div>
                                    </div>
        
         
        <div class="card-body mt-5">
        <div id="infoMessage" class="mb-3"><?php echo $message;?></div>
        <div class="col-md-12 col-sm-4">
           
                             <div class="row row-inner mb-3">
                                     <div class="col-md-4">
                                                    <label for="first_name" class="form-label fw-semibold">Full Name</label>
                                                    <input type="text" name="first_name" class="form-control" id="first_name"  required>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback">Please enter full name.</div> 
                                                   
                                                </div>
                                        <div class="col-md-4">
                                                    <label for="email" class="form-label fw-semibold"> Email</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" class="form-control"  name="email" id="email" aria-describedby="inputGroupPrepend" required>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                     <div class="invalid-feedback">Please enter email.</div>
                                                    </div>
                                                </div>
                                        <div class="col-md-4">
                                                    <label for="username" class="form-label fw-semibold">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username"  required>
                                                   <div class="invalid-feedback">Please enter a unique username.</div> 
                                                </div>
                                                
                                </div>       
                     <div class="row row-inner mb-3">       
                                                <div class="col-md-4">
                                                   
                                                <label class="form-label fw-semibold" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3 has-validation">
                                                    <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                 <div class="valid-feedback">Looks good! </div>
                                               <div class="invalid-feedback">Please choose a password.</div>
                                                </div>
                                          
                                            </div>
                                            
                                            <div class="col-md-4">
                                            <div class="form-group" id="pinField">
                                            <label for="pin">4-Digit PIN</label>
                                            <input type="text" name="pin" id="pin" maxlength="4" class="form-control" pattern="\d{4}" title="Enter a 4-digit PIN">
                                             </div>
                                            </div>
                                            
                                              <div class="col-md-3">
                                                    <label for="role_id" class="form-label fw-semibold">Roles</label>
                                                    <select class="form-select" id="role_id" name="role_id" required>
                                                        <option selected  value="">Select Role</option>
                                                        <?php if(!empty($roles)) {  ?>
                                                        <?php  foreach ($roles as $role) {  ?>
                                                        <option value="<?php echo  $role['id']; ?>"><?php echo $role['name'] ?></option>
                                                        <?php  } ?>
                                                        <?php  } ?>
                                                    </select>
                                            <div class="invalid-feedback">Please select a valid role.</div>
                                                        
                                                </div>   
                          </div>
                 <div class="row row-inner mb-3">
                     
                 
                        
                          
                          <?php if(!empty($locations)){  ?>   
                              <div class="col-lg-6">
                                            <h6 class="fw-semibold text-black">Location Access *</h6>
                                            <select class="js-example-basic-multiple" name="locationIds[]" multiple="multiple">
                                               <?php foreach($locations as $location){ ?>     
                                                 <option value=" <?php echo $location['location_id']; ?> " selected="selected"> <?php echo $location['location_name']; ?>   </option>
                                                  <?php } ?>
                                            </select>
                                        <small> click in the box to view and select multiple locations</small>    
                                        </div>
                                           <?php } ?> 
                                           
                                            <?php if(!empty($prepAreas)){  ?>   
                              <div class="col-lg-6">
                                            <h6 class="fw-semibold text-black">Prep Areas </h6>
                                            <select class="js-example-basic-multiple" name="prepIds[]" multiple="multiple">
                                               <?php foreach($prepAreas as $prepArea){ ?>     
                                                 <option value=" <?php echo $prepArea['id']; ?> " selected="selected"> <?php echo $prepArea['prep_name']; ?>   </option>
                                                  <?php } ?>
                                            </select>
     <small>In case of timesheet user, please select the prep areas this timesheet user will see after login,so that employee can click on that prep area to clockin their time</small>    
                                        </div>
                                           <?php } ?> 
                                           
                             <?php if(!empty($system_details)){  $i =0 ?>   
                              <div class="col-lg-6">
                                            <h6 class="fw-semibold text-black">System Access *</h6>
                                            <select class="js-example-basic-multiple" name="systemIds[]" multiple="multiple">
                                               <?php foreach($system_details as $system){ ?>     
                                                 <option value="<?php echo $system['system_id']; ?>" selected="selected"><?php echo $system['system_name']; ?> </option>
                                                  <?php } ?>
                                            </select>
                                 <small> click in the box to view and select multiple systems</small>    
                                  </div>
                                           <?php } ?> 
        
                     </div>
                     <div class="row row-inner mb-3">
                          
                           
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
              
