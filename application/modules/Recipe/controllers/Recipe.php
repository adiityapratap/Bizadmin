<?php

class Recipe extends MY_Controller
{
    public function __construct() 
    {   
      	parent::__construct();
   	   
   	    $this->load->model('common_model');
   	    $this->load->model('recipe_model');
       !$this->ion_auth->logged_in() ? redirect('auth/login', 'refresh') : '';
        $this->POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->location_id = $this->session->userdata('location_id');
       
    }
    
  
    
    public function Config(){
   	      //   $table = 'your_table';
    //     $fields = array('field1', 'field2');
        $order_by = 'sort_order ASC';
        $conditions = array('location_id' => $this->location_id, 'is_deleted' => 0);
        
        $conditions['listtype'] = 'category';
        $catListData = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions,$order_by);
        
        $conditions['listtype'] = 'uom';
        $uomListData = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions,$order_by);
        $conditions['listtype'] = 'servingSize';
        $servingSizeListData = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions,$order_by);
        
        $conditions['listtype'] = 'prepAreas';
        $prepAreaListData = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions,$order_by);
        
        $conditionsA['is_deleted'] = 0;
        $allergenListData = $this->common_model->fetchRecordsDynamically('Recipe_allergens','',$conditionsA);
        
       
        $ingredientListData = $this->recipe_model->fetchIngredients();
         
        // echo "<pre>"; print_r($ingredientListData); exit;
        
        $modulesListData = array(
            'category' => array(
                'label' => 'Category',
                'tableData' => $catListData,
                ),
                
            'uom' => array(
                'label' => 'UOM',
                'tableData' => $uomListData,
                ),
            'ingredient' => array(
                'label' => 'Ingredient',
                'tableData' => $ingredientListData,
                ),  
            'allergens' => array(
                'label' => 'Allergens',
                'tableData' => $allergenListData,
                ),    
            'prepAreas' => array(
                'label' => 'Recipe Types',
                'tableData' => $prepAreaListData,
                ),     
            'servingSize' => array(
                'label' => 'Serving Size',
                'tableData' => $servingSizeListData,
                )
            );
        
        $data['uomListData']  = $uomListData;
        $data['catListData']  = $catListData;
        $data['ingredientListData']  = $ingredientListData;
        $data['allergenListData']  = $allergenListData;
        $data['servingSizeListData']  = $servingSizeListData;
        $data['prepAreaListData']  = $prepAreaListData;
        $data['modulesInfo']  = $modulesListData;
		$data['selectedlisttype'] = $this->session->userdata('listtype');	
	
			$this->load->view('general/header');
            $this->load->view('Recipebuilder/recipeConfigs',$data);
            $this->load->view('general/footer');
		}
		
	public function saveConfigsdata(){
	    
	
			if(isset($this->POST['name'])){
					$configData = array(
						'name' => $this->POST['name'],
						'listtype' => $this->POST['listtype'],
						'location_id' => $this->location_id,
						'created_date' => date('Y-m-d'),
					);
		$this->session->set_userdata('listtype', $this->POST['listtype']);
		$result = $this->common_model->commonRecordCreate('Recipe_recipebuilder_configs',$configData);
		echo $result;
			}
			
			
		}
		
	public function updateConfig(){
	    
        $result = $this->common_model->commonRecordUpdate('Recipe_recipebuilder_configs','id',$this->POST['id'],$this->POST);
        $this->session->set_userdata('listtype', $this->POST['listtype']);    
		echo 'succcess';
		}
		
  public function updateSortOrder(){
	 
	 $newOrder = $this->input->post('order');
   
    foreach ($newOrder as $index => $itemId) {
        $equipID = substr($itemId, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $equipID);
        $this->tenantDb->update('Recipe_recipebuilder_configs');
    }
    echo "success";
	}  
		
    public function saveIngredients() {
    // Retrieve and sanitize POST data
    $ingredient_name = trim($this->input->post('ingredient_name', TRUE)); // TRUE enables XSS filtering
    $uom_id = (int) $this->input->post('uom_id'); // Cast to integer for safety

    // Set session data (if needed)
    $this->session->set_userdata('listtype', 'ingredient');

    // Validate required fields
    if (empty($ingredient_name) || empty($uom_id)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        return;
    }

    // Check if ingredient name already exists
    $conditions = [
        'name' => $ingredient_name,
        'location_id' => $this->location_id, // Ensure location-specific check
        'is_deleted' => 0 // Exclude deleted ingredients
    ];
    $existing_ingredient = $this->common_model->fetchRecordsDynamically('Recipe_ingredients', ['name'], $conditions);

    // If ingredient exists, return error
    if (!empty($existing_ingredient)) {
        echo json_encode(['success' => false, 'message' => 'Ingredient name already exists.']);
        return;
    }

    // Prepare data for insertion
    $ingredientData = [
        'name' => $ingredient_name,
        'uom' => $uom_id,
        'location_id' => $this->location_id,
    ];

    // Insert data into database
    try {
        $result = $this->common_model->commonRecordCreate('Recipe_ingredients', $ingredientData);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Ingredient saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save ingredient.']);
        }
    } catch (Exception $e) {
        // Log error and return failure
        log_message('error', 'Failed to save ingredient: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while saving the ingredient.']);
    }
}
    
     public function saveAllergen() {
        
    
        $allergen_name = $this->POST['allergen_name'];
        $allergen_type =$this->POST['allergen_type'];
        
        
        $this->session->set_userdata('listtype', 'allergens');  

        // Validate data
        if (empty($allergen_name) || empty($allergen_type) ) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            return;
        }
        

        // Insert data into database
        $allergensData = [
            'name' => $allergen_name,
            'allergen_type' => $allergen_type,
            'location_id' => $this->location_id,
        ];
        if($this->POST['allergen_id'] !=''){
       $this->common_model->commonRecordUpdate('Recipe_allergens','id',$this->POST['allergen_id'],$allergensData);     
        }else{
       $result = $this->common_model->commonRecordCreate('Recipe_allergens',$allergensData);     
        }
        

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Allergens saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save allergens.']);
        }
    }
    
    public function editIngredient($id){
        
        $conditions = array('location_id' => $this->location_id, 'is_deleted' => 0);
        $conditions['listtype'] = 'category';
        $data['catListData'] = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions);
        $conditions['listtype'] = 'uom';
        $data['uomListData'] = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions);
        
        
        $conditionsI['id'] = $id;
        $data['ingredientData'] = $this->common_model->fetchRecordsDynamically('Recipe_ingredients', '',$conditionsI);  
        // echo "<pre>"; print_r($data['ingredientData']); exit;
        $this->load->view('general/header');
        $this->load->view('Recipebuilder/editIngredient',$data);
        $this->load->view('general/footer'); 
    }
    
    function updateIngredient(){
        // echo "<pre>"; print_r($this->POST); exit;
        unset($this->POST['listtype']);
      $result = $this->common_model->commonRecordUpdate('Recipe_ingredients','id',$this->POST['id'],$this->POST); 
      redirect(base_url('Recipe/Config'), 'refresh');
    }
    
    
    // Code related to recipe builder form ================================================================================================
    
     public function buildRecipe() {
         
         $this->session->set_userdata('listtype', 'ingredient');
        $data['recipes'] = $this->recipe_model->recipeList();
        $data['isDashboard'] = false;
        //   echo "<pre>"; print_r($data['recipes']); exit;
        $this->load->view('general/header');
        $this->load->view('Recipebuilder/recipeList', $data);
        $this->load->view('general/footer');
    }
    
    function newRecipeForm(){
        
        $data['ingredients'] = $this->recipe_model->fetchIngredients(); 
         $conditionsA['is_deleted'] = 0;
        $allergens = $this->common_model->fetchRecordsDynamically('Recipe_allergens','',$conditionsA);
        $grouped_allergens = [];

        foreach ($allergens as $item) {
        $type = $item['allergen_type'] ? $item['allergen_type'] : 'Common allergens present';
        $grouped_allergens[$type][] = $item;
       }
       $data['allergens'] = $grouped_allergens;
       
       $data['allRoles'] = get_all_roles($this->ion_auth,$this->location_id);
     
        // these are recipe types not prepArea , just for name we used earlier in DB , we left it as it is
       $conditions['listtype'] = 'prepAreas'; $conditions['location_id'] = $this->location_id;
       $data['recipeTypes'] = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions);
       
       
       $conditions['listtype'] = 'category';
       $order_by = 'sort_order ASC';
       $data['catListData'] = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions,$order_by);
        
        // echo "<pre>"; print_r($data['allergens']); exit;
        $this->load->view('general/header');
        $this->load->view('Recipebuilder/recipeForm',$data);
        $this->load->view('general/footer'); 
    }
    
    public function saveAllRecipeDetails() {
        // Set response header to JSON
        
        header('Content-Type: application/json');
        
      

        try {
            // Prepare recipe data
           $recipeData = [
                'recipeName' => $this->POST['recipeName'],
                'role_id' => serialize($this->POST['roleIds']),
                'servingSize' => $this->POST['servingSize'],
                'preparationTime' => $this->POST['preparationTime'],
                'cookingTime' => $this->POST['cookingTime'],
                'totalTime' => $this->POST['totalTime'],
                'difficulty' => $this->POST['difficulty'],
                'allergens' => implode(',', $this->input->post('allergens') ?: []),
                'date_added' => date('Y-m-d H:i:s'),
                'location_id' => $this->location_id,
                'recipe_type' => $this->POST['recipe_type'],
                'is_deleted' => 0,
                'sort_order' => 0
            ];

            // Insert or update the recipe
            $recipeId = $this->POST['recipeId'];
            if ($recipeId) {
                $this->common_model->commonRecordUpdate('Recipe_recipes', 'id', $recipeId, $recipeData);
            } else {
                $recipeId = $this->common_model->commonRecordCreate('Recipe_recipes', $recipeData);
            }
            

           if ($recipeId) {
                $this->common_model->commonRecordDelete('Recipe_recipesToIngredients', $recipeId, 'recipeID');
                $this->common_model->commonRecordDelete('Recipe_recipeToPreparationSteps', $recipeId, 'recipeID');
                 $this->common_model->commonRecordDelete('Recipe_roles', $recipeId, 'recipeID');
            }

            // Combine parallel ingredient arrays into a single array
            $ingredientNames = $this->input->post('ingredientName') ?: [];
            $ingredientUoms = $this->input->post('ingredientUom') ?: [];
            $ingredientQtys = $this->input->post('ingredientQty') ?: [];
            $ingredientCosts = $this->input->post('ingredientCost') ?: [];
            $ingredientprepIng = $this->input->post('prepIng') ?: [];

            $ingredientData = [];
            $count = max(count($ingredientNames), count($ingredientUoms), count($ingredientQtys), count($ingredientCosts));

            for ($i = 0; $i < $count; $i++) {
                $ingredientId = isset($ingredientNames[$i]) ? $ingredientNames[$i] : null;
                $uom = isset($ingredientUoms[$i]) ? $ingredientUoms[$i] : null;
                $qty = isset($ingredientQtys[$i]) ? $ingredientQtys[$i] : null;
                $cost = isset($ingredientCosts[$i]) ? $ingredientCosts[$i] : null;
                $ingredientprep = isset($ingredientprepIng[$i]) ? $ingredientprepIng[$i] : null;

                if (!empty($ingredientId) && !empty($qty)) {
                    $ingredientData[] = [
                        'recipeID' => $recipeId,
                        'ingredientId' => $ingredientId,
                        'qty' => $qty,
                        'prepIng' => $ingredientprep,
                        'uom' => $uom,
                        'cost' => $cost
                    ];
                }
            }

            // Insert ingredients using bulk insert
            if (!empty($ingredientData)) {
                $this->common_model->commonBulkRecordCreate('Recipe_recipesToIngredients', $ingredientData);
            }
            
            
            // save all roels thatwill see this recipe
            if (isset($this->POST['roleIds']) && !empty($this->POST['roleIds'])) {
               foreach($this->POST['roleIds'] as $roleId){
                $roleData[] = ['role_id' => $roleId,'recipeID' =>$recipeId];
                }
            $this->common_model->commonBulkRecordCreate('Recipe_roles', $roleData);
            }

           $prepSteps = $this->input->post('prepStepsHidden');
            if (!empty($prepSteps)) {
                $prepSteps = $this->security->xss_clean($prepSteps);
                $prepData = [
                    'recipeID' => $recipeId,
                    'prepSteps' => $prepSteps
                ];
                $this->common_model->commonRecordCreate('Recipe_recipeToPreparationSteps', $prepData);
            }


            echo json_encode(['status' => 'success', 'message' => 'Recipe saved successfully']);
        } catch (Exception $e) {
           
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    
    
    function editRecipe($recipeId){
      
     $data['ingredients'] = $this->recipe_model->fetchIngredients(); 
     $recipeInfo = $this->recipe_model->fetchRecipeInfo($recipeId); 
     $data['recipeInfo'] = (isset($recipeInfo) && !empty($recipeInfo) ? reset($recipeInfo) : array());
     
      $data['allRoles'] = get_all_roles($this->ion_auth,$this->location_id);
     
      $conditions['listtype'] = 'prepAreas'; $conditions['location_id'] = $this->location_id;
      $data['recipeTypes'] = $this->common_model->fetchRecordsDynamically('Recipe_recipebuilder_configs','',$conditions);
     
     $allergens = $this->common_model->fetchRecordsDynamically('Recipe_allergens',['id','name','allergen_type'],$conditionsA);
     $grouped_allergens = [];

        foreach ($allergens as $item) {
        $type = $item['allergen_type'] ? $item['allergen_type'] : 'Common allergens present';
        $grouped_allergens[$type][] = $item;
       }
       $data['allergens'] = $grouped_allergens;
       
    //   echo "<pre>"; print_r($recipeInfo); exit;
        $this->load->view('general/header');
        $this->load->view('Recipebuilder/recipeForm',$data);
        $this->load->view('general/footer'); 
        
    }
    function viewRecipe($viewType='m',$recipeId){
      
     $data['ingredients'] = $this->recipe_model->fetchIngredients(); 
     $recipeInfo = $this->recipe_model->fetchRecipeInfo($recipeId); 
     $data['recipeInfo'] = (isset($recipeInfo) && !empty($recipeInfo) ? reset($recipeInfo) : array());
     $data['viewType'] = $viewType;
    //   echo "<pre>"; print_r($data['recipeInfo']); exit;
        $this->load->view('general/header');
        $this->load->view('Recipebuilder/viewRecipe',$data);
        $this->load->view('general/footer'); 
        
    }
    function deleteRecipe(){
      $this->common_model->commonRecordDelete('Recipe_recipes',$this->POST['id'],'id');
      $this->common_model->commonRecordDelete('Recipe_recipesToIngredients',$this->POST['id'],'recipeID'); 
      $this->common_model->commonRecordDelete('Recipe_recipeToPreparationSteps',$this->POST['id'],'recipeID'); 
		echo 'success';
    }
    
    public function updateRecipeSortOrder(){
	 $newOrder = $this->input->post('order');
    // Update the database with the new sort order

    foreach ($newOrder as $index => $recipeid) {
        $recipeID = substr($recipeid, 4);
        $this->tenantDb->set('sort_order', $index + 1);
        $this->tenantDb->where('id', $recipeID);
        $this->tenantDb->update('Recipe_recipes');
    }
    echo "success";
	}  
    function deleteRecipeConfigs(){
        $tabelName = $this->POST['tablename'];
        unset($this->POST['tablename']);
         $result = $this->common_model->commonRecordUpdate($tabelName,'id',$this->POST['id'],$this->POST);
           
		echo 'succcess';
    }
    
    public function fetchIngredientDetails()
    {
    $ingredientId = $this->input->post('id');

    if ($ingredientId) {
        $ingredientDetails = $this->recipe_model->fetchIngredients($ingredientId);

        if (!empty($ingredientDetails)) {
            echo json_encode([
                'success' => true,
                'data' => [
                    'uom_id' => explode(',', $ingredientDetails[0]['uom_id']), 
                    'uom_name' => explode(',', $ingredientDetails[0]['uom_name']), 
                    'cost' => $ingredientDetails[0]['cost'],
                    'uomqty' => $ingredientDetails[0]['uomqty']
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ingredient details not found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    }
   }

    
    
   
    
    }
    
    ?>