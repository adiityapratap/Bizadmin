
<?php $status_colors = $this->config->item('status_colors');  ?>
<style>
.custom-min-height {
    min-height: 200px; /* Set your desired min-height value */
}
</style>
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div class="row">
     <div class="col">
      <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1 text-black"><?php echo $greeting; ?>, <?php echo $username; ?>!</h4>
                                                <p class="text-black mb-0">Here's what's happening with your cafe today.</p>
                                            </div>
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <div class="col-sm-auto">
                                                            <div class="input-group">
                                                               <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-date-format="d M, Y" data-default-date="today">
                                                                <div class="input-group-text bg-dark border-dark text-white">
                                                                    <i class="ri-calendar-2-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-auto">
                                                            <a href="<?php echo base_url('new_order') ?>" class="btn btnAdd"><i class="ri-add-circle-line align-middle me-1"></i>Place Order</a>
                                                        </div>
                                                        <!--end col-->
                                                        <!--<div class="col-auto">-->
                                                        <!--    <button type="button" class="btn btn-success btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>-->
                                                        <!--</div>-->
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <div class="row">
<!--Today’s Deliveries                                    -->
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today’s Deliveries</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> <?php echo  (isset($todaysOrder) && !empty($todaysOrder) ? count($todaysOrder) : 0) ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4 text-dark "> <?php echo  (isset($todaysOrder) && !empty($todaysOrder) ? count($todaysOrder) : 0) ?></h4>
                                                        <a href="<?php echo base_url('futureOrder') ?>" class="text-decoration-underline linkGreen">View all order</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-secondary-subtle rounded fs-3">
                                                            <i class="bx bx-bowl-hot text-secondary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div>
<!--Tomorrow’s Deliveries-->
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                     <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tomorrow’s Deliveries</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i><?php echo  (isset($tommorowsorders) && !empty($tommorowsorders) ? count($tommorowsorders) : 0) ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4 text-dark "><?php echo  (isset($tommorowsorders) && !empty($tommorowsorders) ? count($tommorowsorders) : 0) ?></h4>
                                                        <a href="<?php echo base_url('futureOrder') ?>" class="text-decoration-underline linkGreen">View all orders</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                            <i class="bx bxs-truck text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div>
 
 <!--Pending Quotes-->
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Quotes</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> <?php echo $totalPendingQuotes['totalPendingQuotes'] ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4 text-dark "><?php echo $totalPendingQuotes['totalPendingQuotes'] ?></h4>
                                                        <a href="<?php echo base_url('quoteList') ?>" class="text-decoration-underline linkGreen">View all quotes</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="bx bx-paste text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
<!--Future Orders-->
                                    <div class="col-xl-3 col-md-6">
                                    
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Future Orders</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-muted fs-14 mb-0">
                                                           <?php echo $totalFutureOrders['totalFutureOrders'] ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4 text-dark "><?php echo $totalFutureOrders['totalFutureOrders'] ?> </h4>
                                                        <a href="<?php echo base_url('futureOrder') ?>" class="text-decoration-underline linkGreen">View all future orders</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                            <i class="bx bxs-truck text-warning"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->

                             

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card custom-min-height">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Today’s Deliveries  <?php echo date('d M, Y') ?></h4>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown card-header-dropdown">
                                                       
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Today</a>
                                                            <a class="dropdown-item" href="#">Yesterday</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                 <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                   <thead class="text-muted table-light">
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Email</th>
                    <th>Delivery Time</th>
                    <th>Order Status</th> 
                    <th>Action</th>
                    </thead>
                    <tbody>
                   <?php if (!empty($todaysOrder)): ?>                                         
                   <?php foreach ($todaysOrder as $order): ?>
                    <?php if($order['is_completed'] == 1){ 
                    $className = 'bg-success-subtle';
                     }else{
                     $className = '';
                     }
                     ?>
                     <tr class="<?php echo $className; ?>">
                         <td><a href="<?php echo base_url('viewOrderDetails/'.$order['order_id']) ?>" class="fw-medium link-dark"> #<?php echo $order['order_id']; ?></a> </td>
                         <td><h5 class="fs-14 my-1 fw-normal"><?php echo htmlspecialchars($order['fullname']); ?></h5></td>
                         <td><h5 class="fs-14 my-1 fw-normal"><?php echo htmlspecialchars($order['customer_telephone']); ?></h5></td>
                         <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['customer_email']; ?></h5></td>
                         <td> <h5 class="fs-14 my-1 fw-normal"><?php echo $order['delivery_time']; ?></h5></td>
                      <td class="status"><span class="badge <?php echo $status_colors[$order['status']]; ?> text-uppercase"><?php echo get_order_status_name($order['status']); ?></span></td>
                       <td>
              <div class="hstack gap-2">
             <a href="<?php echo base_url('viewProductionPage/'.$order['order_id']) ?>" class="btn btn-dark btn-sm"><i class="ri-eye-line me-1"></i>Prepare</a>     
             <?php if($order['is_completed'] == 1){ ?> 
             <a type="button" class="btn  btnAdd btn-sm" disabled><i class="ri-time-line me-1"></i>Completed </a> 
             <?php }else { ?>
             <a type="button" onclick="markCompleted(<?php echo $order['order_id']; ?>,this)" class="btn btnAdd btn-sm"><i class="ri-time-line me-1"></i> Complete</a> 
              <?php } ?>
                
                                   
                                
                                
                            </div>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                                                            
                                                       
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="card custom-min-height">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Tomorrow’s Deliveries <?php echo date('d M, Y', strtotime('+1 day')); ?></h4>
                                               
                                            </div><!-- end card header -->

                       <div class="card-body">
                        <div class="table-responsive table-card">
                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                    <thead class="text-muted table-light">
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Email</th>
                    <th>Delivery Time</th>
                    <th>Order Status</th> 
                    <th>Action</th>
                    </thead>
                     <tbody>
                     <?php if (!empty($tommorowsorders)): ?>                                         
                   <?php foreach ($tommorowsorders as $tommorowsorder): ?>
                     <tr>
                         <td><a href="<?php echo base_url('viewOrderDetails/'.$tommorowsorder['order_id']) ?>" class="fw-medium link-dark"> #<?php echo $tommorowsorder['order_id']; ?></a> </td>
                         <td><h5 class="fs-14 my-1 fw-normal"><?php echo htmlspecialchars($tommorowsorder['fullname']); ?></h5></td>
                        <td> <h5 class="fs-14 my-1 fw-normal"><?php echo htmlspecialchars($tommorowsorder['customer_telephone']); ?></h5></td>
                       <td> <h5 class="fs-14 my-1 fw-normal"><?php echo htmlspecialchars($tommorowsorder['customer_email']); ?></h5></td>
                        <td><h5 class="fs-14 my-1 fw-normal"><?php echo $tommorowsorder['delivery_time']; ?></h5></td>
                        <td class="status"><span class="badge <?php echo $status_colors[$tommorowsorder['status']]; ?> text-uppercase"><?php echo get_order_status_name($tommorowsorder['status']); ?></span></td>
                        <td>
             
                               
                              
                    <a href="<?php echo base_url('cateringCheckList/'.$tommorowsorder['order_id']) ?>" class="btn btn-dark btn-sm"><i class="ri-checkbox-line me-1"></i>Checklist</a>                
                    <a href="<?php echo base_url('viewOrderDetails/'.$tommorowsorder['order_id']) ?>" class="btn btnAdd btn-sm"><i class="ri-eye-line me-1"></i>View</a>
                                   
                                
                                
                            </div>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php endif; ?> 
                                                            
                                                        </tbody>
                                                    </table><!-- end table -->
                                                </div>

                                               
                                            </div> <!-- .card-body-->
                                        </div> 
                                    </div> <!-- .col-->
                                </div> <!-- end row-->

                                <div class="row">
                                    <!--<div class="col-xl-4">-->
                                    <!--    <div class="card card-height-100">-->
                                    <!--        <div class="card-header align-items-center d-flex">-->
                                    <!--            <h4 class="card-title mb-0 flex-grow-1">Earning this month</h4>-->
                                    <!--            <div class="flex-shrink-0">-->
                                    <!--                <div class="dropdown card-header-dropdown">-->
                                    <!--                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                    <!--                        <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>-->
                                    <!--                    </a>-->
                                    <!--                    <div class="dropdown-menu dropdown-menu-end">-->
                                    <!--                        <a class="dropdown-item" href="#">Download Report</a>-->
                                    <!--                        <a class="dropdown-item" href="#">Export</a>-->
                                    <!--                        <a class="dropdown-item" href="#">Import</a>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->

                                    <!--        <div class="card-body">-->
                                    <!--            <div id="store-visits-source" data-colors='["--vz-primary", "--vz-success", "--vz-secondary", "--vz-info", "--vz-warning"]' class="apex-charts" dir="ltr"></div>-->
                                    <!--        </div>-->
                                    <!--    </div> -->
                                    <!--</div> -->

                                    <div class="col-xl-12">
                                        <div class="card custom-min-height">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Deliveries within next 7 days</h4>
                                                <div class="flex-shrink-0">
                                                    <a href="<?php echo base_url('reports') ?>" class="btn bgEdit btn-sm">
                                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                                    </a>
                                                </div>
                                            </div><!-- end card header -->

          <div class="card-body">
             <div class="table-responsive table-card">
                 <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                   <thead class="text-muted table-light">
                      <tr>
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Email</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Order Status</th> 
                    <th>Action</th>
                     </tr>
</thead>
<tbody>
    <?php if (!empty($weekorders)): ?>
        <?php foreach ($weekorders as $weekorder): ?>
            <tr>
                <td>
                    <a href="<?php echo base_url('viewOrderDetails/'.$weekorder['order_id']) ?>" class="fw-medium link-dark">#<?php echo $weekorder['order_id']; ?></a>
                </td>
                
                <td>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <img src="/assets/images/users/user-dummy-img.jpg" alt="" class="avatar-xs rounded-circle" />
                        </div>
                        <div class="flex-grow-1"><?php echo htmlspecialchars($weekorder['fullname']); ?></div>
                    </div>
                </td>
                <td><?php echo htmlspecialchars($weekorder['customer_telephone']); ?></td>
                <td><?php echo htmlspecialchars($weekorder['customer_email']); ?></td>
                 <td><?php echo date('d-m-Y',strtotime($weekorder['delivery_date'])); ?> </td>
                 <td><?php echo $weekorder['delivery_time']; ?></td>
               
                <td class="status"><span class="badge <?php echo $status_colors[$weekorder['status']]; ?> text-uppercase"><?php echo get_order_status_name($weekorder['status']); ?></span></td>
               
                <td>
                    <a href="<?php echo base_url('cateringCheckList/'.$weekorder['order_id']) ?>" class="btn btn-dark btn-sm"><i class="ri-checkbox-line me-1"></i>Checklist</a>                
                    <a href="<?php echo base_url('viewOrderDetails/'.$weekorder['order_id']) ?>" class="btn btnAdd btn-sm">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">No orders found.</td>
        </tr>
    <?php endif; ?>
</tbody>

                                                    </table><!-- end table -->
                                                </div>
                                            </div>
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->
                                </div> <!-- end row-->

                            </div> <!-- end .h-100-->
       </div> <!-- end col -->

    </div>
</div>
</div>
</div>
<script>
function markCompleted(orderId,obj){
    let btn = $(obj); btn.html("Loading...")
   $.ajax({
		 url:"<?php echo base_url('markCompleted');?>",
		 method:"POST",
		 data:{'orderId' : orderId},
		 success:function(data){
		 btn.html('');    
		btn.html(' <button type="button" class="btn btn-success" disabled  title="Completed"> Completed</button>')
         
		}
	  }); 
}
</script>