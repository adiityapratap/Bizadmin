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
|	$route['Catering/default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['Catering/404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['Catering/translate_uri_dashes'] = FALSE;
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
$route['Catering/login'] = 'auth/login';
$route['Catering/logout'] = 'auth/logout';
$route['Catering/users'] = 'auth/index';
// $route['Catering/users'] = 'auth/create_user';
$route['Catering/forgot_password'] = 'auth/forgot_password';

$route['Catering/default_controller'] = 'general/dashboard';
$route['Catering/dashboard'] = 'general/dashboard';


// quotes page route
$route['Catering/new_quote'] = 'quote/quoteForm';
$route['Catering/edit_quote/(:any)'] = 'quote/quoteForm/$1';
$route['Catering/quoteList'] = 'quote/quoteList';
$route['Catering/new_company'] = 'customer/addNewCompany';
$route['Catering/new_department'] = 'customer/addNewDepartment';
$route['Catering/fetchCompaniesAndDepartment'] = 'customer/fetchCompaniesAndDepartment';
$route['Catering/new_customer'] = 'customer/addNewCustomer';
$route['Catering/new_quotes_save'] = 'quote/newQuoteSave';
$route['Catering/new_quote_products'] = 'quote/placeQuote';
$route['Catering/edit_quote_products'] = 'quote/updateQuote';
$route['Catering/viewOrderDetails/(:any)'] = 'quote/viewOrderDetails/$1';
$route['Catering/send_quote_email/(:any)'] = 'quote/send_quote_email/$1';
$route['Catering/convertToInvoice'] = 'quote/convertToInvoice';
$route['Catering/order_approval/(:any)'] = 'external/order_approval/$1';
// $route['Catering/tiny/(:any)'] = 'external/order_approval/$1';
$route['Catering/chnage_product_sort_order'] = 'quote/chnage_product_sort_order';


// Orders
$route['Catering/new_order'] = 'quote/orderForm';
$route['Catering/futureOrder'] = 'order/orderList/';
$route['Catering/pastOrder'] = 'order/pastOrderList';
$route['Catering/sendPaymentLink'] = 'order/sendPaymentLink';
$route['Catering/sendInvoice'] = 'order/sendInvoice';
$route['Catering/add_late_fee/(:any)/(:any)'] = 'quote/add_late_fee/$1/$2';
$route['Catering/downloadInvoice/(:any)'] = 'order/downloadInvoice/$1';
$route['Catering/generatePaymentLink'] = 'order/generatePaymentLink';
$route['Catering/reports'] = 'report/generateReport';
$route['Catering/fetchReport'] = 'report/fetchReport';
$route['Catering/markPaid'] = 'order/markPaid';
$route['Catering/reminderOrders'] = 'order/reminderOrders';
$route['Catering/sendPaymentReminderMail'] = 'order/sendPaymentReminderMail';
$route['Catering/collectPayment/(:any)'] = 'order/collectPayment/$1';
$route['Catering/paymentProcess'] = 'order/paymentProcess';
$route['Catering/viewProductionPage/(:any)'] = 'order/viewProductionPage/$1';
$route['Catering/updatePreparedStatus'] = 'order/updatePreparedStatus';
$route['Catering/removeCoupon/(:any)'] = 'order/removeCoupon/$1';
$route['Catering/reorder'] = 'order/reorder';
$route['Catering/markCompleted'] = 'order/markCompleted';

// customer, company, dept, product,category,coupon
$route['Catering/customerList'] = 'customer/customerList';
$route['Catering/companyList'] = 'customer/companyList';
$route['Catering/departmentList'] = 'customer/departmentList';
$route['Catering/productsList'] = 'product/productsList';
$route['Catering/new_product'] = 'product/addNewProduct';
$route['Catering/categoryList'] = 'product/categoryList';
$route['Catering/new_category'] = 'product/addNewCategory';

$route['Catering/coupons'] = 'order/couponsList';
$route['Catering/couponsStatusUpdate/(:any)/(:any)'] = 'order/couponsStatusUpdate/$1/$2';
$route['Catering/validateCoupon/(:any)'] = 'order/validateCoupon/$1';

// general
$route['Catering/deleteRecord'] = 'general/deleteRecord';
$route['Catering/settings'] = 'general/settings';
$route['Catering/fetchSettingsLocationWise'] = 'general/fetchSettingsLocationWise';
$route['Catering/save_locations'] = 'general/save_locations';
$route['Catering/commonUpdaterecord'] = 'general/commonUpdaterecord';


// dashboard
$route['Catering/Catering/cateringCheckList/(:any)'] = 'order/cateringCheckList/$1';
$route['Catering/Catering/submitCateringCheckList'] = 'order/submitCateringCheckList';

// old routes
$route['Catering/Catering/paymentLink'] = 'orders/securepay_customer_link/$1';
$route['Catering/Catering/orders/general/new_company'] = 'general/new_company';


$route['Catering/Catering/orders/general/new_department'] = 'general/new_department';
$route['Catering/Catering/general/general/new_department'] = 'general/new_department';
$route['Catering/general/general/validateCustomer'] = 'general/validateCustomer';
$route['Catering/orders/general/validateCustomer'] = 'general/validateCustomer';

$route['Catering/404_override'] = '';
$route['Catering/translate_uri_dashes'] = FALSE;

$route['Catering/saveSettings']= 'Config/saveSettings';

