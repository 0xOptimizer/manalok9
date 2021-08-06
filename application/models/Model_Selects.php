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
		$this->db->limit('10');
		$result = $this->db->get('security_log');  
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
}
