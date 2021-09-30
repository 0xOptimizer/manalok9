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

	public function GetAllRestocks()
	{
		$this->db->select('*');
		$this->db->where('Type', '0');
		$this->db->order_by('DateAdded', 'desc');
		$result = $this->db->get('products_transactions');  
		return $result;
	}
	// public function GetTransactionsByTID($id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->where('TransactionID', $id);
	// 	$result = $this->db->get('products_transactions');  
	// 	return $result;
	// }
	// public function GetTransactionsByOrderNo($orderNo)
	// {
	// 	$this->db->select('*');
	// 	$this->db->where('OrderNo', $orderNo);
	// 	$result = $this->db->get('products_transactions');
	// 	return $result;
	// }
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
}
