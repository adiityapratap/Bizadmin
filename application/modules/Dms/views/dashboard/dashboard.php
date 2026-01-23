<div class="container-fluid mb-5" style="margin-top: 130px !important;">
   <div class="row">
                        <div class="col-12 tempDiv">
                        
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 text-faded">  🗓 <?php echo date('d-m-Y') ?></h4>
                                    
                                    <div class="flex-shrink-0">
                                        
                                         <select class="form-select folderDropdown">
                                             <option selected> Select Folder</option>
                                                <!--<?php if(!empty($allFolders)) { $count =0; foreach($allFolders as $allFolder) {  $selected = ($count == 0 ? 'selected' : ''); ?>-->
                                                <option <?php //echo $selected; ?> class="dropdown-item" href="#" value="<?php echo $allFolder['id'] ?>"><?php echo $allFolder['folder_name'] ?></option>
                                                <?php $count++; } } ?>
                                       </select>
                                    </div>
                                   
                                </div><!-- end card header -->
                                
                               
                                <div class="card-body">
                                
                                <div class="table-responsive table-card">
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                            <thead class="table-light">
                                                <tr class="text-muted">
                                                    <th scope="col" style="width: 25%;">Document Name</th>
                                                    <th scope="col" style="width: 25%;">Date Created</th>
                                                    <th scope="col" style="width: 25%;">Roles</th>
                                                    <th scope="col" style="width: 5%;">Action</th>
                                                </tr>
                                            </thead>
                                         <?php    
                                         
                                       
                                        
                                         if(isset($allFolders) && !empty($allFolders)){  ?>
                                       
                                          <?php  foreach($allFolders as $allFolder) { ?>

                                           <?php  foreach($dashboardData as $docData) {  
                                         
                                           ?>
                                            <?php  if(isset($docData) && !empty($docData) && $docData['folder_id'] == $allFolder['id']) { ?>
                                            
                                            <?php 
                                            // subfolder Permission
                                               $subFolderAccessRoleIds = explode(',', $docData['subFolderRoleIds']);
                                                $groupNames = array_map(function ($groupId) {
                                                $group = $this->ion_auth->group($groupId)->row();
                                                return $group ? $group->name : "";
                                               }, $subFolderAccessRoleIds);
                                               
                                               // check folder permission
                                               // folder Permission
                                                $FoldergroupIdsArray = explode(',', $docData['folderRoleIds']);
                                                 
                                                $FoldergroupNames = array_map(function ($groupId) {
                                                $Foldergroup = $this->ion_auth->group($groupId)->row();
                                                return $Foldergroup ? $Foldergroup->name : "";
                                               }, $FoldergroupIdsArray);
                                               
                                               ?>
                                           <?php if(in_array($currentUserRoleId,$subFolderAccessRoleIds)) {  ?>                  
                                            <tbody class="folder_<?php echo $allFolder['id'] ?> d-none tbodySite" >
                                        <?php  if($docData['subfolder_name'] !=''){ ?>
                                        <th colspan="8" class="text-black w-100 " style="background-color: #dff0fa;"> <b><?php echo $docData['subfolder_name']; ?></b></th> 
                                        <?php  } ?>
                                        
                                              <?php  foreach($docData['documents'] as $documents) {  ?> 
                                              
                                              <?php $documentsID = $documents['id'];
                                              $fileName= $documents['file_name'];
                                              ?>
                                                 <tr>
                                                  <input type="hidden" name="equip_id" value="<?php echo $documentsID; ?>">     
                                                    <td><?php echo (isset($documents['file_display_name']) ? $documents['file_display_name'] : ''); ?></td>
                                                    <td><?php echo (isset($documents['created_date']) ? date('d-m-Y',strtotime($documents['created_date'])) : ''); ?></td>
                                                     <td><?php echo implode(',', $groupNames); ?> </td>
                                                    <td><a class="btn btn-sm btn-success" href="<?php echo $file_path . $fileName; ?>"  target="_blank">View Document</a></td>
                                                </tr>
                                                
                                            <?php } ?>
                                            
                                           </tbody>
                                            <?php }  ?>
                                            <?php } } ?>
                                            
                                            <!--// for documents wch are not under any sub folder-->
                                            
                                            <?php 
                                           
                                            
                                            foreach($DocsWithoutSubFolder as $docDataWithoutSubFolder) {    ?>
                                            <?php  if(isset($docDataWithoutSubFolder) && !empty($docDataWithoutSubFolder) && $docDataWithoutSubFolder['folder_id'] == $allFolder['id']) {
                                             $FoldergroupIdsArray = explode(',', $docDataWithoutSubFolder['folderRoleIds']);
                                            
                                           
                                            ?>
                                            <?php if(in_array($currentUserRoleId,$FoldergroupIdsArray)) {  ?>
                                            <tbody class="folder_<?php echo $allFolder['id'] ?>  tbodySite" >
                                        <?php  if($docDataWithoutSubFolder['folder_name'] !=''){ ?>
                                        <th colspan="8" class="text-black w-100 " style="background-color: #dff0fa;"> <b><?php echo $docDataWithoutSubFolder['folder_name']; ?></b></th> 
                                        <?php  } ?>
                                        
                                              <?php 
                                              foreach($docDataWithoutSubFolder['documents'] as $documentsWithoutSubfolder) {  ?> 
                                              <?php $documentsID = $documentsWithoutSubfolder['id'];
                                              $fileName= $documentsWithoutSubfolder['file_name'];
                                              ?>
                                                 
                                                 <tr>
                                                  <input type="hidden" name="equip_id" value="<?php echo $documentsID; ?>">     
                                                    <td><?php echo (isset($documentsWithoutSubfolder['file_display_name']) ? $documentsWithoutSubfolder['file_display_name'] : ''); ?></td>
                                                    <td><?php echo (isset($documentsWithoutSubfolder['created_date']) ? date('d-m-Y',strtotime($documentsWithoutSubfolder['created_date'])) : ''); ?></td>
                                                    <td><?php echo implode(',', $FoldergroupNames); ?> </td>
                                                    <td><a class="btn btn-sm btn-success" href="<?php echo $file_path . $fileName; ?>"  target="_blank">View Document</a></td>
                                                </tr>
                                                
                                            <?php } ?>
                                           </tbody>
                                            <?php }  ?>
                                            <?php } } ?>
                                            
                                            
                                            
                                            
                                           
                                            <?php }   ?>
                                              <?php }   ?>
                                        </table><!-- end table -->
                                    </div>    
                                    
                                  
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                       <!-- end col -->
                      
                    </div>
                    
                     
       
         </div>
         
         <script>
         
         $(".folderDropdown").on('change',function(){
    let folderId = $(this).val();
    localStorage.setItem('selectedfolderDashBoard',folderId);
     $(".tbodySite").each(function(index, element) {
    if (!$(element).hasClass("d-none")) {
        console.log($(element).val());
        $(element).addClass("d-none");
    }
});
console.log("folderId",folderId)
$(".folder_"+folderId).removeClass("d-none");
})

         </script>
                                         
         
                            
                                       