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
$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'Admin';
$route['admin/users'] = 'Admin/users';
$route['admin/vendors'] = 'Admin/vendors';
$route['admin/clients'] = 'Admin/clients';
$route['admin/products'] = 'Admin/products';
$route['admin/viewproduct'] = 'Admin/view_product';
$route['admin/inventory'] = 'Admin/inventory';
$route['admin/security'] = 'Admin/security';
$route['admin/view_transactions'] = 'Admin/view_transactions';
$route['admin/orders'] = 'Admin/orders';
$route['admin/viewsummary'] = 'Admin/view_order_summary';

// Users
$route['user'] = 'Users';
$route['user/log'] = 'Users/attendanceLog';
$route['profile'] = 'Users/profile';
$route['register'] = 'Users/register';

$route['demo/inventory'] = 'Demo/inventory';

$route['login'] = 'Main/login';
$route['FORM_loginValidation'] = 'Main/FORM_loginValidation';
$route['logout'] = 'Main/logout';

// Admin
$route['FORM_addNewUser'] = 'Admin/FORM_addNewUser';
$route['FORM_updateUser'] = 'Admin/FORM_updateUser';
$route['FORM_selfUpdateUser'] = 'Users/FORM_selfUpdateUser';
$route['FORM_selfAddNewUser'] = 'Admin/FORM_selfAddNewUser';
$route['FORM_addNewVendor'] = 'Admin/FORM_addNewVendor';
$route['FORM_updateVendor'] = 'Admin/FORM_updateVendor';
$route['FORM_addNewClient'] = 'Admin/FORM_addNewClient';
$route['FORM_updateClient'] = 'Admin/FORM_updateClient';
$route['FORM_addPurchaseOrder'] = 'Admin/FORM_addPurchaseOrder';
$route['FORM_approvePurchaseOrder'] = 'Admin/FORM_approvePurchaseOrder';

$route['admin/getUserLogs'] = 'AJAX/getUserLogs';
$route['AJAX_validateEmailRegistration'] = 'AJAX/validateEmailRegistration';
$route['AJAX_sendRegistrationEmail'] = 'AJAX/sendRegistrationEmail';

// Products
$route['FORM_addNewProduct'] = 'Admin/FORM_addNewProduct';
$route['FORM_addNewTransaction'] = 'Admin/FORM_addNewTransaction';

// AJAX REQUEST
$route['getTransactionDetails'] = 'Admin/getTransactionDetails';
$route['FORM_approveTransaction'] = 'Admin/FORM_approveTransaction';
$route['getPurchaseDetails'] = 'Admin/getPurchaseDetails';
$route['FORM_removePurchaseOrderTransaction'] = 'Admin/FORM_removePurchaseOrderTransaction';
$route['getVendorDetails'] = 'Admin/getVendorDetails';
$route['getClientDetails'] = 'Admin/getClientDetails';


// Database backup
$route['database_backup'] = 'Admin/database_backup';