<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$routes['enableDebug'] = true;
// application/config/routes.php

// Home controller
     $route['logout'] = 'Auth/logout';
     $route['default_controller'] = 'Home';
     $route['index'] = 'Home/index';

    $route['Cash/daily']= 'Floatbc/daily';
    $route['Cash/daily/(:any)']= 'Floatbc/daily/$1';
    $route['Cash/weekly']= 'Floatbc/weekly';
    $route['Cash/monthly']= 'Floatbc/monthly';
    $route['Cash/weekly/(:any)']= 'Floatbc/weekly/$1';
    $route['Cash/monthly/(:any)']= 'Floatbc/monthly/$1';
    
    
    $route['Cash/CashD/delete']= 'CashD/delete';
    $route['Cash/CashD/(:any)']= 'CashD/index/$1';
    $route['Cash/cashdadd/(:any)']= 'CashD/cashdAdd/$1';
    $route['Cash/cashdview/(:any)']= 'CashD/view/$1';
    $route['Cash/cashdedit/(:any)']= 'CashD/edit/$1'; 
    $route['Cash/cashD/update']= 'CashD/update';
    $routes['Cash/endshift'] = 'CashD/endShift';
    $route['Cash/endshift/(:any)']= 'CashD/endShift/$1';
   
    
    
    // Bank Deposit and Bank reconcile
    
    $route['Cash/BankDeposit/(:any)']= 'BankDeposit/index/$1';
    $route['Cash/reconcile']= 'BankDeposit/reconcile';
    $route['Cash/archiveBankReconcile']= 'BankDeposit/archiveBankReconcile';
    $route['Cash/submitreconcile']= 'BankDeposit/saveReconcileForm';
    $route['Cash/uploadBankReceipt']= 'BankDeposit/uploadBankReceipt';
    $route['Cash/fetchBankReceipt']= 'BankDeposit/fetchBankReceipt';
    $route['Cash/markSelectedDateAsCompleted']= 'BankDeposit/markSelectedDateAsCompleted';
    
    
    
    // FLOAT (SAFE)
    
    $route['Cash/Floatbc/floatadd/(:any)']= 'Floatbc/floatAdd/$1';
    $route['Cash/floatadd/(:any)']= 'Floatbc/floatAdd/$1';
    $route['Cash/floatview/(:any)']= 'Floatbc/view/$1';
    $route['Cash/floatedit/(:any)']= 'Floatbc/edit/$1';
    $route['Cash/Floatbc/update/(:any)']= 'Floatbc/update/$1';
    $routes['Cash/weekly/Floatbc/delete']= 'Floatbc/delete';
    
    
    // $routes['Cash/configureFloatSubmit']= 'Floatbc/configureFloats';
    
    // FLOAT BUILD ( FRONT OFFICE BUILDS )
    
    //list
    $route['Cash/frontOfficeBuild']= 'Floatbc/ListfrontOfficeBuild';
    // add,Update
    $route['Cash/frontOfficeBuildAdd']= 'Floatbc/frontOfficeBuild';
    $route['Cash/frontOfficeBuildUpdate/(:any)']= 'Floatbc/frontOfficeBuildUpdate/$1';
    // view , edit,delete
    $route['Cash/frontOfficeBuildAction/(:any)']= 'Floatbc/ViewEditfrontOfficeBuild/$1';
    $route['Cash/DeletefrontOfficeBuild']= 'Floatbc/DeletefrontOfficeBuild';
    $route['Cash/sendBankOrderEmail']= 'Floatbc/sendBankOrderMailToBank';
    
    // FLOAT BUILD ( OFFICE BUILDS )
    
     //list
    $route['Cash/officeBuild']= 'Floatbc/ListofficeBuild';
    // add,Update
    $route['Cash/officeBuildAdd']= 'Floatbc/officeBuild';
    $route['Cash/officeBuildUpdate/(:any)']= 'Floatbc/officeBuildUpdate/$1';
    // view , edit,delete
    $route['Cash/officeBuildAction/(:any)']= 'Floatbc/ViewEditOfficeBuild/$1';
    $route['Cash/DeleteofficeBuild']= 'Floatbc/DeleteOfficeBuild';
    
     $route['Cash/outer-url/(:any)'] = 'Outerurl/getBankOrderById/$1';
    $route['Cash/cfb'] = 'Outerurl/confirmBankOrder';
       
  //// Float BUILD END- ============  =========
  
  
  /// CONFIGURATION 
  $route['Cash/configureFloats']= 'Config/configureAddUpdate';
  $route['Cash/configuresubmit']= 'Config/configureAddUpdate';
  $route['Cash/floatConfiguresubmit']= 'Config/configureFloat';
  $route['Cash/configureAutomatedNotificationsubmit']= 'Config/configureAutomatedNotificationsubmit';

    
    
  
