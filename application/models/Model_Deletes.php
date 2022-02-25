<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Deletes extends CI_Model {

	public function RemoveVariantBrand($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('brand_vcpd');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function remove_size_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('brand_size');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_product($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('products');
		return $result;
	}
	public function deletePrd_details($skuCode)
	{
		$this->db->where('item_code', $skuCode);
		$result = $this->db->delete('product_details');
		return $result;
	}
	public function deletePrd_trans($skuCode)
	{
		$this->db->where('Code', $skuCode);
		$result = $this->db->delete('products_transactions');
		return $result;
	}

	public function remove_brands($UniqueID)
	{
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->delete('brand_category');
		return $result;
	}
	public function remove_brandsprop($UniqueID)
	{
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->delete('brand_properties');
		return $result;
	}
	public function remove_brandssize($UniqueID)
	{
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->delete('brand_size');
		return $result;
	}
	public function RemoveCart_rel($cart_id)
	{
		$this->db->where('cart_id', $cart_id);
		$result = $this->db->delete('cart_release');
	}
	
	public function Delete_user_restriction($userID)
	{
		$this->db->where('UserID', $userID);
		$result = $this->db->delete('user_restrictions');
		return $result;
	}

	public function Delete_journal($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('journals');
		return $result;
	}
	public function Delete_journal_transaction($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('journal_transactions');
		return $result;
	}
	public function Delete_client($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('clients');
		return $result;
	}
	public function Delete_vendor($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('vendors');
		return $result;
	}
	public function Delete_cartRestock_item($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cart_restocking');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_Stock($id)
	{
		$this->db->where('ID', $id);
		$this->db->delete('product_stocks');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_Release($transactionid)
	{
		$this->db->where('transactionid', $transactionid);
		$this->db->delete('product_released');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function Delete_Stock_Code($code)
	{
		$this->db->where('Product_SKU', $code);
		$this->db->delete('product_stocks');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
}
