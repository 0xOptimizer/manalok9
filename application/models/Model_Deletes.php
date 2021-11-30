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
	
}
