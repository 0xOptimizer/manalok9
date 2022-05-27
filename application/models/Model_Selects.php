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
	public function GetUserDetails($userID)
	{
		$this->db->select('*');
		$this->db->where('UserID', $userID);
		$result = $this->db->get('users');  
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
	public function GetRecentLogins()
	{
		$this->db->select('UserID, LastLogin');
		$this->db->order_by('LastLogin', 'desc');
		$result = $this->db->get('users_login');
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
	public function GetProductTransactionByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('products_transactions');  
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
	public function C_Stocks_perMonth($c_year,$val)
	{
		$sql = "SELECT EXTRACT(MONTH FROM date_added) as months, EXTRACT(YEAR FROM date_added) as year,
					COALESCE ((SELECT SUM(quantity) FROM sales_history WHERE status = 'restocked'), 0) -
					COALESCE ((SELECT SUM(quantity) FROM sales_history WHERE status = 'released'), 0) AS total  
				FROM sales_history 
				WHERE YEAR(date_added) = '$c_year' AND MONTH(date_added) = '$val' 
				GROUP BY months,year 
				ORDER BY months ASC";
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

	public function product_stocks_between_months($from,$to)
	{
		$this->db->select('*, SUM(Current_Stocks) in_stock, SUM(Released_Stocks) released');
		if ($from != NULL && $to != NULL) {
			$this->db->where('DATE(Date_Added) BETWEEN ("'. $from .'") AND ("'. $to .'")');
		}
		$this->db->group_by('Product_SKU');
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function product_stocks_total($sku)
	{
		$this->db->select('SUM(Current_Stocks) total_stocks');
		$this->db->where('Product_SKU', $sku);
		$result = $this->db->get('product_stocks');
		return $result;
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
		$this->db->select('*');
		$this->db->where('UserID', $userID);
		$result = $this->db->get('user_restrictions'); 
		return $result;
	}
	public function GetProductStocks($product_sku)
	{
		$this->db->select('*');
		$this->db->where('Product_SKU', $product_sku);
		$this->db->where('Status', '1');
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function GetStockedProductStocks($product_sku)
	{
		$this->db->select('*');
		$this->db->where('Product_SKU', $product_sku);
		$this->db->where('Current_Stocks > 0');
		$this->db->where('Status', '1');
		$result = $this->db->get('product_stocks');
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
		$this->db->where('Status', '1');
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
		$this->db->where('Status', '1');
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
	public function GetClientsWithSO()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('EXISTS(SELECT * FROM sales_orders WHERE clients.ClientNo = sales_orders.BillToClientNo)');
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
	public function GetUnreturnedSalesOrdersByBillClientNoFulfilled($clientNo)
	{
		$this->db->select('*');
		$this->db->where('BillToClientNo', $clientNo);
		$this->db->where('Status', '5');
		$this->db->where('sales_orders.OrderNo NOT IN(SELECT SalesOrderNo FROM returns)');
		$result = $this->db->get('sales_orders');  
		return $result;
	}

	public function GetAllSalesOrdersNo($status='',$from='',$to='')
	{
		$this->db->select('OrderNo');
		$this->db->distinct();
		$this->db->order_by('ID', 'desc');
		if ($status != '') {
			$this->db->where('Status', $status);
		}
		if ($from != '' && $to != '') {
			$from = date('Y-m-d H:i:s', strtotime($from));
			$to = date('Y-m-d H:i:s', strtotime($to) + 86399);

			$this->db->where('DateCreation >', $from);
			$this->db->where('DateCreation <', $to);
		}
		$result = $this->db->get('sales_orders');
		return $result;
	}
	public function GetSalesOrdersInOrderNo($orderNos)
	{
		$this->db->select('*');
		if (sizeof($orderNos) > 0) {
			$this->db->where_in('OrderNo', $orderNos);
		} else {
			$this->db->where('DateCreation', NULL);
		}
		$result = $this->db->get('sales_orders');
		return $result;
	}

	public function GetProductTransactionsInSalesOrderNo($orderNos,$status)
	{
		$this->db->select('Code');
		$this->db->distinct();
		if ($status != '') {
			$status = ' AND sales_orders.Status = "'. $status .'"';
		} else {
			$status = '';
		}
		$this->db->where('EXISTS(SELECT ID FROM sales_orders WHERE products_transactions.OrderNo = sales_orders.OrderNo'. $status .')');
		$this->db->where_in($orderNos);
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetProductTransactionsInPurchaseOrderNo($orderNos,$status)
	{
		$this->db->select('Code');
		$this->db->distinct();
		if ($status != '') {
			$status = ' AND purchase_orders.Status = '. $status;
		} else {
			$status = '';
		}
		$this->db->where('EXISTS(SELECT ID FROM purchase_orders WHERE products_transactions.OrderNo = purchase_orders.OrderNo'. $status .')');
		$this->db->where_in($orderNos);
		$result = $this->db->get('products_transactions');
		// print_r($this->db->last_query()); exit();
		return $result;
	}

	// INVOICES
	public function GetInvoices()
	{
		$this->db->select('*');
		$this->db->where('Status', '1');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('invoices');
		return $result;
	}
	public function GetInvoicesBySONo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$this->db->where('Status', '1');
		$result = $this->db->get('invoices');
		return $result;
	}
	public function GetTotalInvoicesBySONo($orderNo)
	{
		$this->db->select_sum('Amount');
		$this->db->where('OrderNo', $orderNo);
		$this->db->where('Status', '1');
		$result = $this->db->get('invoices');
		return $result;
	}
	public function GetInvoiceByInvoiceNo($invoiceNo)
	{
		$this->db->select('*');
		$this->db->where('InvoiceNo', $invoiceNo);
		$this->db->where('Status', '1');
		$result = $this->db->get('invoices');
		return $result;
	}
	public function GetLastInvoiceBySONo($orderNo)
	{
		$this->db->select('MAX(Date) as date');
		$this->db->where('OrderNo', $orderNo);
		$this->db->where('Status', '1');
		$this->db->limit('1');
		$result = $this->db->get('invoices');
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
		$this->db->where('Status', 1);
		$this->db->order_by('ID', 'asc');
		$result = $this->db->get('products'); 
		return $result;
	}
	// ADTL FEES
	public function GetAdtlFeesByOrderNo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('adtl_fees');
		return $result;
	}
	public function GetAdtlFeesByAdtlFeeNo($adtlFeeNo)
	{
		$this->db->select('*');
		$this->db->where('AdtlFeeNo', $adtlFeeNo);
		$result = $this->db->get('adtl_fees');
		return $result;
	}
	public function GetAdtlFeesByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('adtl_fees');
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
	// BILLS
	public function GetBills()
	{
		$this->db->select('*');
		$this->db->where('Status', '1');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('bills');  
		return $result;
	}
	public function GetBillsByPONo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$this->db->where('Status', '1');
		$result = $this->db->get('bills');  
		return $result;
	}
	public function GetTotalBillsByPONo($orderNo)
	{
		$this->db->select_sum('Amount');
		$this->db->where('OrderNo', $orderNo);
		$this->db->where('Status', '1');
		$result = $this->db->get('bills');  
		return $result;
	}
	public function GetBillByBillNo($billNo)
	{
		$this->db->select('*');
		$this->db->where('BillNo', $billNo);
		$this->db->where('Status', '1');
		$result = $this->db->get('bills');
		return $result;
	}
	public function GetBillByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$this->db->where('Status', '1');
		$result = $this->db->get('bills');
		return $result;
	}

	// MANUAL TRANSACTIONS
	public function GetManualTransactions()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('manual_transactions');  
		return $result;
	}
	public function GetManualTransactionByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('manual_transactions');  
		return $result;
	}
	public function GetManualTransactionsByPONo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->get('manual_transactions');  
		return $result;
	}
	public function GetManualTransactionByManualTransactionNo($manualTransactionNo)
	{
		$this->db->select('*');
		$this->db->where('ManualTransactionNo', $manualTransactionNo);
		$result = $this->db->get('manual_transactions');
		return $result;
	}

	// RESTOCK
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

	public function GetAllPurchaseOrdersNo($status='',$from='',$to='')
	{
		$this->db->select('OrderNo');
		$this->db->distinct();
		$this->db->order_by('ID', 'desc');
		if ($status != '') {
			$this->db->where('Status', $status);
		}
		if ($from != '' && $to != '') {
			$from = date('Y-m-d H:i:s', strtotime($from));
			$to = date('Y-m-d H:i:s', strtotime($to) + 86399);

			$this->db->where('DateCreation >', $from);
			$this->db->where('DateCreation <', $to);
		}
		$result = $this->db->get('purchase_orders');
		return $result;
	}
	public function GetPurchaseOrdersInOrderNo($orderNos)
	{
		$this->db->select('*');
		if (sizeof($orderNos) > 0) {
			$this->db->where_in('OrderNo', $orderNos);
		} else {
			$this->db->where('DateCreation', NULL);
		}
		$result = $this->db->get('purchase_orders');
		return $result;
	}

	// RETURNS
	public function GetReturns()
	{
		$this->db->select('*');
		$result = $this->db->get('returns');  
		return $result;
	}
	public function GetReturnByReturnNo($returnNo)
	{
		$this->db->select('*');
		$this->db->where('ReturnNo', $returnNo);
		$result = $this->db->get('returns');  
		return $result;
	}
	public function GetReturnBySalesNo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('SalesOrderNo', $orderNo);
		$result = $this->db->get('returns');  
		return $result;
	}
	public function GetReturnProductByID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('product_returned');  
		return $result;
	}
	public function GetReturnProductsByReturnNo($returnNo)
	{
		$this->db->select('*');
		$this->db->where('returnno', $returnNo);
		$result = $this->db->get('product_returned');  
		return $result;
	}
	public function GetReturnProductByTID($transactionid)
	{
		$this->db->select('*');
		$this->db->where('transactionid', $transactionid);
		$result = $this->db->get('product_returned');  
		return $result;
	}
	public function GetReturnProductSumQtyByTIDRemark($transactionid, $remark)
	{
		$this->db->select_sum('quantity');
		$this->db->where('transactionid', $transactionid);
		$this->db->where('remarks', $remark);
		$result = $this->db->get('product_returned');
		return $result;
	}
	// public function GetUnreturnedTransactionsByOrderNo($orderNo)
	// {
	// 	$this->db->select('*');
	// 	$this->db->where('OrderNo', $orderNo);
	// 	$this->db->where('NOT EXISTS(SELECT * FROM product_returned WHERE products_transactions.TransactionID
	// 	 = product_returned.transactionid)');
	// 	$result = $this->db->get('products_transactions');
	// 	return $result;
	// }

	// REPLACEMENTS
	public function GetReplacements()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('replacements');
		return $result;
	}
	public function GetReplacementByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('replacements');
		return $result;
	}
	public function GetReplacementByNo($no)
	{
		$this->db->select('*');
		$this->db->where('ReplacementNo', $no);
		$result = $this->db->get('replacements');
		return $result;
	}
	public function GetReplacementsByOrderNo($orderNo)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $orderNo);
		$this->db->where('Status', 1);
		$result = $this->db->get('replacements');
		return $result;
	}
	public function GetReplacementsByTransactionID($transactionID)
	{
		$this->db->select('*');
		$this->db->where('TransactionID', $transactionID);
		$this->db->where('Status', 1);
		$result = $this->db->get('replacements');
		return $result;
	}

	// ACCOUNTING
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
	public function GetJournalByOrderNo($no)
	{
		$this->db->select('*');
		$this->db->where('OrderNo', $no);
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
		$this->db->where('Status', 1);
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
		$this->db->where('Current_Stocks >', 0);
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
		$this->db->where('Current_Stocks >', 0);
		$this->db->limit(1);
		$this->db->order_by('Expiration_Date','ASC');
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function Check_prd_stockid($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function CheckStock_ifExist($id,$uids,$pre_sku)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$this->db->where('UID', $uids);
		$this->db->where('Product_SKU', $pre_sku);
		$result = $this->db->get('product_stocks');
		return $result;
	}
	public function CheckPrd_in_tb($U_ID,$Code)
	{
		$this->db->select('*');
		$this->db->where('U_ID', $U_ID);
		$this->db->where('Code', $Code);
		$result = $this->db->get('products');
		return $result;
	}
	public function total_restock()
	{
		$this->db->select_sum('quantity');
		$this->db->where('status','restocked');
		$this->db->where('EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)');
		$this->db->where('EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)');
		$result = $this->db->get('sales_history');
		return $result->row_array();
	}
	public function total_released()
	{
		$this->db->select_sum('quantity');
		$this->db->where('status','released');
		$this->db->where('EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)');
		$this->db->where('EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)');
		$result = $this->db->get('sales_history');
		return $result->row_array();
	}


	// stock history
	public function GetStockHistoryRestocked($stockid,$uid,$prd_sku)
	{
		$this->db->select('*');
		$this->db->where('stockid', $stockid);
		$this->db->where('uid', $uid);
		$this->db->where('prd_sku', $prd_sku);
		$this->db->where('status', 'restocked');
		$this->db->order_by('date_added','ASC');
		$this->db->where('EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)');
		$this->db->where('EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)');
		$result = $this->db->get('sales_history');
		return $result;
	}
	public function GetStockHistoryRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399);

		$this->db->select('*');
		$this->db->where('date_added >= "' . $from . '" AND date_added <= "' . $to . '"');
		$this->db->where('EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)');
		$this->db->where('EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)');
		$result = $this->db->get('sales_history');
		return $result;
	}

	public function GetStockHistoryRestockedTotalPriceRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399);

		$this->db->select('SUM(total_price) AS restocked_total_price');
		$this->db->where('status', 'restocked');
		$this->db->where('date_added >= "' . $from . '" AND date_added <= "' . $to . '"');
		$this->db->where('EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)');
		$this->db->where('EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)');
		$result = $this->db->get('sales_history');
		return $result->row_array();
	}
	public function GetStockHistoryReleasedTotalPriceRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399);

		$this->db->select('SUM(total_price) AS released_total_price');
		$this->db->where('status', 'released');
		$this->db->where('date_added >= "' . $from . '" AND date_added <= "' . $to . '"');
		$this->db->where('EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)');
		$this->db->where('EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)');
		$result = $this->db->get('sales_history');
		return $result->row_array();
	}

	public function GetStockHistoryTotalPriceRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399);

		$where_date = 'date_added >= "' . $from . '" AND date_added <= "' . $to . '"';
		$where_stocks = 'EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)';
		$where_product = 'EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)';

		$this->db->select('
				COALESCE ((SELECT SUM(total_price) FROM sales_history WHERE status = "restocked" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) -
				COALESCE ((SELECT SUM(total_price) FROM sales_history WHERE status = "released" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) AS ending_inventory_total_price
			');

		$this->db->where($where_date);
		$this->db->limit('1');
		$this->db->where($where_stocks);
		$this->db->where($where_product);
		$result = $this->db->get('sales_history');
		if ($result->num_rows() > 0) {
			return $result->row_array()['ending_inventory_total_price'];
		} else {
			return NULL;
		}
	}
	public function GetStockHistoryTotalPriceBefore($date)
	{
		$date = date('Y/m/d H:i:s', strtotime($date));

		$where_date = 'date_added < "' . $date . '"';
		$where_stocks = 'EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)';
		$where_product = 'EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)';

		$this->db->select('
				COALESCE ((SELECT SUM(total_price) FROM sales_history WHERE status = "restocked" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) -
				COALESCE ((SELECT SUM(total_price) FROM sales_history WHERE status = "released" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) AS ending_inventory_total_price
			');

		$this->db->where($where_date);
		$this->db->limit('1');
		$this->db->where($where_stocks);
		$this->db->where($where_product);
		$result = $this->db->get('sales_history');
		if ($result->num_rows() > 0) {
			return $result->row_array()['ending_inventory_total_price'];
		} else {
			return NULL;
		}
	}
	public function GetStockHistoryTotalCostRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399); // add 1day-1sec

		$where_date = 'date_added >= "' . $from . '" AND date_added <= "' . $to . '"';
		$where_stocks = 'EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)';
		$where_product = 'EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)';

		$this->db->select('
				COALESCE ((SELECT SUM(total_cost) FROM sales_history WHERE status = "restocked" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) -
				COALESCE ((SELECT SUM(total_cost) FROM sales_history WHERE status = "released" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) AS ending_inventory_total_cost
			');

		$this->db->where($where_date);
		$this->db->limit('1');
		$this->db->where($where_stocks);
		$this->db->where($where_product);
		$result = $this->db->get('sales_history');
		if ($result->num_rows() > 0) {
			return $result->row_array()['ending_inventory_total_cost'];
		} else {
			return NULL;
		}
	}
	public function GetStockHistoryTotalCostBefore($date)
	{
		$date = date('Y/m/d H:i:s', strtotime($date));

		$where_date = 'date_added < "' . $date . '"';
		$where_stocks = 'EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)';
		$where_product = 'EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)';

		$this->db->select('
				COALESCE ((SELECT SUM(total_cost) FROM sales_history WHERE status = "restocked" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) -
				COALESCE ((SELECT SUM(total_cost) FROM sales_history WHERE status = "released" 
					AND '. $where_date .' AND '. $where_stocks .' AND '. $where_product .'), 0) AS ending_inventory_total_cost
			');

		$this->db->where($where_date);
		$this->db->limit('1');
		$this->db->where($where_stocks);
		$this->db->where($where_product);
		$result = $this->db->get('sales_history');
		if ($result->num_rows() > 0) {
			return $result->row_array()['ending_inventory_total_cost'];
		} else {
			return NULL;
		}
	}
	// DISCOUNT
	public function GetDiscountsTotalRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399); // add 1day-1sec

		$where_date = 'date_added >= "' . $from . '" AND date_added <= "' . $to . '"';
		$where_stocks = 'EXISTS(SELECT ID, Status FROM product_stocks WHERE sales_history.stockid = product_stocks.ID AND Status = 1)';
		$where_product = 'EXISTS(SELECT U_ID, Status FROM products WHERE sales_history.uid = products.U_ID AND Status = 1)';

		$this->db->select('SUM(total_cost) AS total');

		$this->db->where($where_date);
		$this->db->limit('1');
		$this->db->where($where_stocks);
		$this->db->where($where_product);
		$this->db->where('status', 'discount');
		$result = $this->db->get('sales_history');
		if ($result->num_rows() > 0) {
			return $result->row_array()['total'];
		} else {
			return NULL;
		}
	}

	public function GetReturnsTotalRange($from,$to)
	{
		$from = date('Y-m-d H:i:s', strtotime($from));
		$to = date('Y-m-d H:i:s', strtotime($to) + 86399); // add 1day-1sec

		$where_stocks = 'EXISTS(SELECT ID, Status FROM product_stocks WHERE product_returned.stockid = product_stocks.ID AND Status = 1)';
		$where_product = 'EXISTS(SELECT U_ID, Status FROM products WHERE product_returned.prd_sku = products.Code AND Status = 1)';

		$this->db->select('SUM(quantity * (SELECT Retail_Price FROM product_stocks WHERE product_stocks.ID = product_returned.stockid)) AS total');
		$this->db->where('date_added >= "' . $from . '" AND date_added <= "' . $to . '"');
		$this->db->limit('1');
		$this->db->where($where_stocks);
		$this->db->where($where_product);
		$result = $this->db->get('product_returned');
		if ($result->num_rows() > 0) {
			return $result->row_array()['total'];
		} else {
			return NULL;
		}
	}
	public function GetAdtlFeesTotalRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399); // add 1day-1sec

		$this->db->select('SUM(Qty * UnitCost) AS total');
		$this->db->where('Date >= "' . $from . '" AND Date <= "' . $to . '"');
		$this->db->limit('1');
		$result = $this->db->get('adtl_fees');
		if ($result->num_rows() > 0) {
			return $result->row_array()['total'];
		} else {
			return NULL;
		}
	}
	public function GetManualTransactionsTotalRange($from,$to)
	{
		$from = date('Y/m/d H:i:s', strtotime($from));
		$to = date('Y/m/d H:i:s', strtotime($to) + 86399); // add 1day-1sec

		$this->db->select('SUM(Qty * UnitCost) AS total');
		$this->db->where('Date >= "' . $from . '" AND Date <= "' . $to . '"');
		$this->db->limit('1');
		$result = $this->db->get('manual_transactions');
		if ($result->num_rows() > 0) {
			return $result->row_array()['total'];
		} else {
			return NULL;
		}
	}

	public function GetAccountsTotalRange($from,$to,$accType='')
	{
		$from = date('Y-m-d', strtotime($from));
		$to = date('Y-m-d', strtotime($to)); // add 1day-1sec

		if ($from == $to) {
			$date_query = 'AND journals.Date = "' . $from . '"';
		} else {
			$date_query = 'AND journals.Date >= "' . $from . '" AND journals.Date <= "' . $to . '"';
		}

		$this->db->select('ID, JournalID, AccountID, SUM(Debit) AS totalDebit, SUM(Credit) AS totalCredit');
		$this->db->where('EXISTS(
								SELECT ID, Date FROM journals 
								WHERE journals.ID = journal_transactions.JournalID 
								'. $date_query .'
							)');

		if ($accType != '') {
			$this->db->where('EXISTS(
									SELECT ID, Type FROM accounts 
									WHERE accounts.ID = journal_transactions.AccountID 
									AND Type = "'. $accType .'"
								)');
		}

		$this->db->group_by('AccountID');
		$result = $this->db->get('journal_transactions');
		return $result;
	}



	public function GetBillsRange($from=NULL,$to=NULL)
	{
		$this->db->select('*');
		if ($from != NULL && $to != NULL) {
			$from = date('Y-m-d', strtotime($from));
			$to = date('Y-m-d', strtotime($to));

			if ($from == $to) {
				$date_query = 'Date = "' . $from . '"';
			} else {
				$date_query = 'Date >= "' . $from . '" AND Date <= "' . $to . '"';
			}
			$this->db->where($date_query);
		}
		$this->db->where('Status', '1');

		$result = $this->db->get('bills');
		return $result;
	}


	public function GetAllBillType()
	{
		$this->db->distinct();
		$this->db->select('Type');
		$this->db->order_by('Type', 'desc');
		$result = $this->db->get('bills'); 
		return $result;
	}
	public function GetAllBillPayee()
	{
		$this->db->distinct();
		$this->db->select('Payee');
		$this->db->order_by('Payee', 'desc');
		$result = $this->db->get('bills'); 
		return $result;
	}
	public function GetAllBillCategory()
	{
		$this->db->distinct();
		$this->db->select('Category');
		$this->db->order_by('Category', 'desc');
		$result = $this->db->get('bills'); 
		return $result;
	}
	public function GetAllBillDepartment()
	{
		$this->db->distinct();
		$this->db->select('Department');
		$this->db->order_by('Department', 'desc');
		$result = $this->db->get('bills'); 
		return $result;
	}




	public function GetLatestSalesOrderNo()
	{
		$this->db->select_max('OrderNo');
		$result = $this->db->get('sales_orders');  
		return $result->row_array()['OrderNo'];
	}



	// RELEASES TABLE
	public function GetAllReleases()
	{
		$this->db->select('*');
		$this->db->order_by('Date', 'desc');
		$result = $this->db->get('releases');  
		return $result;
	}
	public function GetReleaseID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('releases');  
		return $result;
	}
}
