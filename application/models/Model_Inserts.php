<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Inserts extends CI_Model {

	public function InsertNewUser($data)
	{
		$result = $this->db->insert('users', $data);
		return $result;
	}
	public function InsertNewVendor($data)
	{
		$result = $this->db->insert('vendors', $data);
		return $result;
	}
	public function InsertNewClient($data)
	{
		$result = $this->db->insert('clients', $data);
		return $result;
	}
	public function InsertLoginHistory($data)
	{
		$result = $this->db->insert('users_login_history', $data);
		return $result;
	}
	public function InsertNewProduct($data)
	{
		$result = $this->db->insert('products', $data);
		return $result;
	}
	public function InsertNewTransaction($data)
	{
		$result = $this->db->insert('products_transactions', $data);
		return $result;
	}
	public function InsertRegistrationToken($data)
	{
		$result = $this->db->insert('users_registrations', $data);
		return $result;
	}
	public function InsertUserLogin($data)
	{
		$result = $this->db->insert('users_login', $data);
		return $result;
	}

	// LOGBOOK
	public function InsertLogbook($data)
	{
		$result = $this->db->insert('logbook', $data);
		return $result;
	}

	// PURCHASE ORDERS
	public function InsertPurchaseOrder($data)
	{
		$result = $this->db->insert('purchase_orders', $data);
		return $result;
	}
	// SALES ORDERS
	public function InsertSalesOrder($data)
	{
		$result = $this->db->insert('sales_orders', $data);
		return $result;
	}
	public function AddNewItem_Code($data)
	{
		$result = $this->db->insert('tb_itemcode', $data);
		return $result;
	}
	public function Insertto_releasingcart($data)
	{
		$result = $this->db->insert('cart_release', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function InsertPrd_Details($data)
	{
		$result = $this->db->insert('product_details', $data);
		return $result;
	}
}
