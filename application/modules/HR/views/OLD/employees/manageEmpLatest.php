

       
        

         

         
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                     

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Add, Edit & Remove</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div id="customerList">
                                            <div class="row g-4 mb-3">
                                                <div class="col-sm-auto">
                                                    <div>
                                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                                        <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="d-flex justify-content-sm-end">
                                                        <div class="search-box ms-2">
                                                            <input type="text" class="form-control search" placeholder="Search...">
                                                            <i class="ri-search-line search-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="table-responsive table-card mt-3 mb-1">
                                                <table class="table align-middle table-nowrap">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col" style="width: 50px;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                                </div>
                                                            </th>
                                                            <th class="sort" data-sort="customer_name">Name</th>
                                                            <th class="sort" data-sort="email">Email</th>
                                                            <th class="sort" data-sort="phone">Phone</th>
                                                            <th class="sort" data-sort="date">Employee Type</th>
                                                            <th class="sort" data-sort="dob">DOB</th>
                                                            <th class="sort" data-sort="startDate">Start Date</th>
                                                            <th class="sort" data-sort="mail_status">Mail Status</th>
                                                             <th class="sort" data-sort="status">Status</th>
                                                            <th class="sort" data-sort="action">Action</th>
                                                            </tr>
                                                    </thead>
                                                    
                                                         <?php if(!empty($employees)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($employees as $row){ 
                                        
                                        if($row->agree_terms_one == '1' && $row->agree_terms_two == '1' && $row->agree_terms_three == '1'){
                        				$color = "class='badge text-bg-success'";						
                        				$btn_name = "Completed";
                        				}	
                        				else if($row->tracking_mail == 'Yes'){
                        				$color = "class='badge text-bg-warning'";						
                        				$btn_name = "In Progress";
                        				}
                        				
                        				else{
                        				$color = "class='badge text-bg-danger'";
                        				$btn_name = "Not Started";
                        				} ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                                </div>
                                                            </th>
                                         <td class="first_name"><a href="<?php echo base_url(); ?>index.php/admin/update_employee/<?php echo $row->emp_id ?>"><?php echo $row->first_name.' '.$row->last_name; ?></a></td>
                                           <td class="email "><?php echo $row->email; ?></td>
                                           <td class="phone "><?php echo $row->phone; ?></td>
                                           <td class="employee_type"><?php echo $row->employee_type; ?></td>
                                            <td class="dob"><?php if($row->dob == '00-00-0000' || $row->dob == '0000-00-00'){ echo ""; }else{ echo date("d-m-Y",strtotime($row->dob)); } ?></td>
                                           <td class="effective_start_date "><?php if($row->effective_start_date == '00-00-0000' || $row->effective_start_date == '0000-00-00'){ echo ""; }else{ echo date("d-m-Y",strtotime($row->effective_start_date)); } ?></td>
                                            <td class="tracking_mail "><?php if($row->tracking_mail != ''){ echo $row->tracking_mail; }else{ echo 'No'; }  ?></td>
                                            <td class="status"><span class="badge badge-soft-success text-uppercase"><?php echo $btn_name;  ?></span></td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                                    </div>
                                                                    <div class="remove">
                                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                                </table>
                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                                        <p class="text-muted mb-0">We did not find any record for you search.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex justify-content-end">
                                                <div class="pagination-wrap hstack gap-2">
                                                    <a class="page-item pagination-prev disabled" href="#">
                                                        Previous
                                                    </a>
                                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                                    <a class="page-item pagination-next" href="#">
                                                        Next
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                       

                     

                      
                        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-2 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Are you Sure ?</h4>
                                                <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>
          


      

        

        
        <!-- prismjs plugin -->
        <script src="/hr-assets/libs/prismjs/prism.js"></script>
        <script src="/hr-assets/libs/list.js/list.min.js"></script>
        <script src="/hr-assets/libs/list.pagination.js/list.pagination.min.js"></script>

        <!-- listjs init -->
        <script src="/hr-assets/js/pages/listjs.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="/hr-assets/libs/sweetalert2/sweetalert2.min.js"></script>
hr-
        <!-- App js -->
        
   