<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// always try to pass user_id and role_id so that if menu is defined at user_leve it will priortized else role level menu will be fetched with 
// selected = selected for those indexes wch has been assigned to this role_id or user_id
if (!function_exists('fetch_render_menu')) {
    // $callType is to decide if this mthod has been called by ajax or normal call, incase of ajax it will return json_encoded object
    function fetch_render_menu($system_id,$user_id='',$role_id='',$callType='') {
        $CI = &get_instance();
        $CI->load->database();
        $CI->load->library('session');
        $CI->load->library('ion_auth');

        // Fetch menu items for this particular system like HR, Supplier etc.
        $menu_for = $system_id;
        $CI->db->where('menu_for', $menu_for);
        $CI->db->where('is_deleted', 0);
        $CI->db->where('status', 1);
        $CI->db->order_by('sort_order', 'ASC'); 
        
        $query = $CI->db->get('menu');
        $menu_items = $query->result();
      

        // Fetch sub menu items for each menu item
        foreach ($menu_items as $menu_item) {
            $menu_item->sub_menu = get_sub_menu_by_parent_id($menu_item->menu_id);
        }
        
        if($role_id == 1){
            // for superadmin
         return  addSelectedToMenu($menu_items);
        }
      
    //   NOTE : if menu is assigned at user level to user A, than if u assign menu at role level , even though user A has that role, lets say Admin
    //   he cannot see those menus assigned to role Admin, u have to assign all menu at user level , if u want user A to see any menu
    //   but vice versa will work that is if 5 menus are assigned to role Admin and if u want to user A to restrict and see 3 menus only u can do so at user level
    //   menu configuration
    
        // filter only those menu Out of all menu which are assigned to this user for this system
        $userMenus = array(); $userSubMenus = array();
        if($user_id != ''){
           
         $user = $CI->ion_auth->user($user_id)->row();
         $overwriteRoleLevelMenu = $user->overwriteRoleLevelMenu;
         
         $userMenus = (($user) ? unserialize($user->menu_ids) : array());   
         $userSubMenus = (($user) ? unserialize($user->sub_menu_ids) : array());
          $userMenus = (isset($userMenus[$system_id]) ? $userMenus[$system_id] : array());
         $userSubMenus = (isset($userSubMenus[$system_id]) ? $userSubMenus[$system_id] : array());
        }
       // basically we have a checkbox in configure menu wch decide if we want to hide all menus from a specific user and even menu assigned at role level, wilnot be vis
    //   visible
        
        if(empty($userMenus) && (isset($overwriteRoleLevelMenu) && $overwriteRoleLevelMenu == 0)){
         $role = $CI->ion_auth->group($role_id)->row();;
         
         $userMenus = (($role) ? unserialize($role->menu_ids) : array());   
    //  
         $userSubMenus = (($role) ? unserialize($role->sub_menu_ids) : array()); 
         $userMenus = (isset($userMenus[$system_id]) ? $userMenus[$system_id] : array());
         $userSubMenus = (isset($userSubMenus[$system_id]) ? $userSubMenus[$system_id] : array());
        }
     
         if(!empty($userMenus)){
          $filteredMenus = array();
          $filteredMenus = array_filter($menu_items, function ($menu) use ($userMenus, $userSubMenus) {
           return in_array($menu->menu_id, $userMenus) &&
           count(array_filter($menu->sub_menu, function ($subMenu) use ($userSubMenus) {
               return in_array($subMenu->id, $userSubMenus);
           })) > 0;
         });
      
          // add "selected" index for those menus or submenus wch are assigned to this user_id or role_id for rest dont add index
          $filteredMenus = array_map(function ($menu) use ($userMenus, $userSubMenus) {
          $menu->selected = in_array($menu->menu_id, $userMenus);
          $menu->sub_menu = array_map(function ($subMenu) use ($userSubMenus) {
          $subMenu->selected = in_array($subMenu->id, $userSubMenus);
            return $subMenu;
           }, $menu->sub_menu);
             return $menu;
            }, $menu_items);   
  
         } else{
             return $menu_items;
         }
      
      
         return $filteredMenus;
    }
    
       function addSelectedToMenu( $menuArray){
        if (empty($menuArray)) {
            return [];
        }

        $modifiedArray = [];
        foreach ($menuArray as $index => $menu) {
            // Ensure menu is an object or array with required fields
            if (!is_object($menu) && !is_array($menu)) {
                continue;
            }

            // Convert to stdClass if array
            $menuObj = is_array($menu) ? (object) $menu : clone $menu;
            
            // Add selected => true to menu
            $menuObj->selected = true;
            
            // Initialize sub_menu if not set
            $menuObj->sub_menu = isset($menuObj->sub_menu) && is_array($menuObj->sub_menu) 
                ? $menuObj->sub_menu 
                : [];
            
            // Process sub-menus
            $modifiedSubMenu = [];
            foreach ($menuObj->sub_menu as $subIndex => $subMenu) {
                if (!is_object($subMenu) && !is_array($subMenu)) {
                    continue;
                }
                
                // Convert to stdClass if array
                $subMenuObj = is_array($subMenu) ? (object) $subMenu : clone $subMenu;
                
                // Add selected => true to sub-menu
                $subMenuObj->selected = true;
                
                $modifiedSubMenu[$subIndex] = $subMenuObj;
            }
            
            // Ensure sub_menu is numerically indexed
            $menuObj->sub_menu = array_values($modifiedSubMenu);
            
            $modifiedArray[$index] = $menuObj;
        }
        
        // Ensure top-level array is numerically indexed
        return array_values($modifiedArray);
    }
    
    function fetch_render_menu_for_setting($system_id,$user_id='',$role_id='',$callType='') {
        $CI = &get_instance();
        $CI->load->database();
        $CI->load->library('session');
        $CI->load->library('ion_auth');

        // Fetch menu items for this particular system like HR, Supplier etc.
        $menu_for = $system_id;
        $CI->db->where('menu_for', $menu_for);
        $CI->db->where('is_deleted', 0);
        $CI->db->where('status', 1);
        $CI->db->order_by('sort_order', 'ASC'); 
        
        $query = $CI->db->get('menu');
        $menu_items = $query->result();
      

        // Fetch sub menu items for each menu item
        foreach ($menu_items as $menu_item) {
            $menu_item->sub_menu = get_sub_menu_by_parent_id($menu_item->menu_id);
        }
      
  
    
        // filter only those menu Out of all menu which are assigned to this user for this system
        $userMenus = array(); $userSubMenus = array();
        if($user_id != ''){
           
         $user = $CI->ion_auth->user($user_id)->row();
         $overwriteRoleLevelMenu = $user->overwriteRoleLevelMenu;
         
         $userMenus = (($user) ? unserialize($user->menu_ids) : array());   
         $userSubMenus = (($user) ? unserialize($user->sub_menu_ids) : array());
          $userMenus = (isset($userMenus[$system_id]) ? $userMenus[$system_id] : array());
         $userSubMenus = (isset($userSubMenus[$system_id]) ? $userSubMenus[$system_id] : array());
        }
       // basically we have a checkbox in configure menu wch decide if we want to hide all menus from a specific user and even menu assigned at role level, wilnot be vis
    //   visible
        
        if(empty($userMenus)){
         $role = $CI->ion_auth->group($role_id)->row();;
        //  echo $system_id;
         $userMenus = (($role) ? unserialize($role->menu_ids) : array());   
        //   echo "<pre>"; print_r($userMenus); exit;
         $userSubMenus = (($role) ? unserialize($role->sub_menu_ids) : array()); 
         $userMenus = (isset($userMenus[$system_id]) ? $userMenus[$system_id] : array());
         $userSubMenus = (isset($userSubMenus[$system_id]) ? $userSubMenus[$system_id] : array());
        }
     
         if(!empty($userMenus)){
             
          $filteredMenus = array();
          $filteredMenus = array_filter($menu_items, function ($menu) use ($userMenus, $userSubMenus) {
           return in_array($menu->menu_id, $userMenus) &&
           count(array_filter($menu->sub_menu, function ($subMenu) use ($userSubMenus) {
               return in_array($subMenu->id, $userSubMenus);
           })) > 0;
         });
      
          // add "selected" index for those menus or submenus wch are assigned to this user_id or role_id for rest dont add index
          $filteredMenus = array_map(function ($menu) use ($userMenus, $userSubMenus) {
          $menu->selected = in_array($menu->menu_id, $userMenus);
          $menu->sub_menu = array_map(function ($subMenu) use ($userSubMenus) {
          $subMenu->selected = in_array($subMenu->id, $userSubMenus);
            return $subMenu;
           }, $menu->sub_menu);
             return $menu;
            }, $menu_items);   
  
         } else{
             return $menu_items;
         }
      
      
         return $filteredMenus;
    }

    function get_sub_menu_by_parent_id($parent_menu_id) {
        $CI = &get_instance();
        $CI->load->database(); // Load the database library if not already loaded

        // Fetch sub menu items based on 'parent_menu_id'
         $CI->db->where('is_deleted', 0);
        $CI->db->where('status', 1);
        $CI->db->where('parent_menu_id', $parent_menu_id);
        $CI->db->order_by('sort_order', 'ASC');
        $query = $CI->db->get('sub_menu');
        return $query->result();
    }
}
