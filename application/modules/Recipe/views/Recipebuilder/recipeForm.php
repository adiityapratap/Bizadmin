<style>
@media print {
    /* Ensure all tabs are displayed */
    .tab-content > .tab-pane {
        display: block !important; /* Show all tab panes */
        visibility: visible !important;
        height: auto !important;
        opacity: 1 !important;
    }

    /* Hide tab headers if they are not needed in print */
    .nav-tabs,
    .nav-pills {
        display: none !important;
    }

    /* Hide buttons and other non-essential elements */
    button,.printhide,
    .btn {
        display: none !important;
    }

    /* Style the inputs and layout for printing */
    input,
    select,
    textarea {
        border: none;
        background: transparent;
        color: black;
        font-size: 14px;
    }

    /* Adjust page margins */
    body {
        margin: 0;
        padding: 0;
    }

    /* Remove any additional margins/padding from forms or containers */
    form {
        margin: 0;
        padding: 0;
    }
}
/* Custom styles for better UI */
.recipe-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}
.recipe-header h4 {
    color: #343a40;
    font-weight: 600;
}
.section-header {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.ingredient-row {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
}

.selectpicker + .dropdown-menu {
    top: 100% !important; /* Force dropdown to open below */
    bottom: auto !important;
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
               <div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <h5 class="card-title mb-0 text-black printhide">Create Recipe</h5>
                        
                    </div>
                    <div class="col-sm-auto">
                       
                        <button onclick="history.back()" class="btn btn-danger btn-sm"><i class="ri-arrow-go-back-line me-2"></i> Back</button>
                        <button class="btn btn-success btn-sm" onclick="saveRecipe(this)"><i class="ri-printer-line me-2"></i> Save Recipe</button>
                        <button class="btn btn-secondary btn-sm" id="printButton"><i class="ri-printer-line me-2"></i> Print Recipe</button>
                    </div>
                </div>
            </div>
            <div class="card-body checkout-tab">
                <form id="recipeForm">
                    <!-- Hidden Recipe ID -->
                    <input type="hidden" class="recipeId" name="recipeId" value="<?php echo isset($recipeInfo['id']) ? $recipeInfo['id'] : ''; ?>">

                    <!-- Recipe Information Section -->
                    <div class="recipe-header recipeSection">
                        <h4 class="mb-4">Recipe Information</h4>
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label for="recipeName" class="form-label">Recipe Name</label>
                                    <input type="text" class="form-control" name="recipeName" id="recipeName" placeholder="Enter recipe name"
                                           value="<?php echo isset($recipeInfo['recipeName']) ? htmlspecialchars($recipeInfo['recipeName'], ENT_QUOTES) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class=" col-3 col-md-4 col-sm-3">
             <h6 class="fw-semibold text-black">Role *</h6>
         <?php
// Normalize selected role IDs (cast all to integers for strict comparison)
$selectedRoles = isset($recipeInfo['allRecipeRoles']) && is_array($recipeInfo['allRecipeRoles'])
    ? array_map('intval', $recipeInfo['allRecipeRoles'])
    : [];
?>

<select class="js-example-basic-multiple" name="roleIds[]" multiple="multiple">
    <?php if (!empty($allRoles)) {
        foreach ($allRoles as $allRole) {
            $roleId = (int) $allRole['id'];
            $selected = in_array($roleId, $selectedRoles, true) ? 'selected' : '';
            ?>
            <option value="<?= $roleId ?>" <?= $selected ?>>
                <?= htmlspecialchars($allRole['name']) ?>
            </option>
    <?php }
    } ?>
</select>

                            <small>Select the  role who will see this recipe like staff/manager/chef etc.... </small>  
                            </div>
                    
                   
                                                         
                            <div class=" col-3 col-md-4 col-sm-3">
                                <div class="mb-3">
                                    <label for="servingSize" class="form-label">Serving Size</label>
                                    <input type="text" class="form-control" name="servingSize" id="servingSize" placeholder="Enter serving size"
                                           value="<?php echo isset($recipeInfo['servingSize']) ? htmlspecialchars($recipeInfo['servingSize'], ENT_QUOTES) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="preparationTime" class="form-label">Preparation Time</label>
                                    <input type="text" class="form-control" id="preparationTime" name="preparationTime" placeholder="Enter preparation time"
                                           value="<?php echo isset($recipeInfo['preparationTime']) ? htmlspecialchars($recipeInfo['preparationTime'], ENT_QUOTES) : ''; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="cookingTime" class="form-label">Cooking Time</label>
                                    <input type="text" class="form-control" name="cookingTime" id="cookingTime" placeholder="Enter cooking time"
                                           value="<?php echo isset($recipeInfo['cookingTime']) ? htmlspecialchars($recipeInfo['cookingTime'], ENT_QUOTES) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="totalTime" class="form-label">Total Time</label>
                                    <input type="text" class="form-control" id="totalTime" name="totalTime" placeholder="Enter total time"
                                           value="<?php echo isset($recipeInfo['totalTime']) ? htmlspecialchars($recipeInfo['totalTime'], ENT_QUOTES) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-6">
                        <label for="recipeName" class="form-label">Recipe Type</label>
                           
                                <select class="form-select selectpicker" data-choices  name="recipe_type" id="choices-single-default">
                                <?php if(isset($recipeTypes) && !empty($recipeTypes)){  ?> 
                                <option value="">Select Category</option>
                                <?php foreach($recipeTypes as $recipeType) {  ?>
                                <option value="<?php echo $recipeType['id'] ?>" <?php echo  (isset($recipeInfo['recipe_type_id']) && $recipeInfo['recipe_type_id'] == $recipeType['id'] ? 'selected' : '') ?>><?php echo $recipeType['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                            
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="difficulty" class="form-label">Difficulty</label>
                                    <input type="text" class="form-control" name="difficulty" id="difficulty" placeholder="Enter difficulty"
                                           value="<?php echo isset($recipeInfo['difficulty']) ? htmlspecialchars($recipeInfo['difficulty'], ENT_QUOTES) : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ingredient Details Section -->
                    <div class="section-header ingredientSection">
                        <div class="d-flex mb-3 align-items-center">
                            <h4 class="mb-0 text-black">Ingredient Details</h4>
                            <a href="<?= base_url('Recipe/Config') ?>" class="btn btn-danger btn-sm btn-label right ms-auto printhide"><i class="bx bx-plus label-icon align-middle fs-16 ms-2"></i>Add New Ingredient</a>
                        </div>
                        <div id="ingredient-form">
                            <?php $totalCost = 0;  if (isset($recipeInfo['ingredients']) && !empty($recipeInfo['ingredients'])) { ?>
                                <?php foreach ($recipeInfo['ingredients'] as $recipeIngredients) { ?>
                                    <div class="row mb-3 align-items-center ingredientRow">
                                        <div class="col-md-3">
                                            <label for="ingredientName" class="form-label">Ingredient Name</label>
                                            <select class="form-select ingredientName" data-choices name="ingredientName[]">
                                                <option disabled>Choose Ingredient Name</option>
                                                <?php if (isset($ingredients) && !empty($ingredients)) { ?>
                                                    <?php foreach ($ingredients as $ingredient) { ?>
                                                        <option <?php echo ($recipeIngredients['ingredientId'] == $ingredient['id'] ? 'selected' : '') ?> value="<?php echo $ingredient['id'] ?>"><?php echo $ingredient['name'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="ingredientQty" class="form-label"> QTY</label>
                                            <input type="text" class="form-control ingredientQty" name="ingredientQty[]" placeholder="Enter Qty Eg. 1000,5000 etc" value="<?php echo $recipeIngredients['qty'] ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="ingredientUom" class="form-label"> UOM</label>
                                            <select class="form-select ingredientUom" name="ingredientUom[]">
                                                <option value="<?php echo $recipeIngredients['uom'] ?>"><?php echo $recipeIngredients['UOMName'] ?></option>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="col-md-3">
                                            <label for="prepIng" class="form-label">Preparation</label>
                                            <input type="text" class="form-control prepIng" name="prepIng[]" placeholder="Enter preparation step if any" value="<?php echo $recipeIngredients['prepIng'] ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalIngredientCost" class="form-label">Cost</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <?php $totalCost =  $totalCost + $recipeIngredients['cost']; ?>
                                                <input type="text" class="form-control totalIngredientCost" name="ingredientCost[]"  aria-label="Cost" value="<?php echo $recipeIngredients['cost'] ?>">
                                                <input type="hidden" class="form-control ingredientCostValue" value="<?php echo $recipeIngredients['ingredientCost'] ?>">
                                                <input type="hidden" class="form-control ingredientUOMqtyValue" value="<?php echo $recipeIngredients['ingredientUOMqty'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1 text-center mt-3 buttonParent">
                                            <button type="button" class="btn btn-success btn-sm add-row"><i class="bx bx-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-minus"></i></button>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="row mb-3 align-items-center ingredientRow">
                                    <div class="col-md-3">
                                        <label for="ingredientName" class="form-label">Ingredient Name</label>
                                        <select class="form-select ingredientName" data-choices name="ingredientName[]" id="choices-single-default">
                                            <option selected disabled>Choose Ingredient Name</option>
                                            <?php if (isset($ingredients) && !empty($ingredients)) { ?>
                                                <?php foreach ($ingredients as $ingredient) { ?>
                                                    <option value="<?php echo $ingredient['id'] ?>"><?php echo $ingredient['name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <div class="col-md-2">
                                        <label for="ingredientQty" class="form-label"> Qty</label>
                                        <input type="text" class="form-control ingredientQty" name="ingredientQty[]" placeholder="Enter Qty Eg. 1000,5000 etc">
                                    </div>
                                    
                                    <div class="col-md-1">
                                        <label for="ingredientUom" class="form-label"> UOM</label>
                                        <select class="form-select ingredientUom" name="ingredientUom[]"></select>
                                    </div>
                                   
                                    <div class="col-md-3">
                                            <label for="prepIng" class="form-label">Preparation</label>
                                            <input type="text" class="form-control prepIng" name="prepIng[]" placeholder="Enter preparation step if any" value="<?php echo $recipeIngredients['prepIng'] ?>">
                                        </div>
                                    <div class="col-md-2">
                                        <label for="totalIngredientCost" class="form-label">Cost</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control totalIngredientCost" name="ingredientCost[]"  aria-label="Cost">
                                            <input type="hidden" class="form-control ingredientCostValue">
                                            <input type="hidden" class="form-control ingredientUOMqtyValue">
                                        </div>
                                    </div>
                                    <div class="col-md-1 text-center mt-3 buttonParent">
                                        <button type="button" class="btn btn-success btn-sm add-row"><i class="bx bx-plus"></i></button>
                                    </div>
                                </div>
                            <?php } ?>
                       
                        </div>
                        
                         <div class="row">
    <div class="col-md-3 offset-md-8 text-center">
        <strong>Total Cost: $<span id="totalCostDisplay"><?php echo number_format($totalCost, 2); ?></span></strong>
    </div>
</div>

                    </div>

                    <!-- Preparation Steps Section -->
                    
<div class="section-header">
    <h4 class="mb-1 text-black">Preparation Steps</h4>
    <p class="text-black mb-4 printhide">Add steps with optional images or videos for each step.</p>
    <div class="mb-3">
        <label for="preparationSteps" class="form-label printhide">Preparation Steps</label>
        <!-- Use a textarea for CKEditor -->
        <textarea class="form-control ckeditor-classic" id="ckEditorMainClass" name="prepSteps" rows="4">
            <?php echo isset($recipeInfo['prepSteps']) ? htmlspecialchars($recipeInfo['prepSteps']) : ''; ?>
        </textarea>
        <!-- Hidden input to store CKEditor content for form submission -->
        <input type="hidden" name="prepStepsHidden" id="prepStepsHidden">
    </div>
</div>
                    <!-- Allergens Section -->
                   <div class="section-header">
    <h4 class="mb-1 text-black mt-3">Allergens</h4>
    <div class="mt-3">
        <?php
        // Convert the comma-separated allergen IDs into an array
        $selectedAllergens = !empty($recipeInfo['allergens']) ? explode(',', $recipeInfo['allergens']) : [];
       if(isset($allergens) && !empty($allergens)){
           
       
        // Loop through each allergen type and its items
        foreach ($allergens as $type => $items): ?>
            <div class="mb-2">
                <h6 class="fw-bold text-black mb-2"><?= htmlspecialchars($type) ?>:</h6>
                <div class="row">
                    <?php foreach ($items as $allergen): ?>
                        <div class="col-md-2 col-sm-4 col-6 mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       name="allergens[]"
                                       value="<?= htmlspecialchars($allergen['id']) ?>"
                                       id="allergen<?= htmlspecialchars($allergen['id']) ?>"
                                       <?= in_array($allergen['id'], $selectedAllergens) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="allergen<?= htmlspecialchars($allergen['id']) ?>">
                                    <?= htmlspecialchars($allergen['name']) ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php } ?>
    </div>
</div>

                    <!-- Submit Button -->
                    <div class="d-flex align-items-start gap-3 mt-4">
                        <button type="button" class="btn btn-success btn-label right ms-auto nexttab" onclick="saveRecipe(this)"><i class="bx bx-list-check label-icon align-middle fs-16 ms-2"></i>Finish</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
 </div>
        </div>
    </div>
</div>






<script>


function saveRecipe(obj) {
    $(obj).html("Saving....");
    
    // Get CKEditor 5 content
    const prepStepsContent = window.ckEditorInstance.getData();
    
    // Set the content to the hidden input
    $('#prepStepsHidden').val(prepStepsContent);

    const formData = $('#recipeForm').serializeArray();
    // const prepIdValue = $('#prep_id').val();
    // formData.push({ name: 'prep_id', value: prepIdValue || '' });
    
    $.ajax({
        url: '<?= base_url("Recipe/saveAllRecipeDetails") ?>',
        type: 'POST',
        data: formData,
        dataType: 'json', // Expect a JSON response
        success: function (response) {
            if (response.status === 'success') {
                 $(obj).html("Save");
                alert('Recipe saved successfully!');
                window.location.href = '<?= base_url("Recipe/buildRecipe") ?>';
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            alert('An error occurred while saving the recipe: ' + error);
        }
    });
}



$(document).ready(function () {

    // Function to calculate total cost
    function calculateTotalCost() {
        let total = 0;
        $('.totalIngredientCost').each(function () {
            let val = parseFloat($(this).val());
            if (!isNaN(val)) {
                total += val;
            }
        });
        $('#totalCostDisplay').text(total.toFixed(2));
    }

    // Initial calculation
    calculateTotalCost();

    // Recalculate when cost input changes
    $(document).on('input', '.totalIngredientCost', function () {
        calculateTotalCost();
    });

    // Add row button
    $(document).on('click', '.add-row', function () {
        let newRowHtml = `
            <div class="row mb-3 align-items-center ingredientRow">
                <div class="col-md-3">
                    <label for="ingredientName" class="form-label">Ingredient Name</label>
                    <select class="form-select ingredientName" data-choices name="ingredientName[]">
                        <option selected disabled>Choose Ingredient Name</option>
                        <?php if (isset($ingredients) && !empty($ingredients)) { ?>
                            <?php foreach ($ingredients as $ingredient) { ?>
                                <option value="<?php echo htmlspecialchars($ingredient['id']); ?>"><?php echo htmlspecialchars($ingredient['name']); ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="ingredientQty" class="form-label"> Qty</label>
                    <input type="text" class="form-control ingredientQty" name="ingredientQty[]" placeholder="Enter Qty Eg. 1000,5000 etc">
                </div>
                
                <div class="col-md-1">
                    <label for="ingredientUom" class="form-label"> UOM</label>
                    <select class="form-select ingredientUom" name="ingredientUom[]">
                        <option selected disabled>Choose UOM</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="prepIng" class="form-label">Preparation</label>
                    <input type="text" class="form-control prepIng" name="prepIng[]" placeholder="Enter preparation step if any">
                </div>
                
                <div class="col-md-2">
                    <label for="totalIngredientCost" class="form-label">Cost</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control totalIngredientCost" name="ingredientCost[]" aria-label="Cost">
                        <input type="hidden" class="form-control ingredientCostValue">
                        <input type="hidden" class="form-control ingredientUOMqtyValue">
                    </div>
                </div>
                
                <div class="col-md-1 text-center mt-3 buttonParent">
                    <button type="button" class="btn btn-success btn-sm add-row"><i class="bx bx-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-minus"></i></button>
                </div>
            </div>
        `;

        $('#ingredient-form').append(newRowHtml);

        // Re-initialize Choices if used
        if (typeof initializeChoices === 'function') {
            initializeChoices();
        }
    });

    // Remove row
    $(document).on('click', '.remove-row', function () {
        if ($('.ingredientRow').length > 1) {
            $(this).closest('.ingredientRow').remove();
            calculateTotalCost(); // Update cost after row removal
        } else {
            alert('At least one row is required.');
        }
    });
});


// Handle ingredient selection change
$(document).on('change', '.ingredientName', function () {
    fetchIngredientDetails(this);
});

// Handle quantity input changes to calculate cost , commented on 13-05-2025 as told by kj so that user can manually enter cost
// $(document).on('input', '.ingredientQty', function () {
//     let currentRow = $(this).closest('.row');
//     let qty = parseFloat($(this).val()) || 0;
//     let costPerUnit = parseFloat(currentRow.find('.ingredientCost').val()) || 0;

//     // Calculate total cost
//     let totalCost = qty * costPerUnit;
//     currentRow.find('.totalIngredientCost').val(totalCost.toFixed(2));
// });

// Function to fetch ingredient details
function fetchIngredientDetails(obj) {
    const ingredientId = $(obj).closest(".row").find('.ingredientName').val(); // Get selected ingredient ID
    console.log("select ingredient", ingredientId);
    if (ingredientId) {
        $.ajax({
            url: '<?= base_url("Recipe/fetchIngredientDetails") ?>',
            type: 'POST',
            data: { id: ingredientId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Populate the UOM dropdown
                    const uomDropdown = $(obj).closest(".row").find('.ingredientUom');
                    uomDropdown.empty();
                 let uomName = '';
                    response.data.uom_id.forEach(function (uomId, index) {
                         uomName = response.data.uom_name[index];
                        uomDropdown.append(`<option selected value="${uomId}">${uomName}</option>`);
                    });

                    // Set cost in the row
                    // $(obj).closest(".row").find('.ingredientUOMqtyValue').val(response.data.uomqty);
                    // $(obj).closest(".row").find('.ingredientCostValue').val(response.data.cost);
                    
                    //  $(obj).closest(".row .ingredientRow").find('.ingqtycost').html('');
                    // $(obj).closest(".row .ingredientRow").append('<b class="ingqtycost"><small class="mb-0 text-bold mt-3 mx-3"> '+response.data.uomqty + ' '+ uomName +'  = $' + response.data.cost+'</small></b>');
                } else {
                    alert(response.message || 'No details found.');
                }
            },
            error: function () {
                alert('An error occurred while fetching ingredient details.');
            }
        });
    }
}








document.getElementById('printButton').addEventListener('click', function () {
    window.print();
});


//, commented on 13-05-2025 as told by kj so that user can manually enter cost

// $(document).ready(function () {
//     $(document).on('input', '.ingredientQty', function () {
//         let $row = $(this).closest('.ingredientRow');
//         let ingredientQty = parseFloat($(this).val()) || 0;
//         let ingredientUOMqtyValue = parseFloat($row.find('.ingredientUOMqtyValue').val()) || 1;
//         let ingredientCostValue = parseFloat($row.find('.ingredientCostValue').val()) || 0; 
        
//         let result = (ingredientQty / ingredientUOMqtyValue) * ingredientCostValue;
        
//         $row.find('.totalIngredientCost').val(result.toFixed(2));
//     });
// });


function initializeChoices() {
    const m = document.querySelectorAll("[data-choices]:not(.choices__inner)");
    Array.from(m).forEach(function (e) {
        // Skip if already initialized
        if (e.choices) return;

        var t = {},
            a = e.attributes;
        a["data-choices-groups"] && (t.placeholderValue = "This is a placeholder set in the config");
        a["data-choices-search-false"] && (t.searchEnabled = !1);
        a["data-choices-search-true"] && (t.searchEnabled = !0);
        a["data-choices-removeItem"] && (t.removeItemButton = !0);
        a["data-choices-sorting-false"] && (t.shouldSort = !1);
        a["data-choices-sorting-true"] && (t.shouldSort = !0);
        a["data-choices-multiple-remove"] && (t.removeItemButton = !0);
        a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString());
        a["data-choices-editItem-true"] && (t.maxItemCount = !0);
        a["data-choices-editItem-false"] && (t.maxItemCount = !1);
        a["data-choices-text-unique-true"] && (t.duplicateItemsAllowed = !1);
        a["data-choices-text-disabled-true"] && (t.addItems = !1);

        // Initialize Choices.js
        a["data-choices-text-disabled-true"] ? new Choices(e, t).disable() : new Choices(e, t);
    });
}

</script>
