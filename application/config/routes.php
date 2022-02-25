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

$route['admin/manual_transactions'] = 'Admin/manual_transactions';

$route['admin/returns'] = 'Admin/returns';
$route['admin/view_return'] = 'Admin/view_return';

$route['admin/accounts'] = 'Admin/accounts';
$route['admin/journals'] = 'Admin/journals';

$route['admin/trial_balance'] = 'Admin/trial_balance';
$route['admin/income_statement'] = 'Admin/income_statement';
$route['admin/balance_sheet'] = 'Admin/balance_sheet';
$route['admin/cash_flow'] = 'Admin/cash_flow';


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

// VENDOR / CLIENT
$route['FORM_addNewVendor'] = 'Admin/FORM_addNewVendor';
$route['FORM_updateVendor'] = 'Admin/FORM_updateVendor';
$route['FORM_deleteVendor'] = 'Admin/FORM_deleteVendor';
$route['FORM_addNewClient'] = 'Admin/FORM_addNewClient';
$route['FORM_updateClient'] = 'Admin/FORM_updateClient';
$route['FORM_deleteClient'] = 'Admin/FORM_deleteClient';

// SALES ORDER / PURCHASE ORDER
$route['FORM_addPurchaseOrder'] = 'Admin/FORM_addPurchaseOrder';
$route['FORM_approvePurchaseOrder'] = 'Admin/FORM_approvePurchaseOrder';
$route['FORM_addSalesOrder'] = 'Admin/FORM_addSalesOrder';
$route['FORM_approveSalesOrder'] = 'Admin/FORM_approveSalesOrder';
$route['FORM_removePurchaseOrderTransaction'] = 'Admin/FORM_removePurchaseOrderTransaction';

// MANUAL TRANSACTION
$route['FORM_addPOManualTransaction'] = 'Admin/FORM_addPOManualTransaction';

// RETURNS
$route['FORM_addNewReturn'] = 'Admin/FORM_addNewReturn';
$route['FORM_addNewReturnProduct'] = 'Admin/FORM_addNewReturnProduct';
$route['FORM_updateReturnProduct'] = 'Admin/FORM_updateReturnProduct';
$route['FORM_updateReturnProductToInventory'] = 'Admin/FORM_updateReturnProductToInventory';


$route['AJAX_validateEmailRegistration'] = 'AJAX/validateEmailRegistration';
$route['AJAX_sendRegistrationEmail'] = 'AJAX/sendRegistrationEmail';

$route['get_productDetails'] = 'Admin/get_productDetails';
$route['admin/SubmitNewItemcode'] = 'Admin/SubmitNewItemcode';
$route['admin/remove_thisicode'] = 'Admin/remove_thisicode';

// ACCOUNTS / JOURNALS
$route['FORM_addAccount'] = 'Admin/FORM_addAccount';
$route['FORM_updateAccount'] = 'Admin/FORM_updateAccount';
$route['FORM_addJournal'] = 'Admin/FORM_addJournal';
$route['FORM_deleteJournal'] = 'Admin/FORM_deleteJournal';

// BILLS / INVOICES
$route['FORM_addPOBill'] = 'Admin/FORM_addPOBill';
$route['FORM_addSOInvoice'] = 'Admin/FORM_addSOInvoice';
$route['FORM_removeBill'] = 'Admin/FORM_removeBill';
$route['FORM_removeInvoice'] = 'Admin/FORM_removeInvoice';

// SALES ORDER MARKING
$route['FORM_scheduleDelivery'] = 'Admin/FORM_scheduleDelivery';
$route['FORM_markDelivered'] = 'Admin/FORM_markDelivered';
$route['FORM_markReceived'] = 'Admin/FORM_markReceived';

// BRAND ROUTES
$route['view_settings_bcat'] = 'Admin/view_settings_bcat';
$route['Add_BrandCategory'] = 'Admin/Add_BrandCategory';
$route['Update_BrandCategory'] = 'Admin/Update_BrandCategory';
$route['Add_BrandVariant'] = 'Admin/Add_BrandVariant';
$route['remove_addVariants'] = 'Admin/remove_addVariants';
$route['Add_BrandSizes'] = 'AJAX/Add_BrandSizes';
$route['AddNew_BrandSizes'] = 'AJAX/AddNew_BrandSizes';
$route['remove_addSizes'] = 'Admin/remove_addSizes';




// Products
$route['FORM_addNewProduct'] = 'Admin/FORM_addNewProduct';
$route['FORM_addNewTransaction'] = 'Admin/FORM_addNewTransaction';
$route['Add_newProductV2'] = 'Admin/Add_newProductV2';
$route['move_to_archive'] = 'Admin/move_to_archive';
$route['Fill_Select_BrandData'] = 'AJAX/Fill_Select_BrandData';



// AJAX REQUEST
$route['getTransactionDetails'] = 'Admin/getTransactionDetails';
$route['FORM_approveTransaction'] = 'Admin/FORM_approveTransaction';
$route['getVendorDetails'] = 'Admin/getVendorDetails';
$route['getClientDetails'] = 'Admin/getClientDetails';

$route['getJournalDetails'] = 'Admin/getJournalDetails';
$route['admin/getAccountTransactionsRange'] = 'AJAX/getAccountTransactionsRange';

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
$route['GetBrand_data'] = 'AJAX/GetBrand_data';

$route['admin/getUserRestrictions'] = 'AJAX/getUserRestrictions';
$route['admin/getProductStocks'] = 'AJAX/getProductStocks';

$route['admin/getClientSalesOrders'] = 'AJAX/getClientSalesOrders';
$route['admin/getClientSalesOrderProducts'] = 'AJAX/getClientSalesOrderProducts';


// CART
$route['admin/Restock_from_cart'] = 'Admin/Restock_from_cart';

$route['admin/release_fromcart'] = 'Admin/release_fromcart';
$route['FORM_NewTransaction'] = 'Admin/FORM_NewTransaction';



$route['admin/Check_sku_code'] = 'AJAX/Check_sku_code';

// TRASH BIN
$route['admin/trash_bin'] = 'Admin/trash_bin';
$route['admin/redo_arch'] = 'Admin/redo_arch';
$route['admin/delete_prd'] = 'Admin/delete_prd';



// Database backup
$route['database_backup'] = 'Admin/database_backup';

// DELETE BRAND
$route['Del_brand'] = 'Admin/Del_brand';
// UPDATE PRODUCTS
$route['Get_ProductJSON'] = 'AJAX/Get_ProductJSON';
$route['UpdatePricesss'] = 'Admin/UpdatePricesss';
// REMOVE FROM CART RELEASE
$route['removeFCartrelease'] = 'Admin/removeFCartrelease';

// MAILS
$route['admin/page_mail'] = 'Admin/page_mail';
$route['SampleMail'] = 'Mail_Controller/SampleMail';
$route['send_email_to'] = 'Mail_Controller/send_email_to';



$route['admin/xlsSalesOrder'] = 'Exporting/xlsSalesOrder';
$route['admin/xlsPurchaseOrder'] = 'Exporting/xlsPurchaseOrder';

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
$route['admin/submit_releasestockss'] = 'Admin_Extend/submit_releasestockss';

$route['admin/Get_Stock_UsingID'] = 'Admin_Extend/Get_Stock_UsingID';
$route['admin/Delete_Stock_row'] = 'Admin_Extend/Delete_Stock_row';
$route['admin/Update_stockdetails'] = 'Admin_Extend/Update_stockdetails';


