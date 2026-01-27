<div class="container" style="margin-top: 60px; padding: 15px;">
    <!-- Welcome Message -->
    <div class="col-12">
        
                                                <?php
                                                $currentHour = date('H');
                                                if ($currentHour >= 5 && $currentHour < 12) {
                                                 $greeting = 'Good Morning';
                                                 } elseif ($currentHour >= 12 && $currentHour < 18) {
                                                 $greeting = 'Good Afternoon';
                                                 } else {
                                                 $greeting = 'Good Evening';
                                                }

                                                ?>
                                                
                                         
      <div class="welcome-message mb-3" style="font-size: clamp(1.5rem, 4vw, 2rem); font-weight: 600;"><?php echo $greeting ?>, <?php echo $this->session->userdata('username');  ?></div>
      <div class="location-text mb-3" style="font-size: clamp(1rem, 2.5vw, 1.25rem);">Please select location</div>
    </div>
    <!-- Cards Section -->
   <div class="row justify-content-center">
        <?php if(!empty($userLocations)) { ?>
         <?php foreach($userLocations as $loc_id=>$location_name)  {   ?>
         <?php $encoded_params = custom_encode($loc_id, $location_name); $url = base_url("auth/checklist/{$encoded_params}"); ?>
      <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
        <div class="card-container dashboard">
            <a style="text-decoration: none;" href="<?php echo $url ?>">
         <div class="custom-card" style="color:#fff;border-radius: 24px;height: clamp(120px, 20vw, 150px);width: 100%; max-width: 150px; margin: 0 auto;">
           <lord-icon
    src="https://cdn.lordicon.com/zzcjjxew.json"
    trigger="hover"
    colors="primary:#121331,secondary:#08a88a"
    style="width:100%;height:auto;max-width:150px;max-height:120px;">
</lord-icon>
            <div class="card-text" style="font-size: clamp(0.75rem, 2vw, 0.875rem); word-wrap: break-word; padding: 0 5px;"><?php echo $location_name; ?></div>
          </div>
          </a>
        </div>
      </div>
      <?php } ?>
       <?php } ?>
    </div>
  </div>
  <script>
  // Clear the localstorage item when we change the location
   $(document).ready(function(){
    localStorage.removeItem("minOrderInfoRead");
    localStorage.removeItem("suppId");
    localStorage.removeItem("dateFrom");
    localStorage.removeItem("dateTo");
    localStorage.removeItem("selectedSiteFoodTempDashBoard");
    localStorage.removeItem("selectedSiteDashBoard");
    localStorage.removeItem("selectedSiteCleanDashBoard");
    localStorage.removeItem("Weekly_from_delivery_date");
    localStorage.removeItem("Weekly_to_delivery_date");
   }) 
  </script>
 


