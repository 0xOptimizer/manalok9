<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Updates extends CI_Model {

	public function UpdateUser($data, $userID)
	{
		$this->db->where('UserID', $userID);
		$result = $this->db->update('users', $data);
		return $result;
	}
	public function UpdateUserLogin($data, $userID)
	{
		$checkIfUserIDExists = $this->Model_Selects->GetUserID($userID, 'users_login');
		if ($checkIfUserIDExists->num_rows() > 0) {
			$this->db->where('UserID', $userID);
			$result = $this->db->update('users_login', $data);
			return $result;
		} else {
			$data['UserID'] = $userID;
			$result = $this->db->insert('users_login', $data);
			return $result;
		}
	}
	public function UpdateStocksCount($code, $inStock)
	{
		$this->db->where('Code', $code);
		$this->db->set('InStock', $inStock);
		$result = $this->db->update('products');
		return $result;
	}
}
