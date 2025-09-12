<div class="main-content">
<div class="page-content">
<div class="container-fluid">

<div class="row">
   <p id="ajaxResponse" class="text-success"></p> 
   <div class="col-6 mt-4">
        <h2 class="mb-4 text-black">Locations</h2>
       <form id="locationForm">
            <input type="hidden" id="deleted_location_ids" name="deleted_location_ids" value="">
            <div id="locationsWrapper">
                <?php if(isset($locations) && !empty($locations)) {  ?>
                <?php foreach($locations as $location) { ?>
                <div class="input-group mb-3 location-field">
                  <input type="hidden" name="location_id[]" value="<?php echo $location['location_id']; ?>">
                  <input type="text" class="form-control" name="location_name[]" placeholder="Enter location"  value="<?php echo $location['location_name']; ?>" required>
                    <div class="input-group-append">
                        <button class="btn btn-success add-location mx-2" type="button">+</button>
                        <button class="btn btn-danger remove-location mx-1" type="button">-</button>
                </div>
                </div>
                <?php } ?>
                <?php } else {  ?>
                
                <div class="input-group mb-3 location-field">
                  <input type="text" class="form-control" name="location_name[]" placeholder="Enter location" required>
                    <div class="input-group-append">
                        <button class="btn btn-success add-location mx-2" type="button">+</button>
                        <button class="btn btn-danger remove-location mx-1" type="button">-</button>
                </div>
                </div>
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-success btnLoading">Save</button>
        </form>
       
   </div>
       <div class="col-6">
         <h2 class="mb-4 text-black">Settings</h2>   
       
        <form action="settings"  id="settingsForm" method="post">
       <input type="hidden" name="setting_id" id="setting_id" value="<?php echo $settingsData[0]['id'] ?? ''; ?>">
       <div class="form-group">
    <label for="remittance_email">Select Location</label>       
      <select class="form-select" id="settings_locations" name="location_id">
      <option value="0" selected disabled>All Locations</option>
       <?php if (!empty($locations)) { 
      foreach ($locations as $location) { ?>
      <?php if($location['location_id'] == $settingsData[0]['location_id']){ $selected='selected'; }else{ $selected=''; }  ?>
      <option value="<?php echo $location['location_id'] ?>"  <?php echo $selected; ?>><?php echo $location['location_name'] ?></option>
      <?php } ?>
      <?php } ?>
      </select>
       </div>
            <div class="form-group">
            <label for="remittance_email">Remittance Email</label>
            <input type="email" class="form-control" id="remittance_email" name="remittance_email" value="<?php echo $settingsData[0]['remittance_email'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="account_name">Account Name</label>
            <input type="text" class="form-control" id="account_name" name="account_name" value="<?php echo $settingsData[0]['account_name'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number" value="<?php echo $settingsData[0]['account_number'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $settingsData[0]['contact_number'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="abn">ABN</label>
            <input type="text" class="form-control" id="abn" name="abn" value="<?php echo $settingsData[0]['abn'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $settingsData[0]['company_name'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="bsb">BSB</label>
            <input type="text" class="form-control" id="bsb" name="bsb" value="<?php echo $settingsData[0]['bsb'] ?? ''; ?>" required>
        </div>
        
         <div class="form-group">
            <label for="pickup_address">Pick Up Address</label>
            <textarea type="text" class="form-control" id="pickup_address" name="pickup_address" required><?php echo $settingsData[0]['pickup_address'] ?? ''; ?></textarea>
        </div>
            <button type="submit" class="btn btn-dark btnLoading mt-3 mb-3">Save</button>
        </form>
   </div>
   
   
  </div>
     
</div>
</div>
</div>
  <script>
        $(document).ready(function() {
            $(document).on('click', '.add-location', function() {
                var newField = '<div class="input-group mb-3 location-field">' +
                    '<input type="text" class="form-control" name="location_name[]" placeholder="Enter location" required>' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-success add-location mx-2" type="button">+</button>' +
                    '<button class="btn btn-danger remove-location mx-1" type="button">-</button>' +
                    '</div>' +
                    '</div>';
                $('#locationsWrapper').append(newField);
            });

            $(document).on('click', '.remove-location', function() {
                var locationId = $(this).closest('.location-field').find('input[name="location_id[]"]').val();
                if (locationId) {
                    var deletedLocationIds = $('#deleted_location_ids').val();
                    $('#deleted_location_ids').val(deletedLocationIds + locationId + ',');
                }
                $(this).closest('.location-field').remove();
            });

            $('#locationForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                $(".btnLoading").html("Saving....")
                $.ajax({
                    url: 'save_locations',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#ajaxResponse').html('<div class="alert alert-success">Locations saved successfully!</div>');
                        $(".btnLoading").html("Save")
                    },
                    error: function(xhr, status, error) {
                        $('#ajaxResponse').html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
            
            $('#settingsForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
              $(".btnLoading").html("Saving....")
                $.ajax({
                    url: 'settings',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#ajaxResponse').html('<div class="alert alert-success">Settings saved successfully!</div>');
                        $(".btnLoading").html("Save")
                    },
                    error: function(xhr, status, error) {
                        $('#ajaxResponse').html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
            
            $('#settings_locations').on('change', function() {
            var locationId = $(this).val();

            if (locationId) {
                $.ajax({
                    url: 'fetchSettingsLocationWise',
                    type: 'POST',
                    data: { location_id: locationId },
                    success: function(response) {
                        // Assuming response is in JSON format
                        var data = JSON.parse(response);
                        
                        if (data) {
                            $('#remittance_email').val(data.remittance_email);
                            $('#setting_id').val(data.id);
                            $('#account_name').val(data.account_name);
                            $('#account_number').val(data.account_number);
                            $('#contact_number').val(data.contact_number);
                            $('#abn').val(data.abn);
                            $('#company_name').val(data.company_name);
                            $('#bsb').val(data.bsb);
                            $('#pickup_address').val(data.pickup_address);
                        } else {
                            alert('No data found for this location.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            }
        });
            
        });
    </script>
