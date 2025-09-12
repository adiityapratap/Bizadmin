<style>
.table td {
    width: 10%; 
}
/* CSS to make the table header fixed */
.fixed-table-header {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 999;
    background-color: #fff; /* Background color of the fixed header */
}

</style>

<div class="container-fluid mb-5" style="margin-top: 130px !important;">
   <div class="row">
       
                        <div class="col-12 tempDiv">
                             <div class="card">
                                <div class="card-header align-items-center d-flex">
                                   
                                    
                                    <div class="flex-shrink-0">
                                        
                                        
                                    </div>
                                    <!--<i class='ri-file-download-fill mx-2' style='font-size:32px;' onclick="showExceedTemp()"></i>-->
                                    <a onclick="goBack()" class="btn bg-orange waves-effect btn-label waves-light">
                                                      <i class="ri-reply-fill label-icon align-middle fs-16 me-2">
                                                      
                                                  </i><span>Back</span></a>  
                                                  
                                                    
                                </div><!-- end card header -->
                                
                               
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <?php $dateCount = 0;
                                     
                                        
                                        foreach($uniqueDates as $dateToFind) {  ?>
                                        
                           <?php if(isset($weeklyHistoryData[$dateToFind]) && !empty($weeklyHistoryData[$dateToFind])){      ?>
                           <h4 class="card-title mb-0 flex-grow-1 text-faded mt-4 mb-4 px-4 text-center"><?php echo date('d-m-Y',strtotime($dateToFind)) ?></h4>
  <?php  foreach($weeklyHistoryData[$dateToFind] as $TaskList) { $attachments= (isset($TaskList['attachment']) && $TaskList['attachment'] !='' ? unserialize($TaskList['attachment']) : '');   ?>
                             <div id="attachmentTaskModal_<?php echo $TaskList['id']; ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                               <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Attachments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                         </div>
                      <div class="modal-body appendAttachment">
                       <div class="card">
                          <div class="card-body">
                                        <div class="swiper pagination-progress-swiper rounded">
                                            <div class="swiper-wrapper">
                                                <?php if(!empty($attachments)) {  ?>
                                                <?php foreach($attachments as $attachment) {  ?>
                                                <div class="swiper-slide">
                                                    <img src="/uploaded_files/<?php echo $this->session->userdata('tenantIdentifier'); ?>/Clean/CleaningAttachments/<?php echo $attachment ?>" alt="" class="img-fluid" style="width: 100%;"/>
                                                </div>
                                              <?php } } ?>
                                            </div>
                                            <div class="swiper-button-next bg-white shadow"></div>
                                            <div class="swiper-button-prev bg-white shadow"></div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div><!-- end card-body -->
                            </div><!-- end card --> 
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
                            </div>
                             <?php } ?>
                             <?php } ?>
                                 
                                 
                                        
                                        
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0 table-bordered">
                                            <?php if($dateCount ==0){ $dateCount++; ?>  
                                            <thead class="table-light fixed-table-header">
                                                <tr class="text-muted">
                                                    <th scope="col">Task Name</th>
                                                    <th scope="col">Record By</th>
                                                    <th scope="col" >Record At </th>
                                                    <th scope="col">Entered By </th>
                                                     <th scope="col">Staff Comments</th>
                                                  
                                                    <th scope="col">Attachments</th>
                                                    
                                                </tr>
                                            </thead>
                                            <?php } ?>
                                         <?php    
                                         
                                         if(isset($weeklyHistoryData[$dateToFind]) && !empty($weeklyHistoryData[$dateToFind])){  ?>
                                         
                                         <?php  foreach($weeklyHistoryData[$dateToFind] as $Task) {    ?>
                                           
                                           <tbody class="site  tbodySite" >
                                               
                                        <th colspan="9" class="text-black w-100 " style="background-color: #07070b2e;"> <b><?php echo $Task['prep_name']; ?></b></th> 
                                         <?php $TaskIdToFind = $Task['id']; 
                                                   $task_time  = $Task['entered_time'];
                                                   $entered_time  = $Task['entered_time'];
                                                   $entered_by  = $Task['entered_by'];
                                                   $staffComment = $Task['staff_comments'];
                                                    $attachments = unserialize($Task['attachment']);          
                                             ?>
                                             
                                                <tr>
       <td><?php echo (isset($Task['task_name']) ? $Task['task_name'] : ''); ?></td>
       <td ><?php echo (isset($task_time) && $task_time !='' ? date('h:i a',strtotime($task_time)) : ''); ?></td>
       <td ><?php echo (isset($entered_time) && $entered_time !='' ? date('h:i a',strtotime($entered_time)) : '') ?> </td>
      
      
       <td><?php echo $entered_by ?></td>
        <td ><?php echo $staffComment ?> </td>
      
       <td ><a onclick="showAttachment('<?php echo $TaskIdToFind; ?>')" class="btn btn-sm btn-green">View</a></td>
        </tr>
        
                   
  
                                                
                                           
                                           </tbody>
                                         
                                             
                                            
                                          <?php  } ?>
                                           
                                           
                                              <?php }   ?>
                                        </table>
                                        <?php    } ?>
                                        
                                        
     <!------------------------------------------------TABLE FOR TEMP VIEW --------------------------------------------------------------------------- -->
                                        
                                      
                                    </div><!-- end table responsive -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                             </div>
                            </div>
                            </div>


                            <script>
                         

function showAttachment(taskId){
    
   $("#attachmentTaskModal_"+taskId).modal('show');
   
}
                           
//                           // JavaScript to make the table header fixed while scrolling
// window.addEventListener('scroll', function () {
//     var header = document.querySelector('.fixed-table-header');
//     var table = document.querySelector('.table');
    
//     if (header && table) {
//         var rect = table.getBoundingClientRect();
//         var topOffset = rect.top;

//         if (topOffset <= 0) {
//             header.style.transform = 'translateY(0)';
//         } else {
//             header.style.transform = 'translateY(-' + topOffset + 'px)';
//         }
//     }
// });
 
                            </script>
                            