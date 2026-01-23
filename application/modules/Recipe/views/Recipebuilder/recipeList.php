<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="alert alert-success fade show" role="alert" style="display:none">
                    Data Added Successfully
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        
        <!-- Title -->
        <h4 class="mb-0 text-black flex-grow-1">Recipes</h4>

        <!-- Search box -->
        <div class="flex-grow-1">
            <input type="text" id="recipeSearch" class="form-control w-75" placeholder="Search recipe name...">
        </div>

        <!-- Add New Recipe Button -->
        <div>
            <a href="<?= base_url('Recipe/newRecipeForm') ?>" class="btn btn-primary btn-md">
                <i class="ri-add-line fs-14 align-bottom me-1"></i> Add New Recipe
            </a>
        </div>

    </div>
</div>


                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link py-3 active" data-bs-toggle="tab" href="#recipes" role="tab">
                                        Recipes Details
                                    </a>
                                </li>
                                
                              
                            </ul>

                            <div class="tab-content p-3">
                                <div class="tab-pane table-responsive  active" id="recipes" role="tabpanel">
                                  <div class="table-responsive mb-1">  
                                  <table class="table align-middle table-nowrap " id="listDatatable" >
                                        <thead class="table-dark">
                                            <tr>
                                              
                                                <th>Recipe name</th>
                                                <th>Cooking time</th>
                                                <th data-sort="role">Role</th>
                                                <th>Difficulty</th>
                                                <?php  if(isset($isDashboard) &&  $isDashboard== false) { ?>
                                                <th>Cost</th>
                                                <?php } ?>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                       <tbody id="sortable">
    <?php if (!empty($recipes) && is_array($recipes)) : ?>
        <?php foreach ($recipes as $preAreaname => $recipeList) : ?>
            <?php if (!is_array($recipeList)) continue; ?>
            
           
            
            <tr class="prep-area">
                <th colspan="8" class="text-black w-100 bg-secondary-subtle">
                    <b><?php echo htmlspecialchars($preAreaname); ?></b>
                </th>
            </tr>
            <?php foreach ($recipeList as $recipe) : ?>
                <?php if (!is_array($recipe)) continue; ?>
                
                 <?php 
            $role_ids = unserialize($recipe['role_id']);
                $role_names = [];

                // Fetch role names using Ion Auth
                if (!empty($role_ids) && is_array($role_ids)) {
                    $this->load->library('ion_auth'); // Ensure Ion Auth library is loaded
                    foreach ($role_ids as $role_id) {
                        $group = $this->ion_auth->group($role_id)->row();
                        if ($group) {
                            $role_names[] = $group->name;
                        }
                    }
                }

                // Join role names with commas
                $role_display = !empty($role_names) ? implode(', ', $role_names) : '-';
            
            ?>
            
                <tr id="row_<?php echo (int) $recipe['id']; ?>">
                    <td class="recipeNameTd"><?php echo htmlspecialchars($recipe['recipeName']); ?></td>
                    <td><?php echo htmlspecialchars($recipe['cookingTime']); ?></td>
                    <td class="descr text-wrap handle"><?php echo $role_display; ?></td>
                    <td><?php echo htmlspecialchars($recipe['difficulty']); ?></td>
                    
                    <?php if (isset($isDashboard) && $isDashboard === false) : ?>
                        <td>$<?php echo number_format((float)$recipe['totalCost'], 2); ?></td>
                    <?php endif; ?>
                    
                    <td>
                        <a href="<?php echo base_url('Recipe/viewRecipe/s/' . (int)$recipe['id']); ?>" class="btn btn-sm btn-success">
                            <i class="ri-eye-line label-icon align-middle fs-12 me-2"></i>Staff View Recipe
                        </a>

                        <?php if (isset($isDashboard) && $isDashboard === false) : ?>
                            <a href="<?php echo base_url('Recipe/viewRecipe/m/' . (int)$recipe['id']); ?>" class="btn btn-sm btn-primary">
                                <i class="ri-eye-line label-icon align-middle fs-12 me-2"></i>Manager View Recipe
                            </a>
                            <a href="<?php echo base_url('Recipe/editRecipe/' . (int)$recipe['id']); ?>" class="btn btn-sm btn-secondary">
                                <i class="ri-edit-box-line label-icon align-middle fs-12 me-2"></i> Edit
                            </a>
                            <button class="btn btn-sm btn-danger remove-item-btn" data-rel-id="<?php echo (int)$recipe['id']; ?>">
                                <i class="ri-delete-bin-line label-icon align-middle fs-12 me-2"></i> Delete
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="8">No recipes found.</td>
        </tr>
    <?php endif; ?>
</tbody>


                                    </table>
                                </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
</div>
<script>

//  $('#listDatatable').DataTable({
//     pageLength: 100,
//     bPaginate: false,
//     bInfo: false,
//     lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
//     ordering: false, // Disable DataTables' ordering
//     "columnDefs": [
//         {
//             "targets": 'no-sort',
//             "orderable": false
//         }
//     ]
// });

        
         $(document).on("click", ".remove-item-btn" , function() {
                let id = $(this).attr('data-rel-id');
               
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
                            url: 'deleteRecipe',
                            data: 'id='+id+'&tableName=Recipe_recipes',
                            success: function(data){
                              $('#row_'+id).remove();
                            }
                        });
                      }
                  })
                
                
            });
            
             $(function() {
    // Make the table rows sortable
    $("#sortable").sortable({
      
        update: function(event, ui) {
            let sortOrder = $(this).sortable("toArray", { attribute: "id" });

            $.ajax({
                url: 'updateRecipeSortOrder',
                type: "POST",
                data: { order: sortOrder },
                success: function(response) {
                    console.log("recipe order updated successfully");
                },
                error: function() {
        
                    console.log("Error updating order");
                }
            });
        }
    });
    
});


$(document).ready(function(){
    $("#recipeSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        // Iterate through each prep area
        $(".prep-area").each(function() {
            var $prepArea = $(this);
            var $nextRows = $prepArea.nextUntil(".prep-area"); // get all recipe rows under this area
            var matchFound = false;

            $nextRows.each(function() {
                var $row = $(this);
                var recipeText = $row.find(".recipeNameTd").text().toLowerCase();
                var isMatch = recipeText.indexOf(value) > -1;
                $row.toggle(isMatch);
                if (isMatch) matchFound = true;
            });

            // Show or hide the prep area row based on matches in its children
            $prepArea.toggle(matchFound);
        });
    });
});



    </script>