<div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                          <div class="card-header">
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                     <h4 class="mb-sm-0 text-black"><?php echo ucfirst($float_type); ?> Float Count</h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                               <a href="/Cash/floatadd/<?php echo $float_type; ?>/<?php echo $tillId; ?>" class="btn btn-primary"> <i class="ri-add-line align-bottom me-1"></i>New Count</a>
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
                                                            <th >Date</th>
                                                            <th class="sort" data-sort="start_staff">Manager</th>
                                                            <th class="sort" data-sort="start_staff">Second Manager</th>
                                                            <th class="sort" data-sort="start_staff">Variance</th>
                                                            <th class="no-sort" >Action</th>
                                                        </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php  if(!empty($floatList)) {  ?>
                                                        <?php foreach($floatList as $cd){  if($cd['items_detail']){ $rawDetails = unserialize($cd['items_detail']);  } ?>
                                                        <tr id="row_<?php echo  $cd['id']; ?>" >
                                                            <td class="start_time"><?php echo date('d-m-Y',strtotime($rawDetails['start_time'])); ?></td>
                                                          <?php 
                                                        
                                                          $m2_managerVarience = (isset($cd['managerVarience']) ? $cd['managerVarience'] : '');
                                                          $varienceListpage =  ($cd['m2_of_fc_floatvarience'] =='disabled' ? $m2_managerVarience : $cd['m2_of_fc_floatvarience']); ?>
                                                            <td class="start_staff"><?php echo $rawDetails['staff_name']; ?></td>
                                                             <td class="start_staff"><?php echo $rawDetails['manager_name']; ?></td>
                                                              <td class="start_staff"><?php echo "$".number_format($varienceListpage,2); ?></td>
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                   
                                                                    <div class="edit">
                                                                        <a  href="<?php echo base_url(); ?>Cash/floatview/<?php echo $cd['id']; ?>/<?php echo $float_type; ?>" class="btn btn-sm btn-violet">View</a>
                                                                    </div>
                                                                    <!--<div class="edit">-->
                                                                    <!--    <a  href="<?php echo base_url(); ?>/floatedit/<?php echo $cd['id']; ?>/<?php echo $float_type; ?>" class="btn btn-sm btn-info">Edit</a>-->
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
                                    </div><!-- end card -->
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
                            url: "Floatbc/delete",
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
                "order": [],
                "columnDefs": [
                  {
                "targets": 0, 
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
   