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

	public function InsertUserRestrictions($data)
	{
		$result = $this->db->insert('user_restrictions', $data);
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
	public function InsertManualTransaction($data)
	{
		$result = $this->db->insert('manual_transactions', $data);
		return $result;
	}
	public function InsertBill($data)
	{
		$result = $this->db->insert('bills', $data);
		return $result;
	}
	// SALES ORDERS
	public function InsertSalesOrder($data)
	{
		$result = $this->db->insert('sales_orders', $data);
		return $result;
	}
	public function InsertInvoice($data)
	{
		$result = $this->db->insert('invoices', $data);
		return $result;
	}
	// RETURNS
	public function InsertReturn($data)
	{
		$result = $this->db->insert('returns', $data);
		return $result;
	}
	public function InsertReturnData($data)
	{
		$result = $this->db->insert('product_returned', $data);
		return $result;
	}
	// ACCOUNTS / JOURNALS
	public function InsertAccount($data)
	{
		$result = $this->db->insert('accounts', $data);
		return $result;
	}
	public function InsertJournal($data)
	{
		$result = $this->db->insert('journals', $data);
		return $result;
	}
	public function InsertJournalTransaction($data)
	{
		$result = $this->db->insert('journal_transactions', $data);
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
	public function Insert_BrandCategory($data)
	{
		$result = $this->db->insert('brand_category', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Insert_BrandProperties($data)
	{
		$result = $this->db->insert('brand_properties', $data);
		return $result;
	}
	public function Insert_BrandVariants($data)
	{
		$result = $this->db->insert('brand_vcpd', $data);
		return $result;
	}
	public function Insert_BrandSizes($data)
	{
		$result = $this->db->insert('brand_size', $data);
		return $result;
	}
	public function AddBrand_Var($data)
	{
		$this->db->insert('brand_vcpd', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Add_NewBrandsize($data)
	{
		$this->db->insert('brand_size', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function EmailInsert($data)
	{
		$result = $this->db->insert('tb_mailsent', $data);
		return $result;
	}
	public function Insert_toCartRestocking($data)
	{
		$result = $this->db->insert('cart_restocking', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Insert_toStock_tb($data)
	{
		$this->db->insert('product_stocks', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Insert_Releasedata($data)
	{
		$this->db->insert('product_released', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
}
