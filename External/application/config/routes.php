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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = '/';
// Path for supplier viewing order
// this should be the structure of all the url
// baseurl/keword/encodedparamaters
//encodedparams = tenatIdentifier ."|". rest all other params as required

$route['viewOrder/([^\s]+)'] ='Supplier/Orders/viewOrder/$1';
$route['Orders/confirmOrder'] ='Supplier/Orders/confirmOrder';
$route['Orders/uploadInvoice'] ='Supplier/Orders/uploadInvoice';

// for manager to approve order without being logged in 

$route['Supplier/approveBudgetExceedOrder/(:any)/(:any)'] ='Supplier/Orders/approveBudgetExceedOrder/$1/$2';

$route['viewBankOrder/([^\s]+)'] ='Cash/Orders/viewOrder/$1';
$route['Orders/confirmBankOrder'] ='Cash/Orders/confirmBankOrder';

// HR Management routes

$route['HR/onboardingForm/(:any)'] ='HR/Employee/onboardingForm/$1';
$route['HR/approveLeave/(:any)'] ='HR/Employee/approveLeave/$1';
$route['HR/rejectLeave/(:any)'] ='HR/Employee/rejectLeave/$1';
$route['Employee/submit_onboarding_process'] ='HR/Employee/submit_onboarding_process';
$route['Employee/uploadFaceImage'] ='HR/Employee/uploadFaceImage';

// catering Site
$route['order_approval/([^\s]+)'] ='Catering/Order/order_approval/$1';
$route['updateOrderStatus'] = 'Catering/Order/updateOrderStatus';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
