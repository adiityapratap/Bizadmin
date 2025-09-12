<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function custom_encode($param1, $param2='') {
    // Combine the parameters with a delimiter
    if($param2 !=''){
      $combined_params = "{$param1}|{$param2}"; 
    }else{
       $combined_params =  $param1;
    }
   
$encoded_params = urlencode($combined_params);
    // Encode the combined string
    return $encoded_params;
}

// GET role of logged in user i.e role_id and role_name pass $this->ion_auth as first parameter
if (!function_exists('get_logged_in_user_role')) {
    function get_logged_in_user_role($ion_auth_instance,$type='id') {
        if ($ion_auth_instance->logged_in()) {
            $user_id = $ion_auth_instance->get_user_id();
            $user_roles = $ion_auth_instance->get_users_groups($user_id)->result_array();
//  echo "<pre>"; print_r($user_roles); exit;
            if (!empty($user_roles)) {
                if($type=='id'){
                  return $user_roles[0]['id'];   
                }else{
                     return $user_roles[0]['name'];  
                }
               
            }
        }

        return null; // Handle the case where the user is not logged in or has no roles
    }
}
// get_all_roles_of_currrent_location
if (!function_exists('get_all_roles')) {
    function get_all_roles($ion_auth_instance,$location_id) {
        if ($ion_auth_instance->logged_in()) {
              $CI = &get_instance();
              $CI->load->database();
              $CI->load->model('ion_auth_model');
              $roles = $CI->ion_auth_model
                      ->where('location_id', $location_id)
                      ->orWhere('location_id', 0)
                       ->groups()
                      ->result_array();
       
       
           
            if (!empty($roles)) {
               return $roles; 
            }
        }
        return null; // Handle the case where the user is not logged in or has no roles
    }
}

if (!function_exists('get_all_datesBetween')) {
   function get_all_datesBetween($fromDate, $toDate) {
    $fromDate = new DateTime($fromDate);
    $toDate = new DateTime($toDate);

    $dates = array();

    while ($fromDate <= $toDate) {
        $dates[] = $fromDate->format('Y-m-d'); // Change the format as needed
        $fromDate->modify('+1 day');
    }

    return $dates;
}
}

if (!function_exists('mergeArrayBasedOnCommonKey')) {
    function mergeArrayBasedOnCommonKey($array1,$array2) {
        
        $lookup = array_reduce($array2, function ($carry, $item) {
    $carry[$item->checklist_id] = $item;
    return $carry;
}, []);

// Merge the arrays based on the common identifier
$mergedArray = array_map(function ($item1) use ($lookup) {
    // Check if there is a match in Array 2 using the identifier
    if (isset($lookup[$item1->id])) {
        // Merge data from both arrays
        return (object) array_merge((array) $item1, (array) $lookup[$item1->id]);
    }
    // If no match is found, return the item from Array 1 as-is
    return $item1;
}, $array1);

return $mergedArray;
        
    }
    
}



if (!function_exists('is_serialized')) {
    function is_serialized($data) {
        // If it isn't a string, it isn't serialized
        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' == $data) {
            return true;
        }
        if (!preg_match('/^([adObis]):/', $data, $badions)) {
            return false;
        }
        switch ($badions[1]) {
            case 'a':
            case 'O':
            case 's':
                if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data)) {
                    return true;
                }
                break;
            case 'b':
            case 'i':
            case 'd':
                if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data)) {
                    return true;
                }
                break;
        }
        return false;
    }
}



