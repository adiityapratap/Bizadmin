 <div class="main-content">
     <?php $this->session->unset_userdata('listtype');  ?>

                <div class="page-content">
                    <div class="container-fluid">
                    
           <div class="col-12">
               <div class="alert alert-success fade show" role="alert" style="display:none">
                  Data Added Succesfully
                    </div>
                    </div>
                      
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black"> Configurations </h4>
    
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end ">
                                         
                                            <div class="d-flex justify-content-sm-end gap-2">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-atoggle="modal" onclick="showModal('category','Category')"> <i class="ri-add-line fs-12 align-bottom me-1"></i>Add Category</button>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-atoggle="modal" onclick="showModal('servingSize','Serving Size')"> <i class="ri-add-line fs-12 align-bottom me-1"></i>Add Serving Size</button>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-atoggle="modal" onclick="showModal('prepAreas','Recipe Types')"> <i class="ri-add-line fs-12 align-bottom me-1"></i>Add Recipe Types</button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" onclick="showModal('uom','UOM')"> <i class="ri-add-line fs-12 align-bottom me-1"></i>Add UOM </button>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#flipIngredientModal"> <i class="ri-add-line fs-12 align-bottom me-1"></i>Add Ingredient</button> 
                                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#flipAllergenModal"> <i class="ri-add-line fs-12 align-bottom me-1"></i>Add Allergen</button> 
                                                
                                              
                                                
                                            </div>
                                        </div>
                                    </div>
    
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        
                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        
                        <?php if(isset($modulesInfo) && !empty($modulesInfo)) { $count = 1; ?>
                         <?php foreach($modulesInfo as $modulename => $moduleData) { 
                         $classActive = '';
                         if(isset($selectedlisttype) && $selectedlisttype !=''){
                         if($selectedlisttype == $modulename){
                          $classActive = 'active';  
                         }   
                         }else{
                         $classActive = ($count == 1 ? 'active' : '');      
                         }    
                        
                        ?>
                       <li class="nav-item">
                       <a class="nav-link py-3 <?php echo $classActive; ?>" data-bs-toggle="tab" href="#Tab<?php echo $modulename;  ?>" role="tab" aria-selected="false">
                       <i class="ri-checkbox-circle-line me-1 align-bottom"></i> <?php echo $moduleData['label'] ?></a>
                       </li>
                        <?php $count++; }  ?>
                        <?php }  ?>
                         </ul>         
                                        
                                          
                      <div class="tab-content mb-1"> 
                                    <?php if(isset($modulesInfo) && !empty($modulesInfo)) { $countD = 1; ?>      
                                    <?php foreach($modulesInfo as $modulename => $moduleData) {
                                       $classActiveShow = '';    
                                       if(isset($selectedlisttype) && $selectedlisttype !=''){
                                       if($selectedlisttype == $modulename){
                                        $classActiveShow = 'active show';  
                                        }   
                                       }else{
                                       $classActiveShow = ($countD == 1 ? 'active show' : '');      
                                      } 
                                   
                                    ?> 
                                         
                                            <div class="tab-pane table-responsive <?php echo $classActiveShow ?>" role="tabpanel"  id="Tab<?php echo $modulename;  ?>">
                                            <div class="table-responsive mb-1">
                                                <table class="table align-middle table-nowrap listDatatable" >
                                                    <thead class="table-dark">
                                                        <tr>
                                                            
                                                            <th class="sort" data-sort="category_name"><?php echo $moduleData['label'] ?> </th>
                                                            <?php if($modulename == 'allergens') { ?>
                                                            <th class="sort" data-sort="status">Allergen Type</th>
                                                            <?php } ?>
                                                            <?php if($modulename == 'ingredient') { ?>
                                                           
                                                            <th class="sort" data-sort="status">UOM</th>
                                                            
                                                            <?php } ?>
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all sortable">
                                                        <?php if(!empty($moduleData['tableData'])) {  ?>
                                                        <?php foreach($moduleData['tableData'] as $listtableData){  ?>
                                                        <tr id="row_<?php echo  $listtableData['id']; ?>" >
                                                        <td class="name"><?php echo $listtableData['name']; ?></td>
                                                        <?php if($modulename == 'allergens') { ?>
                                                        <td class="allergenType"><?php echo $listtableData['allergen_type']; ?></td>
                                                         <?php } ?>
                                                           <?php if($modulename == 'ingredient') { ?>
                                                       
                                                        <td class="uom"><?php echo $listtableData['uom_name']; ?></td>
                                                       
                                                            <?php } ?>
                                                            
                                                            
                                                            
                                            <!--                <td><div class="form-check form-switch form-switch-custom form-switch-success">-->
                                            <!--        <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $category['id']; ?>" <?php if(isset($category['status']) && $category['status']  == '1'){ echo 'checked'; }?>>-->
                                                    
                                            <!--    </div>-->
                                            <!--</td>-->
                                            
                                            
                                                           
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <?php if($modulename =='ingredient') {  ?>
                                                                        <a  href="<?= base_url('Recipe/editIngredient/' . $listtableData['id']) ?>" class="btn btn-sm btn-secondary edit-item-btn">
                                                                            <i class="ri-edit-box-line label-icon align-middle fs-12 me-2"></i>Edit</a>
                                                                            <?php }else if($modulename =='allergens'){ ?>
                                                                          <a  onclick="showAllergenEditModal('<?php echo $listtableData['name']; ?>',<?php echo $listtableData['id']; ?>,'<?php echo $listtableData['allergen_type']; ?>')" class="btn btn-sm btn-secondary edit-item-btn">
                                                                            <i class="ri-edit-box-line label-icon align-middle fs-12 me-2"></i>Edit</a>   
                                                                          <?php    } else {  ?>
                                                                      <a  onclick="showEditModal('<?php echo $listtableData['name']; ?>',<?php echo $listtableData['id']; ?>, '<?php echo $modulename ?>')" class="btn btn-sm btn-secondary edit-item-btn">
                                                                            <i class="ri-edit-box-line label-icon align-middle fs-12 me-2"></i>Edit</a>      
                                                                            <?php }  ?>
                                                                    </div>
                                                                    <div class="remove">
                                                                        <button class="btn btn-sm btn-danger remove-item-btn "  data-listtype="<?php echo  $modulename; ?>" data-rel-id="<?php echo  $listtableData['id']; ?>">
                                                                             <i class="ri-delete-bin-line label-icon align-middle fs-12 me-2"></i>Remove</button>
                                                                    </div>
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
                                            
                                     <?php $countD++; }  ?>
                                      <?php }  ?>        
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
 
        

        <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add category </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                             
                                                                <div>
                                                                    <label for="name-field" class="form-label modalLabel">Name</label>
                                                                    <input type="text"  name="input_config_name" id="input_config_name" class="form-control" required="">
                                                                <div class="invalid-feedback configNameError" style="display:none">
                                                                    Please enter name
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <input type="hidden" name="listtype" id="menuListType">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtoncategory" onclick="addMenuConfig()">Add </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
                                                
                                                
        <div id="flipEditModal" class="modal fade flip"  role="dialog">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title editmodalTitle" id="exampleModalLabel">Update Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                
                                                                <div>
                                                                    <label for="name-field" class="form-label editmodalLabel">Category Name</label>
                                                                    <input type="hidden" id="configIdToUpdate" value="">
                                                                    <input type="text" id="edited_input_config_name" class="form-control" placeholder="Enter value" required="">
                                                                <div class="invalid-feedback configNameError" style="display:none">
                                                                    Please enter category name
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <input type="hidden" name="listtype" id="menuListTypeEdit">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtonCategory" onclick="updateConfig()">Save </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
                                                
       <div id="flipIngredientModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header bg-soft-info p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Ingredient </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field">
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                             <label for="name-field" class="form-label modalLabel">Ingredient Name</label>
                                                              <input type="text"  name="ingredient_name" id="ingredient_name" class="form-control" required="">
                                                                <div class="invalid-feedback configNameError" style="display:none">Please enter ingredient name </div>
                                                             </div>
                                                         </div>
                                                         
                                                         
                                                         
                                                        <div class="row g-3 mt-2">
    <div class="col-lg-12">
        <select class="form-select" id="uomId">
            <?php if (isset($uomListData) && !empty($uomListData)) { ?>
                <option value="">Select UOM</option>
                <?php foreach ($uomListData as $key => $uomList) { ?>
                    <option value="<?php echo $uomList['id']; ?>" <?php echo $key === 0 ? 'selected' : ''; ?>>
                        <?php echo $uomList['name']; ?>
                    </option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
                                                         
                                                          <div class="row g-3 mt-2 d-none">
                                                            <div class="col-lg-12">
                                                             <label for="name-field" class="form-label modalLabel">Ingredient Cost</label>
                                                              <input type="text"  name="cost" id="ingredient_cost" class="form-control" required="">
                                                                <div class="invalid-feedback configNameError" style="display:none">Please enter ingredient cost </div>
                                                             </div>
                                                         </div>
                                                          <div class="row g-3 mt-2">
            <div class="col-lg-12  d-none">
                <label for="uomqty" class="form-label modalLabel">UOM Qty</label>
                <input type="text" name="uomqty" id="uomqty" class="form-control" value="1000" readonly>
            </div>
        </div>
                                                         
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <input type="hidden" name="listtype" id="menuListType">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green submitButtoncategory" onclick="addIngredients(this)">Add </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
                                                
        <div id="flipAllergenModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Allergen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id-field">
                    
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="allergen_name" class="form-label modalLabel">Allergen Name (e.g., Milk (Dairy))</label>
                            <input type="text" name="allergen_name" id="allergen_name" class="form-control" required>
                            <div class="invalid-feedback" style="display:none">Please enter allergen name</div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-lg-12">
                            <label for="allergen_type" class="form-label modalLabel">Allergen Type (e.g., Tree Nuts)</label>
                            <input type="text" name="allergen_type" id="allergen_type" class="form-control" required>
                            <div class="invalid-feedback" style="display:none">Please enter allergen type</div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="display: block;">
                    <div class="hstack gap-2 justify-content-end">
                        <input type="hidden" name="listtype" id="menuListType">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                         <input type="hidden" name="allergen_id" id="allergen_id" class="form-control" >
                        <button type="button" class="btn btn-green submitButtoncategory" onclick="addAllergen(this)">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>                                        

     
      
       
        <script>
    
    function showModal(listType,label){
        $(".modal-title").html('Add '+label)
        $(".modalLabel").html(label+' Name');
        $("#menuListType").val(listType);
       $("#flipModal").modal('show'); 
       
    }    
     $(document).on("click", ".remove-item-btn" , function() {
                let id = $(this).attr('data-rel-id');
                let listType = $(this).attr('data-listtype');
                if(listType =='ingredient'){
                    tablename ='Recipe_ingredients';
                }else{
                    tablename = 'Recipe_recipebuilder_configs'
                }
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
                           url: 'deleteRecipeConfigs',
                            data: 'id='+id+'&is_deleted=1&tablename='+tablename,
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
            
            
      $('.listDatatable').DataTable({
                pageLength: 100,
                bPaginate: false,
                bInfo : false,
                lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
                ordering: false
        });
        
        function showEditModal(configName, configId, listtype) {
    $("#edited_input_config_name").val(configName);
console.log("listtype ",listtype)
    if (typeof listtype === 'string' && listtype.length > 0) {
        console.log("listtype Inner",listtype)
        let capitalizedlisttype = listtype[0].toUpperCase() + listtype.substring(1);
        $("#menuListTypeEdit").val(listtype);
        $(".editmodalTitle").html('Update ' + capitalizedlisttype);
        $(".editmodalLabel").html(capitalizedlisttype + ' Name');
    } else {
        console.warn('Invalid listtype provided:', listtype);
        $("#menuListTypeEdit").val('');
        $(".editmodalTitle").html('Update');
        $(".editmodalLabel").html('Name');
    }

    $("#configIdToUpdate").val(configId);
    $("#flipEditModal").modal('show');
}

        
        function showAllergenEditModal(allergen_name,allergen_id,allergen_type){
            
            $('#allergen_type').val(allergen_type);
            $('#allergen_name').val(allergen_name);
            $('#allergen_id').val(allergen_id);
            
           $("#flipAllergenModal").modal('show');
        }
        function addMenuConfig(){
            let configName = $("#input_config_name").val();
            let listType = $("#menuListType").val()
            if(configName == ''){
               $(".configNameError").show();
               return false;
            }else{
                $(".submitButtoncategory").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "saveConfigsdata",
                 data: 'name=' + configName + '&listtype=' + listType, 
                 success: function(data){
                    location.reload();
                }
                });
        }
        function updateConfig(){
            let configName = $("#edited_input_config_name").val();
            let listType = $("#menuListTypeEdit").val()
            let id = $("#configIdToUpdate").val();
            
            if(configName == ''){
               $(".configNameError").show();
               return false;
            }else{
                $(".submitButtonCategory").html("Loading...")
            }
            $.ajax({
                 type: "POST",
                 url: "updateConfig",
                  data: 'name=' + configName + '&listtype=' + listType+'&id='+id,
                 success: function(data){
                    location.reload();
                }
                });
        }
        
        $(document).ready(()=>{
            setTimeout(()=>{
              $(".alert-success").fadeOut();   
            },7000);
        })
        
        
    function addIngredients(obj) {
    $(obj).html("Saving...");
    const ingredientName = $('#ingredient_name').val();
    // const categoryId = $('#categoryId').val();
    const uomId = $('#uomId').val();
    // const cost = $('#ingredient_cost').val();
    //  const uomqty = $('#uomqty').val();

  
    if (!ingredientName ) {
        alert('Please fill in all fields.');
        return;
    }
  console.log("ingredientName",ingredientName)
    
    $.ajax({
    url: 'saveIngredients',
    type: 'POST',
    data: {
        ingredient_name: ingredientName,
        uom_id: uomId,
    },
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            alert('Ingredient added successfully!');
            $('#flipIngredientModal').modal('hide');
            $(obj).html("Save");
            location.reload();
        } else {
            alert(response.message || 'Failed to add ingredient.');
        }
    },
    error: function(xhr, status, error) {
        alert('An error occurred: ' + (xhr.responseJSON?.message || 'Please try again.'));
    }
});
}

      function addAllergen(obj) {
      $(obj).html("Saving...");
    const allergen_type = $('#allergen_type').val();
    const allergen_name = $('#allergen_name').val();
    const allergen_id =  $('#allergen_id').val();
    if (!allergen_type || !allergen_name) {
        alert('Please fill in all fields.');
        return;
    }

    $.ajax({
        url: 'saveAllergen', 
        type: 'POST',
        data: {
            allergen_type: allergen_type,
            allergen_name: allergen_name,
            allergen_id: allergen_id,
        },
        dataType: 'json',
        success: function(response) {
            
             location.reload();
            let res  = JSON.parse(response);
            if (res.success) {
                alert('Allergen added successfully!');
                $('#flipAllergenModal').modal('hide'); 
                $(obj).html("Save");
            } else {
                alert(res.message || 'Failed to add ingredient.');
            }
        },
        error: function() {
            alert('An error occurred. Please try again.');
        }
    });
}

        
    $(function() {
    // Make the table rows sortable
    $(".sortable").sortable({
      
        update: function(event, ui) {
            let sortOrder = $(this).sortable("toArray", { attribute: "id" });
            $.ajax({
                url: "updateSortOrder",
                type: "POST",
                data: { order: sortOrder },
                success: function(response) {
                    console.log("Order updated successfully");
                },
                error: function() {
        
                    console.log("Error updating order");
                }
            });
        }
    });
    
});
    
        </script>
 