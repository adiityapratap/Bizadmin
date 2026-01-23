<div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                   <h3 class="text-black mb-1"> <?php echo (isset($tillName) ? $tillName : ''); ?></h3>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                               <button type="button" class="btn btn-primary" id="editModal" data-bs-toggle="modal" data-bs-target="#flipEditModal" style="display:none"></button>
                                            </div>
                                        </div>
                                    </div>
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="tillList">
                                           
                                            
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="cashDepositListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                          
                                                          
                                                            <th class="sort" data-sort="start_shift">Start of Shift Time</th>
                                                            <th class="sort" data-sort="start_staff">Start of Shift Staff</th>
                                                             <th class="sort" data-sort="end_manager">Start Shift Variance</th>
                                                             <th class="sort" data-sort="end_shift">End of Shift Time</th>
                                                            <th class="sort" data-sort="end_stff">End of Shift Staff</th>
                                                            <th class="sort" data-sort="end_manager">End of Shift Manager</th>
                                                           
                                                            <th class="sort" data-sort="end_manager">Variance</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php  if(!empty($cashDepositList)) {  ?>
                                                        <?php foreach($cashDepositList as $cd){  if($cd['items_detail']){ $rawDetails = unserialize($cd['items_detail']);   } ?>
                                                        <tr id="row_<?php echo  $cd['id']; ?>" >
                                                           <td class="date"><?php echo (isset($rawDetails['start_time']) ? date('d-m-Y',strtotime($rawDetails['start_time'])) : ''); ?></td>
                                                            <td class="start_staff"><?php echo (isset($rawDetails['staff_name']) ? $rawDetails['staff_name'] : ''); ?></td>
                                                            <td class="staffVariance"><?php echo (isset($cd['varience']) ? sprintf("$%.2f", $cd['varience']) : '$0.00'); ?></td>
                                                            <td class="end_shift"><?php echo (isset($rawDetails['end_time']) ? date('d-m-Y',strtotime($rawDetails['end_time'])): ''); ?></td>
                                                            <td class="end_stff"><?php echo (isset($rawDetails['end_staff_name']) ? $rawDetails['end_staff_name'] : ''); ?></td>
                                                            <td class="end_manager"><?php echo (isset($rawDetails['manager_name']) ? $rawDetails['manager_name'] : ''); ?></td>
                                                            <td class="managerVariance"><?php echo (isset($cd['managerVariance']) ? sprintf("$%.2f", $cd['managerVariance']) : '$0.00'); ?></td>
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                    <!--<div class="edit">-->
                                                                    <!--     <a  href="/Cash/endshift/<?php // echo $cd['id']; ?>" class="btn btn-sm btn-dark">End Of Shift</a>-->
                                                                    <!--</div>-->
                                                                    <div class="edit">
                                                                        <a  href="/Cash/cashdview/<?php echo (isset($cd['id']) ? $cd['id'] :''); ?>" class="btn btn-sm btn-violet">View</a>
                                                                    </div>
                                                                    <div class="edit">
                                                                        <a  href="/Cash/cashdedit/<?php  echo $cd['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                                                    </div>
                                                                    <!--<div class="remove">-->
                                                                    <!--    <button class="btn btn-sm btn-danger remove-item-btn "  data-rel-id="<?php // echo  (isset($cd['id']) ? $cd['id'] :''); ?>">Remove</button>-->
                                                                    <!--</div>-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                          <?php } ?>
                                                    </tbody>
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
                                            
                                           
                                        </div>
                                    </div><!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
            </div>
            <!-- end main content-->

       
      
       
        <script>
            $(document).on("click", ".remove-item-btn" , function() {
                var id = $(this).attr('data-rel-id');
                    Swal.fire({
                      title: "Are you sure?",
                      icon: "warning",
                      showCancelButton: !0,
                      confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                      cancelButtonClass: "btn btn-danger w-xs mt-2",
                      confirmButtonText: "Yes, delete it!",
                      buttonsStyling: !1,
                      showCloseButton: !0,
                  }).then(function (e) {
                      if (e.value) {
                        $.ajax({
                            type: "POST",
                            url: "/Cash/CashD/delete",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
      $('#cashDepositListDatatable').DataTable({
                pageLength: 100,
                "bLengthChange":false,
                "order": [],
                "columnDefs": [
                  {
                "targets": [0,2], 
                "type": "date-custom",
                "render": function (data, type, full, meta) {
                 if (type === "sort") {
                let parts = data.split('-');
                if (parts.length === 3) {
                    return '20' + parts[2] + '-' + parts[1] + '-' + parts[0];
                }
              }
            return data;
        }
    }
]
        });
        
       
      
        
        
        $(document).ready(()=>{
            setTimeout(()=>{
              $(".alert-success").fadeOut();   
            },7000);
            
            // $(".chnageTillStatus").on('change',(this)=>{
            //   console.log("ssss== ",$(this).val())  
            // })
        })
        </script>
    </body>

</html>