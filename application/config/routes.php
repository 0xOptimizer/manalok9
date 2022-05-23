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

$route['admin'] = 'Admin'; // dashboard
$route['admin/security'] = 'Admin/security';

// $route['admin/view_transactions'] = 'Admin/view_transactions';







// $route['admin/settings_itemcodepage'] = 'Admin/view_settings_itemcode';
// $route['admin/product_releasing'] = 'Admin/product_releasing';
// $route['admin/product_restocking'] = 'Admin/product_restocking';



// $route['FORM_addNewTransaction'] = 'Admin/FORM_addNewTransaction';




// Users
$route['user'] = 'Users';
$route['user/log'] = 'Users/attendanceLog';
$route['profile'] = 'Users/profile';
$route['register'] = 'Users/register';

$route['demo/inventory'] = 'Demo/inventory';

$route['login'] = 'Main/login';
$route['FORM_loginValidation'] = 'Main/FORM_loginValidation';
$route['logout'] = 'Main/logout';

// Products
$route['admin/products'] = 'Admin/products';
$route['admin/viewproduct'] = 'Admin/view_product';

$route['FORM_addNewProduct'] = 'Admin/FORM_addNewProduct';
$route['Add_newProductV2'] = 'Admin/Add_newProductV2';
$route['move_to_archive'] = 'Admin/move_to_archive';
$route['Fill_Select_BrandData'] = 'AJAX/Fill_Select_BrandData';

// RESTOCKING version 2
$route['admin/product_restockingv2'] = 'Admin_Extend/product_restockingv2';
$route['admin/Get_Product_data'] = 'Admin_Extend/Get_Product_data';
$route['admin/Add_stockto_cart'] = 'Admin_Extend/Add_stockto_cart';
$route['admin/Get_uid_prd'] = 'Admin_Extend/Get_uid_prd';
$route['admin/get_cart_fill_table'] = 'Admin_Extend/get_cart_fill_table';
$route['admin/Delete_cart_itemrestock'] = 'Admin_Extend/Delete_cart_itemrestock';
$route['admin/restockin_from_cart'] = 'Admin_Extend/restockin_from_cart';

// RELEASING version 2
$route['admin/product_releasingv2'] = 'Admin_Extend/product_releasingv2';
$route['admin/Get_Stock_details'] = 'Admin_Extend/Get_Stock_details';
$route['admin/Getprd_stocks'] = 'Admin_Extend/Getprd_stocks';
$route['admin/submit_get_prdstocks'] = 'Admin_Extend/submit_get_prdstocks';
$route['admin/submit_get_singlestock'] = 'Admin_Extend/submit_get_singlestock';
$route['admin/submit_releasestockss'] = 'Admin_Extend/submit_releasestockss';

$route['admin/Get_Stock_UsingID'] = 'Admin_Extend/Get_Stock_UsingID';
$route['admin/Delete_Stock_row'] = 'Admin_Extend/Delete_Stock_row';
$route['admin/Update_stockdetails'] = 'Admin_Extend/Update_stockdetails';

$route['admin/Delete_release'] = 'Admin_Extend/Delete_release';
$route['admin/FORM_updateRelease'] = 'Admin_Extend/FORM_updateRelease';

// INVENTORY
$route['admin/inventory'] = 'Admin/inventory';

// Users - Accounts
$route['admin/users'] = 'Admin/users';
$route['admin/user_activities'] = 'Admin/user_activities';

$route['FORM_addNewUser'] = 'Admin/FORM_addNewUser';
$route['FORM_updateUser'] = 'Admin/FORM_updateUser';
$route['FORM_selfUpdateUser'] = 'Users/FORM_selfUpdateUser';
$route['FORM_selfAddNewUser'] = 'Admin/FORM_selfAddNewUser';


// VENDOR
$route['admin/vendors'] = 'PurchaseOrders/vendors';

$route['FORM_addNewVendor'] = 'PurchaseOrders/FORM_addNewVendor';
$route['FORM_updateVendor'] = 'PurchaseOrders/FORM_updateVendor';
$route['FORM_deleteVendor'] = 'PurchaseOrders/FORM_deleteVendor';

// PURCHASE ORDER
$route['admin/purchase_orders'] = 'PurchaseOrders/purchase_orders';
$route['admin/view_purchase_order'] = 'PurchaseOrders/view_purchase_order';
$route['admin/view_purchase_summary'] = 'PurchaseOrders/view_purchase_orders_summary';

$route['FORM_addPurchaseOrder'] = 'PurchaseOrders/FORM_addPurchaseOrder';
$route['FORM_approvePurchaseOrder'] = 'PurchaseOrders/FORM_approvePurchaseOrder';
$route['FORM_updatePORemarks'] = 'PurchaseOrders/FORM_updateRemarks';

$route['admin/xlsPurchaseOrder'] = 'Exporting/xlsPurchaseOrder';

// BILLS 
$route['admin/bills'] = 'PurchaseOrders/bills';

$route['FORM_addPOBill'] = 'PurchaseOrders/FORM_addPOBill';
$route['FORM_addBill'] = 'PurchaseOrders/FORM_addBill';
$route['admin/FORM_removeBill'] = 'PurchaseOrders/FORM_removeBill';
$route['FORM_updateBill'] = 'PurchaseOrders/FORM_updateBill';

// MANUAL TRANSACTION
$route['admin/manual_purchases'] = 'PurchaseOrders/manual_purchases';

$route['FORM_addNewManualTransaction'] = 'PurchaseOrders/FORM_addNewManualTransaction';
$route['admin/FORM_removeManualTransaction'] = 'PurchaseOrders/FORM_removeManualTransaction';


// CLIENT
$route['admin/clients'] = 'SalesOrders/clients';

$route['FORM_addNewClient'] = 'SalesOrders/FORM_addNewClient';
$route['FORM_updateClient'] = 'SalesOrders/FORM_updateClient';
$route['FORM_deleteClient'] = 'SalesOrders/FORM_deleteClient';

// SALES ORDER
$route['admin/sales_orders'] = 'SalesOrders/sales_orders';
$route['admin/view_sales_order'] = 'SalesOrders/view_sales_order';
$route['admin/view_sales_summary'] = 'SalesOrders/view_sales_orders_summary';

$route['FORM_addSalesOrder'] = 'SalesOrders/FORM_addSalesOrder';
$route['FORM_addNewSOAdtlFee'] = 'SalesOrders/FORM_addNewSOAdtlFee';
$route['FORM_updateSOAdtlFee'] = 'SalesOrders/FORM_updateSOAdtlFee';
$route['admin/FORM_removeSOAdtlFee'] = 'SalesOrders/FORM_removeSOAdtlFee';
$route['FORM_approveSalesOrder'] = 'SalesOrders/FORM_approveSalesOrder';
$route['FORM_scheduleDelivery'] = 'SalesOrders/FORM_scheduleDelivery';
$route['FORM_markDelivered'] = 'SalesOrders/FORM_markDelivered';
$route['FORM_markReceived'] = 'SalesOrders/FORM_markReceived';
$route['FORM_updateSORemarks'] = 'SalesOrders/FORM_updateRemarks';

$route['FORM_deleteSalesOrder'] = 'SalesOrders/FORM_deleteSalesOrder';
$route['FORM_addNewSOTransaction'] = 'SalesOrders/FORM_addNewSOTransaction';
$route['FORM_removeSOTransaction'] = 'SalesOrders/FORM_removeSOTransaction';

$route['admin/xlsSalesOrder'] = 'Exporting/xlsSalesOrder';

// INVOICES
$route['admin/invoices'] = 'SalesOrders/invoices';

$route['FORM_addSOInvoice'] = 'SalesOrders/FORM_addSOInvoice';
$route['FORM_addInvoice'] = 'SalesOrders/FORM_addInvoice';
$route['admin/FORM_removeInvoice'] = 'SalesOrders/FORM_removeInvoice';

// RETURNS
$route['admin/returns'] = 'SalesOrders/returns';
$route['admin/view_return'] = 'SalesOrders/view_return';

$route['FORM_addNewReturn'] = 'SalesOrders/FORM_addNewReturn';
$route['FORM_addNewReturnProduct'] = 'SalesOrders/FORM_addNewReturnProduct';
// $route['FORM_updateReturnProduct'] = 'SalesOrders/FORM_updateReturnProduct';
// $route['FORM_updateReturnProductToInventory'] = 'SalesOrders/FORM_updateReturnProductToInventory';
$route['admin/FORM_removeReturnProduct'] = 'SalesOrders/FORM_removeReturnProduct';

// REPLACEMENTS
$route['admin/replacements'] = 'SalesOrders/replacements';

$route['FORM_addNewReplacement'] = 'SalesOrders/FORM_addNewReplacement';
$route['FORM_approveReplacement'] = 'SalesOrders/FORM_approveReplacement';
$route['admin/FORM_removeReplacement'] = 'SalesOrders/FORM_removeReplacement';

// ACCOUNTS
$route['admin/accounts'] = 'Accounting/accounts';
$route['admin/accounts_summary'] = 'Accounting/accounts_summary';
$route['admin/trial_balance'] = 'Accounting/trial_balance';
$route['admin/accounting_reports'] = 'Accounting/accounting_reports';
$route['admin/balance_sheet'] = 'Accounting/balance_sheet';
$route['admin/cash_flow'] = 'Accounting/cash_flow';

$route['FORM_addAccount'] = 'Accounting/FORM_addAccount';
$route['FORM_updateAccount'] = 'Accounting/FORM_updateAccount';

// JOURNALS
$route['admin/journals'] = 'Accounting/journals';

$route['FORM_addJournal'] = 'Accounting/FORM_addJournal';
$route['FORM_deleteJournal'] = 'Accounting/FORM_deleteJournal';

// BRAND ROUTES
$route['view_settings_bcat'] = 'Admin/view_settings_bcat';
$route['Add_BrandCategory'] = 'Admin/Add_BrandCategory';
$route['Update_BrandCategory'] = 'Admin/Update_BrandCategory';

$route['Add_BrandVariant'] = 'Admin/Add_BrandVariant';
$route['remove_addVariants'] = 'Admin/remove_addVariants';

$route['Add_BrandSizes'] = 'AJAX/Add_BrandSizes';
$route['AddNew_BrandSizes'] = 'AJAX/AddNew_BrandSizes';
$route['remove_addSizes'] = 'Admin/remove_addSizes';

// TRASH BIN
$route['admin/trash_bin'] = 'Admin/trash_bin';
$route['admin/redo_arch'] = 'Admin/redo_arch';
$route['admin/delete_prd'] = 'Admin/delete_prd';

// MAILS
$route['admin/page_mail'] = 'Admin/page_mail';
$route['SampleMail'] = 'Mail_Controller/SampleMail';
$route['send_email_to'] = 'Mail_Controller/send_email_to';




$route['AJAX_validateEmailRegistration'] = 'AJAX/validateEmailRegistration';
$route['AJAX_sendRegistrationEmail'] = 'AJAX/sendRegistrationEmail';

// $route['get_productDetails'] = 'Admin/get_productDetails';
// $route['admin/SubmitNewItemcode'] = 'Admin/SubmitNewItemcode';
// $route['admin/remove_thisicode'] = 'Admin/remove_thisicode';






// AJAX REQUEST

$route['admin/getVendorDetails'] = 'AJAX/getVendorDetails';
$route['admin/searchVendorName'] = 'AJAX/searchVendorName';
$route['admin/searchVendorDetails'] = 'AJAX/searchVendorDetails';

$route['admin/getClientDetails'] = 'AJAX/getClientDetails';
$route['admin/searchClientName'] = 'AJAX/searchClientName';
$route['admin/searchClientDetails'] = 'AJAX/searchClientDetails';

$route['admin/getUserLogs'] = 'AJAX/getUserLogs';

// $route['getTransactionDetails'] = 'Admin/getTransactionDetails';
// $route['FORM_approveTransaction'] = 'Admin/FORM_approveTransaction';

$route['admin/getJournalDetails'] = 'AJAX/getJournalDetails';
$route['admin/getJournalTransactions'] = 'AJAX/getJournalTransactions';
$route['admin/getAccountTransactionsRange'] = 'AJAX/getAccountTransactionsRange';

$route['admin/Add_idtoCart'] = 'AJAX/Add_idtoCart';
$route['admin/Clear_cartSess'] = 'AJAX/Clear_cartSess';
$route['admin/remove_fromCart'] = 'AJAX/remove_fromCart';
$route['admin/get_Cartdata'] = 'AJAX/get_Cartdata';

$route['admin/add_cart_releasing'] = 'AJAX/add_cart_releasing';
$route['GetBrand_data'] = 'AJAX/GetBrand_data';

$route['admin/getUserRestrictions'] = 'AJAX/getUserRestrictions';
$route['admin/getProductStocks'] = 'AJAX/getProductStocks';

$route['admin/getClientSalesOrders'] = 'AJAX/getClientSalesOrders';
$route['admin/getClientSalesOrderProducts'] = 'AJAX/getClientSalesOrderProducts';

$route['admin/getSODetails'] = 'AJAX/Get_SODetails';
// $route['admin/getSOAdtlFee'] = 'AJAX/Get_SOAdtlFee';

$route['admin/getReturnTransactionDetails'] = 'AJAX/getReturnTransactionDetails';

// CART
$route['admin/Restock_from_cart'] = 'Admin/Restock_from_cart';

$route['admin/release_fromcart'] = 'Admin/release_fromcart';
$route['FORM_NewTransaction'] = 'Admin/FORM_NewTransaction';


$route['admin/Check_sku_code'] = 'AJAX/Check_sku_code';




// Database backup
$route['database_backup'] = 'Admin/database_backup';

// DELETE BRAND
$route['Del_brand'] = 'Admin/Del_brand';
// UPDATE PRODUCTS
$route['Get_ProductJSON'] = 'AJAX/Get_ProductJSON';
$route['UpdatePricesss'] = 'Admin/UpdatePricesss';
// REMOVE FROM CART RELEASE
$route['removeFCartrelease'] = 'Admin/removeFCartrelease';





