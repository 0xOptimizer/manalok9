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
	
	public function Delete_user_restriction($userID)
	{
		$this->db->where('UserID', $userID);
		$result = $this->db->delete('user_restrictions');
		return $result;
	}

}
