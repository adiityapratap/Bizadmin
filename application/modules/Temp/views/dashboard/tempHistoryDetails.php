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
                                    
                                     <h4 class="card-title mb-0 flex-grow-1 text-faded ">
                                         <button type="button" class="btn btn-success waves-effect waves-light shadow-none custom-toggle" data-bs-toggle="button" aria-pressed="false">
                                                        <span class="icon-on"><i class="ri-subtract-line align-bottom me-1"></i> View All</span> 
                                                        <span class="icon-off"><i class="ri-add-line align-bottom me-1"></i>View Temp</span>
                                                    </button></h4>
                                                  <a href="/Temp/home/tempHistory" class="btn bg-orange waves-effect btn-label waves-light">
                                                      <i class="ri-reply-fill label-icon align-middle fs-16 me-2">
                                                  </i><span>Back</span></a>  
                                                <a href="#" class="btn btn-success waves-effect btn-label waves-light mx-2" onclick="updateTempHistoryForm()">
                                                      <i class="ri-save-fill label-icon align-middle fs-16 me-2">
                                                      
                                                  </i><span>Update</span></a>   
                                                    
                                </div><!-- end card header -->
                                
                               
                                <div class="card-body">
                                       <?php if(isset($weeklyTempData) && !empty($weeklyTempData)) {  ?>
                                    <div class="table-responsive table-card">
                                        <?php $dateCount = 0; foreach($uniqueDates as $dateToFind) {  ?>
                                        <?php 
                                             $isDateExist = array_filter($weeklyTempData, function ($dayData) use ($dateToFind) {
                                               return array_filter($dayData, function ($equipData) use ($dateToFind) {
                                                 return $equipData['date_entered'] == $dateToFind;
                                                });
                                               });
                                              
                                               
                                                ?>
                                        <?php if(!empty($isDateExist)) {   ?>        
                                        <h4 class="card-title mb-0 flex-grow-1 text-faded mt-4 mb-4 px-4 text-center allViewT d-none"><?php echo date('d-m-Y',strtotime($dateToFind)) ?></h4>
                                    
                                    
                            <?php if(isset($site_detail) && !empty($site_detail)){  ?>       
                             <?php  foreach($site_detail as $AllSites) { ?>
                             <?php  foreach($EquipListForDash as $EquipList) {    ?>   
                             
                             <?php  if(isset($EquipList) && !empty($EquipList) && $EquipList['site_id'] == $AllSites['id']) { ?>
                             <?php  foreach($EquipList['equipments'] as $Equip) {  ?> 
                            <?php $equipIdToFind = $Equip['id']; ?> 
                           <?php 
                           
                            $filteredData = array();
                            
                            foreach($weeklyTempData as $dayData){
                              foreach($dayData as $equipData){    
                               if($equipData['date_entered'] == $dateToFind && $equipData['equip_id'] == $equipIdToFind){
                              $filteredData[] =   $equipData;  
                               } 
                                }
                            }   
                             
                             if(!empty($filteredData)){
                             foreach ($filteredData as $key => $value) {
                               $attachments =  (isset($value['attachment']) && $value['attachment'] !='' ? unserialize($value['attachment']) : '');
                       
                             }
                                     ?>                   
                                                   
                             <div id="attachmentEquipModal_<?php echo $equipIdToFind; ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                    <img src="/uploaded_files/<?php echo $this->session->userdata('tenantIdentifier') ?>/Temp/TemperatureAttachments/<?php echo $attachment ?>" alt="" class="img-fluid" style="width: 100%;"/>
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
                                <?php } ?>
                                 <?php } ?>
                                  <?php } ?>
                                  <?php } ?>       
                                        
                                        
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0 table-bordered allViewT d-none">
                                            <?php if($dateCount ==0){ $dateCount++; ?>  
                                            <thead class="table-light fixed-table-header">
                                                <tr class="text-muted">
                                                    <th scope="col">Equipment</th>
                                                    <th scope="col">Record By</th>
                                                    <th scope="col" >Record At </th>
                                                    <th scope="col">Old Degree/Secs</th>
                                                    <th scope="col">New Degree/Secs</th>
                                                    <th scope="col">Entered By </th>
                                                     <th scope="col">Staff Comments</th>
                                                    <th scope="col">Manager Comments</th>
                                                    <th scope="col">Attachments</th>
                                                    
                                                </tr>
                                            </thead>
                                            <?php } ?>
                                         <?php    
                                         
                                         if(isset($site_detail) && !empty($site_detail)){  ?>
                                       
                                          <?php  foreach($site_detail as $AllSites) { ?>
                                          
                                           <?php  foreach($EquipListForDash as $EquipList) {    ?>
                                           
                                            <?php  if(isset($EquipList) && !empty($EquipList) && $EquipList['site_id'] == $AllSites['id']) { ?>
                                            <tbody class="site_<?php echo $AllSites['id'] ?>  tbodySite" >
                                               
                                        <th colspan="9" class="text-black w-100 " style="background-color: #07070b2e;"> <b><?php echo $EquipList['prep_name']; ?></b></th> 
                                        
                                              <?php  foreach($EquipList['equipments'] as $Equip) {  ?> 
                                              
                                              <?php $equipIdToFind = $Equip['id']; ?>
                                              
                                              <?php 
                                              $filteredData = array();
                                              
                                                  
                                               
                                               foreach($weeklyTempData as $dayData){
                                               foreach($dayData as $equipData){    
                                                  if($equipData['date_entered'] == $dateToFind && $equipData['equip_id'] == $equipIdToFind){
                                                  $filteredData[] =   $equipData;  
                                                  } 
                                               }
                                               }
                                                // echo $dateToFind;
                                                // echo $equipIdToFind;
                                                // echo $equipIdToFind;
                                                //  echo "<pre>";print_r($PrepAreavalue); exit;
                                                
                                              
                                                if(!empty($filteredData)){
                                                   foreach ($filteredData as $value) {
                                                    
                                                      
                                                   $equip_time  = (isset($value['equip_time']) ? $value['equip_time'] :'');
                                                   $entered_time  = (isset($value['entered_time']) ? $value['entered_time'] :'');
                                                   $equipTemp  = (isset($value['equip_temp']) ? $value['equip_temp'] :'');
                                                   $correctedTemp  = (isset($value['correctedTemp']) ? $value['correctedTemp'] :'');
                                                   $entered_by  = (isset($value['entered_by']) ? $value['entered_by'] :'');
                                                   $staffComment = (isset($value['staff_comments']) ? $value['staff_comments'] :'');
                                                   $managerComment = (isset($value['manager_comments']) ? $value['manager_comments'] :'');
                                                    $attachments = (isset($value['attachment']) ? unserialize($value['attachment']) :'');    
                                                   }
                                                  
                                                }else{
                                                  $equip_time = '';  $entered_time ='';$correctedTemp='';
                                                  $equipTemp = ''; $entered_by = '';
                                                  $staffComment='';$managerComment='';
                                                }
                                               ?>
                                             
                                                <tr>
       <td><?php echo (isset($Equip['equip_name']) ? $Equip['equip_name'] : ''); ?></td>
       <td ><?php echo (isset($equip_time) && $equip_time !='' ? date('h:i a',strtotime($equip_time)) : ''); ?></td>
       <td ><?php echo (isset($entered_time) && $entered_time !='' ? date('h:i a',strtotime($entered_time)) : '') ?> </td>
       <td><?php echo $equipTemp ?></td>
       <td><?php echo $correctedTemp ?></td>
       <td><?php echo $entered_by ?></td>
        <td ><?php echo $staffComment ?> </td>
       <td ><?php echo $managerComment ?> </td>
       <td ><a onclick="showAttachment('<?php echo $equipIdToFind; ?>')" class="btn btn-sm btn-green">View</a></td>
        </tr>
        
                   
  
                                                
                                            <?php } ?>
                                           </tbody>
                                            <?php } ?>
                                             
                                            
                                          <?php  } ?>
                                           
                                            <?php }   ?>
                                              <?php }   ?>
                                        </table>
                                        <?php }   } ?>
                                        
                                        
     <!------------------------------------------------TABLE FOR TEMP VIEW --------------------------------------------------------------------------- -->
                                        <form id="tempHistoryForm" action="/Temp/home/tempHistoryFormUpdate" method="post">
                                            <input type="hidden" name="dateRange" value="<?php echo $dateRange ?>">
                                             <input type="hidden" name="site_id" value="<?php echo $site_id ?>">
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0 table-bordered tempViewT">
                                            <thead class="table-light">
                                                <tr class="text-muted">
                                                <th scope="col">Equipment</th>    
                                                 <?php  foreach($uniqueDates as $dateToFind) {  ?>    
                                                 <th scope="col" ><?php echo date('d-m-Y',strtotime($dateToFind)) ?></th>
                                                   <?php }   ?> 
                                                    </tr>
                                                    </thead>
                                          <?php   foreach($EquipListForDash as $EquipList) {    ?>          
                                                <tbody class="tbodySite" >
   <th colspan="8" class="text-black w-100 " style="background-color: #07070b2e;"> <b><?php echo $EquipList['prep_name']; ?></b></th> 
     <?php  foreach($EquipList['equipments'] as $Equip) {  ?> 
     <?php $equipIdToFind = $Equip['id']; ?>
      <tr>
            <td><?php echo (isset($Equip['equip_name']) ? $Equip['equip_name'] : ''); ?></td>
          <?php foreach($uniqueDates as $dateToFind) {  ?> 
           <?php 
           $filteredData = array();
            foreach($weeklyTempData as $dayData){
             foreach($dayData as $equipData){    
             if($equipData['date_entered'] == $dateToFind && $equipData['equip_id'] == $equipIdToFind){
             $filteredData[] =   $equipData;  
             } 
            }
           }
            //  echo "<pre>"; print_r($weeklyTempData); exit;   
         if(!empty($filteredData)){
            
            foreach ($filteredData as $key => $value) {
             $equipTemp  = $value['equip_temp'];
             $recordTempId  = $value['id'];
             $site_id  = $value['site_id'];
             $prep_id  = $value['prep_id'];
             $equip_id  = $value['equip_id'];
             } 
            }else{
            $equipTemp = ''; $site_id='';$prep_id='';$equip_id='';
            }        
             ?>
          <td><input type="text" name="temp_<?php echo $EquipList['site_id'] ?>_<?php echo $EquipList['prep_id'] ?>_<?php echo $equipIdToFind ?>_<?php echo $dateToFind; ?>" value="<?php echo $equipTemp; ?>"></td>
          <?php }   ?> 
          </tr>
           <?php }   ?> 
             </tbody>   
             
               <?php }   ?> 
               </table>
               </form>
                                        <!-- end table -->
                                    </div><!-- end table responsive -->
                                      <?php } else {  ?>
                    <h3 class="text-black">No result found for this date range/site</h3>
                     <?php }   ?>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                             </div>
                            </div>
                            </div>


                            <script>
                           $(document).ready(function() {
    
    $('.custom-toggle').on('click', function() {
      
        $('.allViewT').toggleClass('d-none');
        $('.tempViewT').toggleClass('d-none');
    });
});

function showAttachment(equipID){
    
   $("#attachmentEquipModal_"+equipID).modal('show');
   
}
function updateTempHistoryForm(){
    $("#tempHistoryForm").submit();
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
                            