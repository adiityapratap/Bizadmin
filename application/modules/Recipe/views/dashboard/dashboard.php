
        
        <div class="row">
            <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                              
                                                <h4 id="greeting" class="fs-16 mb-1 text-black"></h4>
                                                <p class="text-black mb-0">Here's what's happening with your store today.</p>
                                            </div>
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <div class="col-sm-auto">
                                                           <div class="input-group">
    <input type="text" 
           class="form-control border-0 dash-filter-picker shadow flatpickr-input" 
           id="datePicker"
           data-provider="flatpickr" 
           data-date-format="d M, Y" 
           readonly="readonly">
    <div class="input-group-text bg-primary border-primary text-white">
        <i class="ri-calendar-2-line"></i>
    </div>
</div>
                                                        </div>
                                                        
                                                        <div class="col-auto">
                                                            <a href="<?php echo base_url('Orderportal/Menuplanner/list') ?>" class="btn btn-soft-success shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> View Today's Menu</a>
                                                        </div>
                                                       
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    
                                </div>
                                   
                                </div>
                                
         <!--<div class="row">-->
         <!--                           <div class="col-xl-12">-->
         <!--                               <div class="card">-->
         <!--                                   <div class="card-header border-0 align-items-center d-flex">-->
         <!--                                       <h4 class="card-title mb-0 flex-grow-1 text-black ">Revenue</h4>-->
         <!--                                       <div>-->
         <!--                                           <button type="button"-->
         <!--                                               class="btn btn-soft-secondary btn-sm shadow-none">-->
         <!--                                               ALL-->
         <!--                                           </button>-->
         <!--                                           <button type="button"-->
         <!--                                               class="btn btn-soft-secondary btn-sm shadow-none">-->
         <!--                                               1M-->
         <!--                                           </button>-->
         <!--                                           <button type="button"-->
         <!--                                               class="btn btn-soft-secondary btn-sm shadow-none">-->
         <!--                                               6M-->
         <!--                                           </button>-->
         <!--                                           <button type="button"-->
         <!--                                               class="btn btn-soft-primary btn-sm shadow-none">-->
         <!--                                               1Y-->
         <!--                                           </button>-->
         <!--                                       </div>-->
         <!--                                   </div>

         <!--                                   <div class="card-header p-0 border-0 bg-soft-light">-->
         <!--                                       <div class="row g-0 text-center">-->
         <!--                                           <div class="col-6 col-sm-6">-->
         <!--                                               <div class="p-3 border border-dashed border-start-0">-->
         <!--                                                   <h5 class="mb-1 text-black"><span class="counter-value" data-target="7585">0</span></h5>-->
                                                                    
         <!--                                                   <p class="text-black mb-0">Orders</p>-->
         <!--                                               </div>-->
         <!--                                           </div>-->
                                                    
         <!--                                           <div class="col-6 col-sm-6">-->
         <!--                                               <div class="p-3 border border-dashed border-start-0">-->
         <!--                                                   <h5 class="mb-1 text-black">$<span class="counter-value"-->
         <!--                                                           data-target="22.89">0</span>k</h5>-->
         <!--                                                   <p class="text-black mb-0">Earnings</p>-->
         <!--                                               </div>-->
         <!--                                           </div>-->
                                                    
                                                    
         <!--                                       </div>-->
         <!--                                   </div>

         <!--                                   <div class="card-body p-0 pb-2">-->
         <!--                                       <div class="w-100">-->
         <!--                                           <div id="customer_impression_charts"-->
         <!--                                               data-colors='["--vz-success", "--vz-primary", "--vz-danger"]'-->
         <!--                                               class="apex-charts" dir="ltr"></div>-->
         <!--                                       </div>-->
         <!--                                   </div>
         <!--                               </div>
         <!--                           </div>

                                   
                                    
         <!--                       </div>                        -->
                                
        
        
 <script src="theme-assets/libs/apexcharts/apexcharts.min.js"></script>
 <script src="theme-assets/js/pages/dashboard-ecommerce.init.js"></script>
 <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Flatpickr with today's date
        const datePicker = document.getElementById('datePicker');
        flatpickr(datePicker, {
            defaultDate: new Date(), 
            dateFormat: "d M, Y",  
        });
    });
    
    document.addEventListener("DOMContentLoaded", function () {
  const greetingElement = document.getElementById("greeting");
  const now = new Date();
  const hour = now.getHours();
  let greeting = "Hello";

  if (hour >= 5 && hour < 12) {
    greeting = "Good Morning";
  } else if (hour >= 12 && hour < 17) {
    greeting = "Good Afternoon";
  } else if (hour >= 17 && hour < 21) {
    greeting = "Good Evening";
  } else {
    greeting = "Good Night";
  }

  greetingElement.innerHTML = `${greeting}, Admin!`;
});

</script>
