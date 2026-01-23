<div class="main-content">
<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">Reports</h3>
                </div>
                <div class="card-body mx-5">
                    <form action="<?php echo base_url('fetchReport');?>" method="POST">
                        
                        <div class="col-md-12 mb-3">
                         <label for="fullnameInput" class="form-label">Order Date From</label>
                         <input type="text" class="form-control dash-filter-picker shadow flatpickr-input active" name="added_date_from" id="added_date_from" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                         <label for="fullnameInput" class="form-label">Order Date To</label>
                         <input type="text" class="form-control dash-filter-picker shadow flatpickr-input active" name="added_date_to" id="added_date_to" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                         <label for="fullnameInput" class="form-label">Delivery Date From</label>
                         <input type="text" class="form-control dash-filter-picker shadow flatpickr-input active" name="date_from" id="date_from" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                        </div>
                     
                       
                         <div class="col-md-12 mb-3">
                         <label for="fullnameInput" class="form-label">Delivery Date To</label>
                         <input type="text" class="form-control dash-filter-picker shadow flatpickr-input active" name="date_to" id="date_to" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                         <label for="fullnameInput" class="form-label">Select Location</label>
                         <select class="form-control" name="location_id">
                                    <option value="" selected>All Locations</option>
                                    <?php if(!empty($locations)){
                                        foreach($locations as $location){
                                            echo "<option value=\"".$location['company_id']."\">".$location['location_name']."</option>";
                                        }
                                    }?>
                                </select>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                         <label for="fullnameInput" class="form-label">Status</label>
                         <select class="form-control" name="status">
                                    <option value="" selected>All Statuses</option>
                                    <option value="7">Approved</option>
                                    <option value="90">All minus paid</option>
                                    <option value="91">All minus cancelled</option>
                                    <option value="8">Rejected</option>
                                    <option value="0">Cancelled</option>
                                    <option value="2">Paid</option>
                                    <option value="4">Waiting for Approval</option>
                                </select>
                        </div>
                        
                        
                     
                      
                        <div class="form-group d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-dark">Generate <i class="fa fa-bar-chart"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>  