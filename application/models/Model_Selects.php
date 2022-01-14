<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Selects extends CI_Model {

	public function GetUserID($userID, $table)
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('UserID', $userID);
		$result = $this->db->get($table);  
		return $result;
	}
	public function GetAllUsers()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('users');  
		return $result;
	}
	public function GetUserHistory($userID)
	{
		$this->db->select('*');
		$this->db->where('UserID', $userID);
		$this->db->order_by('ID', 'desc');
		$this->db->limit('5');
		$result = $this->db->get('logbook');  
		return $result;
	}
	public function GetAllProducts()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'asc');
		$result = $this->db->get('products');  
		return $result;
	}
	public function GetProductByCode($code)
	{
		$this->db->select('*');
		$this->db->where('Code', $code);
		$result = $this->db->get('products');  
		return $result;
	}
	public function GetTransactionsByCode($code)
	{
		$this->db->select('*');
		$this->db->where('Code', $code);
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function GetTransactionsByUserID($userID)
	{
		$this->db->select('*');
		$this->db->where('UserID', $userID);
		$this->db->order_by('DateAdded', 'desc');
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function getAllTransactions()
	{
		$this->db->select('*');
		$this->db->order_by('DateAdded', 'desc');
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function getall_transaction($data)
	{
		extract($data);
		$this->db->select('*');
		$this->db->where('TransactionID', $TransactionID);
		$result = $this->db->get('products_transactions');  
		return $result->row_array();
	}
	public function CheckIFApproved($TransactionID)
	{
		$this->db->select('*');
		$this->db->where('TransactionID', $TransactionID);
		$result = $this->db->get('products_transactions');  
		return $result->row_array();
	}
	public function CheckStocksByCode($code)
	{
		$this->db->select('*');
		$this->db->where('Code', $code);
		$result = $this->db->get('products');  
		return $result->row_array();
	}
	public function GetAllSecurityLogs()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('security_log');  
		return $result;
	}
	public function C_Products_perMonth($c_year,$val)
	{
		$sql = "SELECT EXTRACT(MONTH FROM DateAdded) as months, EXTRACT(YEAR FROM DateAdded) as year,SUM(InStock) as total  FROM products WHERE YEAR(DateAdded) = '$c_year' AND MONTH(DateAdded) = '$val' GROUP BY months,year ORDER BY months ASC";
		$result = $this->db->query($sql);
		return $result->row_array();
	}
	public function total_product_stocks()
	{
		$this->db->select_sum('InStock');
		$result = $this->db->get('products');
		return $result->row_array();
	}
	public function total_product_thismonth($c_year,$c_month)
	{

		$this->db->select_sum('InStock');
		$this->db->where(array('MONTH(DateAdded)'=> $c_month, 'YEAR(DateAdded)' => $c_year));
		$result = $this->db->get('products');
		return $result->row_array();
	}

	public function GetUserLogs($userID)
	{
		$this->db->select('*');
		$this->db->where('UserID', $userID);
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('logbook'); 
		return $result;
	}
	public function GetUserRestrictions($userID)
	{
		$this->db->select('Action, Allowed');
		$this->db->where('UserID', $userID);
		$this->db->order_by('ID', 'asc');
		$result = $this->db->get('user_restrictions'); 
		return $result;
	}
	public function GetDashboardLogs()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->limit('5');
		$result = $this->db->get('logbook'); 
		return $result;
	}
	public function GetToken($token)
	{
		$this->db->select('*');
		$this->db->where('Token', $token);
		$result = $this->db->get('users_registrations'); 
		return $result;
	}

	// VENDORS
	public function GetVendors()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('vendors');
		return $result;
	}
	public function GetVendorByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('vendors');
		return $result;
	}
	public function GetVendorByNo($no)
	{
		$this->db->select('*');
		$this->db->where('VendorNo', $no);
		$result = $this->db->get('vendors');
		return $result;
	}
	// CLIENTS
	public function GetClients()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('clients');
		return $result;
	}
	public function GetClientByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('clients');
		return $result;
	}
	public function GetClientByNo($no)
	{
		$this->db->select('*');
		$this->db->where('ClientNo', $no);
		$result = $this->db->get('clients');
		return $result;
	}

	// SALES
	public function GetAllSalesOrders()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('sales_orders');  
		return $result;
	}
	public function GetSalesOrders($status)
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('Status', $status);
		$result = $this->db->get('sales_orders');
		return $result;
	}
	public function GetSalesOrderByNo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('sales_orders');  
		return $result;
	}
	public function GetInvoices()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('invoices');  
		return $result;
	}
	public function GetInvoicesBySONo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('invoices');  
		return $result;
	}
	public function GetTotalInvoicesBySONo($orderNo)
	{
		$this->db->select_sum('Amount');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('invoices');  
		return $result;
	}

	public function GetAllReleases()
	{
		$this->db->select('*');
		$this->db->where('Type', '1');
		$this->db->order_by('DateAdded', 'desc');
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function GetTransactionsByTID($id)
	{
		$this->db->select('*');
		$this->db->where('TransactionID', $id);
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function GetTransactionsByOrderNo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetTransactionsReleasedUnordered()
	{
		$this->db->select('*');
		$this->db->where('OrderNo', NULL);
		$this->db->where('Type', '1');
		$this->db->where('Status', '0');
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetAllSalesOrderedTransactions()
	{
		$this->db->select('*');
		$this->db->where('OrderNo !=', NULL);
		$this->db->where('Type', '1');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetSalesOrderedTransactions($status)
	{
		$sql = "SELECT * FROM products_transactions AS ot WHERE Type = '1' AND EXISTS(SELECT * FROM sales_orders AS so WHERE so.OrderNo = ot.OrderNo AND Status = $status)";
		$result = $this->db->query($sql);
		return $result;
	}

	public function GetStockedProducts()
	{
		$this->db->select('*');
		$this->db->where('InStock >', '0');
		$this->db->order_by('ID', 'asc');
		$result = $this->db->get('products'); 
		return $result;
	}
	// PURCHASE
	public function GetAllPurchaseOrders()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('purchase_orders');  
		return $result;
	}
	public function GetPurchaseOrders($status)
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('Status', $status);
		$result = $this->db->get('purchase_orders');
		return $result;
	}
	public function GetPurchaseOrderByNo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('purchase_orders');  
		return $result;
	}
	public function GetBills()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('bills');  
		return $result;
	}
	public function GetBillsByPONo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('bills');  
		return $result;
	}
	public function GetTotalBillsByPONo($orderNo)
	{
		$this->db->select_sum('Amount');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('bills');  
		return $result;
	}

	public function GetAllRestocks()
	{
		$this->db->select('*');
		$this->db->where('Type', '0');
		$this->db->order_by('DateAdded', 'desc');
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function GetTransactionsRestockedUnordered()
	{
		$this->db->select('*');
		$this->db->where('OrderNo', NULL);
		$this->db->where('Type', '0');
		$this->db->where('Status', '0');
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetAllPurchaseOrderedTransactions() // remove duplicate?
	{
		$this->db->select('*');
		$this->db->where('OrderNo !=', NULL);
		$this->db->where('Type', '0');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetPurchaseOrderedTransactions($status)
	{
		$sql = "SELECT * FROM products_transactions AS ot WHERE Type = '0' AND EXISTS(SELECT * FROM purchase_orders AS po WHERE po.OrderNo = ot.OrderNo AND Status = $status)";
		$result = $this->db->query($sql);
		return $result;
	}

	public function GetAccounts()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('accounts');  
		return $result;
	}
	public function GetAccountSelection()
	{
		$this->db->select('*');
		$this->db->order_by('Type', 'desc');
		$result = $this->db->get('accounts');  
		return $result;
	}
	public function GetAccountByName($name)
	{
		$this->db->select('*');
		$this->db->where('Name', $name);
		$result = $this->db->get('accounts');  
		return $result;
	}
	public function GetAccountByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('accounts');  
		return $result;
	}
	public function GetJournals()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('journals');  
		return $result;
	}
	public function GetJournalsSortByAccountType($account_id)
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('EXISTS(SELECT AccountID FROM journal_transactions WHERE journals.ID = journal_transactions.JournalID AND journal_transactions.AccountID = '. $account_id .')');
		$result = $this->db->get('journals');  
		return $result;
	}
	public function GetJournalByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('journals');  
		return $result;
	}
	public function GetJournalsRange($from,$to)
	{
		$from = date('Y-m-d', strtotime($from));
		$to = date('Y-m-d', strtotime($to));
		
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('Date >= "' . $from . '" AND Date <= "' . $to . '"');
		$result = $this->db->get('journals');  
		return $result;
	}
	public function GetTransactions()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('EXISTS(SELECT ID FROM journals WHERE journals.ID = journal_transactions.JournalID)');
		$result = $this->db->get('journal_transactions');
		return $result;
	}
	public function GetTransactionByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('journal_transactions');  
		return $result;
	}
	public function GetTransactionsByJournalID($id)
	{
		$this->db->select('*');
		$this->db->where('JournalID', $id);
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('journal_transactions');  
		return $result;
	}
	public function GetTransactionsRange($from,$to)
	{
		$from = date('Y-m-d', strtotime($from));
		$to = date('Y-m-d', strtotime($to));

		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('EXISTS(SELECT ID FROM journals WHERE journals.ID = journal_transactions.JournalID AND journals.Date >= "' . $from . '" AND journals.Date <= "' . $to . '")');
		$result = $this->db->get('journal_transactions');
		return $result;
	}
	public function GetTransactionsRangeByAccountID($from,$to,$account_id)
	{
		$from = date('Y-m-d', strtotime($from));
		$to = date('Y-m-d', strtotime($to));

		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('AccountID', $account_id);
		$this->db->where('EXISTS(SELECT ID FROM journals WHERE journals.ID = journal_transactions.JournalID AND journals.Date >= "' . $from . '" AND journals.Date <= "' . $to . '")');
		$result = $this->db->get('journal_transactions');
		return $result;
	}

	// NAME SEARCH
	public function FindVendorName($name)
	{
		$this->db->select('Name, VendorNo');
		$this->db->like('Name', $name);
		$this->db->order_by('Name', 'desc');
		$this->db->limit('6');
		$result = $this->db->get('vendors');  
		return $result;
	}
	public function FindVendorAll()
	{
		$this->db->select('Name, VendorNo');
		$this->db->order_by('Name', 'desc');
		$this->db->limit('6');
		$result = $this->db->get('vendors');  
		return $result;
	}
	public function FindClientName($name)
	{
		$this->db->select('Name, ClientNo');
		$this->db->like('Name', $name);
		$this->db->order_by('Name', 'desc');
		$this->db->limit('6');
		$result = $this->db->get('clients');  
		return $result;
	}
	public function FindClientAll()
	{
		$this->db->select('Name, ClientNo');
		$this->db->order_by('Name', 'desc');
		$this->db->limit('6');
		$result = $this->db->get('clients');  
		return $result;
	}

	public function Get_productByPID($product_id)
	{
		$this->db->select('*');
		$this->db->where('Code', $product_id);
		$result = $this->db->get('products');  
		return $result;
	}
	public function AllItem_Code()
	{
		$this->db->select('*');
		$result = $this->db->get('tb_itemcode');  
		return $result;
	}
	public function GetPROdtype()
	{
		$this->db->distinct();
		$this->db->select('Prod_Type');
		$result = $this->db->get('tb_itemcode');  
		return $result;
	}

	public function CheckItemcode_byuid($uniqueID)
	{
		$this->db->select('*');
		$this->db->where('uniqueID', $uniqueID);
		$result = $this->db->get('tb_itemcode');  
		return $result;
	}
	public function CheckItemCode($prod_itemcode)
	{
		$this->db->select('*');
		$this->db->where('ItemCode', $prod_itemcode);
		$result = $this->db->get('tb_itemcode');  
		return $result;
	}
	public function Filter_releaseprod()
	{
		$this->db->select('*');
		$this->db->where('Type', 1);
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function Filter_restockprod()
	{
		$this->db->select('*');
		$this->db->where('Type', 0);
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	public function CheckProduct_restock($Code)
	{
		$this->db->select('*');
		$this->db->where('Code', $Code);
		$result = $this->db->get('products');  
		return $result;
	}
	public function CheckStocks_releasing($Code)
	{
		$this->db->select('*');
		$this->db->where('Code', $Code);
		$result = $this->db->get('products');
		return $result;
	}
	public function cart_releasing($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('status', '0');
		$result = $this->db->get('cart_release');
		return $result;
	}
	public function Getsum_releasequantity($user_id,$status)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('status', $status);
		$result = $this->db->get('cart_release');
		return $result;
	}

	public function Get_ProductRow($Code)
	{
		$this->db->select('*');
		$this->db->where('Code', $Code);
		$result = $this->db->get('products');
		return $result;
	}
	public function CheckProduct_byCode($Code)
	{
		$this->db->select('*');
		$this->db->where('Code', $Code);
		$result = $this->db->get('products');
		return $result;
	}
	public function GetAllProductsv2()
	{
		$this->db->select('*');
		$this->db->where('Status', 1);
		$result = $this->db->get('products');
		return $result;
	}
	public function CheckBrand_Char($data)
	{
		extract($data);
		$this->db->select('*');
		$this->db->where('Brand_Name', $Brand_Name);
		$this->db->where('Brand_Char', $Brand_Char);
		$result = $this->db->get('brand_category');
		return $result;
	}
	public function All_Brands()
	{
		$this->db->select('*');
		$result = $this->db->get('brand_category');
		return $result;
	}
	public function CheckBrand_Data($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_category');
		return $result;
	}
	public function CheckBrand_Properties($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_properties');
		return $result;
	}
	public function CheckBrand_Variants($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_vcpd');
		return $result;
	}
	public function CheckBrand_Sizes($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_size');
		return $result;
	}
	public function CheckBrand_UniqueID($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_category');
		return $result;
	}
	public function CheckBrand_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('brand_vcpd');
		return $result;
	}
	public function GetAll_BrandSizes($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_size');
		return $result;
	}
	public function CheckSizeID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('brand_size');
		return $result;
	}
	public function Get_Brand_Data()
	{
		$this->db->select('*');
		$result = $this->db->get('brand_category');
		return $result;
	}
	public function CheckUID($U_ID)
	{
		$this->db->select('*');
		$this->db->where('U_ID', $U_ID);
		$result = $this->db->get('products');
		return $result;
	}
	public function CheckSKU_Code($skuCode)
	{
		$this->db->select('*');
		$this->db->where('Code', $skuCode);
		$result = $this->db->get('products');
		return $result;
	}
	public function GetProductDetails($skuCode)
	{
		$this->db->select('*');
		$this->db->where('item_code', $skuCode);
		$result = $this->db->get('product_details');
		return $result;
	}
	public function Trashed_Products()
	{
		$this->db->select('*');
		$this->db->where('Status', 2);
		$result = $this->db->get('products');
		return $result;
	}
	public function CheckPrd_id($ID)
	{
		$this->db->select('*');
		$this->db->where('ID', $ID);
		$result = $this->db->get('products');
		return $result;
	}
	public function ChecBrand_Cat($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_category');
		return $result;
	}
	public function ChecBrand_Prop($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_properties');
		return $result;
	}
	public function ChecBrand_Size($UniqueID)
	{
		$this->db->select('*');
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->get('brand_size');
		return $result;
	}
	public function GetProduct_ID($ID)
	{
		$this->db->select('*');
		$this->db->where('ID', $ID);
		$result = $this->db->get('products');
		return $result;
	}
	public function GetProduct_Prop($item_code)
	{
		$this->db->select('*');
		$this->db->where('item_code', $item_code);
		$result = $this->db->get('product_details');
		return $result;
	}
	public function CheckProduct_BY_ID($ID)
	{
		$this->db->select('*');
		$this->db->where('ID', $ID);
		$result = $this->db->get('products');
		return $result;
	}
	public function CheckCart_ByID($cart_id)
	{
		$this->db->select('*');
		$this->db->where('cart_id', $cart_id);
		$result = $this->db->get('cart_release');
		return $result;
	}
	public function GetAll_Mail()
	{
		$this->db->select('*');
		$result = $this->db->get('tb_mailsent');
		return $result;
	}
	public function get_allstocks()
	{
		$this->db->select('*');
		$this->db->where('Stocks >', 0);
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function Checkprd_uid($uid)
	{
		$this->db->select('*');
		$this->db->where('Status', 1);
		$this->db->where('U_ID', $uid);
		$result = $this->db->get('products');
		return $result;
	}
	public function Checkthis_prd_uid($uid)
	{
		$this->db->select('*');
		$this->db->where('U_ID', $uid);
		$result = $this->db->get('products');
		return $result;
	}
	public function Checkthis_prd_sku($product_sku)
	{
		$this->db->select('*');
		$this->db->where('Code', $product_sku);
		$result = $this->db->get('products');
		return $result;
	}
	public function Get_Cart_dataaa($user_id,$status)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('status', $status);
		$result = $this->db->get('cart_restocking');
		return $result;
	}
	public function CheckCartItem_ID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('cart_restocking');
		return $result;
	}
	public function prd_rowdata($U_ID,$Code)
	{
		$this->db->select('*');
		$this->db->where('U_ID', $U_ID);
		$this->db->where('Code', $Code);
		$result = $this->db->get('products');
		return $result;
	}
	public function Get_Stock_indb($UID,$Product_SKU)
	{
		$this->db->select('*');
		$this->db->where('UID', $UID);
		$this->db->where('Product_SKU', $Product_SKU);
		$this->db->where('Stocks >', 0);
		$this->db->limit(1);
		$this->db->order_by('Expiration_Date','ASC');
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function Check_thisstock($uid,$product_sku)
	{
		$this->db->select('*');
		$this->db->where('UID', $uid);
		$this->db->where('Product_SKU', $product_sku);
		$this->db->where('Stocks >', 0);
		$this->db->limit(1);
		$this->db->order_by('Expiration_Date','ASC');
		$result = $this->db->get('product_stocks');
		return $result;
	}
}
