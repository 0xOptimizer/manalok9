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

$route['admin/purchase_orders'] = 'Admin/purchase_orders';
$route['admin/view_purchase_order'] = 'Admin/view_purchase_order';
$route['admin/view_purchase_summary'] = 'Admin/view_purchase_orders_summary';
$route['admin/sales_orders'] = 'Admin/sales_orders';
$route['admin/view_sales_order'] = 'Admin/view_sales_order';
$route['admin/view_sales_summary'] = 'Admin/view_sales_orders_summary';
$route['admin/settings_itemcodepage'] = 'Admin/view_settings_itemcode';
$route['admin/product_releasing'] = 'Admin/product_releasing';
$route['admin/product_restocking'] = 'Admin/product_restocking';

$route['admin/bills'] = 'Admin/bills';
$route['admin/invoices'] = 'Admin/invoices';

$route['admin/accounts'] = 'Admin/accounts';
$route['admin/journals'] = 'Admin/journals';

$route['admin/accounting_test'] = 'Admin/accounting_test';


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
$route['FORM_addSalesOrder'] = 'Admin/FORM_addSalesOrder';
$route['FORM_approveSalesOrder'] = 'Admin/FORM_approveSalesOrder';
$route['FORM_removePurchaseOrderTransaction'] = 'Admin/FORM_removePurchaseOrderTransaction';
$route['FORM_removeSalesOrderTransaction'] = 'Admin/FORM_removeSalesOrderTransaction';

$route['AJAX_validateEmailRegistration'] = 'AJAX/validateEmailRegistration';
$route['AJAX_sendRegistrationEmail'] = 'AJAX/sendRegistrationEmail';

$route['get_productDetails'] = 'Admin/get_productDetails';
$route['admin/SubmitNewItemcode'] = 'Admin/SubmitNewItemcode';
$route['admin/remove_thisicode'] = 'Admin/remove_thisicode';

$route['FORM_addAccount'] = 'Admin/FORM_addAccount';
$route['FORM_addJournal'] = 'Admin/FORM_addJournal';

$route['FORM_addPOBill'] = 'Admin/FORM_addPOBill';
$route['FORM_addSOInvoice'] = 'Admin/FORM_addSOInvoice';

$route['FORM_removeBill'] = 'Admin/FORM_removeBill';
$route['FORM_removeInvoice'] = 'Admin/FORM_removeInvoice';

$route['FORM_scheduleDelivery'] = 'Admin/FORM_scheduleDelivery';
$route['FORM_markDelivered'] = 'Admin/FORM_markDelivered';
$route['FORM_markReceived'] = 'Admin/FORM_markReceived';


// Products
$route['FORM_addNewProduct'] = 'Admin/FORM_addNewProduct';
$route['FORM_addNewTransaction'] = 'Admin/FORM_addNewTransaction';
$route['Add_newProductV2'] = 'Admin/Add_newProductV2';
$route['move_to_archive'] = 'Admin/move_to_archive';


// AJAX REQUEST
$route['getTransactionDetails'] = 'Admin/getTransactionDetails';
$route['FORM_approveTransaction'] = 'Admin/FORM_approveTransaction';
$route['getVendorDetails'] = 'Admin/getVendorDetails';
$route['getClientDetails'] = 'Admin/getClientDetails';

$route['getJournalDetails'] = 'Admin/getJournalDetails';

$route['admin/getUserLogs'] = 'AJAX/getUserLogs';
$route['admin/searchClientName'] = 'AJAX/searchClientName';
$route['admin/searchClientDetails'] = 'AJAX/searchClientDetails';
$route['admin/searchVendorName'] = 'AJAX/searchVendorName';
$route['admin/searchVendorDetails'] = 'AJAX/searchVendorDetails';
$route['admin/Add_idtoCart'] = 'AJAX/Add_idtoCart';
$route['admin/Clear_cartSess'] = 'AJAX/Clear_cartSess';
$route['admin/remove_fromCart'] = 'AJAX/remove_fromCart';
$route['admin/get_Cartdata'] = 'AJAX/get_Cartdata';

$route['admin/add_cart_releasing'] = 'AJAX/add_cart_releasing';


// CART
$route['admin/Restock_from_cart'] = 'Admin/Restock_from_cart';

$route['admin/release_fromcart'] = 'Admin/release_fromcart';






// Database backup
$route['database_backup'] = 'Admin/database_backup';