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
		$this->db->order_by('ID', 'desc');
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

	// PURCHASE ORDERS
	public function GetAllOrders()
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$result = $this->db->get('purchase_orders');  
		return $result;
	}
	public function GetOrders($status)
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('Status', $status);
		$result = $this->db->get('purchase_orders');
		return $result;
	}
	public function GetPurchaseOrderByID($id)
	{
		$this->db->select('*');
		$this->db->where('ID', $id);
		$result = $this->db->get('purchase_orders');  
		return $result;
	}
	public function MaxOrderID()
	{
		$this->db->select_max('ID');
		$result = $this->db->get('purchase_orders');
		return $result->row_array()['ID'];
	}
	public function GetOrderTransactions($orderID)
	{
		$this->db->select('*');
		$this->db->where('PurchaseOrderID', $orderID);
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetAllOrderedTransactions()
	{
		$this->db->select('*');
		$this->db->where('PurchaseOrderID !=', NULL);
		$this->db->order_by('Code', 'asc');
		$result = $this->db->get('products_transactions');
		return $result;
	}
	public function GetOrderedTransactions($status)
	{
		$sql = "SELECT * FROM products_transactions AS ot WHERE Type = '1' AND EXISTS(SELECT * FROM purchase_orders AS po WHERE po.ID = ot.PurchaseOrderID AND Status = $status)";
		$result = $this->db->query($sql);
		return $result;
	}
	public function GetTransactionsReleasedUnordered()
	{
		$this->db->select('*');
		$this->db->where('PurchaseOrderID', NULL);
		$this->db->where('Type', '1');
		$this->db->where('Status', '0');
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
}
