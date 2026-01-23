<div class="container-fluid" style="margin-top: 100px !important;">
   <div class="row">
       <!-- Info icon trigger -->
     


                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1 text-black">Edit User  
<i class="fa-solid fa-circle-info text-primary fs-16"
   role="button"
   data-bs-toggle="modal"
   data-bs-target="#infoModal">
</i></h4>
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
                                            
                                             <div class="col-md-4">
                                            <div class="form-group" id="pinField">
                                            <label for="pin">Allow Approve timesheet</label>
                                    <input type="hidden" name="allow_timesheetapproval" value="0">
                                    <input type="checkbox" name="allow_timesheetapproval"  value="1"  <?= $allow_timesheetapproval; ?>>
       
      
      



                                             </div>
                                             <small>please check this checkbox if you want user with manager role to be able to approve timesheet</small>
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
            <small>Click in the box to view and select multiple locations except for timesheet role(assign just one location)</small>    
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
                
                <!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg border-0 rounded-3">

      <!-- MODAL HEADER -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="infoModalLabel">
          <i class="bi bi-info-circle me-2"></i> How to Use This Page
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- MODAL BODY -->
      <div class="modal-body py-4">
        <p class="mb-3">
          This page allows you to manage user/manager/admin/timesheet user etc...
          You can:
        </p>

        <ul class="list-group list-group-flush mb-3">
          <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>
            For Role =  timesheet do not assign multiple locations, for other roles multiple locations can be assigned
          </li>
          
          <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>
            For timesheet users: select prep areas they'll see after login to clock in.
          </li>
          <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>
            Make sure to enter all important field marked with *
          </li>
        </ul>

        <div class="alert alert-info">
          <strong>Note :</strong> assign menu to this  user by clicking configure menu from top right corner, note that assignning menu from here will overwrite menu access given at the role level
          
        </div>
      </div>

      <!-- MODAL FOOTER -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                
            	<?php 
	 $menuConfigureCanvas = APPPATH . 'views/auth/MenuConfigureCanvas.php';
     include($menuConfigureCanvas);
     ?>    
        <!--js used for this page is in "login-assets/js/custom.js"      -->
