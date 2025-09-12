<div class="container-fluid" style="margin-top: 100px !important;">
   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
                                        <div class="flex-shrink-0">
                                            <a type="button" class="btn bg-orange add-btn" 
                                                id="create-btn" href="<?php echo base_url('auth/userListing') ?>"><i
                                                    class="ri-arrow-go-back-fill align-bottom me-1"></i> Back
                                                </a>
                                            <button class="btn btn-success" type="button" onclick="document.getElementById('editUserForm').submit()">
                                                 <span class="icon-on"><i class="ri-folder-user-line align-bottom me-1"></i> Update</span>
                                                 </button>   
                                           <button type="button" class="btn btn-secondary custom-toggle active" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
    <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Configure Menu</span>
     
    <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Configure Menu</span>
</button>          
                                        </div>
                                    </div><!-- end card header -->
        
        
        <div class="card-body mt-2">
        <div id="infoMessage" class="mb-3"><?php echo $message;?></div>
        <div class="col-md-12 col-sm-4">
             <form class="row g-3 needs-validation" id="editUserForm" novalidate action="<?php echo base_url("auth/edit_user/".$user->id) ?>" method="post">
                 <input type="hidden" class="user_id_being_edited" value="<?php echo $user->id; ?>">
                             <div class="row row-inner mb-3">
                                     <div class="col-md-4">
                                                    <label for="first_name" class="form-label fw-semibold">Full Name</label>
                                                    <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo (isset($first_name) ? $first_name : '') ?>"  required>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                    <div class="invalid-feedback">Please enter full name.</div> 
                                                   
                                                </div>
                                        <div class="col-md-4">
                                                    <label for="email" class="form-label fw-semibold"> Email</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" class="form-control"  name="email" id="email" value="<?php echo (isset($email) ? $email : '') ?>" aria-describedby="inputGroupPrepend" required>
                                                    <div class="valid-feedback"> Looks good! </div>
                                                     <div class="invalid-feedback">Please enter email.</div>
                                                    </div>
                                                </div>
                                        <div class="col-md-4">
                                                    <label for="username" class="form-label fw-semibold">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username"  value="<?php echo (isset($username) ? $username : '') ?>"  required>
                                                   <div class="invalid-feedback">Please enter a unique username.</div> 
                                                </div>
                                                
                                </div>       
                                         <div class="row row-inner mb-3">       
                                                <div class="col-md-4">
                                                   
                                                <label class="form-label fw-semibold" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                 <div class="valid-feedback">Looks good! </div>
                                               <div class="invalid-feedback">Please choose a password.</div>
                                                </div>
                                                
                                                 
                                          
                                            </div>
            <?php if ($this->ion_auth->is_admin()): ?>
            <div class="col-md-4">
                                            <div class="form-group" id="pinField">
                                            <label for="pin">4-Digit PIN</label>
                                            <input type="text" name="pin" id="pin" maxlength="4" class="form-control" pattern="\d{4}" title="Enter a 4-digit PIN">
                                             </div>
                                            </div>
              <div class="col-md-3">
            <label for="role_id" class="form-label fw-semibold">Roles</label>
         <select class="form-select" id="role_id" name="role_id" required>
         <?php foreach ($groups as $group):?>
  <option value="<?php echo $group['id'];?>" <?php echo ($group['id'] == (isset($currentGroups[0]['id']) ? $currentGroups[0]['id'] : 0)) ? 'selected="selected"' : null; ?>  value="1"><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></option>
         <?php endforeach?>
          </select>
                                            <div class="invalid-feedback">Please select a valid role.</div>
                                                        
                                                </div>   
                                                 <?php endif ?>
                          </div>
                 <?php
$selected_location_ids = array_map('intval', is_array($selected_location_ids) ? $selected_location_ids : []);
$selected_prep_ids = array_map('intval', is_array($selected_prep_ids) ? $selected_prep_ids : []);
$selected_system_ids = array_map('intval', is_array($selected_system_ids) ? $selected_system_ids : []);

?>

<div class="row row-inner mb-3">
    <?php if (!empty($locations)) { ?>   
        <div class="col-lg-6">
            <h6 class="fw-semibold text-black">Location Access *</h6>
            <select class="js-example-basic-multiple" name="locationIds[]" multiple="multiple">
                <?php foreach ($locations as $location) { ?>
                    <option value="<?= $location['location_id']; ?>" 
                        <?= in_array((int)$location['location_id'], $selected_location_ids, true) ? 'selected' : ''; ?>>
                        <?= $location['location_name']; ?>
                    </option>
                <?php } ?>
            </select>
            <small>Click in the box to view and select multiple locations</small>    
        </div>
    <?php } ?> 

    <?php if (!empty($prepAreas)) { ?>   
        <div class="col-lg-6">
            <h6 class="fw-semibold text-black">Prep Areas</h6>
            <select class="js-example-basic-multiple" name="prepIds[]" multiple="multiple">
                <?php foreach ($prepAreas as $prepArea) { ?>     
                    <option value="<?= $prepArea['id']; ?>" 
                        <?= in_array((int)$prepArea['id'], $selected_prep_ids, true) ? 'selected' : ''; ?>>
                        <?= $prepArea['prep_name']; ?>
                    </option>
                <?php } ?>
            </select>
            <small>For timesheet users: select prep areas they'll see after login to clock in.</small>    
        </div>
    <?php } ?>

    <?php if (!empty($system_details)) { ?>   
        <div class="col-lg-6">
            <h6 class="fw-semibold text-black">System Access *</h6>
            <select class="js-example-basic-multiple" name="systemIds[]" multiple="multiple">
                <?php foreach ($system_details as $system) { ?>
                    <option value="<?= $system['system_id']; ?>" 
                        <?= in_array((int)$system['system_id'], $selected_system_ids, true) ? 'selected' : ''; ?>>
                        <?= $system['system_name']; ?>
                    </option>
                <?php } ?>
            </select>
            <small>Click in the box to view and select multiple systems</small>    
        </div>
    <?php } ?> 
</div>

                    
                      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?> 
                      </form>
                </div> 
        </div>
                </div> 
                </div>
                </div>
                </div>
                
            	<?php 
	 $menuConfigureCanvas = APPPATH . 'views/auth/MenuConfigureCanvas.php';
     include($menuConfigureCanvas);
     ?>    
        <!--js used for this page is in "login-assets/js/custom.js"      -->
