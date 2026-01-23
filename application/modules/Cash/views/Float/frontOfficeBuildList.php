<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
         
                     
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                  <h4 class="mb-sm-0 text-black">Front Counter Reset</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                              <a href="/Cash/frontOfficeBuildAdd" class="btn btn-primary"> <i class="ri-add-line align-bottom me-1"></i>New Count</a>
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="tillList">
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="floatListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="start_staff">Order No.</th>
                                                            <th class="sort" data-sort="start_staff">Date</th>
                                                            <th class="sort" data-sort="start_staff">Manager Name</th>
                                                           <th class="no-sort" >Status</th>
                                                           <th class="no-sort" >Total</th>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php if(!empty($frontOfficeBuildList)) { ?>
                                                        <?php foreach($frontOfficeBuildList as $cd){  if($cd['otherDetails']){ $rawDetails = unserialize($cd['otherDetails']); } ?>
                                                        <tr id="row_<?php echo  $cd['id']; ?>" >
                                                             <td class="manager_name"><?php echo $cd['id']; ?></td>
                                                            <td class="created_date"><?php echo date('d-m-Y',strtotime($cd['created_date'])); ?></td>
                                                             <td class="manager_name"><?php echo $rawDetails['manager_name']; ?></td>
                                                             <td class="orderStatus"><?php echo $cd['orderStatus']; ?></td>
                                                             <td class="amountInCashTotal"><?php echo "$".$cd['amountInCashTotal']; ?></td>
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                   
                                                                    <div class="edit">
                                                                        <a  href="<?php echo base_url(); ?>Cash/frontOfficeBuildAction/<?php echo $cd['id']; ?>/view" class="btn btn-sm btn-violet">View</a>
                                                                    </div>
                                                                    <!--<div class="edit">-->
                                                                    <!--    <a  href="<?php echo base_url(); ?>/frontOfficeBuildAction/<?php echo $cd['id']; ?>/edit" class="btn btn-sm btn-info">Edit</a>-->
                                                                    <!--</div>-->
                                                                    <!--<div class="remove">-->
                                                                    <!--    <button class="btn btn-sm btn-danger remove-item-btn "  data-rel-id="<?php echo  $cd['id']; ?>">Remove</button>-->
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
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
                    <!-- container-fluid -->
                </div>
              
            </div>
           
       
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
                            url: "DeletefrontOfficeBuild",
                            data:'id='+id,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
      $('#floatListDatatable').DataTable({
                pageLength: 100,
                "bLengthChange":false,
                "aaSorting": [[ 0, "desc" ]],
                
                "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false
                }]
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
 