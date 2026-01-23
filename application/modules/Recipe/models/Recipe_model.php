<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recipe_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->location_id = $this->session->userdata('location_id');
		$this->load->model('common_model');
	}
	
	function recipeList($roleId = '')
{
    // Build the query
    $this->tenantDb->select('r.id, r.recipe_type, rbc.name as prepAreaName, r.recipeName, r.cookingTime, r.difficulty, SUM(ri.cost) as totalCost,r.role_id');
    $this->tenantDb->from('Recipe_recipes as r');
    $this->tenantDb->join('Recipe_recipesToIngredients as ri', 'ri.recipeID = r.id', 'LEFT');
    $this->tenantDb->join('Recipe_recipebuilder_configs as rbc', 'rbc.id = r.recipe_type', 'LEFT');
    $this->tenantDb->join('Recipe_roles as RR', 'RR.recipeID = r.id', 'LEFT');

    $this->tenantDb->where('r.is_deleted', 0);
    $this->tenantDb->where('r.location_id', $this->location_id);

    // If user is not admin (roleId 1), restrict recipes by role
    if (!empty($roleId) && (int)$roleId !== 1) {
        $this->tenantDb->where('RR.role_id', (int)$roleId);
    }

    $this->tenantDb->group_by('r.id'); // Needed for aggregate SUM
    $this->tenantDb->order_by('r.sort_order', 'ASC');
    
    $query = $this->tenantDb->get();

    if ($query === false) {
    // Optional: log the error or debug it
    log_message('error', 'Recipe query failed: ' . $this->tenantDb->last_query());
    return []; // return empty array on failure
}

    $recipes = $query->result_array();


    // Initialize grouped array
    $groupedRecipes = [];

    foreach ($recipes as $recipe) {
        // Use null coalescing operator for safety
        $prepAreaName = $recipe['prepAreaName'] ?? 'Uncategorized';

        // Group by prep area
        if (!isset($groupedRecipes[$prepAreaName])) {
            $groupedRecipes[$prepAreaName] = [];
        }

        $groupedRecipes[$prepAreaName][] = $recipe;
    }

    return $groupedRecipes;
}

	
	function fetchIngredients($ingredientId='') {
	    
       $this->tenantDb->select('ing.name ,ing.id,ing.uom, rc2.id as uom_id, rc2.name as uom_name');
       $this->tenantDb->from('Recipe_ingredients as ing');
       $this->tenantDb->join('Recipe_recipebuilder_configs as rc2', 'rc2.id = ing.uom', 'LEFT');
       
       if($ingredientId !=''){
        $this->tenantDb->where('ing.id', $ingredientId);
        }
       // Add the conditions for the relevant listtypes
      
       $this->tenantDb->where('ing.is_deleted', 0);
       $this->tenantDb->where('rc2.listtype', 'uom');
       $this->tenantDb->where('ing.location_id', $this->location_id);
// echo $lastQuery = $this->tenantDb->last_query(); exit;
       
       
       $query = $this->tenantDb->get();

    if ($query === false) {
    // Optional: log the error or debug it
    log_message('error', 'Recipe query failed: ' . $this->tenantDb->last_query());
    return []; // return empty array on failure
}

    return  $query->result_array();

   }
   
   function fetchRecipeInfo($recipeId){
    $this->tenantDb->select('
        R.*, 
        RBC.name as UOMName, 
        rbc.id as recipe_type_id,
        rbc.name as recipe_type, 
        RI.ingredientId as ingredientId, 
        RI.prepIng as prepIng,
        I.name as ingredientName, 
        RI.qty, 
        RI.uom, 
        RI.cost, 
        RPS.id as rpsId, 
        RPS.prepSteps
    ');
    $this->tenantDb->from('Recipe_recipes R');
    $this->tenantDb->join('Recipe_recipesToIngredients RI', 'R.id = RI.recipeID', 'left');
    $this->tenantDb->join('Recipe_recipeToPreparationSteps RPS', 'R.id = RPS.recipeID', 'left');
    $this->tenantDb->join('Recipe_ingredients I', 'RI.ingredientId = I.id', 'left');
    $this->tenantDb->join('Recipe_recipebuilder_configs RBC', 'RBC.id = RI.uom', 'left');
    $this->tenantDb->join('Recipe_recipebuilder_configs as rbc', 'rbc.id = R.recipe_type', 'LEFT');
    $this->tenantDb->where('R.is_deleted', 0);
    $this->tenantDb->where('R.location_id', $this->location_id);
    $this->tenantDb->where('R.id', $recipeId);
    // Only add the RBC filter if it's not a null join
    $this->tenantDb->group_start();
    $this->tenantDb->where('RBC.listtype', 'uom');
    $this->tenantDb->or_where('RBC.listtype IS NULL');
    $this->tenantDb->group_end();

    $query = $this->tenantDb->get();
    // echo $lastQuery = $this->tenantDb->last_query(); exit;
  

    if ($query === false) {
    // Optional: log the error or debug it
    log_message('error', 'Recipe query failed: ' . $this->tenantDb->last_query());
    return []; // return empty array on failure
}

    $result = $query->result_array();

    // Process the results to nest ingredients under the recipe
    $processedResult = [];
    foreach ($result as $row) {
        $recipeId = $row['id'];
       $allRolesForThisrecipe =  $this->fetchrecipRoles($recipeId);
        if (!isset($processedResult[$recipeId])) {
            // Initialize the recipe data and ingredients array
            $processedResult[$recipeId] = [
                'id' => $row['id'],
                'recipe_type_id' => $row['recipe_type_id'],
                'recipe_type' => $row['recipe_type'],
                'roleIds' => $row['recipe_type'],
                'rpsId' => $row['rpsId'],
                'recipeName' => $row['recipeName'],
                'allergens' => $row['allergens'],
                'servingSize' => $row['servingSize'],
                'preparationTime' => $row['preparationTime'],
                'cookingTime' => $row['cookingTime'],
                'totalTime' => $row['totalTime'],
                'difficulty' => $row['difficulty'],
                'date_added' => $row['date_added'],
                'location_id' => $row['location_id'],
                'is_deleted' => $row['is_deleted'],
                'prepSteps' => $row['prepSteps'],
                'ingredients' => [], // Initialize the ingredients array
                'roleIds' => $row['roleIds']
            ];
        }
        
        // Add the ingredient to the recipe's ingredients array if present
        if ($row['ingredientId'] !== null) {
            $processedResult[$recipeId]['ingredients'][] = [
                'ingredientId' => $row['ingredientId'],
                'ingredientName' => $row['ingredientName'],
                'prepIng' => $row['prepIng'],
                'ingredientUOMqty' => $row['ingredientUOMqty'],
                'qty' => $row['qty'],
                'UOMName' => $row['UOMName'],
                'uom' => $row['uom'],
                'cost' => $row['cost'],
                'ingredientCost' => $row['ingredientCost']
            ];
        }
       if(isset($allRolesForThisrecipe) && !empty($allRolesForThisrecipe)){
       $processedResult[$recipeId]['allRecipeRoles'] =  array_column($allRolesForThisrecipe, 'role_id');;     
       }else{
        $processedResult[$recipeId]['allRecipeRoles'] =[];
       }
    }
    // Reset the array keys to a standard indexed array
    $processedResult = array_values($processedResult);
//   echo "<pre>"; print_r($processedResult); exit;
    // Output the final processed result
    return $processedResult;
}


function fetchrecipRoles($redcipeId){
 $conditions['recipeID'] = $redcipeId;
  $recipeRoles = $this->common_model->fetchRecordsDynamically('Recipe_roles',['role_id'],$conditions);  
  return $recipeRoles;
}
   
}

?>