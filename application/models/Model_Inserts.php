<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Inserts extends CI_Model {

	public function InsertNewUser($data)
	{
		$result = $this->db->insert('users', $data);
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
}
